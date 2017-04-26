<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Session; 
use App\PesananCulture;
use App\PembayaranCulture;
use Illuminate\Support\Facades\DB;
use App\Warga; 
use DateTime;
use App\Rekening;
use Auth;
use File;

class PembayaranCulturalController extends Controller
{
    //

    public function pembayaran_culture($id,$destinasi,$aktivitas){     

      $pesanan_culture = PesananCulture::where('id',$id)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_culture->check_in);
      $format_check_in = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_culture->created_at);
      $waktu_pesan = $created_ats->format('j M Y');
      $rekening = Rekening::select('id','nama_bank','nama_rekening_tabungan','nomor_rekening_tabungan')->limit(1)->first();
      $warga = Warga::select('id','harga_endeso','harga_pemilik')->where('id',$pesanan_culture->id_warga)->first();

      return view('pembayaran_cultural.index',['pesanan_culture'=>$pesanan_culture,'check_in'=>$check_in,'format_check_in'=>$format_check_in,'created_ats'=>$created_ats,'waktu_pesan'=>$waktu_pesan,'aktivitas'=>$aktivitas,'destinasi'=>$destinasi,'rekening'=>$rekening,'warga'=>$warga]);
    } 
    
    public function transaksi_pembayaran_culture($id,$destinasi,$aktivitas){ 
      $pesanan_culture = PesananCulture::where('id',$id)->first();

      $check_in = DateTime::createFromFormat('Y-m-d', $pesanan_culture->check_in);
      $format_check_in = $check_in->format('j M Y');

      $created_ats = DateTime::createFromFormat('Y-m-d H:i:s', $pesanan_culture->created_at);
      $waktu_pesan = $created_ats->format('j M Y'); 
      $warga = Warga::select('id','harga_endeso','harga_pemilik')->where('id',$pesanan_culture->id_warga)->first();

      return view('pembayaran_cultural.transaksi_pembayaran',['pesanan_culture'=>$pesanan_culture,'check_in'=>$check_in,'format_check_in'=>$format_check_in,'created_ats'=>$created_ats,'waktu_pesan'=>$waktu_pesan,'aktivitas'=>$aktivitas,'destinasi'=>$destinasi,'warga'=>$warga]);
    }

    public function proses_transaksi_pembayaran_culture(Request $request){
        $this->validate($request, [
            'nomor_rekening_pelanggan' => 'required',
            'nama_bank_pelanggan' => 'required',
            'id_pesanan' => '',    
            'foto_tanda_bukti' => 'image|max:2048|required'    
            ]); 

        $id_user = Auth::user()->id;
        $pesanan_culture = PembayaranCulture::create([
           'id_user' => $id_user,
           'id_pesanan' => $request->id_pesanan,
           'id_rekening_endeso' => '1',
           'nomor_rekening_pelanggan' => $request->nomor_rekening_pelanggan,
           'nama_bank_pelanggan' => $request->nama_bank_pelanggan,  
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
        } 

        return redirect('/user/pesanan');
        } 
}