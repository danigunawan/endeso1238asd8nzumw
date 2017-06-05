@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Konfirmasi Pembayaran cultural</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="active">Pembayaran cultural</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                @include('layouts._flash') 

 
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Status Pembayaran</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu"> 
                              <li><a href="{{ route('pemesanan.status-cultural-pembayaran',1) }}">Sudah Konfirmasi</a></li>
                              <li><a href="{{ route('pemesanan.status-cultural-pembayaran',0) }}">Belum Konfirmasi</a></li> 
                            </ul>
                          </div>    

                            <br>
                            <br>

                          <div class="table-responsive">
                          {!! $html->table(['class'=>'table-striped']) !!}
                          </div>
                          <br>
                          <p style="color:red"><i>*Klik Foto untuk memperbesar</i></p> 
 
                      </div>
                   </div>
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>
 
@endsection

@section('scripts')
{!! $html->scripts() !!}
@endsection 