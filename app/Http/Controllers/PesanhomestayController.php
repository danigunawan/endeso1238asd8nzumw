<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kamar;
use App\PesananHomestay;
use Session;
use Auth;
use App\Http\Controllers\HomeController;
use App\Rekening;


class PesanhomestayController extends Controller
{
    //

           public function index($id,$tanggal_checkin,$tanggal_checkout,$jumlah_orang){   
        $detail_kamar = Kamar::with(['rumah'])->find($id);
        return view('pesan_homestay.index',['detail_kamar' => $detail_kamar,'id'=>$id,'tanggal_checkin'=>$tanggal_checkin,'tanggal_checkout'=>$tanggal_checkout,'jumlah_orang'=>$jumlah_orang]);
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

      	    Session::flash("flash_notification", [
              "level"=>"success",
              "message"=>"Data Pemesanan Anda Berhasil Tersimpan , Silakan Konfirmasi Pembayaran di Email Anda"
              ]);
                
      	    $rekening_tujuan = Rekening::all();
      	    $total_harga_endeso = $request->harga_endeso_hidden * $request->jumlah_orang * $request->jumlah_malam;
      	    PesananHomestay::sendInvoice($total_harga_endeso,$pesan_homestay->id,$rekening_tujuan);

      	  return view('pencarian_cultur',['lis_cultural'=>$lis_cultural]);

      	}//else penutup pesanan masih tercukupi

    			
    	}
 }