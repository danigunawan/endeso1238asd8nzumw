
<!-- KOLOM DESTINASI KAMAR -->
<div class="form-group{{ $errors->has('id_destinasi') ? ' has-error' : '' }}">
	{!! Form::label('id_destinasi', 'Destinasi', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('id_destinasi', ['' => 'Pilih Destinasi']+App\Destinasi::pluck('nama_destinasi', 'id')->all(), null,['class' => 'form-control','id'=>'destinasi']) !!}
		{!! $errors->first('id_destinasi', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM DESTINASI KAMAR -->
<div class="form-group{{ $errors->has('rumah_kamar') ? ' has-error' : '' }}">
	{!! Form::label('rumah_kamar', 'Pemilik Rumah', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
	@if (old('id_destinasi') != null)
		{!! Form::select('id_rumah',['' => 'Pilih Rumah']+App\Rumah::where('id_destinasi',old('id_destinasi'))->pluck('nama_pemilik', 'id_rumah')->toArray(), null,['class' => 'form-control','id' => 'id_rumah', 'autocomplete' => 'off', 'required' => '']) !!}
	@else
	{!! Form::select('id_rumah',['' => 'Pilih Rumah'], null,['class' => 'form-control','id' => 'id_rumah', 'autocomplete' => 'off', 'required' => '']) !!}
	@endif
		{!! $errors->first('rumah_kamar', '<p class="help-block">:message</p>') !!}
	
	</div>
</div>



<!-- KOLOM DESKRIPSI KAMAR 1-->
<div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
	{!! Form::label('deskripsi', 'Deskripsi 1', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('deskripsi', null, ['class' => 'form-control']) !!}
		{!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<!--END KOLOM DESKRIPSI KAMAR 1-->


<!-- KOLOM DESKRIPSI KAMAR 2-->
<div class="form-group{{ $errors->has('deskripsi_2') ? ' has-error' : '' }}">
	{!! Form::label('deskripsi_2', 'Deskripsi 2', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('deskripsi_2', null, ['class' => 'form-control']) !!}
		{!! $errors->first('deskripsi_2', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<!--END KOLOM DESKRIPSI KAMAR 2-->


<!-- KOLOM FOTO KAMAR GROUP -->

<!-- KOLOM FOTO KAMAR  1-->
<div class="form-group{{ $errors->has('foto_kamar.0') ? ' has-error' : '' }}">
	{!! Form::label('foto1', 'Foto 1', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kamar[]') !!}
			@if (isset($kamar) && $kamar->foto1)
				<p>
					{!! Html::image(asset('img/'.$kamar->foto1), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kamar.0', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM FOTO KAMAR  2-->
<div class="form-group{{ $errors->has('foto_kamar.1') ? ' has-error' : '' }}">
	{!! Form::label('foto2', 'Foto 2', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kamar[]') !!}
			@if (isset($kamar) && $kamar->foto2)
				<p>
					{!! Html::image(asset('img/'.$kamar->foto2), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kamar.1', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM FOTO KAMAR 3-->
<div class="form-group{{ $errors->has('foto_kamar.2') ? ' has-error' : '' }}">
	{!! Form::label('foto3', 'Foto 3 ', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kamar[]') !!}
			@if (isset($kamar) && $kamar->foto3)
				<p>
					{!! Html::image(asset('img/'.$kamar->foto3), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kamar.2', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM FOTO KAMAR  4-->

<div class="form-group{{ $errors->has('foto_kamar.3') ? ' has-error' : '' }}">
	{!! Form::label('foto4', 'Foto 4', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kamar[]') !!}
			@if (isset($kamar) && $kamar->foto4)
				<p>
					{!! Html::image(asset('img/'.$kamar->foto4), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kamar.3', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM FOTO KAMAR  5-->
<div class="form-group{{ $errors->has('foto_kamar.4') ? ' has-error' : '' }}">
	{!! Form::label('foto5', 'Foto 5', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-2">
		{!! Form::file('foto_kamar[]') !!}
			@if (isset($kamar) && $kamar->foto5)
				<p>
					{!! Html::image(asset('img/'.$kamar->foto5), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_kamar.4', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!--END KOLOM FOTO KAMAR GROUP -->



<!-- KOLOM KAPASITAS -->
<div class="form-group{{ $errors->has('kapasitas') ? ' has-error' : '' }}">
	{!! Form::label('kapasitas', 'Kapasitas', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('kapasitas', null, ['class' => 'form-control', 'placeholder' => 'Kapasitas', 'autocomplete' => 'off']) !!}
		{!! $errors->first('kapasitas', '<p class="help-block">:message</p>') !!}
	</div>
</div>



<!-- KOLOM HARGA ENDESO -->
<div class="form-group{{ $errors->has('harga_endeso') ? ' has-error' : '' }}">
	{!! Form::label('harga_endeso', 'Harga Endeso', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('harga_endeso', null, ['class' => 'form-control', 'placeholder' => 'Harga Endeso', 'autocomplete' => 'off']) !!}
		{!! $errors->first('harga_endeso', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM HARGA PEMILIK -->
<div class="form-group{{ $errors->has('harga_pemilik') ? ' has-error' : '' }}">
	{!! Form::label('harga_pemilik', 'Harga Pemilik', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('harga_pemilik', null, ['class' => 'form-control', 'placeholder' => 'Harga Pemilik', 'autocomplete' => 'off']) !!}
		{!! $errors->first('harga_pemilik', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM HARGA MAKAN -->
<div class="form-group{{ $errors->has('harga_makan') ? ' has-error' : '' }}">
	{!! Form::label('harga_makan', 'Harga Makan', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('harga_makan', null, ['class' => 'form-control', 'placeholder' => 'Harga Makan', 'autocomplete' => 'off']) !!}
		{!! $errors->first('harga_makan', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM HARGA MAKAN -->
<div class="form-group{{ $errors->has('info_makanan') ? ' has-error' : '' }}">
	{!! Form::label('info_makanan', 'Info Makanan', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('info_makanan', null, ['class' => 'form-control', 'placeholder' => 'Info Makanan', 'autocomplete' => 'off']) !!}
		{!! $errors->first('info_makanan', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<!-- KOLOM LATITUDE -->
<div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
	{!! Form::label('latitude', 'Latitude', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => 'Latitude', 'autocomplete' => 'off']) !!}
		{!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM LONGITUDE -->
<div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
	{!! Form::label('longitude', 'Longitude', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => 'Longitude', 'autocomplete' => 'off']) !!}
		{!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- KOLOM JUDUL PETA -->
<div class="form-group{{ $errors->has('judul_peta') ? ' has-error' : '' }}">
	{!! Form::label('judul_peta', 'Judul Peta', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('judul_peta', null, ['class' => 'form-control', 'placeholder' => 'Judul Peta', 'autocomplete' => 'off']) !!}
		{!! $errors->first('judul_peta', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<!-- TOMBOL SIMPAN KAMAR -->
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>