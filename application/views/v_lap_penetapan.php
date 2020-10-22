 <style type="text/css">
	.select2 {
		width:100%!important;
	}
	label{
		text-align: left!important;
	}
</style>
<script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<section class="content">
	<div class="box">
		<div class="box-body">
			<div class="card-header">
				<h4 align="center">CETAK DAFTAR HASIL INVENTARISASI BARANG</h4><hr>
			</div>
			<div class="card-body form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-3">SKPD</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="kd_skpd" onchange="get_unit();get_ttd()">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Unit</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="unit_skpd" onchange="get_ttd()"></select>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 5px;">
							<label class="control-label col-sm-3">Tanggal</label>
							<div class="col-md-9">
								<div class="input-group date">
									<input type="text" class="form-control datepicker input-sm" id="tgl" name="tgl" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
								<div class="input-group">
									<input type="radio" id="func" name="func" value="cetak_lap_penetapan" checked="true">
									Komparasi  Hasil Inventaris<br>
									<input type="radio" id="func" name="func" value="cetak_rekap_penetapan">
									Rekap Komparasi  Hasil Inventaris<br>
									<input type="radio" id="func" name="func" value="cetak_rekap_komparasi">
									Rekap KIB Komparasi  Hasil Inventaris<br>
									<input type="radio" id="func" name="func" value="cetak_migrasi_kd_brg">
									Migrasi Kode Barang<br>
									<input type="radio" id="func" name="func" value="cetak_rekap_migrasi">
									Rekap Migrasi Kode Barang
								</div>
							</div>
						</div>

					</div>
					<div class="col-sm-6">
						<div class="form-group meng" hidden="true">
							<label class="control-label col-sm-3">Mengetahui</label>
							<div class="col-md-9">
								<select class="form-control select2" id="mengetahui" name="mengetahui" >
									<option value="">-PILIH-</option>
								</select>
							</div>
						</div>
						<div class="form-group pengg" hidden="true">
							<label class="control-label col-sm-3">Pengurus</label>
							<div class="col-md-9">
								<select class="form-control select2" id="pengurus" name="pengurus" >
									<option value="">-PILIH-</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12" align="center">
								<button class="btn btn-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-align-right"></i> Page Layout</button>
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
<script type="text/javascript">
	$(document).ready(function(){
	document.getElementById("s12").style.display = "block";
  document.getElementById("sm36").style.color = "white";
  document.getElementById("sm36").style.fontWeight = "bold";
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
		}
	});
	
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayBtn: "linked",
		autoclose: true,
		language: "id",
		todayHighlight: true
	}).datepicker("setDate",new Date());

	$('#kd_skpd').on('change',function(){
		if(this.value!=''){
			$('.meng').show();
			// $('.peng').hide();
		}else{
			$('.meng').hide();
			// $('.peng').hide();
		}
		$('#mengetahui').val('').trigger('change');
		// $('#pengurus').val('').trigger('change');
	});
	$('#unit_skpd').on('change',function(){
		if(this.value!=''){
			$('.meng').show();
			// $('.peng').show();
		}else{
			$('.meng').show();
			// $('.peng').hide();
		}
		$('#mengetahui').val('').trigger('change');
		// $('#pengurus').val('').trigger('change');
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
	var func     	   = $("input[name='func']:checked"). val();
	var url            = "<?=base_url()?>index.php/rekap_sensus/"+func;//cetak_lap_penetapan
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
	'&kd_unit='+unit_skpd;

	window.open(url+sub_url,'_blank');
	window.focus();
	
}
</script>

