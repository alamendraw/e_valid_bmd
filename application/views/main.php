<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VALIDASI BMD</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo base_url(); ?>assets/images/logo2.png" rel="shortcut icon">
  <script src="<?php echo base_url(); ?>assets/ajax/jquery.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/admin/css/skins/_all-skins.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" >
  <link href="<?php echo base_url(); ?>assets/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
<!--   <link href="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/css/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url(); ?>assets/datatables/Responsive-2.2.2/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/> -->
  <link href="<?php echo base_url(); ?>assets/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/number/number.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/lightbox/lightbox.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/iziToast/iziToast.min.css" rel="stylesheet">

<?php
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
if (isset($uri_segments[3])=='transaksi') {
?>
  <!--Easy UI-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/bootstrap/easyui.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/icon.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/color.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/demo/demo.css"> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/easyui/datagrid-detailview.js"></script>
<?php
}
?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143601343-1"></script>
<script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-143601343-1');
</script> -->
</head>
<body class="hold-transition skin-blue fixed sidebar-mini sidebar-collapse">
<script type="text/javascript">
  $(function () {
    var side = localStorage.getItem('side');
    if (side==1) {
      if ($("body").hasClass("sidebar-collapse")==false) {
        $("body").addClass('sidebar-collapse');
      }
    }else{
      if ($("body").hasClass("sidebar-collapse")==true) {
        $("body").removeClass('sidebar-collapse');
      }
    }
    $(".sidebar-toggle").on('click',function () {
      if ($("body").hasClass("sidebar-collapse")==false) {
        localStorage.setItem('side',1);
      }else{
        localStorage.setItem('side',0);
      }
    })
  });
</script>
  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url(); ?>" class="logo">
        <span class="logo-mini"><img src="<?php echo base_url(); ?>/assets/images/logo2.png" width="30px"></span>
        <span class="logo-lg"><img src="<?php echo base_url(); ?>/assets/images/logo.png" width="200px"></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
         <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
       </a>
       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="white-space: nowrap">
              <b>
                <?php
                  if (strlen($_SESSION['ket'])>24) {
                    echo substr($_SESSION['ket'],0,24).'...';
                  }else{
                    echo $_SESSION['ket'];
                  }
                ?> 
                <i class="fa fa-user-cog"></i>
              </b>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                  <a data-toggle="modal" data-target="#password" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" onclick="logout();">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- =============================================== -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <?php
        $oto = $_SESSION['otori'];
        $activity = $_SESSION['activity'];
        $main_menu = $this->db->query("SELECT id,nm_menu as menu,link,icon,color from m_menu where parent='0' AND oto_$oto = '1'");
        foreach ($main_menu->result() as $main) {
          $cek_menu = $this->db->query("SELECT COUNT(parent) AS jum from m_menu where parent='$main->id' AND oto_$oto = '1'")->row_array();
          if ($cek_menu['jum']>0){
            echo "<li class='treeview' id='m".$main->id."'>
            <a>";
            echo "<i class='".$main->icon."' style='color:".$main->color.";'></i> <span>".$main->menu."</span>";
            echo "<span class='pull-right-container'>
            <i class='fa fa-angle-left pull-right'></i>
            </span>
            </a>
            <ul class='treeview-menu' id='s".$main->id."'>";
            $sub_menu = $this->db->query("SELECT id,nm_menu as menu,link,icon,color from m_menu where parent='$main->id' AND oto_$oto = '1'");
            foreach ($sub_menu->result() as $sub_main) {
              echo "<li><a id='sm".$sub_main->id."' href=".base_url($sub_main->link)."  ><i class='".$sub_main->icon."' style='color:".$sub_main->color.";'></i>".$sub_main->menu."</a></li>";
            }
            echo "</ul>
            </li>";
          }
          else{
            echo "<li class='menu' id='m".$main->id."'>
            <a href=".base_url($main->link)." id='s".$main->id."'  >
            <i class='".$main->icon."' style='color:".$main->color.";'></i> <span>".$main->menu."</span>
            </a>
            </li>";
          }
        }
        ?>
      </ul>
    </section>
  </aside>
  <script type="text/javascript">
    var oto      = "<?php echo $oto ?>";
    // alert(oto);
    var oto_skpd = "<?php echo $_SESSION['skpd'] ?>";
    var oto_unit = "<?php echo $_SESSION['unit_skpd'] ?>";
    var activity = "<?php echo $activity ?>";
  </script>
  <!-- =============================================== -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="<?php echo $icon ?>"></i> <?php echo $title; ?>
      </h1>
    </section>
    <?php $this->load->view($page);?>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">PT. MURFA SURYA MAHARDIKA</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<div id="password" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Ubah Password</h4>
    </div>
    <form id="subpass" class="form-horizontal">
      <div class="modal-body" align="center">
        <div class="row form-group has-feedback">
          <label class="col-md-4" align="left">Password Lama</label>
          <div class="col-md-8 col-xs-10">
            <input type="password" class="form-control" id="passlama" name="passlama" placeholder="Password Lama" onBlur="check_pass()">
            <span id="passpan1" class="glyphicon glyphicon-ok form-control-feedback" style="color: green;"></span>
            <span id="passpan2" class="glyphicon glyphicon-remove form-control-feedback" style="color: red;"></span>
          </div>
        </div>
        <div class="row form-group">
          <label class="col-md-4" align="left">Password Baru</label>
          <div class="col-md-8 col-xs-10">
            <input type="password" class="form-control" id="passbaru" name="passbaru" placeholder="Password Baru">
            <span style="color: red; visibility: hidden;" id="cek">*Gunakan password yang berbeda!</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving..." id="simpan_password">Simpan</button>
      </div>
    </form>
  </div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/scripts/data_function.js"></script>
