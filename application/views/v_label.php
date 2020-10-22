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
				<h4 align="center">CETAK LABEL SENSUS</h4><hr>
			</div>
			<div class="card-body form-horizontal">
				<div class="row">
					<div class="col-sm-12">
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
								<select class="form-control input-sm select2" id="unit_skpd"></select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Jenis KIB</label>
							<div class="col-md-9">
								<select class="form-control select2" id="jns_kib">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Per Nomor Urut</label>
							<div class="col-md-2 col-sm-2 col-xs-6">
								<input type="number" id="urut_awal" value="0" min="0" class="form-control input-sm">
								<span><small><i>* Isi nol jika semuanya</i></small></span>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-6">
								<input type="number" id="urut_akhir" value="0" min="0" class="form-control input-sm">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Page Size</label>
							<div class="col-md-2 col-sm-2 col-xs-6">
								<select class="form-control select2" id="size">
									<option value="A4">A4 Potrait</option>
									<option value="A4-L">A4 Lanscape</option>
									<option value="Legal">Legal Potrait</option>
									<option value="Legal-L">Legal Lanscape</option>
									<option value="Folio">Folio Potrait</option>
									<option value="Folio-L">Folio Lanscape</option>
								</select>
							</div>
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"><hr>
						<div class="form-group" align="center">
							<button class="btn btn-sm float-right btn-primary" onclick="openWindow(1);"><i class="fa fa-print-search fa-lg"></i> Preview</button>
							<button class="btn btn-sm btn-danger"  onclick="openWindow(2);"><i class="fa fa-file-pdf fa-lg"></i> Cetak PDF</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo base_url(); ?>assets/js/v_label.js" type="text/javascript"></script>

