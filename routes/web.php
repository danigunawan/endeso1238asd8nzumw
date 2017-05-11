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
/* PEMBUKA AJAX PESANAN CULTURAL */
Route::post('/ajax-data-warga', 'PesananCulturalController@ajax_data_warga');

Route::post('/update-status-pesanan-cultural', 'PembayaranCulturalController@status_pesanan_cultural');
/* PENUTUP AJAX PESANAN CULTURAL */

/* PEMBUKA AJAX KATEGORI */
Route::post('/ajax-data-kategori', 'WargaController@ajax_data_kategori');
/* PENUTUP AJAX KATEGORI */

/* PEMBUKA AJAX PEMBAYARAN HOMESTAY */
Route::post('/update-status-pesanan', 'PembayaranController@status_pesanan');
/* PENUTUP AJAX PEMBAYARAN HOMESTAY */


/* PEMBUKA AJAX MASTER DATA KAMAR  */
Route::post('/ajax-data-kamar', 'KamarController@ajax_data_kamar');
/* penutup AJAX MASTER DATA KAMAR  */


Route::get('/', 'HomeController@index');
Route::get('/telegram', 'HomeController@telegram');

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

Route::get('/detail-pesanan-culture/{id}', [
	'middleware' => ['auth'],
	'as'=> 'detail_pesanan.culture',
	'uses' => 'HomeController@detail_pesanan_culture'
]);

Route::get('/pembayaran_culture/{id}', [
	'middleware' => ['auth'],
	'as'=> 'pembayaran_culture.culture',
	'uses' => 'PembayaranCulturalController@pembayaran_culture'
]);

Route::get('/transaksi_pembayaran_culture/{id}', [
	'middleware' => ['auth'],
	'as'=> 'transaksi_pembayaran_culture.form',
	'uses' => 'PembayaranCulturalController@transaksi_pembayaran_culture'
]);

Route::put('/proses_transaksi_pembayaran_culture', [
	'middleware' => ['auth'],
	'as'=> 'transaksi_pembayaran_culture.store',
	'uses' => 'PembayaranCulturalController@store'
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
	Route::resource('setting-halaman-culture', 'SettingHalamanCultureController');
	Route::resource('user_admin', 'UserController');
	Route::resource('user_member', 'User_memberController');
	Route::resource('social_media', 'SocialMediaController');
	Route::resource('rumah','RumahController');
	Route::resource('warga','WargaController');
	Route::resource('kamar','KamarController');
	Route::resource('komentar_kamar','KomentarKamarController');
	Route::resource('komentar_kategori','KomentarKategoriController');
	Route::resource('pemesanan','PemesananController');
	Route::resource('setting-foto-home', 'SettingFotoHomeController');

	Route::get('konfirmasi_pembayaran',[
	'middleware' => ['auth'],
	'as' => 'konfirmasi_pembayaran.index',
	'uses' => 'PembayaranController@konfirmasi'
	]);

	Route::get('konfirmasi_pembayaran/cultural',[
	'middleware' => ['auth'],
	'as' => 'konfirmasi_pembayaran.cultural',
	'uses' => 'PembayaranController@konfirmasi_pembayaran_cultural'
	]);
	
	Route::get('pemesanan/homestay',[
	'middleware' => ['auth'],
	'as' => 'pesanan.homestay',
	'uses' => 'PemesananController@homestay'
	] );

	// konfirmasi komentar homestay dan cultural
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
	// konfirmasi komentar homestay dan cultural

	//ubah status konfirmasi pembayaran
	Route::get('konfirmasi-pembayaran/homestay/terima/{id}',[
	'middleware' => ['auth'],
	'as' => 'konfirmasi_pembayaran.homestay_terima',
	'uses' => 'PembayaranController@homestay_terima'
	]);

	Route::get('konfirmasi-pembayaran/homestay/tolak/{id}',[
	'middleware' => ['auth'],
	'as' => 'konfirmasi_pembayaran.homestay_tolak',
	'uses' => 'PembayaranController@homestay_tolak'
	]);

	//filter konfirmasi 
	Route::get('status/pembayaran/homestay/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.status-homestay-pembayaran',
	'uses' => 'PembayaranController@status_pembayaran_homestay'
	]); 
	Route::get('status/pembayaran/cultural/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.status-cultural-pembayaran',
	'uses' => 'PembayaranController@status_pembayaran_cultural'
	]); 
	//filter konfirmasi 

 

