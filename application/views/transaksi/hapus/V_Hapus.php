<div class="row">
	<div class="col-sm-12">
		<div class="box-header">
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:tambah();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>

			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="detail"  type="button" class="btn btn-default" onClick="javascript:detail();"><span><i class="fa fa-info-circle"></i></span> Detail</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="hapus" type="button" class="btn btn-default" onClick="javascript:hapus();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>

	        <div class="col-sm-4 col-sm-offset-2" align="right">
				<form class="navbar-right">
					<div class="input-group">
						<input type="text" value="" id="keyword" name="keyword" class="form-control" placeholder="">
						<span class="input-group-btn"><button type="button" class="btn btn-default" onClick="javascript:cari();"><i class="fa fa-search"></i></button></span>
					</div>
				</form>
			</div>		 
		</div>
	</div>
	<div class="col-sm-8">
		<div class="box-header">
			<div class="col-sm-3"><div class="gbr1"></div><a>Usulan Belum diverifikasi</a></div>
			<div class="col-sm-3"><div class="gbr2"></div><a>Usulan Sudah diverifikasi</a></div>
		</div>
	</div>
    <div class="alenia"></div>
	
</div>
<style>
.alenia {height:90px;}
.gbr1{ width: 0; height: 0; border-top: 20px solid #D3D3D3; border-right: 20px solid transparent; }
.gbr2{ width: 0; height: 0; border-top: 20px solid #90EE90; border-right: 20px solid transparent; }

sm-3 {
    width: 20% !important;
}
</style>
<div class="row">
	<div class="col-sm-12">
		<table id="dg"></table>
	</div>
</div>


<script type="text/javascript">

	function tambah() {
		localStorage.setItem('status', 'tambah');
		var kd_skpd	= '<?php echo $this->session->userdata('kd_skpd');?>';
		var tahun 		= '<?php echo date('Y')+1;?>';
		var tanggal 	= '<?php echo date('dd-mm-yyyy');?>';
		localStorage.setItem('status', 'tambah');
		localStorage.setItem('kd_skpd', kd_skpd);
		localStorage.setItem('tahun', tahun);
		localStorage.setItem('tanggal', tanggal);
		window.location.href = '<?php echo site_url('transaksi/C_Hapus/add'); ?>';
	}

	function detail() {		
		var no_dokumen = no_dok;
		var kd_skpd = kd_usk;
		var kd_unit = xkd_unit;
		var nm_uskpd = nm_usk;
		var tahun 	= kd_thn;
		var tanggal = kd_tgl; 
		localStorage.setItem('status', 'detail');
		localStorage.setItem('no_dokumen', no_dokumen);
		localStorage.setItem('kd_skpd', kd_skpd);
		localStorage.setItem('kd_unit', kd_unit);
		localStorage.setItem('nm_uskpd', nm_uskpd);
		localStorage.setItem('tahun', tahun);
		localStorage.setItem('tanggal', tanggal); 
		localStorage.setItem('xkd', Nxkd); 

		window.location.href = '<?php echo site_url('transaksi/C_Hapus/add'); ?>';
	}	

	

	$(document).ready(function() {
		$("#ubah").attr("disabled", "disabled");
		$("#hapus").attr("disabled", "disabled");
		$("#detail").attr("disabled", "disabled");

		$('#dg').datagrid({
			idField:'no_dokumen',
			width:1000,
			height:350,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,   
			idField:'itemid',      
			url: '<?php echo base_url(); ?>transaksi/C_Hapus/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
		    frozenColumns:[[
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true},
	    		{field:'icon',title:'',width:'3%',align:'center'},
    		]],
			columns:[[
				{field:'no_dokumen',title:'Nomor Dokumen',width:'23%',align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',width:'23%',align:"center", hidden: true},
				{field:'xkd',title:'Kode',width:'23%',align:"center", hidden: true},
	    		{field:'tgl_dokumen',title:'Tanggal',width:'15%',align:"center"},
	    		{field:'nm_uskpd', title:'SKPD', width:'45%', align:"left"},
	    		{field:'tahun', title:'Tahun', width:'15%', align:"center"}
			]],
			onSelect:function(rowIndex,rowData){
				no_dok = rowData.no_dokumen;
				kd_usk = rowData.kd_skpd;
				xkd_unit = rowData.kd_unit;
				nm_usk = rowData.nm_uskpd;
				kd_thn = rowData.tahun;
				kd_tgl = rowData.tgl_dokumen; 
				Nxkd = rowData.xkd; 
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
			}
		}); 

	});

	function hapus(){
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		var idt = [];
		var xkt = [];
		for(var i=0; i<row.length; i++){
			ids.push(row[i].no_dokumen);
			idt.push(row[i].kd_skpd);
			xkt.push(row[i].xkd);
		}
		 
		if(xkt==1){
			iziToast.error({ title: 'Error', message: 'Nomor Dokumen <b>'+ids+'</b> Tidak dapat dihapus..', });
			exit();
		}
		var no_dokumen = ids.join('#');
		var kd_skpd = idt.join('#');
		if (row){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>transaksi/C_Hapus/hapus',
						{kode:no_dokumen,kd_skpd:kd_skpd},function(result){
						if (result.pesan){
							iziToast.info({ title: 'OK', message: 'Data Berhasil Dihapus.!!', });
							$('#dg').datagrid('reload'); 
						} else {
							iziToast.error({ title: 'Error', message: 'Data Gagal Dihapus.!', });
						}
					},'json');
				}
			});
		}
	}
    </script>