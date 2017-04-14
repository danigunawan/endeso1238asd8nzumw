<?php
namespace App\Http\Controllers; 

use Socialite;
use Auth; 
use App\User; 
use App\Role;
use Illuminate\Support\Facades\Session;

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

        $data = [
        'id' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'foto_profil' => $user->getAvatar(),
        'password' => bcrypt('rahasia'),
        ]; 

        $createuser =  User::firstOrCreate($data);
        $memberRole = Role::where('name', 'member')->first();
        $createuser->attachRole($memberRole);
		Auth::login($createuser);
        return redirect()->to('home'); 
        		 
        } 
    }
}