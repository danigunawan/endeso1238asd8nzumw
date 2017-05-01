<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_homestay', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_pesanan');
            $table->string('nama_bank_pelanggan');
            $table->string('nomor_rekening_pelanggan');
            $table->string('foto_tanda_bukti')->nullable();
            $table->integer('status_pembayaran')->nullable();
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
        Schema::dropIfExists('pembayaran_homestay');
    }
}
