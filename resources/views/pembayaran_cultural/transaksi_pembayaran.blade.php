@extends('layouts.app')

 @section('content')
 <style type="text/css">
 /*unTUK mengatur ukuran font*/
    .satu {
    font-size: 15px;
    font: verdana;
    }
 </style>

<main class="site-main page-spacing">
  <!-- Page Banner -->
  <div class="container-fluid page-banner about-banner">
   <div class="container">
    <h3>Bukti Pembayaran</h3>
    <ol class="breadcrumb">
     <li><a href="#">Home</a></li>
     <li><a href="#">Cultural</a></li>
     <li><a href="#">Pemesanan</a></li>
     <li><a href="#">Pembayaran</a></li>
     <li class="active">Proses</li>
    </ol>
   </div>
            <div class="container" style="color:#faac17"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i> 4.5/5</div>
  </div><!-- Page Banner /- -->
  
  <div class="section-top-padding"></div>
  
  <!-- Container -->
  <div class="container">
            <!-- Container -->
            <div class="container">
                <!-- Form -->


                 <div class="row">
                     <div class="col-md-2">
                       <ul class="nav nav-pills nav-stacked">
                         <li class=""><a href="#">Petunjuk Pembayaran Transfer</a></li>
                         <li class="active"><a href="#">Bukti Pembayaran</a></li>
                       </ul> 
                    </div>
                    <div class="col-md-6">

                      <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Pemesanan Anda sedang dalam tahap:<br>Menunggu Bukti Pembayaran Anda</h4></head></b></div>
                        <div class="panel-body">   
                        <img src="{{ asset('images/unduh.jpg') }}" style="align-content:center;"><br>
                        <span>Mohon unggah bukti transfer Anda untuk mempercepat proses konfirmasi dari sistem bank. Jika Anda belum menyelesaikan pembayaran, Anda dapat mengulangi pemesanan.</span>                                    


               {!! Form::model($pesanan_culture, ['url' => route('transaksi_pembayaran_culture.store'),'method' => 'put','files'=>'true', 'class'=>'form-horizontal' ,'style'=>'padding:5%']) !!}
                        {{ csrf_field() }}
                       <!--KOLOM Nomor Rekening -->
                          <div class="form-group{{ $errors->has('nomor_rekening_pelanggan') ? ' has-error' : '' }}">
                          {!! Form::label('nomor_rekening_pelanggan', 'Nomor Rekening Pengirim', ['class'=>'control-label']) !!}
                            {!! Form::number('nomor_rekening_pelanggan', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('nomor_rekening_pelanggan', '<p class="help-block">:message</p>') !!}
                          </div>

                              <!--KOLOM atas nama rekening pengirim -->
                          <div class="form-group{{ $errors->has('atas_nama_rekening_pengirim') ? ' has-error' : '' }}">
                          {!! Form::label('atas_nama_rekening_pengirim', 'Atas Nama Rekening Pengirim', ['class'=>'control-label']) !!}
                            {!! Form::text('atas_nama_rekening_pengirim', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('atas_nama_rekening_pengirim', '<p class="help-block">:message</p>') !!}
                          </div>

                          <!--SELECT Nama Bank -->
                          <div class="form-group{{ $errors->has('nama_bank_pelanggan') ? ' has-error' : '' }}">   
                                  {!! Form::label('nama_bank_pelanggan', 'Nama Bank Pengirim', ['class' => 'control-label']) !!}
                                {!! Form::select('nama_bank_pelanggan', ['' => 'Pilih Bank Pengirim']+App\Rekening::pluck('nama_bank', 'id')->all(), null,['class' => 'form-control']) !!}
                              {!! $errors->first('nama_bank_pelanggan', '<p class="help-block">:message</p>') !!}
                          </div>

                          <!--SELECT Nama Bank -->
                          <div class="form-group{{ $errors->has('nama_bank_tujuan') ? ' has-error' : '' }}">   
                                  {!! Form::label('nama_bank_tujuan', 'Nama Bank Tujuan', ['class' => 'control-label']) !!}
                                {!! Form::select('nama_bank_tujuan', ['' => 'Pilih Bank Tujuan']+App\Rekening::pluck('nama_bank', 'id')->all(), null,['class' => 'form-control']) !!}
                              {!! $errors->first('nama_bank_tujuan', '<p class="help-block">:message</p>') !!}
                          </div>


                          <!-- FOTO BUKTI TRANSFER --> 
                          <div class="form-group{{ $errors->has('foto_tanda_bukti') ? ' has-error' : '' }}">
                            {!! Form::label('foto_tanda_bukti', 'Foto Bukti Transfer', ['class'=>'control-label']) !!}
                              {!! Form::file('foto_tanda_bukti') !!}
                                   {!! $errors->first('foto_tanda_bukti', '<p class="help-block">:message</p>') !!}
                          </div> 

                            {!! Form::hidden('id_pesanan', $value=$pesanan_culture->id, ['class'=>'form-control']) !!}

                       <div class="form-group">
                            {{ Form::submit('Kirim Bukti Pembayaran', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}
                       </div>

                        </div>
                      </div>
                    </div>

                   <div class="col-md-4">                 
                       
                      <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#df9915;color:#fff" ><b><p>No. Pesanan <br>
                <h4>({{$pesanan_culture->id}})</h4>
                </p></h4></b></div>
                <div class="panel-body">
                      <!-- panel Rincian Pemesanan /- --> 
                      <h4>Rincian Pesanan<br> 
                      <hr>
                          <h3>Destinasi : {{ $destinasi }}<h4>Cultural Experiences : {{ $aktivitas }}</h4></h3><br> 
                          <table>
                            <tbody>                            
                              <tr><td width="25%"><font class="satu">Check-in </font></td> 
                                <td> &nbsp;&nbsp;</td> <td><font class="satu">{{ $format_check_in }}</font> 
                              </tr>
                              <tr><td width="25%"><font class="satu">Jadwal</font></td> 
                                <td> &nbsp;&nbsp;</td> <td><font class="satu">{{ $pesanan_culture->jadwal }}</font> 
                              </tr>
                              <tr><td  width="25%"><font class="satu">Kode Booking  </font></td> 
                                <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{ $pesanan_culture->id }}</font> </td>
                              </tr>
                            </tbody>
                          </table>
                </div>

      </div><!--<div class="panel panel-default">-->
                     
                  </div><!--<div class="col-md-2">-->
                 
                                             
                 </div> <!-- Row /- -->
             </div><!-- Container /- -->
             <div class="section-padding"></div>
         </div><!-- Recommended Section /- -->
         
     </main>

 @endsection

@section('scripts')
    <script type="text/javascript">
    document.getElementById('timer').innerHTML =
  30 + ":" + 00;
startTimer();

function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  //if(m<0){alert('timer completed')}
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}
</script>
@endsection