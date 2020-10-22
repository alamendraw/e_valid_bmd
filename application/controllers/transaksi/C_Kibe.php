<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Kibe extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_Kibe');
		// $this->load->model('perencanaan/M_Pengadaan');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Inventarisasi KIB E",
			'judul'		=> "Inventarisasi KIB E",
			'deskripsi'	=> "Inventarisasi KIB E"
		);

		$this->template->views('transaksi/inventarisasi/V_Kibe', $data);
	}

	public function dataAset()
	{
		
		$a['page']  ='transaksi/inventarisasi/V_KibeAset';
		$a['title'] ='Inventarisasi KIB E';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
	}
	
	public function dataEca()
	{
		$data = array(
			'page' 		=> "Inventarisasi KIB E Eca",
			'judul'		=> "Inventarisasi KIB E Eca",
			'deskripsi'	=> "Inventarisasi KIB E Eca"
		);
		$this->template->views('transaksi/inventarisasi/V_KibeEca', $data);
	}

	public function dataRuang()
	{
		$data = array(
			'page' 		=> "Manajemen Data Ruangan KIB E",
			'judul'		=> "Manajemen Data Ruangan KIB E",
			'deskripsi'	=> "Manajemen Data Ruangan KIB E"
		);
		$this->template->views('transaksi/inventarisasi/V_RuangE', $data);
	}

	public function getMetode()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getMetode($lccq);
		echo json_encode($res);
	}
	  
	function load_ruang(){
		$otori 	= $this->session->userdata['oto'];
		$skpd 	= $this->session->userdata['kd_skpd']; 
		$res 	= $this->M_Kibe->load_ruang($otori,$skpd);
    	echo json_encode($res);
	}

	public function prosesPindah(){
		$param  = $this->input->post();
		$sukses = $this->M_Kibe->prosesPindah($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}

	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}
		
	public function add()
	{
		$a['page']  ='transaksi/inventarisasi/V_Add_Kibe';
		$a['title'] ='Tambah Inventarisasi KIB E';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
	}
	
	public function getDokumen(){
		$kib	= $this->input->post('kib');
		$result = $this->M_Kibe->getDokumen($kib);
		echo json_encode($result);
	}
	public function getKelompok()
	{
		// $res = $this->M_Pengadaan->getKelompok();
		// echo json_encode($res);
	}
	
	public function getJenis()
	{
		// $data = array(
		// 	'kd' 	=> $this->input->post('kel'),
		// 	'lccq' 	=> $this->input->post('q')
		// );
		// $res = $this->M_Pengadaan->getJenis($data);
		// echo json_encode($res);
	}

	public function getBarang()
	{
		// $data = array(
		// 	'kd' 	=> $this->input->post('kod'),
		// 	'lccq' 	=> $this->input->post('q')
		// );

		// $result = $this->M_Pengadaan->getBarang($data);

		// echo json_encode($result);
	}

	public function getSkpd()
	{
		$result = $this->M_Kibe->getSkpd();
		echo json_encode($result);
	}

	public function getRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibe->getRincian($lccq,$akun,$kel,$jenis);
		echo json_encode($res);
	}

	function load_barang(){
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$rinci	    = $this->input->post('rincian'); 
		$key		= $this->input->post('key'); 
		$res 		= $this->M_Kibe->loadBarang($akun,$kel,$jenis,$rinci,$key);
    	echo json_encode($res);
	}
	
	public function getSubRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$rincian= $this->input->post('rincian');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibe->getSubRincian($lccq,$akun,$kel,$jenis,$rincian);
		echo json_encode($res);
	}
	
	public function getKdbarang()
	{
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$subrinci	= $this->input->post('sub_rincian');
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getKdbarang($lccq,$akun,$kel,$jenis,$subrinci);
		echo json_encode($res);
	}
	
	public function getMilik()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getMilik($lccq);
		echo json_encode($res);
	}
	
	
	public function getWilayah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getWilayah($lccq);
		echo json_encode($res);
	}
	
	public function getUnit()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->input->post('kd_skpd');
		$res 		= $this->M_Kibe->getUnit($lccq,$skpd);
		echo json_encode($res);
	}


	public function getRuang()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->input->post('kd_skpd');
		$unit 		= $this->input->post('kd_unit');
		$res 		= $this->M_Kibe->getRuang($lccq,$skpd,$unit);
		echo json_encode($res);
	}
	
	public function getOleh()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getOleh($lccq);
		echo json_encode($res);
	}
	public function getmatriks()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getmatriks($lccq);
		echo json_encode($res);
	}
	public function getDasar()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getDasar($lccq);
		echo json_encode($res);
	}
	
	public function getSatuan()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getSatuan($lccq);
		echo json_encode($res);
	}
	
	public function getbahan()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getBahan($lccq);
		echo json_encode($res);
	}
	
	public function getKondisi()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibe->getKondisi($lccq);
		echo json_encode($res);
	}
	
	public function simpan(){
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
	    // End Proses Upload Foto
		 
		$tahun		= $this->input->post('thn_oleh');
		$unit		= $this->input->post('kd_unit');
		$kd_brg		= $this->input->post('kd_barang');
		$no_regis	= $this->M_Kibe->max_number($tahun,$unit,$kd_brg);
		$data = array(
			'no_regis'		=> $no_regis,
			'no_dokumen' 	=> $this->input->post('no_dokumen'),
			'pilih' 		=> $this->input->post('pilih'),
			'rincian' 		=> $this->input->post('rincian'),
			'sub_rincian' 	=> $this->input->post('sub_rincian'),
			'kd_barang' 	=> $this->input->post('kd_barang'),
			'milik' 		=> $this->input->post('milik'),
			'wil' 			=> $this->input->post('wil'),
			'kd_skpd' 		=> $this->input->post('kd_skpd'),
			'kd_unit' 		=> $this->input->post('kd_unit'),
			'perolehan' 	=> $this->input->post('perolehan'),
			'dasar' 		=> $this->input->post('dasar'),
			'no_oleh' 		=> $this->input->post('no_oleh'),
			'tgl_oleh' 		=> $this->tanggal_balik($this->input->post('tgl_oleh')),
			'thn_oleh' 		=> $tahun,
			'hrg_oleh' 		=> (double)filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'jumlah' 		=> $this->input->post('jumlah'),
			'tgl_regis' 	=> $this->tanggal_balik($this->input->post('tgl_regis')),
			'judul' 		=> $this->input->post('judul'),
			'penerbit' 		=> $this->input->post('penerbit'),
			'spesifikasi' 	=> $this->input->post('spesifikasi'),
			'asal' 			=> $this->input->post('asal'),
			'pencipta'		=> $this->input->post('pencipta'),
			'jenis' 		=> $this->input->post('jenis'),
			'ukuran' 		=> $this->input->post('ukuran'),
			'tahun_terbit' 	=> $this->input->post('tahun_terbit'),
			'satuan' 		=> $this->input->post('satuan'),
			'bahan' 		=> $this->input->post('bahan'),
			'kondisi' 		=> $this->input->post('kondisi'),
			'latitude' 		=> 0,//$this->input->post('latitude'),
			'longtitude' 	=> 0,//$this->input->post('longtitude'),
			'keterangan' 	=> $this->input->post('keterangan'),
			'ruangan' 		=> $this->input->post('kd_ruang'),
			'detail' 		=> $this->input->post('detail'),
			'gambar1'		=> $foto1,
			'gambar2'		=> $foto2,
			'gambar3'		=> $foto3,
			'gambar4'		=> $foto4,
			'ket_matriks'   => $this->input->post('ket_matriks'),
		);
		 
		
		$simpan = $this->M_Kibe->saveData($data);
		
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}
		 
	}
	
	function resize($path, $file){
		$config['image_library']  = 'gd2';
		$config['source_image']   = $path; 
		$config['maintain_ratio'] = TRUE;
		$config['width']          = 600;
		$config['height']         = 400;
		$config['new_image']      = 'uploads/kibE/'.$file;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$path1 = 'uploads/history/'.$file;
		if (file_exists($path1)) {
			unlink($path1); 
		}
	}

	public function edit(){
		$tahun		= $this->input->post('thn_oleh');
		$skpd		= $this->input->post('kd_skpd');
		$unit 		= $this->input->post('kd_unit');
		$kd_brg		= $this->input->post('kd_barang');
		$id_barang  = $this->input->post('id_barang');
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
		$cek = $this->db->query("SELECT foto1,foto2,foto3,foto4 FROM transaksi.trkib_e WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row_array();
		for ($i=1; $i <=4; $i++) { 
			if(!empty($_FILES['filefoto'.$i]['name'])){
				$config['file_name']     = md5($_FILES['filefoto'.$i]['name'].$i.time().date('Y-m-d'));
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('filefoto'.$i)){
					$this->upload->display_errors();	
				}else{
					if ($cek['foto'.$i]!='' || $cek['foto'.$i]!=null) {
						if (file_exists('./uploads/kibE/'.$cek['foto'.$i])) {
							$path1 ='./uploads/kibE/'.$cek['foto'.$i];
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
				$query = $this->db->query("SELECT foto1,foto2,foto3,foto4 FROM transaksi.trkib_e WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row();
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
			'id_lokasi'		=> $this->input->post('id_lokasi'),
			'no_regis'		=> $this->input->post('no_regis'),
			'no_dokumen' 	=> $this->input->post('no_dokumen'),
			'rincian' 		=> $this->input->post('rincian'),
			'sub_rincian' 	=> $this->input->post('sub_rincian'),
			'kd_barang' 	=> $this->input->post('kd_barang'),
			'milik' 		=> $this->input->post('milik'),
			'wil' 			=> $this->input->post('wil'),
			'kd_skpd' 		=> $this->input->post('kd_skpd'),
			'kd_unit' 		=> $this->input->post('kd_unit'),
			'perolehan' 	=> $this->input->post('perolehan'),
			'dasar' 		=> $this->input->post('dasar'),
			'no_oleh' 		=> $this->input->post('no_oleh'),
			'tgl_oleh' 		=> $this->tanggal_balik($this->input->post('tgl_oleh')),
			'thn_oleh' 		=> $this->input->post('thn_oleh'),
			'hrg_oleh' 		=> (double)filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'jumlah' 		=> $this->input->post('jumlah'),
			'tgl_regis' 	=> $this->tanggal_balik($this->input->post('tgl_regis')),
			'judul' 		=> $this->input->post('judul'),
			'penerbit' 		=> $this->input->post('penerbit'),
			'spesifikasi' 	=> $this->input->post('spesifikasi'),
			'asal' 			=> $this->input->post('asal'),
			'pencipta'		=> $this->input->post('pencipta'),
			'jenis' 		=> $this->input->post('jenis'),
			'ukuran' 		=> $this->input->post('ukuran'),
			'tahun_terbit' 	=> $this->input->post('tahun_terbit'),
			'satuan' 		=> $this->input->post('satuan'),
			'bahan' 		=> $this->input->post('bahan'),
			'kondisi' 		=> $this->input->post('kondisi'),
			'latitude' 		=> $this->input->post('latitude'),
			'longtitude' 	=> $this->input->post('longtitude'),
			'keterangan' 	=> $this->input->post('keterangan'),
			'detail' 		=> $this->input->post('detail'),
			'sts' 			=> $_REQUEST['sts'],
			'ruangan' 		=> $this->input->post('kd_ruang'),
			'gambar1'		=> $foto1,
			'gambar2'		=> $foto2,
			'gambar3'		=> $foto3,
			'gambar4'		=> $foto4,
			'ket_matriks'   => $this->input->post('ket_matriks'),
		);
		
		$config['upload_path'] = './uploads/';
		$config['max_size']  = '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);	
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		
		$simpan = $this->M_Kibe->editData($data);
		
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
		$sukses = $this->M_Kibe->hapus($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}
	
	function max_number(){ 
    	$result = $this->M_Kibe->max_number($tahun,$unit,$kd_brg);
        echo json_encode($result);
	}

	function trd_planbrg(){

     //    $data = array(
     //    	'nomor'		=> $this->input->post('no'), 	// no_dokumen
     //    	'skpd' 		=> $this->input->post('kode')	// uskpd
    	// );

    	// $res = $this->M_Pengadaan->load_trd($data);
    	// echo json_encode($res);
    }

    function load_header(){
		$key1 = $this->input->post('key1');
		$key2 = $this->input->post('key2');
		$key3 = $this->input->post('key3');
		$res = $this->M_Kibe->loadHeader($key1,$key2,$key3);
    	echo json_encode($res);
	}
	
	 function cek_session(){
		 //$skpd     = $this->session->userdata();
		//$result =  $this->session->all_userdata(); 
		//echo "121";
       // echo json_encode($result);
        //echo json_encode($skpd);
		//echo $skpd;
		//print_r $result;
		 $user_data = $this->session->userdata();

        //Returns User's name 
        echo $user_data['kd_skpd'];
	}
	function hapus_img(){
		$id_barang = $this->input->post('id_barang');
		$field     = $this->input->post('field');
		$sql = "SELECT $field FROM transaksi.trkib_e WHERE id_barang='$id_barang'";
		$get = $this->db->query($sql)->row($field);
		// print_r($this->db->last_query());
		if ($get!='' || $get!=null) {
			if (file_exists('./uploads/kibE/'.$get)) {
				$path1 ='./uploads/kibE/'.$get;
				unlink($path1); 
			}
		}
		$hapus = $this->db->set($field,'')->where('id_barang',$id_barang)->update('transaksi.trkib_e');
		//print_r($this->db->last_query());
		if ($hapus) {
			echo json_encode(array('pesan'=>true,'message' =>'Foto berhasil dihapus !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menghapus foto !'));
		}
	}

}