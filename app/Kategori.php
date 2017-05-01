<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'kategori';
    protected $fillable = ['nama_aktivitas', 'foto_kategori', 'destinasi_kategori', 'deskripsi_kategori'];

    public function destinasi()
	  {
	  return $this->belongsTo('App\Destinasi','destinasi_kategori');
	  }

	  public function warga()
	  {
	  	return $this->hasMany('App\Warga','id');
	  }
}
