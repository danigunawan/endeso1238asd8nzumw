function tandaPemisahTitik(b){
	var _minus = false;
	if (b<0) _minus = true;
	b = b.toString();
	b=b.replace(".","");
	b=b.replace("-","");
	c = "";
	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--){
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1)){
		   c = b.substr(i-1,1) + "." + c;
		 } else {
		   c = b.substr(i-1,1) + c;
		 }
	}
	if (_minus) c = "-" + c ;
	return c;
}

function numbersonly(ini, e){
	if (e.keyCode>=49){
		if(e.keyCode<=57){
		a = ini.value.toString().replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
		ini.value = tandaPemisahTitik(b);
		return false;
		}
		else if(e.keyCode<=105){
			if(e.keyCode>=96){
				//e.keycode = e.keycode - 47;
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
				ini.value = tandaPemisahTitik(b);
				//alert(e.keycode);
				return false;
				}
			else {return false;}
		}
		else {
			return false; }
	}else if (e.keyCode==48){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}
	}else if (e.keyCode==95){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}
	}else if (e.keyCode==8 || e.keycode==46){
		a = ini.value.replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = b.substr(0,b.length -1);
		if (tandaPemisahTitik(b)!=""){
			ini.value = tandaPemisahTitik(b);
		} else {
			ini.value = "";
		}
		
		return false;
	} else if (e.keyCode==9){
		return true;
	} else if (e.keyCode==17){
		return true;
	} else {
		//alert (e.keyCode);
		return false;
	}

}

function bersihPemisah(ini){
	a = ini.toString().replace(".","");
	//a = a.replace(".","");
	return a;
}



