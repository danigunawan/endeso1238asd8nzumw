<?php

use Illuminate\Database\Seeder;
use App\Rumah;
class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          //
        $rumah1 = Rumah::create(['nama_pemilik'=>'Fahrizal','no_telp'=>'0828934348234','alamat'=>'Tanjung Karang']);
        $rumah2 = Rumah::create(['nama_pemilik'=>'Rama','no_telp'=>'5655645654','alamat'=>'Pringsewu']); 
        $rumah3 = Rumah::create(['nama_pemilik'=>'Hendri','no_telp'=>'6334454','alamat'=>'Bandar']);  
         $rumah4 = Rumah::create(['nama_pemilik'=>'Aris','no_telp'=>'6334454','alamat'=>'Bandar']);  
    }
}
