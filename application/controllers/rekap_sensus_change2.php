
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_sensus extends CI_Controller {
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
			$a['page']  ='v_rekap_sensus';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	function get_mengetahui(){
		$kd_skpd = $this->input->post('kd_skpd');
		$unit_skpd = $this->input->post('unit_skpd');
		$data=$this->M_model->get_ttd('PA',$kd_skpd,kd_unit,$unit_skpd);
		echo json_encode($data);
	}
	function get_pengurus(){
		$kd_skpd = $this->input->post('kd_skpd');
		$unit_skpd = $this->input->post('unit_skpd');
		$data=$this->M_model->get_ttd('PB',$kd_skpd,kd_unit,$unit_skpd);
		echo json_encode($data);
	}
	function get_skpd(){
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			$where="";
		}else{
			$where="WHERE kd_skpd='$_SESSION[skpd]'";
		}
		$data = $this->db->query("SELECT kd_skpd,kd_unit,nm_skpd FROM ms_skpd $where")->result();
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
	
	function cetak_rekap(){
		$cetak      = $_REQUEST['cetak'];
		$mengetahui = ($_REQUEST['mengetahui']=='-PILIH-') ? '':$_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = ($_REQUEST['pengurus']=='-PILIH-') ? '':$_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$pertgl     = date('Y-m-d',strtotime($_REQUEST['tgl']));
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
		$cRet ="";
		if ($kd_skpd!='' && ($kd_unit!='' || $kd_unit!=null)) {
			$where  = "WHERE a.kd_unit='".$kd_unit."'";
			$where2 = "WHERE kd_unit='".$kd_unit."' GROUP BY id_barang";
			$group  = "GROUP by kd_unit";
		}elseif($kd_skpd!='' && ($kd_unit=='' || $kd_unit==null)){
			$where  = "WHERE a.kd_skpd='".$kd_skpd."'";
			$where2 = "WHERE kd_skpd='".$kd_skpd."' GROUP BY id_barang";
			$group  = "GROUP by kd_unit";
		}else{
			$where  = "";
			$where2 = "GROUP BY id_barang";
			$group  = "GROUP by kd_skpd";
		}
		$sql = "SELECT	
					kd_skpd,
					kd_unit,
					sum(if(status='' OR status IS NULL,jumlah,0)) AS j_non_sensus,
					sum(if(status='' OR status IS NULL,nilai,0)) AS n_non_sensus,
					sum(if(status='1',jumlah,0)) AS j_sensus,
					sum(if(status='1',nilai,0)) AS n_sensus,
					sum(if(keberadaan_brg='SKPD',jumlah,0)) AS j_kb_skpd,
					sum(if(keberadaan_brg='SKPD',nilai,0)) AS n_kb_skpd,
					sum(if(keberadaan_brg='Dikerjasamakan dengan pihak lain',jumlah,0)) AS j_kb_kdpl,
					sum(if(keberadaan_brg='Dikerjasamakan dengan pihak lain',nilai,0)) AS n_kb_kdpl,
					sum(if(keberadaan_brg='Dikuasai secara tidak sah pihak lain',jumlah,0)) AS j_kb_dstspl,
					sum(if(keberadaan_brg='Dikuasai secara tidak sah pihak lain',nilai,0)) AS n_kb_dstspl,
					sum(if(kondisi_brg='B',jumlah,0)) AS j_k_b,
					sum(if(kondisi_brg='B',nilai,0)) AS n_k_b,
					sum(if(kondisi_brg='KB',jumlah,0)) AS j_k_kb,
					sum(if(kondisi_brg='KB',nilai,0)) AS n_k_kb,
					sum(if(kondisi_brg='RB',jumlah,0)) AS j_k_rb,
					sum(if(kondisi_brg='RB',nilai,0)) AS n_k_rb,
					SUM(IF(stat_hukum='Tidak Dalam Gugatan Hukum',jumlah,0)) AS j_ph_tdgh,
					SUM(IF(stat_hukum='Tidak Dalam Gugatan Hukum',nilai,0)) AS n_ph_tdgh,
					SUM(IF(stat_hukum='Dalam Gugatan Hukum',jumlah,0)) AS j_ph_dgh,
					SUM(IF(stat_hukum='Dalam Gugatan Hukum',nilai,0)) AS n_ph_dgh,
					sum(if(bukti_milik='Ada',jumlah,0)) AS j_bk_a,
					sum(if(bukti_milik='Ada',nilai,0)) AS n_bk_a,
					sum(if(bukti_milik='Tidak Ada',jumlah,0)) AS j_bk_ta,
					sum(if(bukti_milik='Tidak Ada',nilai,0)) AS n_bk_ta,
					sum(if(status_milik='Milik Pemerintah Pusat',jumlah,0)) AS j_sk_mpp,
					sum(if(status_milik='Milik Pemerintah Pusat',nilai,0)) AS n_sk_mpp,
					sum(if(status_milik='Milik Pihak Lain Non Pemerintah',jumlah,0)) AS j_sk_mplnp,
					sum(if(status_milik='Milik Pihak Lain Non Pemerintah',nilai,0)) AS n_sk_mplnp,
					sum(if(status_milik='Milik Pemerintah Kota Makassar',jumlah,0)) AS j_sk_mpkm,
					sum(if(status_milik='Milik Pemerintah Kota Makassar',nilai,0)) AS n_sk_mpkm,
					sum(if(ket_brg='Hilang',jumlah,0)) AS j_k_h,
					sum(if(ket_brg='Hilang',nilai,0)) AS n_k_h,
					sum(if(ket_brg='Tidak Diketahui Keberadaannya',jumlah,0)) AS j_k_tdk,
					sum(if(ket_brg='Tidak Diketahui Keberadaannya',nilai,0)) AS n_k_tdk,
					sum(if(ket_brg='Habis Akibat Usia Barang',jumlah,0)) AS j_k_baub,
					sum(if(ket_brg='Habis Akibat Usia Barang',nilai,0)) AS n_k_baub,
					sum(if(ket_brg='Seharusnya Telah dihapus',jumlah,0)) AS j_k_std,
					sum(if(ket_brg='Seharusnya Telah dihapus',nilai,0)) AS n_k_std,
					sum(if(ket_brg='Double Catat',jumlah,0)) AS j_k_dc,
					sum(if(ket_brg='Double Catat',nilai,0)) AS n_k_dc,
					sum(if(ket_brg='Koreksi BHP',jumlah,0)) AS j_k_kbhp,
					sum(if(ket_brg='Koreksi BHP',nilai,0)) AS n_k_kbhp
				from (

					Select
					kd_skpd,
					kd_unit,
					'1' AS jumlah,
					status,
					
					keberadaan_brg,
					kondisi_brg,
					stat_hukum,
					bukti_milik,
					status_milik,
					ket_brg,
					(IFNULL(a.nilai,0)+IFNULL(b.nilai,0)) AS nilai
					FROM trkib_a a
					LEFT JOIN
					(SELECT SUM(IFNULL(nilai,0)) AS nilai,id_barang FROM trkib_a_kap $where2 )b
					ON a.id_barang = b.id_barang
					$where
					
					UNION ALL
					
					Select
					kd_skpd,
					kd_unit,
					'1' AS jumlah,
					status,
					
					keberadaan_brg,
					kondisi_brg,
					stat_hukum,
					bukti_milik,
					status_milik,
					ket_brg,
					(IFNULL(a.nilai,0)+IFNULL(b.nilai,0)) AS nilai
					FROM trkib_b a
					LEFT JOIN
					(SELECT SUM(IFNULL(nilai,0)) AS nilai,id_barang FROM trkib_a_kap $where2 )b
					ON a.id_barang = b.id_barang
					$where
					
					UNION ALL
					
					Select
					kd_skpd,
					kd_unit,
					'1' AS jumlah,
					status,
					
					keberadaan_brg,
					kondisi_brg,
					stat_hukum,
					bukti_milik,
					status_milik,
					ket_brg,
					(IFNULL(a.nilai,0)+IFNULL(b.nilai,0)) AS nilai
					FROM trkib_c a
					LEFT JOIN
					(SELECT SUM(IFNULL(nilai,0)) AS nilai,id_barang FROM trkib_a_kap $where2 )b
					ON a.id_barang = b.id_barang
					$where
					
					UNION ALL
					
					Select
					kd_skpd,
					kd_unit,
					'1' AS jumlah,
					status,
					
					keberadaan_brg,
					kondisi_brg,
					stat_hukum,
					bukti_milik,
					status_milik,
					ket_brg,
					(IFNULL(a.nilai,0)+IFNULL(b.nilai,0)) AS nilai
					FROM trkib_d a
					LEFT JOIN
					(SELECT SUM(IFNULL(nilai,0)) AS nilai,id_barang FROM trkib_a_kap $where2 )b
					ON a.id_barang = b.id_barang
					$where
					
					UNION ALL
					
					Select
					kd_skpd,
					kd_unit,
					'1' AS jumlah,
					status,
					
					keberadaan_brg,
					kondisi_brg,
					stat_hukum,
					bukti_milik,
					status_milik,
					ket_brg,
					(IFNULL(a.nilai,0)+IFNULL(b.nilai,0)) AS nilai
					FROM trkib_e a
					LEFT JOIN
					(SELECT SUM(IFNULL(nilai,0)) AS nilai,id_barang FROM trkib_a_kap $where2 )b
					ON a.id_barang = b.id_barang
					$where
					
					UNION ALL
					
					Select
					kd_skpd,
					kd_unit,
					'1' AS jumlah,
					status,
					
					keberadaan_brg,
					kondisi_brg,
					stat_hukum,
					bukti_milik,
					status_milik,
					ket_brg,
					IFNULL(a.nilai,0) AS nilai
					FROM trkib_f a
					$where

				)z $group
		";

		$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px; font-weight:bold;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td align=\"center\" colspan=\"44\">REKAPITULASI HASIL VALIDASI BMD MILIK DAERAH</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">PEMERINTAH KOTA MAKASSAR</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">TAHUN ANGGARAN 2019</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">PER TANGGAL ".strtoupper($tgl)."</td>
					</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead>
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"4\">NO</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"4\">SKPD/UNIT KERJA</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\" colspan=\"2\">BELUM SENSUS</th>
						<th valign=\"midle\" align=\"center\" rowspan=\"3\" colspan=\"2\">SUDAH SENSUS</th>
						<th valign=\"midle\" align=\"center\" colspan=\"26\">FISIK BARANG ADA</th>
						<th valign=\"midle\" align=\"center\" colspan=\"12\">FISIK BARANG TIDAK ADA</th>
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\" colspan=\"6\">KEBERADAAN BARANG</th>
						<th valign=\"midle\" align=\"center\" colspan=\"6\">KONDISI</th>
						<th valign=\"midle\" align=\"center\" colspan=\"4\">PERMASALAHAN HUKUM</th>
						<th valign=\"midle\" align=\"center\" colspan=\"4\">BUKTI KEPEMILIKAN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"6\">STATUS KEPEMILIKAN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"12\">KETERANGAN</th>
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">SKPD</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">DIKERJASAMAKAN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">DIKUASAI TIDAK SAH PIHAK LAIN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">B</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">KB</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">RB</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">TIDAK DLM GUGATAN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">DALAM GUGATAN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">ADA</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">TIDAK ADA</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">PEMKOT MKSR</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">PEMDA LAIN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">NON PEMERINTAH</th>

						<th valign=\"midle\" align=\"center\" colspan=\"2\">KECURIAN</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">TDK DIKETAHUI</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">HABIS KARENA SEBAB WAJAR</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">HARUSNYA SDH DIHAPUS</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">LEBIH CATAT</th>
						<th valign=\"midle\" align=\"center\" colspan=\"2\">KOREKSI BHP</th>
					</tr>
					<tr>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
						<th valign=\"midle\" align=\"center\">JUMLAH</th>
						<th valign=\"midle\" align=\"center\">NILAI</th>
					</tr>
				</thead>
				<tbody>";
				$no           =1;
				$j_non_sensus ='';
				$n_non_sensus ='';
				$j_sensus     ='';
				$n_sensus     ='';
				$j_kb_skpd    ='';
				$n_kb_skpd    ='';
				$j_kb_kdpl    ='';
				$n_kb_kdpl    ='';
				$j_kb_dstspl  ='';
				$n_kb_dstspl  ='';
				$j_k_b        ='';
				$n_k_b        ='';
				$j_k_kb       ='';
				$n_k_kb       ='';
				$j_k_rb       ='';
				$n_k_rb       ='';
				$j_ph_tdgh    ='';
				$n_ph_tdgh    ='';
				$j_ph_dgh     ='';
				$n_ph_dgh     ='';
				$j_bk_a       ='';
				$n_bk_a       ='';
				$j_bk_ta      ='';
				$n_bk_ta      ='';
				$j_sk_mpp     ='';
				$n_sk_mpp     ='';
				$j_sk_mplnp   ='';
				$n_sk_mplnp   ='';
				$j_sk_mpkm    ='';
				$n_sk_mpkm    ='';
				$j_k_h        ='';
				$n_k_h        ='';
				$j_k_tdk      ='';
				$n_k_tdk      ='';
				$j_k_baub     ='';
				$n_k_baub     ='';
				$j_k_std      ='';
				$n_k_std      ='';
				$j_k_dc       ='';
				$n_k_dc       ='';
				$j_k_kbhp     ='';
				$n_k_kbhp     ='';
				$query = $this->db->query($sql);
				foreach ($query->result() as $row) {
			 $cRet.="<tr>
						<td valign=\"top\" align=\"left\" >$no</td>";
			if ($kd_skpd!='' || $kd_skpd!=null) {
			 	$cRet.="	<td valign=\"top\" align=\"left\" >".$this->nm_unit($row->kd_unit)."</td>";
			}else{
				$cRet.="	<td valign=\"top\" align=\"left\" >".$this->nm_skpd($row->kd_skpd)."</td>";
			}

			 $cRet.="   <td valign=\"top\" align=\"left\" >$row->j_non_sensus</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_non_sensus,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_sensus</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_sensus,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_kb_skpd</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_kb_skpd,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_kb_kdpl</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_kb_kdpl,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_kb_dstspl</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_kb_dstspl,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_b</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_b,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_kb</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_kb,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_rb</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_rb,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_ph_tdgh</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_ph_tdgh,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_ph_dgh</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_ph_dgh,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_bk_a</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_bk_a,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_bk_ta</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_bk_ta,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_sk_mpp</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_sk_mpp,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_sk_mplnp</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_sk_mplnp,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_sk_mpkm</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_sk_mpkm,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_h</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_h,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_tdk</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_tdk,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_baub</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_baub,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_std</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_std,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_dc</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_dc,2)."</td>
						<td valign=\"top\" align=\"left\" >$row->j_k_kbhp</td>
						<td valign=\"top\" align=\"right\">".number_format($row->n_k_kbhp,2)."</td>
					</tr>";
					$no++;
					$j_non_sensus =$j_non_sensus+$row->j_non_sensus;
					$n_non_sensus =$n_non_sensus+$row->n_non_sensus;
					$j_sensus     =$j_sensus+$row->j_sensus;
					$n_sensus     =$n_sensus+$row->n_sensus;
					$j_kb_skpd    =$j_kb_skpd+$row->j_kb_skpd;
					$n_kb_skpd    =$n_kb_skpd+$row->n_kb_skpd;
					$j_kb_kdpl    =$j_kb_kdpl+$row->j_kb_kdpl;
					$n_kb_kdpl    =$n_kb_kdpl+$row->n_kb_kdpl;
					$j_kb_dstspl  =$j_kb_dstspl+$row->j_kb_dstspl;
					$n_kb_dstspl  =$n_kb_dstspl+$row->n_kb_dstspl;
					$j_k_b        =$j_k_b+$row->j_k_b;
					$n_k_b        =$n_k_b+$row->n_k_b;
					$j_k_kb       =$j_k_kb+$row->j_k_kb;
					$n_k_kb       =$n_k_kb+$row->n_k_kb;
					$j_k_rb       =$j_k_rb+$row->j_k_rb;
					$n_k_rb       =$n_k_rb+$row->n_k_rb;
					$j_ph_tdgh    =$j_ph_tdgh+$row->j_ph_tdgh;
					$n_ph_tdgh    =$n_ph_tdgh+$row->n_ph_tdgh;
					$j_ph_dgh     =$j_ph_dgh+$row->j_ph_dgh;
					$n_ph_dgh     =$n_ph_dgh+$row->n_ph_dgh;
					$j_bk_a       =$j_bk_a+$row->j_bk_a;
					$n_bk_a       =$n_bk_a+$row->n_bk_a;
					$j_bk_ta      =$j_bk_ta+$row->j_bk_ta;
					$n_bk_ta      =$n_bk_ta+$row->n_bk_ta;
					$j_sk_mpp     =$j_sk_mpp+$row->j_sk_mpp;
					$n_sk_mpp     =$n_sk_mpp+$row->n_sk_mpp;
					$j_sk_mplnp   =$j_sk_mplnp+$row->j_sk_mplnp;
					$n_sk_mplnp   =$n_sk_mplnp+$row->n_sk_mplnp;
					$j_sk_mpkm    =$j_sk_mpkm+$row->j_sk_mpkm;
					$n_sk_mpkm    =$n_sk_mpkm+$row->n_sk_mpkm;
					$j_k_h        =$j_k_h+$row->j_k_h;
					$n_k_h        =$n_k_h+$row->n_k_h;
					$j_k_tdk      =$j_k_tdk+$row->j_k_tdk;
					$n_k_tdk      =$n_k_tdk+$row->n_k_tdk;
					$j_k_baub     =$j_k_baub+$row->j_k_baub;
					$n_k_baub     =$n_k_baub+$row->n_k_baub;
					$j_k_std      =$j_k_std+$row->j_k_std;
					$n_k_std      =$n_k_std+$row->n_k_std;
					$j_k_dc       =$j_k_dc+$row->j_k_dc;
					$n_k_dc       =$n_k_dc+$row->n_k_dc;
					$j_k_kbhp     =$j_k_kbhp+$row->j_k_kbhp;
					$n_k_kbhp     =$n_k_kbhp+$row->n_k_kbhp;

				}
				$cRet.="<tr style='background-color:yellow; font-weight:bold;'>
						<td valign=\"top\" align=\"center\" colspan=\"2\">JUMLAH</td>
						<td valign=\"top\" align=\"left\" >".$j_non_sensus."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_non_sensus,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_sensus."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_sensus,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_kb_skpd."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_kb_skpd,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_kb_kdpl."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_kb_kdpl,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_kb_dstspl."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_kb_dstspl,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_b."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_b,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_kb."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_kb,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_rb."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_rb,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_ph_tdgh."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_ph_tdgh,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_ph_dgh."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_ph_dgh,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_bk_a."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_bk_a,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_bk_ta."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_bk_ta,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_sk_mpp."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_sk_mpp,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_sk_mplnp."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_sk_mplnp,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_sk_mpkm."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_sk_mpkm,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_h."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_h,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_tdk."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_tdk,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_baub."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_baub,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_std."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_std,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_dc."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_dc,2)."</td>
						<td valign=\"top\" align=\"left\" >".$j_k_kbhp."</td>
						<td valign=\"top\" align=\"right\">".number_format($n_k_kbhp,2)."</td>
					</tr>";

		$cRet.="</tbody>
			</table>";

			

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

	function rekap_review(){
		$cetak      = $_REQUEST['cetak'];
		$mengetahui = ($_REQUEST['mengetahui']=='-PILIH-') ? '':$_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = ($_REQUEST['pengurus']=='-PILIH-') ? '':$_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$pertgl		= date('Y-m-d',strtotime($_REQUEST['tgl']));
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
		$cRet ="";

		$sql = "
		SELECT
			ket_sensus,
			COALESCE(s_a,0) AS s_a,
			COALESCE(d_a,0) AS d_a,
			COALESCE(k_a,0) AS k_a,
			COALESCE(b_a,0) AS b_a,
			COALESCE(s_b,0) AS s_b,
			COALESCE(d_b,0) AS d_b,
			COALESCE(k_b,0) AS k_b,
			COALESCE(b_b,0) AS b_b,
			COALESCE(s_c,0) AS s_c,
			COALESCE(d_c,0) AS d_c,
			COALESCE(k_c,0) AS k_c,
			COALESCE(b_c,0) AS b_c,
			COALESCE(s_d,0) AS s_d,
			COALESCE(d_d,0) AS d_d,
			COALESCE(k_d,0) AS k_d,
			COALESCE(b_d,0) AS b_d,
			COALESCE(s_e,0) AS s_e,
			COALESCE(d_e,0) AS d_e,
			COALESCE(k_e,0) AS k_e,
			COALESCE(b_e,0) AS b_e,
			COALESCE(s_f,0) AS s_f,
			COALESCE(d_f,0) AS d_f,
			COALESCE(k_f,0) AS k_f,
			COALESCE(b_f,0) AS b_f,
			(
				COALESCE(s_a,0) +
				COALESCE(s_b,0) +
				COALESCE(s_c,0) +
				COALESCE(s_d,0) +
				COALESCE(s_e,0) +
				COALESCE(s_f,0)
			)s_tot,
			(
				COALESCE(d_a,0) +
				COALESCE(d_b,0) +
				COALESCE(d_c,0) +
				COALESCE(d_d,0) +
				COALESCE(d_e,0) +
				COALESCE(d_f,0)
			)d_tot,
			(
				COALESCE(k_a,0) +
				COALESCE(k_b,0) +
				COALESCE(k_c,0) +
				COALESCE(k_d,0) +
				COALESCE(k_e,0) +
				COALESCE(k_f,0)
			)k_tot,
			(
				COALESCE(b_a,0) +
				COALESCE(b_b,0) +
				COALESCE(b_c,0) +
				COALESCE(b_d,0) +
				COALESCE(b_e,0) +
				COALESCE(b_f,0)
			)b_tot
			from ket_sensus z
			left join(
				select
				kd_unit,
				keberadaan_brg,
				ket_brg,
				COUNT(CASE WHEN STATUS='1' THEN id_barang END)AS s_a,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN id_barang END)AS d_a,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN
				(CASE WHEN stat_fisik='1' THEN
				(CASE WHEN keberadaan_brg<>keberadaan_brg2 OR kondisi_brg<>kondisi_brg2 THEN id_barang END) ELSE
				(CASE WHEN ket_brg<>ket_brg2 THEN id_barang END) 
				END)END)AS k_a,
				COUNT(CASE WHEN keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN id_barang END)AS b_a
				FROM trkib_a
				WHERE kd_unit='$kd_unit'
				GROUP BY kd_unit,keberadaan_brg,ket_brg
			)a on z.`ket_sensus`=a.keberadaan_brg OR z.ket_sensus=a.ket_brg
			LEFT JOIN(
				SELECT
				kd_unit,
				keberadaan_brg,
				ket_brg,
				COUNT(CASE WHEN STATUS='1' THEN id_barang END)AS s_b,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN id_barang END)AS d_b,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN
				(CASE WHEN stat_fisik='1' THEN
				(CASE WHEN keberadaan_brg<>keberadaan_brg2 OR kondisi_brg<>kondisi_brg2 THEN id_barang END) ELSE
				(CASE WHEN ket_brg<>ket_brg2 THEN id_barang END) 
				END)END)AS k_b,
				COUNT(CASE WHEN keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN id_barang END)AS b_b
				FROM trkib_b
				WHERE kd_unit='$kd_unit'
				GROUP BY kd_unit,keberadaan_brg,ket_brg
			)b ON z.`ket_sensus`=b.keberadaan_brg OR z.ket_sensus=b.ket_brg
			LEFT JOIN(
				SELECT
				kd_unit,
				keberadaan_brg,
				ket_brg,
				COUNT(CASE WHEN STATUS='1' THEN id_barang END)AS s_c,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN id_barang END)AS d_c,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN
				(CASE WHEN stat_fisik='1' THEN
				(CASE WHEN keberadaan_brg<>keberadaan_brg2 OR kondisi_brg<>kondisi_brg2 THEN id_barang END) ELSE
				(CASE WHEN ket_brg<>ket_brg2 THEN id_barang END) 
				END)END)AS k_c,
				COUNT(CASE WHEN keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN id_barang END)AS b_c
				FROM trkib_c
				WHERE kd_unit='$kd_unit'
				GROUP BY kd_unit,keberadaan_brg,ket_brg
			)c ON z.`ket_sensus`=c.keberadaan_brg OR z.ket_sensus=c.ket_brg
			LEFT JOIN(
				SELECT
				kd_unit,
				keberadaan_brg,
				ket_brg,
				COUNT(CASE WHEN STATUS='1' THEN id_barang END)AS s_d,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN id_barang END)AS d_d,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN
				(CASE WHEN stat_fisik='1' THEN
				(CASE WHEN keberadaan_brg<>keberadaan_brg2 OR kondisi_brg<>kondisi_brg2 THEN id_barang END) ELSE
				(CASE WHEN ket_brg<>ket_brg2 THEN id_barang END) 
				END)END)AS k_d,
				COUNT(CASE WHEN keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN id_barang END)AS b_d
				FROM trkib_d
				WHERE kd_unit='$kd_unit'
				GROUP BY kd_unit,keberadaan_brg,ket_brg
			)d ON z.`ket_sensus`=d.keberadaan_brg OR z.ket_sensus=d.ket_brg
			LEFT JOIN(
				SELECT
				kd_unit,
				keberadaan_brg,
				ket_brg,
				COUNT(CASE WHEN STATUS='1' THEN id_barang END)AS s_e,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN id_barang END)AS d_e,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN
				(CASE WHEN stat_fisik='1' THEN
				(CASE WHEN keberadaan_brg<>keberadaan_brg2 OR kondisi_brg<>kondisi_brg2 THEN id_barang END) ELSE
				(CASE WHEN ket_brg<>ket_brg2 THEN id_barang END) 
				END)END)AS k_e,
				COUNT(CASE WHEN keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN id_barang END)AS b_e
				FROM trkib_e
				WHERE kd_unit='$kd_unit'
				GROUP BY kd_unit,keberadaan_brg,ket_brg
			)e ON z.`ket_sensus`=e.keberadaan_brg OR z.ket_sensus=e.ket_brg
			LEFT JOIN(
				SELECT
				kd_unit,
				keberadaan_brg,
				ket_brg,
				COUNT(CASE WHEN STATUS='1' THEN id_barang END)AS s_f,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN id_barang END)AS d_f,
				COUNT(CASE WHEN (keberadaan_brg2<>'' AND kondisi_brg2<>'') OR ket_brg2<>'' THEN
				(CASE WHEN stat_fisik='1' THEN
				(CASE WHEN keberadaan_brg<>keberadaan_brg2 OR kondisi_brg<>kondisi_brg2 THEN id_barang END) ELSE
				(CASE WHEN ket_brg<>ket_brg2 THEN id_barang END) 
				END)END)AS k_f,
				COUNT(CASE WHEN keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN id_barang END)AS b_f
				FROM trkib_f
				WHERE kd_unit='$kd_unit'
				GROUP BY kd_unit,keberadaan_brg,ket_brg
			)f ON z.`ket_sensus`=f.keberadaan_brg OR z.ket_sensus=f.ket_brg
			order by z.id asc
		";
		$res = $this->db->query($sql);

		$cRet .="
			<table style=\"border-collapse:collapse; font-size:14px; font-weight:bold;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
					<tr>
						<td align=\"center\" colspan=\"44\">REKAPITULASI REVIEW VALIDASI BMD MILIK DAERAH</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">PEMERINTAH KOTA MAKASSAR</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">".strtoupper($this->nm_unit($kd_unit))."</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">TAHUN ANGGARAN 2019</td>
					</tr>
					<tr>
						<td align=\"center\" colspan=\"44\">PER TANGGAL ".strtoupper($tgl)."</td>
					</tr>
			</table>
			<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">
				<thead bgcolor=\"#d8d8d8\">
					<tr>
						<th valign=\"midle\" align=\"center\" rowspan=\"2\">URAIAN</th>";
						$kib_text = array('KIB A','KIB B','KIB C','KIB D','KIB E','KIB F','TOTAL');
						for ($i=0; $i < 7; $i++) { 
						$cRet.="<th valign=\"midle\" align=\"center\" colspan=\"4\">$kib_text[$i]</th>";
						}
			$cRet.="</tr>
					<tr>";
						for ($i=0; $i < 7; $i++) { 
							$cRet.="
							<th valign=\"midle\" align=\"center\">Sensus</th>
							<th valign=\"midle\" align=\"center\">Direview</th>
							<th valign=\"midle\" align=\"center\">Koreksi</th>
							<th valign=\"midle\" align=\"center\">Belum Review</th>";
						}

			$cRet.="</tr>
				</thead>
				<tbody>";
					$field = array('a','b','c','d','e','f','tot');
					$jum   = array();
					for ($i=0; $i < 7; $i++) { 
						$jum['s_tot_'.$field[$i]]='';
						$jum['d_tot_'.$field[$i]]='';
						$jum['k_tot_'.$field[$i]]='';
						$jum['b_tot_'.$field[$i]]='';
					}
					foreach ($res->result_array() as $row) {
						for ($i=0; $i < 7; $i++) { 
							$jum['s_tot_'.$field[$i]]=$jum['s_tot_'.$field[$i]] + $row['s_'.$field[$i]];
							$jum['d_tot_'.$field[$i]]=$jum['d_tot_'.$field[$i]] + $row['d_'.$field[$i]];
							$jum['k_tot_'.$field[$i]]=$jum['k_tot_'.$field[$i]] + $row['k_'.$field[$i]];
							$jum['b_tot_'.$field[$i]]=$jum['b_tot_'.$field[$i]] + $row['b_'.$field[$i]];
						}
						$cRet.="<tr>
									<td valign=\"top\">$row[ket_sensus]</td>";
								for ($i=0; $i < 7; $i++) { 
									$cRet.="
									<td valign=\"top\" align=\"center\">".$row['s_'.$field[$i]]."</td>
									<td valign=\"top\" align=\"center\">".$row['d_'.$field[$i]]."</td>
									<td valign=\"top\" align=\"center\">".$row['k_'.$field[$i]]."</td>
									<td valign=\"top\" align=\"center\">".$row['b_'.$field[$i]]."</td>";
								}

						$cRet.="
							</tr>";
					}
					$cRet.="<tr bgcolor=\"#d8d8d8\">
									<td valign=\"top\" align=\"center\">TOTAL</td>";
								for ($i=0; $i < 7; $i++) { 
									$cRet.="
									<td valign=\"top\" align=\"center\"><b>".$jum['s_tot_'.$field[$i]]."</b></td>
									<td valign=\"top\" align=\"center\"><b>".$jum['d_tot_'.$field[$i]]."</b></td>
									<td valign=\"top\" align=\"center\"><b>".$jum['k_tot_'.$field[$i]]."</b></td>
									<td valign=\"top\" align=\"center\"><b>".$jum['b_tot_'.$field[$i]]."</b></td>";
								}

						$cRet.="
							</tr>";
		$cRet.="</tbody>
			</table>";

			

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

	function nm_unit($kd_unit){
		$query = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row('nm_lokasi');
		return $query;
	}
	function nm_skpd($kd_skpd){
		$query = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row('nm_skpd');
		return $query;
	}

	function cetak_lap_penetapan(){
		ini_set("memory_limit","-1");
		ini_set("max_execution_time","-1");
		$cetak      = $_REQUEST['cetak'];
		$kd_skpd    = $this->input->get('kd_skpd');
		$kd_unit    = $this->input->get('kd_unit');
		$tmrg       = $_REQUEST['tmrg'];
		$bmrg       = $_REQUEST['bmrg'];
		$lmrg       = $_REQUEST['lmrg'];
		$rmrg       = $_REQUEST['rmrg'];
		$hmrg       = $_REQUEST['hmrg'];
		$fmrg       = $_REQUEST['fmrg'];
		$t_baris    = $_REQUEST['t_baris'];
		$orien      = $_REQUEST['orien'];
		$tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$mengetahui = $_REQUEST['mengetahui'];
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = $_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$html       = "";

		if ($kd_skpd<>'') {
			$where_skpd = "AND kd_skpd='".$kd_skpd."'";
		}else{
			$where_skpd = "";
		}

		if ($kd_unit<>'') {
			$where_unit = "AND kd_unit='".$kd_unit."'";
		}else{
			$where_unit = "";
		}

		$html .="
		<style>
			.border-collapse {
				border-collapse:collapse;
			}
			.fw {
				font-weight:bold;
			}
			.highlight {
				background-color:#c9c5c5;
				font-weight: bold;
			}
			.highlight_green {
			    background-color:#7fff74;
			    font-weight: bold;
			}
			.w-100 {
				width:100%;
			}
			.xl65 {
				mso-style-parent:style0;
				mso-number-format:000000;
			}
			.nowrap {
				white-space: nowrap;
			}
		</style>
		<table class=\"border-collapse w-100\">
			<tr class=\"fw\">
				<td rowspan=\"3\" colspan=\"2\"><img src='".base_url('assets/images/logo3.png')."'></td>
				<td colspan=\"15\" align=\"center\">DAFTAR HASIL INVENTARISASI BARANG MILIK DAERAH</td>
				<td rowspan=\"3\" colspan=\"2\"><img src='".base_url('assets/images/logo4.png')."'></td>
			</tr>
			<tr class=\"fw\">
				<td colspan=\"15\" align=\"center\">PEMERINTAH KOTA MAKASSAR</td>
			</tr>
			<tr class=\"fw\">
				<td colspan=\"15\" align=\"center\">TAHUN ANGGARAN 2019<BR><BR></td>
			</tr>
			<tr>
				<td></td>
				<td>SKPD</td>
				<td colspan=\"17\">:".strtoupper($this->nm_skpd($kd_skpd))."</td>
			</tr>";
			if ($kd_unit<>'') {
			$html .="
			<tr>
				<td></td>
				<td>UPB</td>
				<td colspan=\"17\">:".strtoupper($this->nm_unit($kd_unit))."</td>
			</tr>";
			}
		$html .="
		</table>
		<table class=\"border-collapse w-100\" border=\"1\">
			<thead>	
				<tr class=\"highlight_green\">
					<td class=\"nowrap\" align=\"center\" >No</td>
					<td class=\"nowrap\" align=\"center\" >Kode Barang</td>
					<td class=\"nowrap\" align=\"center\" >Register</td>
					<td class=\"nowrap\" align=\"center\" >Kode<br>Sensus</td>
					<td class=\"nowrap\" align=\"center\" >Nama/Jenis Barang</td>
					<td class=\"nowrap\" align=\"center\" >Merek/Tipe</td>
					<td class=\"nowrap\" align=\"center\" >Sertifikat/Pabrik/Rangka/<br>Mesin/No.Polisi</td>
					<td class=\"nowrap\" align=\"center\" >Bahan</td>
					<td class=\"nowrap\" align=\"center\" >Asal/cara<br>Perolehan</td>
					<td class=\"nowrap\" align=\"center\" >Tahun<br>Perolehan</td>
					<td class=\"nowrap\" align=\"center\" >Ukuran Barang/<br>Konstruksi PSD</td>
					<td class=\"nowrap\" align=\"center\" >Satuan</td>
					<td class=\"nowrap\" align=\"center\" >Kondisi</td>
					<td class=\"nowrap\" align=\"center\" >Harga Brg</td>
					<td class=\"nowrap\" align=\"center\" >Keterangan</td>
					<td class=\"nowrap\" align=\"center\" >Hasil Inventarisasi</td>
					<td class=\"nowrap\" align=\"center\" >Catatan</td>
					<td class=\"nowrap\" align=\"center\" >Status Neraca</td>
				</tr>
				<tr>";
				for ($i=1; $i <= 18; $i++) { 
				$html .="<th>$i</th>";
				}
			$html .="
				</tr>
				<tr>";
				for ($i=1; $i <= 18; $i++) { 
				$html .="<th>&nbsp;</th>";
				}
			$html .="
				</tr>
			</thead>
			<tbody>";
			$status_aset_akhir = "
			(CASE
			WHEN
			#Cek Kondisi B/KB
			((case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end)='B'
			 or 
			(case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end)='KB')
			AND 
			#Cek Keberadaan SKPD-Digunakan
			(CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL AND (ket_brg2='' or ket_brg2 is null) THEN keberadaan_brg2 END)='SKPD'
			THEN 'Aset Tetap'
			else 'Aset Lainnya' END)
			";
			$sql = "SELECT nor,kol_2,kol_3,kol_4,kol_5,kol_5a,kol_6,kol_7,kol_8,kol_9,kol_10,kol_11,kol_12,kol_13,sum(kol_14)kol_14,sum(kol_15)kol_15,kol_16,kol_17,kol_18,kol_19 from (
						SELECT '1' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET TETAP' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_a_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_a b WHERE id_lama='Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
						union all
						SELECT '1' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET TETAP' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_b_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_b b WHERE id_lama='Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
						UNION ALL
						SELECT '1' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET TETAP' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_c_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_c b WHERE id_lama='Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
						UNION ALL
						SELECT '1' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET TETAP' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_d_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_d b WHERE id_lama='Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
						UNION ALL
						SELECT '1' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET TETAP' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_e_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_e b WHERE id_lama='Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
						UNION ALL
						SELECT '1' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET TETAP' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_f WHERE id_lama='Aset Tetap' $where_skpd $where_unit
					)ttp_sub
					UNION ALL
					select * from (
						SELECT '1a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, (CASE WHEN no_sertifikat2 IS NOT NULL THEN no_sertifikat2 ELSE no_sertifikat END) kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN luas2 IS NOT NULL THEN luas2 ELSE luas END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_a_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_a b WHERE id_lama='Aset Tetap' $where_skpd $where_unit
						union all
						SELECT '1a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when merek2 IS NOT NULL THEN merek2 ELSE merek end) AS kol_6, concat(pabrik2,'/',no_rangka2,'/',no_mesin2,'/',no_polisi2) kol_7, kd_bahan AS kol_8, concat(asal,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, (CASE WHEN silinder2 IS NOT NULL THEN silinder2 ELSE silinder END)kol_11, kd_satuan AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_b_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_b b WHERE id_lama='Aset Tetap' $where_skpd $where_unit
						union all
						SELECT '1a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when jenis_gedung2 is not null then jenis_gedung2 else jenis_gedung end) AS kol_6, (CASE WHEN no_dok2 IS NOT NULL THEN no_dok2 ELSE no_dok END) as kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi3 IS NOT NULL THEN konstruksi3 ELSE konstruksi2 END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_c_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_c b WHERE id_lama='Aset Tetap' $where_skpd $where_unit
						union all
						SELECT '1a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, (CASE WHEN no_dok2 IS NOT NULL THEN no_dok2 ELSE no_dok END) AS kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi2 IS NOT NULL THEN konstruksi2 ELSE konstruksi END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_d_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_d b WHERE id_lama='Aset Tetap' $where_skpd $where_unit
						union all
						SELECT '1a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when tipe2 is not null then tipe2 else tipe end) AS kol_6, (case when spesifikasi2 is not null then spesifikasi2 else spesifikasi end) kol_7, (case when kd_bahan2 is not null then kd_bahan2 else kd_bahan end) AS kol_8, concat(peroleh,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, '' as kol_11, kd_satuan AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_e_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_e b WHERE id_lama='Aset Tetap' $where_skpd $where_unit
						union all
						SELECT '1a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, '' as kol_7, '' AS kol_8, concat(asal,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi2 IS NOT NULL THEN konstruksi2 ELSE konstruksi END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, nilai AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_f WHERE id_lama='Aset Tetap' $where_skpd $where_unit
					)ttp_detail
					union all
					select nor,kol_2,kol_3,kol_4,kol_5,kol_5a,kol_6,kol_7,kol_8,kol_9,kol_10,kol_11,kol_12,kol_13,sum(kol_14)kol_14,sum(kol_15)kol_15,kol_16,kol_17,kol_18,kol_19 from (
						SELECT '2' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET LAINNYA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_a_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_a b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit  GROUP BY id_barang
						union all
						SELECT '2' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET LAINNYA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_b_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_b b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '2' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET LAINNYA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_c_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_c b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '2' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET LAINNYA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_d_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_d b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '2' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET LAINNYA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_e_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_e b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '2' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ASET LAINNYA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_f WHERE id_lama='Aset Lainnya' $where_skpd $where_unit 
					)lainnya_sub
					UNION ALL
					select * from (
						SELECT '2a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, (CASE WHEN no_sertifikat2 IS NOT NULL THEN no_sertifikat2 ELSE no_sertifikat END) kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN luas2 IS NOT NULL THEN luas2 ELSE luas END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_a_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_a b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit
						union all
						SELECT '2a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when merek2 IS NOT NULL THEN merek2 ELSE merek end) AS kol_6, concat(pabrik2,'/',no_rangka2,'/',no_mesin2,'/',no_polisi2) kol_7, kd_bahan AS kol_8, concat(asal,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, (CASE WHEN silinder2 IS NOT NULL THEN silinder2 ELSE silinder END)kol_11, kd_satuan AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_b_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_b b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit
						union all
						SELECT '2a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when jenis_gedung2 is not null then jenis_gedung2 else jenis_gedung end) AS kol_6, (CASE WHEN no_dok2 IS NOT NULL THEN no_dok2 ELSE no_dok END) as kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi3 IS NOT NULL THEN konstruksi3 ELSE konstruksi2 END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_c_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_c b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit
						union all
						SELECT '2a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, (CASE WHEN no_dok2 IS NOT NULL THEN no_dok2 ELSE no_dok END) AS kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi2 IS NOT NULL THEN konstruksi2 ELSE konstruksi END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_d_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_d b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit
						union all
						SELECT '2a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when tipe2 is not null then tipe2 else tipe end) AS kol_6, (case when spesifikasi2 is not null then spesifikasi2 else spesifikasi end) kol_7, (case when kd_bahan2 is not null then kd_bahan2 else kd_bahan end) AS kol_8, concat(peroleh,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, '' as kol_11, kd_satuan AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_e_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_e b WHERE id_lama='Aset Lainnya' $where_skpd $where_unit
						union all
						SELECT '2a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, '' as kol_7, '' AS kol_8, concat(asal,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi2 IS NOT NULL THEN konstruksi2 ELSE konstruksi END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, nilai AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, $status_aset_akhir as kol_19 FROM trkib_f WHERE id_lama='Aset Lainnya' $where_skpd $where_unit
					)lainnya_detail
					UNION ALL
					SELECT nor,kol_2,kol_3,kol_4,kol_5,kol_5a,kol_6,kol_7,kol_8,kol_9,kol_10,kol_11,kol_12,kol_13,sum(kol_14)kol_14,SUM(kol_15)kol_15,kol_16,kol_17,kol_18,kol_19 FROM (
						SELECT '3' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ECA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL((SELECT IFNULL(SUM(nilai),0) from trkib_a_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_a b WHERE id_lama='Eca' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '3' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ECA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL((SELECT IFNULL(SUM(nilai),0) from trkib_b_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_b b WHERE id_lama='Eca' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '3' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ECA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL((SELECT IFNULL(SUM(nilai),0) from trkib_c_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_c b WHERE id_lama='Eca' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '3' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ECA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL((SELECT IFNULL(SUM(nilai),0) from trkib_d_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_d b WHERE id_lama='Eca' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '3' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ECA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL((SELECT IFNULL(SUM(nilai),0) from trkib_e_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_e b WHERE id_lama='Eca' $where_skpd $where_unit  GROUP BY id_barang
						UNION ALL
						SELECT '3' AS nor, '' AS kol_2, '' AS kol_3, '' AS kol_4, 'ECA' AS kol_5, '' AS kol_5a, '' AS kol_6, '' AS kol_7, '' AS kol_8, '' AS kol_9, '' AS kol_10, '' AS kol_11, '' AS kol_12, '' AS kol_13, sum(jumlah) AS kol_14, IFNULL(SUM(nilai),0) AS kol_15, 'SUBTOOTAL' AS kol_16, '' AS kol_17, '' AS kol_18, '' AS kol_19 FROM trkib_f WHERE id_lama='Eca' $where_skpd $where_unit 
					)eca_sub
					UNION ALL
					SELECT * FROM (
						SELECT '3a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, (CASE WHEN no_sertifikat2 IS NOT NULL THEN no_sertifikat2 ELSE no_sertifikat END) kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN luas2 IS NOT NULL THEN luas2 ELSE luas END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_a_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, 'Eca' AS kol_19 FROM trkib_a b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
						union all
						SELECT '3a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when merek2 IS NOT NULL THEN merek2 ELSE merek end) AS kol_6, concat(pabrik2,'/',no_rangka2,'/',no_mesin2,'/',no_polisi2) kol_7, kd_bahan AS kol_8, concat(asal,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, (CASE WHEN silinder2 IS NOT NULL THEN silinder2 ELSE silinder END)kol_11, kd_satuan AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_b_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, 'Eca' AS kol_19 FROM trkib_b b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
						union all
						SELECT '3a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when jenis_gedung2 is not null then jenis_gedung2 else jenis_gedung end) AS kol_6, (CASE WHEN no_dok2 IS NOT NULL THEN no_dok2 ELSE no_dok END) as kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi3 IS NOT NULL THEN konstruksi3 ELSE konstruksi2 END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_c_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, 'Eca' AS kol_19 FROM trkib_c b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
						union all
						SELECT '3a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, (CASE WHEN no_dok2 IS NOT NULL THEN no_dok2 ELSE no_dok END) AS kol_7, '' AS kol_8, asal AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi2 IS NOT NULL THEN konstruksi2 ELSE konstruksi END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_d_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, 'Eca' AS kol_19 FROM trkib_d b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
						union all
						SELECT '3a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, (case when tipe2 is not null then tipe2 else tipe end) AS kol_6, (case when spesifikasi2 is not null then spesifikasi2 else spesifikasi end) kol_7, (case when kd_bahan2 is not null then kd_bahan2 else kd_bahan end) AS kol_8, concat(peroleh,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, '' as kol_11, kd_satuan AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, (SELECT IFNULL(SUM(nilai),0) from trkib_e_kap a where a.kd_skpd=b.kd_skpd and a.kd_unit=b.kd_unit and a.id_barang=b.id_barang and tmbh_manfaat<>'0')+IFNULL(nilai,0) AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, 'Eca' AS kol_19 FROM trkib_e b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
						union all
						SELECT '3a' AS nor, kd_brg AS kol_2, no_reg AS kol_3, no_sensus AS kol_4, nm_brg AS kol_5,(CASE WHEN detail_brg2 IS NOT NULL THEN detail_brg2 ELSE detail_brg END)kol_5a, '' AS kol_6, '' as kol_7, '' AS kol_8, concat(asal,'/',dsr_peroleh) AS kol_9, tahun AS kol_10, (CASE WHEN konstruksi2 IS NOT NULL THEN konstruksi2 ELSE konstruksi END)kol_11, '' AS kol_12, (case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end) AS kol_13, jumlah AS kol_14, nilai AS kol_15, (CASE WHEN keterangan2 IS NOT NULL THEN keterangan2 ELSE keterangan END)kol_16, (CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)kol_17, (CASE WHEN STATUS IS NOT NULL AND((keberadaan_brg2<>'' AND kondisi_brg2<>'')OR ket_brg2<>'') THEN 'Sensus+Review' WHEN STATUS IS NOT NULL AND keberadaan_brg2='' AND kondisi_brg2='' AND ket_brg2='' THEN 'Sensus' WHEN STATUS IS NULL THEN 'Belum Sensus' ELSE '' END) AS kol_18, 'Eca' AS kol_19 FROM trkib_f WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
					)eca_detail
					order by nor,kol_2";
		$res       = $this->db->query($sql);
		$no        = 1;
		$class     = "";
		$jml_brg   = 0;
		$jml_nilai = 0;
		foreach ($res->result_array() as $row) {
			if ($row['nor']=='1' || $row['nor']=='2' || $row['nor']=='3') {
				$jml_brg   = $jml_brg   + $row['kol_14'];
				$jml_nilai = $jml_nilai + $row['kol_15'];
				$class = "highlight";
				$html .="<tr class=\"$class\">
						<td></td>";
			}else{
				$class = "";
				$html .="<tr class=\"$class\">
						<td align=\"center\" valign=\"top\">$no</td>";
			}
			for ($i=2; $i <= 19; $i++) {
				if ($i=='5' && ($row['nor']<>'1' && $row['nor']<>'2' && $row['nor']<>'3')) {
					$html .="<td valign=\"top\">".$row['kol_'.$i]."/".$row['kol_5a']."</td>";
				}elseif (($i=='3' || $i=='4') && $row['nor']<>'1' && $row['nor']<>'2' && $row['nor']<>'3') {
					$html .="<td class=\"x165\" style=\"mso-style-parent:style0;mso-number-format:000000;\" valign=\"top\">".sprintf("%06d", $row['kol_'.$i])."</td>";
				}elseif ($i=='15') {
					$html .="<td  valign=\"top\" align=\"right\">".number_format($row['kol_'.$i],2)."</td>";
				}elseif ($i=='14') {
				}else{
					$html .="<td valign=\"top\">".$row['kol_'.$i]."</td>";
				}
			}
			$html .="</tr>";
			if ($row['nor']<>'1' && $row['nor']<>'2' && $row['nor']<>'3') {
			$no++;
			}
		}
		$html .="<tr class=\"highlight_green\">";
				for ($i=1; $i <= 2; $i++) {
					if($i==1){
						$html .="<td colspan=\"13\" align=\"center\">TOTAL</td>";
					}else {
						$html .="<td colspan=\"5\">".number_format($jml_nilai,2)."</td>";
					}
				}
		$html .="
				</tr>
			</tbody>
		</table>
		<br/><br/>
		<table class=\"border-collapse w-100\" border=\"0\">
			<tr>
			<td colspan=\"9\" width=\"65%\"></td>
			<td colspan=\"9\" width=\"45%\">Makassar, $tgl</td>
			</tr>";
		if($kd_skpd<>'' && $kd_unit==''){
			$html .="
			<tr>
				<td colspan=\"9\" width=\"65%\"></td>
				<td colspan=\"9\" align=\"left\" width=\"45%\">KEPALA ".strtoupper($this->nm_skpd($kd_skpd))."<br/><br/><br/><br/><br/>$mengetahui<br/>NIP $nip_m</td>
			</tr>";
		}
		elseif($kd_skpd<>'' && $kd_unit<>''){
			$html .="
			<tr>
				<td colspan=\"9\" width=\"65%\"></td>
				<td colspan=\"9\" align=\"left\" width=\"45%\">KEPALA ".strtoupper($this->nm_unit($kd_unit))."<br/><br/><br/><br/><br/>$mengetahui<br/>NIP $nip_m</td>
			</tr>";
		}else{
			$html .="
			<tr>
				<td colspan=\"9\" width=\"65%\"></td>
				<td colspan=\"9\" align=\"left\" width=\"45%\">SEKRETARIS DAERAH KOTA MAKASSAR<br/><br/><br/><br/><br/>.......................<br/>NIP $nip_m</td>
			</tr>";
		}
		$html .="
		</table>
		";
		$data['excel'] = $html;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $html;
			break;
			case 2:
			$this->M_model->_mpdf($orien,$lmrg,$rmrg,$tmrg,$bmrg,$hmrg,$fmrg,'',$html);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
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

	function cetak_migrasi_kd_brg(){
		ini_set("memory_limit","-1");
		ini_set("max_execution_time","-1");
		$cetak      = $_REQUEST['cetak'];
		$kd_skpd    = $this->input->get('kd_skpd');
		$kd_unit    = $this->input->get('kd_unit');
		$tmrg       = $_REQUEST['tmrg'];
		$bmrg       = $_REQUEST['bmrg'];
		$lmrg       = $_REQUEST['lmrg'];
		$rmrg       = $_REQUEST['rmrg'];
		$hmrg       = $_REQUEST['hmrg'];
		$fmrg       = $_REQUEST['fmrg'];
		$t_baris    = $_REQUEST['t_baris'];
		$orien      = $_REQUEST['orien'];
		$tgl        = ($_REQUEST['tgl']=='') ? '':date_indo($_REQUEST['tgl']);
		$mengetahui = (($_REQUEST['mengetahui']=='-PILIH-')?'':$_REQUEST['mengetahui']);
		$nip_m      = $_REQUEST['nip_m'];
		$pengurus   = $_REQUEST['pengurus'];
		$nip_p      = $_REQUEST['nip_p'];
		$html       = "";

		if ($kd_skpd<>'') {
			$where_skpd = "AND kd_skpd='".$kd_skpd."'";
		}else{
			$where_skpd = "";
		}

		if ($kd_unit<>'') {
			$where_unit = "AND kd_unit='".$kd_unit."'";
		}else{
			$where_unit = "";
		}

		$html .="
		<style>
			.border-collapse {
				border-collapse:collapse;
			}
			.fw {
				font-weight:bold;
			}
			.highlight {
				background-color:#c9c5c5;
				font-weight: bold;
			}
			.highlight_green {
			    background-color:#7fff74;
			    font-weight: bold;
			}
			.w-100 {
				width:100%;
			}
			.xl65 {
				mso-style-parent:style0;
				mso-number-format:000000;
			}
			.nowrap {
				white-space: nowrap;
			}
		</style>
		<table class=\"border-collapse w-100\">
			<tr class=\"fw\">
				<td rowspan=\"3\" colspan=\"2\"><img src='".base_url('assets/images/logo3.png')."'></td>
				<td colspan=\"9\" align=\"center\">RINCIAN MIGRASI KODE BARANG MILIK DAERAH</td>
				<td rowspan=\"3\" colspan=\"2\"><img src='".base_url('assets/images/logo4.png')."'></td>
			</tr>
			<tr class=\"fw\">
				<td colspan=\"9\" align=\"center\">PEMERINTAH KOTA MAKASSAR</td>
			</tr>
			<tr class=\"fw\">
				<td colspan=\"9\" align=\"center\">TAHUN ANGGARAN 2019<BR><BR></td>
			</tr>
			<tr>
				<td></td>
				<td>SKPD</td>
				<td colspan=\"11\">:".strtoupper($this->nm_skpd($kd_skpd))."</td>
			</tr>";
			if ($kd_unit<>'') {
			$html .="
			<tr>
				<td></td>
				<td>UPB</td>
				<td colspan=\"11\">:".strtoupper($this->nm_unit($kd_unit))."</td>
			</tr>";
			}
		$html .="
		</table>
		<table class=\"border-collapse w-100\" border=\"1\">
			<thead>
				<tr class=\"highlight_green\">
					<td align=\"center\" colspan=\"4\"></td>
					<td align=\"center\" colspan=\"4\">Sebelum Migrasi</td>
					<td align=\"center\" colspan=\"5\">Setelah Migrasi</td>
				</tr>
				<tr class=\"highlight_green\">
					<td class=\"nowrap\" align=\"center\" >No</td>
					<td class=\"nowrap\" align=\"center\" >Kode Migrasi</td>
					<td class=\"nowrap\" align=\"center\" >Tahun</td>
					<td class=\"nowrap\" align=\"center\" >Nilai</td>
					<td class=\"nowrap\" align=\"center\" >Kode Barang</td>
					<td class=\"nowrap\" align=\"center\" >Nama Barang</td>
					<td class=\"nowrap\" align=\"center\" >Golongan</td>
					<td class=\"nowrap\" align=\"center\" >Status Aset</td>
					<td class=\"nowrap\" align=\"center\" >Kode Barang</td>
					<td class=\"nowrap\" align=\"center\" >Nama Barang</td>
					<td class=\"nowrap\" align=\"center\" >Keterangan</td>
					<td class=\"nowrap\" align=\"center\" >Golongan</td>
					<td class=\"nowrap\" align=\"center\" >Status Aset</td>
				</tr>
				<tr>";
				for ($i=1; $i <= 13; $i++) { 
				$html .="<th>$i</th>";
				}
			$html .="
				</tr>
				<tr>";
				for ($i=1; $i <= 13; $i++) { 
				$html .="<th>&nbsp;</th>";
				}
			$html .="
				</tr>
			</thead>
			<tbody>";
			$status_aset_akhir = "
			(case
			#B===================================================================================================================
			when
				(CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' 
				THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END)='B'
				AND
				((SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0)) < '300000'
			then 	'Eca'

			#C===================================================================================================================
			WHEN
				(CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' 
				THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END)='C'
				AND
				((SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0)) < '20000000'
			THEN 	'Eca'

			#E===================================================================================================================
			WHEN
				(CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' 
				THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END)='E'
				AND
				((SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0)) < '100000'
			THEN 	'Eca'

			#A===================================================================================================================
			ELSE
				(CASE WHEN( (CASE WHEN kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 WHEN kondisi_brg IS NOT NULL AND kondisi_brg<>'' THEN kondisi_brg ELSE kondisi END)='B' 
				OR (CASE WHEN kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 WHEN kondisi_brg IS NOT NULL AND kondisi_brg<>'' THEN kondisi_brg ELSE kondisi END)='KB') AND 
				(CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL THEN(CASE WHEN keberadaan_brg2='SKPD' THEN 'SKPD-Digunakan' 
				WHEN keberadaan_brg2='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' WHEN keberadaan_brg2='Dikuasai secara tidak sah pihak lain' 
				THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN ket_brg2<>'' AND ket_brg2 IS NOT NULL THEN ket_brg2 WHEN STATUS='1' AND stat_fisik='1' 
				THEN (CASE WHEN keberadaan_brg='SKPD' THEN 'SKPD-Digunakan' WHEN keberadaan_brg='Dikerjasamakan dengan pihak lain' THEN 'SKPD-Dikerjasamakan' 
				WHEN keberadaan_brg='Dikuasai secara tidak sah pihak lain' THEN 'SKPD-Dikuasai Pihak Lain' END) WHEN STATUS='1' AND stat_fisik='0' THEN ket_brg END)='SKPD-Digunakan' 
				THEN 'Aset Tetap' WHEN STATUS IS NULL THEN 'Aset Tetap' ELSE 'Aset Lainnya' END)
			end)";

			$status_aset_awal = "
			(CASE
			WHEN
			#Cek Kondisi B/KB
			((case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end)='B'
			 or 
			(case when kondisi_brg2<>'' AND kondisi_brg2 IS NOT NULL THEN kondisi_brg2 when kondisi_brg IS NOT NULL AND kondisi_brg<>'' then kondisi_brg else kondisi end)='KB')
			AND 
			#Cek Keberadaan SKPD-Digunakan
			(CASE WHEN keberadaan_brg2<>'' AND keberadaan_brg2 IS NOT NULL AND (ket_brg2='' or ket_brg2 is null) THEN keberadaan_brg2 END)='SKPD'
			THEN 'Aset Tetap'
			else 'Aset Lainnya' END)";
			$koreksi = "(CASE WHEN ket_brg2 = 'Koreksi BHP' THEN ket_brg2 WHEN ket_brg = 'Koreksi BHP' THEN ket_brg ELSE '' END)";

			$sql =" SELECT '1' AS col_1,col_2,col_3,SUM(col_4)col_4,'Aset Tetap' AS col_5,col_6,col_7,col_8,col_9,col_10,col_11,col_12,col_13 FROM (
						SELECT '1' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_a b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_b_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_b b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_c_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_c b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_d_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_d b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_e_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_e b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1' AS col_1,'' AS col_2,'' AS col_3,IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_f WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
					)head_ttp
					UNION ALL
					SELECT col_1,col_2,col_3,col_4,col_5,col_6,col_7,col_8,col_9,col_10,col_11,col_12,col_13 FROM (
						SELECT '1a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'A' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_a b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_b_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'B' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_b b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_c_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'C' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_c b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_d_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'D' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_d b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_e_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'E' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_e b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '1a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'F' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_f b WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
					)detal_ttp
					UNION ALL
					SELECT '2' AS col_1,col_2,col_3,SUM(col_4)col_4,'Aset Lainnya' AS col_5,col_6,col_7,col_8,col_9,col_10,col_11,col_12,col_13 FROM (
						SELECT '2' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_a b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_b_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_b b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_c_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_c b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_d_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_d b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_e_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_e b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2' AS col_1,'' AS col_2,'' AS col_3,IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_f WHERE $status_aset_awal = 'Aset Tetap' $where_skpd $where_unit GROUP BY id_barang
					)head_lannya
					UNION ALL
					SELECT col_1,col_2,col_3,col_4,col_5,col_6,col_7,col_8,col_9,col_10,col_11,col_12,col_13 FROM (
						SELECT '2a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'A' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_a b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_b_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'B' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_b b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_c_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'C' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_c b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_d_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'D' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_d b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_e_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'E' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_e b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '2a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'F' AS col_7, $status_aset_awal AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_f b WHERE $status_aset_awal = 'Aset Lainnya' $where_skpd $where_unit GROUP BY id_barang
					)detal_lainnya
					UNION ALL
					SELECT '3' AS col_1,col_2,col_3,SUM(col_4)col_4,'Eca' AS col_5,col_6,col_7,col_8,col_9,col_10,col_11,col_12,col_13 FROM (
						SELECT '3' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_a b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_b_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_b b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_c_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_c b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_d_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_d b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3' AS col_1,'' AS col_2,'' AS col_3,IFNULL((SELECT IFNULL(SUM(nilai),0) FROM trkib_e_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0'),0)+IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_e b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3' AS col_1,'' AS col_2,'' AS col_3,IFNULL(SUM(nilai),0) AS col_4,'' AS col_5,'' AS col_6,'' AS col_7,'' AS col_8,'' AS col_9,'' AS col_10,'' AS col_11,'' AS col_12,'' AS col_13 FROM trkib_f WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
					)head_eca
					UNION ALL
					SELECT col_1,col_2,col_3,col_4,col_5,col_6,col_7,col_8,col_9,col_10,col_11,col_12,col_13 FROM (
						SELECT '3a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_a_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'A' AS col_7, id_lama AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_a b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_b_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'B' AS col_7, id_lama AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_b b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_c_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'C' AS col_7, id_lama AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_c b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_d_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'D' AS col_7, id_lama AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_d b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,(SELECT IFNULL(SUM(nilai),0) FROM trkib_e_kap a WHERE a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit AND a.id_barang=b.id_barang AND tmbh_manfaat<>'0')+IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'E' AS col_7, id_lama AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_e b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang UNION ALL
						SELECT '3a' AS col_1, CONCAT(kd_unit,'.',no_sensus) AS col_2,tahun AS col_3,IFNULL(SUM(nilai),0) AS col_4, kd_brg AS col_5, CONCAT(nm_brg,IF(detail_brg<>'' && detail_brg IS NOT NULL,'/',''),IFNULL(detail_brg,'')) AS col_6, 'F' AS col_7, id_lama AS col_8, kd_brg_new AS col_9, CONCAT(nm_brg_new,IF(detail_brg2<>'' && detail_brg2 IS NOT NULL,'/',''),IFNULL(detail_brg2,'')) AS col_10, $koreksi as col_11, (CASE WHEN LEFT(kd_brg_new,5)='1.3.1' THEN 'A' WHEN LEFT(kd_brg_new,5)='1.3.2' THEN 'B' WHEN LEFT(kd_brg_new,5)='1.3.3' THEN 'C' WHEN LEFT(kd_brg_new,5)='1.3.4' THEN 'D' WHEN LEFT(kd_brg_new,5)='1.3.5' THEN 'E' WHEN LEFT(kd_brg_new,5)='1.3.6' THEN 'F' ELSE '' END) AS col_12, $status_aset_akhir AS col_13 FROM trkib_f b WHERE id_lama='Eca' $where_skpd $where_unit GROUP BY id_barang
					)detal_eca";
			$query = $this->db->query($sql);
			$no = 1;
			$jumlah = 0;
			foreach ($query->result_array() as $row) {
				if ($row['col_1']=='1' || $row['col_1']=='2' || $row['col_1']=='3') {
					$bg = "bgcolor='#b8b8b8'";
				}else{
					$bg = "";
					$jumlah = $jumlah + $row['col_4'];
				}
				$html .="
				<tr $bg>";
				if ($row['col_1']<>'1' && $row['col_1']<>'2' && $row['col_1']<>'3') {
				$html .="
					<td align=\"center\" valign=\"top\">$no</td>";
				}else{
				$html .="
					<td></td>";
				}
					for ($i=2; $i <= 13; $i++) {
						if ($i==4) {
						$html .="<td align=\"right\" valign=\"top\">".number_format($row['col_'.$i],2)."</td>";
						}else{
						$html .="<td valign=\"top\">".$row['col_'.$i]."</td>";
						}
					}
				$html .="	
				</tr>
				";
				if ($row['col_1']<>'1' && $row['col_1']<>'2' && $row['col_1']<>'3') {
					$no++;
				}
			}
			$html .="
				<tr bgcolor=\"#7fff74\" class=\"fw\">
					<td colspan=\"2\" align=\"center\">Jumlah</td>
					<td colspan=\"11\">".number_format($jumlah,2)."</td>
				</tr>
			</tbody>
		</table>
		<br/><br/>
		<table class=\"border-collapse w-100\" border=\"0\">
			<tr>
			<td colspan=\"9\" width=\"65%\"></td>
			<td colspan=\"9\" width=\"45%\">Makassar, $tgl</td>
			</tr>";
		if($kd_skpd<>'' && $kd_unit==''){
			$html .="
			<tr>
				<td colspan=\"9\" width=\"65%\"></td>
				<td colspan=\"9\" align=\"left\" width=\"45%\">KEPALA ".strtoupper($this->nm_skpd($kd_skpd))."<br/><br/><br/><br/><br/>$mengetahui<br/>NIP $nip_m</td>
			</tr>";
		}
		elseif($kd_skpd<>'' && $kd_unit<>''){
			$html .="
			<tr>
				<td colspan=\"9\" width=\"65%\"></td>
				<td colspan=\"9\" align=\"left\" width=\"45%\">KEPALA ".strtoupper($this->nm_unit($kd_unit))."<br/><br/><br/><br/><br/>$mengetahui<br/>NIP $nip_m</td>
			</tr>";
		}else{
			$html .="
			<tr>
				<td colspan=\"9\" width=\"65%\"></td>
				<td colspan=\"9\" align=\"left\" width=\"45%\">SEKRETARIS DAERAH KOTA MAKASSAR<br/><br/><br/><br/><br/>.......................<br/>NIP $nip_m</td>
			</tr>";
		}
		$html .="
		</table>
		";
		$data['excel'] = $html;
		$judul = 'LAPORAN';
		switch ($cetak) {
			case 1:
			echo $html;
			break;
			case 2:
			$this->M_model->_mpdf($orien,$lmrg,$rmrg,$tmrg,$bmrg,$hmrg,$fmrg,'',$html);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
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
}/*Controller*/
?>
