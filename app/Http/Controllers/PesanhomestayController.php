<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kamar;
use App\Rumah;
use App\PesananHomestay;
use Session;
use Auth;
use App\Http\Controllers\HomeController;
use App\Rekening;
use App\TamuHomestay;
use App\Http\Controllers\StringController;
use App\KomentarKamar;
use Telegram;


class PesanhomestayController extends Controller
{
    //

           public function index($id,$tanggal_checkin,$tanggal_checkout,$jumlah_orang,StringController $stringfunction, Request $request){   
        $detail_kamar = Kamar::with(['rumah'])->find($id);

        $harga_kamar = $detail_kamar->harga_endeso + $detail_kamar->harga_pemilik;
        $query_sum_hitung_rating = KomentarKamar::HitungRating($id)->first(); 

        return view('pesan_homestay.index',['total_rating'=>round($query_sum_hitung_rating->total_rating),
                                            'detail_kamar'          => $detail_kamar,
                                            'harga_kamar_sebenarnya'=>$stringfunction->rp($harga_kamar),
                                            'dp'                    =>$stringfunction->rp($detail_kamar->harga_endeso),
                                            'id'                    =>$id,
                                            'tanggal_checkin'       =>$tanggal_checkin,
                                            'tanggal_checkout'      =>$tanggal_checkout,
                                            'jumlah_orang'          =>$jumlah_orang]);
    	}
    	
    		public function store(Request $request){

   		$detail_kamar = Kamar::find($request->id_kamar);


    	 $this->validate($request, [
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'tanggal_checkin' => 'required',
            'tanggal_checkout' => 'required',
            'nama' => 'required',
            'no_telp' => 'required|numeric',
            'no_ktp' => 'required|numeric',
            'email' => 'required|email|max:255',
            'jumlah_orang'=>'required|numeric|max:'.$detail_kamar->kapasitas.''

            ]); 


    	$pesanan = PesananHomestay::status($request->id_kamar,$request->tanggal_checkin,$request->tanggal_checkout)->count();

        if ($pesanan > 0) { //jika pemesanan status dari 0 atau sudah terjadi pemesanan
        	 
        	Session::flash("flash_notification", [
              "level"=>"danger",
              "message"=>"Mohon maaf homestay di destinasi yang anda pilih sedang penuh, silahkan pilih tanggal lain"
              ]);  

        	return redirect()->back()->withInput($request->input());
		} //end jika pemesanan status dari 0 atau sudah terjadi pemesanan

      	else{
      	        $id_user = Auth::user()->id;

      	    $pesan_homestay = PesananHomestay::create([
            'id_kamar' => $request->id_kamar,
            'check_in' => HomeController::tanggal_mysql($request->tanggal_checkin),
            'check_out' => HomeController::tanggal_mysql($request->tanggal_checkout),
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'no_ktp' => $request->no_ktp,
            'email' => $request->email,
           	'total_harga' => $request->harga_total_hidden,
           	'harga_pemilik' => $request->harga_pemilik_hidden,
           	'harga_endeso' => $request->harga_endeso_hidden,
           	'harga_makan' => $request->harga_makan_hidden,
           	'jumlah_orang' => $request->jumlah_orang,
           	'jumlah_malam' => $request->jumlah_malam,
           	'id_user'=> $id_user

           ]);


// INSERT DATA TAMU

           if ($request->has('nama_tamu')) {

             $nama_tamu = $request->input('nama_tamu');

             if (is_array($nama_tamu) || is_object($nama_tamu))
            {


              foreach ($nama_tamu as $nama_tamus) {
                    # code...      
                    $tamu_homestay = TamuHomestay::create([
                      'id_pesanan' => $pesan_homestay->id,
                      'nama_tamu' => $nama_tamus
                      ]);    
                 
                }//end foreach
                
            }

          }
// INSERT DATA TAMU


         $rp = number_format($request->harga_total_hidden,0,',','.');
         $nama_pemesan = Auth::user()->name;
         $kamar = Kamar::with('rumah')->find($request->id_kamar); 
         $rumah = Rumah::with('destinasi')->find($kamar->id_rumah);
         $chat_id = env('CHAT_ID'); 
         $response = Telegram::sendMessage([
            'chat_id' => $chat_id , 
            'text' => "Pelanggan Baru Saja Melakukan Pemesanan (HOMESTAY).\n Nama Pemilik Rumah : $rumah->nama_pemilik \n Nomor Pesanan : $pesan_homestay->id \n Nama Pemesanan : $nama_pemesan \n Tanggal Check In : $request->tanggal_checkin \n Tanggal Check Out : $request->tanggal_checkout \n Nama Pelanggan : $request->nama \n Nomor Telefone : $request->no_telp \n Nomor Ktp : $request->no_ktp \n Email : $request->email \n Total Harga : Rp. $rp \n Jumlah Orang : $request->jumlah_orang Orang \n Jumlah Malam : $request->jumlah_malam Malam"
          ]);

      	    Session::flash("flash_notification", [
              "level"=>"success",
              "message"=>"Data Pemesanan Anda Berhasil Tersimpan , Silakan Konfirmasi Pembayaran di Email Anda"
              ]);

            $rekening_tujuan = Rekening::all();
            if ($kamar->tipe_harga == 1) {

                  $total_harga_endeso = $request->harga_endeso_hidden * $request->jumlah_orang * $request->jumlah_malam;
            }
            elseif ($kamar->tipe_harga == 2) {

              $total_harga_endeso = $request->harga_endeso_hidden  * $request->jumlah_malam;
            }
      	
      	   $email_satu = PesananHomestay::sendInvoice($total_harga_endeso,$pesan_homestay->id,$rekening_tujuan,$request->email,$request->nama

);

             

          return redirect('/pembayaran-homestay/'.$pesan_homestay->id.'');

      	}//else penutup pesanan masih tercukupi

    			
    	}
 }