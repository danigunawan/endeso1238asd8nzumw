<?php

use Illuminate\Database\Seeder;
use App\PesananCulture;

class PesananCulturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder pesanan cultur
        $pesanan_cultures = PesananCulture::Create(['id_warga'=>'1','jadwal'=>'09:00 - 10:00','status_pesanan'=>'0','check_in'=>'2017-04-10','id_user'=>'2','total_harga'=>'150.000','harga_pemilik'=>'100.000','harga_endeso'=>'50.000','jumlah_orang'=>'1','nama'=>'tukiem']);
    }
}
