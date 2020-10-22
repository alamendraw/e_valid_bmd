<section class="content">
  <marquee class="login100-form" style="background-color:#337ab7;color:white;top: 0;min-height: 1vh;height: 24px;padding: 2px;border-radius: 4px;margin-bottom: 5px;" scrollamount="5" behavior="scroll" direction="left"  role="button" data-toggle="modal" data-target="#pengmodal">
    E-Valid BMD merupakan aplikasi pencacahan Barang Milik Daerah untuk menjawab tantangan permasalahan pengelolaan Barang Milik Daerah yang mampu meningkatkan validitas data Barang Milik Daerah
  </marquee>
  <input type="text" id="otori" value="<?php echo $_SESSION['otori'] ?>" hidden="true">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Update" onclick="refresh();">
          <i class="fas fa-undo"> Refresh</i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body no-padding">

      <div class="col-md-4">
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-mountains"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tanah</span>
            <span class="info-box-number" id="a_tot">0</span>
            <div class="progress">
              <div class="progress-bar a" style="width: 0%"></div>
            </div>
            <span class="progress-description">
              <div class="col-md-5" align="center" id="a_sen">
              </div>
              <div class="col-md-5" align="center" id="a_non">
              </div>
            </span>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-toolbox"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Peralatan dan Mesin</span>
            <span class="info-box-number" id="b_tot">0</span>

            <div class="progress">
              <div class="progress-bar b" style="width: 0%"></div>
            </div>
            <span class="progress-description">
              <div class="col-md-5" align="center" id="b_sen">
              </div>
              <div class="col-md-5" align="center" id="b_non">
              </div>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box bg-fuchsia">
          <span class="info-box-icon"><i class="fa fa-building"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Gedung dan Bangunan</span>
            <span class="info-box-number" id="c_tot">0</span>

            <div class="progress">
              <div class="progress-bar c" style="width: 0%"></div>
            </div>
            <span class="progress-description">
              <div class="col-md-5" align="center" id="c_sen">
              </div>
              <div class="col-md-5" align="center" id="c_non">
              </div>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-road"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jalan, Irigasi dan Jaringan</span>
            <span class="info-box-number" id="d_tot">0</span>

            <div class="progress">
              <div class="progress-bar d" style="width: 0%"></div>
            </div>
            <span class="progress-description">
              <div class="col-md-5" align="center" id="d_sen">
              </div>
              <div class="col-md-5" align="center" id="d_non">
              </div>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-tag"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Aset Tetap Lainnya</span>
            <span class="info-box-number" id="e_tot">0</span>

            <div class="progress">
              <div class="progress-bar e" style="width: 0%"></div>
            </div>
            <span class="progress-description">
              <div class="col-md-5" align="center" id="e_sen">
              </div>
              <div class="col-md-5" align="center" id="e_non">
              </div>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box bg-olive">
          <span class="info-box-icon"><i class="fa fa-traffic-cone "></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Konstruksi dalam Pengerjaan</span>
            <span class="info-box-number" id="f_tot">0</span>

            <div class="progress">
              <div class="progress-bar f" style="width: 0%"></div>
            </div>
            <span class="progress-description">
              <div class="col-md-5" align="center" id="f_sen">
              </div>
              <div class="col-md-5" align="center" id="f_non">
              </div>
            </span>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="box box-info" id="table_progress" hidden="true">
    <div class="box-header with-border">
      <h3 class="box-title">Progress Sensus</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Update" onclick="refresh_progress();">
          <i class="fas fa-undo"> Refresh</i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="card-body">
        <div class="table table-responsive">
          <table class="table table-striped"  id="table" width="100%" cellspacing="0" style="font-size: 82%">
            <thead>
              <tr>
                <th rowspan="2" style="background-color: #fefefe;vertical-align: middle;">NO</th>
                <th rowspan="2" style="background-color: #fefefe;vertical-align: middle;">NAMA</th>
                <th colspan="5" style="text-align: center;background-color: #f9f9f9">KIB A</th>
                <th colspan="5" style="text-align: center;background-color: #fefefe">KIB B</th>
                <th colspan="5" style="text-align: center;background-color: #f9f9f9">KIB C</th>
                <th colspan="5" style="text-align: center;background-color: #fefefe">KIB D</th>
                <th colspan="5" style="text-align: center;background-color: #f9f9f9">KIB E</th>
                <th colspan="5" style="text-align: center;background-color: #fefefe">KIB F</th>
              </tr>
              <tr>
                <th style="background-color: #f9f9f9;color:#f012be;">Total</th>
                <th style="background-color: #f9f9f9;color:#00a65a;"><i class="fa fa-check-circle"></i></th>
                <th style="background-color: #f9f9f9;color:#337ab7;">%</th>
                <th style="background-color: #f9f9f9;color:#dd4b39;"><i class="fa fa-empty-set"></i></th>
                <th style="background-color: #f9f9f9;color:#337ab7;">%</th>
                <th style="background-color: #fefefe;color:#f012be;">Total</th>
                <th style="background-color: #fefefe;color:#00a65a;"><i class="fa fa-check-circle"></i></th>
                <th style="background-color: #fefefe;color:#337ab7;">%</th>
                <th style="background-color: #fefefe;color:#dd4b39;"><i class="fa fa-empty-set"></i></th>
                <th style="background-color: #fefefe;color:#337ab7;">%</th>
                <th style="background-color: #f9f9f9;color:#f012be;">Total</th>
                <th style="background-color: #f9f9f9;color:#00a65a;"><i class="fa fa-check-circle"></i></th>
                <th style="background-color: #f9f9f9;color:#337ab7;">%</th>
                <th style="background-color: #f9f9f9;color:#dd4b39;"><i class="fa fa-empty-set"></i></th>
                <th style="background-color: #f9f9f9;color:#337ab7;">%</th>
                <th style="background-color: #fefefe;color:#f012be;">Total</th>
                <th style="background-color: #fefefe;color:#00a65a;"><i class="fa fa-check-circle"></i></th>
                <th style="background-color: #fefefe;color:#337ab7;">%</th>
                <th style="background-color: #fefefe;color:#dd4b39;"><i class="fa fa-empty-set"></i></th>
                <th style="background-color: #fefefe;color:#337ab7;">%</th>
                <th style="background-color: #f9f9f9;color:#f012be;">Total</th>
                <th style="background-color: #f9f9f9;color:#00a65a;"><i class="fa fa-check-circle"></i></th>
                <th style="background-color: #f9f9f9;color:#337ab7;">%</th>
                <th style="background-color: #f9f9f9;color:#dd4b39;"><i class="fa fa-empty-set"></i></th>
                <th style="background-color: #f9f9f9;color:#337ab7;">%</th>
                <th style="background-color: #fefefe;color:#f012be;">Total</th>
                <th style="background-color: #fefefe;color:#00a65a;"><i class="fa fa-check-circle"></i></th>
                <th style="background-color: #fefefe;color:#337ab7;">%</th>
                <th style="background-color: #fefefe;color:#dd4b39;"><i class="fa fa-empty-set"></i></th>
                <th style="background-color: #fefefe;color:#337ab7;">%</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="pengmodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 15px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PENGUMUMAN!</h4>
      </div>
      <div class="modal-body">
        <table style="border-collapse:collapse; font-size:10pt; font-family: arial" width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td colspan="2" align="justify">Kepada Seluruh Kepala SKPD/Unit Kerja lingkup Pemerintah Kota Makassar selaku Pengguna Barang/Kuasa Pengguna Barang.<br><br></td>
          </tr>
          <tr>
            <td colspan="2">Berdasarkan :</td>
          </tr>
          <tr>
            <td valign="top">1.</td>
            <td align="justify">Peraturan Walikota Makassar Nomor 44 Tahun 2018 tentang Petunjuk Teknis Inventarisasi Barang Milik Daerah</td>
          </tr>
          <tr>
            <td valign="top">2.</td>
            <td align="justify">Keputusan Sekretaris Daerah Kota Makassar Nomor 1186/028/Tahun 2019 tanggal 30 April 2019 tentang Penetapan Pelaksanaan Inventarisasi Barang Milik Daerah Kota Makassar Tahun Anggaran 2019</td>
          </tr>
          <tr>
            <td colspan="2" align="justify"><br>Sehubungan dengan hal tersebut, maka bersama ini disampaikan bahwa tahapan pelaksanaan sensus berikutnya adalah Reviu Hasil Sensus. Olehnya itu Laporan Hasil Sensus Pemerintah Kota Makassar TA 2019 akan segera disusun untuk diserahkan kepada Tim Reviu Hasil Sensus BMD, sehingga aplikasi E-Valid BMD <b>AKAN DI TUTUP per tanggal 31 Oktober 2019 Pkl.24.00 WITA</b>.<br>

              <br>Untuk seluruh barang SKPD/Unit Kerja yang tidak diselesaikan sampai dengan batas waktu tersebut, tetap akan dicantumkan dalam Laporan Hasil sensus Pemerintah Kota Makassar dengan status <b>BELUM DILAKUKAN SENSUS</b>.<br>

              <br>Demikian kami sampaikan.<br><br>
            </td>
          </tr>
        </table>
          <table style="border-collapse:collapse; font-size:10pt; font-family: arial" width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td width="50%"></td>
            <td width="50%" align="justify">
              Makassar, 25 Oktober 2019<br>
              Sekretaris Daerah selaku Pejabat Pengelola Barang Milik Daerah.<br><br>Ttd
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/v_dashboard.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var sesi = <?php echo($_SESSION['iduser'])?>;
    var sesi_val = localStorage.getItem(sesi);
    if (sesi_val!='1') {
      $('#pengmodal').modal('show');
      localStorage.setItem(sesi,'1');
    }else{
      localStorage.setItem(sesi,'1');
    }
});
</script>

