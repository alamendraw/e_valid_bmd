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
				<button id="hapus" type="button" class="btn btn-default" onClick="javascript:hapus();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="back" type="button" class="btn btn-default" onClick="javascript:back();"><span><i class="fa fa-arrow-left"></i></span> Menu KIB E</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>
	        <!-- <div style="padding-left: 0px !important; float:right;" class="col-sm-4">
				<form class="navbar-right">
					<div class="input-group">
						<input type="text" value="" id="keyword" name="keyword" class="form-control" placeholder="">
						<span class="input-group-btn"><button type="button" class="btn btn-default" onClick="javascript:cari();"><i class="fa fa-search"></i></button></span>
					</div>
				</form>
			</div>	 -->	 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12"> 
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-1"><p style="padding-top: 10px;"><b>Pencarian</b></p>  </div>
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-3"><input type="text" value="" id="keyword1" name="keyword1" class="form-control" placeholder="Nama Barang / Detail Barang"></div>
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-2"><input type="text" value="" id="keyword2" name="keyword2" class="form-control" placeholder="Tahun"></div>
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-6"><input type="text" value="" id="keyword3" name="keyword3" class="form-control" placeholder="perolehan / sumber dana / ciptaan / penerbit / bahan / judul / keterangan / kondisi"></div> 
	</div>
	<div class="col-sm-12">
		<table id="dg"></table>
	</div>
	</br>&nbsp;</br>
	<div class="col-sm-3"> 
			<div style='width: 0; height: 0; border-top: 20px solid #800000; border-right: 20px solid transparent; float: left;'></div>&nbsp;
			: Tidak Bisa Dihapus
	</div>
	<div class="col-sm-6"> 
			<div style='width: 0; height: 0; border-top: 20px solid #90EE90; border-right: 20px solid transparent; float: left;'></div>&nbsp; 
			: Bisa Dihapus
	</div>
</div>


<script type="text/javascript">

	function newUser() {
		localStorage.setItem('status', 'tambah');
		localStorage.setItem('pilih', 'eca');
		window.location.href = '<?php echo site_url('transaksi/C_Kibe/add'); ?>';
	}

	function back(){
		window.location.href = '<?php echo site_url('transaksi/C_Kibe'); ?>';
	}

	function detail() {		                                        
		localStorage.setItem('status', 'detail');      
		localStorage.setItem('pilih', 'eca');      
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
		localStorage.setItem('sub_rincian',sub_rincian_objek);
		localStorage.setItem('nm_skpd',nm_skpd);
		localStorage.setItem('foto1',foto1);
		localStorage.setItem('foto2',foto2);
		localStorage.setItem('nm_rincian',nm_rincian);
		localStorage.setItem('nm_subrinci',nm_subrinci);
		localStorage.setItem('nm_unit',nm_unit);
		localStorage.setItem('nm_brg',nm_brg);
		localStorage.setItem('sts',sts);
		window.location.href = '<?php echo site_url('transaksi/C_Kibe/add'); ?>';
	}	

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
			url: '<?php echo base_url(); ?>transaksi/C_Kibe/load_header',
			queryParams : ({jenis:'eca'}),
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
				sub_rincian_objek	= rowData.sub_rincian_objek;
				nm_skpd				= rowData.nm_skpd;
				kd_ruang			= rowData.kd_ruang;
				foto1				= rowData.foto1;
				foto2				= rowData.foto2;
				nm_rincian			= rowData.nm_rincian;
				nm_subrinci			= rowData.nm_subrinci;
				nm_unit				= rowData.nm_unit;
				nm_brg				= rowData.nm_brg;
				sts					= rowData.sts;
				kategori			= rowData.kategori;
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
					url: '<?php echo base_url();?>transaksi/C_Kibe/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3,jenis:'eca'})
				});   
		 	});
		});
		$("#keyword2").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>transaksi/C_Kibe/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3,jenis:'eca'})
				});   
		 	});
		});
		$("#keyword3").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>transaksi/C_Kibe/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3,jenis:'eca'})
				});   
		 	});
		});
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
					$.post('<?php echo base_url(); ?>transaksi/C_Kibe/hapus',
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
				url: '<?php echo base_url();?>transaksi/C_Kibe/load_header',
				queryParams:({key:key, jenis:'eca'})
				});        
			 });
	}

    </script>