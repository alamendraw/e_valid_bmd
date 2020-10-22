<div class="row" style="padding-top: 50px;">
	<div class="col-md-3"> &nbsp;</div>
	<div class="col-md-8" style="height: 200px;">
		<a class="btn btn-app shadow" onClick="javascript:aset();">
			<img class="center" src="<?php echo base_url()?>/assets/img/kantor.png" style="display: block;"><h4>ASET TETAP</h4>
		</a>
		<a class="btn btn-app shadow" onClick="javascript:eca();">
			<img class="center" src="<?php echo base_url()?>/assets/img/tugu.png"  style="display: block;height: 100px"><h4>ECA</h4>
		</a>
	</div>
	<div class="col-md-1">&nbsp; </div>
 
</div>

<style type="text/css">
	.shadow:hover{
		box-shadow: 7px 7px 10px;
	}
	.draw{
		width: 120px;
    	height: 150px;
    	padding: 10px;
	    /*box-shadow: 0 0 11px 0 rgba(0, 0, 0, 0.29) inset;*/
	    margin: 5px 9px 9px 9px; 
	    border-radius: 10px; 
	    background-color: ivory;
	    font-size: 20px; 
		text-align: center; 
		font-weight: bold; 
		font-family: Arial;
	}
	.btn-app{
		width: 32%;
		height: auto;
	}
	.center {
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 50%;
	}
	.justify-content-around{
		justify-content: space-around !important;
	}
</style>
<script type="text/javascript">
	function aset(){ 
		window.location.href = '<?php echo site_url('transaksi/C_Kibc/dataAset'); ?>';
	}

	function eca(){
		window.location.href = '<?php echo site_url('transaksi/C_Kibc/dataEca'); ?>';
	}
</script>