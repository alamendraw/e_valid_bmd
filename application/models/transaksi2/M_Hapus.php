<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Hapus extends CI_Model {
	function tanggal_balik($tgl){
		$tanggal  = explode('-',$tgl); 
		$hari  =  $tanggal[0];
		$bulan  = $tanggal[1];
		$tahun  =  $tanggal[2];
		return  $tahun.'-'.$bulan.'-'.$hari;
	}

	function simpan_header($post,$status,$no_dok,$skpd){
		$no_dokumen	= $this->input->post('no_dok');
		$tgl_dokumen= $this->tanggal_balik($this->input->post('tgl_dok'));
		$kd_skpd	= $this->input->post('kd_skpd');
		$kd_unit	= $this->input->post('kd_unit');
		$nm_uskpd	= $this->getNmSkpd($kd_skpd);
		 
		$tabel  	= $this->input->post('tabel');
		$tahun  	= $this->input->post('tahun'); 
		$total  	= $this->input->post('total');
		$status  	= $this->input->post('status');
		$nm_user	= $this->session->userdata('nm_user');
		$cad = '02.2';

		try {
			if($status!='detail'){				
				$cquer = "SELECT count(*) as zx FROM transaksi.trh_hapus
                           WHERE no_dokumen = '$no_dokumen' and kd_unit='$kd_unit'";
				$ck = $this->db->query($cquer)->row('zx');	
				 
				if($ck<1) {
					$query = "insert into transaksi.trh_hapus (no_dokumen,tgl_dokumen,kd_unit,kd_skpd,nm_skpd,tahun,username,tgl_update,total,cad,xkd,tabel) values
					('$no_dokumen','$tgl_dokumen','$kd_unit','$kd_skpd','$nm_uskpd','$tahun','$nm_user',CURRENT_TIMESTAMP,'$total','$cad','0','$tabel')";
					// print_r($query); exit();
					$proses = $this->db->query($query);
						return 1;
				} else {
						return 0;
				}
			}else{
				$del = $this->db->where('no_dokumen',$post['no_dokumen'])
							->where('kd_skpd',$post['kd_skpd'])
							->delete('transaksi.trh_hapus');
				if($del){
				$sql = $this->db->insert('transaksi.trh_hapus', $post);
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
	
	function simpan_detail($post,$no_dokumen,$kd_skpd,$status){ 
		$kd_unit	= $this->input->post('kd_unit');
		$urut = 1;
		try {
			if($status!='detail'){						
					foreach($post as $row) {							
							$filter_data = array(
								"no_dokumen" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"kd_brg" => htmlspecialchars($row->kd_brg, ENT_QUOTES),
								"id_barang" => htmlspecialchars($row->id_barang, ENT_QUOTES),
								"kd_unit" => $kd_unit,
								"kd_skpd" => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"nm_brg" => htmlspecialchars($row->nm_brg, ENT_QUOTES),
								"merek" => '',
								"jumlah" => htmlspecialchars($row->jumlah, ENT_QUOTES),
								"harga" => str_replace(array(','), array(''), $row->harga),
								"total" => str_replace(array(','), array(''), $row->total),
								"cad" => '02.1',
								"ket" => htmlspecialchars($row->ket, ENT_QUOTES),
								"satuan" => htmlspecialchars($row->satuan, ENT_QUOTES),
								"no_urut" => $urut
							);
						$sql = $this->db->insert('transaksi.trd_hapus', $filter_data);
						$urut++;
						}
			}else{
				$del = $this->db->where('no_dokumen',$no_dokumen)
							->where('kd_skpd',$kd_skpd)
							->delete('transaksi.trd_hapus');
				if($del){
						foreach($post as $row) {							
							$filter_data = array(
								"no_dokumen" => htmlspecialchars($no_dokumen, ENT_QUOTES),
								"kd_brg" => htmlspecialchars($row->kd_brg, ENT_QUOTES),
								"id_barang" => htmlspecialchars($row->id_barang, ENT_QUOTES),
								"kd_unit" => '',
								"kd_skpd" => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"nm_brg" => htmlspecialchars($row->nm_brg, ENT_QUOTES),
								"merek" => '',
								"jumlah" => htmlspecialchars($row->jumlah, ENT_QUOTES),
								"harga" => str_replace(array(','), array(''), $row->harga),
								"total" => str_replace(array(','), array(''), $row->total),
								"cad" => '0',
								"ket" => htmlspecialchars($row->ket, ENT_QUOTES),
								"satuan" => htmlspecialchars($row->satuan, ENT_QUOTES),
								"no_urut" => ''
							);
						$sql = $this->db->insert('transaksi.trd_hapus', $filter_data);
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

	function getNmSkpd($kd_skpd){
		$proses = $this->db->query("SELECT nm_skpd from mskpd where kd_skpd='$kd_skpd'")->row('nm_skpd');
		return $proses;
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
								->where('kd_skpd',$skpd[$i])
								->delete('transaksi.trh_hapus');
								if($sql){
										$sql = $this->db->where('no_dokumen', $kd[$i])
										->where('kd_skpd',$skpd[$i])
										->delete('transaksi.trd_hapus');
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

		$csql = "SELECT SUM(total) AS total from transaksi.trd_hapus 
		where no_dokumen = '$nomor' and kd_skpd = '$skpd'";
        $rs   = $this->db->query($csql)->row() ; 
		
        $sql = "SELECT b.* FROM transaksi.trh_hapus a 
				INNER JOIN transaksi.trd_hapus b ON a.no_dokumen=b.no_dokumen 
				AND a.kd_skpd=b.kd_skpd AND a.kd_unit=b.kd_unit
				WHERE a.no_dokumen = '$nomor' AND a.kd_skpd = '$skpd'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(                              
                'no_dokumen'    => $resulte['no_dokumen'],                      
                'kd_brg'        => $resulte['kd_brg'],      
                'id_barang'     => $resulte['id_barang'],  
                'nm_brg'        => $resulte['nm_brg'],
                'merek'         => $resulte['merek'],
                'jumlah'        => $resulte['jumlah'],
                'harga'         => $resulte['harga'],
                'total'         => $resulte['total'],
                'sum'         	=> $rs->total,                
                'ket'           => $resulte['ket'],                        
                'satuan'        => $resulte['satuan'],                    
                'no_urut'       => $resulte['no_urut']			
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
		
        $lccr 	= $this->input->post('q');
		$sql 	= $this->db->query("select * from mskpd where kd_skpd like '%$lccr%' $and");						
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

	public function getUnit() { 
		$skpd 	= $this->input->post('kd');
		  
		$sql 	= $this->db->query("select * from munit where kd_skpd='$skpd'");						
		$res 	= array();
		$li 	= 0;
		foreach ($sql->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_unit'	=> $key['kd_unit'],
				'nm_unit'	=> $key['nm_unit']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}

	public function getSkpd_tuju()
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
		
        $lccr 	= $this->input->post('q');
		$sql 	= $this->db->select('kd_skpd,nm_skpd')
								->from('mskpd')
								->where("kd_skpd like '%$lccr%'")
								->get();		
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
		$sql = $this->db->query("SELECT kd_brg,uraian FROM mbarang WHERE length(kd_brg)='3' and kd_brg!='1.1'");			
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
			if($kel=='1.3'){
			$whr = "LEFT(kd_brg, 3) = '$kel' AND LENGTH(kd_brg)='5' AND kd_brg!='1.3.7' AND ";
			}else{
			$whr = "LEFT(kd_brg, 3) = '$kel' AND kd_brg='1.5.3' AND ";
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
			switch ($key['kd_brg']) {
				case '1.3.1':
					$tabel = 'trkib_a';
					break;
				 
				case '1.3.2':
					$tabel = 'trkib_b';
					break;
				
				case '1.3.3':
					$tabel = 'trkib_c';
					break;
				
				case '1.3.4':
					$tabel = 'trkib_d';
					break;
				
				case '1.3.5':
					$tabel = 'trkib_e';
					break;
				  
				default:
					$tabel = 'trkib_f';
					break;
			}
			$data[] = array(
				'id'		=> $li,
				'jenis'		=> $key['kd_brg'],
				'nm_jenis'	=> $key['uraian'],
				'tabel'		=> $tabel
			);
			$li++;
		}
		return $data;
		$sql->free_result();
	}

	public function getBarang($param)
	{
		$jen  	= $param['kd'];
		$unit  	= $param['ut'];
		$lccq 	= $param['lccq'];
		$jenis = array('1.3.1','1.3.2','1.3.3','1.3.4','1.3.5','1.3.6');
		switch($jen){
			case '1.3.1':
				$tabel = "transaksi.trkib_a";
			break;
			case '1.3.2':
				$tabel = "transaksi.trkib_b";
			break;
			case '1.3.3':
				$tabel = "transaksi.trkib_c";
			break;
			case '1.3.4':
				$tabel = "transaksi.trkib_d";
			break;
			case '1.3.5':
				$tabel = "transaksi.trkib_e";
			break;
			default:
				$tabel = "transaksi.trkib_f";
		}
		
		if ($jen != '') {
			$whr = "a.kd_unit='$unit' AND LEFT(a.kd_brg, 5) = '$jen' AND LENGTH(a.kd_brg)='18' AND ";
		} else {
			$whr = '';
		}

		$sql ="SELECT a.no_reg,a.id_barang,a.kd_brg,a.nilai,a.keterangan,b.uraian,'1' as jml FROM $tabel a
			   left join mbarang b on a.kd_brg=b.kd_brg	
		WHERE a.id_lokasi not in (SELECT id_barang from transaksi.trd_hapus where kd_unit='$unit') and $whr (upper(a.kd_brg) like upper('%$lccq%') 
		or upper(b.uraian) like upper('%$lccq%')) 
		ORDER BY a.kd_brg LIMIT 100 OFFSET 1";		
		$query = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'id_barang'	=> $key['id_barang'], 
				'kd_brg' 	=> $key['kd_brg'],  
                'no_reg' 	=> $key['no_reg'],  
                'nilai' 	=> $key['nilai'],  
                'ket'		=> $key['keterangan'],  
                'nm_brg' 	=> $key['uraian'],  
                'jml' 		=> $key['jml']  
			);
			$li++;
		}

		return $res;
		$query->free_result();
	}

	public function max_number($param){
		$skpd  = $param['skpd'];
		$proses = $this->db->query("SELECT MAX(left(no_dokumen,6)) AS nomor FROM transaksi.trh_hapus where kd_skpd='$skpd'")->row('nomor');
		 
		if($proses=='null'){
			$hasil = '0000001';
		}else{
			$hasil	= sprintf("%06d",intval($proses)+1);
		}
        return $hasil;
        $proses->free_result();
	}
	
	 
}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */