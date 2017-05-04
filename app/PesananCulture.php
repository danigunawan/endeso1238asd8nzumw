<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Warga;
use App\Kategori;

class PesananCulture extends Model
{
    //
    protected $fillable = ['id_warga','jadwal','status_pesanan','check_in','id_user','total_harga','harga_endeso','harga_pemilik','jumlah_orang','nama','no_telp','no_ktp','email'];

    public function scopeStatus($query,$id_warga,$jadwal,$tanggal_masuk){
    	$query->where('id_warga',$id_warga)->where('jadwal',$jadwal)->where('check_in',$tanggal_masuk)->sum('jumlah_orang');
        return $query;
    }

    public function warga()
	  {
	  	return $this->belongsTo('App\Warga','id_warga');
	  }

    public function user()
	  {
	  	return $this->belongsTo('App\User','id_user');
	  }

    public static function sendInvoice($total_harga_endeso,$id_pesanan,$rekening_tujuan){
            
        $user = Auth::user();
        
        Mail::send('emails_cultural.invoice', compact('user','total_harga_endeso','id_pesanan','rekening_tujuan'), function($m)use($user) {
        $m->to($user->email, $user->name)->subject('Invoice Cultural Experience Endeso');

    });

    }

    public function sendCheckout($pesanan_cultural)
    {
         
    $user = Auth::user()->find($pesanan_cultural->id_user);
    $warga = Warga::find($pesanan_cultural->id_warga)->first();
    $kategori = Kategori::find($warga->id_kategori_culture)->first();
  
    Mail::send('pemesanan.checkout_cultural', compact('user','pesanan_cultural','kategori'), function($m)use($user) {
    $m->to($user->email, $user->name)->subject('Thank You & Review (Endeso)');

    });

    }
}
