<style type="text/css">
	.select2 {
		width:100%!important;
	}
	label{
		text-align: left!important;
	}
</style>
<section class="content">
	<div class="box">
		<div class="box-body">
			<div class="card-header">
				<h4 align="center">CETAK LABEL BARANG</h4><hr>
			</div>
			<div class="card-body form-horizontal">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label col-sm-3">SKPD</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="kd_skpd" onchange="get_unit()">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Unit</label>
							<div class="col-md-9">
								<select class="form-control input-sm select2" id="unit_skpd"></select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Jenis KIB</label>
							<div class="col-md-9">
								<select class="form-control select2" id="jns_kib">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Tahun</label>
							<div class="col-md-2 col-sm-2 col-xs-6">
								<select name="tahun" id="tahun" class="form-control">
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Page Size</label>
							<div class="col-md-2 col-sm-2 col-xs-6">
								<select class="form-control select2" id="size">
									<option value="A4">A4 Potrait</option>
									<option value="A4-L">A4 Lanscape</option>
									<option value="Legal">Legal Potrait</option>
									<option value="Legal-L">Legal Lanscape</option>
									<option value="Folio">Folio Potrait</option>
									<option value="Folio-L">Folio Lanscape</option>
								</select>
							</div>
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"><hr>
						<div class="form-group" align="center">
							<button class="btn btn-sm float-right btn-primary" onclick="openWindow(1);"><i class="fa fa-print-search fa-lg"></i> Preview</button>
							<button class="btn btn-sm btn-danger"  onclick="openWindow(2);"><i class="fa fa-file-pdf fa-lg"></i> Cetak PDF</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$.ajax({
		url: 'get_skpd',
		dataType: 'json',
		success: function(data){
			var html = '<option  selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].kd_skpd+'">'+data[i].kd_skpd+' | '+data[i].nm_skpd+'</option>';
			}
			$('#kd_skpd').html(html);
		}
	});

	$.ajax({
		url: 'get_jns_sensus',
		dataType: 'json',
		success: function(data){
			var html = '<option disabled selected value="">-PILIH-</option>';
			var i;
			for(i=0; i<data.length; i++){
				html += '<option value="'+data[i].id+'" >'+data[i].nm_menu+'</option>';
			}
			$('#jns_kib').html(html);

		}
	});

	function get_unit() {
		var kd_skpd = $('#kd_skpd').val();
		$.ajax({
			url: 'get_unit',
			dataType: 'json',
			type : 'POST',
			data: {kd_skpd:kd_skpd},
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
				swal.close();
				var html = '<option selected value="">-PILIH-</option>';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].kd_lokasi+'">'+data[i].kd_lokasi+' | '+data[i].nm_lokasi+'</option>';
				}
				$('#unit_skpd').html(html);
			}
		});
	}
	
	function openWindow($key){
		var cetak          	= $key;
		var jns_kib        	= $('#jns_kib').val();
		var kd_skpd        	= $('#kd_skpd').val();
		var unit_skpd      	= $('#unit_skpd').val();
		var tahun      		= $('#tahun').val(); 
		var size     	   	= $('#size').val();
		var url            	= "cetak_barang";
		sub_url            	= '?cetak='+cetak+'&jns_kib='+jns_kib+'&kd_skpd='+kd_skpd+'&tahun='+tahun+'&unit_skpd='+unit_skpd+'&size='+size;
		
		if (kd_skpd=='') {
			swal("SKPD !!!","SKPD belum dipilih!");
		}else if(unit_skpd=='') {
			swal("Unit !!!","Unit belum dipilih!");
		}else if(jns_kib=='') {
			swal("Jenis KIB !!!","Jenis KIB belum dipilih!");
		}else if (tahun=='') {
			swal("Tahun !!!","Tahun belum dipilih!");
		}else{
			window.open(url+sub_url,'_blank');
			window.focus();
		}
	}
</script>

