<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;

class RouteController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    if ($user->role == 'user') {
        // Jika pengguna adalah "user," arahkan ke tampilan dashboard pengguna
        return view('dashboard.index-user', compact('user'));
    } else {
        // Jika pengguna adalah "admin" atau "master_admin," arahkan ke tampilan dashboard admin
        $totalBuku = Buku::count();
        $totalKategoriBuku = KategoriBuku::count();
        $totalPeminjaman = Peminjaman::count();

        return view('dashboard.index-admin', compact('totalBuku', 'totalKategoriBuku', 'totalPeminjaman'));
    }
}

}
