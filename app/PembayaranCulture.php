<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranCulture extends Model
{
    //
       protected $fillable = ['id_pesanan','id_rekening_endeso','nama_bank_pelanggan','nomor_rekening_pelanggan','foto_tanda_bukti','status'];
}
