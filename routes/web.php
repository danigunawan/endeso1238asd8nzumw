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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/list-penginapan', function () {
    return view('penginapan.list');
});


Route::get('/detail-penginapan', function () {
    return view('penginapan.detail');
});


Route::get('/list-cultural', function () {
    return view('cultural.list');
});


Route::get('/detail-cultural', function () {
    return view('cultural.detail');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('/tentang-endeso','HomeController@tentang');

Route::get('/cara-pesan','HomeController@cara_pesan');

Route::get('/kontak','HomeController@kontak');

Route::get('/user/edit-profil', [
	'middleware' => ['auth'],
	'as'=> 'profil.edit',
	'uses' => 'HomeController@edit_profil'
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
});

// untuk verifikasi akun
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');