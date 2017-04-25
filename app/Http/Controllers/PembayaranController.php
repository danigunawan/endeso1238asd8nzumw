<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    //
    public function index($id,$detail_pesanan){

     return view('pembayaran.index',['id'=>$id,'detail_pesanan'=>$detail_pesanan]);

    }
}
