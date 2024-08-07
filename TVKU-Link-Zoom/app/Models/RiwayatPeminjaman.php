<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'riwayat_peminjaman';

    protected $fillable = [
        'user_id',
        'judul_meeting',
        'waktu_peminjaman',
        'tujuan_penggunaan',
        'permintaan_tambahan',
        'status',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
