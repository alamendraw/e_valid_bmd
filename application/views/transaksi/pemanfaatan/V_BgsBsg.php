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
</div>

<div class="row">
	<div class="col-sm-12">
		<table id="dg"></table>
	</div>
</div>


<script type="text/javascript">

	function tambah() {
		localStorage.setItem('status', 'tambah');
		var kd_uskpd	= '<?php echo $this->session->userdata('kd_skpd');?>';
		var tahun 		= '<?php echo date('Y')+1;?>';
		var tanggal 	= '<?php echo date('d-m-y');?>';
		localStorage.setItem('status', 'tambah');
		localStorage.setItem('kd_uskpd', kd_uskpd);
		localStorage.setItem('tahun', tahun);
		localStorage.setItem('tanggal', tanggal);
		window.location.href = '<?php echo site_url('transaksi/C_BgsBsg/add'); ?>';
	}

	function detail() {		
		var no_dokumen = no_dok;
		var kd_uskpd = kd_usk;
		var nm_uskpd = nm_usk;
		var tahun 	= kd_thn;
		var tanggal = kd_tgl;
		var program = kd_prog;
		localStorage.setItem('status', 'detail');
		localStorage.setItem('no_dokumen', no_dokumen);
		localStorage.setItem('kd_uskpd', kd_uskpd);
		localStorage.setItem('nm_uskpd', nm_uskpd);
		localStorage.setItem('tahun', tahun);
		localStorage.setItem('tanggal', tanggal);
		localStorage.setItem('program', program);

		window.location.href = '<?php echo site_url('transaksi/C_BgsBsg/add'); ?>';
	}	

	

	$(document).ready(function() {
		$("#ubah").attr("disabled", "disabled");
		$("#hapus").attr("disabled", "disabled");
		$("#detail").attr("disabled", "disabled");

		$('#dg').datagrid({
			width:1000,
			height:350,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>transaksi/C_BgsBsg/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'no_dokumen',title:'Nomor Dokumen',width:'23%',align:"center"},
				{field:'kd_uskpd',title:'Kode SKPD',width:'23%',align:"center", hidden: true},
	    		{field:'tgl_dokumen',title:'Tanggal',width:'15%',align:"center"},
	    		{field:'nm_uskpd', title:'SKPD', width:'45%', align:"left"},
	    		{field:'tahun', title:'Tahun', width:'15%', align:"center"},
	    		{field:'kd_program', title:'Program', width:'15%', align:"center",hidden:true},
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				no_dok = rowData.no_dokumen;
				kd_usk = rowData.kd_uskpd;
				nm_usk = rowData.nm_uskpd;
				kd_thn = rowData.tahun;
				kd_tgl = rowData.tgl_dokumen;
				kd_prog = rowData.kd_program;
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
		for(var i=0; i<row.length; i++){ids.push(row[i].no_dokumen);idt.push(row[i].kd_uskpd);}
		var no_dokumen = ids.join('#');
		var kd_uskpd = idt.join('#');
		if (row){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>transaksi/C_BgsBsg/hapus',
						{kode:no_dokumen,kd_skpd:kd_uskpd},function(result){
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