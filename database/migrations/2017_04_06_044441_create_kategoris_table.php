<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_aktivitas');
            $table->string('foto_kategori')->nullable();
            $table->string('foto_kategori2')->nullable();
            $table->string('foto_kategori3')->nullable();
            $table->string('foto_kategori4')->nullable();
            $table->string('foto_kategori5')->nullable();
            $table->integer('destinasi_kategori'); 
            $table->text('deskripsi_kategori')->nullable();            
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
        Schema::dropIfExists('kategori');
    }
}
