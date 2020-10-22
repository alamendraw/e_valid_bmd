<div class="row">
	<div class="col-sm-12">
		<div class="box-header">
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:newUser();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>

			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="detail"  type="button" class="btn btn-default" onClick="javascript:detail();"><span><i class="fa fa-info-circle"></i></span> Detail</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>

			<!-- <div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="ubah" type="button" class="btn btn-default" onClick="javascript:editUser();"><span><i class="fa fa-pencil"></i></span> Ubah</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>	 -->

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

	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('transaksi/C_HibahKeluar/add'); ?>';
	}

	function detail() {		
		var no_dokumen = no_dok;
		var tanggal = kd_tgl;
		localStorage.setItem('status', 'detail');
		localStorage.setItem('no_dokumen', no_dokumen);
		localStorage.setItem('kd_skpd', kd_skpd);
		localStorage.setItem('penerima', penerima);
		localStorage.setItem('tanggal', tanggal);
		localStorage.setItem('kd_unit', kd_unit);
		localStorage.setItem('nm_skpd', nm_skpd);
		localStorage.setItem('nm_unit', nm_unit);
		localStorage.setItem('no_urut', no_urut);
		localStorage.setItem('tahun', tahun);
		window.location.href = '<?php echo site_url('transaksi/C_HibahKeluar/add'); ?>';
	}	

	function hapus(){
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		var idt = [];
		var idu = [];
		var idx = [];
		for(var i=0; i<row.length; i++){ids.push(row[i].no_dokumen);idt.push(row[i].kd_skpd);idu.push(row[i].kd_unit);idx.push(row[i].no_urut);}
		var no_dokumen = ids.join('#');
		var kd_skpd = idt.join('#');
		var kd_unit = idu.join('#');
		var no_urut = idx.join('#');
		if (row){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>transaksi/C_HibahKeluar/hapus',
						{kode:no_dokumen,kd_skpd:kd_skpd,kd_unit:kd_unit,urut:no_urut},function(result){
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
			url: '<?php echo base_url(); ?>transaksi/C_HibahKeluar/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'no_urut',title:'Urut',width:'23%',align:"center",hidden:true},
				{field:'no_dokumen',title:'Nomor Dokumen',width:'23%',align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',width:'23%',align:"center", hidden: true},
	    		{field:'tgl_dokumen',title:'Tanggal',width:'15%',align:"center"},
	    		{field:'nm_skpd', title:'Unit SKPD', width:'45%', align:"center"},
	    		{field:'penerima', title:'penerima', width:'15%', align:"center"},
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				no_dok = rowData.no_dokumen;
				kd_skpd = rowData.kd_skpd;
				penerima = rowData.penerima;
				kd_tgl = rowData.tgl_dokumen;
				kd_unit = rowData.kd_unit;
				nm_skpd = rowData.nm_skpd;
				nm_unit = rowData.nm_unit;
				no_urut = rowData.no_urut;
				tahun = rowData.tahun;
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

	

    </script>