function hitung_penginapan_checkbox() {

		var harga_kamar = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#harga_kamar").text()))));
        var ceklist_harga_makan = $("#harga_makan").attr('data-toogle');
		var harga_makan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#hidden_makan").text()))));
		var checked = $('#harga_makan').is(":checked");

		 if (checked == false){

		 var harga_jumlah =  parseInt(harga_kamar);
		$("#harga_makan_tampil").hide();
		$("#label").hide();
		$("#harga_makan_hidden").val('');
		$("#harga_makan").attr("data-toogle", 0);

		}
		else{
		var harga_jumlah =  parseInt(harga_kamar) + parseInt(harga_makan);
		$("#harga_makan_tampil").show();
		$("#label").show();
		$("#harga_makan_hidden").val(harga_makan);
		$("#harga_makan").attr("data-toogle", 0);
		}


		var tanggal_checkin = new Date($("#datepicker1").val());
		var tanggal_checkout = new Date($("#datepicker2").val());
		var timeDiff = Math.abs(tanggal_checkout.getTime() - tanggal_checkin.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		var hitung_hari = diffDays;

		var jumlah_orang = $("#jumlah_orang").val();
 
 		if (jumlah_orang == ''){
			var total_harga = parseInt(harga_jumlah) * parseInt(hitung_hari);

			var harga_jumlah_orang = parseInt(harga_jumlah);
      		var harga_lama_inap = parseInt(harga_jumlah_orang) * parseInt(hitung_hari);
		}
		else if (tanggal_checkin == '' && tanggal_checkout == ''){
			var total_harga = parseInt(harga_jumlah) * parseInt(jumlah_orang);

			var harga_jumlah_orang = parseInt(harga_jumlah) * parseInt(jumlah_orang);
      		var harga_lama_inap = parseInt(harga_jumlah_orang);
		}
		else{
        	var total_harga = parseInt(harga_jumlah) * parseInt(jumlah_orang) * parseInt(hitung_hari);

        	var harga_jumlah_orang = parseInt(harga_jumlah) * parseInt(jumlah_orang);
      		var harga_lama_inap = parseInt(harga_jumlah_orang) * parseInt(hitung_hari);
      	}



      	// tampilan rincian harga
      	 $("#harga_makan_tampil").text("Rp. "+tandaPemisahTitik(harga_makan));
         $("#harga_total").text(tandaPemisahTitik(total_harga));
         $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
         $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
         $("#hitung_harga_orang").text(harga_jumlah);
         $("#harga_jumlah_orang").text(tandaPemisahTitik(harga_jumlah_orang));
         $("#lama_inap").text(tandaPemisahTitik(hitung_hari));
         $("#hitung_lama_inap").text(tandaPemisahTitik(harga_jumlah_orang));
         $("#harga_lama_inap").text(tandaPemisahTitik(harga_lama_inap));
        // tampilan rincian harga

        //tampilan di form hideen
         $("#harga_total_hidden").val(total_harga);
         $("#jumlah_malam").val(hitung_hari);         
         //tampilan di form hideen
}
function hitung_penginapan() {

		var harga_kamar = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#harga_kamar").text()))));
        var ceklist_harga_makan = $("#harga_makan").attr('data-toogle');
		var harga_makan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#hidden_makan").text()))));
		var checked = $('#harga_makan').is(":checked");

		 if (checked == false){

		var harga_jumlah =  parseInt(harga_kamar);
		$("#harga_makan_tampil").hide();
		$("#label").hide();
		$("#harga_makan_hidden").val('');
		}
		else{
		var harga_jumlah =  parseInt(harga_kamar) + parseInt(harga_makan);
		$("#harga_makan_tampil").show();
		$("#label").show();
		$("#harga_makan_hidden").val(harga_makan);
		}

		var tanggal_checkin = new Date($("#datepicker1").val());
		var tanggal_checkout = new Date($("#datepicker2").val());
		var timeDiff = Math.abs(tanggal_checkout.getTime() - tanggal_checkin.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		var hitung_hari = diffDays;
		var jumlah_orang = $("#jumlah_orang").val();
		 		console.log(jumlah_orang);

 		if (jumlah_orang == ''){
			var total_harga = parseInt(harga_jumlah) * parseInt(hitung_hari);

			var harga_jumlah_orang = parseInt(harga_jumlah);
      		var harga_lama_inap = parseInt(harga_jumlah_orang) * parseInt(hitung_hari);
		}
		else if (tanggal_checkin == '' && tanggal_checkout == ''){
			var total_harga = parseInt(harga_jumlah) * parseInt(jumlah_orang);

			var harga_jumlah_orang = parseInt(harga_jumlah) * parseInt(jumlah_orang);
      		var harga_lama_inap = parseInt(harga_jumlah_orang);
		}
		else{
        	var total_harga = parseInt(harga_jumlah) * parseInt(jumlah_orang) * parseInt(hitung_hari);

        	var harga_jumlah_orang = parseInt(harga_jumlah) * parseInt(jumlah_orang);
      		var harga_lama_inap = parseInt(harga_jumlah_orang) * parseInt(hitung_hari);
      	}



      	// tampilan rincian harga
      	 $("#harga_makan_tampil").text("Rp. "+tandaPemisahTitik(harga_makan));
         $("#harga_total").text(tandaPemisahTitik(total_harga));
         $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
         $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
         $("#hitung_harga_orang").text(harga_jumlah);
         $("#harga_jumlah_orang").text(tandaPemisahTitik(harga_jumlah_orang));
         $("#lama_inap").text(tandaPemisahTitik(hitung_hari));
         $("#hitung_lama_inap").text(tandaPemisahTitik(harga_jumlah_orang));
         $("#harga_lama_inap").text(tandaPemisahTitik(harga_lama_inap));
        // tampilan rincian harga

        //tampilan di form hideen
         $("#harga_total_hidden").val(total_harga);
         $("#jumlah_malam").val(hitung_hari);         
         //tampilan di form hideen
}
function hitung_penginapan_document() {

		var harga_kamar = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#harga_kamar").text()))));
        var checked = $('#harga_makan').is(":checked");
		var harga_makan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#hidden_makan").text()))));
		var harga_jumlah =  parseInt(harga_kamar);

		if (harga_makan != 0) {

		$("#kolom_harga").show();

			if (checked == false){

			var harga_jumlah =  parseInt(harga_kamar);
			$("#harga_makan_tampil").hide();
			$("#label").hide();
			$("#harga_makan_hidden").val('');
			}
			else{
			var harga_jumlah =  parseInt(harga_kamar) + parseInt(harga_makan);
			$("#harga_makan_tampil").show();
			$("#label").show();
			$("#harga_makan_hidden").val(harga_makan);
			}
		};


		var tanggal_checkin = new Date($("#datepicker1").val());
		var tanggal_checkout = new Date($("#datepicker2").val());
		var timeDiff = Math.abs(tanggal_checkout.getTime() - tanggal_checkin.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		var hitung_hari = diffDays;
		var jumlah_orang = $("#jumlah_orang").val();

 		if (jumlah_orang == ''){
			var total_harga = parseInt(harga_jumlah) * parseInt(hitung_hari);

			var harga_jumlah_orang = parseInt(harga_jumlah);
      		var harga_lama_inap = parseInt(harga_jumlah_orang) * parseInt(hitung_hari);
		}
		else if (tanggal_checkin == '' && tanggal_checkout == ''){
			var total_harga = parseInt(harga_jumlah) * parseInt(jumlah_orang);

			var harga_jumlah_orang = parseInt(harga_jumlah) * parseInt(jumlah_orang);
      		var harga_lama_inap = parseInt(harga_jumlah_orang);
		}
		else{
        	var total_harga = parseInt(harga_jumlah) * parseInt(jumlah_orang) * parseInt(hitung_hari);

        	var harga_jumlah_orang = parseInt(harga_jumlah) * parseInt(jumlah_orang);
      		var harga_lama_inap = parseInt(harga_jumlah_orang) * parseInt(hitung_hari);
      	}



      	// tampilan rincian harga
      	 $("#harga_makan_tampil").text("Rp. "+tandaPemisahTitik(harga_makan));
         $("#harga_total").text(tandaPemisahTitik(total_harga));
         $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
         $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
         $("#hitung_harga_orang").text(harga_jumlah);
         $("#harga_jumlah_orang").text(tandaPemisahTitik(harga_jumlah_orang));
         $("#lama_inap").text(tandaPemisahTitik(hitung_hari));
         $("#hitung_lama_inap").text(tandaPemisahTitik(harga_jumlah_orang));
         $("#harga_lama_inap").text(tandaPemisahTitik(harga_lama_inap));
        // tampilan rincian harga

        //tampilan di form hideen
         $("#harga_total_hidden").val(total_harga);
         $("#jumlah_malam").val(hitung_hari);         
         //tampilan di form hideen
}


//SCRIPT PERHITUNGAN PEMESAN CULTURAL


function hitung_penginapan_cultural_document() {


        var jumlah_orang = $("#jumlah_orang").val();
        var harga_cultural = $("#harga_cultural").text();

        if (harga_cultural == "") {
            harga_cultural = 0;
        };

        if (jumlah_orang == "") {
            jumlah_orang = 0;
        };
        
        var total_harga = parseInt(harga_cultural) * parseInt(jumlah_orang);
        var total_dp = parseInt(harga_endeso) * parseInt(jumlah_orang);

        // tampilan rincian harga
        $("#hitung_orang").text(jumlah_orang);
        $("#hitung_harga_orang").text(harga_cultural);
        $("#harga_jumlah_orang").text(total_harga);
}

function hitung_penginapan_cultural() {

        var jumlah_orang = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#jumlah_orang").val()))));
        var harga_cultural = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#harga_cultural").text()))));
        var harga_endeso = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#harga_endeso_hidden").text()))));

        if (harga_cultural == "") {
            harga_cultural = 0;
        };

        if (harga_endeso == "") {
            harga_endeso = 0;
        };

        if (jumlah_orang == "") {
            jumlah_orang = 0;
        };
        
        var total_harga = parseInt(harga_cultural) * parseInt(jumlah_orang);
        var total_dp = parseInt(harga_endeso) * parseInt(jumlah_orang);

        // tampilan rincian harga
        $("#hitung_orang").text(tandaPemisahTitik(jumlah_orang));
        $("#hitung_harga_orang").text(tandaPemisahTitik(harga_cultural));
        $("#harga_jumlah_orang").text(tandaPemisahTitik(total_harga));
        $("#harga_total").text(tandaPemisahTitik(total_harga));
        $("#harga_endeso").text(tandaPemisahTitik(total_dp));

}

function hitung_penginapan_warga_cultural(harga_warga, nilai_dp) {

       	var jumlah_orang = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#jumlah_orang").val()))));
       	if (jumlah_orang == "") {
       		jumlah_orang = 0;
       	}
   //HITUNG TOTAL HARGA
		var total_harga = parseInt(harga_warga) * parseInt(jumlah_orang);
		var total_dp = parseInt(nilai_dp) * parseInt(jumlah_orang);
		$("#harga_jumlah_orang").text(tandaPemisahTitik(total_harga));
		$("#harga_total").text(tandaPemisahTitik(total_harga));
		$("#harga_endeso").text(tandaPemisahTitik(total_dp));
		$("#harga_endeso_hidden").text(tandaPemisahTitik(total_dp));
}