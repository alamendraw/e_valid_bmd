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
            
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Pilih KIB</label></div>
                    <div class="col-sm-8"> 
                        <select id="kib" name="kib" class="form-control" style="width:50%;">
                            <option value="">--Pilih KIB--</option>
                            <option value="trkib_a">KIB A (TANAH)</option>
                            <option value="trkib_b">KIB B (PERALATAN DAN MESIN)</option>
                            <option value="trkib_c">KIB C (GEDUNG DAN BANGUNAN)</option>
                            <option value="trkib_d">KIB D (JALAN, JARINGAN DAN IRIGASI)</option>
                            <option value="trkib_e">KIB E (ASET TETAP LAINNYA)</option>
                            <option value="trkib_f">KIB F (KONTRUKSI DALAM PENGERJAAN)</option>
                        </select>
                    </div>
                </div>
            </div>     
        </div>

        <div class="col-md-6"> 
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
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Unit</label></div>
                    <div class="col-sm-8">
                        <input id="kd_unit" name="kd_unit" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div> 
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>SKPD Baru</label></div>
                    <div class="col-sm-8">
                        <input id="kd_skpd_baru" name="kd_skpd_baru" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Unit Baru</label></div>
                    <div class="col-sm-8">
                        <input id="kd_unit_baru" name="kd_unit_baru" type="text" class="easyui-textbox" style="width:80%;">
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
             
            <div class="col-md-11">
                <div class="row">                    
                        <table id="dg"></table>
                </div>
                
            </div>  
			</form>
        </div>
</div>

