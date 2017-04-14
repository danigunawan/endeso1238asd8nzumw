@extends('layouts.app')

@section('content')


<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>{{$kamar->rumah->nama_pemilik}}</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="list.html">Rumah Alam</a></li>
					<li class="active">{{$kamar->rumah->nama_pemilik}}</li>
				</ol>
			</div>
            <div class="container" style="color:#faac17"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i> 4.5/5</div>
		</div><!-- Page Banner /- -->
		
		<div class="section-top-padding"></div>
		
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Contenta Area -->
				<div class="col-md-8 col-sm-8 col-xs-12 content-area">
					<div id="booking-carousel" class="carousel slide booking-carousel" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
						<!--foto 1-->
						@if (isset($kamar) && $kamar->foto1)
							<div class="item active">
						{!! Html::image(asset('img/'.$kamar->foto1), null, ['alt' => 'Slide']) !!}					
						</div>
						@endif
						<!--foto 1-->
						<!--foto 2-->
						@if (isset($kamar) && $kamar->foto2)
							<div class="item">
						{!! Html::image(asset('img/'.$kamar->foto2), null, ['alt' => 'Slide']) !!}					
							</div>
						@endif
						<!--foto 2-->
						<!--foto 3-->
						@if (isset($kamar) && $kamar->foto3)							
						<div class="item">
						{!! Html::image(asset('img/'.$kamar->foto3), null, ['alt' => 'Slide']) !!}					
							</div>
							@endif
						<!--foto 3-->
						<!--foto 4-->
						@if (isset($kamar) && $kamar->foto4)
						<div class="item">
						{!! Html::image(asset('img/'.$kamar->foto4), null, ['alt' => 'Slide']) !!}					
							</div>
							@endif
						<!--foto 4-->
						<!--foto 5-->
						@if (isset($kamar) && $kamar->foto5)
						<div class="item">
						{!! Html::image(asset('img/'.$kamar->foto5), null, ['alt' => 'Slide']) !!}					
							</div>
							@endif
						<!--foto 5-->
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#booking-carousel" role="button" data-slide="prev">
							<span class="fa fa-caret-left" aria-hidden="true"></span>
						</a>
						<a class="right carousel-control" href="#booking-carousel" role="button" data-slide="next">
							<span class="fa fa-caret-right" aria-hidden="true"></span>
						</a>
					</div>
					
                    <!--- Review -->
                    <div class="comment-section">
						<h3 class="section-heading"> Review dari Pelanggan</h3>
						<ul class="media-list">
						@foreach($komentar as $komentars)
							<div class="panel panel-default">
							<li class="row" style="padding:5%">
								<div class="col-sm-2">
							<a href="#" title="Peter Hein">
							@if (isset($komentars) && $komentars->user->foto_profil)
							{!! Html::image(asset('img/'.$komentars->user->foto_profil), null, ['alt' => 'comment']) !!}
							@else
							{!! Html::image(asset('images/user_icon.jpg'), null, ['alt' => 'comment']) !!}	
							@endif
							</a>							
								</div>
								<div class="col-sm-10">
									<div class="media-content">
										<h4 class="media-heading">{{$komentars->user->name}} <span>{{$komentars->created_at}}</span><a href="#" title="Reply">Balas</a></h4>
										<p>{{$komentars->isi_komentar}}</p>
									</div>
								</div>
								</li>
							</div>
							@endforeach
						</ul>
					</div>
					<div class="comment-form">
						<h3>Bagikan Pengalamanmu</h3>
						<form class="row">
							<div class="form-group col-md-6">
								<input type="text" required="" placeholder="Nama Lengkap" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<input type="text" required="" placeholder="Nomor Pesanan Endeso" class="form-control">
							</div>												
							<div class="form-group col-md-12">
								<textarea placeholder="Tuliskan Pengalamanmu" rows="8" class="form-control"></textarea>
							</div>
							<div class="form-group col-md-12">
								<input type="submit" title="Submit" value="Kirim Review" name="submit">
							</div>
						</form>
					</div>
                    <!-- Review -->
                    
			
					<a href="{{ url('/pesan-homestay/'.$kamar->id_kamar.'/'.$tanggal_checkin.'/'.$tanggal_checkout)}}" class="read-more btn-pesan" title="Book Now">Pesan Sekarang (Rp. {{$kamar->harga_endeso + $kamar->harga_pemilik}}) <i class="fa fa-long-arrow-right"></i></a>
						
					
				</div><!-- Contenta Area /- -->
				<!-- Widget Area -->
				<div class="col-md-4 col-sm-4 col-xs-12 widget-area">
					<!-- Features Widget -->
					<aside class="widget widget_features">
						<h3 class="widget-title">Tentang {{$kamar->rumah->nama_pemilik}}</h3>
						{!!$kamar->deskripsi!!}
						
					</aside><!-- Features Widget -->
					<!-- Room Detail Widget -->
					<aside class="widget widget_room">

						<h3 class="widget-title"> Homestay Lainnya </h3>
						@foreach($kamar_lain as $kamar_lains)
							<div class="single-room">
							@if (isset($kamar_lains) && $kamar_lains->foto1)
							<a href="{{url('/detail-penginapan/'.$kamar_lains->id_kamar.'/'.$tanggal_checkin.'/'.$tanggal_checkout)}}">{!! Html::image(asset('img/'.$kamar_lains->foto1), null, ['alt' => 'Slide','style'=>'width:30%']) !!}</a>					
							@endif
							<a href="{{url('/detail-penginapan/'.$kamar_lains->id_kamar.'/'.$tanggal_checkin.'/'.$tanggal_checkout)}}"><h4>{{$kamar_lains->rumah->nama_pemilik}}<b>{{$kamar_lains->harga_endeso + $kamar_lains->harga_pemilik}}</b> <span>{{$kamar_lains->destinasi->nama_destinasi}}</span></h4></a>
						</div>
						@endforeach
					</aside>
					<!-- Room Detail Widget /- -->
				</div><!-- Widget Area /- -->
			</div>
		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>



@endsection
