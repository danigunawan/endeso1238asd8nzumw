
							<div class="form-group{{ $errors->has('tanggal_checkin') ? ' has-error' : '' }}">
							<i class="fa fa-calendar-minus-o"></i>
								{!! Form::text('tanggal_checkin', $value = $tanggal_checkin , ['class' => 'form-control', 'placeholder' => 'Tanggal Check In', 'id'=>'datepicker1', 'autocomplete' => 'off']) !!}
								{!! $errors->first('tanggal_checkin', '<p class="help-block">:message</p>') !!}
							</div><br>
							
		
							<div class="form-group{{ $errors->has('tanggal_checkout') ? ' has-error' : '' }}">
							<i class="fa fa-calendar-minus-o"></i>
								{!! Form::text('tanggal_checkout', $value = $tanggal_checkout , ['class' => 'form-control', 'placeholder' => 'Tanggal Check Out', 'id'=>'datepicker2', 'autocomplete' => 'off']) !!}
								{!! $errors->first('tanggal_checkout', '<p class="help-block">:message</p>') !!}
							</div><br>

							<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
								{!! Form::text('nama', null , ['class' => 'form-control', 'placeholder' => 'Nama Lengkap', 'id'=>'nama', 'autocomplete' => 'off']) !!}
								{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
							</div><br>

							<div class="form-group{{ $errors->has('no_ktp') ? ' has-error' : '' }}">
								{!! Form::text('no_ktp', null , ['class' => 'form-control', 'placeholder' => 'No KTP', 'id'=>'no_ktp', 'autocomplete' => 'off']) !!}
								{!! $errors->first('no_ktp', '<p class="help-block">:message</p>') !!}
							</div><br>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								{!! Form::text('email', null , ['class' => 'form-control', 'placeholder' => 'Alamat Email', 'id'=>'email', 'autocomplete' => 'off']) !!}
								{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
							</div><br>

							<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
								{!! Form::text('no_telp', null , ['class' => 'form-control', 'placeholder' => 'No Telp', 'id'=>'no_telp', 'autocomplete' => 'off']) !!}
								{!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
							</div><br>

							<div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}">
								{!! Form::text('jumlah_orang', $value = $jumlah_orang , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'jumlah_orang', 'autocomplete' => 'off']) !!}
								{!! $errors->first('jumlah_orang', '<p class="help-block">:message</p>') !!}
							</div><br>

							<div class="form-group{{ $errors->has('harga_makan') ? ' has-error' : '' }}">
								{!!Form::select('harga_makan', ['0'=>'Tidak Termasuk Makan','1'=>'Termasuk Makan'], null, ['class' => 'form-control','data-placeholder'=>'Harga Makan','id'=>'harga_makan','style'=>'heigth:10%'] )!!}
								{!! $errors->first('harga_makan', '<p class="help-block">:message</p>') !!}
							</div><br>

								{!! Form::hidden('harga_makan_hidden', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_makan_hidden', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('harga_total_hidden', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_total_hidden', 'autocomplete' => 'off']) !!}
								
								{!! Form::hidden('harga_endeso_hidden', $detail_kamar->harga_endeso , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_endeso_hidden', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('harga_pemilik_hidden', $detail_kamar->harga_pemilik , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'harga_pemilik_hidden', 'autocomplete' => 'off']) !!}

								{!! Form::hidden('id_kamar', $detail_kamar->id_kamar , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'id_kamar', 'autocomplete' => 'off']) !!}
							
								{!! Form::hidden('jumlah_malam', null , ['class' => 'form-control', 'placeholder' => 'Jumlah Orang', 'id'=>'jumlah_malam', 'autocomplete' => 'off']) !!}

							{{ Form::button('Pesan Sekarang', array('class' => 'btn btn-success','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}
							


