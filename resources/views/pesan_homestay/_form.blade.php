
							<div class="form-group{{ $errors->has('tanggal_checkin') ? ' has-error' : '' }} has-feedback">
							
							{!! Form::label('tanggal_checkin', 'Tanggal Checkin', ['class' => 'control-label']) !!}
								{!! Form::text('tanggal_checkin', $value = $tanggal_checkin , ['class' => 'form-control datepicker', 'placeholder' => 'Tanggal Check In', 'id'=>'datepicker1', 'autocomplete' => 'off']) !!}
								<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
								{!! $errors->first('tanggal_checkin', '<p class="help-block">:message</p>') !!}
							</div>
							
		
							<div class="form-group{{ $errors->has('tanggal_checkout') ? ' has-error' : '' }} has-feedback">
							
								{!! Form::label('tanggal_checkout', 'Tanggal Checkout', ['class' => 'control-label']) !!}
								{!! Form::text('tanggal_checkout', $value = $tanggal_checkout , ['class' => 'form-control datepicker', 'placeholder' => 'Tanggal Check Out', 'id'=>'datepicker2', 'autocomplete' => 'off']) !!}
								<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
								{!! $errors->first('tanggal_checkout', '<p class="help-block">:message</p>') !!}
							</div>

							{!! Form::hidden('latitude', $value = $detail_kamar->latitude, ['class'=>'form-control', 'id' => 'latitude_homestay']) !!}
							{!! Form::hidden('longitude', $value = $detail_kamar->longitude, ['class'=>'form-control', 'id' => 'longitude_homestay']) !!}

							<div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}">
								{!! Form::label('jumlah_orang', 'Jumlah Orang', ['class' => 'control-label']) !!}
								{!! Form::selectRange('jumlah_orang',1 , $detail_kamar->kapasitas, $value = $jumlah_orang,['class'=>'form-control','placeholder'=>'--PILIH JUMLAH ORANG--','id'=>'jumlah_orang']) !!}
								{!! $errors->first('jumlah_orang', '<p class="help-block">:message</p>') !!}
							</div>

							<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
								{!! Form::label('nama', 'Nama Lengkap', ['class' => 'control-label']) !!}
								{!! Form::text('nama', null , ['class' => 'form-control', 'placeholder' => '....', 'id'=>'nama', 'autocomplete' => 'off']) !!}
								{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
							</div>

							<div class="form-group{{ $errors->has('no_ktp') ? ' has-error' : '' }}">
								{!! Form::label('no_ktp', 'No KTP', ['class' => 'control-label']) !!}
								{!! Form::text('no_ktp', null , ['class' => 'form-control', 'placeholder' => '....', 'id'=>'no_ktp', 'autocomplete' => 'off']) !!}
								{!! $errors->first('no_ktp', '<p class="help-block">:message</p>') !!}
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								{!! Form::label('email', 'Alamat Email', ['class' => 'control-label']) !!}
								{!! Form::text('email', null , ['class' => 'form-control', 'placeholder' => '....', 'id'=>'email', 'autocomplete' => 'off']) !!}
								{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
							</div>

							<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
								{!! Form::label('no_telp', 'No Telp', ['class' => 'control-label']) !!}
								{!! Form::text('no_telp', null , ['class' => 'form-control', 'placeholder' => '....', 'id'=>'no_telp', 'autocomplete' => 'off']) !!}
								{!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
							</div>



							<div style="display: none;" class="panel panel-default" style="background:#eceff1;" id="kolom_harga">
								<div class="panel-body">
								{!! Form::label('harga_makan', 'Harga Makan' , ['class' => 'control-label']) !!}
								<div class="form-group{{ $errors->has('harga_makan') ? ' has-error' : '' }} " >
   								<br>
    							<div class="col-sm-1" >

    							{{ Form::checkbox('harga_makan',  null, ['class' => 'field' , 'id'=>'harga_makan', 'data-toogle'=>'0']) }}

    							</div>

    							<div class="col-sm-11" >
    								<i><b>*Info</b>:  {!!$detail_kamar->info_makanan!!}</i>
								</div>
								{!! $errors->first('harga_makan', '<p class="help-block">:message</p>') !!}
  								</div>
								  </div>
  							</div>


  							@for ($i = 1; $i <= old('jumlah_orang',$jumlah_orang); $i++)

							<div class="form-group{{ $errors->has('nama_tamu') ? ' has-error' : '' }} span-hapus">
								{!! Form::label('nama_tamu','Nama Tamu '.$i,['class'=>'control-label']) !!}
								{!! Form::text('nama_tamu['.$i.']', null, ['class'=>'form-control',  'id'=>'nama_tamu', 'autocomplete'=>'off']) !!}
								{!! $errors->first('nama_tamu', '<p class="help-block">:message</p>') !!}
							</div>


							@endfor

								{!! Form::hidden('harga_makan_hidden', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_makan_hidden', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('harga_total_hidden', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_total_hidden', 'autocomplete' => 'off']) !!}
								
								{!! Form::hidden('harga_endeso_hidden', $detail_kamar->harga_endeso , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_endeso_hidden', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('harga_pemilik_hidden', $detail_kamar->harga_pemilik , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_pemilik_hidden', 'autocomplete' => 'off']) !!}

								{!! Form::hidden('id_kamar', $detail_kamar->id_kamar , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'id_kamar', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('jumlah_malam', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'jumlah_malam', 'autocomplete' => 'off' ]) !!}

                        <!-- Panel Rincian Harga /- -->

                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: #df9915; color: white"><h4>Rincian Harga</h4></div>
                              <div class="panel-body">
		                        <table class="table-sm">
		 							<tbody>
		      						 	<tr><td width="50%" style="font-size:110%"><b>{{$detail_kamar->rumah->nama_pemilik}}</b></td> <td> &nbsp;&nbsp;&nbsp;&nbsp;</td> <td> </tr>
		      						 	<tr><td  width="50%" style="font-size:110%;"><span id="label" style="display: none;"> Harga Makan </span></td> <td> &nbsp;&nbsp;&nbsp;&nbsp;</td><td style="font-size:110%;"> <span id="harga_makan_tampil" style="display: none;"> </span> </td></tr>
		      						 	<tr><td  width="50%" style="font-size:110%">Harga Kamar </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:110%">Rp. <span id="harga_kamar">{{ $harga_kamar_sebenarnya }}</span> </td></tr>
		      						 	<tr><td  width="50%" style="font-size:110%;"><span id="hitung_orang"></span> orang x <span id="hitung_harga_orang"></span> </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:110%">Rp. <span id="harga_jumlah_orang"></span> </td></tr>
		      						 	<tr><td  width="50%" style="font-size:110%;"><span id="lama_inap"></span> Hari x <span id="hitung_lama_inap"></span> </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:110%">Rp. <span id="harga_lama_inap"></span> </td></tr>
		      						 	<span id="hidden_makan" style="display: none;">{{$detail_kamar->harga_makan}}</span>

		  							</tbody>
								</table>
								<table class="table-sm">
		 							<tbody>
		 								<tr><td width="75%" style="font-size:110%;color:red;"><b> Harga Total </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:110%;color:red;" ><b> Rp. <span id="harga_total"> </span> </b></td></tr>
		                    			<tr><td width="75%" style="font-size:125%;color:red;"><b> Jumlah yang harus dibayar sekarang (DP) </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:125%;color:red;"><b> Rp. <span id="harga_dp"> </span> </b></td></tr>

		  							</tbody>
								</table>
								</div>
                        </div>
                        <!-- Panel Rincian Harga /- -->


							{{ Form::button('Pesan Sekarang <i class="fa fa-long-arrow-right"></i>', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}