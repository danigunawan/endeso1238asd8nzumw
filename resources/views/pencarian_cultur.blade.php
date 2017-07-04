	@extends('layouts.app')

@section('content')

<style type="text/css">

.list-ce:hover {
    background: #f2f2f2;
}

    
.booking-form {
    background-color: #fff;
}

.booking-form .form-group .btn-default{
     color:#000000;
}

.booking-form form .form-group input {
      color:#000000;
      border-bottom:2px solid #000000;
}
.booking-form form .form-group select {
          color:#000000;
      border-bottom:2px solid #000000;
}

.booking-form .form-group .btn-default {
       color:#000000;
      border-bottom:2px solid #000000;
}
.booking-form {
    z-index: 1000;
    color:#000000;

  }

 input#datepicker1::-webkit-input-placeholder {color:#000000;}
 input#datepicker1::-moz-placeholder          {color:#000000;}
 input#datepicker1:-moz-placeholder           {color:#000000;}
 input#datepicker1:-ms-input-placeholder      {color:#000000;} 
 input#datepicker2::-webkit-input-placeholder {color:#000000;}
 input#datepicker2::-moz-placeholder          {color:#000000;}
 input#datepicker2:-moz-placeholder           {color:#000000;}
 input#datepicker2:-ms-input-placeholder      {color:#000000;}

#map-list-homestay {
    margin-bottom: 10%;
}

.booking-form .form-group > i{
    color:#000000;
}

.booking-form .bootstrap-select.btn-group .dropdown-toggle .caret::before, .booking-form2 .bootstrap-select.btn-group .dropdown-toggle .caret::before {
      color:#000000;
}

.booking-form .form-group .bootstrap-select.btn-group .dropdown-menu li a {
     color:#000000;
}
</style>
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
        
        

				@if($jumlah_kategori == 0 OR $jumlah_warga == 0)
					@include('layouts._flash')
                 @endif

        		
            <div class="booking-form container-fluid">
       
          {!! Form::open(['url' => 'pencarian','files'=>'true','method' => 'get', 'class'=>'']) !!}
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
                            {!! Form::text('dari_tanggal', null, ['class'=>'form-control datepicker', 'id'=>'datepicker1','placeholder'=>'DARI TANGGAL','readonly' => 'true']) !!}
                            {!! $errors->first('dari_tanggal', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>

                    <span id="span_cultur">
                        <div class="col-sm-2">
                            <div id="sampai_tanggal" style="width:180px;"  class="form-group{{ $errors->has('sampai_tanggal') ? ' has-error' : '' }}">
                                <i class="fa fa-calendar-minus-o"></i>
                                {!! Form::text('sampai_tanggal', null, ['class'=>'form-control datepicker_sampai_tanggal', 'id'=>'datepicker2','placeholder'=>'SAMPAI TANGGAL','readonly' => 'true']) !!}
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
       
		<!-- Recommended Section -->
		<div id="recommended-section" class="recommended-section container-fluid no-padding">
			<!-- Container -->
			<div class="container">


                <div class="row">
                    <div class="col-sm-8">
                    {!! $lis_cultural !!}
                    </div>
                    <div  class="col-md-4 map-list-homestay">
                
                    </div>
                            
                </div>

				
				
			

			</div><!-- Container /- -->

		</div><!-- Recommended Section /- -->
		
	</main>

	@endsection	

@section('scripts')
<script type="text/javascript">

@if ($agent->isMobile())

  $(".booking-form").stick_in_parent({
    offset_top: 120 }); 

@else
  
  $(".booking-form").stick_in_parent({
    offset_top: 90 });  

@endif


</script>


@endsection