$(document).ready(function(){
  $('#section_1').show();
  if (oto==1 || oto==4) {
    $('#header_ttd').show();
    document.getElementById('tools_ttd').style.display='inline';
  }

  var d = document.getElementById("m13");
  d.className += " menu-open";
  document.getElementById("s13").style.display = "block";
  document.getElementById("sm15").style.color = "white";
  document.getElementById("sm15").style.fontWeight = "bold";
  $('.select2').select2({
  });

  $.ajax({
    url: 'Welcome/get_skpd',
    dataType: 'json',
    success: function(data){
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
      url    : "Ruang/get_ruang",
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
    url: 'Welcome/get_unit',
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
      $('#kd_unit').html(html);
    }
  });
}

function get_unit_2(kd_skpd) {
  $.ajax({
    url: 'Welcome/get_unit',
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
function get_kode(kd_unit) {
  $.ajax({
    url: 'Ruang/get_kode',
    dataType: 'json',
    type : 'POST',
    data: {kd_unit:kd_unit},
    success: function(data){
      $('#kd_ruang').val(data.kd_ruang);
      $('#no_urut').val(data.no_urut).attr('readOnly',true);
    }
  });
}
function hapus(kd_ruang,nm_ruang,kd_skpd,kd_unit){
  swal({
    title: "Anda Yakin ?",
    text: "Hapus ruang "+nm_ruang,
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
      data    : ({tabel:'mruang',kd_ruang,kd_skpd,kd_unit}),
      url     : 'ruang/hapus',
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
  $('#skpd').val('').trigger('change.select2').prop('disabled',false);
  $('#unit').val('').trigger('change.select2').prop('disabled',false);
  $('#kd_ruang').val('');
  $('#nm_ruang').val('');
  $('#no_urut').val('');
  $('#keterangan').val('');
  $('#modal_ruang').modal('toggle');
  $('#save').val(0);
}
function simpan(key) {
  var skpd       = $('#skpd').val();
  var unit       = $('#unit').val();
  var kd_ruang   = $('#kd_ruang').val();
  var nm_ruang   = $('#nm_ruang').val();
  var no_urut    = $('#no_urut').val();
  var keterangan = $('#keterangan').val();
  if (skpd=='') {
    swal('','Pilih SKPD!!!');
    return false;
  }
  if (unit=='') {
    swal('','Pilih UNIT!!!');
    return false;
  }
  if (nm_ruang=='') {
    swal('','Nama ruang masih kosong!!!');
    return false;
  }
  $.ajax({
    url: 'ruang/simpan',
    dataType: 'json',
    type    : 'POST',
    data: ({key,skpd,unit,kd_ruang,nm_ruang,no_urut,keterangan}),
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
function edit(kd_ruang,kd_skpd,kd_unit) {
  $.ajax({
    dataType: 'json',
    url     : 'ruang/get_detail',
    type    : 'POST',
    data    : {kd_ruang,kd_skpd,kd_unit},
    error: function(xhr, status, error) {
      var err = eval("(" + xhr.responseText + ")");
      swal("Error!",err.Message);
    },
    success : function(data){
      $('#save').val(1);
      $('#skpd').html('<option value="'+data[0].kd_skpd+'">'+data[0].kd_skpd+' | '+data[0].nm_skpd+'</option>').attr('disabled','disabled');
      $('#unit').html('<option value="'+data[0].kd_unit+'">'+data[0].kd_unit+' | '+data[0].nm_lokasi+'</option>').attr('disabled','disabled');
      $('#kd_ruang').val(data[0].kd_ruang).attr('readOnly','true');
      $('#nm_ruang').val(data[0].nm_ruang);
      $('#no_urut').val(data[0].no_urut);
      $('#keterangan').val(data[0].keterangan);
    }
  });
}
function tambah() {
  $('#skpd').prop('disabled',false);
  $('#unit').prop('disabled',false);
  $.ajax({
    url: 'Welcome/get_skpd',
    dataType: 'json',
    success: function(data){
      var html = '<option  selected value="">-SKPD-</option>';
      var i;
      for(i=0; i<data.length; i++){
        html += '<option value="'+data[i].kd_skpd+'">'+data[i].kd_skpd+' | '+data[i].nm_skpd+'</option>';
      }
      $('#skpd').html(html);
    }
  });
}

