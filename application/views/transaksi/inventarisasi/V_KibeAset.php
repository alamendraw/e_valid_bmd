<style type="text/css">
	button{
		margin: 2px;
	}
</style>
<section class="content">
<div class="box" style="padding-right: 3px;">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">  

				<div class="tab-content"> 

					<div class="col-sm-12">
						<div class="box-header">

							<div style="padding-left: 0px !important;display: flex;" class="col-sm-12">
								<button id="tambah"  type="button" class="btn btn-primary btn-sm" onclick="javascript:newUser();"><i class="fa fa-plus"></i> Tambah</button>  
								<div class="help-block with-errors" id="error_custom1"></div>
								<button id="detail"  type="button" class="btn btn-info btn-sm" onclick="javascript:detail();"><i class="fa fa-info-circle"></i> Detail</button> <div class="help-block with-errors" id="error_custom1"></div>
								<button id="hapus" type="button" class="btn btn-danger btn-sm" onclick="javascript:hapus();"><i class="fa fa-trash"></i> Hapus</button>  
								<div class="help-block with-errors" id="error_custom1"></div>
								<!-- <button id="back" type="button" class="btn btn-warning btn-sm" onclick="javascript:back();"><i class="fa fa-arrow-left"></i> Menu KIB B</button>   -->
								<div class="help-block with-errors" id="error_custom1"></div>
							</div> 
						</div>
					</div>
					<div class="col-sm-12">
						<input type="hidden" value="" id="keyword1" name="keyword1" class="form-control input-sm" placeholder="Nama Barang / Detail Barang">
						<input type="hidden" value="" id="keyword2" name="keyword2" class="form-control input-sm" placeholder="Tahun">
						<div style="margin-bottom:37px">
							<div class="col-sm-4" align="right" style="padding-top: 7px;"><label>Pencarian:</label></div>
							<div class="col-sm-8 pull-right">
								<input type="text" value="" id="keyword3" name="keyword3" class="form-control input-sm" placeholder="Sumber dana / merek / no polisi / kondisi / keterangan / nilai">
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<table id="dg"></table> 
					</div> 

				</br>&nbsp;</br>
				<div class="col-sm-3 text-muted"> 
					<div style='width: 0; height: 0; border-top: 13px solid #800000; border-right: 13px solid transparent; float: left;'></div>&nbsp;
					: Tidak Bisa Dihapus
				</div>
				<div class="col-sm-6 text-muted"> 
					<div style='width: 0; height: 0; border-top: 13px solid #90EE90; border-right: 13px solid transparent; float: left;'></div>&nbsp; 
					: Bisa Dihapus
				</div>


			</div>
		</div>
	</div>
</div>
</div>
</section>

