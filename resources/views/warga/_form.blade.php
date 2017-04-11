<div class="form-group{{ $errors->has('nama_warga') ? ' has-error' : '' }}">
	{!! Form::label('nama_warga', 'Nama Warga', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_warga', null, ['class' => 'form-control', 'placeholder' => 'Nama Warga', 'autocomplete' => 'off']) !!}
		{!! $errors->first('nama_warga', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('id_kategori_culture') ? ' has-error' : '' }}">
	{!! Form::label('id_kategori_culture', 'Kategori Culture', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('id_kategori_culture', ['' => 'Pilih Kategori Culture']+App\Kategori::pluck('nama_aktivitas', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('id_kategori_culture', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jadwal_1') ? ' has-error' : '' }}">
	{!! Form::label('jadwal_1', 'Jadwal 1', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jadwal_1', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('jadwal_1', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jadwal_2') ? ' has-error' : '' }}">
	{!! Form::label('jadwal_2', 'Jadwal 2', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jadwal_2', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('jadwal_2', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jadwal_3') ? ' has-error' : '' }}">
	{!! Form::label('jadwal_3', 'Jadwal 3', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jadwal_3', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('jadwal_3', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jadwal_4') ? ' has-error' : '' }}">
	{!! Form::label('jadwal_4', 'Jadwal 4', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jadwal_4', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('jadwal_4', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jadwal_5') ? ' has-error' : '' }}">
	{!! Form::label('jadwal_5', 'Jadwal 5', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jadwal_5', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('jadwal_5', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
	{!! Form::label('harga', 'Harga', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('kapasitas') ? ' has-error' : '' }}">
	{!! Form::label('kapasitas', 'Kapasitas', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('kapasitas', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('kapasitas', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto_profil') ? ' has-error' : '' }}">
	{!! Form::label('foto_profil', 'Foto', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto_profil') !!}
			@if (isset($warga) && $warga->foto_profil)
				<p>
					{!! Html::image(asset('img/'.$warga->foto_profil), null, ['class' => 'img-rounded img-responsive']) !!}
				</p>
			@endif
		{!! $errors->first('foto_profil', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>