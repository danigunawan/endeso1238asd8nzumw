<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananCulture extends Model
{
    //
    protected $fillable = ['id_warga','jadwal','status_pesanan','check_in','id_user','total_harga','harga_endeso','harga_pemilik','jumlah_orang','nama','no_telp','no_ktp','email'];
}
