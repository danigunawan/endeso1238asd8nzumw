<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('warga', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori_culture'); 
            $table->string('nama_warga'); 
            $table->string('foto_profil')->nullable();
            $table->string('jadwal_1'); 
            $table->string('jadwal_2')->nullable();
            $table->string('jadwal_3')->nullable();
            $table->string('jadwal_4')->nullable();
            $table->string('jadwal_5')->nullable();
            $table->string('harga_endeso'); 
            $table->string('harga_pemilik'); 
            $table->integer('kapasitas');  
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
        //
        Schema::dropIfExists('warga');
    }
}
