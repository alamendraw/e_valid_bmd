<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kibb extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('transaksi/M_Kibb');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}
	
	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}
	
	
	public function getSkpd()
	{
		$lccq 	= $this->input->post('q');
		$result = $this->M_Kibb->getSkpd($lccq);
		echo json_encode($result);
	}
	
	public function getRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibb->getRincian($lccq,$akun,$kel,$jenis);
		echo json_encode($res);
	}
	
	public function getSubRincian()
	{
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$rincian= $this->input->post('rincian');
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibb->getSubRincian($lccq,$akun,$kel,$jenis,$rincian);
		echo json_encode($res);
	}
	
	// public function getKdbarang()
	// {
	// 	$akun 		= $this->input->post('akun');
	// 	$kel 		= $this->input->post('kelompok');
	// 	$jenis 		= $this->input->post('jenis');
	// 	$subrinci	= $this->input->post('sub_rincian');
	// 	$lccq 		= $this->input->post('q');
	// 	$res 		= $this->M_Kibb->getKdbarang($lccq,$akun,$kel,$jenis,$subrinci);
	// 	echo json_encode($res);
	// }
	
	public function getMilik()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getMilik($lccq);
		echo json_encode($res);
	}
	
	public function getWarna()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getWarna($lccq);
		echo json_encode($res);
	}
	
	public function getBahan()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getBahan($lccq);
		echo json_encode($res);
	}
	
	public function getKondisi()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getKondisi($lccq);
		echo json_encode($res);
	}
	 
	public function getMetode()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getMetode($lccq);
		echo json_encode($res);
	}
	 
	public function getWilayah()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getWilayah($lccq);
		echo json_encode($res);
	}
	
	public function getUnit()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $this->input->post('kd_skpd');
		$res 		= $this->M_Kibb->getUnit($lccq,$skpd);
		echo json_encode($res);
	}
	
	public function getRuang()
	{
		$lccq 		= $this->input->post('q');
		$skpd 		= $_SESSION['skpd']; 
		$res 		= $this->M_Kibb->getRuang($lccq,$skpd);
		echo json_encode($res);
	}
	
	public function getOleh()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getOleh($lccq);
		echo json_encode($res);
	}

	public function getmatriks()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getmatriks($lccq);
		echo json_encode($res);
	}
	
	public function getDasar()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Kibb->getDasar($lccq);
		echo json_encode($res);
	}
	

	public function getSatuan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kibb->getSatuan($lccq);
		echo json_encode($res);
	}
	
	public function index()
	{

		$a['page']  ='transaksi/inventarisasi/V_Kibb';
		$a['title'] ='PERALATAN DAN MESIN ++';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
	}
	
	public function add()
	{
		
		$a['page']  ='transaksi/inventarisasi/V_Add_Kibb';
		$a['title'] ='Tambah Inventarisasi KIB B';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
	}
	
	public function dataAset()
	{

		$a['page']  ='transaksi/inventarisasi/V_KibbAset';
		$a['title'] ='Inventarisasi KIB B';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
	}
	
	public function dataEca()
	{
	
		$a['page']  ='transaksi/inventarisasi/V_KibbEca';
		$a['title'] ='Inventarisasi KIB B Eca';
		$a['icon']  ='fa fa-toolbox';
		$this->load->view('main',$a);
	}
	 
	public function dataRuang()
	{
		$data = array(
			'page' 		=> "Manajemen Data Ruangan KIB B",
			'judul'		=> "Manajemen Data Ruangan KIB B",
			'deskripsi'	=> "Manajemen Data Ruangan KIB B"
		);
		$this->template->views('transaksi/inventarisasi/V_RuangB', $data);
	}
	
	
	public function getDokumen(){
		$kib	= $this->input->post('kib');
		$result = $this->M_Kibb->getDokumen($kib);
		echo json_encode($result);
	}
	
	 function load_header(){
		$otori = $this->session->userdata['otori'];
		$skpd  = $this->session->userdata['skpd'];
		$key1  = $this->input->post('key1');
		$key2  = $this->input->post('key2');
		$key3  = $this->input->post('key3');
		$res   = $this->M_Kibb->loadHeader($key1,$key2,$key3,$otori,$skpd);
    	echo json_encode($res);
	}

	function load_ruang(){
		$otori 	= $this->session->userdata['otori'];
		$skpd 	= $this->session->userdata['skpd']; 
		$res 	= $this->M_Kibb->load_ruang($otori,$skpd);
    	echo json_encode($res);
	}
	
	 function load_barang(){
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$key		= $this->input->post('key'); 
		$rinci		= $this->input->post('rinci'); 
		$res 		= $this->M_Kibb->loadBarang($akun,$kel,$jenis,$key,$rinci);
    	echo json_encode($res);
	}
	
	function load_kibb() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY no_reg ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "where upper(nm_brg) like upper('%$key%')";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from trkib_b_input $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT * from trkib_b_input $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'kd_brg' => $resulte['kd_brg'],
                        'nm_brg' => $resulte['nm_brg'],					
                        'no_reg' => $resulte['no_reg'],					
                        'merek' => $resulte['merek'],					
                        'tahun' => $resulte['tahun'],					
                        'nilai' => $resulte['nilai'],					
                        'keterangan' => $resulte['keterangan']					
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
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
		//var_dump($tahun);
		$skpd		= $this->input->post('kd_skpd');
		$kd_brg		= $this->input->post('kd_barang'); 
		 
		$data = array( 
		'jns' 			=> $this->input->post('jns'),
		'no_dokumen' 	=> $this->input->post('no_dokumen'),
		'kd_brg' 		=> $this->input->post('kd_barang'),
		'milik' 		=> $this->input->post('milik'),
		'wilayah' 		=> $this->input->post('wil'),
		'tahun' 		=> $tahun,
		'kd_skpd' 		=> $skpd,
		'kd_unit' 		=> $this->input->post('kd_unit'),
		'detail' 		=> $this->input->post('detail'),
		'asal' 			=> $this->input->post('perolehan'),
		'dsr_peroleh'	=> $this->input->post('dasar'),
		'no_oleh' 		=> $this->input->post('no_oleh'), 
		'nilai' 		=> (double)filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
		'merek' 		=> $this->input->post('merk'),
		'tipe' 			=> $this->input->post('type'),
		'kd_warna' 		=> $this->input->post('warna'),
		'kd_bahan' 		=> $this->input->post('bahan'),
		'no_rangka' 	=> $this->input->post('no_rangka'),
		'no_mesin' 		=> $this->input->post('no_mesin'),
		'no_polisi' 	=> $this->input->post('no_polisi'),
		'no_stnk' 		=> $this->input->post('nostnk'),
		'no_bpkb' 		=> $this->input->post('nobpkb'),
		'kondisi' 		=> $this->input->post('kondisi'),
		'keterangan' 	=> $this->input->post('keterangan'),
		'kd_ruang' 		=> $this->input->post('kd_ruang'),
		'jumlah' 		=> $this->input->post('jumlah'),
		'satuan' 		=> $this->input->post('satuan'),
		'ukuran' 		=> $this->input->post('ukuran'),
		'tgl_regis' 	=> $this->tanggal_balik($this->input->post('tgl_regis')),
		'tgl_oleh' 		=> $this->tanggal_balik($this->input->post('tgl_oleh')),
		'tgl_bpkb' 		=> $this->tanggal_balik($this->input->post('tgl_bpkb')),
		'tgl_stnk' 		=> $this->tanggal_balik($this->input->post('tgl_stnk')),
		'gambar1'		=> $foto1,
		'gambar2'		=> $foto2,
		'gambar3'		=> $foto3,
		'gambar4'		=> $foto4,
		'ket_matriks'   => $this->input->post('ket_matriks'),
		'kronologis'    => $this->input->post('kronologis'),
		);
		 
		
		$simpan = $this->M_Kibb->saveData($data);
		
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
		$config['width']         	= 600;
		$config['height']       	= 400;
		$config['new_image']       	= './uploads/kibB/'.$file;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		if (file_exists('./uploads/history/'.$file)) {
			$path1 ='./uploads/history/'.$file;
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
		$cek = $this->db->query("SELECT foto1,foto2,foto3,foto4 FROM trkib_b_input WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row_array();
		for ($i=1; $i <=4; $i++) { 
			if(!empty($_FILES['filefoto'.$i]['name'])){
				$config['file_name']     = md5($_FILES['filefoto'.$i]['name'].$i.time().date('Y-m-d'));
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('filefoto'.$i)){
					$this->upload->display_errors();	
				}else{
					if ($cek['foto'.$i]!='' || $cek['foto'.$i]!=null) {
						if (file_exists('./uploads/kibB/'.$cek['foto'.$i])) {
							$path1 ='./uploads/kibB/'.$cek['foto'.$i];
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
				$query = $this->db->query("SELECT foto1,foto2,foto3,foto4 FROM trkib_b_input WHERE kd_skpd='$skpd' AND kd_unit='$unit' AND id_lokasi='$id_barang'")->row();
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
			'id_barang' 	=> $this->input->post('id_barang'),
			'no_reg' 		=> $this->input->post('no_regis'),
			'no_dokumen' 	=> $this->input->post('no_dokumen'),
			'kd_brg' 		=> $this->input->post('kd_barang'),
			'milik' 		=> $this->input->post('milik'),
			'wilayah' 		=> $this->input->post('wil'),
			'tahun' 		=> $this->input->post('thn_oleh'),
			'kd_skpd' 		=> $this->input->post('kd_skpd'),
			'kd_unit' 		=> $this->input->post('kd_unit'),
			'asal' 			=> $this->input->post('perolehan'),
			'dsr_peroleh'	=> $this->input->post('dasar'),
			'no_oleh' 		=> $this->input->post('no_oleh'),
			//'nilai' 		=> $this->input->post('hrg_oleh'),
			'nilai' 		=> (double)filter_var($this->input->post('hrg_oleh'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
			'merek' 		=> $this->input->post('merk'),
			'tipe' 			=> $this->input->post('type'),
			'kd_warna' 		=> $this->input->post('warna'),
			'kd_bahan' 		=> $this->input->post('bahan'),
			'no_rangka' 	=> $this->input->post('no_rangka'),
			'no_mesin' 		=> $this->input->post('no_mesin'),
			'no_polisi' 	=> $this->input->post('no_polisi'),
			'no_stnk' 		=> $this->input->post('nostnk'),
			'no_bpkb' 		=> $this->input->post('nobpkb'),
			'kondisi' 		=> $this->input->post('kondisi'),
			'keterangan' 	=> $this->input->post('keterangan'),
			'kd_ruang' 		=> $this->input->post('kd_ruang'),
			'jumlah' 		=> $this->input->post('jumlah'),
			'satuan' 		=> $this->input->post('satuan'),
			'ukuran' 		=> $this->input->post('ukuran'),
			'detail' 		=> $this->input->post('detail'),
			'sts' 			=> $_REQUEST['sts'],
			'tgl_regis' 	=> $this->tanggal_balik($this->input->post('tgl_regis')),
			'tgl_oleh' 		=> $this->tanggal_balik($this->input->post('tgl_oleh')),
			'tgl_bpkb' 		=> $this->tanggal_balik($this->input->post('tgl_bpkb')),
			'tgl_stnk' 		=> $this->tanggal_balik($this->input->post('tgl_stnk')),
			'gambar1'		=> $foto1,
			'gambar2'		=> $foto2,
			'gambar3'		=> $foto3,
			'gambar4'		=> $foto4,
			'ket_matriks'   => $this->input->post('ket_matriks'),
			'kronologis'    => $this->input->post('kronologis'),
		);
		
		$config['upload_path'] = './uploads/';
		$config['max_size']  = '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);	
		
		$simpan = $this->M_Kibb->editData($data);
		
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Terupdate !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Update Data !'));
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
	
	public function simpan2(){
		$param  = $this->input->post();
		$sukses = $this->M_Kibb->simpan($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_Kibb->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_Kibb->hapus($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}
	
	public function prosesPindah(){
		$param  = $this->input->post();
		$sukses = $this->M_Kibb->prosesPindah($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}
	
	function max_number($kode){   
		// $kode = $this->input->post('kode');
    	$result = $this->M_Kibb->max_number($kode);
        echo json_encode($result);
	}
	function hapus_img(){
		$id_barang = $this->input->post('id_barang');
		$field     = $this->input->post('field');
		$sql = "SELECT $field FROM trkib_b_input WHERE id_barang='$id_barang'";
		$get = $this->db->query($sql)->row($field);
		// print_r($this->db->last_query());
		if ($get!='' || $get!=null) {
			if (file_exists('./uploads/kibB/'.$get)) {
				$path1 ='./uploads/kibB/'.$get;
				unlink($path1); 
			}
		}
		$hapus = $this->db->set($field,'')->where('id_barang',$id_barang)->update('trkib_b_input');
		//print_r($this->db->last_query());
		if ($hapus) {
			echo json_encode(array('pesan'=>true,'message' =>'Foto berhasil dihapus !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menghapus foto !'));
		}
	}


		
}
