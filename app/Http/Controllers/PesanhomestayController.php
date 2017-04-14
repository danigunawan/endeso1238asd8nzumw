<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kamar;

class PesanhomestayController extends Controller
{
    //

           public function index($id,$tanggal_checkin,$tanggal_checkout){   
        $detail_kamar = Kamar::with(['rumah'])->find($id);
        return view('pesan_homestay.index',['detail_kamar' => $detail_kamar,'id'=>$id,'tanggal_checkin'=>$tanggal_checkin,'tanggal_checkout'=>$tanggal_checkout]);
    	}
    	
    		public function store(){

    	}
 }