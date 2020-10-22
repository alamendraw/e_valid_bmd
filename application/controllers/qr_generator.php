<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_generator extends CI_Controller {

	public function index()
	{
		$this->load->library('qr');
		$server=$_SERVER['HTTP_HOST'];
		$url_components = parse_url($server); 
  
// Use parse_str() function to parse the 
// string passed via URL 

		$no_reg = htmlspecialchars($this->input->get('no_reg'), ENT_QUOTES);
		$kd_brg = htmlspecialchars($this->input->get('kd_brg'), ENT_QUOTES);
		$nm_brg = htmlspecialchars($this->input->get('nm_brg'), ENT_QUOTES);
		$nm_skpd = htmlspecialchars($this->input->get('nm_skpd'), ENT_QUOTES);
		$kd_skpd = htmlspecialchars($this->input->get('kd_skpd'), ENT_QUOTES);
		
		$tahun = htmlspecialchars($this->input->get('tahun'), ENT_QUOTES);

		$xdata = $no_reg.'.'.$kd_skpd.'.'.$kd_brg.'.'.$tahun;

		$isiQR = array('no_reg'=>$no_reg,
						'kode_barang'=>$xdata,
						'tahun'=>$tahun,
						'kd_skpd'=>$kd_skpd,
						'nm_skpd'=>$nm_skpd,
						'nm_brg'=>$nm_brg);


		$data = json_encode($isiQR);

		$img = QRcode::png($data);

		return $img;
	}

	
	public function kir()
	{
		$this->load->library('qr'); 

		$isii =  'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$data = json_encode($isii);

		$img = QRcode::png($data);

		return $img;
	}



}

/* End of file qrgenerator.php */
/* Location: ./application/controllers/qrgenerator.php */