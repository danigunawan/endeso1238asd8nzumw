<p>Hallo <b>{{$user->name}}</b>,</p>
<p>Terima kasih telah melakukan pemesanan Cultural Experience dari website</p>
<p>www.endeso.id</p>
<p>Untuk dapat menemukan lokasi tempat, anda dapat meilihatnya di peta yang ada</p>
<p>di website www.endeso.id pada bagian &quot;Pesanan Saya&quot; atau <a href="https://www.google.com/maps/place/{{$warga->latitude}},{{$warga->longitude}}">Peta</a>. Ketika anda telah</p>
<p>bertemu dengan warga terpilih, harap tunjukkan kartu identitas anda</p>
<p>(KTP/SIM/ Kartu Pelajar) kepada warga terpilih.</p>
<p>Berikut adalah nomor telepon warga yang terpilih untuk mempermudah anda</p>
<p>menemukan lokasi ( No Telp: {{$warga->no_telp }}, Nama Warga: {{ $warga->nama_warga }}</p>
<p>Ketika cultural experience telah berakhir, kami memohon anda untuk melakukan</p>
<p>melakukan sisa pembayaran sejumlah Rp. {{number_format($total_harga_warga,0,',','.')}}</p>
<p>kepada warga secara tunai.</p>
<p>Jika ada hal yang ingin anda tanyakan lebih lanjut, anda dapat menghubungi</p>
<p>kami di 081284393755 dan 087880186496</p>
<p>Salam Traveler,</p>
<p>Endeso</p>