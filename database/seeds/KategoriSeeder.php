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
        $kategori = Kategori::create(['nama_aktivitas' => 'Tapis Kain', 'destinasi_kategori' => '1', 'deskripsi_kategori' => 'Kota Lampung' ]);
        $kategori = Kategori::create(['nama_aktivitas' => 'Bela Diri', 'destinasi_kategori' => '2', 'deskripsi_kategori' => 'Kota Jakarta' ]);
        $kategori = Kategori::create(['nama_aktivitas' => 'Bertani', 'destinasi_kategori' => '3', 'deskripsi_kategori' => 'Kota Tasik' ]);
    }
}
