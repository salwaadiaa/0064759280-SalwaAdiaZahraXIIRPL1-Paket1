<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $primaryKey = 'buku_id'; 
    public $incrementing = false;

    protected $fillable = [
        'buku_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'gambar',
        'stok',
        'sinopsis',
    ];

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }

    public function kategoribukuRelasis()
    {
        return $this->hasMany(KategoriBukuRelasi::class, 'buku_id');
    }

    public function peminjams()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function peminjamans()
{
    return $this->hasMany(Peminjaman::class, 'buku_id');
}


    public function hasUlasan()
    {
        return $this->ulasan_bukus()->exists();
    }
     public function ulasans()
    {
        return $this->hasMany(UlasanBuku::class, 'buku_id');
    }
}
