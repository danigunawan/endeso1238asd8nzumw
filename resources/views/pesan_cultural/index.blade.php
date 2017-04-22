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



                    @include('pesan_cultural._form')


						</div>
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="row" style="padding:10%">
									<div class="col-xs-3">
									{!! Html::image(asset('img/'.$detail_kategori->foto_kategori), null, ['alt' => 'Slide']) !!}					
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
						</div>
					</div><!-- Form /- -->
                
   		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>



@endsection

@section('scripts')
    <script type="text/javascript">
        $("#warga").change(function(){
            var warga = $('#warga').val();

                        $.post('{{ url('/ajax-jadwal-kegiatan') }}',
                        {
                            '_token': $('meta[name=csrf-token]').attr('content'),
                            warga:warga },function(data){
                                $("#jadwal_1").val(data);
                            });
                    });
    </script>
@endsection

@section('scripts')
<script type="text/javascript">
	$.post('Diisi dengan route(yang dicontroller)',{_token:'{{ csrf_token() }}'}, function(data){
		
	});
</script>
@endsection