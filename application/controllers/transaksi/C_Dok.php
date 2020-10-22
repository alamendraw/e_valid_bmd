<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Dok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Dok');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Dokumen Pengadaan Barang",
			'judul'		=> "Dokumen Pengadaan Barang",
			'deskripsi'	=> "Dokumen Pengadaan Barang"
		);

		$this->template->views('transaksi/dokumen/V_Dok', $data);
	}


	function load_header(){
		$key = $this->input->post('key');
		$res = $this->M_Dok->loadHeader($key);
    	echo json_encode($res);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Tambah Dokumen Pengadaan Barang",
			'judul'		=> "Tambah Dokumen Pengadaan Barang",
			'deskripsi'	=> "Tambah Dokumen Pengadaan Barang"
		);

		$this->template->views('transaksi/dokumen/V_Add_Dok', $data);
	}


	public function get_comp()
	{
		$res 		= $this->M_Dok->get_comp();
		echo json_encode($res);
	}

	public function getMilik()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Dok->getMilik($lccq);
		echo json_encode($res);
	}

	public function getdana()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Dok->getdana($lccq);
		echo json_encode($res);
	}

	public function getbukti()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Dok->getbukti($lccq);
		echo json_encode($res);
	}

	public function getWilayah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Dok->getWilayah($lccq);
		echo json_encode($res);
	}

	public function getKontrak()
	{
		$result = $this->M_Dok->getKontrak();
		echo json_encode($result);
	}

	public function getSp2d()
	{
		$result = $this->M_Dok->getSp2d();
		echo json_encode($result);
	}

	public function getSkpd()
	{
		$result = $this->M_Dok->getSkpd();
		echo json_encode($result);
	}

	public function getUnit()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->input->post('kd_skpd');
		$unit 		= $this->input->post('kd_unit');
		$res 		= $this->M_Dok->getUnit($lccq,$skpd,$unit);
		echo json_encode($res);
	}


	public function getOleh()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Dok->getOleh($lccq);
		echo json_encode($res);
	}

	public function getDasar()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Dok->getDasar($lccq);
		echo json_encode($res);
	}

	public function getKegiatan()
	{
		$param = $this->input->post('skpd');
		$result = $this->M_Dok->getKegiatan($param);
		echo json_encode($result);
	}

	public function getrekening()
	{
		$result = $this->M_Dok->getrekening();
		echo json_encode($result);
	}

	public function getKelompok()
	{
		$lccq 		= $this->input->post('q');
		print_r($lccq);
		$res = $this->M_Dok->getKelompok($lccq);
		echo json_encode($res);
	}

	public function getJenis()
	{
		$data = array(
			'kd' 	=> $this->input->post('kel'),
			'lccq' 	=> $this->input->post('q')
		);
		$res = $this->M_Dok->getJenis($data);
		echo json_encode($res);
	}

	public function getKdbarangEdit()
	{
		$data = array(
			'kdBarang' => $this->input->post('kdBarang'),
			'lccq'     => $this->input->post('q')
		);
		$res = $this->M_Dok->getKdbarangEdit($data);
		echo json_encode($res);
	}

	

	function load_barang(){
		$kod 		= $this->input->post('kod');  
		$key		= $this->input->post('key'); 
		$res 		= $this->M_Dok->loadBarang($kod,$key);
    	echo json_encode($res);
	}

	public function getBarangAfDel()
	{
		$data = array(
				'kd' 	=> $this->input->post('kod'),
				'lccq' 	=> $this->input->post('q'),
				'skpd' 	=> $this->input->post('skpd'),
				'kdbrg' => $this->input->post('kdbrg')
		);

		$result = $this->M_Dok->getBarangAfDel($data);

		echo json_encode($result);
	}

	public function getBarangall()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'lccq' 	=> $this->input->post('q'),
			'skpd' 	=> $this->input->post('skpd')
		);

		$result = $this->M_Dok->getBarangall($data);

		echo json_encode($result);
	}

	public function getSatuan()
	{
		
		$res  = $this->M_Dok->getSatuan();
		echo json_encode($res);
	}

	public function saveData(){  
		$id_locks       = $this->db->query("SELECT max(id_lock)+1 id_lock from transaksi.trh_isianbrg")->row('id_lock');     
		$id_lockz 			= $this->input->post('id_lock');
		$skpd 			= $this->input->post('skpd');
		$unit 			= $this->input->post('unit');
		$kontrak 		= $this->input->post('kontrak'); 
		$nil_kontrak 	= $this->input->post('nil_kontrak');
		$s_dana 		= $this->input->post('s_dana'); 
		$data          = json_decode($this->input->post('detail'));
		$status 		= $this->input->post('status');
		if($id_locks==''){
			$id_locks = 1;
		}	 

		if($status=='detail'){
			$id_lock = $id_lockz;
		}else{
			$id_lock = $id_locks;
		}

		// $h =	$this->M_Dok->saveData($header,$status,$no_dokumen); $no_dokumen,$kd_unit,$kd_skpd,$s_dana,$nilai_kontrak,$post,$id_lock
		$h =	$this->M_Dok->saveData($id_lock);
		if($h == 1){
				$sukses =	$this->M_Dok->simpan_detail($kontrak,$unit,$skpd,$s_dana,$nil_kontrak,$data,$id_lock);
					if($sukses){
						echo json_encode(array('notif'=>true,'message'=>'Data Berhasil Disimpan !'));
						// echo json_encode('sda');
					}else {
						echo json_encode(array('notif'=>false,'message'=>'Data Gagal Disimpan !'));
					}
		}else{
			echo json_encode(array('notif'=>false,'message'=>'Nomor Dokumen Sudah ada, Mohon dicek kembali !'));
		}
	}

	function coba1(){
      
        print_r($this->session->all_userdata());
        
   	}

   	function max_number(){
    	$result = $this->M_Dok->max_number();
        echo json_encode($result);
	}

	public function hapus(){ 
		$sukses = $this->M_Dok->hapus();
		echo json_encode(1);
	}

	function load_detail(){

        $data = array(
        	'idLock'		=> $this->input->post('idLock'), 	// no_dokumen
        	'skpd' 		=> $this->input->post('kode')	// uskpd
    	);

    	$res = $this->M_Dok->load_detail($data);
    	echo json_encode($res);
    	//print_r($res);
    }

    public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}

	function get_api_simakda(){
		$skpd = $this->session->userdata('kd_skpd');
		$url="http://222.124.4.74/simakda_inhu2018/api/smbkd_api.php?skpd=$skpd";

        $data= $this->curl->simple_get($url);
        $result = array_values(json_decode($data,true));
	
        echo json_encode($result);
	}
		

	// function CallAPI( $url, $data = false)
	// {
	//     $curl = curl_init();
	//     curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//     curl_setopt($curl, CURLOPT_URL, $url);
	//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	//     $result = curl_exec($curl);
	//     curl_close($curl);
	//     return $result;
	// }

	function insert_rekanan(){
		$hrekan = $this->input->post('hkd_comp');
		$skpd = $this->input->post('skpd');
    	$sukses = $this->M_Dok->insert_rekanan($hrekan,$skpd);

    	echo json_encode(array('kode'=>$sukses));

  //       if($sukses){
		// 	echo json_encode(array('pesan'=>true));
		// }else {
		// 	echo json_encode(array('pesan'=>false));
		// }
	}

	//=========@Naga=====================================================

}