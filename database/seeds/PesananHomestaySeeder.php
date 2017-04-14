<?php

use Illuminate\Database\Seeder;
use App\PesananHomestay;

class PesananHomestaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeder pesanan home stay
        $PesananHomestay1 = PesananHomestay::Create(['id_kamar'=>'1','id_user'=>'2', 'check_in'=>'2017-04-10', 'check_out'=>'2017-04-20','status_pesanan'=>'0','total_harga'=>'1500000','harga_endeso'=>'500000','harga_pemilik'=>'1000000','jumlah_malam'=>'1', 'jumlah_orang'=>'1']); 
        $PesananHomestay2 = PesananHomestay::Create(['id_kamar'=>'2','id_user'=>'2', 'check_in'=>'2017-04-11', 'check_out'=>'2017-04-21','status_pesanan'=>'0','total_harga'=>'1800000','harga_endeso'=>'600000','harga_pemilik'=>'1200000','jumlah_malam'=>'1', 'jumlah_orang'=>'1']); 
    } 
}
