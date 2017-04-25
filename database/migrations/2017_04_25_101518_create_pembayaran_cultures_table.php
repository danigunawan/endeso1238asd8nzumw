<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranCulturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_culture', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pesanan');
            $table->integer('id_rekening_endeso');
            $table->string('nama_bank_pelanggan');
            $table->integer('nomor_rekening_pelanggan');
            $table->string('foto_tanda_bukti')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('pembayaran_culture');
    }
}
