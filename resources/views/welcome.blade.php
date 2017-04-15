@extends('layouts.app')

@section('content')

    
    
    <main class="site-main page-spacing">
        <!-- Slider Section -->
        <div id="slider-section" class="slider-section container-fluid no-padding">
            <div id="photo-slider" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="images/slider/slide1.jpg" alt="Slide" />
                        
                    </div>
                    <div class="item">
                        <img src="images/slider/slide2.jpg" alt="Slide" />
                        
                    </div>          
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#photo-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                </a>
                <a class="right carousel-control" href="#photo-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                </a>
            </div>
            <p class="goto-next"><a href="#" title="Go to Next" class="bounce"><img src="images/slider/go-to-next.png" alt="Go To Next" /></a></p>
        </div><!-- Slider Section /- -->
        
    <!-- container -->
        <div class="container">
            <div class="booking-form container-fluid">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <h4><span>Pesan</span> Sekarang</h4>
                </div>



          {!! Form::open(['url' => 'pencarian','files'=>'true','method' => 'get', 'class'=>'col-md-10 col-sm-12 col-xs-12']) !!}
                 <div class="row"> 

                    <div class="col-sm-2" id="col-pilihan">
                        <div style="width:180px;" class="form-group {{ $errors->has('pilihan') ? ' has-error' : '' }}">
                            {{ Form::select('pilihan', [
                            '1' => 'HOMESTAY',
                            '2' => 'CULTURAL EXPERIENCES'],null, ['class'=> 'selectpicker', 'id'=>'pilihan' ]
                            ) }}
                            {!! $errors->first('pilihan', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-2"> 
                        <div id="dari_tanggal" style="width:180px;" class="form-group{{ $errors->has('dari_tanggal') ? ' has-error' : '' }}">
                            <i class="fa fa-calendar-minus-o"></i>
                            {!! Form::text('dari_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker1','placeholder'=>'DARI TANGGAL']) !!}
                            {!! $errors->first('dari_tanggal', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>

                    <span id="span_cultur">
                        <div class="col-sm-2">
                            <div id="sampai_tanggal" style="width:180px;"  class="form-group{{ $errors->has('sampai_tanggal') ? ' has-error' : '' }}">
                                <i class="fa fa-calendar-minus-o"></i>
                                {!! Form::text('sampai_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker2','placeholder'=>'SAMPAI TANGGAL']) !!}
                                {!! $errors->first('sampai_tanggal', '<p class="help-block">:message</p>') !!}

                            </div>
                        </div>
                    </span>

                    <div class="col-sm-2" id="col-tujuan">
                        <div style="width:180px;"  class="form-group{{ $errors->has('tujuan') ? ' has-error' : '' }}">
                          {!! Form::select('tujuan', [''=>'TUJUAN']+App\Destinasi::pluck('nama_destinasi','id')->all(), null,['class'=>'selectpicker']) !!}
                          {!! $errors->first('tujuan', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-2" id="col-jumlah">
                        <div style="width:180px;"  class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}">
                            {!! Form::select('jumlah_orang',[
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5'],null,['class'=>'selectpicker','placeholder'=>'JUMLAH ORANG']) !!}

                             {!! $errors->first('jumlah_orang', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group" style="width:100px; ">
                            {!! Form::submit('CARI') !!}
                        </div>
                    </div>


                </div>
               {!! Form::close() !!}
            </div>      
            
        </div>



        
        
      <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                <div class="section-header">
                    <h3>Homestay Terbaik</h3>
                    <p>Pilihan Homestay dengan rating dan harga terbaik pilihan pelanggan setia Endeso. Harga ditampilkan dalam ratusan ribu Rupiah.</p>
                </div>
                <div class="recommended-detail">
                    @foreach($homestay AS $homestays)
                            <div class="col-md-6 col-sm-12 col-xs-12 no-padding hotel-detail">
                                <div class="col-md-6 col-sm-6 col-xs-6 no-padding hotel-img-box">                               
                                    <img src="img/{{ $homestays->foto1 or 'foto1' }}" alt="Recommended" height="267" width="297" />
                                    <span><a href="{{ url('/detail-penginapan-home/')}}/{{$homestays->id_kamar}}">Pesan</a></span>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 hotel-detail-box">
                                    <h4>{{$homestays->rumah->nama_pemilik}}</h4>
                                    <h6><b><sup>RP</sup>{{ $homestays->harga_endeso + $homestays->harga_pemilik }}</b><span>/Malam</span></h6>
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </span>
                                </div>
                            </div>
                    @endforeach                 
                </div>
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->


        <!-- Offer Section -->
        <div class="container-fluid offer-section no-padding">
            <!-- container -->
            <div class="container">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Cultural Experiences Terbaik</h3>
                    <p>Paket Cultural Experiences dengan rating dan harga terbaik pilihan pelanggan setia Endeso.</p>
                </div><!-- Section Header /- -->
                <div class="offer-list">
                    <div class="offer-box tall">
                        <img src="images/offer/offer1.jpg" alt="Offer" />
                        <div class="offer-detail">
                            <h3>Danau <span>Toba</span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> 4.150.000</span></h4>
                                <a class="read-more" title="book now" href="#">pesan <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="offer-box wide">
                        <img src="images/offer/offer2.jpg" alt="Offer" />
                        <div class="offer-detail">
                            <h3>Sumba, <span>NTT</span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> 2.750.000</span></h4>
                                <a class="read-more" title="book now" href="#">pesan <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="offer-box wide">
                        <img src="images/offer/offer3.jpg" alt="Offer" />
                        <div class="offer-detail">
                            <h3>Wamena,  <span>Papua</span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> 8.500.000</span></h4>
                                <a class="read-more" title="book now" href="#">pesan <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="offer-box full">
                        <img src="images/offer/offer4.jpg" alt="Offer" />
                        <div class="offer-detail">
                            <h3>Tana  <span>Toraja</span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> 6.750.000</span></h4>
                                <a class="read-more" title="book now" href="#">book now <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- container /- -->
        </div><!-- Offer Section /- -->
        <div class="section-padding"></div>
        

    </main>



@endsection

 