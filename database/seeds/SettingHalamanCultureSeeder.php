<?php

use Illuminate\Database\Seeder;
use App\SettingHalamanCulture;

class SettingHalamanCultureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	SettingHalamanCulture::create(
    	['foto_1' => 'foto1.jpg','kategori_1' => '1',
        'foto_2' => 'foto2.jpg','kategori_2' => '2',
        'foto_3' => 'foto3.jpg','kategori_3' => '3',
        'foto_4' => 'foto4.jpg','kategori_4' => '1']
        );
    }
}
