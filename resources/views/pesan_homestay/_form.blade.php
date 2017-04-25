
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

							<div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}">
								{!! Form::label('jumlah_orang', 'Jumlah Orang', ['class' => 'control-label']) !!}

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
                           			'15' => '15',], $value = $jumlah_orang,['class'=>'form-control','placeholder'=>'--PILIH JUMLAH ORANG--','id'=>'jumlah_orang']) !!}
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

							<div class="panel panel-default" style="background:#eceff1;" id="kolom_harga">
								<div class="panel-body">
								{!! Form::label('harga_makan', 'Harga Makan' , ['class' => 'control-label']) !!}
								<div class="form-group{{ $errors->has('harga_makan') ? ' has-error' : '' }} " >
   								<br>
    							<div class="col-sm-1" >
     							<input type="checkbox" name="harga_makan" id="harga_makan" data-toogle="0" />
    							</div>

    							<div class="col-sm-11" >
    								<i><b>*Info</b>:  {!!$detail_kamar->info_makanan!!}</i>
								</div>
								{!! $errors->first('harga_makan', '<p class="help-block">:message</p>') !!}
  								</div>
  								</div>
  							</div>


								{!! Form::hidden('harga_makan_hidden', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_makan_hidden', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('harga_total_hidden', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_total_hidden', 'autocomplete' => 'off']) !!}
								
								{!! Form::hidden('harga_endeso_hidden', $detail_kamar->harga_endeso , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_endeso_hidden', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('harga_pemilik_hidden', $detail_kamar->harga_pemilik , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_pemilik_hidden', 'autocomplete' => 'off']) !!}

								{!! Form::hidden('id_kamar', $detail_kamar->id_kamar , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'id_kamar', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('jumlah_malam', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'jumlah_malam', 'autocomplete' => 'off' ]) !!}

							{{ Form::button('Pesan Sekarang <i class="fa fa-long-arrow-right"></i>', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}
							 
							


