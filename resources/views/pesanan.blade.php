
    @extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Pesanan Saya</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Home</a></li>
                    <li class="active">Pesanan Saya</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">

            <!-- Container -->
            <div class="container ">
             @include('layouts._flash')

                 <div class="row">
                    <div class="col-md-4">
                      <ul class="nav nav-pills nav-stacked">
                        <li ><a href="{{ route('profil.edit')}}">Ubah Profil</a></li>
                        <li class="active"><a href="{{ route('pesanan')}}">Pesanan Saya</a></li>
                       
                      </ul>
                   </div>
                   <div class="col-md-8">
                       <ul class="nav nav-tabs">
                          <li class="active"><a href="#">Pesanan Baru</a></li>
                          <li><a href="#">Pesanan Lama</a></li> 
                        </ul>
                        <br>
                        <center><h3>Belum Ada Pesanan</h3></center>
                        <center>     <p>Seluruh pesanan baru Anda akan muncul di sini, tapi kini Anda belum punya satu pun. Mari buat pesanan via homepage!</p></center>    

                   </div>
                
              

           
                   
                </div> <!-- Row /- -->
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     
