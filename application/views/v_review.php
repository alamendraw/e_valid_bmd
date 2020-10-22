<link href="<?=base_url()?>assets/bootstrap_tags/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
<style type="text/css">
	.select2 {
		width: 100% !important;
	}

	label {
		text-align: left !important;
	}

	table.dataTable tbody tr.selected {
		background-color: #B0BED9 !important;
	}

	table.dataTable.stripe tbody tr.odd.selected,
	table.dataTable.display tbody tr.odd.selected {
		background-color: #acbad4 !important;
	}

	.modal-dialog-centered {
		min-height: calc(100% - (1.75rem * 2));
	}

	.my-2 {
		margin-top: 5px !important;
		margin-bottom: 5px !important;
	}
</style>
<section class="content">
	<div class="box">
		<div class="box-body">
			<div class="card-header">
				<h4 align="center">REVIEW</h4>
				<hr>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 p-0">
							<select class="form-control search-slt select2" id="kd_skpd"
								onchange="get_unit(this.value);">
							</select>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 p-0">
							<select class="form-control search-slt select2" id="kd_unit">
							</select>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 p-0">
							<select class="form-control search-slt select2" id="jns_kib" name="jns_kib">
							</select>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 p-0">
							<button class="btn btn-sm float-right btn-primary filter" type="button"><i
									class="fa fa-print-search fa-lg"></i> filter</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<hr>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<form id="fm2">
						<div class="row">
							<div
								class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_a trkib_b trkib_c trkib_d trkib_e trkib_f">
								<select class="form-control input-sm" id="kondisi">
									<option value="">Kondisi</option>
									<option value="B">Baik</option>
									<option value="KB">Kurang Baik</option>
									<option value="RB">Rusak Berat</option>
								</select>
							</div>
							<div
								class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_a trkib_b trkib_c trkib_d trkib_e trkib_f">
								<input type="text" class="form-control input-sm rounded" id="keterangan"
									placeholder="Keterangan">
							</div>
							<div
								class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_a trkib_b trkib_c trkib_d trkib_e trkib_f">
								<input type="text" class="form-control input-sm rounded" id="kronologis"
									placeholder="Kronologis">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_a trkib_c trkib_d trkib_f">
								<input type="text" class="form-control input-sm rounded" id="alamat"
									placeholder="Alamat">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_a trkib_c trkib_d trkib_f">
								<input type="text" class="form-control input-sm rounded" id="luas" placeholder="Luas">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_b">
								<input type="text" class="form-control input-sm rounded" id="merek" placeholder="Merek">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_b">
								<input type="text" class="form-control input-sm rounded" id="no_polisi"
									placeholder="No. Polisi">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_b">
								<input type="text" class="form-control input-sm rounded" id="no_rangka"
									placeholder="No Rangka">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_b">
								<input type="text" class="form-control input-sm rounded" id="no_mesin"
									placeholder="No Mesin">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_c trkib_d">
								<input type="text" class="form-control input-sm rounded" id="konstruksi"
									placeholder="Konstruksi">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_c trkib_f">
								<input type="text" class="form-control input-sm rounded" id="jenis" placeholder="Jenis">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_d">
								<input type="text" class="form-control input-sm rounded" id="panjang"
									placeholder="Panjang">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_d">
								<input type="text" class="form-control input-sm rounded" id="lebar" placeholder="Lebar">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_e">
								<input type="text" class="form-control input-sm rounded" id="judul" placeholder="Judul">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_e">
								<input type="text" class="form-control input-sm rounded" id="spesifikasi"
									placeholder="Spesifikasi">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_e">
								<input type="text" class="form-control input-sm rounded" id="asal" placeholder="Asal">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_e">
								<input type="text" class="form-control input-sm rounded" id="cipta" placeholder="Cipta">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 p-0 my-2 filter2 trkib_f">
								<input type="text" class="form-control input-sm rounded" id="bangunan"
									placeholder="Bangunan">
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<hr>
				</div>
			</div>

			<div class="table table-responsive">
				<table class="table table-striped" id="list" width="100%" cellspacing="0" style="font-size: 82%">
					<thead>
						<tr>
							<th colspan="11">
								<div class="btn-group pull-right">
									<button class="btn btn-primary btn-sm" id="selectAll"><i
											class="fa fa-hand-pointer"></i> <small>Select All</small></button>
									<button class="btn btn-warning btn-sm disabled" id="selectNone"><i
											class="fa fa-empty-set"></i> <small>Unselect All</small></button>
									<button class="btn btn-success btn-sm allRows disabled"><i class="fa fa-edit"></i>
										<small>All Selected</small></button>
									<button class="btn btn-info btn-sm allRows_equal_sensus disabled"><i
											class="fa fa-equals"></i> <small>All Selected</small></button>
								</div>
							</th>
						</tr>
						<tr class="bg-primary">
							<th></th>
							<th><input class="form-control input-sm rounded" style="width: 100%!important;" type="text"
									id="fno_sensus" name="fno_sensus" placeholder="No Sensus" maxlength="6"></th>
							<th><input class="form-control input-sm rounded" style="width: 100%!important;" type="text"
									id="fnama" name="fnama" placeholder="Nama"></th>
							<th>
								<input class="form-control input-sm rounded" multiple style="width: 100%!important;"
									type="text" id="frincian" name="frincian" placeholder="Detail"
									data-role="tagsinput">
							</th>
							<th>
								<input class="form-control input-sm rounded" style="width: 100%!important;" type="text"
									id="ftahun" name="ftahun" placeholder="Tahun">
							</th>
							<th><input class="form-control input-sm rounded" style="width: 100%!important;" type="text"
									id="fnilai" name="fnilai" placeholder="Nilai"></th>
							<th><input class="form-control input-sm rounded" style="width: 100%!important;" type="text"
									id="fumur" name="fumur" placeholder="S.Umur"></th>
							<th>
								<select class="form-control input-sm select2 fselect" multiple id="fhasil"
									name="fhasil">
								</select>
							</th>
							<th>
								<select class="form-control input-sm select2 fselect" multiple id="freview"
									name="freview" placeholder="Hasil Sensus">
									<option value="Belum">Belum Review</option>
								</select>
							</th>
							<th><input class="form-control input-sm rounded" type="text" id="fcatatan" name="fcatatan"
									placeholder="Catatan"></th>
							<th>

							</th>
						</tr>
						<tr>
							<th width="5%">No</th>
							<th width="5%">No.Sen</th>
							<th width="20%">Nama</th>
							<th width="15%">Rincian</th>
							<th width="5%">Tahun</th>
							<th width="5%">Nilai</th>
							<th width="5%">S.Umur</th>
							<th width="10%">Hasil Sensus</th>
							<th width="10%">Review</th>
							<th width="15%">Catatan</th>
							<th width="5%">Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="modal_review" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close reset" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Review</h4>
			</div>
			<div class="modal-body form-horizontal">

				<form id="fm" class="form-horizontal">
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="id_barang" id="id_barang">
							<div class="form-group">
								<label class="control-label col-sm-3">No Sensus</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="no_sensus" name="no_sensus" readonly="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Rincian</label>
								<div class="col-md-9" id="rincian">
									Rincian
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Catatan</label>
								<div class="col-md-9">
									<textarea class="form-control" id="catat" name="catat"></textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<input type="hidden" id="stat_fisik2" name="stat_fisik2" value="1">
											<li class="active" id="ada"><a href="#tab_1" data-toggle="tab"> Fisik Ada
												</a></li>
											<li class="" id="tidak"><a href="#tab_2" data-toggle="tab"> Fisik Tidak Ada
												</a></li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="tab_1">
												<div class="form-group">
													<label class="control-label col-sm-3">Keberadaan Barang</label>
													<div class="col-md-9">
														<label class="col-sm-12"><input type="radio" class="radio_ada"
																onclick="uncheked_tidak_ada();" name="keberadaan_brg2"
																value="SKPD"> SKPD</label>
														<label class="col-sm-12"><input type="radio" class="radio_ada"
																onclick="uncheked_tidak_ada();" name="keberadaan_brg2"
																value="Dikerjasamakan dengan pihak lain"> Dikerjasamakan
															dengan pihak lain</label>
														<label class="col-sm-12"><input type="radio" class="radio_ada"
																onclick="uncheked_tidak_ada();" name="keberadaan_brg2"
																value="Dikuasai secara tidak sah pihak lain"> Dikuasai
															secara tidak sah pihak lain</label>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-3">Kondisi Barang</label>
													<div class="col-md-9">
														<label class="col-sm-12"><input type="radio" class="radio_ada"
																onclick="uncheked_tidak_ada();" name="kondisi_brg2"
																value="B"> Baik</label>
														<label class="col-sm-12"><input type="radio" class="radio_ada"
																onclick="uncheked_tidak_ada();" name="kondisi_brg2"
																value="KB"> Kurang Baik</label>
														<label class="col-sm-12"><input type="radio" class="radio_ada"
																onclick="uncheked_tidak_ada();" name="kondisi_brg2"
																value="RB"> Rusak Berat</label>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_2">
												<div class="form-group">
													<label class="control-label col-sm-3">Keterangan</label>
													<div class="col-md-9">
														<label class="col-sm-12"><input type="radio"
																class="radio_tidak_ada" onclick="uncheked_ada();"
																name="ket_brg2" value="Hilang"> Hilang Karena
															Kecurian</label>
														<label class="col-sm-12"><input type="radio"
																class="radio_tidak_ada" onclick="uncheked_ada();"
																name="ket_brg2" value="Tidak Diketahui Keberadaannya">
															Tidak Diketahui Keberadaannya</label>
														<label class="col-sm-12"><input type="radio"
																class="radio_tidak_ada" onclick="uncheked_ada();"
																name="ket_brg2" value="Habis Akibat Usia Barang"> Fisik
															Habis/Tidak Ada Karena Sebab Yang Wajar</label>
														<label class="col-sm-12"><input type="radio"
																class="radio_tidak_ada" onclick="uncheked_ada();"
																name="ket_brg2" value="Seharusnya Telah dihapus">
															Seharusnya Telah dihapus</label>
														<label class="col-sm-12"><input type="radio"
																class="radio_tidak_ada" onclick="uncheked_ada();"
																name="ket_brg2" value="Double Catat"> Dobel/Lebih
															Catat</label>
														<label class="col-sm-12"><input type="radio"
																class="radio_tidak_ada" onclick="uncheked_ada();"
																name="ket_brg2" value="Koreksi BHP"> Koreksi Barang
															Habis Pakai</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group" align="center">
								<button type="button" class="btn btn-sm btn-danger reset">Reset</button>
								<button class="btn btn-sm float-right btn-primary" type="submit">Submit</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="image" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Gambar</h5>
			</div>
			<div class="modal-body">
				<div class="gallery">
					<div class="row justify-content-center">
						<div class="col-md-12 img-wrapper" id="image_list">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="equal_sensus" tabindex="-1" role="dialog" aria-labelledby="equal_sensus" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close reset" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Review</h4>
			</div>
			<div class="modal-body form-horizontal">

				<form id="fm_equal_sensus" class="form-horizontal">
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="id_barang" id="id_barang">
							<div class="form-group">
								<label class="control-label col-sm-3">No Sensus</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="no_sensus_equal_sensus"
										name="no_sensus_equal_sensus" readonly="">
									<span class="text-muted">Review sesuai hasil sensus</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Catatan</label>
								<div class="col-md-9">
									<textarea class="form-control" id="catat_equal_sensus"
										name="catat_equal_sensus"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group" align="center">
								<button class="btn btn-sm float-right btn-primary" type="submit">Submit</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>assets/bootstrap_tags/bootstrap-tagsinput.min.js" type="text/javascript" charset="utf-8">
