<?php

use Illuminate\Database\Seeder;
use App\Kamar;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kamar1 = Kamar::create(['id_rumah'=>'1','id_destinasi'=>'1','deskripsi'=>'Kamar Megah Dipinggir Sungai','judul_peta'=>'Kamar Megah','kapasitas'=>'3','harga_endeso'=>'500000','harga_pemilik'=>'1000000']);
        $kamar1 = Kamar::create(['id_rumah'=>'2','id_destinasi'=>'2','deskripsi'=>'Kamar Unik Dipinggir Sungai','judul_peta'=>'Kamar Unik','kapasitas'=>'2','harga_endeso'=>'600000','harga_pemilik'=>'1200000']);
        $kamar1 = Kamar::create(['id_rumah'=>'3','id_destinasi'=>'3','deskripsi'=>'Kamar Luas Dipinggir Masjid','judul_peta'=>'Kamar Luas','kapasitas'=>'5','harga_endeso'=>'800000','harga_pemilik'=>'1700000']);
        $kamar1 = Kamar::create(['id_rumah'=>'4','id_destinasi'=>'4','deskripsi'=>'Kamar Modern','judul_peta'=>'Kamar Modern','kapasitas'=>'4','harga_endeso'=>'1000000','harga_pemilik'=>'2000000']);
    }
}
