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
        // Jika pengguna adalah "user," arahkan ke tampilan dashboard pengguna
        return view('dashboard.index-user', compact('user'));
    } else {
        $peminjamanPerTanggal = Peminjaman::select(DB::raw('DATE(tanggal_peminjaman) as tanggal'), DB::raw('COUNT(*) as total'))
                                ->groupBy('tanggal')
                                ->get();
        $totalBuku = Buku::count();
        $totalKategoriBuku = KategoriBuku::count();
        $totalPeminjaman = Peminjaman::count();

        return view('dashboard.index-admin', compact('totalBuku', 'totalKategoriBuku', 'totalPeminjaman', 'peminjamanPerTanggal'));
    }
}

}
