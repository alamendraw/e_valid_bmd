<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Mutasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Mutasi');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Mutasi Barang",
			'judul'		=> "Data Mutasi Barang",
			'deskripsi'	=> "Mutasi Barang"
		);
		$this->template->views('transaksi/mutasi/V_Mutasi', $data);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Tambah Mutasi Barang",
			'judul'		=> "Tambah Data Mutasi Barang",
			'deskripsi'	=> "Tambah Mutasi Barang"
		);
		$this->template->views('transaksi/mutasi/V_Add_Mutasi', $data);
	}
	
	public function getKelompok()
	{
		$res = $this->M_Mutasi->getKelompok();
		echo json_encode($res);
	}
	
	public function getJenis()
	{
		$data = array(
			'kd' 	=> $this->input->post('kel'),
			'lccq' 	=> $this->input->post('q')
		);
		$res = $this->M_Mutasi->getJenis($data);
		echo json_encode($res);
	}

	public function getBarang()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'sk' 	=> $this->input->post('skp'),
			'lccq' 	=> $this->input->post('q')
		);
		$result = $this->M_Mutasi->getBarang($data);

		echo json_encode($result);
	}

	public function getSkpd()
	{
		$result = $this->M_Mutasi->getSkpd();
		echo json_encode($result);
	}
	
	public function getSkpdBaru()
	{
		$result = $this->M_Mutasi->getSkpdBaru();
		echo json_encode($result);
	}
	
	public function getUnit() {
		$skpd = $this->input->post('kode');
		$result = $this->M_Mutasi->getUnit($skpd);
		echo json_encode($result);
	}
	
	public function getSkpd_tuju()
	{
		$result = $this->M_Mutasi->getSkpd_tuju();
		echo json_encode($result);
	}

	// public function getProgram()
	// {
	// 	$param = $this->input->post();
	// 	$result = $this->M_Mutasi->getProgram($param);
	// 	echo json_encode($result);
	// }
	// public function getKegiatan()
	// {
	// 	$param = $this->input->post();
	// 	$result = $this->M_Mutasi->getKegiatan($param);
	// 	echo json_encode($result);
	// }

	public function getSatuan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Mutasi->getSatuan($lccq);
		echo json_encode($res);
	}
	
	public function saveData(){
		$no_dokumen 	= $this->input->post('no_dokumen');
		$tgl_dokumen 	= $this->input->post('tgl_dokumen');
		$kd_skpd 		= $this->input->post('kd_skpd');
		$kd_unit 		= $this->input->post('kd_unit');
		$kd_skpd_baru 	= $this->input->post('kd_skpd_baru');
		$kd_unit_baru 	= $this->input->post('kd_unit_baru');
		$tahun 			= $this->input->post('tahun');
		$total 			= $this->input->post('total');
		$status 		= $this->input->post('status');
		$kib 		= $this->input->post('kib');
		$nm_user	= $this->session->userdata('nm_user');
		$data 		= json_decode($this->input->post('detail'));
 
		$header = array(
				'no_dokumen' 	=> htmlspecialchars($no_dokumen, ENT_QUOTES),
				'tgl_dokumen' 	=> $this->M_Mutasi->tanggal_balik(htmlspecialchars($tgl_dokumen, ENT_QUOTES)),
				'kd_unit' 		=> htmlspecialchars($kd_unit, ENT_QUOTES),
				'kd_skpd' 		=> htmlspecialchars($kd_skpd, ENT_QUOTES),
				'tahun' 		=> htmlspecialchars($tahun, ENT_QUOTES),
				'username' 		=> htmlspecialchars($nm_user, ENT_QUOTES),
				'tgl_update' 	=> date('Y-m-d h:m:s'),
				'total' 		=> htmlspecialchars($total, ENT_QUOTES),
				'cad' 			=> '02.1',
				'xkd' 			=> '0',
				'kd_unit_baru' 	=> htmlspecialchars($kd_unit_baru, ENT_QUOTES),
				'kd_skpd_baru' 	=> htmlspecialchars($kd_skpd_baru, ENT_QUOTES),
				'tabel' 		=> $kib
		);
		
		$h =	$this->M_Mutasi->simpan_header($header,$status,$no_dokumen,$kd_unit);
	 
		if($h == 1 ){
				$sukses =	$this->M_Mutasi->simpan_detail($data,$no_dokumen,$kd_unit,$status);
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
		$sukses = $this->M_Mutasi->hapus($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else{
				echo json_encode(array('pesan'=>false));
			}
	}
	
	function max_number(){

        $data = array(
        	'unit'		=> $this->session->userdata('kd_unit'),
        	'table'		=> $this->input->post('table'),
        	'kolom' 	=> $this->input->post('kolom')
    	);

    	$result = $this->M_Mutasi->max_number($data);
        echo json_encode($result);
	}

	function trd_mutasi(){

        $data = array(
        	'nomor'		=> $this->input->post('no'), 	// no_dokumen
        	'unit' 		=> $this->input->post('kode')	// uskpd
    	);

    	$res = $this->M_Mutasi->load_trd($data);
    	echo json_encode($res);
    }

    function getNmSkpd($kdskpd){
    	$proses = $this->db->query("SELECT nm_skpd from mskpd where kd_skpd='$kdskpd'")->row('nm_skpd');
    	return $proses;
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
		$limit = "ORDER BY tgl_dokumen desc LIMIT $rows OFFSET $offset";
		if($key!=''){
		$and2 = "and upper(nm_uskpd) like upper('%$key%') 
			   or upper(no_dokumen) like upper('%$key%') 
			   or upper(tahun) like upper('%$key%')";	
		$limit = "";	
		}
		if($oto=='01'){
			$and1 = "";
		}elseif($oto=='02'){
			$and1 = "and kd_skpd='$skpd'";
		}else{
			$and1 = "";
		}
		
		$sql = "SELECT count(*) as tot 
		from transaksi.trh_mutasi
		where no_dokumen is not null $and1 $and2" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT no_dokumen,tgl_dokumen,kd_unit,kd_skpd,tahun,total,kd_unit_baru,kd_skpd_baru,tabel,xkd from transaksi.trh_mutasi
				where no_dokumen is not null $and1 $and2 $limit";
				// print_r($sql);
				// exit();
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte) { 
        	 
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
                'no_dokumen' 	=> $resulte['no_dokumen'],
                'tgl_dokumen' 	=> $this->M_Mutasi->tanggal_ind($resulte['tgl_dokumen']),
                'kd_unit' 		=> $resulte['kd_unit'],
                'kd_skpd' 		=> $resulte['kd_skpd'],
                'tahun' 		=> $resulte['tahun'],
                'total' 		=> $resulte['total'],
                'kd_unit_baru' 	=> $resulte['kd_unit_baru'],
                'kd_skpd_baru' 	=> $resulte['kd_skpd_baru'],
                'xkd' 			=> $resulte['xkd'],
                'tabel' 		=> $resulte['tabel'],
                'nm_skpd' 		=> $this->getNmSkpd($resulte['kd_skpd']), 
                'nm_skpd_baru' 	=> $this->getNmSkpd($resulte['kd_skpd_baru']), 
                'icon' 			=> $icon, 
            );
            $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
	}

    function load_kib() {
		$oto 	= $this->session->userdata('oto');
		$skpd 	= $this->session->userdata('kd_skpd');
		$tabel 	= $this->input->post('kib'); 
		$unit 	= $this->input->post('unit'); 
		$tahun 	= $this->input->post('tahun'); 
	 
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$and2 = '';
		$limit = "ORDER BY no_dokumen ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$and2 = "and upper(a.tgl_reg) like upper('%$key%') 
			   or upper(a.no_dokumen) like upper('%$key%') 
			   or upper(a.tahun) like upper('%$key%')";	
		$limit = "";	
		}
		  
		$sql = "SELECT count(*) as tot 
		from transaksi.$tabel
		where no_dokumen is not null and tahun='$tahun' and kd_unit='$unit' $and2" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		 
        $sql = "SELECT a.id_barang,a.jumlah,a.no_reg,tgl_reg,a.kd_brg,b.uraian,nilai,kondisi,tahun,keterangan from transaksi.$tabel a
				inner join public.mbarang b on a.kd_brg=b.kd_brg 
				where no_dokumen is not null and a.tahun='$tahun'and a.kd_unit='$unit' and id_lokasi not in 
				(SELECT id_barang from transaksi.trd_mutasi where kd_unit='$unit') $and2 $limit";
				// print_r($sql); exit();
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte) { 
            $row[] = array(
                'id' 			=> $ii,         
                'tgl_reg' 	=>  $this->M_Mutasi->tanggal_ind($resulte['tgl_reg']),
                'no_reg' 	=> $resulte['no_reg'],
                'id_barang' 	=> $resulte['id_barang'],
                'jumlah' 	=> $resulte['jumlah'],
                'kd_brg' 	=> $resulte['kd_brg'],
                'uraian' 	=> $resulte['uraian'],
                'nilai' 	=> number_format($resulte['nilai'],2),
                'kondisi' 	=> $resulte['kondisi'],
                'tahun' 	=> $resulte['tahun'],
                'keterangan' 	=> $resulte['keterangan'], 
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