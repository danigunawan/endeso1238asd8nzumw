<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use App\PesananHomestay;
use App\Kamar;
use Http\Controller\Auth\StringController;
use App\PembayaranHomestay;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables; 
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
        $kamar = Kamar::with('rumah')->find($detail_pesanan->id_kamar);
        


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
           'nama_bank_tujuan' => $request->nama_bank_tujuan,
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

        public function konfirmasi(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

             $pembayaran_homestay = PembayaranHomestay::with('pemesanan_homestay');

            return Datatables::of($pembayaran_homestay)->addColumn('status_pesanan',function($pesanan_status){
                $status_pesanan = "status_pesanan";
                if ($pesanan_status->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru saja melakukan pemesanan";
                }
                elseif ($pesanan_status->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan telah mengkonfirmasi pembayaran";
                }
                elseif ($pesanan_status->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Admin telah mengkonfirmasi pembayaran";
                } 
                elseif ($pesanan_status->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check In";
                } 
                elseif ($pesanan_status->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check Out";
                } 
                elseif ($pesanan_status->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan telah membatalkan pesanan";
                } 
                return $status_pesanan; 
                })->addColumn('foto_tanda_bukti',function($foto_transfer){
                return view('pembayaran_homestay.foto_bukti', [
                        'foto_transfer'=> $foto_transfer
                         ]);
                })->rawColumns(['foto_tanda_bukti'])
                ->addColumn('action',function($foto_transfer){
                return view('pembayaran_homestay._action', [
                        'foto_transfer'=> $foto_transfer
                         ]);
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'id_pesanan', 'name'=>'id_pesanan', 'title'=>'ID Pesanan'])  
            ->addColumn(['data' => 'pemesanan_homestay.nama', 'name'=>'pemesanan_homestay.nama', 'title'=>'Nama Pemesan'])  
              ->addColumn(['data' => 'nomor_rekening_pelanggan', 'name'=>'nomor_rekening_pelanggan', 'title'=>'No Rekening Pelanggan'])  
               ->addColumn(['data' => 'nama_bank_pelanggan', 'name'=>'nama_bank_pelanggan', 'title'=>'Nama Bank Pelanggan'])
                ->addColumn(['data' => 'nama_bank_tujuan', 'name'=>'nama_bank_tujuan', 'title'=>'Nama Bank Tujuan'])
                 ->addColumn(['data' => 'foto_tanda_bukti', 'name'=>'foto_tanda_bukti', 'title'=>'Foto Bukti Transfer'])   
                    ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'Status Pesanan' , 'searchable'=>false]);


            return view('pembayaran_homestay.konfirmasi_pembayaran')->with(compact('html'));

    }


    



}
 