@if($model->status == 0)
<a href="{{ $terima }}" class="btn btn-info  btn-sm">Terima</a> <a href="{{ $tolak }}" class="btn btn-danger  btn-sm">Tolak</a> 

@elseif($model->status == 1) 
<p style="color:red;">Sudah Konfirmasi</p>
@endif

