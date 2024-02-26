<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\KategoriBuku;
use App\Models\KoleksiPribadi;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{

    public function index(Request $request)
    {
        $categories = KategoriBuku::all();

        $selectedCategory = $request->input('category');

        $bukusQuery = Buku::leftJoin('ulasan_bukus', 'bukus.buku_id', '=', 'ulasan_bukus.buku_id')
            ->select('bukus.*', DB::raw('COUNT(ulasan_bukus.ulasan_id) as jumlah_ulasan'), DB::raw('AVG(ulasan_bukus.rating) as rating_rata_rata'))
            ->groupBy('bukus.buku_id')
            ->orderBy('jumlah_ulasan', 'desc')
            ->orderBy('rating_rata_rata', 'desc');

        if ($selectedCategory) {
            $bukusQuery->where('bukus.kategori_id', $selectedCategory);
        }

        $bukus = $bukusQuery->paginate(10);

        foreach ($bukus as $buku) {
            $buku->best_seller = ($buku->jumlah_ulasan >= 3);
        }

        return view('dashboard.buku.index', compact('bukus', 'categories', 'selectedCategory'));
    }

    public function bukuIndex(Request $request)
    {
        $search = $request->input('search');
        $kategori_id = $request->input('kategori_id');
        $kategoris = KategoriBuku::all();

        $bukus = Buku::leftJoin('ulasan_bukus', 'bukus.buku_id', '=', 'ulasan_bukus.buku_id')
                    ->select('bukus.*', DB::raw('COUNT(ulasan_bukus.ulasan_id) as jumlah_ulasan'), DB::raw('AVG(ulasan_bukus.rating) as rating_rata_rata'))
                    ->when($kategori_id, function ($query) use ($kategori_id) {
                        return $query->whereHas('kategoriBuku', function ($q) use ($kategori_id) {
                            $q->where('kategori_id', $kategori_id);
                        });
                    })
                    ->when(!$kategori_id, function ($query) {
                        return $query;
                    })
                    ->where('judul', 'like', "%$search%")
                    ->groupBy('bukus.buku_id')
                    ->orderBy('jumlah_ulasan', 'desc')
                    ->orderBy('rating_rata_rata', 'desc')
                    ->paginate(9);

        return view('dashboard.buku-user.index', compact('bukus', 'kategoris', 'kategori_id'));
    }

    public function create()
    {
        $buku_id = 'BUKU-' . sprintf('%04d', Buku::count() + 1);
        $kategoriBukus = KategoriBuku::all();
        return view('dashboard.buku.create', compact('kategoriBukus', 'buku_id'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'kategori_id' => 'required',
            'stok' => 'required|numeric',
            'sinopsis' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ], [
            'judul.required' => 'Judul buku harus diisi',
            'penulis.required' => 'Nama penulis harus diisi',
            'penerbit.required' => 'Nama penerbit harus diisi',
            'tahun_terbit.required' => 'Tahun terbit harus diisi',
            'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka',
            'kategori_id.required' => 'Kategori harus dipilih',
            'stok.required' => 'Stok harus diisi',
            'stok.numeric' => 'Stok harus berupa angka',
            'sinopsis.required' => 'Sinopsis buku harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita'
        ]);
        

        $buku = new Buku();
        $buku->buku_id = $request->input('buku_id');
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->stok = $request->input('stok');
        $buku->sinopsis = $request->input('sinopsis');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('/uploads/images'), $namaGambar);
            $buku->gambar = $namaGambar;
        }

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }


    public function destroy($buku_id)
    {
        $buku = Buku::findOrFail($buku_id);

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function edit($buku_id)
    {
        $buku = Buku::findOrFail($buku_id);
        $kategoriBukus = KategoriBuku::all();
        return view('dashboard.buku.edit', compact('buku', 'kategoriBukus'));
    }

    public function update(Request $request, $buku_id)
    {
        $request->validate([
            'buku_id' => 'required',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'sinopsis' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric|min:0',
            'kategori_id' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buku = Buku::findOrFail($buku_id);
        $buku->buku_id = $request->input('buku_id');
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->stok = $request->input('stok');
        $buku->sinopsis = $request->input('sinopsis');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('/uploads/images'), $namaGambar);
            $buku->gambar = $namaGambar;
        }

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku dengan judul ' .$buku->judul. ' berhasil diperbarui!');
    }

    public function ajukanPeminjaman($bukuId)
    {
        $buku = Buku::find($bukuId);

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis. Tidak dapat melakukan peminjaman.');
        }

        $buku->stok--;
        $buku->save();

        $tanggalPeminjaman = now();
        $tanggalPengembalian = clone $tanggalPeminjaman;
        $tanggalPengembalian->addDays(5);

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $bukuId,
            'tanggal_peminjaman' => $tanggalPeminjaman,
            'tanggal_pengembalian' => clone $tanggalPengembalian,
            'status_peminjaman' => 'Dipinjam',
        ]);


        return redirect()->back()->with('success', 'Peminjaman buku yang berjudul ' . $buku->judul . ' berhasil dilakukan.');
    }
}
