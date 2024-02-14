<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\KategoriBuku;
use App\Models\KoleksiPribadi;

class BukuController extends Controller
{
    //menampilkan daftar buku di halaman admin dan petugas
    public function index()
    {
        $bukus = Buku::paginate(10); 
        return view('dashboard.buku.index', compact('bukus'));
    }

    //menampilkan daftar buku di halaman user, dan menambahkan fungsi search berdasarkan judul buku dan dapat memilih kategori buku 
    public function bukuIndex(Request $request)
{
    $search = $request->input('search');
    $kategori_id = $request->input('kategori_id');
    $kategoris = KategoriBuku::all();

    $bukus = Buku::when($kategori_id, function ($query) use ($kategori_id) {
            return $query->whereHas('kategoriBuku', function ($q) use ($kategori_id) {
                $q->where('kategori_id', $kategori_id);
            });
        })
        ->when(!$kategori_id, function ($query) {
            return $query;
        })
        ->where('judul', 'like', "%$search%")
        ->where('stok', '>', 0) 
        ->paginate(10);

    return view('dashboard.buku-user.index', compact('bukus', 'kategoris', 'kategori_id'));
}

    //menampilkan form tambah buku untuk admin
    public function create()
    {
        $buku_id = 'BUKU-' . sprintf('%04d', Buku::count() + 1);
        $kategoriBukus = KategoriBuku::all();
        return view('dashboard.buku.create', compact('kategoriBukus', 'buku_id'));
    }

    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->buku_id = $request->input('buku_id');
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->stok = $request->input('stok');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('/uploads/images'), $namaGambar);
            $buku->gambar = $namaGambar;
        }

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku telah ditambahkan!');
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
        // dd($request->all());
        $request->validate([
            'buku_id' => 'required',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric|min:0',
            'kategori_id' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        ]);

        $buku = Buku::findOrFail($buku_id);
        $buku->buku_id = $request->input('buku_id');
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->stok = $request->input('stok');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('/uploads/images'), $namaGambar);
            $buku->gambar = $namaGambar;
        }

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Data buku telah diperbarui!');
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
    
    
        return redirect()->back()->with('success', 'Peminjaman berhasil dilakukan.');
    }
    

}
