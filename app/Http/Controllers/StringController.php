<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringController extends Controller
{
    //

    public function tanggal_mysql($tanggal){

    	  $date= date_create($tanggal);
		  $date_format = date_format($date,"Y-m-d");

		   return $date_format;
    }

    public function persen($persen){
	$hasil = "". $persen."%";
	return $hasil;
	}

	public function rp($rupiah){
	$rp = number_format($rupiah,0,',','.');
	$rpp = $rp;
	return $rpp;
	}

	public function tanggal_normal($tanggal){

	 $date= date_create($tanggal);
	 $date_terbalik =  date_format($date,"d-m-Y");
	 return $date_terbalik;
	}

	public function dari_huruf_kekata($x) {
		$x = abs($x);
		$angka = array("", "satu", "dua", "tiga", "empat", "lima",
		"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($x <12) {
		$temp = " ". $angka[$x];
		} else if ($x <20) {
		$temp = kekata($x - 10). " belas";
		} else if ($x <100) {
		$temp = kekata($x/10)." puluh". kekata($x % 10);
		} else if ($x <200) {
		$temp = " seratus" . kekata($x - 100);
		} else if ($x <1000) {
		$temp = kekata($x/100) . " ratus" . kekata($x % 100);
		} else if ($x <2000) {
		$temp = " seribu" . kekata($x - 1000);
		} else if ($x <1000000) {
		$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
		} else if ($x <1000000000) {
		$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
		} else if ($x <1000000000000) {
		$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
		$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
		}     
		return $temp;
		}



}
