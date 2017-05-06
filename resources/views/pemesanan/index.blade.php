@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Pesanan</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="active">Pesanan</li>
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
                        <li class="active"><a data-toggle="tab" href="#homestay">Pesanan Homestay</a></li>
                        <li><a data-toggle="tab" href="#culture">Pesanan Cultur Experience</a></li>
                      </ul>
                      <br><br>
                      <div class="tab-content">
                         <div id="homestay" class="tab-pane fade in active">
                     
                         <table  class="table-striped table" id="datatable_pesanan_homestay">
                             <thead>
                                <tr>

                                <th>Kode Booking</th>
                                    <th>Nama Kamar</th> 
                                    <th>Nama Pemesan</th> 
                                    <th>Check In</th> 
                                    <th>Check Out</th> 
                                    <th>Jumlah Malam</th> 
                                    <th>No Hp</th>
                                    <th>No KTP</th>
                                    <th>Email</th>                                  
                                    <th>Total Harga</th> 
                                    <th>Status</th> 
                                    <th>W</th> 
                                    <th></th> 
                                </tr>
                             </thead>
                        </table>

                         </div>

                        <div id="culture" class="tab-pane fade">   

                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Check In & Check Out</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu"> 
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',2) }}">Check In</a></li>
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',3) }}">Check Out</a></li> 
                            </ul>
                          </div>    

                                 {!! $html->table(['class'=>'table-striped']) !!}
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
$("#datatable_pesanan_homestay").DataTable({
    "serverSide":true,"processing":true,"ajax":"{{ url('admin/pesana/homestay') }}","columns":[  
    {"data":"id","name":"id","title":"Kode Booking","orderable":false,"searchable":false},
    {"data":"nama_pemilik","name":"nama_pemilik","title":"Pemilik Rumah","orderable":false,"searchable":false},
    {"data":"user.name","name":"user.name","title":"Nama Pemesan","orderable":false,"searchable":false},
    {"data":"check_in","name":"check_in","title":"Check In","orderable":false,"searchable":false},
    {"data":"check_out","name":"check_out","title":"Check Out","orderable":false,"searchable":false},
    {"data":"jumlah_malam","name":"jumlah_malam","title":"Jumlah Malam","orderable":false,"searchable":false},
    {"data":"no_ktp","name":"no_ktp","title":"No KTP","orderable":false,"searchable":false},
    {"data":"no_telp","name":"no_telp","title":"No Telp","orderable":false,"searchable":false},
    {"data":"email","name":"email","title":"Email","orderable":false,"searchable":false},
    {"data":"total_harga","name":"total_harga","title":"Total Harga","orderable":false,"searchable":false},
    {"data":"status_pesanan","name":"status_pesanan","title":"Status","orderable":false,"searchable":false},
    {"data":"action","name":"action","title":"","orderable":false,"searchable":false},
    {"data":"created_at","name":"created_at","title":"Waktu dipesan","orderable":false,"searchable":true} 
]});
</script>
@endsection