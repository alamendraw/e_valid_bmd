<style type="text/css">
	.select2 {
		width:100%!important;
	}
	label{
		text-align: left!important;
	}
</style>
<section class="content">
	<div class="box">
		<div class="box-body">
			<div class="card-header">
				<h4 align="center">CETAK LAPORAN SENSUS REVIEW</h4><hr>
			</div>
			<div class="card-body form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-3">SKPD</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="kd_skpd" onchange="get_unit()">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Unit</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="unit_skpd" onchange="get_ttd()"></select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Jenis KIB</label>
							<div class="col-md-9">
								<select class="form-control select2" id="jns_kib" onchange="show_sub()">
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Jenis Cetak</label>
							<div class="col-md-9">
								<select class="form-control select2" id="jns_cetak" onchange="show_main()">
									<option value="0" selected>-Semua-</option>
									<option value="1">Sudah Sensus</option>
									<option value="2">Belum Sensus</option>
								</select>
							</div>
						</div>

						<div class="form-group" hidden="true" id="show_1">
							<label class="control-label col-sm-3">Fisik Barang</label>
							<div class="col-md-9">
								<select class="form-control select2" id="fisik_brg" onchange="show_sub()">
									<option value="2" selected>-Semua-</option>
									<option value="1">Fisik Barang Ada</option>
									<option value="0">Fisik Barang Tidak Ada</option>
								</select>
							</div>
						</div>

						<div class="form-group" hidden="true" id="show_2">
							<label class="control-label col-sm-3">Kriteria</label>
							<div class="col-md-9">
								<select class="form-control select2" id="kriteria">
								</select>
							</div>
						</div>

					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-3">Mengetahui</label>
							<div class="col-md-9">
								<select class="form-control select2" id="mengetahui" name="mengetahui">
									<option value="">-PILIH-</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Pengurus</label>
							<div class="col-md-9">
								<select class="form-control select2" id="pengurus" name="pengurus">
									<option value="">-PILIH-</option>
								</select>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<label class="control-label col-sm-3">Tanggal</label>
							<div class="col-md-9">
								<div class="input-group date">
									<input type="text" class="form-control datepicker input-sm" id="tgl" name="tgl" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12" align="center">
								<button class="btn btn-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-align-right"></i> Page Layout</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-light" role="button" data-toggle="modal" data-target="#modal_ttd" ><i class="fa fa-plus fa-lg"></i> TTD</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"><hr>
						<div class="form-group" align="center">
							<button class="btn btn-sm float-right btn-primary" onclick="openWindow(1);"><i class="fa fa-print-search fa-lg"></i> Preview</button>
							<button class="btn btn-sm btn-danger"  onclick="openWindow(2);"><i class="fa fa-file-pdf fa-lg"></i> Cetak PDF</button>
							<button class="btn btn-sm btn-info"  onclick="openWindow(3);"><i class="fa fa-file-excel fa-lg"></i> Cetak Excel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-align-right"></i> Page Layout</h4>
				</div>
				<div class="modal-body" align="center">
					<div class="form-horizontal striped-rows">
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Top Margin</label>
							<div class="col-md-9">
								<input type="number" class="form-control  number_type" id="tmrg" name="tmrg"  step="1" min="0" value="10">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Bottom Margin</label>
							<div class="col-md-9">
								<input type="number" class="form-control  number_type" id="bmrg" name="bmrg"  step="1" min="0" value="10">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Left Margin</label>
							<div class="col-md-9">
								<input type="number" class="form-control  number_type" id="lmrg" name="lmrg"  step="1" min="0" value="10">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Right Margin</label>
							<div class="col-md-9">
								<input type="number" class="form-control  number_type" id="rmrg" name="rmrg"  step="1" min="0" value="10">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Header</label>
							<div class="col-md-9">
								<input type="number" class="form-control  number_type" id="hmrg" name="hmrg"  step="1" min="0" value="10">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Footer</label>
							<div class="col-md-9">
								<input type="number" class="form-control  number_type" id="fmrg" name="fmrg"  step="1" min="0" value="10">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Tinggi Baris</label>
							<div class="col-md-9" align="center">
								<input type="number" class="form-control input-sm" id="t_baris" name="t_baris"  step="1" min="20" value="20">
							</div>
						</div>
						<div class="form-group" align="center">
							<label class="control-label col-sm-3">Orientasi</label>
							<div class="col-md-9" align="center">
								<select id="orien" class="form-control">
									<option value="L">Lanscape</option>
									<option value="P">Potrait</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="modal_ttd" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-signature"></i> TAMBAH PENANDATANGANAN</h4>
        </div>
        <div class="modal-body form-horizontal">

          <fieldset>
            <legend class="btn btn-default">DETAIL PENANDATANGANAN</legend>
            <div class="row">
              <div class="col-md-12">
              	<form id="fm">
                <div class="form-group">
                  <label class="control-label col-sm-4">SKPD<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="skpd_ttd" onchange="get_unit_2(this.value);">
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">UNIT<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="unit_ttd">
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">NIP<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <input type="text" class="form-control input-sm" id="nip" placeholder="00000000 000000 0 000">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">NAMA<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <input type="text" class="form-control input-sm" id="nama">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">JABATAN<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="jabatan" style="text-transform: uppercase;">
                      <option value="" selected disabled>-PILIH-</option>
                      <option value="PA">Pengguna Anggaran</option>
                      <option value="PB">Pengurus Barang</option>
                      <option value="PPPB">Pejabat Penatausahaan Pengguna Barang</option>
                    </select>
                  </div>
                </div>
            	</form>
              </div>
            </div>
          </fieldset><small class="text-muted"><i><span style="color: red;">*</span>Wajib</i></small><br>
          <div class="form-group" align="center">
            <button class="btn btn-sm float-right btn-primary"><i class="fa fa-save fa-lg" onclick="saveTtd(0)"></i> Simpan</button>
            <button class="btn btn-sm btn-danger" class="close" data-dismiss="modal"><i class="fa fa-arrow-alt-to-left fa-lg"></i> Kembali</button>
          </div>

        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
	$(document).ready(function(){
	document.getElementById("s9").style.display = "block";
  document.getElementById("sm33").style.color = "white";
  document.getElementById("sm33").style.fontWeight = "bold";
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
		url: '<?=base_url()?>index.php/laporan/get_jns_sensus',
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
		url: '<?=base_url()?>index.php/laporan/get_skpd',
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
		url: '<?=base_url()?>index.php/laporan/get_unit',
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
		url: '<?=base_url()?>index.php/laporan/get_mengetahui',
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
		url: '<?=base_url()?>index.php/laporan/get_pengurus',
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
	var url            = "<?=base_url()?>index.php/laporan/cetak_laporan_review";
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
    url: '<?=base_url()?>index.php/ttd/simpan',
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
    url: '<?=base_url()?>index.php/ttd/get_unit',
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

</script>

