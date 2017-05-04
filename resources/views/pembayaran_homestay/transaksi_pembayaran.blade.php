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
				<h3>Pembayaran</h3>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
        <li><a href="#">Homestay</a></li>
					<li><a href="#">Pemesanan</a></li>
					<li class="active">Pembayaran</li>

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
                         <li  ><a href="#">Petunjuk Pembayaran Transfer</a></li>
                         <li class="active"><a href="#">Bukti Transfer</a></li>
                       </ul>
                    </div>
                    <div class="col-md-6">

                      <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h4>Pemesanan Anda sedang dalam tahap:<br>Menunggu Bukti Pembayaran Anda</h4></head></b></div>
                        <div class="panel-body">   
                        <img src="{{ asset('images/unduh.jpg') }}" style="align-content:center;"><br>
                        <span>Mohon unggah bukti transfer Anda untuk mempercepat proses konfirmasi dari sistem bank. Jika Anda belum menyelesaikan pembayaran, Anda dapat mengulangi pemesanan.</span>                                    


                      {!! Form::model($id, ['url' => route('pembayaran.proses'),'method' => 'post','files'=>'true', 'class'=>'form-horizontal']) !!}
                        {{ csrf_field() }}

                              <!--KOLOM Nomor Rekening -->
                          <div class="form-group{{ $errors->has('nomor_rekening_pelanggan') ? ' has-error' : '' }}">
                          {!! Form::label('nomor_rekening_pelanggan', 'Nomor Rekening Pengirim', ['class'=>'col-sm-6 control-label']) !!}
                            <div class="col-sm-6">
                            {!! Form::number('nomor_rekening_pelanggan', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('nomor_rekening_pelanggan', '<p class="help-block">:message</p>') !!}
                            </div>
                          </div>

                          <!--SELECT Nama Bank -->
                          <div class="form-group{{ $errors->has('nama_bank_pelanggan') ? ' has-error' : '' }}">   
                                  {!! Form::label('nama_bank_pelanggan', 'Nama Bank Pengirim', ['class' => 'col-sm-6 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('nama_bank_pelanggan', ['' => 'Pilih Bank Pengirim']+App\Rekening::pluck('nama_bank', 'id')->all(), null,['class' => 'form-control']) !!}
                              {!! $errors->first('nama_bank_pelanggan', '<p class="help-block">:message</p>') !!}
                            </div>
                          </div>

                          <!--SELECT Nama Bank -->
                          <div class="form-group{{ $errors->has('nama_bank_tujuan') ? ' has-error' : '' }}">   
                                  {!! Form::label('nama_bank_tujuan', 'Nama Bank Tujuan', ['class' => 'col-sm-6 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('nama_bank_tujuan', ['' => 'Pilih Bank Tujuan']+App\Rekening::pluck('nama_bank', 'id')->all(), null,['class' => 'form-control']) !!}
                              {!! $errors->first('nama_bank_tujuan', '<p class="help-block">:message</p>') !!}
                            </div>
                          </div>


                          <!-- FOTO BUKTI TRANSFER --> 
                                      <div class="form-group{{ $errors->has('foto_tanda_bukti') ? ' has-error' : '' }}">
                                      {!! Form::label('foto_tanda_bukti', 'Foto Tanda Bukti', ['class'=>'col-sm-6 control-label']) !!}
                                          <div class="col-sm-6">
                                          {!! Form::file('foto_tanda_bukti') !!}
                                          {!! $errors->first('foto_tanda_bukti', '<p class="help-block">:message</p>') !!}
                                          </div>
                                      </div> 

                            {!! Form::hidden('id_pesanan', $value=$id, ['class'=>'form-control']) !!}

              <div class="form-group">
                <div class="col-md-4">
                  {{ Form::submit('Kirim Bukti Pembayaran', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}
                </div>
              </div>

                        </div>
                      </div>
                    </div>

	                  <div class="col-md-4">                 
	                   		
	                   	<div class="panel panel-default">
						    <div class="panel-heading" style="background-color:#df9915;color:#fff" ><b><p>No. Pesanan <br>
						    <h4>({{$id}})</h4>
								</p></h4></b></div>
						    <div class="panel-body">
						  	<!-- panel Rincian Pemesanan /- -->	
								<h4>Rincian Pesanan<br>	
								<hr>
								{{$kamar->rumah->nama_pemilik}}<br>
							<table>
                            <tbody>                            
                                <tr><td width="60%"><font class="satu">Check-in </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">{{$detail_pesanan->check_in}}</font> 
                                </tr>
                                <tr><td  width="60%"><font class="satu">Check-out </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->check_out}}</font> </td>
                                </tr>
                                <tr><td  width="60%"><font class="satu">Jumlah Hari</font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->jumlah_malam}} Hari</font> </td>
                                </tr>
                                <tr><td  width="60%"><font class="satu">Jumlah Orang</font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->jumlah_orang}} Orang</font> </td>
                                </tr>
                            </tbody>
                          </table>

								</div>							
							<!-- panel Rincian Pemesanan /- -->
						    </div>

						</div><!--<div class="panel panel-default">-->
	                   	
	                 </div><!--<div class="col-md-2">-->
                             
	                </div> <!-- Row /- -->
	            </div><!-- Container /- -->
	            <div class="section-padding"></div>
	        </div><!-- Recommended Section /- -->
	        
	    </main>

	@endsection    

