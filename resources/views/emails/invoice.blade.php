<p>Hallo {{$user->name}},</p>
Kami telah menerima pesanan anda. Proses pesanan anda masih belum selesai. 
Untuk dapat menyelesaikan pesanan, harap segera melakukan pembayaran 
down payment (DP) sejumlah {{$total_harga_endeso}}.<p>

<p>Harap lakukan pembayaran melalui transfer ke informasi rekening berikut.</p>

@foreach($rekening_tujuan as $rekening_tujuans)
<hr>
<p>Nomor rekening : {{$rekening_tujuans->nomor_rekening_tubungan}}</p>
<p>Bank : {{$rekening_tujuans->nama_bank }} </p>
<p>Atas nama : {{$rekening_tujuans->nama_rekening_tabungan}} </p>
<hr>
@endforeach

<p>Batas waktu pembayaran down payment (DP) anda adalah 120 menit. Jika anda tidak melakukan pembayaran dan konfirmasi pembayaran melebihi batas waktu, pesanan anda kami anggap gagal dan anda dapat melakukan pemesanan ulang di website.</p>

<p>Mohon untuk mengirim bukti transfer dengan melampirkan foto bukti transfer dengan cara mengklik link berikut ini .</p>

<p>Salam Traveler,</p>
<p>Endeso</p>