<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_HibahKeluar extends CI_Model {

	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	
	
	function saveHeader($post){
		$no_dokumen 	= $post['no_dokumen']; 
		$tgl_dokumen 	= $post['tgl_dokumen'];
		$kd_unit 		= $post['kd_unit']; 	
		$kd_skpd 		= $post['kd_skpd']; 	
		$penerima 		= $post['penerima'];	
		$tgl_update 	= $post['tgl_update']; 
		$no_urut 		= $post['no_urut']; 
		$tahun 			= $post['tahun']; 
		$username		= $this->session->userdata['nm_user'];
		$query = "INSERT INTO transaksi.trh_hibah(no_urut,tahun,no_dokumen,tgl_dokumen,pemberi,tujuan,kd_skpd,kd_unit,jenis,last_update,username)
					VALUES('$no_urut','$tahun','$no_dokumen','$tgl_dokumen','','$penerima','$kd_skpd','$kd_unit','2','$tgl_update','$username')";
		$sql = $this->db->query($query);  
		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
	}
	
	
	function updateHeader($post){
		$no_dokumen 	= $post['no_dokumen']; 
		$tgl_dokumen 	= $post['tgl_dokumen'];
		$kd_unit 		= $post['kd_unit']; 	
		$kd_skpd 		= $post['kd_skpd']; 	
		$penerima 		= $post['penerima'];	
		$tgl_update 	= $post['tgl_update']; 
		$no_urut 		= $post['no_urut']; 
		$tahun 			= $post['tahun']; 
		$username		= $this->session->userdata['nm_user'];
		$query = " UPDATE transaksi.trh_hibah SET 
			no_dokumen	= '$no_dokumen',
			tgl_dokumen	= '$tgl_dokumen',
			pemberi     = '',
			tujuan      = '$penerima',
			last_update = '$tgl_update',
			username    = '$username',
			tahun		= '$tahun'
			WHERE no_urut = '$no_urut' AND kd_skpd ='$kd_skpd' AND kd_unit = '$kd_unit' AND jenis = '2'";
			 $sql = $this->db->query($query);  
			try{
			if ($sql) {
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
			
		
		
	}
	
	function saveDetail($post,$no_dokumen,$kd_skpd,$kd_unit,$tahun,$no_urut){
		foreach ($post as $row){
		$kd_brg = htmlspecialchars($row->kd_brg, ENT_QUOTES);
		$no_reg = htmlspecialchars($row->no_reg, ENT_QUOTES);
		$nilai = str_replace(',','', $row->nilai);
		$jns_kib = htmlspecialchars($row->jns_kib, ENT_QUOTES);
		$query = "INSERT INTO transaksi.trd_hibah(no_dokumen,id_reg,kd_brg,nilai,kib,kd_skpd,kd_unit,jenis,no_urut)
					VALUES('$no_dokumen','$no_reg','$kd_brg','$nilai','$jns_kib','$kd_skpd','$kd_unit','2','$no_urut')";
		$sql = $this->db->query($query);  
	}
		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
	
	}
	
	
	function updateDetail($post,$no_dokumen,$kd_skpd,$kd_unit,$tahun,$no_urut){
		$del 	= "DELETE FROM transaksi.trd_hibah WHERE no_urut='$no_urut' AND kd_skpd='$kd_skpd' AND kd_unit='$kd_unit' AND jenis='2'";
		$delete = $this->db->query($del); 
		if($delete){
		foreach ($post as $row){
		$kd_brg = htmlspecialchars($row->kd_brg, ENT_QUOTES);
		$no_reg = htmlspecialchars($row->no_reg, ENT_QUOTES);
		$nilai = str_replace(',','', $row->nilai);
		$jns_kib = htmlspecialchars($row->jns_kib, ENT_QUOTES);
		$query = "INSERT INTO transaksi.trd_hibah(no_dokumen,id_reg,kd_brg,nilai,kib,kd_skpd,kd_unit,jenis,no_urut)
					VALUES('$no_dokumen','$no_reg','$kd_brg','$nilai','$jns_kib','$kd_skpd','$kd_unit','2','$no_urut')";
		$sql = $this->db->query($query);  
			}
		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		 }
		} else{
			return 0;
		}
	 
	}
	
	
	
	function hapus($post){
		$kd 	= explode("#",$post['kode']);
		$skpd 	= explode("#",$post['kd_skpd']);
		$unit 	= explode("#",$post['kd_unit']);
		$urut 	= explode("#",$post['urut']);
		$jml	= count($kd);
		try{
			if($jml>0){
				for($i=0;$i<=$jml;$i++){
						$sql = $this->db->where('no_dokumen', $kd[$i])
								->where('kd_skpd',$skpd[$i])
								->where('kd_unit',$unit[$i])
								->where('no_urut',$urut[$i])
								->where('jenis','2')
								->delete('transaksi.trh_hibah');
								if($sql){
										$sql = $this->db->where('no_dokumen', $kd[$i])
										->where('kd_skpd',$skpd[$i])
										->where('kd_unit',$unit[$i])
										->where('no_urut',$urut[$i])
										->where('jenis','2')
										->delete('transaksi.trd_hibah');
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

	

	public function loadDetail($param){
		$nomor 	= $param['nomor'];
		$skpd 	= $param['skpd'];
		$unit 	= $param['unit'];
		$urut 	= $param['urut'];
		$csql = "SELECT SUM(nilai) AS total from transaksi.trd_hibah 
		where no_dokumen = '$nomor' AND no_urut='$urut' and kd_skpd = '$skpd' AND kd_unit = '$unit' AND jenis='2'";
        $rs   = $this->db->query($csql)->row() ; 
        $sql = "SELECT a.*, b.uraian as nm_barang FROM transaksi.trd_hibah a LEFT JOIN public.mbarang b 
				ON a.kd_brg=b.kd_brg WHERE a.no_dokumen = '$nomor' AND a.kd_skpd = '$skpd' AND a.kd_unit='$unit' AND a.no_urut='$urut' AND a.jenis='2' ";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(                                
                'no_dokumen'    => $resulte['no_dokumen'],                      
                'kd_brg'        => $resulte['kd_brg'],                     
                'nm_brg'        => $resulte['nm_barang'],
                'no_reg'        => $resulte['id_reg'],
                'nilai'         => $resulte['nilai'],
                'jns_kib'       => $resulte['kib'],
                'total'         => $rs->total
            );
            $ii++;
        }           
        return $result;
        $query1->free_result();
        $rs->free_result();
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
	
	public function getUnit($lccq,$skpd){
		$sql	= "SELECT kd_unit,nm_unit FROM public.munit WHERE kd_skpd='$skpd' order by kd_unit";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_unit' => $key['kd_unit'],  
                'nm_unit' => $key['nm_unit'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getDokumen($data){
		$lccq 	= $data['lccq'];
		$kib 	= trim($data['kib']);
		$tgl 	= $data['tgl'];
		$skpd 	= $data['skpd'];
		$unit 	= $data['unit'];
		$uskpd	= "";
		if($unit!=''){
			$uskpd = "AND a.kd_unit='$unit'";
		}
		
		if($kib==1){
			$from = "trkib_a" ;
		}
		if($kib==2){
			$from = "trkib_b" ;
		}
		if($kib==3){
			$from = "trkib_c" ;
		}
		if($kib==4){
			$from = "trkib_d" ;
		}
		if($kib==5){
			$from = "trkib_e" ;
		}
		if($kib==6){
			$from = "trkib_f" ;
		}
		if($kib==7){
			$from = "trkib_g" ;
		}
		
		$sql	= "select no_reg,a.kd_brg,nilai,keterangan,b.uraian as nm_brg 
				FROM transaksi.$from a 
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg WHERE a.tgl_reg <='$tgl'
				AND a.kd_skpd = '$skpd' $uskpd
				AND CONCAT(a.no_reg,a.kd_brg,a.kd_skpd,a.kd_unit) NOT IN (SELECT CONCAT(no_reg,kd_brg,kd_skpd,kd_unit) FROM transaksi.trd_hibah WHERE jenis='2')";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'	 		=> $li,
				'no_reg' 		=> $key['no_reg'],  
                'kd_brg' 		=> $key['kd_brg'],
                'nm_brg' 		=> $key['nm_brg'],
                'nilai'  		=> $key['nilai'],
                'keterangan' 	=> $key['keterangan'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getKelompok()
	{
		$data = array();
		$sql = $this->db->select('kd_brg, uraian')
						->from('mbarang')
						->where('LENGTH(kd_brg)=','2')
						->get();			
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
			$whr = "LEFT(kd_brg, 2) = '$kel' AND LENGTH(kd_brg)='3' AND ";
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
                'nm_brg' 	=> $key['uraian']/* ,
                'kd_rek5'	=> $key['kd_rek5'],
                'nm_rek5'	=> $key['nm_rek5'] */  
			);
			$li++;
		}

		return $res;
		$query->free_result();
	}
	
	public function max_number($tahun,$skpd){
		$query1 = $this->db->query("SELECT COALESCE(MAX(CAST(no_urut as int)),0) as nomor FROM transaksi.trh_hibah WHERE kd_skpd='$skpd' AND tahun='$tahun' AND jenis='2'");  
        $nomor  = $query1->row('nomor');
		$result	= sprintf("%05d",intval($nomor)+1);
        return $result;
        $query1->free_result();
	}
}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */