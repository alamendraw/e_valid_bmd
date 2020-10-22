$(document).ready(function(){
  $('#section_1').show();
  if (oto==1 || oto==4) {
    $('#header_ttd').show();
    document.getElementById('tools_ttd').style.display='inline';
  }

  document.getElementById("m20").style.display = "block";
  document.getElementById("m20").style.background = "linear-gradient(90deg, rgba(36,69,87,1) 0%, rgba(26,34,38,1) 100%)";
  document.getElementById("m20").style.boxShadow = "0px 6px 11px -3px rgba(0,0,0,0.57)";
  document.getElementById("s20").style.fontWeight = "bold";
  document.getElementById("s20").style.color = "white";
  $('.select2').select2({
  });

  $.ajax({
    url: 'Activity/get_skpd',
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
      url    : "Activity/get_user",
      type   : "POST",
      data   : function ( d ) {
        d.kd_skpd = $('#kd_skpd').val();
        d.activity = $('#activity').val();
      }
    },
    columnDefs: [{
      targets  : [ 0,3 ],
      orderable : false
    }]
  });

});


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
      url     : 'Activity/hapus',
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

function edit(activity,unit) {
  $.ajax({
    dataType: 'json',
    url     : 'Activity/edit',
    type    : 'POST',
    data    : {activity,unit},
    success : function(data){
      refresh();
    }
  });
}


