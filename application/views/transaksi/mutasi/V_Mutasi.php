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
			<div class="col-sm-3"><div class="gbr3"></div><a>Usulan Ditolak</a></div>
		</div>
	</div>
    <div class="alenia"></div>
	
</div>
<style>
.alenia {height:90px;}
.gbr1{ width: 0; height: 0; border-top: 20px solid #D3D3D3; border-right: 20px solid transparent; }
.gbr2{ width: 0; height: 0; border-top: 20px solid #90EE90; border-right: 20px solid transparent; }
.gbr3{ width: 0; height: 0; border-top: 20px solid #FF6600; border-right: 20px solid transparent; }

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
		var tanggal 	= '<?php echo date('d-m-y');?>';
		localStorage.setItem('status', 'tambah');
		localStorage.setItem('kd_skpd', kd_skpd);
		localStorage.setItem('tahun', tahun);
		localStorage.setItem('tanggal', tanggal);
		window.location.href = '<?php echo site_url('transaksi/C_Mutasi/add'); ?>';
	}

	function detail() {		
 
		var no_dokumen = nno_dokumen;
		var kd_skpd = nkd_skpd;
		var nm_skpd = nnm_skpd;
		var tahun 	= ntahun;
		var tanggal = ntgl_dokumen; 
		localStorage.setItem('status', 'detail');  
		localStorage.setItem('no_dokumen',nno_dokumen);
		localStorage.setItem('tgl_dokumen',ntgl_dokumen);
		localStorage.setItem('kd_unit',nkd_unit);
		localStorage.setItem('kd_skpd',nkd_skpd);
		localStorage.setItem('tahun',ntahun);
		localStorage.setItem('total',ntotal);
		localStorage.setItem('kd_unit_baru',nkd_unit_baru);
		localStorage.setItem('kd_skpd_baru',nkd_skpd_baru);
		localStorage.setItem('tabel',ntabel);
		localStorage.setItem('xkd',nxkd);

		window.location.href = '<?php echo site_url('transaksi/C_Mutasi/add'); ?>';
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
			url: '<?php echo base_url(); ?>transaksi/C_Mutasi/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
		    frozenColumns:[[
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true},
	    		{field:'icon',title:'',width:'3%',align:'center'},
    		]],
			columns:[[
				{field:'no_dokumen',title:'Nomor Dokumen',width:'20%',align:"center"}, 
	    		{field:'tgl_dokumen',title:'Tanggal',width:'13%',align:"center"},
	    		{field:'nm_skpd', title:'SKPD Lama', width:'33%', align:"left"},
	    		{field:'nm_skpd_baru', title:'SKPD Baru', width:'33%', align:"left"},
	    		{field:'xkd', title:'Kode', width:'33%', align:"left", hidden:true}
			]],
			onSelect:function(rowIndex,rowData){ 
				nno_dokumen 	= rowData.no_dokumen;
				ntgl_dokumen 	= rowData.tgl_dokumen;
				nkd_unit 		= rowData.kd_unit;
				nkd_skpd 		= rowData.kd_skpd;
				ntahun 			= rowData.tahun;
				ntotal 			= rowData.total;
				nkd_unit_baru 	= rowData.kd_unit_baru;
				nkd_skpd_baru 	= rowData.kd_skpd_baru;
				ntabel 			= rowData.tabel;
				nnm_skpd 		= rowData.nm_skpd;
				nxkd 			= rowData.xkd;
			 
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
		var kdx = [];
		for(var i=0; i<row.length; i++){
			ids.push(row[i].no_dokumen);
			idt.push(row[i].kd_unit);
			kdx.push(row[i].xkd);
		}
		var no_dokumen = ids.join('#');
		var kd_unit = idt.join('#');
		var vzx = kdx.join('#');
		
		if(vzx==1){
			iziToast.error({ title: 'Error', message: 'Nomor Dokumen <b>'+ids+'</b> Tidak Dapat Dihapus..', });
			exit();
		}
	 
		if (row){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>transaksi/C_Mutasi/hapus',
						{kode:no_dokumen,kd_unit:kd_unit},function(result){
						if (result.pesan){
							iziToast.info({
								title: 'OK',
								message: 'Data Berhasil Dihapus.!!',
							});
							$('#dg').datagrid('reload'); 
						} else {
							iziToast.error({
								title: 'Error',
								message: 'Data Gagal Dihapus.!',
							});
						}
					},'json');
				}
			});
		}
	}
    </script>