<!--KOLOM TANGGAL -->
<div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
	<i class="fa fa-calendar-minus-o"></i>
		{!! Form::text('tanggal_masuk', $value = $tanggal_masuk , ['class' => 'form-control', 'placeholder' => 'Tanggal', 'id'=>'datepicker2', 'autocomplete' => 'off']) !!}
		{!! $errors->first('tanggal_masuk', '<p class="help-block">:message</p>') !!}
</div><br>

<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('nama_lengkap') ? ' has-error' : '' }}">
		{!! Form::text('nama_lengkap', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap', 'autocomplete' => 'off']) !!}
		{!! $errors->first('nama_lengkap', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
	<button class="read-more" title="Book Now">Pesan Sekarang <i class="fa fa-long-arrow-right"></i></button>
</div>
					