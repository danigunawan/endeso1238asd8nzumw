@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Konfirmasi Pembayaran</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="active">Pembayaran</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                @include('layouts._flash') 


                     <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#homestay">Pembayaran Homestay</a></li>
                        <li><a data-toggle="tab" href="#culture">Pembayaran Cultur Experience</a></li>
                      </ul>
                      <br><br>
                      <div class="tab-content">
                         <div id="homestay" class="tab-pane fade in active">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Filter Status Pembayaran</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu"> 
                              <li><a href="{{ route('pemesanan.status-homestay-pembayaran',1) }}">Sudah Konfirmasi</a></li>
                              <li><a href="{{ route('pemesanan.status-homestay-pembayaran',0) }}">Belum Konfirmasi</a></li> 
                            </ul>
                          </div>    

                            <br>
                            <br>

                          {!! $html->table(['class'=>'table-striped']) !!}
                          <br>
                          <p style="color:red"><i>*Klik Foto untuk memperbesar</i></p>
                         </div>

                        <div id="culture" class="tab-pane fade">                          
                               
                         <table  class="table-striped table" id="konfirmasi_pembayaran_cultural">
                             <thead>
                                <tr>
                                    <th>ID Pesanan</th> 
                                    <th>Nama Pemesan</th> 
                                    <th>Harga Dp</th>
                                    <th>No Rekening Pemesan</th> 
                                    <th>Nama Bank Pemesan</th> 
                                    <th>Nama Bank Tujuan</th> 
                                    <th>Foto Bukti</th> 
                                    <th>Status Pesanan</th> 
                                    <th>Konfirmasi Pembayaran</th> 
                                </tr>
                             </thead>
                        </table>
                          <br>
                          <p style="color:red"><i>*Klik Foto untuk memperbesar</i></p>

                        </div>
                      </div>
                   </div>
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>
 
@endsection

@section('scripts')
{!! $html->scripts() !!}
<script type="text/javascript">
$("#konfirmasi_pembayaran_cultural").DataTable({
    "serverSide":true,"processing":true,"ajax":"{{ url('admin/konfirmasi/pembayaran/cultural') }}","columns":[  
    {"data":"id_pesanan","name":"id_pesanan","title":"ID Pesanan","orderable":false,"searchable":false},
    {"data":"pemesanan_cultural.nama","name":"pemesanan_cultural.nama","title":"Nama Pemesan","orderable":false,"searchable":false},
    {"data":"total_harga_endeso","name":"total_harga_endeso","title":"Harga Dp","orderable":false,"searchable":false},
    {"data":"nomor_rekening_pelanggan","name":"nomor_rekening_pelanggan","title":"No Rekening Pelanggan","orderable":false,"searchable":false},
    {"data":"rekening_bank_pelanggan.nama_bank","name":"rekening_bank_pelanggan.nama_bank","title":"Nama Bank Pelanggan","orderable":false,"searchable":false},
    {"data":"rekening_bank_tujuan.nama_bank","name":"rekening_bank_tujuan.nama_bank","title":"Nama Bank Tujuan","orderable":false,"searchable":false},
    {"data":"foto_tanda_bukti","name":"foto_tanda_bukti","title":"Foto Bukti","orderable":false,"searchable":false},
    {"data":"status_pesanan","name":"status_pesanan","title":"Status Pesanan","orderable":false,"searchable":false},
    {"data":"action","name":"action","title":"Konfirmasi Pembayaran","orderable":false,"searchable":false} 
]});
</script>
@endsection 