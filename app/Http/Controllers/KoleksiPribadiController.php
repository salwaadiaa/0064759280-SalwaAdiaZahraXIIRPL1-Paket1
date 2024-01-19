<?php

namespace App\Http\Controllers;

use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;
use App\Models\Buku;
use Illuminate\Http\Request;

class KoleksiPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Ambil buku yang sudah diulas
    $bukusDiUlas = Buku::has('ulasans')->get();

    // Ambil data lain yang diperlukan untuk tampilan (sesuaikan jika diperlukan)
    $koleksiPribadi = KoleksiPribadi::all();

    // Kirim data ke tampilan
    return view('dashboard.koleksipribadi.index', compact('koleksiPribadi', 'bukusDiUlas'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KoleksiPribadi  $koleksiPribadi
     * @return \Illuminate\Http\Response
     */
    public function show(KoleksiPribadi $koleksiPribadi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KoleksiPribadi  $koleksiPribadi
     * @return \Illuminate\Http\Response
     */
    public function edit(KoleksiPribadi $koleksiPribadi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KoleksiPribadi  $koleksiPribadi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KoleksiPribadi $koleksiPribadi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KoleksiPribadi  $koleksiPribadi
     * @return \Illuminate\Http\Response
     */
    public function hapus($koleksi_id)
    {
        // Hapus item dari koleksi pribadi
        $koleksiPribadi = KoleksiPribadi::where('koleksi_id', $koleksi_id)->delete();
    
        // Redirect atau tampilkan pesan sukses
        return redirect()->route('koleksipribadi.index')->with('success', 'Item dihapus dari koleksi pribadi.');
    }
    
}
