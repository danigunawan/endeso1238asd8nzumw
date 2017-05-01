<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use App\PesananHomestay;
use App\Kamar;
use Http\Controller\Auth\StringController;
use App\PembayaranHomestay;
use Auth;
use DateTime;
use Session;
class PembayaranController extends Controller
{
    //
    public function index($id){

    	$rekening = Rekening::select('id','nama_bank','nama_rekening_tabungan','nomor_rekening_tabungan')->limit(1)->first();
    	$detail_pesanan = PesananHomestay::find($id);
        $kamar = Kamar::with(['rumah'])->find($detail_pesanan->id_kamar);

        $datetime1 = new DateTime();
        $datetime2 = new DateTime($detail_pesanan->created_at);
        $interval = $datetime1->diff($datetime2);
        $time_diff_jam = $interval->format('%H');
        $time_diff_minutes = $interval->format('%i');
    
        if ($time_diff_jam >= 1){
            $pesanan =  PesananHomestay::find($id);
            $pesanan->status_pesanan = 5; 
            $pesanan->save();

            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Transaksi Ini Telah Melebihi Batas Waktu yang ditentukan "
        ]);

             return redirect()->back();
        }
        else{
            if ($time_diff_minutes > 30){
            
            $pesanan =  PesananHomestay::find($id);
            $pesanan->status_pesanan = 5; 
            $pesanan->save();

            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Transaksi Ini Telah Melebihi Batas Waktu yang ditentukan "
            ]);

             return redirect()->back();

            }
            else{
            $time_diff_minutes = 30 - $time_diff_minutes;

            return view('pembayaran_homestay.index',['id'=>$id,'detail_pesanan'=>$detail_pesanan,'rekening'=>$rekening,'kamar'=>$kamar,'time_diff'=>$time_diff_minutes]);
            }
        }
    }

        public function transaksi_pembayaran_homestay($id){

    	$rekening = Rekening::select('id','nama_bank','nama_rekening_tabungan','nomor_rekening_tabungan')->limit(1)->first();
    	$detail_pesanan = PesananHomestay::find($id);
        $kamar = Kamar::with(['rumah'])->find($detail_pesanan->id_kamar);
        


     return view('pembayaran_homestay.transaksi_pembayaran',['id'=>$id,'detail_pesanan'=>$detail_pesanan,'rekening'=>$rekening,'kamar'=>$kamar]);

    }

     public function store(Request $request){
        $this->validate($request, [
            'nomor_rekening_pelanggan' => 'required',
            'nama_bank_pelanggan' => 'required',
            'foto_tanda_bukti' => 'image|max:2048|required'    
            ]); 

            $pesanan =  PesananHomestay::find($request->id_pesanan);
            $pesanan->status_pesanan = 1; 
            $pesanan->save();

            $id_user = Auth::user()->id;
            $pembayaran_homestay_insert = PembayaranHomestay::create([
           'id_user' => $id_user,
           'id_pesanan' => $request->id_pesanan,
           'nomor_rekening_pelanggan' => $request->nomor_rekening_pelanggan,
           'nama_bank_pelanggan' => $request->nama_bank_pelanggan,
           'status_pembayaran' => "0",
  
        ]);
         // isi field foto_tanda_bukti jika ada foto_tanda_bukti yang diupload
        if ($request->hasFile('foto_tanda_bukti')) {
        // Mengambil file yang diupload
        $uploaded_foto_tanda_bukti = $request->file('foto_tanda_bukti');
        // mengambil extension file
        $extension = $uploaded_foto_tanda_bukti->getClientOriginalExtension();
        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;
        // menyimpan foto_tanda_bukti ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_foto_tanda_bukti->move($destinationPath, $filename);
        // mengisi field foto_tanda_bukti di destinasi dengan filename yang baru dibuat
        $pembayaran_homestay_insert->foto_tanda_bukti = $filename;
        $pembayaran_homestay_insert->save();
        } 
            
          return redirect('/user/pesanan');

     
    }


      public function status_pesanan(Request $request)
    { 

     $id = $request->id_pesanan;
        $pesanan =  PesananHomestay::find($id);
        $pesanan->status_pesanan = 5; 
        $pesanan->save(); 
    }


}
 