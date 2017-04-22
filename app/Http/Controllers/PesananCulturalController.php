<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Warga;

class PesananCulturalController extends Controller
{
    //
    public function index($id, $tanggal_masuk){
    	$detail_kategori = Kategori::find($id);

    	return view('pesan_cultural.index', ['detail_kategori' => $detail_kategori, 'id' => $id, 'tanggal_masuk' => $tanggal_masuk]);
    }


    public function ajax_jadwal_kegiatan(Request $request)
    { 
        if ($request-> ajax()) {
            # code...
            $id_warga = $request->warga;
            $warga = Warga::find($id_warga); 
            return $warga->jadwal_1;

        } 
    }

}