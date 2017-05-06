<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomIdDestinasiTableRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rumah', function (Blueprint $table) {
            //
           $table->integer('id_destinasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rumah', function (Blueprint $table) {
            //
           $table->dropColumn('id_destinasi');
        });
    }
}
