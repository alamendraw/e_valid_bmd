$(document).ready(function(){
	document.getElementById("m10").style.display = "block";
	document.getElementById("m10").style.background = "linear-gradient(90deg, rgba(36,69,87,1) 0%, rgba(26,34,38,1) 100%)";
	document.getElementById("m10").style.boxShadow = "0px 6px 11px -3px rgba(0,0,0,0.57)";
	document.getElementById("s10").style.fontWeight = "bold";
	document.getElementById("s10").style.color = "white";
	if (window.innerWidth > 760) {
		$('.select2').select2({
		});
	}
	
	$.ajax({
		url: 'Label/get_jns_sensus',
		dataType: 'json',
		success: function(data){
			var html = '<option disabled selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].id+'" >'+data[i].nm_menu+'</option>';
			}
			$('#jns_kib').html(html);

		}
	});
	$.ajax({
		url: 'Label/get_skpd',
		dataType: 'json',
		success: function(data){
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].kd_skpd+'">'+data[i].kd_skpd+' | '+data[i].nm_skpd+'</option>';
			}
			$('#kd_skpd').html(html);
		}
	});
	

});
function get_unit() {
	var kd_skpd = document.getElementById('kd_skpd').value;
	$.ajax({
		url: 'Label/get_unit',
		dataType: 'json',
		type : 'POST',
		data: {kd_skpd:kd_skpd},
		beforeSend: function (data) {
			swal({
				title            : 'Mohon tunggu..!',
				imageUrl         : '../assets/sweetalert/lib/loader.gif',
				allowOutsideClick: false,
				allowEscapeKey   : false,
				allowEnterKey    : false,
				showConfirmButton: false,
			})
		},
		success: function(data){
			swal.close();
			var html = '<option selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].kd_lokasi+'">'+data[i].kd_lokasi+' | '+data[i].nm_lokasi+'</option>';
			}
			$('#unit_skpd').html(html);
		}
	});
}
function openWindow($key){
	var cetak          = $key;
	var jns_kib        = document.getElementById('jns_kib').value;
	var kd_skpd        = document.getElementById('kd_skpd').value;
	var unit_skpd      = document.getElementById('unit_skpd').value;
	var urut_awal      = document.getElementById('urut_awal').value;
	var urut_akhir     = document.getElementById('urut_akhir').value;
	var size     	   = document.getElementById('size').value;
	var url            = "Label/cetak_label";
	sub_url            = 
	'?cetak='+cetak+
	'&jns_kib='+jns_kib+
	'&kd_skpd='+kd_skpd+
	'&urut_awal='+urut_awal+
	'&urut_akhir='+urut_akhir+
	'&unit_skpd='+unit_skpd+
	'&size='+size;
	
	if (kd_skpd=='') {
		swal("SKPD !!!","SKPD belum dipilih!");
	}else if(unit_skpd=='') {
		swal("Unit !!!","Unit belum dipilih!");
	}else if(jns_kib=='') {
		swal("Jenis KIB !!!","Jenis KIB belum dipilih!");
	}else if (urut_awal>urut_akhir) {
		swal("Per Nomor Urut !!!","No. Urut akhir tidak boleh lebih kecil dari No. Urut awal!");
	}else{
		window.open(url+sub_url,'_blank');
		window.focus();
	}
}

