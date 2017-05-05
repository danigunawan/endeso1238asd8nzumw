<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use App\PesananHomestay;
use App\PesananCulture;
use App\PembayaranHomestay;
use App\PembayaranCulture;
use App\Kamar;
use App\Warga;
use App\Kategori;
use Http\Controller\Auth\StringController;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables; 
use Auth;
use DateTime;
use Session;


class PembayaranController extends Controller
{
    //
    public function index($id){

    	$rekening = Rekening::all();
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

    	$rekening = Rekening::all();
    	$detail_pesanan = PesananHomestay::find($id);
        $kamar = Kamar::with('rumah')->find($detail_pesanan->id_kamar);
        


     return view('pembayaran_homestay.transaksi_pembayaran',['id'=>$id,'detail_pesanan'=>$detail_pesanan,'rekening'=>$rekening,'kamar'=>$kamar]);

    }

     public function store(Request $request){
        $this->validate($request, [
            'nomor_rekening_pelanggan' => 'required',
            'atas_nama_rekening_pengirim' => 'required',
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
           'atas_nama_rekening_pelanggan' => $request->atas_nama_rekening_pengirim,
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

             $pembayaran_homestay = PembayaranHomestay::with('pemesanan_homestay','rekening_bank_pelanggan','rekening_bank_tujuan');

            return Datatables::of($pembayaran_homestay)->addColumn('status_pesanan',function($pesanan_status){
                if ($pesanan_status->pemesanan_homestay->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru saja melakukan pemesanan";
                }
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan telah mengkonfirmasi pembayaran";
                }
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Admin telah mengkonfirmasi pembayaran";
                } 
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check In";
                } 
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check Out";
                } 
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan telah membatalkan pesanan";
                } 
                return $status_pesanan; 

                })->addColumn('foto_tanda_bukti',function($foto_transfer){
                return view('pembayaran_homestay.foto_bukti', [
                        'foto_transfer'=> $foto_transfer
                         ]);
                })->addColumn('action',function($pembayaran_homestay){
                        return view('pembayaran_homestay._action', [
                    'model'=> $pembayaran_homestay,
                    'terima' => route('konfirmasi_pembayaran.homestay_terima', $pembayaran_homestay->id),
                    'tolak' => route('konfirmasi_pembayaran.homestay_tolak', $pembayaran_homestay->id)
                    ]);
                })->rawColumns(['foto_tanda_bukti','action'])->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'id_pesanan', 'name'=>'id_pesanan', 'title'=>'ID Pesanan'])  
            ->addColumn(['data' => 'pemesanan_homestay.nama', 'name'=>'pemesanan_homestay.nama', 'title'=>'Nama Pemesan']) 
            ->addColumn(['data' => 'pemesanan_homestay.harga_endeso', 'name'=>'pemesanan_homestay.harga_endeso', 'title'=>'Harga Dp'])  
            ->addColumn(['data' => 'atas_nama_rekening_pelanggan', 'name'=>'atas_nama_rekening_pelanggan', 'title'=>'A.n Rekening Pemesan'])    
            ->addColumn(['data' => 'nomor_rekening_pelanggan', 'name'=>'nomor_rekening_pelanggan', 'title'=>'No Rekening Pemesan'])  
            ->addColumn(['data' => 'rekening_bank_pelanggan.nama_bank', 'name'=>'rekening_bank_pelanggan.nama_bank', 'title'=>'Nama Bank Pemesan'])
            ->addColumn(['data' => 'rekening_bank_tujuan.nama_bank', 'name'=>'rekening_bank_tujuan.nama_bank', 'title'=>'Nama Bank Tujuan'])
            ->addColumn(['data' => 'foto_tanda_bukti', 'name'=>'foto_tanda_bukti', 'title'=>'Foto Bukti'])  
            ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'  Status Pesanan'])  
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Konfirmasi Pembayaran' ,  'orderable'=>false, 'searchable'=>false]);


            return view('pembayaran_homestay.konfirmasi_pembayaran')->with(compact('html'));

    }

        public function status_pembayaran_homestay(Request $request, Builder $htmlBuilder,$id)
    {
        //

        if ($request->ajax()) {

             $pembayaran_homestay = PembayaranHomestay::with('pemesanan_homestay','rekening_bank_pelanggan','rekening_bank_tujuan')->where('status_pembayaran',$id);

            return Datatables::of($pembayaran_homestay)->addColumn('status_pesanan',function($pesanan_status){
                if ($pesanan_status->pemesanan_homestay->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru saja melakukan pemesanan";
                }
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan telah mengkonfirmasi pembayaran";
                }
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Admin telah mengkonfirmasi pembayaran";
                } 
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check In";
                } 
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check Out";
                } 
                elseif ($pesanan_status->pemesanan_homestay->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan telah membatalkan pesanan";
                } 
                return $status_pesanan; 

                })->addColumn('foto_tanda_bukti',function($foto_transfer){
                return view('pembayaran_homestay.foto_bukti', [
                        'foto_transfer'=> $foto_transfer
                         ]);
                })

                ->addColumn('action',function($pembayaran_homestay){
                        return view('pembayaran_homestay._action', [
                    'model'=> $pembayaran_homestay,
                    'terima' => route('konfirmasi_pembayaran.homestay_terima', $pembayaran_homestay->id),
                    'tolak' => route('konfirmasi_pembayaran.homestay_tolak', $pembayaran_homestay->id)
                    ]);
                })->rawColumns(['foto_tanda_bukti','action'])->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'id_pesanan', 'name'=>'id_pesanan', 'title'=>'ID Pesanan'])  
            ->addColumn(['data' => 'pemesanan_homestay.nama', 'name'=>'pemesanan_homestay.nama', 'title'=>'Nama Pemesan']) 
            ->addColumn(['data' => 'pemesanan_homestay.harga_endeso', 'name'=>'pemesanan_homestay.harga_endeso', 'title'=>'Harga Dp'])  
            ->addColumn(['data' => 'atas_nama_rekening_pelanggan', 'name'=>'atas_nama_rekening_pelanggan', 'title'=>'A.n Rekening Pemesan']) 
            ->addColumn(['data' => 'nomor_rekening_pelanggan', 'name'=>'nomor_rekening_pelanggan', 'title'=>'No Rekening Pemesan'])    
            ->addColumn(['data' => 'rekening_bank_pelanggan.nama_bank', 'name'=>'rekening_bank_pelanggan.nama_bank', 'title'=>'Nama Bank Pemesan'])
            ->addColumn(['data' => 'rekening_bank_tujuan.nama_bank', 'name'=>'rekening_bank_tujuan.nama_bank', 'title'=>'Nama Bank Tujuan'])
            ->addColumn(['data' => 'foto_tanda_bukti', 'name'=>'foto_tanda_bukti', 'title'=>'Foto Bukti'])  
            ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'  Status Pesanan'])  
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Konfirmasi Pembayaran' ,  'orderable'=>false, 'searchable'=>false]);


            return view('pembayaran_homestay.konfirmasi_pembayaran')->with(compact('html'));

    }


