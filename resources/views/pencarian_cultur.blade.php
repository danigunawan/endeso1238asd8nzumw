	@extends('layouts.app')

@section('content')
	<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>Cultural Experiences</h3>
				<ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
					<li class="active">Cultural Experiences</li>
				</ol>
			</div>
		</div><!-- Page Banner /- -->
        
        		<div class="section-top-padding"></div>

		<!-- Recommended Section -->
		<div id="recommended-section" class="recommended-section container-fluid no-padding">
			<!-- Container -->
			<div class="container">

				@foreach($kategori as $kategoris)

				<div class="recommended-detail">
					<div class="col-md-6 col-sm-12 col-xs-12 no-padding hotel-detail">
						<div class="col-md-6 col-sm-6 col-xs-6 no-padding hotel-img-box">
							<img src="img/{{$kategoris->foto_kategori or 'foto_kategori' }}" alt="Recommended" height="267" width="297" />
							<span><a href="{{ url ('/detail-cultural/')}}/{{$kategoris->id}}">Pesan</a></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 hotel-detail-box">
							<h4>{!! $kategoris->nama_aktivitas !!}</h4>
							<h6><b><sup>RP</sup> 550</b><span>ribu / paket</span></h6>
							<span>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
								<i class="fa fa-star-half-o"></i>
							</span>
						</div>
					</div>
					
				</div>

				@endforeach

			</div><!-- Container /- -->
			<div class="section-padding"></div>
		</div><!-- Recommended Section /- -->
		
	</main>

	@endsection	