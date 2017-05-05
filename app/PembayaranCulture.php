<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranCulture extends Model
{
    //
    protected $table = 'pembayaran_culture';
    protected $fillable = ['id','id_user','id_pesanan','nama_bank_tujuan','nama_bank_pelanggan','nomor_rekening_pelanggan','foto_tanda_bukti','status'];

    	public function pemesanan_cultural()
	  {
	  return $this->belongsTo('App\PesananCulture','id_pesanan');
	  }
	  
	  public function rekening_bank_pelanggan()
	  {
	  return $this->belongsTo('App\Rekening','nama_bank_pelanggan');
	  }

	  public function rekening_bank_tujuan()
	  {
	  return $this->belongsTo('App\Rekening','nama_bank_tujuan');
	  }
}