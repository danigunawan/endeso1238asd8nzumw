<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahColomJumlahBintangDitablekomentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komentar_kamar', function (Blueprint $table) {
            $table->integer('jumlah_bintang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('komentar_kamar', function (Blueprint $table) {
            //
            $table->dropColumn('jumlah_bintang');
        });
    }
}
