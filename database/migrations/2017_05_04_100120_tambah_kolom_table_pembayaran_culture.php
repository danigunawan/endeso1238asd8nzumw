<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomTablePembayaranCulture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembayaran_culture', function (Blueprint $table) {
            //
           $table->string('nama_bank_tujuan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran_culture', function (Blueprint $table) {
            //
            $table->dropColumn('nama_bank_tujuan');
        });
    }
}
