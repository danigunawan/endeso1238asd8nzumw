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

<!-- KOLOM DURASI -->
<div class="form-group{{ $errors->has('durasi') ? ' has-error' : '' }}">
	{!! Form::label('durasi', 'Durasi', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('durasi', null, ['class' => 'form-control', 'placeholder' => 'Durasi', 'autocomplete' => 'off']) !!}
		{!! $errors->first('durasi', '<p class="help-block">:message</p>') !!}
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

<!-- KOLOM FOTO KAtegori GROUP -->
<!-- KOLOM FOTO KAtegori  1-->
<div class="form-group{{ $errors->has('foto_kategori.0') ? ' has-error' : '' }}">
	{!! Form::label('foto_kategori', 'Foto 1', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kategori[]') !!}
			@if (isset($kategori) && $kategori->foto_kategori)
				<p>
					{!! Html::image(asset('img/'.$kategori->foto_kategori), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kategori.0', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM FOTO KAtegori  2-->
<div class="form-group{{ $errors->has('foto_kategori.1') ? ' has-error' : '' }}">
	{!! Form::label('foto_kategori2', 'Foto 2', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kategori[]') !!}
			@if (isset($kategori) && $kategori->foto_kategori2)
				<p>
					{!! Html::image(asset('img/'.$kategori->foto_kategori2), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kategori.1', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM FOTO KAtegori 3-->
<div class="form-group{{ $errors->has('foto_kategori.2') ? ' has-error' : '' }}">
	{!! Form::label('foto_kategori3', 'Foto 3 ', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kategori[]') !!}
			@if (isset($kategori) && $kategori->foto_kategori3)
				<p>
					{!! Html::image(asset('img/'.$kategori->foto_kategori3), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kategori.2', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM FOTO KAtegori  4-->

<div class="form-group{{ $errors->has('foto_kategori.3') ? ' has-error' : '' }}">
	{!! Form::label('foto_kategori4', 'Foto 4', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kategori[]') !!}
			@if (isset($kategori) && $kategori->foto_kategori4)
				<p>
					{!! Html::image(asset('img/'.$kategori->foto_kategori4), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kategori.3', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM FOTO KAtegori  5-->
<div class="form-group{{ $errors->has('foto_kategori.4') ? ' has-error' : '' }}">
	{!! Form::label('foto_kategori5', 'Foto 5', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kategori[]') !!}
			@if (isset($kategori) && $kategori->foto_kategori5)
				<p>
					{!! Html::image(asset('img/'.$kategori->foto_kategori5), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kategori.4', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!--END KOLOM FOTO KAtegori GROUP -->

<!-- TOMBOL SIMPAN KATEGORI -->
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>