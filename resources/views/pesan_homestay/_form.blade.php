
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

							
							<div class="form-group">
								<button class="read-more" title="Book Now">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></button>
							</div>
					