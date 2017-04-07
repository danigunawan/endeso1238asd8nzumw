<div class="form-group{{ $errors->has('nama_facebook') ? ' has-error' : '' }}">
{!! Form::label('nama_facebook', 'Nama Facebook', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('nama_facebook', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nama_facebook', '<p class="help-block">:message</p>') !!}
	</div>
</div>
 
<div class="form-group{{ $errors->has('link_facebook') ? ' has-error' : '' }}">
{!! Form::label('link_facebook', 'Link Facebook', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('link_facebook', null, ['class'=>'form-control']) !!}
	{!! $errors->first('link_facebook', '<p class="help-block">:message</p>') !!}
	</div>
</div>
 
<div class="form-group{{ $errors->has('nama_twitter') ? ' has-error' : '' }}">
{!! Form::label('nama_twitter', 'Nama Twitter', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('nama_twitter', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nama_twitter', '<p class="help-block">:message</p>') !!}
	</div>
</div>
 
<div class="form-group{{ $errors->has('link_twitter') ? ' has-error' : '' }}">
{!! Form::label('link_twitter', 'Link Twitter', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('link_twitter', null, ['class'=>'form-control']) !!}
	{!! $errors->first('link_twitter', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('nama_instagram') ? ' has-error' : '' }}">
{!! Form::label('nama_instagram', 'Nama Instagram', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('nama_instagram', null, ['class'=>'form-control']) !!}
	{!! $errors->first('nama_instagram', '<p class="help-block">:message</p>') !!}
	</div>
</div>
 
<div class="form-group{{ $errors->has('link_instagram') ? ' has-error' : '' }}">
{!! Form::label('link_instagram', 'Link Instagram', ['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-4">
	{!! Form::text('link_instagram', null, ['class'=>'form-control']) !!}
	{!! $errors->first('link_instagram', '<p class="help-block">:message</p>') !!}
	</div>
</div> 
<div class="form-group">
	<div class="col-md-4 col-md-offset-3">
	{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>