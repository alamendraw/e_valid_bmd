<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
	}
	
	function get_info(){
		$query = $this->db->query("SELECT * from info where kd_unit='$_SESSION[unit_skpd]'");
		$a = $query->row_array(0);
		$b = $query->row_array(1);
		$c = $query->row_array(2);
		$d = $query->row_array(3);
		$e = $query->row_array(4);
		$f = $query->row_array(5);
		$data = array(
			'a_tot' => $a['tot'],
			'b_tot' => $b['tot'], 
			'c_tot' => $c['tot'], 
			'd_tot' => $d['tot'], 
			'e_tot' => $e['tot'], 
			'f_tot' => $f['tot'], 
			'a_sen' => $a['sen'], 
			'b_sen' => $b['sen'], 
			'c_sen' => $c['sen'], 
			'd_sen' => $d['sen'],
			'e_sen' => $e['sen'], 
			'f_sen' => $f['sen'], 
			'a_non' => $a['non'], 
			'b_non' => $b['non'], 
			'c_non' => $c['non'], 
			'd_non' => $d['non'], 
			'e_non' => $e['non'], 
			'f_non' => $f['non'], 
		);
		echo json_encode($data);
	}
	function call(){
		$data;
		$query = $this->db->query("call info('$_SESSION[unit_skpd]')");
		if ($query) {
			$data = 1;
		}
		echo json_encode($data);
	}
	function call_progress(){
		$data;
		$query = $this->db->query("call progres_sensus('','')");
		if ($query) {
			$data = 1;
		}
		echo json_encode($data);
	}
	function get_progress(){
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			$query=$this->db->select(array('kd_skpd','kd_lokasi','nm_lokasi','a_t','a_s','a_p_s','a_n','a_p_n','b_t','b_s','b_p_s','b_n','b_p_n','c_t','c_s','c_p_s','c_n','c_p_n','d_t','d_s','d_p_s','d_n','d_p_n','e_t','e_s','e_p_s','e_n','e_p_n','f_t','f_s','f_p_s','f_n','f_p_n'))
			->from('progress');
		}elseif ($_SESSION['otori']==2) {
			$query=$this->db->select(array('kd_lokasi','nm_lokasi','a_t','a_s','a_p_s','a_n','a_p_n','b_t','b_s','b_p_s','b_n','b_p_n','c_t','c_s','c_p_s','c_n','c_p_n','d_t','d_s','d_p_s','d_n','d_p_n','e_t','e_s','e_p_s','e_n','e_p_n','f_t','f_s','f_p_s','f_n','f_p_n'))
			->from('progress')
			->where(array('kd_skpd'=>$_SESSION['skpd']));
		}else {
			$query=$this->db->select(array('kd_lokasi','nm_lokasi','a_t','a_s','a_p_s','a_n','a_p_n','b_t','b_s','b_p_s','b_n','b_p_n','c_t','c_s','c_p_s','c_n','c_p_n','d_t','d_s','d_p_s','d_n','d_p_n','e_t','e_s','e_p_s','e_n','e_p_n','f_t','f_s','f_p_s','f_n','f_p_n'))
			->from('progress')
			->where(array('kd_lokasi'=>$_SESSION['unit_skpd']));
		}
		$column_order = array(null,'kd_lokasi','nm_lokasi','a_t','a_s','a_p_s','a_n','a_p_n','b_t','b_s','b_p_s','b_n','b_p_n','c_t','c_s','c_p_s','c_n','c_p_n','d_t','d_s','d_p_s','d_n','d_p_n','e_t','e_s','e_p_s','e_n','e_p_n','f_t','f_s','f_p_s','f_n','f_p_n',null);
		$column_search = array('kd_lokasi','nm_lokasi','a_t','a_s','a_p_s','a_n','a_p_n','b_t','b_s','b_p_s','b_n','b_p_n','c_t','c_s','c_p_s','c_n','c_p_n','d_t','d_s','d_p_s','d_n','d_p_n','e_t','e_s','e_p_s','e_n','e_p_n','f_t','f_s','f_p_s','f_n','f_p_n');
		$order = array('kd_lokasi'=>'DESC','nm_lokasi'=>'DESC','a_t'=>'DESC','a_s'=>'DESC','a_p_s'=>'DESC','a_n'=>'DESC','a_p_n'=>'DESC','b_t'=>'DESC','b_s'=>'DESC','b_p_s'=>'DESC','b_n'=>'DESC','b_p_n'=>'DESC','c_t'=>'DESC','c_s'=>'DESC','c_p_s'=>'DESC','c_n'=>'DESC','c_p_n'=>'DESC','d_t'=>'DESC','d_s'=>'DESC','d_p_s'=>'DESC','d_n'=>'DESC','d_p_n'=>'DESC','e_t'=>'DESC','e_s'=>'DESC','e_p_s'=>'DESC','e_n'=>'DESC','e_p_n'=>'DESC','f_t'=>'DESC','f_s'=>'DESC','f_p_s'=>'DESC','f_n'=>'DESC','f_p_n'=>'DESC');
		$list = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $resulte) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $resulte->nm_lokasi;
			$row[] = '<span style="color:#f012be;">'.$resulte->a_t.'</span>';
			$row[] = '<span style="color:#00a65a;">'.$resulte->a_s;
			$row[] = '<span style="color:#337ab7;">'.$resulte->a_p_s.'%</span>';
			$row[] = '<span style="color:#dd4b39;">'.$resulte->a_n.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->a_p_n.'%</span>';
			$row[] = '<span style="color:#f012be;">'.$resulte->b_t.'</span>';
			$row[] = '<span style="color:#00a65a;">'.$resulte->b_s.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->b_p_s.'%</span>';
			$row[] = '<span style="color:#dd4b39;">'.$resulte->b_n.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->b_p_n.'%</span>';
			$row[] = '<span style="color:#f012be;">'.$resulte->c_t.'</span>';
			$row[] = '<span style="color:#00a65a;">'.$resulte->c_s.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->c_p_s.'%</span>';
			$row[] = '<span style="color:#dd4b39;">'.$resulte->c_n.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->c_p_n.'%</span>';
			$row[] = '<span style="color:#f012be;">'.$resulte->d_t.'</span>';
			$row[] = '<span style="color:#00a65a;">'.$resulte->d_s.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->d_p_s.'%</span>';
			$row[] = '<span style="color:#dd4b39;">'.$resulte->d_n.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->d_p_n.'%</span>';
			$row[] = '<span style="color:#f012be;">'.$resulte->e_t.'</span>';
			$row[] = '<span style="color:#00a65a;">'.$resulte->e_s.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->e_p_s.'%</span>';
			$row[] = '<span style="color:#dd4b39;">'.$resulte->e_n.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->e_p_n.'%</span>';
			$row[] = '<span style="color:#f012be;">'.$resulte->f_t.'</span>';
			$row[] = '<span style="color:#00a65a;">'.$resulte->f_s.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->f_p_s.'%</span>';
			$row[] = '<span style="color:#dd4b39;">'.$resulte->f_n.'</span>';
			$row[] = '<span style="color:#337ab7;">'.$resulte->f_p_n.'%</span>';
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
}
?>
