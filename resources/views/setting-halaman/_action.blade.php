{!! Form::model($model, ['url' => $hapus_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] 
) !!}
<a href="{{ $edit_url }}" class="btn btn-xs btn-success">Edit</a>
{!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
{!! Form::close()!!}