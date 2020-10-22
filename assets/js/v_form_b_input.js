$(document).ready( function() {

      $('#rincian').combogrid({
        panelWidth:550,  
        idField:'kd_brg',  
        textField:'uraian',  
        mode:'remote',
        url:'trkib_b_input/get_rincian', 
        queryParams:({akun:'1',kelompok:'3',jenis:'2'}),      
        columns:[[  
        {field:'kd_brg',title:'Kode',width:70},  
        {field:'uraian',title:'Rincian Objek',width:470}    
        ]],
        onSelect:function(rowIndex,rowData){
          // xbidang                = rowData.rincian_objek;
          // nm_rincian.textContent = rowData.nm_bidang; 
          // $("#kd_barang").val('');
          // $("#nm_barang").text('');
        },onChange: function(rowIndex,rowData){
          // xbidang                = rowData.rincian_objek;
          // nm_rincian.textContent = rowData.nm_bidang; 
        }
      });

      $('#milik').combogrid({ 
        idField:'kd_milik',  
        textField:'nm_milik',  
        url:'trkib_b_input/get_milik',
        mode:'remote',
        columns:[[  
        {field:'kd_milik',title:'Kode',width:150},  
        {field:'nm_milik',title:'Uraian',width:200}    
        ]]
      });

      $('#wil').combogrid({
        panelWidth:350,
        idField:'kd_wilayah',
        textField:'nm_wilayah',
        mode:'remote',
        url:'trkib_b_input/get_wilayah',
        queryParams:({akun:'1',kelompok:'3',jenis:'2'}),
        columns:[[
        {field:'kd_wilayah',title:'Kode',width:150},
        {field:'nm_wilayah',title:'Uraian',width:200}
        ]]
      });

      $('#kd_skpd').combogrid({
        panelWidth:600,  
        idField:'kd_skpd',  
        textField:'nm_skpd',  
        mode:'remote',
        url: 'trkib_b_input/get_skpd',
        columns:[[  
        {field:'kd_skpd',title:'KODE SKPD',width:200},  
        {field:'nm_skpd',title:'NAMA SKPD',width:400}    
        ]],  
        onSelect:function(rowIndex,rowData){
             kd_skpd = rowData.kd_skpd;
             $('#kd_unit').combogrid({url:'trkib_b_input/get_unit',
               queryParams:({kd_skpd:kd_skpd})
             });
             // $('#kd_ruang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getRuang',
             //   queryParams:({kd_skpd:kd_skpd,kd_unit:''})
             // });

       },onChange: function(){
            var kd_skpd = $('#kd_skpd').val();
            $('#kd_unit').combogrid({url:'trkib_b_input/get_unit',
             queryParams:({kd_skpd:kd_skpd})
            });
           //  $('#kd_ruang').combogrid({url:'<?php echo base_url(); ?>transaksi/C_Kibb/getRuang',
           //   queryParams:({kd_skpd:kd_skpd,kd_unit:''})
           // });
      }
      });

      $('#kd_unit').combogrid({
        panelWidth:600,  
        idField:'kd_unit',  
        textField:'nm_unit',
        mode:'remote',
        columns:[[  
        {field:'kd_unit',title:'KODE UNIT',width:200},  
        {field:'nm_unit',title:'NAMA UNIT',width:400}    
        ]],  
        onSelect:function(rowIndex,rowData){
        }  
      });

      $('#perolehan').combogrid({
        panelWidth:350,  
        idField:'cara_peroleh',  
        textField:'cara_peroleh',  
        mode:'remote',
        url:'trkib_b_input/get_oleh', 
        columns:[[  
        {field:'kd_cr_oleh',title:'Kode',width:150},  
        {field:'cara_peroleh',title:'Uraian',width:200}    
        ]]
      });
      $('#ket_matriks').combogrid({
        panelWidth:'25%',  
        idField:'kode',  
        textField:'ket_matriks',  
        mode:'remote',
        url:'trkib_b_input/get_matriks', 
        columns:[[  
        {field:'kode',title:'Kode',width:'20%'},  
        {field:'ket_matriks',title:'Ket Matriks',width:'80%'}
        ]]
      });
      $('#dasar').combogrid({
        panelWidth:350,  
        idField:'dasar_peroleh',  
        textField:'dasar_peroleh',  
        mode:'remote',
        url:'trkib_b_input/get_dasar',
        columns:[[  
        {field:'kode',title:'Kode',width:150},
        {field:'dasar_peroleh',title:'Uraian',width:200}
        ]]
      });
      $('#upload').filebox({
        buttonText: 'Choose File',
        buttonAlign: 'right'
      });
      $('#thn_oleh').datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy',
        autoclose:true
      });

      $('#tgl_regis').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true
      });

      $('#tgl_oleh').datepicker({
        format: 'dd-mm-yyyy',
        inline: true,
        autoclose:true
      }).on("changeDate", function (e) {
        var date = $(this).datepicker('getDate'),
        day  = date.getDate(),  
        month = date.getMonth() + 1,              
        year =  date.getFullYear();
        var tgl_oleh = new Date(year+"/"+month+"/"+day);
        var tgl_reg  = new Date($('#tgl_regis').val().split("-").reverse().join("/"));
        if(tgl_reg<tgl_oleh){
          alert("Cek Kembali Tgl Register.! Tidak boleh sebelum Tgl Perolehan.");
        }

        $("#thn_oleh").val(year).readOnly = true; 
        document.getElementById('thn_oleh').readOnly = true;
      });

      $('#tgl_stnk').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true
      });

      $('#tgl_bpkb').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true
      });

      $('#tgl_regis').val(getToday());
      function getToday() {
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var output = ((''+day).length<2 ? '0' : '') + day + '-' +
                   ((''+month).length<2 ? '0' : '') + month + '-' +
                   d.getFullYear();
      return output;
     }
     $('#warna').combogrid({
      panelWidth:350,  
      idField:'kd_warna',  
      textField:'nm_warna',  
      mode:'remote',
      url:'trkib_b_input/get_warna',  
      columns:[[  
      {field:'kd_warna',title:'KODE WARNA',width:150},  
      {field:'nm_warna',title:'NAMA WARNA',width:200}    
      ]]
    });

     $('#bahan').combogrid({
      panelWidth:350,  
      idField:'kd_bahan',  
      textField:'nm_bahan',  
      mode:'remote',
      url:'trkib_b_input/get_bahan',  
      columns:[[  
      {field:'kd_bahan',title:'KODE BAHAN',width:150},  
      {field:'nm_bahan',title:'NAMA BAHAN',width:200}    
      ]]
    });

     $('#kondisi').combogrid({
      panelWidth:350,  
      idField:'kondisi',  
      textField:'kondisi',  
      mode:'remote',
      url:'trkib_b_input/get_kondisi',  
      columns:[[  
      {field:'kode',title:'KODE KONDISI',width:150},  
      {field:'kondisi',title:'NAMA KONDISI',width:200}    
      ]]
    });
     $('#satuan').combogrid({
      panelWidth:350,  
      idField:'nm_satuan',  
      textField:'nm_satuan',  
      mode:'remote',
      url:'trkib_b_input/get_satuan',  
      columns:[[  
      {field:'kd_satuan',title:'KODE SATUAN',width:150},  
      {field:'nm_satuan',title:'SATUAN',width:200}    
      ]],  
      onSelect:function(rowIndex,rowData){
      } 
    });


});/*$(document).ready*/

