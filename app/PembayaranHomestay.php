<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranHomestay extends Model
{
    //
        protected $table = 'pembayaran_homestay';
    protected $fillable = ['id_user','id_pesanan','id_rekening_endeso','nama_bank_pelanggan','nomor_rekening_pelanggan','foto_tanda_bukti','status'];
}
