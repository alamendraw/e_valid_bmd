<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Reklas extends CI_Model {
	
	function simpan_header($post,$status,$no_dok,$skpd){

		try {
			if($status!='detail'){
				$ck = $this->db->query("SELECT no_dokumen FROM transaksi.trh_reklas
                           WHERE no_dokumen = '$no_dok' and kd_uskpd='$skpd'");	
				if($ck->num_rows() == 0) {
					$this->db->insert('transaksi.trh_reklas', $post);
						return 1;
				} else {
						return 0;
				}
			}else{
				$del = $this->db->where('no_dokumen',$post['no_dokumen'])
							->where('kd_uskpd',$post['kd_uskpd'])
							->delete('transaksi.trh_reklas');
				if($del){
				$sql = $this->db->insert('transaksi.trh_reklas', $post);
				}
					if ($sql) {
						return 1;
						$sql->free_result();
					} else {
						return 0;
					}
			}

		} catch (Exception $e) {
			return 0;
		}
		
	}
	
	function simpan_detail($post,$no_dokumen,$kd_skpd,$status,$sw){

		try {
			if($status!='detail'){						
					foreach($post as $row) {							
							$filter_data = array(
								"no_dokumen" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"id_barang" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"kd_brg" => htmlspecialchars($row->kd_brg, ENT_QUOTES),
								"kd_rek5" => '',
								"kd_unit" => '',
								"kd_uskpd" => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"nm_brg" => htmlspecialchars($row->nm_brg, ENT_QUOTES),
								"merek" => htmlspecialchars($row->merek, ENT_QUOTES),
								"jumlah" => htmlspecialchars($row->jumlah, ENT_QUOTES),
								"harga" => str_replace(array(','), array(''), $row->harga),
								"total" => str_replace(array(','), array(''), $row->harga),
								"status" => '',
								"jns_reklas" => $sw,
								"kd_brg_lama" => htmlspecialchars($row->kd_brg_lama, ENT_QUOTES),
								"uraian_reklas" => str_replace(array(','), array(''), $row->uraian_reklas),
								"ket" => htmlspecialchars($row->uraian_reklas, ENT_QUOTES),
								"satuan" => '',
								"kd_kegiatan" => $row->id_barang
							);
						$sql = $this->db->insert('transaksi.trd_reklas', $filter_data);
					}
			}else{
				$del = $this->db->where('no_dokumen',$no_dokumen)
							->where('kd_uskpd',$kd_skpd)
							->delete('transaksi.trd_reklas');
				if($del){
						foreach($post as $row) {							
							$filter_data = array(
								"no_dokumen" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"id_barang" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"kd_brg" => htmlspecialchars($row->kd_brg, ENT_QUOTES),
								"kd_rek5" => '',
								"kd_unit" => '',
								"kd_uskpd" => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"nm_brg" => htmlspecialchars($row->nm_brg, ENT_QUOTES),
								"merek" => htmlspecialchars($row->merek, ENT_QUOTES),
								"jumlah" => htmlspecialchars($row->jumlah, ENT_QUOTES),
								"harga" => str_replace(array(','), array(''), $row->harga),
								"total" => str_replace(array(','), array(''), $row->harga),
								"status" => '',
								"jns_reklas" => $sw,
								"kd_brg_lama" => htmlspecialchars($row->kd_brg_lama, ENT_QUOTES),
								"uraian_reklas" => str_replace(array(','), array(''), $row->uraian_reklas),
								"ket" => htmlspecialchars($row->uraian_reklas, ENT_QUOTES),
								"satuan" => '',
								"kd_kegiatan" => $row->id_barang
							);
						$sql = $this->db->insert('transaksi.trd_reklas', $filter_data);
						}	
				}
				if($sql){
					
				}
			}
			
			if ($sql) {
				return 1;
				$sql->free_result();
			} else {
				return 0;
			}

		} catch (Exception $e) {
			return 0;
		}
		
	}
	
	function simpan_kdp($post,$no_dokumen,$kd_skpd,$status,$tgl_dokumen){
		try {
				
				if($status!='detail'){
						foreach($post as $row) {							
							/* $filter_data = array(
								"no_dokumen" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"id_barang" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"kd_brg" => htmlspecialchars($row->kd_brg, ENT_QUOTES),
								"kd_rek5" => '',
								"kd_unit" => '',
								"kd_uskpd" => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"nm_brg" => htmlspecialchars($row->nm_brg, ENT_QUOTES),
								"merek" => htmlspecialchars($row->merek, ENT_QUOTES),
								"jumlah" => htmlspecialchars($row->jumlah, ENT_QUOTES),
								"harga" => str_replace(array(','), array(''), $row->harga),
								"total" => str_replace(array(','), array(''), $row->harga),
								"status" => '',
								"jns_reklas" => $sw,
								"kd_brg_lama" => htmlspecialchars($row->kd_brg_lama, ENT_QUOTES),
								"uraian_reklas" => str_replace(array(','), array(''), $row->uraian_reklas),
								"ket" => htmlspecialchars($row->uraian_reklas, ENT_QUOTES),
								"satuan" => '',
								"kd_kegiatan" => $row->id_barang
							); */
						//$sql = $this->db->insert('transaksi.trd_reklas', $filter_data);
							$upd = $this->db->set('tgl_pindah',$tgl_dokumen)
							->set('no_pindah',$no_dokumen)
							->where('id_barang',$row->id_barang)
							->where('kd_skpd',$kd_skpd)
							->update('transaksi.trkib_f');
							
								if($upd){
									if(substr($row->kd_brg,0,3)=='132'){
										$sqlb = "/*kib b*/
												insert into transaksi.trkib_b 
												select 
												no_reg,id_barang,no,no_oleh,tgl_reg,tgl_oleh,no_dokumen,'$row->kd_brg' as kd_brg,
												'' as nm_brg,detail_brg,nilai,asal,dsr_peroleh,jumlah,total,'' as merek,'' as tipe,'' as pabrik,'' as kd_warna,
												konstruksi as kd_bahan,'' as kd_satuan,'' as no_rangka,'' as no_mesin,'' as no_polisi,'' as silinder,'' as no_stnk,null as tgl_stnk,'' as no_bpkb,
												null as tgl_bpkb,kondisi,'' as tahun_produksi,dsr_peroleh as dasar,'' as no_sk,null as tgl_sk,keterangan,no_mutasi,tgl_mutasi,
												no_pindah,tgl_pindah,no_hapus,tgl_hapus,'' as kd_ruang,'' as kd_lokasi2,kd_skpd,kd_unit,milik,
												wilayah,username,tgl_update,tahun,'' as foto1,'' as foto2,'' as foto3,'$row->kd_brg_lama' as foto4,'' as foto5,no_urut,'' as metode,'' as masa_manfaat,
												'' as nilai_sisa,kd_riwayat,tgl_riwayat,detail_riwayat,milik as kd_pemilik,auto
												 from transaksi.trkib_f 
												 where id_barang='$row->id_barang'";
												$query1 = $this->db->query($sqlb);
									}elseif(substr($row->kd_brg,0,3)=='133'){
										$sqlc = "/*kib c*/
												insert into transaksi.trkib_c 
												select no_reg,id_barang,no,no_oleh,tgl_reg,tgl_oleh,no_dokumen,'$row->kd_brg' as kd_brg,detail_brg,nilai,
												jumlah,asal,dsr_peroleh,total,no_dokumen no_dok,tgl_oleh tgl_dok,luas luas_gedung,konstruksi jenis_gedung,luas luas_tanah,
												status_tanah,alamat1,alamat2,alamat3,no_mutasi,tgl_mutasi,no_pindah,tgl_pindah,
												no_hapus,tgl_hapus,konstruksi,konstruksi2,luas luas_lantai,kondisi,dsr_peroleh dasar,null as tgl_sk,
												keterangan,'' as kd_lokasi2,kd_skpd,kd_unit,milik,wilayah,kd_tanah,username,tgl_update,
												tahun,'' as foto1,'' as foto2,'' as foto3,'$row->kd_brg_lama' as foto4,no_urut,lat,lon,'' as metode,'' as masa_manfaat,'' as nilai_sisa,'' as hibah,
												kd_riwayat,tgl_riwayat,detail_riwayat,'' as kd_pemilik,auto
												 from transaksi.trkib_f
												 where id_barang='$row->id_barang'";
												$query1 = $this->db->query($sqlc);
									}elseif(substr($row->kd_brg,0,3)=='134'){
										$sqld = "/*kib d*/
												insert into transaksi.trkib_d 
												select no_reg,id_barang,no,no_oleh,tgl_reg,tgl_oleh,no_dokumen,'$row->kd_brg' as kd_brg,detail_brg,kd_tanah,
												nilai,asal,total,no_dokumen no_dok,tgl_oleh tgl_dok,kondisi,status_tanah,'' panjang,luas,'' lebar,konstruksi,alamat1,
												alamat2,alamat3,no_mutasi,tgl_mutasi,no_pindah,tgl_pindah,no_hapus,tgl_hapus,dsr_peroleh perolehan,dsr_peroleh dasar,
												jumlah,keterangan,kd_skpd,kd_unit,milik,wilayah,'' penggunaan,username,tgl_update,tahun,'' foto1,
												foto2,'$row->kd_brg_lama' foto3,no_urut,lat,lon,'' metode,'' masa_manfaat,'' nilai_sisa,kd_riwayat,tgl_riwayat,detail_riwayat,
												milik kd_pemilik,auto,'' no_sp2d
												from transaksi.trkib_f
												 where id_barang='$row->id_barang'";
												$query1 = $this->db->query($sqld);
									}else{
										$sqle = "/*kib e*/
												insert into transaksi.trkib_e 
												select no_reg,id_barang,no,no_oleh,tgl_reg,tgl_oleh,no_dokumen,'$row->kd_brg' as kd_brg,detail_brg,nilai,
												'' peroleh,dsr_peroleh,total,'' judul,'' spesifikasi,asal,'' cipta,'' tahun_terbit,'' penerbit,'' kd_bahan,
												'' jenis,'' tipe,'' kd_satuan,jumlah,kondisi,keterangan,kd_skpd,kd_unit,milik,wilayah,username,
												tgl_update,no_mutasi,tgl_mutasi,no_pindah,tgl_pindah,no_hapus,tgl_hapus,'' kd_ruang,tahun,
												'' foto1,'' foto2,'$row->kd_brg_lama' foto3,no_urut,'' metode,'' masa_manfaat,'' nilai_sisa,lat,lon,kd_riwayat,
												tgl_riwayat,detail_riwayat,milik kd_pemilik,auto
												from transaksi.trkib_f
												 where id_barang='$row->id_barang'";
												$query1 = $this->db->query($sqle);
									}
								}
						
						}	
				}
			
			if ($upd) {
				return 1;
				$sql->free_result();
			} else {
				return 0;
			}

		} catch (Exception $e) {
			return 0;
		}
		
	}
	
	function ubah($post){
		$object = array(
			'kd_comp'	=> htmlspecialchars($post['kd_comp'], ENT_QUOTES),
			'nm_comp'	=> htmlspecialchars($post['nm_comp'], ENT_QUOTES),
			'bentuk'	=> htmlspecialchars($post['bentuk'], ENT_QUOTES),
			'alamat'	=> htmlspecialchars($post['alamat'], ENT_QUOTES),
			'pimpinan'	=> htmlspecialchars($post['pimpinan'], ENT_QUOTES),
			'kd_bank'	=> htmlspecialchars($post['kd_bank'], ENT_QUOTES),
			'rekening'	=> htmlspecialchars($post['rekening'], ENT_QUOTES),
		);

		$sql = $this->db->where('kd_comp', $object['kd_comp'])
						->update('mcompany', $object);

		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}		
	}
	
	function hapus($post){
		$kd 	= explode("#",$post['kode']);
		$skpd 	= explode("#",$post['kd_skpd']);
		$jml	= count($kd);
		try{
			if($jml>0){
				for($i=0;$i<=$jml;$i++){
						$sql = $this->db->where('no_dokumen', $kd[$i])
								->where('kd_uskpd',$skpd[$i])
								->delete('transaksi.trh_reklas');
								if($sql){
										$sql = $this->db->where('no_dokumen', $kd[$i])
										->where('kd_uskpd',$skpd[$i])
										->delete('transaksi.trd_reklas');
										return 1;
										$sql->free_result();
									}else{
									return 0;
								}
				}					
			}					
		}catch(Exception $e){
			return 0;
		}
		
	}

	public function ambil_bank($param)
	{
		$sql = "SELECT kode, nama FROM mbank where upper(kode) like upper('%$param%') or upper(nama) like upper('%$param%') order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(
	            'id' => $ii,        
	            'kd_bank' => $resulte['kode'],  
	            'nm_bank' => $resulte['nama']
            );	
            $ii++;
        }
        return $result;
        $query1->free_result();
	}

	public function load_trd($param)
	{
		$nomor 	= $param['nomor'];
		$skpd 	= $param['skpd'];

		$csql = "SELECT SUM(total) AS total from transaksi.trd_reklas 
		where no_dokumen = '$nomor' and kd_uskpd = '$skpd'";
        $rs   = $this->db->query($csql)->row() ; 
		
        $sql = "SELECT b.* FROM transaksi.trh_reklas a 
				INNER JOIN transaksi.trd_reklas b ON a.no_dokumen=b.no_dokumen 
				AND a.kd_uskpd=b.kd_uskpd AND a.kd_unit=b.kd_unit
				WHERE a.no_dokumen = '$nomor' AND a.kd_uskpd = '$skpd'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(                                
                'no_dokumen'    => $resulte['no_dokumen'],      
                'id_barang'    	=> $resulte['id_barang'],                    
                'kd_brg'        => $resulte['kd_brg'],                     
                'kd_rek5'       => $resulte['kd_rek5'],
                'nm_brg'        => $resulte['nm_brg'],
                'merek'         => $resulte['merek'],
                'jumlah'        => $resulte['jumlah'],
                'harga'         => $resulte['harga'],
                'total'         => $resulte['total'],
                'sum'         	=> $rs->total,                        
                'jns_reklas'	=> $resulte['jns_reklas'],            
                'kd_brg_lama'	=> $resulte['kd_brg_lama'],           
                'uraian_reklas'	=> $resulte['uraian_reklas'],          
                'ket'           => $resulte['ket'],                        
                'satuan'        => $resulte['satuan'],                    
                'kd_kegiatan'   => $resulte['kd_kegiatan'] 				
            );
            $ii++;
        }           
		
        return $result; 
	}


	public function getSkpd()
	{
		$oto 	= $this->session->userdata('oto');
		$skpd 	= $this->session->userdata('kd_skpd');
		if($oto=='01'){
			$and = "";
		}elseif($oto=='02'){
			$and = "and kd_skpd='$skpd'";
		}else{
			$and = "";
		}
		
        $lccr 	= strtoupper($this->input->post('q'));
		/* $sql 	= $this->db->select('*')
								->from('mskpd')
								->where("kd_skpd like '%$lccr%'")
								->get(); */
		$sql 	= $this->db->query("select * from mskpd 
			where (upper(kd_skpd) like '%$lccr%' or upper(nm_skpd) like '%$lccr%') $and");						
		
		$res 	= array();
		$li 	= 0;
		foreach ($sql->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_skpd'	=> $key['kd_skpd'],
				'nm_skpd'	=> $key['nm_skpd']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}
	
	public function getProgram($param)
	{
        $lccr 	= strtolower($this->input->post('q'));
		$kd_skpd = $param['kode'];
		$sql 		= $this->db->select('kd_program,nm_program')
								->from('trskpd')
								->where('kd_skpd',$kd_skpd)
								->where('jns_kegiatan','52')
								->where("(LOWER(kd_program) LIKE '%{$lccr}%' OR LOWER(nm_program) LIKE '%{$lccr}%')")
								->group_by('kd_program')
								->group_by('nm_program')
								->get();
		$res = array();
		$li = 0;
		foreach ($sql->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kd_program'	=> $key['kd_program'],
				'nm_program'	=> $key['nm_program']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}
	
	public function getKegiatan($param)
	{
		
		$kd_program = $param['kode'];
        $lccr 	= strtolower($this->input->post('q'));
		$sql 		= $this->db->select('a.kd_kegiatan,a.nm_kegiatan')
					->from('trdrka a')
					->join('trskpd b','a.kd_kegiatan=b.kd_kegiatan')
					->where('b.kd_program',$kd_program)
					->where('b.jns_kegiatan','52')
					->where("(LOWER(a.kd_kegiatan) LIKE '%{$lccr}%' OR LOWER(a.nm_kegiatan) LIKE '%{$lccr}%')")
					->group_by('a.kd_kegiatan')
					->group_by('a.nm_kegiatan')
					->get();
		$res 		= array();
		$li = 0;
		foreach ($sql->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kd_kegiatan'	=> $key['kd_kegiatan'],
				'nm_kegiatan'	=> $key['nm_kegiatan']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}

		public function getSatuan($param)
	{        
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_satuan) like upper('%$lccr%')"; 
        }


		$sql	= "SELECT kd_satuan, nm_satuan 
				FROM msatuan $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_satuan' => $key['kd_satuan'],  
                'nm_satuan' => $key['nm_satuan'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getKelompok()
	{
		$data = array();
		$sql = $this->db->query("SELECT kd_brg,uraian FROM mbarang WHERE length(kd_brg)='2' and kd_brg!='11' and kd_brg!='15'");			
		foreach ($sql->result_array() as $key) {
			$data[] = array(
				'kelompok'		=> $key['kd_brg'],
				'nm_kelompok'	=> $key['uraian']
			);
		}
		return $data;
		$sql->free_result();
	}
	
	public function getJenis($param)
	{
		$kel  	= $param['kd'];
		$lccq 	= $param['lccq'];
		$rd 	= $param['rd'];
				
		if ($kel != '') {
			if($kel=='13'){
				if($rd=='1'){
				$whr = "LEFT(kd_brg, 2) = '$kel' AND LENGTH(kd_brg)='3' AND kd_brg!='131' AND kd_brg!='136' AND kd_brg!='137' AND ";
				}else{
				$whr = "LEFT(kd_brg, 2) = '$kel' AND LENGTH(kd_brg)='3' AND kd_brg='136' AND ";
				}
			}else{
			$whr = "LEFT(kd_brg, 2) = '$kel' AND kd_brg='153' AND ";
			}
		} else {
			$whr = '';
		}				
		
		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE $whr (upper(kd_brg) like upper('%$lccq%') 
		or upper(uraian) like upper('%$lccq%')) order by kd_brg";
		$query = $this->db->query($sql);
		$data = array();
		$li = 0;		
		foreach ($query->result_array() as $key) {
			$data[] = array(
				'id'		=> $li,
				'jenis'		=> $key['kd_brg'],
				'nm_jenis'	=> $key['uraian']
			);
			$li++;
		}
		return $data;
		$sql->free_result();
	}

	public function getBarang($param)
	{
		$jen  	= $param['kd'];
		$skpd  	= $param['skpd'];
		$tab  	= $param['tabel'];
		$lccq 	= $param['lccq'];
		
		if($tab=='trkib_a' || $tab=='trkib_c' || $tab=='trkib_d' || $tab=='trkib_f'){
			$merek ="'' as merek";
			$satuan="'' as kd_satuan";
		}else{
			$merek ="a.merek";
			$satuan="a.kd_satuan";
		}
		
		if ($jen != '') {
			$whr = "a.kd_skpd = '$skpd' AND ";//"LEFT(kd_brg, 3) = '$jen' AND LENGTH(kd_brg)='12' AND ";
		} else {
			$whr = '';
		}

		$sql ="SELECT a.id_barang,a.kd_brg,b.uraian,$satuan,$merek,
		a.jumlah,a.nilai,a.total,a.keterangan  
		FROM transaksi.$tab a join public.mbarang b on a.kd_brg=b.kd_brg
		WHERE $whr (upper(a.kd_brg) like upper('%$lccq%') 
		or upper(b.uraian) like upper('%$lccq%')) ORDER BY a.kd_brg LIMIT 100 OFFSET 0";		
		$query = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'id_barang'	=> $key['id_barang'],  
				'kd_brg' 	=> $key['kd_brg'],  
                'kd_satuan'	=> $key['kd_satuan'],  
                'merek' 	=> $key['merek'],  
                'jumlah' 	=> $key['jumlah'],  
                'nilai' 	=> $key['nilai'],  
                'total' 	=> $key['total'],  
                'keterangan'=> $key['keterangan'],  
                'nm_brg' 	=> $key['uraian']
				
			);
			$li++;
		}

		return $res;
		$query->free_result();
	}
	
	
	public function getBarangNew($param)
	{
		$jen  	= $param['kd'];
		$lccq 	= $param['lccq'];

		if ($jen != '') {
			$whr = "LEFT(kd_brg, 3) = '$jen' AND LENGTH(kd_brg)='12' AND ";
		} else {
			$whr = '';
		}

		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE $whr (upper(kd_brg) like upper('%$lccq%') 
		or upper(uraian) like upper('%$lccq%')) ORDER BY kd_brg LIMIT 100 OFFSET 1";		
		$query = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_brg' 	=> $key['kd_brg'],  
                'nm_brg' 	=> $key['uraian']  
			);
			$li++;
		}

		return $res;
		$query->free_result();
	}
	
	public function max_number($param)
	{
		$oto   = $this->session->userdata('oto');
		$skpd  = $param['skpd'];
		$kolom = $param['kolom'];
		$table = $param['table'];
		
		if($oto=='01'){
			$where = "";
		}elseif($oto=='02'){
			$where = "where kd_uskpd='$skpd'";
		}else{
			$where = "";
		}

		$query1 = $this->db->query("SELECT MAX($kolom) AS kode FROM $table $where");  
        $result = array();
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(      
                'no_urut' => $resulte['kode']
            );
        }
        return $result;
        $query1->free_result();
	}

}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */