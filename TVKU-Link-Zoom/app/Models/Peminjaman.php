<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'judul_meeting',
        'waktu_peminjaman',
        'tujuan_penggunaan',
        'permintaan_tambahan',
        'user_id',
        'status',
        'link_zoom',
        'id_meeting',
        'password',
        'catatan_admin',
        'nama_peminjam',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
