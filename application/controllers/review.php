<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Review extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
	}
	public function index(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page'] ='v_review';
			$a['title']='';
			$a['icon'] ='';
			$this->load->view('main',$a);
		}
	}
	public function rekap(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page' ] ='v_rekap_review';
			$a['title'] ='';
			$a['icon' ] ='';
			$this->load->view('main',$a);
		}
	}

	public function rekap2(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_rekap_review2';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}

	public function lap_penetapan(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			$a['page']  ='v_lap_penetapan';
			$a['title'] ='';
			$a['icon']  ='';
			$this->load->view('main',$a);
		}
	}

	public function falidasi(){
		$res             = 0;
		$id_barang       = $this->input->post('id_barang');
		$no_sensus       = $this->input->post('no_sensus');
		$kd_skpd         = $this->input->get('kd_skpd');
		$kd_unit         = $this->input->get('kd_unit');
		$table           = $this->input->get('jns_kib');
		$catat           = $this->input->post('catat');
		$stat_fisik2     = $this->input->post('stat_fisik2');
		$ket_brg2        = $this->input->post('ket_brg2');
		$kondisi_brg2    = $this->input->post('kondisi_brg2');
		$keberadaan_brg2 = $this->input->post('keberadaan_brg2');
		$value = array(
			'stat_fisik2'     =>($stat_fisik2==null)?'':$stat_fisik2,
			'keberadaan_brg2' =>($keberadaan_brg2==null)?'':$keberadaan_brg2,
			'kondisi_brg2'    =>($kondisi_brg2==null)?'':$kondisi_brg2,
			'ket_brg2'        =>($ket_brg2==null)?'':$ket_brg2,
			'catatan'         =>($catat==null)?'':$catat
		);
		if ($no_sensus<>'') {
		$res =  $this->db->where(array('kd_skpd'=>$kd_skpd,'kd_unit'=>$kd_unit));
		$res =  $this->db->where_in('no_sensus', explode(",",$no_sensus));
		$res =  $this->db->update($table,$value);
		$res =  $this->db->affected_rows();
		}
		if ($res>0) {
			echo("Berhasil!");
		}else{
		 	echo("Berhasil!");
		} 
	}
	public function falidasi_equal_sensus(){
		$res             = 0;
		$no_sensus       = $this->input->post('no_sensus_equal_sensus');
		$kd_skpd         = $this->input->get('kd_skpd');
		$kd_unit         = $this->input->get('kd_unit');
		$table           = $this->input->get('jns_kib');
		$catat           = $this->input->post('catat_equal_sensus');
		$value = array(
			"catatan"         =>($catat==null)?"":$catat
		);
		if ($no_sensus<>'') {
		$res =  $this->db->set("stat_fisik2","IFNULL(stat_fisik,'')",false);
		$res =  $this->db->set("keberadaan_brg2","IFNULL(keberadaan_brg,'')",false);
		$res =  $this->db->set("kondisi_brg2","IFNULL(kondisi_brg,'')",false);
		$res =  $this->db->set("ket_brg2","IFNULL(ket_brg,'')",false);
		$res =  $this->db->where(array('kd_skpd'=>$kd_skpd,'kd_unit'=>$kd_unit));
		$res =  $this->db->where_in('no_sensus', explode(",",$no_sensus));
		$res =  $this->db->update($table,$value);
		$res =  $this->db->affected_rows();
		}
		if ($res>0) {
			echo("Berhasil!");
		}else{
		 	echo("Tidak ada perubahan!");
		} 
	}
	public function getlist(){
		ini_set('memory_limit', '-1');

		$kd_skpd     = $this->input->post('kd_skpd');
		$kd_unit     = $this->input->post('kd_unit');
		$no_sensus   = $this->input->post('fno_sensus');
		$nm_brg      = $this->input->post('fnama');
		$rincian     = $this->input->post('frincian');
		$tahun       = $this->input->post('ftahun');
		$nilai       = $this->input->post('fnilai');
		$umur        = $this->input->post('fumur');
		$hasil       = $this->input->post('fhasil');
		$review      = $this->input->post('freview');
		$catatan     = $this->input->post('fcatatan');
		$kondisi     = $this->input->post('kondisi');
		$keterangan  = $this->input->post('keterangan');
		$kronologis  = $this->input->post('kronologis');
		$alamat      = $this->input->post('alamat');
		$luas        = $this->input->post('luas');
		$merek       = $this->input->post('merek');
		$no_polisi   = $this->input->post('no_polisi');
		$no_rangka   = $this->input->post('no_rangka');
		$no_mesin    = $this->input->post('no_mesin');
		$konstruksi  = $this->input->post('konstruksi');
		$jenis       = $this->input->post('jenis');
		$panjang     = $this->input->post('panjang');
		$lebar       = $this->input->post('lebar');
		$judul       = $this->input->post('judul');
		$spesifikasi = $this->input->post('spesifikasi');
		$asal        = $this->input->post('asal');
		$cipta       = $this->input->post('cipta');
		$bangunan    = $this->input->post('bangunan');

		$table     = ($this->input->post('jns_kib')=='')?'trkib_a':$this->input->post('jns_kib');
		if ($table=='trkib_a') {
			$query=$this->db->select(
				array(
					'kd_unit',
					'id_barang',
					'no_sensus',
					'nm_brg',
					'detail_brg',
					'kondisi',
					'tahun',
					'keterangan2',
					'kronologis',
					'nilai',
					'alamat1',
					'luas',
					'(case when kondisi_brg is null or kondisi_brg="" THEN ket_brg ELSE concat(kondisi_brg," / ",keberadaan_brg) END) as hasil',
					'(case when kondisi_brg2 is null or kondisi_brg2="" THEN ket_brg2 ELSE concat(kondisi_brg2," / ",keberadaan_brg2) END) as review',
					'catatan'
					)
			);
		}
		if ($table=='trkib_b') {
			$query=$this->db->select(
				array(
					'kd_unit',
					'id_barang',
					'no_sensus',
					'nm_brg',
					'detail_brg',
					'kondisi',
					'tahun',
					'keterangan2',
					'kronologis',
					'nilai',
					'merek',
					'no_polisi',
					'no_rangka',
					'no_mesin',
					'(case when kondisi_brg is null or kondisi_brg="" THEN ket_brg ELSE concat(kondisi_brg," / ",keberadaan_brg) END) as hasil',
					'(case when kondisi_brg2 is null or kondisi_brg2="" THEN ket_brg2 ELSE concat(kondisi_brg2," / ",keberadaan_brg2) END) as review',
					'catatan',
					'umur_sisa'
					)
			);
		}
		if ($table=='trkib_c') {
			$query=$this->db->select(
				array(
					'kd_unit',
					'id_barang',
					'no_sensus',
					'nm_brg',
					'detail_brg',
					'kondisi',
					'tahun',
					'keterangan2',
					'kronologis',
					'nilai',
					'alamat1',
					'konstruksi',
					'jenis_gedung',
					'luas_tanah',
					'(case when kondisi_brg is null or kondisi_brg="" THEN ket_brg ELSE concat(kondisi_brg," / ",keberadaan_brg) END) as hasil',
					'(case when kondisi_brg2 is null or kondisi_brg2="" THEN ket_brg2 ELSE concat(kondisi_brg2," / ",keberadaan_brg2) END) as review',
					'catatan'
					)
			);
		}
		if ($table=='trkib_d') {
			$query=$this->db->select(
				array(
					'kd_unit',
					'id_barang',
					'no_sensus',
					'nm_brg',
					'detail_brg',
					'kondisi',
					'tahun',
					'keterangan2',
					'kronologis',
					'nilai',
					'alamat1',
					'konstruksi',
					'panjang',
					'lebar',
					'luas',
					'(case when kondisi_brg is null or kondisi_brg="" THEN ket_brg ELSE concat(kondisi_brg," / ",keberadaan_brg) END) as hasil',
					'(case when kondisi_brg2 is null or kondisi_brg2="" THEN ket_brg2 ELSE concat(kondisi_brg2," / ",keberadaan_brg2) END) as review',
					'catatan'
					)
			);
		}
		if ($table=='trkib_e') {
			$query=$this->db->select(
				array(
					'kd_unit',
					'id_barang',
					'no_sensus',
					'nm_brg',
					'detail_brg',
					'kondisi',
					'tahun',
					'keterangan2',
					'kronologis',
					'nilai',
					'judul',
					'spesifikasi',
					'asal',
					'cipta',
					'jenis',
					'(case when kondisi_brg is null or kondisi_brg="" THEN ket_brg ELSE concat(kondisi_brg," / ",keberadaan_brg) END) as hasil',
					'(case when kondisi_brg2 is null or kondisi_brg2="" THEN ket_brg2 ELSE concat(kondisi_brg2," / ",keberadaan_brg2) END) as review',
					'catatan'
					)
			);
		}
		if ($table=='trkib_f') {
			$query=$this->db->select(
				array(
					'kd_unit',
					'id_barang',
					'no_sensus',
					'nm_brg',
					'detail_brg',
					'kondisi',
					'tahun',
					'keterangan2',
					'kronologis',
					'nilai',
					'alamat1',
					'bangunan',
					'luas',
					'jenis',
					'(case when kondisi_brg is null or kondisi_brg="" THEN ket_brg ELSE concat(kondisi_brg," / ",keberadaan_brg) END) as hasil',
					'(case when kondisi_brg2 is null or kondisi_brg2="" THEN ket_brg2 ELSE concat(kondisi_brg2," / ",keberadaan_brg2) END) as review',
					'catatan'
					)
			);
		}
		$query=$this->db->from($table);
		if ($table=='trkib_a') {
			if ($kondisi<>'') {
				$query=$this->db->where('kondisi',$kondisi);
			}
			if ($keterangan<>'') {
				$query=$this->db->like('keterangan2',$keterangan);
			}
			if ($kronologis<>'') {
				$query=$this->db->like('kronologis',$kronologis);
			}
			if ($alamat<>'') {
				$query=$this->db->like('alamat1',$alamat);
			}
			if ($luas<>'') {
				$query=$this->db->like('luas',$luas);
			}
		}
		if ($table=='trkib_b') {
			if ($kondisi<>'') {
				$query=$this->db->where('kondisi',$kondisi);
			}
			if ($keterangan<>'') {
				$query=$this->db->like('keterangan2',$keterangan);
			}
			if ($kronologis<>'') {
				$query=$this->db->like('kronologis',$kronologis);
			}
			if ($merek<>'') {
				$query=$this->db->like('merek',$merek);
			}
			if ($no_polisi<>'') {
				$query=$this->db->like('no_polisi',$no_polisi);
			}
			if ($no_rangka<>'') {
				$query=$this->db->like('no_rangka',$no_rangka);
			}
			if ($no_mesin<>'') {
				$query=$this->db->like('no_mesin',$no_mesin);
			}
		}
		if ($table=='trkib_c') {
			if ($kondisi<>'') {
				$query=$this->db->where('kondisi',$kondisi);
			}
			if ($keterangan<>'') {
				$query=$this->db->like('keterangan2',$keterangan);
			}
			if ($kronologis<>'') {
				$query=$this->db->like('kronologis',$kronologis);
			}
			if ($alamat<>'') {
				$query=$this->db->like('alamat1',$alamat);
			}
			if ($luas<>'') {
				$query=$this->db->like('luas_tanah',$luas);
			}
			if ($konstruksi<>'') {
				$query=$this->db->like('konstruksi',$konstruksi);
			}
			if ($jenis<>'') {
				$query=$this->db->like('jenis_gedung',$jenis);
			}
		}
		if ($table=='trkib_d') {
			if ($kondisi<>'') {
				$query=$this->db->where('kondisi',$kondisi);
			}
			if ($keterangan<>'') {
				$query=$this->db->like('keterangan2',$keterangan);
			}
			if ($kronologis<>'') {
				$query=$this->db->like('kronologis',$kronologis);
			}
			if ($alamat<>'') {
				$query=$this->db->like('alamat1',$alamat);
			}
			if ($luas<>'') {
				$query=$this->db->like('luas',$luas);
			}
			if ($konstruksi<>'') {
				$query=$this->db->like('konstruksi',$konstruksi);
			}
			if ($panjang<>'') {
				$query=$this->db->like('panjang',$panjang);
			}
			if ($lebar<>'') {
				$query=$this->db->like('lebar',$lebar);
			}
		}
		if ($table=='trkib_e') {
			if ($kondisi<>'') {
				$query=$this->db->where('kondisi',$kondisi);
			}
			if ($keterangan<>'') {
				$query=$this->db->like('keterangan2',$keterangan);
			}
			if ($kronologis<>'') {
				$query=$this->db->like('kronologis',$kronologis);
			}
			if ($judul<>'') {
				$query=$this->db->like('judul',$judul);
			}
			if ($spesifikasi<>'') {
				$query=$this->db->like('spesifikasi',$spesifikasi);
			}
			if ($asal<>'') {
				$query=$this->db->like('asal',$asal);
			}
			if ($cipta<>'') {
				$query=$this->db->like('cipta',$cipta);
			}
		}
		if ($table=='trkib_f') {
			if ($kondisi<>'') {
				$query=$this->db->where('kondisi',$kondisi);
			}
			if ($keterangan<>'') {
				$query=$this->db->like('keterangan2',$keterangan);
			}
			if ($kronologis<>'') {
				$query=$this->db->like('kronologis',$kronologis);
			}
			if ($alamat<>'') {
				$query=$this->db->like('alamat1',$alamat);
			}
			if ($luas<>'') {
				$query=$this->db->like('luas',$luas);
			}
			if ($bangunan<>'') {
				$query=$this->db->like('bangunan',$bangunan);
			}
			if ($jenis<>'') {
				$query=$this->db->like('jenis',$jenis);
			}
		}
		$query=$this->db->where('kd_skpd',$kd_skpd);
		if ($kd_unit<>'') {
			$query=$this->db->where('kd_unit',$kd_unit);
		}
		if ($no_sensus<>'') {
			$query=$this->db->like('no_sensus',$no_sensus);
		}
		if ($nm_brg<>'') {
			$query=$this->db->like('nm_brg',$nm_brg);
		}
		if ($rincian<>'') {
			$i = 0;

			foreach ($rincian as $post_rincian){

				if ($i===0) {
					$this->db->group_start();
					$this->db->like('detail_brg', $post_rincian);
				} else {
					$this->db->or_like('detail_brg', $post_rincian);
				}

				$i++;
				
			}
			$this->db->group_end();
			
		}
		if ($tahun<>"") {
			if (strpos($tahun,",")<>"") {
				$data = explode(",",$tahun);
				$i = 0;
				foreach ($data as $item){

					if ($i===0) {
						$this->db->group_start();
						$this->db->like('tahun', $item);
					} else {
						$this->db->or_like('tahun', $item);
					}

					$i++;

				}
				$this->db->group_end();
			}elseif (strpos($tahun,"-")<>'') {

				$data = explode("-", $tahun);
				$this->db->where('tahun BETWEEN '.$data[0].' AND '.$data[1]);

			}elseif (substr($tahun,0,2)=="<=") {

				$data = explode("<=", $tahun);
				$this->db->where('tahun <=',$data[1]);

			}elseif (substr($tahun,0,2)==">=") {

				$data = explode(">=", $tahun);
				$this->db->where('tahun >=',$data[1]);

			}elseif (substr($tahun,0,1)=="<") {

				$data = explode("<", $tahun);
				$this->db->where('tahun <',$data[1]);

			}elseif (substr($tahun,0,1)==">") {

				$data = explode(">", $tahun);
				$this->db->where('tahun >',$data[1]);

			}else{
				$data = substr(trim($tahun),0,4);
				$this->db->like('tahun', $data);
			}
		}



		if (strpos($nilai,',')<>'') {
			$data = explode(",",$nilai);
			$i = 0;
			foreach ($data as $item){

				if ($i===0) {
					$this->db->group_start();
					$this->db->like('nilai', $item);
				} else {
					$this->db->or_like('nilai', $item);
				}

				$i++;

			}
			$this->db->group_end();
		}elseif (strpos($nilai,'-')<>'') {
			$data = explode("-", $nilai);
			$this->db->where('nilai BETWEEN '.$data[0].' AND '.$data[1]);
		}elseif (substr($nilai,0,2)=="<=") {

			$data = explode("<=", $nilai);
			$this->db->where('nilai <=',$data[1]);
		}elseif (substr($nilai,0,2)==">=") {

			$data = explode(">=", $nilai);
			$this->db->where('nilai >=',$data[1]);
		}elseif (substr($nilai,0,1)=="<") {

			$data = explode("<", $nilai);
			$this->db->where('nilai <',$data[1]);
		}elseif (substr($nilai,0,1)==">") {

			$data = explode(">", $nilai);
			$this->db->where('nilai >',$data[1]);
		}else{
			$data = substr(trim($nilai),0,4);
			$this->db->like('nilai', $data);
		}

		if ($hasil<>'') {
			$field_hasil = array(
						'kondisi_brg',
						'ket_brg',
						'keberadaan_brg'
			);
			$i = 0;
			foreach ($hasil as $post_hasil){
				$data = explode(",", $post_hasil);
				if ($i===0) {
					$this->db->group_start();
					if ($data[0]=='keberadaan_brg') {
						$this->db->where($field_hasil[2], $data[1]);
					}
					if ($data[0]=='kondisi_brg') {
						$this->db->where($field_hasil[0], $data[1]);
					}
					if ($data[0]=='ket_brg') {
						$this->db->where($field_hasil[1], $data[1]);
					}
				}else {
					if ($data[0]=='keberadaan_brg') {
						$this->db->or_where($field_hasil[2], $data[1]);
					}
					if ($data[0]=='kondisi_brg') {
						$this->db->or_where($field_hasil[0], $data[1]);
					}
					if ($data[0]=='ket_brg') {
						$this->db->or_where($field_hasil[1], $data[1]);
					}
				}
				$i++;
			}
			$this->db->group_end();
		}
		if ($review<>'') {
			if ($review[0]=='Belum') {

					$this->db->where(array('keberadaan_brg2'=>'','kondisi_brg2'=>'','ket_brg2'=>''));

			}else{
				$field_review = array('kondisi_brg2','ket_brg2','keberadaan_brg2'
				);
				$i = 0;
				foreach ($review as $post_review){
					$data = explode(",", $post_review);
					if ($i===0) {
						$this->db->group_start();
						if ($data[0]=='keberadaan_brg') {
							$this->db->where($field_review[2], $data[1]);
						}
						if ($data[0]=='kondisi_brg') {
							$this->db->where($field_review[0], $data[1]);
						}
						if ($data[0]=='ket_brg') {
							$this->db->where($field_review[1], $data[1]);
						}
					}else{
						if ($data[0]=='keberadaan_brg') {
							$this->db->or_where($field_review[2], $data[1]);
						}
						if ($data[0]=='kondisi_brg') {
							$this->db->or_where($field_review[0], $data[1]);
						}
						if ($data[0]=='ket_brg') {
							$this->db->or_where($field_review[1], $data[1]);
						}
					}
					$i++;
				}
				$this->db->group_end();	
			}
		}
		if ($catatan<>'') {
			$query=$this->db->like('catatan',$catatan);
		}
		if ($umur<>'' && $table=='trkib_b') {
			$query=$this->db->like('umur_sisa',$umur);
		}
		$column_order  = array(null,'no_sensus','nm_brg','detail_brg','tahun','nilai','kondisi_brg','kondisi_brg','catatan',null);
		$column_search = array('no_sensus','nm_brg');
		$order         = array('no_sensus'=>'ASC');
		$data          = array();
		$list          = $this->M_model->get_datatables($query, $column_order, $column_search, $order);
		$no            = $_POST['start'];
		$umur_sisa     = "";
		foreach ($list['result'] as $resulte) {
			if ($kd_unit<>'') {
				$nmunit = "";
			}else{
				$nmunit = "<tr>
								<td valign=\"top\"><strong>UPB</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> ".$this->nmunit($resulte->kd_unit)."</td>
							</tr>";
			}
			$no++;
			$row    = array();
			if ($table=='trkib_a') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas</td>
							</tr>
							$nmunit
						</table>";
			}
			if ($table=='trkib_b') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Merek</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->merek</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>No Polisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->no_polisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>No Rangka</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->no_rangka</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>No Mesin</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->no_mesin</td>
							</tr>
							$nmunit
						</table>";
				$umur_sisa = ($resulte->umur_sisa<0)?'0':$resulte->umur_sisa;
			}
			if ($table=='trkib_c') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Konstruksi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->konstruksi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Jenis Gedung</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->jenis_gedung</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas Tanah</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas_tanah</td>
							</tr>
							$nmunit
						</table>";
			}
			if ($table=='trkib_d') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Konstruksi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->konstruksi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Panjang</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->panjang</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Lebar</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->lebar</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas</td>
							</tr>
							$nmunit
						</table>";
			}
			if ($table=='trkib_e') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Judul</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->judul</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Spesifikasi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->spesifikasi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Asal</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->asal</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Cipta</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->cipta</td>
							</tr>
							$nmunit
						</table>";
			}
			if ($table=='trkib_f') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Bangunan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->bangunan</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Jenis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->jenis</td>
							</tr>
							$nmunit
						</table>";
			}
			$row[]  = $no;
			$row[]  = $resulte->no_sensus;
			$row[]  = $resulte->nm_brg;
			$row[]  = $detail;
			$row[]  = $resulte->tahun;
			$row[]  = number_format($resulte->nilai,2);
			$row[]  = $umur_sisa;
			$row[]  = $resulte->hasil;
			$row[]  = $resulte->review;
			$row[]  = $resulte->catatan;
			$row[]  = "<button class='btn btn-primary' onclick=edit(\"".$resulte->id_barang."\")><i class='fa fa-edit'></i></button>
			<button class='btn btn-primary' onclick=get_image(\"".$resulte->id_barang."\")><i class='fa fa-images'></i></button>
			";
			$data[] = $row;
		}
		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->M_model->count_all($query),
			"recordsFiltered" => $list['count_filtered'],
			"data"            => $data
		);
		echo json_encode($output);
	}
	public function nmunit($kd_unit){
		$res = $this->db->where('kd_lokasi',$kd_unit)->get('mlokasi')->row('nm_lokasi');
		return $res;
	}
	public function get_brg_id(){
		$id_barang = $this->input->get('id_barang');
		$table     = $this->input->get('jns_kib');
		if ($table=='trkib_a') {
			$query=
					'id_barang,
					no_sensus,
					nm_brg,
					detail_brg,
					kondisi,
					tahun,
					keterangan2,
					kronologis,
					nilai,
					alamat1,
					luas,
					stat_fisik2,
					kondisi_brg2,
                    ket_brg2,
					catatan,
					keberadaan_brg2';
		}
		if ($table=='trkib_b') {
			$query=
				'id_barang,
				no_sensus,
				nm_brg,
				detail_brg,
				kondisi,
				tahun,
				keterangan2,
				kronologis,
				nilai,
				merek,
				no_polisi,
				no_rangka,
				no_mesin,
				stat_fisik2,
				kondisi_brg2,
                ket_brg2,
				catatan,
				keberadaan_brg2';
		}
		if ($table=='trkib_c') {
			$query=
					'id_barang,
					no_sensus,
					nm_brg,
					detail_brg,
					kondisi,
					tahun,
					keterangan2,
					kronologis,
					nilai,
					alamat1,
					konstruksi,
					jenis_gedung,
					luas_tanah,
					stat_fisik2,
					kondisi_brg2,
                    ket_brg2,
					catatan,
					keberadaan_brg2';
		}
		if ($table=='trkib_d') {
			$query= 'id_barang,
					no_sensus,
					nm_brg,
					detail_brg,
					kondisi,
					tahun,
					keterangan2,
					kronologis,
					nilai,
					alamat1,
					konstruksi,
					panjang,
					lebar,
					luas,
					stat_fisik2,
					kondisi_brg2,
                    ket_brg2,
					catatan,
					keberadaan_brg2';
		}
		if ($table=='trkib_e') {
			$query= 'id_barang,
					no_sensus,
					nm_brg,
					detail_brg,
					kondisi,
					tahun,
					keterangan2,
					kronologis,
					nilai,
					judul,
					spesifikasi,
					asal,
					cipta,
					jenis,
					stat_fisik2,
					kondisi_brg2,
                    ket_brg2,
					catatan,
					keberadaan_brg2';
		}
		if ($table=='trkib_f') {
			$query= 'id_barang,
					no_sensus,
					nm_brg,
					detail_brg,
					kondisi,
					tahun,
					keterangan2,
					kronologis,
					nilai,
					alamat1,
					bangunan,
					luas,
					jenis,
					stat_fisik2,
					kondisi_brg2,
                    ket_brg2,
					catatan,
					keberadaan_brg2';
		}
		$query1       = $this->db->query("SELECT $query from $table where id_barang='$id_barang'");
		foreach ($query1->result() as $resulte) {
			if ($table=='trkib_a') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Nama</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->nm_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas</td>
							</tr>
						</table>";
			}
			if ($table=='trkib_b') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Nama</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->nm_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Merek</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->merek</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>No Polisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->no_polisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>No Rangka</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->no_rangka</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>No Mesin</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->no_mesin</td>
							</tr>
						</table>";
			}
			if ($table=='trkib_c') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Nama</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->nm_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Konstruksi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->konstruksi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Jenis Gedung</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->jenis_gedung</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas Tanah</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas_tanah</td>
							</tr>
						</table>";
			}
			if ($table=='trkib_d') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Nama</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->nm_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Konstruksi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->konstruksi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Panjang</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->panjang</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Lebar</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->lebar</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas</td>
							</tr>
						</table>";
			}
			if ($table=='trkib_e') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Nama</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->nm_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Judul</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->judul</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Spesifikasi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->spesifikasi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Asal</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->asal</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Cipta</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->cipta</td>
							</tr>
						</table>";
			}
			if ($table=='trkib_f') {
				$detail = "<table>
							<tr>
								<td valign=\"top\"><strong>Nama</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->nm_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Detail</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->detail_brg</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Kondisi</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kondisi</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Keterangan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->keterangan2</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>kronologis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->kronologis</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Alamat</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->alamat1</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Bangunan</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->bangunan</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Luas</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->luas</td>
							</tr>
							<tr>
								<td valign=\"top\"><strong>Jenis</strong> </td>
								<td valign=\"top\"> : </td>
								<td valign=\"top\"> $resulte->jenis</td>
							</tr>
						</table>";
			}
			$data = array(
				'id_barang'       =>$resulte->id_barang,
				'no_sensus'       =>$resulte->no_sensus,
				'rincian'         =>$detail,
				'stat_fisik2'     =>$resulte->stat_fisik2,
				'keberadaan_brg2' =>$resulte->keberadaan_brg2,
				'kondisi_brg2'    =>$resulte->kondisi_brg2,
				'ket_brg2'        =>$resulte->ket_brg2,
				'catatan'         =>$resulte->catatan
			);
		}
		echo(json_encode($data));
	}
	function get_image(){
		$id_barang = $this->input->get('id_barang');
		$jns_kib   = $this->input->get('jns_kib');
		if ($jns_kib=='trkib_a' || $jns_kib=='trkib_c') {
			$query     = $this->db->query("
				SELECT  
				IF(foto1 is null OR LENGTH(foto1)<36 OR LENGTH(foto1)>37,0,foto1) AS foto1, 
				IF(foto2 is null OR LENGTH(foto2)<36 OR LENGTH(foto2)>37,0,foto2) AS foto2, 
				IF(foto3 is null OR LENGTH(foto3)<36 OR LENGTH(foto3)>37,0,foto3) AS foto3, 
				IF(foto4 is null OR LENGTH(foto4)<36 OR LENGTH(foto4)>37,0,foto4) AS foto4  
				from $jns_kib where id_barang = '$id_barang'");
		}else{
			$query     = $this->db->query("
				SELECT  
				IF(foto  is null OR LENGTH(foto)<36  OR LENGTH(foto)>37,0,foto)   AS foto1, 
				IF(foto2 is null OR LENGTH(foto2)<36 OR LENGTH(foto2)>37,0,foto2) AS foto2, 
				IF(foto3 is null OR LENGTH(foto3)<36 OR LENGTH(foto3)>37,0,foto3) AS foto3, 
				IF(foto4 is null OR LENGTH(foto4)<36 OR LENGTH(foto4)>37,0,foto4) AS foto4  
				from $jns_kib where id_barang = '$id_barang'");
		}
		$data = array();
		$foto1 = 'javascript:void(0)';
		$foto2 = 'javascript:void(0)';
		$foto3 = 'javascript:void(0)';
		$foto4 = 'javascript:void(0)';
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
							}else if (file_exists(FCPATH.'assets/image_file5/'.$row['foto'.$i])){
								$foto1 = base_url().'assets/image_file5/'.$row['foto'.$i];
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
							}else if (file_exists(FCPATH.'assets/image_file5/'.$row['foto'.$i])){
								$foto2 = base_url().'assets/image_file5/'.$row['foto'.$i];
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
							}else if (file_exists(FCPATH.'assets/image_file5/'.$row['foto'.$i])){
								$foto3 = base_url().'assets/image_file5/'.$row['foto'.$i];
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
							}else if (file_exists(FCPATH.'assets/image_file5/'.$row['foto'.$i])){
								$foto4 = base_url().'assets/image_file5/'.$row['foto'.$i];
							}
						break;
						default:
						break;
					}
				}
			}
			$data = array(
				'foto1' => $foto1,
				'foto2' => $foto2,
				'foto3' => $foto3,
				'foto4' => $foto4
			);
		}
		echo json_encode($data);
	}
}/*END:CLASS*/