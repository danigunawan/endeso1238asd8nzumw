@extends('layouts.app')

@section('content')


<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>{{$detail_kategori->nama_aktivitas}}</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="list.html">Cultural Experience</a></li>
					<li class="active">{{$detail_kategori->nama_aktivitas}}</li>
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
						<h3>Form Pemesanan</h3>
						<div class="row">
						<div class="col-sm-6">


            {!! Form::model($warga, ['url' => route('pesancultural.proses'),
            'method' => 'get', 'files'=>'true']) !!}
                    @include('pesan_cultural._form') 
            {!! Form::close() !!}



						</div>
						<div class="col-sm-6"> 
						<br>
				<!-- panel Rincian Pemesanan /- -->
							<div class="panel panel-default">
							 <div class="panel-heading" style="background-color:#df9915;color:#fff"><h3>Rincian Pemesanan</h3></div>
  								<div class="panel-body">
								<div class="row" style="padding:10%">
									<div class="col-xs-3">
									@if (isset($detail_kategori) && $detail_kategori->foto_kategori)
										<p>
											{!! Html::image(asset('img/'.$detail_kategori->foto_kategori), null, ['class' => 'img-rounded img-responsive']) !!}
										</p>
									@endif 						
									</div>
									<div class="col-xs-9">
										<aside class="widget widget_features">
									<h3 class="widget-title">Tentang {{$detail_kategori->nama_aktivitas}}</h3>
									{!!$detail_kategori->deskripsi_kategori!!}
								</aside><!-- Features Widget -->
									</div>
								</div>
								</div>
							</div> 
								<!-- panel Rincian Pemesanan /- -->
				<div class="panel panel-default" >
					<div class="panel-heading" style="background-color:#df9915;color:#fff"><h3>Rincian Harga</h3></div>
  					<div class="panel-body">
						<table>
 							<tbody>
      						 	<tr><td width="50%" style="font-size:150%"><b>Warga : <span id="nama_warga"></span></b></td> <td> &nbsp;&nbsp;&nbsp;&nbsp;</td> <td></td> </tr>

      						 	<tr><td  width="50%" style="font-size:150%">Harga </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%">Rp. <span id="harga_cultural"></span> </td></tr>

      						 	<tr><td  width="50%" style="font-size:150%;"><span id="hitung_orang"></span> orang X <span id="hitung_harga_orang"></span> </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%">Rp. <span id="harga_jumlah_orang"></span> </td></tr> 
  							</tbody>
						</table>
								<hr>
						<table>
 							<tbody>
      							<tr><td width="50%" style="font-size:150%;color:red;">Total Pembayaran </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%;color:red;" >Rp. <span id="harga_total"> </span></td></tr>
  							</tbody>
						</table>
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
        $("#id_warga").change(function(){
            var id_warga = $('#id_warga').val();
            

                        $.post('{{ url('/ajax-jadwal-kegiatan') }}',{'_token': $('meta[name=csrf-token]').attr('content'),
                            id_warga:id_warga },function(data){   
                            $(".span-option").remove();

                            if (data.jadwal_1 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_1+'">'+data.jadwal_1+'</option>');
                            }
                            if (data.jadwal_2 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_2+'">'+data.jadwal_2+'</option>');

                            } 
                            if (data.jadwal_3 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_3+'">'+data.jadwal_3+'</option>');

                            } 
                            if (data.jadwal_4 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_4+'">'+data.jadwal_4+'</option>');

                            } 
                            if (data.jadwal_5 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_5+'">'+data.jadwal_5+'</option>');

                            } 
                        });



                        $.post('{{ url('/ajax-warga-cultural') }}',
                        {
                            '_token': $('meta[name=csrf-token]').attr('content'),
                            id_warga:id_warga },function(data){
                                $("#nama_warga").text(data);
                            });

                        $.post('{{ url('/ajax-harga-cultural') }}',
                        {
                            '_token': $('meta[name=csrf-token]').attr('content'),
                            id_warga:id_warga },function(data){
                                $("#harga_cultural").text(data);
                            });

                    });
    </script>
@endsection
