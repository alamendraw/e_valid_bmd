<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Survey extends CI_Controller {
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
			$a['page']  ='v_survey';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	function get_skpd(){
		$data = $this->db->query("SELECT kd_skpd,nm_skpd FROM ms_skpd")->result();
		echo json_encode($data);
	}
	function get_unit(){
		$p = $this->input->post('kd_skpd');
		$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_skpd ='$p' order by kd_lokasi ASC")->result();
		echo json_encode($data);
	}
	function get_ruang(){
		$kd_skpd = $this->input->post('kd_skpd');
		$kd_unit = $this->input->post('kd_unit');
		$data = $this->db->query("xSELECT kd_ruang,nm_ruang,no_urut FROM mruang where kd_skpd='$kd_skpd' AND kd_unit='$kd_unit' ORDER BY no_urut ASC")->result();
		echo json_encode($data);
	}
	function cetak(){
		ini_set('max_execution_time', 300);
		$cetak    = $_REQUEST['cetak'];
		$kd_skpd  = $_REQUEST['kd_skpd'];
		$kd_unit  = $_REQUEST['unit_skpd'];
		$jns_kib  = $_REQUEST['jns_kib'];
		$limit    = $_REQUEST['limit'];
		$ruang    = $_REQUEST['ruang'];
		$nm_ruang = $_REQUEST['nm_ruang'];
		if ($limit>0) {
			$limit_value = 'limit '.$limit;
		}else{
			$limit_value = '';
		}
		if ($ruang!='' OR $ruang!=null) {
			$ruang_value = 'AND kd_ruang="'.$ruang.'"';
		}else{
			$ruang_value = '';
		}
		if ($ruang!='' OR $ruang!=null) {
			$nm_ruang_value = 'RUANGAN '.strtoupper(substr($nm_ruang,5));
		}else{
			$nm_ruang_value = '';
		}
		$nama 	 = $this->db->query("SELECT nm_lokasi,nm_skpd FROM mlokasi a INNER JOIN ms_skpd b on a.kd_skpd=b.kd_skpd WHERE a.kd_lokasi='$kd_unit'")->row_array();
		if ($jns_kib==0) {
		$cRet_1  ="
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"center\" style=\"font-size:23px\">
					LAPORAN TIM SURVEI SKPD<br><br><br>
					KEGIATAN VALIDASI BMD MILIK DAERAH<br>
					LINGKUP PEMERINTAH KOTA MAKASSAR<br>
					PADA UPB ".strtoupper($nama['nm_lokasi'])."<br>
					".strtoupper($nama['nm_skpd'])." KOTA MAKASSAR
					</b></td>
				</tr>
				<tr>
					<td colspan=\"5\" align=\"center\" style=\"font-size:23px\"><br><br><br><br><br>
						<img style=\"height:265px\" src='".base_url('assets/images/logo_grey.png')."'><br><br><br><br><br><br><br><br><br>
					</td>
				</tr>
				<tr>
					<td colspan=\"5\" align=\"center\" style=\"font-size:23px\"><b>
					BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br>
					KOTA MAKASSAR<br>
					TA. ".date("Y")."
					</b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>A. PELAKSANAAN SENSUS<br><br></b></td>
				</tr>
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>A.1. INFORMASI SURVEI</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang</b><br><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB</b><br><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td width=\"72%\" colspan=\"4\"><b>Dasar Pelaksanaan (Surat Perintah)</b></td>
					<td width=\"28%\"><b>Tanggal Pelaksanaan</b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td style=\"border-top:hidden;background-color:#ededed\" width=\"10%\">Nomor</td>
					<td style=\"border-top:hidden;\" width=\"26%\"></td>
					<td style=\"border-top:hidden;background-color:#ededed\" width=\"10%\">Tanggal</td>
					<td style=\"border-top:hidden;\" width=\"26%\"></td>
					<td style=\"border-top:hidden;\" width=\"28%\"></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>A.2. HASIL SURVEI</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"50%\" colspan=\"3\"><b>URAIAN HASIL SENSUS</b></td>
					<td width=\"50%\" colspan=\"2\" align=\"center\">Keterangan</td>
				</tr>
				<tr>
					<td colspan=\"3\">Prosedur Sensus</td>
					<td colspan=\"2\">
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Memadai</span>&emsp;&emsp;&emsp;&emsp;
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Tidak Memadai</span>
					</td>
				</tr>
				<tr>
					<td colspan=\"3\">Penguasaan Aplikasi e-Sensus</td>
					<td colspan=\"2\">
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Memadai</span>&emsp;&emsp;&emsp;&emsp;
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Tidak Memadai</span>
					</td>
				</tr>
				<tr>
					<td colspan=\"3\">Kelengkapan Pemasangan Label Sensus</td>
					<td colspan=\"2\">
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Memadai</span>&emsp;&emsp;&emsp;&emsp;
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Tidak Memadai</span>
					</td>
				</tr><tr>
					<td colspan=\"3\">Kesesuaian Fisik Hasil Sensus (Uji petik)</td>
					<td colspan=\"2\">
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Memadai</span>&emsp;&emsp;&emsp;&emsp;
						<span style=\"border: 1px solid black;\">&emsp;</span><span>&emsp;Tidak Memadai</span>
					</td>
				</tr>
				<tr>
					<td width=\"100%\" colspan=\"5\"><br><br><br><br><br><br><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"right\"><br>Makassar, <br><br><br></td>
				</tr>
				<tr>
					<td width=\"60%\" colspan=\"3\" align=\"left\">TIM SURVEY<br><br><br></td>
					<td width=\"40%\" colspan=\"2\" align=\"left\">Pengurus Barang<br>(Ttd)<br><br><br></td>
				</tr>
				<tr>
					<td colspan=\"3\" align=\"left\">
						<table>
							<tr>
								<td valign=\"bottom\" height=\"40px\" width=\"50%\">1.<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
								<td valign=\"bottom\" height=\"40px\" width=\"50%\"></td>
							<tr>
							<tr>
								<td valign=\"bottom\" height=\"40px\"></td>
								<td valign=\"bottom\" height=\"40px\">4.<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
							<tr>
							<tr>
								<td valign=\"bottom\" height=\"40px\">2.<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
								<td valign=\"bottom\" height=\"40px\"></td>
							<tr>
							<tr>
								<td valign=\"bottom\" height=\"40px\"></td>
								<td valign=\"bottom\" height=\"40px\">5.<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
							<tr>
							<tr>
								<td valign=\"bottom\" height=\"40px\">3.<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
								<td valign=\"bottom\" height=\"40px\"></td>
							<tr>
							<tr>
								<td valign=\"bottom\" height=\"40px\"></td>
								<td valign=\"bottom\" height=\"40px\">6.<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
							<tr>
						</table>
					</td>
					<td colspan=\"2\" align=\"left\">
						<table>
							<tr>
								<td valign=\"bottom\" width=\"100%\" height=\"40px\"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
							<tr>
							<tr>
								<td width=\"100%\">Mengetahui,<br>Penanggung Jawab UPB<br>(Ttd)</td>
							<tr>
							<tr>
								<td valign=\"bottom\" width=\"100%\" rowspan=\"3\"><br><br><br><br><br><br><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
							<tr>
						</table>
					</td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>C. DOKUMENTASI</b></td>
				</tr>
			</table>";
		}
		if ($jns_kib==1) {
		$cRet_2  ="
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>B-01. IDENTIFIKASI LAY OUT TANAH<br><br></b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang<br>(Ttd)</b><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB<br>(Ttd)</b><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
				<tr>
					<td width=\"100%\" colspan=\"5\"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>KETERANGAN :</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<thead>
					<tr>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Kode Sensus</th>
						<th width=\"50%\" align=\"center\" valign=\"middle\">Nama Tanah</th>
						<th width=\"5%\" align=\"center\" valign=\"middle\">Tahun</th>
						<th width=\"20%\" align=\"center\" valign=\"middle\">Nilai Perolehan</th>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Notasi</th>
					</tr>
					<tr style=\"background-color:#ededed;\">
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"left\"   valign=\"middle\">A. TERDAFTAR DI KIB</th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
					</tr>
				</thead>
				<tbody>";
				$query_a = $this->db->query("SELECT no_sensus,CONCAT(nm_brg,(IF(detail_brg ='','',' / ')),detail_brg) AS nm_brg,tahun,nilai FROM trkib_a WHERE kd_unit='$kd_unit' ORDER BY no_sensus");
				foreach ($query_a->result_array() as $row_a) {
		$cRet_2 .="
					<tr>
						<td align=\"center\" valign=\"top\">A-$row_a[no_sensus]</td>
						<td align=\"left\"   valign=\"top\">$row_a[nm_brg]</td>
						<td align=\"center\" valign=\"top\">$row_a[tahun]</td>
						<td align=\"right\"  valign=\"top\">".number_format($row_a['nilai'],2)."</td>
						<td align=\"center\" valign=\"top\"></td>
					</tr>";
				}
		$cRet_2 .="
					<tr style=\"background-color:#ededed;\">
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"left\"   valign=\"middle\"><b>B. BELUM TERDAFTAR DI KIB</b></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
					</tr>
					<tr>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"right\"  valign=\"top\">&nbsp;</td>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
					</tr>
				</tbody>
			</table>";
		}
		if ($jns_kib==2) {
		$cRet_3 ="
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>B-02. UJI PETIK SENSUS PERALATAN DAN MESIN<br><br></b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang<br>(Ttd)</b><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB<br>(Ttd)</b><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
				<tr>
					<td width=\"100%\" colspan=\"5\"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>KETERANGAN :$nm_ruang_value</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<thead>
					<tr>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Kode Sensus</th>
						<th width=\"50%\" align=\"center\" valign=\"middle\">Nama Peralatan & Mesin</th>
						<th width=\"5%\" align=\"center\" valign=\"middle\">Tahun</th>
						<th width=\"20%\" align=\"center\" valign=\"middle\">Nilai Perolehan</th>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Notasi</th>
					</tr>
					<tr style=\"background-color:#ededed;\">
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"left\"   valign=\"middle\">A. TERDAFTAR DI KIB</th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
					</tr>
				</thead>
				<tbody>";
		$query_b = $this->db->query("SELECT no_sensus,CONCAT(nm_brg,(IF(detail_brg ='','',' / ')),detail_brg) AS nm_brg,tahun,nilai FROM trkib_b WHERE kd_unit='$kd_unit' $ruang_value ORDER BY no_sensus $limit_value");
				foreach ($query_b->result_array() as $row_b) {
		$cRet_3 .="
					<tr>
						<td align=\"center\" valign=\"top\">B-$row_b[no_sensus]</td>
						<td align=\"left\"   valign=\"top\">$row_b[nm_brg]</td>
						<td align=\"center\" valign=\"top\">$row_b[tahun]</td>
						<td align=\"right\"  valign=\"top\">".number_format($row_b['nilai'],2)."</td>
						<td align=\"center\" valign=\"top\"></td>
					</tr>";
				}
		$cRet_3 .="
					<tr style=\"background-color:#ededed;\">
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"left\"   valign=\"middle\"><b>B. BELUM TERDAFTAR DI KIB</b></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
					</tr>
					<tr>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"right\"  valign=\"top\">&nbsp;</td>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
					</tr>
				</tbody>
			</table>";
		}
		if ($jns_kib==3) {
		$cRet_4 ="
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>B-03. IDENTIFIKASI LAY-OUT GEDUNG DAN BANGUNAN<br><br></b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang<br>(Ttd)</b><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB<br>(Ttd)</b><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>KETERANGAN :</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<thead>
					<tr>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Kode Sensus</th>
						<th width=\"50%\" align=\"center\" valign=\"middle\">Nama Gedung & Bangunan</th>
						<th width=\"5%\" align=\"center\" valign=\"middle\">Tahun</th>
						<th width=\"20%\" align=\"center\" valign=\"middle\">Nilai Perolehan</th>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Notasi</th>
					</tr>
					<tr style=\"background-color:#ededed;\">
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"left\"   valign=\"middle\">A. TERDAFTAR DI KIB</th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
					</tr>
				</thead>
				<tbody>";
		$query_c = $this->db->query("SELECT no_sensus,CONCAT(nm_brg,(IF(detail_brg ='','',' / ')),detail_brg) AS nm_brg,tahun,nilai FROM trkib_c WHERE kd_unit='$kd_unit' ORDER BY no_sensus");
				foreach ($query_c->result_array() as $row_c) {
		$cRet_4 .="
					<tr>
						<td align=\"center\" valign=\"top\">C-$row_c[no_sensus]</td>
						<td align=\"left\"   valign=\"top\">$row_c[nm_brg]</td>
						<td align=\"center\" valign=\"top\">$row_c[tahun]</td>
						<td align=\"right\"  valign=\"top\">".number_format($row_c['nilai'],2)."</td>
						<td align=\"center\" valign=\"top\"></td>
					</tr>";
				}
		$cRet_4 .="
					<tr style=\"background-color:#ededed;\">
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"left\"   valign=\"middle\"><b>B. BELUM TERDAFTAR DI KIB</b></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
					</tr>
					<tr>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"right\"  valign=\"top\">&nbsp;</td>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
					</tr>
				</tbody>
			</table>";
		}
		if ($jns_kib==4) {
		$cRet_5 ="
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>B-04. UJI PETIK SENSUS JALAN IRIGASI DAN JARINGAN<br><br></b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang<br>(Ttd)</b><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB<br>(Ttd)</b><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>KETERANGAN :</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<thead>
					<tr>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Kode Sensus</th>
						<th width=\"50%\" align=\"center\" valign=\"middle\">Nama Jalan, Irigasi & Jaringan</th>
						<th width=\"5%\" align=\"center\" valign=\"middle\">Tahun</th>
						<th width=\"20%\" align=\"center\" valign=\"middle\">Nilai Perolehan</th>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Notasi</th>
					</tr>
					<tr style=\"background-color:#ededed;\">
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"left\"   valign=\"middle\">A. TERDAFTAR DI KIB</th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
					</tr>
				</thead>
				<tbody>";
		$query_d = $this->db->query("SELECT no_sensus,CONCAT(nm_brg,(IF(detail_brg ='','',' / ')),detail_brg) AS nm_brg,tahun,nilai FROM trkib_d WHERE kd_unit='$kd_unit' ORDER BY no_sensus");
				foreach ($query_d->result_array() as $row_d) {
		$cRet_5 .="
					<tr>
						<td align=\"center\" valign=\"top\">D-$row_d[no_sensus]</td>
						<td align=\"left\"   valign=\"top\">$row_d[nm_brg]</td>
						<td align=\"center\" valign=\"top\">$row_d[tahun]</td>
						<td align=\"right\"  valign=\"top\">".number_format($row_d['nilai'],2)."</td>
						<td align=\"center\" valign=\"top\"></td>
					</tr>";
				}
		$cRet_5 .="
					<tr style=\"background-color:#ededed;\">
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"left\"   valign=\"middle\"><b>B. BELUM TERDAFTAR DI KIB</b></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
					</tr>
					<tr>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"right\"  valign=\"top\">&nbsp;</td>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
					</tr>
				</tbody>
			</table>";
		}
		if ($jns_kib==5) {
		$cRet_6 ="
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>B-05. UJI PETIK SENSUS ASET TETAP LAINNYA<br><br></b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang<br>(Ttd)</b><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB<br>(Ttd)</b><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>KETERANGAN :$nm_ruang_value</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<thead>
					<tr>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Kode Sensus</th>
						<th width=\"50%\" align=\"center\" valign=\"middle\">Nama Aset Tetap Lainnya</th>
						<th width=\"5%\" align=\"center\" valign=\"middle\">Tahun</th>
						<th width=\"20%\" align=\"center\" valign=\"middle\">Nilai Perolehan</th>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Notasi</th>
					</tr>
					<tr style=\"background-color:#ededed;\">
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"left\"   valign=\"middle\">A. TERDAFTAR DI KIB</th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
					</tr>
				</thead>
				<tbody>";
		$query_e = $this->db->query("SELECT no_sensus,CONCAT(nm_brg,(IF(detail_brg ='','',' / ')),detail_brg) AS nm_brg,tahun,nilai FROM trkib_e WHERE kd_unit='$kd_unit' $ruang_value ORDER BY no_sensus $limit_value");
				foreach ($query_e->result_array() as $row_e) {
		$cRet_6 .="
					<tr>
						<td align=\"center\" valign=\"top\">E-$row_e[no_sensus]</td>
						<td align=\"left\"   valign=\"top\">$row_e[nm_brg]</td>
						<td align=\"center\" valign=\"top\">$row_e[tahun]</td>
						<td align=\"right\"  valign=\"top\">".number_format($row_e['nilai'],2)."</td>
						<td align=\"center\" valign=\"top\"></td>
					</tr>";
				}
		$cRet_6 .="
					<tr style=\"background-color:#ededed;\">
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"left\"   valign=\"middle\"><b>B. BELUM TERDAFTAR DI KIB</b></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
					</tr>
					<tr>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"right\"  valign=\"top\">&nbsp;</td>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
					</tr>
				</tbody>
			</table>";
		}
		if ($jns_kib==6) {
		$cRet_7 ="
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"40%\" colspan=\"5\" align=\"center\"><b>KERTAS KERJA SURVEY<br>VALIDASI BMD MILIK DAERAH<br><br>B-06. UJI PETIK SENSUS KONSTRUKSI DALAM PENGERJAAN<br><br></b></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse; \" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">UPB</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_lokasi'])."</td>
				</tr>
				<tr>
					<td width=\"10%\" align=\"left\" style=\"background-color:#ededed;\">SKPD</td>
					<td width=\"90%\" colspan=\"4\">".strtoupper($nama['nm_skpd'])."</td>
				</tr>
				<tr style=\"background-color:#ededed;\">
					<td valign=\"top\" width=\"50%\" colspan=\"2\"><b>Pengurus Barang<br>(Ttd)</b><br><br><br><br></td>
					<td valign=\"top\" width=\"50%\" colspan=\"3\"><b>Penanggung Jawab UPB<br>(Ttd)</b><br><br><br><br></td>
				</tr>
				<tr>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\"></td>
					<td width=\"10%\" style=\"background-color:#ededed;\">Nama</td>
					<td width=\"40%\" colspan=\"2\"></td>
				</tr>
				<tr>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td></td>
					<td style=\"background-color:#ededed;\">NIP</td>
					<td colspan=\"2\"></td>
				</tr>
			</table>
			<br>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
					<td colspan=\"5\" align=\"left\" style=\"font-size:16px\"><b>KETERANGAN :</b><br><br></td>
				</tr>
			</table>
			<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
				<thead>
					<tr>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Kode Sensus</th>
						<th width=\"50%\" align=\"center\" valign=\"middle\">Nama Konstruk dalam Pengerjaan</th>
						<th width=\"5%\" align=\"center\" valign=\"middle\">Tahun</th>
						<th width=\"20%\" align=\"center\" valign=\"middle\">Nilai Perolehan</th>
						<th width=\"10%\" align=\"center\" valign=\"middle\">Notasi</th>
					</tr>
					<tr style=\"background-color:#ededed;\">
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"left\"   valign=\"middle\">A. TERDAFTAR DI KIB</th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
						<th align=\"center\" valign=\"middle\"></th>
					</tr>
				</thead>
				<tbody>";
		$query_f = $this->db->query("SELECT no_sensus,CONCAT(nm_brg,(IF(detail_brg ='','',' / ')),detail_brg) AS nm_brg,tahun,nilai FROM trkib_f WHERE kd_unit='$kd_unit' ORDER BY no_sensus");
				foreach ($query_f->result_array() as $row_f) {
		$cRet_7 .="
					<tr>
						<td align=\"center\" valign=\"top\">F-$row_f[no_sensus]</td>
						<td align=\"left\"   valign=\"top\">$row_f[nm_brg]</td>
						<td align=\"center\" valign=\"top\">$row_f[tahun]</td>
						<td align=\"right\"  valign=\"top\">".number_format($row_f['nilai'],2)."</td>
						<td align=\"center\" valign=\"top\"></td>
					</tr>";
				}
		$cRet_7 .="
					<tr style=\"background-color:#ededed;\">
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"left\"   valign=\"middle\"><b>B. BELUM TERDAFTAR DI KIB</b></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
						<td align=\"center\" valign=\"middle\"></td>
					</tr>
					<tr>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"left\"   valign=\"top\">&nbsp;</td>
						<td align=\"right\"  valign=\"top\">&nbsp;</td>
						<td align=\"center\" valign=\"top\">&nbsp;</td>
					</tr>
				</tbody>
			</table>";
		}

		if ($cetak==1) {
			if ($jns_kib==0) {
				echo($cRet_1);
			}elseif ($jns_kib==1) {
				echo($cRet_2);
			}elseif ($jns_kib==2) {
				echo($cRet_3);
			}elseif ($jns_kib==3) {
				echo($cRet_4);
			}elseif ($jns_kib==4) {
				echo($cRet_5);
			}elseif ($jns_kib==5) {
				echo($cRet_6);
			}elseif ($jns_kib==6) {
				echo($cRet_7);
			}
		}elseif ($cetak==2){
			if ($jns_kib==0) {
				$data['excel'] = $cRet_1;
			}elseif ($jns_kib==1) {
				$data['excel'] = $cRet_2;
			}elseif ($jns_kib==2) {
				$data['excel'] = $cRet_3;
			}elseif ($jns_kib==3) {
				$data['excel'] = $cRet_4;
			}elseif ($jns_kib==4) {
				$data['excel'] = $cRet_5;
			}elseif ($jns_kib==5) {
				$data['excel'] = $cRet_6;
			}elseif ($jns_kib==6) {
				$data['excel'] = $cRet_7;
			}
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header("Content-Type: application/vnd.ms-word");
			header('Content-Disposition: attachment; filename=KKS.doc');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			$this->load->view('doc', $data);
		}else{
				$this->M_model->_mpdf_label('P',10,10,10,10,0,0,'',$cRet_1,'LEGAL');
				/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
		}
	}

}
?>
