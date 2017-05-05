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
              
                              <h4 style="color:red;">Selesaikan Pembayaran Sebelum <span id="timer"></span></h4>
                      <div class="panel panel-default" >

                        <div class="panel-heading" style="background-color:#df9915;color:#fff"><b><h3>Petunjuk Pembayaran Transfer</h3></head></b></div>
                        <div class="panel-body"> 

                          <ol>
                          <h4><li>
                              <h4>Mohon Lakukan Pembayaran Down Payment (DP) Sebesar<br>
                              Rp. {{ number_format($detail_pesanan->harga_endeso * $detail_pesanan->jumlah_orang * $detail_pesanan->jumlah_malam,0,',','.') }}</h4>

                              <h5>

                                <table>
                                    <tbody>                            
                                      <tr><td width="25%"><font class="satu"> Melalui Transfer Ke </font></td> 
                                        <td> &nbsp;: </td></tr>
                                    </tbody>
                                </table>

                                @foreach($rekening as $rekenings)
                                  <table>
                                    <tbody>                       
                                      <tr><td width="25%"><font class="satu"> Nama Bank </font></td> 
                                        <td> &nbsp;: </td> <td><font class="satu"> {{ $rekenings->nama_bank }} </font></td>
                                      </tr><br>                                      
                                      <tr><td width="25%"><font class="satu"> Nomor Rekening </font></td> 
                                        <td> &nbsp;: </td> <td><font class="satu"> {{ $rekenings->nomor_rekening_tabungan }} </font></td>
                                      </tr><br>
                                      <tr><td width="25%"><font class="satu"> Atas Nama </font></td> 
                                        <td> &nbsp;: </td> <td><font class="satu"> {{ $rekenings->nama_rekening_tabungan }} </font></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                @endforeach

                              </h5>
                          </li>
                          <h4><li>
                              <h4>Lakukan Konfirmasi Pembayaran Dengan Meng-upload Foto Bukti Transfer</h4>

                                <h5>
                                    <table>
                                        <tbody>                            
                                          <tr>
                                            <td width="25%"><font class="satu"> Anda Sudah Bayar?  </font></td> 
                                            <td> &nbsp; 
                                              <a href="{{ url('/transaksi_pembayaran_homestay/'.$id.'')}}" class="btn read-more">Konfirmasi Pembayaran<i class="fa fa-long-arrow-right"></i></a>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </h5>
                          </li>
                          <h4><li>
                              @if($detail_pesanan->harga_makan == 0)
                                <h4>Lakukan Sisa Pembayaran Sebesar Rp. {{ number_format($detail_pesanan->harga_pemilik * $detail_pesanan->jumlah_orang * $detail_pesanan->jumlah_malam,0,',','.') }}<br>
                                 Ketika Anda Check Out</h4>
                              @else
                                <h4>Lakukan Sisa Pembayaran Sebesar Rp. {{ number_format( ($detail_pesanan->harga_pemilik + $detail_pesanan->harga_makan) * $detail_pesanan->jumlah_orang * $detail_pesanan->jumlah_malam,0,',','.') }}<br>
                                 Ketika Anda Check Out</h4>
                              @endif                            
                          </li>
                          </ol>

                        </div>
                      </div>

	              </div>

	                  <div class="col-md-4">                 
	                   		<br><br>
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
                                <tr><td width="60%"><font class="satu">Check-in </font></td> <td> &nbsp;: </td>
                                    <td> &nbsp;&nbsp;</td> <td><font class="satu">{{$detail_pesanan->check_in}}</font> 
                                </tr>
                                <tr><td  width="60%"><font class="satu">Check-out </font></td> <td> &nbsp;: </td>
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->check_out}}</font> </td>
                                </tr>
                                <tr><td  width="60%"><font class="satu">Jumlah Hari</font></td> <td> &nbsp;: </td>
                                    <td> &nbsp;&nbsp;</td> <td> <font class="satu">{{$detail_pesanan->jumlah_malam}} Hari</font> </td>
                                </tr>
                                <tr><td  width="60%"><font class="satu">Jumlah Orang</font></td> <td> &nbsp;: </td>
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
 
    document.getElementById('timer').innerHTML = {{$time_diff}} + ":" + 00;
    startTimer();
  

function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var id_pesanan = "{{$id}}";
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  //if(m<0){alert('timer completed')}
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
    if(m < "00"){
      //untuk post ke route
      $.post('{{ url('/update-status-pesanan') }}',{'_token': $('meta[name=csrf-token]').attr('content'),id_pesanan:id_pesanan },function(data){  
      });
     //untuk post ke route

      window.location = "{{ url('/user/pesanan/') }}";
    }
    else{
    setTimeout(startTimer, 1000);
  }
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}	


});
</script>
@endsection
