<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    //
    protected $table = 'warga';
    protected $fillable = ['id_kategori_culture','nama_warga','foto_profil','jadwal_1','jadwal_2','jadwal_3','jadwal_4','jadwal_5','durasi','harga_endeso','harga_pemilik','latitude','longitude','alamat_warga','kapasitas'];


    public function kategori()
	  {
	  return $this->belongsTo('App\Kategori','id_kategori_culture');
	  }
}
