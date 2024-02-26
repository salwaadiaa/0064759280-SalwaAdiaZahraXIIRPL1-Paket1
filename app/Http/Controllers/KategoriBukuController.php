<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBuku;

class KategoriBukuController extends Controller
{
    public function indexAdmin()
    {
        $kategoris = KategoriBuku::orderBy('created_at', 'asc')->paginate(10);
        return view('dashboard.kategori.kategori_admin', compact('kategoris'));
    }

    public function indexUser()
    {
        $kategoris = KategoriBuku::all();
        return view('dashboard.kategori.kategori_user', compact('kategoris'));
    }
    public function create()
    {
        return view('dashboard.kategori.create_kategori');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriBuku::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.admin')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($ketegori_id)
    {
        $kategori = KategoriBuku::findOrFail($ketegori_id);
        return view('dashboard.kategori.edit_kategori', compact('kategori'));
    }

    public function update(Request $request, $ketegori_id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriBuku::findOrFail($ketegori_id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.admin')->with('success', 'Kategori ' .$kategori->nama_kategori. ' berhasil diperbarui.');
    }

    public function destroy($ketegori_id)
    {
        $kategori = KategoriBuku::findOrFail($ketegori_id);
        $kategori->delete();

        return redirect()->route('kategori.admin')->with('success', 'Kategori berhasil dihapus.');
    }
}
