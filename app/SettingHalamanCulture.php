<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingHalamanCulture extends Model
{
	protected $fillable = ['id','foto_1','kategori_1', 'foto_2','kategori_2', 'foto_3','kategori_3', 'foto_4','kategori_4'];
}
