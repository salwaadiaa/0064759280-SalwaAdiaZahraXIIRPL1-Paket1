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
        $peminjamans = Peminjaman::with(['user', 'buku'])->where('status_peminjaman', 'Dipinjam')->paginate(10);

        $peminjamanSelesai = Peminjaman::with(['user', 'buku'])->where('status_peminjaman', 'Sudah Kembali')->get();

        return view('dashboard.peminjaman.index', compact('peminjamans', 'peminjamanSelesai'));
    }

    public function selesai()
    {
        $peminjamanSelesai = Peminjaman::with(['user', 'buku'])->where('status_peminjaman', 'Sudah Kembali')->paginate(10);
    
        return view('dashboard.peminjaman.riwayat', compact('peminjamanSelesai'));
    }    

    public function return(Request $request, $peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
    
        if ($peminjaman->status_peminjaman === 'Sudah Kembali') {
            return redirect()->route('peminjaman.index')->with('warning', 'Buku sudah dikembalikan sebelumnya.');
        }
    
        if ($peminjaman->tanggal_pengembalian < now()) {
            $denda = $this->calculateDenda($peminjaman->tanggal_pengembalian);
    
            $peminjaman->status_peminjaman = 'Sudah Kembali';
            $peminjaman->denda = $denda;
    
            $peminjaman->save();
    
            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
        } else {
            $peminjaman->status_peminjaman = 'Sudah Kembali';
            $peminjaman->save();
    
            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
        }
    }    
    
    private function calculateDenda($tanggalPengembalian)
    {
        $today = now();
        $returnDate = Carbon::createFromFormat('Y-m-d', $tanggalPengembalian);
        
        $lateDays = max(0, $returnDate->diffInDays($today));

        $denda = $lateDays * 10000;

        return $denda;
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        
        $query = Peminjaman::with(['user', 'buku'])
            ->where('status_peminjaman', 'Sudah Kembali');
        
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_peminjaman', [$startDate, $endDate]);
        }
        
        $peminjamans = $query->get();

        $pdf = PDF::loadView('dashboard.peminjaman.export-pdf', compact('peminjamans', 'startDate', 'endDate'));
        $pdf->setPaper('a4', 'landscape');
        
        $filename = 'peminjaman_' . ($startDate ?? 'all') . '_to_' . ($endDate ?? 'all') . '.pdf';
        
        return $pdf->download($filename);
    }   

    public function edit($peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        return view('dashboard.peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, $peminjaman_id)
    {
        $request->validate([
            'tanggal_pengembalian' => 'required|date|after_or_equal:tomorrow', 
        ]);
        
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Tanggal pengembalian untuk ' .$peminjaman->user->name. ' berhasil diperbarui.');
    }
}
