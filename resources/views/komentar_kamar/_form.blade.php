
					<div class="comment-form">
						<h3>Mohon bagikan pengalaman anda mengenai homestay ini</h3>
						<form class="row"> 	

							<div class="form-group col-md-12">	
								{!! Form::label('jumlah_bintang', 'Berikan peringkat untuk homestay ini', ['class' => 'control-label']) !!}
								{!! Form::text('jumlah_bintang', null , ['class' => 'rating rating-loading', 'id'=>'jumlah_bintang', 'data-show-clear'=>'false' ,'data-min'=>'0' ,'data-max'=>'5' ,'data-step'=>'1']) !!}
								{!! $errors->first('jumlah_bintang', '<p class="help-block">:message</p>') !!}
							</div>


							<div class="form-group col-md-12">							
								{!! Form::textarea('isi_komentar', null, ['class'=>'form-control', 'placeholder' => 'Tuliskan Ulasan anda disini','maxlength' => 500]) !!}
							</div>


							{!! Form::hidden('id_kamar', $value  = $kamar->id, ['class'=>'form-control']) !!}
							<div class="form-group col-md-12">								
								{!! Form::submit('Kirim Komentar') !!} 
							</div>
						</form>
					</div>
                    <!--- Komentar /-->