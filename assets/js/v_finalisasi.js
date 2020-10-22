$(document).ready(function(){


  var d = document.getElementById("m2");
  d.className += " menu-open";
  document.getElementById("s2").style.display = "block";
  document.getElementById("sm30").style.color = "white";
  document.getElementById("sm30").style.fontWeight = "bold";

});

function edit() {
  swal({
    title:'',
    text             : "Anda yakin ingin mengunci sensus?",
    type              : "warning",
    showCancelButton  : true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText : "Ya",
    closeOnConfirm    : false
  },
  function(){
    $.ajax({
      dataType: 'json',
      url     : 'Finalisasi/edit',
      type    : 'POST',
      data    : {activity,oto_unit},
      success : function(data){
        if (data==true) {
          swal({
          title: 'Sensus Selesai',
          text : '',
          type : 'success'
          },
          function () {
            location.reload();
          });

        }else{
          swal({
          title: 'Terjadi Kesalahan',
          text : '',
          type : 'error'
          });
        }
      }
    });
  });
  
}


