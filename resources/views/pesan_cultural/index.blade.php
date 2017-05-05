@extends('layouts.app')

@section('content')


<main class="site-main page-spacing">
		<!-- Page Banner -->
		<div class="container-fluid page-banner about-banner">
			<div class="container">
				<h3>{{$detail_kategori->nama_aktivitas}}</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
                    <li><a href="list.html">Cultural Experience</a></li>
					<li class="active">{{$detail_kategori->nama_aktivitas}}</li>
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
					<div class="booking-form2">
                    
                    @include('layouts._flash')
						<h3>Form Pemesanan</h3>
						<div class="row">
						<div class="col-sm-6">


            {!! Form::model($warga, ['url' => route('pesancultural.proses'),
            'method' => 'get', 'files'=>'true']) !!}
                    @include('pesan_cultural._form') 
            {!! Form::close() !!}



						</div>
						<div class="col-sm-6"> 
						<br>
				<!-- panel Rincian Pemesanan /- -->
							<div class="panel panel-default">
							 <div class="panel-heading" style="background-color:#df9915;color:#fff"><h3>Rincian Pemesanan</h3></div>
  								<div class="panel-body">
    								<div class="row" style="padding:3%">
    									<div class="col-xs-3">
    									@if (isset($detail_kategori) && $detail_kategori->foto_kategori)
    										<p>
    											{!! Html::image(asset('img/'.$detail_kategori->foto_kategori), null, ['class' => 'img-rounded img-responsive']) !!}
    										</p>                              
    									@endif 						
    									</div>
    									<div class="col-xs-9">                                          
                                            <aside class="widget widget_features">
                                                <h3 class="widget-title"> Tentang {{$detail_kategori->nama_aktivitas}}</h3>
                                                {!!$detail_kategori->deskripsi_kategori!!}
                                            </aside><!-- Features Widget -->
                                        </div>
    								</div>

                                <span id="span_tentang_warga" style="display: none">
                                    <hr style="height: 10px; border: 0; box-shadow: 0 10px 10px -10px #8c8c8c inset;">                                                           
                                        
                                    <div class="row" style="padding: 3%">

                                        <div class="col-sm-3">
                                            <span id="span_foto"></span>                                            
                                        </div>      

                                        <div class="col-sm-8">
                                            <aside class="widget widget_features">
                                                    <h3 class="widget-title"> <span id="tentang_warga"></span> </h3>
                                            </aside><!-- Features Widget --> 
                                        </div>                                    
                                    </div>

                                    <div class="row" style="padding: 3%">
                                        <span class="span-peta">
                                            <div id="map" style=" height: 200px;" class="img-rounded img-responsive"></div>                                                
                                        </span>                                                                      
                                    </div>
                                </span>

								</div>
							</div> 
								<!-- panel Rincian Pemesanan /- -->
				<div class="panel panel-default" >
					<div class="panel-heading" style="background-color:#df9915;color:#fff"><h3>Rincian Harga</h3></div>
  					<div class="panel-body">
						<table>
 							<tbody>
                                <tr><td  width="50%" style="font-size:150%"><b> Warga </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%"><b> <span id="nama_warga"></span> </b></td></tr>

                                <tr><td  width="50%" style="font-size:150%">Harga </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%">Rp. <span id="harga_cultural"></span> </td></tr>

      						 	<tr><td  width="50%" style="font-size:150%;"><span id="hitung_orang"></span> Orang x Rp. <span id="hitung_harga_orang"></span> </td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%">Rp. <span id="harga_jumlah_orang"></span> </td></tr>

  							</tbody>
						</table>
								<hr>
						<table>
 							<tbody>
                                <span style="display: none" id="harga_endeso_hidden"> </span>
                                <tr><td width="50%" style="font-size:150%;color:red;"><b> Down Payment (DP) </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%;color:red;" ><b> Rp. <span id="harga_endeso"> </span> </b></td></tr>
                                <tr><td width="50%" style="font-size:150%;color:red;"><b> Total Pembayaran </b></td> <td> &nbsp;&nbsp;:&nbsp;&nbsp;</td> <td style="font-size:150%;color:red;" ><b> Rp. <span id="harga_total"> </span> </b></td></tr>
  							</tbody>
						</table>
					</div>
				</div>
			<!-- panel Rincian Pemesanan /- -->


						</div>
						</div>
					</div><!-- Form /- -->
                
   		</div><!-- Container /- -->
		
		<div class="section-padding"></div>
	</main>



@endsection

@section('scripts')   

