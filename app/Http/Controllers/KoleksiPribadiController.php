<?php

namespace App\Http\Controllers;

use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiPribadiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $koleksiPribadi = KoleksiPribadi::where('user_id', $user->user_id)->with('buku')->get();
        } else {
            $koleksiPribadi = null; 
        }

        return view('dashboard.koleksipribadi.index', compact('koleksiPribadi'));
    }

    public function destroy($koleksi_id)
    {
        $koleksiPribadi = KoleksiPribadi::findOrFail($koleksi_id); 
        $koleksiPribadi->delete();

        return redirect()->route('koleksipribadi.index')->with('success', 'Koleksi Anda berhasil dihapus.');
    }
 
}