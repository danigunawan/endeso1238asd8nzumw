<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class KomentarKamar extends Model
{
    //
    protected $table = 'komentar_kamar';
    protected $fillable = ['id','id_kamar','id_user','isi_komentar','status','jumlah_bintang'];


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

	  public function scopeHitungRating($query_sum_hitung_rating,$id)
	  {
	  	$query_sum_hitung_rating->select(DB::raw('(SUM(jumlah_bintang) * 5) / (count(*) * 5) AS total_rating'))
        ->where('id_kamar',$id);

        return $query_sum_hitung_rating;
	  }
}
