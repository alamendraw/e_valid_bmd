<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Reklas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Reklas');
	}
	public function index()
	{
		$data = array(
			'page' 		=> "Reklas Barang",
			'judul'		=> "Data Reklas Barang",
			'deskripsi'	=> "Reklas Barang"
		);

		$this->template->views('reklas/V_Reklas', $data);
	}
	
		public function add()
	{
		$data = array(
			'page' 		=> "Tambah Reklas Barang",
			'judul'		=> "Tambah Data Reklas Barang",
			'deskripsi'	=> "Tambah Reklas Barang"
		);
		$this->template->views('reklas/V_Add_Reklas', $data);
	}
	
	public function getKelompok()
	{
		$res = $this->M_Reklas->getKelompok();
		echo json_encode($res);
	}
	
	public function getJenis()
	{
		$data = array(
			'kd' 	=> $this->input->post('kel'),
			'lccq' 	=> $this->input->post('q'),
			'rd' 	=> $this->input->post('sw')
		);
		$res = $this->M_Reklas->getJenis($data);
		echo json_encode($res);
	}

	public function getBarang()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'tabel'	=> $this->input->post('tabel'),
			'skpd'	=> $this->input->post('skpd'),
			'lccq' 	=> $this->input->post('q')
		);

		$result = $this->M_Reklas->getBarang($data);

		echo json_encode($result);
	}

	public function getBarangNew()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'lccq' 	=> $this->input->post('q')
		);

		$result = $this->M_Reklas->getBarangNew($data);

		echo json_encode($result);
	}
	
	public function getSkpd()
	{
		$result = $this->M_Reklas->getSkpd();
		echo json_encode($result);
	}
	public function getProgram()
	{
		$param = $this->input->post();
		$result = $this->M_Reklas->getProgram($param);
		echo json_encode($result);
	}
	public function getKegiatan()
	{
		$param = $this->input->post();
		$result = $this->M_Reklas->getKegiatan($param);
		echo json_encode($result);
	}

	public function getSatuan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Reklas->getSatuan($lccq);
		echo json_encode($res);
	}
	
	public function saveData(){
		$sw			= $this->input->post('sw');
		$no_dokumen	= $this->input->post('no_dok');
		$tgl_dokumen= $this->input->post('tgl_dok');
		$kd_skpd	= $this->input->post('kd_skpd');
		$nm_uskpd	= $this->session->userdata('nm_user');
		$tahun  	= substr($this->input->post('tahun'),6,4);
		$program  	= $this->input->post('program');
		$total  	= $this->input->post('total');
		$status  	= $this->input->post('status');
		$nm_user	= $this->session->userdata('nm_user');
		$data 		= json_decode($this->input->post('detail'));
		
		$header = array(
				'no_dokumen' 	=> htmlspecialchars($no_dokumen, ENT_QUOTES),
				'tgl_dokumen' 	=> htmlspecialchars($tgl_dokumen, ENT_QUOTES),
				'kd_unit' 		=> '',
				'kd_uskpd' 		=> htmlspecialchars($kd_skpd, ENT_QUOTES),
				'nm_uskpd' 		=> htmlspecialchars($nm_uskpd, ENT_QUOTES),
				'tahun' 		=> htmlspecialchars($tahun, ENT_QUOTES),
				'username' 		=> htmlspecialchars($nm_user, ENT_QUOTES),
				'tgl_update' 	=> date('y-m-d h:m:s'),
				'total' 		=> htmlspecialchars($total, ENT_QUOTES),
				'kd_program' 	=> htmlspecialchars($program, ENT_QUOTES)
		);
		
		$h =	$this->M_Reklas->simpan_header($header,$status,$no_dokumen,$kd_skpd);
		if($h == 1 ){
				$sukses =	$this->M_Reklas->simpan_detail($data,$no_dokumen,$kd_skpd,$status,$sw);
					if($sukses){
						$kdp =	$this->M_Reklas->simpan_kdp($data,$no_dokumen,$kd_skpd,$status,$tgl_dokumen);
					}
				
					if($sukses){
                    	echo json_encode(array('notif'=>true,'message'=>'Data Berhasil Disimpan !'));
					}else {
                    	echo json_encode(array('notif'=>false,'message'=>'Data Gagal Disimpan !'));
					}
		}else{
                    	echo json_encode(array('notif'=>false,'message'=>'Nomor Dokumen Sudah ada, Mohon dicek kemali !'));
		}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_Perusahaan->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_Reklas->hapus($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else{
				echo json_encode(array('pesan'=>false));
			}
	}
	
	function max_number(){

        $data = array(
        	'skpd'		=> $this->session->userdata('kd_skpd'),
        	'table'		=> $this->input->post('table'),
        	'kolom' 	=> $this->input->post('kolom')
    	);

    	$result = $this->M_Reklas->max_number($data);
        echo json_encode($result);
	}

	function trd_reklas(){

        $data = array(
        	'nomor'		=> $this->input->post('no'), 	// no_dokumen
        	'skpd' 		=> $this->input->post('kode')	// uskpd
    	);

    	$res = $this->M_Reklas->load_trd($data);
    	echo json_encode($res);
    }

    function load_header()
	{
		$oto 	= $this->session->userdata('oto');
		$skpd 	= $this->session->userdata('kd_skpd');
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$and2 = '';
		$limit = "ORDER BY a.no_dokumen ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$and2 = "and upper(a.nm_uskpd) like upper('%$key%') 
			   or upper(a.no_dokumen) like upper('%$key%') 
			   or upper(a.tahun) like upper('%$key%')";	
		$limit = "";	
		}
		if($oto=='01'){
			$and1 = "";
		}elseif($oto=='02'){
			$and1 = "and a.kd_uskpd='$skpd'";
		}else{
			$and1 = "";
		}
		
		$sql = "SELECT count(a.*) as tot from transaksi.trh_Reklas a 
		where a.no_dokumen is not null $and1 $and2" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT a.*,b.nm_skpd from transaksi.trh_Reklas a 
		join public.mskpd b on a.kd_uskpd=b.kd_skpd
		where a.no_dokumen is not null $and1 $and2 $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                'id' 			=> $ii,        
                'kd_uskpd' 		=> $resulte['kd_uskpd'],
                'no_dokumen' 	=> $resulte['no_dokumen'],
                'tgl_dokumen' 	=> $resulte['tgl_dokumen'],
                'tahun' 		=> $resulte['tahun'],
                'nm_uskpd' 		=> $resulte['nm_skpd'],
                'kd_program'	=> $resulte['kd_program'],
            );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
	}


}

/* End of file C_Reklas.php */
/* Location: ./application/controllers/transaksi/C_Reklas.php */