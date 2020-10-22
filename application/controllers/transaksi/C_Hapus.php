<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Hapus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Hapus');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Penghapusan Barang",
			'judul'		=> "Data Penghapusan Barang",
			'deskripsi'	=> "Penghapusan Barang"
		);
		$this->template->views('transaksi/hapus/V_Hapus', $data);
	}

	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
	}
	public function add()
	{
		$data = array(
			'page' 		=> "Tambah Penghapusan Barang",
			'judul'		=> "Tambah Data Penghapusan Barang",
			'deskripsi'	=> "Tambah Penghapusan Barang"
		);
		$this->template->views('transaksi/hapus/V_Add_Hapus', $data);
	}
	
	public function getKelompok()
	{
		$res = $this->M_Hapus->getKelompok();
		echo json_encode($res);
	}
	
	public function getJenis()
	{
		$data = array(
			'kd' 	=> $this->input->post('kel'),
			'lccq' 	=> $this->input->post('q')
		);
		$res = $this->M_Hapus->getJenis($data);
		echo json_encode($res);
	}

	public function getBarang()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'ut' 	=> $this->input->post('unit'),
			'lccq' 	=> $this->input->post('q')
		);
		$result = $this->M_Hapus->getBarang($data);

		echo json_encode($result);
	}

	public function getSkpd()
	{
		$result = $this->M_Hapus->getSkpd();
		echo json_encode($result);
	}
	
	public function getUnit()
	{
		$result = $this->M_Hapus->getUnit();
		echo json_encode($result);
	}
	
	public function getSkpd_tuju()
	{
		$result = $this->M_Hapus->getSkpd_tuju();
		echo json_encode($result);
	}
	 

	public function getSatuan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Hapus->getSatuan($lccq);
		echo json_encode($res);
	}
	
	public function saveData(){
		$no_dokumen	= $this->input->post('no_dok');
		$tgl_dokumen= $this->input->post('tgl_dok');
		$kd_skpd	= $this->input->post('kd_skpd');
		$kd_unit	= $this->input->post('kd_unit');
		// $nm_uskpd	= $this->session->userdata('nm_skpd');
		$tahun  	= $this->input->post('tahun'); 
		$total  	= $this->input->post('total');
		$status  	= $this->input->post('status');
		$tabel  	= $this->input->post('tabel');
		$nm_user	= $this->session->userdata('nm_user');
		$data 		= json_decode($this->input->post('detail'));
		
		$header = array(
				'no_dokumen' 	=> htmlspecialchars($no_dokumen, ENT_QUOTES),
				'tgl_dokumen' 	=> htmlspecialchars($this->tanggal_balik($tgl_dokumen), ENT_QUOTES),
				'kd_unit' 		=> '',
				'kd_skpd' 		=> htmlspecialchars($kd_skpd, ENT_QUOTES),
				// 'nm_uskpd' 		=> htmlspecialchars($nm_uskpd, ENT_QUOTES),
				'tahun' 		=> htmlspecialchars($tahun, ENT_QUOTES),
				'username' 		=> htmlspecialchars($nm_user, ENT_QUOTES),
				'tgl_update' 	=> date('Y-m-d h:m:s'),
				'total' 		=> htmlspecialchars($total, ENT_QUOTES), 
				'tabel' 		=> htmlspecialchars($tabel, ENT_QUOTES),
				'cad' 			=> '02.1',
				'xkd' 			=> '1'
		);
		
		$h =	$this->M_Hapus->simpan_header($header,$status,$no_dokumen,$kd_skpd);
		if($h == 1 ){
				$sukses =	$this->M_Hapus->simpan_detail($data,$no_dokumen,$kd_skpd,$status);
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
		$sukses = $this->M_Hapus->hapus($param);
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

    	$result = $this->M_Hapus->max_number($data);
        echo json_encode($result);
	}

	function trd_hapus(){

        $data = array(
        	'nomor'		=> $this->input->post('no'), 	// no_dokumen
        	'skpd' 		=> $this->input->post('kode')	// uskpd
    	);

    	$res = $this->M_Hapus->load_trd($data);
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
		$limit = "ORDER BY a.tgl_dokumen desc LIMIT $rows OFFSET $offset";
		if($key!=''){
		$and2 = "and upper(a.nm_uskpd) like upper('%$key%') 
			   or upper(a.no_dokumen) like upper('%$key%') 
			   or upper(a.tahun) like upper('%$key%')";	
		$limit = "";	
		}
		if($oto=='01'){
			$and1 = "";
		}elseif($oto=='02'){
			$and1 = "and a.kd_skpd='$skpd'";
		}else{
			$and1 = "";
		}
		
		$sql = "SELECT count(a.*) as tot 
		from transaksi.trh_hapus a 
		where a.no_dokumen is not null $and1 $and2" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT a.*,b.nm_skpd from transaksi.trh_hapus a 
				join public.mskpd b on a.kd_skpd=b.kd_skpd 
				where a.no_dokumen is not null $and1 $and2 $limit";
				// print_r($sql);
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte){
        	switch ($resulte['xkd']) {
			    case 1:
			        $icon = "<div style='width: 0; height: 0; border-top: 20px solid #90EE90; border-right: 20px solid transparent;'></div>";
			        break;
			    case 2:
			        $icon = "<div style='width: 0; height: 0; border-top: 20px solid #FF6600; border-right: 20px solid transparent;'></div>";
			        break; 
			    default:
			        $icon 	= "<div style='width: 0; height: 0; border-top: 20px solid #D3D3D3; border-right: 20px solid transparent;'></div>";
			}  
            $row[] = array(
                'id' 			=> $ii,        
                'kd_skpd' 		=> $resulte['kd_skpd'],
                'kd_unit' 		=> $resulte['kd_unit'],
                'no_dokumen' 	=> $resulte['no_dokumen'],
                'tgl_dokumen' 	=> $resulte['tgl_dokumen'],
                'tahun' 		=> $resulte['tahun'],
                'nm_uskpd' 		=> $resulte['nm_skpd'], 
                'cad'			=> $resulte['cad'],
                'xkd'			=> $resulte['xkd'],
                'icon'			=> $icon,
            );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
	}

}

/* End of file C_Mutasi.php */
/* Location: ./application/controllers/transaksi/C_Mutasi.php */