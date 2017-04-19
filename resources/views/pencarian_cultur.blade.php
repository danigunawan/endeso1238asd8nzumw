	@extends('layouts.app')

@section('content')
	<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>Cultural Experiences</h3>
				<ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
					<li class="active">Cultural Experiences</li>
				</ol>
			</div>
		</div><!-- Page Banner /- -->
        
        		<div class="section-top-padding"></div>

		<!-- Recommended Section -->
		<div id="recommended-section" class="recommended-section container-fluid no-padding">
			<!-- Container -->
			<div class="container">

				{!! $lis_cultural !!}

			</div><!-- Container /- -->
			<div class="section-padding"></div>
		</div><!-- Recommended Section /- -->
		
	</main>

	@endsection	