//ubah status konfirmasi homestay
    public function homestay_terima($id){ 

            $pembayaran_homestay = PembayaranHomestay::find($id);   
            $pembayaran_homestay->status_pembayaran = 1;
            $pembayaran_homestay->save();   


            $pesanan_homestay = PesananHomestay::find($pembayaran_homestay->id_pesanan);   
            $pesanan_homestay->status_pesanan = 2;
            $pesanan_homestay->save();

            $detail_kamar = Kamar::with('rumah')->find($pesanan_homestay->id_kamar);

            $total_harga_endeso = $pesanan_homestay->harga_endeso * $pesanan_homestay->jumlah_orang * $pesanan_homestay->jumlah_malam;
            $total_harga_seluruh = $pesanan_homestay->total_harga;
            $total_harga_warga = $total_harga_seluruh - $total_harga_endeso;

            PesananHomestay::sendPetunjukCheckin($total_harga_warga,$detail_kamar,$pesanan_homestay);


        return redirect()->back();
    }
    
    public function homestay_tolak($id){ 

            $pembayaran_homestay = PembayaranHomestay::find($id);   
            $pembayaran_homestay->status_pembayaran = 0;
            $pembayaran_homestay->save();   


            $pesanan_homestay = PesananHomestay::find($pembayaran_homestay->id_pesanan);   
            $pesanan_homestay->status_pesanan = 1;
            $pesanan_homestay->save();

        return redirect()->back();
    }
//ubah status konfirmasi homestay

    


        public function konfirmasi_pembayaran_cultural(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

             $pembayaran_cultural = PembayaranCulture::with('pemesanan_cultural','rekening_bank_pelanggan','rekening_bank_tujuan');

            return Datatables::of($pembayaran_cultural)

                ->addColumn('status_pesanan',function($pesanan_status){
                if ($pesanan_status->pemesanan_cultural->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru saja melakukan pemesanan";
                }
                elseif ($pesanan_status->pemesanan_cultural->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan telah mengkonfirmasi pembayaran";
                }
                elseif ($pesanan_status->pemesanan_cultural->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Admin telah mengkonfirmasi pembayaran";
                } 
                elseif ($pesanan_status->pemesanan_cultural->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check In";
                } 
                elseif ($pesanan_status->pemesanan_cultural->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan telah Check Out";
                } 
                elseif ($pesanan_status->pemesanan_cultural->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan telah membatalkan pesanan";
                } 
                return $status_pesanan; 

                })

                ->addColumn('action',  function($action){    

                if ($action->status  == 0 ) {
                    # code belum nampil
                  
                return '<a href="konfirmasi-pembayaran/cultural/terima/'.$action->id.'" class="btn btn-info  btn-sm">Terima</a> <a href="konfirmasi-pembayaran/cultural/tolak/'.$action->id.'" class="btn btn-danger  btn-sm">Tolak</a> ';
                }
                elseif ($action->status  == 1) {
                    # code belum nampil
                  
                return '<p style="color:red;">Sudah Konfirmasi</p>';
                }      

                }) 

                ->addColumn('foto_tanda_bukti',function($foto_transfer){
                return view('pembayaran_homestay.foto_bukti', [
                        'foto_transfer'=> $foto_transfer
                         ]);

                })->rawColumns(['foto_tanda_bukti','action'])->make(true);
            } 
    } 

//ubah status konfirmasi cultural
    public function cultural_terima($id){ 

            $pembayaran_cultural = PembayaranCulture::find($id);   
            $pembayaran_cultural->status = 1;
            $pembayaran_cultural->save();   


            $pesanan_cultural = PesananCulture::find($pembayaran_cultural->id_pesanan);   
            $pesanan_cultural->status_pesanan = 2;
            $pesanan_cultural->sendPetunjukCheckin($pesanan_cultural);
            $pesanan_cultural->save(); 

        return redirect()->back();
    }
    
    public function cultural_tolak($id){ 

            $pembayaran_cultural = PembayaranCulture::find($id);   
            $pembayaran_cultural->status = 0;
            $pembayaran_cultural->save();   


            $pesanan_cultural = PesananCulture::find($pembayaran_cultural->id_pesanan);   
            $pesanan_cultural->status_pesanan = 1;
            $pesanan_cultural->save();

        return redirect()->back();
    }
//ubah status konfirmasi cultural
}
 