<script src="<?php echo base_url(); ?>assets/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/datatables.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/fixedColumns.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Responsive-2.2.2/js/responsive.bootstrap.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/number/number.js"></script>
<script src="<?php echo base_url(); ?>assets/lightbox/lightbox.js"></script>
<script src="<?php echo base_url(); ?>assets/iziToast/iziToast.min.js"></script>
</body>
</html>
<!-- <script type="text/javascript">
  var BASE_URL  = "<?php echo base_url(); ?>";
  var Broadcast = {
      POST : "<?php echo POST; ?>",
      BROADCAST_URL : "<?php echo BROADCAST_URL; ?>",
      BROADCAST_PORT : "<?php echo BROADCAST_PORT; ?>",
  };
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/app/Connection2.js"></script> -->
<script type="text/javascript">
  // var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);
  $("#passpan1").css({"visibility":"hidden"});
  $("#passpan2").css({"visibility":"hidden"});
  function check_pass()
  { 
    $.ajax(
    {
      type: "POST",
      url: "<?php echo base_url(); ?>index.php/welcome/cek_password",
      data: "passlama="+$("#passlama").val(),
      success: function(msg)
      {
        if(msg=="true"){ 
          $("#passpan1").css({"visibility":"visible"});
          $("#passpan2").css({"visibility":"hidden"});
        }
        else{
          $("#passpan2").css({"visibility":"visible"});
          $("#passpan1").css({"visibility":"hidden"});
        }
      }
    });
  };

  $('[data-dismiss=modal]').on('click', function (e) {
    var $t = $(this),
    target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

    $(target)
    /*.find("input,textarea,select")
    .val('')*/
    .end()
    .find("span")
    .css('visibility','hidden')
    .end();
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var prevNowPlaying = null;
    prevNowPlaying = setInterval(function(){
      $.ajax({
      	url: '<?php echo base_url(); ?>index.php/welcome/cek_stat',
      	success: function (data) {
          if (data==0) {
            clearInterval(prevNowPlaying);
          }else{
            location.reload();
          }
        }
      });
    }, 2000);


    $('#subpass').submit(function(e){
      var baru = $('#passbaru').val();
      var lama = $('#passlama').val();
      e.preventDefault();
      if (baru==lama) {
        $("#cek").css({"visibility":"visible"});
      }else {
        $.ajax({
          url:'<?php echo base_url(); ?>index.php/welcome/simpan_password',
          type:"post",
          data:new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          dataType:"JSON",
          error:function(data){
            swal("Oops!",data.data_msg,"error");
          },
          success: function(data){
            if (data.swal=='success') {
              swal({
                title: "GodJob!", 
                text : data.data_msg, 
                type : "success"},
                );
              $('#password').modal('toggle');
              $('#passlama').val('');
              $('#passbaru').val('');
              $("#passpan1").css({"visibility":"hidden"});
              $("#passpan2").css({"visibility":"hidden"});
              $("#cek").css({"visibility":"hidden"});
            }else {
              swal("Oops!",data.data_msg,"error");
              $("#passpan1").css({"visibility":"hidden"});
              $("#passpan2").css({"visibility":"hidden"});
            }
          }
        });
      }
    });
  });
  function logout(){
  swal({
    title             : "Anda yakin ingin keluar?",
    type              : "warning",
    showCancelButton  : true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText : "Ya",
    closeOnConfirm    : false
  },
  function(){
    swal.close();
    window.location = '<?php echo base_url(); ?>index.php/welcome/logout';
  });
}
</script>