<div class="col-sm-12">
	<div class="col-sm-5">
		<div class="col-sm-12" style="padding-bottom: 10px;padding-top: 13px;">
            <div class="col-sm-6"><label>Pindah Ke Ruangan</label></div>
            <div class="col-sm-6">
                <span id="kd_ruang" name="kd_ruang" type="text" class="easyui-textbox" style="width:100%;"><span>

            </div>
        </div>
	</div>	
	<div class="col-sm-2"> </div>
	<div class="col-sm-5">
		<div class="col-sm-12" style="padding-bottom: 10px;">
            <div class="col-sm-6"><button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:proses()">Proses</button></div>
            <div class="col-sm-6"><button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back()">Kembali</button></div>
        </div>
	</div>	
</div>
<div class="col-sm-12" style="height: 10px;"> </div>
<div class="col-sm-12">
	<table id="dg"></table>
</div>
<div class="col-sm-12" style="height: 10px;"> </div>
<div class="col-sm-12">
	<div class="col-sm-2 col-sm-offset-4">
        
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/easyui/datagrid-filter.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dg').datagrid({
			width:1000,
			height:350,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>transaksi/C_Kibb/load_ruang',
		    loadMsg:"Tunggu Sebentar....!!",
		     
		    frozenColumns:[[
	    		{field:'ck',title:'',width:'5%',align:'center',checkbox:true}, 
				{field:'no_reg',title:'Nomor Reg',width:'13%',align:"center"},
				{field:'nm_ruang',title:'Ruangan',width:'20%',align:"left"}, 
				{field:'id_lokasi',title:'Lokasi',width:'20%',align:"left",hidden:true}, 
		    ]],
			columns:[[
				{field:'nm_brg',title:'Nama Barang',width:'30%',align:"left"},
				{field:'id_lokasi',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'nilai',title:'Harga',width:'18%',align:"right"},
	    		{field:'tahun', title:'Tahun', width:'10%', align:"center"},
	    		{field:'cara_peroleh', title:'Cara Peroleh', width:'15%', align:"center"},
	    		{field:'merek', title:'Merek', width:'15%', align:"center"},
	    		{field:'no_polisi', title:'No Polisi', width:'10%', align:"center"},
	    		{field:'kondisi', title:'Kondisi', width:'10%', align:"center"},
	    		{field:'detail_brg', title:'Detail', width:'10%', align:"center"},
				{field:'keterangan',title:'Keterangan',width:'35%',align:"left"},
				{field:'kd_skpd',title:'Skpd',width:'10%',align:"left"},
				{field:'kd_unit',title:'Unit',width:'12%',align:"left"},

			]],
			onSelect:function(rowIndex,rowData){
				 
				 
			}
		}); 

		$('#kd_ruang').combogrid({
            panelWidth:600,  
            idField:'kd_ruang',  
            textField:'nm_ruang',  
            mode:'remote',
            url:'<?php echo base_url(); ?>transaksi/C_Kibb/getRuang', 
            columns:[[  
               {field:'kd_ruang',title:'KODE RUANGAN',width:200},  
               {field:'nm_ruang',title:'NAMA RUANGAN',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
            	Rkode = rowData.kd_ruang; 
            } 
        }); 
	})
 
	$(function(){
        var dg = $('#dg').datagrid();
        dg.datagrid('enableFilter');
    });
	function back(){
		window.location.href = '<?php echo site_url('transaksi/C_Kibb'); ?>';
	}
    function proses(){
    	var xruang = $("#kd_ruang").combogrid('getValue');

		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		for(var i=0; i<row.length; i++){
			ids.push(row[i].id_lokasi); 
		}
		var kode = ids.join('#');
		if ( row ){
			$.post('<?php echo base_url(); ?>transaksi/C_Kibb/prosesPindah',
						{kode:kode,ruang:xruang},function(result){
						if (result.pesan){
							iziToast.info({
								title: 'OK',
								message: 'Data Berhasil Dipindahkan.!!',
							});
							$('#dg').datagrid('reload');  
						} else {
							iziToast.error({
								title: 'Error',
								message: 'Data Gagal Dipindahkan.!',
							}); 
						}
					},'json'); 
		}
	}


</script>