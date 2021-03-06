<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use App\SettingHalaman;
use App\SettingHalamanCulture;
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
use App\TamuHomestay;
use App\TamuCulture;
use App\Http\Controllers\StringController;
use App\SettingFotoHome;
use Telegram;


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
        
        $besok = mktime (0,0,0, date("m"), date("d")+1,date("Y"));
        $tanggal_sampai_tanggal = date('Y-m-d', $besok);

        $homestay = Kamar::with('rumah','destinasi')->where('tampil_home',1)->inRandomOrder()->get();
        $cultural = Kategori::with('destinasi')->where('tampil_home',1)->inRandomOrder()->get();

        $destinasi_homestay =   DB::table('kamar')->join('destinasi', 'kamar.id_destinasi', '=', 'destinasi.id')->select('id_destinasi','nama_destinasi','foto_destinasi')->inRandomOrder()->limit(10)->groupBy('id_destinasi')->get();

        $destinasi_cultural =   DB::table('kategori')->join('destinasi', 'kategori.destinasi_kategori', '=', 'destinasi.id')->select('destinasi.id AS id_destinasi','nama_destinasi','foto_destinasi')->inRandomOrder()->limit(10)->groupBy('destinasi_kategori')->get();

 
        //MENAMPILKAN FOTO SEEDER
        $setting_foto_home = SettingFotoHome::first();


        //Mereturn (menampilkan) halaman yang ada difolder cultural -> list. (Passing $lis_cultural ke view atau tampilan cultural.list)
        return view('welcome', ['homestay' => $homestay,'cultural' => $cultural,'tanggal' => $tanggal,'tanggal_sampai_tanggal' => $tanggal_sampai_tanggal, 'setting_foto_home'=>$setting_foto_home,'destinasi_homestay' => $destinasi_homestay,'destinasi_cultural' => $destinasi_cultural]);
 
    }


      public function tentang_homestay()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',1)->first();

        return view('tentang.homestay',['setting_halaman' => $setting_halaman]);
    }  

     public function tentang_ce()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',4)->first();

        return view('tentang.ce',['setting_halaman' => $setting_halaman]);
    }

     public function cara_pesan_homestay()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',2)->first();

        return view('cara_pesan.homestay',['setting_halaman' => $setting_halaman]);
    } 
     public function cara_pesan_ce()
    {
        $setting_halaman = SettingHalaman::where('jenis_halaman',5)->first();

        return view('cara_pesan.ce',['setting_halaman' => $setting_halaman]);
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
        $tanggal_lahir = date_create($profil->tanggal_lahir);
        $hari_tanggal_lahir = date_format($tanggal_lahir,"d");
        $bulan_tanggal_lahir = date_format($tanggal_lahir,"m");
        $tahun_tanggal_lahir = date_format($tanggal_lahir,"Y");

        return view('profil',['profil' => $profil,'status_foto_profil' => $status_foto_profil,'hari' => $hari_tanggal_lahir,'bulan' => $bulan_tanggal_lahir,'tahun' => $tahun_tanggal_lahir]);
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

         $tanggal_lahir = $request->tahun.'-'. $request->bulan.'-'.$request->tanggal ;

        $profil->update(['name' => $request->name,'email' => $request->email,'tanggal_lahir' => $tanggal_lahir,'alamat' => $request->alamat,'jenis_kelamin' => $request->jenis_kelamin,'no_telp' => $request->no_telp,'kewarga_negaraan' => $request->kewarga_negaraan]);


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
              $status_pesanan = "Anda baru saja melakukan pemesanan";   
          }
          else if ($pesanan_homestays->status_pesanan == 1) {
              $status_pesanan = "Admin Sedang Melakukan Pengecekan Pembayaran anda";   
          }
           else if ($pesanan_homestays->status_pesanan == 2) {
              $status_pesanan = "Pesanan Anda Telah dikonfirmasi oleh admin";   
          }
          elseif ($pesanan_homestays->status_pesanan == 3) {
              $status_pesanan = "Check In";   
          }
          else if ($pesanan_homestays->status_pesanan == 4) {
              $status_pesanan = "Check Out";   
          }  
          else if ($pesanan_homestays->status_pesanan == 5) {
              $status_pesanan = "Pesanan Batal";   
          }

          if ($pesanan_homestays->status_pesanan == 0) {
          $tombol_pesanan = '<a href="'.url("pemesanan/homestay/batal/".$pesanan_homestays->id).'" class="btn read-more-batal">BATAL<i class="glyphicon glyphicon-remove-circle"></i></a>';   
          }elseif ($pesanan_homestays->status_pesanan == 2) {
          $tombol_pesanan  = '<a href="'.url("pemesanan/homestay/check_in/".$pesanan_homestays->id).'" class="btn read-more">CHECK IN<i class="glyphicon glyphicon-th-list"></i></a>';   
          }elseif ($pesanan_homestays->status_pesanan == 3) {
          $tombol_pesanan  = '<a href="'.url("pemesanan/homestay/check_out/".$pesanan_homestays->id).'" class="btn read-more">CHECK OUT<i class="glyphicon glyphicon-hand-right"></i></a>';  
          }else{
          $tombol_pesanan = '';
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
                                              <strong> '.$status_pesanan.'  </strong> 
                                            </div>
 
                                          </div> 
                                          <div class="col-md-6">
                                            <a href="'.url("/detail-pesanan-homestay/".$pesanan_homestays->id).'" class="btn read-more">Detail<i class="glyphicon glyphicon-th-list"></i></a>
                                             '. $tombol_pesanan .'
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
                    $status_pesanan = "Anda baru saja melakukan pemesanan";   
                    }
                    else if ($pesanan_cultures->status_pesanan == 1) {
                    $status_pesanan = "Anda telah mengkonfirmasi pembayaran anda";   
                    }
                    else if ($pesanan_cultures->status_pesanan == 2) {
                    $status_pesanan = "Kami telah mengkonfirmasi pembayaran anda";   
                    }
                    elseif ($pesanan_cultures->status_pesanan == 3) {
                    $status_pesanan = "Check In";   
                    }
                    else if ($pesanan_cultures->status_pesanan == 4) {
                    $status_pesanan = "Check Out";   
                    }  
                    else if ($pesanan_cultures->status_pesanan == 5) {
                    $status_pesanan = "Anda telah membatalkan pesanan anda";   
                    }
 
                    if ($pesanan_cultures->status_pesanan == 0) {
                    $tombol_pesanan = '<a href="'.url("pemesanan/cultural/batal/".$pesanan_cultures->id).'" class="btn read-more-batal" >BATAL<i class="glyphicon glyphicon-remove-circle"></i></a>';   
                    } 
                    elseif ($pesanan_cultures->status_pesanan == 2) {
                     $tombol_pesanan  = '<a href="'.url("pemesanan/cultural/check_in/".$pesanan_cultures->id).'" class="btn read-more">CHECK IN<i class="glyphicon glyphicon-th-list"></i></a>';   
                    }
                    elseif ($pesanan_cultures->status_pesanan == 3) {
                     $tombol_pesanan  = '<a href="'.url("pemesanan/cultural/check_out/".$pesanan_cultures->id).'" 
                                            class="btn read-more">CHECK OUT<i class="glyphicon glyphicon-hand-right"></i></a>';  
                    } 
                    else{
                      $tombol_pesanan = '';
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
                                              <strong>'.$status_pesanan.'</strong> 
                                            </div>

                                          </div>

                                          <div class="col-md-6">
                                            <a href="'.url("/detail-pesanan-culture/".$pesanan_cultures->id).'" 
                                            class="btn read-more">Detail<i class="glyphicon glyphicon-th-list"></i></a>
                                               '. $tombol_pesanan .'
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

    public function detail_pesanan_homestay($id,StringController $stringfunction)
    {


      $pesanan_homestay = PesananHomestay::where('id',$id)->first();
      $kamar = Kamar::with(['rumah','destinasi'])->where('id_kamar',$pesanan_homestay->id_kamar)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_homestay->check_in);
      $format_check_in = $check_in->format('j M Y');

      $check_out = DateTime::createFromFormat('Y-m-d', $pesanan_homestay->check_out);
      $format_check_out = $check_out->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_homestay->created_at);
      $waktu_pesan = $created_ats->format('j M Y H:i:s');

      //hitung harga
      $harga_kamar = $pesanan_homestay->harga_pemilik + $pesanan_homestay->harga_endeso;

      $harga_kamar_tambah_harga_makan = $harga_kamar + $pesanan_homestay->harga_makan;

      if ($kamar->tipe_harga == 1) {

          $harga_jumlah_orang = $harga_kamar_tambah_harga_makan * $pesanan_homestay->jumlah_orang;

           $total_dp = $pesanan_homestay->harga_endeso * $pesanan_homestay->jumlah_orang * $pesanan_homestay->jumlah_malam;
           $harga_lama_inap = $harga_jumlah_orang * $pesanan_homestay->jumlah_malam;
      
          $total_bayar = $harga_kamar_tambah_harga_makan * $pesanan_homestay->jumlah_orang * $pesanan_homestay->jumlah_malam;

      }
      elseif ($kamar->tipe_harga == 2) {

          $harga_jumlah_orang = $harga_kamar_tambah_harga_makan ;
          $total_dp = $pesanan_homestay->harga_endeso  * $pesanan_homestay->jumlah_malam;
          $harga_lama_inap = $harga_jumlah_orang * $pesanan_homestay->jumlah_malam;
      
          $total_bayar = $harga_kamar_tambah_harga_makan  * $pesanan_homestay->jumlah_malam;

      }

    

      
      // ambil nama tamu
      $tamu = TamuHomestay::select('nama_tamu')->where('id_pesanan',$pesanan_homestay->id)->get();

      $tampil_detail = '<div class="panel panel-default">
                          <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Detail Homestay</h4></b></div>
                          <div class="panel-body">
                            <h3>'.$kamar->rumah->nama_pemilik.',</h3>

                            <div class="row">
                              <div class="col-md-6">
                              <h5>'.$kamar->destinasi->nama_destinasi.'</h5>
                             <table>
                            <tbody>                            
                                <tr><td width="25%"><font class="satu">Check-in </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">'.$format_check_in.'</font> 
                                </tr>
                                <tr><td  width="25%"><font class="satu">Check-out </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$format_check_out.'</font> </td>
                                </tr>
                                <tr><td  width="30%"><font class="satu">Kode Booking</font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$pesanan_homestay->id.'</font> </td>
                                </tr>';
 
                                // penutup tabel per tama dan penutup div pertama
                                $tampil_detail .= ' </tbody></table>
                                </div>

                                <div class="col-md-6">
                                <tbody><table>';  // pembuka tabel kedau dan pembuka div kedua

                                // jika ada harga makan, makan akan tampil harga makan nya
                                if ($pesanan_homestay->harga_makan != 0) {
                                  $tampil_detail .=     '<tr><td width="50%"><font class="satu">Harga Makan </font></td> <td> &nbsp;:&nbsp;</td> <td> <font class="satu">'.$stringfunction->rp($pesanan_homestay->harga_makan).' </font></td></tr>';
                                }
                                
                                // dibawah ini rincian harga nya
                                $tampil_detail .= '

                                  <tr><td  width="50%"><font class="satu">Harga Kamar </font></td> <td> &nbsp;:&nbsp;</td> <td><font class="satu"> '.$stringfunction->rp($harga_kamar).'</font></td></tr>';

                                  if ($kamar->tipe_harga == 1) {

                                     $tampil_detail .= '<tr><td  width="50%"> <font class="satu">'.$pesanan_homestay->jumlah_orang.' orang X '.$stringfunction->rp($harga_kamar_tambah_harga_makan).'</font></td> <td> &nbsp;:&nbsp;</td> <td><font class="satu"> '.$stringfunction->rp($harga_jumlah_orang).'</font></td></tr>';


                                  }
                                
                                 
                                $tampil_detail .=  '<tr><td  width="50%"><font class="satu"> '.$pesanan_homestay->jumlah_malam.' Hari X '.$stringfunction->rp($harga_jumlah_orang).'</font></td> <td> &nbsp;:&nbsp;</td> <td><font class="satu"> '.$stringfunction->rp($harga_lama_inap).'</font></td></tr>

                                  <tr><td  width="50%"><font class="satu" style="color:red"> Down Payment (DP) </font></td> <td><font class="satu" style="color:red">  &nbsp;:&nbsp;</font></td> <td><font class="satu" style="color:red"> '.$stringfunction->rp($total_dp).'</font></td></tr>

                                  <tr><td  width="50%"><font class="satu" style="color:red"> Total Pembayaran </font></td> <td> <font class="satu" style="color:red"> &nbsp;:&nbsp;</font></td> <td><font class="satu" style="color:red"> '.$stringfunction->rp($total_bayar).'</font></td></tr>
                                </tbody>
                                </table>

                                  </div>
                                </div>
                                ';// penutup ttabel kedau dan  penutup div kedua
                                if ($tamu->count() != '') {
                                  $tampil_detail .= '<hr>
                                <h4>Daftar Tamu</h4>';
                                }
                               $no_urut_tamu = 1; 
                                foreach ($tamu as $tamus) {
                                  if ($tamus->nama_tamu == NULL OR $tamus->nama_tamu == '') {
                                    # code...
                                  }
                                  else{
                                      $tampil_detail .=  '
                                      
                                      <tr><td  width="25%"><font class="satu">'.$no_urut_tamu++.'.</font></td> 
                                          <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$tamus->nama_tamu.'</font> </td>
                                      </tr><br>';
                                  }
                              

                                }  

                      $tampil_detail .= '</div>
                        </div>';
      

      return view('detail_pesanan_homestay',
                  ['pesanan_homestay' =>$pesanan_homestay, 
                  'tampil_detail'     =>$tampil_detail, 
                  'waktu_pesan'       =>$waktu_pesan]);      
    }



    public function detail_pesanan_culture($id, StringController $stringfunction)
    {
      $pesanan_culture = PesananCulture::where('id',$id)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_culture->check_in);
      $format_check_in = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_culture->created_at);
      $waktu_pesan = $created_ats->format('j M Y');

      $warga = Warga::select('id_kategori_culture')->where('id',$pesanan_culture->id_warga)->first();
      $kategori = Kategori::select('nama_aktivitas', 'destinasi_kategori')->where('id',$warga->id_kategori_culture)->first();
      $destinasi = Destinasi::select('nama_destinasi')->where('id',$kategori->destinasi_kategori)->first();
            // ambil nama tamu
      $tamu = TamuCulture::select('nama_tamu')->where('id_pesanan',$pesanan_culture->id)->get();

      // hitung harga 
      $harga_cultural = $pesanan_culture->harga_endeso + $pesanan_culture->harga_pemilik;

      $harga_jumlah_orang = $harga_cultural * $pesanan_culture->jumlah_orang;

      $total_dp = $pesanan_culture->harga_endeso * $pesanan_culture->jumlah_orang;

      $total_bayar = 

      $nama_user = User::select('name')->where('id',$pesanan_culture->id_user)->first();

      $tampil_detail = '<div class="panel panel-default">
                          <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Detail Culture</h4></b></div>
                          <div class="panel-body">

                                <h3>'.$destinasi->nama_destinasi.',</h3>
                          <div class="row">

                            <div class="col-md-6">
                                <h5>'.$kategori->nama_aktivitas.'</h5>
                                 <table>
                                <tbody>                            
                                    <tr><td width="30%"><font class="satu">Check-in </font></td> 
                                        <td> &nbsp;&nbsp;</td> <td><font class="satu">'.$format_check_in.'</font> 
                                    </tr>
                                    <tr><td width="30%"><font class="satu">Jadwal</font></td> 
                                        <td> &nbsp;&nbsp;</td> <td><font class="satu">'.$pesanan_culture->jadwal.'</font> 
                                    </tr>
                                    <tr><td  width="30%"><font class="satu">Kode Booking  </font></td> 
                                        <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$pesanan_culture->id.'</font> </td>
                                    </tr>

                                </tbody>
                              </table>
                            </div>

                            <div class="col-md-6">
                                 <table>
                                <tbody>  
                                      <tr><td  width="50%"><font class="satu">Harga </font></td> <td> &nbsp;:&nbsp;</td> <td><font class="satu"> '.$stringfunction->rp($harga_cultural).'</font></td></tr>

                                      <tr><td  width="50%"> <font class="satu">'.$pesanan_culture->jumlah_orang.' orang X '.$stringfunction->rp($harga_cultural).'</font></td> <td> &nbsp;:&nbsp;</td> <td><font class="satu"> '.$stringfunction->rp($harga_jumlah_orang).'</font></td></tr>

                                      <tr><td  width="50%"><font class="satu" style="color:red"> Down Payment (DP) </font></td> <td> <font class="satu" style="color:red">&nbsp;:&nbsp;</font></td> <td><font class="satu" style="color:red"> '.$stringfunction->rp($total_dp).'</font></td></tr>

                                      <tr><td  width="50%"><font class="satu" style="color:red"> Total Pembayaran </font></td> <td> <font class="satu" style="color:red">&nbsp;:&nbsp;</font></td> <td><font class="satu" style="color:red"> '.$stringfunction->rp($harga_jumlah_orang).'</font></td></tr>

                                </tbody>
                              </table>
                            </div>



                          </div>';
                            if ($tamu->count() != '') {
                                  $tampil_detail .= '<hr>
                                <h4>Daftar Tamu</h4>';
                                }
                               $no_urut_tamu = 1; 
                                foreach ($tamu as $tamus) {
                                  if ($tamus->nama_tamu == NULL OR $tamus->nama_tamu == '') {
                                    # code...
                                  }
                                  else{
                                      $tampil_detail .=  '
                                      
                                      <tr><td  width="25%"><font class="satu">'.$no_urut_tamu++.'.</font></td> 
                                          <td> &nbsp;&nbsp;</td> <td> <font class="satu">'.$tamus->nama_tamu.'</font> </td>
                                      </tr><br>'; 
                                  }


                                }  
                          $tampil_detail .= '</div>
                        </div>
                        </div>';

      return view('detail_pesanan_culture',['pesanan_culture'=>$pesanan_culture, 
                                            'tampil_detail'=>$tampil_detail, 
                                            'waktu_pesan'=>$waktu_pesan,     
                                            'nama_user'=>$nama_user,
                                            'destinasi'=>$destinasi->nama_destinasi,
                                            'aktivitas'=>$kategori->nama_aktivitas]); 

    }


    public function detail_cultural($id, $tanggal_masuk, $jumlah_orang){ 
 
        $detail_cultural = Kategori::find($id); 
 
        $komentar_kategori = KomentarKategori::with('user')->where('status','!=','2')->where('id_kategori', $id)->limit(5)->get(); 


        $warga = Warga::select(['harga_endeso', 'harga_pemilik'])->where('id_kategori_culture',$detail_cultural->id)->inRandomOrder()->first();
                // perhitungan rating
        $query_sum_hitung_rating = KomentarKategori::HitungRating($id)->first(); 
 
        //Mereturn (menampilkan) halaman yang ada difolder cultural -> detail. (Passing $detail_cultural ke view atau tampilan cultural.detail) 
        return view('cultural.detail', ['total_rating'=>round($query_sum_hitung_rating->total_rating),'detail_cultural' => $detail_cultural, 'komentar_kategori' => $komentar_kategori, 'tanggal_masuk' => $tanggal_masuk, 'jumlah_orang' => $jumlah_orang, 'warga' => $warga]); 
    } 


    public function komentar_penginapan(Request $request){  

          $this->validate($request, [
          'isi_komentar' => 'required',
          'id_kamar' => 'required',
          'jumlah_bintang' => 'required',
        ]); 
    $id_user = Auth::user()->id;
    KomentarKamar::create(['status'=>'0','isi_komentar' => $request->isi_komentar,'id_kamar' => $request->id_kamar,'id_user' => $id_user,'jumlah_bintang'=>$request->jumlah_bintang]);

    return back();

    } 

    public function komentar_cultural(Request $request){  

          $this->validate($request, [
        'isi_komentar' => 'required',
        'id_kategori' => 'required',
        'jumlah_bintang' => 'required',
     
        ]); 
    $id_user = Auth::user()->id;

    KomentarKategori::create(['status'=>'0','isi_komentar' => $request->isi_komentar,'id_kategori' => $request->id_kategori,'id_user' => $id_user,'jumlah_bintang'=>$request->jumlah_bintang]);


    return back();

    } 


       public function detail_penginapan($id,$tanggal_checkin,$tanggal_checkout,$jumlah_orang,StringController $stringfunction)   
    {


        $kamar = Kamar::with(['rumah'])->find($id);
        $kamar_lain = Kamar::with(['rumah','destinasi'])->where('id_destinasi',$kamar->id_destinasi)->where('id_kamar','!=',$kamar->id_kamar)->limit(3)->get();
        // perhitungan rating
        $query_sum_hitung_rating = KomentarKamar::HitungRating($id)->first(); 

        $komentar = KomentarKamar::with('user')->where('status','!=' ,2)->where('id_kamar',$id)->limit(5)->get();
        $harga_kamar = $kamar->harga_endeso + $kamar->harga_pemilik;

        $tanggal_pertama =date_create($tanggal_checkin);
        $tanggal_kedua =date_create($tanggal_checkout);
        $selisih_hari =date_diff($tanggal_pertama,$tanggal_kedua);

        return view('penginapan.detail',['total_rating'=>round($query_sum_hitung_rating->total_rating),
                                          'kamar' => $kamar,
                                         'kamar_lain'=>$kamar_lain,
                                         'harga_kamar_sebenarnya'=>$stringfunction->rp($harga_kamar),
                                         'dp'=>$stringfunction->rp($kamar->harga_endeso),
                                         'komentar'=>$komentar,
                                         'tanggal_checkin'=>$tanggal_checkin,
                                         'tanggal_checkout'=>$tanggal_checkout,
                                         'jumlah_orang'=>$jumlah_orang,
                                         'selisih_hari' =>  $selisih_hari->format("%a")]); 

      }



    public static function tanggal_mysql($tanggal2){
    
    $date= date_create($tanggal2);
    $date_format = date_format($date,"Y-m-d");
    return $date_format;
    }


    public function pencarian_ce_homestay(Request $request,StringController $string)
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

            //penentuan urutan harga homestay
            if (isset($request->urutan)) {
              
              $urutan = $request->urutan;
            }
            else {
              $urutan = 0;
            }

            // urutkan dari yang paling murah
            if ($urutan == 0) {
              $kamar = Kamar::with('rumah')->where('id_destinasi',$request->tujuan)->where(function ($query) use ($request){
                  $query->where('kapasitas',$request->jumlah_orang)->orwhere('kapasitas','>',$request->jumlah_orang);
              })->orderByRaw('harga_endeso + harga_pemilik ASC')->get(); 
            }
            // urutkan dari yang paling mahal
            elseif ($urutan == 1) {
              $kamar = Kamar::with('rumah')->where('id_destinasi',$request->tujuan)->where(function ($query) use ($request){
                  $query->where('kapasitas',$request->jumlah_orang)->orwhere('kapasitas','>',$request->jumlah_orang);
              })->orderByRaw('harga_endeso + harga_pemilik DESC')->get(); 
            }
            
        

            $tampil_kamar = '';   
            $hitung = 0;

            $lokasi_kamar = array();

            foreach ($kamar as $kamars) {// foreach ($kamar as $kamars)
         
                $pesanan = PesananHomestay::status($kamars->id_kamar,$request->dari_tanggal,$request->sampai_tanggal)->count();



                    if ($pesanan == 0) {//  if ($pesanan == 0)

                        //harga kamar
                        $harga_kamar = $kamars->harga_endeso + $kamars->harga_pemilik;

                        // untuk menghitung berapa kamar yang akan tampil
                        $hitung = $hitung + 1;

                        if ($kamars->judul_peta != NULL AND $kamars->latitude != NULL AND $kamars->longitude != NULL) {
                          array_push($lokasi_kamar, ['judul_peta' => $kamars->judul_peta,'latitude' => $kamars->latitude,'longitude' => $kamars->longitude ,'id_kamar' => $kamars->id_kamar,'harga' => $kamars->harga_endeso + $kamars->harga_pemilik,'nama_pemilik' => $kamars->rumah->nama_pemilik ,'sistem_harga' => $kamars->tipe_harga,'gambar' => $kamars->foto1,'kapasitas' => $kamars->kapasitas]);
                        }

           

                        $tampil_kamar .= "<div class='row ' style='margin-bottom:10px;' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."'>
                        
                            <div class='col-md-4 col-sm-4 col-xs-4 no-padding '>
                             ";
                        $tampil_kamar .=  "<div id='list-homestay-".$kamars->id_kamar."' class='carousel slide' data-ride='carousel'>


                      <div class='carousel-inner'>
                        <div class='item active list-homestay' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."' >
                          <img src='img/".$kamars->foto1."' alt='Los Angeles'>
                        </div>";
                        if ($kamars->foto2 != NULL) {
                           $tampil_kamar .= "<div class='item list-homestay' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."' >
                          <img src='img/".$kamars->foto2."' alt='".$kamars->rumah->nama_pemilik."'>
                        </div>";
                        }

                        if ($kamars->foto3 != NULL) {
                          $tampil_kamar .=  "<div class='item list-homestay' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."' >
                          <img src='img/".$kamars->foto3."' alt='".$kamars->rumah->nama_pemilik."'>
                        </div>";
                         
                          }
                        if ($kamars->foto4 != NULL) {

                          $tampil_kamar .= "<div class='item list-homestay' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."' >
                          <img src='img/".$kamars->foto4."' alt='".$kamars->rumah->nama_pemilik."'>
                        </div>";
                          }

                        if ($kamars->foto5 != NULL) {
                          $tampil_kamar .="<div class='item list-homestay' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."' >
                          <img src='img/".$kamars->foto5."' alt='".$kamars->rumah->nama_pemilik."'>
                        </div>";
                          }
           $tampil_kamar .= "</div> <!-- / carousel-inner -->

                      <!-- Left and right controls -->
                      <a class='left carousel-control' href='#list-homestay-".$kamars->id_kamar."' data-slide='prev'>
                        <span class='glyphicon glyphicon-chevron-left'></span>
                        <span class='sr-only'>Previous</span>
                      </a>
                      <a class='right carousel-control' href='#list-homestay-".$kamars->id_kamar."' data-slide='next'>
                        <span class='glyphicon glyphicon-chevron-right'></span>
                        <span class='sr-only'>Next</span>
                      </a>
                    </div>";

                    $tampil_kamar .= "
                
                    </div> <!-- / carousel slide -->
                    
                        <div class='col-md-6 col-sm-6 col-xs-6 hotel-detail-box list-homestay' data-url='detail-penginapan/".$kamars->id_kamar."/".HomeController::tanggal_mysql($request->dari_tanggal)."/".HomeController::tanggal_mysql($request->sampai_tanggal)."/".$request->jumlah_orang."'>
                            <h4>".$kamars->rumah->nama_pemilik."</h4>
                            <p>".$kamars->deskripsi ."</p>
                            <h6><b><sup>RP</sup>". number_format($harga_kamar,0,',','.')."</b><span>";

                              
                                if ($kamars->tipe_harga ==  1) {
                                
                                   $tampil_kamar .=  "/Orang/Malam";
                                }
                                elseif ($kamars->tipe_harga ==  2) {
                                     $tampil_kamar .=  "/Kamar/Malam";
                                }
                                              

                           $tampil_kamar .=  "</span></h6>
                          <span>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star-half-o'></i>
                          </span>
                        </div><!-- / hotel-detail-box -->
                     
                  
                      </div> <!--/ row list-homestay -->
                    
                      <hr>
                      ";

                    }////  if ($pesanan == 0)
            } // foreach ($kamar as $kamars)
            
                  // jika kapasitas nya tidak mencukupi
                  if ($kamar->count() == "") { 
                    Session::flash("flash_notification", [
                    "level"=>"danger",
                    "message"=>"mohon maaf tidak ada homestay yang mencukupi kapasitas yang anda inginkan"
                    ]);
                  }
                  else
                  {
                   
                     // jika kamar tidak ada yang tampil maka akan muncul alert
                  
                      if ($hitung === 0) {
                         Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"mohon maaf homestay di destinasi yang anda pilih sedang penuh, silahkan pilih tanggal lain"
                        ]);
                      }// if ($hitung === 0)
                      
                  }// else if ($kamar->count() == "")


                  $string = new StringController();



             
           return view('pencarian_homestay',['tampil_kamar'=>$tampil_kamar, 'hitung'=>$hitung,'lokasi_kamar' =>  $lokasi_kamar,'pilihan' => $request->pilihan,'dari_tanggal' => $string->tanggal_mysql($request->dari_tanggal),'sampai_tanggal' => $string->tanggal_mysql($request->sampai_tanggal),'tujuan' => $request->tujuan,'jumlah_orang' => $request->jumlah_orang,'urutan' => $urutan]);   

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
            
            $kategori = Kategori::where('destinasi_kategori',$request->tujuan);

            
            $lis_cultural = '';

            $jumlah_kategori = $kategori->count();

            if ($jumlah_kategori == 0) {
              # code...
              Session::flash("flash_notification", [
              "level"=>"danger",
              "message"=>"mohon maaf cultural experience di daerah yang anda pilih belum tersedia"
              ]);
            }
            $jumlah_warga = 0;

            $data_warga = array();

            foreach ($kategori->get() as $kategoris ) {
               # code... 


              $warga = Warga::select('harga_endeso','harga_pemilik','nama_warga','harga_endeso','harga_pemilik','latitude','longitude','kapasitas')->where('id_kategori_culture',$kategoris->id)->inRandomOrder();
              if ($warga->count() > 0){

                array_push($data_warga,['nama_warga' => $warga->first()->nama_warga,'nama_kategori' => $kategoris->nama_aktivitas,'harga' =>$string->rp($warga->first()->harga_endeso + $warga->first()->harga_pemilik),'latitude' => $warga->first()->latitude,'longitude' => $warga->first()->longitude,'kapasitas' => $warga->first()->kapasitas,'id_kategori' => $kategoris->id ]);


             
   
              $jumlah_warga++;

              $harga_cultural = $warga->first()->harga_endeso + $warga->first()->harga_pemilik;


             $lis_cultural .= '
                            <div class="row " style="margin-bottom:10px;" data-url="'. url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang.'">
                            
                                <div class="col-md-4 col-sm-4 col-xs-4 no-padding ">';

              $lis_cultural .=   "<div id='list-ce-".$kategoris->id."' class='carousel slide' data-ride='carousel'>


                      <div class='carousel-inner'>
                        <div class='item active list-ce' data-url='". url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang."'>
                          <img src='img/".$kategoris->foto_kategori."' alt='".$kategoris->nama_aktivitas."'>
                        </div>";
                        if ($kategoris->foto_kategori2 != NULL) {
                           $lis_cultural .= "<div class='item list-ce' data-url='". url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang."'>
                          <img src='img/".$kategoris->foto_kategori2."' alt='".$kategoris->nama_aktivitas."'>
                        </div>";
                        }

                        if ($kategoris->foto_kategori3 != NULL) {
                          $lis_cultural .=  "<div class='item list-ce' data-url='". url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang."'
                          >
                          <img src='img/".$kategoris->foto_kategori3."' alt='".$kategoris->nama_aktivitas."'>
                        </div>";
                         
                          }
                        if ($kategoris->foto_kategori4 != NULL) {

                          $lis_cultural .= "<div class='item list-ce' data-url='". url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang."'
                          >
                          <img src='img/".$kategoris->foto_kategori4."' alt='".$kategoris->nama_aktivitas."'>
                        </div>";
                          }

                        if ($kategoris->foto_kategori5 != NULL) {
                          $lis_cultural .="<div class='item list-ce' data-url='". url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang."'
                          >
                          <img src='img/".$kategoris->foto_kategori5."' alt='".$kategoris->nama_aktivitas."'>
                        </div>";
                          }
           $lis_cultural .= "</div> <!-- / carousel-inner -->

                      <!-- Left and right controls -->
                      <a class='left carousel-control' href='#list-ce-".$kategoris->id."' data-slide='prev'>
                        <span class='glyphicon glyphicon-chevron-left'></span>
                        <span class='sr-only'>Previous</span>
                      </a>
                      <a class='right carousel-control' href='#list-ce-".$kategoris->id."' data-slide='next'>
                        <span class='glyphicon glyphicon-chevron-right'></span>
                        <span class='sr-only'>Next</span>
                      </a>
                    </div>";        
                            
              $lis_cultural .= '</div>
                                <div class="col-md-6 col-sm-6 col-xs-6 hotel-detail-box list-ce" data-url="'. url ('/detail-cultural/').'/'.$kategoris->id.'/'.HomeController::tanggal_mysql($request->dari_tanggal).'/'.$request->jumlah_orang.'" ><h4>'. $kategoris->nama_aktivitas .'</h4> 
                                <h6><b><sup>RP</sup>'. $string->rp($harga_cultural) .'</b><span>ribu / paket</span></h6>';
                                                                             

                                 $lis_cultural .= '<h6><b> <span> Durasi : '. $kategoris->durasi .' </span> </b></h6>
                                  <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                  </span>
                                </div>
                          
                               
                           
                              
                            </div>
                            ';
              }
              


             } 

             if ($jumlah_warga == 0) {
               # code...
              Session::flash("flash_notification", [
              "level"=>"danger",
              "message"=>"mohon maaf cultural experience di daerah yang anda pilih belum tersedia"
              ]);
             }

            return view('pencarian_cultur',['lis_cultural'=>$lis_cultural,'jumlah_kategori' => $jumlah_kategori,'jumlah_warga' => $jumlah_warga,'dari_tanggal' => $string->tanggal_mysql($request->dari_tanggal),'jumlah_orang' => $request->jumlah_orang,'data_warga' => $data_warga]);

        }


    }

    public function telegram(){
        $response = Telegram::getUpdates();

        return $response;
    }
   
}
