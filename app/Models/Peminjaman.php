<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';
    protected $primaryKey = 'peminjaman_id';
    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status_peminjaman',
        'denda',
    ];

    public function calculateDenda()
    {
        $expectedReturnDate = Carbon::parse($this->tanggal_pengembalian);
        $actualReturnDate = Carbon::now();

        // Calculate the difference in days
        $daysLate = $actualReturnDate->diffInDays($expectedReturnDate, false);

        // Calculate late fee (for example, $10 per day)
        $lateFee = max(0, $daysLate) * 10000;

        $this->denda = $lateFee;
        $this->save();

        return $this->denda;
    }

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke tabel bukus
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'buku_id');
    }

    public function ulasan()
    {
        return $this->hasOne(UlasanBuku::class, 'peminjaman_id');
    }
}
