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

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->get();
    
        foreach ($peminjamans as $peminjaman) {
            $peminjaman->calculateDenda();
        }
    
        return view('dashboard.peminjaman.index', compact('peminjamans'));
    }

    public function return($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        
        // Menghitung selisih hari
        $tanggalPengembalian = Carbon::parse($peminjaman->tanggal_pengembalian);
        $tanggalKembali = Carbon::now();
        $selisihHari = $tanggalKembali->diffInDays($tanggalPengembalian, false);
        
        // Menghitung denda jika telat mengembalikan
        $denda = $selisihHari > 0 ? $selisihHari * 5000 : 0;
        
        $peminjaman->status_peminjaman = 'Sudah Kembali';
        $peminjaman->denda = $denda;
        $peminjaman->save();

        // Mengembalikan stok buku
        $buku = Buku::find($peminjaman->buku_id);
        $buku->stok++;
        $buku->save();

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

        $statusSuffix = $statusFilter ? '_' . str_replace(' ', '_', strtolower($statusFilter)) : '';
        $fileName = 'daftar_peminjaman' . $statusSuffix . '.pdf';

        $pdf = PDF::loadView('dashboard.peminjaman.export-pdf', compact('peminjamans'));
        return $pdf->download($fileName);
    }
}
