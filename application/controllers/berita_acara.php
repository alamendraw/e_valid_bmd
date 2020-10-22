<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_acara extends CI_Controller {
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
			$a['page']  ='v_berita_acara';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	function get_mengetahui_skpd(){
		$kd_skpd = $this->input->post('kd_skpd');
		$data=$this->M_model->get_ttd_skpd('PA',$kd_skpd);
		echo json_encode($data);
	}
	function get_pengurus_skpd(){
		$kd_skpd = $this->input->post('kd_skpd');
		$data=$this->M_model->get_ttd_skpd('PB',$kd_skpd);
		echo json_encode($data);
	}
	function get_pppb_skpd(){
		$kd_skpd = $this->input->post('kd_skpd');
		$data=$this->M_model->get_ttd_skpd('PPPB',$kd_skpd);
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
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			$where="";
		}else{
			$where="WHERE kd_skpd='$_SESSION[skpd]'";
		}
		$data = $this->db->query("SELECT kd_skpd,nm_skpd FROM ms_skpd $where")->result();
		echo json_encode($data);
	}
	public function getNmSkpd($skpd)
	{
		$res = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$skpd' limit 1")->row("nm_skpd");
		return $res;
	}
	public function getNmUnit($unit)
	{
		$res = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$unit' limit 1")->row("nm_lokasi");
		return $res;
	}
	public function getJabatan($nip)
	{
		$res = $this->db->query("SELECT jabatan FROM ttd WHERE nip='$nip' limit 1")->row("jabatan");
		return $res;
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
	
	function cetak_berita_acara(){
		$cetak         = $_REQUEST['cetak'];
		$skpd          = $_REQUEST['kd_skpd'];
		$unit          = $_REQUEST['unit_skpd'];
		$tgl           = ($_REQUEST['tgl']=='')?'':date_indo($_REQUEST['tgl']);
		$kpl_skpd      = ($_REQUEST['kpl_skpd']=='-PILIH-')?'-':$_REQUEST['kpl_skpd'];
		$nip_kpl_skpd  = ($_REQUEST['nip_kpl_skpd']=='')?'-':$_REQUEST['nip_kpl_skpd'];
		$pppb_skpd     = ($_REQUEST['pppb_skpd']=='-PILIH-')?'-':$_REQUEST['pppb_skpd'];
		$nip_pppb_skpd = ($_REQUEST['nip_pppb_skpd']=='')?'-':$_REQUEST['nip_pppb_skpd'];
		$peng_skpd     = ($_REQUEST['peng_skpd']=='-PILIH-')?'-':$_REQUEST['peng_skpd'];
		$nip_peng_skpd = ($_REQUEST['nip_peng_skpd']=='')?'-':$_REQUEST['nip_peng_skpd'];

		$kpl      = ($_REQUEST['kpl']=='-PILIH-')?'-':$_REQUEST['kpl'];
		$nip_kpl  = ($_REQUEST['nip_kpl']=='')?'-':$_REQUEST['nip_kpl'];
		$peng     = ($_REQUEST['peng']=='-PILIH-')?'-':$_REQUEST['peng'];
		$nip_peng = ($_REQUEST['nip_peng']=='')?'-':$_REQUEST['nip_peng'];

		$cjns 		   = $_REQUEST['cjns'];
		$cRet          = "";


		if ($cjns=='SKPD') {
		$cRet .="
			<table style=\"border-collapse:collapse; font-size:12pt;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td align=\"center\" colspan=\"44\">
							BERITA ACARA HASIL INVENTARISASI BARANG MILIK DAERAH TA 2019<BR>PADA ".strtoupper($this->getNmSkpd($skpd))."
						</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">NOMOR:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"left\" colspan=\"44\">Kami yang bertanda tangan dibawah ini:<br><br></td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"right\" valign=\"top\" width=\"3%\" rowspan=\"3\">a.</td>
						<td align=\"left\" width=\"15%\" >&nbsp;&nbsp;Nama</td>
						<td align=\"left\" width=\"1%\" >:</td>
						<td align=\"left\" width=\"81%\" colspan=\"41\">$kpl_skpd</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;NIP</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".str_replace(' ', '', $nip_kpl_skpd)."</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;Jabatan</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">Kepala ".ucwords(strtolower($this->getNmSkpd($skpd)))."</td>
					</tr>

					<tr>
						<td align=\"right\" valign=\"top\" rowspan=\"3\">b.</td>
						<td align=\"left\" >&nbsp;&nbsp;Nama</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">$pppb_skpd</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;NIP</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".str_replace(' ', '', $nip_pppb_skpd)."</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;Jabatan</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".ucwords(strtolower($this->getJabatan($nip_pppb_skpd)))."</td>
					</tr>

					<tr>
						<td align=\"right\" valign=\"top\" rowspan=\"3\">c.</td>
						<td align=\"left\" >&nbsp;&nbsp;Nama</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">$peng_skpd</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;NIP</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".str_replace(' ', '', $nip_peng_skpd)."</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;Jabatan</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".ucwords(strtolower($this->getJabatan($nip_peng_skpd)))."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"left\" colspan=\"44\">Dengan ini menyatakan bahwa:</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"right\" valign=\"top\">1.&nbsp;&nbsp;&nbsp;</td>
						<td align=\"justify\" colspan=\"43\">Telah melaksanakan inventarisasi barang milik daerah dalam lingkup ".$this->getNmSkpd($skpd)." dengan hasil sebagaimana data terlampir.</td>
					</tr>
					<tr>
						<td align=\"right\" valign=\"top\">2.&nbsp;&nbsp;&nbsp;</td>
						<td align=\"justify\" colspan=\"43\">Bertanggung jawab atas kebenaran hasil inventarisasi barang milik daerah yang telah dilaksanakan sebagaimana dimaksud.</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"justify\" colspan=\"44\">Demikian berita acara ini dibuat dengan sebenar-benarnya dan disampaikan kepada Sekretaris Daerah Kota Makassar Cq.  Kepala Badan Pengelola Keuangan  dan Aset Daerah Kota Makassar untuk dipergunakan sebagaimana mestinya</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"20px\"></td>
					</tr>
			</table>";
		$cRet .="
			<table style=\"border-collapse:collapse; font-size:12pt;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td width=\"40%\" align=\"center\"></td>
						<td width=\"20%\" align=\"center\"></td>
						<td width=\"40%\" align=\"left\">Makassar, $tgl</td>
					</tr>
					<tr>
						<td align=\"left\">Pejabat Penatausahaan<br>Pengguna Barang</td>
						<td align=\"center\"></td>
						<td align=\"left\">Pengurus Barang ".$this->getNmSkpd($skpd)."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"3\" height=\"80px\"></td>
					</tr>
					<tr>
						<td align=\"left\">( $pppb_skpd )</td>
						<td align=\"center\"></td>
						<td align=\"left\">( $peng_skpd )</td>
					</tr>
					<tr>
						<td align=\"left\">NIP ".str_replace(' ', '', $nip_pppb_skpd)."</td>
						<td align=\"center\"></td>
						<td align=\"left\">NIP ".str_replace(' ', '', $nip_peng_skpd)."</td>
					</tr>
			</table><br>";
		$cRet .="
			<table style=\"border-collapse:collapse; font-size:12pt;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td width=\"35%\" align=\"left\"></td>
						<td width=\"65%\" align=\"left\" colspan=\"2\">Mengetahui,<br>Kepala ".$this->getNmSkpd($skpd)."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"3\" height=\"80px\"></td>
					</tr>
					<tr>
						<td align=\"left\"></td>
						<td align=\"left\" colspan=\"2\">( $kpl_skpd )</td>
					</tr>
					<tr>
						<td align=\"left\"></td>
						<td align=\"left\" colspan=\"2\">NIP ".str_replace(' ', '', $nip_kpl_skpd)."</td>
					</tr>
			</table>";
		}else{
		$cRet .="
			<table style=\"border-collapse:collapse; font-size:12pt;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td align=\"center\" colspan=\"44\">
							BERITA ACARA HASIL INVENTARISASI BARANG MILIK DAERAH TA 2019<BR>PADA ".strtoupper($this->getNmUnit($unit))."
						</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">NOMOR:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"left\" colspan=\"44\">Kami yang bertanda tangan dibawah ini:<br><br></td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"right\" valign=\"top\" width=\"3%\" rowspan=\"3\">a.</td>
						<td align=\"left\" width=\"15%\" >&nbsp;&nbsp;Nama</td>
						<td align=\"left\" width=\"1%\" >:</td>
						<td align=\"left\" width=\"81%\" colspan=\"41\">$kpl</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;NIP</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".str_replace(' ', '', $nip_kpl)."</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;Jabatan</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">Kepala ".ucwords(strtolower($this->getNmUnit($unit)))."</td>
					</tr>

					<tr>
						<td align=\"right\" valign=\"top\" rowspan=\"3\">b.</td>
						<td align=\"left\" >&nbsp;&nbsp;Nama</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">$peng</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;NIP</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".str_replace(' ', '', $nip_peng)."</td>
					</tr>
					<tr>
						<td align=\"left\" >&nbsp;&nbsp;Jabatan</td>
						<td align=\"left\" >:</td>
						<td align=\"left\" colspan=\"41\">".ucwords(strtolower($this->getJabatan($nip_peng)))."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"left\" colspan=\"44\">Dengan ini menyatakan bahwa:</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"right\" valign=\"top\">1.&nbsp;&nbsp;&nbsp;</td>
						<td align=\"justify\" colspan=\"43\">Telah melaksanakan inventarisasi barang milik daerah dalam lingkup ".$this->getNmUnit($unit)." dengan hasil sebagaimana data terlampir.</td>
					</tr>
					<tr>
						<td align=\"right\" valign=\"top\">2.&nbsp;&nbsp;&nbsp;</td>
						<td align=\"justify\" colspan=\"43\">Bertanggung jawab atas kebenaran hasil inventarisasi barang milik daerah yang telah dilaksanakan sebagaimana dimaksud.</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"10px\"></td>
					</tr>
					<tr>
						<td align=\"justify\" colspan=\"44\">Demikian berita acara ini dibuat dengan sebenar-benarnya dan disampaikan kepada Kepala ".$this->getNmSkpd($skpd)." selaku Pengguna Barang dan Sekretaris Daerah Kota Makassar Cq.  Kepala Badan Pengelola Keuangan  dan Aset Daerah Kota Makassar untuk dipergunakan sebagaimana mestinya</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\" height=\"20px\"></td>
					</tr>
			</table>";
		$cRet .="
			<table style=\"border-collapse:collapse; font-size:12pt;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td width=\"45%\" align=\"center\"></td>
						<td width=\"10%\" align=\"center\"></td>
						<td width=\"45%\" align=\"left\">Makassar, $tgl</td>
					</tr>
					<tr>
						<td align=\"left\">Mengetahui,</td>
						<td align=\"center\"></td>
						<td align=\"left\"></td>
					</tr>
					<tr>
						<td align=\"left\">Pengurus Barang ".$this->getNmSkpd($skpd)."</td>
						<td align=\"center\"></td>
						<td align=\"left\">Pengurus Barang ".$this->getNmUnit($unit)."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"3\" height=\"80px\"></td>
					</tr>
					<tr>
						<td align=\"left\">( $peng_skpd )</td>
						<td align=\"center\"></td>
						<td align=\"left\">( $peng )</td>
					</tr>
					<tr>
						<td align=\"left\">NIP ".str_replace(' ', '', $nip_peng_skpd)."</td>
						<td align=\"center\"></td>
						<td align=\"left\">NIP ".str_replace(' ', '', $nip_peng)."</td>
					</tr>

					<tr>
						<td align=\"center\" colspan=\"3\" height=\"50px\"></td>
					</tr>

					<tr>
						<td align=\"left\">Kepala ".$this->getNmSkpd($skpd)."</td>
						<td align=\"center\"></td>
						<td align=\"left\">Kepala ".$this->getNmUnit($unit)."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"3\" height=\"80px\"></td>
					</tr>
					<tr>
						<td align=\"left\">( $kpl_skpd )</td>
						<td align=\"center\"></td>
						<td align=\"left\">( $kpl )</td>
					</tr>
					<tr>
						<td align=\"left\">NIP ".str_replace(' ', '', $nip_kpl_skpd)."</td>
						<td align=\"center\"></td>
						<td align=\"left\">NIP ".str_replace(' ', '', $nip_kpl)."</td>
					</tr>
			</table>";	
		}

			

		$data['excel'] = $cRet;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf('P',10,10,10,10,5,5,'',$cRet);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
			// echo $cRet;

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

	function nm_unit($kd_unit){
		$query = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row('nm_lokasi');
		return $query;
	}
	function nm_skpd($kd_skpd){
		$query = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row('nm_skpd');
		return $query;
	}
}/*Controller*/
?>
