	@extends('layouts.app')

@section('content')

<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>Festival Danau Toba</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="list.html">Cultural Experiences</a></li>
					<li class="active">Festival Danau Toba</li>
				</ol>
			</div>
            <div class="container" style="color:#faac17"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 5/5</div>
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
								<img src="images/fest-slide.jpg" alt="Slide">
							</div>
							<div class="item">
								<img src="images/fest-slide.jpg" alt="Slide">
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
					
                    <!--- Event -->
                    <h3 style="padding-bottom:25px">Jadwal Kegiatan</h3>
                    <div class="col-md-5 col-sm-12 col-xs-12 event-tabs">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#1" aria-controls="music" role="tab" data-toggle="tab">
								<h5 class="event-date">21 <span>Jan</span></h5>
								<h3 style="color:#000">Hari 1 <span>08.00-17.00</span></h3>
							</a>
						</li>
						<li role="presentation" >
							<a href="#2" aria-controls="movie" role="tab" data-toggle="tab">
								<h5 class="event-date">22 <span>Jan</span></h5>
								<h3 style="color:#000">Hari 2 <span>08.00-17.00</span></h3>
							</a>
						</li>
                        <li role="presentation" >
							<a href="#3" aria-controls="movie" role="tab" data-toggle="tab">
								<h5 class="event-date">23 <span>Jan</span></h5>
								<h3 style="color:#000">Hari 3 <span>08.00-17.00</span></h3>
							</a>
						</li>
					</ul>
				</div>
				<div class="col-md-5 col-sm-12 col-xs-12">
					<div class="tab-content event-content">
						<div role="tabpanel" class="tab-pane active" id="1">
							<div class="event-box">
								<h3>Hari Pertama</h3>
								<p>Detail teks akan dimasukkan disini. Detail teks akan dimasukkan disini. Detail teks akan dimasukkan disini.</p>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane " id="2">
							<div class="event-box">
								<h3>Hari Kedua</h3>
								<p>Detail teks akan dimasukkan disini. Detail teks akan dimasukkan disini. Detail teks akan dimasukkan disini.</p>
							</div>
						</div>
                        <div role="tabpanel" class="tab-pane " id="3">
							<div class="event-box">
								<h3>Hari Ketiga</h3>
								<p>Detail teks akan dimasukkan disini. Detail teks akan dimasukkan disini. Detail teks akan dimasukkan disini.</p>
							</div>
						</div>
					</div>
				</div>
                    <!--- Event / -->
                    
                    <hr width="75%" style="margin-top:100px;margin-bottom:100px">
                    
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
                    <!--- Review /--->
                    
                    <hr width="75%">
                    
					<!-- Form -->
					<div class="booking-form2">
						<h3>Form Pemesanan</h3>
						<form class="row">
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<i class="fa fa-calendar-minus-o"></i>
								<input type="text" placeholder="Tanggal Pergi" id="datepicker1" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<i class="fa fa-calendar-minus-o"></i>
								<input type="text" placeholder="Tanggal Pulang" id="datepicker2" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<select class="selectpicker">
									<option>JUMLAH DEWASA</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<select class="selectpicker">
									<option>JUMLAH ANAK-ANAK</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Nama Lengkap" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Nomor KTP" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Alamat E-mail" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="No. Ponsel" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Alamat 1" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Alamat 2" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Kota" class="form-control"/>
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<input type="text" placeholder="Propinsi" class="form-control"/>
							</div>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<textarea placeholder="Catatan Khusus (Jika ada)" class="form-control"></textarea>
							</div>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<button class="read-more" title="Book Now">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></button>
							</div>
						</form>
					</div><!-- Form /- -->
				</div><!-- Contenta Area /- -->
				<!-- Widget Area -->
				<div class="col-md-4 col-sm-4 col-xs-12 widget-area">
					<!-- Features Widget -->
					<aside class="widget widget_features">
						<h3 class="widget-title">Tentang Festival Danau Toba</h3>
						<p>Setelah ditetapkan menjadi destinasi prioritas, membuat Danau Toba terus kebanjiran even. Belum lepas dari ingatan, hingar-bingar Karnaval Pesona Danau Toba 2016 di Balige, Tobasa, Presiden Joko Widodo ikut hadir, mengenakan baju adat Batak dan membuat suasana di Balige begitu istimewa. Festival Danau Toba (FDI) 2016 itu sendiri bakal dibuat di Kota Muara, Kabupaten Tapanuli Utara, Sumatera Utara (Sumut), 9 – 12 September.</p>
					</aside><!-- Features Widget -->
                    
                    <!-- Features Widget -->
					<aside class="widget widget_features">
						<h3 class="widget-title">Peta</h3>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510166.6709496358!2d98.55577078101425!3d2.610729824375855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031de07a843b6ad%3A0xc018edffa69c0d05!2sLake+Toba!5e0!3m2!1sen!2sid!4v1488293450198" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
					</aside><!-- Features Widget -->
                    
				</div><!-- Widget Area /- -->
			</div>
		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>

		@endsection	