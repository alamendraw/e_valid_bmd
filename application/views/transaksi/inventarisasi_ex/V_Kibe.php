<div class="row" style="padding-top: 50px;">
	<div class="col-md-2"> &nbsp;</div>
	<div class="col-md-10" style="height: 200px;">
		<button type="button" class="btn btn-default draw shadow" style="width: 25%;height: 90%;" onClick="javascript:aset();">
			INPUT KIB B <br> ASET TETAP</button>
		<button type="button" class="btn btn-default draw shadow" style="width: 25%;height: 90%;" onClick="javascript:eca();">INPUT KIB B <br> ECA</button>
		<button type="button" class="btn btn-default draw shadow" style="width: 25%;height: 90%;" onClick="javascript:ruang();">MANAJEMEN <br> DATA RUANGAN</button>
	</div>
</div>

<style type="text/css">
	.shadow{
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
</style>
<script type="text/javascript">
	function aset(){ 
		window.location.href = '<?php echo site_url('transaksi/C_Kibe/dataAset'); ?>';
	}

	function eca(){
		window.location.href = '<?php echo site_url('transaksi/C_Kibe/dataEca'); ?>';
	}

	function ruang(){
		window.location.href = '<?php echo site_url('transaksi/C_Kibe/dataRuang'); ?>';
	}
</script>