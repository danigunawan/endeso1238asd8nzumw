<?php

use Illuminate\Database\Seeder;
use App\SettingFotoHome;

class SettingFotoHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	SettingFotoHome::create(
    	['foto_1' => 'foto1.jpg','foto_2' => 'foto2.jpg']
        );
    }
}
