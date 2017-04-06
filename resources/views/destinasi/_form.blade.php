<div class="form-group{{ $errors->has('nama_destinasi') ? ' has-error' : '' }}">
{!! Form::label('nama_destinasi', 'Nama Destinasi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('nama_destinasi', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nama_destinasi', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto_destinasi') ? ' has-error' : '' }}">
{!! Form::label('foto_destinasi', 'Foto', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
	{!! Form::file('foto_destinasi') !!}
	<br>
	@if (isset($destinasi) && $destinasi->foto_destinasi)
	<p>
	{!! Html::image(asset('img/'.$destinasi->foto_destinasi), null, ['class'=>'img-rounded img-responsive	']) !!}
	</p>
	@endif

	{!! $errors->first('foto_destinasi', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>