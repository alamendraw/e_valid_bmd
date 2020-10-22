$(document).ready(function(){
  $('#section_1').show();
  if (oto==1 || oto==4) {
    $('#header_ttd').show();
    document.getElementById('tools_ttd').style.display='inline';
  }

  var d = document.getElementById("m13");
  d.className += " menu-open";
  document.getElementById("s13").style.display = "block";
  document.getElementById("sm14").style.color = "white";
  document.getElementById("sm14").style.fontWeight = "bold";
  $('.select2').select2({
  });

  $.ajax({
    url: 'Ttd/get_skpd',
    dataType: 'json',
    success: function(data){
      refresh()
      var html = '<option  selected value="">-SKPD-</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value="'+data[i].kd_skpd+'">'+data[i].kd_skpd+' | '+data[i].nm_skpd+'</option>';
      }
      $('#kd_skpd').html(html);
    }
  });

  $('#dataTable_1').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    order     : [],
    autoWidth : true,
    ajax: {
      url    : "Ttd/get_ttd",
      type   : "POST",
      data   : function ( d ) {
        d.kd_skpd = $('#kd_skpd').val();
        d.kd_unit = $('#kd_unit').val();
      }
    },
    columnDefs: [{
      targets  : [ 0,7 ],
      orderable : false,
    },
    {
      targets: 7,
      className: "text-center",
      orderable : false
    }]
  });

});

function get_unit(kd_skpd) {
  if ($('#kd_skpd').val()=='') {
    $('#grid_kd_unit').hide();
  }else{
    $('#grid_kd_unit').show();
  }
  $.ajax({
    url: 'Ttd/get_unit',
    dataType: 'json',
    type : 'POST',
    data: {kd_skpd:kd_skpd},
    success: function(data){
      swal.close();
      refresh()
      var html = '<option selected value="">-UNIT-</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value="'+data[i].kd_lokasi+'">'+data[i].kd_lokasi+' | '+data[i].nm_lokasi+'</option>';
      }
      $('#kd_unit').html(html);
    }
  });
}

function get_unit_2(kd_skpd) {
  $.ajax({
    url: 'Ttd/get_unit',
    dataType: 'json',
    type : 'POST',
    data: {kd_skpd:kd_skpd},
    success: function(data){
      swal.close();
      var html = '<option selected value="">-UNIT-</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value="'+data[i].kd_lokasi+'">'+data[i].kd_lokasi+' | '+data[i].nm_lokasi+'</option>';
      }
      $('#unit').html(html);
    }
  });
}

function refresh() {
  $('#dataTable_1').DataTable().ajax.reload(null, false);
}
function hapus(nip,nama,skpd,unit){
  swal({
    title: "Anda Yakin ?",
    text: "Hapus Nama "+nama,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya Hapus",
    closeOnConfirm: false
  },
  function(){
    $.ajax({
      dataType: 'json',
      type    : 'POST',
      data    : ({tabel:'ttd',nip,skpd,unit}),
      url     : 'Ttd/hapus',
      beforeSend: function (data) {
        swal({
          title            : 'Mohon tunggu..!',
          imageUrl         : '../assets/sweetalert/lib/loader.gif',
          allowOutsideClick: false,
          allowEscapeKey   : false,
          allowEnterKey    : false,
          showConfirmButton: false,
        })
      },
      success : function(data){
        swal.close();
        $('#dataTable_1').DataTable().ajax.reload(null, false);
      }
    });
  });
}
function close_modal() {
  $('#skpd').val('').trigger('change.select2');
  $('#unit').val('').trigger('change.select2');
  $('#nip').val('').attr('readOnly',false);
  $('#nama').val('');
  $('#jabatan').val('').trigger('change.select2');
  $('#modal_ttd').modal('toggle');
  $('#save').val(0);
}
function simpan(key) {
  var skpd         = $('#skpd').val();
  var unit         = $('#unit').val();
  var nip          = $('#nip').val();
  var nama         = $('#nama').val();
  var jabatan      = $("#jabatan option:selected").html();
  var kode_jabatan = $('#jabatan').val();
  if (skpd=='') {
    swal('','Pilih SKPD!!!');
    return false;
  }
  if (unit=='') {
    swal('','Pilih UNIT!!!');
    return false;
  }
  if (jabatan=='') {
    swal('','Pilih JABATAN!!!');
    return false;
  }
  if (nip=='' || nip==' ' || nip=='_' || nip=='-') {
    swal('','NIP tidak sesuai!!!');
    return false;
  }
  if (nama=='' || nama==' ' || nama=='_' || nama=='-') {
    swal('','Nama tidak boleh kosong!!!');
    return false;
  }
  $.ajax({
    url: 'Ttd/simpan',
    dataType: 'json',
    type    : 'POST',
    data: ({key,skpd,unit,nip,nama,jabatan,kode_jabatan}),
    beforeSend: function (data) {
      swal({
        title            : 'Mohon tunggu..!',
        imageUrl         : '../assets/sweetalert/lib/loader.gif',
        allowOutsideClick: false,
        allowEscapeKey   : false,
        allowEnterKey    : false,
        showConfirmButton: false
      })
    },
    success: function(data){
      $('#save').val(0);
      if (data==true) {
        $('#dataTable_1').DataTable().ajax.reload(null, false);
        close_modal();
      }else{
        swal({
          title: 'Ops!',
          text : 'Gagal!',
          type : 'error'
        });
      }
    }
  });
}
function edit(nip,skpd,unit) {
  $.ajax({
    dataType: 'json',
    url     : 'Ttd/get_detail',
    type    : 'POST',
    data    : {nip,skpd,unit},
    error: function(xhr, status, error) {
      var err = eval("(" + xhr.responseText + ")");
      swal("Error!",err.Message);
    },
    success : function(data){
      $('#save').val(1);
      $('#skpd').html('<option value="'+data[0].skpd+'">'+data[0].skpd+' | '+data[0].nm_skpd+'</option>').attr('readOnly','true');
      $('#unit').html('<option value="'+data[0].unit+'">'+data[0].unit+' | '+data[0].nm_lokasi+'</option>').attr('readOnly','true');
      $('#nip').val(data[0].nip).attr('readOnly','readOnly');
      $('#nama').val(data[0].nama);
      $('#jabatan').val(data[0].ckey).trigger('change.select2');
    }
  });
}
function tambah() {
  $('#nip').attr('readOnly',false);
  $.ajax({
    url: 'Ttd/get_skpd',
    dataType: 'json',
    success: function(data){
      refresh()
      var html = '<option  selected value="">-SKPD-</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value="'+data[i].kd_skpd+'">'+data[i].kd_skpd+' | '+data[i].nm_skpd+'</option>';
      }
      $('#skpd').html(html);
    }
  });
}

