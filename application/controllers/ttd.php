<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ttd extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
		$this->load->library('upload');
	}

	public function index(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_ttd';
			$a['title'] ='PENANDA TANGAN';
			$a['icon']  ='fa fa-signature';
			$a['otori'] = $_SESSION['otori'];
			$this->load->view('main',$a);
		}
	}

	function get_ttd(){
		$kd_skpd = $this->input->post('kd_skpd');
		$kd_unit = $this->input->post('kd_unit');
		if ($kd_skpd != '' && $kd_unit != '') {
			$query=$this->db->select(array('nip','nama','jabatan','ckey','skpd','unit'))
			->from('ttd')
			->where(array('skpd'=>$kd_skpd,'unit'=>$kd_unit))
			->where('(ckey="PA" OR ckey="PB"  OR ckey="PPPB")');
		}elseif ($kd_skpd != '' && $kd_unit == '') {
			$query=$this->db->select(array('nip','nama','jabatan','ckey','skpd','unit'))
			->from('ttd')
			->where(array('skpd'=>$kd_skpd))
			->where('(ckey="PA" OR ckey="PB"  OR ckey="PPPB")');
		}else {
			if ($_SESSION['otori']==1 || $_SESSION['otori']==4) {
				$query=$this->db->select(array('nip','nama','jabatan','ckey','skpd','unit'))->from('ttd')->where('(ckey="PA" OR ckey="PB" OR ckey="PPPB")');
			}else{
				$query=$this->db->select(array('nip','nama','jabatan','ckey','skpd','unit'))->from('ttd')->WHERE(array('unit'=>$_SESSION['unit_skpd']))->where('(ckey="PA" OR ckey="PB"  OR ckey="PPPB")');
			}
			
		}
		$column_order = array(null,'nip','nama','jabatan','ckey','skpd','unit',null);
		$column_search = array('nip','nama','jabatan','ckey','skpd','unit');
		$order = array('unit'=>'ASC');
		$list = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $resulte) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $resulte->nip;
			$row[] = $resulte->nama;
			$row[] = $resulte->jabatan;
			$row[] = $resulte->skpd;
			$row[] = $resulte->unit;
			$row[] = $resulte->ckey;
			$row[] = '<div class="btn-group">
			<button class="btn btn-default btn-sm" onclick="edit(\''.$resulte->nip.'\',\''.$resulte->skpd.'\',\''.$resulte->unit.'\');" role="button" data-toggle="modal" data-target="#modal_ttd"><i class="fa fa-user-edit fa-lg text-primary"></i></button>
			<button class="btn btn-default btn-sm" onclick="hapus(\''.$resulte->nip.'\',\''.$resulte->nama.'\',\''.$resulte->skpd.'\',\''.$resulte->unit.'\');"><i class="fa fa-trash fa-lg text-warning"></i></button>
			</div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_model->count_all($query),
			"recordsFiltered" => $list['count_filtered'],
			"data" => $data
		);
		echo json_encode($output);
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
	function hapus(){
		$nip = $this->input->post('nip');
		$skpd = $this->input->post('skpd');
		$unit = $this->input->post('unit');
		$tabel = $this->input->post('tabel');
		$data = $this->db->query("DELETE FROM $tabel where nip='$nip' and skpd='$skpd' and unit='$unit'");
		if($data=='1'){
			echo '1';
		}else{
			echo '2';
		}
	}
	function simpan(){
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
	function get_detail(){
		$kd_skpd = $this->input->post('skpd');
		$kd_unit = $this->input->post('unit');
		$nip     = $this->input->post('nip');
		$data = $this->db->query("SELECT skpd,a.nm_skpd,unit,c.nm_lokasi,nip,nama,jabatan,ckey FROM ttd a 
			LEFT JOIN ms_skpd b ON a.skpd=b.kd_skpd 
			LEFT JOIN mlokasi c ON c.kd_lokasi=a.unit WHERE a.skpd='$kd_skpd' AND a.unit='$kd_unit' AND a.nip='$nip'")->result();
		echo json_encode($data);
	}

}
?>
