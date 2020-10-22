$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  //$(this).ekkoLightbox();
  $(this).ekkoLightbox({
    alwaysShowClose: true,
    onShown: function() {
      console.log('Checking our the events huh?');
    },
    onNavigate: function(direction, itemIndex){
      console.log('Navigating '+direction+'. Current item: '+itemIndex);
    }

  });
});
$(document).ready( function() {
  if (oto==1 || oto==4) {
    document.getElementById('select').style.display='block';
  }
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
  var reload;
  $('#ada').show();
  $('#tidak_ada').hide();
  $('#section_1').show();
  $('.progress-bar').hide();
  $('[data-toggle="popover"]').popover().click(function () {
    setTimeout(function () {
      $('[data-toggle="popover"]').popover('hide');
    }, 5000);
  });
  $('[data-toggle="tooltip"]').tooltip();
  $("input[name='ket_stat_hukum']").hide();
  $("#no_surat_pol").hide();

  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
  });

});
function get_unit(kd_skpd) {

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
function refresh() {

  $('#dataTable_1').DataTable().ajax.reload(null, false);
  $('#dataTable_2').DataTable().ajax.reload(null, false);

}
function belum(){
  $('#section_table').show();
  $('#section_1').show();
  $('#section_2').hide();
  $('#section_3').hide();
  $('#dataTable_1').DataTable()
  .columns.adjust()
  .responsive.recalc();
}
function sudah(){
  $('#section_table').show();
  $('#section_1').hide();
  $('#section_2').show();
  $('#section_3').hide();
  $('#dataTable_2').DataTable()
  .columns.adjust()
  .responsive.recalc();
}
function ada() {
  $('#ada').show();
  $('#tidak_ada').hide();
}
function tidak_ada() {
  $('#ada').hide();
  $('#tidak_ada').show();
}
function uncheked_ada() {
  $(".radio_ada").prop("checked", false);
}
function uncheked_tidak_ada() {
  $(".radio_tidak_ada").prop("checked", false);
}
function reset_prog() {
  $('.progress-bar').hide();
  $('.progress-bar').width('0'+'%').html('0'+'%');
}
$(function() {
  $(document).on('change', ':file', function() {
    var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });
  $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {

      var input = $(this).parents('.input-group').find(':text'),
      log = numFiles > 1 ? numFiles + ' files selected' : label;

      if( input.length ) {
        input.val(log);
      } else {
        if( log ) alert(log);
      }
    });
  });
});

$(document).on('submit','form',function(e){
  e.preventDefault();

  $form = $(this);

  uploadImage($form);

});