//ubah status konfirmasi pembayaran cultural
	Route::get('konfirmasi-pembayaran/cultural/terima/{id}',[
	'middleware' => ['auth'],
	'as' => 'konfirmasi_pembayaran.cultural_terima',
	'uses' => 'PembayaranController@cultural_terima'
	]);

	Route::get('konfirmasi-pembayaran/cultural/tolak/{id}',[
	'middleware' => ['auth'],
	'as' => 'konfirmasi_pembayaran.cultural_tolak',
	'uses' => 'PembayaranController@cultural_tolak'
	]);
//ubah status konfirmasi pembayaran cultural

// STATUS PESANAN CULTURAL DAN HOMESTAY
	Route::get('status/pesanan/cultural/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.status-cultural-pesanan',
	'uses' => 'PemesananController@status_pesanan_cultural'
	]);  

	Route::get('status/pesanan/homestay/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.status-homestay-pesanan',
	'uses' => 'PemesananController@status_pesanan_homestay'
	]);  
// STATUS PESANAN CULTURAL DAN HOMESTAY

	// CHECK IN & CHECK OUT HOMESTAY
	Route::get('pemesanan/homestay/check_in/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.homestay_check_in',
	'uses' => 'PemesananController@homestay_check_in'
	]);

	Route::get('pemesanan/homestay/check_out/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.homestay_check_out',
	'uses' => 'PemesananController@homestay_check_out'
	]); 
	// CHECK IN & CHECK OUT HOMESTAY

	// CHECK IN & CHECK OUT CULTURAL
	Route::get('pemesanan/cultural/check_in/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.cultural_check_in',
	'uses' => 'PemesananController@cultural_check_in'
	]);

	Route::get('pemesanan/cultural/check_out/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.cultural_check_out',
	'uses' => 'PemesananController@cultural_check_out'
	]);
	// CHECK IN & CHECK OUT CULTURAL

	// Batal pesanan HOMESTAY CULTURAL
	Route::get('pemesanan/cultural/batal/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.cultural_batal',
	'uses' => 'PemesananController@cultural_batal'
	]);

	Route::get('pemesanan/homestay/batal/{id}',[
	'middleware' => ['auth'],
	'as' => 'pemesanan.homestay_batal',
	'uses' => 'PemesananController@homestay_batal'
	]);
	// Batal pesanan HOMESTAY CULTURAL

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

Route::get('/pesan-cultural-proses', [
	'middleware' => ['auth'],
	'as'=> 'pesancultural.proses',
	'uses' => 'PesananCulturalController@store'
]);

//
Route::get('/pesan-cultural/{id}/{tanggal_masuk}/{jumlah_orang}', [
	'as'=> 'pesananCultural.form',
	'uses' => 'PesananCulturalController@index'
]);

//
Route::get('/komentar_cultural', [
	'middleware' => ['auth'],
	'as'=> 'komentar_cultural.proses',
	'uses' => 'HomeController@komentar_cultural'
]);

//
Route::get('/komentar_penginapan', [
	'middleware' => ['auth'],
	'as'=> 'komentar_penginapan.proses',
	'uses' => 'HomeController@komentar_penginapan'
]);

Route::get('/pembayaran-homestay/{id}', [ 	
	'middleware' => ['auth'],
	'as'=> 'pembayaran.index',
	'uses' => 'PembayaranController@index'
]);

Route::get('/transaksi_pembayaran_homestay/{id}', [ 	
	'middleware' => ['auth'],
	'as'=> 'pembayaran.transaksi_pembayaran_homestay',
	'uses' => 'PembayaranController@transaksi_pembayaran_homestay'
]);

Route::post('/pembayaran-proses', [ 	
	'as'=> 'pembayaran.proses',
	'uses' => 'PembayaranController@store'
]);

// untuk verifikasi akun
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

// kirim ulang verifikasi akun
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');


