<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    //
    protected $table = 'rumah';
    protected $fillable = ['nama_pemilik','no_telp','alamat'];

    
}
