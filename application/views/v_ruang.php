<style type="text/css">
  .select2 {
    width:100%!important;
  }
  label{
    text-align: left!important;
  }
</style>
<section class="content" id="section_1" hidden="true">
  <div class="box">
    <div class="box-header with-border">
      <button class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#modal_ruang" onclick="tambah()"><i class="fa fa-plus fa-lg"></i> Tambah</button>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" id="tools_ttd" style="display: none;"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body" id="header_ttd" hidden="true">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                <select class="form-control search-slt select2" id="kd_skpd" onchange="get_unit(this.value);">
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 p-0" id="grid_kd_unit" hidden="true">
                <select class="form-control search-slt select2" id="kd_unit">
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                <button type="button" class="btn btn-info" onclick="refresh()"><i class="fa fa-search fa-lg"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body" style="padding: 5px;">
      <div class="table table-responsive">
        <table class="table table-striped" id="dataTable_1" width="100%" cellspacing="0" style="font-size: 82%">
          <thead class="bg-danger">
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>SKPD</th>
              <th>UNIT</th>
              <th>No. Urut</th>
              <th>Keterangan</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_ruang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-warehouse-alt"></i> TAMBAH RUANGAN</h4>
        </div>
        <div class="modal-body form-horizontal">
          <fieldset>
            <legend class="btn btn-default">DETAIL RUANGAN</legend>

            <div class="row">
              <div class="col-md-12">

                <div class="form-group">
                  <label class="control-label col-sm-4">SKPD</label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="skpd" onchange="get_unit_2(this.value);">
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">UNIT</label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="unit" onchange="get_kode(this.value)">
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">KODE RUANG</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control input-sm" id="kd_ruang" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">NAMA RUANG</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control input-sm" id="nm_ruang">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">NO. URUT</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control input-sm" id="no_urut" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">KETERANGAN</label>
                  <div class="col-md-7">
                    <textarea class="form-control" id="keterangan"></textarea>
                  </div>
                </div>

              </div>
            </div>
          </fieldset><br>
          <div class="form-group" align="center">
            <button class="btn btn-sm float-right btn-primary" id="save" value="0" onclick="simpan(this.value);"><i class="fa fa-save fa-lg"></i> Simpan</button>
            <button class="btn btn-sm btn-danger" class="close" data-dismiss="modal" onclick="close_modal();"><i class="fa fa-arrow-alt-to-left fa-lg"></i> Kembali</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<script src="<?php echo base_url(); ?>assets/js/v_ruang.js" type="text/javascript"></script>


