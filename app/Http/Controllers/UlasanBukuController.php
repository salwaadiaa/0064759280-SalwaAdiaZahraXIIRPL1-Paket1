<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UlasanBuku;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;

class UlasanBukuController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', auth()->user()->user_id)
        ->where('status_peminjaman', 'Sudah Kembali')
        ->doesntHave('ulasan')
        ->with(['user', 'buku', 'ulasan'])
        ->paginate(10);

    return view('dashboard.ulasan.index', compact('peminjamans'));
    }
    
    public function create($peminjamanId)
    {
        $peminjaman = Peminjaman::findOrFail($peminjamanId);
        $buku = $peminjaman->buku; // Ambil buku dari peminjaman
    
        return view('dashboard.ulasan.create', compact('peminjaman', 'buku'));
    }
    
    public function store(Request $request)
    {
        // Simpan ulasan buku yang dibuat oleh pengguna
        $request->validate([
            'buku_id' => 'required|exists:bukus,buku_id',
            'ulasan' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        $peminjam = Peminjaman::where('user_id', auth()->user()->user_id)
            ->where('buku_id', $request->buku_id)
            ->where('status_peminjaman', 'Sudah Kembali')
            ->first();
    
        if (!$peminjam) {
            // Handle jika peminjam tidak ditemukan atau belum mengembalikan buku
            return redirect()->route('ulasan.index')->with('error', 'Anda tidak dapat memberikan ulasan untuk buku ini.');
        }
    
        // Cek apakah buku sudah diulas sebelumnya
        $ulasanBuku = UlasanBuku::where('buku_id', $request->buku_id)
            ->where('peminjaman_id', $peminjam->peminjaman_id)
            ->first();
    
        if (!$ulasanBuku) {
            // Jika belum diulas, tambahkan ulasan
            UlasanBuku::create([
                'user_id' => auth()->user()->user_id,
                'buku_id' => $request->buku_id,
                'peminjaman_id' => $peminjam->peminjaman_id,
                'ulasan' => $request->ulasan,
                'rating' => $request->rating,
            ]);
        }
    
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }
    
    public function bukuDiUlas()
    {
        // Ambil buku yang sudah diulas
        $bukusDiUlas = DB::table('ulasan_bukus')
            ->join('bukus', 'ulasan_bukus.buku_id', '=', 'bukus.buku_id')
            ->select('bukus.*')
            ->distinct()
            ->get();
    
        return view('dashboard.ulasan.buku_di_ulas', compact('bukusDiUlas'));
    }

   public function ulasanAdmin(Request $request)
{
    $ulasans = UlasanBuku::with(['user', 'buku']);

    if ($request->has('judul')) {
        $judul = $request->input('judul');
        $ulasans->whereHas('buku', function ($query) use ($judul) {
            $query->where('judul', $judul);
        });
    }

    $ulasans = $ulasans->paginate(10);
    $listJudulBuku = Buku::select('judul')->distinct()->get();

    return view('dashboard.ulasan.ulasan_admin', compact('ulasans', 'listJudulBuku'));
}
}