
    @extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Edit Profil</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Home</a></li>
                    <li class="active">Edit Profil</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
  @include('layouts._flash')
              

               {!! Form::model($profil, ['url' => route('profil.update',$profil->id),
            'method' => 'put', 'class'=>'form-horizontal']) !!}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                            <div class="col-md-6">
                               {!! Form::text('name', null, ['class'=>'form-control']) !!}

                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                        {!! Form::label('jenis_kelamin', 'Jenis Kelamins', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('jenis_kelamin', ['' => 'Pilih Jenis Kelamin','1' => 'Laki-Laki','2' => 'Perempuan'], null,['class' => 'form-control']) !!}
                                {!! $errors->first('jenis_kelamin', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
                            <label for="no_telp" class="col-md-4 control-label">No Telp</label>

                            <div class="col-md-6">
                    
                               {!! Form::text('no_telp', null, ['class'=>'form-control']) !!}

                                {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tanggal Lahir</label>

                            <div class="col-md-6">
                                    
                               {!! Form::text('tanggal_lahir', null, ['class'=>'form-control']) !!}

                                {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                               {!! Form::text('alamat', null, ['class'=>'form-control']) !!}
                                {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                   

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>

                                
                               
                            </div>
                        </div>
                    </form>
            
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     
