<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller {
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
			$a['page']  ='v_progress';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	function get_skpd(){
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			$where="";
		}else{
			$where="WHERE kd_skpd='$_SESSION[skpd]'";
		}
		$data = $this->db->query("SELECT kd_skpd,nm_skpd FROM ms_skpd $where")->result();
		echo json_encode($data);
	}
	function get_unit(){
		$p = $this->input->post('kd_skpd');
		$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_skpd ='$p' order by kd_lokasi ASC")->result();
		echo json_encode($data);
	}
	function get_jns_cetak(){
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			$data = 1;
		}elseif ($_SESSION['otori']==2) {
			$data = 2;
		}else{
			$data = 3;
		}
		echo json_encode($data);
	}
	function cetak_progress(){
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$jns_cetak = $_REQUEST['jns_cetak'];
		$cetak     = $_REQUEST['cetak'];
		$kd_skpd   = $_REQUEST['kd_skpd'];
		$kd_unit   = $_REQUEST['unit_skpd'];
		$tgl       = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$format    = $_REQUEST['format'];
		$color     = '';
		$no        = 0;
		$nm_skpd   = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit   = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		if ($jns_cetak==4) {
			$query     = $this->db->query("call progres_sensus_cetak_skpd('$kd_skpd','$kd_unit')");
		}else{
			$query     = $this->db->query("call progres_sensus_cetak('$kd_skpd','$kd_unit')");
		}
		$cRet="";
		if($jns_cetak==4){
			$orientasi = 'P';
			$cRet .="
					<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
						<tr>
							<td width=\"30%\" colspan=\"2\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
							<td width=\"40%\" colspan=\"3\" align=\"center\"><b>REKAP PROGRES SENSUS</b></td>
							<td width=\"30%\" colspan=\"2\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
						</tr>
						<tr>
							<td colspan=\"7\" align=\"center\" style=\"font-size:16px\"><hr></td>
						</tr>";
					$cRet .="
						<tr>
							<td width=\"2%\"></td>
							<td width=\"10%\">KOTA</td>
							<td width=\"18%\" colspan=\"5\">: MAKASSAR</td>
						</tr>";
					if ($tgl<>'') {
					$cRet .="
						<tr>
							<td></td>
							<td>TANGGAL</td>
							<td colspan=\"5\">: ".strtoupper($tgl)."</td>
						</tr>";
					}
					$cRet .="
					</table>";
			$cRet .="<table style=\"border-collapse:collapse; font-size:13px;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">";
			$cRet .="<thead>
						<tr>
							<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
							<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama SKPD</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Total Kib</th>
						</tr>
						<tr>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
						</tr>
					</thead>
					<tbody>";
			$cRet .="	<tr style=\"background-color:#a2c8fb;\">
							<td valign=\"midle\" align=\"center\">1</td>
							<td valign=\"midle\" align=\"center\">2</td>
							<td valign=\"midle\" align=\"center\">3</td>
							<td valign=\"midle\" align=\"center\">4</td>
							<td valign=\"midle\" align=\"center\">5</td>
							<td valign=\"midle\" align=\"center\">6</td>
							<td valign=\"midle\" align=\"center\">7</td>
						</tr>";
				foreach ($query->result_array() as $row) {
				$no++;
				if ($no % 2== 0) {
					$color = '#f6f6f6';
				}else{
					$color = '';
				}
				$cRet .="<tr style=\"background-color:$color;\">
							<td width=\"5%\" valign=\"top\" align=\"center\">$no</td>
							<td width=\"45%\" valign=\"top\" align=\"left\">".strtoupper($row['nm_skpd'])."</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot]</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_s]</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_s_p]<b>%</b></td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_n]</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_n_p]<b>%</b></td>
						</tr>";
				}
			$cRet .="</tbody>
			</table>";
		}else if ($format=='rinci') {
			$orientasi = 'L';
			$cRet .="
					<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
						<tr>
							<td width=\"30%\" colspan=\"12\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
							<td width=\"40%\" colspan=\"13\" align=\"center\"><b>REKAP PROGRES SENSUS</b></td>
							<td width=\"30%\" colspan=\"12\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
						</tr>
						<tr>
							<td colspan=\"37\" align=\"center\" style=\"font-size:16px\"><hr></td>
						</tr>";
					if ($kd_skpd<>'') {
					$cRet .="
						<tr>
							<td width=\"2%\"></td>
							<td width=\"10%\">SKPD</td>
							<td width=\"88%\" colspan=\"35\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
						</tr>";
					}
					if ($kd_unit<>'') {
					$cRet .="
						<tr>
							<td></td>
							<td>UNIT</td>
							<td colspan=\"35\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
						</tr>";
					}
					$cRet .="
						<tr>
							<td></td>
							<td>KOTA</td>
							<td colspan=\"35\">: MAKASSAR</td>
						</tr>";
					if ($tgl<>'') {
					$cRet .="
						<tr>
							<td></td>
							<td>TANGGAL</td>
							<td colspan=\"35\">: ".strtoupper($tgl)."</td>
						</tr>";
					}
					$cRet .="
					</table>";
			$cRet .="<table style=\"border-collapse:collapse; font-size:13px;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">";
			$cRet .="<thead>
						<tr>
							<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
							<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Unit</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Kib A</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Kib B</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Kib C</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Kib D</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Kib E</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Kib F</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Total Kib</th>
						</tr>
						<tr>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
						</tr>
					</thead>
					<tbody>";
			$cRet .="	<tr style=\"background-color:#a2c8fb;\">
							<td valign=\"midle\" align=\"center\">1</td>
							<td valign=\"midle\" align=\"center\">2</td>
							<td valign=\"midle\" align=\"center\">3</td>
							<td valign=\"midle\" align=\"center\">4</td>
							<td valign=\"midle\" align=\"center\">5</td>
							<td valign=\"midle\" align=\"center\">6</td>
							<td valign=\"midle\" align=\"center\">7</td>
							<td valign=\"midle\" align=\"center\">8</td>
							<td valign=\"midle\" align=\"center\">9</td>
							<td valign=\"midle\" align=\"center\">10</td>
							<td valign=\"midle\" align=\"center\">11</td>
							<td valign=\"midle\" align=\"center\">12</td>
							<td valign=\"midle\" align=\"center\">13</td>
							<td valign=\"midle\" align=\"center\">14</td>
							<td valign=\"midle\" align=\"center\">15</td>
							<td valign=\"midle\" align=\"center\">16</td>
							<td valign=\"midle\" align=\"center\">17</td>
							<td valign=\"midle\" align=\"center\">18</td>
							<td valign=\"midle\" align=\"center\">19</td>
							<td valign=\"midle\" align=\"center\">20</td>
							<td valign=\"midle\" align=\"center\">21</td>
							<td valign=\"midle\" align=\"center\">22</td>
							<td valign=\"midle\" align=\"center\">23</td>
							<td valign=\"midle\" align=\"center\">24</td>
							<td valign=\"midle\" align=\"center\">25</td>
							<td valign=\"midle\" align=\"center\">26</td>
							<td valign=\"midle\" align=\"center\">27</td>
							<td valign=\"midle\" align=\"center\">28</td>
							<td valign=\"midle\" align=\"center\">29</td>
							<td valign=\"midle\" align=\"center\">30</td>
							<td valign=\"midle\" align=\"center\">31</td>
							<td valign=\"midle\" align=\"center\">32</td>
							<td valign=\"midle\" align=\"center\">33</td>
							<td valign=\"midle\" align=\"center\">34</td>
							<td valign=\"midle\" align=\"center\">35</td>
							<td valign=\"midle\" align=\"center\">36</td>
							<td valign=\"midle\" align=\"center\">37</td>
						</tr>";
				foreach ($query->result_array() as $row) {
				$no++;
				if ($no % 2== 0) {
					$color = '#f6f6f6';
				}else{
					$color = '';
				}
				$cRet .="<tr style=\"background-color:$color;\">
							<td width=\"2%\" valign=\"top\" align=\"center\">$no</td>
							<td width=\"7%\" valign=\"top\" align=\"left\">".strtoupper($row['nm_lokasi'])."</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[a_t]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[a_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[a_p_s]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[a_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[a_p_n]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[b_t]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[b_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[b_p_s]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[b_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[b_p_n]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[c_t]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[c_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[c_p_s]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[c_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[c_p_n]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[d_t]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[d_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[d_p_s]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[d_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[d_p_n]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[e_t]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[e_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[e_p_s]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[e_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[e_p_n]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[f_t]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[f_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[f_p_s]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[f_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[f_p_n]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[tot]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[tot_s]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[tot_s_p]<b>%</b></td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[tot_n]</td>
							<td width=\"3%\" valign=\"top\" align=\"right\">$row[tot_n_p]<b>%</b></td>
						</tr>";
				}
			$cRet .="</tbody>
			</table>";
		}else{
			$orientasi = 'P';
			$cRet .="
					<table style=\"border-collapse:collapse; font-size:14px;\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
						<tr>
							<td width=\"30%\" colspan=\"2\" align=\"center\"><img src='".base_url('assets/images/logo3.png')."'></td>
							<td width=\"40%\" colspan=\"3\" align=\"center\"><b>REKAP PROGRES SENSUS</b></td>
							<td width=\"30%\" colspan=\"2\" align=\"center\"><img src='".base_url('assets/images/logo4.png')."'></td>
						</tr>
						<tr>
							<td colspan=\"7\" align=\"center\" style=\"font-size:16px\"><hr></td>
						</tr>";
					if ($kd_skpd<>'') {
					$cRet .="
						<tr>
							<td width=\"2%\"></td>
							<td width=\"10%\">SKPD</td>
							<td width=\"88%\" colspan=\"5\">: ".strtoupper($nm_skpd['nm_skpd'])."</td>
						</tr>";
					}
					if ($kd_unit<>'') {
					$cRet .="
						<tr>
							<td></td>
							<td>UNIT</td>
							<td colspan=\"5\">: ".strtoupper($nm_unit['nm_lokasi'])."</td>
						</tr>";
					}
					$cRet .="
						<tr>
							<td></td>
							<td>KOTA</td>
							<td colspan=\"5\">: MAKASSAR</td>
						</tr>";
					if ($tgl<>'') {
					$cRet .="
						<tr>
							<td></td>
							<td>TANGGAL</td>
							<td colspan=\"5\">: ".strtoupper($tgl)."</td>
						</tr>";
					}
					$cRet .="
					</table>";
			$cRet .="<table style=\"border-collapse:collapse; font-size:13px;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">";
			$cRet .="<thead>
						<tr>
							<th valign=\"midle\" align=\"center\" rowspan=\"2\">No</th>
							<th valign=\"midle\" align=\"center\" rowspan=\"2\">Nama Unit</th>
							<th valign=\"midle\" align=\"center\" colspan=\"5\">Total Kib</th>
						</tr>
						<tr>
							<th valign=\"midle\" align=\"center\">Total</th>
							<th valign=\"midle\" align=\"center\">Sudah Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8730;%</th>
							<th valign=\"midle\" align=\"center\">Belum Sensus</th>
							<th valign=\"midle\" align=\"center\">&#8709;%</th>
						</tr>
					</thead>
					<tbody>";
			$cRet .="	<tr style=\"background-color:#a2c8fb;\">
							<td valign=\"midle\" align=\"center\">1</td>
							<td valign=\"midle\" align=\"center\">2</td>
							<td valign=\"midle\" align=\"center\">3</td>
							<td valign=\"midle\" align=\"center\">4</td>
							<td valign=\"midle\" align=\"center\">5</td>
							<td valign=\"midle\" align=\"center\">6</td>
							<td valign=\"midle\" align=\"center\">7</td>
						</tr>";
				foreach ($query->result_array() as $row) {
				$no++;
				if ($no % 2== 0) {
					$color = '#f6f6f6';
				}else{
					$color = '';
				}
				$cRet .="<tr style=\"background-color:$color;\">
							<td width=\"5%\" valign=\"top\" align=\"center\">$no</td>
							<td width=\"45%\" valign=\"top\" align=\"left\">".strtoupper($row['nm_lokasi'])."</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot]</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_s]</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_s_p]<b>%</b></td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_n]</td>
							<td width=\"10%\" valign=\"top\" align=\"right\">$row[tot_n_p]<b>%</b></td>
						</tr>";
				}
			$cRet .="</tbody>
			</table>";
		}
		$data['excel'] = $cRet;
		$judul = 'REKAP PROGRES SENSUS';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf($orientasi,5,5,5,5,5,5,'',$cRet);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
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
?>
