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
                        <span id="nm_barang" name="nm_barang" type="text"  style="width:80%;"><span>
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


	function simpan() {
        
        $("#btn_simpan").prop('disabled',true);
		var milik       = $('#milik').combogrid('getValue');
        var wil         = $('#wil').combogrid('getValue');
        var kd_skpd     = $('#kd_skpd').combogrid('getValue');
        var kd_unit     = $('#kd_unit').combogrid('getValue');
        var perolehan   = $('#perolehan').combogrid('getValue');
        var dasar       = $('#dasar').combogrid('getValue'); 
        var kondisi       = $('#kondisi').combogrid('getValue'); 
 
        var kd_barang   = $("#kd_barang").val();
        var no_oleh     = $("#no_oleh").val();
        var tgl_oleh    = $("#tgl_oleh").val();
        var thn_oleh    = $("#thn_oleh").val();
        var hrg_oleh    = angka($("#hrg_oleh").val());
        var jumlah      = $("#jumlah").val();
        var tgl_regis   = $("#tgl_regis").val();
         
        if(kondisi==''){
            iziToast.error({ title: 'Error', message: 'Kondisi Tidak boleh Kosong', });
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
					url: '<?php echo base_url();?>transaksi/C_Kibg/simpan',
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
                            cekOtori();
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
					url: '<?php echo base_url();?>transaksi/C_Kibg/edit?sts='+sts,
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
	
    function cekOtori(){
        var otori = "<?php echo $this->session->userdata['oto'];?>";
        if(otori!='01'){
            var zskpd = "<?php echo $this->session->userdata['kd_skpd'];?>";
            var zunit = "<?php echo $this->session->userdata['kd_unit'];?>";
            $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getUnit',
               queryParams:({kd_skpd:zskpd})
               });
            $('#kd_skpd').combogrid({readonly: true}).combogrid('setValue', zskpd);
            $('#kd_unit').combogrid({readonly: true}).combogrid('setValue', zunit); 
        }
    }

    /* var tgl_dokumen     = document.getElementById('tgl_dokumen');
    var no_dokumen      = document.getElementById('no_dokumen');
    var tahun_rencana   = document.getElementById('tahun_rencana');
    var jml             = document.getElementById('jml');
    var hrg             = document.getElementById('hrg');
    var nm_skpd         = document.getElementById('nm_skpd');
    var total           = document.getElementById('total_s1');
    var nm_brg          = document.getElementById('nm_brg');
    var total_dlg       = document.getElementById('total');
    var brg_dlg         = document.getElementById('brg_dlg'); */
    
	window.onload = function(){
        var status  = localStorage.getItem('status');
        cekOtori();
        var sts  = localStorage.getItem('sts');
        if(sts=='1'){
            // $("#kondisi").combogrid({disabled:true})
            $("#tgl_regis").prop('disabled',true);
            $("#hrg_oleh").prop('disabled',true);
            $("#thn_oleh").prop('disabled',true);
            $("#jumlah").numberbox({disabled:true});
        }
        if (status == 'detail') {
            var id_brg             = localStorage.getItem('id_barang');
            var id_lok             = localStorage.getItem('id_lokasi');
			var no_reg            = localStorage.getItem('no_reg');
			var rincian           = localStorage.getItem('rincian'); //alert (rincian);
			var sub_rincian       = localStorage.getItem('sub_rincian'); //alert (sub_rincian);
			var kd_barang         = localStorage.getItem('kd_barang');
			var no_dokumen        = localStorage.getItem('no_dokumen');
			var milik             = localStorage.getItem('milik');
			var wil          	  = localStorage.getItem('wil');
			var kd_skpd           = localStorage.getItem('kd_skpd');
			var nm_skpd           = localStorage.getItem('nm_skpd');
			var kd_unit           = localStorage.getItem('kd_unit');
			var perolehan         = localStorage.getItem('perolehan');
			var dasar             = localStorage.getItem('dasar');
			var no_oleh	          = localStorage.getItem('no_oleh');
			var tgl_oleh	      = localStorage.getItem('tgl_oleh');
			var thn_oleh          = localStorage.getItem('thn_oleh');
			var hrg_oleh          = localStorage.getItem('hrg_oleh');
			var jumlah	          = localStorage.getItem('jumlah');
			var tgl_regis	      = localStorage.getItem('tgl_regis');
			var kondisi			  = localStorage.getItem('kondisi')
			var alamat1           = localStorage.getItem('alamat1');
			var alamat2           = localStorage.getItem('alamat2');
			var alamat3           = localStorage.getItem('alamat3');
			var keterangan        = localStorage.getItem('keterangan');
			var lat               = localStorage.getItem('lat');
			var lon				  = localStorage.getItem('lon');
			var gambar1		  	  = localStorage.getItem('foto');
			var gambar2		  	  = localStorage.getItem('foto2');
            var nm_brg            = localStorage.getItem('nm_brg');
            var sts              = localStorage.getItem('sts');
			var detail_brg 	     = localStorage.getItem('detail_brg');
			// $('#kd_barang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getKdbarang',
			//    queryParams:({akun:'1',kelompok:'5',jenis:'3',rincian:'153010101',sub_rincian:'01'})
			//    });
            detail.value       = detail_brg;
            id_barang.value       = id_brg;
            id_lokasi.value       = id_lok;
			
			no_regis.value = no_reg;
			//tgl_regis.value       = tgl_reg;
			$("#tgl_regis").datepicker("setDate", tgl_regis);
			$("#no_dokumen").textbox('setValue',no_dokumen);
			$('#kd_barang').val(kd_barang);
			nm_barang.textContent = nm_brg;
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
			$("#alamat1").textbox('setValue',alamat1);
			$("#alamat2").textbox('setValue',alamat2);
			$("#alamat3").textbox('setValue',alamat3);
			$("#keterangan").textbox('setValue',keterangan);
			$("#latitude").textbox('setValue',lat);
			$("#longtitude").textbox('setValue',lon);
			$("#foto1").filebox('setValue',gambar1);
			$("#foto2").filebox('setValue',gambar2);
			// $("#rincian").combogrid('setValue',rincian);
			// $("#sub_rincian").combogrid('setValue',sub_rincian);
			
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
        window.location.href = "<?php echo base_url(); ?>transaksi/C_Kibg";
		//"http://localhost/simbakda_akrual/perencanaan/C_Pengadaan";
    }

    function max_number(){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_Kibg/max_number',
            data: ({table:'transaksi.trkib_g',kolom:'no_reg'}),
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
            url: '<?php echo base_url(); ?>transaksi/C_Kibg/getDokumen',
			queryParams:({kib:'1.5.3'}),
            columns:[[  
               {field:'no_dokumen',title:'No.Dok',width:150},  
               {field:'no_sp2d',title:'Sp2d',width:150},
               {field:'nm_brg',title:'Barang',width:250},      
               {field:'harga',title:'Nilai',width:200,align:'right'},  
               {field:'keterangan',title:'Keterangan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
                $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getUnit',
                    queryParams:({kd_skpd:rowData.kd_skpd})
                });
				$('#kd_barang').val(rowData.kd_brg);
				$("#nm_barang").text(rowData.nm_brg);
				$('#milik').combogrid('setValue', 12);
				$('#wil').combogrid('setValue', rowData.kd_wilayah);
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
            url: '<?php echo base_url(); ?>transaksi/C_Kibg/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               nama = rowData.nm_skpd;
               kd_skpd = rowData.kd_skpd;
               nm_skpd.textContent = nama;
			   $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getUnit',
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
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getRincian', 
			queryParams:({akun:'1',kelompok:'3',jenis:'3'}),			
            columns:[[  
               {field:'bidang',title:'Rincian Objek',width:150},  
               {field:'nm_bidang',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
				bidang        = rowData.bidang;
			  $('#sub_rincian').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getSubRincian',
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
			    $('#kd_barang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getKdbarang',
			   queryParams:({akun:'1',kelompok:'3',jenis:'3',rincian:rincian,sub_rincian:sub_rincian})
			   });
				
			}
        }); */
		
		// $('#kd_barang').combogrid({
  //           panelWidth:550,  
  //           idField:'kd_brg',  
  //           textField:'kd_brg',  
  //           mode:'remote',
		// 	url:'<?php echo base_url(); ?>transaksi/C_Kibg/getKdbarang',
		// 	queryParams:({akun:'1',kelompok:'5',jenis:'3',rincian:'153010101',sub_rincian:'01'}),
  //           columns:[[  
  //              {field:'kd_brg',title:'Kode',width:120},  
  //              {field:'uraian',title:'Uraian',width:420}    
  //           ]],
		// 	onSelect:function(rowIndex,rowData){
		// 		nm_barang.textContent = rowData.uraian;
		// 		/* $('#milik').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getMilik',
		// 	   }); */
		// 	   }
  //       });
        
		$('#milik').combogrid({
            panelWidth:350,  
            idField:'kd_milik',  
            textField:'nm_milik',  
            mode:'remote',
			url:'<?php echo base_url(); ?>transaksi/C_Kibg/getMilik',
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
            panelWidth:450,  
            idField:'kd_wilayah',  
            textField:'nm_wilayah',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getWilayah', 
			queryParams:({akun:'1',kelompok:'3',jenis:'1'}),			
            columns:[[  
               {field:'kd_wilayah',title:'Kode',width:50},  
               {field:'nm_wilayah',title:'Uraian',width:400}    
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
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getOleh', 
            columns:[[  
               {field:'kd_cr_oleh',title:'Kode',width:150},  
               {field:'cara_peroleh',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
			  /* $('#dasar').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibg/getDasar',
			   }); */
			}
        });
		
		$('#dasar').combogrid({
            panelWidth:350,  
            idField:'kode',  
            textField:'dasar_peroleh',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getDasar', 
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
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getStatustanah', 
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
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getKonstruksi', 
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
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/getKonstruksi2', 
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
			url:'<?php echo base_url(); ?>transaksi/C_Kibg/getJenisBangun',
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
			url:'<?php echo base_url(); ?>transaksi/C_Kibg/getKondisi',
            columns:[[  
               {field:'kode',title:'Kode',width:150},  
               {field:'kondisi',title:'Uraian',width:200}    
            ]],
			onSelect:function(rowIndex,rowData){
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
            url:'<?php echo base_url(); ?>transaksi/C_Kibg/load_barang',
            queryParams:({akun:'1',kelompok:'5',jenis:'3',rincian:'1.5.3.01.01.01',sub_rincian:'01',key:xkey}),
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
	
/**maps**/
function open_map() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','');
		initMap();
    }
	
//var uluru = {lat: -6.175350713610744, lng: 106.82716557653816};
var uluru = {lat: -0.392461, lng: 102.437743};
	
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