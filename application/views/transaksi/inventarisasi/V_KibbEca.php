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
								<button id="back" type="button" class="btn btn-warning btn-sm" onclick="javascript:back();"><i class="fa fa-arrow-left"></i> Menu KIB B</button>  
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
					localStorage.setItem('jenis', '2');
					window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibb/add'); ?>';
					
				}

				function back(){
					window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibb'); ?>';
				}
				
				function editUser(){
					localStorage.setItem('jenis', '2');
					localStorage.setItem('status', 'detail');
					localStorage.setItem('id_barang',id_barang);
					localStorage.setItem('id_lokasi',id_lokasi);
					localStorage.setItem('no_reg',no_reg);
					localStorage.setItem('tgl_reg',tgl_reg);
					localStorage.setItem('no_oleh',no_oleh);
					localStorage.setItem('tgl_oleh',tgl_oleh);
					localStorage.setItem('no_dokumen',no_dokumen);
					localStorage.setItem('kondisi',kondisi);
					localStorage.setItem('asal',asal);
					localStorage.setItem('dsr_peroleh',dsr_peroleh);
					localStorage.setItem('ket_matriks',ket_matriks);
					localStorage.setItem('nilai',nilai);
					localStorage.setItem('keterangan',keterangan);
					localStorage.setItem('milik',milik);
					localStorage.setItem('wilayah',wilayah);
					localStorage.setItem('kd_skpd',kd_skpd);
					localStorage.setItem('kd_unit',kd_unit);
					localStorage.setItem('tahun',tahun);
					localStorage.setItem('kd_brg',kd_brg);
					localStorage.setItem('rincian_objek',rincian_objek);
					localStorage.setItem('sub_rinci',sub_rinci);
					localStorage.setItem('nm_skpd',nm_skpd);
					localStorage.setItem('foto1',foto1);
					localStorage.setItem('foto2',foto2);
					localStorage.setItem('foto3',foto3);
					localStorage.setItem('foto4',foto4);
					localStorage.setItem('nm_rincian',nm_rincian);
					localStorage.setItem('nm_subrinci',nm_subrinci);
					localStorage.setItem('nm_brg',nm_brg);
					localStorage.setItem('detail_brg',detail_brg);
					localStorage.setItem('nm_unit',nm_unit);
					localStorage.setItem('merek',merek);
					localStorage.setItem('tipe',tipe);
					localStorage.setItem('kd_warna',kd_warna.trim());
					localStorage.setItem('kd_bahan',kd_bahan);
					localStorage.setItem('kd_satuan',kd_satuan.trim());
					localStorage.setItem('no_rangka',no_rangka);
					localStorage.setItem('no_mesin',no_mesin);
					localStorage.setItem('no_polisi',no_polisi);
					localStorage.setItem('silinder',silinder);
					localStorage.setItem('no_stnk',no_stnk);
					localStorage.setItem('tgl_stnk',tgl_stnk);
					localStorage.setItem('no_bpkb',no_bpkb);
					localStorage.setItem('tgl_bpkb',tgl_bpkb);
					localStorage.setItem('jumlah',jumlah);
					localStorage.setItem('kd_ruang',kd_ruang);
					localStorage.setItem('kronologis',kronologis);
					localStorage.setItem('sts',sts);
					window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibb/add'); ?>';
				}
				$(document).ready(function() {
					$("#ubah").attr("disabled", "disabled");
					$("#hapus").attr("disabled", "disabled");
					$("#detail").attr("disabled", "disabled");

					$('#dg').datagrid({
						width:'95%',
						height:350,
						rownumbers:true, 
						remoteSort:false,
						nowrap:false,
						fitColumns:true,
						pagination:true,
						url: '<?php echo base_url(); ?>index.php/transaksi/C_Kibb/load_header',
						queryParams:({jns:'eca'}),
					    loadMsg:"Tunggu Sebentar....!!",
					    frozenColumns:[[
					    	{field:'ck',title:'',width:'6%',align:'center',checkbox:true},
	    					{field:'icon',title:'',width:'3%',align:'center'},
					    ]],
						columns:[[
									
							{field:'id_lokasi',title:'id',width:'10%',align:"center",hidden:"true"},
							{field:'id_barang',title:'id',width:'10%',align:"center",hidden:"true"},
							{field:'sts',title:'is',width:'10%',align:"center",hidden:"true"},
							{field:'no_reg',title:'No. Reg.',width:'10%',align:"center"},
							{field:'nm_brg',title:'Nama Barang',width:'30%',align:"left"},
							{field:'merek',title:'Merek',width:'19%',align:"center"},
							{field:'tahun', title:'Tahun', width:'10%', align:"center"},
							{field:'nilai',title:'Harga',width:'17%',align:"right"},
							{field:'keterangan',title:'Keterangan',width:'35%',align:"left"}
						]],
						onSelect:function(rowIndex,rowData){
							id_lokasi			= rowData.id_lokasi;
							id_barang			= rowData.id_barang;
							no_reg 				= rowData.no_reg;
							tgl_reg 			= rowData.tgl_reg;
							no_oleh 			= rowData.no_oleh;
							tgl_oleh 			= rowData.tgl_oleh;
							no_dokumen			= rowData.no_dokumen;			
							kondisi             = rowData.kondisi ;            
							asal                = rowData.asal ;               
							dsr_peroleh         = rowData.dsr_peroleh ;        
							nilai               = rowData.nilai ;              
							keterangan          = rowData.keterangan ;         
							milik               = rowData.milik  ;             
							wilayah             = rowData.wilayah   ;          
							kd_skpd             = rowData.kd_skpd  ;           
							kd_unit             = rowData.kd_unit  ;           
							tahun               = rowData.tahun;               
							kd_brg              = rowData.kd_brg ;             
							rincian_objek       = rowData.rincian_objek ;      
							sub_rinci   		= rowData.sub_rincian_objek;  
							nm_skpd             = rowData.nm_skpd;        
							foto1               = rowData.foto1;        
							foto2               = rowData.foto2;
							foto3               = rowData.foto3;
							foto4               = rowData.foto4;
							nm_rincian          = rowData.nm_rincian;      
							nm_subrinci         = rowData.nm_subrinci;      
							nm_brg              = rowData.nm_brg;
							detail_brg          = rowData.detail_brg;     
							nm_unit             = rowData.nm_unit;    
							merek               = rowData.merek;    
							tipe                = rowData.tipe;    
							kd_warna            = rowData.kd_warna;    
							kd_bahan            = rowData.kd_bahan;    
							kd_satuan           = rowData.kd_satuan;    
							no_rangka           = rowData.no_rangka;    
							no_mesin            = rowData.no_mesin;    
							no_polisi           = rowData.no_polisi;    
							silinder            = rowData.silinder;    
							no_stnk             = rowData.no_stnk;    
							tgl_stnk            = rowData.tgl_stnk;    
							no_bpkb             = rowData.no_bpkb;    
							tgl_bpkb            = rowData.tgl_bpkb;
							ket_matriks         = rowData.ket_matriks;   
							jumlah            	= rowData.jumlah;  
							kd_ruang           	= rowData.kd_ruang; 
							kronologis          = rowData.kronologis;  
							sts           	= rowData.sts; 
										
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

					$("#keyword1").on('keyup', function(){
						var key1 = $('#keyword1').val(); 
						var key2 = $('#keyword2').val(); 
						var key3 = $('#keyword3').val(); 
						$(function(){ 
							$('#dg').datagrid({
								url: '<?php echo base_url();?>index.php/transaksi/C_Kibb/load_header',
								queryParams:({key1:key1,key2:key2,key3:key3,jns:'eca'})
							});   
					 	});
					});
					$("#keyword2").on('keyup', function(){
						var key1 = $('#keyword1').val(); 
						var key2 = $('#keyword2').val(); 
						var key3 = $('#keyword3').val(); 
						$(function(){ 
							$('#dg').datagrid({
								url: '<?php echo base_url();?>index.php/transaksi/C_Kibb/load_header',
								queryParams:({key1:key1,key2:key2,key3:key3,jns:'eca'})
							});   
					 	});
					});
					$("#keyword3").on('keyup', function(){
						var key1 = $('#keyword1').val(); 
						var key2 = $('#keyword2').val(); 
						var key3 = $('#keyword3').val(); 
						$(function(){ 
							$('#dg').datagrid({
								url: '<?php echo base_url();?>index.php/transaksi/C_Kibb/load_header',
								queryParams:({key1:key1,key2:key2,key3:key3,jns:'eca'})
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
								$.post('<?php echo base_url(); ?>index.php/transaksi/C_Kibb/hapus',
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
							url: '<?php echo base_url();?>index.php/transaksi/C_Kibb/load_header',
							queryParams:({key:key,jns:'eca'})
						});   
				 	});
				}
				
				
			    </script>