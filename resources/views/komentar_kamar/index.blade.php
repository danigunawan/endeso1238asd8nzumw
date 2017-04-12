@extends('layouts.app')

@section('content')

    <main class="site-main page-spacing">
        <!-- Page Banner -->
        <div class="container-fluid page-banner about-banner">
            <div class="container">
                <h3>Komentar Kamar</h3>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/home')}}">Admin</a></li>
                    <li class="active">Komentar Kamar</li>
                </ol>
            </div>
        </div><!-- Page Banner /- -->
        
                <div class="section-top-padding"></div>

        <!-- Recommended Section -->
        <div id="recommended-section" class="recommended-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                @include('layouts._flash') 

                    {!! $html->table(['class'=>'table-striped']) !!}
                
            </div><!-- Container /- -->
            <div class="section-padding"></div>
        </div><!-- Recommended Section /- -->
        
    </main>

@endsection

@section('scripts')

    {!! $html->scripts() !!}

@endsection