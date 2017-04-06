<?php

use Illuminate\Database\Seeder;
use App\Destinasi;

class DestinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $destinasi = new Destinasi();
        $destinasi->nama_destinasi = 'Lampung';
        $destinasi->save();
        $destinasi = new Destinasi();
        $destinasi->nama_destinasi = 'Jakarta';
		$destinasi->save();
        $destinasi = new Destinasi();
 		$destinasi->nama_destinasi = 'Tasik';
		$destinasi->save();
    }
}
