<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use App\PesananHomestay;
use App\Kamar;
use Http\Controller\Auth\StringController;
use App\PembayaranHomestay;
use Auth;

class PembayaranController extends Controller
{
    //
    public function index($id){

    	$rekening = Rekening::select('id','nama_bank','nama_rekening_tabungan','nomor_rekening_tabungan')->limit(1)->first();
    	$detail_pesanan = PesananHomestay::find($id);
        $kamar = Kamar::with(['rumah'])->find($detail_pesanan->id_kamar);

     return view('pembayaran_homestay.index',['id'=>$id,'detail_pesanan'=>$detail_pesanan,'rekening'=>$rekening,'kamar'=>$kamar]);

    }

        public function transaksi_pembayaran_culture($id){

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

            $pembayaran_homestay_count = PembayaranHomestay::where('id_pesanan',$request->id_pesanan)->count();

        if ($pembayaran_homestay_count > 0){


            $id_user = Auth::user()->id;
            $pembayaran_homestay_update = PembayaranHomestay::where('id_pesanan',$request->id_pesanan);
            $pembayaran_homestay_update->update([
           'id_user' => $id_user,
           'nomor_rekening_pelanggan' => $request->nomor_rekening_pelanggan,
           'nama_bank_pelanggan' => $request->nama_bank_pelanggan,
           'status_pembayaran' => "0"
           ]);
            
            if ($request->hasFile('foto_tanda_bukti')) {
                 // menambil foto_tanda_bukti yang diupload berikut ekstensinya

                $filename = null;
                $uploaded_foto_tanda_bukti = $request->file('foto_tanda_bukti');
                $extension = $uploaded_foto_tanda_bukti->getClientOriginalExtension();
                // membuat nama file random dengan extension
                $filename = md5(time()) . '.' . $extension;
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                // memindahkan file ke folder public/img
                $uploaded_foto_tanda_bukti->move($destinationPath, $filename);
                // hapus foto_tanda_bukti lama, jika ada
                if ($pembayaran_homestay_update->foto_tanda_bukti) {
                $old_foto_tanda_bukti = $pembayaran_homestay_update->foto_tanda_bukti;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $pembayaran_homestay_update->foto_tanda_bukti;
                try {
                File::delete($filepath);
                } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
                }
                }
        // ganti field foto_tanda_bukti dengan cover yang baru

        $pembayaran_homestay_update->foto_tanda_bukti = $filename;
        $pembayaran_homestay_update->save();
            }
            
        return redirect('/user/pesanan');

        } //if ($pesanan->id != $request->id_pesanan ){
        else{

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

        }//else ($pesanan->id == $request->id_pesanan ){

    }


}
 