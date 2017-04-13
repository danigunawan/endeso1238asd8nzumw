<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingHalaman;
use App\User;
use Auth;
use App\Kamar;
use App\KomentarKamar;
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
        return view('welcome');
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

        return view('profil',['profil' => $profil]);
    }

       public function update_profil(Request $request, $id)
    {   
         $this->validate($request, [
        'name' => 'required', 
        'email' => 'required|unique:users,email,'.$id,
        'tanggal_lahir' => 'date',
         'foto_profil' => 'image|max:2048'
        ]);




        $tanggal_lahir = date_create($request->tanggal_lahir);       
        $profil = User::where('id',$id)->first();

        $profil->update(['name' => $request->name,'email' => $request->email,'tanggal_lahir' => date_format($tanggal_lahir,'Y-m-d'),'alamat' => $request->alamat,'jenis_kelamin' => $request->jenis_kelamin,'no_telp' => $request->no_telp]);


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

       public function detail_penginapan($id)  
    {
        $kamar = Kamar::with(['rumah'])->find($id);
        $kamar_lain = Kamar::with(['rumah','destinasi'])->where('id_destinasi',$kamar->id_destinasi)->limit(3)->get();

        $komentar = KomentarKamar::with('user')->where('id_kamar',$id)->limit(5)->get();
        return view('penginapan.detail',['kamar' => $kamar,'kamar_lain'=>$kamar_lain,'komentar'=>$komentar]);

    }


   
}
