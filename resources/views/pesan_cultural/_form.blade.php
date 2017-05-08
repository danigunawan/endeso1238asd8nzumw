<!--KOLOM TANGGAL -->
<div class="form-group{{ $errors->has('check_in') ? ' has-error' : '' }} has-feedback">       
        {!! Form::label('check_in', 'Tanggal Masuk', ['class' => 'control-label']) !!}
        {!! Form::text('check_in', $value = $tanggal_masuk , ['class' => 'form-control datepicker', 'placeholder' => '........', 'id'=>'datepicker2', 'autocomplete' => 'off']) !!}
<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
        {!! $errors->first('check_in', '<p class="help-block">:message</p>') !!}
</div>

<!--KOLOM WARGA -->
<div class="form-group{{ $errors->has('id_warga') ? ' has-error' : '' }}">
        {!! Form::label('id_warga', 'Nama Warga', ['class' => 'control-label']) !!}
        {!!Form::select('id_warga', $warga, null, ['class' => 'form-control','placeholder'=>'--PILIH WARGA--'])!!}
        {!! $errors->first('id_warga', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::hidden('latitude', null, ['class'=>'form-control', 'id' => 'latitude']) !!}
{!! Form::hidden('longitude', null, ['class'=>'form-control', 'id' => 'longitude']) !!}
<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('jadwal') ? ' has-error' : '' }}">
        {!! Form::label('jadwal', 'Jadwal ', ['class' => 'control-label']) !!}
        {!! Form::select('jadwal', [], null, ['class' => 'form-control','placeholder'=>'--PILIH JADWAL--','id' => 'jadwal', 'autocomplete' => 'off']) !!}
        {!! $errors->first('jadwal', '<p class="help-block">:message</p>') !!}
</div>

<!--KOLOM NAMA LENGKAP -->
<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
        {!! Form::label('nama', 'Nama Lengkap', ['class' => 'control-label']) !!}
		{!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => '........', 'id' => 'nama', 'autocomplete' => 'off']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>

<!-- KOLOM NO KTP -->
<div class="form-group{{ $errors->has('no_ktp') ? ' has-error' : '' }}">
        {!! Form::label('no_ktp', 'No KTP', ['class' => 'control-label']) !!}
        {!! Form::number('no_ktp', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'no_ktp', 'autocomplete' => 'off']) !!}
        {!! $errors->first('no_ktp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', 'Alamat Email', ['class' => 'control-label']) !!}
        {!! Form::email('email', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'email', 'autocomplete' => 'off']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
        {!! Form::label('no_telp', 'No Telp', ['class' => 'control-label']) !!}
        {!! Form::number('no_telp', null , ['class' => 'form-control', 'placeholder' => '........', 'id'=>'no_telp', 'autocomplete' => 'off']) !!}
        {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('jumlah_orang') ? ' has-error' : '' }}" id="span_jumlah_orang">
        {!! Form::label('jumlah_orang', 'Jumlah Orang', ['class' => 'control-label']) !!}
        {!! Form::select('jumlah_orang',[
                             $jumlah_orang => $jumlah_orang,
                             ],$value = $jumlah_orang,['class'=>'form-control','placeholder'=>'--PILIH JUMLAH ORANG--','id'=>'jumlah_orang']) !!}
        {!! $errors->first('jumlah_orang', '<p class="help-block">:message</p>') !!}
</div>


<div style="display: none" class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
        {!! Form::label('no_telp', 'No Telp', ['class' => 'control-label']) !!}
</div>

 @for ($i = 1; $i < old('jumlah_orang',$jumlah_orang); $i++)

<div class="form-group{{ $errors->has('nama_tamu') ? ' has-error' : '' }} span-hapus">
    {!! Form::label('nama_tamu','Nama Tamu '.$i,['class'=>'control-label']) !!}
    {!! Form::text('nama_tamu['.$i.']', null, ['class'=>'form-control',  'id'=>'nama_tamu', 'autocomplete'=>'off']) !!}
    {!! $errors->first('nama_tamu', '<p class="help-block">:message</p>') !!}
</div>
@endfor


                        <!-- Panel Rincian Harga /- -->

                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: #df9915; color: white"><h4>Rincian Harga</h4></div>
                              <div class="panel-body">
                                <table class="table-sm">
                                    <tbody>
                                        <tr><td  width="50%" style="font-size:125%"><b> Warga </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:125%"><b> <span id="nama_warga"></span> </b></td></tr>
                                        <tr><td  width="50%" style="font-size:125%">Harga </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:125%">Rp. <span id="harga_cultural"></span> </td></tr>
                                        <tr><td  width="50%" style="font-size:125%;"><span id="hitung_orang"></span> Orang x Rp. <span id="hitung_harga_orang"></span> </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:125%">Rp. <span id="harga_jumlah_orang"></span> </td></tr>

                                    </tbody>
                                </table>
                                <table class="table-sm">
                                    <tbody>
                                        <span style="display: none" id="harga_endeso_hidden"> </span>
                                        <tr><td width="75%" style="font-size:125%;color:red;"><b>  Harga Total </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:125%;color:red;" ><b> Rp. <span id="harga_endeso"> </span> </b></td></tr>
                                        <tr><td width="75%" style="font-size:100%;color:red;"><b><p></p> Jumlah yang harus dibayar sekarang (DP)  </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:125%;color:red;" ><b> Rp. <span id="harga_total"> </span> </b></td></tr>
                                    </tbody>
                                </table>
                              </div>
                        </div>
                        <!-- Panel Rincian Harga /- -->

{{ Form::button('Pesan Sekarang <i class="fa fa-long-arrow-right"></i>', array('class' => 'btn read-more','title'=>'Book Now','id'=>'submit_pesan','type'=>'submit')) }}