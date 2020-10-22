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
        <h4 align="center">CETAK PROGRESS SENSUS</h4><hr>
      </div>
      <div class="card-body form-horizontal">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="control-label col-sm-3">Jenis Cetak</label>
              <div class="col-md-9">
                <select class="form-control input-sm select2" id="jns_cetak" onchange="jns_cetak()">
                </select>
              </div>
            </div>
            <div class="form-group" hidden="true" id="select_1">
              <label class="control-label col-sm-3">SKPD</label>
              <div class="col-md-9">
                <select class="form-control input-sm select2" id="kd_skpd" onchange="get_unit()">
                </select>
              </div>
            </div>
            <div class="form-group" hidden="true" id="select_2">
              <label class="control-label col-sm-3">Unit</label>
              <div class="col-md-9">
                <select class="form-control input-sm select2" id="unit_skpd"></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Tanggal</label>
              <div class="col-md-9">
                <div class="input-group date">
                  <input type="text" class="form-control datepicker input-sm" id="tgl" name="tgl" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group" id="rinci_view" hidden="true">
              <label class="control-label col-sm-3"></label>
              <div class="col-md-9">
                <input type="checkbox" id="rinci" value="rinci"> <span class="text-muted"><i>*Tampilkan rincian</i></span>
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
<script src="<?php echo base_url(); ?>assets/js/v_progress.js" type="text/javascript"></script>
<tr>
  <td></td>
</tr>
