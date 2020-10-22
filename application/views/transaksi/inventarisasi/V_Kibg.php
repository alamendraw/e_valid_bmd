<div class="row">
	<div class="col-sm-12">
		<div class="box-header">
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="tambah"  type="button" class="btn btn-primary btn-sm" onClick="javascript:newUser();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>

			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="detail"  type="button" class="btn btn-info btn-sm" onClick="javascript:detail();"><span><i class="fa fa-info-circle"></i></span> Detail</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="hapus" type="button" class="btn btn-danger btn-sm" onClick="javascript:hapus();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12"> 
		<input type="hidden" value="" id="keyword1" name="keyword1" class="form-control input-sm" placeholder="Nama Barang / Detail Barang">
		<input type="hidden" value="" id="keyword2" name="keyword2" class="form-control input-sm" placeholder="Tahun">
		<div style="margin-bottom:37px">
			<div class="col-sm-4" align="right" style="padding-top: 7px;"><label>Pencarian:</label></div>
			<div class="col-sm-8 pull-right">
				<input type="text" value="" id="keyword3" name="keyword3" class="form-control input-sm" placeholder="Sumber Dana / No Sertifikat / Luas / Penggunaan / Alamat / Tahun / Keterangan">
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<table id="dg"></table>
	</div></br>&nbsp;</br>
	<div class="col-sm-3 text-muted"> 
			<div style='width: 0; height: 0; border-top: 13px solid #800000; border-right: 13px solid transparent; float: left;'></div>&nbsp;
			: Tidak Bisa Dihapus
	</div>
	<div class="col-sm-6 text-muted"> 
			<div style='width: 0; height: 0; border-top: 13px solid #90EE90; border-right: 13px solid transparent; float: left;'></div>&nbsp; 
			: Bisa Dihapus
	</div>
</div>


<script type="text/javascript">

	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('transaksi/C_Kibg/add'); ?>';
	}

	function detail() {		
		localStorage.setItem('status', 'detail');
		localStorage.setItem('id_barang',id_barang);
		localStorage.setItem('id_lokasi',id_lokasi);
		localStorage.setItem('id',id);
		localStorage.setItem('no_reg',no_reg); //alert (rincian);
		localStorage.setItem('rincian',rincian); //alert (sub_rincian);
		localStorage.setItem('sub_rincian',sub_rincian); //alert (kd_barang);
		localStorage.setItem('kd_barang',kd_barang);
		localStorage.setItem('no_dokumen',no_dokumen);
		localStorage.setItem('milik',milik);
		localStorage.setItem('wil',wil);
		localStorage.setItem('kd_skpd',kd_skpd);
		localStorage.setItem('nm_skpd',nm_skpd);
		localStorage.setItem('kd_unit',kd_unit);
		localStorage.setItem('perolehan',perolehan);
		localStorage.setItem('dasar',dasar);
		localStorage.setItem('no_oleh',no_oleh);
		localStorage.setItem('tgl_oleh',tgl_oleh);
		localStorage.setItem('thn_oleh',thn_oleh);
		localStorage.setItem('hrg_oleh',hrg_oleh);
		localStorage.setItem('jumlah',jumlah);
		localStorage.setItem('tgl_regis',tgl_regis);
		localStorage.setItem('kondisi',kondisi);
		localStorage.setItem('alamat1',alamat1);
		localStorage.setItem('alamat2',alamat2);
		localStorage.setItem('alamat3',alamat3);
		localStorage.setItem('keterangan',keterangan);
		localStorage.setItem('lat',lat);
		localStorage.setItem('lon',lon);
		localStorage.setItem('foto',foto);
		localStorage.setItem('foto2',foto2);
		localStorage.setItem('sts',sts);
		localStorage.setItem('detail_brg',detail_brg);
		localStorage.setItem('nm_brg',nm_brg);
		localStorage.setItem('ket_matriks',ket_matriks);
		window.location.href = '<?php echo site_url('transaksi/C_Kibg/add'); ?>';
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
			url: '<?php echo base_url(); ?>transaksi/C_Kibg/load_header',
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
				{field:'no_reg',title:'Nomor Reg',width:'15%',align:"center"},
				{field:'nm_brg',title:'Nama Barang',width:'30%',align:"left"},
	    		{field:'thn_oleh', title:'Tahun', width:'10%', align:"center"},
				{field:'hrg_oleh',title:'Harga',width:'18%',align:"right"},
				{field:'keterangan',title:'Keterangan',width:'35%',align:"left"}
			]],
			onSelect:function(rowIndex,rowData){
				id_barang		= rowData.id_barang;
				id_lokasi		= rowData.id_lokasi;
				id		        = rowData.id;
				no_reg		    = rowData.no_reg;
				rincian		    = rowData.rincian_objek;
				sub_rincian		= rowData.sub_rincian_objek; //alert (sub_rincian);
				kd_barang		= rowData.kd_barang
				no_dokumen		= rowData.no_dokumen;
				milik			= rowData.milik;
				wil				= rowData.wil;
				kd_skpd			= rowData.kd_skpd;
				nm_skpd			= rowData.nm_skpd;
				kd_unit			= rowData.kd_unit;
				perolehan		= rowData.perolehan;
				dasar			= rowData.dasar;
				no_oleh			= rowData.no_oleh;
				tgl_oleh		= rowData.tgl_oleh;
				thn_oleh		= rowData.thn_oleh;
				hrg_oleh		= rowData.hrg_oleh;
				jumlah			= rowData.jumlah;
				tgl_regis		= rowData.tgl_regis;
				kondisi			= rowData.kondisi;
				alamat1			= rowData.alamat1;
				alamat2			= rowData.alamat2;
				alamat3			= rowData.alamat3;
				keterangan		= rowData.keterangan;
				lat             = rowData.lat;
				lon				= rowData.lon;
				foto			= rowData.foto;
				foto2			= rowData.foto2;
				nm_brg			= rowData.nm_brg;
				sts				= rowData.sts;
				detail_brg		= rowData.detail_brg;
				ket_matriks		= rowData.ket_matriks;
				
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
					url: '<?php echo base_url();?>transaksi/C_Kibg/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3})
				});   
		 	});
		});
		$("#keyword2").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>transaksi/C_Kibg/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3})
				});   
		 	});
		});
		$("#keyword3").on('keyup', function(){
			var key1 = $('#keyword1').val(); 
			var key2 = $('#keyword2').val(); 
			var key3 = $('#keyword3').val(); 
			$(function(){ 
				$('#dg').datagrid({
					url: '<?php echo base_url();?>transaksi/C_Kibg/load_header',
					queryParams:({key1:key1,key2:key2,key3:key3})
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
					$.post('<?php echo base_url(); ?>transaksi/C_Kibg/hapus',
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
				url: '<?php echo base_url();?>transaksi/C_Kibg/load_header',
				queryParams:({key:key})
				});        
			 });
	}

    </script>