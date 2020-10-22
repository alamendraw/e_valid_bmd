<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dok extends CI_Model {

	public function loadHeader($key) {
			$result = array();
			$row    = array();
			$page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
			$rows   = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
			$offset = ($page-1)*$rows;
			
			$oto = $this->session->userdata('oto');
			if ($oto=='01')// as ADMIN
			{
				if($key !=''){
				$cari  = "upper(no_dokumen) like upper('%$key%')";	
				$limit = "";	
				$where = " where $cari $limit ";
				}else{
				$limit  = "ORDER BY tgl_update desc LIMIT $rows OFFSET $offset";
				$where = "";
				}	
			}
			else
			{	
				$skpd = $this->session->userdata('kd_skpd');
				$kdskpd = " kd_uskpd='$skpd' ";

				if($key !=''){
				$cari  = "upper(no_dokumen) like upper('%$key%')";	
				$limit = "";	
				$where = " where $cari $limit and $kdskpd";
				}else{
				$limit  = "ORDER BY tgl_update desc LIMIT $rows OFFSET $offset";
				$where = "where $kdskpd";
				}

			}

		
		
		$sql = "SELECT count(*) as tot from transaksi.trh_isianbrg $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT no_dokumen,kd_comp,tgl_dokumen,
				kd_milik,
				nilai_kontrak,kd_wilayah,kd_skpd,
				kd_skpd,kd_unit,s_dana,tahun,s_ang,kd_cr_oleh,b_dasar,b_nomor,b_tanggal,h_total,id_lock
				from transaksi.trh_isianbrg
				$where $limit ";
			// print_r($sql); exit();
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte) { 
        	if($resulte['kd_comp']*1==0){ 
        		$nmComp = $resulte['kd_comp'];
        	}else{ 
        		$nmComp = $this->getnmcomp($resulte['kd_comp']);
        	}
            $row[] = array(
				'id'            => $ii,        
				'no_dokumen'    => $resulte['no_dokumen'],
				'kd_comp'       => $resulte['kd_comp'], 
				'nm_comp'       => $nmComp,
				'tgl_dokumen'   => $this->tanggal_ind($resulte['tgl_dokumen']),
				'kd_milik'      => $resulte['kd_milik'],
				'nm_milik'      => $this->getnmmilik($resulte['kd_milik']),
				'nilai_kontrak' => $resulte['nilai_kontrak'],
				'kd_wilayah'    => $resulte['kd_wilayah'],
				'kd_skpd'      => $resulte['kd_skpd'],
				'kd_unit'       => $resulte['kd_unit'],
				's_dana'        => $resulte['s_dana'],
				'tahun'         => $resulte['tahun'],
				's_ang'         => $resulte['s_ang'],
				'kd_cr_oleh'    => $resulte['kd_cr_oleh'],
				'b_dasar'       => $resulte['b_dasar'],
				'b_nomor'       => $resulte['b_nomor'],
				'b_tanggal'     => $this->tanggal_ind($resulte['b_tanggal']),
				'h_total'       => $resulte['h_total'],
				'id_lock'       => $resulte['id_lock']

            );
            $ii++;
        }
    
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result;
	}

	// ,(select nama from ms_multi where kelompok=1 AND ms_multi.kode=transaksi.trh_isianbrg.kd_milik)as nm_milik

	function getnmcomp($id){
		$proses = $this->db->query("select nm_comp from mcompany where kd_comp='$id'")->row('nm_comp');
		return $proses;
	}

	function getnmmilik($id){ 
		$pnj = substr($id,0,2)+1; 
		if($pnj==1){
			$proses = $id;
		}else{
			$sql = "select nm_milik from mmilik where kd_milik='$id'"; 
			$proses = $this->db->query($sql)->row('nm_milik');
		}
		
		return $proses;
	}

	public function get_comp() {
		$lccr  = $this->input->post('q');
		$sql   = "SELECT kd_comp,nm_comp FROM public.mcompany where (upper(nm_comp) like upper('%$lccr%') or upper(kd_comp) like upper('%$lccr%')) order by kd_comp";
		$query = $this->db->query($sql);
		$res   = array();
		$li    = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_comp'	=> $key['kd_comp'],
				'nm_comp'	=> $key['nm_comp']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}

	public function getMilik($lccq){
		$sql	= "SELECT kd_milik kode, nm_milik nama FROM public.mmilik where upper(nm_milik) like upper('%$lccq%') order by kd_milik";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_milik' => $key['kode'],  
                'nm_milik' => $key['nama'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getdana($lccq){
		$sql	= "SELECT kode, nama FROM public.ms_multi where kelompok=2 and upper(nama) like upper('%$lccq%') order by kode";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_dana' => $key['kode'],  
                'nm_dana' => $key['nama'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getbukti($lccq){
		$sql	= "SELECT kode, nama FROM public.ms_multi where kelompok=3 and upper(nama) like upper('%$lccq%') order by kode";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_bukti' => $key['kode'],  
                'nm_bukti' => $key['nama'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getOleh($lccq){
		$sql	= "SELECT kode, nama FROM public.ms_multi where kelompok=4 and upper(nama) like upper('%$lccq%') order by kode";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kd_cr_oleh' 	=> $key['kode'],  
                'cara_peroleh' 	=> $key['nama'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getDasar($lccq){
		$sql	= "SELECT kode, nama FROM public.ms_multi where kelompok=5 and upper(nama) like upper('%$lccq%') order by kode";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'dasar_peroleh' => $key['nama'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}


	public function getWilayah($lccq){
		$sql	= "SELECT rtrim(kd_wilayah)as kd_wilayah,nm_wilayah FROM mwilayah where upper(kd_wilayah) like upper('%$lccq%') order by kd_wilayah";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_wilayah' => $key['kd_wilayah'],  
                'nm_wilayah' => $key['nm_wilayah']
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	function getNmRekanan($kode){ 
		// $query = "SELECT nama from public.mrekanan where kode='$id' limit 1";
		// // print_r($query); exit();
		// $proses = $this->db->query($query)->row('nama');
		// return $proses;
		$sql = "SELECT nama from mrekanan where kode='$kode' limit 1"; 
		$proses = $this->db->query($sql)->row('nama');
		print_r($proses);
	}
  
	public function getKontrak() {
		$lccq = $this->input->post('q');
		$skpd = $_REQUEST['skpd'];
		

		if ($lccq==''){
			$like = '';
		}else{
			$like = "and  (no_bast like '%$lccq%' or nm_kegiatan like '%$lccq%')";
		}

		$sql   = "SELECT no_bast as no_kontrak,tgl_bast as tgl_kontrak,d.nama as rekanan,nm_kegiatan,sum(a.total)as total from transaksi.plh_form_isian a inner join transaksi.pld_form_isian b 
			on a.no_transaksi=b.no_transaksi and a.kd_unit=b.kd_unit 
			inner join transaksi.pl_lengkap c on b.no_transaksi=c.no_transaksi and b.kd_unit=c.kd_skpd
			left join mrekanan d on a.rekanan::text=d.kode::text
			where a.kd_unit='$skpd' and no_bast!='' $like group by no_bast,tgl_bast,nama,nm_kegiatan limit 10";
			// print_r($sql);exit();
		$query = $this->db->query($sql);
		$res   = array();
		$li    = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li, 
				'no_kontrak' 	=> $key['no_kontrak'],
				'tgl_kontrak' 	=> $this->tanggal_ind($key['tgl_kontrak']),
				'rekanan' 		=> $key['rekanan'],
				'nm_kegiatan' 	=> $key['nm_kegiatan'],
				'total' 		=> number_format($key['total'],2) 
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}

	public function getSp2d() {
		$lccq = $this->input->post('q');
		$skpd = $this->session->userdata('kd_skpd');
		$kontrak = $this->input->post('kontrak');
		if ($lccq==''){
			$like = '';
		}else{
			$like = "and  upper(no_kontrak) like upper('%$lccq%') or upper(no_sp2d) like upper('%$lccq%')";
		}

		$sql   = "SELECT no_kontrak,tgl_kontrak,nilai_kontrak,no_sp2d,tgl_sp2d,nilai_sp2d,no_spm,kd_kegiatan,kd_rek5,ppn,kd_skpd 
				from transaksi.tr_kontrak where kd_skpd='$skpd' and no_kontrak='$kontrak' $like order by kd_skpd";
		$query = $this->db->query($sql);
		$res   = array();
		$li    = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li, 
				'no_kontrak'	=> $key['no_kontrak'],
				'tgl_kontrak'	=> $this->tanggal_ind($key['tgl_kontrak']),
				'nilai_kontrak'	=> number_format($key['nilai_kontrak'],2),
				'no_sp2d'		=> $key['no_sp2d'],
				'tgl_sp2d'		=> $this->tanggal_ind($key['tgl_sp2d']),
				'nilai_sp2d'	=> number_format($key['nilai_sp2d'],2),
				'no_spm'		=> $key['no_spm'],
				'kd_kegiatan'	=> $key['kd_kegiatan'],
				'kd_rek5'		=> $key['kd_rek5'],
				'ppn'			=> number_format($key['ppn'],2),
				'kd_skpd'		=> $key['kd_skpd']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}

	public function getSkpd() {
		$lccq = $this->input->post('q');
		$skpd = $this->session->userdata('kd_skpd');
		

		if ($lccq==''){
			$like = '';
		}else{
			$like = "and  upper(nm_skpd) like upper('%$lccq%') or upper(kd_skpd) like upper('%$lccq%')";
		}

		// $sql   = "SELECT kd_skpd,nm_skpd FROM public.mskpd where kd_skpd='$skpd' $like order by kd_skpd";
		$sql   = "SELECT kd_skpd,nm_skpd FROM public.mskpd where 1=1 $like order by kd_skpd";
		$query = $this->db->query($sql);
		$res   = array();
		$li    = 0;
		foreach ($query->result_array() as $key) {
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

	public function getUnit($lccq,$skpd,$unit){
		$sql	= "SELECT kd_unit,nm_unit FROM public.munit WHERE (kd_skpd='$skpd' or kd_unit='$unit' ) group by kd_unit,nm_unit order by kd_unit";
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

	

	

	public function getKegiatan($param)
	{
		$lccq  = $this->input->post('q');
		$sql   = "SELECT kd_kegiatan,nm_kegiatan FROM public.mkegiatan where kd_skpd='$param' and (upper(nm_kegiatan) like upper('%$lccq%') or upper(kd_kegiatan) like upper('%$lccq%')) order by kd_skpd";
		$query = $this->db->query($sql);
		$res 		= array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kd_kegiatan'	=> $key['kd_kegiatan'],
				'nm_kegiatan'	=> $key['nm_kegiatan']
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getrekening()
	{
		$lccq  = $this->input->post('q');
		$sql   = "SELECT kd_rek13,nm_rek13 from public.ms_rek13 where rek1='5' and rek2='2' and level='5' 
					and (upper(kd_rek13) like upper('%$lccq%') or upper(nm_rek13) like upper('%$lccq%')) order by kd_rek13";
		$query = $this->db->query($sql);
		$res 		= array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'       => $li,
				'kd_rek13' => $key['kd_rek13'],
				'nm_rek13' => $key['nm_rek13']
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getKelompok()
	{
		$lccq = $this->input->post('q');		
		//print_r($lccq);

		if ($lccq==''){
			$like = '';
		}else{
			$like = "and  upper(kd_brg) like upper('%$lccq') ";
		}

		$data = array();
		$sql = $this->db->query("SELECT kd_brg,uraian FROM mbarang WHERE LENGTH(kd_brg)='3' $like ");			
		foreach ($sql->result_array() as $key) {
			$data[] = array(
				'kelompok'		=> $key['kd_brg'],
				'nm_kelompok'	=> $key['uraian']
			);
		}
		return $data;
		$sql->free_result();
	}

	public function getJenis($param) { 
		$lccq 	= $param['lccq'];
		  
		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE length(kd_brg)='5' AND (upper(kd_brg) like upper('%$lccq%') 
		or upper(uraian) like upper('%$lccq%')) order by kd_brg";
		// print_r($sql); exit();
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

	public function getKdbarangEdit($param)
	{
		$kdBarang = $param['kdBarang'];
		$lccq     = $param['lccq'];
				
		$sql ="SELECT kd_brg as kode,uraian as nama from mbarang where kd_brg=left('$kdBarang',2)
				union ALL
				select kd_brg as kode,uraian as nama from mbarang where kd_brg=left('$kdBarang',3)
				union all
				select kd_brg as kode,uraian as nama from mbarang where kd_brg='$kdBarang' ";

		$query = $this->db->query($sql);
		
		$data = array();
		$li = 0;		
		foreach ($query->result_array() as $key) {
			$data[] = array(
				'id'   => $li,
				'kode' => $key['kode'],
				'nama' => $key['nama']
			);
			$li++;
		}
		return $data;
		$sql->free_result();
	}

	function loadBarang($kod,$key) {  
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
		
		$sql = "SELECT count(*) as tot FROM public.mbarang 
				WHERE length(kd_brg)='18' and left(kd_brg,5)='$kod'
				$where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM public.mbarang 
				WHERE length(kd_brg)='18' and left(kd_brg,5)='$kod'
				$where $limit";
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
        return $result;
	 
        
	}
		
		
		
		
 


	public function getBarangAfDel($param)
	{
		$jen   = $param['kd'];
		$lccq  = $param['lccq'];
		$skpd  = $param['skpd'];
		$kdbrg = $param['kdbrg'];


		$sql = "SELECT no_dokumen,kd_brg,nm_brg,merek,jumlah,harga,ket,satuan,total from transaksi.trd_planbrg where kd_uskpd='$skpd' and left(kd_brg,3)='$jen' and kd_brg not in (select kd_brg from transaksi.trd_isianbrg where kd_uskpd='$skpd')
				union ALL
				SELECT no_dokumen,kd_brg,nm_brg,merek,jumlah,harga,ket,satuan,total from transaksi.trd_planbrg where 
				kd_uskpd='$skpd' and kd_brg in ('$kdbrg')";
		$query = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'         => $li,
				'no_dokumen' => $key['no_dokumen'],  
				'kd_brg'     => $key['kd_brg'],
				'nm_brg'     => $key['nm_brg'],
				'merek'      => $key['merek'],
				'jumlah'     => $key['jumlah'],
				'harga'      => $key['harga'],
				'ket'        => $key['ket'],
				'satuan'     => $key['satuan'],
				'total'      => $key['total']
			);
			$li++;
		}

		return $res;
		$query->free_result();
	}

	public function getSatuan()
	{
		
		$lccq = $this->input->post('q');

		$sql	= "SELECT kd_satuan, nm_satuan FROM msatuan where upper(kd_satuan) like upper('%$lccq%') or upper(nm_satuan) like upper('%$lccq%')";
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

	public function max_number()
	{
		
		$skpd = $this->session->userdata('kd_skpd');

		$query1 = $this->db->query("SELECT count(id_lock)+1 as kode,(select COALESCE(max(id_lock),0)+1 as id_lock from transaksi.trh_isianbrg ) from transaksi.trh_isianbrg where kd_uskpd='$skpd' ");  
        $result = array();
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(      
                'no_urut' => sprintf("%05d",intval($resulte['kode'])),
                'id_lock' => $resulte['id_lock']
            );
        }
        return $result;
        $query1->free_result();
	}


	function saveData($id_lock){
		$status 		= $this->input->post('status');
		$skpd 			= $this->input->post('skpd');
		$unit 			= $this->input->post('unit');
		$kontrak 		= $this->input->post('kontrak');
		$tgl_kontrak 	= $this->tanggal_balik($this->input->post('tgl_kontrak'));
		$nil_kontrak 	= $this->input->post('nil_kontrak');
		$rekanan 		= $this->input->post('rekanan');
		$milik 			= $this->input->post('milik');
		$wilayah 		= $this->input->post('wilayah');
		$peroleh 		= $this->input->post('peroleh');
		$s_ang 			= $this->input->post('s_ang');
		$s_dana 		= $this->input->post('s_dana');
		$dasar 			= $this->input->post('dasar');
		$nomor 			= $this->input->post('nomor');
		$ztotal 		= $this->input->post('ztotal');
		$tgl_b 			= $this->tanggal_balik($this->input->post('tgl_b'));
		$tahun 			= $this->input->post('tahun'); 
		$user          = $this->session->userdata('nm_user');
		$tglupdate     = date('Y-m-d H:i:s');

		if($status!='detail'){
			$sql = "insert into transaksi.trh_isianbrg (no_dokumen,kd_comp,tgl_dokumen,kd_milik,kd_wilayah,kd_unit,kd_skpd,s_dana,s_ang,b_dasar,b_nomor,tahun,b_tanggal,nilai_kontrak,username,tgl_update,kd_cr_oleh,h_total,id_lock) values 
			('$kontrak','$rekanan','$tgl_kontrak','$milik','$wilayah','$unit','$skpd','$s_dana','$s_ang','$dasar','$nomor','$tahun','$tgl_b','$nil_kontrak','$user','$tglupdate','$peroleh','$ztotal','$id_lock')";
		 	// print_r($sql); exit();
			$proses = $this->db->query($sql); 
			return 1;
		}else{
			$sql ="UPDATE transaksi.trh_isianbrg SET
					no_dokumen='$kontrak', kd_comp='$rekanan', tgl_dokumen='$tgl_kontrak', kd_milik='$milik', kd_wilayah='$wilayah', kd_unit='$unit' , s_dana='$s_dana', s_ang='$s_ang', b_dasar='$dasar', b_nomor='$nomor', tahun='$tahun', b_tanggal='$tgl_b', nilai_kontrak='$nil_kontrak', username='$user', tgl_update='$tglupdate', kd_cr_oleh='$peroleh', h_total='$ztotal'
					where kd_skpd='$skpd' and id_lock='$id_lock'";
			// print_r($sql); exit();
			$proses = $this->db->query($sql);
			return 1;
		}
	}

	function simpan_detail($no_dokumen,$kd_unit,$kd_skpd,$s_dana,$nilai_kontrak,$post,$id_lock){
	 	$del = $this->db->query("delete from transaksi.trd_isianbrg where kd_skpd='$kd_skpd' and id_lock='$id_lock'");
		foreach($post as $row) {					
			if($row->tgl_sp2d==''){
				$tglSp2d = '01-01-0001';
			}else{
				$tglSp2d = $row->tgl_sp2d;
			}	
			if($row->nilai_sp2d==''){
				$nilSp2d = '0';
			}else{
				$nilSp2d = $row->nilai_sp2d;
			}
			if($row->ppn==''){
				$ppn = '0';
			}else{
				$ppn = $row->ppn;
			}
			$filter_data = array(
				"no_dokumen"    => htmlspecialchars($no_dokumen, ENT_QUOTES),
				"kd_brg"        => htmlspecialchars($row->kd_brg, ENT_QUOTES),
				"kd_unit"       => htmlspecialchars($kd_unit, ENT_QUOTES),
				"kd_skpd"       => htmlspecialchars($kd_skpd, ENT_QUOTES),
				"nm_brg"        => $this->getNmBrg($row->kd_brg),
				"kd_rek5"       => htmlspecialchars($row->kd_rek5, ENT_QUOTES),
				"jumlah"        => htmlspecialchars($row->jumlah, ENT_QUOTES),
				"harga"         => str_replace(array(',',''), array('',''), $row->harga),
				"total"         => str_replace(array(',',''), array('',''), $row->total),
				"no_sp2d"       => htmlspecialchars($row->no_sp2d, ENT_QUOTES),
				"tgl_sp2d"      => htmlspecialchars($this->tanggal_balik($tglSp2d), ENT_QUOTES),
				"nilai_sp2d"    => str_replace(array(',',''), array('',''), $nilSp2d),
				"keterangan"    => htmlspecialchars($row->keterangan, ENT_QUOTES),
				"invent"        => '0',
				"ppn"           => str_replace(array(',',''), array('',''), $ppn),
				"cad"           => '0',
				"s_dana"        => htmlspecialchars($s_dana, ENT_QUOTES),
				"kd_kegiatan"   => htmlspecialchars($row->kd_kegiatan, ENT_QUOTES),
				"jns"           => htmlspecialchars($row->jns, ENT_QUOTES),
				"nilai_kontrak" => htmlspecialchars($nilai_kontrak, ENT_QUOTES),
				"id_lock"       => htmlspecialchars($id_lock, ENT_QUOTES),
				"satuan"        => htmlspecialchars($row->satuan, ENT_QUOTES),
				"merek"         => htmlspecialchars($row->merek, ENT_QUOTES) 
			);
				// print_r($filter_data); exit();
			$sql = $this->db->insert('transaksi.trd_isianbrg', $filter_data);
			
		} 
		 return 1; 
	}

	function getNmBrg($kode){
		$sql = "SELECT uraian from mbarang where kd_brg='$kode' limit 1"; 
		$proses = $this->db->query($sql)->row('uraian');
		return $proses;
	}

	function angka($nilai){
		
        if ($nilai== null || $nilai == 0){
            $nilai = '0';    
        }
        
        $a = $nilai.split(',').join('');
        $b = eval(a);
        return b;
	}

	function hapus(){
		$skpd = $this->input->post('skpd');
		$lock = $this->input->post('id_lock');

		$sql_h = "DELETE FROM transaksi.trh_isianbrg WHERE kd_skpd='$skpd' AND id_lock='$lock'";
		$sql_d = "DELETE FROM transaksi.trd_isianbrg WHERE kd_skpd='$skpd' AND id_lock='$lock'";
		// print_r($sql_h); print_r($sql_d); exit(); 
		$del_h = $this->db->query($sql_h);
		$del_d = $this->db->query($sql_d);
		return 1;
		
	}

	public function load_detail($param)
	{
		$idLock 	= $param['idLock'];
		$skpd 	= $param['skpd'];

		$result   = array();
        $row      = array();
        $page     = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows     = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset   = ($page-1)*$rows;

        $csql = "SELECT SUM(total) AS total from transaksi.trd_isianbrg where id_lock = '$idLock' and kd_skpd = '$skpd'";
// print_r($csql); exit();
        $query1 = $this->db->query($csql);
        $ntotal = $query1->row('total');
        $sql = "SELECT a.nm_brg,a.no_sp2d,a.tgl_sp2d,a.harga,a.total,a.kd_brg,a.kd_rek5,a.jumlah,a.nilai_sp2d,a.keterangan,a.kd_kegiatan,a.jns,a.satuan,a.merek,a.ppn FROM transaksi.trd_isianbrg a LEFT JOIN transaksi.trh_isianbrg b ON a.id_lock=b.id_lock WHERE a.id_lock = '$idLock' AND a.kd_skpd = '$skpd'";
        $query2 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query2->result_array() as $resulte)
        {            
            $row[] = array( 
            	'id'          	=> $ii,                     
				'kd_brg' 		=> $resulte['kd_brg'],
				'no_sp2d' 		=> $resulte['no_sp2d'],
				'tgl_sp2d' 		=> $this->tanggal_ind($resulte['tgl_sp2d']),
				'nilai_sp2d' 	=> number_format($resulte['nilai_sp2d'],2,'.',','),
				'kd_kegiatan' 	=> $resulte['kd_kegiatan'],
				'kd_rek5' 		=> $resulte['kd_rek5'],
				'ppn' 			=> $resulte['ppn'],
				'keterangan' 	=> $resulte['keterangan'],
				'jns' 			=> $resulte['jns'],
				'satuan' 		=> $resulte['satuan'],
				'merek' 		=> $resulte['merek'],
				'harga' 		=> number_format($resulte['harga'],2,'.',','),
				'jumlah' 		=> $resulte['jumlah'],
				'total' 		=> number_format($resulte['total'],2,'.',',')
            );
            $ii++;
        }           

		

		$query1->free_result();
        $query2->free_result();
        
        
        $result["total"]  = $ntotal;
        $result["rows"]   = $row; 
        
        return $result;		
        
	}

	public function tanggal_ind($tgl){
		$tahun   =  substr($tgl,0,4);
		$bulan   = substr($tgl,5,2);
		$tanggal =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}


	public function insert_rekanan($param,$skpd)
	{
		$hrekanx  	= $param;
		//cek dulu nama rekanan
		$sqlcek = " SELECT count(kd_comp) as kd from mcompany where nm_comp like '%$hrekanx%' ";
		$query = $this->db->query($sqlcek);
		$kode = $query->row('kd');
		$kodecompt	= $kode.'.'.$skpd;

		//jika belum ada, insert ke tabel mcompany
		if ($kode < 1){
				$sql ="SELECT COALESCE(max(cast(left(kd_comp,5) as int)),0)+1 as kode from mcompany";
				$query = $this->db->query($sql);
				$kode = $query->row('kode');
				$kd_comp = sprintf("%05d",intval($kode));

				$insert = "INSERT into mcompany (kd_comp,nm_comp) values ('$kodecompt','$hrekanx') ";
				$query1 = $this->db->query($insert);
				if ($query1) {
							$getKode = "SELECT kd_comp from mcompany where nm_comp like '%$hrekanx%'";
							$query2 = $this->db->query($getKode);
							$kodenya = $query2->row('kd_comp');

							return $kodenya;
							$query1->free_result();
							$query2->free_result();
						} else {
							return 0;
						}
		}else{
			//jika sudah ada, cari dan return kode comp
				$getKode = "SELECT kd_comp from mcompany where nm_comp like '%$hrekanx%'";
							$query2 = $this->db->query($getKode);
							$kodenya = $query2->row('kd_comp');				
				return $kodenya;
		}

	}


	//=================@Naga=================================

}
