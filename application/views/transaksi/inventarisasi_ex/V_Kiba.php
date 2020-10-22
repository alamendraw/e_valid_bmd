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
 	 
		</div>
	</div>
	<div class="col-sm-12"> 
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-1"><p style="padding-top: 10px;"><b>Pencarian</b></p>  </div>
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-3"><input type="text" value="" id="keyword1" name="keyword1" class="form-control" placeholder="Nama Barang / Detail Barang"></div>
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-2"><input type="text" value="" id="keyword2" name="keyword2" class="form-control" placeholder="Tahun"></div>
		<div style="padding-left: 0px !important; padding-bottom: 10px;"  class="col-sm-6"><input type="text" value="" id="keyword3" name="keyword3" class="form-control" placeholder="Sumber Dana / No Sertifikat / Luas / Penggunaan / Alamat / Tahun / Keterangan"></div> 
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<table id="dg"></table>
	</div></br>&nbsp;</br>
	<div class="col-sm-3"> 
			<div style='width: 0; height: 0; border-top: 20px solid #800000; border-right: 20px solid transparent; float: left;'></div>&nbsp;
			: Tidak Bisa Dihapus
	</div>
	<div class="col-sm-6"> 
			<div style='width: 0; height: 0; border-top: 20px solid #90EE90; border-right: 20px solid transparent; float: left;'></div>&nbsp; 
			: Bisa Dihapus
	</div>
</div>

<div id="dlgGbr" class="easyui-dialog" style="width:900px" closed="true" buttons="#dlg-buttonsBrg">
        <div class="row" style="width: 100%">
        <form id="popfm" method="post" novalidate style="padding: 8px;" enctype="multipart/form-data">
             <div class="col-sm-4 col-sm-offset-2" align="right" style="float: right;">
               
            </div>&nbsp;<br>&nbsp;
            <div class="col-md-12">
                <div class="row">                    
                        gambar
                </div>
                
            </div>  
            </form>
        </div>
</div>

<div id="dlg-buttonsBrg"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="javascript:$('#dlgGbr').dialog('close')" style="width:90px">Selesai</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlgGbr').dialog('close')" style="width:90px">Kembali</a>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/easyui/datagrid-filter.js"></script>
<script type="text/javascript">
	xid = '';
	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('transaksi/C_Kiba/add'); ?>';
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
		localStorage.setItem('rincian_objek',rincian_objek);
		localStorage.setItem('sub_rinci',sub_rinci);
		localStorage.setItem('nm_skpd',nm_skpd);
		localStorage.setItem('hrg_oleh',hrg_oleh);
		localStorage.setItem('upload_sert',upload_sert);
		localStorage.setItem('foto1',foto1);
		localStorage.setItem('foto2',foto2);
		localStorage.setItem('nm_rincian',nm_rincian);
		localStorage.setItem('nm_subrinci',nm_subrinci);
		localStorage.setItem('nm_unit',nm_unit);
		localStorage.setItem('nm_brg',nm_brg);
		localStorage.setItem('penggunaan',penggunaan);
		localStorage.setItem('detail_brg',detail_brg);
		localStorage.setItem('sts',sts);
		window.location.href = '<?php echo site_url('transaksi/C_Kiba/add'); ?>';
	}	
// no_reg,nm_brg,merek,tahun,harga,keterangan
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
			// remoteFilter: true,
			pagination:true,
			url: '<?php echo base_url(); ?>transaksi/C_Kiba/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
		    frozenColumns:[[
	    		{field:'ck',title:'',width:'5%',align:'center',checkbox:true},
	    		{field:'icon',title:'',width:'3%',align:'center'},
	    		{field:'sert',title:'',width:'3%',align:'center', hidden:'true'},
	    		{field:'img',title:'',width:'3%',align:'center', hidden:'true'},
    		]],
			columns:[[
				{field:'id_lokasi',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'id_barang',title:'id',width:'10%',align:"center",hidden:"true"},
				{field:'sts',title:'sts',width:'10%',align:"center",hidden:"true"},
				{field:'no_reg',title:'Nomor Reg',width:'15%',align:"center"},
	    		{field:'nm_brg',title:'Nama Barang',width:'30%',align:"left"},
	    		{field:'tahun', title:'Tahun', width:'10%', align:"center"},
				{field:'nilai',title:'Harga',width:'20%',align:"right"},
				{field:'keterangan',title:'Keterangan',width:'35%',align:"left"}
			]],
			onSelect:function(rowIndex,rowData){
				id_barang		= rowData.id_barang;
				id_lokasi		= rowData.id_lokasi;
				xid				= rowData.id_lokasi;
				id		        = rowData.id;
				no_reg          = rowData.no_reg;
				tgl_reg	        = rowData.tgl_reg;
				no_oleh	        = rowData.no_oleh;
				tgl_oleh	    = rowData.tgl_oleh;
				no_dokumen      = rowData.no_dokumen;
				no_oleh         = rowData.no_oleh;
				status_tanah    = rowData.status_tanah;
				asal            = rowData.asal;
				dsr_peroleh     = rowData.dsr_peroleh;
				no_sertifikat   = rowData.no_sertifikat;
				tgl_sertifikat  = rowData.tgl_sertifikat;
				luas            = rowData.luas;
				alamat1         = rowData.alamat1;
				alamat2         = rowData.alamat2;
				alamat3         = rowData.alamat3;
				keterangan      = rowData.keterangan;
				milik           = rowData.milik;
				wilayah         = rowData.wilayah;
				kd_skpd         = rowData.kd_skpd;
				kd_unit         = rowData.kd_unit;
				tahun           = rowData.tahun;
				kd_brg          = rowData.kd_brg;
				lat             = rowData.lat;
				lon				= rowData.lon;
				kondisi			= rowData.kondisi; 
				rincian_objek	= rowData.rincian_objek;
				sub_rinci		= rowData.sub_rincian_objek;
				nm_skpd			= rowData.nm_skpd;
				hrg_oleh		= rowData.nilai; 
				upload_sert		= rowData.upload_sert;
				foto1			= rowData.foto1;
				foto2			= rowData.foto2;
				nm_brg			= rowData.nm_brg;
				nm_rincian		= rowData.nm_rincian;
				nm_subrinci		= rowData.nm_subrinci;
				nm_unit			= rowData.nm_unit;
				penggunaan		= rowData.penggunaan;
				detail_brg		= rowData.detail_brg;
				sts				= rowData.sts;
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
					$.post('<?php echo base_url(); ?>transaksi/C_Kiba/hapus',
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
				url: '<?php echo base_url();?>transaksi/C_Kiba/load_header',
				queryParams:({key1:key1,key2:key2,key3:key3})
			});   
	 	});
	}

	function getGambar(){
		$('#dlgGbr').dialog('open').dialog('center').dialog('setTitle','Data Gambar'+xid);
	}
    </script>