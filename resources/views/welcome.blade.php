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
               
            </div>
        </div><!-- Slider Section /- -->
        
    <!-- container -->
           
<?php      

$useragent = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){


    ?>        
     <div class="container">

            <div class="booking-form container-fluid" >
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <h4><span>Pesan</span> Sekarang</h4>
                </div>

          {!! Form::open(['url' => 'pencarian','files'=>'true','method' => 'get', 'class'=>'col-md-10 col-sm-12 col-xs-12']) !!}
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
                            {!! Form::text('dari_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker1','placeholder'=>'DARI TANGGAL','autocomplete'=>'off']) !!}
                            {!! $errors->first('dari_tanggal', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>

                    <span id="span_cultur">
                        <div class="col-sm-2">
                            <div id="sampai_tanggal" style="width:180px;"  class="form-group{{ $errors->has('sampai_tanggal') ? ' has-error' : '' }}">
                                <i class="fa fa-calendar-minus-o"></i>
                                {!! Form::text('sampai_tanggal', null, ['class'=>'form-control datepicker_sampai_tanggal', 'id'=>'datepicker2','placeholder'=>'SAMPAI TANGGAL','autocomplete'=>'off']) !!}
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
        </div>
<?php
}
else{
?>

 <div class="container">
                 <div class="carousel-caption">

            <div class="booking-form container-fluid" >
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <h4><span>Pesan</span> Sekarang</h4>
                </div>

          {!! Form::open(['url' => 'pencarian','files'=>'true','method' => 'get', 'class'=>'col-md-10 col-sm-12 col-xs-12']) !!}
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
                            {!! Form::text('dari_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker1','placeholder'=>'DARI TANGGAL','autocomplete'=>'off']) !!}
                            {!! $errors->first('dari_tanggal', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>

                    <span id="span_cultur">
                        <div class="col-sm-2">
                            <div id="sampai_tanggal" style="width:180px;"  class="form-group{{ $errors->has('sampai_tanggal') ? ' has-error' : '' }}">
                                <i class="fa fa-calendar-minus-o"></i>
                                {!! Form::text('sampai_tanggal', null, ['class'=>'form-control datepicker_sampai_tanggal', 'id'=>'datepicker2','placeholder'=>'SAMPAI TANGGAL','autocomplete'=>'off']) !!}
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
           </div>      
        </div>
 <?php
    }
 ?>       
        


        <!-- Offer Section -->
        <div class="container-fluid offer-section no-padding" style="padding-top: 30px">
            <!-- container -->
            <div class="container">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Destinasi Cultural Experiences</h3>
                    <p>Paket Cultural Experiences Dengan Rating Dan Harga Terbaik Pilihan Pelanggan Setia Endeso.</p>
                </div><!-- Section Header /- -->
                
                @if (isset($warga_1))
                <div class="row"> 

                   <div class="col-sm-2"> </div> 
                   <div class="col-sm-8"> 

                    <div class="offer-box full">
                        <img src="img/{{ $setting_halaman_culture->foto_1 or 'foto_1' }}" alt="Offer" />
                        <div class="offer-detail">
                            <h3><span>{{$kategori_1->nama_aktivitas}} ({{$destinasi_1->nama_destinasi}}) </span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> {{number_format($warga_1->harga_endeso + $warga_1->harga_pemilik,0,',','.')}}</span></h4>
                                <a class="read-more" title="book now" href="{{ url('/detail-cultural/')}}/{{$kategori_1->id}}/{{$tanggal}}/1">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                   </div> 
                   <div class="col-sm-2"> </div> 

                </div>
                @endif

                @if (isset($warga_2))
                <div class="row"> 

                   <div class="col-sm-2"> </div> 
                   <div class="col-sm-8"> 

                    <div class="offer-box full">
                        <img src="img/{{ $setting_halaman_culture->foto_2 or 'foto_2' }}" alt="Offer" />
                        <div class="offer-detail">
                            <h3><span>{{$kategori_2->nama_aktivitas}} ({{$destinasi_2->nama_destinasi}}) </span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> {{number_format($warga_2->harga_endeso + $warga_2->harga_pemilik,0,',','.')}}</span></h4>
                                <a class="read-more" title="book now" href="{{ url('/detail-cultural/')}}/{{$kategori_2->id}}/{{$tanggal}}/1">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                   </div> 
                   <div class="col-sm-2"> </div> 

                </div>
                @endif

                @if (isset($warga_3))
                <div class="row"> 

                   <div class="col-sm-2"> </div> 
                   <div class="col-sm-8"> 

                    <div class="offer-box full">
                        <img src="img/{{ $setting_halaman_culture->foto_3 or 'foto_3' }}" alt="Offer" />
                        <div class="offer-detail">
                            <h3><span>{{$kategori_3->nama_aktivitas}} ({{$destinasi_3->nama_destinasi}}) </span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> {{number_format($warga_3->harga_endeso + $warga_3->harga_pemilik,0,',','.')}}</span></h4>
                                <a class="read-more" title="book now" href="{{ url('/detail-cultural/')}}/{{$kategori_3->id}}/{{$tanggal}}/1">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                   </div> 
                   <div class="col-sm-2"> </div> 

                </div>
                @endif

                @if (isset($warga_4))
                <div class="row"> 

                   <div class="col-sm-2"> </div> 
                   <div class="col-sm-8"> 

                    <div class="offer-box full">
                        <img src="img/{{ $setting_halaman_culture->foto_4 or 'foto_4' }}" alt="Offer" />
                        <div class="offer-detail">
                            <h3><span>{{$kategori_4->nama_aktivitas}} ({{$destinasi_4->nama_destinasi}}) </span></h3>
                            <div class="price-detail">
                                <h4>mulai dari <span><sup>RP</sup> {{number_format($warga_4->harga_endeso + $warga_4->harga_pemilik,0,',','.')}}</span></h4>
                                <a class="read-more" title="book now" href="{{ url('/detail-cultural/')}}/{{$kategori_4->id}}/{{$tanggal}}/1">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                   </div> 
                   <div class="col-sm-2"> </div> 

                </div>
                @endif
            </div><!-- container /- -->
        </div><!-- Offer Section /- -->
        <div class="section-padding"></div>
        

    </main>



@endsection

 