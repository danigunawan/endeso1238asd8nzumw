@extends('layouts.app')

@section('content')

<style type="text/css">
    
    .carousel-inner{
  width:100%;
  max-height: 450px !important;
}
</style>

    
    
    <main class="site-main page-spacing">
       

        <!-- Slider Section -->

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
     

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
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
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>


        <!-- Slider Section /- -->
        
    <!-- container -->
           
       
        <!-- form pesan sekarang -->
            <div class="booking-form container-fluid" >
                <div class="col-sm-2 col-sm-12 col-sm-12">
                    <h4><span>Pesan</span> Sekarang</h4>
                </div>

          {!! Form::open(['url' => 'pencarian','files'=>'true','method' => 'get', 'class'=>'col-sm-10 col-sm-12 col-sm-12']) !!}
                 <div class="row"> 

                    <div class="col-sm-2" id="col-pilihan">
                        <div style="width:180px;" class="form-group {{ $errors->has('pilihan') ? ' has-error' : '' }}">
                            {{ Form::select('pilihan', [
                            '1' => 'HOMESTAY',
                            '2' => 'CULTURAL EXPERIENCES'],null, ['class'=> 'selectpicker', 'id'=>'pilihan','style'=>'font-size:70px;' ]
                            ) }}
                            {!! $errors->first('pilihan', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-2"> 
                        <div id="dari_tanggal" style="width:180px;" class="form-group{{ $errors->has('dari_tanggal') ? ' has-error' : '' }}">
                            <i class="fa fa-calendar-minus-o"></i>
                            {!! Form::text('dari_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker1','placeholder'=>'DARI TANGGAL','autocomplete'=>'off','readonly' => 'true']) !!}
                            {!! $errors->first('dari_tanggal', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>

                    <span id="span_cultur">
                        <div class="col-sm-2">
                            <div id="sampai_tanggal" style="width:180px;"  class="form-group{{ $errors->has('sampai_tanggal') ? ' has-error' : '' }}">
                                <i class="fa fa-calendar-minus-o"></i>
                                {!! Form::text('sampai_tanggal', null, ['class'=>'form-control datepicker_sampai_tanggal', 'id'=>'datepicker2','placeholder'=>'SAMPAI TANGGAL','autocomplete'=>'off','readonly' => 'true']) !!}
                                {!! $errors->first('sampai_tanggal', '<p class="help-block">:message</p>') !!}

                            </div>
                        </div>
                    </span>

                    <div class="col-sm-2" id="col-tujuan">
                        <div style="width:180px;"  class="form-group{{ $errors->has('tujuan') ? ' has-error' : '' }}">
                          {!! Form::select('tujuan', [''=>'TUJUAN']+App\Destinasi::pluck('nama_destinasi','id')->all(), null,['class'=>'selectpicker','id' => 'tujuan']) !!}
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
        <!-- / form pesan sekarang -->



        <!-- homestay terbaik Section -->
        <div class="container-fluid offer-section no-padding" >
            <!-- container -->
            <div class="container">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Homestay Terbaik</h3>
                    <p>Homestay Dengan Rating Dan Harga Terbaik Pilihan Pelanggan Setia Endeso.</p>
                </div><!-- Section Header /- -->
              

            
                <div class="row"> 

                @foreach($homestay as $homestays)
                    <a href="{{ url('/detail-penginapan/')}}/{{$homestays->id_kamar}}/{{$tanggal}}/{{$tanggal_sampai_tanggal}}/1">
                   <div class="col-sm-3 list-penginapan section-header">

                   <div id="carousel-homestay-{{$homestays->id_kamar }}" class="carousel slide" data-ride="carousel">
            
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">

                    <div class="item active">
                      <img src="img/{{ $homestays->foto1 }}" alt="{{ $homestays->rumah->nama_pemilik}}">
                    </div>
                    @if($homestays->foto2 != NULL)
                    <div class="item">
                      <img src="img/{{ $homestays->foto2 }}" alt="{{ $homestays->rumah->nama_pemilik}}">
                    </div>
                    @endif
                    @if($homestays->foto3 != NULL)
                    <div class="item">
                      <img src="img/{{ $homestays->foto3 }}" alt="{{ $homestays->rumah->nama_pemilik}}">
                    </div>
                    @endif  
                    @if($homestays->foto4 != NULL)
                    <div class="item">
                      <img src="img/{{ $homestays->foto4 }}" alt="{{ $homestays->rumah->nama_pemilik}}">
                    </div>
                    @endif
                    @if($homestays->foto5 != NULL)
                    <div class="item">
                      <img src="img/{{ $homestays->foto5 }}" alt="{{ $homestays->rumah->nama_pemilik}}">
                    </div>
                    @endif
                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#carousel-homestay-{{$homestays->id_kamar }}" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-homestay-{{$homestays->id_kamar }}" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <!-- / carousel homestay -->
                       <center>
                    <p>

                    @if($homestays->tipe_harga == 1)
                    <b>Rp {{ number_format($homestays->harga_endeso + $homestays->harga_pemilik,0,',','.')  }} </b> /Orang/Malam
                    @elseif($homestays->tipe_harga == 2)
                    Rp <b>{{ number_format($homestays->harga_endeso + $homestays->harga_pemilik,0,',','.')  }}</b> /Kamar/Malam
                    @endif
                    <br>
                        <b>{{ $homestays->rumah->nama_pemilik}}</b><br>
                        KAPASITAS : {{ $homestays->kapasitas}} orang <br>
                        {{ $homestays->destinasi->nama_destinasi}} 
                    </p>
                    <a  title="book now" href="{{ url('/detail-penginapan/')}}/{{$homestays->id_kamar}}/{{$tanggal}}/{{$tanggal_sampai_tanggal}}/1">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></a>
                    
                        </center>
                </div>
                </a> 
                <!-- / row -->

                @endforeach

               
        

              
            </div><!-- container /- -->

        </div><!-- homestay terbaik  /- -->

<!-- culture experience terbaik Section -->
      
        <div class="container-fluid offer-section no-padding" >
            <!-- container -->
            <div class="container">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Culture Experience Terbaik</h3>
                    <p>Paket Cultural Experiences Dengan Rating Dan Harga Terbaik Pilihan Pelanggan Setia Endeso.</p>
                </div><!-- Section Header /- -->
              

            
                <div class="row"> 

                @foreach($cultural as $culturals)

                   <div class="col-sm-3 list-penginapan section-header">

                   <div id="carousel-cultural-{{$culturals->id }}" class="carousel slide" data-ride="carousel">
            
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">

                    <div class="item active">
                      <img src="img/{{ $culturals->foto_kategori }}" alt="{{ $culturals->nama_aktivitas}}">
                    </div>
                    @if($culturals->foto_kategori2 != NULL)
                    <div class="item">
                      <img src="img/{{ $culturals->foto_kategori2 }}" alt="{{ $culturals->nama_aktivitas}}">
                    </div>
                    @endif
                    @if($culturals->foto_kategori3 != NULL)
                    <div class="item">
                      <img src="img/{{ $culturals->foto_kategori3 }}" alt="{{ $culturals->nama_aktivitas}}">
                    </div>
                    @endif  
                    @if($culturals->foto_kategori4 != NULL)
                    <div class="item">
                      <img src="img/{{ $culturals->foto_kategori4 }}" alt="{{ $culturals->nama_aktivitas}}">
                    </div>
                    @endif
                    @if($culturals->foto_kategori5 != NULL)
                    <div class="item">
                      <img src="img/{{ $culturals->foto_kategori5 }}" alt="{{ $culturals->rumah->nama_aktivitas}}">
                    </div>
                    @endif
                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#carousel-cultural-{{$culturals->id }}" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-cultural-{{$culturals->id }}" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <!-- / carousel homestay -->
                       <center>
                    <p>

               
                    <!-- <b>Rp {{ number_format($culturals->harga_endeso + $culturals->harga_pemilik,0,',','.')  }} </b> /Paket -->
                 
                        <b>{{ $culturals->nama_aktivitas}}</b><br>
                        {{ $culturals->destinasi->nama_destinasi}} 
                    </p>
                    <a  title="book now" href="{{ url('/detail-penginapan/')}}/{{$culturals->id_kamar}}/{{$tanggal}}/{{$tanggal_sampai_tanggal}}/1">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></a>
                    
                        </center>
                </div> 
                <!-- / row -->

                @endforeach

               
        

              
            </div><!-- container /- -->

        </div>

<!-- /culture experience terbaik  /- -->

<!-- destinasi homestay -->

   <div class="container-fluid offer-section no-padding" >
            <!-- container -->
            <div class="container">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Destinasi Homestay</h3>
                  
                </div><!-- Section Header /- -->
              

            
                <div class="row"> 

                @foreach($destinasi_homestay as $destinasi_homestays)

                <div class="col-sm-3 section-header col-destinasi-homestay" style="cursor:pointer" data-id="{{ $destinasi_homestays->id_destinasi }}">
          
                      <img src="img/{{ $destinasi_homestays->foto_destinasi }}" alt="{{ $destinasi_homestays->nama_destinasi}}" class="img-responsive" >
                 
                       <center>
                        <p>
                            <b>{{ $destinasi_homestays->nama_destinasi}}</b><br>
                        </p>
                      </center>
                
                </div> 
                <!-- / row -->

                @endforeach

               
        

              
            </div><!-- container /- -->

        </div>

<!-- / destinasi homestay -->

<!-- destinasi cultural -->

   <div class="container-fluid offer-section no-padding" >
            <!-- container -->
            <div class="container">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Destinasi cultural experience</h3>
                  
                </div><!-- Section Header /- -->
      
                <div class="row"> 

                @foreach($destinasi_cultural as $destinasi_culturals)

                <div class="col-sm-3 section-header col-destinasi-culture" style="cursor:pointer" data-id="{{$destinasi_culturals->id_destinasi}}">
          
                      <img src="img/{{ $destinasi_culturals->foto_destinasi }}" alt="{{ $destinasi_culturals->nama_destinasi}}" class="img-responsive" >
                 
                       <center>
                        <p>
                            <b>{{ $destinasi_culturals->nama_destinasi}}</b><br>
                        </p>
                      </center>
                
                </div> 
                <!-- / row -->

                @endforeach

               
        

              
            </div><!-- container /- -->

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
</script>

@endsection
 