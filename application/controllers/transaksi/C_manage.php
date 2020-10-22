<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_manage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Manage');	
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Manage Ruangan",
			'judul'		=> "Manajemen Ruangan",
			'deskripsi'	=> "Manage Ruangan"
		);
		$this->template->views('transaksi/inventarisasi/V_Manage', $data);
	}

	function load_header(){
		$otori 	= $this->session->userdata['oto'];
		$skpd 	= $this->session->userdata['kd_skpd'];
		$key1 	= $this->input->post('key1');
		$key2 	= $this->input->post('key2');
		$key3 	= $this->input->post('key3');
		$res 	= $this->M_Manage->loadHeader($key1,$key2,$key3,$otori,$skpd);
    	echo json_encode($res);
	}

	public function getRuang()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->session->userdata('kd_skpd'); 
		$res 		= $this->M_Kibb->getRuang($lccq,$skpd);
		echo json_encode($res);
	}
 
}

/* End of file C_Mutasi.php */
/* Location: ./application/controllers/transaksi/C_Mutasi.php */