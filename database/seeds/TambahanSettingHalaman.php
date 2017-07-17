<?php

use Illuminate\Database\Seeder;
use App\SettingHalaman;

class TambahanSettingHalaman extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


   SettingHalaman::create(['judul' => 'Tentang Endeso CE','isi_halaman' =>'Kontak Punya nya endeso' ,'jenis_halaman' => 4]);
    SettingHalaman::create(['judul' => 'Cara Pesan CE','isi_halaman' =>'Kontak Punya nya endeso' ,'jenis_halaman' => 5]);

    }
}
