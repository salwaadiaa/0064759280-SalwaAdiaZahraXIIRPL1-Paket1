<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBukuRelasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_buku_relasis';
    protected $primaryKey = 'kategoribuku_id';
    protected $fillable = [
        'kategori_id',
        'buku_id',
    ];

    // Relasi ke tabel kategori_buku
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke tabel bukus
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'buku_id');
    }
}
