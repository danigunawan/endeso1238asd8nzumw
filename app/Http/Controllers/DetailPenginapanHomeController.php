<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomentarKamar;
use App\Kamar;


class DetailPenginapanHomeController extends Controller
{
    //

       public function index($id)  
    { 
    	$tanggal = date('Y-m-d');
        $kamar = Kamar::with(['rumah'])->find($id);
        $kamar_lain = Kamar::with(['rumah','destinasi'])->where('id_destinasi',$kamar->id_destinasi)->limit(3)->get();

        return view('penginapan.detail_home',['kamar' => $kamar,'kamar_lain'=>$kamar_lain,'komentar'=>$komentar,'tanggal'=> $tanggal ]);

    }
}
