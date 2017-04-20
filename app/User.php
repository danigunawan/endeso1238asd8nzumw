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
        'name', 'email', 'password','alamat','tanggal_lahir','no_telp','jenis_kelamin','kewarga_negaraan','foto_profil'
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

    public function generateVerificationToken()
    {
    $token = $this->verification_token;
    if (!$token) {
    $token = str_random(40);
    $this->verification_token = $token;
    $this->save();
    }
    return $token;
    }

    public function sendVerification()
    {
        
    $token = $this->generateVerificationToken();
    $user = $this;
  
    Mail::send('auth.emails.verification', compact('user', 'token'), function($m)use($user) {
    $m->to($user->email, $user->name)->subject('Verifikasi Akun Endeso');

    });

    }

    public function verify()
    {
    $this->is_verified = 1;
    $this->verification_token = null;
    $this->save();
    }
 
    public function sendAkun($password_random)
    {
        
    $token = $this->generateVerificationToken();
    $user = $this;
  
    Mail::send('auth.emails.verification', compact('user', 'token','password_random'), function($m)use($user) {
    $m->to($user->email, $user->name)->subject('Verifikasi Akun Endeso');

    });

    }


}
