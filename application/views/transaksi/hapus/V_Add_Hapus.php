    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Dokumen</label></div>
                    <div class="col-sm-8">
                        <input id="no_dokumen" name="no_dokumen" type="text" class="form-control" style="width:80%;" readonly>
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
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>UNIT</label></div>
                    <div class="col-sm-8">
                        <input id="kd_unit" name="kd_unit" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-md-6">
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal Dokumen</label></div>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <input id="tgl_dokumen" name="tgl_dokumen" type="text" class="form-control" style="width:100%;">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tahun Rencana</label></div>
                    <div class="col-sm-8">
                        <input id="tahun_rencana" name="tahun_rencana" type="text" class="form-control" style="width:30%;">
                    </div>
                </div>
            </div> 
            
        </div>
    </div>
<div style="padding-bottom: 20px;">
    <button type="button" class="btn btn-default btn-lg btn-block" id="btn_tambah" onClick="javascript:tambahrincian();">Tambah Rencana Barang</button>
</div>
<!--
<div class="col-sm-8">
	<div class="box-header">
		<div class="col-sm-3"><div class="gbr1"></div><a>Mutasi Belum ditetapkan</a></div>
		<div class="col-sm-3"><div class="gbr2"></div><a>Mutasi Sudah ditetapkan</a></div>
		<div class="col-sm-3"><div class="gbr3"></div><a>Mutasi Ditolak</a></div>
	</div>
