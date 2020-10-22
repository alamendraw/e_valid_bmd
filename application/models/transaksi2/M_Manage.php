<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Manage extends CI_Model {
	 public function loadHeader($key1,$key2,$key3,$otori,$skpd) { 
		 
		$xkey1 ='';
		$xkey2 ='';
		$xkey3 ='';
	 
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = '';
		$limit = "ORDER BY id_lokasi LIMIT $rows OFFSET $offset";

		if($key1!=''){
			$xkey1 = "and (upper(b.uraian) like upper('%$key1%') or upper(a.detail_brg) like upper('%$key1%'))"; 
		}
		
		if($key2!=''){
			$xkey2 = "and (upper(a.tahun) like upper('%$key2%'))";	 
		}
		
		if($key3!=''){ //Sumber dana / merek / no polisi / kondisi / keterangan / nilai
			$xkey3 = "and (upper(g.cara_peroleh) like upper('%$key3%') or upper(a.merek) like upper('%$key3%') or upper(a.no_polisi) like upper('%$key3%') or upper(a.kondisi) like upper('%$key3%') or upper(a.keterangan) like upper('%$key3%'))";	 
		}
		if($key1!='' || $key2!='' || $key3!=''){
			$where = "where $kond $xkey1 $xkey2 $xkey3";	
		}
		
		
		$sql = "SELECT count(*) as tot FROM transaksi.trkib_b $where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT id_lokasi,no_reg,nm_brg,tahun,nilai,keterangan,kd_skpd,kd_unit FROM transaksi.trkib_b
				$where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte){ 
        	 
            $row[] = array(
                'id' 				=> $ii,        
                'no_reg' 			=> $resulte['no_reg'], 
                'nm_brg' 			=> $resulte['nm_brg'], 
                'tahun' 			=> $resulte['tahun'], 
                'nilai' 			=> number_format($resulte['nilai'],2), 
                'keterangan' 		=> $resulte['keterangan'], 
                'kd_skpd' 			=> $resulte['kd_skpd'], 
                'kd_unit' 			=> $resulte['kd_unit'], 
            );
            $ii++;
        }
	  	$result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result; 
	}
}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */