@if($model->status_pesanan == 2)
	<a href="{{ $check_in }}" class="btn btn-info  btn-sm">Check In</a> 
@elseif($model->status_pesanan == 3) 
	<a href="{{ $check_out }}" class="btn btn-danger  btn-sm">Check Out</a>  
@endif