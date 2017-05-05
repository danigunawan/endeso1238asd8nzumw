<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIdRumahId extends Migration
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
             $table->renameColumn('id', 'id_rumah');
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
            $table->renameColumn('id_rumah', 'id');
        });
    }
}