function uploadImage($form){
  $form.find('.progress-bar').removeClass('progress-bar-success')
  .removeClass('progress-bar-danger');

  var formdata = new FormData($form[0]);
  var request = new XMLHttpRequest();


  request.upload.addEventListener('progress',function(e){
    var percent = Math.round(e.loaded/e.total * 100);
    $('.progress-bar').show();
    $form.find('.progress-bar').width(percent+'%').html(percent+'%');
  });


  request.addEventListener('load',function(e){
    $form.find('.progress-bar').addClass('progress-bar-success').html('upload completed....');
    setTimeout(function () {
      $form.find('.progress-bar').width('0%').html('');
    }, 2000);
    $("input[name='file_1']").val('');
    $("input[name='file_2']").val('');
    $("input[name='file_3']").val('');
    $("input[name='file_4']").val('');
    $("#file_1").val('');
    $("#file_2").val('');
    $("#file_3").val('');
    $("#file_4").val('');
    get_image();
  });

  request.open('post', 'Trkib_f/upload');
  request.send(formdata);

  $form.on('click','.cancel',function(){
    request.abort();

    $form.find('.progress-bar')
    .addClass('progress-bar-danger')
    .removeClass('progress-bar-success')
    .html('upload aborted...');
  });

}
$(document).ready(function(){
  var d = document.getElementById("m2");
  d.className += " menu-open";
  document.getElementById("s2").style.display = "block";
  document.getElementById("sm8").style.color = "white";
  document.getElementById("sm8").style.fontWeight = "bold";

  $('#dataTable_1').DataTable({ 
    
    "processing": true,
    "serverSide": true,
    "responsive": true,
    "order"     : [],
    "autoWidth" : false,
    "ajax": {
      "url": "Trkib_f/get_trkib_f_non",
      "type": "POST",
      data   : function ( d ) {
        d.kd_skpd = $('#kd_skpd').val();
        d.kd_unit = $('#kd_unit').val();
      }
    },
    "columnDefs": [{
      "targets"   : [ 0,8 ],
      "orderable" : false,
    }]
  });

  $('#dataTable_2').DataTable({ 
    
    "processing": true,
    "serverSide": true,
    "responsive": true,
    "order"     : [],
    "autoWidth" : false,
    "ajax": {
      "url": "Trkib_f/get_trkib_f",
      "type": "POST",
      data   : function ( d ) {
        d.kd_skpd = $('#kd_skpd').val();
        d.kd_unit = $('#kd_unit').val();
      }
    },
    "columnDefs": [{
      "targets"   : [ 0,8 ],
      "orderable" : false,
    }]
  });

});
function sensus(id_barang,key){
  $('#section_table').hide();
  $('#section_1').hide();
  $('#section_2').hide();
  $('#section_3').show();
  reload = key;
  $.ajax({
    dataType : 'json',
    type : 'POST',
    data : {id_barang},
    url : 'Trkib_f/get_Trkib_f_id_non',
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
      $('#id_brg').val(data[0].id_barang);
      $('#id_brg2').val(data[0].id_barang);
      $('#nm_brg').val(data[0].nm_brg);

      if (data[0].detail_brg2=='' || data[0].detail_brg2==null) {
        $('#dtl_brg').val(data[0].detail_brg);
      }else{
        $('#dtl_brg').val(data[0].detail_brg2);
      } $('#dtl_brg_awal').text(data[0].detail_brg);

      if (data[0].bangunan2=='' || data[0].bangunan2==null) {
        $('#bangunan').val(data[0].bangunan);
      }else{
        $('#bangunan').val(data[0].bangunan2);
      } $('#bangunan_awal').text(data[0].bangunan);

      if (data[0].konstruksi2=='' || data[0].konstruksi2==null) {
        $('#konstruksi').val(data[0].konstruksi);
      }else{
        $('#konstruksi').val(data[0].konstruksi2);
      } $('#konstruksi_awal').text(data[0].konstruksi);

      if (data[0].jenis2=='' || data[0].jenis2==null) {
        $('#jns_gedung').val(data[0].jenis);
      }else{
        $('#jns_gedung').val(data[0].jenis2);
      } $('#jns_gedung_awal').text(data[0].jenis);

      if (data[0].luas2=='' || data[0].luas2==null) {
        $('#luas').val(data[0].luas);
      }else{
        $('#luas').val(data[0].luas2);
      } $('#luas_awal').text(data[0].luas);

      if (data[0].alamat=='' || data[0].alamat==null) {
        $('#alamat').val(data[0].alamat1);
      }else{
        $('#alamat').val(data[0].alamat);
      } $('#alamat_awal').text(data[0].alamat1);

      if (data[0].lat2=='' || data[0].lat2==null) {
        $('#lat').val(data[0].lat);
      }else{
        $('#lat').val(data[0].lat2);
      } $('#lat_awal').text(data[0].lat);

      if (data[0].lon2=='' || data[0].lon2==null) {
        $('#lon').val(data[0].lon);
      }else{
        $('#lon').val(data[0].lon2);
      } $('#lon_awal').text(data[0].lon);

      if (data[0].tgl_awal_kerja2=='' || data[0].tgl_awal_kerja2==null) {
        $('#tgl_mulai').val(data[0].tgl_awal_kerja);
      }else{
        $('#tgl_mulai').val(data[0].tgl_awal_kerja2);
      } $('#tgl_mulai_awal').text(data[0].tgl_awal_kerja);

      if (data[0].keterangan2=='' || data[0].keterangan2==null) {
        $('#ket').val(data[0].keterangan);
      }else {
        $('#ket').val(data[0].keterangan2);
      } $('#ket_awal').text(data[0].keterangan);

      $('#kronologis').val(data[0].kronologis);

      $('#asal').val(data[0].asal);
      $('#thn_oleh').val(data[0].tahun);
      $('#nilai_oleh').val(formatNumber(data[0].nilai));
      $('#kondisi_awal').val(data[0].kondisi);

      if (data[0].no_sensus=='' || data[0].no_sensus==null) {
        $('#no_header').hide();
        $('#no_header').text("");
      }else {
        $('#no_header').text("F-"+data[0].no_sensus);
        $('#no_header').show();
      }
      if (data[0].stat_fisik==1 || data[0].stat_fisik==null) {
        $('input:radio[name=stat_fisik]').filter('[value='+data[0].stat_fisik+']').prop('checked', true);
        ada();
      }else{
        $('input:radio[name=stat_fisik]').filter('[value='+data[0].stat_fisik+']').prop('checked', true);
        tidak_ada();
      }
      $('input:radio[value="'+data[0].keberadaan_brg+'"]').prop('checked', true);
      $('input:radio[value='+data[0].kondisi_brg+']').prop('checked', true);
      $('input:radio[value="'+data[0].stat_hukum+'"]').prop('checked', true);
      if (data[0].stat_hukum=='Dalam Gugatan Hukum') {
        $("#ket_stat_hukum").show();
        $("#ket_stat_hukum").val(data[0].ket_stat_hukum);
      }
      $('input:radio[value="'+data[0].bukti_milik+'"]').prop('checked', true);
      $('input:radio[value="'+data[0].status_milik+'"]').prop('checked', true);
      $('input:radio[value="'+data[0].ket_brg+'"]').prop('checked', true);
      if (data[0].ket_brg=='Hilang') {
        $("#no_surat_pol").show();
        $("#no_surat_pol").val(data[0].no_surat_pol);
      }
      if (reload=='edit') {
        document.getElementById("batal_sensus").style.display='inline';
        document.getElementById("simpan_edit").style.display='none';
        $(".img-overlay").hide();
      }else{
        document.getElementById("batal_sensus").style.display='none';
        document.getElementById("simpan_edit").style.display='inline';
        $(".img-overlay").show();
      }
      if ((activity==0 || activity=='' || activity==null)) {
        document.getElementById("simpan_main").style.display='none';
        document.getElementById("simpan_edit").style.display='none';
        document.getElementById("batal_sensus").style.display='none';
      }else{
        document.getElementById("simpan_main").style.display='inline';
        document.getElementById("simpan_edit").style.display='inline';
        
      }
      get_image();
    }
  });
}
function batal(){
  $('#section_table').show();
  if (reload=='sensus') {
    $('#section_1').show();
    $('#section_2').hide();
    $('#section_3').hide();
  }else{
    $('#section_1').hide();
    $('#section_2').show();
    $('#section_3').hide();
  }
  $('#id_brg').val('');
  $('#id_brg2').val('');
  $('#nm_brg').val('');
  $('#dtl_brg').val('');
  $('#dtl_brg_awal').val('');
  $('#bangunan').val('');
  $('#bangunan_awal').val('');
  $('#konstruksi').val('');
  $('#konstruksi_awal').val('');
  $('#jns_gedung').val('');
  $('#jns_gedung_awal').val('');
  $('#luas').val('');
  $('#luas_awal').val('');
  $('#alamat').val('');
  $('#alamat_awal').val('');
  $('#lat').val('');
  $('#lat_awal').val('');
  $('#lon').val('');
  $('#lon_awal').val('');
  $('#tgl_mulai').val('');
  $('#tgl_mulai_awal').val('');
  $('#ket').val('');
  $('#ket_awal').val('');
  $('#kronologis').val('');
  $('.progress-bar').width('0'+'%').html('0'+'%');
  $('.progress-bar').hide();
  $('#img1').attr('src','');
  $('#img2').attr('src','');
  $('#img3').attr('src','');
  $('#img4').attr('src','');
  $('input:radio[name=stat_fisik][value=1]').prop('checked', true);
  $('input:radio[name=keberadaan_brg]').prop('checked', false);
  $('input:radio[name=kondisi_brg]').prop('checked', false);
  $('input:radio[name=stat_hukum]').prop('checked', false);
  $("#ket_stat_hukum").val('');
  $('input:radio[name=bukti_milik]').prop('checked', false);
  $('input:radio[name=status_milik]').prop('checked', false);
  $('input:radio[name=ket_brg]').prop('checked', false);
  $('#no_surat_pol').val('');
  $("#no_surat_pol").hide();
}
function submit(stat_submit) {
 var id_brg         = $('#id_brg').val();
 var dtl_brg        = $('#dtl_brg').val();
 var bangunan       = $('#bangunan').val();
 var konstruksi     = $('#konstruksi').val();
 var jns_gedung     = $('#jns_gedung').val();
 var luas           = $('#luas').val();
 var alamat         = $('#alamat').val();
 var lat            = $('#lat').val();
 var lon            = $('#lon').val();
 var tgl_mulai      = $('#tgl_mulai').val();
 var ket            = $('#ket').val();
 var kronologis     = $('#kronologis').val();
 var stat_fisik     = $("input[name='stat_fisik']:checked").val();
 
 var keberadaan_brg = $("input[name='keberadaan_brg']:checked").val();
 var kondisi_brg    = $("input[name='kondisi_brg']:checked").val();
 var stat_hukum     = $("input[name='stat_hukum']:checked").val();
 var ket_stat_hukum = $('#ket_stat_hukum').val();
 var bukti_milik    = $("input[name='bukti_milik']:checked").val();
 var status_milik    = $("input[name='status_milik']:checked").val();
 var ket_brg        = $("input[name='ket_brg']:checked").val();
 var no_surat_pol   = $('#no_surat_pol').val();

 if (stat_fisik==1 && stat_submit==1) {

  if (keberadaan_brg==null) {
    swal('','Keberadaan barang belum dipilih!');
    return false;
  }
  if(kondisi_brg==null){
    swal('','Kondisi barang belum dipilih!');
    return false;
  }
  if(stat_hukum==null){
    swal('','Permasalahan Hukum belum dipilih!');
    return false;
  }
  if(status_milik==null){
    swal('','Status Kepemilikan belum dipilih!');
    return false;
  }

}else if(stat_fisik==0 && stat_submit==1){
  if (ket_brg==null) {
    swal('','Keterangan belum dipilih!');
  }
}

$.ajax({
  url:"Trkib_f/simpan_Trkib_f",
  method : "post",
  data:{stat_submit,id_brg,dtl_brg,bangunan,konstruksi,jns_gedung,luas,alamat,lat,lon,tgl_mulai,ket,kronologis,stat_fisik,keberadaan_brg,kondisi_brg,stat_hukum,bukti_milik,status_milik,ket_brg,ket_stat_hukum,no_surat_pol},
  async:false,
  dataType:"JSON",
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
  success: function(data){
    swal({
      title: data.title,
      text : data.msg,
      type : data.type},
      function(){ 
        if (data.type!='error') {
          $('#section_table').show();
          if (reload=='sensus') {
            $('#section_1').show();
            $('#section_2').hide();
            $('#section_3').hide();
          }else{
            $('#section_1').hide();
            $('#section_2').show();
            $('#section_3').hide();
          }
          $('input:radio[name=stat_fisik][value=1]').prop('checked', true);
          $('#dataTable_1').DataTable().ajax.reload(null, false);
          $('#dataTable_2').DataTable().ajax.reload(null, false);
          batal();
        }
      });
  }
});

}
function batal_sensus() {
  var id_brg = $('#id_brg').val();
  var nm_brg = $('#nm_brg').val();
  var dtl_brg = $('#dtl_brg').val();
  swal({
    title: "Anda yakin membatalkan sensus?",
    text:  nm_brg+" / "+dtl_brg,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya Batal",
    closeOnConfirm: false
  },
  function(){
    $.ajax({
      url:"Trkib_f/batal_trkib_f",
      method : "post",
      data:{id_brg},
      async:false,
      dataType:"JSON",
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
      success: function(data){
        swal({
          title: data.title,
          text : data.msg,
          type : data.type},
          function(){ 
            $('#section_1').hide();
            $('#section_2').show();
            $('#section_3').hide();
            $('input:radio[name=stat_fisik][value=1]').prop('checked', true);
            $('#dataTable_1').DataTable().ajax.reload(null, false);
            $('#dataTable_2').DataTable().ajax.reload(null, false);
            batal();
          });
      }
    });
  });
}
popup = {
  init: function(){
    $('figure').click(function(){
      popup.open($(this));
    });
    
    $(document).on('click', '.popup img', function(){
      return false;
    }).on('click', '.popup', function(){
      popup.close();
    })
  },
  open: function($figure) {
    $('.gallery').addClass('pop');
    $popup = $('<div class="popup" />').appendTo($('body'));
    $fig = $figure.clone().appendTo($('.popup'));
    $bg = $('<div class="bg" />').appendTo($('.popup'));
    $close = $('<div class="close"><svg><use xlink:href="#close"></use></svg></div>').appendTo($fig);
    $shadow = $('<div class="shadow" />').appendTo($fig);
    src = $('img', $fig).attr('src');
    $shadow.css({backgroundImage: 'url(' + src + ')'});
    $bg.css({backgroundImage: 'url(' + src + ')'});
    setTimeout(function(){
      $('.popup').addClass('pop');
    }, 10);
  },
  close: function(){
    $('.gallery, .popup').removeClass('pop');
    setTimeout(function(){
      $('.popup').remove()
    }, 100);
  }
}