<script type="text/javascript" src="<?php echo base_url();?>assets/easyui/datagrid-filter.js"></script>
<script type="text/javascript">

	function newUser() {
		localStorage.setItem('status', 'tambah');
		localStorage.setItem('pilih', 'aset');
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibe/add'); ?>';
	}

	function back(){
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibe'); ?>';
	}

	function detail() {		                                        
		localStorage.setItem('status', 'detail');      
		localStorage.setItem('pilih', 'aset');      
		localStorage.setItem('id_barang',id_barang);             
		localStorage.setItem('id_lokasi',id_lokasi);             
		localStorage.setItem('detail_brg',detail_brg);             
		localStorage.setItem('id',id);
		localStorage.setItem('no_reg',no_reg);
		localStorage.setItem('tgl_reg',tgl_reg);
		localStorage.setItem('no_oleh',no_oleh);
		localStorage.setItem('tgl_oleh',tgl_oleh);
		localStorage.setItem('no_dokumen',no_dokumen);
		localStorage.setItem('kondisi',kondisi);
		localStorage.setItem('asal',asal);
		localStorage.setItem('dsr_peroleh',dsr_peroleh);
		localStorage.setItem('peroleh',peroleh);
		localStorage.setItem('judul',judul);
		localStorage.setItem('penerbit',penerbit);
		localStorage.setItem('spesifikasi',spesifikasi);
		localStorage.setItem('asal',asal);
		localStorage.setItem('cipta',cipta);
		localStorage.setItem('jenis',kategori);
		localStorage.setItem('tahun_terbit',tahun_terbit);
		localStorage.setItem('kd_satuan',kd_satuan);
		localStorage.setItem('kd_bahan',kd_bahan);
		localStorage.setItem('tipe',tipe);
		localStorage.setItem('nilai',nilai);
		localStorage.setItem('jumlah',jumlah);
		localStorage.setItem('keterangan',keterangan);
		localStorage.setItem('milik',milik);
		localStorage.setItem('wilayah',wilayah);
		localStorage.setItem('kd_skpd',kd_skpd);
		localStorage.setItem('kd_unit',kd_unit);
		localStorage.setItem('tahun',tahun);
		localStorage.setItem('kd_brg',kd_brg);
		localStorage.setItem('kd_ruang',kd_ruang);
		localStorage.setItem('lat',lat);
		localStorage.setItem('lon',lon);
		localStorage.setItem('rincian_objek',rincian_objek);
		localStorage.setItem('nm_skpd',nm_skpd);
		localStorage.setItem('foto1',foto1);
		localStorage.setItem('foto2',foto2);
		localStorage.setItem('foto3',foto3);
		localStorage.setItem('foto4',foto4);
		localStorage.setItem('nm_rincian',nm_rincian);
		localStorage.setItem('nm_unit',nm_unit);
		localStorage.setItem('nm_brg',nm_brg);
		localStorage.setItem('sts',sts);
		localStorage.setItem('ket_matriks',ket_matriks);
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibe/add'); ?>';
	}	

	$(document).ready(function() {
		$("#hapus").attr("disabled", "disabled");
		$("#detail").attr("disabled", "disabled");
		$('#dg').datagrid({
			width:'98%',
			height:350,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>index.php/transaksi/C_Kibe/load_header',
			queryParams : ({jenis:'aset'}),
		    loadMsg:"Tunggu Sebentar....!!",
		    // no_reg,nm_barang,merek,tahun,harga,keterangn
		    frozenColumns:[[
	    		{field:'ck',title:'',width:'5%',align:'center',checkbox:true},
				{field:'icon',title:'',width:'3%',align:'center'},
    		]],
			columns:[[
				{field:'id_lokasi',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'id_barang',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'sts',title:'is',width:'10%',align:"center",hidden:"true"},
				{field:'no_reg',title:'Nomor Reg',width:'13%',align:"center"},
				{field:'nm_brg',title:'Nama Barang',width:'30%',align:"left"},
	    		{field:'tahun', title:'Tahun', width:'10%', align:"center"},
				{field:'nilai',title:'Harga',width:'18%',align:"right"},
				{field:'keterangan',title:'Keterangan',width:'35%',align:"left"}
			]],
			onSelect:function(rowIndex,rowData){
				id_barang			= rowData.id_barang;
				id_lokasi			= rowData.id_lokasi;
				detail_brg			= rowData.detail_brg;
				id				  	= rowData.id;
				no_reg 			  	= rowData.no_reg;
				tgl_reg 		  	= rowData.tgl_reg;
				no_oleh 		  	= rowData.no_oleh;
				tgl_oleh 		  	= rowData.tgl_oleh;
				no_dokumen		  	= rowData.no_dokumen;
				kondisi 		  	= rowData.kondisi;
				dsr_peroleh 	  	= rowData.dsr_peroleh;
				peroleh		 	  	= rowData.peroleh;
				judul			  	= rowData.judul;
				penerbit		  	= rowData.penerbit;
				spesifikasi			= rowData.spesifikasi;
				asal				= rowData.asal;
				cipta				= rowData.cipta;
				jenis				= rowData.jenis;
				tahun_terbit		= rowData.tahun_terbit;
				kd_satuan			= rowData.kd_satuan;
				kd_bahan			= rowData.kd_bahan;
				tipe				= rowData.tipe;
				nilai 			  	= rowData.nilai;
				jumlah 			  	= rowData.jumlah;
				keterangan 		  	= rowData.keterangan;
				milik 			  	= rowData.milik;
				wilayah 			= rowData.wilayah;
				kd_skpd 			= rowData.kd_skpd;
				kd_unit 			= rowData.kd_unit;
				tahun 			  	= rowData.tahun;
				kd_brg  			= rowData.kd_brg;
				lat  				= rowData.lat;
				lon  				= rowData.lon;
				rincian_objek 		= rowData.rincian_objek;
				nm_skpd				= rowData.nm_skpd;
				kd_ruang			= rowData.kd_ruang;
				foto1				= rowData.foto1;
				foto2				= rowData.foto2;
				foto3				= rowData.foto3;
				foto4				= rowData.foto4;
				nm_rincian			= rowData.nm_rincian;
				nm_unit				= rowData.nm_unit;
				nm_brg				= rowData.nm_brg;
				sts					= rowData.sts;
				kategori			= rowData.kategori;
				ket_matriks			= rowData.ket_matriks;
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

		$("#keyword1").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>index.php/transaksi/C_Kibe/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3,jenis:'aset'})
				});   
		 	});
		});
		$("#keyword2").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>index.php/transaksi/C_Kibe/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3,jenis:'aset'})
				});   
		 	});
		});
		$("#keyword3").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>index.php/transaksi/C_Kibe/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3,jenis:'aset'})
				});   
		 	});
		});
	});
	$(function(){
		var dg = $('#dg').datagrid();
		dg.datagrid('enableFilter');
	});
	function hapus() {
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		var ist = [];
		var irg = [];
		for(var i=0; i<row.length; i++){
			ids.push(row[i].id_lokasi);
			ist.push(row[i].sts);
			irg.push(row[i].no_reg);
			if(ist==1){
				iziToast.error({ title: 'Error', message: 'No Reg : <b>'+irg+'</b> Tidak Bisa Dihapus.!', });
				return
			}
		}
		var kode = ids.join('#');
		if ( row ){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>index.php/transaksi/C_Kibe/hapus',
						{id_lokasi:kode},function(result){
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
				url: '<?php echo base_url();?>index.php/transaksi/C_Kibe/load_header',
				queryParams:({key:key, jenis:'aset'})
				});        
			 });
	}

    </script>