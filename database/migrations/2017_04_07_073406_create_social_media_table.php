<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('social_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_facebook'); 
            $table->string('link_facebook'); 
            $table->string('nama_twitter'); 
            $table->string('link_twitter'); 
            $table->string('nama_instagram'); 
            $table->string('link_instagram'); 
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
        Schema::dropIfExists('social_media');
    }
}
