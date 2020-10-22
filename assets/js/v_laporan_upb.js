$(document).ready(function(){
	document.getElementById("s9").style.display = "block";
  document.getElementById("sm19").style.color = "white";
  document.getElementById("sm19").style.fontWeight = "bold";
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
		url: 'get_skpd',
		dataType: 'json',
		success: function(data){
			swal.close();
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].kd_skpd+'">'+data[i].kd_skpd+' | '+data[i].nm_skpd+'</option>';
			}
			$('#kd_skpd').html(html);
			$('#skpd_ttd').html(html);
		}
	});
	
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayBtn: "linked",
		autoclose: true,
		language: "id",
		todayHighlight: true
	}).datepicker("setDate",new Date());

});
function get_unit() {
	var kd_skpd = document.getElementById('kd_skpd').value;
	$.ajax({
		url: 'get_unit',
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
		url: 'get_mengetahui',
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
		url: 'get_pengurus',
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
	var thn            = document.getElementById('thn').value;
	var tgl            = document.getElementById('tgl').value;
	var s_tgl          = document.getElementById('s_tgl').value;
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
	var url            = "inventaris_upb";
	sub_url            = 
	'?cetak='+cetak+
	'&mengetahui='+mengetahui+
	'&nip_m='+nip_m+
	'&pengurus='+pengurus+
	'&nip_p='+nip_p+
	'&tgl='+tgl+
	'&s_tgl='+s_tgl+
	'&thn='+thn+
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
	
	if (kd_skpd=='') {
		swal("SKPD!","SKPD belum dipilih!");
	}/*else if(unit_skpd=='') {
		swal("Unit!","Unit belum dipilih!");
	}*/else{
		window.open(url+sub_url,'_blank');
		window.focus();
	}
}


function saveTtd(key) {
  var skpd         = $('#skpd_ttd').val();
  var unit         = $('#unit_ttd').val();
  var nip          = $('#nip').val();
  var nama         = $('#nama').val();
  var jabatan      = $("#jabatan option:selected").html();
  var kode_jabatan = $('#jabatan').val();
  if (skpd=='') {
    swal('','Pilih SKPD!!!');
    return false;
  }
  if (unit=='') {
    swal('','Pilih UNIT!!!');
    return false;
  }
  if (jabatan=='') {
    swal('','Pilih JABATAN!!!');
    return false;
  }
  if (nip=='' || nip==' ' || nip=='_' || nip=='-') {
    swal('','NIP tidak sesuai!!!');
    return false;
  }
  if (nama=='' || nama==' ' || nama=='_' || nama=='-') {
    swal('','Nama tidak boleh kosong!!!');
    return false;
  }
  $.ajax({
    url: 'saveTtd',
    dataType: 'json',
    type    : 'POST',
    data: ({key,skpd,unit,nip,nama,jabatan,kode_jabatan}),
    beforeSend: function (data) {
      swal({
        title            : 'Mohon tunggu..!',
        imageUrl         : '../assets/sweetalert/lib/loader.gif',
        allowOutsideClick: false,
        allowEscapeKey   : false,
        allowEnterKey    : false,
        showConfirmButton: false
      })
    },
    success: function(data){
      if (data==true) {
        $('.close').click();
        if(data.error) return;
        $(document).ajaxStop(function() { location.reload(true); });
        swal.close();
      }else{
        swal({
          title: 'Ops!',
          text : 'Gagal!',
          type : 'error'
        });
      }
    }
  });
}

function get_unit_2(kd_skpd) {
  $.ajax({
    url: 'get_unit',
    dataType: 'json',
    type : 'POST',
    data: {kd_skpd:kd_skpd},
    success: function(data){
      swal.close();
      var html = '<option selected value="">-UNIT-</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value="'+data[i].kd_lokasi+'">'+data[i].kd_lokasi+' | '+data[i].nm_lokasi+'</option>';
      }
      $('#unit_ttd').html(html);
    }
  });
}

