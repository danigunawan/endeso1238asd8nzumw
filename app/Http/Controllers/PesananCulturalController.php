<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Warga;
use App\PesananCulture;
use Session;
use App\Rekening;
use Auth;
use App\Destinasi;
use App\TamuCulture;

class PesananCulturalController extends Controller
{
    //
    public function index($id, $tanggal_masuk,$jumlah_orang){
    	$detail_kategori = Kategori::find($id);        
            $warga = Warga::where('id_kategori_culture',$detail_kategori->id)->pluck('nama_warga','id'); 

    	return view('pesan_cultural.index', ['detail_kategori' => $detail_kategori, 'id' => $id, 'tanggal_masuk' => $tanggal_masuk,'jumlah_orang' => $jumlah_orang,'warga'=>$warga]);
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


        $pesanan = PesananCulture::status($request->id_warga,$request->jadwal,$request->check_in)->sum('jumlah_orang');
        $sisa_pesanan = $warga->kapasitas - $pesanan;

          if ($sisa_pesanan >= $request->jumlah_orang ) {
            $pesanan_culture = PesananCulture::create([
            'id_warga' => $request->id_warga,
            'check_in' => HomeController::tanggal_mysql($request->check_in), 
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'no_ktp' => $request->no_ktp,
            'email' => $request->email,
            'jadwal' => $request->jadwal,
            'harga_pemilik' => $warga->harga_pemilik,
            'harga_endeso' => $warga->harga_endeso, 
            'jumlah_orang' => $request->jumlah_orang, 
            'total_harga' => ($warga->harga_pemilik + $warga->harga_endeso) * $request->jumlah_orang,
            'id_user'=> $id_user

           ]); 

        if ($request->jumlah_orang > 1){
            // INSERT DATA TAMU


           if ($request->has('nama_tamu')) {

             $nama_tamu = $request->input('nama_tamu');

             if (is_array($nama_tamu) || is_object($nama_tamu))
            {


              foreach ($nama_tamu as $nama_tamus) {
                    # code...      
                    $tamu_culture = TamuCulture::create([
                      'id_pesanan' => $pesanan_culture->id,
                      'nama_tamu' => $nama_tamus
                      ]);    
                 
                }//end foreach
                
            }

          }
        // INSERT DATA TAMU
        }

            Session::flash("flash_notification", [
              "level"=>"success",
              "message"=>"Data Pemesanan Anda Berhasil Tersimpan , Silakan Konfirmasi Pembayaran Di Email Anda"
            ]);

            $rekening_tujuan = Rekening::all();
            $total_harga_endeso = $warga->harga_endeso * $request->jumlah_orang;
            PesananCulture::sendInvoice($total_harga_endeso,$pesanan_culture->id,$rekening_tujuan);
        
        return redirect('/pembayaran_culture/'.$pesanan_culture->id.'');         
        }
        else{
            Session::flash("flash_notification", [
              "level"=>"danger",
              "message"=>"Mohon Maaf Warga Di Cultural Yang Anda Pilih Sedang Penuh, Silahkan Pilih Jadwal Atau Warga Lain"
              ]);  

            return redirect()->back()->withInput($request->input());
        } 
    }

    public function ajax_data_warga(Request $request)
    { 
        if ($request-> ajax()) {
            # code...
            $id_warga = $request->id_warga;
            $warga = Warga::find($id_warga); 
            return $warga;

        } 
    }
}