 <style>
    /* The expanding image container */
    .container2 {
      position: relative;
      display: none;
  }

  /* Expanding image text */
  #imgtext {
      position: absolute;
      bottom: 15px;
      left: 15px;
      color: white;
      font-size: 20px;
  }
  .gal{
     background-position: center;
     background-repeat: no-repeat;
     background-size: cover;
     background-image: url('<?php echo base_url();?>uploads/noimage.jpg');
     padding: 50%;
     text-align: center;
     vertical-align: middle;
     text-transform: uppercase;
     text-shadow: 2px 2px 4px #000;
     font-weight: bold;
     color: #00c5ff;
 }
 .btnn {
  position: absolute;
  top: 89%;
  left: 51%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #9b1616;
  color: white;
  font-size: 16px;
  padding: 4px 12px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}
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
  .iframe-container{
    position: relative;
    /*width: 100%;*/
    padding-bottom: 56.25%; /* Ratio 16:9 ( 100%/16*9 = 56.25% ) */
}
.iframe-container > *{
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    margin: 0;
    padding: 0;
    /*height: 100%;*/
    /*width: 100%;*/
}
</style>
 <form id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom:10px" class="hide">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <input id="id_barang" name="id_barang" type="text" class="form-control" style="width:80%;">
                        <input id="id_lokasi" name="id_lokasi" type="text" class="form-control" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Registrasi</label></div>
                    <div class="col-sm-8">
                        <input placeholder="Auto Register" id="no_regis" name="no_regis" type="text" class="form-control" style="width:80%;" readonly="true">
                    </div>
                </div>
            </div>
			 <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Dokumen</label></div>
                    <div class="col-sm-8">
                        <input id="no_dokumen" name="no_dokumen" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kode Barang</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
                          <input id="kd_barang" name="kd_barang" type="text" class="form-control" style="width:100%;" readonly>
                           <span class="input-group-addon" > <a href='javascript:getBarang();' class="glyphicon glyphicon-list"></a></span>
                        </div>
                    </div> 
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="nm_barang" name="nm_barang" type="text"  style="width:100%;"><span>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Detail Barang</label></div>
                    <div class="col-sm-8">
                        <input id="detail" name="detail" type="text" class="form-control" placeholder="Deskripsi Barang" style="width:80%;">
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kepemilikan</label></div>
                    <div class="col-sm-8">
                        <input id="milik" name="milik" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Wilayah</label></div>
                    <div class="col-sm-8">
                        <input id="wil" name="wil" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>SKPD</label></div>
                    <div class="col-sm-8">
                        <input id="kd_skpd" name="kd_skpd" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px"  class="hide">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="nm_skpd" name="nm_skpd" type="text" style="width:100%;"><span>
                    </div>
                </div>
            </div>
            
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>UNIT</label></div>
                    <div class="col-sm-8">
                        <input id="kd_unit" name="kd_unit" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px" class="hide">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="nm_unit" name="nm_unit" type="text" style="width:100%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div  style="padding-top: 3px;"><label><u>Asal Usul Barang</u></label></div>
                </div>
            </div>
			
           <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Cara Perolehan</label></div>
                    <div class="col-sm-8">
                        <input id="perolehan" name="perolehan" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Ket Matriks</label>
                    </div>
                    <div class="col-sm-8">
                        <input id="ket_matriks" name="ket_matriks" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Dasar Perolehan</label></div>
                    <div class="col-sm-8">
                        <input id="dasar" name="dasar" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nomor</label></div>
                    <div class="col-sm-8">
                        <input id="no_oleh" name="no_oleh" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
                          <input id="tgl_oleh" name="tgl_oleh" type="text" class="form-control" style="width:100%;" >
                           <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tahun Perolehan</label></div>
                    <div class="col-sm-8">
                        <input id="thn_oleh" name="thn_oleh" type="text" class="form-control" style="width:30%;">
                    </div>
                </div>
            </div> 
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Harga Perolehan</label></div>
                    <div class="col-sm-8">
						<input id="hrg_oleh" name="hrg_oleh" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 80%; text-align: right;"> 
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Jumlah</label></div>
                    <div class="col-sm-4">
                        <input id="jumlah" name="jumlah" type="text" class="easyui-numberbox" style="width:80%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal Registrasi</label></div>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kondisi</label></div>
                    <div class="col-sm-8">
                        <span id="kondisi" name="kondisi" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kontruksi</label></div>
                    <div class="col-sm-8">
                        <span id="konstruksi" name="konstruksi" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
					<div class="col-sm-4" style="padding-top: 3px;"></div>
					<div class="col-sm-8">
                        <span id="konstruksi2" name="konstruksi2" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Jenis Bangunan</label></div>
                    <div class="col-sm-8">
                        <span id="jenis" name="jenis" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Luas Bangunan</label></div>
                    <div class="col-sm-8">
					<div class="input-group" style="width:80%;">
                        <input id="luas" name="luas" type="text" class="easyui-numberbox" style="width:80%;">
						<span class="input-group-addon">m<sup>2</sup></span>
                    </div></div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tgl Mulai Kerja</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
                          <input id="tgl_mulai" name="tgl_mulai" type="text" class="form-control" style="width:100%;" >
                           <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Status Tanah</label></div>
                    <div class="col-sm-8">
                        <span id="sts_tanah" name="sts_tanah" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nilai Kontrak</label></div>
                    <div class="col-sm-8">
						<input id="kontrak" name="kontrak" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 80%; text-align: right;"> 
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Letak/Alamat</label></div>
                    <div class="col-sm-8">
                        <span id="alamat1" name="alamat1" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="alamat2" name="alamat2" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="alamat3" name="alamat3" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Keterangan</label></div>
                    <div class="col-sm-8">
                        <span id="keterangan" name="keterangan" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"><span>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Latitude</label>
                    </div>
                    <div class="col-sm-8">
                        <input id="latitude" name="latitude" type="text" class="easyui-textbox" style="width:80%;" >
                        <button class="btn-circle btn-info" type="button" style="border:none;" onClick="javascript:open_map();"><i class="fa fa-map-marker fa-lg"></i></button>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Longtitude</label>
                    </div>
                    <div class="col-sm-8">
                      <input id="longtitude" name="longtitude" type="text" class="easyui-textbox" style="width:80%;" >
                  </div>
              </div>
          </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kode Tanah</label></div>
                    <div class="col-sm-8">
                        <span id="kd_tanah" name="kd_tanah" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Gambar</label></div>
                    <div class="col-sm-8">
                          <?php for ($i=1; $i <=4 ; $i++) :?> 
                                <input class="easyui-filebox" id="foto<?php echo $i;?>" name="filefoto<?php echo $i;?>" style="width:80%;">  
                        <?php endfor;?>
                        <button class="btn-circle btn-info" type="button" style="border:none;" onClick="javascript:galery();"><i class="fa fa-image fa-lg"></i></button>
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
    <div class="col-xs-6 col-sm-2 col-sm-offset-4">
        <button type="button" class="btn btn-primary btn-block" id="btn_simpan" onClick="javascript:simpan()"><i class="fa fa-save fa-lg"></i> Simpan</button>
    </div>
    <div class="col-xs-6 col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-danger btn-block" onClick="javascript:back();"><i class="fa fa-undo fa-lg"></i> Kembali</button>
    </div>
    <div id="progressFile" class="easyui-progressbar" style="width:50%;" hidden="true"></div>
