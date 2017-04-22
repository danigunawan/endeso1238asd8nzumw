<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');


Route::get('auth/login', function () {
    return view('auth');
});
 
Route::get('auth/google', 'AuthController@redirectToGoogle');
Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');

Route::get('/list-penginapan', function () {
    return view('penginapan.list');
});




Route::get('/detail-penginapan/{id}/{tanggal_checkin}/{tanggal_checkout}/{jumlah_orang}', [
	'as'=> 'penginapan.detail',
	'uses' => 'HomeController@detail_penginapan'
]);

//Routing Menggunakan Model
Route::get('/list-cultural', 'KategoriController@list_cultural');


Route::get('/detail-cultural/{id}/{tanggal_masuk}/{jumlah_orang}', [
	'as'=> 'cultural.detail',
	'uses' => 'HomeController@detail_cultural'
]);

Auth::routes();

Route::get('/home', 'HomeController@index');
 
Route::get('/tentang-endeso','HomeController@tentang');

Route::get('/cara-pesan','HomeController@cara_pesan');

Route::get('/kontak','HomeController@kontak');

Route::get('/pencarian','HomeController@pencarian_ce_homestay');

Route::post('/ajax-jadwal-kegiatan', 'PesananCulturalController@ajax_jadwal_kegiatan');

Route::get('/user/edit-profil', [
	'middleware' => ['auth'],
	'as'=> 'profil.edit',
	'uses' => 'HomeController@edit_profil'
]);

Route::get('/detail-pesanan-homestay/{id}', [
	'middleware' => ['auth'],
	'as'=> 'detail_pesanan.homestay',
	'uses' => 'HomeController@detail_pesanan_homestay'
]);

Route::get('/detail-pesanan-culture/{id}/{destinasi}/{aktivitas}', [
	'middleware' => ['auth'],
	'as'=> 'detail_pesanan.culture',
	'uses' => 'HomeController@detail_pesanan_culture'
]);

Route::get('/PembayaranCulture/{id}', [
	'middleware' => ['auth'],
	'as'=> 'pembayaran_culture.culture',
	'uses' => 'HomeController@pembayaran_culture'
]);

Route::get('/PembayaranHomestay/{id}', [
	'middleware' => ['auth'],
	'as'=> 'pembayaran_homestay.homestay',
	'uses' => 'HomeController@pembayaran_homestay'
]);

Route::put('/user/edit-profil/{id}', [
	'middleware' => ['auth'],
	'as'=> 'profil.update',
	'uses' => 'HomeController@update_profil'
]);

Route::get('/user/pesanan', [
	'middleware' => ['auth'],
	'as'=> 'pesanan',
	'uses' => 'HomeController@pesanan'
]);


Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {

	Route::resource('destinasi', 'DestinasiController');
	Route::resource('rekening', 'RekeningController');
	Route::resource('kategori', 'KategoriController');
	Route::resource('setting-halaman', 'SettingHalamanController');
	Route::resource('user_admin', 'UserController');
	Route::resource('user_member', 'User_memberController');
	Route::resource('social_media', 'SocialMediaController');
	Route::resource('rumah','RumahController');
	Route::resource('warga','WargaController');
	Route::resource('kamar','KamarController');
	Route::resource('komentar_kamar','KomentarKamarController');
	Route::resource('komentar_kategori','KomentarKategoriController');

	Route::get('komentar_kategori/no_konfirmasi/{id}',[
	'middleware' => ['auth'],
	'as' => 'komentar_kategori.no_konfirmasi',
	'uses' => 'KomentarKategoriController@no_konfirmasi'
	]);

	Route::get('komentar_kategori/konfirmasi/{id}',[
	'middleware' => ['auth'],
	'as' => 'komentar_kategori.konfirmasi',
	'uses' => 'KomentarKategoriController@konfirmasi'
	]);

	Route::get('komentar_kamar/no_konfirmasi/{id}',[
	'middleware' => ['auth'],
	'as' => 'komentar_kamar.no_konfirmasi',
	'uses' => 'KomentarKamarController@no_konfirmasi'
	]);

	Route::get('komentar_kamar/konfirmasi/{id}',[
	'middleware' => ['auth'],
	'as' => 'komentar_kamar.konfirmasi',
	'uses' => 'KomentarKamarController@konfirmasi'
	]);
});


Route::get('/pesan-homestay/{id}/{tanggal_checkin}/{tanggal_checkout}/{jumlah_orang}', [
	'as'=> 'pesanhomestay.form',
	'uses' => 'PesanhomestayController@index'
]);

Route::get('/pesan-homestay-proses', [
	'middleware' => ['auth'],
	'as'=> 'pesanhomestay.proses',
	'uses' => 'PesanhomestayController@store'
]);

//
Route::get('/pesan-cultural/{id}/{tanggal_masuk}/{jumlah_orang}', [
	'as'=> 'pesananCultural.form',
	'uses' => 'PesananCulturalController@index'
]);

// untuk verifikasi akun
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

// kirim ulang verifikasi akun
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');


