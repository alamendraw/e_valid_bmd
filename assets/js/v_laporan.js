$(document).ready(function(){
	document.getElementById("s9").style.display = "block";
  document.getElementById("sm18").style.color = "white";
  document.getElementById("sm18").style.fontWeight = "bold";
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
		url: 'Laporan/get_jns_sensus',
		dataType: 'json',
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
			var html = '<option disabled selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].id+'" >'+data[i].nm_menu+'</option>';
			}
			$('#jns_kib').html(html);

		}
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
			$('#skpd_ttd').html(html);
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
function show_main() {
	if ($('#jns_cetak').val()==0 || $('#jns_cetak').val()==2) {
		$('#show_1').hide();
		$('#fisik_brg').val(2).trigger('change.select2');
		$('#show_2').hide();
		$('#keberadaan_brg').val(0).trigger('change.select2');
		$('#show_3').hide();
		$('#kondisi_brg').val(0).trigger('change.select2');
		$('#show_4').hide();
		$('#stat_hukum').val(0).trigger('change.select2');
		$('#show_5').hide();
		$('#bukti_milik').val(0).trigger('change.select2');
		$('#show_6').hide();
		$('#ket_brg').val(0).trigger('change.select2');
	}else if($('#jns_cetak').val()==1){
		$('#show_1').show();
	}
}
function show_sub() {
	var html;
	if ($('#fisik_brg').val()==2){
		$('#show_2').hide();
		$('#kriteria').val(0).trigger('change.select2');
	}else if ($('#fisik_brg').val()==1 && ($('#jns_kib').val()==3 || $('#jns_kib').val()==4)){
		html +=
		'<option value="0" selected>-Semua-</option>'+
		'<option disabled>Keberadaan Barang</option>'+
		'<option value="1">SKPD</option>'+
		'<option value="2">Dikerjasamakan dengan pihak lain</option>'+
		'<option value="3">Dikuasai secara tidak sah pihak lain</option>'+
		'<option disabled>Kondisi Barang</option>'+
		'<option value="4">Baik</option>'+
		'<option value="5">Kurang Baik</option>'+
		'<option value="6">Rusak Berat</option>'+
		'<option disabled>Permasalahan Hukum</option>'+
		'<option value="7">Tidak Dalam Gugatan Hukum</option>'+
		'<option value="8">Dalam Gugatan Hukum</option>'+
		'<option disabled>Bukti Kepemilikan</option>'+
		'<option value="9">Ada</option>'+
		'<option value="10">Tidak Ada</option>'+
		'<option disabled>Status Kepemilikan</option>'+
		'<option value="19">Milik Pemerintah Kota Makassar</option>'+
		'<option value="17">Milik Pemerintah Pusat (BMN)/Pemda Lain</option>'+
		'<option value="18">Milik Pihak Lain Non Pemerintah</option>';
		$('#kriteria').html(html);
		$('#show_2').show();
	}else if ($('#fisik_brg').val()==1){
		html +=
		'<option value="0" selected>-Semua-</option>'+
		'<option disabled>Keberadaan Barang</option>'+
		'<option value="1">SKPD</option>'+
		'<option value="2">Dikerjasamakan dengan pihak lain</option>'+
		'<option value="3">Dikuasai secara tidak sah pihak lain</option>'+
		'<option disabled>Kondisi Barang</option>'+
		'<option value="4">Baik</option>'+
		'<option value="5">Kurang Baik</option>'+
		'<option value="6">Rusak Berat</option>'+
		'<option disabled>Permasalahan Hukum</option>'+
		'<option value="7">Tidak Dalam Gugatan Hukum</option>'+
		'<option value="8">Dalam Gugatan Hukum</option>'+
		'<option disabled>Status Kepemilikan</option>'+
		'<option value="19">Milik Pemerintah Kota Makassar</option>'+
		'<option value="17">Milik Pemerintah Pusat (BMN)/Pemda Lain</option>'+
		'<option value="18">Milik Pihak Lain Non Pemerintah</option>';
		$('#kriteria').html(html);
		$('#show_2').show();
	}else{
		html +=
		'<option value="0" selected>-Semua-</option>'+
		'<option disabled>Keterangan</option>'+
		'<option value="11">Hilang Karena Kecurian</option>'+
		'<option value="12">Tidak Diketahui Keberadaannya</option>'+
		'<option value="13">Fisik Habis/Tidak Ada Kerena Sebab Yang Wajar</option>'+
		'<option value="14">Seharusnya Telah dihapus</option>'+
		'<option value="15">Dobel/Lebih Catat</option>'+
		'<option value="16">Koreksi Barang Habis Pakai</option>';
		$('#kriteria').html(html);
		$('#show_2').show();
	}
}
function openWindow($key){
	var cetak          = $key;
	var jns_kib        = document.getElementById('jns_kib').value;
	var jns_cetak      = document.getElementById('jns_cetak').value;
	var fisik_brg      = document.getElementById('fisik_brg').value;
	var kriteria       = document.getElementById('kriteria').value;
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
	var url            = "laporan/cetak_laporan";
	sub_url            = 
	'?cetak='+cetak+
	'&jns_kib='+jns_kib+
	'&jns_cetak='+jns_cetak+
	'&fisik_brg='+fisik_brg+
	'&kriteria='+kriteria+
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
	
	/*if (kd_skpd=='') {
		swal("SKPD!","SKPD belum dipilih!");
	}*//*else if(unit_skpd=='') {
		swal("Unit!","Unit belum dipilih!");
	}*//*else if(jns_kib=='') {
		swal("Jenis KIB","Jenis KIB belum dipilih!");
	}else{*/
		window.open(url+sub_url,'_blank');
		window.focus();
	/*}*/
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
