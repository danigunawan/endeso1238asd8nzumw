<?php
namespace App\Http\Controllers; 

use Socialite;
use Auth; 
use App\User; 
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
   
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {  

        $user = Socialite::driver('google')->user();
        $cekuser =  User::where('email',$user->getEmail())->count();

        if ($cekuser >0 ) {
        	# code...
        $createuser =  User::where('email',$user->getEmail())->first();
		Auth::login($createuser);
        return redirect()->to('home');

        } 
        else  {
        $password_random =  str_random(10); 

        $data = [
        'id' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'foto_profil' => $user->getAvatar(),
        'password' =>   bcrypt($password_random),
        ]; 

        $createuser =  User::firstOrCreate($data);
        $memberRole = Role::where('name', 'member')->first();
        $createuser->attachRole($memberRole); 
		Auth::login($createuser);
     
        $email = $user->getEmail(); 
            User::sendInvoice($user,$email,$password_random);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Cek Email Untuk Verifikasi Akun"
        ]);  
        return redirect()->to('/user/edit-profil'); 
        		 
        } 
    }
}