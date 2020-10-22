<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang extends CI_Controller {
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
			$a['page']  ='v_ruang';
			$a['title'] ='RUANGAN';
			$a['icon']  ='fa fa-warehouse-alt';
			$a['otori'] = $_SESSION['otori'];
			$this->load->view('main',$a);
		}
	}

	function get_ruang(){
		$kd_skpd = $this->input->post('kd_skpd');
		$kd_unit = $this->input->post('kd_unit');
		if ($kd_skpd != '' && $kd_unit != '') {
			$query=$this->db->select(array('kd_ruang','nm_ruang','kd_skpd','kd_unit','no_urut','keterangan'))
			->from('mruang')
			->where(array('kd_skpd'=>$kd_skpd,'kd_unit'=>$kd_unit));
		}elseif ($kd_skpd != '' && $kd_unit == '') {
			$query=$this->db->select(array('kd_ruang','nm_ruang','kd_skpd','kd_unit','no_urut','keterangan'))
			->from('mruang')
			->where(array('kd_skpd'=>$kd_skpd));
		}else {
			if ($_SESSION['otori']==1 || $_SESSION['otori']==4) {
				$query=$this->db->select(array('kd_ruang','nm_ruang','kd_skpd','kd_unit','no_urut','keterangan'))->from('mruang');
			}else{
				$query=$this->db->select(array('kd_ruang','nm_ruang','kd_skpd','kd_unit','no_urut','keterangan'))->from('mruang')->WHERE(array('kd_skpd'=>$_SESSION['skpd'],'kd_unit'=>$_SESSION['unit_skpd']));
			}
		}
		$column_order = array(null,'kd_ruang','nm_ruang','kd_skpd','kd_unit','no_urut','keterangan',null);
		$column_search = array('kd_ruang','nm_ruang','kd_skpd','kd_unit','no_urut','keterangan');
		$order = array('kd_ruang'=>'ASC');
		$list = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $resulte) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $resulte->kd_ruang;
			$row[] = $resulte->nm_ruang;
			$row[] = $resulte->kd_skpd;
			$row[] = $resulte->kd_unit;
			$row[] = $resulte->no_urut;
			$row[] = $resulte->keterangan;
			$row[] = '<div class="btn-group">
			<button class="btn btn-default btn-sm" onclick="edit(\''.$resulte->kd_ruang.'\',\''.$resulte->kd_skpd.'\',\''.$resulte->kd_unit.'\');" role="button" data-toggle="modal" data-target="#modal_ruang"><i class="fa fa-user-edit fa-lg text-primary"></i></button>
			<button class="btn btn-default btn-sm" onclick="hapus(\''.$resulte->kd_ruang.'\',\''.$resulte->nm_ruang.'\',\''.$resulte->kd_skpd.'\',\''.$resulte->kd_unit.'\');"><i class="fa fa-trash fa-lg text-warning"></i></button>
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
	function hapus(){
		$kd_ruang = $this->input->post('kd_ruang');
		$kd_skpd = $this->input->post('kd_skpd');
		$kd_unit = $this->input->post('kd_unit');
		$tabel = $this->input->post('tabel');
		$data = $this->db->query("DELETE FROM $tabel where kd_ruang='$kd_ruang' and kd_skpd='$kd_skpd' and kd_unit='$kd_unit'");
		if($data=='1'){
			echo '1';
		}else{
			echo '2';
		}
	}
	function simpan(){
		$key        = $this->input->post('key');
		$kd_skpd    = $this->input->post('skpd');
		$kd_unit    = $this->input->post('unit');
		$kd_ruang   = $this->input->post('kd_ruang');
		$nm_ruang   = $this->input->post('nm_ruang');
		$no_urut    = $this->input->post('no_urut');
		$keterangan = $this->input->post('keterangan');
		if ($key==0) {
			$query = $this->db->query("INSERT into mruang (kd_ruang,nm_ruang,kd_skpd,kd_unit,no_urut,keterangan) value('$kd_ruang','$nm_ruang','$kd_skpd','$kd_unit','$no_urut','$keterangan')");
		}else{
			$value    = array(
				'nm_ruang'   => $nm_ruang,
				'no_urut'    => $no_urut,
				'keterangan' => $keterangan
			);
			$where = array(
				'kd_ruang' => $kd_ruang,
				'kd_skpd' => $kd_skpd,
				'kd_unit' => $kd_unit
			);
			$query = $this->db->where($where);
			$query = $this->db->update('mruang', $value);
		}

		if ($query) {
			$data = true;
		}else{
			$data = false;
		}
		echo json_encode($data);
	}
	function get_detail(){
		$kd_skpd  = $this->input->post('kd_skpd');
		$kd_unit  = $this->input->post('kd_unit');
		$kd_ruang = $this->input->post('kd_ruang');
		$data = $this->db->query("SELECT kd_ruang,nm_ruang,a.kd_skpd,b.nm_skpd,kd_unit,c.nm_lokasi,no_urut,keterangan FROM mruang a 
			LEFT JOIN ms_skpd b ON a.kd_skpd=b.kd_skpd 
			LEFT JOIN mlokasi c ON c.kd_lokasi=a.kd_unit WHERE a.kd_skpd='$kd_skpd' AND a.kd_unit='$kd_unit' AND a.kd_ruang='$kd_ruang'")->result();
		echo json_encode($data);
	}
	function get_kode(){
		$kd_unit = $this->input->post('kd_unit');
		$query = $this->db->query("SELECT LPAD(IFNULL(MAX(RIGHT(kd_ruang,2)),0)+1,2,'0') AS kode FROM mruang WHERE kd_unit='$kd_unit'")->row_array();
		$kd_ruang = $kd_unit.'.'.$query['kode'];
		$data = array('kd_ruang' => $kd_ruang,'no_urut' => $query['kode'] );
		echo json_encode($data);
	}

}
?>
