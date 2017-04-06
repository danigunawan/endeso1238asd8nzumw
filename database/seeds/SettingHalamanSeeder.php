<?php

use Illuminate\Database\Seeder;
use App\SettingHalaman;

class SettingHalamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SettingHalaman::create(['judul' => 'Tentang Endeso','isi_halaman' =>'Endeso adalah ...' ,'jenis_halaman' => 1]);
        SettingHalaman::create(['judul' => 'Cara Pesan','isi_halaman' =>'Cara Pesan di Endeso Gini Cara nya' ,'jenis_halaman' => 2]);
        SettingHalaman::create(['judul' => 'Kontak Endeso','isi_halaman' =>'Kontak Punya nya endeso' ,'jenis_halaman' => 3]);

    }
}
