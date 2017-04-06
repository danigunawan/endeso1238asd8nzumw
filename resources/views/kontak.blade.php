
    @extends('layouts.app')

@section('content')
    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>{{ $setting_halaman->judul }}</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Home</a></li>
                    <li class="active">Kontak</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">

                {!! $setting_halaman->isi_halaman !!}
            
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection     
