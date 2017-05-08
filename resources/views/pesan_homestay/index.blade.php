@extends('layouts.app')

@section('content')


<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>{{$detail_kamar->rumah->nama_pemilik}}</h3>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
                    <li><a href="#">Homestay</a></li>
					<li class="active">Pemesanan</li>
				</ol>
			</div>
            <div class="container" style="color:#faac17"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i> 4.5/5</div>
		</div><!-- Page Banner /- -->
		
		<div class="section-top-padding"></div>
		
		<!-- Container -->
		<div class="container">
            <!-- Container -->
            <div class="container">
                <!-- Form -->
					<div class="booking-form2">

					@include('layouts._flash')

						<h3>Form Pemesanan</h3>
						<div class="row">
						<div class="col-sm-6">

            {!! Form::model($detail_kamar, ['url' => route('pesanhomestay.proses'),
            'method' => 'get', 'files'=>'true']) !!}
                    @include('pesan_homestay._form')
            {!! Form::close() !!}


						</div>
						<div class="col-sm-6">
						<br>
				<!-- panel Rincian Pemesanan /- -->
							<div class="panel panel-default">
							 <div class="panel-heading" style="background-color:#df9915;color:#fff"><h3>Rincian Pemesanan</h3></div>
  								<div class="panel-body">

									<div class="row" style="padding:3%">
    									<div class="col-xs-3">
    									@if (isset($detail_kamar) && $detail_kamar->foto1)
    										<p>
    											{!! Html::image(asset('img/'.$detail_kamar->foto1), null, ['class' => 'img-rounded img-responsive']) !!}
    										</p>                              
    									@endif 						
    									</div>
      									<div class="col-xs-9">                                          
                          <aside class="widget widget_features">
                              <h3 class="widget-title"> Tentang {{$detail_kamar->rumah->nama_pemilik}}</h3>
                               {!!$detail_kamar->deskripsi!!}
                               {!!$detail_kamar->deskripsi_2!!}
                          </aside><!-- Features Widget -->
                        </div>
      								</div>

      								<div class="row" style="padding: 3%">
      									<span id="span-peta" style="display: none">
  	                       <div id="map" style=" height: 200px;" class="img-rounded img-responsive"></div>     										
      									</span>   
                      </div>

								</div>
							</div>
				<!-- panel Rincian Pemesanan /- -->

				</div>
				</div>
			</div><!-- Form /- -->
                
   		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>

@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function(){

    var harga_endeso = "{{ $dp }}";
    hitung_penginapan_document(harga_endeso);

  });


	$(document).on('click','#harga_makan',function(e){
		$(this).prop('checked', this.checked);

		hitung_penginapan_checkbox();
    });

    $(document).on('change','#jumlah_orang',function(e){
    	var harga_endeso = "{{ $dp }}";

 		hitung_penginapan(harga_endeso);

 		var jumlah_orang_baru = $(this).val();
 		var jumlah_orang_ganti = jumlah_orang_baru - 1;
 		var no_urut_tamu = jumlah_orang_baru;
 		var no = 1;

 			$(".span-hapus").remove();
 			for (var tamu = 1; tamu <= jumlah_orang_baru; tamu++) 
        {	
        	var no_urut = no_urut_tamu--;

       	$('<div class="form-group{{ $errors->has('nama_tamu.+no_urut_tamu--+') ? ' has-error' : '' }} span-hapus"><label align="left">Nama Tamu '+no_urut+' </label><br><input type="text" name="nama_tamu['+no_urut+']" id="nama_tamu" class="form-control" autocomplete="off" required=""></div>').insertAfter("#kolom_harga");
        }


        
    });

    $(document).on('change','#datepicker1',function(e){
    	var harga_endeso = "{{ $dp }}";
  		hitung_penginapan(harga_endeso); 
    });

    $(document).on('change','#datepicker2',function(e){
    	var harga_endeso = "{{ $dp }}";
       hitung_penginapan(harga_endeso); 
    });

</script>
@endsection

