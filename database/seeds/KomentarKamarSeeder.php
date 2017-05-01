<?php

use Illuminate\Database\Seeder;
use App\KomentarKamar;

class KomentarKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $komentar = KomentarKamar::create(['id_kamar' => '1', 'id_user' => '1', 'isi_komentar' => 'komentar saya cukup menarik' ]);
    }
}
