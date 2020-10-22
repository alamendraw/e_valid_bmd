$(document).ready(function(){
	document.getElementById("s9").style.display = "block";
  document.getElementById("sm28").style.color = "white";
  document.getElementById("sm28").style.fontWeight = "bold";
	if (window.innerWidth > 760) {
		$('.select2').select2({
		});
	}
	$('#t_baris').each(function () {

		$(this).number();

	});
	$('.number_type').each(function () {

		$(this).number();

	});

	$.ajax({
		url: 'Laporan/get_skpd',
		dataType: 'json',
		success: function(data){
			swal.close();
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
		url: 'Laporan/get_unit',
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
function get_ttd() {
	var kd_skpd   = document.getElementById('kd_skpd').value;
	var unit_skpd = document.getElementById('unit_skpd').value;
	$.ajax({
		url: 'Laporan/get_mengetahui',
		dataType: 'json',
		type : 'POST',
		data: {kd_skpd:kd_skpd,unit_skpd:unit_skpd},
		success: function(data){
			var html = '<option disabled selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].nip+'" >'+data[i].nama+'</option>';
			}
			$('#mengetahui').html(html);

		}
	});
	$.ajax({
		url: 'Laporan/get_pengurus',
		dataType: 'json',
		type : 'POST',
		data: {kd_skpd:kd_skpd,unit_skpd:unit_skpd},
		success: function(data){
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].nip+'" >'+data[i].nama+'</option>';
			}
			$('#pengurus').html(html);

		}
	});
}


function openWindow($key){
	var cetak          = $key;
	var mengetahui     = $('#mengetahui option:selected').html();
	var nip_m          = document.getElementById('mengetahui').value;
	var pengurus       = $('#pengurus option:selected').html();
	var nip_p          = document.getElementById('pengurus').value;
	var tgl            = document.getElementById('tgl').value;
	var tmrg           = document.getElementById('tmrg').value;
	var bmrg           = document.getElementById('bmrg').value;
	var lmrg           = document.getElementById('lmrg').value;
	var rmrg           = document.getElementById('rmrg').value;
	var hmrg           = document.getElementById('hmrg').value;
	var fmrg           = document.getElementById('fmrg').value;
	var t_baris        = document.getElementById('t_baris').value;
	var orien          = document.getElementById('orien').value;
	var kd_skpd        = document.getElementById('kd_skpd').value;
	var unit_skpd      = document.getElementById('unit_skpd').value;
	var url            = "Rekap_sensus/cetak_rekap";
	sub_url            = 
	'?cetak='+cetak+
	'&mengetahui='+mengetahui+
	'&nip_m='+nip_m+
	'&pengurus='+pengurus+
	'&nip_p='+nip_p+
	'&tgl='+tgl+
	'&tmrg='+tmrg+
	'&bmrg='+bmrg+
	'&lmrg='+lmrg+
	'&rmrg='+rmrg+
	'&hmrg='+hmrg+
	'&fmrg='+fmrg+
	'&t_baris='+t_baris+
	'&orien='+orien+
	'&kd_skpd='+kd_skpd+
	'&unit_skpd='+unit_skpd;
	
	if (tgl=='') {
		swal("PER TANGGAL!","PER TANGGAL belum dipilih!");
	}else{
		window.open(url+sub_url,'_blank');
		window.focus();
	}
}
