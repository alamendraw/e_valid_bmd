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
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<!-- <button id="hapus" type="button" class="btn btn-default" onClick="javascript:hapus();"><span><i class="fa fa-trash"></i></span> Hapus</button>   -->
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

	$(document).ready(function() {
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
			url: '<?php echo base_url(); ?>transaksi/C_Dok/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'no_dokumen',title:'No Dokumen',width:'20%',align:"left"},
	    		{field:'tgl_dokumen',title:'Tanggal',width:'15%',align:"center"},
	    		{field:'nm_comp',title:'Perusahaan/Rekanan',width:'48%',align:"left"},
	    		{field:'nm_milik', title:'Kepemilikan', width:'15%', align:"left"},
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true},
	    		{field:'id_lock',title:'',width:'10%',align:'center',hidden:true}
			]],
			onSelect:function(rowIndex,rowData){
				id            =rowData.id;
				no_dokumen    =rowData.no_dokumen;
				kd_comp       =rowData.kd_comp;
				tgl_dokumen   =rowData.tgl_dokumen;
				kd_milik      =rowData.kd_milik;
				nilai_kontrak =rowData.nilai_kontrak;
				kd_wilayah    =rowData.kd_wilayah;
				kd_skpd      =rowData.kd_skpd;
				kd_unit       =rowData.kd_unit;
				s_dana        =rowData.s_dana;
				tahun         =rowData.tahun;
				s_ang         =rowData.s_ang;
				kd_cr_oleh    =rowData.kd_cr_oleh;
				b_dasar       =rowData.b_dasar;
				b_nomor       =rowData.b_nomor;
				b_tanggal     =rowData.b_tanggal;
				h_total	      =rowData.h_total;
				id_lock	      =rowData.id_lock;
				
				cekjumlah();
			},
			onCheck: function(index, row) {
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

	function detail() {		
		localStorage.setItem('status', 'detail');
		localStorage.setItem('id',id);
		localStorage.setItem('no_dokumen',no_dokumen);
		localStorage.setItem('kd_comp',kd_comp);
		localStorage.setItem('tgl_dokumen',tgl_dokumen);
		localStorage.setItem('kd_milik',kd_milik);
		localStorage.setItem('nilai_kontrak',nilai_kontrak);
		localStorage.setItem('kd_wilayah',kd_wilayah);
		localStorage.setItem('kd_skpd',kd_skpd);
		localStorage.setItem('kd_unit',kd_unit);
		localStorage.setItem('s_dana',s_dana);
		localStorage.setItem('tahun',tahun);
		localStorage.setItem('s_ang',s_ang);
		localStorage.setItem('kd_cr_oleh',kd_cr_oleh);
		localStorage.setItem('b_dasar',b_dasar);
		localStorage.setItem('b_nomor',b_nomor);
		localStorage.setItem('b_tanggal',b_tanggal);
		localStorage.setItem('h_total',h_total);
		localStorage.setItem('id_lock',id_lock);
				
		window.location.href = '<?php echo site_url('transaksi/C_Dok/add'); ?>';
	}

	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('transaksi/C_Dok/add'); ?>';
	}

	
	function hapus() {
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		for(var i=0; i<row.length; i++){ids.push(row[i].id_lock);}
		var kode = ids.join('#');
		if ( row ){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>transaksi/C_Dok/hapus',
						{id_lock:kode},function(result){
						if (result.pesan){
							iziToast.info({
								title: 'OK',
								message: 'Data Berhasil Dihapus.!!',
							});
							$('#dg').datagrid('reload'); 
							$("#ubah").attr("disabled", "disabled");
							$("#hapus").attr("disabled", "disabled");
						} else {
							iziToast.error({
								title: 'Error',
								message: 'Data Gagal Dihapus.!',
							});
							$("#ubah").attr("disabled", "disabled");
							$("#hapus").attr("disabled", "disabled");
						}
					},'json');
				}
			});
		}
	}


	function cari(){
					var key = $('#keyword').val();
					    $(function(){
						 $('#dg').datagrid({
							url: '<?php echo base_url();?>transaksi/C_Dok/load_header',
							queryParams:({key:key})
							});        
						 });
				}
	
	//================@Naga========================  

    </script>