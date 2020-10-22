$(document).ready(function(){
	cek_jns_cetak();
	if (window.innerWidth > 760) {
		$('.select2').select2({
		});
	}
	$.ajax({
		url: 'Progress/get_skpd',
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
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayBtn: "linked",
		autoclose: true,
		language: "id",
		todayHighlight: true
	});
});
function get_unit() {
	var kd_skpd = document.getElementById('kd_skpd').value;
	$.ajax({
		url: 'Progress/get_unit',
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
function cek_jns_cetak() {
	$.ajax({
		url: 'Progress/get_jns_cetak',
		dataType: 'json',
		success: function(data){
			var html = '<option selected value="">-PILIH-</option>';
			if (data==1) {
				html += '<option value="1">SEMUA UNIT</option>';
				html += '<option value="2">PER SKPD</option>';
				html += '<option value="3">PER UNIT</option>';
				html += '<option value="4">REKAP SKPD</option>';
				document.getElementById("m11").style.display = "block";
				document.getElementById("m11").style.background = "linear-gradient(90deg, rgba(36,69,87,1) 0%, rgba(26,34,38,1) 100%)";
				document.getElementById("m11").style.boxShadow = "0px 6px 11px -3px rgba(0,0,0,0.57)";
				document.getElementById("s11").style.fontWeight = "bold";
				document.getElementById("s11").style.color = "white";
			}else if(data==2){
				html += '<option value="2">PER SKPD</option>';
				html += '<option value="3">PER Unit</option>';
				document.getElementById("m11").style.display = "block";
				document.getElementById("m11").style.background = "linear-gradient(90deg, rgba(36,69,87,1) 0%, rgba(26,34,38,1) 100%)";
				document.getElementById("m11").style.boxShadow = "0px 6px 11px -3px rgba(0,0,0,0.57)";
				document.getElementById("s11").style.fontWeight = "bold";
				document.getElementById("s11").style.color = "white";
			}
			$('#jns_cetak').html(html);
		}
	});
}
function jns_cetak() {
	var jns_cetak = $('#jns_cetak').val();
	if (jns_cetak==1 || jns_cetak=='') {
		$('#select_1').hide();
		$('#select_2').hide();
		$('#kd_skpd').val('').trigger('change.select2');
		$('#unit_skpd').val('').trigger('change.select2');
		$('#rinci_view').show();
	}else if (jns_cetak==2) {
		$('#select_1').show();
		$('#select_2').hide();
		$('#unit_skpd').val('').trigger('change.select2');
		$('#rinci_view').show();
	}else if (jns_cetak==3){
		$('#kd_skpd').val('').trigger('change.select2');
		$('#unit_skpd').val('').trigger('change.select2');
		$('#select_1').show();
		$('#select_2').show();
		$('#rinci_view').show();
	}else{
		$('#kd_skpd').val('').trigger('change.select2');
		$('#unit_skpd').val('').trigger('change.select2');
		$('#select_1').hide();
		$('#select_2').hide();
		$('#rinci_view').hide();
	}
}
function openWindow($key){
	var jns_cetak      = document.getElementById('jns_cetak').value;
	var cetak          = $key;
	var kd_skpd        = document.getElementById('kd_skpd').value;
	var unit_skpd      = document.getElementById('unit_skpd').value;
	var tgl            = document.getElementById('tgl').value;
	var rinci          = ($("#rinci:checked").val()==null)? '' : $("#rinci:checked").val();
	var url            = "Progress/cetak_progress";
	sub_url            = 
	'?cetak='+cetak+
	'&tgl='+tgl+
	'&kd_skpd='+kd_skpd+
	'&unit_skpd='+unit_skpd+
	'&format='+rinci+
	'&jns_cetak='+jns_cetak;
	if (jns_cetak=='') {
		swal("Jenis Cetak !!!","Jenis cetak belum dipilih!");
	}else if (jns_cetak==1) {
		window.open(url+sub_url,'_blank');
		window.focus();
	}else if (jns_cetak==2){
		if (kd_skpd=='') {
			swal("SKPD !!!","SKPD belum dipilih!");
		}else{
			window.open(url+sub_url,'_blank');
			window.focus();
		}
	}else if (jns_cetak==3){
		if (kd_skpd=='') {
			swal("SKPD !!!","SKPD belum dipilih!");
		}else if(unit_skpd=='') {
			swal("Unit !!!","Unit belum dipilih!");
		}else{
			window.open(url+sub_url,'_blank');
			window.focus();
		}
	}else{
			window.open(url+sub_url,'_blank');
			window.focus();
	}
}


