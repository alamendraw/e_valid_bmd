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
				<h4 align="center">CETAK LAPORAN UPB</h4><hr>
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
						<div class="form-group" hidden="true">
							<label class="control-label col-sm-3">Tahun</label>
							<div class="col-md-9">
								<select class="form-control select2" id="thn">
									<option selected disabled></option>
									<?php
										$date = date('Y');
										for ($i=2000; $i <=$date ; $i++) { 
											echo'<option>'.$i.'</option>';
										}

									?>
								</select>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 5px;">
							<label class="control-label col-sm-3">Per Tanggal</label>
							<div class="col-md-9">
								<div class="input-group date">
									<input type="text" class="form-control datepicker input-sm" id="s_tgl" name="s_tgl" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
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
            <button class="btn btn-sm float-right btn-primary" onclick="saveTtd(0)"><i class="fa fa-save fa-lg"></i> Simpan</button>
            <button class="btn btn-sm btn-danger" class="close" data-dismiss="modal"><i class="fa fa-arrow-alt-to-left fa-lg"></i> Kembali</button>
          </div>

        </div>
      </div>
    </div>
  </div>
<script src="<?php echo base_url(); ?>assets/js/v_laporan_upb.js" type="text/javascript"></script>

