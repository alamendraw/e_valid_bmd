<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Kibg extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Kibg');
		$this->load->model('perencanaan/M_Pengadaan');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Inventarisasi ATB",
			'judul'		=> "Inventarisasi ATB",
			'deskripsi'	=> "Inventarisasi ATB"
		);

		$this->template->views('transaksi/inventarisasi/V_Kibg', $data);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Tambah Inventarisasi ATB",
			'judul'		=> "Tambah Inventarisasi ATB",
			'deskripsi'	=> "Tambah Inventarisasi ATB"
		);
		$this->template->views('transaksi/inventarisasi/V_Add_Kibg', $data);
	}
	
	public function getDokumen(){
		$kib	= $this->input->post('kib');
		$result = $this->M_Kibg->getDokumen($kib);
		echo json_encode($result);
	}
	public function getKelompok()
	{
		$res = $this->M_Pengadaan->getKelompok();
		echo json_encode($res);
	}
	
	public function getJenis()
	{
		$data = array(
			'kd' 	=> $this->input->post('kel'),
			'lccq' 	=> $this->input->post('q')
		);
		$res = $this->M_Pengadaan->getJenis($data);
		echo json_encode($res);
	}

	public function getBarang()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'lccq' 	=> $this->input->post('q')
		);

		$result = $this->M_Pengadaan->getBarang($data);

		echo json_encode($result);
	}

	function load_barang(){
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$rincian	= $this->input->post('rincian'); 
		$key		= $this->input->post('key'); 
		$res 		= $this->M_Kibg->loadBarang($akun,$kel,$jenis,$rincian,$key);
    	echo json_encode($res);
	}

	public function getSkpd()
	{
		$result = $this->M_Kibg->getSkpd();
		echo json_encode($result);
	}

	public function getRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibg->getRincian($lccq,$akun,$kel,$jenis);
		echo json_encode($res);
	}
	
	public function getSubRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$rincian= $this->input->post('rincian');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibg->getSubRincian($lccq,$akun,$kel,$jenis,$rincian);
		echo json_encode($res);
	}
	
	public function getKdbarang()
	{
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$rincian	= $this->input->post('rincian');
		$subrinci	= $this->input->post('sub_rincian');
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getKdbarang($lccq,$akun,$kel,$jenis,$rincian,$subrinci);
		echo json_encode($res);
	}
	public function getMilik()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getMilik($lccq);
		echo json_encode($res);
	}
	
	
	public function getWilayah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getWilayah($lccq);
		echo json_encode($res);
	}
	
	public function getUnit()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->input->post('kd_skpd');
		$res 		= $this->M_Kibg->getUnit($lccq,$skpd);
		echo json_encode($res);
	}
	
	public function getOleh()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getOleh($lccq);
		echo json_encode($res);
	}
	public function getmatriks()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getmatriks($lccq);
		echo json_encode($res);
	}
	public function getDasar()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getDasar($lccq);
		echo json_encode($res);
	}
	
	public function getStatustanah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getStatustanah($lccq);
		echo json_encode($res);
	}
	
	public function getKondisi()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getKondisi($lccq);
		echo json_encode($res);
	}
	
	public function getJenisBangun()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getJenisBangun($lccq);
		echo json_encode($res);
	}
	
	public function getKonstruksi()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getKonstruksi($lccq);
		echo json_encode($res);
	}
	
	public function getKonstruksi2()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibg->getKonstruksi2($lccq);
		echo json_encode($res);
	}
	
	public function simpan(){
		// Proses Upload Foto
		$foto1 = '';
		$foto2 = ''; 

		$config['upload_path'] = './uploads/history'; 
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size']  = '6024';
		$config['max_width']  = '4024';
		$config['max_height']  = '7680'; 
	    $config['encrypt_name'] = FALSE;   
	   
	    $this->load->library('upload',$config);
	    for ($i=1; $i <=4 ; $i++) { 
	    	if(!empty($_FILES['filefoto'.$i]['name'])){
	    		if(!$this->upload->do_upload('filefoto'.$i))
	    			$this->upload->display_errors();	
	    		else
	    			if($i=='1'){
	    				$foto1 = $_FILES['filefoto'.$i]['name'];
	    			}else{
	    				$foto2 = $_FILES['filefoto'.$i]['name'];
	    			}
	    			 
	    			$datag1 = array('upload_data' => $this->upload->data()); 
					$this->resize($datag1['upload_data']['full_path'],$datag1['upload_data']['file_name']);
	    	}
	    }
	    // End Proses Upload Foto


		$tahun		= $this->input->post('thn_oleh');
		$skpd		= $this->input->post('kd_skpd');
		$kd_brg		= $this->input->post('kd_barang');
		$no_regis	= $this->M_Kibg->max_number($tahun,$skpd,$kd_brg);
		$data = array(
			'no_regis'    => $no_regis,
			'no_dokumen'  => $this->input->post('no_dokumen'),
			'kd_barang'   => $this->input->post('kd_barang'),
			'milik'       => $this->input->post('milik'),
			'wil'         => $this->input->post('wil'),
			'kd_skpd'     => $skpd,
			'nm_skpd'     => $this->input->post('nm_skpd'),
			'kd_unit'     => $this->input->post('kd_unit'),
			'nm_unit'     => $this->input->post('nm_unit'),
			'perolehan'   => $this->input->post('perolehan'),
			'dasar'       => $this->input->post('dasar'),
			'no_oleh'     => $this->input->post('no_oleh'),
			'tgl_oleh'    => $this->tanggal_balik($this->input->post('tgl_oleh')),
			'thn_oleh'    => $tahun,
			'hrg_oleh'    => filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'jumlah'      => $this->input->post('jumlah'),
			'tgl_regis'   => $this->tanggal_balik($this->input->post('tgl_regis')),
			'kondisi'     => $this->input->post('kondisi'),
			'alamat1'     => $this->input->post('alamat1'),
			'alamat2'     => $this->input->post('alamat2'),
			'alamat3'     => $this->input->post('alamat3'),
			'keterangan'  => $this->input->post('keterangan'),
			'latitude'    => $this->input->post('latitude'),
			'longtitude'  => $this->input->post('longtitude'),
			'detail'      => $this->input->post('detail'),
			'ket_matriks' => $this->input->post('ket_matriks'),
			'gambar1'     => $foto1,
			'gambar2'     => $foto2,
		);
		 
		$simpan = $this->M_Kibg->saveData($data);
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}
		 
	}
	
	function resize($path, $file){
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $path; 
		$config['maintain_ratio'] 	= TRUE;
		$config['width']         	= 800;
		$config['height']       	= 600;
		$config['new_image']       	= 'uploads/kibG/'.$file; 
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		// --hapus gambar asli yg ada di folder history--
		$path1 = 'uploads/history/'.$file;
		if (file_exists($path1)) {
			unlink($path1); 
		}
		
	}


	public function edit(){
		// Proses Upload Foto
		$foto1 = '';
		$foto2 = ''; 

		$config['upload_path'] = './uploads/history'; 
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size']  = '6024';
		$config['max_width']  = '4024';
		$config['max_height']  = '7680'; 
	    $config['encrypt_name'] = FALSE;   
	   
	    $this->load->library('upload',$config);
	    for ($i=1; $i <=4 ; $i++) { 
	    	if(!empty($_FILES['filefoto'.$i]['name'])){
	    		if(!$this->upload->do_upload('filefoto'.$i))
	    			$this->upload->display_errors();	
	    		else
	    			if($i=='1'){
	    				$foto1 = $_FILES['filefoto'.$i]['name'];
	    			}else{
	    				$foto2 = $_FILES['filefoto'.$i]['name'];
	    			}
	    			 
	    			$datag1 = array('upload_data' => $this->upload->data()); 
					$this->resize($datag1['upload_data']['full_path'],$datag1['upload_data']['file_name']);
	    	}
	    }
	    // End Proses Upload Foto
		$data = array(
			'no_regis'		=> $this->input->post('no_regis'),
			'id_lokasi'		=> $this->input->post('id_lokasi'),
			'no_dokumen' 	=> $this->input->post('no_dokumen'),
			'kd_barang' 	=> $this->input->post('kd_barang'),
			'milik' 		=> $this->input->post('milik'),
			'wil' 			=> $this->input->post('wil'),
			'kd_skpd' 		=> $this->input->post('kd_skpd'),
			'nm_skpd' 		=> $this->input->post('nm_skpd'),
			'kd_unit' 		=> $this->input->post('kd_unit'),
			'nm_unit' 		=> $this->input->post('nm_unit'),
			'perolehan' 	=> $this->input->post('perolehan'),
			'dasar' 		=> $this->input->post('dasar'),
			'no_oleh' 		=> $this->input->post('no_oleh'),
			'tgl_oleh' 		=> $this->tanggal_balik($this->input->post('tgl_oleh')),
			'thn_oleh' 		=> $this->input->post('thn_oleh'),
			'hrg_oleh'          => filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'jumlah' 		=> $this->input->post('jumlah'),
			'tgl_regis' 	=> $this->tanggal_balik($this->input->post('tgl_regis')),
			'kondisi' 		=> $this->input->post('kondisi'),
			'konstruksi' 	=> $this->input->post('konstruksi'),
			'konstruksi2' 	=> $this->input->post('konstruksi2'),
			'jenis' 		=> $this->input->post('jenis'),
			'luas' 			=> $this->input->post('luas'),
			'tgl_mulai' 	=> $this->tanggal_balik($this->input->post('tgl_mulai')),
			'sts_tanah' 	=> $this->input->post('sts_tanah'),
			'kontrak' 		=> $this->input->post('kontrak'),
			'alamat1' 		=> $this->input->post('alamat1'),
			'alamat2'	 	=> $this->input->post('alamat2'),
			'alamat3' 		=> $this->input->post('alamat3'),
			'keterangan' 	=> $this->input->post('keterangan'),
			'latitude' 		=> $this->input->post('latitude'),
			'longtitude' 	=> $this->input->post('longtitude'),
			'kd_tanah' 		=> $this->input->post('kd_tanah'),
			'detail' 		=> $this->input->post('detail'),
			'ket_matriks' 	=> $this->input->post('ket_matriks'),
			'sts' 			=> $_REQUEST['sts'],
			'gambar1' 		=> $foto1,
			'gambar2' 		=> $foto2,
		);
		$config['upload_path'] = './uploads/';
		$config['max_size']  = '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);	
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		
		$simpan = $this->M_Kibg->editData($data);
		
		
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}
		
		
		
		// if($gambar1!=''){
		// 	if (file_exists('uploads/' . $gambar1)) {
		// 		echo json_encode(array('pesan'=>false,'message'=>'Gambar tersebut sudah ada, mohon ganti file / nama file yang akan di upload !'));
		// 		exit();
		// 	}else{
		// 		$this->upload->do_upload('gambar1');
		// 	}
			
		// }
		
		// if($gambar2!=''){
		// 	if (file_exists('uploads/' . $gambar2)) {
		// 		echo json_encode(array('pesan'=>false,'message'=>'Gambar tersebut sudah ada, mohon ganti file / nama file yang akan di upload !'));
		// 		exit();
		// 	}else{
		// 		$this->upload->do_upload('gambar2');
		// 	}
			
		// }
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_Kibg->hapus($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else{
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
	}
	
	function max_number(){

        $data = array(
        	'table'		=> $this->input->post('table'),
        	'kolom' 	=> $this->input->post('kolom')
    	);

    	$result = $this->M_Pengadaan->max_number($data);
        echo json_encode($result);
	}

	function trd_planbrg(){

        $data = array(
        	'nomor'		=> $this->input->post('no'), 	// no_dokumen
        	'skpd' 		=> $this->input->post('kode')	// uskpd
    	);

    	$res = $this->M_Pengadaan->load_trd($data);
    	echo json_encode($res);
    }

    function load_header(){
        $key1 = $this->input->post('key1');
        $key2 = $this->input->post('key2');
        $key3 = $this->input->post('key3');
		$res = $this->M_Kibg->loadHeader($key1,$key2,$key3);
    	echo json_encode($res);
	}
	

}