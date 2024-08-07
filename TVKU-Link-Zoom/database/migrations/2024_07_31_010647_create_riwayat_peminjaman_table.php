<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPeminjamanTable extends Migration
{
    public function up()
    {
        Schema::create('riwayat_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_meeting');
            $table->timestamp('waktu_peminjaman');
            $table->string('tujuan_penggunaan');
            $table->text('permintaan_tambahan')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_peminjaman');
    }
}
