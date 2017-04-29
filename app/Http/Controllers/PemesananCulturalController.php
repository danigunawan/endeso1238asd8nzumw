<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Kategori;
use App\Warga;
use App\PesananCulture;
use Session;
use Auth;
use App\Destinasi;

class PemesananCulturalController extends Controller
{
    //
    public function index(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

             $pesanan_cultural = PesananCulture::with(['warga','user']);

            return Datatables::of($pesanan_cultural)->addColumn('status_pesanan',function($pesanan_status){
                $status_pesanan = "status_pesanan";
                if ($pesanan_status->status_pesanan == 0 ) {
                    # code...
                    $status_pesanan = "baru saja melakukan pemesanan";
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
                     $status_pesanan = "Pelanggan telah membatalkan pesanan anda";
                } 
                return $status_pesanan; 
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'warga.nama_warga', 'name'=>'warga.nama_warga', 'title'=>'Nama Warga'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Nama Pemesan'])   
            ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'Status' , 'searchable'=>false]); 

            return view('pesanan_cultural.index')->with(compact('html'));

    }
}