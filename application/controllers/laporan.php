<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
	}
	public function index(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_laporan';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	public function sensus_review(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_laporan_review';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	public function upb()
	{
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_laporan_upb';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	public function review()
	{
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_laporan_upb_review';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	function get_jns_sensus(){
		$data=$this->M_model->get_jns_sensus();
		echo json_encode($data);
	}
	function get_mengetahui(){
		$kd_skpd = $this->input->post('kd_skpd');
		$unit_skpd = $this->input->post('unit_skpd');
		$data=$this->M_model->get_ttd('PA',$kd_skpd,$unit_skpd);
		echo json_encode($data);
	}
	function get_pengurus(){
		$kd_skpd = $this->input->post('kd_skpd');
		$unit_skpd = $this->input->post('unit_skpd');
		$data=$this->M_model->get_ttd('PB',$kd_skpd,$unit_skpd);
		echo json_encode($data);
	}
	function get_skpd(){
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4 OR $_SESSION['otori']==5) {
			$where="";
		}else{
			$where="WHERE kd_skpd='$_SESSION[skpd]'";
		}
		$data = $this->db->query("SELECT kd_skpd,nm_skpd FROM ms_skpd $where")->result();
		echo json_encode($data);
	}
	function get_unit(){
		$p = $this->input->post('kd_skpd');
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4 OR $_SESSION['otori']==2) {
			$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_skpd ='$p' order by kd_lokasi ASC")->result();
		}else if($p=='1.02.01.00'){
			$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE LEFT(kd_lokasi,11) ='$_SESSION[unit_skpd]' order by kd_lokasi ASC")->result();
		}else{
			$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_lokasi ='$_SESSION[unit_skpd]' order by kd_lokasi ASC")->result();
		}
		echo json_encode($data);
	}

	function nm_unit($kd_unit){
		$res = $this->db->where('kd_lokasi',$kd_unit)->get('mlokasi')->row('nm_lokasi');
		return $res;
	}

	function saveTtd(){
		$key     = $this->input->post('key');
		$kd_skpd = $this->input->post('skpd');
		$kd_unit = $this->input->post('unit');
		$nip     = $this->input->post('nip');
		$nama    = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$kode    = $this->input->post('kode_jabatan');
		$nm_skpd = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row();
		if ($key==0) {
			$query = $this->db->query("INSERT into ttd (nip,nama,jabatan,skpd,unit,nm_skpd,ckey) value('$nip','$nama',UPPER('$jabatan'),'$kd_skpd','$kd_unit','$nm_skpd->nm_skpd','$kode')");
		}else{
			$value    = array(
				'nip'     => $nip,
				'nama'    => $nama,
				'jabatan' => strtoupper($jabatan),
				'ckey'    => $kode);
			$where = array(
				'nip' => $nip,
				'skpd' => $kd_skpd,
				'unit' => $kd_unit
			);
			$query = $this->db->where($where);
			$query = $this->db->update('ttd', $value);
		}

		if ($query) {
			$data = true;
		}else{
			$data = false;
		}
		echo json_encode($data);
	}
	
	function cetak_laporan(){
		$cetak      = $_REQUEST['cetak'];
		$jns_kib    = $_REQUEST['jns_kib'];
		$jns_cetak  = $_REQUEST['jns_cetak'];
		$fisik_brg  = $_REQUEST['fisik_brg'];
		$kriteria   = $_REQUEST['kriteria'];
		$mengetahui = ($_REQUEST['mengetahui']=='-PILIH-') ? '':$_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = ($_REQUEST['pengurus']=='-PILIH-') ? '':$_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$tmrg       = $_REQUEST['tmrg'];
		$bmrg       = $_REQUEST['bmrg'];
		$lmrg       = $_REQUEST['lmrg'];
		$rmrg       = $_REQUEST['rmrg'];
		$hmrg       = $_REQUEST['hmrg'];
		$fmrg       = $_REQUEST['fmrg'];
		$t_baris    = $_REQUEST['t_baris'];
		$orien      = $_REQUEST['orien'];
		$kd_skpd    = $_REQUEST['kd_skpd'];
		$kd_unit    = $_REQUEST['unit_skpd'];
		if ($kriteria == 1) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"12\">: SKPD</td>
								</tr>";
		}else if ($kriteria == 2) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"12\">: DIKERJASAMAKAN DENGAN PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 3) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"12\">: DIKUASAI SECARA TIDAK SAH PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 4) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"12\">: BAIK</td>
								</tr>";
		}else if ($kriteria == 5) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"12\">: KURANG BAIK</td>
								</tr>";
		}else if ($kriteria == 6) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"12\">: RUSAK BERAT</td>
								</tr>";
		}else if ($kriteria == 7) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"12\">: TIDAK DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 8) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"12\">: DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 9) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"12\">: ADA</td>
								</tr>";
		}else if ($kriteria == 10) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"12\">: TIDAK ADA</td>
								</tr>";
		}else if ($kriteria == 11) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"12\">: HILANG KARENA KECURIAN</td>
								</tr>";
		}else if ($kriteria == 12) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"12\">: TIDAK DIKETAHUI KEBERADAANNYA</td>
								</tr>";
		}else if ($kriteria == 13) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"12\">: FISIK HABIS/TIDAK ADA KARENA SEBAB YANG WAJAR</td>
								</tr>";
		}else if ($kriteria == 14) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"12\">: SEHARUSNYA TELAH DIHAPUS</td>
								</tr>";
		}else if ($kriteria == 15) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"12\">: DOBEL/LEBIH CATAT</td>
								</tr>";
		}else if ($kriteria == 16) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"12\">: KOREKSI BARANG HABIS PAKAI</td>
								</tr>";
		}else if ($kriteria == 17) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"12\">: MILIK PEMERINTAH PUSAT (BMN)/PEMDA LAIN</td>
								</tr>";
		}else if ($kriteria == 18) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"12\">: MILIK PIHAK LAIN NON PEMERINTAH</td>
								</tr>";
		}else if ($kriteria == 19) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"12\">: MILIK PEMERINTAH KOTA MAKASSAR</td>
								</tr>";
		}else {
			$ket_stat_fisik = "";
		}

		if ($jns_cetak==0 && $jns_kib==3) {
			$kop_a = "KARTU INVENTARIS BARANG (KIB) A<br>TANAH"; 
		}else{
			$kop_a = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN TANAH"; 
		}

		if ($jns_cetak==0 && $jns_kib==4) {
			$kop_b = "KARTU INVENTARIS BARANG (KIB) B<br>PERALATAN DAN MESIN"; 
		}else{
			$kop_b = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN PERALATAN DAN MESIN"; 
		}

		if ($jns_cetak==0 && $jns_kib==5) {
			$kop_c = "KARTU INVENTARIS BARANG (KIB) C<br>GEDUNG DAN BANGUNAN"; 
		}else{
			$kop_c = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN GEDUNG DAN BANGUNAN"; 
		}

		if ($jns_cetak==0 && $jns_kib==6) {
			$kop_d = "KARTU INVENTARIS BARANG (KIB) D<br>JALAN, IRIGASI, DAN JARINGAN"; 
		}else{
			$kop_d = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN JALAN, IRIGASI, DAN JARINGAN"; 
		}

		if ($jns_cetak==0 && $jns_kib==7) {
			$kop_e = "KARTU INVENTARIS BARANG (KIB) E<br>ASET TETAP LAINNYA"; 
		}else{
			$kop_e = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN ASET TETAP LAINNYA"; 
		}

		if ($jns_cetak==0 && $jns_kib==8) {
			$kop_f = "KARTU INVENTARIS BARANG (KIB) F<br>KONSTRUKSI DALAM PENGERJAAN"; 
		}else{
			$kop_f = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN KONSTRUKSI DALAM PENGERJAAN"; 
		}
		if ($mengetahui!=='') {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(b.nm_lokasi)) as jabatan_m FROM ttd a INNER JOIN mlokasi b on a.unit=b.kd_lokasi where a.nip = '$nip_m' AND b.kd_lokasi='$kd_unit'")->row_array();
		}else {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(nm_lokasi)) as jabatan_m FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		}
		$nm_skpd    = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit    = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		$ket_sensus = "";
		if ($jns_kib==3) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_a('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 6;
				$col_hr		= 16;
				$col_sub    = 14;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">16</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"3\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 5;
				$col_hr		= 15;
				$col_sub    = 13;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_a</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Luas(m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Tahun</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Letak/Alamat</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Penggunaan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Keterangan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Register</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Hak</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Sertifikat</th>
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th width=\"2%\"  valign=\"midle\" align=\"center\">1</th>
						<th width=\"20%\" valign=\"midle\" align=\"center\">2</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">3</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">4</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">5</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">6</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">7</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">8</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">9</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">10</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">11</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">12</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">13</th>
						<th width=\"13%\" valign=\"midle\" align=\"center\">14</th>
						<th width=\"18%\" valign=\"midle\" align=\"center\">15</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$ket_sensus = $row->ket_sensus;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"center\">".$row->luas."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"left\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->tgl_sertifikat."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_sertifikat."</td>
						<td  valign=\"top\" align=\"left\">".$row->penggunaan."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}

				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7; font-weight:bold;\">
						<td colspan=\"13\" align=\"center\">Total</td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"15\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"7\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">Mengetahui,</td>
					<td align=\"center\" colspan=\"7\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"7\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"15\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"7\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"7\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==4) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_b('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 9;
				$col_hr		= 19;
				$col_sub    = 16;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">18</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 8;
				$col_hr		= 18;
				$col_sub    = 15;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_b</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Register</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Merek/Type</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Ukuran/CC</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Bahan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Tahun</th>
						<th valign=\"midle\" align=\"center\" colspan=\"5\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Pabrik</th>
						<th valign=\"midle\" align=\"center\">Rangka</th>
						<th valign=\"midle\" align=\"center\">Mesin</th>
						<th valign=\"midle\" align=\"center\">Polisi</th>
						<th valign=\"midle\" align=\"center\">BPKB</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th width=\"2%\"  valign=\"midle\" align=\"center\">1</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">2</th>
						<th width=\"14%\" valign=\"midle\" align=\"center\">3</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">4</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">5</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">6</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">7</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">8</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">9</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">10</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">11</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">12</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">13</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">14</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">15</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">16</th>
						<th width=\"13%\" valign=\"midle\" align=\"center\">17</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->merek."</td>
						<td  valign=\"top\" align=\"left\">".$row->silinder."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_bahan."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"left\">".$row->pabrik."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_rangka."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_mesin."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_polisi."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_bpkb."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"15\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"17\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"9\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">Mengetahui,</td>
					<td align=\"center\" colspan=\"9\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"9\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"17\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"9\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"9\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==5) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_c('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 7;
				$col_hr		= 19;
				$col_sub    = 17;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">19</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 6;
				$col_hr		= 18;
				$col_sub    = 16;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"6\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_c</b></td>
					<td width=\"30%\" colspan=\"6\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Kondisi (B/KB/RB)</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Konstruksi Gedung/Bangunan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas/Lantai</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Letak/Lokasi Alamat</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Dokumen Gedung</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas (m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nomor Kode Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\">Register</th>
						<th valign=\"midle\" align=\"center\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\">Bertingkat/Tidak</th>
						<th valign=\"midle\" align=\"center\">Beton/Tidak</th>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th valign=\"midle\" align=\"center\">1</th>
						<th valign=\"midle\" align=\"center\">2</th>
						<th valign=\"midle\" align=\"center\">3</th>
						<th valign=\"midle\" align=\"center\">4</th>
						<th valign=\"midle\" align=\"center\">5</th>
						<th valign=\"midle\" align=\"center\">6</th>
						<th valign=\"midle\" align=\"center\">7</th>
						<th valign=\"midle\" align=\"center\">8</th>
						<th valign=\"midle\" align=\"center\">9</th>
						<th valign=\"midle\" align=\"center\">10</th>
						<th valign=\"midle\" align=\"center\">11</th>
						<th valign=\"midle\" align=\"center\">12</th>
						<th valign=\"midle\" align=\"center\">13</th>
						<th valign=\"midle\" align=\"center\">14</th>
						<th valign=\"midle\" align=\"center\">15</th>
						<th valign=\"midle\" align=\"center\">16</th>
						<th valign=\"midle\" align=\"center\">17</th>
						<th valign=\"midle\" align=\"center\">18</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"center\">".$row->kondisi."</td>
						<td  valign=\"top\" align=\"center\">".$row->konstruksi."</td>
						<td  valign=\"top\" align=\"center\">".$row->jenis_gedung."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas_lantai."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"left\">".$row->tgl_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"16\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"18\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\" width=\"50%\"></td>
					<td></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">Mengetahui,</td>
					<td></td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
					<td></td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"18\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
					<td></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
					<td></td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==6) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_d('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 8;
				$col_hr		= 18;
				$col_sub    = 16;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">18</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 7;
				$col_hr		= 17;
				$col_sub    = 15;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_d</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Jenis Barang / Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Konstruksi</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Panjang (Km)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Lebar (M)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas (m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Letak/Lokasi</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Dokumen</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nomor Kode Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\">Register</th>
						<th valign=\"midle\" align=\"center\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th valign=\"midle\" align=\"center\">1</th>
						<th valign=\"midle\" align=\"center\">2</th>
						<th valign=\"midle\" align=\"center\">3</th>
						<th valign=\"midle\" align=\"center\">4</th>
						<th valign=\"midle\" align=\"center\">5</th>
						<th valign=\"midle\" align=\"center\">6</th>
						<th valign=\"midle\" align=\"center\">7</th>
						<th valign=\"midle\" align=\"center\">8</th>
						<th valign=\"midle\" align=\"center\">9</th>
						<th valign=\"midle\" align=\"center\">10</th>
						<th valign=\"midle\" align=\"center\">11</th>
						<th valign=\"midle\" align=\"center\">12</th>
						<th valign=\"midle\" align=\"center\">13</th>
						<th valign=\"midle\" align=\"center\">14</th>
						<th valign=\"midle\" align=\"center\">15</th>
						<th valign=\"midle\" align=\"center\">16</th>
						<th valign=\"midle\" align=\"center\">17</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->konstruksi."</td>
						<td  valign=\"top\" align=\"left\">".$row->panjang."</td>
						<td  valign=\"top\" align=\"left\">".$row->lebar."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"left\">".$row->tgl_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"15\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"17\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">Mengetahui,</td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"17\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==7) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_e('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 8;
				$col_hr		= 18;
				$col_sub    = 16;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">18</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 7;
				$col_hr		= 17;
				$col_sub    = 15;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_e</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Buku Perpustakaan</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Barang Bercora Kesenian/Kebudayaan</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Hewan/Ternak dan Tumbuhan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">JUmlah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Tahun Pembelian</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul Perolehan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\">Register</th>
						<th valign=\"midle\" align=\"center\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\">Judul/Pencipta</th>
						<th valign=\"midle\" align=\"center\">Spesifikasi</th>
						<th valign=\"midle\" align=\"center\">Asal Daerah</th>
						<th valign=\"midle\" align=\"center\">Pencipta</th>
						<th valign=\"midle\" align=\"center\">Bahan</th>
						<th valign=\"midle\" align=\"center\">Jenis</th>
						<th valign=\"midle\" align=\"center\">Ukuran</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th valign=\"midle\" align=\"center\">1</th>
						<th valign=\"midle\" align=\"center\">2</th>
						<th valign=\"midle\" align=\"center\">3</th>
						<th valign=\"midle\" align=\"center\">4</th>
						<th valign=\"midle\" align=\"center\">5</th>
						<th valign=\"midle\" align=\"center\">6</th>
						<th valign=\"midle\" align=\"center\">7</th>
						<th valign=\"midle\" align=\"center\">8</th>
						<th valign=\"midle\" align=\"center\">9</th>
						<th valign=\"midle\" align=\"center\">10</th>
						<th valign=\"midle\" align=\"center\">11</th>
						<th valign=\"midle\" align=\"center\">12</th>
						<th valign=\"midle\" align=\"center\">13</th>
						<th valign=\"midle\" align=\"center\">14</th>
						<th valign=\"midle\" align=\"center\">15</th>
						<th valign=\"midle\" align=\"center\">16</th>
						<th valign=\"midle\" align=\"center\">17</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->judul."</td>
						<td  valign=\"top\" align=\"left\">".$row->spesifikasi."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"left\">".$row->cipta."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_bahan."</td>
						<td  valign=\"top\" align=\"left\">".$row->jenis."</td>
						<td  valign=\"top\" align=\"left\">".$row->tipe."</td>
						<td  valign=\"top\" align=\"left\">".$row->jumlah."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"center\">".$row->peroleh."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"15\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"17\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">Mengetahui,</td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"16\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==8) {

			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_f('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 7;
				$col_hr		= 17;
				$col_sub    = 15;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">17</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 6;
				$col_hr		= 16;
				$col_sub    = 14;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_f</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			";
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Bangunan (P.SP.D)</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Konstruksi</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas (m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Letak/Lokasi</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Dokumen</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Tgl,Bln,Thn,Mulai</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nomor Kode Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nilai Kontrak</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Bertingkat/Tidak</th>
						<th valign=\"midle\" align=\"center\">Beton/Tidak</th>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th width =\"2%\"  valign=\"midle\" align=\"center\">1</th>
						<th width =\"15%\" valign=\"midle\" align=\"center\">2</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">3</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">4</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">5</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">6</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">7</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">8</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">9</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">10</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">11</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">12</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">13</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">14</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">15</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">16</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->bangunan."</td>
						<td  valign=\"top\" align=\"left\">".$row->konstruksi."</td>
						<td  valign=\"top\" align=\"left\">".$row->jenis."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"left\">".$row->tgl_awal_kerja."</td>
						<td  valign=\"top\" align=\"left\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"14\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"16\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">Mengetahui,</td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"16\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==''){
			$kon        = "";
			$skpdorunit = "";
			$krit       = "";

		if ($kriteria == 1) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: SKPD</td>
								</tr>";
		}else if ($kriteria == 2) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: DIKERJASAMAKAN DENGAN PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 3) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: DIKUASAI SECARA TIDAK SAH PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 4) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: BAIK</td>
								</tr>";
		}else if ($kriteria == 5) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: KURANG BAIK</td>
								</tr>";
		}else if ($kriteria == 6) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: RUSAK BERAT</td>
								</tr>";
		}else if ($kriteria == 7) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"14\">: TIDAK DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 8) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"14\">: DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 9) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"14\">: ADA</td>
								</tr>";
		}else if ($kriteria == 10) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"14\">: TIDAK ADA</td>
								</tr>";
		}else if ($kriteria == 11) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: HILANG KARENA KECURIAN</td>
								</tr>";
		}else if ($kriteria == 12) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: TIDAK DIKETAHUI KEBERADAANNYA</td>
								</tr>";
		}else if ($kriteria == 13) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: FISIK HABIS/TIDAK ADA KARENA SEBAB YANG WAJAR</td>
								</tr>";
		}else if ($kriteria == 14) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: SEHARUSNYA TELAH DIHAPUS</td>
								</tr>";
		}else if ($kriteria == 15) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: DOBEL/LEBIH CATAT</td>
								</tr>";
		}else if ($kriteria == 16) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: KOREKSI BARANG HABIS PAKAI</td>
								</tr>";
		}else if ($kriteria == 17) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PEMERINTAH PUSAT (BMN)/PEMDA LAIN</td>
								</tr>";
		}else if ($kriteria == 18) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PIHAK LAIN NON PEMERINTAH</td>
								</tr>";
		}else if ($kriteria == 19) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PEMERINTAH KOTA MAKASSAR</td>
								</tr>";
		}else {
			$ket_stat_fisik = "";
		}

			if ($kd_skpd<>'') {
				$skpdorunit = " AND a.kd_skpd='$kd_skpd'";
			}elseif($kd_unit<>''){
				$skpdorunit = " AND a.kd_unit='$kd_unit'";
			}elseif($kd_skpd<>'' && $kd_unit<>''){
				$skpdorunit = " AND a.kd_skpd='$kd_skpd' AND a.kd_unit='$kd_unit'";
			}

			$kon = "WHERE 1=1 ";
			if ($kriteria<>'') {
				$krit =" AND (CASE WHEN $fisik_brg='0' THEN a.stat_fisik='0' 
						 WHEN $fisik_brg='1' THEN a.stat_fisik='1'
						 ELSE a.stat_fisik IS NULL OR a.stat_fisik='' OR a.stat_fisik IN ('0','1') END)
						 AND (CASE WHEN $kriteria='1' THEN a.keberadaan_brg='SKPD' 
						 WHEN $kriteria='2' THEN a.keberadaan_brg='Dikerjasamakan dengan pihak lain'
						 WHEN $kriteria='3' THEN a.keberadaan_brg='Dikuasai secara tidak sah pihak lain'
						 WHEN $kriteria='4' THEN a.kondisi_brg='Baik' 
						 WHEN $kriteria='5' THEN a.kondisi_brg='Kurang Baik' 
						 WHEN $kriteria='6' THEN a.kondisi_brg='Rusak Berat' 
						 WHEN $kriteria='7' THEN a.stat_hukum='Tidak Dalam Gugatan Hukum' 
						 WHEN $kriteria='8' THEN a.stat_hukum='Dalam Gugatan Hukum' 
						 WHEN $kriteria='9' THEN a.bukti_milik='Ada' 
						 WHEN $kriteria='10' THEN a.bukti_milik='Tidak Ada'
						 WHEN $kriteria='11' THEN a.ket_brg='Hilang'
						 WHEN $kriteria='12' THEN a.ket_brg='Tidak Diketahui Keberadaannya' 
						 WHEN $kriteria='13' THEN a.ket_brg='Habis Akibat Usia Barang'
						 WHEN $kriteria='14' THEN a.ket_brg='Seharusnya Telah dihapus'
						 WHEN $kriteria='15' THEN a.ket_brg='Double Catat'
						 WHEN $kriteria='16' THEN a.ket_brg='Koreksi BHP'
						 WHEN $kriteria='17' THEN a.status_milik='Milik Pemerintah Pusat'
						 WHEN $kriteria='18' THEN a.status_milik='Milik Pihak Lain Non Pemerintah'
						 WHEN $kriteria='19' THEN a.status_milik='Milik Pemerintah Kota Makassar' 	
						 ELSE a.keberadaan_brg IS NULL OR a.keberadaan_brg=''
						 OR a.keberadaan_brg IN ('SKPD','Dikerjasamakan dengan pihak lain','Dikuasai secara tidak sah pihak lain')
						 OR a.kondisi_brg IS NULL OR a.kondisi_brg=''
						 OR a.kondisi_brg IN ('Baik','Kurang Baik','Rusak Berat')
						 OR a.stat_hukum IS NULL OR a.stat_hukum=''
						 OR a.stat_hukum IN ('Tidak Dalam Gugatan Hukum','Dalam Gugatan Hukum')
						 OR a.bukti_milik IS NULL OR a.bukti_milik=''
						 OR a.bukti_milik IN ('Ada','Tidak Ada')
						 OR a.status_milik IS NULL OR a.status_milik=''
						 OR a.status_milik IN ('Milik Pemerintah Kota Makassar','Milik Pemerintah Pusat','Milik Pihak Lain Non Pemerintah')
						 OR a.ket_brg IS NULL OR a.ket_brg=''
						 OR a.ket_brg IN ('Hilang','Tidak Diketahui Keberadaannya','Habis Akibat Usia Barang','Seharusnya Telah dihapus','Double Catat','Koreksi BHP')
						 END)";
			}
			$where =$kon.$skpdorunit.$krit;
		$cRet  = "";
        $cRet .= "
	        <table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		        <tr>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
			        <td width=\"40%\" colspan=\"6\" align=\"center\"><b>LAPORAN VALIDASI BMD MILIK DAERAH<br>PEMERINTAH KOTA MAKASSAR<br>TAHUN ANGGARAN 2019</b></td>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
		        </tr>
		        <tr>
		        	<td colspan=\"16\" align=\"center\" style=\"font-size:16px\"><hr></td>
		        </tr>
	        </table>
	        <table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
	        	<tr>
					<td width=\"2%\" ></td>
					<td width=\"13%\"></td>
					<td width=\"85%\" colspan=\"14\"></td>
				</tr>
	        ";
	        if ($kd_skpd<>'') {
			$cRet .="
				<tr>
					<td width=\"2%\" ></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"14\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			}

			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UPB</td>
					<td colspan=\"14\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				$ket_stat_fisik
			</table>
           <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NOMOR</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE BARANG</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>REGISTER</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE SENSUS</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NAMA/JENIS BARANG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>MEREK/TIPE</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NO SERTIFIKAT/PABRIK/RANGKA/MESIN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>BAHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>ASAL/CARA PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>TAHUN PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>UKURAN BARANG/KONSTRUKSI PSD</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>SATUAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KONDISI</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>JML BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>HARGA BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KETERANGAN</b></td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px\">1</td>
                <td align=\"center\" style=\"font-size:10px\">2</td>
                <td align=\"center\" style=\"font-size:10px\">3</td>
                <td align=\"center\" style=\"font-size:10px\">4</td>
			    <td align=\"center\" style=\"font-size:10px\">5</td>
                <td align=\"center\" style=\"font-size:10px\">6</td>
                <td align=\"center\" style=\"font-size:10px\">7</td>
				<td align=\"center\" style=\"font-size:10px\">8</td>
				<td align=\"center\" style=\"font-size:10px\">9</td>
				<td align=\"center\" style=\"font-size:10px\">10</td>
				<td align=\"center\" style=\"font-size:10px\">11</td>
				<td align=\"center\" style=\"font-size:10px\">12</td>
				<td align=\"center\" style=\"font-size:10px\">13</td>
				<td align=\"center\" style=\"font-size:10px\">14</td>
				<td align=\"center\" style=\"font-size:10px\">15</td>
				<td align=\"center\" style=\"font-size:10px\">16</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
            </tr>
			</thead>";
			$csql = "SELECT * FROM (

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,
			(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_a_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus
			FROM trkib_a a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
			a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_b_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_b a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_c_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_c a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			
			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_d_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_d a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
			a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus
			FROM trkib_e a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where  
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    '' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_f a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			
			) faiz  ORDER BY kd_brg,no_reg,tahun";
                        
             $ket_sensus='';
             $jml_brgx ='';
			 $nilaix   ='';
			 $nama_barang = '';
			 $i = 1;
             $hasil=$this->db->query($csql);
             foreach ($hasil->result() as $row)
             {  
				$jml_brgx = $jml_brgx + $row->jumlah;
				$nilaix   = $nilaix+($row->nilai+$row->nil_kap);
				if ($row->status!=1) {
					$ket_sensus='Belum Sensus';
				}else{
					$ket_sensus= $row->hsl;
				}
				if ($row->nm_brg<>'' && $row->detail_brg<>'') {
					$nama_barang = $row->nm_brg." / ".$row->detail_brg;
				}elseif ($row->nm_brg<>'' && ($row->detail_brg=='' OR $row->detail_brg==null)) {
					$nama_barang = $row->nm_brg;
				}else{
					$nama_barang = $row->detail_brg;
				}
                $cRet .="
                 <tr>
                    <td valign=\"top\" align=\"center\" >$i</td>
                    <td valign=\"top\" align=\"center\" >$row->kd_brg</td>
                    <td valign=\"top\" align=\"center\" >$row->no_reg</td>
                    <td valign=\"top\" align=\"center\" >$row->no_sensus</td>
                    <td valign=\"top\" align=\"left\"   >$nama_barang</td>
                    <td valign=\"top\" align=\"left\"   >$row->merek</td>
                    <td valign=\"top\" align=\"left\"   >$row->gabung</td>
                    <td valign=\"top\" align=\"left\"   >$row->kd_bahan</td>
                    <td valign=\"top\" align=\"left\"   >$row->asal</td>
                    <td valign=\"top\" align=\"center\" >$row->tahun</td>
                    <td valign=\"top\" align=\"left\"   >$row->silinder</td>
                    <td valign=\"top\" align=\"left\"   >$row->kd_satuan</td>
                    <td valign=\"top\" align=\"center\" >$row->kondisi</td>
                    <td valign=\"top\" align=\"center\" >$row->jumlah</td>
                    <td valign=\"top\" align=\"right\"  >".number_format($row->nilai+$row->nil_kap,2)."</td>
                    <td valign=\"top\" align=\"left\"   >$row->keterangan</td>
                </tr>"; 
                $i++;
             }
             $cRet .="
                <tr>
					<td bgcolor=\"#80FE80\" colspan=\"13\" align=\"center\" style=\" border-bottom:solid 1px black;\"><b>Jumlah</b></td>
                    <td bgcolor=\"#80FE80\" align=\"center\" style=\"border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#80FE80\" align=\"right\"  style=\"border-bottom:solid 1px black;\"><b>".number_format($nilaix,2)."</b></td>
                    <td bgcolor=\"#80FE80\" align=\"LEFT\"   style=\"border-bottom:solid 1px black;\"></td>
                </tr>
            </table>";
		}/*END IF*/

		$data['excel'] = $cRet;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf($orien,$lmrg,$rmrg,$tmrg,$bmrg,$hmrg,$fmrg,'',$cRet);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
			break;
			case 3:
			$namafile	= str_replace(' ','_',$judul);
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename= $namafile.xls");
			$this->load->view('doc', $data);
			break;
		}
	}/*cetak_laporan*/

	function cetak_laporan_review(){
		$cetak      = $_REQUEST['cetak'];
		$jns_kib    = $_REQUEST['jns_kib'];
		$jns_cetak  = $_REQUEST['jns_cetak'];
		$fisik_brg  = $_REQUEST['fisik_brg'];
		$kriteria   = $_REQUEST['kriteria'];
		$mengetahui = ($_REQUEST['mengetahui']=='-PILIH-') ? '':$_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = ($_REQUEST['pengurus']=='-PILIH-') ? '':$_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$tmrg       = $_REQUEST['tmrg'];
		$bmrg       = $_REQUEST['bmrg'];
		$lmrg       = $_REQUEST['lmrg'];
		$rmrg       = $_REQUEST['rmrg'];
		$hmrg       = $_REQUEST['hmrg'];
		$fmrg       = $_REQUEST['fmrg'];
		$t_baris    = $_REQUEST['t_baris'];
		$orien      = $_REQUEST['orien'];
		$kd_skpd    = $_REQUEST['kd_skpd'];
		$kd_unit    = $_REQUEST['unit_skpd'];
		if ($kriteria == 1) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: SKPD</td>
								</tr>";
		}else if ($kriteria == 2) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: DIKERJASAMAKAN DENGAN PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 3) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: DIKUASAI SECARA TIDAK SAH PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 4) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: BAIK</td>
								</tr>";
		}else if ($kriteria == 5) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: KURANG BAIK</td>
								</tr>";
		}else if ($kriteria == 6) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: RUSAK BERAT</td>
								</tr>";
		}else if ($kriteria == 7) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"14\">: TIDAK DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 8) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"14\">: DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 9) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"14\">: ADA</td>
								</tr>";
		}else if ($kriteria == 10) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"14\">: TIDAK ADA</td>
								</tr>";
		}else if ($kriteria == 11) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: HILANG KARENA KECURIAN</td>
								</tr>";
		}else if ($kriteria == 12) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: TIDAK DIKETAHUI KEBERADAANNYA</td>
								</tr>";
		}else if ($kriteria == 13) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: FISIK HABIS/TIDAK ADA KARENA SEBAB YANG WAJAR</td>
								</tr>";
		}else if ($kriteria == 14) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: SEHARUSNYA TELAH DIHAPUS</td>
								</tr>";
		}else if ($kriteria == 15) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: DOBEL/LEBIH CATAT</td>
								</tr>";
		}else if ($kriteria == 16) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: KOREKSI BARANG HABIS PAKAI</td>
								</tr>";
		}else if ($kriteria == 17) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PEMERINTAH PUSAT (BMN)/PEMDA LAIN</td>
								</tr>";
		}else if ($kriteria == 18) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PIHAK LAIN NON PEMERINTAH</td>
								</tr>";
		}else if ($kriteria == 19) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PEMERINTAH KOTA MAKASSAR</td>
								</tr>";
		}else {
			$ket_stat_fisik = "";
		}

		if ($jns_cetak==0 && $jns_kib==3) {
			$kop_a = "KARTU INVENTARIS BARANG (KIB) A<br>TANAH"; 
		}else{
			$kop_a = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN TANAH"; 
		}

		if ($jns_cetak==0 && $jns_kib==4) {
			$kop_b = "KARTU INVENTARIS BARANG (KIB) B<br>PERALATAN DAN MESIN"; 
		}else{
			$kop_b = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN PERALATAN DAN MESIN"; 
		}

		if ($jns_cetak==0 && $jns_kib==5) {
			$kop_c = "KARTU INVENTARIS BARANG (KIB) C<br>GEDUNG DAN BANGUNAN"; 
		}else{
			$kop_c = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN GEDUNG DAN BANGUNAN"; 
		}

		if ($jns_cetak==0 && $jns_kib==6) {
			$kop_d = "KARTU INVENTARIS BARANG (KIB) D<br>JALAN, IRIGASI, DAN JARINGAN"; 
		}else{
			$kop_d = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN JALAN, IRIGASI, DAN JARINGAN"; 
		}

		if ($jns_cetak==0 && $jns_kib==7) {
			$kop_e = "KARTU INVENTARIS BARANG (KIB) E<br>ASET TETAP LAINNYA"; 
		}else{
			$kop_e = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN ASET TETAP LAINNYA"; 
		}

		if ($jns_cetak==0 && $jns_kib==8) {
			$kop_f = "KARTU INVENTARIS BARANG (KIB) F<br>KONSTRUKSI DALAM PENGERJAAN"; 
		}else{
			$kop_f = "LAPORAN VALIDASI BMD MILIK DAERAH<br>
						TAHUN ANGGARAN ".date('Y')."<br>
						GOLONGAN KONSTRUKSI DALAM PENGERJAAN"; 
		}
		if ($mengetahui!=='') {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(b.nm_lokasi)) as jabatan_m FROM ttd a INNER JOIN mlokasi b on a.unit=b.kd_lokasi where a.nip = '$nip_m' AND b.kd_lokasi='$kd_unit'")->row_array();
		}else {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(nm_lokasi)) as jabatan_m FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		}
		$nm_skpd    = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit    = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		$ket_sensus = "";
		if ($jns_kib==3) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_a('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 8;
				$col_hr		= 18;
				$col_sub    = 16;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">18</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"3\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 7;
				$col_hr		= 17;
				$col_sub    = 15;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_a</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Luas(m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Tahun</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Letak/Alamat</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Penggunaan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Keterangan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Review</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\">Catatan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Register</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Hak</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Sertifikat</th>
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th width=\"2%\"  valign=\"midle\" align=\"center\">1</th>
						<th width=\"20%\" valign=\"midle\" align=\"center\">2</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">3</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">4</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">5</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">6</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">7</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">8</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">9</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">10</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">11</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">12</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">13</th>
						<th width=\"13%\" valign=\"midle\" align=\"center\">14</th>
						<th width=\"18%\" valign=\"midle\" align=\"center\">15</th>
						<th width=\"13%\" valign=\"midle\" align=\"center\">16</th>
						<th width=\"18%\" valign=\"midle\" align=\"center\">17</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$ket_sensus = $row->ket_sensus;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"center\">".$row->luas."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"left\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->tgl_sertifikat."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_sertifikat."</td>
						<td  valign=\"top\" align=\"left\">".$row->penggunaan."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>
						<td  valign=\"top\" align=\"left\">".$row->review."</td>
						<td  valign=\"top\" align=\"left\">".$row->catatan."</td>
						";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}

				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7; font-weight:bold;\">
						<td colspan=\"13\" align=\"center\">Total</td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td>
						<td></td><td></td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"15\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"7\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">Mengetahui,</td>
					<td align=\"center\" colspan=\"7\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"7\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"15\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"7\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"7\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==4) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_b('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 11;
				$col_hr		= 21;
				$col_sub    = 18;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">20</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 10;
				$col_hr		= 20;
				$col_sub    = 17;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_b</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Register</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Merek/Type</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Ukuran/CC</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Bahan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Tahun</th>
						<th valign=\"midle\" align=\"center\" colspan=\"5\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Review</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Catatan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Pabrik</th>
						<th valign=\"midle\" align=\"center\">Rangka</th>
						<th valign=\"midle\" align=\"center\">Mesin</th>
						<th valign=\"midle\" align=\"center\">Polisi</th>
						<th valign=\"midle\" align=\"center\">BPKB</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th width=\"2%\"  valign=\"midle\" align=\"center\">1</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">2</th>
						<th width=\"14%\" valign=\"midle\" align=\"center\">3</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">4</th>
						<th width=\"7%\"  valign=\"midle\" align=\"center\">5</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">6</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">7</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">8</th>
						<th width=\"6%\"  valign=\"midle\" align=\"center\">9</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">10</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">11</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">12</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">13</th>
						<th width=\"4%\"  valign=\"midle\" align=\"center\">14</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">15</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">16</th>
						<th width=\"13%\" valign=\"midle\" align=\"center\">17</th>
						<th width=\"5%\"  valign=\"midle\" align=\"center\">18</th>
						<th width=\"13%\" valign=\"midle\" align=\"center\">19</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->merek."</td>
						<td  valign=\"top\" align=\"left\">".$row->silinder."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_bahan."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"left\">".$row->pabrik."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_rangka."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_mesin."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_polisi."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_bpkb."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>
						<td  valign=\"top\" align=\"left\">".$row->review."</td>
						<td  valign=\"top\" align=\"left\">".$row->catatan."</td>
						";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"15\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td><td></td><td></td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"17\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"9\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">Mengetahui,</td>
					<td align=\"center\" colspan=\"9\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"9\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"17\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"9\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"9\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==5) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_c('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 9;
				$col_hr		= 21;
				$col_sub    = 19;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">21</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 8;
				$col_hr		= 20;
				$col_sub    = 18;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"6\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_c</b></td>
					<td width=\"30%\" colspan=\"6\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Kondisi (B/KB/RB)</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Konstruksi Gedung/Bangunan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas/Lantai</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Letak/Lokasi Alamat</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Dokumen Gedung</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas (m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nomor Kode Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Review</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Catatan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\">Register</th>
						<th valign=\"midle\" align=\"center\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\">Bertingkat/Tidak</th>
						<th valign=\"midle\" align=\"center\">Beton/Tidak</th>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th valign=\"midle\" align=\"center\">1</th>
						<th valign=\"midle\" align=\"center\">2</th>
						<th valign=\"midle\" align=\"center\">3</th>
						<th valign=\"midle\" align=\"center\">4</th>
						<th valign=\"midle\" align=\"center\">5</th>
						<th valign=\"midle\" align=\"center\">6</th>
						<th valign=\"midle\" align=\"center\">7</th>
						<th valign=\"midle\" align=\"center\">8</th>
						<th valign=\"midle\" align=\"center\">9</th>
						<th valign=\"midle\" align=\"center\">10</th>
						<th valign=\"midle\" align=\"center\">11</th>
						<th valign=\"midle\" align=\"center\">12</th>
						<th valign=\"midle\" align=\"center\">13</th>
						<th valign=\"midle\" align=\"center\">14</th>
						<th valign=\"midle\" align=\"center\">15</th>
						<th valign=\"midle\" align=\"center\">16</th>
						<th valign=\"midle\" align=\"center\">17</th>
						<th valign=\"midle\" align=\"center\">18</th>
						<th valign=\"midle\" align=\"center\">19</th>
						<th valign=\"midle\" align=\"center\">20</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"center\">".$row->kondisi."</td>
						<td  valign=\"top\" align=\"center\">".$row->konstruksi."</td>
						<td  valign=\"top\" align=\"center\">".$row->jenis_gedung."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas_lantai."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"left\">".$row->tgl_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>
						<td  valign=\"top\" align=\"left\">".$row->review."</td>
						<td  valign=\"top\" align=\"left\">".$row->catatan."</td>
						";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"16\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td><td></td><td></td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"18\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\" width=\"50%\"></td>
					<td></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">Mengetahui,</td>
					<td></td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
					<td></td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"18\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
					<td></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
					<td></td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==6) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_d('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 10;
				$col_hr		= 20;
				$col_sub    = 18;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">20</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 9;
				$col_hr		= 19;
				$col_sub    = 17;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_d</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Jenis Barang / Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Konstruksi</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Panjang (Km)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Lebar (M)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas (m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Letak/Lokasi</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Dokumen</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nomor Kode Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Review</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Catatan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\">Register</th>
						<th valign=\"midle\" align=\"center\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th valign=\"midle\" align=\"center\">1</th>
						<th valign=\"midle\" align=\"center\">2</th>
						<th valign=\"midle\" align=\"center\">3</th>
						<th valign=\"midle\" align=\"center\">4</th>
						<th valign=\"midle\" align=\"center\">5</th>
						<th valign=\"midle\" align=\"center\">6</th>
						<th valign=\"midle\" align=\"center\">7</th>
						<th valign=\"midle\" align=\"center\">8</th>
						<th valign=\"midle\" align=\"center\">9</th>
						<th valign=\"midle\" align=\"center\">10</th>
						<th valign=\"midle\" align=\"center\">11</th>
						<th valign=\"midle\" align=\"center\">12</th>
						<th valign=\"midle\" align=\"center\">13</th>
						<th valign=\"midle\" align=\"center\">14</th>
						<th valign=\"midle\" align=\"center\">15</th>
						<th valign=\"midle\" align=\"center\">16</th>
						<th valign=\"midle\" align=\"center\">17</th>
						<th valign=\"midle\" align=\"center\">18</th>
						<th valign=\"midle\" align=\"center\">19</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->konstruksi."</td>
						<td  valign=\"top\" align=\"left\">".$row->panjang."</td>
						<td  valign=\"top\" align=\"left\">".$row->lebar."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"left\">".$row->tgl_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_dok."</td>
						<td  valign=\"top\" align=\"left\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>
						<td  valign=\"top\" align=\"left\">".$row->review."</td>
						<td  valign=\"top\" align=\"left\">".$row->catatan."</td>
						";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"15\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td><td></td><td></td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"17\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">Mengetahui,</td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"17\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==7) {
			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_e('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 10;
				$col_hr		= 20;
				$col_sub    = 18;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">20</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 9;
				$col_hr		= 19;
				$col_sub    = 17;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_e</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Nomor</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Buku Perpustakaan</th>
						<th valign=\"midle\" align=\"center\" colspan=\"3\">Barang Bercora Kesenian/Kebudayaan</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Hewan/Ternak dan Tumbuhan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">JUmlah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Tahun Pembelian</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul Perolehan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Harga</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Review</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Catatan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Kode Barang</th>
						<th valign=\"midle\" align=\"center\">Register</th>
						<th valign=\"midle\" align=\"center\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\">Judul/Pencipta</th>
						<th valign=\"midle\" align=\"center\">Spesifikasi</th>
						<th valign=\"midle\" align=\"center\">Asal Daerah</th>
						<th valign=\"midle\" align=\"center\">Pencipta</th>
						<th valign=\"midle\" align=\"center\">Bahan</th>
						<th valign=\"midle\" align=\"center\">Jenis</th>
						<th valign=\"midle\" align=\"center\">Ukuran</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th valign=\"midle\" align=\"center\">1</th>
						<th valign=\"midle\" align=\"center\">2</th>
						<th valign=\"midle\" align=\"center\">3</th>
						<th valign=\"midle\" align=\"center\">4</th>
						<th valign=\"midle\" align=\"center\">5</th>
						<th valign=\"midle\" align=\"center\">6</th>
						<th valign=\"midle\" align=\"center\">7</th>
						<th valign=\"midle\" align=\"center\">8</th>
						<th valign=\"midle\" align=\"center\">9</th>
						<th valign=\"midle\" align=\"center\">10</th>
						<th valign=\"midle\" align=\"center\">11</th>
						<th valign=\"midle\" align=\"center\">12</th>
						<th valign=\"midle\" align=\"center\">13</th>
						<th valign=\"midle\" align=\"center\">14</th>
						<th valign=\"midle\" align=\"center\">15</th>
						<th valign=\"midle\" align=\"center\">16</th>
						<th valign=\"midle\" align=\"center\">17</th>
						<th valign=\"midle\" align=\"center\">18</th>
						<th valign=\"midle\" align=\"center\">19</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->kd_brg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->judul."</td>
						<td  valign=\"top\" align=\"left\">".$row->spesifikasi."</td>
						<td  valign=\"top\" align=\"left\">".$row->asal."</td>
						<td  valign=\"top\" align=\"left\">".$row->cipta."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_bahan."</td>
						<td  valign=\"top\" align=\"left\">".$row->jenis."</td>
						<td  valign=\"top\" align=\"left\">".$row->tipe."</td>
						<td  valign=\"top\" align=\"left\">".$row->jumlah."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"center\">".$row->peroleh."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>
						<td  valign=\"top\" align=\"left\">".$row->review."</td>
						<td  valign=\"top\" align=\"left\">".$row->catatan."</td>
						";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"15\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td><td></td><td></td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"17\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">Mengetahui,</td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"16\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==8) {

			
			$query		= $this->db->query("CALL sp_lap_sensus_kib_f('$kd_skpd','$kd_unit','$jns_cetak','$fisik_brg','$kriteria')")->result();
			$no 		= 1;
			$jum_tot	= 0;
			if ($jns_cetak==0) {
				$col_kop    = 9;
				$col_hr		= 19;
				$col_sub    = 17;
				$plus_col   = "<th width=\"18%\" valign=\"midle\" align=\"center\">19</th>";
				$plus_col_h = "<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan Sensus</th>";
			}else{
				$col_kop    = 8;
				$col_hr		= 18;
				$col_sub    = 16;
				$plus_col   = "";
				$plus_col_h = "";
			}
			$cRet ="
			<table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
					<td width=\"40%\" colspan=\"$col_kop\" align=\"center\"><b>$kop_f</b></td>
					<td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
				</tr>
				<tr>
					<td colspan=\"$col_hr\" align=\"center\" style=\"font-size:16px\"><hr></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"$col_sub\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UNIT</td>
					<td colspan=\"$col_sub\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				<tr>
					<td></td>
					<td>KOTA</td>
					<td colspan=\"$col_sub\">: MAKASSAR</td>
				</tr>
				$ket_stat_fisik
			</table>
			";
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Barang</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">No. Sensus</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Bangunan (P.SP.D)</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Konstruksi</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Luas (m2)</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Letak/Lokasi</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">Dokumen</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Tgl,Bln,Thn,Mulai</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Status Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nomor Kode Tanah</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Asal Usul</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nilai Kontrak</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Keterangan</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Review</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">Catatan</th>
						$plus_col_h
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">Bertingkat/Tidak</th>
						<th valign=\"midle\" align=\"center\">Beton/Tidak</th>
						<th valign=\"midle\" align=\"center\">Tanggal</th>
						<th valign=\"midle\" align=\"center\">Nomor</th>
					</tr>
					<tr style=\"background-color:#a2c8fb;\">
						<th width =\"2%\"  valign=\"midle\" align=\"center\">1</th>
						<th width =\"15%\" valign=\"midle\" align=\"center\">2</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">3</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">4</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">5</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">6</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">7</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">8</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">9</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">10</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">11</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">12</th>
						<th width =\"5%\"  valign=\"midle\" align=\"center\">13</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">14</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">15</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">16</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">17</th>
						<th width =\"17\"  valign=\"midle\" align=\"center\">18</th>
						$plus_col
					</tr>
				</thead>
				<tbody>";
				foreach ($query as $row) {
				$jum_tot = $jum_tot + $row->nilai;
				$cRet .="
					<tr>
						<td  valign=\"top\" align=\"center\" height=\"".$t_baris."px\">$no</td>
						<td  valign=\"top\" align=\"left\">".$row->nm_brg."</td>
						<td  valign=\"top\" align=\"left\">".$row->no_sensus."</td>
						<td  valign=\"top\" align=\"left\">".$row->bangunan."</td>
						<td  valign=\"top\" align=\"left\">".$row->konstruksi."</td>
						<td  valign=\"top\" align=\"left\">".$row->jenis."</td>
						<td  valign=\"top\" align=\"left\">".$row->luas."</td>
						<td  valign=\"top\" align=\"left\">".$row->alamat1."</td>
						<td  valign=\"top\" align=\"center\">".$row->tahun."</td>
						<td  valign=\"top\" align=\"center\">".$row->no_reg."</td>
						<td  valign=\"top\" align=\"left\">".$row->tgl_awal_kerja."</td>
						<td  valign=\"top\" align=\"left\">".$row->status_tanah."</td>
						<td  valign=\"top\" align=\"left\">".$row->kd_tanah."</td>
						<td  valign=\"top\" align=\"center\">".$row->asal."</td>
						<td  valign=\"top\" align=\"right\">".number_format($row->nilai,2,",",".")."</td>
						<td  valign=\"top\" align=\"left\">".$row->keterangan."</td>
						<td  valign=\"top\" align=\"left\">".$row->review."</td>
						<td  valign=\"top\" align=\"left\">".$row->catatan."</td>
						";
				if ($jns_cetak==0) {
				$cRet .="
						<td valign=\"top\" align=\"left\">".$row->ket_sensus."</td>
						";
				}
				$cRet .="
					</tr>
				";
				$no++;
				}
				$cRet .="
					<tr style=\"background-color:#fce5e7;\">
						<td colspan=\"14\"></td>
						<td align=\"right\">".number_format($jum_tot,2,",",".")."</td><td></td><td></td>";
				if ($jns_cetak==0) {
				$cRet .="<td></td><td></td>";
				}
				$cRet .="
					</tr>
				";

			$cRet .="
				</tbody>
				<tfoot>
				</tfoot>
			</table>";
			if ($mengetahui<>'' && $pengurus<>'') {
			$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td colspan=\"16\" height=\"20px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\" width=\"50%\"></td>
					<td align=\"center\" colspan=\"8\" width=\"50%\">Makassar, $tgl</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">Mengetahui,</td>
					<td align=\"center\" colspan=\"8\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
					<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"16\" height=\"70px\"></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
					<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
				</tr>
				<tr>
					<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
					<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
				</tr>
			</table>
			";
			}
		}
		if ($jns_kib==''){
			$kon        = "";
			$skpdorunit = "";
			$krit       = "";

		if ($kriteria == 1) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: SKPD</td>
								</tr>";
		}else if ($kriteria == 2) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: DIKERJASAMAKAN DENGAN PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 3) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KEBERADAAN BARANG</td>
									<td colspan=\"14\">: DIKUASAI SECARA TIDAK SAH PIHAK LAIN</td>
								</tr>";
		}else if ($kriteria == 4) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: BAIK</td>
								</tr>";
		}else if ($kriteria == 5) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: KURANG BAIK</td>
								</tr>";
		}else if ($kriteria == 6) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KONDISI BARANG</td>
									<td colspan=\"14\">: RUSAK BERAT</td>
								</tr>";
		}else if ($kriteria == 7) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"14\">: TIDAK DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 8) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>PERMASALAHAN HUKUM</td>
									<td colspan=\"14\">: DALAM GUGATAN HUKUM</td>
								</tr>";
		}else if ($kriteria == 9) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"14\">: ADA</td>
								</tr>";
		}else if ($kriteria == 10) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>BUKTI KEPEMILIKAN</td>
									<td colspan=\"14\">: TIDAK ADA</td>
								</tr>";
		}else if ($kriteria == 11) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: HILANG KARENA KECURIAN</td>
								</tr>";
		}else if ($kriteria == 12) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: TIDAK DIKETAHUI KEBERADAANNYA</td>
								</tr>";
		}else if ($kriteria == 13) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: FISIK HABIS/TIDAK ADA KARENA SEBAB YANG WAJAR</td>
								</tr>";
		}else if ($kriteria == 14) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: SEHARUSNYA TELAH DIHAPUS</td>
								</tr>";
		}else if ($kriteria == 15) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: DOBEL/LEBIH CATAT</td>
								</tr>";
		}else if ($kriteria == 16) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>KETERANGAN</td>
									<td colspan=\"14\">: KOREKSI BARANG HABIS PAKAI</td>
								</tr>";
		}else if ($kriteria == 17) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PEMERINTAH PUSAT (BMN)/PEMDA LAIN</td>
								</tr>";
		}else if ($kriteria == 18) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PIHAK LAIN NON PEMERINTAH</td>
								</tr>";
		}else if ($kriteria == 19) {
			$ket_stat_fisik = " <tr>
									<td></td>
									<td>STATUS KEPEMILIKAN</td>
									<td colspan=\"14\">: MILIK PEMERINTAH KOTA MAKASSAR</td>
								</tr>";
		}else {
			$ket_stat_fisik = "";
		}

			if ($kd_skpd<>'') {
				$skpdorunit = " AND a.kd_skpd='$kd_skpd'";
			}elseif($kd_unit<>''){
				$skpdorunit = " AND a.kd_unit='$kd_unit'";
			}elseif($kd_skpd<>'' && $kd_unit<>''){
				$skpdorunit = " AND a.kd_skpd='$kd_skpd' AND a.kd_unit='$kd_unit'";
			}

			$kon = "WHERE 1=1 ";
			if ($kriteria<>'') {
				$krit =" AND (CASE WHEN $fisik_brg='0' THEN a.stat_fisik='0' 
						 WHEN $fisik_brg='1' THEN a.stat_fisik='1'
						 ELSE a.stat_fisik IS NULL OR a.stat_fisik='' OR a.stat_fisik IN ('0','1') END)
						 AND (CASE WHEN $kriteria='1' THEN a.keberadaan_brg='SKPD' 
						 WHEN $kriteria='2' THEN a.keberadaan_brg='Dikerjasamakan dengan pihak lain'
						 WHEN $kriteria='3' THEN a.keberadaan_brg='Dikuasai secara tidak sah pihak lain'
						 WHEN $kriteria='4' THEN a.kondisi_brg='Baik' 
						 WHEN $kriteria='5' THEN a.kondisi_brg='Kurang Baik' 
						 WHEN $kriteria='6' THEN a.kondisi_brg='Rusak Berat' 
						 WHEN $kriteria='7' THEN a.stat_hukum='Tidak Dalam Gugatan Hukum' 
						 WHEN $kriteria='8' THEN a.stat_hukum='Dalam Gugatan Hukum' 
						 WHEN $kriteria='9' THEN a.bukti_milik='Ada' 
						 WHEN $kriteria='10' THEN a.bukti_milik='Tidak Ada'
						 WHEN $kriteria='11' THEN a.ket_brg='Hilang'
						 WHEN $kriteria='12' THEN a.ket_brg='Tidak Diketahui Keberadaannya' 
						 WHEN $kriteria='13' THEN a.ket_brg='Habis Akibat Usia Barang'
						 WHEN $kriteria='14' THEN a.ket_brg='Seharusnya Telah dihapus'
						 WHEN $kriteria='15' THEN a.ket_brg='Double Catat'
						 WHEN $kriteria='16' THEN a.ket_brg='Koreksi BHP'
						 WHEN $kriteria='17' THEN a.status_milik='Milik Pemerintah Pusat'
						 WHEN $kriteria='18' THEN a.status_milik='Milik Pihak Lain Non Pemerintah'
						 WHEN $kriteria='19' THEN a.status_milik='Milik Pemerintah Kota Makassar' 	
						 ELSE a.keberadaan_brg IS NULL OR a.keberadaan_brg=''
						 OR a.keberadaan_brg IN ('SKPD','Dikerjasamakan dengan pihak lain','Dikuasai secara tidak sah pihak lain')
						 OR a.kondisi_brg IS NULL OR a.kondisi_brg=''
						 OR a.kondisi_brg IN ('Baik','Kurang Baik','Rusak Berat')
						 OR a.stat_hukum IS NULL OR a.stat_hukum=''
						 OR a.stat_hukum IN ('Tidak Dalam Gugatan Hukum','Dalam Gugatan Hukum')
						 OR a.bukti_milik IS NULL OR a.bukti_milik=''
						 OR a.bukti_milik IN ('Ada','Tidak Ada')
						 OR a.status_milik IS NULL OR a.status_milik=''
						 OR a.status_milik IN ('Milik Pemerintah Kota Makassar','Milik Pemerintah Pusat','Milik Pihak Lain Non Pemerintah')
						 OR a.ket_brg IS NULL OR a.ket_brg=''
						 OR a.ket_brg IN ('Hilang','Tidak Diketahui Keberadaannya','Habis Akibat Usia Barang','Seharusnya Telah dihapus','Double Catat','Koreksi BHP')
						 END)";
			}
			$where =$kon.$skpdorunit.$krit;
		$cRet  = "";
        $cRet .= "
	        <table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		        <tr>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
			        <td width=\"40%\" colspan=\"6\" align=\"center\"><b>LAPORAN VALIDASI BMD MILIK DAERAH<br>PEMERINTAH KOTA MAKASSAR<br>TAHUN ANGGARAN 2019</b></td>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
		        </tr>
		        <tr>
		        	<td colspan=\"16\" align=\"center\" style=\"font-size:16px\"><hr></td>
		        </tr>
	        </table>
	        <table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
	        	<tr>
					<td width=\"2%\" ></td>
					<td width=\"13%\"></td>
					<td width=\"85%\" colspan=\"14\"></td>
				</tr>
	        ";
	        if ($kd_skpd<>'') {
			$cRet .="
				<tr>
					<td width=\"2%\" ></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"14\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			}

			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UPB</td>
					<td colspan=\"14\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
				$ket_stat_fisik
			</table>
           <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NOMOR</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE BARANG</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>REGISTER</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE SENSUS</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NAMA/JENIS BARANG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>MEREK/TIPE</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NO SERTIFIKAT/PABRIK/RANGKA/MESIN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>BAHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>ASAL/CARA PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>TAHUN PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>UKURAN BARANG/KONSTRUKSI PSD</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>SATUAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KONDISI</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>JML BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>HARGA BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KETERANGAN</b></td>
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px\">1</td>
                <td align=\"center\" style=\"font-size:10px\">2</td>
                <td align=\"center\" style=\"font-size:10px\">3</td>
                <td align=\"center\" style=\"font-size:10px\">4</td>
			    <td align=\"center\" style=\"font-size:10px\">5</td>
                <td align=\"center\" style=\"font-size:10px\">6</td>
                <td align=\"center\" style=\"font-size:10px\">7</td>
				<td align=\"center\" style=\"font-size:10px\">8</td>
				<td align=\"center\" style=\"font-size:10px\">9</td>
				<td align=\"center\" style=\"font-size:10px\">10</td>
				<td align=\"center\" style=\"font-size:10px\">11</td>
				<td align=\"center\" style=\"font-size:10px\">12</td>
				<td align=\"center\" style=\"font-size:10px\">13</td>
				<td align=\"center\" style=\"font-size:10px\">14</td>
				<td align=\"center\" style=\"font-size:10px\">15</td>
				<td align=\"center\" style=\"font-size:10px\">16</td>
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
            </tr>
			</thead>";
			$csql = "SELECT * FROM (

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,
			(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_a_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus
			FROM trkib_a a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin) AS gabung,a.kd_bahan,a.no_urut,
			a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_b_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_b a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_c_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_c a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			
			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_d_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_d a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
			a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus
			FROM trkib_e a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where  
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    a.nm_brg,a.detail_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    '' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus 
			FROM trkib_f a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$where 
			
			) faiz  ORDER BY kd_brg,no_reg,tahun";
                        
             $ket_sensus='';
             $jml_brgx ='';
			 $nilaix   ='';
			 $nama_barang = '';
			 $i = 1;
             $hasil=$this->db->query($csql);
             foreach ($hasil->result() as $row)
             {  
				$jml_brgx = $jml_brgx + $row->jumlah;
				$nilaix   = $nilaix+($row->nilai+$row->nil_kap);
				if ($row->status!=1) {
					$ket_sensus='Belum Sensus';
				}else{
					$ket_sensus= $row->hsl;
				}
				if ($row->nm_brg<>'' && $row->detail_brg<>'') {
					$nama_barang = $row->nm_brg." / ".$row->detail_brg;
				}elseif ($row->nm_brg<>'' && ($row->detail_brg=='' OR $row->detail_brg==null)) {
					$nama_barang = $row->nm_brg;
				}else{
					$nama_barang = $row->detail_brg;
				}
                $cRet .="
                 <tr>
                    <td valign=\"top\" align=\"center\" >$i</td>
                    <td valign=\"top\" align=\"center\" >$row->kd_brg</td>
                    <td valign=\"top\" align=\"center\" >$row->no_reg</td>
                    <td valign=\"top\" align=\"center\" >$row->no_sensus</td>
                    <td valign=\"top\" align=\"left\"   >$nama_barang</td>
                    <td valign=\"top\" align=\"left\"   >$row->merek</td>
                    <td valign=\"top\" align=\"left\"   >$row->gabung</td>
                    <td valign=\"top\" align=\"left\"   >$row->kd_bahan</td>
                    <td valign=\"top\" align=\"left\"   >$row->asal</td>
                    <td valign=\"top\" align=\"center\" >$row->tahun</td>
                    <td valign=\"top\" align=\"left\"   >$row->silinder</td>
                    <td valign=\"top\" align=\"left\"   >$row->kd_satuan</td>
                    <td valign=\"top\" align=\"center\" >$row->kondisi</td>
                    <td valign=\"top\" align=\"center\" >$row->jumlah</td>
                    <td valign=\"top\" align=\"right\"  >".number_format($row->nilai+$row->nil_kap,2)."</td>
                    <td valign=\"top\" align=\"left\"   >$row->keterangan</td>
                </tr>"; 
                $i++;
             }
             $cRet .="
                <tr>
					<td bgcolor=\"#80FE80\" colspan=\"13\" align=\"center\" style=\" border-bottom:solid 1px black;\"><b>Jumlah</b></td>
                    <td bgcolor=\"#80FE80\" align=\"center\" style=\"border-bottom:solid 1px black;\"><b>$jml_brgx</b></td>
                    <td bgcolor=\"#80FE80\" align=\"right\"  style=\"border-bottom:solid 1px black;\"><b>".number_format($nilaix,2)."</b></td>
                    <td bgcolor=\"#80FE80\" align=\"LEFT\"   style=\"border-bottom:solid 1px black;\"></td>
                </tr>
            </table>";
		}/*END IF*/

		$data['excel'] = $cRet;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf($orien,$lmrg,$rmrg,$tmrg,$bmrg,$hmrg,$fmrg,'',$cRet);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
			break;
			case 3:
			$namafile	= str_replace(' ','_',$judul);
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename= $namafile.xls");
			$this->load->view('doc', $data);
			break;
		}
	}/*cetak_laporan_review*/

	function inventaris_upb(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
        ini_set("memory_limit","-1");
		ini_set("max_execution_time","-1");
		$cetak 	= $_REQUEST['cetak'];
        $kd_skpd 	= $_REQUEST['kd_skpd'];
        $kd_unit 	= $_REQUEST['unit_skpd'];
        $tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
        $thn 		= $_REQUEST['thn'];
        $sampai_tgl = date('Y-m-d',strtotime($_REQUEST['s_tgl']));
        $mengetahui = ($_REQUEST['mengetahui']=='-PILIH-') ? '':$_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = ($_REQUEST['pengurus']=='-PILIH-') ? '':$_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$tmrg       = $_REQUEST['tmrg'];
		$bmrg       = $_REQUEST['bmrg'];
		$lmrg       = $_REQUEST['lmrg'];
		$rmrg       = $_REQUEST['rmrg'];
		$hmrg       = $_REQUEST['hmrg'];
		$fmrg       = $_REQUEST['fmrg'];
		$t_baris    = $_REQUEST['t_baris'];
		$orien      = $_REQUEST['orien'];
        $fthn		= '';
        $skpd 		= '';
        $unit 		= '';
        if($thn<>''){
            $fthn ="and year(a.tgl_reg)='$thn'";
        }
		if($kd_unit<>''){
			$unit="Where a.kd_unit='$kd_unit'";
		}else{
			$skpd="Where a.kd_skpd='$kd_skpd'";
        }
        if ($mengetahui!=='') {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(b.nm_lokasi)) as jabatan_m FROM ttd a INNER JOIN mlokasi b on a.unit=b.kd_lokasi where a.nip = '$nip_m' AND b.kd_lokasi='$kd_unit'")->row_array();
		}else {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(nm_lokasi)) as jabatan_m FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		}
		$nm_skpd    = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit    = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
        $iz = 1;
		$cRet  = "";
        $cRet .= "
	        <table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		        <tr>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
			        <td width=\"40%\" colspan=\"7\" align=\"center\"><b>LAPORAN VALIDASI BMD MILIK DAERAH<br>PEMERINTAH KOTA MAKASSAR<br>TAHUN ANGGARAN 2019</b></td>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
		        </tr>
		        <tr>
		        	<td colspan=\"17\" align=\"center\" style=\"font-size:16px\"><hr></td>
		        </tr>
	        </table>
	        <table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"15\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UPB</td>
					<td colspan=\"15\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
			</table>
           <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NOMOR</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE BARANG</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>REGISTER</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE SENSUS</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NAMA/JENIS BARANG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>MEREK/TIPE</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NO SERTIFIKAT/PABRIK/RANGKA/MESIN/NO.POLISI</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>BAHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>ASAL/CARA PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>TAHUN PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>UKURAN BARANG/KONSTRUKSI PSD</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>SATUAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KONDISI</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>JML BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>HARGA BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KETERANGAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>HASIL SENSUS</b></td>";
            if ($kd_unit=='') {
            $cRet .=" 
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>UPB</b></td>";
            }
            $cRet .="
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px\">1</td>
                <td align=\"center\" style=\"font-size:10px\">2</td>
                <td align=\"center\" style=\"font-size:10px\">3</td>
                <td align=\"center\" style=\"font-size:10px\">4</td>
			    <td align=\"center\" style=\"font-size:10px\">5</td>
                <td align=\"center\" style=\"font-size:10px\">6</td>
                <td align=\"center\" style=\"font-size:10px\">7</td>
				<td align=\"center\" style=\"font-size:10px\">8</td>
				<td align=\"center\" style=\"font-size:10px\">9</td>
				<td align=\"center\" style=\"font-size:10px\">10</td>
				<td align=\"center\" style=\"font-size:10px\">11</td>
				<td align=\"center\" style=\"font-size:10px\">12</td>
				<td align=\"center\" style=\"font-size:10px\">13</td>
				<td align=\"center\" style=\"font-size:10px\">14</td>
				<td align=\"center\" style=\"font-size:10px\">15</td>
				<td align=\"center\" style=\"font-size:10px\">16</td>
				<td align=\"center\" style=\"font-size:10px\">17</td>";
            if ($kd_unit=='') {
            $cRet .=" 
                <td align=\"center\" style=\"font-size:10px\">18</td>";
            }
            $cRet .="
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				";
            if ($kd_unit=='') {
            $cRet .=" 
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>";
            }
            $cRet .="
            </tr>
			</thead>";
			if($iz=='1' || $iz=='3' || $iz=='2'){ 
			/*Aset Tetap-----------------------------------------------------------------------------------------------------*/
			$csql_ttp = "SELECT * FROM 
			(

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,
			(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_a_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
			FROM trkib_a a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND a.tgl_reg<='$sampai_tgl'  
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin,'/',IFNULL(a.no_polisi2,a.no_polisi)) AS gabung,a.kd_bahan,a.no_urut,
			a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_b_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit
			FROM trkib_b a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'  
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR (a.kd_eca='9' and a.kd_riwayat IS NULL))
			AND (a.nilai >=300000 OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_c_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit
			FROM trkib_c a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			and (a.nilai>=20000000 OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg,
			    a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_d_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit
			FROM trkib_d a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
			a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
			FROM trkib_e a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			and (a.nilai>=100000 OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    '' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit
			FROM trkib_f a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			

			) faiz  ORDER BY kd_brg,no_reg,tahun";
                        
             $hasil_ttp = $this->db->query($csql_ttp);
             $i_ttp = 1;
			 $nilaix_ttp=0;
			 $jml_brgx_ttp=0;
             $subtot_ttp = '0';
             $jumtot_ttp = '0';
             $bc = 'background-color: #dfdfdf; font-weight: bold;';
             foreach ($hasil_ttp->result() as $row_sum) {
                 $subtot_ttp = $subtot_ttp + ($row_sum->nilai+$row_sum->nil_kap);
                 $jumtot_ttp = $jumtot_ttp + $row_sum->jumlah;
             }
             $cRet.="
             <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">ASET TETAP</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">$jumtot_ttp</td>
                    <td valign=\"top\"  align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">".number_format($subtot_ttp,2)."</td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">SUBTOTAL</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    ";
            if ($kd_unit=='') {
            $cRet .="<td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            }
            $cRet .="
                </tr>
             ";
             $ket_sensus='';
             foreach ($hasil_ttp->result() as $row_ttp)
             {  
				$jml_brgx_ttp = $jml_brgx_ttp+$row_ttp->jumlah;
				$nilaix_ttp = $nilaix_ttp+($row_ttp->nilai+$row_ttp->nil_kap);
				if ($row_ttp->status!=1) {
					$ket_sensus='Belum Sensus';
				}else{
					$ket_sensus= $row_ttp->hsl;
				}
                $cRet .="
                 <tr>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i_ttp</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kd_brg</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->no_reg</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->no_sensus</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->nm_brg</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->merek</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->gabung</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kd_bahan</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->asal</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->tahun</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->silinder</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kd_satuan</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kondisi</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->jumlah</td>
                    <td valign=\"top\" align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row_ttp->nilai+$row_ttp->nil_kap,2)."</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->keterangan</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$ket_sensus</td>";
            if ($kd_unit=='') {
            $cRet .="<td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">".$this->nm_unit($row_ttp->kd_unit)."</td>";
            }
            $cRet .="
                </tr>
             ";
                $i_ttp++;    
              
             }
/*--------------------------------------------------------------------------------------------------------------*/
/*Aset Lainnya-----------------------------------------------------------------------------------------------------*/
$csql_lain = "SELECT * FROM ( 
    
            SELECT a.status,a.kd_brg,a.no_reg, b.nm_brg,'' AS merek,'' AS gabung,'' AS kd_bahan,a.no_urut, a.asal,a.tahun, '' AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
            FROM trkib_a a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
            
            
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin,'/',IFNULL(a.no_polisi2,a.no_polisi)) AS gabung,a.kd_bahan,a.no_urut, a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
            FROM trkib_b a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
                AND (a.nilai >= 300000 OR a.kd_eca='9')
            
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut, a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
            FROM trkib_c a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
                AND (a.nilai >= 20000000 OR a.kd_eca='9')
           
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg, b.nm_brg,'' AS merek,a.no_dok AS gabung,a.konstruksi AS kd_bahan,a.no_urut, a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
            FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
            
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut, a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
            FROM trkib_e a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
                AND (a.nilai >= 100000 OR a.kd_eca='9')
            
            )faiz ORDER BY kd_brg,tahun,no_reg";
                        
             $hasil_lain = $this->db->query($csql_lain);
             $i_lain = 1;
             $nilaix_lain=0;
             $jml_brgx_lain=0;
             $subtot_lain = '0';
             $jumtot_lain = '0';
             $bc = 'background-color: #dfdfdf; font-weight: bold;';
             foreach ($hasil_lain->result() as $row_sum) {
                 $subtot_lain = $subtot_lain + $row_sum->nilai;
                 $jumtot_lain = $jumtot_lain + $row_sum->jumlah;
             }
             $cRet.="
             <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">ASET LAINNYA</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">$jumtot_lain</td>
                    <td valign=\"top\"  align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">".number_format($subtot_lain,2)."</td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">SUBTOTAL</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            if ($kd_unit=='') {
            $cRet .="<td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            }
            $cRet .="
                    
                </tr>
             ";
             $ket_sensus='';
             foreach ($hasil_lain->result() as $row_lain){  
                $jml_brgx_lain = $row_lain->jumlah+$jml_brgx_lain;
                $nilaix_lain = $row_lain->nilai+$nilaix_lain;
                if ($row_lain->status!=1) {
                	$ket_sensus='Belum Sensus';
                }else{
                	$ket_sensus= $row_lain->hsl;
                }
                $cRet .="
                
                 <tr>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i_lain</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kd_brg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->no_reg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->no_sensus</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->nm_brg</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->merek</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->gabung</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kd_bahan</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->asal</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->tahun</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->silinder</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kd_satuan</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kondisi</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->jumlah</td>
                     <td valign=\"top\" align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row_lain->nilai,2)."</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->keterangan</td>
                    <td valign=\"top\" align=\"left\" style=\"fo
                    nt-size:11px; border-bottom:solid 1px black;\">$ket_sensus</td>";
            if ($kd_unit=='') {
            $cRet .="
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">".$this->nm_unit($row_lain->kd_unit)."</td>";
            }
            $cRet .="
                </tr>
             ";
                $i_lain++;
              
             }
			/*--------------------------------------------------------------------------------------------------------------*/
			/*Aset Eca-----------------------------------------------------------------------------------------------------*/
			$csql_eca = "SELECT * FROM 
			(SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin,'/',IFNULL(a.no_polisi2,a.no_polisi)) AS gabung,a.kd_bahan,a.no_urut,
			a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
			FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg  $skpd $unit $fthn AND a.nilai<'300000' and a.kd_riwayat<>'9' 

			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl') and a.tgl_reg<='$sampai_tgl'
			
			UNION ALL
			SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
			FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg $skpd $unit $fthn AND a.nilai<'20000000' and a.kd_riwayat<>'9' 

			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl') and a.tgl_reg<='$sampai_tgl' 
			
			UNION ALL
			SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
			a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit
			FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg  $skpd $unit $fthn AND a.nilai<'100000' and a.kd_riwayat<>'9' 

			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl') and a.tgl_reg<='$sampai_tgl'
			
			) faiz  ORDER BY kd_brg,no_reg";
                        
             $hasil_eca = $this->db->query($csql_eca);
             $i_eca = 1;
             $nilaix_eca=0;
             $jml_brgx_eca=0;
             $subtot_eca = '0';
             $jumtot_eca = '0';
             $bc = 'background-color: #dfdfdf; font-weight: bold;';
             foreach ($hasil_eca->result() as $row_sum) {
                 $subtot_eca = $subtot_eca + $row_sum->nilai;
                 $jumtot_eca = $jumtot_eca + $row_sum->jumlah;
             }
             $cRet.="
             <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">EXTRA COUNTING ASSET (ECA)</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">$jumtot_eca</td>
                    <td valign=\"top\"  align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">".number_format($subtot_eca,2)."</td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">SUBTOTAL</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            if ($kd_unit=='') {
            $cRet .="
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            }
            $cRet .="
                    
                </tr>
             ";
             $ket_sensus='';
             foreach ($hasil_eca->result() as $row_eca)
             {  
                $jml_brgx_eca = $row_eca->jumlah+$jml_brgx_eca;
                $nilaix_eca = $row_eca->nilai+$nilaix_eca;
                if ($row_eca->status!=1) {
                	$ket_sensus='Belum Sensus';
                }else{
                	$ket_sensus= $row_eca->hsl;
                }
                $cRet .="
                
                 <tr>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i_eca</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kd_brg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->no_reg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->no_sensus</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->nm_brg</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->merek</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->gabung</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kd_bahan</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->asal</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->tahun</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->silinder</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kd_satuan</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kondisi</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->jumlah</td>
                     <td valign=\"top\" align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row_eca->nilai,2)."</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->keterangan</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$ket_sensus</td>
                     ";
            if ($kd_unit=='') {
            $cRet .="
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">".$this->nm_unit($row_eca->kd_unit)."</td>";
            }
            $cRet .="
                    
                </tr>
             ";
                $i_eca++;    
              
             }
