<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    //
    protected $primaryKey = 'id_rumah';
    protected $table = 'rumah';
    protected $fillable = ['nama_pemilik','no_telp','alamat','id_destinasi'];

 		public function destinasi()
	  {
	  return $this->hasOne('App\Destinasi','id','id_destinasi');
	  }


	  
    
}
