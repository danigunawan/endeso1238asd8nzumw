@if($model->status == 0)
	<a href="{{ $konfirmasi_url }}" class="btn btn-info  btn-sm">Terima</a>
	<a href="{{ $no_konfirmasi_url }}" class="btn btn-danger  btn-sm">Tolak</a>

@elseif($model->status == 1)
	{!! Form::model($model, ['url' => $hapus_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!} 
	<a href="{{ $no_konfirmasi_url }}" class="btn btn-primary  btn-sm">Tolak</a>
	{!! Form::submit('Hapus', ['class'=>'btn btn-danger  btn-sm']) !!}
{!! Form::close()!!}

@elseif($model->status == 2)
	{!! Form::model($model, ['url' => $hapus_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!} 
	<a href="{{ $konfirmasi_url }}" class="btn btn-info  btn-sm">Terima</a>
	{!! Form::submit('Hapus', ['class'=>'btn btn-danger  btn-sm']) !!}
	{!! Form::close()!!}
@endif
