<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trkib_e extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
		$this->load->library('upload');
	}

	public function index(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_form_e';
			$a['title'] ='ASET TETAP LAINNYA';
			$a['icon']  ='fa fa-tag';
			$this->load->view('main',$a);
		}
	}
	function get_trkib_e_non(){
		$kd_skpd = $this->input->post('kd_skpd');
		$kd_unit = $this->input->post('kd_unit');
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			if ($kd_unit=='' OR $kd_unit==null) {
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$kd_skpd,'status is null'=>``));
			}else{
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$kd_skpd,'status is null'=>``,'kd_unit'=>$kd_unit));
			}
		}else {
			if ($_SESSION['skpd']=='1.02.01.00') {
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$_SESSION['skpd'], 'left(kd_unit,11)'=>$_SESSION['unit_skpd'], 'status is null'=>``));
			}else{
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$_SESSION['skpd'], 'kd_unit'=>$_SESSION['unit_skpd'], 'status is null'=>``));
			}
		}
		
		$column_order = array(null,'no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul',null);
		$column_search = array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul','keterangan');
		$order = array('no_sensus'=>'ASC');
		$list = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $resulte) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $resulte->no_sensus;
			$row[] = $resulte->nm_brg;
			$row[] = $resulte->detail_brg;
			$row[] = $resulte->judul;
			$row[] = $resulte->kd_brg;
			$row[] = $resulte->asal;
			$row[] = $resulte->tahun;
			$row[] = number_format($resulte->nilai,2,",",".");
			$row[] = '<i class="text-danger fa fa-empty-set fa-2x"></i>';
			$row[] = '<a class="btn btn-primary btn-sm" onclick="sensus(\''.$resulte->id_barang.'\',\'sensus\');"><i class="fa fa-clipboard-list-check fa-lg"></i></a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_model->count_all($query),
			"recordsFiltered" => $list['count_filtered'],
			"data" => $data
		);
		echo json_encode($output);
	}
	function get_trkib_e(){
		$kd_skpd = $this->input->post('kd_skpd');
		$kd_unit = $this->input->post('kd_unit');
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			if ($kd_unit=='' OR $kd_unit==null) {
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$kd_skpd, 'status'=>'1'));
			}else{
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$kd_skpd, 'status'=>'1','kd_unit'=>$kd_unit));	
			}
		}else {
			if ($_SESSION['skpd']=='1.02.01.00') {
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$_SESSION['skpd'], 'left(kd_unit,11)'=>$_SESSION['unit_skpd'], 'status'=>'1'));
			}else{
				$query=$this->db->select(array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul'))
				->from('trkib_e')
				->where(array('kd_skpd'=>$_SESSION['skpd'], 'kd_unit'=>$_SESSION['unit_skpd'], 'status'=>'1'));
			}
		}
		$column_order = array(null,'no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul',null);
		$column_search = array('no_sensus','id_barang','kd_brg','nm_brg','asal','nilai','kd_skpd','kd_unit','tahun','detail_brg','judul','keterangan');
		$order = array('no_sensus'=>'ASC');
		$list = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $resulte) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $resulte->no_sensus;
			$row[] = $resulte->nm_brg;
			$row[] = $resulte->detail_brg;
			$row[] = $resulte->judul;
			$row[] = $resulte->kd_brg;
			$row[] = $resulte->asal;
			$row[] = $resulte->tahun;
			$row[] = number_format($resulte->nilai,2,",",".");
			$row[] = '<i class="text-success fa fa-check-circle fa-2x"></i>';
			$row[] = '<a class="btn btn-primary btn-sm" onclick="sensus(\''.$resulte->id_barang.'\',\'edit\');"><i class="fa fa-file-edit fa-lg"></i></a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_model->count_all($query),
			"recordsFiltered" => $list['count_filtered'],
			"data" => $data
		);
		echo json_encode($output);
	}
	function upload(){
		$p = $this->input->post('id_brg2');
		
		$foto1 = '';
		$foto2 = '';
		$foto3 = '';
		$foto4 = '';

		$config['upload_path'] = './assets/image_file/history'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		// $config['encrypt_name'] = true;   

		// $this->load->library('upload', $config);
		// $this->upload->initialize($config);
		for ($i=1; $i <=4 ; $i++) { 
			if(!empty($_FILES['file_'.$i]['name'])){
				$config['file_name'] = md5($_FILES['file_'.$i]['name'].time().date());
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('file_'.$i))
					$this->upload->display_errors();	
				else{
					if($i=='1'){
						$foto1 = $this->upload->data();
						$query = $this->db->query("SELECT foto as foto1 FROM trkib_e where id_barang ='$p'")->row('foto1');
						for ($i=''; $i <= 4; $i++) { 
							if (file_exists(FCPATH.'assets/image_file'.$i.'/'.$query)) {
								$path_file = './assets/image_file'.$i.'/';
								unlink($path_file.$query);
							}
						}
						
						$this->db->query("UPDATE trkib_e set foto = '$foto1[file_name]' WHERE id_barang = '$p'");
					}else if($i=='2'){
						$foto2 = $this->upload->data();
						$query = $this->db->query("SELECT foto2 FROM trkib_e where id_barang ='$p'")->row('foto2');
						for ($i=''; $i <= 4; $i++) { 
							if (file_exists(FCPATH.'assets/image_file'.$i.'/'.$query)) {
								$path_file = './assets/image_file'.$i.'/';
								unlink($path_file.$query);
							}
						}
						$this->db->query("UPDATE trkib_e set foto2 = '$foto2[file_name]' WHERE id_barang = '$p'");
					}else if($i=='3'){
						$foto3 = $this->upload->data();
						$query = $this->db->query("SELECT foto3 FROM trkib_e where id_barang ='$p'")->row('foto3');
						for ($i=''; $i <= 4; $i++) { 
							if (file_exists(FCPATH.'assets/image_file'.$i.'/'.$query)) {
								$path_file = './assets/image_file'.$i.'/';
								unlink($path_file.$query);
							}
						}
						$this->db->query("UPDATE trkib_e set foto3 = '$foto3[file_name]' WHERE id_barang = '$p'");
					}else if($i=='4'){
						$foto4 = $this->upload->data();
						$query = $this->db->query("SELECT foto4 FROM trkib_e where id_barang ='$p'")->row('foto4');
						for ($i=''; $i <= 4; $i++) { 
							if (file_exists(FCPATH.'assets/image_file'.$i.'/'.$query)) {
								$path_file = './assets/image_file'.$i.'/';
								unlink($path_file.$query);
							}
						}
						$this->db->query("UPDATE trkib_e set foto4 = '$foto4[file_name]' WHERE id_barang = '$p'");
					}
					$data_image = array('upload_data' => $this->upload->data()); 
					$this->resize($data_image['upload_data']['full_path'],$data_image['upload_data']['file_name']);
				}
			}
		}
	}
	function resize($path, $file){
		$config['image_library']  = 'gd2';
		$config['source_image']   = $path;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = 800;
		$config['height']         = 600;
		$config['new_image']      = './assets/image_file/'.$file;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$path1 = './assets/image_file/history/'.$file;
		if (file_exists($path1)) {
			unlink($path1);
			echo($file);
		}
	}
	function get_trkib_e_id_non(){
		$p = $this->input->post('id_barang');
		$query = $this->db->query("SELECT a.*,concat(b.kd_ruang,' | ',b.nm_ruang,' | ',b.no_urut) as ruang_lama from trkib_e a left join mruang b on a.kd_ruang=b.kd_ruang where id_barang = '$p'")->result();
		echo json_encode($query);
	}
	function simpan_trkib_e(){
		$p = $this->input->post('id_brg');
		$cek_num = $this->db->query("SELECT no_sensus FROM trkib_e WHERE id_barang='$p'")->row_array();
		if ($cek_num['no_sensus']=='' OR $cek_num['no_sensus']==null) {
			$set_num = $this->db->query("SELECT LPAD(IFNULL(MAX(no_sensus),0)+1,6,'0') AS nor FROM trkib_e WHERE kd_unit='$_SESSION[unit_skpd]'")->row_array();
			$num = $set_num['nor'];
		}else {
			$num = $cek_num['no_sensus'];
		}
		if ($this->input->post('stat_fisik')==1) {

			if ($this->input->post('stat_submit')==1) {
				$data=array(
					'no_sensus'		 => $num,
					'detail_brg2'    => $this->input->post('dtl_brg'),
					'judul2'         => $this->input->post('judul'),
					'spesifikasi2'   => $this->input->post('spesifikasi'),
					'asal2'          => $this->input->post('asal'),
					'pencipta2'      => $this->input->post('pencipta'),
					'kd_bahan2'      => $this->input->post('kd_bahan'),
					'jenis2'         => $this->input->post('jenis'),
					'tipe2'          => $this->input->post('tipe'),
					'keterangan2'    => $this->input->post('ket'),
					'kronologis'     => $this->input->post('kronologis'),
					'status'         => '1',
					'stat_fisik'     => $this->input->post('stat_fisik'),
					'keberadaan_brg' => $this->input->post('keberadaan_brg'),
					'kd_ruang2' 	 => $this->input->post('kd_ruang'),
					'kondisi_brg'    => $this->input->post('kondisi_brg'),
					'stat_hukum'     => $this->input->post('stat_hukum'),
					'ket_stat_hukum' => $this->input->post('ket_stat_hukum'),
					'bukti_milik'    => $this->input->post('bukti_milik'),
					'status_milik'   => $this->input->post('status_milik'),
					'ket_brg'        => null,
					'no_surat_pol'   => null,
					'stat_fisik2'     =>'',
					'keberadaan_brg2' =>'',
					'kondisi_brg2'    =>'',
					'ket_brg2'        =>''
				);
			}else{
				$data=array(
					'no_sensus'		 => $num,
					'detail_brg2'    => $this->input->post('dtl_brg'),
					'judul2'         => $this->input->post('judul'),
					'spesifikasi2'   => $this->input->post('spesifikasi'),
					'asal2'          => $this->input->post('asal'),
					'pencipta2'      => $this->input->post('pencipta'),
					'kd_bahan2'      => $this->input->post('kd_bahan'),
					'jenis2'         => $this->input->post('jenis'),
					'tipe2'          => $this->input->post('tipe'),
					'keterangan2'    => $this->input->post('ket'),
					'kronologis'     => $this->input->post('kronologis'),
					'stat_fisik'     => $this->input->post('stat_fisik'),
					'keberadaan_brg' => $this->input->post('keberadaan_brg'),
					'kd_ruang2' 	 => $this->input->post('kd_ruang'),
					'kondisi_brg'    => $this->input->post('kondisi_brg'),
					'stat_hukum'     => $this->input->post('stat_hukum'),
					'ket_stat_hukum' => $this->input->post('ket_stat_hukum'),
					'bukti_milik'    => $this->input->post('bukti_milik'),
					'status_milik'   => $this->input->post('status_milik'),
					'ket_brg'        => null,
					'no_surat_pol'   => null,
					'stat_fisik2'     =>'',
					'keberadaan_brg2' =>'',
					'kondisi_brg2'    =>'',
					'ket_brg2'        =>''
				);
			}
			
		}else{

			if ($this->input->post('stat_submit')==1) {
				$data=array(
					'no_sensus'		 => $num,
					'detail_brg2'    => $this->input->post('dtl_brg'),
					'judul2'         => $this->input->post('judul'),
					'spesifikasi2'   => $this->input->post('spesifikasi'),
					'asal2'          => $this->input->post('asal'),
					'pencipta2'      => $this->input->post('pencipta'),
					'kd_bahan2'      => $this->input->post('kd_bahan'),
					'jenis2'         => $this->input->post('jenis'),
					'tipe2'          => $this->input->post('tipe'),
					'keterangan2'    => $this->input->post('ket'),
					'kronologis'     => $this->input->post('kronologis'),
					'status'         => '1',
					'stat_fisik'     => $this->input->post('stat_fisik'),
					'keberadaan_brg' => null,
					'kd_ruang2' 	 => null,
					'kondisi_brg'    => null,
					'stat_hukum'     => null,
					'ket_stat_hukum' => null,
					'bukti_milik'    => null,
					'status_milik'   => null,
					'ket_brg'        => $this->input->post('ket_brg'),
					'no_surat_pol'   => $this->input->post('no_surat_pol'),
					'stat_fisik2'     =>'',
					'keberadaan_brg2' =>'',
					'kondisi_brg2'    =>'',
					'ket_brg2'        =>''
				);
			}else{
				$data=array(
					'no_sensus'		 => $num,
					'detail_brg2'    => $this->input->post('dtl_brg'),
					'judul2'         => $this->input->post('judul'),
					'spesifikasi2'   => $this->input->post('spesifikasi'),
					'asal2'          => $this->input->post('asal'),
					'pencipta2'      => $this->input->post('pencipta'),
					'kd_bahan2'      => $this->input->post('kd_bahan'),
					'jenis2'         => $this->input->post('jenis'),
					'tipe2'          => $this->input->post('tipe'),
					'keterangan2'    => $this->input->post('ket'),
					'kronologis'     => $this->input->post('kronologis'),
					'stat_fisik'     => $this->input->post('stat_fisik'),
					'keberadaan_brg' => null,
					'kd_ruang2' 	 => null,
					'kondisi_brg'    => null,
					'stat_hukum'     => null,
					'ket_stat_hukum' => null,
					'bukti_milik'    => null,
					'status_milik'   => null,
					'ket_brg'        => $this->input->post('ket_brg'),
					'no_surat_pol'   => $this->input->post('no_surat_pol'),
					'stat_fisik2'     =>'',
					'keberadaan_brg2' =>'',
					'kondisi_brg2'    =>'',
					'ket_brg2'        =>''
				);
			}
			
		}
		$this->db->where('id_barang', $p);
		$query = $this->db->update('trkib_e',$data);
		$msg   = $this->db->error();
		if ($query) {
			$p = array(
				'title' => "Good Job!",
				'msg'   => "Data Tersimpan",
				'type'  => "success"
			);
		}
		else{
			$p = array(
				'title' => "Oops!",
				'msg'   => "Error(".$msg['code'].") ". $msg['message'],
				'type'  => "error"
			);
		}
		// $p = array(
		// 		'title' => "WARNING!",
		// 		'msg'   => "Sistem Terkunci",
		// 		'type'  => "warning"
		// );
		echo json_encode($p);
	}
	function batal_trkib_e(){
		$p = $this->input->post('id_brg');
		$data=array(
			'foto'           => null,
			'foto2'          => null,
			'foto3'          => null,
			'foto4'          => null,
			'detail_brg2'    => null,
			'judul2'         => null,
			'spesifikasi2'   => null,
			'asal2'          => null,
			'pencipta2'      => null,
			'kd_bahan2'      => null,
			'jenis2'         => null,
			'tipe2'          => null,
			'keterangan2'    => null,
			'kronologis'     => null,
			'status'         => null,
			'stat_fisik'     => null,
			'keberadaan_brg' => null,
			'kd_ruang2' 	 => null,
			'kondisi_brg'    => null,
			'stat_hukum'     => null,
			'ket_stat_hukum' => null,
			'bukti_milik'    => null,
			'status_milik'   => null,
			'ket_brg'        => null,
			'no_surat_pol'   => null,
					'stat_fisik2'     =>'',
					'keberadaan_brg2' =>'',
					'kondisi_brg2'    =>'',
					'ket_brg2'        =>''

		);
		$this->db->where('id_barang', $p);
		$query = $this->db->update('trkib_e',$data);
		$msg   = $this->db->error();
		if ($query) {
			$p = array(
				'title' => "Good Job!",
				'msg'   => "Sensus Batal",
				'type'  => "success"
			);
		}
		else{
			$p = array(
				'title' => "Oops!",
				'msg'   => "Error(".$msg['code'].") ". $msg['message'],
				'type'  => "error"
			);
		}
		echo json_encode($p);
	}
	function get_image(){
		$p = $this->input->post('id_brg');
		$query = $this->db->query("
			SELECT  IF(foto is null OR LENGTH(foto)<36 OR LENGTH(foto)>37,0,foto) AS foto1, 
			IF(foto2 is null OR LENGTH(foto2)<36 OR LENGTH(foto2)>37,0,foto2) AS foto2, 
			IF(foto3 is null OR LENGTH(foto3)<36 OR LENGTH(foto3)>37,0,foto3) AS foto3, 
			IF(foto4 is null OR LENGTH(foto4)<36 OR LENGTH(foto4)>37,0,foto4) AS foto4  
			from trkib_e where id_barang = '$p'");
		$data = array();
		$foto1 = '';
		$foto2 = '';
		$foto3 = '';
		$foto4 = '';
		foreach ($query->result_array() as $row) {
			for ($i=1; $i <= 4; $i++) { 
				if($row['foto'.$i]!=null || $row['foto'.$i]!=''){
					switch ($i) {
						case 1:
							if (file_exists(FCPATH.'assets/image_file/'.$row['foto'.$i])) {
								$foto1 = base_url().'assets/image_file/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file2/'.$row['foto'.$i])){
								$foto1 = base_url().'assets/image_file2/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file3/'.$row['foto'.$i])){
								$foto1 = base_url().'assets/image_file3/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file4/'.$row['foto'.$i])){
								$foto1 = base_url().'assets/image_file4/'.$row['foto'.$i];
							}
							for ($ii=0; $ii <= 49; $ii++) { 
								if (file_exists(FCPATH.'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i])){
									$foto1 = base_url().'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i];
								}
							}
						break;
						case 2:
							if (file_exists(FCPATH.'assets/image_file/'.$row['foto'.$i])) {
								$foto2 = base_url().'assets/image_file/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file2/'.$row['foto'.$i])){
								$foto2 = base_url().'assets/image_file2/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file3/'.$row['foto'.$i])){
								$foto2 = base_url().'assets/image_file3/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file4/'.$row['foto'.$i])){
								$foto2 = base_url().'assets/image_file4/'.$row['foto'.$i];
							}
							for ($ii=0; $ii <= 49; $ii++) { 
								if (file_exists(FCPATH.'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i])){
									$foto2 = base_url().'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i];
								}
							}
						break;
						case 3:
							if (file_exists(FCPATH.'assets/image_file/'.$row['foto'.$i])) {
								$foto3 = base_url().'assets/image_file/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file2/'.$row['foto'.$i])){
								$foto3 = base_url().'assets/image_file2/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file3/'.$row['foto'.$i])){
								$foto3 = base_url().'assets/image_file3/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file4/'.$row['foto'.$i])){
								$foto3 = base_url().'assets/image_file4/'.$row['foto'.$i];
							}
							for ($ii=0; $ii <= 49; $ii++) { 
								if (file_exists(FCPATH.'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i])){
									$foto3 = base_url().'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i];
								}
							}
						break;
						case 4:
							if (file_exists(FCPATH.'assets/image_file/'.$row['foto'.$i])) {
								$foto4 = base_url().'assets/image_file/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file2/'.$row['foto'.$i])){
								$foto4 = base_url().'assets/image_file2/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file3/'.$row['foto'.$i])){
								$foto4 = base_url().'assets/image_file3/'.$row['foto'.$i];
							}else if (file_exists(FCPATH.'assets/image_file4/'.$row['foto'.$i])){
								$foto4 = base_url().'assets/image_file4/'.$row['foto'.$i];
							}
							for ($ii=0; $ii <= 49; $ii++) { 
								if (file_exists(FCPATH.'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i])){
									$foto4 = base_url().'assets/image_file6/New folder ('.$ii.')/'.$row['foto'.$i];
								}
							}
						break;
						default:
						break;
					}
				}
			}
			$data = array(
				'page_1' => $row['foto1'],
				'page_2' => $row['foto2'],
				'page_3' => $row['foto3'],
				'page_4' => $row['foto4'],
				'foto1' => $foto1,
				'foto2' => $foto2,
				'foto3' => $foto3,
				'foto4' => $foto4
			);
		}
		echo json_encode($data);
	}
	function hapus_image(){
		$value = $this->input->post('id');
		$tabel = $this->input->post('tabel');
		$field = $this->input->post('field');
		$data = $this->M_model->hapus_image($tabel,$field,$value);
		if($data=='1'){
			echo '1';
		}else{
			echo '2';
		}
	}
	function get_ruang(){
		$data = $this->db->query("SELECT kd_ruang,nm_ruang,no_urut FROM mruang where kd_skpd='$_SESSION[skpd]' AND kd_unit='$_SESSION[unit_skpd]'")->result();
		echo json_encode($data);
	}
}
?>
