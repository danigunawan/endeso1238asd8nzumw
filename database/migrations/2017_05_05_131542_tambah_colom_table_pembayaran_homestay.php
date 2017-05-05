<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahColomTablePembayaranHomestay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembayaran_homestay', function (Blueprint $table) {
            // tambah colom atas_nama_rekening_pelanggan
           $table->string('atas_nama_rekening_pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('pembayaran_homestay', function (Blueprint $table) {
            //
            $table->dropColumn('atas_nama_rekening_pelanggan');
        });
    }
}
