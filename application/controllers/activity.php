<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
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
			$a['page']  ='v_activity';
			$a['title'] ='AKTIVITAS SENSUS';
			$a['icon']  ='fa fa-user-lock';
			$a['otori'] = $_SESSION['otori'];
			$this->load->view('main',$a);
		}
	}

	function get_user(){
		$kd_skpd  = $this->input->post('kd_skpd');
		$activity = $this->input->post('activity');
		$query         = $this->db->select(array('a.username','b.kd_lokasi','b.nm_lokasi','a.activity'))->from('m_user a');
		$query         = $this->db->join('mlokasi b','a.unit_skpd=b.kd_lokasi','inner');
		$query         = $this->db->where(array('a.oto !='=>'1','a.oto !='=>'4'));
		$query         = $this->db->like('a.activity',$activity);
		$query         = $this->db->like('b.kd_skpd',$kd_skpd)->group_by('a.unit_skpd');
		$column_order  = array(null,'a.username','b.kd_lokasi','b.nm_lokasi','a.activity',null);
		$column_search = array('a.username','b.kd_lokasi','b.nm_lokasi','a.activity');
		$order         = array('b.kd_skpd,b.kd_lokasi ASC');
		$list          = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$data          = array();
		$no            = $_POST['start'];
		foreach ($list['result'] as $resulte) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $resulte->kd_lokasi;
			$row[] = $resulte->nm_lokasi;
			if ($resulte->activity==1) {
			$row[] = '<button class="btn btn-default btn-sm" onclick="edit(\''.$resulte->activity.'\',\''.$resulte->kd_lokasi.'\');" ><i class="fa fa-check-double fa-lg text-primary"></i></button>';
			}else{
				$row[] = '<button class="btn btn-default btn-sm" onclick="edit(\''.$resulte->activity.'\',\''.$resulte->kd_lokasi.'\');" ><i class="fa fa-ban fa-lg text-danger"></i></button>';
			}
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

	function edit(){
		$kd_unit  = $this->input->post('unit');
		$activity = $this->input->post('activity');
		if ($activity==0) {
			$value = array('activity'=>1,'destroy'=>1);
		}else{
			$value = array('activity'=>0,'destroy'=>1);
		}
		$query = $this->db->where('unit_skpd',$kd_unit);
		$query = $this->db->update('m_user', $value);
		if ($query) {
			$data = true;
		}else{
			$data = false;
		}
		echo json_encode($data);
	}

}
?>
