@if($model->status == 0)
	<a href="{{ $konfirmasi_url }}" class="btn btn-info">Konfirmasi</a>
	<a href="{{ $no_konfirmasi_url }}" class="btn btn-danger">No Konfirmasi</a>

@elseif($model->status == 1)
	{!! Form::model($model, ['url' => $hapus_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!} 
	{!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
{!! Form::close()!!}

@elseif($model->status == 2)
	{!! Form::model($model, ['url' => $hapus_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!} 
	{!! Form::submit('Hapus Komentar', ['class'=>'btn btn-danger']) !!}
	{!! Form::close()!!}
@endif
