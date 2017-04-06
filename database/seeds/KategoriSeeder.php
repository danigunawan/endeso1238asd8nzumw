<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kategori = Kategori::create(['nama_aktivitas' => 'A', 'destinasi_kategori' => '1', 'deskripsi_kategori' => 'Kota Tapis Berseri' ]);
        $kategori = Kategori::create(['nama_aktivitas' => 'B', 'destinasi_kategori' => '2', 'deskripsi_kategori' => 'Ibu Kota Indonesia' ]);
        $kategori = Kategori::create(['nama_aktivitas' => 'C', 'destinasi_kategori' => '3', 'deskripsi_kategori' => 'Tasik Terbaik' ]);
    }
}
