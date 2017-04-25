@extends('layouts.app')

	@section('content')
	<style type="text/css">
	/*unTUK mengatur ukuran font*/
	   .satu {
	   font-size: 15px;
	   font: verdana;
	   }
	</style>

<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>Pembayaran</h3>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
                    <li><a href="#">Homestay</a></li>
					<li><a href="#">Pemesanan</a></li>
					<li class="active">Pembayaran</li>
				</ol>
			</div>
            <div class="container" style="color:#faac17"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i> 4.5/5</div>
		</div><!-- Page Banner /- -->
		
		<div class="section-top-padding"></div>
		
		<!-- Container -->
		<div class="container">
            <!-- Container -->
            <div class="container">
                <!-- Form -->


	                <div class="row">
	                    <div class="col-md-2">
	                      <ul class="nav nav-pills nav-stacked">
	                        <li class="active"><a href="{{ route('pembayaran.index')}}">Transfer</a></li>
	                      </ul>
	                   </div>
	                   <div class="col-md-6">

						  <div class="panel panel-default">
						    <div class="panel-heading"><b><h3>Transfer</h3></head></b></div>
						    <div class="panel-body">
		
		

						    </div>
						  </div>

	                   </div>

	                  <div class="col-md-4">                 
	                   		
	                   	<div class="panel panel-default">
						    <div class="panel-heading"><b> <h4><p>No. Pesanan <br><br>
								<b>{{$detail_pesanan->id}}</b></p></h4></head></b></div>
						    <div class="panel-body">
						  
						    </div>

						</div><!--<div class="panel panel-default">-->
	                   	
	                 </div><!--<div class="col-md-2">-->
	                
	                                            
	                </div> <!-- Row /- -->
	            </div><!-- Container /- -->
	            <div class="section-padding"></div>
	        </div><!-- Recommended Section /- -->
	        
	    </main>

	@endsection    

