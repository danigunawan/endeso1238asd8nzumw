@extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Edit Warga</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="">Warga</li>
                    <li class="active">Edit</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
               
            {!! Form::model($warga, ['url' => route('warga.update', $warga->id),
            'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}

                    @include('warga._form')

            {!! Form::close() !!}
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     

@section('scripts')
    <script type="text/javascript">
        CKEDITOR.replace('deskripsi_kategori');
    </script>
@endsection