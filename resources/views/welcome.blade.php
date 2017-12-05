@extends('layouts.app')

@section('content')
<style type="text/css">
    .carousel-home{
  width:100%;
  max-height: 450px !important;
}



.iosSlider{
  width: 100%;
  height: 450px;
}

.iosSlider .slider {
  width: 100%;
  height: 100%;
}

@if ($agent->isMobile())

.iosSlider .slider .item {
  float: left;
  width: 50%;

  padding-right: 10px;
}


@else 

.iosSlider .slider .item {
  float: left;
  width: 25%;

  padding-right: 10px;
}

@endif




.container-homestay .unselectable {
  opacity: 0.2;
}


.contaier-homestay{

  padding-bottom: 20px;
}

@if (!$agent->isMobile())

 .glyphicon-chevron-left {
    font-size: 50px;
    margin-top: 75%;
}

 .glyphicon-chevron-right {
    font-size: 50px;
    margin-top: 75%;
}


@endif
</style>
<main class="site-main page-spacing">
    <!-- Slider Section -->
    <div class="carousel slide" data-ride="carousel" id="myCarousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner carousel-home">
            <div class="item active">
                @if (isset($setting_foto_home) && $setting_foto_home->foto_1) 
                                {!! Html::image(asset('img/'.$setting_foto_home->foto_1), null, ['alt' => 'Slide']) !!} 
                @endif
            </div>
            <div class="item">
                @if (isset($setting_foto_home) && $setting_foto_home->foto_2) 
                                {!! Html::image(asset('img/'.$setting_foto_home->foto_2), null, ['alt' => 'Slide']) !!} 
                @endif
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" data-slide="prev" href="#myCarousel">
            <span class="glyphicon glyphicon-chevron-left">
            </span>
            <span class="sr-only">
                Previous
            </span>
        </a>
        <a class="right carousel-control" data-slide="next" href="#myCarousel">
            <span class="glyphicon glyphicon-chevron-right">
            </span>
            <span class="sr-only">
                Next
            </span>
        </a>
    </div>
    <!-- Slider Section /- -->
    <!-- container -->
    <!-- form pesan sekarang -->
    <div class="booking-form container-fluid">
        <div class="col-sm-2 col-sm-12 col-sm-12">
            <h4>
                <span>
                    Pesan
                </span>
                Sekarang
            </h4>
        </div>
        {!! Form::open(['url' => 'pencarian','files'=>'true','method' => 'get', 'class'=>'col-sm-10 col-sm-12 col-sm-12']) !!}
        <div class="row">
            <div class="col-sm-2" id="col-pilihan">
                <div class="form-group{{ $errors->has('pilihan') ? ' has-error' : '' }}" style="width:180px;">
                    {!! Form::select('pilihan',  [
                            '1' => 'HOMESTAY',
                            '2' => 'CULTURAL EXPERIENCES'], null,['class'=>'selectpicker','id' => 'pilihan']) !!}
                          {!! $errors->first('pilihan', '
                    <p class="help-block">
                        :message
                    </p>
                    ') !!}
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group{{ $errors->has('dari_tanggal') ? ' has-error' : '' }}" id="dari_tanggal" style="width:180px;">
                    <i class="fa fa-calendar-minus-o">
                    </i>
                    {!! Form::text('dari_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker1','placeholder'=>'DARI TANGGAL','autocomplete'=>'off','readonly' => 'true']) !!}
                            {!! $errors->first('dari_tanggal', '
                    <p class="help-block">
                        :message
                    </p>
                    ') !!}
                </div>
            </div>
            <span id="span_cultur">
                <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('sampai_tanggal') ? ' has-error' : '' }}" id="sampai_tanggal" style="width:180px;">
                        <i class="fa fa-calendar-minus-o">
                        </i>
                        {!! Form::text('sampai_tanggal', null, ['class'=>'form-control datepicker_sampai_tanggal', 'id'=>'datepicker2','placeholder'=>'SAMPAI TANGGAL','autocomplete'=>'off','readonly' => 'true']) !!}
                                {!! $errors->first('sampai_tanggal', '
                        <p class="help-block">
                            :message
                        </p>
                        ') !!}
                    </div>
                </div>
            </span>
            <div class="col-sm-2" id="col-tujuan">
                <div class="form-group{{ $errors->has('tujuan') ? ' has-error' : '' }}" style="width:180px;">
                    {!! Form::select('tujuan', [''=>'TUJUAN']+App\Destinasi::pluck('nama_destinasi','id')->all(), null,['class'=>'selectpicker','id' => 'tujuan']) !!}
                          {!! $errors->first('tujuan', '
                    <p class="help-block">
                        :message
                    </p>
                    ') !!}
                </div>
            </div>
            <div class="col-sm-2" id="col-jumlah">
                <div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}" style="width:180px;">
                    {!! Form::select('jumlah_orang',[
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10',
                            '11' => '11',
                            '12' => '12',
                            '13' => '13',
                            '14' => '14',
                            '15' => '15',],null,['class'=>'selectpicker','placeholder'=>'JUMLAH ORANG']) !!}


                             {!! $errors->first('jumlah_orang', '
                    <p class="help-block">
                        :message
                    </p>
                    ') !!}
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
    <!-- / form pesan sekarang -->
    <!-- homestay terbaik Section -->
    <!-- container -->
    <div class="container container-homestay offer-section">
        <!-- Section Header -->
        <div class="section-header">
            <h3>
                Homestay Terbaik
            </h3>
            <p>
                Homestay Dengan Rating Dan Harga Terbaik Pilihan Pelanggan Setia Endeso.
            </p>
        </div>
        <!-- Section Header /- -->
        <div class="row">
            <div class="col-sm-1">
                @if (!$agent->isMobile())
                <span class="glyphicon glyphicon-chevron-left prev-homestay">
                </span>
                @endif
            </div>
            <div class="col-sm-10">
                <div class="iosSliderHomestay iosSlider ">
                    <div class="slider">
                        @foreach($homestay as $homestays)
                        <a href="{{ url('/detail-penginapan/')}}/{{$homestays->id_kamar}}/{{$tanggal}}/{{$tanggal_sampai_tanggal}}/1">
                            <div class="item list-penginapan section-header">
                                <!-- carousel homestay -->
                                <img alt="{{ $homestays->rumah->nama_pemilik}}" src="img/{{ $homestays->foto1 }}">
                                    <!-- / carousel homestay -->
                                    <center>
                                        <p>
                                            @if($homestays->tipe_harga == 1)
                                            <b>
                                                Rp {{ number_format($homestays->harga_endeso + $homestays->harga_pemilik,0,',','.')  }}
                                            </b>
                                            /Orang/Malam
                    @elseif($homestays->tipe_harga == 2)
                    Rp
                                            <b>
                                                {{ number_format($homestays->harga_endeso + $homestays->harga_pemilik,0,',','.')  }}
                                            </b>
                                            /Kamar/Malam
                    @endif
                                            <br>
                                                <b>
                                                    {{ $homestays->rumah->nama_pemilik}}
                                                </b>
                                                <br>
                                                    KAPASITAS : {{ $homestays->kapasitas}} orang
                                                    <br>
                                                        {{ $homestays->destinasi->nama_destinasi}}
                                                    </br>
                                                </br>
                                            </br>
                                        </p>
                                        <a href="{{ url('/detail-penginapan/')}}/{{$homestays->id_kamar}}/{{$tanggal}}/{{$tanggal_sampai_tanggal}}/1" title="book now">
                                            Pesan Sekarang
                                            <i class="fa fa-long-arrow-right">
                                            </i>
                                        </a>
                                    </center>
                                </img>
                            </div>
                            <!-- / div item -->
                        </a>
                        @endforeach
                    </div>
                    <!-- / slider -->
                </div>
                <!-- / iosslider -->
            </div>
            <div class="col-sm-1">
                @if (!$agent->isMobile())
                <span class="glyphicon glyphicon-chevron-right next-homestay">
                </span>
                @endif
            </div>
        </div>
        <!-- / div row -->
    </div>
    <!-- container homestay terbaik  /- -->
    <!-- culture experience terbaik Section -->
    <div class="container offer-section ">
        <!-- Section Header -->
        <div class="section-header">
            <h3>
                Culture Experience Terbaik
            </h3>
            <p>
                Paket Cultural Experiences Dengan Rating Dan Harga Terbaik Pilihan Pelanggan Setia Endeso.
            </p>
        </div>
        <!-- Section Header /- -->
        <div class="row">
            <div class="col-sm-1">
                @if (!$agent->isMobile())
                <span class="glyphicon glyphicon-chevron-left prev-ce">
                </span>
                @endif
            </div>
            <div class="col-sm-10">
                <div class="iosSliderCe iosSlider">
                    <div class="slider">
                        @foreach($cultural as $culturals)
                        <div class="item section-header">
                            <img alt="{{ $culturals->nama_aktivitas}}" src="img/{{ $culturals->foto_kategori }}">
                                <center>
                                    <p>
                                        <!-- <b>Rp {{ number_format($culturals->harga_endeso + $culturals->harga_pemilik,0,',','.')  }} </b> /Paket -->
                                        <b>
                                            {{ $culturals->nama_aktivitas}}
                                        </b>
                                        <br>
                                            {{ $culturals->destinasi->nama_destinasi}}
                                        </br>
                                    </p>
                                    <a href="{{ url('/detail-penginapan/')}}/{{$culturals->id}}/{{$tanggal}}/{{$tanggal_sampai_tanggal}}/1" title="book now">
                                        Pesan Sekarang
                                        <i class="fa fa-long-arrow-right">
                                        </i>
                                    </a>
                                </center>
                            </img>
                        </div>
                        <!-- / row -->
                        @endforeach
                    </div>
                    <!-- / slider -->
                </div>
                <!-- / iosslider -->
            </div>
            <div class="col-sm-1">
                @if (!$agent->isMobile())
                <span class="glyphicon glyphicon-chevron-right next-ce">
                </span>
                @endif
            </div>
        </div>
        <!-- / div row -->
        <!-- /culture experience terbaik  /- -->
        <!-- destinasi homestay -->
        <div class="container offer-section ">
            <!-- Section Header -->
            <div class="section-header">
                <h3>
                    Destinasi Homestay
                </h3>
            </div>
            <!-- Section Header /- -->
            <div class="row">
                <div class="col-sm-1">
                    @if (!$agent->isMobile())
                    <span class="glyphicon glyphicon-chevron-left prev-destinasi-homestay">
                    </span>
                    @endif
                </div>
                <div class="col-sm-10">
                    <div class="iosSliderDestinasiHomestay iosSlider">
                        <div class="slider">
                            @foreach($destinasi_homestay as $destinasi_homestays)
                            <div class="item section-header col-destinasi-homestay" data-id="{{ $destinasi_homestays->id_destinasi }}" style="cursor:pointer">
                                <img alt="{{ $destinasi_homestays->nama_destinasi}}" class="img-responsive" src="img/{{ $destinasi_homestays->foto_destinasi }}">
                                    <center>
                                        <p>
                                            <b>
                                                {{ $destinasi_homestays->nama_destinasi}}
                                            </b>
                                            <br>
                                            </br>
                                        </p>
                                    </center>
                                </img>
                            </div>
                            <!-- / row -->
                            @endforeach
                        </div>
                        <!-- /slider -->
                    </div>
                    <!-- / iosslider -->
                </div>
                <div class="col-sm-1">
                    @if (!$agent->isMobile())
                    <span class="glyphicon glyphicon-chevron-right next-destinasi-homestay">
                    </span>
                    @endif
                </div>
            </div>
            <!-- / div row -->
        </div>
        <!-- / destinasi homestay -->
        <!-- destinasi cultural -->
        <div class="container offer-section">
            <!-- Section Header -->
            <div class="section-header">
                <h3>
                    Destinasi cultural experience
                </h3>
            </div>
            <!-- Section Header /- -->
            <div class="row">
                <div class="col-sm-1">
                    @if (!$agent->isMobile())
                    <span class="glyphicon glyphicon-chevron-left prev-destinasi-ce">
                    </span>
                    @endif
                </div>
                <div class="col-sm-10">
                    <div class="iosSliderDestinasiCe iosSlider">
                        <div class="slider">
                            @foreach($destinasi_cultural as $destinasi_culturals)
                            <div class="item section-header col-destinasi-culture" data-id="{{$destinasi_culturals->id_destinasi}}" style="cursor:pointer">
                                <img alt="{{ $destinasi_culturals->nama_destinasi}}" class="img-responsive" src="img/{{ $destinasi_culturals->foto_destinasi }}">
                                    <center>
                                        <p>
                                            <b>
                                                {{ $destinasi_culturals->nama_destinasi}}
                                            </b>
                                            <br>
                                            </br>
                                        </p>
                                    </center>
                                </img>
                            </div>
                            <!-- / row -->
                            @endforeach
                        </div>
                        <!-- slider -->
                    </div>
                    <!-- / iosslider -->
                </div>
                <div class="col-sm-1">
                    @if (!$agent->isMobile())
                    <span class="glyphicon glyphicon-chevron-right next-destinasi-ce">
                    </span>
                    @endif
                </div>
            </div>
            <!-- / div row -->
        </div>
        <!-- container /- -->
    </div>
    <!-- / destinasi cultural -->
</main>
@endsection
@section('scripts')
<script type="text/javascript">
    $(".col-destinasi-culture").click(function() {
    $('html,body').animate({
        scrollTop: $(".site-main").offset().top},
        'slow');
    var tujuan = $(this).attr('data-id');
  
    $("#pilihan").val('2');
    $("#tujuan").val(tujuan);
   
    $("#span_cultur").hide();
    $("#datepicker1").attr("placeholder","TANGGAL");
    $('.selectpicker').selectpicker('refresh');

    });

    $(".col-destinasi-homestay").click(function() {
    $('html,body').animate({
        scrollTop: $(".site-main").offset().top},
        'slow');
    var tujuan = $(this).attr('data-id');
 

    $("#pilihan").val('1');
    $("#tujuan").val(tujuan);
  
    $("#span_cultur").show();
    $("#datepicker1").attr("placeholder","DARI TANGGAL");

    $('.selectpicker').selectpicker('refresh');

    });


      $(document).ready(function() {
        
        $('.iosSliderHomestay').iosSlider({
          snapToChildren: true,
          keyboardControls: true,
           desktopClickDrag: true,
          navNextSelector: $('.next-homestay'),
          navPrevSelector: $('.prev-homestay'),
          autoSlide : true,
          infiniteSlider : true,
          scrollbar:true,
          autoSlideTimer :3000,
        });

        $('.iosSliderCe').iosSlider({
          snapToChildren: true,
          keyboardControls: true,
           desktopClickDrag: true,
          autoSlide : true, 
          navNextSelector: $('.next-ce'),
          navPrevSelector: $('.prev-ce'),
          infiniteSlider : true,
          scrollbar:true,
          autoSlideTimer :3000,
        });
        $('.iosSliderDestinasiHomestay').iosSlider({
          snapToChildren: true,
          keyboardControls: true,
           desktopClickDrag: true,
          autoSlide : true, 
          navNextSelector: $('.next-destinasi-homestay'),
          navPrevSelector: $('.prev-destinasi-homestay'),
          infiniteSlider : true,
          scrollbar:true,
          autoSlideTimer :3000,
        });
      $('.iosSliderDestinasiCe').iosSlider({
          snapToChildren: true,
          keyboardControls: true,
           desktopClickDrag: true,
          autoSlide : true, 
          navNextSelector: $('.next-destinasi-ce'),
          navPrevSelector: $('.prev-destinasi-ce'),
          infiniteSlider : true,
          scrollbar:true,
          autoSlideTimer :3000,
        });
      
        $('i:contains("version")').html('');
        
      });
</script>
@endsection
