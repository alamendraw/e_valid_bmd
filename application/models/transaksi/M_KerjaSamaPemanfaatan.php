<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_KerjaSamaPemanfaatan extends CI_Model {
	
	function simpan_header($post,$status,$no_dok,$skpd){

		try {
			if($status!='detail'){			
				$ck = $this->db->query("SELECT no_dokumen FROM transaksi.trh_kerjasama
                           WHERE no_dokumen = '$no_dok' and kd_uskpd='$skpd'");	
				if($ck->num_rows() == 0) {
					$this->db->insert('transaksi.trh_kerjasama', $post);
						return 1;
				} else {
						return 0;
				}
			}else{
				$del = $this->db->where('no_dokumen',$post['no_dokumen'])
							->where('kd_uskpd',$post['kd_uskpd'])
							->delete('transaksi.trh_kerjasama');
				if($del){
				$sql = $this->db->insert('transaksi.trh_kerjasama', $post);
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
	
	function simpan_detail($post,$no_dokumen,$kd_skpd,$status){

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
								"total" => str_replace(array(','), array(''), $row->biaya_kerjasama),
								"status" => '',
								"kd_rek" => '',
								"biaya_kerjasama" => str_replace(array(','), array(''), $row->biaya_kerjasama),
								"uraian_kerjasama" => str_replace(array(','), array(''), $row->uraian_kerjasama),
								"ket" => htmlspecialchars($row->uraian_kerjasama, ENT_QUOTES),
								"satuan" => htmlspecialchars($row->satuan, ENT_QUOTES),
								"kd_kegiatan" => htmlspecialchars($row->kd_kegiatan, ENT_QUOTES)
							);
						$sql = $this->db->insert('transaksi.trd_kerjasama', $filter_data);
						}
			}else{
				$del = $this->db->where('no_dokumen',$no_dokumen)
							->where('kd_uskpd',$kd_skpd)
							->delete('transaksi.trd_kerjasama');
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
								"total" => str_replace(array(','), array(''), $row->biaya_kerjasama),
								"status" => '',
								"kd_rek" => '',
								"biaya_kerjasama" => str_replace(array(','), array(''), $row->biaya_kerjasama),
								"uraian_kerjasama" => str_replace(array(','), array(''), $row->uraian_kerjasama),
								"ket" => htmlspecialchars($row->uraian_kerjasama, ENT_QUOTES),
								"satuan" => htmlspecialchars($row->satuan, ENT_QUOTES),
								"kd_kegiatan" => htmlspecialchars($row->kd_kegiatan, ENT_QUOTES)
							);
						$sql = $this->db->insert('transaksi.trd_kerjasama', $filter_data);
						}	
					
					
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
								->delete('transaksi.trh_kerjasama');
								if($sql){
										$sql = $this->db->where('no_dokumen', $kd[$i])
										->where('kd_uskpd',$skpd[$i])
										->delete('transaksi.trd_kerjasama');
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

		$csql = "SELECT SUM(total) AS total from transaksi.trd_kerjasama 
		where no_dokumen = '$nomor' and kd_uskpd = '$skpd'";
        $rs   = $this->db->query($csql)->row() ; 
		
        $sql = "SELECT b.* FROM transaksi.trh_kerjasama a 
				INNER JOIN transaksi.trd_kerjasama b ON a.no_dokumen=b.no_dokumen 
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
                'biaya_kerjasama'=> $resulte['biaya_kerjasama'],           
                'uraian_kerjasama'=> $resulte['uraian_kerjasama'],          
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
				
		if ($kel != '') {
			if($kel=='13'){
			$whr = "LEFT(kd_brg, 2) = '$kel' AND LENGTH(kd_brg)='3' AND kd_brg!='136' AND kd_brg!='137' AND ";
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

		if($tab=='trkib_a' || $tab=='trkib_c' || $tab=='trkib_d'){
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

		$sql ="SELECT a.kd_brg,b.uraian,$satuan,$merek,
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