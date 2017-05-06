<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TamuCulture extends Model
{
    protected $table = 'tamu_culture';
    protected $fillable = ['id_pesanan','nama_tamu'];
}
