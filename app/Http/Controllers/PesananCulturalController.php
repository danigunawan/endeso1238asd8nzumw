<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Warga;
use App\PesananCulture;
use Session;
use Auth;
use App\Destinasi;

class PesananCulturalController extends Controller
{
    //
    public function index($id, $tanggal_masuk,$jumlah_orang){
    	$detail_kategori = Kategori::find($id);

    	return view('pesan_cultural.index', ['detail_kategori' => $detail_kategori, 'id' => $id, 'tanggal_masuk' => $tanggal_masuk,'jumlah_orang' => $jumlah_orang]);
    }

    public function store(Request $request){

        $warga = Warga::find($request->id_warga); 
        $kategori = Kategori::select('id','nama_aktivitas','destinasi_kategori')->where('id',$warga->id_kategori_culture)->first();
        $destinasi = Destinasi::select('id','nama_destinasi')->where('id',$kategori->destinasi_kategori)->first();
        $id_user = Auth::user()->id;

         $this->validate($request, [
            'id_warga' => 'required|exists:warga,id',
            'jadwal' => 'required',
            'check_in' => 'required',
            'nama' => 'required',
            'no_telp' => 'required|numeric',
            'no_ktp' => 'required|numeric',
            'email' => 'required|email|max:255',
            'jumlah_orang'=>'required|numeric|max:'.$warga->kapasitas.''

            ]); 

            $pesanan_culture = PesananCulture::create([
            'id_warga' => $request->id_warga,
            'check_in' => HomeController::tanggal_mysql($request->check_in), 
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'no_ktp' => $request->no_ktp,
            'email' => $request->email,
            'jadwal' => $request->jadwal,
            'total_harga' => $warga->harga_pemilik + $warga->harga_endeso,
            'harga_pemilik' => $warga->harga_pemilik,
            'harga_endeso' => $warga->harga_endeso, 
            'jumlah_orang' => $request->jumlah_orang, 
            'id_user'=> $id_user

           ]);
 
            Session::flash("flash_notification", [   
            "level"=>"success",
            "message"=>"Data Pemesanan Anda Berhasil Tersimpan,Silakan
            Konfirmasi Pembayaran di Email Anda"]); 
            return redirect('/pembayaran_culture/'.$pesanan_culture->id.'/'.$destinasi->nama_destinasi.'/'.$kategori->nama_aktivitas.''); 

    }

    public function ajax_jadwal_kegiatan(Request $request)
    { 
        if ($request-> ajax()) {
            # code...
            $id_warga = $request->id_warga;
            $warga = Warga::find($id_warga); 
            return $warga->jadwal_1;

        } 
    }

}