/*--------------------------------------------------------------------------------------------------------------*/
                $jum_tot ='';
                $jum_tot =$jml_brgx_ttp + $jml_brgx_lain + $jml_brgx_eca;
                $cRet .="
                 <tr>
					<td bgcolor=\"#80FE80\" colspan=\"13\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jum_tot</b></td>
                    <td bgcolor=\"#80FE80\" colspan=\"3\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>".number_format($nilaix_ttp+$nilaix_lain+$nilaix_eca,2)."</b></td>
                </tr>";
                if ($mengetahui<>'' && $pengurus<>'') {
                $cRet .="
                <tr>
                	<td colspan=\"17\" style=\"border-right:hidden;border-left:hidden;border-bottom:hidden;\" width=\"100%\">
                		<br/><br/>
						<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
							<tr>
								<td colspan=\"17\" height=\"20px\"></td>
							</tr>
							<tr>
								<td align=\"right\" colspan=\"17\" width=\"100%\">Makassar, $tgl</td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"8\">Mengetahui,</td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"8\"></td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"8\">".$query_ttd['jabatan_m']."</td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"8\">PENGURUS BARANG</td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"17\" height=\"70px\"></td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"8\"><u><b>$mengetahui</u></td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"8\"><u><b>$pengurus</u></td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"8\">NIP $nip_m</td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"8\">NIP $nip_p</td>
							</tr>
						</table>
                	</td>
                </tr>";
                }
                $cRet .="
                </table>";
				}
				$cRet .="
		
			";
			

		$data['excel'] = $cRet;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf($orien,$lmrg,$rmrg,$tmrg,$bmrg,$hmrg,$fmrg,'',$cRet);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
			break;
			case 3:
			$namafile	= str_replace(' ','_',$judul);
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename= $namafile.xls");
			$this->load->view('doc', $data);
			break;
		}
       } 
	}	



	function inventaris_review(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
        ini_set("memory_limit","-1");
		ini_set("max_execution_time","-1");
		$cetak 	= $_REQUEST['cetak'];
        $kd_skpd 	= $_REQUEST['kd_skpd'];
        $kd_unit 	= $_REQUEST['unit_skpd'];
        $tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
        $thn 		= $_REQUEST['thn'];
        $sampai_tgl = date('Y-m-d',strtotime($_REQUEST['s_tgl']));
        $mengetahui = ($_REQUEST['mengetahui']=='-PILIH-') ? '':$_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = ($_REQUEST['pengurus']=='-PILIH-') ? '':$_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$tmrg       = $_REQUEST['tmrg'];
		$bmrg       = $_REQUEST['bmrg'];
		$lmrg       = $_REQUEST['lmrg'];
		$rmrg       = $_REQUEST['rmrg'];
		$hmrg       = $_REQUEST['hmrg'];
		$fmrg       = $_REQUEST['fmrg'];
		$t_baris    = $_REQUEST['t_baris'];
		$orien      = $_REQUEST['orien'];
        $fthn		= '';
        $skpd 		= '';
        $unit 		= '';
        if($thn<>''){
            $fthn ="and year(a.tgl_reg)='$thn'";
        }
		if($kd_unit<>''){
			$unit="Where a.kd_unit='$kd_unit'";
		}else{
			$skpd="Where a.kd_skpd='$kd_skpd'";
        }
        if ($mengetahui!=='') {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(b.nm_lokasi)) as jabatan_m FROM ttd a INNER JOIN mlokasi b on a.unit=b.kd_lokasi where a.nip = '$nip_m' AND b.kd_lokasi='$kd_unit'")->row_array();
		}else {
			$query_ttd  = $this->db->query("SELECT CONCAT('KEPALA ',UPPER(nm_lokasi)) as jabatan_m FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		}
		$nm_skpd    = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit    = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
        $iz = 1;
		$cRet  = "";
        $cRet .= "
	        <table style=\"border-collapse:collapse; font-size:16px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		        <tr>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
			        <td width=\"40%\" colspan=\"7\" align=\"center\"><b>LAPORAN VALIDASI BMD MILIK DAERAH<br>PEMERINTAH KOTA MAKASSAR<br>TAHUN ANGGARAN 2019</b></td>
			        <td width=\"30%\" colspan=\"5\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
		        </tr>
		        <tr>
		        	<td colspan=\"17\" align=\"center\" style=\"font-size:16px\"><hr></td>
		        </tr>
	        </table>
	        <table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
				<tr>
					<td width=\"2%\"></td>
					<td width=\"13%\">SKPD</td>
					<td width=\"85%\" colspan=\"15\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
				</tr>";
			if ($kd_unit<>'') {
			$cRet .="
				<tr>
					<td></td>
					<td>UPB</td>
					<td colspan=\"15\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
				</tr>";
			}
			$cRet .="
			</table>
           <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
            <tr>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NOMOR</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE BARANG</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>REGISTER</b></td>
            	<td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KODE SENSUS</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NAMA/JENIS BARANG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>MEREK/TIPE</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>NO SERTIFIKAT/PABRIK/RANGKA/MESIN/NO.POLISI</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>BAHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>ASAL/CARA PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>TAHUN PEROLEHAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>UKURAN BARANG/KONSTRUKSI PSD</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>SATUAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KONDISI</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>JML BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>HARGA BRG</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>KETERANGAN</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>HASIL SENSUS</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>REVIEW</b></td>
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>CATATAN</b></td>
                ";
            if ($kd_unit=='') {
            $cRet .=" 
                <td align=\"center\"  bgcolor=\"#80FE80\"  style=\"font-size:12px\"><b>UPB</b></td>";
            }
            $cRet .="
			</tr>
			<tr>
                <td align=\"center\" style=\"font-size:10px\">1</td>
                <td align=\"center\" style=\"font-size:10px\">2</td>
                <td align=\"center\" style=\"font-size:10px\">3</td>
                <td align=\"center\" style=\"font-size:10px\">4</td>
			    <td align=\"center\" style=\"font-size:10px\">5</td>
                <td align=\"center\" style=\"font-size:10px\">6</td>
                <td align=\"center\" style=\"font-size:10px\">7</td>
				<td align=\"center\" style=\"font-size:10px\">8</td>
				<td align=\"center\" style=\"font-size:10px\">9</td>
				<td align=\"center\" style=\"font-size:10px\">10</td>
				<td align=\"center\" style=\"font-size:10px\">11</td>
				<td align=\"center\" style=\"font-size:10px\">12</td>
				<td align=\"center\" style=\"font-size:10px\">13</td>
				<td align=\"center\" style=\"font-size:10px\">14</td>
				<td align=\"center\" style=\"font-size:10px\">15</td>
				<td align=\"center\" style=\"font-size:10px\">16</td>
				<td align=\"center\" style=\"font-size:10px\">17</td>
				<td align=\"center\" style=\"font-size:10px\">18</td>
				<td align=\"center\" style=\"font-size:10px\">19</td>
				";
            if ($kd_unit=='') {
            $cRet .=" 
                <td align=\"center\" style=\"font-size:10px\">20</td>";
            }
            $cRet .="
            </tr>
            <tr>
			    <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"5%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
                <td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"8%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				<td align=\"center\" width =\"10%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>
				";
            if ($kd_unit=='') {
            $cRet .=" 
                <td align=\"center\" width =\"10%\" style=\"font-size:10px; border-bottom:solid 1px black;\"></td>";
            }
            $cRet .="
            </tr>
			</thead>";
			if($iz=='1' || $iz=='3' || $iz=='2'){ 
			/*Aset Tetap-----------------------------------------------------------------------------------------------------*/
			$csql_ttp = "SELECT * FROM 
			(

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			'' AS merek,a.no_sertifikat AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.luas AS silinder,'' kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,
			(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_a_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_a a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND a.tgl_reg<='$sampai_tgl'  
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin,'/',IFNULL(a.no_polisi2,a.no_polisi)) AS gabung,a.kd_bahan,a.no_urut,
			a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_b_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_b a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'  
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR (a.kd_eca='9' and a.kd_riwayat IS NULL))
			AND (a.nilai >=300000 OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_c_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_c a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			and (a.nilai>=20000000 OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg,
			    a.panjang AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.lebar AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan, 
			(select IFNULL(sum(nilai),0) from trkib_d_kap where a.kd_skpd=kd_skpd and a.kd_unit=kd_unit and a.id_barang=id_barang and tmbh_manfaat<>'0') as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_d a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
			a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_e a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			and (a.nilai>=100000 OR a.kd_eca='9')
			

			UNION ALL

			SELECT a.status,a.kd_brg,a.kd_brg_new,a.no_reg,
			    concat(b.nm_brg,'/',a.detail_brg)as nm_brg,concat(c.uraian,'/',a.detail_brg)as nm_brg_new,
			    '' AS merek,a.luas AS gabung,'' AS kd_bahan,a.no_urut,
			a.asal,a.tahun,'' AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,'' as nil_kap,LPAD(a.no_sensus, 6, '0') as no_sensus , a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_f a 
			left join mbarang b on a.kd_brg=b.kd_brg 
			left join mbarang_new_modif c on a.kd_brg_new=c.kd_brg 
			$skpd $unit $fthn
			AND kondisi<>'RB'
			AND a.tgl_reg<='$sampai_tgl' 
			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl')  
			AND (a.tgl_riwayat IS NULL OR a.tgl_riwayat='' OR a.kd_riwayat IS NULL OR a.kd_riwayat='' OR a.kd_eca='9')
			

			) faiz  ORDER BY kd_brg,no_reg,tahun";
                        
             $hasil_ttp = $this->db->query($csql_ttp);
             $i_ttp = 1;
			 $nilaix_ttp=0;
			 $jml_brgx_ttp=0;
             $subtot_ttp = '0';
             $jumtot_ttp = '0';
             $bc = 'background-color: #dfdfdf; font-weight: bold;';
             foreach ($hasil_ttp->result() as $row_sum) {
                 $subtot_ttp = $subtot_ttp + ($row_sum->nilai+$row_sum->nil_kap);
                 $jumtot_ttp = $jumtot_ttp + $row_sum->jumlah;
             }
             $cRet.="
             <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">ASET TETAP</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">$jumtot_ttp</td>
                    <td valign=\"top\"  align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">".number_format($subtot_ttp,2)."</td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">SUBTOTAL</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    ";
            if ($kd_unit=='') {
            $cRet .="<td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            }
            $cRet .="
                </tr>
             ";
             $ket_sensus='';
             foreach ($hasil_ttp->result() as $row_ttp)
             {  
				$jml_brgx_ttp = $jml_brgx_ttp+$row_ttp->jumlah;
				$nilaix_ttp = $nilaix_ttp+($row_ttp->nilai+$row_ttp->nil_kap);
				if ($row_ttp->status!=1) {
					$ket_sensus='Belum Sensus';
				}else{
					$ket_sensus= $row_ttp->hsl;
				}
                $cRet .="
                 <tr>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i_ttp</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kd_brg</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->no_reg</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->no_sensus</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->nm_brg</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->merek</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->gabung</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kd_bahan</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->asal</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->tahun</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->silinder</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kd_satuan</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->kondisi</td>
                    <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->jumlah</td>
                    <td valign=\"top\" align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row_ttp->nilai+$row_ttp->nil_kap,2)."</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->keterangan</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$ket_sensus</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->review</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_ttp->catatan</td>
                    ";
            if ($kd_unit=='') {
            $cRet .="<td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">".$this->nm_unit($row_ttp->kd_unit)."</td>";
            }
            $cRet .="
                </tr>
             ";
                $i_ttp++;    
              
             }
/*--------------------------------------------------------------------------------------------------------------*/
/*Aset Lainnya-----------------------------------------------------------------------------------------------------*/
$csql_lain = "SELECT * FROM ( 
    
            SELECT a.status,a.kd_brg,a.no_reg, b.nm_brg,'' AS merek,'' AS gabung,'' AS kd_bahan,a.no_urut, a.asal,a.tahun, '' AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
            FROM trkib_a a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
            
            
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin,'/',IFNULL(a.no_polisi2,a.no_polisi)) AS gabung,a.kd_bahan,a.no_urut, a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
            FROM trkib_b a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
                AND (a.nilai >= 300000 OR a.kd_eca='9')
            
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut, a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
            FROM trkib_c a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
                AND (a.nilai >= 20000000 OR a.kd_eca='9')
           
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg, b.nm_brg,'' AS merek,a.no_dok AS gabung,a.konstruksi AS kd_bahan,a.no_urut, a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
            FROM trkib_d a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
            
            UNION ALL
            SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut, a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
            FROM trkib_e a LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
            $skpd $unit $fthn AND a.tgl_reg<='$sampai_tgl' 
                AND (CASE WHEN a.kondisi='RB' THEN a.kondisi='RB' 
                     ELSE a.tgl_riwayat<='$sampai_tgl' AND (a.kd_riwayat='8' OR a.kd_riwayat='1' OR a.kd_riwayat='3' OR a.kd_riwayat='4' OR a.kd_riwayat='10' OR a.kd_riwayat='11') 
                     END)
                AND (CASE WHEN a.tgl_hapus<='$sampai_tgl' THEN (a.no_hapus IS NULL OR a.no_hapus='') ELSE (a.no_hapus LIKE '%') END)
                AND (a.nilai >= 100000 OR a.kd_eca='9')
            
            )faiz ORDER BY kd_brg,tahun,no_reg";
                        
             $hasil_lain = $this->db->query($csql_lain);
             $i_lain = 1;
             $nilaix_lain=0;
             $jml_brgx_lain=0;
             $subtot_lain = '0';
             $jumtot_lain = '0';
             $bc = 'background-color: #dfdfdf; font-weight: bold;';
             foreach ($hasil_lain->result() as $row_sum) {
                 $subtot_lain = $subtot_lain + $row_sum->nilai;
                 $jumtot_lain = $jumtot_lain + $row_sum->jumlah;
             }
             $cRet.="
             <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">ASET LAINNYA</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">$jumtot_lain</td>
                    <td valign=\"top\"  align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">".number_format($subtot_lain,2)."</td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">SUBTOTAL</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    ";
            if ($kd_unit=='') {
            $cRet .="<td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            }
            $cRet .="
                    
                </tr>
             ";
             $ket_sensus='';
             foreach ($hasil_lain->result() as $row_lain){  
                $jml_brgx_lain = $row_lain->jumlah+$jml_brgx_lain;
                $nilaix_lain = $row_lain->nilai+$nilaix_lain;
                if ($row_lain->status!=1) {
                	$ket_sensus='Belum Sensus';
                }else{
                	$ket_sensus= $row_lain->hsl;
                }
                $cRet .="
                
                 <tr>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i_lain</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kd_brg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->no_reg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->no_sensus</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->nm_brg</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->merek</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->gabung</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kd_bahan</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->asal</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->tahun</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->silinder</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kd_satuan</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->kondisi</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->jumlah</td>
                     <td valign=\"top\" align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row_lain->nilai,2)."</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->keterangan</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$ket_sensus</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->review</td>
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_lain->catatan</td>
                    ";
            if ($kd_unit=='') {
            $cRet .="
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">".$this->nm_unit($row_lain->kd_unit)."</td>";
            }
            $cRet .="
                    
                </tr>
             ";
                $i_lain++;
              
             }
			/*--------------------------------------------------------------------------------------------------------------*/
			/*Aset Eca-----------------------------------------------------------------------------------------------------*/
			$csql_eca = "SELECT * FROM 
			(SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.merek,CONCAT(a.pabrik,'/',no_rangka,'/',no_mesin,'/',IFNULL(a.no_polisi2,a.no_polisi)) AS gabung,a.kd_bahan,a.no_urut,
			a.asal,a.tahun,a.silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_b a left join mbarang b on a.kd_brg=b.kd_brg  $skpd $unit $fthn AND a.nilai<'300000' and a.kd_riwayat<>'9' 

			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl') and a.tgl_reg<='$sampai_tgl'
			
			UNION ALL
			SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.luas_tanah AS merek,a.no_dok AS gabung,a.jenis_gedung AS kd_bahan,a.no_urut,
			a.asal,a.tahun,a.konstruksi AS silinder,'' AS kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_c a left join mbarang b on a.kd_brg=b.kd_brg $skpd $unit $fthn AND a.nilai<'20000000' and a.kd_riwayat<>'9' 

			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl') and a.tgl_reg<='$sampai_tgl' 
			
			UNION ALL
			SELECT a.status,a.kd_brg,a.no_reg,b.nm_brg,a.judul AS merek,a.spesifikasi AS gabung,a.kd_bahan,a.no_urut,
			a.peroleh AS asal,a.tahun,a.tipe AS silinder,a.kd_satuan,a.kondisi,a.jumlah,IFNULL(a.nilai,0) AS nilai,(CASE WHEN a.stat_fisik='1' THEN CONCAT(a.keberadaan_brg,IF(a.keberadaan_brg<>'',' / ',''),a.kondisi_brg) WHEN a.stat_fisik='0' THEN a.ket_brg ELSE '' END) AS hsl,a.keterangan ,LPAD(a.no_sensus, 6, '0') as no_sensus, a.kd_unit,
			(CASE WHEN a.stat_fisik2='1' THEN CONCAT(a.keberadaan_brg2,IF(a.keberadaan_brg2<>'',' / ',''),a.kondisi_brg2) WHEN a.stat_fisik2='0' THEN a.ket_brg2 ELSE '' END) AS review,a.catatan
			FROM trkib_e a left join mbarang b on a.kd_brg=b.kd_brg  $skpd $unit $fthn AND a.nilai<'100000' and a.kd_riwayat<>'9' 

			AND (a.no_mutasi IS NULL OR a.no_mutasi='' OR a.tgl_mutasi>='$sampai_tgl') 
			AND (a.no_pindah IS NULL OR a.no_pindah='' OR a.tgl_pindah>='$sampai_tgl') 
			AND (a.no_hapus IS NULL OR a.no_hapus='' OR a.tgl_hapus>='$sampai_tgl') and a.tgl_reg<='$sampai_tgl'
			
			) faiz  ORDER BY kd_brg,no_reg";
                        
             $hasil_eca = $this->db->query($csql_eca);
             $i_eca = 1;
             $nilaix_eca=0;
             $jml_brgx_eca=0;
             $subtot_eca = '0';
             $jumtot_eca = '0';
             $bc = 'background-color: #dfdfdf; font-weight: bold;';
             foreach ($hasil_eca->result() as $row_sum) {
                 $subtot_eca = $subtot_eca + $row_sum->nilai;
                 $jumtot_eca = $jumtot_eca + $row_sum->jumlah;
             }
             $cRet.="
             <tr>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">EXTRA COUNTING ASSET (ECA)</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">$jumtot_eca</td>
                    <td valign=\"top\"  align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">".number_format($subtot_eca,2)."</td>
                    <td valign=\"top\"  align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\">SUBTOTAL</td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>
                    ";
            if ($kd_unit=='') {
            $cRet .="
                    <td align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black; $bc\"></td>";
            }
            $cRet .="
                    
                </tr>
             ";
             $ket_sensus='';
             foreach ($hasil_eca->result() as $row_eca)
             {  
                $jml_brgx_eca = $row_eca->jumlah+$jml_brgx_eca;
                $nilaix_eca = $row_eca->nilai+$nilaix_eca;
                if ($row_eca->status!=1) {
                	$ket_sensus='Belum Sensus';
                }else{
                	$ket_sensus= $row_eca->hsl;
                }
                $cRet .="
                
                 <tr>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$i_eca</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kd_brg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->no_reg</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->no_sensus</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->nm_brg</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->merek</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->gabung</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kd_bahan</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->asal</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->tahun</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->silinder</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kd_satuan</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->kondisi</td>
                     <td valign=\"top\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->jumlah</td>
                     <td valign=\"top\" align=\"right\" style=\"font-size:11px; border-bottom:solid 1px black;\">".number_format($row_eca->nilai,2)."</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->keterangan</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$ket_sensus</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->review</td>
                     <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">$row_eca->catatan</td>
                     ";
            if ($kd_unit=='') {
            $cRet .="
                    <td valign=\"top\" align=\"left\" style=\"font-size:11px; border-bottom:solid 1px black;\">".$this->nm_unit($row_eca->kd_unit)."</td>";
            }
            $cRet .="
                    
                </tr>
             ";
                $i_eca++;    
              
             }
/*--------------------------------------------------------------------------------------------------------------*/
                $jum_tot ='';
                $jum_tot =$jml_brgx_ttp + $jml_brgx_lain + $jml_brgx_eca;
                $cRet .="
                 <tr>
					<td bgcolor=\"#80FE80\" colspan=\"13\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"></td>
                    <td bgcolor=\"#80FE80\" align=\"center\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>$jum_tot</b></td>
                    <td bgcolor=\"#80FE80\" colspan=\"5\" align=\"LEFT\" style=\"font-size:11px; border-bottom:solid 1px black;\"><b>".number_format($nilaix_ttp+$nilaix_lain+$nilaix_eca,2)."</b></td>
                </tr>";
                if ($mengetahui<>'' && $pengurus<>'') {
                $cRet .="
                <tr>
                	<td colspan=\"19\" style=\"border-right:hidden;border-left:hidden;border-bottom:hidden;\" width=\"100%\">
                		<br/><br/>
						<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
							<tr>
								<td colspan=\"19\" height=\"20px\"></td>
							</tr>
							<tr>
								<td align=\"right\" colspan=\"19\" width=\"100%\">Makassar, $tgl</td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"9\">Mengetahui,</td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"9\"></td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"9\">".$query_ttd['jabatan_m']."</td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"9\">PENGURUS BARANG</td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"19\" height=\"70px\"></td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"9\"><u><b>$mengetahui</u></td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"9\"><u><b>$pengurus</u></td>
							</tr>
							<tr>
								<td align=\"center\" colspan=\"9\">NIP $nip_m</td>
								<td align=\"center\" width=\"50%\" ></td>
								<td align=\"center\" colspan=\"9\">NIP $nip_p</td>
							</tr>
						</table>
                	</td>
                </tr>";
            	}
            	$cRet .="
                </table>";
				}
				$cRet .="
		
			";
			

		$data['excel'] = $cRet;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf($orien,$lmrg,$rmrg,$tmrg,$bmrg,$hmrg,$fmrg,'',$cRet);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
			break;
			case 3:
			$namafile	= str_replace(' ','_',$judul);
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename= $namafile.xls");
			$this->load->view('doc', $data);
			break;
		}
       } 
	}	
}/*Controller*/
?>