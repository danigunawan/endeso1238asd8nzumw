						<!--KOLOM Nomor Rekening -->
						<div class="form-group{{ $errors->has('nomor_rekening_pelanggan') ? ' has-error' : '' }}">
						{!! Form::label('nomor_rekening_pelanggan', 'Nomor Rekening', ['class'=>'col-md-4 control-label']) !!}
							<div class="col-md-6">
							{!! Form::number('nomor_rekening_pelanggan', null, ['class'=>'form-control']) !!}
							{!! $errors->first('nomor_rekening_pelanggan', '<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<!--SELECT Nama Bank -->
						<div class="form-group{{ $errors->has('nama_bank_pelanggan') ? ' has-error' : '' }}">   
						        {!! Form::label('nama_bank_pelanggan', 'Nama Bank', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::select('nama_bank_pelanggan', ['' => '-- PILIH BANK --','BNI' => 'BNI'], null,['class' => 'form-control']) !!}
								{!! $errors->first('nama_bank_pelanggan', '<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<!-- FOTO BUKTI TRANSFER --> 
                        <div class="form-group{{ $errors->has('foto_tanda_bukti') ? ' has-error' : '' }}">
                        {!! Form::label('foto_tanda_bukti', 'Foto Tanda Bukti', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                            {!! Form::file('foto_tanda_bukti') !!}
                            {!! $errors->first('foto_tanda_bukti', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div> 

							{!! Form::hidden('id_pesanan', $value=$pesanan_culture->id, ['class'=>'form-control']) !!}

<div class="form-group">
	<div class="col-md-4">
	{!! Form::submit('Kirim Bukti Pembayaran', ['class'=>'btn btn-primary']) !!}
	</div>
</div>