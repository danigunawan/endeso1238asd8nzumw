<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    //
    protected $table = 'rekening';
    protected $fillable = ['nama_bank','nama_rekening_tabungan','nomor_rekening_tabungan'];
}
