<?php

use Illuminate\Database\Seeder;
use App\Warga;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $warga = Warga::create(['nama_warga' => 'Bayu', 'id_destinasi' => '1', 'id_kategori_culture' => '1','jadwal_1' => '09:00 - 10:00','durasi' =>'1 jam' ,'harga_endeso' => '50000','harga_pemilik' => '100000', 'kapasitas' => '5','no_telp' => '0099797987988']); 
    }
}
