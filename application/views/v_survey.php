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
				<h4 align="center">CETAK KERTAS KERJA SURVEY</h4><hr>
			</div>
			<div class="card-body form-horizontal">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label col-sm-3">SKPD</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="kd_skpd" onchange="get_unit();">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Unit</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="unit_skpd" onchange="limit()"></select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Jenis KIB</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="jns_kib" onchange="limit();">
									<option value="0">SAMPUL & PELENGKAP</option>
									<option value="1">A - TANAH</option>
									<option value="2">B - PERALATAN & MESIN</option>
									<option value="3">C - GEDUNG & BANGUNAN</option>
									<option value="4">D - JALAN, IRIGASI & JARINGAN</option>
									<option value="5">E - ASET TETAP LAINNYA</option>
									<option value="6">F - KONSTRUKSI DALAM PENGERJAAN</option>
								</select>
							</div>
						</div>
						<div class="form-group" hidden="true" id="tag_ruang">
							<label class="control-label col-sm-3">Ruang</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="ruang"></select>
							</div>
						</div>
						<div class="form-group" hidden="true" id="tag_limit">
							<label class="control-label col-sm-3">Limit</label>
							<div class="col-md-1">
								<input type="number" class="form-control input-sm" id="limit" min="0" value="0">
							</div>
						</div>					
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"><hr>
						<div class="form-group" align="center">
							<button class="btn btn-sm float-right btn-primary" onclick="openWindow(1);"><i class="fa fa-print-search fa-lg"></i> Preview</button>
							<button class="btn btn-sm btn-info"  onclick="openWindow(2);"><i class="fa fa-file-word fa-lg"></i> Cetak Word</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo base_url(); ?>assets/js/v_survey.js" type="text/javascript"></script>

