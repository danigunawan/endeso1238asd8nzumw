<!-- KOLOM AJKTIVITAS -->
<div class="form-group{{ $errors->has('nama_aktivitas') ? ' has-error' : '' }}">
	{!! Form::label('nama_aktivitas', 'Aktivitas', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('nama_aktivitas', null, ['class' => 'form-control', 'placeholder' => 'Aktivitas', 'autocomplete' => 'off']) !!}
		{!! $errors->first('nama_aktivitas', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM DESTINASI KATEGORI -->
<div class="form-group{{ $errors->has('destinasi_kategori') ? ' has-error' : '' }}">
	{!! Form::label('destinasi_kategori', 'Destinasi', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('destinasi_kategori', ['' => 'Pilih Destinasi']+App\Destinasi::pluck('nama_destinasi', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('destinasi_kategori', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM DESKRIPSI KATEGORI -->
<div class="form-group{{ $errors->has('deskripsi_kategori') ? ' has-error' : '' }}">
	{!! Form::label('deskripsi_kategori', 'Deskripsi', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('deskripsi_kategori', null, ['class' => 'form-control']) !!}
		{!! $errors->first('deskripsi_kategori', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM FOTO KATEGORI -->
<div class="form-group{{ $errors->has('foto_kategori') ? ' has-error' : '' }}">
	{!! Form::label('foto_kategori', 'Foto', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto_kategori') !!}
			@if (isset($kategori) && $kategori->foto_kategori)
				<p>
					{!! Html::image(asset('img/'.$kategori->foto_kategori), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kategori', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- TOMBOL SIMPAN KATEGORI -->
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>