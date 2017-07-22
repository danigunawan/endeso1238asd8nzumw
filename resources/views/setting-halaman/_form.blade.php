<div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
	{!! Form::label('judul', 'Judul', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Judul Halaman', 'autocomplete' => 'off']) !!}
		{!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('isi_halaman') ? ' has-error' : '' }}">
	{!! Form::label('isi_halaman', 'Isi Halaman', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('isi_halaman', null, ['class' => 'form-control']) !!}
		{!! $errors->first('isi_halaman', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jenis_halaman') ? ' has-error' : '' }}">
	{!! Form::label('jenis_halaman', 'Jenis Halaman', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('jenis_halaman', ['' => 'Pilih Jenis Halaman','1' => 'Tentang Homestay','2' => 'Cara Pesan Homestay' ,'3' => 'Kontak','4'=>'Tentang Culture Experience','5'=>'Cara Pesan Culture Experience'], null,['class' => 'form-control']) !!}
		{!! $errors->first('jenis_halaman', '<p class="help-block">:message</p>') !!}
	</div>
</div>



<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>