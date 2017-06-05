<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingFotoHome extends Model
{
    //
    protected $table = 'setting_foto_home';
    protected $fillable = ['id','foto_1','foto_2'];
}
