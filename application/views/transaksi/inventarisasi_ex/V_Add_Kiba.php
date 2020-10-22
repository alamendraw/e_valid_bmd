<form id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">            

            <div style="margin-bottom:10px" class="hide">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <input id="id_barang" name="id_barang" type="text" class="form-control" style="width:80%;">
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Rincian Objek</label></div>
                    <div class="col-sm-8">
                        <input id="rincian" name="rincian" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px" hidden="true">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="nm_rincian" name="nm_rincian" type="text"  style="width:100%;"><span>
                    </div>
                </div>
            </div>
			<!-- <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Sub. Rincian Objek</label></div>
                    <div class="col-sm-8">
                        <input id="sub_rincian" name="sub_rincian" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div> -->
			<div style="margin-bottom:10px"  hidden="true">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="nm_subrinci" name="nm_subrinci" type="text"  style="width:100%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kode Barang</label></div>
                    <div class="col-sm-8">
                        <!-- <input id="kd_barang" name="kd_barang" type="text" class="easyui-textbox" style="width:80%;"> -->
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
			<div style="margin-bottom:10px" class="hide">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8">
                        <span id="nm_skpd" name="nm_skpd" type="text"  style="width:100%;"><span>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Harga Perunit</label></div>
                    <div class="col-sm-8">
						<input id="hrg_oleh" name="hrg_oleh" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 80%; text-align: right;"> 
					</div>
                </div>
            </div>	

            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div  style="padding-top: 3px;"><label><u>Batas - Batas</u></label></div>
                </div>
            </div>	

            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Batas Barat</label></div>
                    <div class="col-sm-8">
                        <span id="b_barat" name="b_barat" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"><span>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Batas Timur</label></div>
                    <div class="col-sm-8">
                        <span id="b_timur" name="b_timur" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"><span>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Batas Utara</label></div>
                    <div class="col-sm-8">
                        <span id="b_utara" name="b_utara" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"><span>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Batas Selatan</label></div>
                    <div class="col-sm-8">
                        <span id="b_selatan" name="b_selatan" type="text" class="easyui-textbox" style="width:80%;"  multiline="true"><span>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Status Tanah</label></div>
                    <div class="col-sm-8">
                        <span id="sts_tanah" name="sts_tanah" type="text" class="easyui-textbox" style="width:80%;"><span>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Sertifikat</label></div>
                    <div class="col-sm-8">
                        <span id="no_sert" name="no_sert" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tgl. Sertifikat</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
                          <input id="tgl_sert" name="tgl_sert" type="text" class="form-control" style="width:100%;" >
                           <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                        </div></div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Luas Tanah</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
                          <input id="luas" name="luas" type="text" class="easyui-textbox" style="width:80%;" >
                          <span class="input-group-addon">m<sup>2</sup></span>
                        </div></div>
                </div>
            </div>
			
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Penggunaan</label></div>
                    <div class="col-sm-8">
                        <span id="penggunaan" name="penggunaan" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Letak/Alamat</label></div>
                    <div class="col-sm-8">
                        <span id="alamat1" name="alamat1" type="text" class="easyui-textbox" style="width:80%;" multiline="true"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8" hidden="true">
                        <span id="alamat2" name="alamat2" type="text" class="easyui-textbox" style="width:80%;" ><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"></div>
                    <div class="col-sm-8" hidden="true">
                        <span id="alamat3" name="alamat3" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Upload Sertifikat</label></div>
                    <div class="col-sm-6">
                        <span id="upload" name="upload" type="text"  style="width:110%;"><span>
                    </div>
                    <div class="col-sm-2" style="padding-left: 7px;">
                        <button class="" type="button" onClick="javascript:realoadSert();" style="height: 28px;"><i class="fa fa-undo" style="color:red; font-size: 12px;" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Latitude</label></div>
                    <div class="col-sm-8">
						  <input id="latitude" name="latitude" type="text" class="easyui-textbox" style="width:80%;" >
						  <button class="" type="button" onClick="javascript:open_map();"><i class="fa fa-map-marker fa-2x" style="color:red;" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Longtitude</label></div>
                    <div class="col-sm-8">
                          <input id="longtitude" name="longtitude" type="text" class="easyui-textbox" style="width:80%;" >
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Gambar</label></div>
                    <div class="col-sm-8">
                          <?php for ($i=1; $i <=2 ; $i++) :?> 
                                <input class="easyui-filebox" id="foto<?php echo $i;?>" name="filefoto<?php echo $i;?>" style="width:80%;">  
                        <?php endfor;?> 
                    </div>
                </div>
            </div>
			 <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;">&nbsp;</div>
                    <div class="col-sm-8">&nbsp;  </div>
                </div>
            </div>
 
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kecamatan</label></div>
                    <div class="col-sm-8">
                          <input id="camat" name="camat" type="text" class="easyui-textbox" style="width:80%;" >
                    </div>
                </div>
            </div> 
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kelurahan</label></div>
                    <div class="col-sm-8">
                          <input id="lurah" name="lurah" type="text" class="easyui-textbox" style="width:80%;" >
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Pemegang Hak</label></div>
                    <div class="col-sm-8">
                          <input id="pemegang_hak" name="pemegang_hak" type="text" class="easyui-textbox" style="width:80%;" >
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nomor Surat Ukur</label></div>
                    <div class="col-sm-8">
                          <input id="no_surat_ukur" name="no_surat_ukur" type="text" class="easyui-textbox" style="width:80%;" >
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal Surat Ukur</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
                          <input id="tgl_surat_ukur" name="tgl_surat_ukur" type="text" class="form-control" style="width:100%;" >
                           <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                        </div></div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Status Sertifikat</label></div>
                    <div class="col-sm-8">
                          <input id="status_sertifikat" name="status_sertifikat" type="text" class="easyui-textbox" style="width:80%;" >
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tipe Fasilitas</label></div>
                    <div class="col-sm-8">
                          <input id="fasilitas" name="fasilitas" type="text" class="easyui-textbox" style="width:80%;" >
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</form>
<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="button" class="btn btn-default btn-lg btn-block" id="btn_simpan" onClick="javascript:simpan()">Simpan</button>
    </div>
    <div class="col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Kembali</button>
    </div>
	    <div id="progressFile" class="easyui-progressbar" style="width:50%;" hidden="true"></div>
