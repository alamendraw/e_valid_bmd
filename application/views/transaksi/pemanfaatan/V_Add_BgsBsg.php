
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Dokumen</label></div>
                    <div class="col-sm-8">
                        <input id="no_dokumen" name="no_dokumen" type="text" class="form-control" style="width:80%;">
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tahun Rencana</label></div>
                    <div class="col-sm-8">
                        <input id="tahun_rencana" name="tahun_rencana" type="text" class="form-control" style="width:30%;">
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nama SKPD</label></div>
                    <div class="col-sm-8">
                        <input id="nm_skpd" name="nm_skpd" type="text" class="form-control" readonly="true" style="width:100%;border:none;">
                    </div>
                </div>
            </div>
           <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Program Kerja</label></div>
                    <div class="col-sm-8">
                        <input id="program" name="program" type="text" class="easyui-textbox" style="width:80%;">
						<span id="nmprog" name="nmprog" ></span>
					</div>
                </div>
            </div> 
        </div>
    </div>
<div style="padding-bottom: 20px;">
    <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:tambahrincian();">Tambah Rencana Barang</button>
</div>

<table id="trd" name="trd"></table> <!-- Table TRD Home -->

<div class="row" id="sum_show">
    <div class="col-md-5 text-right col-md-offset-4">
        <h4><span>Total BGS/BSG: </span></h4>
    </div>
    <div class="col-md-3 text-left">
        <h4><span id="total_s1"></span></h4>
    </div>
</div>

