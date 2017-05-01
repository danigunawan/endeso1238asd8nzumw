<?php

use Illuminate\Database\Seeder;
use App\Rekening;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rekening = Rekening::create(['nama_bank' => 'Bank Mandiri Syariah', 'nama_rekening_tabungan' => '0000000000','nomor_rekening_tabungan' => '1020003078265']); 
    }
}
