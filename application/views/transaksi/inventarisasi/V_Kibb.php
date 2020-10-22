<div class="row" style="padding-top: 50px;">
	<div class="col-md-12 d-flex justify-content-around text-center">
		<a class="btn btn-app shadow" onClick="javascript:aset();">
			<img class="center" src="<?php echo base_url()?>/assets/img/aset-min.png" style="display: block;"><h4>ASET TETAP</h4>
		</a>
		<a class="btn btn-app shadow" onClick="javascript:eca();">
			<img class="center" src="<?php echo base_url()?>/assets/img/eca-min.png"  style="display: block;"><h4>ECA</h4>
		</a>
	</div>
</div>

<style type="text/css">
	.shadow:hover{
		box-shadow: 7px 7px 10px;
	}

	.btn-app{
		width: 32%;
		height: auto;
		background-color: white;
	}
	.center {
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 50%;
	}
	/*.justify-content-around{
		justify-content: space-around !important;
	}*/
</style>
<script type="text/javascript">
	function aset(){ 
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibb/dataAset'); ?>';
	}

	function eca(){
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibb/dataEca'); ?>';
	}

	function ruang(){
		window.location.href = '<?php echo base_url('index.php/transaksi/C_Kibb/dataRuang'); ?>';
	}
</script>