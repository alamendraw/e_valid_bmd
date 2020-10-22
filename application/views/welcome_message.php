<!DOCTYPE html>
<html lang="id">
<head>
	<title>E-Valid BMD</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo base_url(); ?>assets/images/logo2.png" rel="shortcut icon">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/main.css">
	<link href="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/ajax/jquery.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css" rel="stylesheet">
	<script type="text/javascript">
	  var BASE_URL  = "<?php echo base_url(); ?>";
	  var Broadcast = {
	      POST : "<?php echo POST; ?>",
	      BROADCAST_URL : "<?php echo BROADCAST_URL; ?>",
	      BROADCAST_PORT : "<?php echo BROADCAST_PORT; ?>",
	  };
	</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/app/Connection2.js"></script>
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="login" class="login100-form validate-form">
					<span class="login100-form-title p-b-10">
					E-Valid BMD
					</span>
					<span style="color: red; visibility: hidden;" id="span">warning</span>
					<div class="wrap-input100 validate-input" data-validate = "User Name is required">
						<input class="input100 has-val" type="text" name="username" onkeyup="span();">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fa fa-user"></i> User Name</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100 has-val" type="password" name="password" onkeyup="span();">
						<span class="focus-input100"></span>
						<span class="label-input100"><i class="fa fa-key"></i> Password</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
					<footer class="m-t-70" id="footer">
						<strong>Copyright &copy; 2019 <a href="#" style="text-decoration: none;">PT. MURFA SURYA MAHARDIKA</a>.<hr style="margin-top: 5px;margin-bottom: 7px;">
							<a id="android" href="https://doc-0g-7c-docs.googleusercontent.com/docs/securesc/ha0ro937gcuc7l7deffksulhg5h7mbp1/v4hsoa91jqphtmektunleh9pf3erq2jq/1561687200000/05938458592656592569/*/1oZfH3aNKogowOWnIHItaCdGcAX_LvxMP?e=download" style="text-decoration: none;color: #aaa;"><i class="fab fa-android fa-2x"></i> Download</a>
						</strong>
					</footer>
				</form>
				<div class="login100-more" style="background-image: url('<?php echo base_url(); ?>assets/images/bg.png');">
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>assets/login/js/login.js"></script>
	<script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.js"></script>
</body>
</html>
<script type="text/javascript">
	// var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);
	$(document).ready(function(){
		if (window.innerWidth < 760) {
			$('#android').hide();
		}
		$('#login').submit(function(e){
			e.preventDefault(); 
			$.ajax({
				url:'<?php echo base_url(); ?>index.php/welcome/login',
				type:"post",
				data:new FormData(this),
				processData:false,
				contentType:false,
				cache:false,
				async:false,
				dataType:"JSON",
				error:function(data){
					location.reload();
				},
				success: function(data){
					if (data.status==true) {
						swal({
							title: 'Welcome Back!',
							type: "success",
							timer: 1900,
							showConfirmButton: false
						});
						// var typeData = { broadType : Broadcast.POST,resData:'login', data : {msg:data.ket+' login'}};
      //     				conn.sendMsg(typeData);
						window.setTimeout(function(){ 
							location.reload();
						} ,1900);
					}else{
						document.getElementById("span").style.visibility='visible';
						$('#span').html(data.msg);
					}
				}
			});
		});
	});
	function span() {
		document.getElementById("span").style.visibility='hidden';
		$('#span').html('warning');
	}
</script>