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
                         <li class="active" ><a href="#">Petunjuk Pembayaran Transfer</a></li>
                         <li ><a href="#">Bukti Transfer</a></li>
                       </ul>
                    </div>
                    <div class="col-md-6">

                      <div class="panel panel-default" >
                        <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h3>Petunjuk Pembayaran Transfer</h3></head></b></div>
                        <div class="panel-body">      
                        <h4>1. Selesaikan Pembayaran Sebelum <span id="timer"></span></h5></h4> <br><hr>
                        <h4>2. Mohon Transfer Ke:</h4>
                        <h4>{{ $rekening->nama_bank }}</h4>
                        <b>Nomor Rekening : {{ $rekening->nomor_rekening_tabungan }}<br>
                        Nama Penerima : {{ $rekening->nama_rekening_tabungan   }}</b> <hr>
                        <h5>Jumlah Transfer : Rp. {{ number_format($detail_pesanan->harga_endeso * $detail_pesanan->jumlah_orang * $detail_pesanan->jumlah_malam,0,',','.') }}</h5><br>
                        <h4>3. Anda Sudah Membayar? 
                        <a href="" class="btn read-more">Konfirmasi Pembayaran<i class="fa fa-long-arrow-right"></i></a>  </h4>
                        </div>
                      </div>

	              </div>

	                  <div class="col-md-4">                 
	                   		
	                   	<div class="panel panel-default">
						    <div class="panel-heading" style="background-color:#df9915;color:#fff" ><b><p>No. Pesanan <br>
						    <h4>({{$id}})</h4>
								</p></h4></b></div>
						    <div class="panel-body">
						  	<!-- panel Rincian Pemesanan /- -->	
								<h4>Rincian Pesanan<br>	
								<hr>
								{{$kamar->rumah->nama_pemilik}}<br>
							<table>
                            <tbody>                            
                                <tr><td width="60%"><font class="satu">Check-in </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">{{$detail_pesanan->check_in}}</font> 
                                </tr>
                                <tr><td  width="60%"><font class="satu">Check-out </font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->check_out}}</font> </td>
                                </tr>
                                <tr><td  width="60%"><font class="satu">Jumlah Hari</font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->jumlah_malam}} Hari</font> </td>
                                </tr>
                                <tr><td  width="60%"><font class="satu">Jumlah Orang</font></td> 
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->jumlah_orang}} Orang</font> </td>
                                </tr>
                            </tbody>
                          </table>

								</div>							
							<!-- panel Rincian Pemesanan /- -->
						    </div>

						</div><!--<div class="panel panel-default">-->
	                   	
	                 </div><!--<div class="col-md-2">-->
                             
	                </div> <!-- Row /- -->
	            </div><!-- Container /- -->
	            <div class="section-padding"></div>
	        </div><!-- Recommended Section /- -->
	        
	    </main>

	@endsection    

@section('scripts')
    <script type="text/javascript">
    $(document).ready(function(){

    document.getElementById('timer').innerHTML =
  30 + ":" + 00;
startTimer();

function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  //if(m<0){alert('timer completed')}
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}	


var d = new Date();
var curr_hour = d.getHours();
var curr_min = d.getMinutes();
curr_min = curr_min + "";
if (curr_min.length == 1) {
    curr_min = "0" + curr_min;
}

$("#now").text(curr_hour + " : " + curr_min + " WIB ");


});
</script>
@endsection
