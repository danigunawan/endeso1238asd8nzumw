<div class="form-group{{ $errors->has('nama_bank') ? ' has-error' : '' }}">
{!! Form::label('nama_bank', 'Nama Bank', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('nama_bank', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nama_bank', '<p class="help-block">:message</p>') !!}
	</div>
</div>
 
<div class="form-group{{ $errors->has('nama_rekening_tabungan') ? ' has-error' : '' }}">
{!! Form::label('nama_rekening_tabungan', 'Nama Rekening Tabungan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('nama_rekening_tabungan', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nama_rekening_tabungan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

 <div class="form-group{{ $errors->has('nomor_rekening_tabungan') ? ' has-error' : '' }}">
{!! Form::label('nomor_rekening_tabungan', 'Nomor Rekening Tabungan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
	{!! Form::number('nomor_rekening_tabungan', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nomor_rekening_tabungan', '<p class="help-block">:message</p>') !!}
	</div>
</div>
 
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>