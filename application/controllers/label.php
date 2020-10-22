<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label extends CI_Controller {
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
			$a['page']  ='v_label';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
	function get_jns_sensus(){
		$data=$this->M_model->get_jns_sensus();
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
	
	function cetak_label(){
		$cetak      = $_REQUEST['cetak'];
		$jns_kib    = $_REQUEST['jns_kib'];
		$kd_skpd    = $_REQUEST['kd_skpd'];
		$kd_unit    = $_REQUEST['unit_skpd'];
		$urut_awal  = $_REQUEST['urut_awal'];
		$urut_akhir = $_REQUEST['urut_akhir'];
		$size 		= $_REQUEST['size'];
		$nm_skpd    = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit    = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		if ($kd_skpd<>'') {
			$where_1 = 'AND kd_skpd="'.$kd_skpd.'"';
		}else{
			$where_1 = '';
		}

		if ($kd_unit<>'') {
			$where_2 = 'AND kd_unit="'.$kd_unit.'"';
		}else{
			$where_2 = '';
		}

		if ($jns_kib == 3) {
			$table = 'trkib_a';
			$k = 'A';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else if ($jns_kib == 4) {
			$table = 'trkib_b';
			$k = 'B';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,
					CONCAT(IF(merek='' OR merek IS NULL,'','/'),merek) AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,
					CONCAT(IF(no_polisi='' OR no_polisi IS NULL,'','/'),no_polisi) AS no_polisi";
		}
		else if ($jns_kib == 5) {
			$table = 'trkib_c';
			$k = 'C';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else if ($jns_kib == 6) {
			$table = 'trkib_d';
			$k = 'D';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else if ($jns_kib == 7) {
			$table = 'trkib_e';
			$k = 'E';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else {
			$table = 'trkib_f';
			$k = 'F';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}

		if ($urut_awal !=0 && $urut_akhir !=0) {
			$antara = 'AND no_sensus BETWEEN '.$urut_awal.' AND '.$urut_akhir.' ';
		}else {
			$antara = '';
		}

		$query = $this->db->query("SELECT $v FROM $table WHERE kd_unit is not null $where_1 $where_2 $antara order by no_sensus");
		$no=0;
		$cRet ="
			<table style=\"border-collapse:collapse; font-size:13px;\" border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"1\">";
		foreach ($query->result_array() as $row) {
			$no = $no+1;
			if ($no==1) {
			$cRet .="
				<tr>";
			}

			$cRet .="
					<td valign=\"midle\" align=\"center\" width=\"190px\">
						<table style=\"border-collapse:collapse; font-size:13px; border: 1px solid black;\" border=\"1\" width=\"190px\" cellspacing=\"1\" cellpadding=\"1\">
							<tr>
								<td align=\"center\"  style=\"font-size:13px; font-weight:bold; font-family: tahoma;\">SENSUS 2019</td>
							</tr>
							<tr>
								<td align=\"center\"  style=\"font-size:20px; font-weight:bold; font-family: tahoma;\">$k-$row[no_sensus]</td>
							</tr>
							<tr>
								<td align=\"center\"  style=\"font-family: tahoma; height:35px\">$row[nm_brg_new]</td>
							</tr>
							<tr>
								<td align=\"center\"  style=\"font-family: tahoma; height:52px\">$row[nm_brg]$row[detail_brg]$row[merek]$row[tahun]$row[no_polisi]</td>
							</tr>
							<tr>
								<td align=\"center\" style=\"font-family: tahoma; font-weight:bold;\">$kd_unit</td>
							</tr>
						</table>
					</td>";
			if ($no==4) {
			$cRet .="
				</tr>
				<tr>
					<td colspan=\"4\">&nbsp;</td>
				</tr>
				";
			$no = $no-4;
			}
		}

		$cRet .="
			</table>";

		$data['excel'] = $cRet;
		$judul = 'LABEL';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf_label('L',3,3,3,3,0,0,'',$cRet,$size);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
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

	function cetak_barang(){
		$cetak      = $_REQUEST['cetak'];
		$jns_kib    = $_REQUEST['jns_kib'];
		$kd_skpd    = $_REQUEST['kd_skpd'];
		$kd_unit    = $_REQUEST['unit_skpd'];
		$tahun  	= $_REQUEST['tahun']; 
		$size 		= $_REQUEST['size'];
		$nm_skpd    = $this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd='$kd_skpd'")->row_array();
		$nm_unit    = $this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi='$kd_unit'")->row_array();
		if ($kd_skpd<>'') {
			$where_1 = 'AND a.kd_skpd="'.$kd_skpd.'"';
		}else{
			$where_1 = '';
		}

		if ($kd_unit<>'') {
			$where_2 = 'AND a.kd_unit="'.$kd_unit.'"';
		}else{
			$where_2 = '';
		}

		if ($jns_kib == 3) {
			$table = 'trkib_a';
			$k = 'A';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else if ($jns_kib == 4) {
			$table = 'trkib_b';
			$k = 'B';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,
					CONCAT(IF(merek='' OR merek IS NULL,'','/'),merek) AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,
					CONCAT(IF(no_polisi='' OR no_polisi IS NULL,'','/'),no_polisi) AS no_polisi";
		}
		else if ($jns_kib == 5) {
			$table = 'trkib_c';
			$k = 'C';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else if ($jns_kib == 6) {
			$table = 'trkib_d';
			$k = 'D';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else if ($jns_kib == 7) {
			$table = 'trkib_e';
			$k = 'E';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}
		else {
			$table = 'trkib_f';
			$k = 'F';
			$v = "
					no_sensus,nm_brg_new,nm_brg,
					CONCAT(IF(detail_brg='' OR detail_brg IS NULL,'','/'),detail_brg) AS detail_brg,'' AS merek,
					CONCAT(IF(tahun='' OR tahun IS NULL,'','/'),tahun) AS tahun,'' AS no_polisi";
		}

		if ($tahun !='') {
			$where_3 = "AND tahun='$tahun' ";
		}else {
			$where_3 = '';
		}

		$no=0;
		$cRet  = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\">";
			
			$csql = "SELECT a.kd_skpd,d.nm_skpd,a.no_reg,a.milik,a.wilayah,c.kd_uker,a.tahun,c.kd_lokasi,CONCAT(a.milik,'.',a.wilayah,'.',LEFT(c.kd_uker,5),'.',RIGHT(a.tahun,2),'.',RIGHT(c.kd_lokasi,5)) AS id_barang,concat(a.kd_brg_new,'.',right(a.no_reg,4)) as no,b.nm_brg,a.detail_brg FROM $table a
			LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg 
			left join mlokasi c on a.kd_skpd=c.kd_skpd AND a.kd_unit=c.kd_lokasi
            left join ms_skpd d on a.kd_skpd=d.kd_skpd
			$where_1 $where_2 $where_3 limit 4";

		$tot	= $this->db->query($csql)->num_rows();

			 $hasil = $this->db->query($csql);
             $totHasil = count($hasil);
             
             $i = 0;
                
             foreach ($hasil->result() as $row)
             {  
                $i          = $i+1;
                $id_barang  = $row->id_barang;
                $nm_skpd    = $row->nm_skpd;
                $kd_skpd    = $row->kd_skpd;
                $tahun      = $row->tahun;
                $no         = $row->no;

                $nm_brg     = $row->nm_brg;
                $detail_brg = $row->detail_brg;
                $nm_brg_full = $row->nm_brg.'/'.$row->detail_brg;
                $nm_brg = $row->detail_brg;
 
                $qr = site_url()."/Qr_generator?no_reg=".$no."&kd_brg=".$id_barang."&nm_brg=".$nm_brg."&kd_skpd=".$kd_skpd."&nm_skpd=".$nm_skpd."&tahun=".$tahun;
             
				if($i%2!=0){
					$cRet .="
					<tr>
						<td align=\"center\" width=\"48%\">
							<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
								<tr>
									<td  width=\"20%\" rowspan=\"6\" align=\"center\" style=\"font-size:11px; border-bottom:solid 2px black; border-right:solid 2px black;border-top:solid 2px black;border-left:solid 2px black;\">
									<img src=\"".base_url()."assets/images\logo2.png\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
									<td align=\"center\" width=\"80%\" height=\"20%\" style=\"font-size:10px; border-bottom:solid 2px black; font-family: tahoma;border-top:solid 2px black; border-right:solid 2px black;\"><b>$id_barang</b></td>
									<td align=\"center\"  width=\"10%\" rowspan=\"6\" style=\"padding:0px;margin:0px;font-size:11px; border-bottom:solid 2px black; border-right:solid 2px black;border-top:solid 2px black;border-left:solid 2px black;\">
										<img src=\"".$qr."\" width=\"90px\" height=\"90px\" alt=\"\" />
									</td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:10px; border-bottom:solid 2px black;font-family: tahoma;border-right:solid 2px black;\"><b>$no</b></td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:8px; border-bottom:solid 2px white;font-family: tahoma;border-right:solid 2px black;\"><b>$nm_brg_full</b></td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:8px; font-family: tahoma; border-bottom:solid 2px white;border-right:solid 2px black;border-left:solid 2px black;border-top:solid 2px white;\"><b>".strtoupper($nm_skpd)."</b></td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:8px; font-family: tahoma; border-bottom:solid 2px black;border-right:solid 2px black;border-left:solid 2px black;border-top:solid 2px white;\"><b> TAHUN ANGGARAN ".$tahun."</b></td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:10px; font-family: tahoma; border-bottom:solid 2px black;border-right:solid 2px black;border-left:solid 2px black;\"><b>PEMERINTAH KABUPATEN SINTANG</b></td>
								</tr>
							</table>
						</td>
						<td border:none; width=\"4%\">&nbsp;</td>
					";

					if ($tot == $i) {
						$cRet .="<td align=\"center\" width=\"48%\">&nbsp;</td></tr>";
					}
				}else{
					$cRet .="
						<td align=\"center\"  width=\"48%\">
							<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
								<tr>
									<td  width=\"20%\" rowspan=\"6\" align=\"center\" style=\"font-size:11px; border-bottom:solid 2px black; border-right:solid 2px black;border-top:solid 2px black;border-left:solid 2px black;\">
										<img src=\"".base_url()."assets/images/logo2.png\" width=\"80px\" height=\"80px\" alt=\"\" /></td>
									</td>
									<td align=\"center\" width=\"80%\" height=\"20%\" style=\"font-size:10px; border-bottom:solid 2px black; font-family: tahoma;border-top:solid 2px black; border-right:solid 2px black;\"><b>$id_barang</b></td>
									<td align=\"center\"  width=\"10%\" rowspan=\"6\" style=\"padding:0px;margin:0px;font-size:11px; border-bottom:solid 2px black; border-right:solid 2px black;border-top:solid 2px black;border-left:solid 2px black;\">
										<img src=\"".$qr."\" width=\"90px\" height=\"90px\" alt=\"\" />
									</td>
								</tr>
								<tr>							
									<td align=\"center\" height=\"10%\" style=\"font-size:10px; border-bottom:solid 2px black;font-family: tahoma;border-right:solid 2px black;\"><b>$no</b></td>
								</tr>
								<tr>							
									<td align=\"center\" height=\"10%\" style=\"font-size:8px; border-bottom:solid 2px white;font-family: tahoma;border-right:solid 2px black;\"><b>$nm_brg_full</b></td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:8px; font-family: tahoma; border-bottom:solid 2px white;border-right:solid 2px black;border-left:solid 2px black;border-top:solid 2px white;\"><b>".strtoupper($nm_skpd)."</b></td>
								</tr>
								<tr>                            
									<td align=\"center\" height=\"10%\" style=\"font-size:8px; font-family: tahoma; border-bottom:solid 2px black;border-right:solid 2px black;border-left:solid 2px black;border-top:solid 2px white;\"><b> TAHUN ANGGARAN ".$tahun."</b></td>
								</tr>
								<tr>							
									<td align=\"center\" height=\"10%\" style=\"font-size:10px; font-family: tahoma; border-bottom:solid 2px black;border-right:solid 2px black;border-left:solid 2px black;\"><b>PEMERINTAH KABUPATEN SINTANG</b></td>
								</tr>
							</table>
						</td>
				</tr>
				
				<tr><td height=\"80%\" style=\"border:none;\" width= \"100%\" colspan=\"3\"></td></tr>";
				}
        		
                //$i++;    
              
			}
		$cRet .= " </table>";
		 
		$data['excel'] = $cRet;
		$judul = 'LABEL';
		switch ($cetak) {
			case 1:
			echo $cRet;
			break;
			case 2:
			$this->M_model->_mpdf_label('L',3,3,3,3,0,0,'',$cRet,$size);/*($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi)*/
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

	public function label_barang(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_label_barang';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}
}
?>
