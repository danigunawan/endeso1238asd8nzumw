@extends('layouts.app')

@section('content')


<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>{{$detail_kamar->rumah->nama_pemilik}}</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="list.html">Rumah Alam</a></li>
					<li class="active">{{$detail_kamar->rumah->nama_pemilik}}</li>
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

            {!! Form::model($detail_kamar, ['url' => route('pesanhomestay.proses'),
            'method' => 'post', 'files'=>'true']) !!}

                    @include('pesan_homestay._form')

            {!! Form::close() !!}


						</div>
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="row" style="padding:10%">
									<div class="col-xs-3">
									{!! Html::image(asset('img/'.$detail_kamar->foto1), null, ['alt' => 'Slide']) !!}					
									</div>
									<div class="col-xs-9">
										<aside class="widget widget_features">
									<h3 class="widget-title">Tentang {{$detail_kamar->rumah->nama_pemilik}}</h3>
									{!!$detail_kamar->deskripsi!!}
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