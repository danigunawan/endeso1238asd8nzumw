<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranHomestay extends Model
{
    //
        protected $table = 'pembayaran_homestay';
    protected $fillable = ['id_user','id_pesanan','nama_bank_pelanggan','nama_bank_tujuan','nomor_rekening_pelanggan','foto_tanda_bukti','status_pembayaran'];


    	public function pemesanan_homestay()
	  {
	  return $this->belongsTo('App\PesananHomestay','id_pesanan');
	  }

}
