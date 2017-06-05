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
        $kategori = Kategori::create(['nama_aktivitas' => 'Tapis Kain', 'destinasi_kategori' => '1', 'deskripsi_kategori' => 'Kain Tapis merupakan salah satu jenis kerajinan tradisional masyarakat Lampung dalam menyelaraskan kehidupannya baik terhadap lingkungannya maupun Sang Pencipta Alam Semesta. Oleh sebab itu, munculnya kain tapis ini ditempuh melalui tahap-tahap waktu yang mengarah kepada kesempurnaan teknik tenun, maupun cara-cara memberikan ragam hias yang sesuai dengan perkembangan kebudayaan masyarakat.', 'durasi' => '3 Jam' ]);
        $kategori = Kategori::create(['nama_aktivitas' => 'Bela Diri', 'destinasi_kategori' => '2', 'deskripsi_kategori' => 'Seni bela diri merupakan satu kesenian yang timbul sebagai satu cara seseorang mempertahankan / membela diri. Seni bela diri telah lama ada dan berkembang dari masa ke masa. Pada dasarnya, manusia mempunyai insting untuk selalu melindungi diri dan hidupnya. Dalam tumbuh atau berkembang, manusia tidak dapat lepas dari kegiatan fisiknya, kapan pun dan di manapun. Hal inilah yang akan memacu aktivitas fisiknya sepanjang waktu. Pada zaman kuno,tepatnya sebelum adanya persenjataan modern, manusia tidak memikirkan cara lain untuk mempertahankan dirinya selain dengan tangan kosong. Pada saat itu, kemampuan bertarung dengan tangan kosong dikembangkan sebagai cara untuk menyerang dan bertahan, kemudian digunakan untuk meningkatkan kemampuan fisik / badan seseorang. Meskipun begitu, pada zaman-zaman selanjutnya, persenjataan pun mulai dikenal dan dijadikan sebagai alat untuk mempertahankan diri.', 'durasi' => '3 Jam' ]);
        $kategori = Kategori::create(['nama_aktivitas' => 'Bertani', 'destinasi_kategori' => '3', 'deskripsi_kategori' => 'Pertanian adalah kegiatan pemanfaatan sumber daya hayati yang dilakukan manusia untuk menghasilkan bahan pangan, bahan baku industri, atau sumber energi, serta untuk mengelola lingkungan hidupnya.[1] Kegiatan pemanfaatan sumber daya hayati yang termasuk dalam pertanian biasa dipahami orang sebagai budidaya tanaman atau bercocok tanam (bahasa Inggris: crop cultivation) serta pembesaran hewan ternak (raising), meskipun cakupannya dapat pula berupa pemanfaatan mikroorganisme dan bioenzim dalam pengolahan produk lanjutan, seperti pembuatan keju dan tempe, atau sekadar ekstraksi semata, seperti penangkapan ikan atau eksploitasi hutan.', 'durasi' => '3 Jam' ]);
    }
}
