<p>Hallo <b>{{$user->name}}</b>,</p>

<p>Terima kasih telah menggunakan Endeso. Kami berharap untuk dapat melayani</p>

<p>anda lagi kedepannya. Tentunya kami akan segera memperluas pilihan destinasi</p>

<p>.</p>

<p>Guna untuk meningkatkan mutu pelayanan kami, kami mengharapkan anda</p>

<p>memberikan rating dan review mengenai pelayanan kami dan pelayanan dari warga.</p>

<p>Anda dapat mengklik link ini 
<a href="{{ $link = url('/detail-penginapan/'. $pesanan_homestay->id_kamar.'/'. $pesanan_homestay->check_in.'/'. $pesanan_homestay->check_in.'/'.$pesanan_homestay->jumlah_orang) }}"> {{ $link }} </a> untuk</p>

<p>memberikan rating dan review.</p>

<p>Salam Traveler,</p>

<p>Endeso</p>