<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingHalaman;
use App\User;
use Auth;
use App\Kamar;
use App\Rumah;
use App\Kategori;
use App\KomentarKamar;
use App\KomentarKategori;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homestay = Kamar::with('rumah')->limit(8)->inRandomOrder()->get(); 
        //Mereturn (menampilkan) halaman yang ada difolder cultural -> list. (Passing $lis_cultural ke view atau tampilan cultural.list)
        return view('welcome', ['homestay' => $homestay]);
 
    }

      public function tentang()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',1)->first();

        return view('tentang',['setting_halaman' => $setting_halaman]);
    }

     public function cara_pesan()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',2)->first();

        return view('cara_pesan',['setting_halaman' => $setting_halaman]);
    }

      public function kontak()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',3)->first();

        return view('kontak',['setting_halaman' => $setting_halaman]);
    }


       public function edit_profil()
    {   

        $id_user = Auth::user()->id;
        $profil = User::where('id',$id_user)->first();

        $status_foto_profil = strpos($profil->foto_profil, 'http');

        return view('profil',['profil' => $profil,'status_foto_profil' => $status_foto_profil]);
    }

       public function update_profil(Request $request, $id)
    {   
         $this->validate($request, [
        'name' => 'required', 
        'email' => 'required|unique:users,email,'.$id, 
         'foto_profil' => 'image|max:2048'
        ]);
     
        $profil = User::where('id',$id)->first();

        $profil->update(['name' => $request->name,'email' => $request->email,'tanggal_lahir' => $request->tanggal_lahir,'alamat' => $request->alamat,'jenis_kelamin' => $request->jenis_kelamin,'no_telp' => $request->no_telp]);


         // isi field foto_profil jika ada foto_profil yang diupload
        if ($request->hasFile('foto_profil')) {
        // Mengambil file yang diupload
        $uploaded_foto_profil = $request->file('foto_profil');
        // mengambil extension file
        $extension = $uploaded_foto_profil->getClientOriginalExtension();
        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;
        // menyimpan foto_profil ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_foto_profil->move($destinationPath, $filename);
        // mengisi field foto_profil di destinasi dengan filename yang baru dibuat
        $profil->foto_profil = $filename;
        $profil->save();

        }

          Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan Perubahan Profil"
        ]);

        return redirect()->route('profil.edit');
    }
      
      public function pesanan()  
    {
        return view('pesanan');
    }

       public function detail_penginapan($id,$tanggal_checkin,$tanggal_checkout)  
    {
        $kamar = Kamar::with(['rumah'])->find($id);
        $kamar_lain = Kamar::with(['rumah','destinasi'])->where('id_destinasi',$kamar->id_destinasi)->limit(3)->get();

        $komentar = KomentarKamar::with('user')->where('id_destinasi',$id)->limit(5)->get();
        return view('penginapan.detail',['kamar' => $kamar,'kamar_lain'=>$kamar_lain,'komentar'=>$komentar,'tanggal_checkin'=>$tanggal_checkin,'tanggal_checkout'=>$tanggal_checkout]);

    }

    public function detail_cultural($id){

        $detail_cultural = Kategori::find($id);

        $komentar_kategori = KomentarKategori::with('user')->where('id', $id)->limit(5)->get();

        //Mereturn (menampilkan) halaman yang ada difolder cultural -> detail. (Passing $detail_cultural ke view atau tampilan cultural.detail)
        return view('cultural.detail', ['detail_cultural' => $detail_cultural, 'komentar_kategori' => $komentar_kategori]);
    }


   
}
