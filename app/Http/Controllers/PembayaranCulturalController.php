<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Session; 
use App\PesananCulture;
use App\PembayaranCulture;
use Illuminate\Support\Facades\DB;
use App\Warga; 
use App\Kategori; 
use App\Destinasi; 
use DateTime;
use App\Rekening;
use Auth;
use File;
use Telegram;

class PembayaranCulturalController extends Controller
{
    //

    public function pembayaran_culture($id){     

      $pesanan_culture = PesananCulture::where('id',$id)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_culture->check_in);
      $format_check_in = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_culture->created_at);
      $waktu_pesan = $created_ats->format('j M Y');
      $rekening = Rekening::all();
      $warga = Warga::select('id','harga_endeso','harga_pemilik', 'id_kategori_culture')->where('id',$pesanan_culture->id_warga)->first();
      $kategori = Kategori::select('nama_aktivitas', 'destinasi_kategori')->where('id',$warga->id_kategori_culture)->first();
      $destinasi = Destinasi::select('nama_destinasi')->where('id',$kategori->destinasi_kategori)->first();

      $datetime1 = new DateTime();
      $datetime2 = new DateTime($pesanan_culture->created_at);
      $interval = $datetime1->diff($datetime2);
      $time_diff_jam = $interval->format('%H');
      $time_diff_minutes = $interval->format('%i');

      if ($time_diff_jam >= 1){
            $pesanan =  PesananCulture::find($id);
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
            
            $pesanan =  PesananCulture::find($id);
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

            return view('pembayaran_cultural.index',['id'=>$id,'pesanan_culture'=>$pesanan_culture,'check_in'=>$check_in,'format_check_in'=>$format_check_in,'created_ats'=>$created_ats,'waktu_pesan'=>$waktu_pesan,'aktivitas'=>$kategori->nama_aktivitas,'destinasi'=>$destinasi->nama_destinasi,'rekening'=>$rekening,'warga'=>$warga, 'time_diff'=>$time_diff_minutes]);
            }
        }

    } 
    
    public function transaksi_pembayaran_culture($id){ 
      $pesanan_culture = PesananCulture::where('id',$id)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_culture->check_in);
      $format_check_in = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_culture->created_at);
      $waktu_pesan = $created_ats->format('j M Y'); 
      $warga = Warga::select('id','harga_endeso','harga_pemilik', 'id_kategori_culture')->where('id',$pesanan_culture->id_warga)->first();
      $kategori = Kategori::select('nama_aktivitas', 'destinasi_kategori')->where('id',$warga->id_kategori_culture)->first();
      $destinasi = Destinasi::select('nama_destinasi')->where('id',$kategori->destinasi_kategori)->first();

      return view('pembayaran_cultural.transaksi_pembayaran',['pesanan_culture'=>$pesanan_culture,'check_in'=>$check_in,'format_check_in'=>$format_check_in,'created_ats'=>$created_ats,'waktu_pesan'=>$waktu_pesan,'aktivitas'=>$kategori->nama_aktivitas,'destinasi'=>$destinasi->nama_destinasi,'warga'=>$warga]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'nomor_rekening_pelanggan' => 'required',
            'nama_bank_pelanggan' => 'required',
            'atas_nama_rekening_pengirim' => 'required',
            'nama_bank_tujuan' => 'required',  
            'foto_tanda_bukti' => 'image|max:2048|required'
            ]); 

            $pesanan =  PesananCulture::find($request->id_pesanan);
            $pesanan->status_pesanan = 1; 
            $pesanan->save();

         $id_user = Auth::user()->id;
        $pesanan_culture = PembayaranCulture::create([
           'id_user' => $id_user,
           'id_pesanan' => $request->id_pesanan, 
           'nomor_rekening_pelanggan' => $request->nomor_rekening_pelanggan,
           'atas_nama_rekening_pelanggan' => $request->atas_nama_rekening_pengirim,
           'nama_bank_pelanggan' => $request->nama_bank_pelanggan,
           'nama_bank_tujuan' => $request->nama_bank_tujuan,  
           'status' => "0",
        ]);

         $nama_pemesan = Auth::user()->name; 
         $rekening = Rekening::find($request->nama_bank_tujuan);
         $chat_id = env('CHAT_ID'); 
         $response = Telegram::sendMessage([
            'chat_id' => $chat_id , 
            'text' => "Pelanggan Baru Saja Melakukan Pembayaran (CULTURAL). \n Nomor Pesanan : $request->id_pesanan \n Nama Pemesanan : $nama_pemesan \n Nomor Rekening Pelanggan : $request->nomor_rekening_pelanggan \n Nama Bank Pelanggan : $request->nama_bank_pelanggan \n Atas Nama Rekening Pengirim : $request->atas_nama_rekening_pengirim \n Nama Bank Tujuan : $rekening->nama_bank"
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
        $pesanan_culture->foto_tanda_bukti = $filename;
        $pesanan_culture->save();
        $lokasi_foto = $destinationPath."/".$filename;

        $sendPhoto = Telegram::sendPhoto([
        'chat_id' => $chat_id , 
        'photo' => $lokasi_foto, 
        'caption' =>  "Tanda Bukti Pembayaran (CULTURAL) \n Nomor Pesanan : $request->id_pesanan"
        ]);
        } 
        return redirect('/user/pesanan');
        
    }

  public function status_pesanan_cultural(Request $request){
        $id = $request->id_pesanan;
        $pesanan_cultural =  PesananCulture::find($id);
        $pesanan_cultural->status_pesanan = 5; 
        $pesanan_cultural->save(); 
    }

}