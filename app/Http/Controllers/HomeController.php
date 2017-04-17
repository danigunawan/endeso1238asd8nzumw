<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use App\SettingHalaman;
use App\User;
use Auth;
use App\Kamar;
use App\Rumah;
use App\Kategori;
use App\KomentarKamar;
use Session;
use App\PesananHomestay;
use App\PesananCulture;
use Illuminate\Support\Facades\DB;
use App\Warga;

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

       public function detail_penginapan($id,$tanggal_checkin,$tanggal_checkout,$jumlah_orang)  
    {
        $kamar = Kamar::with(['rumah'])->find($id);
        $kamar_lain = Kamar::with(['rumah','destinasi'])->where('id_destinasi',$kamar->id_destinasi)->limit(3)->get();

        $komentar = KomentarKamar::with('user')->where('id_kamar',$id)->limit(5)->get();


        return view('penginapan.detail',['kamar' => $kamar,'kamar_lain'=>$kamar_lain,'komentar'=>$komentar,'tanggal_checkin'=>$tanggal_checkin,'tanggal_checkout'=>$tanggal_checkout,'jumlah_orang'=>$jumlah_orang]);
      }

    public static function tanggal_mysql($tanggal2){
    
    $date= date_create($tanggal2);
    $date_format = date_format($date,"Y-m-d");
    return $date_format;
    }


    public function pencarian_ce_homestay(Request $request)
    {   
DB::enableQueryLog();
        // JIKA PILIHAN DESTINASI NYA HOMESTAY
        if ($request->pilihan == 1) {

                  // validate
            $this->validate($request,[
                  'pilihan'       => 'required',
                  'dari_tanggal'  => 'required|date',
                  'sampai_tanggal'=> 'required|date',
                  'tujuan'        => 'required',
                  'jumlah_orang'  => 'required'
                  ]);
            
            $kamar = Kamar::with('rumah')->where('id_destinasi',$request->tujuan)->where(function ($query) use ($request){
                $query->where('kapasitas',$request->jumlah_orang)->orwhere('kapasitas','>',$request->jumlah_orang);
            })->get();

            $tampil_kamar = '';   
            $hitung = 0;

            foreach ($kamar as $kamars) {// foreach ($kamar as $kamars)

                $pesanan = PesananHomestay::status($kamars->id_kamar,$request->dari_tanggal,$request->sampai_tanggal)->count();

                    if ($pesanan == 0) {//  if ($pesanan == 0)

                        //harga kamar
                        $harga_kamar = $kamars->harga_endeso + $kamars->harga_pemilik;

                        // untuk menghirung berapa kamar yang tampil
                        $hitung = $hitung + 1;

                        $tampil_kamar .= "<div class='col-md-6 col-sm-12 col-xs-12 no-padding hotel-detail'>
                                            <div class='col-md-6 col-sm-6 col-xs-6 no-padding hotel-img-box'>
                                              <img src='img/".$kamars->foto1."' alt='Recommended' height='267' width='297' />

                                              <span><a href='".url('/detail-penginapan/'.$kamars->id_kamar.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.HomeController::tanggal_mysql($request->sampai_tanggal).'/'.$request->jumlah_orang)."'>Pesan</a></span>
                                            </div>
                                            <div class='col-md-6 col-sm-6 col-xs-6 hotel-detail-box'>
                                              <h4>".$kamars->rumah->nama_pemilik."</h4>
                                              <p>".$kamars->deskripsi ."</p>
                                              <h6><b><sup>RP</sup>".$harga_kamar."</b><span>/Orang/Malam</span></h6>
                                              <span>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star-half-o'></i>
                                              </span>
                                            </div>
                                          </div>";

                    }////  if ($pesanan == 0)
            } // foreach ($kamar as $kamars)
            
            // jika kamar tidak ada yang tampil maka akan muncul alert
            if ($hitung === 0) {// if ($hitung === 0)
               Session::flash("flash_notification", [
              "level"=>"success",
              "message"=>"Tujuan Homestay yang anda pilih sudah terisi atau jumlah orang melebihi kapasitas, silahkan pilih Tujuan Homestay yang lain"
              ]);
            }// if ($hitung === 0)

          return view('pencarian_homestay',['tampil_kamar'=>$tampil_kamar, 'hitung'=>$hitung]);

        }
        else        // JIKA PILIHAN DESTINASI NYA CULTUR EXPERIENCE
        {

             // validate
            $this->validate($request,[
                  'pilihan'       => 'required',
                  'dari_tanggal'  => 'required|date',
                  'tujuan'        => 'required',
                  'jumlah_orang'  => 'required'
                  ]);
            
            $kategori = Kategori::with('warga')->where('destinasi_kategori',$request->tujuan)->get();

            foreach ($kategori as $kategoris) {
            
              $pesanan = PesananCulture::where('check_in',$request->dari_tanggal)
                        ->where('id_warga',$kategoris->warga->id)
                        ->where('jumlah_orang','<',$kategoris->warga->kapasitas)->get();

            }


            
        }

      dd(DB::getQueryLog());


    }


   
}
