<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_homestays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kamar');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('status_pesanan');
            $table->integer('id_user');
            $table->integer('total_harga');
            $table->integer('harga_endeso'); 
            $table->integer('harga_pemilik'); 
            $table->string('jumlah_malam');
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
        Schema::dropIfExists('pesanan_homestays');
    }
}
