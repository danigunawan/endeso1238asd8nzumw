<!-- KOLOM KATEGORI -->
<div class="form-group{{ $errors->has('kategori_1') ? ' has-error' : '' }}">
	{!! Form::label('kategori_1', 'Kategori 1', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('kategori_1', ['' => 'PILIH KATEGORI']+App\Kategori::pluck('nama_aktivitas', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('kategori_1', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto.0') ? ' has-error' : '' }}">
	{!! Form::label('foto_1', 'Foto Kategori 1', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto[]') !!}
			@if (isset($setting_halaman_culture) && $setting_halaman_culture->foto_1)
				<p>
					{!! Html::image(asset('img/'.$setting_halaman_culture->foto_1), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto.0', '<p class="help-block">:message</p>') !!}
	</div>
</div> 

<!-- KOLOM KATEGORI -->
<div class="form-group{{ $errors->has('kategori_2') ? ' has-error' : '' }}">
	{!! Form::label('kategori_2', 'Kategori 2', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('kategori_2', ['' => 'PILIH KATEGORI']+App\Kategori::pluck('nama_aktivitas', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('kategori_2', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto.1') ? ' has-error' : '' }}">
	{!! Form::label('foto_2', 'Foto Kategori 2', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto[]') !!}
			@if (isset($setting_halaman_culture) && $setting_halaman_culture->foto_2)
				<p>
					{!! Html::image(asset('img/'.$setting_halaman_culture->foto_2), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto.1', '<p class="help-block">:message</p>') !!}
	</div>
</div> 

<!-- KOLOM KATEGORI -->
<div class="form-group{{ $errors->has('kategori_3') ? ' has-error' : '' }}">
	{!! Form::label('kategori_3', 'Kategori 3', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('kategori_3', ['' => 'PILIH KATEGORI']+App\Kategori::pluck('nama_aktivitas', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('kategori_3', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto.0') ? ' has-error' : '' }}">
	{!! Form::label('foto_3', 'Foto Kategori 3', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto[]') !!}
			@if (isset($setting_halaman_culture) && $setting_halaman_culture->foto_3)
				<p>
					{!! Html::image(asset('img/'.$setting_halaman_culture->foto_3), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto.0', '<p class="help-block">:message</p>') !!}
	</div>
</div> 

<!-- KOLOM KATEGORI -->
<div class="form-group{{ $errors->has('kategori_4') ? ' has-error' : '' }}">
	{!! Form::label('kategori_4', 'Kategori 4', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('kategori_4', ['' => 'PILIH KATEGORI']+App\Kategori::pluck('nama_aktivitas', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('kategori_4', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto.1') ? ' has-error' : '' }}">
	{!! Form::label('foto_4', 'Foto Kategori 4', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto[]') !!}
			@if (isset($setting_halaman_culture) && $setting_halaman_culture->foto_4)
				<p>
					{!! Html::image(asset('img/'.$setting_halaman_culture->foto_4), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto.1', '<p class="help-block">:message</p>') !!}
	</div>
</div> 

<!-- TOMBOL SIMPAN KATEGORI -->
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>