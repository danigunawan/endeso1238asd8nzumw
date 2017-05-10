<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables; 
use App\PesananHomestay;
use App\PesananCulture;
Use App\Kamar;
Use App\Rumah;
use Session;
use Auth; 

class PemesananController extends Controller
{
    //
    public function index(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

             $pesanan_cultural = PesananCulture::with(['warga','user']);

            return Datatables::of($pesanan_cultural)

            ->addColumn('action',function($pesanan_cultural){
            return view('pemesanan._action', [
                    'model'=> $pesanan_cultural,
                    'check_in' => route('pemesanan.cultural_check_in', $pesanan_cultural->id),
                    'check_out' => route('pemesanan.cultural_check_out', $pesanan_cultural->id)
                    ]);})
            
            ->addColumn('status_pesanan',function($pesanan_status){
                $status_pesanan = "status_pesanan";
                if ($pesanan_status->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru Saja Melakukan Pemesanan";
                }
                elseif ($pesanan_status->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan Telah Mengkonfirmasi Pembayaran";
                }
                elseif ($pesanan_status->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Pembayaran Sudah Dikonfirmasi Admin";
                } 
                elseif ($pesanan_status->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan Check In";
                } 
                elseif ($pesanan_status->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan Check Out";
                } 
                elseif ($pesanan_status->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan Membatalkan Pesanan";
                } 
                return $status_pesanan; 
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Booking'])  
            ->addColumn(['data' => 'warga.nama_warga', 'name'=>'warga.nama_warga', 'title'=>'Nama Warga'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Nama Pemesan'])   
            ->addColumn(['data' => 'check_in', 'name'=>'check_in', 'title'=>'Check In'])  
            ->addColumn(['data' => 'jadwal', 'name'=>'jadwal', 'title'=>'Jadwal'])  
            ->addColumn(['data' => 'no_ktp', 'name'=>'no_ktp', 'title'=>'No KTP'])  
            ->addColumn(['data' => 'no_telp', 'name'=>'no_telp', 'title'=>'No HP'])  
            ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])  
            ->addColumn(['data' => 'total_harga', 'name'=>'total_harga', 'title'=>'Total Harga'])  
            ->addColumn(['data' => 'jumlah_orang', 'name'=>'jumlah_orang', 'title'=>'Jumlah Orang'])  
            ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'Status' , 'searchable'=>true]) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'' , 'searchable'=>false])
            ->addColumn(['data' => 'created_at', 'name'=>'created_at', 'title'=>'Waktu dipesan']); 

            return view('pemesanan.index')->with(compact('html'));

    }

        public function status_pesanan_cultural(Request $request, Builder $htmlBuilder,$id)
    {
        if ($request->ajax()) {


        $pesanan_cultural = PesananCulture::with(['warga','user'])->where('status_pesanan',$id);

            return Datatables::of($pesanan_cultural)

            ->addColumn('action',function($pesanan_cultural){
            return view('pemesanan._action', [
                    'model'=> $pesanan_cultural,
                    'check_in' => route('pemesanan.cultural_check_in', $pesanan_cultural->id),
                    'check_out' => route('pemesanan.cultural_check_out', $pesanan_cultural->id)
                    ]);})
            
            ->addColumn('status_pesanan',function($pesanan_status){
                $status_pesanan = "status_pesanan";
                if ($pesanan_status->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru Saja Melakukan Pemesanan";
                }
                elseif ($pesanan_status->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan Telah Mengkonfirmasi Pembayaran";
                }
                elseif ($pesanan_status->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Pembayaran Sudah Dikonfirmasi Admin";
                } 
                elseif ($pesanan_status->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan Check In";
                } 
                elseif ($pesanan_status->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan Check Out";
                } 
                elseif ($pesanan_status->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan Membatalkan Pesanan";
                } 
                return $status_pesanan; 
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])  
            ->addColumn(['data' => 'warga.nama_warga', 'name'=>'warga.nama_warga', 'title'=>'Nama Warga'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Nama Pemesan'])   
            ->addColumn(['data' => 'check_in', 'name'=>'check_in', 'title'=>'Check In'])  
            ->addColumn(['data' => 'jadwal', 'name'=>'jadwal', 'title'=>'Jadwal'])  
            ->addColumn(['data' => 'harga_endeso', 'name'=>'harga_endeso', 'title'=>'Harga Endeso'])  
            ->addColumn(['data' => 'harga_pemilik', 'name'=>'harga_pemilik', 'title'=>'Harga Pemilik'])  
            ->addColumn(['data' => 'total_harga', 'name'=>'total_harga', 'title'=>'Total Harga'])  
            ->addColumn(['data' => 'jumlah_orang', 'name'=>'jumlah_orang', 'title'=>'Jumlah Orang'])  
            ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'Status' , 'searchable'=>false]) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'' , 'searchable'=>false])
            ->addColumn(['data' => 'created_at', 'name'=>'created_at', 'title'=>'Waktu dipesan']) ; 

            return view('pemesanan.index')->with(compact('html'));
    }


    public function cultural_check_in($id){ 

            $pesanan_cultural = PesananCulture::find($id);   
            $pesanan_cultural->status_pesanan = 3;
            $pesanan_cultural->save();   

        return back();
    }
    
    public function cultural_check_out($id){ 

            $pesanan_cultural = PesananCulture::find($id);   
            $pesanan_cultural->status_pesanan = 4;
            $pesanan_cultural->sendCheckout($pesanan_cultural);
            $pesanan_cultural->save();   

        return back();
    }

    public function cultural_batal($id){ 

            $pesanan_cultural = PesananCulture::find($id);   
            $pesanan_cultural->status_pesanan = 5;
            $pesanan_cultural->save();   

        return back();
    }

    public function datatable_pesanan_homestay(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

             $pesanan_homestay = PesananHomestay::with(['kamar','user']);

            return Datatables::of($pesanan_homestay)

            ->addColumn('action',  function($check){    

                if ($check->status_pesanan == 2 ) {
                    # code belum nampil
                  
                return '<a href="pemesanan/homestay/check_in/'.$check->id.'" class="btn btn-primary">Check in<a>';
                }
                elseif ($check->status_pesanan == 3) {
                    # code belum nampil
                  
                return '<a href="pemesanan/homestay/check_out/'.$check->id.'" class="btn btn-danger">Check Out<a>';
                }           
 
            })

            ->addColumn('nama_pemilik', function($pesanan_homestay){
                $kamar = Kamar::select('id_rumah')->find($pesanan_homestay->id_kamar); 
                $rumah = Rumah::select('nama_pemilik')->find($kamar->id_rumah);
                return $rumah->nama_pemilik; 
            })

            ->addColumn('status_pesanan',function($pesanan_status){
                $status_pesanan = "status_pesanan";
                if ($pesanan_status->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "Pelanggan Baru Saja Melakukan Pemesanan";
                }
                elseif ($pesanan_status->status_pesanan == 1) {
                    # code...
                     $status_pesanan = "Pelanggan Telah Mengkonfirmasi Pembayaran";
                }
                elseif ($pesanan_status->status_pesanan == 2) {
                    # code...
                     $status_pesanan = "Pembayaran Sudah Dikonfirmasi";
                } 
                elseif ($pesanan_status->status_pesanan == 3) {
                    # code...
                     $status_pesanan = "Pelanggan Check In";
                } 
                elseif ($pesanan_status->status_pesanan == 4) {
                    # code...
                     $status_pesanan = "Pelanggan Check Out";
                } 
                elseif ($pesanan_status->status_pesanan == 5) {
                    # code...
                     $status_pesanan = "Pelanggan Membatalkan Pesanan";
                } 
                return $status_pesanan; 
                })->rawColumns(['action'])->make(true);
            }  
    }  
    
    public function homestay_check_in($id){ 

            $pesanan_homestay = PesananHomestay::find($id);   
            $pesanan_homestay->status_pesanan = 3;
            $pesanan_homestay->save();   

        return back();
    }
    
    public function homestay_check_out($id){ 

            $pesanan_homestay = PesananHomestay::find($id);   
            $pesanan_homestay->status_pesanan = 4;
            $pesanan_homestay->sendCheckout($pesanan_homestay);
            $pesanan_homestay->save();   

        return back();
    }

    public function homestay_batal($id){ 

            $pesanan_homestay = PesananHomestay::find($id);   
            $pesanan_homestay->status_pesanan = 5;
            $pesanan_homestay->save();   

        return back();
    }
}