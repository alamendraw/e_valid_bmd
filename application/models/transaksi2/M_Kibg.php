<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kibg extends CI_Model {
	
	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	function saveData($post){

			$no_regis		= htmlspecialchars($post['no_regis'], ENT_QUOTES);
			$no_dokumen	 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
			$kd_barang	 	= htmlspecialchars($post['kd_barang'], ENT_QUOTES);
			$milik 			= htmlspecialchars($post['milik'], ENT_QUOTES);
			$wil 			= htmlspecialchars($post['wil'], ENT_QUOTES);
			$kd_skpd 		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
			$nm_skpd 		= htmlspecialchars($post['nm_skpd'], ENT_QUOTES);
			$kd_unit 		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
			$nm_unit 		= htmlspecialchars($post['nm_unit'], ENT_QUOTES);
			$perolehan	 	= htmlspecialchars($post['perolehan'], ENT_QUOTES);
			$dasar 			= htmlspecialchars($post['dasar'], ENT_QUOTES);
			$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
			$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
			$thn_oleh 		= htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
			$hrg_oleh 		= htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
			$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
			$tgl_regis 		= htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
			$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
			$alamat1 		= htmlspecialchars($post['alamat1'], ENT_QUOTES);
			$alamat2		= htmlspecialchars($post['alamat2'], ENT_QUOTES);
			$alamat3 		= htmlspecialchars($post['alamat3'], ENT_QUOTES);
			$keterangan	 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
			$latitude 		= htmlspecialchars($post['latitude'], ENT_QUOTES);
			$longtitude	 	= htmlspecialchars($post['longtitude'], ENT_QUOTES);
			$gambar1 		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
			$gambar2 		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
			$detail 		= htmlspecialchars($post['detail'], ENT_QUOTES);
			$ket_matriks 	= htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
			$user 			= $this->session->userdata('nm_user');
			$auto 			= $this->getAuto(); 
			$nmBrg 			= $this->getNmBrg($kd_barang);

			for ($x = 1; $x <= $jumlah; $x++) {
				$id_barang = $kd_barang.'.'.$kd_unit.'.'.$thn_oleh.'.'.$no_regis;
				$query ="insert into transaksi.trkib_g (no_reg, id_barang, id_lokasi, kd_brg,nm_brg, no_dokumen, milik, wilayah, kd_skpd, kd_unit, asal, dsr_peroleh, no_oleh, tgl_oleh, tahun, nilai, jumlah, tgl_reg, kondisi,alamat1, alamat2, alamat3, keterangan, lat, lon,foto1, foto2, total,username,tgl_update, auto, sts,detail_brg,ket_matriks
				)
				values ('$no_regis', '$id_barang', '$id_barang', '$kd_barang','$nmBrg', '$no_dokumen', '$milik', '$wil', '$kd_skpd', '$kd_unit', '$perolehan', '$dasar', '$no_oleh', '$tgl_oleh', '$thn_oleh', '$hrg_oleh', '1', '$tgl_regis', '$kondisi','$alamat1', '$alamat2', '$alamat3', '$keterangan', cast(NULLIF('$latitude','') as double precision),cast(NULLIF('$longtitude','') as double precision),'$gambar1', '$gambar2', '$hrg_oleh', '$user', CURRENT_TIMESTAMP, '$auto','0','$detail','$ket_matriks'
				);";
				// print_r($query);
				$sql = $this->db->query($query);
				$no_regis=sprintf("%05d",intval($no_regis)+1);
				$auto++;
			}	
		try {
			if ($sql) {
				return 1;
				$sql->free_result();
			} 

		} catch (Exception $e) {
			return 0;
		}
		
	}

	function getNmBrg($kode){
		$proses = $this->db->query("SELECT uraian from mbarang where kd_brg='$kode'")->row('uraian');
		return $proses;
	}

	function getAuto(){
		$query = $this->db->query("SELECT max(auto) as auto from transaksi.trkib_g")->row('auto');
		if($query=='' || $query=='NULL'){
			$hasil = '1';
		}else{
			$hasil = $query +1;
		}
		return $hasil;
	}
	
	function editData($post){
		 
		$id_lokasi			= htmlspecialchars($post['id_lokasi'], ENT_QUOTES);
		$no_regis		= htmlspecialchars($post['no_regis'], ENT_QUOTES);
		$no_dokumen	 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
		$kd_barang	 	= htmlspecialchars($post['kd_barang'], ENT_QUOTES);
		$milik 			= htmlspecialchars($post['milik'], ENT_QUOTES);
		$wil 			= htmlspecialchars($post['wil'], ENT_QUOTES);
		$kd_skpd 		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
		$nm_skpd 		= htmlspecialchars($post['nm_skpd'], ENT_QUOTES);
		$kd_unit 		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
		$nm_unit 		= htmlspecialchars($post['nm_unit'], ENT_QUOTES);
		$perolehan	 	= htmlspecialchars($post['perolehan'], ENT_QUOTES);
		$dasar 			= htmlspecialchars($post['dasar'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
		$thn_oleh 		= htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
		$hrg_oleh 		= htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
		$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$tgl_regis 		= htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
		$konstruksi	 	= htmlspecialchars($post['konstruksi'], ENT_QUOTES);
		$konstruksi2 	= htmlspecialchars($post['konstruksi2'], ENT_QUOTES);
		$jenis	 		= htmlspecialchars($post['jenis'], ENT_QUOTES);
		$luas 			= htmlspecialchars($post['luas'], ENT_QUOTES);
		$tgl_mulai 		= htmlspecialchars($post['tgl_mulai'], ENT_QUOTES);
		$sts_tanah	 	= htmlspecialchars($post['sts_tanah'], ENT_QUOTES);
		$kontrak	 	= htmlspecialchars($post['kontrak'], ENT_QUOTES);
		$alamat1 		= htmlspecialchars($post['alamat1'], ENT_QUOTES);
		$alamat2		= htmlspecialchars($post['alamat2'], ENT_QUOTES);
		$alamat3 		= htmlspecialchars($post['alamat3'], ENT_QUOTES);
		$keterangan	 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
		$latitude 		= htmlspecialchars($post['latitude'], ENT_QUOTES);
		$longtitude	 	= htmlspecialchars($post['longtitude'], ENT_QUOTES);
		$kd_tanah 		= htmlspecialchars($post['kd_tanah'], ENT_QUOTES);
		$detail 		= htmlspecialchars($post['detail'], ENT_QUOTES);
		$sts 			= htmlspecialchars($post['sts'], ENT_QUOTES);
		$gambar1 		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
		$gambar2 		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
		$ket_matriks 	= htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
		
		if($tgl_mulai=='--'){
			$tgl_mulai='0001-01-01';
		}

		switch ($sts) {
			case 1:
				$query = "UPDATE transaksi.trkib_g SET 
					milik			= '$milik',
					wilayah			= '$wil',
					asal			= '$perolehan',
					dsr_peroleh		= '$dasar',
					no_oleh			= '$no_oleh',
					tgl_oleh		= '$tgl_oleh',
					kondisi			= '$kondisi',
					konstruksi		= '$konstruksi',  
					bangunan		= '$jenis',
					luas			= '$luas',
					tgl_awal_kerja	= '$tgl_mulai',
					status_tanah	= '$sts_tanah',
					nilai_kontrak	= '$kontrak',
					alamat1			= '$alamat1',
					alamat2			= '$alamat2',
					alamat3			= '$alamat3',
					detail_brg		= '$detail',
					keterangan		= '$keterangan',
					lat				= '$latitude',
					lon				= '$longtitude',
					kd_tanah		= '$kd_tanah',
					foto1			= '$gambar1',
					foto2			= '$gambar2',
					ket_matriks		= '$ket_matriks'
					WHERE id_lokasi='$id_lokasi'";
			break;
			
			default:
				$query = "UPDATE transaksi.trkib_g SET 
					milik			= '$milik',
					wilayah			= '$wil',
					asal			= '$perolehan',
					dsr_peroleh		= '$dasar',
					no_oleh			= '$no_oleh',
					tgl_oleh		= '$tgl_oleh',
					tahun			= '$thn_oleh',
					nilai			= '$hrg_oleh',
					jumlah			= '$jumlah',
					tgl_reg			= '$tgl_regis',
					kondisi			= '$kondisi',
					konstruksi		= '$konstruksi',  
					bangunan		= '$jenis',
					luas			= '$luas',
					tgl_awal_kerja	= '$tgl_mulai',
					status_tanah	= '$sts_tanah',
					nilai_kontrak	= '$kontrak',
					alamat1			= '$alamat1',
					alamat2			= '$alamat2',
					alamat3			= '$alamat3',
					detail_brg		= '$detail',
					keterangan		= '$keterangan',
					lat				= '$latitude',
					lon				= '$longtitude',
					kd_tanah		= '$kd_tanah',
					foto1			= '$gambar1',
					foto2			= '$gambar2',
					ket_matriks		= '$ket_matriks'
					WHERE id_lokasi='$id_lokasi'";
			break;
		}

		
				// print_r($query); exit();
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
	
	function hapus($post){
		$kode = htmlspecialchars($post['id_lokasi'], ENT_QUOTES);
		$ex	  = explode("#", $kode);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$query = "DELETE from transaksi.trkib_g where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query);
					// $sql = $this->db->where('id_lokasi', $val)->where('sts','0')
					// 			->delete('transaksi.trkib_g');
				}
			
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	public function loadHeader($key1,$key2,$key3) {
		$xkey1 ='';
		$xkey2 ='';
		$xkey3 ='';
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = '';
		$limit = "ORDER BY a.tahun DESC,a.kd_brg,a.no_reg,b.uraian,a.tgl_reg ASC LIMIT $rows OFFSET $offset";
		// if($key!=''){
		// $where = "where (upper(b.uraian) like upper('%$key%') or upper(a.no_reg) like upper('%$key%') or upper(a.tahun) like upper('%$key%') or upper(a.keterangan) like upper('%$key%'))";	
		// $limit = "";	
		// }

		if($key1!=''){
			$xkey1 = "and (upper(b.uraian) like upper('%$key1%') or upper(a.detail_brg) like upper('%$key1%'))"; 
		}
		
		if($key2!=''){
			$xkey2 = "and (upper(a.tahun) like upper('%$key2%'))";	 
		}
		
		if($key3!=''){ //sumber dana / kontruksi / alamat / kondisi / keterangan
			$xkey3 = "and (upper(g.cara_peroleh) like upper('%$key3%') or upper(a.alamat1) like upper('%$key3%') or upper(a.kondisi) like upper('%$key3%') or upper(a.keterangan) like upper('%$key3%') or a.nilai::text like '%$key3%')";	 
		}
		if($key1!='' || $key2!='' || $key3!=''){
			$where = "where a.no_reg!='' $xkey1 $xkey2 $xkey3";	
		}

		// no_reg,nm_barang,merek,tahun,harga,keterangn
		$sql = "SELECT count(*) as tot from transaksi.trkib_g a 
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh $where" ;
			// print_r($sql); exit();
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT a.*,rincian_objek,sub_rincian_objek,c.nm_skpd, b.uraian as nm_brg
				FROM transaksi.trkib_g a 
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				LEFT JOIN public.mskpd c ON a.kd_skpd=c.kd_skpd
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte) {
        	if($resulte['sts']=='1'){
        		$icon = "<div style='width: 0; height: 0; border-top: 13px solid #800000; border-right: 13px solid transparent;'></div>"; 
        	}else{
        		$icon = "<div style='width: 0; height: 0; border-top: 13px solid #90EE90; border-right: 13px solid transparent;'></div>"; 
        	} 

            $row[] = array(
                'id' 			=> $ii,
				'no_reg'		=> $resulte['no_reg'],
                'id_lokasi' 	=> $resulte['id_lokasi'],
                'id_barang' 	=> $resulte['id_barang'],
				'no_dokumen' 	=> $resulte['no_dokumen'],
				'kd_barang' 	=> $resulte['kd_brg'],
				'rincian_objek' => $resulte['rincian_objek'],
				'sub_rincian_objek' 	=> $resulte['sub_rincian_objek'],
				'milik' 		=> $resulte['milik'],
				'wil'	 		=> $resulte['wilayah'],
				'kd_skpd' 		=> $resulte['kd_skpd'],
				'nm_skpd' 		=> $resulte['nm_skpd'],
				'kd_unit' 		=> $resulte['kd_unit'],
				'perolehan' 	=> $resulte['asal'],
				'dasar' 		=> $resulte['dsr_peroleh'],
				'no_oleh' 		=> $resulte['no_oleh'],
				'tgl_oleh' 		=> $this->tanggal_ind($resulte['tgl_oleh']),
				'thn_oleh' 		=> $resulte['tahun'],
				'hrg_oleh' 		=> number_format($resulte['nilai'],2),
				'jumlah' 		=> $resulte['jumlah'],
				'tgl_regis'		=> $this->tanggal_ind($resulte['tgl_reg']),
				'kondisi' 		=> $resulte['kondisi'],
				'alamat1' 		=> $resulte['alamat1'],
				'alamat2'	 	=> $resulte['alamat2'],
				'alamat3' 		=> $resulte['alamat3'],
				'keterangan' 	=> $resulte['keterangan'],
				'lat' 			=> $resulte['lat'],
				'lon' 			=> $resulte['lon'],
				'foto' 			=> $resulte['foto1'],
				'foto2' 		=> $resulte['foto2'],
				'nm_brg'		=> $resulte['nm_brg'],
                'sts' 			=> $resulte['sts'],
                'detail_brg' 	=> $resulte['detail_brg'],
                'ket_matriks' 	=> $resulte['ket_matriks'],
                'icon' 			=> $icon,
            );
            $ii++;
        }
        
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result;
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

		$csql = "SELECT SUM(total) AS total from trd_planbrg 
		where no_dokumen = '$nomor' and kd_skpd = '$skpd'";
        $rs   = $this->db->query($csql)->row() ; 
		
        $sql = "SELECT b.* FROM trh_planbrg a 
				INNER JOIN trd_planbrg b ON a.no_dokumen=b.no_dokumen 
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
                'kd_rek5'       => $resulte['kd_rek5'],
                'nm_brg'        => $resulte['nm_brg'],
                'merek'         => $resulte['merek'],
                'jumlah'        => $resulte['jumlah'],
                'harga'         => $resulte['harga'],
                'total'         => $rs->total,                
                'ket'           => $resulte['ket'],                        
                'satuan'        => $resulte['satuan'],                    
                'no_urut'       => $resulte['no_urut'] 				
            );
            $ii++;
        }           
        return $result;
        $query1->free_result();
        $rs->free_result();
	}

	public function loadBarang($akun,$kel,$jenis,$rincian,$key) {  
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
				WHERE length(kd_brg)='18'and akun='$akun' 
				and kelompok='$kel' and jenis='$jenis' and left(kd_brg,5)='$rincian' and uraian not like '%Dst%'
				$where" ;
			 // print_r($sql);
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM public.mbarang 
				WHERE length(kd_brg)='18'and akun='$akun' 
				and kelompok='$kel' and jenis='$jenis' and left(kd_brg,5)='$rincian' and uraian not like '%Dst%'
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
        return $result;
	 
        
	}
		
	public function getDokumen($kib){
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		if($otori == '01'){
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg,kd_wilayah FROM transaksi.trd_isianbrg a join public.mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock 
		where left(a.kd_brg,5)='$kib' order by a.kd_skpd";
		} else {
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg,kd_wilayah FROM transaksi.trd_isianbrg a join public.mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock
		WHERE  left(a.kd_brg,5)='$kib' and c.kd_skpd = '$skpd' order by a.kd_skpd";
		}
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSkpd(){
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		if($otori == '01'){
		$sql	= "SELECT kd_skpd,nm_skpd FROM public.mskpd order by kd_skpd";
		} else {
		$sql	= "SELECT kd_skpd,nm_skpd FROM public.mskpd WHERE kd_skpd = '$skpd' order by kd_skpd";
		}
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_skpd' => trim($key['kd_skpd']),  
				'nm_skpd' => trim($key['nm_skpd']),  
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
		
	public function getRincian($lccq,$akun,$kel,$jenis){

		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(uraian) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kd_brg,rincian_objek,uraian FROM public.mbarang 
					WHERE length(kd_brg)='7'and akun='$akun' and kelompok='$kel' and jenis='$jenis' $key  order by kd_brg ASC";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getSubRincian($lccq,$akun,$kel,$jenis,$rincian){

		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(uraian) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kd_brg,sub_rincian_objek,uraian FROM public.mbarang 
					WHERE length(kd_brg)='9'and akun='$akun' and kelompok='$kel' and jenis='$jenis' and rincian_objek='$rincian' $key";
		$query  = $this->db->query($sql);
		return $query->result_array() ;
	}
	
	public function getKdbarang($lccr,$akun,$kel,$jenis,$subrinci){
		$sql	= "SELECT kd_brg,uraian FROM public.mbarang 
					WHERE length(kd_brg)='12'and akun='$akun' and kelompok='$kel' and jenis='$jenis' 
					AND (upper(kd_brg) like upper('%$lccr%') or upper(uraian) like upper('%$lccr%'))";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getMilik($lccq){
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
		return $res;
		$query->free_result();
	}
	
	public function getWilayah($lccq){
		$sql	= "SELECT kd_wilayah, nm_wilayah FROM mwilayah";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_wilayah' => trim($key['kd_wilayah']),  
                'nm_wilayah' => trim($key['nm_wilayah']),
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getUnit($lccq,$skpd){
		$sql	= "SELECT kd_unit,nm_unit FROM public.munit WHERE kd_skpd='$skpd' order by kd_unit";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_unit' => trim($key['kd_unit']),  
                'nm_unit' => trim($key['nm_unit']),
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getOleh($lccq){
		$sql	= "SELECT kd_cr_oleh,cara_peroleh FROM public.cara_peroleh ";
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
		return $res;
		$query->free_result();
	}
	public function getmatriks($lccq){
		$sql	= "SELECT id,ket_matriks FROM public.matriks ";
		$query  = $this->db->query($sql);
 
		return $query->result_array();
		 
	}
	public function getDasar($lccq){
		$sql	= "SELECT kode,dasar_peroleh FROM public.mdasar ";
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
		return $res;
		$query->free_result();
	}
	
	public function getStatustanah($lccq){
		$sql	= "SELECT kode,status FROM public.st_tanah order by kode ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'status' => $key['status'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getKondisi($lccq){
		$sql	= "SELECT kode,kondisi FROM public.mkondisi order by kode ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'kondisi'		=> $key['kondisi'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getJenisBangun($lccq){
		$sql	= "SELECT kode,jns_bangunan FROM public.mjenis order by kode ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'jns_bangunan'	=> $key['jns_bangunan'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getKonstruksi($lccq){
		$sql	= "SELECT kode,nm_konstruksi FROM public.mkonstruksi order by kode ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'nm_konstruksi'	=> $key['nm_konstruksi'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getKonstruksi2($lccq){
		$sql	= "SELECT kode,nm_konstruksi FROM public.mkonstruksi2 order by kode ";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'nm_konstruksi'	=> $key['nm_konstruksi'],
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
	
	public function max_number($tahun,$skpd,$kd_brg){
		$query1 = $this->db->query("SELECT COALESCE(MAX(CAST(no_reg as int)),0) as nomor 
		FROM transaksi.trkib_g WHERE kd_skpd='$skpd' AND tahun='$tahun' and kd_brg='$kd_brg'");  
        $nomor  = $query1->row('nomor');
		$result	= sprintf("%05d",intval($nomor)+1);
        return $result;
        $query1->free_result();
	}

}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */