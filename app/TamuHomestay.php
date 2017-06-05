<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TamuHomestay extends Model
{
    //
    protected $table = 'tamu_homestays';
    protected $fillable = ['id_pesanan','nama_tamu'];
}
