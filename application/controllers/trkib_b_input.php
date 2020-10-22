<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trkib_b_input extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
		$this->load->model('transaksi/M_Kibb');
		$this->load->library('upload');
	}

	public function index(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_form_b_input';
			$a['title'] ='PERALATAN DAN MESIN ++';
			$a['icon']  ='fa fa-toolbox';
			$this->load->view('main',$a);
		}
	}
	function get_milik(){
		$lccq 		= $this->input->post('q');
		$sql	= "SELECT kd_milik, nm_milik FROM mmilik order by kd_milik";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_milik' => $key['kd_milik'],  
                'nm_milik' => $key['nm_milik'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_wilayah(){
		$sql	= "SELECT kd_wilayah, nm_wilayah FROM mwilayah";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_wilayah' => $key['kd_wilayah'],  
                'nm_wilayah' => $key['nm_wilayah'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_skpd(){
		$key='';
		$lccq = $this->input->post('q');
		if($lccq!=''){
        	$key ="where upper(kd_skpd) like upper('%$lccq%') or upper(nm_skpd) like upper('%$lccq%')";
        }
		if($_SESSION['otori'] == '01'){
		$sql	= "SELECT kd_skpd,nm_skpd FROM ms_skpd $key order by kd_skpd";
		} else {
		$sql	= "SELECT kd_skpd,nm_skpd FROM ms_skpd WHERE kd_skpd = '$_SESSION[kd_skpd]' order by kd_skpd";
		}
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_skpd' => trim($key['kd_skpd']),  
				'nm_skpd' => $key['nm_skpd'],  
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_unit(){
		$lccq = $this->input->post('q');
		$skpd = $this->input->post('kd_skpd');
		$key='';
		if($lccq!=''){
        	$key ="and upper(nm_lokasi) like upper('%$lccq%') or upper(kd_lokasi) like upper('%$lccq%')"; 
        }
		$sql	= "SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_skpd='$skpd' $key order by kd_lokasi";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_unit' => trim($key['kd_lokasi']),  
                'nm_unit' => trim($key['nm_lokasi']),
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_oleh(){
		$sql	= "SELECT kd_cr_oleh,cara_peroleh FROM cara_peroleh ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kd_cr_oleh' 	=> $key['kd_cr_oleh'],  
                'cara_peroleh' 	=> $key['cara_peroleh'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_matriks(){
		$sql	= "SELECT id as kode,ket_matriks FROM ket_matriks ";
		$query  = $this->db->query($sql);
 		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'          => $li,
				'kode'        => $key['kode'],  
				'ket_matriks' => $key['ket_matriks'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
		 
	}
	function get_dasar(){
		$sql	= "SELECT kode,dasar_peroleh FROM mdasar ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'dasar_peroleh' => $key['dasar_peroleh'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_warna(){
        $lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_warna) like '%$lccr%'"; 
        }

		$sql	= "SELECT kd_warna, nm_warna 
					FROM mwarna $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_warna' => $key['kd_warna'],  
                'nm_warna' => $key['nm_warna'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	
	function get_bahan(){
        $lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_bahan) like '%$lccr%'"; 
        }

		$sql	= "SELECT kd_bahan, nm_bahan 
		FROM mbahan $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_bahan' => $key['kd_bahan'],  
                'nm_bahan' => $key['nm_bahan'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	
	function get_kondisi(){
		$sql	= "SELECT kode, kondisi FROM mkondisi";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kode' => $key['kode'],  
                'kondisi' => $key['kondisi'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_satuan(){        
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_satuan) like upper('%$lccr%')";
        }


		$sql   ="SELECT kd_satuan, nm_satuan 
		FROM msatuan $key ORDER BY kd_satuan";
		$query = $this->db->query($sql);
		$res   = array();
		$li    = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_satuan' => trim($key['kd_satuan']),  
                'nm_satuan' => $key['nm_satuan'],
			);
			$li++;
		}
		echo json_encode($res);
		$query->free_result();
	}
	function get_rincian(){
		$akun 	= $this->input->post('akun');
		$kel 	= $this->input->post('kelompok');
		$jenis 	= $this->input->post('jenis');
		$lccr 	= $this->input->post('q');
		$key   = "";
		if($lccr!=''){
			$key ="and upper(uraian) like upper('%$lccr%')"; 
		}

		$sql	= "SELECT kd_brg,uraian FROM mbarang_new_modif 
		WHERE length(kd_brg)='8' and akun='$akun' 
		and kelompok='$kel' and jenis='$jenis' and objek<>'' $key order by kd_brg ASC";
		$query  = $this->db->query($sql)->result();
		echo json_encode($query);
	}
	public function load_barang() {
		$akun 		= $this->input->post('akun');
		$kel 		= $this->input->post('kelompok');
		$jenis 		= $this->input->post('jenis');
		$key		= $this->input->post('key'); 
		$rinci		= $this->input->post('rinci'); 
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = '';
		$limit = "ORDER BY kd_brg ASC LIMIT $rows OFFSET $offset";

		if($key!=''){
			$where = " and (upper(uraian) like upper('%$key%') or upper(kd_brg) like upper('%$key%'))";	
			$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot FROM mbarang_new_modif 
				WHERE length(kd_brg)='18' and left(kd_brg,8)='$rinci' and uraian <> 'Dst….'
				$where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM mbarang_new_modif 
				WHERE length(kd_brg)='18' and left(kd_brg,8)='$rinci' and uraian <> 'Dst….'
				$where $limit";
				// print_r($sql);
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte){ 
            $row[] = array(
                'id' 		=> $ii,        
                'kd_brg' 	=> $resulte['kd_brg'],
                'nm_brg' 	=> $resulte['uraian'], 
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
	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
	}


}/*end*/
?>
