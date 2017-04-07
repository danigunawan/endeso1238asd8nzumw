<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(DestinasiSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(SettingHalamanSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(RumahSeeder::class);
        
    }
}
