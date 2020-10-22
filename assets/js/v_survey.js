$(document).ready(function(){
	// document.getElementById("m12").style.display = "block";
	// document.getElementById("m12").style.background = "linear-gradient(90deg, rgba(36,69,87,1) 0%, rgba(26,34,38,1) 100%)";
	// document.getElementById("m12").style.boxShadow = "0px 6px 11px -3px rgba(0,0,0,0.57)";
	// document.getElementById("s12").style.fontWeight = "bold";
	// document.getElementById("s12").style.color = "white";

	var d = document.getElementById("m12");
	d.className += " menu-open";
	document.getElementById("s12").style.display = "block";
	document.getElementById("sm16").style.color = "white";
	document.getElementById("sm16").style.fontWeight = "bold";
	/*if (window.innerWidth > 760) {
		$('.select2').select2({
		});
	}*/
	$('.select2').select2({
	});
	$.ajax({
		url: 'survey/get_skpd',
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
		url: 'survey/get_unit',
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
	var kd_skpd        = document.getElementById('kd_skpd').value;
	var unit_skpd      = document.getElementById('unit_skpd').value;
	var jns_kib   	   = document.getElementById('jns_kib').value;
	var limit   	   = document.getElementById('limit').value;
	var ruang   	   = document.getElementById('ruang').value;
	var nm_ruang   	   = $('#ruang option:selected').html();
	var url            = "survey/cetak";
	sub_url            = 
	'?cetak='+cetak+
	'&kd_skpd='+kd_skpd+
	'&unit_skpd='+unit_skpd+
	'&jns_kib='+jns_kib+
	'&limit='+limit+
	'&ruang='+ruang+
	'&nm_ruang='+nm_ruang;
	
	if (kd_skpd=='') {
		swal("SKPD !!!","SKPD belum dipilih!");
	}else if(unit_skpd=='') {
		swal("Unit !!!","Unit belum dipilih!");
	}else{
		window.open(url+sub_url,'_blank');
		window.focus();
	}
}
function limit() {
	var kode = $('#jns_kib').val();
	if (kode==2 || kode==5) {
		$('#tag_limit').show();
		$('#tag_ruang').show();
	}else{
		$('#tag_limit').hide();
		$('#tag_ruang').hide();
	}
	var kd_skpd = $('#kd_skpd').val();
	var kd_unit = $('#unit_skpd').val();
	$.ajax({
		url: 'survey/get_ruang',
		dataType: 'json',
		data: ({kd_unit,kd_skpd}),
		type: 'POST',
		success: function(data){
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].kd_ruang+'">'+data[i].no_urut+' | '+data[i].nm_ruang+'</option>';
			}
			$('#ruang').html(html);
		}
	});
}


