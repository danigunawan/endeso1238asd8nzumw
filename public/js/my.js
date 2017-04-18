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

function hitung_penginapan() {

        var harga_kamar = $("#harga_kamar").text();
        var ceklist_harga_makan = $("#harga_makan").val();
		var harga_makan = $("#hidden_makan").text();

		if (ceklist_harga_makan == 1){
		var harga_jumlah =  parseInt(harga_kamar) + parseInt(harga_makan);
		$("#harga_makan_tampil").show();
		$("#label").show();
		$("#harga_makan_hidden").val(harga_makan);
		}
		else{
		var harga_jumlah =  parseInt(harga_kamar);
		$("#harga_makan_tampil").hide();
		$("#label").hide();
		$("#harga_makan_hidden").val('');
		}

		var tanggal_checkin = new Date($("#datepicker1").val());
		var tanggal_checkout = new Date($("#datepicker2").val());
		var hitung_hari = tanggal_checkout.getDate() - tanggal_checkin.getDate(); 
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