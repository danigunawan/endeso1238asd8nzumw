
    @extends('layouts.app')

@section('content')

<style type="text/css">
/*unTUK mengatur ukuran font*/
   .satu {
   font-size: 15px;
   font: verdana;
   }
</style>

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Detail Pesanan</h3>
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

					  <div class="panel panel-default">
					    <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Detail Pesanan</h4></b></div>
					    <div class="panel-body">
					    	<div class="row">
					    		<div class="col-sm-4">
					    			<p>Dipesan Oleh<br><br>
					    				<b>{!! $nama_user->name !!}</b></p>
					    		</div>
					    		<div class="col-sm-4">
					    			<p>Tanggal Pemesanan<br><br>
					    			<b>{!! $waktu_pesan !!}</b></p>
					    		</div>
					    		<div class="col-sm-4">
					    			<p>No. Pesanan <br><br>
					    			<b>{!! $pesanan_culture->id !!}</b></p>
					    		</div>
					    	</div>
					    </div>
					    <hr>
					    <div class="panel-body">
					    	<div class="row">
					    		<div class="col-sm-4">
					    			<p>Jumlah Orang<br><br>
					    				<b>{!! $pesanan_culture->jumlah_orang  !!} {!! "Orang" !!}</b></p>
					    		</div>
					    		<div class="col-sm-4">
					    			<p>Status Pesanan<br>
					    		     <div class="alert alert-warning" role="alert">
		                                     <strong>@if($pesanan_culture->status_pesanan == 0)
							    				{!! "Anda Baru Saja Melakukan Pemesanan" !!}

							    				@elseif($pesanan_culture->status_pesanan == 1)
							    				{!! "Kami Sedang Melakukan Pengecekan Pembayaran Anda" !!} 

							    				@elseif($pesanan_culture->status_pesanan == 2)
							    				{!! "Pembayaran Anda Telah Dikonfirmasi" !!}

							    				@elseif($pesanan_culture->status_pesanan == 3)
							    				{!! "Check In" !!}  

							    				@elseif($pesanan_culture->status_pesanan == 4)
							    				{!! "Check Out" !!}  

							    				@elseif($pesanan_culture->status_pesanan == 5)
							    				{!!"Pesanan Anda Dibatalkan" !!}   

							    				@endif
							    			</strong> 
                                      </div></p>
                                      
					    		</div>

					    		<div class="col-sm-4"><br>
					    		@if ($pesanan_culture->status_pesanan < 1 )
									<a href="{{ url('/pembayaran_culture/'.$pesanan_culture->id.'/'.$destinasi.'/'.$aktivitas)}}" class="btn read-more">Pembayaran<i class="fa fa-long-arrow-right"></i></a>	
					    		@endif
					    		</div>

					    	</div>
					    </div>
					  </div>

						{!! $tampil_detail !!}
                   </div>
                
                         
                   
                </div> <!-- Row /- -->
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection    

