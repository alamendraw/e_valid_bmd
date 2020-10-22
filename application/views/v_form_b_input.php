<style type="text/css">
  .hover:hover{
    color: #ffe102!important;
    cursor: pointer;
  }
  .select2{
    width: 50%!important;
  }
  @media only screen and (max-width: 600px) {
    .select2{
      width: 100%!important;
    }
  }
</style>
<script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/easyui/autoCurrency.js') ?>"></script>
<section class="content" id="section_" >
  <div class="box">

    <div class="box-body form-horizontal">
      <form id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div style="margin-bottom:10px" class="hide">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div class="col-sm-4" style="padding-top: 3px;"></div>
                <div class="col-sm-8">
                  <input id="id_barang" name="id_barang" type="text" class="form-control" style="width:80%;">
                  <input id="jns" name="jns" type="text" class="form-control" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label  class="col-sm-4" style="padding-top: 3px;">No. Registrasi</label>
                <div class="col-sm-8">
                  <input placeholder="Auto Register" id="no_regis" name="no_regis" type="text" class="form-control" style="width:80%;" readonly="true">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label  class="col-sm-4" style="padding-top: 3px;">Objek</label>
                <div class="col-sm-8">
                  <input id="rincian" name="rincian" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div class="col-sm-4" style="padding-top: 3px;"><label>Kode Barang</label></div>
                <div class="col-sm-8"> 
                  <div class="input-group" style="width:80%;">
                    <input id="kd_barang" name="kd_barang" type="text" class="form-control input-sm" style="width:100%;" readonly>
                    <span class="input-group-addon" > <a role="button" onclick="getBarang();" class="glyphicon glyphicon-list"></a></span>
                  </div>
                </div> 
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div class="col-sm-4" style="padding-top: 3px;">
                </div>
                <div class="col-sm-8">
                  <span id="nm_barang" name="nm_barang" type="text"  style="width:100%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Detail Barang</label>
                <div class="col-sm-8">
                  <input id="detail" name="detail" type="text" class="form-control input-sm" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div  style="padding-top: 3px;"><label><u>Pengurus Barang</u></label></div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Kepemilikan</label>
                <div class="col-sm-8">
                  <input id="milik" name="milik" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Wilayah</label>
                <div class="col-sm-8">
                  <input id="wil" name="wil" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label  class="col-sm-4" style="padding-top: 3px;">SKPD</label>
                <div class="col-sm-8">
                  <input id="kd_skpd" name="kd_skpd" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">UNIT</label>
                <div class="col-sm-8">
                  <input id="kd_unit" name="kd_unit" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div  style="padding-top: 3px;"><label><u>Asal Usul Barang</u></label></div>
              </div>
            </div>

            <div class="col-sm-12" style="padding-bottom: 10px;">
              <label class="col-sm-4" style="padding-top: 3px;">Cara Perolehan</label>
              <div class="col-sm-8">
                <input id="perolehan" name="perolehan" type="text" class="easyui-textbox" style="width:80%;">
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Ket Matriks</label>
                <div class="col-sm-8">
                  <input id="ket_matriks" name="ket_matriks" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Dasar Perolehan</label>
                <div class="col-sm-8">
                  <input id="dasar" name="dasar" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Nomor</label>
                <div class="col-sm-8">
                  <input id="no_oleh" name="no_oleh" type="text" class="easyui-textbox" style="width:80%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Tanggal Perolehan</label>
                <div class="col-sm-8">
                  <div class="input-group" style="width:80%;">
                    <input id="tgl_oleh" name="tgl_oleh" type="text" class="form-control input-sm datepicker" style="width:100%;" >
                    <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Tahun Perolehan</label>
                <div class="col-sm-8">
                  <input id="thn_oleh" name="thn_oleh" type="text" class="form-control input-sm" style="width:30%;">
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Harga Perolehan</label>
                <div class="col-sm-8">
                  <input id="hrg_oleh" name="hrg_oleh" class="form-control input-sm" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 80%; text-align: right;"> 
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Jumlah</label>
                <div class="col-sm-8">
                  <input id="jumlah" name="jumlah" type="text" class="easyui-numberbox" style="width:30%;" data-options="min:1">
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-6">

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Tanggal Registrasi</label>
                <div class="col-sm-8">
                  <div class="input-group" style="width:80%;">
                    <input id="tgl_regis" name="tgl_regis" type="text" class="form-control" style="width:100%;" >
                    <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div  style="padding-top: 3px;"><label><u>Spesifikasi Barang</u></label></div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
               <label class="col-sm-4" style="padding-top: 3px;">Merk</label>
               <div class="col-sm-8">
                <span id="merk" name="merk" type="text" class="easyui-textbox" style="width:80%;"><span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Type</label>
                <div class="col-sm-8">
                  <span id="type" name="type" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Warna</label>
                <div class="col-sm-8">
                  <span id="warna" name="warna" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Bahan</label>
                <div class="col-sm-8">
                  <span id="bahan" name="bahan" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>


            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Satuan</label>
                <div class="col-sm-8">
                  <span id="satuan" name="satuan" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">No Rangka</label>
                <div class="col-sm-8">
                  <span id="no_rangka" name="no_rangka" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">No Mesin</label>
                <div class="col-sm-8">
                  <span id="no_mesin" name="no_mesin" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">No Polisi</label>
                <div class="col-sm-8">
                  <span id="no_polisi" name="no_polisi" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Ukuran/CC</label>
                <div class="col-sm-8">
                  <span id="ukuran" name="ukuran" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">No STNK</label>
                <div class="col-sm-8">
                  <span id="nostnk" name="nostnk" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Tanggal STNK</label>
                <div class="col-sm-8">
                  <div class="input-group" style="width:80%;">
                    <input id="tgl_stnk" name="tgl_stnk" type="text" class="form-control" style="width:100%;" >
                    <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">No BPKB</label>
                <div class="col-sm-8">
                  <span id="nobpkb" name="nobpkb" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Tanggal BPKB</label>
                <div class="col-sm-8">
                  <div class="input-group" style="width:80%;">
                    <input id="tgl_bpkb" name="tgl_bpkb" type="text" class="form-control" style="width:100%;" >
                    <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Kondisi</label>
                <div class="col-sm-8">
                  <span id="kondisi" name="kondisi" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Keterangan</label>
                <div class="col-sm-8">
                  <span id="keterangan" name="keterangan" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Kronologis</label>
                <div class="col-sm-8">
                  <span id="kronologis" name="kronologis" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px" hidden="true">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Ruangan</label>
                <div class="col-sm-8">
                  <span id="kd_ruang" name="kd_ruang" type="text" class="easyui-textbox" style="width:80%;"></span>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <label class="col-sm-4" style="padding-top: 3px;">Gambar</label>
                <div class="col-sm-8">
                  <?php for ($i=1; $i <=4 ; $i++) :?> 
                    <input class="easyui-filebox" id="foto<?php echo $i;?>" name="filefoto<?php echo $i;?>" style="width:80%;">  
                  <?php endfor;?>
                  <button class="btn btn-info btn-sm" type="button" style="border:none;" onclick="galery();"><i class="fa fa-image fa-lg"></i></button>
                </div>
              </div>
            </div>

            <div style="margin-bottom:10px">
              <div class="col-sm-12" style="padding-bottom: 10px;">
                <div class="col-sm-4" style="padding-top: 3px;">&nbsp;</div>
                <div class="col-sm-8">&nbsp;  </div>
              </div>
            </div>

          </div>
        </div>
      </form>

      <div style="padding-top: 10px;" class="row">
        <div class="col-sm-12">

          <button type="button" class="btn btn-primary btn-sm pull-right" id="btn_simpan" onclick="simpan()"><i class="fa fa-save fa-lg"></i> Simpan</button>
          <button type="button" class="btn btn-danger btn-sm pull-right" onclick="back();"><i class="fa fa-undo fa-lg"></i> Kembali</button>

        </div>
      </div>

    </div>

  </div>


  <div id="dlg" class="easyui-dialog" style="width:900px" closed="true" buttons="#dlg-buttons">
    <div class="row" style="width: 100%">
      <form id="popfm" method="post" novalidate style="padding: 8px;" enctype="multipart/form-data">
       <div class="col-sm-4 col-sm-offset-2" align="right" style="float: right;">
        <form class="navbar-right">
          <div class="input-group">
            <input type="text" value="" id="keyword" name="keyword" class="form-control" placeholder="Ketik Barang Yang Dicari">
            <span class="input-group-btn"><button type="button" class="btn btn-default" onClick="javascript:getBarang();"><i class="fa fa-search"></i></button></span>
          </div>
        </form>
      </div>&nbsp;<br>&nbsp;
      <div class="col-md-11">
        <div class="row">                    
          <table id="dgBarang"></table>
        </div>

      </div>  
    </form>
  </div>
