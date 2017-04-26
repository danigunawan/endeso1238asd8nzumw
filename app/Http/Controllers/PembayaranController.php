<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use App\PesananHomestay;
use App\Kamar;
use Http\Controller\Auth\StringController;

class PembayaranController extends Controller
{
    //
    public function index($id){

    	$rekening = Rekening::select('id','nama_bank','nama_rekening_tabungan','nomor_rekening_tabungan')->limit(1)->first();
    	$detail_pesanan = PesananHomestay::find($id);
        $kamar = Kamar::with(['rumah'])->find($detail_pesanan->id_kamar);

     return view('pembayaran_homestay.index',['id'=>$id,'detail_pesanan'=>$detail_pesanan,'rekening'=>$rekening,'kamar'=>$kamar]);

    }


}
