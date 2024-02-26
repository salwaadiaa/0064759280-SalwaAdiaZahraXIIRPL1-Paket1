<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{

    public function landing()
    {
        $bukus = Buku::with('ulasans')
            ->leftJoin('ulasan_bukus', 'bukus.buku_id', '=', 'ulasan_bukus.buku_id')
            ->select('bukus.*', DB::raw('COUNT(ulasan_bukus.ulasan_id) as jumlah_ulasan'), DB::raw('AVG(ulasan_bukus.rating) as rating_rata_rata'))
            ->groupBy('bukus.buku_id')
            ->orderBy('jumlah_ulasan', 'desc')
            ->orderBy('rating_rata_rata', 'desc')
            ->limit(12)
            ->get();

        return view('layouts.landingpage', compact('bukus'));
    }

    public function dashboard()
    {
        $user = auth()->user();

        if ($user->role == 'user') {
            $peminjamans = Peminjaman::with(['user', 'buku'])
                ->where('user_id', $user->user_id)
                ->where('status_peminjaman', 'Dipinjam')
                ->get();

            return view('dashboard.index-user', compact('user', 'peminjamans'));
        } else {
            $totalDenda = Peminjaman::where('status_peminjaman', 'Sudah Kembali')
                ->sum('denda');

            $peminjamanPerTanggal = Peminjaman::select(DB::raw('DATE(tanggal_peminjaman) as tanggal'), DB::raw('COUNT(*) as total'))
                ->groupBy('tanggal')
                ->get();

            $totalBuku = Buku::count();
            $totalKategoriBuku = KategoriBuku::count();
            $totalPeminjaman = Peminjaman::count();
            $jumlahUlasan = UlasanBuku::count();

            return view('dashboard.index-admin', compact('totalBuku', 'totalKategoriBuku', 'totalPeminjaman', 'peminjamanPerTanggal', 'totalDenda', 'jumlahUlasan'));
        }
    }


    
}
