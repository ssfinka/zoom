<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoomFieldsToPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('link_zoom')->nullable();
            $table->string('id_meeting')->nullable();
            $table->string('password')->nullable();
            $table->string('catatan_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('link_zoom');
            $table->dropColumn('id_meeting');
            $table->dropColumn('password');
            $table->dropColumn('catatan_admin');
        });
    }
}
