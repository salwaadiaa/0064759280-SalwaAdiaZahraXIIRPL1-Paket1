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
    
        // Hitung denda hanya jika buku terlambat dikembalikan
        if ($peminjaman->tanggal_pengembalian < now()) {
            // Hitung denda berdasarkan tanggal pengembalian
            $denda = $this->calculateDenda($peminjaman->tanggal_pengembalian);
    
            // Perbarui status menjadi 'Sudah Kembali' dan perbarui denda
            $peminjaman->status_peminjaman = 'Sudah Kembali';
            $peminjaman->denda = $denda;
    
            // Simpan perubahan
            $peminjaman->save();
    
            // Perbarui stok buku
            $buku = Buku::find($peminjaman->buku_id);
            $buku->stok++;
            $buku->save();
    
            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
        } else {
            // Buku dikembalikan tepat waktu, tanpa denda
            $peminjaman->status_peminjaman = 'Sudah Kembali';
            $peminjaman->save();
    
            // Perbarui stok buku
            $buku = Buku::find($peminjaman->buku_id);
            $buku->stok++;
            $buku->save();
    
            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
        }
    }    
    
    private function calculateDenda($tanggalPengembalian)
    {
        $today = now(); // Tanggal dan waktu saat ini
        $returnDate = Carbon::createFromFormat('Y-m-d', $tanggalPengembalian);
        
        // Hitung hari keterlambatan
        $lateDays = max(0, $returnDate->diffInDays($today));

        // Logika perhitungan denda Anda di sini
        $denda = $lateDays * 10000;

        return $denda;
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

        $pdf = PDF::loadView('dashboard.peminjaman.export-pdf', compact('peminjamans', 'startDate', 'endDate'));
        $pdf->setPaper('a4', 'landscape');
        
        $filename = 'peminjaman_' . ($startDate ?? 'all') . '_to_' . ($endDate ?? 'all') . '.pdf';
        
        return $pdf->download($filename);
    }   
}
