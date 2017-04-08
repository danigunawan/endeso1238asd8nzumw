<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','alamat','tanggal_lahir','no_telp','jenis_kelamin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
    'is_verified' => 'boolean',
    ];

    public function sendVerification()
    {
    $user = $this;
    $token = str_random(40);

    $user->verification_token = $token;

    $user->save();

    Mail::send('auth.emails.verification', compact('user', 'token'), function($m)use($user) {
    $m->to($user->email, $user->name)->subject('Verifikasi Akun Endeso');

    });

    }
}
