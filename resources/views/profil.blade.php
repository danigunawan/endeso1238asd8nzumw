
    @extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Ubah Profil</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Home</a></li>
                    <li class="active">Ubah Profil</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container ">
            @include('layouts._flash')
                 <div class="row">
                    <div class="col-md-3">
                      <ul class="nav nav-pills nav-stacked">
                         <li class="active"><a href="{{ route('profil.edit')}}">Ubah Profil</a></li>
                        <li ><a href="{{ route('pesanan')}}">Pesanan Saya</a></li>
                      
                      </ul>
                   </div>
                
              

               {!! Form::model($profil, ['url' => route('profil.update',$profil->id),
            'method' => 'put','files'=>'true', 'class'=>'form-vertical col-md-5']) !!}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div class="">
                {!! Form::email('email', null, ['class'=>'form-control col-md-8']) !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class=" control-label">Nama Lengkap</label>

                            <div class="">
                               {!! Form::text('name', null, ['class'=>'form-control']) !!}

                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                        {!! Form::label('jenis_kelamin', 'Jenis Kelamins', ['class' => ' control-label']) !!}
                            <div class="">
                                {!! Form::select('jenis_kelamin', ['' => 'Pilih Jenis Kelamin','1' => 'Laki-Laki','2' => 'Perempuan'], null,['class' => 'form-control']) !!}
                                {!! $errors->first('jenis_kelamin', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
                            <label for="no_telp" class="control-label">No Telp</label>

                            <div class=""> 

                               {!! Form::number('no_telp', null, ['class'=>'form-control']) !!}

                                {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class=" control-label">Tanggal Lahir</label>

                            <div class="">
                                    
                                <div class="row">
                                    <div class="col-sm-2">

                                    {{ Form::selectRange('tanggal', 1, 31,$hari,['class' => 'form-control']) }}

                                       
                                    </div>
                                    <div class="col-sm-3">
                                          {{ Form::selectMonth('bulan',$bulan,['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::selectYear('tahun', 1950, 2050, $tahun , ['class' => 'form-control']) }}

                                    </div>
                                    
                                </div>

                                {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class=" control-label">Tempat Tinggal</label>

                            <div class="">
                               {!! Form::text('alamat', null, ['class'=>'form-control','maxlength' => 50]) !!}
                                {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('kewarga_negaraan') ? ' has-error' : '' }}">
                            <label for="kewarga_negaraan" class=" control-label">Kewarga Negaraan</label>

                            <div class="">
                               {!! Form::text('kewarga_negaraan', null, ['class'=>'form-control','maxlength' => 50]) !!}
                                {!! $errors->first('kewarga_negaraan', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto_profil') ? ' has-error' : '' }}">
                        {!! Form::label('foto_profil', 'Foto Profil', ['class'=>' control-label']) !!}
                            <div class="">
                            {!! Form::file('foto_profil') !!}

                            {!! $errors->first('foto_profil', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                   

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>

                                
                               
                            </div>
                        </div>
                    </form>
                    <div class="col-md-4">
                        
                        @if (isset($profil) && $profil->foto_profil && $status_foto_profil === FALSE )
                        <p>
                        {!! Html::image(asset('img/'.$profil->foto_profil), null, ['class'=>'img-rounded img-responsive']) !!}
                        <br>
                        Foto Profil
                        </p>
                        @elseif (isset($profil) && $profil->foto_profil && $status_foto_profil >= 0  )
                        <p>
                        {!! Html::image(asset($profil->foto_profil), null, ['class'=>'img-rounded img-responsive']) !!}
                        <br>
                        Foto Profil
                        </p>
                        @endif

                    </div>
                   
                </div> <!-- Row /- -->
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     
