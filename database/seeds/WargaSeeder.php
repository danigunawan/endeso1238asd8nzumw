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
        $warga = Warga::create(['nama_warga' => 'Bayu', 'id_kategori_culture' => '1','jadwal_1' => '09:00 - 10:00', 'harga_endeso' => '50.000','harga_pemilik' => '100.000', 'kapasitas' => '5']); 
    }
}
