<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Kiba extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Kiba');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{

		$a['page']  ='transaksi/inventarisasi/V_Kiba';
		$a['title'] ='Inventarisasi KIB A ++';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
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
			'page' 		=> "Tambah Inventarisasi KIB A",
			'judul'		=> "Tambah Inventarisasi KIB A",
			'deskripsi'	=> "Tambah Inventarisasi KIB A"
		);
		$this->load->views('transaksi/inventarisasi/V_Add_Kiba', $data);
	}
	
	public function getDokumen(){
		$kib	= $this->input->post('kib');
		$result = $this->M_Kiba->getDokumen($kib);
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

		$result = $this->M_Kiba->getBarang($data);

		echo json_encode($result);
	}

	public function getSkpd(){
		$result = $this->M_Kiba->getSkpd();
		echo json_encode($result);
	}

	public function getCamat(){
		$result = $this->M_Kiba->getCamat();
		echo json_encode($result);
	}

	public function getLurah(){
		$result = $this->M_Kiba->getLurah();
		echo json_encode($result);
	}

	public function getFasilitas(){
		$result = $this->M_Kiba->getFasilitas();
		echo json_encode($result);
	}

	public function getSertifikat(){
		$result = $this->M_Kiba->getSertifikat();
		echo json_encode($result);
	}

	public function getRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kiba->getRincian($lccq,$akun,$kel,$jenis);
		echo json_encode($res);
	}
	
	public function getSubRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$rincian= $this->input->post('rincian');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kiba->getSubRincian($lccq,$akun,$kel,$jenis,$rincian);
		echo json_encode($res);
	}
	
	public function getKdbarang()
	{
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$subrinci	= $this->input->post('sub_rincian');
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getKdbarang($lccq,$akun,$kel,$jenis,$subrinci);
		echo json_encode($res);
	}
	
	public function getMilik()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getMilik($lccq);
		echo json_encode($res);
	}
	
	
	public function getWilayah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getWilayah($lccq);
		echo json_encode($res);
	}
	
	public function getUnit()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->input->post('kd_skpd');
		$res 		= $this->M_Kiba->getUnit($lccq,$skpd);
		echo json_encode($res);
	}
	
	public function getOleh()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getOleh($lccq);
		echo json_encode($res);
	}

	public function getmatriks()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getmatriks($lccq);
		echo json_encode($res);
	}
	
	public function getDasar()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getDasar($lccq);
		echo json_encode($res);
	}
	
	public function getStatustanah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getStatustanah($lccq);
		echo json_encode($res);
	}
	
	public function getKondisi()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kiba->getKondisi($lccq);
		echo json_encode($res);
	}

 
	public function simpan(){ 
 		$upload_sert= $_FILES['upload']['name'];  
		$tahun		= $this->input->post('thn_oleh');
		$skpd		= $this->input->post('kd_skpd');
		$kd_brg		= $this->input->post('kd_barang');

		if($upload_sert!=''){
			$config['upload_path']   = './uploads/kibA';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['max_size']      = '1024';
			$config['max_width']     = '1024';
			$config['max_height']    = '768';
			$config['file_name']     = md5($_FILES['upload']['name'].time().date('Y-m-d'));
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
			$this->upload->do_upload('upload');
			$file_name   = $this->upload->data();
			$upload_sert = $file_name['file_name']; 
		}

		// Proses Upload Foto
		$foto1 = '';
		$foto2 = '';
		$foto3 = '';
		$foto4 = '';

		$config['upload_path']   = './uploads/history'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size']      = '6024';
		$config['max_width']     = '4024';
		$config['max_height']    = '7680'; 
		$config['encrypt_name']  = FALSE;   
	   
	    $this->load->library('upload',$config);
	    for ($i=1; $i <=4; $i++) { 
	    	if(!empty($_FILES['filefoto'.$i]['name'])){
	    		$config['file_name']     = md5($_FILES['filefoto'.$i]['name'].$i.time().date('Y-m-d'));
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
	    		if(!$this->upload->do_upload('filefoto'.$i)){
	    			$this->upload->display_errors();	
	    		}else{
	    			if($i=='1'){
	    				$name = $this->upload->data();
	    				$foto1 = $name['file_name'];
	    			}else if($i=='2'){
	    				$name = $this->upload->data();
	    				$foto2 = $name['file_name'];
	    			}else if($i=='3'){
	    				$name = $this->upload->data();
	    				$foto3 = $name['file_name'];
	    			}else if($i=='4'){
	    				$name = $this->upload->data();
	    				$foto4 = $name['file_name'];
	    			}
	    			$datag1 = array('upload_data' => $this->upload->data()); 
					$this->resize($datag1['upload_data']['full_path'],$datag1['upload_data']['file_name']);
	    		}
	    	}
	    }

		$data = array( 
			'no_dokumen'        => $this->input->post('no_dokumen'),
			'kd_barang'         => $this->input->post('kd_barang'),
			'milik'             => $this->input->post('milik'),
			'wil'               => $this->input->post('wil'),
			'kd_skpd'           => $skpd,
			'kd_unit'           => $this->input->post('kd_unit'),
			'perolehan'         => $this->input->post('perolehan'),
			'dasar'             => $this->input->post('dasar'),
			'no_oleh'           => $this->input->post('no_oleh'),
			'tgl_oleh'          => $this->tanggal_balik($this->input->post('tgl_oleh')),
			'thn_oleh'          => $tahun,
			'hrg_oleh'          => filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'tgl_regis'         => $this->tanggal_balik($this->input->post('tgl_regis')),
			'sts_tanah'         => $this->input->post('sts_tanah'),
			'kondisi'           => $this->input->post('kondisi'),
			'no_sert'           => $this->input->post('no_sert'),
			'tgl_sert'          => $this->tanggal_balik($this->input->post('tgl_sert')),
			'luas'              => $this->input->post('luas'),
			'alamat1'           => $this->input->post('alamat1'),
			'alamat2'           => $this->input->post('alamat2'),
			'alamat3'           => $this->input->post('alamat3'),
			'latitude'          => $this->input->post('latitude'),
			'longtitude'        => $this->input->post('longtitude'),
			'keterangan'        => $this->input->post('keterangan'),
			'penggunaan'        => $this->input->post('penggunaan'),
			'detail'            => $this->input->post('detail'),
			'upload_sert'       => $upload_sert,
			'gambar1'           => $foto1,
			'gambar2'           => $foto2,
			'gambar3'           => $foto3,
			'gambar4'           => $foto4,
			'camat'             => $this->input->post('camat'),
			'lurah'             => $this->input->post('lurah'),
			'pemegang_hak'      => $this->input->post('pemegang_hak'),
			'b_barat'           => $this->input->post('b_barat'),
			'b_timur'           => $this->input->post('b_timur'),
			'b_selatan'         => $this->input->post('b_selatan'),
			'b_utara'           => $this->input->post('b_utara'),
			'no_surat_ukur'     => $this->input->post('no_surat_ukur'),
			'tgl_surat_ukur'    => $this->tanggal_balik($this->input->post('tgl_surat_ukur')),
			'status_sertifikat' => $this->input->post('status_sertifikat'),
			'fasilitas'         => $this->input->post('fasilitas'),
			'ket_matriks'       => $this->input->post('ket_matriks'),
			'kronologis'        => $this->input->post('kronologis')

		);



		$simpan = $this->M_Kiba->saveData($data);
/*********/			
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
		$config['new_image']       	= './uploads/kibA/'.$file; 
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		if (file_exists('./uploads/history/'.$file)) {
			$path1 ='./uploads/history/'.$file;
			unlink($path1); 
		}
	}


	public function edit(){ 
		$upload_sert= $_FILES['upload']['name'];  
		$tahun		= $this->input->post('thn_oleh');
		$skpd		= $this->input->post('kd_skpd');
		$unit 		= $this->input->post('kd_unit');
		$kd_brg		= $this->input->post('kd_barang');
		$id_barang  = $this->input->post('id_barang');

		if($upload_sert!=''){
			$query = "SELECT upload_sert FROM transaksi.trkib_a WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'";
			$sql   = $this->db->query($query)->row('upload_sert');
			if($sql!=null || $sql!=''){
				if (file_exists(FCPATH.'uploads/kibA/'.$sql)) {
					$path = FCPATH.'uploads/kibA/'.$sql;
					unlink($path);
				}
			}
			$config['upload_path']   = './uploads/kibA';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['max_size']      = '1024';
			$config['max_width']     = '1024';
			$config['max_height']    = '768';
			$config['file_name']     = md5($_FILES['upload']['name'].time().date('Y-m-d'));
			$config['encrypt_name']  = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
			$this->upload->do_upload('upload');
			$file_name   = $this->upload->data();
			$upload_sert = $file_name['file_name'];
		}else{
			$query = $this->db->query("SELECT upload_sert FROM transaksi.trkib_a WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row();
			$upload_sert = $query->upload_sert;
		}
		// Proses Upload Foto
		$foto1 = '';
		$foto2 = '';
		$foto3 = '';
		$foto4 = ''; 

		$config['upload_path']   = './uploads/history'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size']      = '6024';
		$config['max_width']     = '4024';
		$config['max_height']    = '7680';
		$cek = $this->db->query("SELECT foto1,foto2,foto3,foto4 FROM transaksi.trkib_a WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row_array();
		for ($i=1; $i <=4; $i++) { 
			if(!empty($_FILES['filefoto'.$i]['name'])){
				$config['file_name']     = md5($_FILES['filefoto'.$i]['name'].$i.time().date('Y-m-d'));
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('filefoto'.$i)){
					$this->upload->display_errors();	
				}else{
					if ($cek['foto'.$i]!='' || $cek['foto'.$i]!=null) {
						if (file_exists('./uploads/kibA/'.$cek['foto'.$i])) {
							$path1 ='./uploads/kibA/'.$cek['foto'.$i];
							unlink($path1); 
						}
					}
					if($i=='1'){
						$name = $this->upload->data();
						$foto1 = $name['file_name'];
					}else if($i=='2'){
						$name = $this->upload->data();
						$foto2 = $name['file_name'];
					}else if($i=='3'){
						$name = $this->upload->data();
						$foto3 = $name['file_name'];
					}else if($i=='4'){
						$name = $this->upload->data();
						$foto4 = $name['file_name'];
					}
					$datag1 = array('upload_data' => $this->upload->data()); 
					$this->resize($datag1['upload_data']['full_path'],$datag1['upload_data']['file_name']);
				}
			}else{
				$query = $this->db->query("SELECT foto1,foto2,foto3,foto4 FROM transaksi.trkib_a WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row();
				// print_r($this->db->last_query());
				if ($i==1) {
					$foto1 = $query->foto1;
				}else if($i==2){
					$foto2 = $query->foto2;
				}else if($i==3){
					$foto3 = $query->foto3;
				}else if($i==4){
					$foto4 = $query->foto4;
				}
			}
		}
	    // End Proses Upload Foto
		$data = array(
			'id_barang'         => $this->input->post('id_barang'),
			'no_regis'          => $this->input->post('no_regis'),
			'no_dokumen'        => $this->input->post('no_dokumen'),
			'rincian'           => $this->input->post('rincian'),
			'sub_rincian'       => $this->input->post('sub_rincian'),
			'kd_barang'         => $this->input->post('kd_barang'),
			'milik'             => $this->input->post('milik'),
			'wil'               => $this->input->post('wil'),
			'kd_skpd'           => $this->input->post('kd_skpd'),
			'kd_unit'           => $this->input->post('kd_unit'),
			'perolehan'         => $this->input->post('perolehan'),
			'dasar'             => $this->input->post('dasar'),
			'no_oleh'           => $this->input->post('no_oleh'),
			'tgl_oleh'          => $this->tanggal_balik($this->input->post('tgl_oleh')),
			'thn_oleh'          => $this->input->post('thn_oleh'),
			'hrg_oleh'          => filter_var($this->input->post('hrg_oleh'),FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'tgl_regis'         => $this->tanggal_balik($this->input->post('tgl_regis')),
			'sts_tanah'         => $this->input->post('sts_tanah'),
			'kondisi'           => $this->input->post('kondisi'),
			'no_sert'           => $this->input->post('no_sert'),
			'tgl_sert'          => $this->tanggal_balik($this->input->post('tgl_sert')),
			'luas'              => $this->input->post('luas'),
			'alamat1'           => $this->input->post('alamat1'),
			'alamat2'           => $this->input->post('alamat2'),
			'alamat3'           => $this->input->post('alamat3'),
			'latitude'          => $this->input->post('latitude'),
			'longtitude'        => $this->input->post('longtitude'),
			'keterangan'        => $this->input->post('keterangan'),
			'penggunaan'        => $this->input->post('penggunaan'),
			'detail'            => $this->input->post('detail'),
			'kronologis'        => $this->input->post('kronologis'),
			'sts'               => $_REQUEST['sts'],
			'upload_sert'       => $upload_sert,
			'gambar1'           => $foto1,
			'gambar2'           => $foto2,
			'gambar3'           => $foto3,
			'gambar4'           => $foto4,
			'b_barat'           => $this->input->post('b_barat'),
			'b_timur'           => $this->input->post('b_timur'),
			'b_selatan'         => $this->input->post('b_selatan'),
			'b_utara'           => $this->input->post('b_utara'),
			'camat'             => $this->input->post('camat'),
			'lurah'             => $this->input->post('lurah'),
			'pemegang_hak'      => $this->input->post('pemegang_hak'),
			'no_surat_ukur'     => $this->input->post('no_surat_ukur'),
			'tgl_surat_ukur'    => $this->tanggal_balik($this->input->post('tgl_surat_ukur')),
			'status_sertifikat' => $this->input->post('status_sertifikat'),
			'fasilitas'         => $this->input->post('fasilitas'),
			'ket_matriks'       => $this->input->post('ket_matriks')
		);
		
		$simpan = $this->M_Kiba->editData($data);
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Berhasil Diupdate !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Mengupdate data !'));
		}
	}
	
	
	public function hapus(){
		$param  = $this->input->post();
		 
		$sukses = $this->M_Kiba->hapus($param);
		 
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}

	function hapus_img(){
		$id_barang = $this->input->post('id_barang');
		$field     = $this->input->post('field');
		$sql = "SELECT $field FROM transaksi.trkib_a WHERE id_barang='$id_barang'";
		$get = $this->db->query($sql)->row($field);
		// print_r($this->db->last_query());
		if ($get!='' || $get!=null) {
			if (file_exists('./uploads/kibA/'.$get)) {
				$path1 ='./uploads/kibA/'.$get;
				unlink($path1); 
			}
		}
		$hapus = $this->db->set($field,'')->where('id_barang',$id_barang)->update('transaksi.trkib_a');
		//print_r($this->db->last_query());
		if ($hapus) {
			echo json_encode(array('pesan'=>true,'message' =>'Foto berhasil dihapus !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menghapus foto !'));
		}
	}
	
	function max_number(){ 
		$unit = $this->input->post('unit');
		$kode = $this->input->post('kode');
        $data = array(
        	'table'		=> $this->input->post('table'),
        	'kolom' 	=> $this->input->post('kolom')
    	);
    	$result = $this->M_Kiba->max_number($unit,$kode);
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
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		$key1 = $this->input->post('key1');
		$key2 = $this->input->post('key2');
		$key3 = $this->input->post('key3');
		$res = $this->M_Kiba->loadHeader($key1,$key2,$key3,$otori,$skpd);
    	echo json_encode($res);
	}
	
	function cek_session(){
		$result =  $this->session->all_userdata(); 
		print_r ($result);
	}
	
	function load_barang(){
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$key		= $this->input->post('key'); 
		$res 		= $this->M_Kiba->loadBarang($akun,$kel,$jenis,$key);
    	echo json_encode($res);
	}

	

}