popup.init();

function get_image() {
  document.getElementById("page_1").style.display = "none";
  document.getElementById("page_2").style.display = "none";
  document.getElementById("page_3").style.display = "none";
  document.getElementById("page_4").style.display = "none";
  var id_brg = $('#id_brg').val();
  $.ajax({
    dataType : 'json',
    type : 'POST',
    data : {id_brg:id_brg},
    url : "Trkib_f/get_image",
    success : function(data){
      swal.close();
      $('#img1').attr('src',data.foto1);
      $('#img2').attr('src',data.foto2);
      $('#img3').attr('src',data.foto3);
      $('#img4').attr('src',data.foto4);
      $('#herf_1').attr('href',data.foto1);
      $('#herf_2').attr('href',data.foto2);
      $('#herf_3').attr('href',data.foto3);
      $('#herf_4').attr('href',data.foto4);
      if (data.page_1==0) {document.getElementById("page_1").style.display = "none";}else{document.getElementById("page_1").style.display = "block";}
      if (data.page_2==0) {document.getElementById("page_2").style.display = "none";}else{document.getElementById("page_2").style.display = "block";}
      if (data.page_3==0) {document.getElementById("page_3").style.display = "none";}else{document.getElementById("page_3").style.display = "block";}
      if (data.page_4==0) {document.getElementById("page_4").style.display = "none";}else{document.getElementById("page_4").style.display = "block";}
    }
  });
}
function hapus_image(no,field){
  var id = $('#id_brg').val();
  swal({
    title: "Anda Yakin ?",
    text: "Hapus Gambar "+no,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya Hapus",
    closeOnConfirm: false
  },
  function(){
    $.ajax({
      dataType : 'json',
      type : 'POST',
      data : ({tabel:'trkib_f',field,id}),
      url : 'trkib_f/hapus_image',
      success : function(data){
        get_image();
      }
    });
  });
}


