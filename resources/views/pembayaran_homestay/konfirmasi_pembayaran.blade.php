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
@endsection


  