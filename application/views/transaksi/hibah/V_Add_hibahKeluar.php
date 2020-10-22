<form id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
		 <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Urut</label></div>
                    <div class="col-sm-8">
                        <input id="no_urut" name="no_urut" type="text" class="form-control" style="width:80%;" readonly="true" placeholder="Terisi Otomatis">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>No. Dokumen</label></div>
                    <div class="col-sm-8">
                        <input id="no_dokumen" name="no_dokumen" type="text" class="form-control" style="width:80%;">
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>SKPD</label></div>
                    <div class="col-sm-8">
                        <input id="kd_skpd" name="kd_skpd" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
			
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Unit Kerja</label></div>
                    <div class="col-sm-8">
                        <input id="kd_unit" name="kd_unit" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div> 
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>penerima</label></div>
                    <div class="col-sm-8">
                        <input id="penerima" name="penerima" type="text" class="easyui-textbox" style="width:80%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
		<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">&nbsp;
                    <div class="col-sm-4" style="padding-top: 3px;">&nbsp;</div>
                    <div class="col-sm-8"></div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tanggal Dokumen</label></div>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <input id="tgl_dokumen" name="tgl_dokumen" type="text" class="form-control" style="width:100%;">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nama SKPD</label></div>
                    <div class="col-sm-8">
                        <span id="nm_skpd" name="nm_skpd" type="text" style="width:100%;"><span>
                    </div>
                </div>
            </div>
             <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Nama Unit</label></div>
                    <div class="col-sm-8">
                        <span id="nm_unit" name="nm_unit" type="text" style="width:100%;"><span>
                    </div>
                </div>
            </div>
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-4" style="padding-top: 3px;"><label>Tahun</label></div>
                    <div class="col-sm-8">
                        <input id="tahun" name="tahun" type="text" class="form-control" style="width:30%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div style="padding-bottom: 20px;">
    <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:newUser();">Tambah Daftar Hibah Keluar</button>
</div>

<table id="trd"></table> <!-- Table TRD Home -->

<div class="row" id="sum_show">
    <div class="col-md-4 text-right col-md-offset-4">
        <h3><span>Total : </span></h3>
    </div>
    <div class="col-md-4 text-right">
        <h3><span id="total_s1"></span></h3>
    </div>
</div>

<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="saveData()">Simpan</button>
    </div>
    <div class="col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Kembali</button>
    </div>
</div>

<div id="dlg" class="easyui-dialog" style="width:1100px" closed="true" buttons="#dlg-buttons">
    <form id="fm" method="post" novalidate style="padding: 8px;" enctype="multipart/form-data">
        <div class="row" style="width: 100%">
            <div class="col-md-5">
                <div style="margin-bottom:10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>K I B</label></div>
                        <div class="col-sm-7">
                            <input id="kib" name="kib" type="text" class="form-control" style="width:100%;">
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>No. Reg</label></div>
                        <div class="col-sm-7">
                            <input id="no_reg" name="no_reg" type="text" class="form-control" style="width:100%;">
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Kode Barang</label></div>
                        <div class="col-sm-7">
                            <span id="kd_barang" name="kd_barang" type="text" style="width: 100%"></span>
                        </div>
                    </div>
                </div>
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Nama Barang</label></div>
                        <div class="col-sm-7">
                            <span id="nm_barang" name="nm_barang" type="text" style="width: 100%"></span>
                        </div>
                    </div>
                </div>
                
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Nilai</label></div>
                        <div class="col-sm-7">
                            <span id="nil" name="nil" type="text" style="width: 100%" text-align="right"></span>
                        </div>
                    </div>
                </div>
                
                <div id="hide" style="margin-bottom: 10px">
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="col-sm-5"><label>Keterangan</label></div>
                        <div class="col-sm-7">
                            <span id="keterangan" name="keterangan" type="text" class="easyui-textbox" style="width:100%;" multiline="true"><span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">                    
                        <table id="dg"></table>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-5"><label>Total</label></div>
                        <div class="col-sm-7">
							<span id="total" name="total" type="text" style="width: 100%"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<div id="dlg-buttons">
    <!--<a type="submit" href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Simpan</a>-->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="appendSave()" style="width:90px">Tampung</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-back" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Kembali</a>
