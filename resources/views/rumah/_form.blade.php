
<!-- KOLOM DESTINASI KAMAR -->
<div class="form-group{{ $errors->has('destinasi_kamar') ? ' has-error' : '' }}">
	{!! Form::label('destinasi_kamar', 'Destinasi', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('id_destinasi', ['' => 'Pilih Destinasi']+App\Destinasi::pluck('nama_destinasi', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('destinasi_kamar', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM NAMA PEMILIK -->
<div class="form-group{{ $errors->has('nama_pemilik') ? ' has-error' : '' }}">
	{!! Form::label('nama_pemilik', 'Nama Pemilik', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('nama_pemilik', null, ['class' => 'form-control', 'placeholder' => 'Nama Pemilik', 'autocomplete' => 'off']) !!}
		{!! $errors->first('nama_pemilik', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM NAMA PEMILIK -->
<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
	{!! Form::label('no_telp', 'No Telp', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('no_telp', null, ['class' => 'form-control', 'placeholder' => 'No Telp', 'autocomplete' => 'off']) !!}
		{!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM ALAMAT -->
<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
	{!! Form::label('alamat', 'Alamat', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
		{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- TOMBOL SIMPAN KATEGORI -->
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>