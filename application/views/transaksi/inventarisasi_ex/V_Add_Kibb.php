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
                        <input id="detail" name="detail" type="text" class="form-control" style="width:80%;">
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
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Cara Perolehan</label></div>
                    <div class="col-sm-8">
           <div style="margin-bottom:10px">
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal Perolehan</label></div>
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
                    <div class="col-sm-8">
                        <input id="jumlah" name="jumlah" type="text" class="easyui-numberbox" style="width:30%;" data-options="min:1">
                    </div>
                </div>
            </div>  
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div  style="padding-top: 3px;"><label><u>Penyusutan Aset</u></label></div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Metode</label></div>
                    <div class="col-sm-8">
                        <input id="metode" name="metode" type="text" class="form-control" style="width:80%;">
                    </div>
                </div>
            </div>  
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Masa Manfaat</label></div>
                    <div class="col-sm-8">
                        <input id="masa" name="masa" type="text" class="easyui-numberbox" style="width:20%; text-align: right;" data-options="min:1"> Tahun
                    </div>
                </div>
            </div>  
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nilai Sisa</label></div>
                    <div class="col-sm-8">
                        <input id="nilai_sisa" name="nilai_sisa" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 80%; text-align: right;">
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
                    <div  style="padding-top: 3px;"><label><u>Spesifikasi Barang</u></label></div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Merk</label></div>
                    <div class="col-sm-8">
                        <span id="merk" name="merk" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			 <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Type</label></div>
                    <div class="col-sm-8">
                        <span id="type" name="type" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Warna</label></div>
                    <div class="col-sm-8">
                        <span id="warna" name="warna" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Bahan</label></div>
                    <div class="col-sm-8">
                        <div class="input-group" style="width:80%;">
						<span id="bahan" name="bahan" type="text" class="easyui-textbox" style="width:100%;"><span>
                         
                        </div></div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Satuan</label></div>
                    <div class="col-sm-8">
                        <span id="satuan" name="satuan" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No Rangka</label></div>
                    <div class="col-sm-8">
                        <span id="no_rangka" name="no_rangka" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No Mesin</label></div>
                    <div class="col-sm-8">
                        <span id="no_mesin" name="no_mesin" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No Polisi</label></div>
                    <div class="col-sm-8">
                        <span id="no_polisi" name="no_polisi" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Ukuran/CC</label></div>
                    <div class="col-sm-8">
                        <span id="ukuran" name="ukuran" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No STNK</label></div>
                    <div class="col-sm-8">
                        <span id="nostnk" name="nostnk" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal STNK</label></div>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No BPKB</label></div>
                    <div class="col-sm-8">
                        <span id="nobpkb" name="nobpkb" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal BPKB</label></div>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Kondisi</label></div>
                    <div class="col-sm-8">
                        <span id="kondisi" name="kondisi" type="text" class="easyui-textbox" style="width:80%;"><span>
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Ruangan</label></div>
                    <div class="col-sm-8">
                        <span id="kd_ruang" name="kd_ruang" type="text" class="easyui-textbox" style="width:80%;"><span>
                    </div>
                </div>
            </div>
			
			
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Gambar</label></div>
                    <div class="col-sm-8">
                          <?php for ($i=1; $i <=5 ; $i++) :?> 
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
</div>

 
<style>
.col-sm-4{
	padding-right: 10px !important;
    padding-left: 10px !important;
}
</style>

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

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">
	
     
    var xbidang         = ''; 
      
 window.onload = function(){
		
        var jns  = localStorage.getItem('jenis'); // 1=Aset Tetap; 2=Eca;
        $("#jns").attr('value',jns);
        var status  = localStorage.getItem('status');
        var sts  = localStorage.getItem('sts');
        if(sts=='1'){
            // $("#kondisi").combogrid({disabled:true})
            $("#tgl_regis").prop('disabled',true);
            $("#hrg_oleh").prop('disabled',true);
            $("#thn_oleh").prop('disabled',true);
            $("#jumlah").numberbox({disabled:true});
        }

        cekOtori();

		if(status=='detail'){
            var id_brg             = localStorage.getItem('id_lokasi');
    		var no_reg 				= localStorage.getItem('no_reg');
    		var tgl_reg 			= localStorage.getItem('tgl_reg');
    		var no_oleh 			= localStorage.getItem('no_oleh');
    		var tgl_oleh 			= localStorage.getItem('tgl_oleh');
    		var no_dokumen			= localStorage.getItem('no_dokumen');
    		var kondisi           	= localStorage.getItem('kondisi');
    		var asal              	= localStorage.getItem('asal');
    		var dsr_peroleh       	= localStorage.getItem('dsr_peroleh');
    		var nilai             	= localStorage.getItem('nilai');
    		var keterangan        	= localStorage.getItem('keterangan');
    		var milik             	= localStorage.getItem('milik');
    		var wilayah           	= localStorage.getItem('wilayah');
    		var kd_skpd           	= localStorage.getItem('kd_skpd');
    		var kd_unit           	= localStorage.getItem('kd_unit');
    		var tahun             	= localStorage.getItem('tahun');
    		var kd_brg            	= localStorage.getItem('kd_brg');
    		var rincian			  	= localStorage.getItem('rincian_objek');
    		var sub_rincian		  	= localStorage.getItem('sub_rinci');
    		var nm_skpd           	= localStorage.getItem('nm_skpd');
    		var foto              	= localStorage.getItem('foto');
    		var foto2             	= localStorage.getItem('foto2');
    		var nm_rincian        	= localStorage.getItem('nm_rincian');
    		var nm_subrinci       	= localStorage.getItem('nm_subrinci');
    		var nm_brg            	= localStorage.getItem('nm_brg');
    		var nm_unit           	= localStorage.getItem('nm_unit');
    		var merek             	= localStorage.getItem('merek');
    		var tipe              	= localStorage.getItem('tipe');
    		var kd_warna          	= localStorage.getItem('kd_warna');
    		var kd_bahan          	= localStorage.getItem('kd_bahan');
    		var kd_satuan         	= localStorage.getItem('kd_satuan');
    		var no_rangka         	= localStorage.getItem('no_rangka');
    		var no_mesin          	= localStorage.getItem('no_mesin');
    		var no_polisi         	= localStorage.getItem('no_polisi');
    		var silinder          	= localStorage.getItem('silinder');
    		var no_stnk           	= localStorage.getItem('no_stnk');
    		var tgl_stnk          	= localStorage.getItem('tgl_stnk');
    		var no_bpkb           	= localStorage.getItem('no_bpkb');
    		var tgl_bpkb          	= localStorage.getItem('tgl_bpkb');
    		var jumlah          	= localStorage.getItem('jumlah');
            var kd_ruang            = localStorage.getItem('kd_ruang');
            id_barang.value       = id_brg;
			no_regis.value        = no_reg;
			tgl_regis.value       = tgl_reg;
            $('#kd_skpd').combogrid('setValue', kd_skpd);
            $('#kd_unit').combogrid('setValue', kd_unit);
			$("#no_dokumen").textbox('setValue',no_dokumen);
			$("#no_oleh").textbox('setValue',no_oleh);
			$('#kd_barang').val(kd_brg);
			$("#nm_skpd").text(nm_skpd);
			$("#nm_rincian").text(nm_rincian);
			$("#nm_subrinci").text(nm_subrinci);
			$("#nm_unit").text(nm_unit);
			$("#nm_barang").text(nm_brg);
			$('#milik').combogrid('setValue', milik);
			$('#wil').combogrid('setValue', wilayah);	
			$('#perolehan').combogrid('setValue', asal);	
			$('#dasar').combogrid('setValue', dsr_peroleh);	
			$("#thn_oleh").datepicker("setDate", tahun); 
            $("#hrg_oleh").val(nilai);  
			$("#jumlah").textbox('setValue',jumlah);
			$("#merk").textbox('setValue',merek);
			$("#type").textbox('setValue',tipe);
			$("#warna").combogrid('setValue',kd_warna.trim());
			$("#bahan").combogrid('setValue',kd_bahan.trim());
			$("#satuan").combogrid('setValue',kd_satuan.trim());
			$("#no_rangka").textbox('setValue',no_rangka);
			$("#no_mesin").textbox('setValue',no_mesin);
			$("#no_polisi").textbox('setValue',no_polisi);
			$("#ukuran").textbox('setValue',silinder);
			$("#nostnk").textbox('setValue',no_stnk);
			$("#tgl_stnk").datepicker("setDate", tgl_stnk);
            $("#tgl_oleh").datepicker("setDate", tgl_oleh);
			$("#nobpkb").textbox('setValue',no_bpkb);
			$("#tgl_bpkb").datepicker("setDate", tgl_bpkb);
			$("#kondisi").combogrid('setValue',kondisi);
			$("#keterangan").textbox('setValue',keterangan);
			$("#rincian").combogrid('setValue',rincian); 
			$("#kd_ruang").combogrid('setValue',kd_ruang);
			
		}
		else{
			
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

    function back() {
        if(localStorage.getItem('jenis')==1){
            localStorage.clear();
            window.location.href = "<?php echo base_url(); ?>transaksi/C_Kibb/dataAset";
        }else{
            localStorage.clear();
            window.location.href = "<?php echo base_url(); ?>transaksi/C_Kibb/dataEca";
        } 
    }

	function max_number(kdBar){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_Kibb/max_number', 
            data:({kode:kdBar}),
            dataType:"json",
            success:function(data){                    
                no_regis.value = data; 
            }
        }); 
    }
 
    function getBarang(){  
        xkey = $("#keyword").val(); 
        rinci = $("#rincian").val();

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
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/load_barang',
            queryParams:({akun:'1',kelompok:'3',jenis:'2',sub_rincian:xbidang,key:xkey,rinci:rinci}),
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
                max_number(rowData.kd_brg);
           }  

        });
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Pilih Barang');
    }
	
	function simpan(){
        $("#btn_simpan").prop('disabled',true);
        var xjenis       = localStorage.getItem('jenis');
		var status  	= localStorage.getItem('status');
		var kd_skpd     = $('#kd_skpd').combogrid('getValue');
        var tgl_oleh    = $('#tgl_oleh').val();
        var thn         = $('#thn_oleh').val();
        var jumlah      = $('#jumlah').textbox('getValue');
        var xnil        = angka($("#hrg_oleh").val());

        var tgl_reg     = $('#tgl_regis').val();
        var rincian     = $('#rincian').combogrid('getValue');
        var milik       = $('#milik').combogrid('getValue');
        var wil         = $('#wil').combogrid('getValue'); 
        var kd_unit     = $('#kd_unit').combogrid('getValue'); 
        var dasar       = $('#dasar').combogrid('getValue');
        var no_oleh     = $('#no_oleh').val();
        var kd_barang   = $('#kd_barang').val();
        var kondisi     = $('#kondisi').val(); 
 
        if(xnil==''){
            iziToast.error({ title: 'Error', message: 'Harga Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(kondisi==''){
            iziToast.error({ title: 'Error', message: 'Kondisi Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(kd_barang==''){ 
            iziToast.error({ title: 'Error', message: 'Barang Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(no_oleh==''){
            iziToast.error({title: 'Error',message: 'Nomor Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(dasar==''){
            iziToast.error({ title: 'Error', message: 'Dasar Perolehan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(wil==''){ 
            iziToast.error({ title: 'Error', message: 'Wilayah Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(milik==''){ 
            iziToast.error({ title: 'Error', message: 'Kepemilikan Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(rincian==''){
            iziToast.error({ title: 'Error',  message: 'Rincian Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(tgl_reg==''){
            iziToast.error({ title: 'Error', message: 'Tanggal Registrasi Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        if(kd_skpd==''){
            iziToast.error({ title: 'Error', message: 'SKPD Tidak boleh Kosong', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
		if(kd_unit==''){
			iziToast.error({ title: 'Error', message: 'UNIT Tidak boleh Kosong', });
			$("#btn_simpan").prop('disabled',false);
            return
		}
		
		if(tgl_oleh==''){
			iziToast.error({ title: 'Error', message: 'Tanggal Perolehan Tidak boleh Kosong', });
			$("#btn_simpan").prop('disabled',false);
            return
		}
		 
		if(thn==''){
			iziToast.error({ title: 'Error', message: 'Tahun Perolehan Tidak boleh Kosong', });
			$("#btn_simpan").prop('disabled',false);
            return
		}
		
		if(jumlah==''){
			iziToast.error({ title: 'Error', message: 'Jumlah Tidak boleh Kosong',
			});
			$("#btn_simpan").prop('disabled',false);
            return
		}
		
        if(xjenis==1 && xnil < 300000){ //Kondisi Aset Tetap
            iziToast.error({ title: 'Error', message: 'Nilai Aset Tetap Tidak Boleh Kurang Dari 300.000', });
            $("#btn_simpan").prop('disabled',false);
            return
        }else if(xjenis!=1 && xnil >= 300000){ //Kondisi Eca
            iziToast.error({ title: 'Error', message: 'Nilai Eca Tidak Boleh Lebih Dari 300.000', });
            $("#btn_simpan").prop('disabled',false);
            return
        }
        
        var sts  = localStorage.getItem('sts');
		if(status == 'tambah'){
            $(document).ready(function() {
				$('#fm').form('submit', {
					url: '<?php echo base_url();?>transaksi/C_Kibb/simpan', 
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
							$('#nm_barang').text("");
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
					url: '<?php echo base_url();?>transaksi/C_Kibb/edit?sts='+sts,
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

 
    $(document).ready(function() {


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
		
		$('#tgl_stnk').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		
		$('#tgl_bpkb').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });

        $('#tgl_regis').val(getToday()); 

        $('#no_dokumen').combogrid({
            panelWidth:1049,  
            idField:'no_dokumen',  
            textField:'no_dokumen',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Kibb/getDokumen',
			queryParams:({kib:'1.3.2'}),
            columns:[[  
               {field:'no_dokumen',title:'No.Dok',width:150},  
               {field:'no_sp2d',title:'Sp2d',width:150},
               {field:'nm_brg',title:'Barang',width:250},      
               {field:'harga',title:'Nilai',width:200,align:'right'},  
               {field:'keterangan',title:'Keterangan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
                $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getUnit',
                    queryParams:({kd_skpd:rowData.kd_skpd})
                });
				$("#rincian").combogrid('setValue',rowData.rincian_objek); 
                $('#kd_barang').val(rowData.kd_brg);
				$('#merk').textbox('setValue',rowData.merek);
				$("#nm_barang").text(rowData.nm_brg);
				$('#milik').combogrid('setValue', 12);
                $('#wil').combogrid('setValue', rowData.kd_wilayah); 
                $('#satuan').combogrid('setValue', rowData.satuan); 
                $('#kd_skpd').combogrid('setValue', rowData.kd_skpd); 
				$('#kd_unit').combogrid('setValue', rowData.kd_unit); 
				$('#perolehan').combogrid('setValue', '03');
				$('#dasar').combogrid('setValue', 1);			
                $("#no_oleh").textbox('setValue',rowData.no_sp2d);
				$("#keterangan").textbox('setValue',rowData.keterangan);
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
            url: '<?php echo base_url(); ?>transaksi/C_Kibb/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               nama = rowData.nm_skpd;
               kd_skpd = rowData.kd_skpd;
               nm_skpd.textContent = nama;
			   $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getUnit',
			   queryParams:({kd_skpd:kd_skpd})
                });
			   $('#kd_ruang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getRuang',
			   queryParams:({kd_skpd:kd_skpd,kd_unit:''})
			   });
                
            },onChange: function(){
				var kd_skpd = $('#kd_skpd').val();
			   $('#kd_ruang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getRuang',
			     queryParams:({kd_skpd:kd_skpd,kd_unit:''})
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
		
		$('#kd_ruang').combogrid({
            panelWidth:600,  
            idField:'kd_ruang',  
            textField:'kd_ruang',  
            mode:'remote',
            columns:[[  
               {field:'kd_ruang',title:'KODE RUANGAN',width:200},  
               {field:'nm_ruang',title:'NAMA RUANGAN',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
            } 
        });
	

        $('#satuan').combogrid({
            panelWidth:350,  
            idField:'kd_satuan',  
            textField:'nm_satuan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getSatuan',  
            columns:[[  
               {field:'kd_satuan',title:'KODE SATUAN',width:150},  
               {field:'nm_satuan',title:'SATUAN',width:200}    
            ]]
        });
	
        $('#rincian').combogrid({
            panelWidth:550,  
            idField:'kd_brg',  
            textField:'uraian',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getRincian', 
			queryParams:({akun:'1',kelompok:'3',jenis:'2'}),			
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
				 
			}
        });
		
		 
        
		$('#milik').combogrid({
            panelWidth:350,  
            idField:'kd_milik',  
            textField:'nm_milik',  
			url:'<?php echo base_url(); ?>transaksi/C_Kibb/getMilik',			
            mode:'remote',
            columns:[[  
               {field:'kd_milik',title:'Kode',width:150},  
               {field:'nm_milik',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				 
			    }
        });
		
		$('#warna').combogrid({
            panelWidth:350,  
            idField:'kd_warna',  
            textField:'nm_warna',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getWarna',  
            columns:[[  
               {field:'kd_warna',title:'KODE WARNA',width:150},  
               {field:'nm_warna',title:'NAMA WARNA',width:200}    
            ]]
        });
		
		$('#bahan').combogrid({
            panelWidth:350,  
            idField:'kd_bahan',  
            textField:'nm_bahan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getBahan',  
            columns:[[  
               {field:'kd_bahan',title:'KODE BAHAN',width:150},  
               {field:'nm_bahan',title:'NAMA BAHAN',width:200}    
            ]]
        });
		
        $('#kondisi').combogrid({
            panelWidth:350,  
            idField:'kondisi',  
            textField:'kondisi',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getKondisi',  
            columns:[[  
               {field:'kode',title:'KODE KONDISI',width:150},  
               {field:'kondisi',title:'NAMA KONDISI',width:200}    
            ]]
        });
        
		$('#metode').combogrid({
            panelWidth:350,  
            idField:'metode',  
            textField:'metode',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getMetode',  
            columns:[[  
               {field:'kode',title:'KODE METODE',width:150},  
               {field:'metode',title:'NAMA METODE',width:200}    
            ]]
        });
		
		 $('#wil').combogrid({
            panelWidth:350,  
            idField:'kd_wilayah',  
            textField:'nm_wilayah',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getWilayah', 
			queryParams:({akun:'1',kelompok:'3',jenis:'2'}),			
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
            idField:'kd_cr_oleh',  
            textField:'cara_peroleh',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getOleh', 
            columns:[[  
               {field:'kd_cr_oleh',title:'Kode',width:150},  
               {field:'cara_peroleh',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			  $('#dasar').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getDasar',
			   });
			}
        });
		
		$('#dasar').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'dasar_peroleh',  
            mode:'remote',
			url:'<?php echo base_url(); ?>transaksi/C_Kibb/getDasar',
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'dasar_peroleh',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });

        $("#keyword").on('keyup', function(){
            getBarang();
        });
		
    });
</script>