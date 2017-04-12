<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarKamar extends Model
{
    //
    protected $table = 'komentar_kamar';
    protected $fillable = ['id','id_kamar','id_user','isi_komentar','status'];


    public function kamar()
	  {
	  	return $this->belongsTo('App\Kamar','id_kamar');
	  }

    public function rumah()
	  {
	  	return $this->belongsTo('App\Rumah','id_kamar');
	  }

    public function user()
	  {
	  	return $this->belongsTo('App\User','id_user');
	  }
}
