<!--KOLOM TANGGAL -->
<div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }} has-feedback">       
        {!! Form::label('tanggal_masuk', 'Tanggal Masuk', ['class' => 'control-label']) !!}
        {!! Form::text('tanggal_masuk', $value = $tanggal_masuk , ['class' => 'form-control datepicker', 'placeholder' => '........', 'id'=>'datepicker2', 'autocomplete' => 'off']) !!}
<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
        {!! $errors->first('tanggal_masuk', '<p class="help-block">:message</p>') !!}
</div>

<!--KOLOM WARGA -->
<div class="form-group{{ $errors->has('warga') ? ' has-error' : '' }}">   
        {!! Form::label('warga', 'Warga', ['class' => 'control-label']) !!}
		{!! Form::select('warga', ['' => '--PILIH WARGA--']+App\Warga::pluck('nama_warga', 'id')->all(), null,['class' => 'form-control']) !!}
		{!! $errors->first('warga', '<p class="help-block">:message</p>') !!}

</div>

<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('jadwal_1') ? ' has-error' : '' }}">
        {!! Form::label('jadwal_1', 'Jadwal 1', ['class' => 'control-label']) !!}
        {!! Form::text('jadwal_1', null, ['class' => 'form-control','id' => 'jadwal_1', 'autocomplete' => 'off']) !!}
        {!! $errors->first('jadwal_1', '<p class="help-block">:message</p>') !!}
</div>

<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('nama_lengkap') ? ' has-error' : '' }}">
        {!! Form::label('nama_lengkap', 'Nama Lengkap', ['class' => 'control-label']) !!}
		{!! Form::text('nama_lengkap', null, ['class' => 'form-control', 'placeholder' => '........', 'id' => 'nama_lengkap', 'autocomplete' => 'off']) !!}
		{!! $errors->first('nama_lengkap', '<p class="help-block">:message</p>') !!}
</div>

<!-- KOLOM NO KTP -->
<div class="form-group{{ $errors->has('no_ktp') ? ' has-error' : '' }}">
        {!! Form::label('no_ktp', 'No KTP', ['class' => 'control-label']) !!}
        {!! Form::text('no_ktp', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'no_ktp', 'autocomplete' => 'off']) !!}
        {!! $errors->first('no_ktp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', 'Alamat Email', ['class' => 'control-label']) !!}
        {!! Form::text('email', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'email', 'autocomplete' => 'off']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
        {!! Form::label('no_telp', 'No Telp', ['class' => 'control-label']) !!}
        {!! Form::text('no_telp', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'no_telp', 'autocomplete' => 'off']) !!}
        {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}">
        {!! Form::label('jumlah_orang', 'Jumlah Orang', ['class' => 'control-label']) !!}

        {!! Form::select('jumlah_orang',[
                             '1' => '1',
                             '2' => '2',
                             '3' => '3',
                             '4' => '4',
                             '5' => '5',
                             '6' => '6',
                             '7' => '7',
                             '8' => '8',
                             '9' => '9',
                             '10' => '10',
                             '11' => '11',
                             '12' => '12',
                             '13' => '13',
                             '14' => '14',
                             '15' => '15',
                             ],null,['class'=>'form-control','placeholder'=>'--PILIH JUMLAH ORANG--']) !!}
        {!! $errors->first('jumlah_orang', '<p class="help-block">:message</p>') !!}
</div>

		{{ Form::button('Pesan Sekarang <i class="fa fa-long-arrow-right"></i>', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}					