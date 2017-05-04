<!--KOLOM TANGGAL -->
<div class="form-group{{ $errors->has('check_in') ? ' has-error' : '' }} has-feedback">       
        {!! Form::label('check_in', 'Tanggal Masuk', ['class' => 'control-label']) !!}
        {!! Form::text('check_in', $value = $tanggal_masuk , ['class' => 'form-control datepicker', 'placeholder' => '........', 'id'=>'datepicker2', 'autocomplete' => 'off', 'required' => '']) !!}
<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
        {!! $errors->first('check_in', '<p class="help-block">:message</p>') !!}
</div>

<!--KOLOM WARGA -->
<div class="form-group{{ $errors->has('id_warga') ? ' has-error' : '' }}">
        {!! Form::label('id_warga', 'Nama Warga', ['class' => 'control-label']) !!}
        {!!Form::select('id_warga', $warga, null, ['class' => 'form-control','placeholder'=>'--PILIH WARGA--', 'required' => ''])!!}
        {!! $errors->first('id_warga', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::hidden('latitude', null, ['class'=>'form-control', 'id' => 'latitude']) !!}
{!! Form::hidden('longitude', null, ['class'=>'form-control', 'id' => 'longitude']) !!}
<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('jadwal') ? ' has-error' : '' }}">
        {!! Form::label('jadwal', 'Jadwal ', ['class' => 'control-label']) !!}
        {!! Form::select('jadwal', [], null, ['class' => 'form-control','placeholder'=>'--PILIH JADWAL--','id' => 'jadwal', 'autocomplete' => 'off', 'required' => '']) !!}
        {!! $errors->first('jadwal', '<p class="help-block">:message</p>') !!}
</div>

<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
        {!! Form::label('nama', 'Nama Lengkap', ['class' => 'control-label']) !!}
		{!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => '........', 'id' => 'nama', 'autocomplete' => 'off', 'required' => '']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>

<!-- KOLOM NO KTP -->
<div class="form-group{{ $errors->has('no_ktp') ? ' has-error' : '' }}">
        {!! Form::label('no_ktp', 'No KTP', ['class' => 'control-label']) !!}
        {!! Form::number('no_ktp', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'no_ktp', 'autocomplete' => 'off', 'required' => '']) !!}
        {!! $errors->first('no_ktp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', 'Alamat Email', ['class' => 'control-label']) !!}
        {!! Form::email('email', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'email', 'autocomplete' => 'off', 'required' => '']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
        {!! Form::label('no_telp', 'No Telp', ['class' => 'control-label']) !!}
        {!! Form::number('no_telp', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'no_telp', 'autocomplete' => 'off', 'required' => '']) !!}
        {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}">
        {!! Form::label('jumlah_orang', 'Jumlah Orang', ['class' => 'control-label']) !!}
        {!! Form::select('jumlah_orang',[
                             $jumlah_orang => $jumlah_orang,
                             ],$value = $jumlah_orang,['class'=>'form-control','placeholder'=>'--PILIH JUMLAH ORANG--','id'=>'jumlah_orang', 'required' => '']) !!}
        {!! $errors->first('jumlah_orang', '<p class="help-block">:message</p>') !!}
</div> 

		{{ Form::button('Pesan Sekarang <i class="fa fa-long-arrow-right"></i>', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}					