</script>
<script type="text/javascript">
	var table;
	$(document).on('click', '[data-toggle="lightbox"]', function (event) {
		event.preventDefault();
		$(this).ekkoLightbox({
			alwaysShowClose: true,
			onShown: function () {
				console.log('Checking our the events huh?');
			},
			onNavigate: function (direction, itemIndex) {
				console.log('Navigating ' + direction + '. Current item: ' + itemIndex);
			}

		});
	});
	$(document).ready(function () {

		var d = document.getElementById("m12");
		d.className += " menu-open";
		document.getElementById("s12").style.display = "block";
		document.getElementById("sm31").style.color = "white";
		document.getElementById("sm31").style.fontWeight = "bold";
		$('.select2').select2({
			minimumResultsForSearch: 10
		});

		$(".datepicker").datepicker({
			format: "yyyy",
			viewMode: "years",
			minViewMode: "years"
		});




		$.ajax({
			url: 'survey_v2/get_skpd',
			dataType: 'json',
			success: function (data) {
				var html = '<option  selected value="">-PILIH-</option>';
				var i;
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].kd_skpd + '">' + data[i].kd_skpd + ' | ' +
						data[i].nm_skpd + '</option>';
				}
				$('#kd_skpd').html(html);
				$('#kd_skpd').val(localStorage.getItem("kd_skpd"));
			},
			async: false
		});
		if (localStorage.getItem("kd_skpd") != '' || localStorage.getItem("kd_skpd") != null) {
			get_unit(localStorage.getItem("kd_skpd"));
		}
		$("#jns_kib").html(
			'<option value="trkib_a">A - TANAH</option>' +
			'<option value="trkib_b">B - PERALATAN & MESIN</option>' +
			'<option value="trkib_c">C - GEDUNG & BANGUNAN</option>' +
			'<option value="trkib_d">D - JALAN, IRIGASI & JARINGAN</option>' +
			'<option value="trkib_e">E - ASET TETAP LAINNYA</option>' +
			'<option value="trkib_f">F - KONSTRUKSI DALAM PENGERJAAN</option>'
		).val(localStorage.getItem("jns_kib"));
		$("#kd_skpd").on('change', function () {
			localStorage.setItem("kd_skpd", this.value);
		});
		$("#kd_unit").on('change', function () {
			localStorage.setItem("kd_unit", this.value);
		});
		$("#jns_kib").on('change', function () {
			localStorage.setItem("jns_kib", this.value);
		});

		$("input:radio").on('click', function () {
			$('input:radio[value="' + this.value + '"]').prop('checked', true);
		});
		$(".reset").on('click', function () {
			$('input:radio').prop('checked', false);
			$("#ada").addClass('active');
			$("#tidak").removeClass('active');
			$("#tab_1").addClass('active');
			$("#tab_2").removeClass('active');
			$("#catat").val("");
			$("#rincian").html("Rincian");
		});

		table = $('#list').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			ajax: {
				url: "<?=base_url()?>index.php/review/getlist",
				type: "POST",
				data: function (d) {
					d.kd_skpd = $('#kd_skpd').val();
					d.kd_unit = $('#kd_unit').val();
					d.jns_kib = $('#jns_kib').val();
					d.fno_sensus = $('#fno_sensus').val();
					d.fnama = $('#fnama').val();
					d.frincian = $("#frincian").tagsinput('items');
					d.ftahun = $('#ftahun').val();
					d.fnilai = $('#fnilai').val();
					d.fumur = $('#fumur').val();
					d.fhasil = $('#fhasil').val();
					d.freview = $('#freview').val();
					d.fcatatan = $('#fcatatan').val();
					d.kondisi = $('#kondisi').val();
					d.keterangan = $('#keterangan').val();
					d.kronologis = $('#kronologis').val();
					d.alamat = $('#alamat').val();
					d.luas = $('#luas').val();
					d.merek = $('#merek').val();
					d.no_polisi = $('#no_polisi').val();
					d.no_rangka = $('#no_rangka').val();
					d.no_mesin = $('#no_mesin').val();
					d.konstruksi = $('#konstruksi').val();
					d.jenis = $('#jenis').val();
					d.panjang = $('#panjang').val();
					d.lebar = $('#lebar').val();
					d.judul = $('#judul').val();
					d.spesifikasi = $('#spesifikasi').val();
					d.asal = $('#asal').val();
					d.cipta = $('#cipta').val();
					d.bangunan = $('#bangunan').val();

				},
				async: false
			},
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Search...",
				lengthMenu: "_MENU_",
				zeroRecords: "Nothing found",
				info: "Showing page _PAGE_ of _PAGES_",
				infoEmpty: "No records available",
				infofilter2ed: "" /*"(filter2ed from _MAX_ total records)"*/
			},
		});

		$("#selectAll").on("click", function () {
			table.rows({
				page: 'all'
			}).nodes().each(function () {
				$(this).removeClass('selected')
			})
			table.rows({
				search: 'applied'
			}).nodes().each(function () {
				$(this).addClass('selected');
			})
			$("#selectNone").removeClass('disabled');
			$(".allRows_equal_sensus").removeClass('disabled');
			$(".allRows").removeClass('disabled');
		});

		$("#selectNone").on("click", function () {
			if (!$(this).hasClass("disabled")) {
				table.rows({
					page: 'all'
				}).nodes().each(function () {
					$(this).removeClass('selected')
				});
				$("#selectNone").addClass('disabled');
				$(".allRows_equal_sensus").addClass('disabled');
				$(".allRows").addClass('disabled');
			}
		});


		$('#list tbody').on('click', '.odd', function () {
			$(this).toggleClass('selected');
		});
		$('#list tbody').on('click', '.even', function () {
			$(this).toggleClass('selected');
		});

		$(".filter").on('click', function () {
			$('#list').DataTable().ajax.reload(null, true);
		});

		$(".allRows").on('click', function () {
			if (!$(this).hasClass("disabled")) {
				var selectedRows = $('#list').DataTable().rows('.selected').data();
				values = '';
				$.each(selectedRows, function (index, value) {
					values = values + value[1] + ',';
				});
				$("#no_sensus").val(values);
				edit('');
			}
		});
		$(".allRows_equal_sensus").on('click', function () {
			if (!$(this).hasClass("disabled")) {
				var selectedRows = $('#list').DataTable().rows('.selected').data();
				values = '';
				$.each(selectedRows, function (index, value) {
					values = values + value[1] + ',';
				});
				$("#no_sensus_equal_sensus").val(values);
				if (values == '') {
					alert('Belum memilih barang!');
				} else {
					$('#equal_sensus').modal('show');
				}
			}
		});
		$('#list tbody').on('click', 'tr', function () {
			var rows = $('#list  tbody tr.selected').length;
			if (rows > 1) {
				$(".allRows_equal_sensus").removeClass('disabled');
				$(".allRows").removeClass('disabled');
				$("#selectNone").removeClass('disabled');
			} else {
				$(".allRows_equal_sensus").addClass('disabled');
				$(".allRows").addClass('disabled');
				$("#selectNone").addClass('disabled');
			}
		});

		$('.fselect').append(
			'<option disabled>Keberadaan Barang</option>' +
			'<option value="keberadaan_brg,SKPD">SKPD</option>' +
			'<option value="keberadaan_brg,Dikerjasamakan dengan pihak lain">Dikerjasamakan dengan pihak lain</option>' +
			'<option value="keberadaan_brg,Dikuasai secara tidak sah pihak lain">Dikuasai secara tidak sah pihak lain</option>' +
			'<option disabled>Kondisi Barang</option>' +
			'<option value="kondisi_brg,B">Baik</option>' +
			'<option value="kondisi_brg,KB">Kurang Baik</option>' +
			'<option value="kondisi_brg,RB">Rusak Berat</option>' +
			'<option disabled>Keterangan</option>' +
			'<option value="ket_brg,Hilang">Hilang Karena Kecurian</option>' +
			'<option value="ket_brg,Tidak Diketahui Keberadaannya">Tidak Diketahui Keberadaannya</option>' +
			'<option value="ket_brg,Habis Akibat Usia Barang">Fisik Habis/Tidak Ada Kerena Sebab Yang Wajar</option>' +
			'<option value="ket_brg,Seharusnya Telah dihapus">Seharusnya Telah dihapus</option>' +
			'<option value="ket_brg,Double Catat">Dobel/Lebih Catat</option>' +
			'<option value="ket_brg,Koreksi BHP">Koreksi Barang Habis Pakai</option>'
		);
		$('.filter2').hide();
		$("#jns_kib").on('change', function () {
			document.getElementById('fm2').reset();
			$('.filter2').hide();
			if (this.value == 'trkib_a') {
				$('.trkib_a').show();
			}
			if (this.value == 'trkib_b') {
				$('.trkib_b').show();
			}
			if (this.value == 'trkib_c') {
				$('.trkib_c').show();
			}
			if (this.value == 'trkib_d') {
				$('.trkib_d').show();
			}
			if (this.value == 'trkib_e') {
				$('.trkib_e').show();
			}
			if (this.value == 'trkib_f') {
				$('.trkib_f').show();
			}
		});

		cek($("#jns_kib").val());

	});

	function get_image(id_barang) {
		var kib = $("#jns_kib").val();
		var stat = "";
		$("#image_list").html('');
		$.ajax({
			url: '<?=base_url()?>index.php/review/get_image?id_barang=' + id_barang + '&jns_kib=' + kib,
			dataType: 'json',
			success: function (data) {
				if (data.foto1 != 'javascript:void(0)') {
					$("#image_list").append('<div class="col-md-3 col-sm-4 col-xs-6">' +
						'<a  href="' + data.foto1 +
						'" data-toggle="lightbox" data-gallery="example-gallery">' +
						'<img  src="' + data.foto1 + '" class="img-responsive img-rounded">' +
						'</a>' +
						'</div>');
					stat = 1;
				}
				if (data.foto2 != 'javascript:void(0)') {
					$("#image_list").append('<div class="col-md-3 col-sm-4 col-xs-6">' +
						'<a  href="' + data.foto2 +
						'" data-toggle="lightbox" data-gallery="example-gallery">' +
						'<img  src="' + data.foto2 + '" class="img-responsive img-rounded">' +
						'</a>' +
						'</div>');
					stat = 1;
				}
				if (data.foto3 != 'javascript:void(0)') {
					$("#image_list").append('<div class="col-md-3 col-sm-4 col-xs-6">' +
						'<a  href="' + data.foto3 +
						'" data-toggle="lightbox" data-gallery="example-gallery">' +
						'<img  src="' + data.foto3 + '" class="img-responsive img-rounded">' +
						'</a>' +
						'</div>');
					stat = 1;
				}
				if (data.foto4 != 'javascript:void(0)') {
					$("#image_list").append('<div class="col-md-3 col-sm-4 col-xs-6">' +
						'<a  href="' + data.foto4 +
						'" data-toggle="lightbox" data-gallery="example-gallery">' +
						'<img  src="' + data.foto4 + '" class="img-responsive img-rounded">' +
						'</a>' +
						'</div>');
					stat = 1;
				}
				if (stat == 1) {
					$('#image').modal('show');
				} else {
					alert("No Image Found");
				}

			},
			async: false
		});
	}

	function cek(vall) {
		document.getElementById('fm2').reset();
		$('.filter2').hide();
		if (vall == 'trkib_a') {
			$('.trkib_a').show();
		}
		if (vall == 'trkib_b') {
			$('.trkib_b').show();
		}
		if (vall == 'trkib_c') {
			$('.trkib_c').show();
		}
		if (vall == 'trkib_d') {
			$('.trkib_d').show();
		}
		if (vall == 'trkib_e') {
			$('.trkib_e').show();
		}
		if (vall == 'trkib_f') {
			$('.trkib_f').show();
		}
	}

	function get_unit(kd_skpd) {
		$.ajax({
			url: 'survey_v2/get_unit',
			dataType: 'json',
			type: 'POST',
			data: {
				kd_skpd: kd_skpd
			},
			beforeSend: function (data) {
				$('#kd_unit').html('<option selected value="">Loading...</option>');
			},
			success: function (data) {
				swal.close();
				var html = '<option selected value="">-PILIH-</option>';
				var i;
				for (i = 0; i < data.length; i++) {
					html += '<option value="' + data[i].kd_lokasi + '">' + data[i].kd_lokasi + ' | ' + data[i]
						.nm_lokasi + '</option>';
				}
				$('#kd_unit').html(html);
				$('#kd_unit').val(localStorage.getItem("kd_unit"));
			},
			async: false
		});
	}
	$("#fm").submit(function (e) {
		var jns_kib = $("#jns_kib").val();
		var stat_fisik2 = $("#stat_fisik2").val();
		var keberadaan_brg2 = $("input[name='keberadaan_brg2']:checked").val();
		var kondisi_brg2 = $("input[name='kondisi_brg2']:checked").val();
		var kd_skpd = $("#kd_skpd").val();
		var kd_unit = $("#kd_unit").val();
		e.preventDefault();
		if (kd_skpd == null || kd_skpd == '' || kd_unit == null || kd_unit == '') {
			alert('Lengkapi pilihan kd_skpd atau kd_unit!');
			return false;
		}
		$.ajax({
			url: "<?php echo base_url();?>index.php/review/falidasi?jns_kib=" + jns_kib + "&kd_skpd=" +
				kd_skpd + "&kd_unit=" + kd_unit,
			type: "post",
			data: $("#fm").serialize(),
			beforeSend: function () {
				$("button:submit").attr('disabled', true);
			},
			success: function (result) {
				$("button:submit").attr('disabled', false);
				if (result != 'Berhasil!') {
					$('#list').DataTable().ajax.reload(null, true);
					$('#modal_review').modal('toggle');
					alert(result);
				} else {
					uncheked_ada();
					uncheked_tidak_ada();
					$("#ada").addClass('active');
					$("#tidak").removeClass('active');
					$("#tab_1").addClass('active');
					$("#tab_2").removeClass('active');
					$("#stat_fisik2").val(1);
					$("#catat").val("");
					$("#no_sensus").val("");
					$("#rincian").html("Detail");
					$('#list').DataTable().ajax.reload(null, true);
					$('#modal_review').modal('toggle');
					alert(result);
				}
			},
			error: function (error) {
				alert("Terjadi kesalahan, Coba lagi!");
				$("button:submit").attr('disabled', false);
			}
		});
	});
	$("#fm_equal_sensus").submit(function (e) {
		var jns_kib = $("#jns_kib").val();
		var kd_skpd = $("#kd_skpd").val();
		var kd_unit = $("#kd_unit").val();
		e.preventDefault();
		if (kd_skpd == null || kd_skpd == '' || kd_unit == null || kd_unit == '') {
			alert('Lengkapi pilihan kd_skpd atau kd_unit!');
			return false;
		}
		$.ajax({
			url: "<?php echo base_url();?>index.php/review/falidasi_equal_sensus?jns_kib=" + jns_kib +
				"&kd_skpd=" + kd_skpd + "&kd_unit=" + kd_unit,
			type: "post",
			data: $("#fm_equal_sensus").serialize(),
			beforeSend: function () {
				$("button:submit").attr('disabled', true);
			},
			success: function (result) {
				$("button:submit").attr('disabled', false);
				if (result != 'Berhasil!') {
					$('#list').DataTable().ajax.reload(null, true);
					$('#equal_sensus').modal('toggle');
					alert(result);
				} else {
					$("#no_sensus_equal_sensus").val("");
					$("#catat_equal_sensus").html("Detail");
					$('#list').DataTable().ajax.reload(null, true);
					$('#equal_sensus').modal('toggle');
					alert(result);
				}
			},
			error: function (error) {
				alert("Terjadi kesalahan, Coba lagi!");
				$("button:submit").attr('disabled', false);
			}
		});
	});

	function uncheked_ada() {
		$(".radio_ada").prop("checked", false);
		$("#stat_fisik2").val(0);
	}

	function uncheked_tidak_ada() {
		$(".radio_tidak_ada").prop("checked", false);
		$("#stat_fisik2").val(1);
	}

	function edit(arg) {
		var jns_kib = $('#jns_kib').val();
		if ($('#no_sensus').val() == '' && arg == '') {
			alert('Belum memilih barang!');
		} else if (arg == '') {
			$('#modal_review').modal('show');
		} else {
			$.ajax({
				url: '<?php echo base_url();?>index.php/review/get_brg_id?id_barang=' + arg + '&jns_kib=' +
					jns_kib,
				dataType: 'json',
				success: function (data) {
					$("#id_barang").val(data.id_barang);
					$("#no_sensus").val(data.no_sensus);
					$("#rincian").html(data.rincian);
					if (data.stat_fisik2 == '1') {
						$("#ada").addClass('active');
						$("#tidak").removeClass('active');
						$("#tab_1").addClass('active');
						$("#tab_2").removeClass('active');
					} else {
						$("#ada").removeClass('active');
						$("#tidak").addClass('active');
						$("#tab_1").removeClass('active');
						$("#tab_2").addClass('active');
					}

					$('input:radio[value="' + data.keberadaan_brg2 + '"]').prop('checked', true);
					$('input:radio[value="' + data.kondisi_brg2 + '"]').prop('checked', true);
					$('input:radio[value="' + data.ket_brg2 + '"]').prop('checked', true);
					$("#catat").val(data.catatan);
					$("#stat_fisik2").val(data.stat_fisik2);
				}
			});
			$('#modal_review').modal('show');
		}
	}
</script>
