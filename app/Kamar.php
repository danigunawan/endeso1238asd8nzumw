<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    //

        protected $table = 'kamar';
    	protected $fillable = ['id_rumah','id_destinasi','foto1','foto2','foto3','foto4','foto5','deskripsi','kapasitas','latitude','longitude','judul_peta','harga_endeso','harga_pemilik'];

    	 public function destinasi()
	  {
	  return $this->belongsTo('App\Destinasi','id_destinasi');
	  }
	   public function rumah()
	  {
	  return $this->belongsTo('App\Rumah','id_rumah');
	  }
}
