@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Tambah Setting Halaman</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="">Setting Halaman</li>
                    <li class="active">Tambah</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
               
           {!! Form::open(['url' => route('setting-halaman.store'),'method' => 'post', 'class'=>'form-horizontal']) !!}

                    @include('setting-halaman._form')

            {!! Form::close() !!}
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection

@section('scripts')
	<script type="text/javascript">
		CKEDITOR.replace('isi_halaman');
	</script>
@endsection