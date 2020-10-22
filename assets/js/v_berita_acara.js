	var cjns = 'SKPD';
$(document).ready(function(){
	$('.upb').hide();
	$('.skpd').show();
	cek_otori();
	
	document.getElementById("s9").style.display = "block";
  document.getElementById("sm29").style.color = "white";
  document.getElementById("sm29").style.fontWeight = "bold";
  if (window.innerWidth > 760) {
		$('.select2').select2({
		});
	}
	$.ajax({
		url: 'berita_acara/get_skpd',
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
	}).datepicker('setDate', new Date());

});
function get_unit() {
	var kd_skpd = document.getElementById('kd_skpd').value;
	$.ajax({
		url: 'berita_acara/get_unit',
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
function get_ttd_skpd() {
	var kd_skpd   = document.getElementById('kd_skpd').value;
	$.ajax({
		url: 'berita_acara/get_mengetahui_skpd',
		dataType: 'json',
		type : 'POST',
		data: {kd_skpd:kd_skpd},
		success: function(data){
			var html = '<option disabled selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].nip+'" >'+data[i].nama+'</option>';
			}
			$('#mengetahui_skpd').html(html);

		}
	});
	$.ajax({
		url: 'berita_acara/get_pengurus_skpd',
		dataType: 'json',
		type : 'POST',
		data: {kd_skpd:kd_skpd},
		success: function(data){
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].nip+'" >'+data[i].nama+'</option>';
			}
			$('#pengurus_skpd').html(html);

		}
	});
	$.ajax({
		url: 'berita_acara/get_pppb_skpd',
		dataType: 'json',
		type : 'POST',
		data: {kd_skpd:kd_skpd},
		success: function(data){
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].nip+'" >'+data[i].nama+'</option>';
			}
			$('#pppb_skpd').html(html);

		}
	});
}
function get_ttd() {
	var kd_skpd   = document.getElementById('kd_skpd').value;
	var unit_skpd = document.getElementById('unit_skpd').value;
	$.ajax({
		url: 'berita_acara/get_mengetahui',
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
		url: 'berita_acara/get_pengurus',
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

function jns(jns) {
	if (jns=='SKPD') {
		cjns='SKPD';
		$('.upb').hide();
		$('.skpd').show();
		$('#unit_skpd').val('');
		$('#mengetahui').val('');
		$('#pengurus').val('');
	}else{
		cjns='UPB';
		$('.upb').show();
		$('.skpd').show();
		$('.pppb').hide();
	}
}

function cek_otori() {
	// alert(oto);
	if (oto=='2') {
		// $('#kd_skpd').val(oto_skpd).attr('disabled',true);
		// $('#unit_skpd').val();
	}else if(oto=='3'){
		$("input:radio[value='UPB']").prop("checked", true);
		$("#jns").attr("disabled", true);
		jns('UPB');
	// 	$('#kd_skpd').val(oto_skpd).attr('disabled',true);
	// 	if (get_unit()) {
	// 	$('#unit_skpd').val(oto_unit).attr('disabled',true);
	// }
	}
}

function openWindow($key){
	var cetak         = $key;
	var kpl_skpd      = $('#mengetahui_skpd option:selected').html();
	var nip_kpl_skpd  = $('#mengetahui_skpd').val();
	var peng_skpd     = $('#pengurus_skpd option:selected').html();
	var nip_peng_skpd = $('#pengurus_skpd').val();
	var pppb_skpd     = $('#pppb_skpd option:selected').html();
	var nip_pppb_skpd = $('#pppb_skpd').val();
	var kpl           = $('#mengetahui option:selected').html();
	var nip_kpl       = $('#mengetahui').val();
	var peng          = $('#pengurus option:selected').html();
	var nip_peng      = $('#pengurus').val();
	var tgl           = $('#tgl').val();;
	var kd_skpd       = $('#kd_skpd').val();
	var unit_skpd     = $('#unit_skpd').val();
	var url           = "berita_acara/cetak_berita_acara";
	var sub_url       = 
	'?cetak='+cetak+
	'&kpl_skpd='+kpl_skpd+
	'&nip_kpl_skpd='+nip_kpl_skpd+
	'&peng_skpd='+peng_skpd+
	'&nip_peng_skpd='+nip_peng_skpd+
	'&pppb_skpd='+pppb_skpd+
	'&nip_pppb_skpd='+nip_pppb_skpd+
	'&kpl='+kpl+
	'&nip_kpl='+nip_kpl+
	'&peng='+peng+
	'&nip_peng='+nip_peng+
	'&tgl='+tgl+
	'&kd_skpd='+kd_skpd+
	'&unit_skpd='+unit_skpd+
	'&cjns='+cjns;
	window.open(url+sub_url,'_blank');
	window.focus();
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
    url: 'Ttd/simpan',
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
    url: 'Ttd/get_unit',
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


