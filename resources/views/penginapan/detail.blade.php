@extends('layouts.app')

@section('content')


<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>Wae Rebo</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="list.html">Rumah Alam</a></li>
					<li class="active">Wae Rebo</li>
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
							<div class="item active">
								<img src="images/booking/booking-slide.jpg" alt="Slide">
							</div>
							<div class="item">
								<img src="images/booking/booking-slide.jpg" alt="Slide">
							</div>
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
						<h3 class="section-heading"><span>2</span> Review dari Pelanggan</h3>
						<ul class="media-list">
							<li class="media">
								<div class="media-left">
									<a href="#" title="Peter Hein"><img src="images/review.jpg" alt="comment"></a>							
								</div>
								<div class="media-body">
									<div class="media-content">
										<h4 class="media-heading">Joko Widodo <span>24 Desember 2016</span><a href="#" title="Reply">Balas</a></h4>
										<p>Wae Rebo memang indah dan menakjubkan, diselimuti oleh kabut tipis di seluruh perkampungan membuat Wae Rebo pantas mendapatkan julukan 'kampung diatas awan'</p>
									</div>
								</div>
							</li>
							<li class="media">
								<div class="media-left">
									<a href="#" title="William Stark"><img src="images/review.jpg" alt="comment"></a>
								</div>
								<div class="media-body">
									<div class="media-content">
										<h4 class="media-heading">Widodo Joko <span>31 Januari 2017</span><a href="#" title="Reply">Balas</a></h4>
										<p>Backpacking saya kali ini menuju Wae Rebo, sebuah kampung yang masih berpegang teguh pada adat istiadat, dimana masyarakatnya masih sangat tradisional</p>
									</div>
								</div>
							</li>
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
                    
			
					<button class="read-more btn-pesan" title="Book Now">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></button>
						
					
				</div><!-- Contenta Area /- -->
				<!-- Widget Area -->
				<div class="col-md-4 col-sm-4 col-xs-12 widget-area">
					<!-- Features Widget -->
					<aside class="widget widget_features">
						<h3 class="widget-title">Tentang Wae Rebo</h3>
						<p>Desa Wae Rebo di Flores yang terletak pada ketinggian 1.200 meter di atas permukaan laut ini layaknya sebuah surga yang berada di atas awan.

Perlu perjuangan untuk bisa mencapainya, namun apa yang didapat ketika sampai ke lokasi sebanding dengan perjalanan yang dilalui.

Pemandangan alam berupa gunung-gunung berpadu dengan 7 rumah adat berbentuk kerucut akan memberi kesan tersendiri bagi setiap pengunjung yang pernah datang ke Desa Wae Rebo.

Desa Wae Rebo berada di barat daya kota Ruteng, Kabupaten Manggarai, Nusa Tenggara Timur. Untuk bisa sampai ke lokasi memang tidak mudah karena letaknya yang di atas gunung.

Perlu tenaga ekstra untuk melakukan perjalanan kaki selama kurang lebih 3 sampai dengan 4 jam. Tergantung kondisi fisik karena trekking menuju desa Wae Rebo mendaki sejauh 7 km.</p>
						<ul>
							<li><img src="images/booking/fet-wid-ic1.png" alt="Features" /> Koneksi Internet Wifi</li>
							<li><img src="images/booking/fet-wid-ic3.png" alt="Features" /> Termasuk Akomodasi Mobil & Supir</li>
                            <li><img src="images/booking/fet-wid-ic6.png" alt="Features" /> Termasuk Laundry</li>
							<li><img src="images/booking/fet-wid-ic4.png" alt="Features" /> Akses Air Bersih</li>
							<li><img src="images/booking/fet-wid-ic5.png" alt="Features" /> Pemandangan</li>
							
						</ul>
					</aside><!-- Features Widget -->
					<!-- Room Detail Widget -->
					<aside class="widget widget_room">
						<h3 class="widget-title">Kegiatan Cultural Experiences</h3>
						<div class="single-room">
							<img src="images/cultural.jpg" alt="Single Room" />
							<h4>Festival ABCDEFG <b>RP 210.000</b> <span>Sumba, Nusa Tenggara Timur</span></h4>
						</div>
                        <div class="single-room">
							<img src="images/cultural.jpg" alt="Single Room" />
							<h4>Festival ABCDEFG <b>RP 210.000</b> <span>Sumba, Nusa Tenggara Timur</span></h4>
						</div>
                        <div class="single-room">
							<img src="images/cultural.jpg" alt="Single Room" />
							<h4>Festival ABCDEFG <b>RP 210.000</b> <span>Sumba, Nusa Tenggara Timur</span></h4>
						</div>
					</aside>
					<!-- Room Detail Widget /- -->
				</div><!-- Widget Area /- -->
			</div>
		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>



@endsection