</div>


<!-- Dialog Kode Barang -->
<div id="dlgBrg" class="easyui-dialog" style="width:900px" closed="true" buttons="#dlgBrg-buttons">
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

<div id="dlgBrg-buttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="javascript:$('#dlgBrg').dialog('close')" style="width:90px">Selesai</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlgBrg').dialog('close')" style="width:90px">Kembali</a>
</div>
<!-- End Dialog Kode Barang -->

<style>
.col-sm-4{
	padding-right: 10px !important;
    padding-left: 10px !important;
}
</style>
 
<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

    function cekOtori(){
        var otori = "<?php echo $this->session->userdata['oto'];?>";
        if(otori!='01'){
            var zskpd = "<?php echo $this->session->userdata['kd_skpd'];?>";
            var zunit = "<?php echo $this->session->userdata['kd_unit'];?>";
            $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getUnit',
               queryParams:({kd_skpd:zskpd})
               });
            $('#kd_skpd').combogrid({readonly: true}).combogrid('setValue', zskpd);
            $('#kd_unit').combogrid({readonly: true}).combogrid('setValue', zunit); 
        }
    }

	function simpan() { 
        $("#btn_simpan").prop('disabled',true);
        var milik       = $('#milik').combogrid('getValue');
        var wil         = $('#wil').combogrid('getValue');
        var kd_skpd     = $('#kd_skpd').combogrid('getValue');
        var kd_unit     = $('#kd_unit').combogrid('getValue');
        var perolehan   = $('#perolehan').combogrid('getValue');
        var dasar       = $('#dasar').combogrid('getValue'); 
        
        var kd_barang   = $("#kd_barang").val();
        var no_oleh     = $("#no_oleh").val();
        var tgl_oleh    = $("#tgl_oleh").val();
        var thn_oleh    = $("#thn_oleh").val();
        var hrg_oleh    = angka($("#hrg_oleh").val());
        var jumlah      = $("#jumlah").val();
        var tgl_regis   = $("#tgl_regis").val();
        var tgl_mulai   = $('#tgl_mulai').val();
        var ket_matriks = $('#ket_matriks').combogrid('getValue');
        if(ket_matriks==''){
            iziToast.error({ title: 'Error', message: 'Ket. matriks Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(tgl_mulai==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Mulai Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(tgl_regis==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Registrasi Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(jumlah==''){
            iziToast.error({ title: 'Error', message: 'Jumlah Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(hrg_oleh==''){
            iziToast.error({ title: 'Error', message: 'Harga Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(thn_oleh==''){
            iziToast.error({ title: 'Error', message: 'Tahun Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(tgl_oleh==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(no_oleh==''){
            iziToast.error({ title: 'Error', message: 'Nomor Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(kd_barang==''){
            iziToast.error({ title: 'Error', message: 'Kode Barang Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(dasar==''){
            iziToast.error({ title: 'Error', message: 'Dasar Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(perolehan==''){
            iziToast.error({ title: 'Error', message: 'Cara Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(kd_skpd==''){
            iziToast.error({ title: 'Error', message: 'SKPD Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(kd_unit==''){
            iziToast.error({ title: 'Error', message: 'UNIT Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(wil==''){
            iziToast.error({ title: 'Error', message: 'Wilayah Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
        if(milik==''){
            iziToast.error({ title: 'Error', message: 'Kepemilikan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            exit();
        }
       
        var sts  = localStorage.getItem('sts');
		var status = localStorage.getItem('status');
		if(status == 'tambah'){
		$(document).ready(function() {
				$('#fm').form('submit', {
					url: '<?php echo base_url();?>transaksi/C_Kibf/simpan',
					onSubmit: function() {
					},
					success: function (data) {
				 		mes = $.parseJSON(data);
						if (mes.pesan) {
							iziToast.success({
								title: 'OK',
								message: mes.message,
							});
							$('#fm').form('reset');
							$('#nm_barang').text("");
                            $("#btn_simpan").prop('disabled',false);
							//max_number();
						} else {
							iziToast.error({
								title: 'Error',
								message: mes.message,
							});
                            $("#btn_simpan").prop('disabled',false);
						} 
					}
					
				});
			});
		} else {
			$(document).ready(function() {
				$('#fm').form('submit', {
					url: '<?php echo base_url();?>transaksi/C_Kibf/edit?sts='+sts,
					onSubmit: function() {
					},
					success: function (data) {
				 		mes = $.parseJSON(data);
						if (mes.pesan) {
							iziToast.success({
								title: 'OK',
								message: mes.message,
							});
                            $("#btn_simpan").prop('disabled',false);
                            cekOtori();
							//$('#fm').form('reset');
							//max_number();
						} else {
							iziToast.error({
								title: 'Error',
								message: mes.message,
							});
                            $("#btn_simpan").prop('disabled',false);
						} 
					}
					
				});
			});
		}
	}
	
    var id_brg ='';
	window.onload = function(){
        var status = localStorage.getItem('status');
        var sts    = localStorage.getItem('sts');
       
        cekOtori();
        if(sts=='1'){
            // $("#kondisi").combogrid({disabled:true})
            $("#tgl_regis").prop('disabled',true);
            $("#hrg_oleh").prop('disabled',true);
            $("#thn_oleh").prop('disabled',true);
            $("#jumlah").numberbox({disabled:true});
        }
        if (status == 'detail') {
                id_brg      = localStorage.getItem('id_barang');
            var id_lok      = localStorage.getItem('id_lokasi');
            var no_reg      = localStorage.getItem('no_reg');
            var rincian     = localStorage.getItem('rincian');
            var sub_rincian = localStorage.getItem('sub_rincian');
            var kd_barang   = localStorage.getItem('kd_barang');
            var nm_barang   = localStorage.getItem('nm_brg');
            var detail_brg  = localStorage.getItem('detail_brg');
            var no_dokumen  = localStorage.getItem('no_dokumen');
            var milik       = localStorage.getItem('milik');
            var wil         = localStorage.getItem('wil');
            var kd_skpd     = localStorage.getItem('kd_skpd');
            var nm_skpd     = localStorage.getItem('nm_skpd');
            var kd_unit     = localStorage.getItem('kd_unit');
            var perolehan   = localStorage.getItem('perolehan');
            var dasar       = localStorage.getItem('dasar');
            var no_oleh     = localStorage.getItem('no_oleh');
            var tgl_oleh    = localStorage.getItem('tgl_oleh');
            var thn_oleh    = localStorage.getItem('thn_oleh');
            var hrg_oleh    = localStorage.getItem('hrg_oleh');
            var jumlah      = localStorage.getItem('jumlah');
            var tgl_regis   = localStorage.getItem('tgl_regis');
            var kondisi     = localStorage.getItem('kondisi')
            var konstruksi  = localStorage.getItem('konstruksi');
            var konstruksi2 = localStorage.getItem('konstruksi2');
            var nm_skpd     = localStorage.getItem('nm_skpd');
            var jenis       = localStorage.getItem('jenis');
            var luas        = localStorage.getItem('luas');
            var tgl_mulai   = localStorage.getItem('tgl_mulai');
            var sts_tanah   = localStorage.getItem('sts_tanah');
            var kontrak     = localStorage.getItem('kontrak');
            var alamat1     = localStorage.getItem('alamat1');
            var alamat2     = localStorage.getItem('alamat2');
            var alamat3     = localStorage.getItem('alamat3');
            var keterangan  = localStorage.getItem('keterangan');
            var lat         = localStorage.getItem('lat');
            var lon         = localStorage.getItem('lon');
            var kd_tanah    = localStorage.getItem('kd_tanah');
            var ket_matriks = localStorage.getItem('ket_matriks');
            var gambar1     = localStorage.getItem('foto1');
            var gambar2     = localStorage.getItem('foto2');
            var gambar3     = localStorage.getItem('foto3');
            var gambar4     = localStorage.getItem('foto4');
            detail.value    = detail_brg;
            id_barang.value = id_brg;
            id_lokasi.value = id_lok;
			
			no_regis.value = no_reg;
			$("#tgl_regis").datepicker("setDate", tgl_regis);
			$("#no_dokumen").textbox('setValue',no_dokumen);
			$('#kd_barang').val(kd_barang);
			$('#milik').combogrid('setValue', milik);
			$('#wil').combogrid('setValue', wil);
			$('#kd_skpd').combogrid('setValue', kd_skpd);
			$("#nm_skpd").text(nm_skpd);
			$('#kd_unit').combogrid('setValue', kd_unit);
			$('#perolehan').combogrid('setValue', perolehan);
			$('#dasar').combogrid('setValue', dasar);			
			$("#no_oleh").textbox('setValue',no_oleh);
			$("#tgl_oleh").datepicker("setDate", tgl_oleh);
			$("#thn_oleh").datepicker("setDate", thn_oleh);
			$("#hrg_oleh").val(hrg_oleh);
			$("#jumlah").textbox("setValue", jumlah);
			$("#kondisi").combogrid("setValue", kondisi);
			$("#konstruksi").combogrid("setValue", konstruksi);
			$("#konstruksi2").combogrid("setValue", konstruksi2);
			$("#jenis").combogrid("setValue", jenis);
			$("#luas").textbox("setValue", luas);
			$("#tgl_mulai").datepicker("setDate", tgl_mulai);
			$('#sts_tanah').combogrid('setValue', sts_tanah);
            $('#ket_matriks').combogrid('setValue', ket_matriks);
			$("#kontrak").val(kontrak);
			$("#alamat1").textbox('setValue',alamat1);
			$("#alamat2").textbox('setValue',alamat2);
			$("#alamat3").textbox('setValue',alamat3);
			$("#keterangan").textbox('setValue',keterangan);
			$("#latitude").textbox('setValue',lat);
			$("#longtitude").textbox('setValue',lon);
            $("#nm_barang").text(nm_barang);
			$("#kd_tanah").combogrid('setValue',kd_tanah);
			$("#foto1").filebox('setValue',gambar1);
			$("#foto2").filebox('setValue',gambar2);
            $("#foto3").filebox('setValue',gambar3);
            $("#foto4").filebox('setValue',gambar4);
			$("#rincian").combogrid('setValue',rincian); 
			$("#sub_rincian").combogrid('setValue',sub_rincian);
			$("#btn_del1").html('<i class="fa fa-trash" onclick=hapus("foto1")></i>');
            $("#btn_del2").html('<i class="fa fa-trash" onclick=hapus("foto2")></i>');
            $("#btn_del3").html('<i class="fa fa-trash" onclick=hapus("foto3")></i>');
            $("#btn_del4").html('<i class="fa fa-trash" onclick=hapus("foto4")></i>');
            for (var i = 1; i <= 4; i++) {
                switch(i) {
                  case 1:
                  if (gambar1=='' || gambar1==null){ $("#foto"+i+'d').css("display", "none");$("#btn_del"+i).css("display", "none");}
                  break;
                  case 2:
                  if (gambar2=='' || gambar2==null){ $("#foto"+i+'d').css("display", "none");$("#btn_del"+i).css("display", "none");}
                  break;
                  case 3:
                  if (gambar3=='' || gambar3==null){ $("#foto"+i+'d').css("display", "none");$("#btn_del"+i).css("display", "none");}
                  break;
                  case 4:
                  if (gambar4=='' || gambar4==null){ $("#foto"+i+'d').css("display", "none");$("#btn_del"+i).css("display", "none");}
                  break;
                } 
            
            }
            $("#foto11").css("background-image", "url('<?php echo base_url();?>uploads/kibF/"+gambar1+"')");
            $("#foto21").css("background-image", "url('<?php echo base_url();?>uploads/kibF/"+gambar2+"')");
            $("#foto31").css("background-image", "url('<?php echo base_url();?>uploads/kibF/"+gambar3+"')");
            $("#foto41").css("background-image", "url('<?php echo base_url();?>uploads/kibF/"+gambar4+"')");
        } else {
			//max_number();
		}
    }

    function dialog_detail() {
        $('#dlg_dtl').dialog('open').dialog('center').dialog('setTitle','Detail Barang');
        $('#fm').form('clear');
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_Kibf";
		//"http://localhost/simbakda_akrual/perencanaan/C_Pengadaan";
    }

    function max_number(){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_Kibf/max_number',
            data: ({table:'transaksi.trkib_f',kolom:'no_reg'}),
            dataType:"json",
            success:function(data){
                $.each(data,function(i,n){                                    
                    max = Number(n['no_urut'])+1;                   
                    nom = String('000' + max).slice(-4);                    
                    no_regis.value = nom;
                });
            }
        }); 
    }

    function newUser() {
        if (no_dokumen.value == "" || 
            $('#kd_skpd').combogrid('getValue') == "" || 
            tahun_rencana.value == "" || 
            tgl_dokumen.value == "") {

                iziToast.error({
                    title: 'Error',
                    message: 'Field No. Dokumen, SKPD, Tahun Rencana, Tanggal Dokumen Harus Terisi.!',
                });
        } else {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
            $('#fm').form('clear');
            status = 'add';
        }
    }

    function saveUser() {
        console.log(kd);
    }

    function hitung() {
        var a = eval($('#jml').val());//angka(jml.value);
        var b = eval($('#hrg').val());//angka(hrg.value);
        var tot = a*b;
        tot = number_format(tot, 2,'.',',');        
        total_dlg.value = tot;
    }

    function getToday() {
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var output = ((''+day).length<2 ? '0' : '') + day + '-' +
                   ((''+month).length<2 ? '0' : '') + month + '-' +
                   d.getFullYear();
      return output;
    }

    function load_detail() {
        var i = 0;
        var nomor = no_dokumen.value;
        var tgl = tgl_dokumen.value;
        var kode = $('#kd_skpd').combogrid('getValue');

        $.ajax({
            url: '<?php echo site_url('perencanaan/C_Pengadaan/trd_planbrg') ?>',
            type: 'POST',
            dataType: 'json',
            data: {no: nomor, kode: kode},
            success: function(data) {
                // console.log(data);
                $.each(data,function(i,n){                                    
                no      = n['no_dokumen'];                                                                 
                kd      = n['kd_brg'];                                                                                       
                r5      = n['kd_rek5'];
                nm      = n['nm_brg'];
                mrk     = n['merek'];                        
                jml     = n['jumlah'];                         
                hrg     = number_format(n['harga'],2,'.',',');
                tot     = number_format(n['total'],2,'.',',');
                ket     = n['ket'];             
                satuan  = n['satuan'];                  
                no_urut = n['no_urut'];      
                $('#trd').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        kd_rek5:r5,
                        nm_brg:nm,
                        merek:mrk,
                        jumlah:jml,
                        harga:hrg,
                        total:tot,
                        ket:ket,
                        satuan:satuan,
                        no_urut:no_urut });   
                total.textContent = tot;
            });
            }
        });    
    }
	
    $(document).ready(function() {

        $('#trd').datagrid({
            width:1000,
            height:300,
            rownumbers:true,
            remoteSort:false,
            nowrap:true,
            fitColumns:false,
            pagination:true,
            url: '<?php echo base_url(); ?>perencanaan/C_Pengadaan/trd_planbrg',
            loadMsg:"Tunggu Sebentar....!!",    
			frozenColumns:[[
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:275,align:"left"},
			]],
            columns:[[
                {field:'merek', title:'Merek', width:150, align:"left"},
                {field:'jumlah',title:'Jumlah',width:125,align:"left"},
                {field:'harga',title:'Harga',width:125,align:"left"},
                {field:'total',title:'Total',width:125,align:"left"},
                {field:'ket',title:'Keterangan',width:150,align:"left"},
                {field:'satuan',title:'Satuan',width:125,align:"left"},
                {field:'ck',title:'',width:1,align:'center',checkbox:true}
            ]],
            onSelect:function(rowIndex,rowData){
                cekjumlah();            
            },
            onCheck:function(rowIndex,rowData){
                cekjumlah();                        
            },
            onUncheck: function(index,row) {
                cekjumlah();
            },
            onCheckAll: function(row) {
                cekjumlah();
            },
            onUncheckAll: function(row) {
                cekjumlah();
            },
            onDblClickRow: function () {
                dialog_detail();
            }
        });
		

        $('#dg').datagrid({
            width: '100%',
            height: '300',
            rownumbers: true,
            remoteSort: false,
            nowrap: true,
            pagination: true,
            // url: ,
            loadMsg: 'TUnggu Sebentar ... !',
			frozenColumns:[[
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:275,align:"left"},
			]],
            columns:[[
                {field:'merek', title:'Merek', width:150, align:"left"},
                {field:'jumlah',title:'Jumlah',width:125,align:"left"},
                {field:'harga',title:'Harga',width:125,align:"left"},
                {field:'ck',title:'',width:1,align:'center',checkbox:true}
            ]]

        });

		$('#upload').filebox({
			buttonText: 'Choose File',
			buttonAlign: 'right'
		});
		// $('#gambar1').filebox({
		// 	buttonText: 'Choose File',
		// 	buttonAlign: 'right'
		// });
		// $('#gambar2').filebox({
		// 	buttonText: 'Choose File',
		// 	buttonAlign: 'right'
		// });
		// $('#gambar3').filebox({
		// 	buttonText: 'Choose File',
		// 	buttonAlign: 'right'
		// });
		// $('#gambar4').filebox({
		// 	buttonText: 'Choose File',
		// 	buttonAlign: 'right'
		// });
		
        $('#thn_oleh').datepicker({
            minViewMode: 'years',
            autoclose: true,
            format: 'yyyy',
        autoclose:true
          });

        $('#tgl_regis').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		
		$('#tgl_sert').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });

        $('#tgl_oleh').datepicker({
              format: 'dd-mm-yyyy',
              inline: true,
              autoclose:true
        }).on("changeDate", function (e) {
            var date = $(this).datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
            var tgl_oleh = new Date(year+"/"+month+"/"+day);
            var tgl_reg  = new Date($('#tgl_regis').val().split("-").reverse().join("/"));
            if(tgl_reg<tgl_oleh){
                alert("Cek Kembali Tgl Register.! Tidak boleh sebelum Tgl Perolehan.");
            }

            $("#thn_oleh").val(year).readOnly = true; 
            document.getElementById('thn_oleh').readOnly = true;
        });
		
		$('#tgl_mulai').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });

		
        $('#tgl_regis').val(getToday());

   		$('#no_dokumen').combogrid({
            panelWidth:1049,  
            idField:'no_sp2d',  
            textField:'no_sp2d',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Kibf/getDokumen',
			queryParams:({kib:'1.3.6'}),
            columns:[[  
               {field:'no_dokumen',title:'No.Dok',width:150},  
               {field:'no_sp2d',title:'Sp2d',width:150},
               {field:'nm_brg',title:'Barang',width:250},      
               {field:'harga',title:'Nilai',width:200,align:'right'},  
               {field:'keterangan',title:'Keterangan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
                $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getUnit',
                    queryParams:({kd_skpd:rowData.kd_skpd})
                });               
				$("#rincian").combogrid('setValue',rowData.rincian_objek);
				$("#sub_rincian").combogrid('setValue',rowData.sub_rincian_objek);
                $('#kd_barang').val(rowData.kd_brg);
				$('#keterangan').textbox('setValue',rowData.keterangan);
				$("#nm_barang").text(rowData.nm_brg);
				$('#milik').combogrid('setValue', 12);
				$('#wil').combogrid('setValue', rowData.kd_wilayah);
                $('#kd_skpd').combogrid('setValue', rowData.kd_skpd); 
				$('#kd_unit').combogrid('setValue', rowData.kd_unit); 
				$('#perolehan').combogrid('setValue', '03');
				$('#dasar').combogrid('setValue', 1);			
				$("#no_oleh").textbox('setValue',rowData.no_sp2d);
				$("#tgl_oleh").datepicker("setDate", rowData.tgl_sp2d);
				$("#thn_oleh").datepicker("setDate", rowData.tahun);		
				$("#hrg_oleh").val(number_format(rowData.harga, 2,'.',','));
				$("#jumlah").textbox("setValue", rowData.jumlah);
				$("#kondisi").combogrid("setValue", 'B');
            }  
        });


		$('#kd_skpd').combogrid({
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'nm_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>perencanaan/C_Pengadaan/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               nama = rowData.nm_skpd;
               kd_skpd = rowData.kd_skpd;
               nm_skpd.textContent = nama;
			   $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getUnit',
			   queryParams:({kd_skpd:kd_skpd})
			   });
            },
            onChange:function () {
                kd_skpd = $('#kd_skpd').combogrid('getValue');
                $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getUnit',
               queryParams:({kd_skpd:kd_skpd})
               });
            }
        });

		 $('#kd_unit').combogrid({
            panelWidth:600,  
            idField:'kd_unit',  
            textField:'nm_unit',  
            mode:'remote',
            columns:[[  
               {field:'kd_unit',title:'KODE UNIT',width:200},  
               {field:'nm_unit',title:'NAMA UNIT',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
            }  
        });

       /*  $('#rincian').combogrid({
            panelWidth:350,  
            idField:'bidang',  
            textField:'bidang',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getRincian', 
			queryParams:({akun:'1',kelompok:'3',jenis:'3'}),			
            columns:[[  
               {field:'bidang',title:'Rincian Objek',width:150},  
               {field:'nm_bidang',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				bidang        = rowData.bidang;
			  $('#sub_rincian').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getSubRincian',
			   queryParams:({akun:'1',kelompok:'3',jenis:'3',rincian:bidang})
			   });
				
			}
        }); */
		
	/* 	$('#sub_rincian').combogrid({
            panelWidth:350,  
            idField:'sub_rincian',  
            textField:'sub_rincian',  
            mode:'remote',
            columns:[[  
               {field:'sub_rincian',title:'Sub. Rincian',width:150},  
               {field:'uraian',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				sub_rincian = rowData.sub_rincian;
				rincian    	= $('#rincian').combogrid('getValue');
			    $('#kd_barang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getKdbarang',
			   queryParams:({akun:'1',kelompok:'3',jenis:'3',rincian:rincian,sub_rincian:sub_rincian})
			   });
				
			}
        }); */
		
		// $('#kd_barang').combogrid({
  //           panelWidth:550,  
  //           idField:'kd_brg',  
  //           textField:'kd_brg',  
  //           mode:'remote',
		// 	url:'<?php echo base_url(); ?>transaksi/C_Kibf/getKdbarang',
		// 	queryParams:({akun:'1',kelompok:'3',jenis:'6',rincian:'136010101',sub_rincian:'01'}),
  //           columns:[[  
  //              {field:'kd_brg',title:'Kode',width:120},  
  //              {field:'uraian',title:'Uraian',width:420}    
  //           ]],
		// 	onSelect:function(rowIndex,rowData){
		// 		nm_barang.textContent = rowData.uraian;
		// 		/* $('#milik').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibf/getMilik',
		// 	   }); */
		// 	   }
  //       });
        
		$('#milik').combogrid({
            panelWidth:350,  
            idField:'kd_milik',  
            textField:'nm_milik',  
            mode:'remote',
			url:'<?php echo base_url(); ?>transaksi/C_Kibf/getMilik',
            columns:[[  
               {field:'kd_milik',title:'Kode',width:150},  
               {field:'nm_milik',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				//sub_rincian = rowData.sub_rincian;
				//rincian    	= $('#rincian').combogrid('getValue');
			    }
        });
		
		 $('#wil').combogrid({
            panelWidth:350,  
            idField:'kd_wilayah',  
            textField:'nm_wilayah',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getWilayah', 
			queryParams:({akun:'1',kelompok:'3',jenis:'1'}),			
            columns:[[  
               {field:'kd_wilayah',title:'Kode',width:150},  
               {field:'nm_wilayah',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				bidang        = rowData.bidang;
			}
        });
		
		$('#perolehan').combogrid({
            panelWidth:350,  
            idField:'cara_peroleh',  
            textField:'cara_peroleh',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getOleh', 
            columns:[[  
               {field:'kd_cr_oleh',title:'Kode',width:150},  
               {field:'cara_peroleh',title:'Uraian',width:200}    
            ]]
        });
		$('#ket_matriks').combogrid({
            panelWidth:'25%',  
            idField:'id',  
            textField:'ket_matriks',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getmatriks', 
            columns:[[  
            {field:'id',title:'Kode',width:'20%'},  
            {field:'ket_matriks',title:'Ket Matriks',width:'80%'}
            ]]
        });
		$('#dasar').combogrid({
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getDasar',
            panelWidth:350,  
            idField:'dasar_peroleh',  
            textField:'dasar_peroleh',  
            mode:'remote',
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'dasar_peroleh',title:'Uraian',width:200}    
            ]]
        });
		
		$('#sts_tanah').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'status',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getStatustanah', 
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'status',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
		$('#konstruksi').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'nm_konstruksi',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getKonstruksi', 
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'nm_konstruksi',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
		$('#konstruksi2').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'nm_konstruksi',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/getKonstruksi2', 
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'nm_konstruksi',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
		$('#jenis').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'jns_bangunan',  
            mode:'remote',
			url:'<?php echo base_url(); ?>transaksi/C_Kibf/getJenisBangun',
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'jns_bangunan',title:'Jenis Bangunan',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				
			}
        });
		
		$('#kondisi').combogrid({
            panelWidth:350,  
            idField:'kondisi',  
            textField:'kondisi',  
            mode:'remote',
			url:'<?php echo base_url(); ?>transaksi/C_Kibf/getKondisi',
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'kondisi',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
				
	$('#kd_tanah').combogrid({
		panelWidth:500,  
		idField:'kd_brg',  
		textField:'kd_brg',  
		mode:'remote',
		url: '<?php echo base_url(); ?>transaksi/C_Kibf/getkdtanah',
		columns:[[  
		   {field:'kd_brg',title:'KODE',width:150,align:'center'},  
		   {field:'uraian',title:'TANAH',width:400}
		]],  
		onSelect:function(rowIndex,rowData){
		   uraian = rowData.uraian;
		   kd_brg = rowData.kd_brg;
		}  
	});

    $("#keyword").on('keyup', function(){
        getBarang();
    });
		
});

	
	function getBarang(){  
        xkey = $("#keyword").val(); 
        
        $('#dgBarang').datagrid({
            width: '111%',
            height: '300',
            rownumbers: true,
            remoteSort: false,
            singleSelect:true,
            nowrap: true,
            pagination: true, 
            url:'<?php echo base_url(); ?>transaksi/C_Kibf/load_barang',
            queryParams:({akun:'1',kelompok:'3',jenis:'6',rincian:'1.3.6.01.01.01',sub_rincian:'01',key:xkey}),
            loadMsg: 'Tunggu Sebentar ... !', 
            frozenColumns:[[
                {field:'ck',title:'',width:1,align:'center',checkbox:true},
            ]],
            columns:[[
                {field:'kd_brg', title:'Kode', width:220, align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:620,align:"left"}
            ]],
            onSelect:function(rowIndex,rowData){  
                $("#kd_barang").val(rowData.kd_brg);
                $("#nm_barang").text(rowData.nm_brg); 
           },onSelect:function(rowIndex,rowData){
                $("#nm_barang").text(rowData.nm_brg); 
           } 

        });
        $('#dlgBrg').dialog('open').dialog('center').dialog('setTitle','Pilih Barang');
    }


/**maps**/
function open_map() {
    $('#dlg').dialog('open').dialog('center').dialog('setTitle','');
    initialize();
}


function galery() {
    $('#galery').dialog('open').dialog('center').dialog('setTitle','');
}
function myFunction(imgs,text) {
  var expandImg = document.getElementById("expandedImg");
  var imgText = document.getElementById("imgtext");
  var bg = imgs.style.backgroundImage;
  expandImg.src = bg.replace('url("','').replace('")','');
  imgText.innerHTML = text;
  expandImg.parentElement.style.display = "block";
}
function hapus(field) {
    $.messager.confirm('Konfirmasi','Yakin ingin menghapus foto ini?',function(r){
        if (r){
            $.ajax({
                url:'<?php echo base_url();?>transaksi/C_Kibf/hapus_img',
                type:'POST',
                dataType:'JSON',
                data:{field,'id_barang':id_brg},
                success: function(data) {
                    if (data.pesan) {
                        iziToast.success({
                            title: 'OK',
                            message: data.message,
                            timeout: 1500
                        });
                        localStorage.setItem(field,'');
                        $('#'+field+'d').css('display','none');
                    }else {
                        iziToast.error({
                            title: 'error',
                            message: data.message,
                            timeout: 1500
                        });
                    }
                }
            });
        }
    });
}



function initialize() {
  var map, markersArray = [],infoWindow;
  if ($("#latitude").textbox('getValue') !='' && $("#longtitude").textbox('getValue') !='') {
    var latitude  = $('#latitude').textbox('getValue');
    var longitude = $('#longtitude').textbox('getValue');
}else{
    var latitude  = -5.146609365513;
    var longitude = 119.43245638575854;
}

var clickmarkers = [];
var haightAshbury = new google.maps.LatLng(latitude, longitude);
var mapOptions = {
    zoom: 15,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};
map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);


var clickmarker = new google.maps.Marker({
    position: haightAshbury,
    map:map,
    draggable: true
});

google.maps.event.addListener(map, 'click', function(event) {

    clickmarker.setPosition(event.latLng);
    clickmarker.setMap(map);
    clickmarker.setAnimation(google.maps.Animation.DROP);
    var lat = clickmarker.getPosition().lat();
    var lng = clickmarker.getPosition().lng();
    $("#latitude").textbox('setValue',lat);
    $("#longtitude").textbox('setValue',lng);


});
google.maps.event.addListener(clickmarker, 'drag', function() {
    var lat = clickmarker.getPosition().lat();
    var lng = clickmarker.getPosition().lng();
    $("#latitude").textbox('setValue',lat);
    $("#longtitude").textbox('setValue',lng);
});

var input =(document.getElementById('pac-input'));
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
var searchBox = new google.maps.places.SearchBox((input));
google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
  }
  for (var i = 0, clickmarker; clickmarker = clickmarkers[i]; i++) {
      clickmarker.setMap(null);
  }
  clickmarkers = [];
  var bounds = new google.maps.LatLngBounds();
  for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
    };
    var clickmarker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
    });
    clickmarkers.push(clickmarker);
    bounds.extend(place.geometry.location);
}
map.fitBounds(bounds);
map.setZoom(16);
});
google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
});
google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function() {
  $('#find').click(function() { 
    infoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
      };
      infoWindow.setPosition(pos);
      infoWindow.setContent('Location found.');
      infoWindow.open(map);
      map.setCenter(pos);
  }, function() {
    handleLocationError(true, infoWindow, map.getCenter());
});
  } else {
      handleLocationError(false, infoWindow, map.getCenter());
  }
});
});
  


}/*END*/
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
      'Error: The Geolocation service failed.' :
      'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}

</script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP5P2jPNd49MKMeOphABZ2PgiYdBeS6qk&libraries=places">
</script>

<div id="dlg" class="easyui-dialog" closed="true" buttons="#dlg-buttons" style="width: 70%;">
    <button id="find" class="btn-circle btn-info controls pac-container" type="button" style="border:none;margin-top: -38px;"><i class="fa fa-street-view fa-lg"></i></button>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas" class="iframe-container"></div>
</div>



<div id="galery" class="easyui-dialog" closed="true" buttons="#dlg-buttons" style="width:60%">
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