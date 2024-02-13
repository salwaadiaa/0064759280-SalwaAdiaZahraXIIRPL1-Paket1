<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use App\Models\Buku;
use App\Models\KoleksiPribadi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->where('status_peminjaman', 'Dipinjam')->get();

        $peminjamanSelesai = Peminjaman::with(['user', 'buku'])->where('status_peminjaman', 'Sudah Kembali')->get();

        return view('dashboard.peminjaman.index', compact('peminjamans', 'peminjamanSelesai'));
    }

    public function selesai()
    {
        $peminjamanSelesai = Peminjaman::with(['user', 'buku'])->where('status_peminjaman', 'Sudah Kembali')->get();

        return view('dashboard.peminjaman.riwayat', compact('peminjamanSelesai'));
    }


    public function return($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        if ($peminjaman->status_peminjaman === 'Sudah Kembali') {
            return redirect()->route('peminjaman.index')->with('warning', 'Buku sudah dikembalikan sebelumnya.');
        }

        $peminjaman->status_peminjaman = 'Sudah Kembali';
        
        $peminjaman->save();

        $buku = Buku::find($peminjaman->buku_id);
        $buku->stok++;
        $buku->save();

        return redirect()->route('peminjaman.index')->with('success', 'Buku sudah berhasil dikembalikan.');
    }

    public function calculateDenda(Request $request)
{
    $peminjamanId = $request->input('peminjaman_id');

    // Temukan peminjaman berdasarkan ID
    $peminjaman = Peminjaman::find($peminjamanId);

    // Panggil metode calculateDenda pada model
    $peminjaman->calculateDenda();

    return response()->json(['message' => 'Denda berhasil dihitung dan disimpan.']);
}

public function exportPdf(Request $request)
{
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');
    
    // Ambil data berdasarkan rentang tanggal jika ada, jika tidak, ambil semua data
    $query = Peminjaman::with(['user', 'buku'])
        ->where('status_peminjaman', 'Sudah Kembali');
    
    if ($startDate && $endDate) {
        $query->whereBetween('tanggal_peminjaman', [$startDate, $endDate]);
    }
    
    $peminjamans = $query->get();

    // Hitung denda untuk setiap peminjaman
    foreach ($peminjamans as $peminjaman) {
        $peminjaman->calculateDenda();
    }

    $pdf = PDF::loadView('dashboard.peminjaman.export-pdf', compact('peminjamans', 'startDate', 'endDate'));
    $pdf->setPaper('a4', 'landscape');
    
    $filename = 'peminjaman_' . ($startDate ?? 'all') . '_to_' . ($endDate ?? 'all') . '.pdf';
    
    return $pdf->download($filename);
}

    
}
