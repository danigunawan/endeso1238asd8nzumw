<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarKategori extends Model
{
    //
    protected $table = 'komentar_kategori';
    protected $fillable = ['id','id_kategori','id_user','isi_komentar','status'];


    public function kategori()
	  {
	  	return $this->belongsTo('App\Kategori','id_kategori');
	  }

    public function user()
	  {
	  	return $this->belongsTo('App\User','id_user');
	  }
}