</div>

<style>
.col-sm-4{
	padding-right: 10px !important;
    padding-left: 10px !important;
}
#map {
 height: 400px;
 width: 500px;
}
</style>
<div id="dlgBrg" class="easyui-dialog" style="width:900px" closed="true" buttons="#dlg-buttonsBrg">
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

<div id="dlg-buttonsBrg"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="javascript:$('#dlgBrg').dialog('close')" style="width:90px">Selesai</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlgBrg').dialog('close')" style="width:90px">Kembali</a>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript"> 
	xbidang='';
	window.onload = function(){
        var status  = localStorage.getItem('status');
        var otori = "<?php echo $this->session->userdata['oto'];?>";
        cekOtori();
        if (status == 'detail') {  
            var id_brg            = localStorage.getItem('id_lokasi');
			var no_reg            = localStorage.getItem('no_reg');
			var tgl_reg	          = localStorage.getItem('tgl_reg');
			var no_oleh	          = localStorage.getItem('no_oleh');
			var tgl_oleh	      = localStorage.getItem('tgl_oleh');
			var no_dokumen        = localStorage.getItem('no_dokumen');
			var no_oleh           = localStorage.getItem('no_oleh');
			var status_tanah      = localStorage.getItem('status_tanah');
			var asal              = localStorage.getItem('asal');
			var dsr_peroleh       = localStorage.getItem('dsr_peroleh');
			var no_sertifikat     = localStorage.getItem('no_sertifikat');
			var tgl_sertifikat    = localStorage.getItem('tgl_sertifikat');
			var luas              = localStorage.getItem('luas');
			var nilai             = localStorage.getItem('nilai');
			var alamat1           = localStorage.getItem('alamat1');
			var alamat2           = localStorage.getItem('alamat2');
			var alamat3           = localStorage.getItem('alamat3');
			var keterangan        = localStorage.getItem('keterangan');
			var milik             = localStorage.getItem('milik');
			var wilayah           = localStorage.getItem('wilayah');
			var kd_skpd           = localStorage.getItem('kd_skpd');
			var kd_unit           = localStorage.getItem('kd_unit');
			var tahun             = localStorage.getItem('tahun');
			var kd_brg            = localStorage.getItem('kd_brg');
			var lat               = localStorage.getItem('lat');
			var lon				  = localStorage.getItem('lon');
			var kondisi			  = localStorage.getItem('kondisi');
			var rincian			  = localStorage.getItem('rincian_objek');
			// var sub_rincian		  = localStorage.getItem('sub_rinci');
			var nm_skpd			  = localStorage.getItem('nm_skpd');
			var hrg_oleh		  = localStorage.getItem('hrg_oleh'); 

			var upload		  	  = localStorage.getItem('upload_sert');
			var gambar1		  	  = localStorage.getItem('foto1');
			var gambar2		  	  = localStorage.getItem('foto2');
			var nm_rincian		  = localStorage.getItem('nm_rincian');
			var nm_subrinci		  = localStorage.getItem('nm_subrinci');
			var nm_unit			  = localStorage.getItem('nm_unit');
			var nm_brg			  = localStorage.getItem('nm_brg');
            var penggunaan        = localStorage.getItem('penggunaan');
            var detail_brg        = localStorage.getItem('detail_brg');
 
            id_barang.value       = id_brg;
            no_regis.value        = no_reg;
			detail.value        = detail_brg;
			tgl_regis.value       = tgl_reg;
            $('#kd_skpd').combogrid('setValue', kd_skpd);
			$("#no_dokumen").textbox('setValue',no_dokumen);
			$("#no_oleh").textbox('setValue',no_oleh);
			$('#kd_barang').val(kd_brg);
			$('#milik').combogrid('setValue', milik);
			$('#wil').combogrid('setValue', wilayah);
			$('#kd_unit').combogrid('setValue', kd_unit);
			$('#perolehan').combogrid('setValue', asal);
			$('#dasar').combogrid('setValue', dsr_peroleh);
			$("#thn_oleh").datepicker("setDate", tahun);
			$('#sts_tanah').combogrid('setValue', status_tanah); 
            $("#kondisi").combogrid("setValue", kondisi);
			$("#no_sert").textbox('setValue',no_sertifikat);
			$("#tgl_oleh").datepicker("setDate", tgl_oleh);
			$("#tgl_sert").datepicker("setDate", tgl_sertifikat);
			$("#luas").textbox('setValue',luas);
			$("#alamat1").textbox('setValue',alamat1);
			$("#alamat2").textbox('setValue',alamat2);
			$("#alamat3").textbox('setValue',alamat3);
			$("#latitude").textbox('setValue',lat);
			$("#longtitude").textbox('setValue',lon);
			$("#keterangan").textbox('setValue',keterangan);
			$("#rincian").combogrid('setValue',rincian);
			// $("#sub_rincian").combogrid('setValue',sub_rincian);
			//$("#hrg_oleh").textbox('setValue',hrg_oleh);
			$("#hrg_oleh").val(hrg_oleh);  
            $("#penggunaan").textbox('setValue',penggunaan);

			$("#upload").textbox('setValue','upload');
			$("#foto1").textbox('setValue','gambar1');
			$("#foto2").textbox('setValue','gambar2');
			$("#nm_skpd").text(nm_skpd);
			$("#nm_rincian").text(nm_rincian);
			$("#nm_subrinci").text(nm_subrinci);
			$("#nm_unit").text(nm_unit);
			$("#nm_barang").text(nm_brg);
            var sts       = localStorage.getItem('sts');
            if(sts=='1'){
                // $("#kondisi").combogrid({disabled:true});
                $("#tgl_regis").prop('disabled','disabled');
                $("#hrg_oleh").prop('disabled','disabled');
                $("#thn_oleh").prop('disabled','disabled');
            }
        } else {
			
		}
    }

    function cekOtori(){
        var otori = "<?php echo $this->session->userdata['oto'];?>";
        if(otori!='01'){
            var zskpd = "<?php echo $this->session->userdata['kd_skpd'];?>";
            var zunit = "<?php echo $this->session->userdata['kd_unit'];?>";
            $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kiba/getUnit',
               queryParams:({kd_skpd:zskpd})
               });
            $('#kd_skpd').combogrid({readonly: true}).combogrid('setValue', zskpd);
            $('#kd_unit').combogrid({readonly: true}).combogrid('setValue', zunit); 
        }
    }

    function realoadSert() { 
        $("#upload").textbox('setValue','');
    }
    function realoadGbr1() { 
        $("#gambar1").textbox('setValue','');
    }
    function realoadGbr2() { 
        $("#gambar2").textbox('setValue','');
    }
 
    function getBarang(){  
        xkey = $("#keyword").val(); 
        if(xbidang==''){
            iziToast.error({
                title: 'Error',
                message: 'Pilih Rincian Objek Terlebih Dahulu',
            });
            return
        }
        $('#dgBarang').datagrid({
            width: '111%',
            height: '300',
            rownumbers: true,
            remoteSort: false,
            singleSelect:true,
            nowrap: true,
            pagination: true,
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/load_barang',
            queryParams:({akun:'1',kelompok:'3',jenis:'1',sub_rincian:xbidang,key:xkey}),
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
                
           }  

        });
        $('#dlgBrg').dialog('open').dialog('center').dialog('setTitle','Pilih Barang');
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_Kiba";
    }

    function max_number(xunit,xkode){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_Kiba/max_number', 
            data:({kode:xkode,unit:xunit}),
            dataType:"json",
            success:function(data){                
                no_regis.value = data; 
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

	function simpan(){
        $("#btn_simpan").prop('disabled',true);

		var status  	= localStorage.getItem('status');  
        var kd_barang   = $('#kd_barang').val();
        var milik       = $('#milik').combogrid('getValue');
        var wil         = $('#wil').combogrid('getValue');
        var kd_skpd     = $('#kd_skpd').combogrid('getValue');
        var kd_unit     = $('#kd_unit').combogrid('getValue');
        var perolehan   = $('#perolehan').combogrid('getValue');
        var dasar       = $('#dasar').combogrid('getValue');
        var no_oleh     = $('#no_oleh').val(); 
        var kondisi     = $('#kondisi').combogrid('getValue');
        var xnil        = angka($("#hrg_oleh").val()); 
        var tgl_oleh = $('#tgl_oleh').val();
        var tgl_sert = $('#tgl_sert').val();
        var tgl_regis = $('#tgl_regis').val();
        var no_sert = $('#no_sert').val();
        var thn = $('#thn_oleh').val(); 
       
        if(tgl_regis==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Register Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(thn==''){
            iziToast.error({ title: 'Error', message: 'Tahun Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(no_sert==''){
            iziToast.error({ title: 'Error', message: 'Nomor Sertifikat Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(tgl_sert==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Sertifikat Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(tgl_oleh==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(xnil==''){
            iziToast.error({ title: 'Error', message: 'Harga Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(kondisi==''){
            iziToast.error({ title: 'Error', message: 'Kondisi Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(no_oleh==''){
            iziToast.error({ title: 'Error', message: 'Nomor Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(dasar==''){
            iziToast.error({ title: 'Error', message: 'Dasar Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(perolehan==''){
            iziToast.error({ title: 'Error', message: 'Cara Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(kd_unit==''){
            iziToast.error({ title: 'Error', message: 'UNIT Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(kd_skpd==''){
            iziToast.error({ title: 'Error', message: 'SKPD Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(wil==''){
            iziToast.error({ title: 'Error', message: 'Wilayah Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        if(milik==''){
            iziToast.error({ title: 'Error', message: 'Pemilik Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
		if(kd_barang==''){
			iziToast.error({ title: 'Error', message: 'Barang Tidak boleh Kosong', });
			$("#btn_simpan").prop('disabled',false);
            return
		}
		var sts         = localStorage.getItem('sts');
		if(status == 'tambah'){
		$(document).ready(function() {
				$('#fm').form('submit', {
					url: '<?php echo base_url();?>transaksi/C_Kiba/simpan',
					onSubmit: function() {
					},
					success: function (data) {
                        $("#btn_simpan").prop('disabled',false);
				 		mes = $.parseJSON(data);
						if (mes.pesan) {
							iziToast.success({
								title: 'OK',
								message: mes.message,
							});
							$('#fm').form('reset');
							cekOtori();
						} else {
							iziToast.error({
								title: 'Error',
								message: mes.message,
							});
						} 
					}
					
				});
			});
		} else {
			$(document).ready(function() {
				$('#fm').form('submit', {
					url: '<?php echo base_url();?>transaksi/C_Kiba/edit?sts='+sts,
					onSubmit: function() {
					},
					success: function (data) {
                        $("#btn_simpan").prop('disabled',false);
						console.log(data);
				 		mes = $.parseJSON(data);
						if (mes.pesan) {
						console.log(mes.pesan);
							iziToast.success({
								title: 'OK',
								message: mes.message,
							});
							$('#fm').form('reset');
							$('#nm_barang').text("");
							//max_number();
						} else {
							iziToast.error({
								title: 'Error',
								message: mes.message,
							});
						} 
					}
					
				});
			});
		}
	}
	  

    $(document).ready(function() {
        $("#keyword").on('keyup', function(){
            getBarang();
        });

		$('#upload').filebox({
			buttonText: 'Choose File',
			buttonAlign: 'right',
			accept:'.pdf'
		});

		$('#gambar1').filebox({
			buttonText: 'Choose File',
			buttonAlign: 'right',
			accept:'.jpg,.gif,.png,.jpeg'
		});
		$('#gambar2').filebox({
			buttonText: 'Choose File',
			buttonAlign: 'right',
			accept:'.jpg,.gif,.png,.jpeg'
		});
				
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

		$('#tgl_surat_ukur').datepicker({
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

		
        $('#tgl_regis').val(getToday());

       
		$('#no_dokumen').combogrid({
            panelWidth:1049,  
            idField:'no_sp2d',  
            textField:'no_sp2d',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Kiba/getDokumen',
			queryParams:({kib:'1.3.1'}),
            columns:[[  
               {field:'no_dokumen',title:'No.Dok',width:150},  
               {field:'no_sp2d',title:'Sp2d',width:150},
               {field:'nm_brg',title:'Barang',width:250},      
               {field:'harga',title:'Nilai',width:200,align:'right'},  
               {field:'keterangan',title:'Keterangan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
                $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kiba/getUnit',
                    queryParams:({kd_skpd:rowData.kd_skpd})
                });
                $('#wil').combogrid({ 
                    url:'<?php echo base_url(); ?>transaksi/C_Kiba/getWilayah', 
                    queryParams:({akun:'1',kelompok:'3',jenis:'1'})
                });
                
				$("#rincian").combogrid('setValue',rowData.rincian_objek);
				// $("#sub_rincian").combogrid('setValue',rowData.sub_rincian_objek);
				$('#kd_barang').val(rowData.kd_brg);
				$("#nm_barang").text(rowData.nm_brg);
				$('#milik').combogrid('setValue', 12);
				$('#wil').combogrid('setValue', rowData.kd_wilayah);
                $('#kd_skpd').combogrid('setValue', rowData.kd_skpd);
				$('#kd_unit').combogrid('setValue', rowData.kd_unit);
				// $("#nm_skpd").text('');
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
            url: '<?php echo base_url(); ?>transaksi/C_Kiba/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               nama = rowData.nm_skpd;
               kd_skpd = rowData.kd_skpd;
               nm_skpd.textContent = nama;
			   $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kiba/getUnit',
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
                zxkode = $("#kd_barang").val();
                max_number(rowData.kd_unit,zxkode);
            }  
        });

        $('#camat').combogrid({
            panelWidth:600,  
            idField:'kd_lokasi',  
            textField:'nm_lokasi',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Kiba/getCamat',
            columns:[[  
               {field:'kd_lokasi',title:'Kode Kecamatan',width:200},  
               {field:'nm_lokasi',title:'Nama Kecamatan',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
                ode = rowData.kd_lokasi;
                qode = ode.substring(0,2);
              
                $('#lurah').combogrid({
                    url: '<?php echo base_url(); ?>transaksi/C_Kiba/getLurah',
                    queryParams : ({qode:qode})
                })
            }  
        });

        $('#lurah').combogrid({
            panelWidth:600,  
            idField:'kd_lokasi',  
            textField:'nm_lokasi',  
            mode:'remote', 
            columns:[[  
               {field:'kd_lokasi',title:'Kode Kelurahan',width:200},  
               {field:'nm_lokasi',title:'Nama Kelurahan',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
                
            }  
        });

        $('#fasilitas').combogrid({
            panelWidth:600,  
            idField:'id',  
            textField:'fasilitas',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Kiba/getFasilitas',
            columns:[[    
               {field:'fasilitas',title:'Nama Fasilitas',width:600}    
            ]],  
            onSelect:function(rowIndex,rowData){
                
            }  
        });

        $('#status_sertifikat').combogrid({
            panelWidth:600,  
            idField:'id',  
            textField:'status',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Kiba/getSertifikat',
            columns:[[    
               {field:'status',title:'Keterangan',width:600}    
            ]],  
            onSelect:function(rowIndex,rowData){
                
            }  
        });


        $('#rincian').combogrid({
            panelWidth:550,  
            idField:'kd_brg',  
            textField:'uraian',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/getRincian', 
			queryParams:({akun:'1',kelompok:'3',jenis:'1'}),			
            columns:[[  
               {field:'kd_brg',title:'Kode',width:70},  
               {field:'uraian',title:'Rincian Objek',width:470}    
            ]],
			onSelect:function(rowIndex,rowData){
				xbidang        = rowData.rincian_objek;
				nm_rincian.textContent = rowData.nm_bidang; 
                $("#kd_barang").val('');
                $("#nm_barang").text(''); 
				
			},onChange: function(){
				var row = $(this).combogrid('grid').datagrid('getSelected');
				bidang        = row.rincian_objek; 
			}
        });
		
		 
        
		$('#milik').combogrid({
            panelWidth:350,  
            idField:'kd_milik',  
            textField:'nm_milik',
			url:'<?php echo base_url(); ?>transaksi/C_Kiba/getMilik',			
            mode:'remote',
            columns:[[  
               {field:'kd_milik',title:'Kode',width:150},  
               {field:'nm_milik',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				
			    }
        });
		
		 $('#wil').combogrid({
            panelWidth:350,  
            idField:'kd_wilayah',  
            textField:'nm_wilayah',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/getWilayah', 
			queryParams:({akun:'1',kelompok:'3',jenis:'1'}),			
            columns:[[  
               {field:'kd_wilayah',title:'Kode',width:50,align:'center'},  
               {field:'nm_wilayah',title:'Uraian',width:300}    
            ]],
			onSelect:function(rowIndex,rowData){
				bidang        = rowData.bidang;
			}
        });
		
		$('#perolehan').combogrid({
            panelWidth:350,  
            idField:'kd_cr_oleh',  
            textField:'cara_peroleh',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/getOleh', 
            columns:[[  
               {field:'kd_cr_oleh',title:'Kode',width:150},  
               {field:'cara_peroleh',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			  $('#dasar').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kiba/getDasar',
			   });
			}
        });
		
		$('#dasar').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'dasar_peroleh',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/getDasar', 
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'dasar_peroleh',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
		$('#sts_tanah').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'status',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/getStatustanah', 
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'status',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			  $('#kondisi').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kiba/getKondisi',
			   });
			}
        });
		
		$('#kondisi').combogrid({
            panelWidth:350,  
            idField:'kondisi',  
            textField:'kondisi',  
            url:'<?php echo base_url(); ?>transaksi/C_Kiba/getKondisi', 
            mode:'remote',
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'kondisi',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
		
    });
	
	
/**maps**/
function open_map() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','');
		initMap();
    }
	
//var uluru = {lat: -6.175350713610744, lng: 106.82716557653816};
var uluru = {lat: -5.149006, lng: 119.435707};
	
function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 15,
	  center: uluru,
      mapTypeId: 'roadmap'
	});
	
	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map,
	  draggable : true,
      mapTypeId: 'roadmap'
	});
	
	 google.maps.event.addListener(marker, 'drag', function() {
	  updateMarkerPosition(marker.getPosition());
	 });
	
  }
   function updateMarkerPosition(latLng) {
			//$("#latitude").textbox('disabled',disabled);
			$("#latitude").textbox('setValue',[latLng.lat()]);
			$("#longtitude").textbox('setValue',[latLng.lng()]);
  }
  /**end maps**/
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP5P2jPNd49MKMeOphABZ2PgiYdBeS6qk&callback=initMap">
</script>

<div id="dlg" class="easyui-dialog" closed="true" buttons="#dlg-buttons">
    <div class="row" style="width: 100%">
		<div class="col-md-12">
		<div id="map" style="width:650px;height: 500px;"></div>     
		</div>
	</div>
</div>
 