<div id="dlg-buttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="savedetail()" style="width:90px">Tampung</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Kembali</a>
</div>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

    var tgl_dokumen     = document.getElementById('tgl_dokumen');
    var no_dokumen      = document.getElementById('no_dokumen');
    var tahun_rencana   = document.getElementById('tahun_rencana');   
    var total           = document.getElementById('total_s1'); 
    var brg_dlg         = document.getElementById('brg_dlg'); 
    var kib             = document.getElementById('kib'); 

    window.onload = function(){

        var status  = localStorage.getItem('status');

        if (status == 'detail') { 
			var status	= status;
			localStorage.setItem('status', status);

            var Qno_dokumen     = localStorage.getItem('no_dokumen');
            var Qtgl_dokumen    = localStorage.getItem('tgl_dokumen');
            var Qkd_unit        = localStorage.getItem('kd_unit');
            var Qkd_skpd        = localStorage.getItem('kd_skpd');
            var Qtahun          = localStorage.getItem('tahun');
            var Qtotal          = localStorage.getItem('total');
            var Qkd_unit_baru   = localStorage.getItem('kd_unit_baru');
            var Qkd_skpd_baru   = localStorage.getItem('kd_skpd_baru');
            var Qtabel          = localStorage.getItem('tabel');
            var Qxkd            = localStorage.getItem('xkd');
            if(Qxkd==1){
                $("#btn_simpan").prop('disabled',true);
                $("#btn_tambah").prop('disabled',true);    
            }
            
            getUnit(Qkd_unit);
            getUnitBaru(Qkd_unit_baru); 
            tgl_dokumen.value   = Qtgl_dokumen;
            kib.value           = Qtabel;
            no_dokumen.value    = Qno_dokumen;
            tahun_rencana.value = Qtahun; 
            $('#kd_skpd').combogrid('setValue', Qkd_skpd); 
            $('#kd_skpd_baru').combogrid('setValue', Qkd_skpd_baru);  
            $('#kd_unit').combogrid('setValue', Qkd_unit);  
            $('#kd_unit_baru').combogrid('setValue', Qkd_unit_baru);  
            total.textContent = number_format(Qtotal, 2,'.',',');
            load_detail();
        }else{
			max_number();
			var status	= status;
			localStorage.setItem('status', status);
            var kd_usk  = localStorage.getItem('kd_skpd');
            var no_dok  = localStorage.getItem('no_dokumen');
            var tahun   = localStorage.getItem('tahun');
            var tanggal = localStorage.getItem('tanggal');     
            tgl_dokumen.value   = "<?php echo date('d-m-Y')?>";
            no_dokumen.value    = no_dok;
            tahun_rencana.value = tahun;
            $('#kd_skpd option:selected').combogrid('setValue', kd_usk); 
		}
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_Mutasi";
    }

    function max_number(){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/max_number',
            data: ({table:'transaksi.trh_mutasi',kolom:'no_dokumen'}),
            dataType:"json",
            success:function(data){
                no_dokumen.value = data; 
            }
        }); 
    }

    function tambahrincian() {
        var munit = $('#kd_unit').val(); 
        var mkib = $('#kib').val();  
        if (munit == "" || tahun_rencana.value == '' || mkib == '') { 
                iziToast.error({
                    title: 'Error',
                    message: 'Field No. Dokumen, Kode Unit, KIB, Tahun Rencana, Tanggal Dokumen Harus Terisi.!',
                });
        } else {
            getDataKib();
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
        }
    }

	function saveData(){ 
		var no_dokumen 	    = $('#no_dokumen').val();
		var tgl_dokumen	    = $('#tgl_dokumen').val();
        var kd_skpd         = $('#kd_skpd').val();
        var kd_unit         = $('#kd_unit').val();
        var kib             = $('#kib').val();
        var kd_skpd_baru    = $('#kd_skpd_baru').val();
		var kd_unit_baru 	= $('#kd_unit_baru').val();
		var tahun		    = $('#tahun_rencana').val(); 
		var total		    = angka($('#total_s1').text());
		var status		    = localStorage.getItem('status');
		var data1 		    = $('#trd').datagrid('getRows'); //Detail kib

        
		$.post('<?php echo base_url(); ?>transaksi/C_Mutasi/saveData', {detail: JSON.stringify(data1),no_dokumen:no_dokumen,tgl_dokumen:tgl_dokumen,kd_skpd:kd_skpd,kd_unit:kd_unit,tahun:tahun,total:total,kd_skpd_baru:kd_skpd_baru,kd_unit_baru:kd_unit_baru,status:status,kib:kib}, 
        function(result) {
            if (result.notif){
				iziToast.success({
					title: 'OK',
					message: result.message,
				});
                // back();
			} else {
				iziToast.error({
					title: 'Error',
					message: result.message,
				});
			}
		}, "json");
	}
	


    function load_detail() {

        var i = 0; 
        var nomor = no_dokumen.value;
        var tgl = tgl_dokumen.value;
        var kode = $('#kd_unit').combogrid('getValue');
        $.ajax({
            url: '<?php echo site_url('transaksi/C_Mutasi/trd_mutasi') ?>',
            type: 'POST',
            dataType: 'json',
            data: {no: nomor, kode: kode},
            success: function(data) { 
                $.each(data,function(i,n){      

                Nno_dokumen = n['no_dokumen'];
                Nkd_brg     = n['kd_brg'];
                Nid_barang  = n['id_barang'];
                Nnm_brg     = n['nm_brg'];
                Njumlah     = n['jumlah'];
                Nharga      = n['harga'];
                Nket        = n['ket'];
                Nno_urut    = n['no_urut'];
                Nkd_unit    = n['kd_unit'];   
                $('#trd').datagrid('appendRow',
                    {no_dokumen:Nno_dokumen,id_barang:Nid_barang,kd_brg:Nkd_brg,nm_brg:Nnm_brg,jumlah:Njumlah,harga:Nharga,ket:Nket,no_urut:Nno_urut,kd_unit:Nkd_unit}
                );  
               
            });

            }
        });    
    }
	function savedetail(){ 
         
        var noDok = $("#no_dokumen").val();
        var kdUnit = $("#kd_unit").combogrid('getValue');
        var urut = 0;
        var tot = 0;
        var rows = $("#dg").datagrid('getSelections');
        for( i=0; i < rows.length; i++){ 
            var id_barang   = rows[i].id_barang;
            var kd_brg  = rows[i].kd_brg;
            var nm_brg  = rows[i].uraian;
            var jumlah  = rows[i].jumlah;
            var nilai   = rows[i].nilai;
                tot     = tot + angka(rows[i].nilai);
            var keterangan  = rows[i].keterangan;
            urut++;
            $("#trd").datagrid('appendRow',{no_dokumen:noDok,id_barang:id_barang,kd_brg:kd_brg,nm_brg:nm_brg,jumlah:jumlah,harga:nilai,ket:keterangan,no_urut:urut,kd_unit:kdUnit});
        }
         total_s1.textContent=number_format(tot,2,'.',','); 
        $('#dlg').dialog('close');
 
				 
		
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
	
    function getUnit(kdx){
        $('#kd_unit').combogrid({
            panelWidth:600,  
            idField:'kd_unit',  
            textField:'nm_unit',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/getunit',
            queryParams:({kode:kdx}),
            columns:[[  
               {field:'kd_unit',title:'KODE Unit',width:200},  
               {field:'nm_unit',title:'NAMA Unit',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
                
           }  
        });
    }

    function getUnitBaru(kdx){
        $('#kd_unit_baru').combogrid({
            panelWidth:600,  
            idField:'kd_unit',  
            textField:'nm_unit',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/getunit',
            queryParams:({kode:kdx}),
            columns:[[  
               {field:'kd_unit',title:'KODE Unit',width:200},  
               {field:'nm_unit',title:'NAMA Unit',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
                
           }  
        });
    }
	
    function getDataKib(){
        var xkib = $("#kib").val();
        var xunit = $("#kd_unit").combogrid('getValue');
        var xthn = tahun_rencana.value;
        $('#dg').datagrid({
            width: '111%',
            height: '300',
            rownumbers: true,
            remoteSort: false,
            nowrap: true,
            pagination: true,
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/load_kib',
            queryParams : ({kib:xkib,unit:xunit,tahun:xthn}),
            rowStyler: function(index,row){
            if (row.cad == 0){
                    return 'background-color:#D3D3D3;color:#fff;';
                }
            }, 
            loadMsg: 'Tunggu Sebentar ... !',
            frozenColumns:[[
                {field:'ck',title:'',width:1,align:'center',checkbox:true},
            ]],
            
            columns:[[
                {field:'id_barang', title:'IdBar', width:120, align:"left", hidden:true},/*x*/ 
                {field:'jumlah', title:'jml', width:120, align:"left", hidden:true},/*x*/
                {field:'no_reg', title:'No Reg', width:120, align:"left"},
                {field:'tgl_reg', title:'Tanggal Reg', width:130, align:"left"},
                {field:'kd_brg',title:'Kode Barang',width:140,align:"left"},
                {field:'uraian',title:'Nama Barang',width:250,align:"left"},
                {field:'nilai',title:'Harga',width:135,align:"right"},
                {field:'tahun',title:'Tahun',width:100,align:"center"},
                {field:'keterangan',title:'Keterangan',width:280,align:"left"}
            ]]

        });
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
			nowrap:true,
			remoteSort:true,       
			rowStyler: function(index,row){
			if (row.cad == 0){
					return 'background-color:#D3D3D3;color:#fff;';
				}
			},
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/trd_mutasi',
            loadMsg:"Tunggu Sebentar....!!",    
			frozenColumns:[[
            {field:'action',title:'Aksi',width:80,align:'center',
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
			 
                {field:'no_dokumen', title:'NO', width:150, align:"left",editor:'text', hidden:true}, /*x*/ 
                {field:'id_barang', title:'ID', width:150, align:"left",editor:'text', hidden:true}, /*x*/
			]], 
            columns:[[
                {field:'kd_brg', title:'Kode Barang', width:130, align:"left",editor:'text'},
                {field:'nm_brg',title:'Nama Barang',width:230,align:"left",editor:'text'},
                {field:'jumlah',title:'Jumlah',width:100,align:"left",editor:'numberbox'},
                {field:'harga',title:'Harga',width:125,align:"right",editor:{type:'numberbox',options:{precision:2}}}, 
                {field:'ket',title:'Keterangan',width:300,align:"left",editor:'text'},
                {field:'no_urut', title:'urut', width:5, align:"left",editor:'text', hidden:true },/*x*/
                {field:'kd_unit', title:'unit', width:5, align:"left",editor:'text', hidden:true }/*x*/
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
			  // total_s1.textContent=number_format(sum,2,'.',',');
		}
		
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

         

        $('#kd_skpd').combogrid({
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'nm_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               kd = rowData.kd_skpd;  
               getUnit(kd); 
           }  
        });

        $('#kd_skpd_baru').combogrid({
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'nm_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_Mutasi/getSkpdBaru',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
                kd = rowData.kd_skpd; 
                getUnitBaru(kd);
           }  
        });
  
    });




</script>