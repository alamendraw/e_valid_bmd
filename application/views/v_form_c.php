<style>
  .controls {
    margin-top: 16px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  #pac-input {
    background-color: #fff;
    padding: 0 11px 0 13px;
    width: 400px;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    text-overflow: ellipsis;
    bottom: 0px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
    margin-left: -1px;
    padding-left: 14px;
  }

  .pac-container {
    font-family: Roboto;
    z-index: 10000000;
  }

  #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
  }

  #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }
  #target {
    width: 345px;
  }
  .gmnoprint{
    bottom: 0px !important;
  }
  @media only screen and (max-width: 760px) {
    .modal-body{
      height: 400px !important;
    }
    #pac-input {
      width: 200px;
      font-size: 10px;
      bottom: 0px;
    }
    .iframe-container{
      height: 370px;
    }
  }
  .hover:hover{
    color: #ffe102 text-yellow!important;
    cursor: pointer;
  }
</style>
<script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<section class="content" id="section_table">
  <div class="box">
    <div class="box-header" id="select" style="display: none;">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                <select class="form-control search-slt select2" id="kd_skpd" onchange="get_unit(this.value);">
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 p-0">
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
    <div class="box-body"  id="section_1" hidden="true">
      <div class="card-header">
        <button class="btn btn-sm btn-danger active" onclick="belum();"><i class="fa fa-times-octagon fa-lg"></i> Belum Sensus</button>
        <button class="btn btn-xs float-right btn-primary" style="opacity: 0.5" onclick="sudah();"><i class="fa fa-check-square fa-lg"></i> Sudah Sensus</button>
        <?php
        if ($_SESSION['activity']==0) {
          echo '<div class="badge bg-red pull-right">Sensus Terkunci</div>';
        }
        ?>
        <hr>
      </div>
      <div class="card-body">
        <div class="table table-responsive">
          <table class="table table-striped" id="dataTable_1" width="100%" cellspacing="0" style="font-size: 82%">
            <thead class="bg-danger">
              <tr>
                <th>No</th>
                <th>No.Sensus</th>
                <th>Nama Barang</th>
                <th>Detail Barang</th>
                <th>Alamat</th>
                <th>Kode Barang</th>
                <th>Asal</th>
                <th>Th.Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>Status</th>
                <th>Sensus</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="box-body"  id="section_2" hidden="true">
      <div class="card-header">
        <button class="btn btn-xs btn-danger" style="opacity: 0.5" onclick="belum();"><i class="fa fa-times-octagon fa-lg"></i> Belum Sensus</button>
        <button class="btn btn-sm float-right btn-primary active" onclick="sudah();"><i class="fa fa-check-square fa-lg"></i> Sudah Sensus</button>
        <?php
        if ($_SESSION['activity']==0) {
          echo '<div class="badge bg-red pull-right">Sensus Terkunci</div>';
        }
        ?>
        <hr>
      </div>
      <div class="card-body">
        <div class="table table-responsive">
          <table class="table table-striped" id="dataTable_2" width="100%" cellspacing="0" style="font-size: 82%">
            <thead class="bg-primary">
              <tr>
                <th>No</th>
                <th>No.Sensus</th>
                <th>Nama Barang</th>
                <th>Detail Barang</th>
                <th>Alamat</th>
                <th>Kode Barang</th>
                <th>Asal</th>
                <th>Th.Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>Status</th>
                <th>Edit Sensus</th>
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
<section class="content" id="section_3" hidden="true">
  <div class="box">
    <div class="box-body">
      <table width="100%" class="col-sm-10">
        <tr>
          <td width="20%">UNIT PENGGUNA BARANG</td>
          <td width="1%" valign="middle">:</td>
          <td width="79%" valign="top"><?php echo $_SESSION['nm_skpd'] ?></td>
        </tr>
        <tr>
          <td>SUB UNIT</td>
          <td valign="middle">:</td>
          <td valign="top"><?php echo $_SESSION['nm_unit'] ?></td>
        </tr>
      </table>
      <div class="col-md-2" align="center">
        <h4 style="font-weight: bold; color: #3c8dbc;border: 1px solid #3c8dbc; border-radius: 4px;padding: 5px;margin: 0px;" id="no_header"></h4>
      </div>
    </div>
    <div class="box-body form-horizontal">
      <fieldset>
        <legend class="btn btn-default">DETAIL INVENTARISASI BARANG</legend>

        <div class="row">
          <div class="col-md-6 bor-right">

            <div class="form-group">
              <label class="control-label col-sm-5">No. ID Barang</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="id_brg" name="id_brg" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">No. Kode Barang</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="kd_brg" name="kd_brg" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Nama Barang</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="nm_brg" name="nm_brg" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Detail Barang</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="dtl_brg" name="dtl_brg">
                <small><i>* <span id="dtl_brg_awal"></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Konstruksi</label>
              <div class="col-md-7">
                <select class="form-control input-sm" id="konstruksi">
                  <option value="">-PILIH-</option>
                  <option value="Bertingkat">Bertingkat</option>
                  <option value="Tidak">Tidak</option>
                </select>
                <small><i>* <span id="konstruksi_awal"></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Jenis Gedung</label>
              <div class="col-md-7">
                <select class="form-control input-sm" id="jns_gedung">
                  <option value="">-PILIH-</option>
                  <option value="Beton">Beton</option>
                  <option value="Tidak">Tidak</option>
                </select>
                <small><i>* <span id="jns_gedung_awal"></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Luas/Lantai</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="luas" name="luas">
                <small><i>* <span id="luas_awal"></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Tanggal Dokumen</label>
              <div class="col-md-7">
                <div class="input-group date">
                  <input type="text" class="form-control datepicker input-sm" id="tgl_dok" name="tgl_dok" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
                <small><i>* <span id="tgl_dok_awal"></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">No. Dokumen</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="no_dok" name="no_dok">
                <small><i>* <span id="no_dok_awal"></span></i></small>
              </div>
            </div>


          </div>
          <div class="col-md-6">
            
            <div class="form-group">
              <label class="control-label col-sm-5">Alamat</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="alamat" name="alamat">
                <small><i>* <span id="alamat_awal"></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5 col-xs-12">Latitude/Longitude</label>
              <div class="col-md-3 col-sm-2 col-xs-5" style="margin-right: 1px;padding-right: 0px;">
                <input type="text" class="form-control input-sm" id="lat" name="lat">
                <small><i>* <span id="lat_awal"></span></i></small>
              </div>
              <div class="col-md-3 col-sm-2 col-xs-5" style="margin-right: -18px; padding-left: 0px;">
                <input type="text" class="form-control input-sm" id="lon" name="lon">
                <small><i>* <span id="lon_awal"></span></i></small>
              </div>
              <div class="col-md-1 col-sm-2 col-xs-2" style="padding-left: 11px;">
                <i class="fa fa-map-marked-alt fa-2x text-primary" role="button" data-toggle="modal" data-target="#myModal" onclick="initialize();"></i>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Asal/Cara Perolahan</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="asal" name="asal" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Tahun Perolehan</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="thn_oleh" name="thn_oleh" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Nilai Perolehan</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="nilai_oleh" name="nilai_oleh" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-5">Kondisi Awal</label>
              <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="kondisi_awal" name="kondisi_awal" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Keterangan</label>
              <div class="col-md-7">
                <textarea class="form-control input-sm" id="ket" name="ket"></textarea>
                <small><i>* <span><textarea class="form-control input-sm read" id="ket_awal" readonly></textarea></span></i></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5">Kronologis</label>
              <div class="col-md-7">
                <textarea class="form-control input-sm" id="kronologis" name="kronologis"></textarea>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
      <br>
      <fieldset>
        <legend class="btn btn-default">DETAIL GAMBAR BARANG</legend>

        <div class="row">
          <div class="col-md-12">
            <form id="gambar" class="form-horizontal">
              <input type="hidden" class="form-control input-sm" id="id_brg2" name="id_brg2" readonly>
              <div class="form-group">
                <label class="control-label col-sm-3">Gambar 1</label>
                <div class="col-md-7">
                  <div class="input-group">
                    <label class="input-group-btn">
                      <span class="btn btn-primary input-sm" onclick="reset_prog();">
                        Browse&hellip; <input type="file" style="display: none;" multiple name="file_1">
                      </span>
                    </label>
                    <input type="text" class="form-control input-sm" readonly id="file_1">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Gambar 2</label>
                <div class="col-md-7">
                  <div class="input-group">
                    <label class="input-group-btn">
                      <span class="btn btn-primary input-sm" onclick="reset_prog();">
                        Browse&hellip; <input type="file" style="display: none;" multiple name="file_2">
                      </span>
                    </label>
                    <input type="text" class="form-control input-sm" readonly id="file_2">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Gambar 3</label>
                <div class="col-md-7">
                  <div class="input-group">
                    <label class="input-group-btn">
                      <span class="btn btn-primary input-sm" onclick="reset_prog();">
                        Browse&hellip; <input type="file" style="display: none;" multiple name="file_3">
                      </span>
                    </label>
                    <input type="text" class="form-control input-sm" readonly id="file_3">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3">Gambar 4</label>
                <div class="col-md-7">
                  <div class="input-group">
                    <label class="input-group-btn">
                      <span class="btn btn-primary input-sm" onclick="reset_prog();">
                        Browse&hellip; <input type="file" style="display: none;" multiple name="file_4">
                      </span>
                    </label>
                    <input type="text" class="form-control input-sm" readonly id="file_4">
                  </div>
                </div>
              </div>

              <div class="progress progress-striped active">
                <div class="progress-bar" style="width:0%">
                </div>
              </div>
              <div class="form-group" align="center">
                <button class="btn btn-sm btn-primary upload" type="submit"><i class="fa fa-upload fa-lg"></i> Upload</button>
                <button type="button" class="btn btn-sm btn-danger cancel float-right"><i class="fa fa-ban fa-lg"></i> Cancel</button>
              </div>
              <div class="gallery">
                <div class="row justify-content-center">
                  <div class="col-md-12 img-wrapper">
                    <div id="page_1" class="col-md-3 col-sm-4 col-xs-6" hidden="true">
                      <a id="herf_1" href="" data-toggle="lightbox" data-gallery="example-gallery">
                        <img id="img1" src="" class="img-responsive img-rounded">
                      </a>
                      <div class="img-overlay">
                        <i onclick="hapus_image(1,'foto1')" class="fa fa-trash btn btn-success" style="cursor: pointer;"></i>
                      </div>
                    </div>
                    <div id="page_2" class="col-md-3 col-sm-4 col-xs-6" hidden="true">
                      <a id="herf_2" href="" data-toggle="lightbox" data-gallery="example-gallery">
                        <img id="img2" src="" class="img-responsive img-rounded">
                      </a>
                      <div class="img-overlay">
                        <i onclick="hapus_image(2,'foto2')" class="fa fa-trash btn btn-success" style="cursor: pointer;"></i>
                      </div>
                    </div>
                    <div id="page_3" class="col-md-3 col-sm-4 col-xs-6" hidden="true">
                      <a id="herf_3" href="" data-toggle="lightbox" data-gallery="example-gallery">
                        <img id="img3" src="" class="img-responsive img-rounded">
                      </a>
                      <div class="img-overlay">
                        <i onclick="hapus_image(3,'foto3')" class="fa fa-trash btn btn-success" style="cursor: pointer;"></i>
                      </div>
                    </div>
                    <div id="page_4" class="col-md-3 col-sm-4 col-xs-6" hidden="true">
                      <a id="herf_4" href="" data-toggle="lightbox" data-gallery="example-gallery">
                        <img id="img4" src="" class="img-responsive img-rounded">
                      </a>
                      <div class="img-overlay">
                        <i onclick="hapus_image(4,'foto4')" class="fa fa-trash btn btn-success" style="cursor: pointer;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </fieldset>
      <br>
      <fieldset>
        <legend class="btn btn-default">KETERANGAN INVENTARISASI BARANG</legend>
        <div class="row">

          <div class="col-md-3" >
            <div class="form-group row">
              <label class="col-md-12"><input type="radio" name="stat_fisik" value="1" onclick="ada();" checked> Fisik Barang Ada</label>
            </div>
            <div class="form-group row">
              <label class="col-md-12"><input type="radio" name="stat_fisik" value="0" onclick="tidak_ada();"> Fisik Barang Tidak Ada</label>
            </div>
          </div>

          <div class="col-md-9 bor-left"  id="ada">
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3">Keberadaan Barang</label>
              <div class="col-md-9">
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="keberadaan_brg" value="SKPD"> SKPD <span class="badge badge-pill badge-primary btn-info" data-toggle="popover" data-placement="top" data-content="Keterangan: Digunakan, dipinjampakai ke instansi pemerintah yang lain, atau IDLE.">?</span></label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="keberadaan_brg" value="Dikerjasamakan dengan pihak lain"> Dikerjasamakan dengan pihak lain</label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="keberadaan_brg" value="Dikuasai secara tidak sah pihak lain"> Dikuasai secara tidak sah pihak lain</label>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3">Kondisi Barang</label>
              <div class="col-md-9">
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" class="radio-custom" name="kondisi_brg" value="B"> Baik</label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="kondisi_brg" value="KB"> Kurang Baik</label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="kondisi_brg" value="RB"> Rusak Berat</label>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3">Permasalahan Hukum</label>
              <div class="col-md-9">
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="stat_hukum" value="Tidak Dalam Gugatan Hukum"> Tidak Dalam Gugatan Hukum</label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();" name="stat_hukum" value="Dalam Gugatan Hukum"> Dalam Gugatan Hukum<input type="text" class="form-control input-sm" id="ket_stat_hukum" name="ket_stat_hukum" placeholder="Keterangan"></label>
              </div>
            </div>
            <hr hidden="true">
            <div class="form-group" hidden="true">
              <label class="control-label col-sm-3">Bukti Kepemilikan</label>
              <div class="col-md-9">
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();"  name="bukti_milik" value="Ada"> Ada(Sertifikat Tanah)</label><!-- class="radio_ada" -->
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();"  name="bukti_milik" value="Tidak Ada" checked> Tidak Ada</label><!-- class="radio_ada" -->
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3">Status Kepemilikan</label>
              <div class="col-md-9">
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();"  name="status_milik" value="Milik Pemerintah Kota Makassar"> Milik Pemerintah Kota Makassar</label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();"  name="status_milik" value="Milik Pemerintah Pusat"> Milik Pemerintah Pusat(BMN)/Pemda Lain</label>
                <label class="col-sm-12" ><input type="radio" class="radio_ada" onclick="uncheked_tidak_ada();"  name="status_milik" value="Milik Pihak Lain Non Pemerintah"> Milik Pihak Lain Non Pemerintah</label>
              </div>
            </div>
            <hr>
          </div>

          <div class="col-md-9 bor-left" id="tidak_ada">
            <div class="form-group">
              <label class="control-label col-sm-3">Keterangan</label>
              <div class="col-md-9">
                <label class="col-sm-12" ><input type="radio" class="radio_tidak_ada" onclick="uncheked_ada();" name="ket_brg" value="Hilang"> Hilang Karena Kecurian<input type="text" class="form-control input-sm" id="no_surat_pol" name="no_surat_pol" placeholder="No. Surat Polisi"></label>
                <label class="col-sm-12" ><input type="radio" class="radio_tidak_ada" onclick="uncheked_ada();" name="ket_brg" value="Tidak Diketahui Keberadaannya"> Tidak Diketahui Keberadaannya</label>
                <label class="col-sm-12" ><input type="radio" class="radio_tidak_ada" onclick="uncheked_ada();" name="ket_brg" value="Habis Akibat Usia Barang"> Fisik Habis/Tidak Ada Karena Sebab Yang Wajar</label>
                <label class="col-sm-12" ><input type="radio" class="radio_tidak_ada" onclick="uncheked_ada();" name="ket_brg" value="Seharusnya Telah dihapus"> Seharusnya Telah dihapus <span class="badge badge-pill badge-primary btn-info" data-toggle="popover" data-placement="top" data-content="SK Pengalihan Status. Pemindahtanganan">?</span></label>
                <label class="col-sm-12" ><input type="radio" class="radio_tidak_ada" onclick="uncheked_ada();" name="ket_brg" value="Double Catat"> Dobel/Lebih Catat</label>
                <label class="col-sm-12" ><input type="radio" class="radio_tidak_ada" onclick="uncheked_ada();" name="ket_brg" value="Koreksi BHP"> Koreksi Barang Habis Pakai</label>
              </div>
            </div>

          </div>

        </div>
      </fieldset>
      <br>
      <div class="form-group" align="center">
        <button class="btn btn-sm btn-primary" onclick="submit(1);" id="simpan_main"><i class="fa fa-save fa-lg"></i> Simpan</button>
        <button class="btn btn-sm btn-success" onclick="submit(0);" style="display:none;" id="simpan_edit"><i class="fa fa-edit fa-lg"></i> Simpan Sementara</button>
        <button class="btn btn-sm btn-warning" onclick="batal_sensus();" style="display:none;" id="batal_sensus"><i class="fa fa-undo fa-lg"></i> Batal Sensus</button>
        <button class="btn btn-sm btn-danger"  onclick="batal();"><i class="fa fa-arrow-alt-to-left fa-lg"></i> Kembali</button>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-map"></i> Map</h4>
      </div>
      <div class="modal-body" id="add_box">
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/v_form_c.js" type="text/javascript"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP5P2jPNd49MKMeOphABZ2PgiYdBeS6qk&libraries=places">
</script>
