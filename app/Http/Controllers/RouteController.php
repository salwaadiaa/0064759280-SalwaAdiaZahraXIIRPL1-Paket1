<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
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

        return view('dashboard.index-admin', compact('totalBuku', 'totalKategoriBuku', 'totalPeminjaman', 'peminjamanPerTanggal', 'totalDenda'));
    }
}

    
}
