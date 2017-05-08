@extends('layouts.app')

@section('content')

<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>{{$detail_cultural->nama_aktivitas}}</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="{{ url('/list-cultural')}}">Cultural Experiences</a></li>
					<li class="active">{{$detail_cultural->nama_aktivitas}}</li>
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
						<!--foto_kategori 1-->
							@if (isset($detail_cultural) && $detail_cultural->foto_kategori)
								<div class="item active">
									{!! Html::image(asset('img/'.$detail_cultural->foto_kategori), null, ['alt' => 'Slide']) !!}					
								</div>
							@endif
						<!--foto_kategori 1-->

						<!--foto_kategori 2-->
							@if (isset($detail_cultural) && $detail_cultural->foto_kategori2)
								<div class="item">
									{!! Html::image(asset('img/'.$detail_cultural->foto_kategori2), null, ['alt' => 'Slide']) !!}					
								</div>
							@endif
						<!--foto_kategori 2-->

						<!--foto_kategori 3-->
							@if (isset($detail_cultural) && $detail_cultural->foto_kategori3)
								<div class="item">
									{!! Html::image(asset('img/'.$detail_cultural->foto_kategori3), null, ['alt' => 'Slide']) !!}					
								</div>
							@endif
						<!--foto_kategori 3-->

						<!--foto_kategori 4-->
							@if (isset($detail_cultural) && $detail_cultural->foto_kategori4)
								<div class="item">
									{!! Html::image(asset('img/'.$detail_cultural->foto_kategori4), null, ['alt' => 'Slide']) !!}					
								</div>
							@endif
						<!--foto_kategori 4-->

						<!--foto_kategori 5-->
							@if (isset($detail_cultural) && $detail_cultural->foto_kategori5)
								<div class="item">
									{!! Html::image(asset('img/'.$detail_cultural->foto_kategori5), null, ['alt' => 'Slide']) !!}					
								</div>
							@endif
						<!--foto_kategori 5-->
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#booking-carousel" role="button" data-slide="prev">
							<span class="fa fa-caret-left" aria-hidden="true"></span>
						</a>
						<a class="right carousel-control" href="#booking-carousel" role="button" data-slide="next">
							<span class="fa fa-caret-right" aria-hidden="true"></span>
						</a>
					</div>

					
                    <!--- Event 
                    <h3 style="padding-bottom:25px">Jadwal Kegiatan</h3>
                    <div class="col-md-5 col-sm-12 col-xs-12 event-tabs">
					 Nav tabs 
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
                     Event / -->
                    
                    <hr width="75%" style="margin-top:100px;margin-bottom:100px">

                     <!--- Review -->
                    <div class="comment-section">
						<h3 class="section-heading"> Review dari Pelanggan</h3>
						<ul class="media-list">
						@foreach($komentar_kategori as $komentar_kategoris)
							<div class="panel panel-default">
							<li class="row" style="padding:5%">
								<div class="col-sm-2">
							<a href="#" title="Peter Hein">
							@if (isset($komentar_kategoris) && $komentar_kategoris->user->foto_profil)
							{!! Html::image(asset('img/'.$komentar_kategoris->user->foto_profil), null, ['alt' => 'comment']) !!}
							@else
							{!! Html::image(asset('images/user_icon.jpg'), null, ['alt' => 'comment']) !!}	
							@endif
							</a>							
								</div>
								<div class="col-sm-10">
									<div class="media-content">
										<h4 class="media-heading">{{$komentar_kategoris->user->name}} <span>{{$komentar_kategoris->created_at}}</span></h4>
										<p>{{$komentar_kategoris->isi_komentar}}</p>
									</div>
								</div>
								</li>
							</div>
							@endforeach
						</ul>
					</div>


            {!! Form::model($warga, ['url' => route('komentar_cultural.proses'),
            'method' => 'get', 'files'=>'true']) !!}
                    @include('komentar_kategori._form')
            {!! Form::close() !!}

                    
                    <hr width="75%">
                    
					<!-- Form 
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
					</div> Form /- -->
				</div><!-- Contenta Area /- -->
				<!-- Widget Area -->
				<div class="col-md-4 col-sm-4 col-xs-12 widget-area">
					<!-- Features Widget -->
					<aside class="widget widget_features">
						<h3 class="widget-title">Tentang {{$detail_cultural->nama_aktivitas}}</h3>
						<p>{!! $detail_cultural->deskripsi_kategori !!}</p>
					</aside><!-- Features Widget -->

                   	<a href="{{ url('/pesan-cultural/'.$detail_cultural->id.'/'.$tanggal_masuk.'/'.$jumlah_orang)}}" class="read-more btn-pesan" title="Book Now">Pesan Sekarang (Rp. {{number_format(($warga->harga_endeso + $warga->harga_pemilik) * $jumlah_orang),0,',','.'}}) <i class="fa fa-long-arrow-right"></i></a>

                    <!-- Features Widget 
					<aside class="widget widget_features">
						<h3 class="widget-title">Peta</h3>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510166.6709496358!2d98.55577078101425!3d2.610729824375855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031de07a843b6ad%3A0xc018edffa69c0d05!2sLake+Toba!5e0!3m2!1sen!2sid!4v1488293450198" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
					</aside> Features Widget -->


                        <!-- Panel Rincian Harga /- -->

                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: #df9915; color: white"><h4>Rincian Harga</h4></div>
                              <div class="panel-body">
                                <table class="table-sm">
                                    <tbody>
                                        <tr><td  width="50%" style="font-size:100%"><b> Warga </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:100%"><b><span id="nama_warga"> {{$detail_cultural->nama_aktivitas}} </span></b></td></tr>
                                        <tr><td  width="50%" style="font-size:100%">Harga </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:100%">Rp. {{number_format(($warga->harga_endeso + $warga->harga_pemilik) * $jumlah_orang),0,',','.'}} <span id="harga_cultural"></span> </td></tr>
                                        <tr><td  width="50%" style="font-size:100%;"><span id="hitung_orang">{{$jumlah_orang}}</span> Orang x Rp. <span id="hitung_harga_orang">{{number_format(($warga->harga_endeso + $warga->harga_pemilik)),0,',','.'}}</span> </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:100%">Rp. <span id="harga_jumlah_orang">{{number_format(($warga->harga_endeso + $warga->harga_pemilik) * $jumlah_orang),0,',','.'}}</span> </td></tr>

                                    </tbody>
                                </table>
                                <hr>
                                <table class="table-sm">
                                    <tbody>
                                        <span style="display: none" id="harga_endeso_hidden"> </span>
                                        <tr><td width="50%" style="font-size:100%;color:red;"><b>  Harga Total </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:100%;color:red;" ><b> Rp. <span id="harga_endeso"> {{number_format(($warga->harga_endeso + $warga->harga_pemilik) * $jumlah_orang),0,',','.'}} </span> </b></td></tr>
                                        <tr><td width="50%" style="font-size:80%;color:red;"><b><p></p> Jumlah yang harus dibayar<br>sekarang (DP)  </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:100%;color:red;" ><b> Rp. <span id="harga_total"> {{number_format($warga->harga_endeso * $jumlah_orang),0,',','.'}} </span> </b></td></tr>
                                    </tbody>
                                </table>
                              </div>
                        </div>
                        <!-- Panel Rincian Harga /- -->
                    
				</div><!-- Widget Area /- -->

			</div>
		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>

		@endsection	