$(document).ready(function(){
	document.getElementById("m1").style.display = "block";
	document.getElementById("m1").style.background = "linear-gradient(90deg, rgba(36,69,87,1) 0%, rgba(26,34,38,1) 100%)";
	document.getElementById("m1").style.boxShadow = "0px 6px 11px -3px rgba(0,0,0,0.57)";
	document.getElementById("s1").style.fontWeight = "bold";
	document.getElementById("s1").style.color = "white";
	info();
	progress();
	var SESSION = $('#otori').val();
	if (SESSION==1 || SESSION==2) {
		$('#table_progress').show();
	}
});
$(document).ready(function() {
	var table = $('#table').DataTable();

	$('#table tbody')
	.on( 'mouseenter', 'td', function () {
		var colIdx = table.cell(this).index().column;

		$( table.cells().nodes() ).removeClass( 'highlight' );
		$( table.column( colIdx ).nodes() ).addClass( 'highlight' );
	});
} );
function info() {
	var check = '<i class="fa fa-check-circle"></i>';
	var non   = '<i class="fa fa-empty-set"></i>';
	$.ajax({
		url: 'index.php/Dashboard/get_info',
		dataType: 'json',
		success: function(data){
			$('.a').width((data.a_sen/data.a_tot)*100+'%');
			$('.b').width((data.b_sen/data.b_tot)*100+'%');
			$('.c').width((data.c_sen/data.c_tot)*100+'%');
			$('.d').width((data.d_sen/data.d_tot)*100+'%');
			$('.e').width((data.e_sen/data.e_tot)*100+'%');
			$('.f').width((data.f_sen/data.f_tot)*100+'%');
			$('#a_tot').text(data.a_tot);
			$('#b_tot').text(data.b_tot);
			$('#c_tot').text(data.c_tot);
			$('#d_tot').text(data.d_tot);
			$('#e_tot').text(data.e_tot);
			$('#f_tot').text(data.f_tot);

			var a_sen = (data.a_tot==0)? 0 : ((data.a_sen/data.a_tot)*100).toFixed(2);
			var a_non = (data.a_tot==0)? 0 : ((data.a_non/data.a_tot)*100).toFixed(2);
			var b_sen = (data.b_tot==0)? 0 : ((data.b_sen/data.b_tot)*100).toFixed(2);
			var b_non = (data.b_tot==0)? 0 : ((data.b_non/data.b_tot)*100).toFixed(2);
			var c_sen = (data.c_tot==0)? 0 : ((data.c_sen/data.c_tot)*100).toFixed(2);
			var c_non = (data.c_tot==0)? 0 : ((data.c_non/data.c_tot)*100).toFixed(2);
			var d_sen = (data.d_tot==0)? 0 : ((data.d_sen/data.d_tot)*100).toFixed(2);
			var d_non = (data.d_tot==0)? 0 : ((data.d_non/data.d_tot)*100).toFixed(2);
			var e_sen = (data.e_tot==0)? 0 : ((data.e_sen/data.e_tot)*100).toFixed(2);
			var e_non = (data.e_tot==0)? 0 : ((data.e_non/data.e_tot)*100).toFixed(2);
			var f_sen = (data.f_tot==0)? 0 : ((data.f_sen/data.f_tot)*100).toFixed(2);
			var f_non = (data.f_tot==0)? 0 : ((data.f_non/data.f_tot)*100).toFixed(2);
			
			$('#a_sen').html('<div class="col-md-6">'+data.a_sen+' '+check+'</div><br/><div class="col-md-6">'+a_sen+'%</div>');
			$('#a_non').html('<div class="col-md-6">'+data.a_non+' '+non+'</div><br/><div class="col-md-6">'+a_non+'%</div>');

			$('#b_sen').html('<div class="col-md-6">'+data.b_sen+' '+check+'</div><br/><div class="col-md-6">'+b_sen+'%</div>');
			$('#b_non').html('<div class="col-md-6">'+data.b_non+' '+non+'</div><br/><div class="col-md-6">'+b_non+'%</div>');

			$('#c_sen').html('<div class="col-md-6">'+data.c_sen+' '+check+'</div><br/><div class="col-md-6">'+c_sen+'%</div>');
			$('#c_non').html('<div class="col-md-6">'+data.c_non+' '+non+'</div><br/><div class="col-md-6">'+c_non+'%</div>');

			$('#d_sen').html('<div class="col-md-6">'+data.d_sen+' '+check+'</div><br/><div class="col-md-6">'+d_sen+'%</div>');
			$('#d_non').html('<div class="col-md-6">'+data.d_non+' '+non+'</div><br/><div class="col-md-6">'+d_non+'%</div>');

			$('#e_sen').html('<div class="col-md-6">'+data.e_sen+' '+check+'</div><br/><div class="col-md-6">'+e_sen+'%</div>');
			$('#e_non').html('<div class="col-md-6">'+data.e_non+' '+non+'</div><br/><div class="col-md-6">'+e_non+'%</div>');

			$('#f_sen').html('<div class="col-md-6">'+data.f_sen+' '+check+'</div><br/><div class="col-md-6">'+f_sen+'%</div>');
			$('#f_non').html('<div class="col-md-6">'+data.f_non+' '+non+'</div><br/><div class="col-md-6">'+f_non+'%</div>');

		}
	});
}
function progress() {
	$('#table').DataTable({ 
		"processing"    : true,
		"serverSide"    : true,
		"order"         : [],
		"autoWidth"     : true,
		"ajax": {
			"url": "index.php/Dashboard/get_progress",
			"type": "POST"
		},
		"columnDefs": [{
			"targets"   : [ 0,31 ],
			"orderable" : false,
		}]
	});
}
function refresh() {
	$.ajax({
		dataType: 'json',
		beforeSend: function (data) {
			swal({
				title            : 'Mohon tunggu..!',
				imageUrl         : 'assets/sweetalert/lib/loader.gif',
				allowOutsideClick: false,
				allowEscapeKey   : false,
				allowEnterKey    : false,
				showConfirmButton: false,
			})
		},
		url: 'index.php/Dashboard/call',
		success: function(data){
			info();
			swal.close();
		}
	});
}
function refresh_progress() {
	$.ajax({
		dataType: 'json',
		beforeSend: function (data) {
			swal({
				title            : 'Mohon tunggu..!',
				imageUrl         : 'assets/sweetalert/lib/loader.gif',
				allowOutsideClick: false,
				allowEscapeKey   : false,
				allowEnterKey    : false,
				showConfirmButton: false,
			})
		},
		url: 'index.php/Dashboard/call_progress',
		success: function(data){
			$('#table').DataTable().ajax.reload();
			swal.close();
		}
	});
}


