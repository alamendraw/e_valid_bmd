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
								<button id="detail"  type="button" class="btn btn-info btn-sm" onclick="javascript:editUser();"><i class="fa fa-info-circle"></i> Detail</button> <div class="help-block with-errors" id="error_custom1"></div>
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
	xid = '';
	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kiba/add'); ?>';
	}

	function detail() {		
		localStorage.setItem('status', 'detail');
		localStorage.setItem('id_barang',id_barang);
		localStorage.setItem('id_lokasi',id_lokasi);
		localStorage.setItem('id',id);
		localStorage.setItem('no_reg',no_reg);
		localStorage.setItem('tgl_reg',tgl_reg);
		localStorage.setItem('no_oleh',no_oleh);
		localStorage.setItem('tgl_oleh',tgl_oleh);
		localStorage.setItem('no_dokumen',no_dokumen);
		localStorage.setItem('no_oleh',no_oleh);
		localStorage.setItem('status_tanah',status_tanah);
		localStorage.setItem('asal',asal);
		localStorage.setItem('dsr_peroleh',dsr_peroleh);
		localStorage.setItem('no_sertifikat',no_sertifikat);
		localStorage.setItem('tgl_sertifikat',tgl_sertifikat);
		localStorage.setItem('luas',luas);
		localStorage.setItem('alamat1',alamat1);
		localStorage.setItem('alamat2',alamat2);
		localStorage.setItem('alamat3',alamat3);
		localStorage.setItem('keterangan',keterangan);
		localStorage.setItem('milik',milik);
		localStorage.setItem('wilayah',wilayah);
		localStorage.setItem('kd_skpd',kd_skpd);
		localStorage.setItem('kd_unit',kd_unit);
		localStorage.setItem('tahun',tahun);
		localStorage.setItem('kd_brg',kd_brg);
		localStorage.setItem('lat',lat);
		localStorage.setItem('lon',lon);
		localStorage.setItem('kondisi',kondisi);
		localStorage.setItem('nm_skpd',nm_skpd);
		localStorage.setItem('hrg_oleh',hrg_oleh);
		localStorage.setItem('upload_sert',upload_sert);
		localStorage.setItem('foto1',foto1);
		localStorage.setItem('foto2',foto2);
		localStorage.setItem('foto3',foto3);
		localStorage.setItem('foto4',foto4);
		localStorage.setItem('nm_subrinci',nm_subrinci);
		localStorage.setItem('nm_unit',nm_unit);
		localStorage.setItem('nm_brg',nm_brg);
		localStorage.setItem('penggunaan',penggunaan);
		localStorage.setItem('detail_brg',detail_brg);

		localStorage.setItem('ket_matriks',ket_matriks);
		localStorage.setItem('b_barat',b_barat);
		localStorage.setItem('b_timur',b_timur);
		localStorage.setItem('b_selatan',b_selatan);
		localStorage.setItem('b_utara',b_utara);
		localStorage.setItem('kd_camat',kd_camat);
		localStorage.setItem('kd_lurah',kd_lurah);
		localStorage.setItem('pemegang_hak',pemegang_hak);
		localStorage.setItem('no_surat_ukur',no_surat_ukur);
		localStorage.setItem('tgl_surat_ukur',tgl_surat_ukur);
		localStorage.setItem('status_sertifikat',status_sertifikat);
		localStorage.setItem('status_fasilitas',status_fasilitas);
		localStorage.setItem('kronologis',kronologis);

		localStorage.setItem('sts',sts);
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kiba/add'); ?>';
	}	

	$(document).ready(function() {
		$("#hapus").attr("disabled", "disabled");
		$("#detail").attr("disabled", "disabled");
		
		$('#dg').datagrid({
			width:'100%',
			height:350,
			remoteSort:true,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			clientPaging: true,
			remoteFilter: true,
			rownumbers: true,
			url: '<?php echo base_url(); ?>index.php/transaksi/C_Kiba/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
		    frozenColumns:[[
	    		{field:'ck',title:'',width:'5%',align:'center',checkbox:true},
	    		{field:'icon',title:'',width:'3%',align:'center'},
	    		{field:'sert',title:'',width:'3%',align:'center', hidden:'true'},
	    		{field:'img',title:'',width:'3%',align:'center', hidden:'true'},
				{field:'id_lokasi',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'id_barang',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'sts',title:'sts',width:'10%',align:"center",hidden:"true"},
				{field:'no_reg',title:'No Reg',width:'6%',align:"center"},
	    		{field:'nm_brg',title:'Nama Barang',width:'30%',align:"left"},
    		]],
			columns:[[
	    		{field:'tahun', title:'Tahun', width:'5%', align:"center"},
				{field:'nilai',title:'Harga',width:'15%',align:"right"},
				{field:'alamat1',title:'Alamat',width:'30%',align:"left"},
				{field:'keterangan',title:'Keterangan',width:'35%',align:"left"}
			]],
			onSelect:function(rowIndex,rowData){
				id_barang         = rowData.id_barang;
				id_lokasi         = rowData.id_lokasi;
				xid               = rowData.id_lokasi;
				id                = rowData.id;
				no_reg            = rowData.no_reg;
				tgl_reg           = rowData.tgl_reg;
				no_oleh           = rowData.no_oleh;
				tgl_oleh          = rowData.tgl_oleh;
				no_dokumen        = rowData.no_dokumen;
				no_oleh           = rowData.no_oleh;
				status_tanah      = rowData.status_tanah;
				asal              = rowData.asal;
				dsr_peroleh       = rowData.dsr_peroleh;
				no_sertifikat     = rowData.no_sertifikat;
				tgl_sertifikat    = rowData.tgl_sertifikat;
				luas              = rowData.luas;
				alamat1           = rowData.alamat1;
				alamat2           = rowData.alamat2;
				alamat3           = rowData.alamat3;
				keterangan        = rowData.keterangan;
				milik             = rowData.milik;
				wilayah           = rowData.wilayah;
				kd_skpd           = rowData.kd_skpd;
				kd_unit           = rowData.kd_unit;
				tahun             = rowData.tahun;
				kd_brg            = rowData.kd_brg;
				lat               = rowData.lat;
				lon               = rowData.lon;
				kondisi           = rowData.kondisi; 
				nm_skpd           = rowData.nm_skpd;
				hrg_oleh          = rowData.nilai; 
				upload_sert       = rowData.upload_sert;
				foto1             = rowData.foto1;
				foto2             = rowData.foto2;
				foto3             = rowData.foto3;
				foto4             = rowData.foto4;
				nm_brg            = rowData.nm_brg;
				nm_subrinci       = rowData.nm_subrinci;
				nm_unit           = rowData.nm_unit;
				penggunaan        = rowData.penggunaan;
				detail_brg        = rowData.detail_brg;
				ket_matriks       = rowData.ket_matriks;
				b_barat           = rowData.b_barat;
				b_timur           = rowData.b_timur;
				b_selatan         = rowData.b_selatan;
				b_utara           = rowData.b_utara;
				kd_camat          = rowData.kd_camat;
				kd_lurah          = rowData.kd_lurah;
				pemegang_hak      = rowData.pemegang_hak;
				no_surat_ukur     = rowData.no_surat_ukur;
				tgl_surat_ukur    = rowData.tgl_surat_ukur;
				status_sertifikat = rowData.status_sertifikat;
				status_fasilitas  = rowData.status_fasilitas;
				kronologis        = rowData.kronologis;
				sts               = rowData.sts;
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
			cari();
		});
		$("#keyword2").on('keyup', function(){
			cari();
		});
		$("#keyword3").on('keyup', function(){
			cari();
		});
		$('.btn-toggle-fullwidth').click(function() {
			setTimeout(function () {
				$('#dg').datagrid('resize');
				$('.pagination-load').click();
			}, 300);
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
					$.post('<?php echo base_url(); ?>index.php/transaksi/C_Kiba/hapus',
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
		var key1 = $('#keyword1').val(); 
		var key2 = $('#keyword2').val(); 
		var key3 = $('#keyword3').val(); 
		$(function(){ 
			$('#dg').datagrid({
				url: '<?php echo base_url();?>index.php/transaksi/C_Kiba/load_header',
				queryParams:({key1:key1,key2:key2,key3:key3})
			});   
	 	});
	}

	function getGambar(){
		$('#dlgGbr').dialog('open').dialog('center').dialog('setTitle','Data Gambar'+xid);
	}
    </script>