<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="text" class="btn btn-default btn-lg btn-block" onClick="javascript:saveData();">Simpan</button>
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
                        <div class="col-sm-5"><label>Kegiatan</label></div>
                        <div class="col-sm-7">
                            <input id="kegiatan" name="kegiatan" type="text" class="form-control" style="width:100%;">
                        </div>
                    </div>
                </div>
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
                <div class="hide" style="margin-bottom: 10px">
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
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Merk</label></div>
                        <div class="col-sm-7">
                            <input id="merk" type="text" name="merk" class="easyui-textbox" style="width: 100%;readonly:true;">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Jumlah</label></div>
                        <div class="col-sm-7">
                            <input id="jml" type="text" name="jml" class="easyui-textbox" onkeypress="return isNumberKey(event)" style="width: 100%; text-align: right;readonly:true;" 
                            onkeyup="hitung();" >
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Harga Perolehan</label></div>
                        <div class="col-sm-7">
                            <input id="hrg" type="text" name="hrg" class="easyui-textbox" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 100%; text-align: right;readonly:true;" 
                            onkeyup="hitung();">
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Total Harga</label></div>
                        <div class="col-sm-7">
                            <input id="total" type="text" name="total" class="easyui-textbox" style="width: 100%; text-align: right;readonly:true;" readonly="true">
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Nilai BGS/BSG</label></div>
                        <div class="col-sm-7">
							<input id="hrg_pelihara" name="hrg_pelihara" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width: 100%; text-align: right;">						
							</div>
                    </div>
                </div>
			</form>
            </div>
            <div class="col-md-8">
                <div class="row">                    
                        <table id="dg"></table>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-10">
                            <p class="text-right"><b>Total BGS/BSG: </b></p>
                        </div>
                        <div class="col-sm-2">
							<b><span id="total_s2"></span></b>
                        </div>
                    </div>
                </div>
            </div>            
			<div class="col-md-8">
                <div class="row" style="padding-top: 10px;">   
					<div class="col-sm-12" style="padding-bottom: 10px;">					
                        <div class="col-sm-3"><label>Uraian BGS/BSG</label></div>
                        <div class="col-sm-8">
                            <textarea id="keterangan" name="keterangan" class="form-control" style="width: 100%"></textarea>
                        </div>
                    </div>
                </div>
            </div>
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
    var nm_skpd         = document.getElementById('nm_skpd');
    var total           = document.getElementById('total_s1');
    var nm_brg          = document.getElementById('nm_brg');
    var total_dlg       = document.getElementById('total');
    var brg_dlg         = document.getElementById('brg_dlg');
    var program         = document.getElementById('program');

    window.onload = function(){

        var status  = localStorage.getItem('status');

        if (status == 'detail') {
			var status	= status;
			localStorage.setItem('status', status);
            var kd_usk  = localStorage.getItem('kd_uskpd');
            var nm_usk  = localStorage.getItem('nm_uskpd');
            var no_dok  = localStorage.getItem('no_dokumen');
            var tahun   = localStorage.getItem('tahun');
            var tanggal = localStorage.getItem('tanggal');  
            var program = localStorage.getItem('program');  
            tgl_dokumen.value   = tanggal;
            no_dokumen.value    = no_dok;
            tahun_rencana.value = tahun;
			nm_skpd.value		= nm_usk;
            $('#kd_skpd').combogrid('setValue', kd_usk);
            $('#program').combogrid('setValue', program);
            load_detail();
        }else{
			max_number();
			var status	= status;
			localStorage.setItem('status', status);
            var kd_usk  = localStorage.getItem('kd_uskpd');
            var no_dok  = localStorage.getItem('no_dokumen');
            var tahun   = localStorage.getItem('tahun');
            var tanggal = localStorage.getItem('tanggal');      
            var program = localStorage.getItem('program');   
            tgl_dokumen.value   = tanggal;
            no_dokumen.value    = no_dok;
            tahun_rencana.value = tahun;
            $('#kd_skpd option:selected').combogrid('setValue', kd_usk);
            $('#program').combogrid('setValue', program);
		}
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_BgsBsg";
    }

    function max_number(){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/max_number',
            data: ({table:'transaksi.trh_bgsbsg',kolom:'no_dokumen'}),
            dataType:"json",
            success:function(data){
                   
                $.each(data,function(i,n){                                    
                    max = Number(n['no_urut'])+1;                   
                    nom = String('000' + max).slice(-4);                    
                    no_dokumen.value = nom;
                });
            }
        }); 
    }

    function tambahrincian() {
        if (no_dokumen.value == "" || 
            $('#kd_skpd').combogrid('getValue') == "" || 
            tahun_rencana.value == "" || 
            tgl_dokumen.value == "" ||
			$('#program').combogrid('getValue') == "") {

                iziToast.error({
                    title: 'Error',
                    message: 'Field No. Dokumen, SKPD, Program, Tahun Rencana, Tanggal Dokumen Harus Terisi.!',
                });
        } else {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
        }
    }

	function saveData(){
		var no_dokumen 	= $('#no_dokumen').val();
		var tgl_dokumen	= $('#tgl_dokumen').val();
		var kd_skpd 	= $('#kd_skpd').val();
		var tahun		= $('#tahun_rencana').val();
		var program		= $('#program').val();
		var total		= angka($('#total_s1').text());
		var status		= localStorage.getItem('status');
		var data1 		= $('#trd').datagrid('getRows');
		$.post('<?php echo base_url(); ?>transaksi/C_BgsBsg/saveData', {detail: JSON.stringify(data1),no_dok:no_dokumen,tgl_dok:tgl_dokumen,kd_skpd:kd_skpd,tahun:tahun,program:program,total:total,status:status}, function(result) {
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
            url: '<?php echo site_url('transaksi/C_BgsBsg/trd_bgsbsg') ?>',
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
                hrg     = n['harga'];//number_format(n['harga'],2,'.',',');
                bp     	= n['biaya_bgsbsg'];
                up     	= n['uraian_bgsbsg'];
                //tot     = n['total'];//number_format(n['total'],2,'.',',');
                sum     = n['sum'];                         
                ket     = n['ket'];             
                satuan  = n['satuan'];             
                kd_keg  = n['kd_kegiatan'];                
                no_urut = n['no_urut'];      
                $('#trd').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        kd_rek5:r5,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        biaya_bgsbsg:bp,
                        uraian_bgsbsg:up,
                        //ket:ket,
						kd_kegiatan:kd_keg,
                        no_urut:no_urut });  
				
				$('#dg').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        kd_rek5:r5,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        biaya_bgsbsg:bp,
                        uraian_bgsbsg:up,
                        //ket:ket,
						kd_kegiatan:kd_keg,
                        no_urut:no_urut });
						
                total.textContent = number_format(sum, 2,'.',',');
            });
            }
        });    
    }
	function savedetail(){
		var kd_keg = $('#kegiatan').val();
		var no = $('#no_dokumen').val();
		var prog = $('#program').val();
		var keg  = $('#kegiatan').val();
		var r5 = $('#kd_rek5').val();
		var kd = $('#kd_brg').val();
		var nm = $('#nm_brg').text();
		var mrk= $('#merk').val();
		var satuan = $('#satuan').val();
		var jml= $('#jml').val();
		var hrg= $('#hrg').val();
		var tot= $('#total').val();
		var bp= $('#hrg_pelihara').val();
		var ket= $('#keterangan').val();
		var no_urut= '';//$('#no_dokumen').val();
		var tot_s1 = angka($('#total_s1').text());
		var tot_s2 = angka($('#total_s2').text());
			$('#trd').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        kd_rek5:r5,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        biaya_bgsbsg:bp,
                        uraian_bgsbsg:ket,
                        //ket:ket,
						kd_kegiatan:kd_keg,
                        no_urut:no_urut });  
				
				$('#dg').datagrid('appendRow',
                    {no_dokumen:no,
                        kd_brg:kd,
                        kd_rek5:r5,
                        nm_brg:nm,
                        merek:mrk,
                        satuan:satuan,
                        jumlah:jml,
                        harga:hrg,
                        biaya_bgsbsg:bp,
                        uraian_bgsbsg:ket,
                        //ket:ket,
						kd_kegiatan:kd_keg,
                        no_urut:no_urut });
				
				$('#popfm').form('clear');
				$('#nm_brg').text("");
				$('#keterangan').text("");
				
                total_s1.textContent = number_format(tot_s1 + angka(bp), 2,'.',',');
                total_s2.textContent = number_format(tot_s2 + angka(bp), 2,'.',',');
		
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
            url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/trd_bgsbsg',
            loadMsg:"Tunggu Sebentar....!!",    
			frozenColumns:[[
            {field:'action',title:'Aksi',width:100,align:'center',
                formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<a href="javascript:void(0)" onclick="saverow(this)"><i class="fa fa-check-square" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                        var c = '<a href="javascript:void(0)" onclick="cancelrow(this)"><i class="fa fa-undo" aria-hidden="true"></i></a>';
                        return s+c;
                    } else {
                        var e = '<a href="javascript:void(0)" onclick="editrow(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                        var d = '<a href="javascript:void(0)" onclick="deleterow(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                        return e+d;
                    }
                }
            },
			
                //{field:'ck',title:'',width:1,align:'center',checkbox:true},
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:275,align:"left"},
			]], 
            columns:[[
                {field:'merek', title:'Merek', width:150, align:"left"},
                {field:'satuan',title:'Satuan',width:125,align:"left"},
                {field:'jumlah',title:'Jumlah',width:125,align:"left"},
                {field:'harga',title:'Harga',width:125,align:"right",editor:{type:'numberbox',options:{readonly:true}}},
                {field:'biaya_bgsbsg',title:'Biaya BgsBsg',width:125,align:"right",editor:{type:'numberbox',options:{precision:2}}},
                {field:'uraian_bgsbsg',title:'Uraian',width:150,align:"left",editor:'text'},
                {field:'kd_kegiatan',title:'Kegiatan',width:150,align:"left"}
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
        /*var editors = $('#trd').datagrid('getEditors', rowIndex);
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
        }) */
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
            loadMsg: 'Tunggu Sebentar ... !',
			frozenColumns:[[
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:255,align:"left"},
			]],
            columns:[[
                {field:'merek', title:'Merek', width:150, align:"left"},
                {field:'satuan',title:'Satuan',width:125,align:"left"},
                {field:'jumlah',title:'Jumlah',width:125,align:"left"},
                {field:'harga',title:'Harga',width:125,align:"left"},
                {field:'biaya_bgsbsg',title:'Biaya BgsBsg',width:125,align:"left"},
                {field:'uraian_bgsbsg',title:'Uraian',width:150,align:"left"},
                {field:'kd_kegiatan',title:'Kegiatan',width:150,align:"left"},
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
            textField:'kd_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               kd = rowData.kd_skpd;
               nm = rowData.nm_skpd;
               $('#nm_skpd').val(nm);
			  /*  var ab = $('#kd_skpd').combogrid('grid'); 
					ab.datagrid('getSelected'); */
			   $('#program').combogrid({url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getProgram',queryParams:({kode:kd})});
				//g.combogrid('getSelected'); 
				
				//var g = $('#cc').combogrid('grid');	// get datagrid object
				//var r = g.datagrid('getSelected');	
				
		   }  
        });

		
		$('#program').combogrid({
            panelWidth:600,  
            idField:'kd_program',  
            textField:'kd_program',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getProgram',
            columns:[[  
               {field:'kd_program',title:'KODE PROGRAM',width:200},  
               {field:'nm_program',title:'NAMA PROGRAM',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               nm = rowData.nm_program;
			   kd = rowData.kd_program;
			   nmprog.textContent = nm;
					$('#kegiatan').combogrid({
						panelWidth:600,  
						idField:'kd_kegiatan',  
						textField:'kd_kegiatan',  
						mode:'remote',
						url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getKegiatan',
						queryParams:({kode:kd}),
						columns:[[  
						   {field:'kd_kegiatan',title:'KODE KEGIATAN',width:200},  
						   {field:'nm_kegiatan',title:'NAMA KEGIATAN',width:400}    
						]],  
						onSelect:function(rowIndex,rowData){
						   kd = rowData.kd_kegiatan;
						   $('#kegiatan').val(kd);
							$('#kelompok').combogrid({url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getKelompok'});
						}  
					});
            }  
        });
		
		
		
	$('#kelompok').combogrid({
            panelWidth:600,  
            idField:'kelompok',  
            textField:'kelompok',  
            mode:'remote',
            //url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getKelompok',
            columns:[[  
               {field:'kelompok',title:'KODE KELOMPOK',width:200},  
               {field:'nm_kelompok',title:'NAMA KELOMPOK',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               kel = rowData.kelompok;	
					$('#jenis').combogrid({
						panelWidth:700,  
						idField:'jenis',  
						textField:'jenis',  
						mode:'remote',
						url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getJenis',
						queryParams:({kel: kel}),
						columns:[[  
						   {field:'jenis',title:'KODE JENIS',width:200},  
						   {field:'nm_jenis',title:'NAMA JENIS',width:400}    
						]],  
						onSelect:function(rowIndex,rowData){
						   jen = rowData.jenis;
						   var skpd = $('#kd_skpd').val();
						   switch (jen) {
								case '131':
									tabel = "trkib_a";
									break;
								case '132':
									tabel = "trkib_b";
									break;
								case '133':
									tabel = "trkib_c";
									break;
								case '134':
									tabel = "trkib_d";
									break;
								case '135':
									tabel = "trkib_e";
									break;
								case '136':
									tabel = "trkib_f";
									break;
								default:
									tabel = "trkib_g";
							}
						   $('#kd_brg').combogrid({
								url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getBarang',
								queryParams:({kod: jen,tabel:tabel,skpd:skpd}),
								idField: 'kd_brg',
								textField: 'kd_brg',
								mode: 'remote',
								panelWidth: 600,
								columns:[[
									{field:'kd_brg',title:'Kode Barang',width:150},  
									{field:'nm_brg',title:'Nama Barang',width:400}    
								]],
								onSelect:function(rowIndex, rowData) {
									nm_brg.textContent = rowData.nm_brg;
									$('#merk').textbox('setValue', rowData.merek).textbox({disabled: true});
									$('#jml').textbox('setValue', rowData.jumlah).textbox({disabled: true});
									$('#hrg').textbox('setValue', rowData.nilai).textbox({disabled: true});
									$('#total').textbox('setValue', rowData.total).textbox({disabled: true});
									keterangan.textContent = rowData.keterangan; 
									$('#satuan').combogrid({url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/getSatuan'});

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
            //url:'<?php echo base_url(); ?>transaksi/C_BgsBsg/getSatuan',  
            columns:[[  
               {field:'kd_satuan',title:'KODE SATUAN',width:150},  
               {field:'nm_satuan',title:'SATUAN',width:200}    
            ]]
        });
		

    });
</script>