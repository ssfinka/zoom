<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->timestamp('waktu_zoom');
            $table->string('nama_acara');
            $table->text('permintaan_tambahan')->nullable();
            $table->string('status_penilaian')->default('Menunggu Persetujuan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjamans');
    }
}
