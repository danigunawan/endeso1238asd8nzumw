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

<div class="form-group{{ $errors->has('harga_endeso') ? ' has-error' : '' }}">
	{!! Form::label('harga_endeso', 'Harga Endeso', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga_endeso', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('harga_endeso', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('harga_pemilik') ? ' has-error' : '' }}">
	{!! Form::label('harga_pemilik', 'Harga Pemilik', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga_pemilik', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('harga_pemilik', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('latitude_longitude') ? ' has-error' : '' }}">
	{!! Form::label('latitude_longitude', 'Latitude Longitude', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('latitude_longitude', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('latitude_longitude', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('alamat_warga') ? ' has-error' : '' }}">
	{!! Form::label('alamat_warga', 'Alamat Warga', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('alamat_warga', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		{!! $errors->first('alamat_warga', '<p class="help-block">:message</p>') !!}
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