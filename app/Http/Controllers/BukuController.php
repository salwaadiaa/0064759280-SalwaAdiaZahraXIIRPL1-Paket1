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
    public function index()
    {
        $bukus = Buku::paginate(10); // Ganti jumlah paginasi sesuai kebutuhan
        return view('dashboard.buku.index', compact('bukus'));
    }

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
            // Jika tidak ada kategori yang dipilih, tampilkan semua buku
            return $query;
        })
        ->where('judul', 'like', "%$search%")
        ->paginate(10);

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
        // Validasi inputan form disini

        $buku = new Buku();
        $buku->buku_id = $request->input('buku_id');
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->kategori_id = $request->input('kategori_id');

        // Simpan gambar dan atur nama gambar sesuai kebutuhan
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
        // Temukan buku berdasarkan ID
        $buku = Buku::findOrFail($buku_id);

        // Hapus buku
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function edit($buku_id)
    {
        $buku = Buku::findOrFail($buku_id);
        return view('dashboard.buku.edit', compact('buku'));
    }

    public function update(Request $request, $buku_id)
    {
        $request->validate([
            'buku_id' => 'required',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        ]);

        $buku = Buku::findOrFail($buku_id);
        $buku->buku_id = $request->input('buku_id');
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');

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
    // Logika untuk mengajukan peminjaman, misalnya set tanggal_peminjaman dan tanggal_pengembalian
    Peminjaman::create([
        'user_id' => auth()->id(),
        'buku_id' => $bukuId,
        'tanggal_peminjaman' => now(),
        'tanggal_pengembalian' => now()->addDays(5), // Contoh: batas peminjaman 14 hari
        'status_peminjaman' => 'Diajukan',
    ]);

    return redirect()->back()->with('success', 'Peminjaman berhasil diajukan.');
}

    public function setujuiPeminjaman($peminjamanId)
    {
        $peminjaman = Peminjaman::findOrFail($peminjamanId);
        $peminjaman->status_persetujuan = 'Disetujui';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui.');
    }

    public function tolakPeminjaman($peminjamanId)
    {
        $peminjaman = Peminjaman::findOrFail($peminjamanId);
        $peminjaman->status_persetujuan = 'Ditolak';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman ditolak.');
    }
    public function tambahKeKoleksi($buku_id)
    {
        $buku = Buku::find($buku_id);

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }
    
        // Cek apakah buku sudah ada di koleksi pribadi pengguna
        $existingCollection = KoleksiPribadi::where('user_id', Auth::user()->user_id)
            ->where('buku_id', $buku->buku_id)
            ->first();
    
        if ($existingCollection) {
            return redirect()->back()->with('warning', 'Buku sudah ada di koleksi Anda');
        }
    
        // Tambahkan buku ke koleksi pribadi
        KoleksiPribadi::create([
            'user_id' => Auth::user()->user_id,
            'buku_id' => $buku->buku_id,
            // Anda bisa menambahkan data tambahan jika diperlukan
        ]);
    
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke koleksi Anda');
    }
    }
