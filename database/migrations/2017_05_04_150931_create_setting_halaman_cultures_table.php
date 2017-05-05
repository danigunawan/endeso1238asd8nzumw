<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingHalamanCulturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_halaman_cultures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_1')->nullable();            
            $table->integer('kategori_1'); 

            $table->string('foto_2')->nullable();            
            $table->integer('kategori_2'); 

            $table->string('foto_3')->nullable();            
            $table->integer('kategori_3'); 

            $table->string('foto_4')->nullable();            
            $table->integer('kategori_4'); 
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
        Schema::dropIfExists('setting_halaman_cultures');
    }
}
