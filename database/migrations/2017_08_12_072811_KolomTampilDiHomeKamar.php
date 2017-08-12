<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KolomTampilDiHomeKamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('kamar', function (Blueprint $table) {
      
        $table->integer('tampil_home')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //


         Schema::table('kamar', function (Blueprint $table) {
            //
            $table->dropColumn('tampil_home');
        });
    }
}