$('input[name=stat_hukum][value="Tidak Dalam Gugatan Hukum"]').click(function(){
  $("#ket_stat_hukum").hide();
});
$('input[name=stat_hukum][value="Dalam Gugatan Hukum"]').click(function(){
  $("#ket_stat_hukum").show();
});

$('input[name=ket_brg][value=Hilang]').click(function(){
  $("#no_surat_pol").show();
});
$('input[name=ket_brg][value="Tidak Diketahui Keberadaannya"]').click(function(){
  $("#no_surat_pol").hide();
});
$('input[name=ket_brg][value="Habis Akibat Usia Barang"]').click(function(){
  $("#no_surat_pol").hide();
});
$('input[name=ket_brg][value="Seharusnya Telah dihapus"]').click(function(){
  $("#no_surat_pol").hide();
});


function formatNumber(num) {
  return 'Rp. '+num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

var map;

function initialize() {
  if ($("#lat").val() !='' && $("#lon").val() !='') {
    var latitude  = $('#lat').val();
    var longitude = $('#lon').val();
  }else if($("#lat_awal").val() !='' && $("#lon_awal").val() !=''){
    var latitude  = $('#lat_awal').val();
    var longitude = $('#lon_awal').val();
  }else{
    var latitude  = -5.149006;
    var longitude = 119.435707;
  }

  var haightAshbury = new google.maps.LatLng(latitude, longitude);
  var mapOptions = {
    zoom: 15,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map'),
    mapOptions);


  var clickmarker = new google.maps.Marker({
    position: haightAshbury,
    map:map,
    draggable: true
  });

  google.maps.event.addListener(map, 'click', function(event) {

    clickmarker.setPosition(event.latLng);
    clickmarker.setMap(map);
    clickmarker.setAnimation(google.maps.Animation.DROP);
    var lat = clickmarker.getPosition().lat();
    var lng = clickmarker.getPosition().lng();
    $("#lat").val(lat);
    $("#lon").val(lng)


  });
  google.maps.event.addListener(clickmarker, 'drag', function() {
    var lat = clickmarker.getPosition().lat();
    var lng = clickmarker.getPosition().lng();
    $("#lat").val(lat);
    $("#lon").val(lng)
  });


  google.maps.event.addDomListener(window, 'load', initialize);
}