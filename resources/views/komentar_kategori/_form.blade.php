
					<div class="comment-form">
						<h3>Komentar</h3>
						<form class="row"> 				
							<div class="form-group col-md-12">							
								{!! Form::textarea('isi_komentar', null, ['class'=>'form-control', 'placeholder' => 'Tulisakan Komentar','maxlength' => 500]) !!}
							</div>

							{!! Form::hidden('id_kategori', $value  = $detail_cultural->id, ['class'=>'form-control']) !!}
							<div class="form-group col-md-12">								
								{!! Form::submit('Kirim Komentar') !!} 
							</div>
						</form>
					</div>
                    <!--- Komentar /-->