</div>
<div class="alenia"></div>
-->
<style>
.alenia {height:70px;}
.gbr1{ width: 60px; height: 20px; -webkit-transform: skew(20deg); -moz-transform: skew(20deg); -o-transform: skew(20deg); background: #D3D3D3; }
.gbr2{ width: 60px; height: 20px; -webkit-transform: skew(20deg); -moz-transform: skew(20deg); -o-transform: skew(20deg); background: #90EE90; }
.gbr3{ width: 60px; height: 20px; -webkit-transform: skew(20deg); -moz-transform: skew(20deg); -o-transform: skew(20deg); background: #FFB6C1; }

sm-3 {
    width: 20% !important;
}

</style>	
<table id="trd" name="trd"></table> <!-- Table TRD Home -->

<div class="row" id="sum_show">
    <div class="col-md-5 text-right col-md-offset-4">
        <h4><span>Total : </span></h4>
    </div>
    <div class="col-md-3 text-left">
        <h4><span id="total_s1"></span></h4>
    </div>
</div>

<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="text" class="btn btn-default btn-lg btn-block" id="btn_simpan" onClick="javascript:saveData();">Simpan</button>
    </div>
    <div class="col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Kembali</button>
    </div>
</div>
<style>

.popdg {
    width: 33% !important;
}	
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: 20px !important;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
}

</style>
<div id="dlg" class="easyui-dialog" style="width:1100px" closed="true" buttons="#dlg-buttons">
        <div class="row" style="width: 100%">
		<form id="popfm" method="post" novalidate style="padding: 8px;" enctype="multipart/form-data">
            <div class="popdg col-md-5">
                 
                <div style="margin-bottom:10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Kelompok</label></div>
                        <div class="col-sm-7">
                            <input id="kelompok" name="kelompok" type="text" class="form-control" style="width:100%;">
                        </div>
                    </div> 
                </div>
                <div style="margin-bottom:10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Jenis Barang</label></div>
                        <div class="col-sm-7">
                            <input id="jenis" name="jenis" type="text" class="form-control" style="width:100%;">
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Kode Barang</label></div>
                        <div class="col-sm-7">
                            <input id="kd_brg" name="kd_brg" type="text" class="form-control" data-options="required:true" style="width:100%">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Nama Barang</label></div>
                        <div class="col-sm-7">
							<span id="nm_brg" name="nm_brg" ></span>
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px" hidden="true">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Satuan</label></div>
                        <div class="col-sm-7">
                            <input id="satuan" name="satuan" class="form-control" style="width: 50%">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px"  hidden="true">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Kode Rekening</label></div>
                        <div class="col-sm-7">
                            <input id="kd_rek5" name="kd_rek5" class="form-control" style="width: 50%">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px" hidden="true">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Nama Rekening</label></div>
                        <div class="col-sm-7">
                            <span id="nm_rek" name="nm_rek" style="width: 100%"></span>
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px" hidden="true">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Merk</label></div>
                        <div class="col-sm-7">
                            <input id="merk" name="merk" class="form-control" style="width: 100%">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Jumlah</label></div>
                        <div class="col-sm-7">
                            <input id="jml" name="jml" class="form-control" onkeypress="return isNumberKey(event)" style="width: 100%; text-align: right;" 
                            onkeyup="hitung();" >
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Harga Satuan</label></div>
                        <div class="col-sm-7">
                            <input id="hrg" name="hrg" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 100%; text-align: right;" 
                            onkeyup="hitung();">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Total Harga</label></div>
                        <div class="col-sm-7">
                            <input id="total" name="total" class="form-control" style="width: 100%; text-align: right;" readonly="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">                    
                        <table id="dg"></table>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-10">
                            <p class="text-right"><b>Total : </b></p>
                        </div>
                        <div class="col-sm-2">
							<b><span id="total_s2"></span></b>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-8">
				<div class="row" style="padding-top: 10px;">
					<div class="col-sm-12">
						
						<div class="col-sm-2">
							<p class="text-right"><b>Alasan Penghapusan</b></p>
						</div>
						<div class="col-sm-5">
                            <textarea id="keterangan" name="keterangan" class="form-control" style="width: 750px; height: 40px;"></textarea>
							<input id="idbrg" name="idbrg" class="form-control" type="hidden" style="width: 100%; hide">
						</div>
					</div>
				</div>
			</div>
			<div></div>
			</form>
        </div>
</div>

<div id="dlg-buttons">
   <!-- <a type="submit" href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Simpan</a> -->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="savedetail()" style="width:90px">Tampung</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Kembali</a>
</div>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

    var tgl_dokumen     = document.getElementById('tgl_dokumen');
    var no_dokumen      = document.getElementById('no_dokumen');
    var tahun_rencana   = document.getElementById('tahun_rencana');
    var jml             = document.getElementById('jml');
    var hrg             = document.getElementById('hrg'); 
    var total           = document.getElementById('total_s1');
    var nm_brg          = document.getElementById('nm_brg');
    var total_dlg       = document.getElementById('total');
    var brg_dlg         = document.getElementById('brg_dlg'); 
    var xtbl            = '';

    window.onload = function(){
        cekOtori();
        var status  = localStorage.getItem('status');

        if (status == 'detail') {
			var status	= status;
			localStorage.setItem('status', status);
            var kd_usk  = localStorage.getItem('kd_skpd');
            var xkd_unit  = localStorage.getItem('kd_unit');
            var nm_usk  = localStorage.getItem('nm_uskpd');
            var no_dok  = localStorage.getItem('no_dokumen');
            var tahun   = localStorage.getItem('tahun');
            var tanggal = localStorage.getItem('tanggal');   
            var xkd = localStorage.getItem('xkd');   
            if(xkd==1){
                $("#btn_simpan").prop('disabled',true);
                $("#btn_tambah").prop('disabled',true);
            }
            tgl_dokumen.value   = tanggal;
            no_dokumen.value    = no_dok;
            tahun_rencana.value = tahun; 
            $("#kd_unit").combogrid({
                    url: '<?php echo base_url(); ?>transaksi/C_Hapus/getUnit',
                    queryParams : ({kd:kd_usk}),
               });
            $('#kd_skpd').combogrid('setValue', kd_usk); 
            $('#kd_unit').combogrid('setValue', xkd_unit); 
            load_detail();
        }else{
			max_number();
			var status	= status;
			localStorage.setItem('status', status);
            var kd_usk  = localStorage.getItem('kd_skpd');
            var no_dok  = localStorage.getItem('no_dokumen');
            var tahun   = localStorage.getItem('tahun');
            var tanggal = localStorage.getItem('tanggal');       
           // tgl_dokumen.value   = tanggal;
            no_dokumen.value    = no_dok;
            tahun_rencana.value = tahun;
            $('#kd_skpd option:selected').combogrid('setValue', kd_usk); 
		}
    }

    function cekOtori(){
        var otori = "<?php echo $this->session->userdata['oto'];?>";
        if(otori!='01'){
            var zskpd = "<?php echo $this->session->userdata['kd_skpd'];?>";
            var zunit = "<?php echo $this->session->userdata['kd_unit'];?>";
            $("#kd_unit").combogrid({
                    url: '<?php echo base_url(); ?>transaksi/C_Hapus/getUnit',
                    queryParams : ({kd:zskpd}),
               });
            
            $('#kd_skpd').combogrid({readonly: true}).combogrid('setValue', zskpd);
            $('#kd_unit').combogrid({readonly: true}).combogrid('setValue', zunit); 
        }
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_Hapus";
    }

    function max_number(){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_Hapus/max_number',
            data: ({table:'transaksi.trh_hapus',kolom:'no_dokumen'}),
            dataType:"json",
            success:function(data){
                                    
                    no_dokumen.value = data;
              
            }
        }); 
    }

    function tambahrincian() {
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
        }
    }

	function saveData(){
		var no_dokumen 	= $('#no_dokumen').val();
		var tgl_dokumen	= $('#tgl_dokumen').val();
        var kd_skpd     = $('#kd_skpd').val();
        var kd_unit     = $('#kd_unit').val();
		var tabel 	   = xtbl;
		var tahun		= $('#tahun_rencana').val(); 
		var total		= angka($('#total_s1').text());
		var status		= localStorage.getItem('status');
		var data1 		= $('#trd').datagrid('getRows');
      
		$.post('<?php echo base_url(); ?>transaksi/C_Hapus/saveData', {detail: JSON.stringify(data1),no_dok:no_dokumen,tgl_dok:tgl_dokumen,kd_skpd:kd_skpd,kd_unit:kd_unit,tahun:tahun,total:total,status:status,tabel:tabel}, function(result) {
		if (result.notif){
				iziToast.success({
					title: 'OK',
					message: result.message,
				});
			} else {
				iziToast.error({
					title: 'Error',
					message: result.message,
				});
			}
		}, "json");
	}
	
    function hitung() {
        var a = angka($('#jml').val());
        var b = angka($('#hrg').val());
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
            url: '<?php echo site_url('transaksi/C_Hapus/trd_hapus') ?>',
            type: 'POST',
            dataType: 'json',
            data: {no: nomor, kode: kode},
            success: function(data) {
                // console.log(data);
                $.each(data,function(i,n){                                    
                id      = n['id_barang'];                                      
                no      = n['no_dokumen'];                                                                 
                kd      = n['kd_brg'];                                                                                       
                r5      = n['kd_rek5'];
                nm      = n['nm_brg'];
                mrk     = n['merek'];                        
                jml     = n['jumlah'];                         
                hrg     = n['harga']; 
                tot     = n['total']; 
                sum     = n['sum'];                         
                ket     = n['ket'];             
                satuan  = n['satuan'];                        
                no_urut = n['no_urut'];                   
                cad 	= n['cad'];   
                $('#trd').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        id_barang:id,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        total:tot,
                        ket:ket, 
                        no_urut:no_urut });  
				
				$('#dg').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        id_barang:id,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        total:tot,
                        ket:ket, 
                        no_urut:no_urut });
						
                total.textContent = number_format(sum, 2,'.',',');
            });
            }
        });    
    }
	function savedetail(){ 
		var no = $('#no_dokumen').val();  
		var r5 = $('#kd_rek5').val();
		var kd = $('#kd_brg').val();
		var nm = $('#nm_brg').text();
		var mrk= $('#merk').val();
		var satuan = $('#satuan').val();
		var jml= $('#jml').val();
		var hrg= $('#hrg').val();
		var tot= $('#total').val();
		var ket= $('#keterangan').val();
		var no_urut= '';//$('#no_dokumen').val();
		var tot_s1 = angka($('#total_s1').text());
		var tot_s2 = angka($('#total_s2').text());
		var id	= $('#idbrg').val(); 
			$('#trd').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        id_barang:id,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        total:tot,
                        ket:ket, 
                        no_urut:no_urut });  
				
				$('#dg').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        id_barang:id,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        total:tot,
                        ket:ket, 
                        no_urut:no_urut });
				$('#popfm').form('clear');
				$('#nm_brg').text("");
				$('#nm_skpd_tuju').text("");
                total_s1.textContent = number_format(tot_s1 + angka(tot), 2,'.',',');
                total_s2.textContent = number_format(tot_s2 + angka(tot), 2,'.',',');
		
	}
	
	/*****edit data*****/
	function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row'); 
        return parseInt(tr.attr('datagrid-row-index'));
    }
    function editrow(target){
        $('#trd').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterow(target){
		$('#trd').datagrid('endEdit', getRowIndex(target));
        $.messager.confirm('Confirm','Are you sure?',function(r){
            if (r){
                $('#trd').datagrid('deleteRow', getRowIndex(target));
            }
        });
    }
    function saverow(target){
        $('#trd').datagrid('endEdit', getRowIndex(target));
    }
    function cancelrow(target){
        $('#trd').datagrid('cancelEdit', getRowIndex(target));
    }
	
	
	/********************/
    $(document).ready(function() {
		var lastIndex;
        $('#trd').datagrid({
			idField:'no_dokumen',
            width:1000,
            height:300,
            rownumbers:true,
            singleSelect:true,
            fitColumns:false,
            pagination:true,
			//showFooter:true,
			nowrap:true,
			remoteSort:true,       
			rowStyler: function(index,row){
			if (row.cad == 0){
					return 'background-color:#D3D3D3;color:#fff;';
				}
			},
            url: '<?php echo base_url(); ?>transaksi/C_Hapus/trd_hapus',
            loadMsg:"Tunggu Sebentar....!!",    
			frozenColumns:[[
            {field:'action',title:'Aksi',width:90,align:'center',
                formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<a href="javascript:void(0)" onclick="saverow(this)"><i class="fa fa-check-square" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                        var c = '<a href="javascript:void(0)" onclick="cancelrow(this)"><i class="fa fa-undo" aria-hidden="true"></i></a>';
                        return s+c;
                    } else {
                        var e = '<a href="javascript:void(0)" onclick="editrowd(this)"><i class=" " aria-hidden="true"></i></a>&nbsp;&nbsp;';
                        var d = '<a href="javascript:void(0)" onclick="deleterow(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                        return e+d;
                    }
                }
            },
			
                //{field:'ck',title:'',width:1,align:'center',checkbox:true},
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'id_barang', title:'ID', width:150, align:"left",editor:'text',hidden:true},
                {field:'nm_brg',title:'Nama Barang',width:275,align:"left"},
			]], 
            columns:[[
                {field:'merek', title:'Merek', width:150, align:"left",editor:'text',hidden:true},
                {field:'satuan',title:'Satuan',width:125,align:"left",editor:'text',hidden:true},
                {field:'jumlah',title:'Jumlah',width:125,align:"left",editor:'numberbox'},
                {field:'harga',title:'Harga',width:125,align:"right",editor:{type:'numberbox',options:{precision:2}}},
                {field:'total',title:'Total',width:125,align:"right",editor:{type:'numberbox',options:{readonly:true}}},
                {field:'ket',title:'Keterangan',width:150,align:"left",editor:'text'} 
            ]],
         onEndEdit:function(index,row){
            var ed = $(this).datagrid('getEditor', {
                index: index,
                field: 'no_dokumen'
            });
        },
		onBeforeEdit:function(index,row){
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }, 
		onClickRow:function(rowIndex){ 
        if (lastIndex != rowIndex){
            $(this).datagrid('endEdit', lastIndex);
        }
        lastIndex = rowIndex;
		},
		onBeginEdit:function(rowIndex){      
        var editors = $('#trd').datagrid('getEditors', rowIndex);
        var v1 = $(editors[2].target);
        var v2 = $(editors[3].target);
        var v3 = $(editors[4].target);
		
        v1.add(v2.add(v3)).numberbox({
            onChange:function(){
				var jumlah = v1.numberbox('getValue');
				var harga  = v2.numberbox('getValue');
                var cost = jumlah*harga;
                v3.numberbox('setValue',cost);
            }
        })
		},onLoadSuccess:function(data) {
			  var sum = 0;
			  for (i = 0; i < data.length; i++) {
				 sum+=data[i].total;
			  }
			  total_s1.textContent=number_format(sum,2,'.',',');
		}
		
        });

		
        $('#dg').datagrid({
            width: '115%',
            height: '300',
            rownumbers: true,
            remoteSort: false,
            nowrap: true,
            pagination: true,
            // url: ,       
			rowStyler: function(index,row){
			if (row.cad == 0){
					return 'background-color:#D3D3D3;color:#fff;';
				}
			},
            loadMsg: 'Tunggu Sebentar ... !',
			frozenColumns:[[
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'id_barang', title:'ID', width:150, align:"left",hidden:true},
                {field:'nm_brg',title:'Nama Barang',width:255,align:"left"},
			]],
            columns:[[
                {field:'merek', title:'Merek', width:150, align:"left",hidden:true},
                {field:'satuan',title:'Satuan',width:125,align:"left",hidden:true},
                {field:'jumlah',title:'Jumlah',width:125,align:"left"},
                {field:'harga',title:'Harga',width:125,align:"left"},
                {field:'total',title:'Total',width:125,align:"left"},
                {field:'ket',title:'Keterangan',width:150,align:"left"}, 
                {field:'ck',title:'',width:1,align:'center',checkbox:true}
            ]]

        });

        $('#tahun_rencana').datepicker({
            minViewMode: 'years',
            autoclose: true,
            format: 'yyyy'
          });
		  
        $('#tgl_dokumen').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
        });
		
        $('#tgl_dokumen').val(getToday());

        $('#kd_skpd').combogrid({
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'nm_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Hapus/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               kd = rowData.kd_skpd;
               nm = rowData.nm_skpd; 
               $("#kd_unit").combogrid({
                    url: '<?php echo base_url(); ?>transaksi/C_Hapus/getUnit',
                    queryParams : ({kd:kd}),
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
               kdU = rowData.kd_unit;
               nmU = rowData.nm_unit;  
				
		   }  
        });

        $('#skpd_tujuan').combogrid({
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Hapus/getSkpd_tuju',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               kd = rowData.kd_skpd;
               nm = rowData.nm_skpd;
			   nm_skpd_tuju.textContent = nm;
		   }  
        });
		 
	$('#kelompok').combogrid({
            panelWidth:600,  
            idField:'kelompok',  
            textField:'kelompok',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Hapus/getKelompok',
            columns:[[  
               {field:'kelompok',title:'KODE KELOMPOK',width:200},  
               {field:'nm_kelompok',title:'NAMA KELOMPOK',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               kel = rowData.kelompok;	
					$('#jenis').combogrid({
						panelWidth:700,  
						idField:'tabel',  
						textField:'jenis',  
						mode:'remote',
						url: '<?php echo base_url(); ?>transaksi/C_Hapus/getJenis',
						queryParams:({kel: kel}),
						columns:[[  
						   {field:'jenis',title:'KODE JENIS',width:200},  
						   {field:'nm_jenis',title:'NAMA JENIS',width:400}    
						]],  
						onSelect:function(rowIndex,rowData){
                           xtbl = rowData.tabel;
						   jen = rowData.jenis;
						   unit = $('#kd_unit').val();
						   $('#kd_brg').combogrid({
								url: '<?php echo base_url(); ?>transaksi/C_Hapus/getBarang',
								queryParams:({kod: jen,unit: unit}),
								idField: 'kd_brg',
								textField: 'kd_brg',
								mode: 'remote',
								panelWidth: 850,
								columns:[[
									{field:'no_reg',title:'Reg',width:90},
									{field:'kd_brg',title:'Kode Barang',width:160},  
									{field:'nm_brg',title:'Nama Barang',width:250},  
									{field:'nilai',title:'Nilai',width:110,align:'right'},  
									{field:'ket',title:'Keterangan',width:300,align:'left'}    
								]],
								onSelect:function(rowIndex, rowData) {
									nm_brg.textContent = rowData.nm_brg;
									id = rowData.id_barang;
									$('#idbrg').val(id);
								    $('#jml').val(rowData.jml).attr("disabled", "disabled");
								    $('#hrg').val(number_format(rowData.nilai,2,'.',',')).attr("disabled", "disabled");
								    $('#total').val(number_format(rowData.nilai,2,'.',',')).attr("disabled", "disabled");
									$('#satuan').combogrid({url: '<?php echo base_url(); ?>transaksi/C_Hapus/getSatuan'});

								}
							});
						}  
					});
				}  
			});

        $('#satuan').combogrid({
            panelWidth:350,  
            idField:'nm_satuan',  
            textField:'nm_satuan',  
            mode:'remote',
            //url:'<?php echo base_url(); ?>transaksi/C_Hapus/getSatuan',  
            columns:[[  
               {field:'kd_satuan',title:'KODE SATUAN',width:150},  
               {field:'nm_satuan',title:'SATUAN',width:200}    
            ]]
        });
		

    });
</script>