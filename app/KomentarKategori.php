<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KomentarKategori extends Model
{
    //
    protected $table = 'komentar_kategori';
    protected $fillable = ['id','id_kategori','id_user','isi_komentar','status','jumlah_bintang'];


    public function kategori()
	  {
	  	return $this->belongsTo('App\Kategori','id_kategori');
	  }

    public function user()
	  {
	  	return $this->belongsTo('App\User','id_user');
	  }
	  	  public function scopeHitungRating($query_sum_hitung_rating,$id)
	  {
	  	$query_sum_hitung_rating->select(DB::raw('(SUM(jumlah_bintang) * 5) / (count(*) * 5) AS total_rating'))
        ->where('id_kategori',$id);

        return $query_sum_hitung_rating;
	  }
}
