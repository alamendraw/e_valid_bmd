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
                <select class="form-control search-slt select2" id="kd_skpd" onchange="refresh();">
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-3 p-0">
                <select class="form-control search-slt" id="activity" onchange="refresh();">
                  <option value="">-ACTIVITY-</option>
                  <option value="1">Active</option>
                  <option value="0">Non Active</option>
                </select>
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
              <th>KODE UNIT</th>
              <th>NAMA UNIT</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
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

                <div class="form-group">
                  <label class="control-label col-sm-4">SKPD<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="skpd" onchange="get_unit_2(this.value);">
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">UNIT<span style="color: red;">*</span></label>
                  <div class="col-md-7">
                    <select class="form-control select2 input-sm" id="unit">
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
                    </select>
                  </div>
                </div>

              </div>
            </div>
          </fieldset><small class="text-muted"><i><span style="color: red;">*</span>Wajib</i></small><br>
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
<script src="<?php echo base_url(); ?>assets/js/v_activity.js" type="text/javascript"></script>