</div>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

    var tgl_dokumen     = document.getElementById('tgl_dokumen');
    var no_dokumen      = document.getElementById('no_dokumen');
    var tahun_rencana   = document.getElementById('tahun_rencana');
    var jml             = document.getElementById('jml');
    var hrg             = document.getElementById('hrg');
    var nm_skpd         = document.getElementById('nm_skpd');
    var total           = document.getElementById('total_s1');
    var nm_brg          = document.getElementById('nm_brg');
    var total_dlg       = document.getElementById('total');
    var brg_dlg         = document.getElementById('brg_dlg');

    // window.onload = alert(localStorage.getItem('kd_uskpd'));
    // var kd;

    window.onload = function(){

        var status  = localStorage.getItem('status');
        if (status == 'detail') {
            var kd_skpd  		= localStorage.getItem('kd_skpd');
            var no_dok  		= localStorage.getItem('no_dokumen');
            var penerima   		= localStorage.getItem('penerima');
            var tanggal 		= localStorage.getItem('tanggal');        
            var nm_skpd 		= localStorage.getItem('nm_skpd'); 
            var kd_unit 		= localStorage.getItem('kd_unit'); 
            var nm_unit 		= localStorage.getItem('nm_unit'); 
            var urut 			= localStorage.getItem('no_urut'); 
            var tahun	 		= localStorage.getItem('tahun'); 
			$("#penerima").textbox('setValue',penerima);
            $("#tgl_dokumen").datepicker("setDate", tanggal);
            no_dokumen.value    = no_dok;
			no_urut.value    	= urut;
            $("#tahun").datepicker("setDate", tahun);
			$("#nm_skpd").text(nm_skpd);
			$("#nm_unit").text(nm_unit);
            $('#kd_skpd').combogrid('setValue', kd_skpd);
            $('#kd_unit').combogrid('setValue', kd_unit);
            load_detail();
        } else{
			//max_number();
		}
    }

    function dialog_detail() {
        $('#dlg_dtl').dialog('open').dialog('center').dialog('setTitle','Detail Barang');
        $('#fm').form('clear');
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_HibahKeluar";
    }

    function max_number(){ 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>transaksi/C_HibahKeluar/max_number',
            data: ({table:'transaksi.trh_hibah',kolom:'no_dokumen'}),
            dataType:"json",
            success:function(data){
                $.each(data,function(i,n){                                    
                    max = Number(n['no_urut'])+1;                   
                    nom = String('000' + max).slice(-4);                    
                    no_dokumen.value = nom;
                });
            }
        }); 
    }

	function saveData(){
		var no_urut 	= $('#no_urut').val();
		var no_dokumen 	= $('#no_dokumen').val();
		var tgl_dokumen	= $('#tgl_dokumen').val();
		var kd_skpd 	= $('#kd_skpd').val();
		var kd_unit 	= $('#kd_unit').val();
		var penerima	= $('#penerima').val();
		var tahun		= $('#tahun').val();
		var total		= angka($('#total_s1').text());
		var status		= localStorage.getItem('status');
		var data1 		= $('#trd').datagrid('getRows');
		if(no_dokumen==''){
			iziToast.error({
					title: 'Error',
					message: 'No Dokumen Tidak Boleh Kosong',
				});
				return
		}
		if(kd_skpd==''){
			iziToast.error({
					title: 'Error',
					message: 'SKPD Tidak Boleh Kosong',
				});
				return
		}
		if(tahun==''){
			iziToast.error({
					title: 'Error',
					message: 'Tahun Tidak Boleh Kosong',
				});
				return
		}
		if(penerima==''){
			iziToast.error({
					title: 'Error',
					message: 'Penerima Tidak Boleh Kosong',
				});
				return
		}
		if(total==0){
			iziToast.error({
					title: 'Error',
					message: 'Data Barang Tidak Boleh Kosong',
				});
				return
		}
		if(total==''){
			iziToast.error({
					title: 'Error',
					message: 'Data Barang Tidak Boleh Kosong',
				});
				return
		}
		$.post('<?php echo base_url(); ?>transaksi/C_HibahKeluar/saveData', {detail: JSON.stringify(data1),no_dok:no_dokumen,tgl_dok:tgl_dokumen,kd_skpd:kd_skpd,kd_unit:kd_unit,penerima:penerima,status:status,tahun:tahun,no_urut:no_urut},
		function(result) {
		if (result.pesan){
				iziToast.success({
					title: 'OK',
					message: 'Data Berhasil Disimpan.!!',
				});
			$('#fm').form('reset');
			$("#total").text(number_format(0, 2,'.',','));
			$("#total_s1").text(number_format(0, 2,'.',','));
			$('#trd').datagrid('loadData', {"rows":[]});
			} else {
				iziToast.error({
					title: 'Error',
					message: 'Data Gagal Disimpan.!',
				});
			}
		}, "json");
	}
	
    function newUser() {
        if (no_dokumen.value == "" || 
            $('#kd_skpd').combogrid('getValue') == "" || 
            penerima.value == "" || 
            tgl_dokumen.value == "") {

                iziToast.error({
                    title: 'Error',
                    message: 'Field No. Dokumen, SKPD, Penerima, Tanggal Dokumen Harus Terisi.!',
                });
        } else {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
            //$('#fm').form('clear');
            status = 'add';
        }
		
		
    }

    function saveUser() {
        console.log(kd);
    }

    function hitung() {
        var a = eval($('#jml').val());//angka(jml.value);
        var b = eval($('#hrg').val());//angka(hrg.value);
        var tot = a*b;
        tot = number_format(tot, 2,'.',',');        
        total_dlg.value = tot;
    }

    function getToday() {
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var output = ((''+day).length<2 ? '0' : '') + day + '-' +
                   ((''+month).length<2 ? '0' : '') + month + '-' +
                   d.getFullYear();
      return output;
    }

	function appendSave(){
		var no_dok 	= $('#no_dokumen').val();
		var jns_kib = $('#kib').combobox('getValue');
		var kd_brg 	= $('#kd_barang').text();
		var nm_brg 	= $('#nm_barang').text();
		var nilai  	= $('#nil').text();
		var no_reg 	= $('#no_reg').val();
		var tot		= angka($('#total').text());
		$('#dg').datagrid('selectAll');
            var rows = $('#dg').datagrid('getSelections');           
			for(var p=0;p<rows.length;p++){
                no_regis  = rows[p].no_reg;
                barang  = rows[p].kd_brg;
                if ((no_regis==no_reg)&&(barang==kd_brg)) {
					iziToast.error({
					title: 'Error',
					message: 'Data Sudah ada di List!',
					});
					return;
			}
			}
		
		
		$('#dg').datagrid('appendRow',
						{kd_brg:kd_brg,
                        nm_brg:nm_brg,
                        no_reg:no_reg,
                        nilai:nilai,
                        jns_kib:jns_kib
						});
		$('#trd').datagrid('appendRow',
						{kd_brg:kd_brg,
                        nm_brg:nm_brg,
                        no_reg:no_reg,
                        nilai:nilai,
                        jns_kib:jns_kib
						});
		sisa_ = tot+angka(nilai);
		$("#total").text(number_format(sisa_, 2,'.',','));
		$("#total_s1").text(number_format(sisa_, 2,'.',','));
	}
	
    function load_detail() {
        var i = 0;
        var no_urut = $('#no_urut').val();
        var nomor = no_dokumen.value;
        var tgl = tgl_dokumen.value;
        var kode = $('#kd_skpd').combogrid('getValue');
        var unit = $('#kd_unit').combogrid('getValue');
        $.ajax({
            url: '<?php echo site_url('transaksi/C_HibahKeluar/loadDetail') ?>',
            type: 'POST',
            dataType: 'json',
            data: {no: nomor, kode: kode,unit:unit,urut:no_urut},
            success: function(data) {
                // console.log(data);
                $.each(data,function(i,n){                                    
                no      = n['no_dokumen'];                                                                 
                kd      = n['kd_brg'];                                                                                       
                nm      = n['nm_brg'];
                jns     = n['jns_kib'];                        
                no_reg  = n['no_reg'];                        
                nilai   = n['nilai'];
                tot     = n['total'];
                $('#trd').datagrid('appendRow',
                    {   kd_brg:kd,
                        nm_brg:nm,
                        nilai:nilai,
                        no_reg:no_reg,
                        jns_kib:jns,
                       }); 
				$('#dg').datagrid('appendRow',
                    {   kd_brg:kd,
                        nm_brg:nm,
                        nilai:nilai,
                        no_reg:no_reg,
                        jns_kib:jns,
                       }); 
               $("#total").text(number_format(tot, 2,'.',','));
				$("#total_s1").text(number_format(tot, 2,'.',','));
           });
            }
        });    
    }
	
	function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row'); 
        return parseInt(tr.attr('datagrid-row-index'));
    }
    function editrow(target){
        $('#trd').datagrid('beginEdit', getRowIndex(target));
    }
    
    function saverow(target){
        $('#trd').datagrid('endEdit', getRowIndex(target));
    }
    function cancelrow(target){
        $('#trd').datagrid('cancelEdit', getRowIndex(target));
    }
    function deleterow(target){
		var rows = $('#trd').datagrid('getSelected');
		var nilRow = rows.nilai;
		$('#trd').datagrid('endEdit', getRowIndex(target));
        $.messager.confirm('Confirm','Anda Yakin?',function(r){
            if (r){
                $('#trd').datagrid('deleteRow', getRowIndex(target));
                $('#dg').datagrid('deleteRow', getRowIndex(target));
            }
		var sisa = angka($('#total_s1').text())-angka(nilRow);
			$("#total").text(number_format(sisa, 2,'.',','));
			$("#total_s1").text(number_format(sisa, 2,'.',','));

        });
    }

    $(document).ready(function() {
		var lastIndex;
        $('#trd').datagrid({
			idField:'no_dokumen',
            width:1000,
            height:300,
             rownumbers:true,
            singleSelect:true,
            fitColumns:false,
            pagination:true,
			//showFooter:true,
			nowrap:true,
			remoteSort:true,
            url: '<?php echo base_url(); ?>transaksi/C_HibahKeluar/loadDetail',
            loadMsg:"Tunggu Sebentar....!!",    
			frozenColumns:[[
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:400,align:"left"},
			]],
            columns:[[
                {field:'no_reg',title:'No Reg',width:100,align:"left"},
                {field:'nilai',title:'Nilai',width:125,align:"left"},
                {field:'jns_kib',title:'Kib',width:125,align:"left",hidden:"true"},
                //{field:'ck',title:'',width:1,align:'center',checkbox:true},
				{field:'action',title:'',width:50,align:'center',
                formatter:function(value,row,index){
                        var d = '<a href="javascript:void(0)" onclick="deleterow(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                        return d;
                }
            },
            ]],
		onLoadSuccess:function(data) {
			  var sum = 0;
			  for (i = 0; i < data.length; i++) {
				 sum+=data[i].nilai;
			  }
			  // $("#total_s1").text(sum);
		}
        });
		

        $('#dg').datagrid({
            width: '100%',
            height: '300',
            rownumbers: true,
            remoteSort: false,
            nowrap: true,
            pagination: true,
            // url: ,
            loadMsg: 'Tunggu Sebentar ... !',
			frozenColumns:[[
                {field:'kd_brg',title:'Kode Barang',width:150,align:"left"},
                {field:'nm_brg',title:'Nama Barang',width:275,align:"left"},
			]],
            columns:[[
                {field:'no_reg',title:'No Reg',width:100,align:"left"},
                {field:'nilai',title:'Nilai',width:125,align:"left"},
                {field:'jns_kib',title:'Kib',width:125,align:"left",hidden:"true"},
                {field:'ck',title:'',width:1,align:'center',checkbox:true}
            ]]

        });

        $('#tahun_rencana').datepicker({
            minViewMode: 'years',
            autoclose: true,
            format: 'yyyy'
          });

        $('#tgl_dokumen').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true,
        });

        $('#tgl_dokumen').val(getToday());
		
		$('#tahun').datepicker({
            minViewMode: 'years',
            autoclose: true,
            format: 'yyyy'
          });
		  
        $('#kd_skpd').combogrid({
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',
            url: '<?php echo base_url(); ?>transaksi/C_HibahKeluar/getSkpd',
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:200},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
			   kd_skpd = rowData.kd_skpd;
               nm_	   = rowData.nm_skpd;
               nm_skpd.textContent = nm_;
			   $('#kd_unit').combogrid({url:'<?php echo base_url(); ?>transaksi/C_HibahKeluar/getUnit',
			   queryParams:({kd_skpd:kd_skpd})
			   });
            }  
        });
		
		 $('#kd_unit').combogrid({
            panelWidth:600,  
            idField:'kd_unit',  
            textField:'kd_unit',  
            mode:'remote',
            columns:[[  
               {field:'kd_unit',title:'KODE UNIT',width:200},  
               {field:'nm_unit',title:'NAMA UNIT',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
				nm_u	   = rowData.nm_unit;
				nm_unit.textContent = nm_u;
            }  
        });

	
	$('#kib').combobox({
        valueField:'id',
        textField:'text',
        data: [{
            id: 0,
            text: 'Pilih Kib'
        },{ id: 1,
            text: 'KIB A'
        },{
            id: 2,
            text: 'KIB B'
        },{
            id: 3,
            text: 'KIB C'
        },{
            id: 4,
            text: 'KIB D'
        },{
            id: 5,
            text: 'KIB E'
        },{
            id: 6,
            text: 'KIB F'
        },{
            id: 7,
            text: 'KIB G'
        }],onSelect:function(rec){
			hasil =  rec.id;
			tgl = document.getElementById("tgl_dokumen").value;
			skpd = $('#kd_skpd').combogrid('getValue');
			unit = $('#kd_unit').combogrid('getValue');
             $('#no_reg').combogrid({url:'<?php echo base_url(); ?>transaksi/C_HibahKeluar/getDokumen',
			 queryParams:({kib:hasil,tgl:tgl,skpd:skpd,unit:unit})})
        }
    });
	
        $('#no_reg').combogrid({
            panelWidth:650,  
            idField:'no_reg',  
            textField:'no_reg',  
            mode:'remote',
            //url:'<?php echo base_url(); ?>transaksi/C_HibahKeluar/getSatuan',  
            columns:[[  
               {field:'no_reg',title:'No Reg',width:100},  
               {field:'kd_brg',title:'Kode',width:100},    
               {field:'nm_brg',title:'Nama',width:200},    
               {field:'nilai',title:'Nilai',width:100},    
               {field:'keterangan',title:'Ket.',width:150},    
            ]],onSelect:function(rowIndex,rowData){
				kode	= rowData.kd_brg;
				nama	= rowData.nm_brg;
				nilai  	= rowData.nilai;
				ket	   	= rowData.keterangan;
				kd_barang.textContent = kode;
				nm_barang.textContent = nama;
				nil.textContent = nilai;
				$("#keterangan").textbox('setValue',ket);
			
			}
        });

    });
</script>