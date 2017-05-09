@extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Edit Setting Foto Home</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="">Setting Foto Home</li>
                    <li class="active">Edit</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
               
            {!! Form::model($setting_foto_home, ['url' => route('setting-foto-home.update', $setting_foto_home->id),
            'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 

            <!-- KOLOM FOTO  1-->
            <div class="form-group{{ $errors->has('foto_home.0') ? ' has-error' : '' }}">
                {!! Form::label('foto_1', 'Foto 1', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-2">
                    {!! Form::file('foto_home[]') !!}
                        @if (isset($setting_foto_home) && $setting_foto_home->foto_1)
                            <p>
                                {!! Html::image(asset('img/'.$setting_foto_home->foto_1), null, ['class' => 'img-rounded img-responsive']) !!}
                            </p>
                        @endif
                    {!! $errors->first('foto_home.0', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <!-- KOLOM FOTO  2-->
            <div class="form-group{{ $errors->has('foto_home.1') ? ' has-error' : '' }}">
                {!! Form::label('foto_2', 'Foto 2', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-2">
                    {!! Form::file('foto_home[]') !!}
                        @if (isset($setting_foto_home) && $setting_foto_home->foto_2)
                            <p>
                                {!! Html::image(asset('img/'.$setting_foto_home->foto_2), null, ['class' => 'img-rounded img-responsive']) !!}
                            </p>
                        @endif
                    {!! $errors->first('foto_home.1', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <!-- TOMBOL SIMPAN -->
            <div class="form-group">
                <div class="col-md-4 col-md-offset-2">
                {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     

@section('scripts')


@endsection