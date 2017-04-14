<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananCulturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_cultures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_warga');
            $table->string('jadwal');
            $table->integer('status_pesanan');
            $table->date('check_in');
            $table->integer('id_user');
            $table->integer('total_harga');
            $table->integer('harga_endeso');
            $table->integer('harga_pemilik');
            $table->integer('jumlah_orang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_cultures');
    }
}
