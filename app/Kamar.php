<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    //
		protected $primaryKey = 'id_kamar';
        protected $table = 'kamar';
    	protected $fillable = ['id_rumah','id_destinasi','foto1','foto2','foto3','foto4','foto5','deskripsi','deskripsi_2','kapasitas','latitude','longitude','judul_peta','harga_endeso','harga_pemilik','harga_makan','info_makanan','tipe_harga','tampil_home'];

    	 public function destinasi()
	  {
	  return $this->hasOne('App\Destinasi','id','id_destinasi');
	  }
	   public function rumah()
	  {
	  return $this->hasOne('App\Rumah','id_rumah','id_rumah');
	  }

	  
}
