<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananCulture extends Model
{
    //
    protected $fillable = ['id_warga','jadwal','status_pesanan','check_in','id_user','total_harga','harga_endeso','harga_pemilik','jumlah_orang','nama','no_telp','no_ktp','email'];

    public function scopeStatus($query,$id_warga,$jadwal,$tanggal_masuk){
    	$query->where('id_warga',$id_warga)->where('jadwal',$jadwal)->where('check_in',$tanggal_masuk)->sum('jumlah_orang');
        return $query;
    }
}
