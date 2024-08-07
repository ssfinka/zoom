<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $table = 'links';

    protected $fillable = [
        'link_zoom',
        'meeting_id',
        'nama_peminjam',
        'password_code',
        'waktu_peminjaman',
        'status_peminjaman'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Validasi sebelum menyimpan data baru atau mengupdate data
            if ($model->status_peminjaman == 'Sedang dipinjam') {
                if (empty($model->nama_peminjam) || empty($model->waktu_peminjaman)) {
                    throw new \Exception('Nama peminjam dan waktu peminjaman harus diisi jika status peminjaman adalah Sedang dipinjam.');
                }
            }
        });

        static::updating(function ($model) {
            // Validasi sebelum mengupdate data yang sudah ada
            if ($model->status_peminjaman == 'Sedang dipinjam') {
                if (empty($model->nama_peminjam) || empty($model->waktu_peminjaman)) {
                    throw new \Exception('Nama peminjam dan waktu peminjaman harus diisi jika status peminjaman adalah Sedang dipinjam.');
                }
            }
        });
    }
}
