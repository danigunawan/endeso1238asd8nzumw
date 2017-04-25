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
use App\KomentarKategori;
use App\KomentarKamar;
use Session;
use App\PesananHomestay;
use App\PesananCulture;
use Illuminate\Support\Facades\DB;
use App\Warga;
use App\Destinasi;
use DateTime;

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
        $tanggal = date('Y-m-d');
        $homestay = Kamar::with('rumah')->limit(8)->inRandomOrder()->get(); 
        //Mereturn (menampilkan) halaman yang ada difolder cultural -> list. (Passing $lis_cultural ke view atau tampilan cultural.list)
        return view('welcome', ['homestay' => $homestay,'tanggal' => $tanggal]);
 
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
        'tanggal_lahir' => ' ',
        'kewarga_negaraan' => ' ',
         'foto_profil' => 'image|max:2048'
        ]);

      
        $profil = User::where('id',$id)->first();

        $profil->update(['name' => $request->name,'email' => $request->email,'tanggal_lahir' => $request->tanggal_lahir,'alamat' => $request->alamat,'jenis_kelamin' => $request->jenis_kelamin,'no_telp' => $request->no_telp,'kewarga_negaraan' => $request->kewarga_negaraan]);


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

    function tanggal_terbalik($tanggal){
    
    $date= date_create($tanggal);
    $date_terbalik =  date_format($date,"d/m/Y");
    return $date_terbalik;
    }
      
      public function pesanan()  
    {

        $id_user = Auth::user()->id;

        $pesanan_homestay = PesananHomestay::where('id_user',$id_user)->get();
        $pesanan_culture = PesananCulture::where('id_user',$id_user)->get();

          $tampil_pesanan_homestay = "";
          $tampil_pesanan_culture = "";
          $belum_ada_pemesanan_homestay = ""; 
          $belum_ada_pemesanan_culture = ""; 

        foreach ($pesanan_homestay  as $pesanan_homestays) {//        foreach ($pesanan_homestay  as $pesanan_homestays) {

          $kamar = Kamar::with(['rumah','destinasi'])->where('id_kamar',$pesanan_homestays->id_kamar)->first();

          if ($pesanan_homestays->status_pesanan == 0) {
              $pesanan_homestays->status_pesanan = "Anda baru saja melakukan pemesanan";   
          }
          else if ($pesanan_homestays->status_pesanan == 1) {
              $pesanan_homestays->status_pesanan = "Anda telah mengkonfirmasi pembayaran anda";   
          }
           else if ($pesanan_homestays->status_pesanan == 2) {
              $pesanan_homestays->status_pesanan = "Kami telah mengkonfirmasi pembayaran anda";   
          }
          elseif ($pesanan_homestays->status_pesanan == 3) {
              $pesanan_homestays->status_pesanan = "Check In";   
          }
          else if ($pesanan_homestays->status_pesanan == 4) {
              $pesanan_homestays->status_pesanan = "Check Out";   
          }  
          else if ($pesanan_homestays->status_pesanan == 5) {
              $pesanan_homestays->status_pesanan = "Anda telah membatalkan pesanan anda";   
          }

          $tampil_pesanan_homestay .= '<div class="panel panel-default">
                                    <div class="panel-body">
                                      <div class="card card-outline-danger">
                                      <div class="card-header">
                                          <div class="row"> 
                                             <div class="col-md-6"> <h4> '.$kamar->rumah->nama_pemilik.'  </h4> <p> '.$kamar->destinasi->nama_destinasi.' </p></div>
                                             <div class="col-md-6"> No. Pesanan <b>'.$pesanan_homestays->id.'</b> </div>

                                          </div>
                                      </div>
                                      <div class="card-block">
                                         <div class="alert alert-success" role="alert">

                                             <div class="row">
                                                <div class="col-md-4"> 
                                                <p> <b>CHECK-IN </b></p> <br> '.HomeController::tanggal_terbalik($pesanan_homestays->check_in).'
                                                </div>
                                                <div class="col-md-4"> 
                                                <p> <b>CHECK-OUT  </b></p> <br>'.HomeController::tanggal_terbalik($pesanan_homestays->check_out).'                                                
                                                </div>
                                             </div>
                                         </div>

                                        <div class="row">
                                          <div class="col-md-6">

                                            <div class="alert alert-warning" role="alert">
                                              <strong> '.$pesanan_homestays->status_pesanan.'  </strong> 
                                            </div>


                                          </div>

                                          <div class="col-md-6">
                                            <a href="'.url("/detail-pesanan-homestay/".$pesanan_homestays->id).'" class="btn read-more">Detail<i class="glyphicon glyphicon-th-list"></i></a>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                    </div>
                                    </div>
                                    <br>';
          
        }//        foreach ($pesanan_homestay  as $pesanan_homestays) {

        foreach ($pesanan_culture as $pesanan_cultures) {//  foreach ($pesanan_culture as $pesanan_cultures) {
                                                         
          $query = Warga::select('kategori.nama_aktivitas' , 'destinasi.nama_destinasi')
                          ->leftJoin('kategori', 'warga.id_kategori_culture', '=', 'kategori.id')
                          ->leftJoin('destinasi', 'kategori.destinasi_kategori', '=', 'destinasi.id')
                          ->where('warga.id',$pesanan_cultures->id_warga)            
                          ->first();

                    if ($pesanan_cultures->status_pesanan == 0) {
                    $pesanan_cultures->status_pesanan = "Anda baru saja melakukan pemesanan";   
                    }
                    else if ($pesanan_cultures->status_pesanan == 1) {
                    $pesanan_cultures->status_pesanan = "Anda telah mengkonfirmasi pembayaran anda";   
                    }
                    else if ($pesanan_cultures->status_pesanan == 2) {
                    $pesanan_cultures->status_pesanan = "Kami telah mengkonfirmasi pembayaran anda";   
                    }
                    elseif ($pesanan_cultures->status_pesanan == 3) {
                    $pesanan_cultures->status_pesanan = "Check In";   
                    }
                    else if ($pesanan_cultures->status_pesanan == 4) {
                    $pesanan_cultures->status_pesanan = "Check Out";   
                    }  
                    else if ($pesanan_cultures->status_pesanan == 5) {
                    $pesanan_cultures->status_pesanan = "Anda telah membatalkan pesanan anda";   
                    }

          $tampil_pesanan_culture .= '<div class="panel panel-default">
                                    <div class="panel-body">
                                      <div class="card card-outline-danger">
                                      <div class="card-header">
                                          <div class="row"> 
                                             <div class="col-md-6"> <h4> '.$query->nama_aktivitas.'  </h4> <p> '.$query->nama_destinasi.' </p></div>
                                             <div class="col-md-6"> No. Pesanan <b>'.$pesanan_cultures->id.'</b> </div>

                                          </div>
                                      </div>
                                      <div class="card-block">
                                         <div class="alert alert-success" role="alert">

                                             <div class="row">
                                                <div class="col-md-4"> 
                                                <p> <b>CHECK-IN </b></p> <br> '.HomeController::tanggal_terbalik($pesanan_cultures->check_in).'
                                                </div>
                                             </div>
                                         </div>

                                        <div class="row">
                                          <div class="col-md-6">

                                           <div class="alert alert-warning" role="alert">
                                              <strong>'.$pesanan_cultures->status_pesanan.'</strong> 
                                            </div>

                                          </div>

                                          <div class="col-md-6">
                                            <a href="'.url("/detail-pesanan-culture/".$pesanan_cultures->id."/".$query->nama_aktivitas."/".$query->nama_destinasi).'" 
                                            class="btn read-more">Detail<i class="glyphicon glyphicon-th-list"></i></a>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                    </div>
                                    </div>
                                    <br>';
        }//   foreach ($pesanan_culture as $pesanan_cultures) {


        if ($pesanan_homestay->count() == "") {
            $belum_ada_pemesanan_homestay .= '<center><h3>Belum Ada Pesanan</h3></center>
                                     <center><p>Seluruh pesanan baru Anda akan muncul di sini, tapi kini Anda belum punya satu pun. Mari buat pesanan via homepage!</p></center>';
        }
      if ($pesanan_culture->count() == "") {
            $belum_ada_pemesanan_culture .= '<center><h3>Belum Ada Pesanan</h3></center>
                                     <center><p>Seluruh pesanan baru Anda akan muncul di sini, tapi kini Anda belum punya satu pun. Mari buat pesanan via homepage!</p></center>';
        }

        return view('pesanan',['tampil_pesanan_homestay'      =>$tampil_pesanan_homestay, 
                               'tampil_pesanan_culture'        =>$tampil_pesanan_culture, 
                               'belum_ada_pemesanan_homestay' => $belum_ada_pemesanan_homestay,
                               'belum_ada_pemesanan_culture'  => $belum_ada_pemesanan_culture]);

    }

    public function detail_pesanan_homestay($id)
    {


      $pesanan_homestay = PesananHomestay::where('id',$id)->first();
      $kamar = Kamar::with(['rumah','destinasi'])->where('id_kamar',$pesanan_homestay->id_kamar)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_homestay->check_in);
      $format_check_in = $check_in->format('j M Y');

      $check_out = DateTime::createFromFormat('Y-m-d', $pesanan_homestay->check_out);
      $format_check_out = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_homestay->created_at);
      $waktu_pesan = $created_ats->format('j M Y');

      $tampil_detail = '<div class="panel panel-default">
                          <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Detail Homestay</h4></b></div>
                          <div class="panel-body">
                            <h3>'.$kamar->rumah->nama_pemilik.',<h5>'.$kamar->destinasi->nama_destinasi.'</h5></h3>
                             <table>
                            <tbody>                            
                                <tr><td width="25%"><font class="satu">Check-in </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">'.$format_check_in.'</font> 
                                </tr>
                                <tr><td  width="25%"><font class="satu">Check-out </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$format_check_out.'</font> </td>
                                </tr>
                                <tr><td  width="25%"><font class="satu">Kode Booking  </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$pesanan_homestay->id.'</font> </td>
                                </tr>
                            </tbody>
                          </table>
                          </div>
                        </div>';
      

      return view('detail_pesanan_homestay',['pesanan_homestay'=>$pesanan_homestay, 'tampil_detail'=>$tampil_detail, 'waktu_pesan'=>$waktu_pesan]);      
    }

    public function detail_pesanan_culture($id,$destinasi,$aktivitas)
    {
      $pesanan_culture = PesananCulture::where('id',$id)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_culture->check_in);
      $format_check_in = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_culture->created_at);
      $waktu_pesan = $created_ats->format('j M Y');


      $nama_user = User::select('name')->where('id',$pesanan_culture->id_user)->first();

      $tampil_detail = '<div class="panel panel-default">
                          <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Detail Culture</h4></b></div>
                          <div class="panel-body">
                            <h3>'.$destinasi.',<h5>'.$aktivitas.'</h5></h3>
                             <table>
                            <tbody>                            
                                <tr><td width="25%"><font class="satu">Check-in </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">'.$format_check_in.'</font> 
                                </tr>
                                <tr><td width="25%"><font class="satu">Jadwal</font></td> 
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">'.$pesanan_culture->jadwal.'</font> 
                                </tr>
                                <tr><td  width="25%"><font class="satu">Kode Booking  </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$pesanan_culture->id.'</font> </td>
                                </tr>
                            </tbody>
                          </table>
                          </div>
                        </div>';

      return view('detail_pesanan_culture',['pesanan_culture'=>$pesanan_culture, 
                                            'tampil_detail'=>$tampil_detail, 
                                            'waktu_pesan'=>$waktu_pesan,
                                            'nama_user'=>$nama_user]);      


    }

    public function detail_cultural($id, $tanggal_masuk, $jumlah_orang){ 
 
        $detail_cultural = Kategori::find($id); 
 
        $komentar_kategori = KomentarKategori::with('user')->where('status',1)->where('id_kategori', $id)->limit(5)->get(); 

        $warga = Warga::select('harga_endeso')->where('id_kategori_culture',$detail_cultural->id)->inRandomOrder()->first();

 
        //Mereturn (menampilkan) halaman yang ada difolder cultural -> detail. (Passing $detail_cultural ke view atau tampilan cultural.detail) 
        return view('cultural.detail', ['detail_cultural' => $detail_cultural, 'komentar_kategori' => $komentar_kategori, 'tanggal_masuk' => $tanggal_masuk, 'jumlah_orang' => $jumlah_orang, 'warga' => $warga]); 
    } 


    public function komentar_penginapan(Request $request){  

          $this->validate($request, [
        'isi_komentar' => 'required',
        'id_kamar' => 'required',
     
        ]); 
    $id_user = Auth::user()->id;
    KomentarKamar::create(['isi_komentar' => $request->isi_komentar,'id_kamar' => $request->id_kamar,'id_user' => $id_user]);

    return back();

    } 

    public function komentar_cultural(Request $request){  

          $this->validate($request, [
        'isi_komentar' => 'required',
        'id_kategori' => 'required',
     
        ]); 
    $id_user = Auth::user()->id;
    KomentarKategori::create(['isi_komentar' => $request->isi_komentar,'id_kategori' => $request->id_kategori,'id_user' => $id_user]);

    return back();

    } 


       public function detail_penginapan($id,$tanggal_checkin,$tanggal_checkout,$jumlah_orang)   
    {
        $kamar = Kamar::with(['rumah'])->find($id);
        $kamar_lain = Kamar::with(['rumah','destinasi'])->where('id_destinasi',$kamar->id_destinasi)->limit(3)->get();

        $komentar = KomentarKamar::with('user')->where('status',1)->where('id_kamar',$id)->limit(5)->get();

        return view('penginapan.detail',['kamar' => $kamar,'kamar_lain'=>$kamar_lain,'komentar'=>$komentar,'tanggal_checkin'=>$tanggal_checkin,'tanggal_checkout'=>$tanggal_checkout,'jumlah_orang'=>$jumlah_orang]); 

      }



    public static function tanggal_mysql($tanggal2){
    
    $date= date_create($tanggal2);
    $date_format = date_format($date,"Y-m-d");
    return $date_format;
    }


    public function pencarian_ce_homestay(Request $request)
    {   
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
         
                $pesanan = PesananHomestay::status($kamars,$request->dari_tanggal,$request->sampai_tanggal)->count();

                    if ($pesanan == 0) {//  if ($pesanan == 0)

                        //harga kamar
                        $harga_kamar = $kamars->harga_endeso + $kamars->harga_pemilik;

                        // untuk menghitung berapa kamar yang akan tampil
                        $hitung = $hitung + 1;

                        $tampil_kamar .= "<div class='col-md-6 col-sm-12 col-xs-12 no-padding hotel-detail'>
                                            <div class='col-md-6 col-sm-6 col-xs-6 no-padding hotel-img-box'>
                                              <img src='img/".$kamars->foto1."' alt='Recommended' height='267' width='297' />

                                              <span><a href='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."'>Pesan</a></span>
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
            
                  // jika kapasitas nya tidak mencukupi
                  if ($kamar->count() == "") { // if if ($kamar->count() == "")
                    Session::flash("flash_notification", [
                    "level"=>"danger",
                    "message"=>"mohon maaf tidak ada homestay yang mencukupi kapasitas yang anda inginkan"
                    ]);
                  }// if if ($kamar->count() == "")
                  else
                  {// else if ($kamar->count() == "")
                   
                     // jika kamar tidak ada yang tampil maka akan muncul alert
                  
                      if ($hitung === 0) {// if ($hitung === 0)
                         Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"mohon maaf homestay di destinasi yang anda pilih sedang penuh, silahkan pilih tanggal lain"
                        ]);
                      }// if ($hitung === 0)
                      
                  }// else if ($kamar->count() == "")


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
            
            $kategori = Kategori::where('destinasi_kategori',$request->tujuan)->get();   
            
            $lis_cultural = '';
            foreach ($kategori as $kategoris ) {
               # code... 
              $warga = Warga::select('harga_endeso')->where('id_kategori_culture',$kategoris->id)->inRandomOrder()->first(); 

             $lis_cultural .= '
        <div class="recommended-detail">
          <div class="col-md-6 col-sm-12 col-xs-12 no-padding hotel-detail">
            <div class="col-md-6 col-sm-6 col-xs-6 no-padding hotel-img-box">
              <img src="img/'.$kategoris->foto_kategori .'" alt="Recommended" height="267" width="297" />
              <span><a href="'. url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang.'">Pesan</a></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 hotel-detail-box">
              <h4>'. $kategoris->nama_aktivitas .'</h4>
              <h6><b><sup>RP</sup>'. $warga->harga_endeso .'   </b><span>ribu / paket</span></h6>
              <span>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </span>
            </div>
          </div>
          
        </div>';
             } 

            return view('pencarian_cultur',['lis_cultural'=>$lis_cultural]);

        }


    }


   
}
