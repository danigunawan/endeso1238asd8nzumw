<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    //
    protected $table = 'social_media';
    protected $fillable = ['id','nama_facebook','link_facebook','nama_twitter','link_twitter','nama_instagram','link_instagram'];
}
