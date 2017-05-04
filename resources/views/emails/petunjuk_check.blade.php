<p>Hallo {{$user->name}},</p>
<p>Terima kasih telah melakukan booking homestay melalui Endeso.</p> 
<p>Untuk dapat menemukan lokasi tempat, anda dapat melihatnya di peta yang ada di website www.endeso.id atau <a href="https://www.google.com/maps/place/{{$detail_kamar->latitude}},{{$detail_kamar->longitude}}">Peta</a> pada bagian "Pesanan Saya". Ketika anda telah sampai di rumah yang terpilih, harap tunjukkan kartu identitas anda (KTP/SIM/ Kartu Pelajar) kepada pemilik rumah.</p>
<p>Berikut adalah nomor telepon pemilik rumah untuk mempermudah anda menemukan lokasi rumah. </p>
<p>( No Telp: {{$detail_kamar->rumah->no_telp }}, Nama Pemilik: {{ $detail_kamar->rumah->nama_pemilik }}, Alamat: {{$detail_kamar->rumah->alamat}} )</p>
<p>Anda dapat melakukan check-in di rumah yang terpilih setelah pukul 15.00 waktu setempat.</p>
<p>Harap lakukan pembayaran sebesar Rp. {{number_format($total_harga_warga,0,',','.')}} kepada warga secara tunai ketika anda check-out pada tanggal ({{$pesanan_homestay->check_out}}).</p>
<p>Jika ada hal yang ingin anda tanyakan, anda dapat menghubungi kami di  081284393755 dan 087880186496</p>
<p>Have a pleasant stay ☺</p>

<p>Salam Traveler,</p>

<p>Endeso.id</p>
