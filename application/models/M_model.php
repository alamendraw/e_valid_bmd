<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}
	function cek_data($table,$where){		
		$query =  $this->db->get_where($table,$where);
		$query = $query->result_array();
		return $query;
	}
	function hapus($tabel,$field,$value){
		$del_item = $this->db->query("delete from $tabel where $field='$value'");
		return '1';
	}
	function hapus_image($tabel,$field,$value){
		$query = $this->db->query("SELECT $field FROM $tabel where id_barang ='$value'")->row();
		for ($i=''; $i <= 4; $i++) { 
			if (file_exists(FCPATH.'assets/image_file'.$i.'/'.$query->$field)) {
				$path_file = './assets/image_file'.$i.'/';
	    		unlink($path_file.$query->$field);
			}
		}
		$del_item = $this->db->query("UPDATE $tabel set $field = '' where id_barang='$value'");
		return '1';
	}
	function get_datatables($query, $column_order, $column_search, $order) {
		$this->_get_datatables_query($query, $column_order, $column_search, $order);
		if($_POST['length'] != -1)
			$clone = clone $query;
		$this->db->limit($_POST['length'], $_POST['start']);
		$data['result'] = $query->get()->result();
		$data['count_filtered'] = $clone->get()->num_rows();
		return $data;
	}
	function _get_datatables_query($query, $column_order, $column_search, $order) {
		$i = 0;

		foreach ($column_search as $item)
		{
			if(isset($_POST['search']['value'])) {

				if ($i===0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if(isset($_POST['order'])) {
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($order)) {
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function count_all($query){
		return $query->count_all_results();
	}
	function get_jns_sensus(){
		$hasil=$this->db->query("SELECT id,nm_menu from m_menu where id IN('3','4','5','6','7','8')");
		return $hasil->result();
	}
	function get_ttd($key,$kd_skpd,$unit_skpd){
		if($unit_skpd<>''){
			$where = "AND unit='$unit_skpd'";
		}else{
			$where = "";
		}
		$hasil=$this->db->query("SELECT * from ttd where ckey='$key' AND skpd='$kd_skpd' $where");
		return $hasil->result();
	}
	function get_ttd_skpd($key,$kd_skpd){
		$hasil=$this->db->query("SELECT * from ttd where ckey='$key' AND skpd='$kd_skpd'");
		return $hasil->result();
	}
	function _mpdf($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi) {
		ini_set('memory_limit', -1);
		ini_set('max_execution_time', -1);
        $this->load->library('mpdf');
        $this->mpdf->defaultheaderfontsize = 6;
        $this->mpdf->defaultheaderfontstyle = BI;
        $this->mpdf->defaultheaderline = 1;
        $this->mpdf->defaultfooterfontsize = 6;
        $this->mpdf->defaultfooterfontstyle = B;
        $this->mpdf->defaultfooterline = 0; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        //$this->mpdf->SetHeader('Page {PAGENO} of {nb}');
        $this->mpdf->SetFooter('Page {PAGENO} of {nb}');
        $this->mpdf->AddPage($orientasi,'','','','',$lmargin,$rmargin,$tmargin,$bmargin,$hmargin,$fmargin,'','','','','','','','','','');/*(orientasi,'',EX.$p( Page $p of 12),'','','lmargin','rmargin','tmargin',bmargin,tfoot,bfooter)*/
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }
    function _mpdf_label($orientasi,$lmargin,$rmargin,$tmargin,$bmargin,$tfoot,$bfoot,$judul,$isi,$size) {
		ini_set('memory_limit', -1);
		ini_set('max_execution_time', -1);
        $this->load->library('mpdf');
        $this->mpdf->defaultheaderfontsize = 6;
        $this->mpdf->defaultheaderfontstyle = BI;
        $this->mpdf->defaultheaderline = 1;
        $this->mpdf->defaultfooterfontsize = 6;
        $this->mpdf->defaultfooterfontstyle = B;
        $this->mpdf->defaultfooterline = 0; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        //$this->mpdf->SetHeader('Page {PAGENO} of {nb}');
        $this->mpdf->SetFooter('Page {PAGENO} of {nb}');
        $this->mpdf->AddPage($orientasi,'','','','',$lmargin,$rmargin,$tmargin,$bmargin,$hmargin,$fmargin,'','','','','','','','','',$size);/*(orientasi,'',EX.$p( Page $p of 12),'','','lmargin','rmargin','tmargin',bmargin,tfoot,bfooter)*/
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
               
    }
}
?>