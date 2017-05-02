<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables; 
use App\PesananHomestay;
use App\PesananCulture;
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

            return Datatables::of($pesanan_cultural)->addColumn('status_pesanan',function($pesanan_status){
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
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'warga.nama_warga', 'name'=>'warga.nama_warga', 'title'=>'Nama Warga'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Nama Pemesan'])   
            ->addColumn(['data' => 'status_pesanan', 'name'=>'status_pesanan', 'title'=>'Status' , 'searchable'=>false]); 

            return view('pemesanan.index')->with(compact('html'));

    }

    public function datatable_pesanan_homestay(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

             $pesanan_homestay = PesananHomestay::with(['kamar','user']);

            return Datatables::of($pesanan_homestay)->addColumn('status_pesanan',function($pesanan_status){
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
                })->make(true);
            } 

    }

}