</div>

<div id="dlg-buttons"> 
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Selesai</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Kembali</a>
</div>
<div id="galery" class="easyui-dialog" closed="true"  style="width:60%">
    <div class="row d-flex justify-content-around">
        <div class="col-md-3" id="foto1d">
            <div class="btnn" id="btn_del1">
            </div>
            <div class="gal" id="foto11" onclick="myFunction(this,'GAMBAR 1');">
            </div>
        </div>
        <div class="col-md-3" id="foto2d">
            <div class="btnn" id="btn_del2">
            </div>
            <div class="gal" id="foto21" onclick="myFunction(this,'GAMBAR 2');">
            </div>
        </div>
        <div class="col-md-3" id="foto3d">
            <div class="btnn" id="btn_del3">
            </div>
            <div class="gal" id="foto31" onclick="myFunction(this,'GAMBAR 3');">
            </div>
        </div>
        <div class="col-md-3" id="foto4d">
            <div class="btnn" id="btn_del4">
            </div>
            <div class="gal" id="foto41" onclick="myFunction(this,'GAMBAR 4');">
            </div>
        </div>

    </div>
    <div class="container2">
      <button onclick="this.parentElement.style.display='none'" class="btn-circle btn-warning" style="right: 15px;position: absolute;top: 25px;">&times;</button>
      <img id="expandedImg" style="width:100%;margin-top: 14px;">
      <div id="imgtext">
      </div>
  </div>
</div>

</section>
<script src="<?php echo base_url(); ?>assets/js/v_form_b_input.js" type="text/javascript"></script>
