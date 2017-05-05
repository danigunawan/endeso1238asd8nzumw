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
        $this->call(KomentarKategoriSeeder::class);
        $this->call(KomentarKamarSeeder::class);
        $this->call(KamarSeeder::class);
        $this->call(WargaSeeder::class);
        $this->call(RekeningSeeder::class);
        $this->call(PesananHomestaySeeder::class);
        $this->call(PesananCulturSeeder::class);
        $this->call(SettingHalamanCultureSeeder::class);

    }
}
