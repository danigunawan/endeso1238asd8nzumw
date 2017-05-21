@if (isset($password_random) )
<p>Hallo Nama {{$user->name}},</p>
<p>ini akun endeso.id anda</p>
<p>Email : {{ $user->email }}</p>
<p>Password : {{ $password_random }}</p> 
@endif
klik link berikut ini untuk melakukan aktivasi akun Endeso anda
<a href="{{ $link = url('auth/verify', $token).'?email='.urlencode($user->email) }}"> {{ $link }} </a>