<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class PesananCulturalController extends Controller
{
    //
    public function index($id, $tanggal_masuk){
    	$detail_kategori = Kategori::find($id);

    	return view('pesan_cultural.index', ['detail_kategori' => $detail_kategori, 'id' => $id, 'tanggal_masuk' => $tanggal_masuk]);
    }
}