function simpan() {
  $(document).ready(function() {
    $('#fm').form('submit', {
      url: 'trkib_b_input/simpan', 
      onSubmit: function() {
      },
      success: function (data) {
      }

    });
  });
}
function getBarang(){  
  xkey  = $("#keyword").val(); 
  rinci = $("#rincian").combogrid('getValue');
  if(rinci==''){
    iziToast.error({
      title: 'Error',
      message: 'Pilih Objek Terlebih Dahulu',
    });
    return
  }
  $('#dgBarang').datagrid({
    width: '100%',
    height: '300',
    rownumbers: true,
    remoteSort: false,
    singleSelect:true,
    nowrap: true,
    pagination: true,
    url:'trkib_b_input/load_barang',
    queryParams:({akun:'1',kelompok:'3',jenis:'2',key:xkey,rinci:rinci}),
    loadMsg: 'Tunggu Sebentar ... !', 
    frozenColumns:[[
    {field:'ck',title:'',width:1,align:'center',checkbox:true},
    ]],
    columns:[[
    {field:'kd_brg', title:'Kode', width:220, align:"left"},
    {field:'nm_brg',title:'Nama Barang',width:620,align:"left"}
    ]],
    onSelect:function(rowIndex,rowData){  
      $("#kd_barang").val(rowData.kd_brg);
      $("#nm_barang").text(rowData.nm_brg);
      // max_number(rowData.kd_brg);
    }  

  });
  $('#dlg').dialog('open').dialog('center').dialog('setTitle','Pilih Barang');
}

function galery() {
        $('#galery').dialog('open').dialog('center').dialog('setTitle','');
    }
    function myFunction(imgs,text) {
      var expandImg = document.getElementById("expandedImg");
      var imgText = document.getElementById("imgtext");
      var bg = imgs.style.backgroundImage;
      expandImg.src = bg.replace('url("','').replace('")','');
      imgText.innerHTML = text;
      expandImg.parentElement.style.display = "block";
    }
    function hapus(field) {
    $.messager.confirm('Konfirmasi','Yakin ingin menghapus foto ini?',function(r){
        if (r){
            $.ajax({
                url:'trkib_b_input/hapus_img',
                type:'POST',
                dataType:'JSON',
                data:{field,'id_barang':id_brg},
                success: function(data) {
                    if (data.pesan) {
                        iziToast.success({
                            title: 'OK',
                            message: data.message,
                            timeout: 1500
                        });
                        localStorage.setItem(field,'');
                        $('#'+field+'d').css('display','none');
                    }else {
                        iziToast.error({
                            title: 'error',
                            message: data.message,
                            timeout: 1500
                        });
                    }
                }
            });
        }
    });
}