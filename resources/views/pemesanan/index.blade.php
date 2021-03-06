@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Pesanan Cultural</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="active">Pesanan Cultural</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                @include('layouts._flash') 
                          <!-- STATUS PESANAN CULTURAL -->
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Status Pesanan</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu"> 
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',0) }}">Pelanggan Baru Saja Melakukan Pemesanan</a></li>
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',1) }}">Pelanggan Telah Mengkonfirmasi Pembayaran</a></li>
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',2) }}">Pembayaran Sudah Dikonfirmasi Admin</a></li>
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',3) }}">Pelanggan  Check In</a></li>
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',4) }}">Pelanggan  Check Out</a></li> 
                              <li><a href="{{ route('pemesanan.status-cultural-pesanan',5) }}">Pelanggan Membatalkan Pesanan</a></li>
                            </ul>
                          </div>    
                            <br>
                            <br>
                          <!-- STATUS PESANAN CULTURAL /-->

                          <!-- DATATABLE PESANAN CULTURAL -->
                          <div class="table-responsive">
                                 {!! $html->table(['class'=>'table-striped']) !!} 
                          </div>
                          <!-- DATATABLE PESANAN CULTURAL /-->
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection

@section('scripts')
{!! $html->scripts() !!}  
@endsection