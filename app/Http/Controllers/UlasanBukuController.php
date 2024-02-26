<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UlasanBuku;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\KoleksiPribadi;
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
        $buku = $peminjaman->buku;
    
        return view('dashboard.ulasan.create', compact('peminjaman', 'buku'));
    }
    
    public function store(Request $request)
    {
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
            return redirect()->route('ulasan.index')->with('error', 'Anda tidak dapat memberikan ulasan untuk buku ini.');
        }

        $ulasanBuku = UlasanBuku::where('buku_id', $request->buku_id)
            ->where('peminjaman_id', $peminjam->peminjaman_id)
            ->first();

        if (!$ulasanBuku) {
            UlasanBuku::create([
                'user_id' => auth()->user()->user_id,
                'buku_id' => $request->buku_id,
                'peminjaman_id' => $peminjam->peminjaman_id,
                'ulasan' => $request->ulasan,
                'rating' => $request->rating,
            ]);

            KoleksiPribadi::create([
                'user_id' => auth()->user()->user_id,
                'buku_id' => $request->buku_id,
            ]);
        }

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan.');
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

    public function destroy($ulasan_id)
    {
        $ulasan = UlasanBuku::findOrFail($ulasan_id);
        $judulBuku = $ulasan->buku->judul;
    
        $ulasan->delete();
    
        return redirect()->route('ulasan.admin')->with('success', 'Ulasan untuk buku ' . $judulBuku . ' berhasil dihapus');
    }
    
}