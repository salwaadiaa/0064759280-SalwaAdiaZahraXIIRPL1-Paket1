<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use App\Models\KoleksiPribadi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->get();
        return view('dashboard.peminjaman.index', compact('peminjamans'));
    }

    public function approve($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $peminjaman->status_peminjaman = 'Dipinjam';
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui.');
    }

    public function reject($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $peminjaman->status_peminjaman = 'Ditolak';
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman ditolak.');
    }

    public function return($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
    
        // Menghitung selisih hari
        $tanggalPengembalian = Carbon::parse($peminjaman->tanggal_pengembalian);
        $tanggalKembali = Carbon::now();
        $selisihHari = $tanggalKembali->diffInDays($tanggalPengembalian, false);
    
        // Menghitung denda jika telat mengembalikan
        $denda = $selisihHari > 0 ? $selisihHari * 20000 : 0;
    
        $peminjaman->status_peminjaman = 'Sudah Kembali';
        $peminjaman->denda = $denda;
        $peminjaman->save();
    
        // Menambahkan sweetalert pengembalian berhasil
        return redirect()->route('peminjaman.index')->with('success', 'Pengembalian berhasil.');
    }

    public function exportPdf(Request $request)
{
    $statusFilter = $request->input('status');

    $peminjamans = Peminjaman::when($statusFilter, function ($query) use ($statusFilter) {
            return $query->where('status_peminjaman', $statusFilter);
        })
        ->get();

    $pdf = PDF::loadView('dashboard.peminjaman.export_pdf', compact('peminjamans'));
    return $pdf->download('daftar_peminjaman.pdf');
}

    public function submitReview(Request $request, $peminjaman_id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'ulasan' => 'required|string|max:255',
        ]);
    
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
    
        // Create a new book review
        UlasanBuku::create([
            'user_id' => Auth::user_id(), // Anggap saja Anda memiliki sistem pengguna
            'buku_id' => $peminjaman->buku_id,
            'peminjam_id' => $peminjaman->peminjaman_id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);
    
        // Delete the record from the original table
        $peminjaman->delete();
    
        return redirect()->route('peminjaman.index')->with('success', 'Pengembalian berhasil, dan ulasan Anda telah direkam.');
    }
    


}