<script type="text/javascript">

    $(document).ready(function(){
        hitung_penginapan_cultural_document();

    });
    
    $(document).on('change','#id_warga',function(e){

            var id_warga = $('#id_warga').val();
            var jumlah_orang = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#jumlah_orang").val()))));
        

                        $.post('{{ url('/ajax-data-warga') }}',{'_token': $('meta[name=csrf-token]').attr('content'),
                            id_warga:id_warga },function(data){
                            $(".span-option").remove();

                            if (data.jadwal_1 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_1+'">'+data.jadwal_1+'</option>');
                            }
                            if (data.jadwal_2 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_2+'">'+data.jadwal_2+'</option>');

                            } 
                            if (data.jadwal_3 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_3+'">'+data.jadwal_3+'</option>');

                            } 
                            if (data.jadwal_4 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_4+'">'+data.jadwal_4+'</option>');

                            } 
                            if (data.jadwal_5 != null) {
                            	$("#jadwal").prepend('<option class="span-option" value="'+data.jadwal_5+'">'+data.jadwal_5+'</option>');

                            } 

                        $("#nama_warga").text(data.nama_warga);
                        $("#tentang_warga").text(data.nama_warga);
                        var harga_warga = parseInt(data.harga_endeso) + parseInt(data.harga_pemilik);
                        var nilai_dp = parseInt(data.harga_endeso);
                        var foto_profil = data.foto_profil;
                        var foto_tempat = data.foto_tempat;
                        var kapasitas = data.kapasitas;
                        var latitude = data.latitude;
                        var longitude = data.longitude;


                        $("#harga_cultural").text(tandaPemisahTitik(harga_warga));
                        $("#hitung_harga_orang").text(tandaPemisahTitik(harga_warga));
                        $("#latitude").val(latitude);
                        $("#longitude").val(longitude);


                    //HITUNG HARGA
                        hitung_penginapan_warga_cultural(harga_warga, nilai_dp);

                    //TAMPIL KAPASITAS ORANG /WARGA
                            var kapasitas_orang;
                            $("#jumlah_orang option").remove();

                            $("#jumlah_orang").append('<option class="span-kapasitas" value="">--PILIH JUMLAH ORANG--</option>');
                            for (kapasitas_orang = 1; kapasitas_orang <= kapasitas; kapasitas_orang++){
                                if (jumlah_orang == kapasitas_orang) {
                                    $("#jumlah_orang").append('<option selected class="span-kapasitas" value="'+kapasitas_orang+'">'+kapasitas_orang+' '+'</option>');                                }
                                else{
                                    $("#jumlah_orang").append('<option class="span-kapasitas" value="'+kapasitas_orang+'">'+kapasitas_orang+' '+'</option>');                                }
                            }

                    //TAMPIL FOTO WARGA
                        $(".span-hapus").remove();

                        $("#span_foto").prepend('<span class="span-hapus"> <img class="img-rounded img-responsive" src="{{asset("img/")}}/'+foto_profil+'"> </span>');
                        $("#span_tentang_warga").show();

                    //MENAMPILKAN PETA WARGA
                            var latitude = $("#latitude").val();
                            var longitude = $("#longitude").val();


                                                        
                            if (latitude != "" && longitude != "") {
                              var marker;

                              function initMap() {
                                var map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 15,
                                  center: {lat: parseFloat(latitude), lng: parseFloat(longitude)}
                                });

                                marker = new google.maps.Marker({
                                  map: map,
                                  draggable: true,
                                  animation: google.maps.Animation.DROP,
                                  position: {lat: parseFloat(latitude), lng: parseFloat(longitude)}
                                });
                                marker.addListener('click', toggleBounce);
                              } //INTI MAP

                              function toggleBounce() {
                                if (marker.getAnimation() !== null) {
                                  marker.setAnimation(null);

                                }
                                else {
                                  marker.setAnimation(google.maps.Animation.BOUNCE);
                                

                                }

                              }// TOOGLE BOUNCE

                              initMap();
                              $("#map").show();

                            } //END IF
                            else{
                                $("#map").hide();
                            }
                    //MENAMPILKAN PETA WARGA


                    // Menampilkan nama tamu
                            var jumlah_orang_baru = $("#jumlah_orang").val();
                            var jumlah_orang_ganti = jumlah_orang_baru - 1;
                            var no_urut_tamu = jumlah_orang_baru - 1;
                            var no = 1;
                            if (jumlah_orang_baru > 1){
                            
                            $(".span-hapus").remove();
                            
                            for (var tamu = 0; tamu < jumlah_orang_ganti; tamu++) 
                            {   
                            var no_urut = no_urut_tamu--;
                            $('<div class="form-group{{ $errors->has('nama_tamu.+no_urut_tamu--+') ? ' has-error' : '' }} span-hapus"><label align="left">Nama Tamu '+no_urut+' </label><br><input type="text" name="nama_tamu['+no_urut+']" id="nama_tamu" class="form-control" autocomplete="off" required=""></div>').insertAfter("#span_jumlah_orang");
                            }
                            
                            }
                            else{
                            $(".span-hapus").html('');
                            }

                        });

    });


    $(document).on('change','#jumlah_orang',function(e){
        hitung_penginapan_cultural();

        var jumlah_orang_baru = $(this).val();
        var jumlah_orang_ganti = jumlah_orang_baru - 1;
        var no_urut_tamu = jumlah_orang_baru - 1;
        var no = 1;
        if (jumlah_orang_baru > 1){

            $(".span-hapus").remove();
 
            for (var tamu = 0; tamu < jumlah_orang_ganti; tamu++) 
        {   
            var no_urut = no_urut_tamu--;
        $('<div class="form-group{{ $errors->has('nama_tamu.+no_urut_tamu--+') ? ' has-error' : '' }} span-hapus"><label align="left">Nama Tamu '+no_urut+' </label><br><input type="text" name="nama_tamu['+no_urut+']" id="nama_tamu" class="form-control" autocomplete="off" required=""></div>').insertAfter("#span_jumlah_orang");
        }

        }
        else{
            $(".span-hapus").html('');
        }
    }); 

    </script>



@endsection
