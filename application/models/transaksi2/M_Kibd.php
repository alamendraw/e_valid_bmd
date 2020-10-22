<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kibd extends CI_Model {

	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
	}

	function saveData($post){
		$no_regis		= htmlspecialchars($post['no_regis'], ENT_QUOTES);
		$no_dokumen 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
		$rincian		= htmlspecialchars($post['rincian'], ENT_QUOTES);
		$sub_rincian 	= htmlspecialchars($post['sub_rincian'], ENT_QUOTES);
		$kd_barang 		= htmlspecialchars($post['kd_barang'], ENT_QUOTES);
		$milik 			= htmlspecialchars($post['milik'], ENT_QUOTES);
		$wil			= htmlspecialchars($post['wil'], ENT_QUOTES);
		$kd_skpd		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
		$kd_unit		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
		$perolehan		= htmlspecialchars($post['perolehan'], ENT_QUOTES);
		$dasar 			= htmlspecialchars($post['dasar'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
		$thn_oleh 		= htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
		$hrg_oleh 		= htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
		$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$tgl_regis 		= htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
		$sts 			= htmlspecialchars($post['sts'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
		$konstruksi 	= htmlspecialchars($post['konstruksi'], ENT_QUOTES);
		$panjang 		= htmlspecialchars($post['panjang'], ENT_QUOTES);
		$lebar 			= htmlspecialchars($post['lebar'], ENT_QUOTES);
		$luas 			= htmlspecialchars($post['luas'], ENT_QUOTES);
		$alamat1 		= htmlspecialchars($post['alamat1'], ENT_QUOTES);
		$alamat2		= htmlspecialchars($post['alamat2'], ENT_QUOTES);
		$alamat3 		= htmlspecialchars($post['alamat3'], ENT_QUOTES);
		$latitude 		= htmlspecialchars($post['latitude'], ENT_QUOTES);
		$longtitude 	= htmlspecialchars($post['longtitude'], ENT_QUOTES);
		$keterangan 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
		$penggunaan 	= htmlspecialchars($post['penggunaan'], ENT_QUOTES);
		$kd_tanah 		= htmlspecialchars($post['kd_tanah'], ENT_QUOTES);
		$gambar1		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
		$gambar2		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
		$gambar3		= htmlspecialchars($post['gambar3'], ENT_QUOTES);
		$gambar4		= htmlspecialchars($post['gambar4'], ENT_QUOTES);
		$metode			= htmlspecialchars($post['metode'], ENT_QUOTES);
		$masa			= htmlspecialchars($post['masa'], ENT_QUOTES);
		$nilai_sisa		= htmlspecialchars($post['nilai_sisa'], ENT_QUOTES);
		$detail			= htmlspecialchars($post['detail'], ENT_QUOTES);
		$user 			= $this->session->userdata('nm_user');
		$auto 			= $this->getAuto();
		$nm_brg 		= $this->getNmBrg($kd_barang);
		$ket_matriks    = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
		$kronologis     = htmlspecialchars($post['kronologis'], ENT_QUOTES);

		// total,username,tgl_update, auto
		for ($x = 1; $x <= $jumlah; $x++) {
			$id_barang = $kd_barang.'.'.$kd_skpd.'.'.$thn_oleh.'.'.$no_regis;
			$query = "INSERT INTO transaksi.trkib_d(no_reg,tgl_reg,id_barang,id_lokasi,no_dokumen,kd_brg,no_oleh,tgl_oleh,status_tanah,kondisi,asal,dsr_peroleh,konstruksi,panjang,lebar,luas,nilai,jumlah,alamat1,alamat2,alamat3,keterangan,milik,wilayah,kd_skpd,kd_unit,tahun,foto1,foto2,foto3,foto4,lat,lon,penggunaan,kd_tanah,total,username,tgl_update, auto, nm_brg,metode,masa_manfaat,nilai_sisa,detail_brg,ket_matriks,kronologis)
			VALUES('$no_regis','$tgl_regis','$id_barang','$id_barang','$no_dokumen','$kd_barang','$no_oleh','$tgl_oleh','$sts','$kondisi','$perolehan','$dasar','$konstruksi','$panjang','$lebar','$luas','$hrg_oleh','1','$alamat1','$alamat2','$alamat3','$keterangan','$milik','$wil','$kd_skpd','$kd_unit','$thn_oleh','$gambar1','$gambar2','$gambar3','$gambar4',cast(NULLIF('$latitude','') as double precision),cast(NULLIF('$longtitude','') as double precision),'$penggunaan','$kd_tanah','$hrg_oleh','$user',CURRENT_TIMESTAMP,'$auto', '$nm_brg','$metode','$masa','$nilai_sisa','$detail','$ket_matriks','$kronologis')";
// print_r($query);	exit();				
			 $sql = $this->db->query($query);  
			 $auto++;
			 $no_regis=sprintf("%05d",intval($no_regis)+1);
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

	function getNmBrg($kode){
		$proses = $this->db->query("SELECT uraian from mbarang where kd_brg='$kode'")->row('uraian');
		return $proses;
	}

	function getAuto(){
		$proses = $this->db->query("SELECT max(auto) as auto from transaksi.trkib_d")->row('auto');
		if($proses=='' || $proses=='(Null)'){
			$hasil =1;
		}else{
			$hasil = $proses +1;
		}
		return $hasil;
	}
	
	function editData($post){
		$id_lokasi		= htmlspecialchars($post['id_lokasi'], ENT_QUOTES);  
		$rincian		= htmlspecialchars($post['rincian'], ENT_QUOTES);  
		$milik 			= htmlspecialchars($post['milik'], ENT_QUOTES);
		$wil			= htmlspecialchars($post['wil'], ENT_QUOTES); 
		$perolehan		= htmlspecialchars($post['perolehan'], ENT_QUOTES);
		$dasar 			= htmlspecialchars($post['dasar'], ENT_QUOTES);
		$kd_barang 		= htmlspecialchars($post['kd_barang'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
		$thn_oleh 		= htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
		$hrg_oleh 		= htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
		$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$tgl_regis 		= htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
		$sts 			= htmlspecialchars($post['sts'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
		$konstruksi 	= htmlspecialchars($post['konstruksi'], ENT_QUOTES);
		$panjang 		= htmlspecialchars($post['panjang'], ENT_QUOTES);
		$lebar 			= htmlspecialchars($post['lebar'], ENT_QUOTES);
		$luas 			= htmlspecialchars($post['luas'], ENT_QUOTES);
		$alamat1 		= htmlspecialchars($post['alamat1'], ENT_QUOTES);
		$alamat2		= htmlspecialchars($post['alamat2'], ENT_QUOTES);
		$alamat3 		= htmlspecialchars($post['alamat3'], ENT_QUOTES);
		$gambar4		= htmlspecialchars($post['gambar4'], ENT_QUOTES);
		$latitude 		= htmlspecialchars($post['latitude'], ENT_QUOTES);
		$longtitude 	= htmlspecialchars($post['longtitude'], ENT_QUOTES);
		$keterangan 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
		$penggunaan 	= htmlspecialchars($post['penggunaan'], ENT_QUOTES);
		$kd_tanah 		= htmlspecialchars($post['kd_tanah'], ENT_QUOTES);
		$stsx 			= htmlspecialchars($post['stsx'], ENT_QUOTES);
		$detail 		= htmlspecialchars($post['detail'], ENT_QUOTES);
		$gambar1		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
		$gambar2		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
		$gambar3		= htmlspecialchars($post['gambar3'], ENT_QUOTES);
		$ket_matriks    = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
		$kronologis     = htmlspecialchars($post['kronologis'], ENT_QUOTES);
			
		switch ($stsx) {
			case 1:
				$query = "UPDATE transaksi.trkib_d SET   
				status_tanah       =  '$sts',
				kondisi            =  '$kondisi',
				kd_brg             =  '$kd_barang',
				detail_brg         =  '$detail',
				asal               =  '$perolehan',
				dsr_peroleh        =  '$dasar',
				konstruksi         =  '$konstruksi',
				panjang            =  '$panjang',
				lebar              =  '$lebar',
				luas               =  '$luas', 
				alamat1            =  '$alamat1',
				alamat2            =  '$alamat2',
				alamat3            =  '$alamat3',
				keterangan         =  '$keterangan',
				milik              =  '$milik',
				wilayah            =  '$wil', 
				foto1              =  '$gambar1',
				foto2              =  '$gambar2',
				foto3              =  '$gambar3',
				foto4              =  '$gambar4',
				lat                =  '$latitude',
				lon                =  '$longtitude',
				penggunaan         =  '$penggunaan',
				ket_matriks        =  '$ket_matriks',
				kronologis         =  '$kronologis',
				kd_tanah           =  '$kd_tanah' 
				 
				WHERE id_lokasi='$id_lokasi'";
			break;
			
			default:
				$query = "UPDATE transaksi.trkib_d SET  
				no_oleh            =  '$no_oleh',
				tgl_oleh           =  '$tgl_oleh',
				status_tanah       =  '$sts',
				kd_brg             =  '$kd_barang',
				kondisi            =  '$kondisi',
				asal               =  '$perolehan',
				dsr_peroleh        =  '$dasar',
				konstruksi         =  '$konstruksi',
				detail_brg         =  '$detail',
				panjang            =  '$panjang',
				lebar              =  '$lebar',
				luas               =  '$luas',
				nilai              =  '$hrg_oleh',
				jumlah             =  '$jumlah',
				alamat1            =  '$alamat1',
				alamat2            =  '$alamat2',
				alamat3            =  '$alamat3',
				keterangan         =  '$keterangan',
				milik              =  '$milik',
				wilayah            =  '$wil',
				tahun              =  '$thn_oleh',
				foto1              =  '$gambar1',
				foto2              =  '$gambar2',
				foto3              =  '$gambar3',
				foto4              =  '$gambar4',
				lat                =  '$latitude',
				lon                =  '$longtitude',
				penggunaan         =  '$penggunaan',
				ket_matriks        =  '$ket_matriks',
				kronologis         =  '$kronologis',
				kd_tanah           =  '$kd_tanah' 
				 
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
					$query = "SELECT foto1,foto2,foto3,foto4 from transaksi.trkib_d where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query)->row_array();
					for ($i=1; $i <= 4; $i++) {
						if ($sql['foto'.$i]!='' || $sql['foto'.$i]!=null) {
							if (file_exists('./uploads/kibD/'.$sql['foto'.$i])) {
								$path1 ='./uploads/kibD/'.$sql['foto'.$i];
								unlink($path1);
							}
						}
					}
					$query = "DELETE from transaksi.trkib_d where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query);
				}
			
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}

	
	
	public function loadHeader($key1,$key2,$key3) {
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		$xkey1 ='';
		$xkey2 ='';
		$xkey3 ='';
	 	
	 	$unit = $this->session->userdata['kd_unit'];
		if($otori=='01'){
		 	$kondisi = "";
		 }else{
		 	$kondisi = "and a.kd_skpd='$skpd' and a.kd_unit='$unit'";
		 }
			$result = array();
			$row = array();
			$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
			$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
			$offset = ($page-1)*$rows;
			$where = "where a.no_reg!='' $kondisi";
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
			
			if($key3!=''){ //sumber dana / panjang / luas / lebar / alamat / tahun / kondisi / keterangan / nilai / nama barang
				$xkey3 = "and (upper(g.cara_peroleh) like upper('%$key3%') or upper(a.panjang) like upper('%$key3%') or upper(a.luas) like upper('%$key3%') or upper(a.alamat1) like upper('%$key3%') or upper(a.kondisi) like upper('%$key3%') or upper(a.keterangan) like upper('%$key3%') or a.nilai::text like '%$key3%')";	 
			}
			if($key1!='' || $key2!='' || $key3!=''){
				$where = "where a.no_reg!='' $kondisi $xkey1 $xkey2 $xkey3";	
			}
			
			$sql = "SELECT count(*) as tot from transaksi.trkib_d a
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh $where" ;
			$query1 = $this->db->query($sql);
			$total = $query1->row();
			
			$sql = "SELECT a.*,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,
				b.uraian as nm_rincian, b.uraian as nm_subrinci,
				c.nm_skpd,b.uraian nm_brg,f.nm_unit
				FROM transaksi.trkib_d a 
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				LEFT JOIN public.mskpd c ON a.kd_skpd=c.kd_skpd 
				LEFT JOIN public.munit f ON a.kd_unit = f.kd_unit and a.kd_skpd=f.kd_skpd
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh  $where
				GROUP BY no_reg,id_barang,id_lokasi,tgl_reg,no_oleh,tgl_oleh,no_dokumen,status_tanah,kondisi,asal,dsr_peroleh,panjang,lebar,luas,nilai,jumlah,alamat1,alamat2,alamat3,keterangan,kd_tanah,konstruksi,milik,wilayah,a.kd_skpd,a.kd_unit,tahun,b.kd_brg,lat,lon,rincian_objek,sub_rincian_objek,nm_skpd,penggunaan,foto1,foto2,nm_rincian,nm_subrinci,nm_brg,nm_unit,sts,detail_brg
				 $limit";
// print_r($sql);  exit();
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
					'id' 				=> $ii,        
					'no_reg' 			=> $resulte['no_reg'],
                	'id_barang' 		=> $resulte['id_barang'],
                	'id_lokasi' 		=> $resulte['id_lokasi'],
					'tgl_reg' 			=> $this->tanggal_ind($resulte['tgl_reg']),
					'no_oleh' 			=> $resulte['no_oleh'],
					'tgl_oleh' 			=> $this->tanggal_ind($resulte['tgl_oleh']),
					'no_dokumen'		=> $resulte['no_dokumen'],
					'status_tanah' 		=> $resulte['status_tanah'],
					'kondisi' 			=> $resulte['kondisi'],
					'asal' 				=> $resulte['asal'],
					'dsr_peroleh' 		=> $resulte['dsr_peroleh'],
					'panjang'			=> $resulte['panjang'],
					'lebar'				=> $resulte['lebar'],
					'luas'				=> $resulte['luas'],
					'nilai' 			=> number_format($resulte['nilai'],2),
					'jumlah' 			=> $resulte['jumlah'],
					'alamat1' 			=> $resulte['alamat1'],
					'alamat2' 			=> $resulte['alamat2'],
					'alamat3' 			=> $resulte['alamat3'],
					'keterangan' 		=> $resulte['keterangan'],
					'kd_tanah' 			=> $resulte['kd_tanah'],
					'konstruksi' 		=> $resulte['konstruksi'],
					'milik' 			=> $resulte['milik'],
					'wilayah' 			=> $resulte['wilayah'],
					'kd_skpd' 			=> $resulte['kd_skpd'],
					'kd_unit' 			=> $resulte['kd_unit'],
					'tahun' 			=> $resulte['tahun'],
					'kd_brg'  			=> $resulte['kd_brg'],
					'lat'  				=> $resulte['lat'],
					'lon'  				=> $resulte['lon'],
					'rincian_objek' 	=> $resulte['rincian_objek'],
					'sub_rincian_objek'	=> $resulte['sub_rincian_objek'],
					'nm_skpd'			=> $resulte['nm_skpd'],
					'penggunaan'		=> $resulte['penggunaan'],
					'foto1'				=> trim($resulte['foto1']),
					'foto2'				=> trim($resulte['foto2']),
					'foto3'				=> trim($resulte['foto3']),
					'foto4'				=> trim($resulte['foto4']),
					'nm_rincian'		=> $resulte['nm_rincian'],
					'nm_subrinci'		=> $resulte['nm_subrinci'],
					'nm_brg'			=> $resulte['nm_brg'],
					'nm_unit'			=> $resulte['nm_unit'],
	                'sts' 				=> $resulte['sts'],
	                'detail_brg' 		=> $resulte['detail_brg'],
	                'ket_matriks' 		=> $resulte['ket_matriks'],
	                'kronologis' 		=> $resulte['kronologis'],
	                'icon' 				=> $icon,
				);
				$ii++;
			}
			$result["total"] = $total->tot;
			$result["rows"] = $row; 
			return $result;
		 
	}

	function loadBarang($akun,$kel,$jenis,$subrinci,$key,$rinci) {  
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
				WHERE length(kd_brg)='18' and left(kd_brg,8)='$rinci' and uraian not like '%Dst….%'
				$where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM public.mbarang 
				WHERE length(kd_brg)='18' and left(kd_brg,8)='$rinci' and uraian not like '%Dst….%'
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
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg, kd_wilayah FROM transaksi.trd_isianbrg a join public.mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock 
		where left(a.kd_brg,5)='$kib' order by a.kd_skpd";
		} else {
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg, kd_wilayah FROM transaksi.trd_isianbrg a join public.mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock
		WHERE  left(a.kd_brg,5)='$kib' and c.kd_skpd = '$skpd' order by a.kd_skpd";
		}

		// print_r($sql);
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
				'kd_skpd' => $key['kd_skpd'],  
				'nm_skpd' => $key['nm_skpd'],  
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
		
	public function getkdtanah($data){
		$otori = $data['oto'];
		$skpd  = $data['skpd'];
        $lccr  = $this->input->post('q');
		$key   = "";
		if($lccr!='' ){
			$key ="AND (upper(a.kd_brg) like upper('%$lccr%') 
		or upper(b.uraian) like upper('%$lccr%') 
		or upper(a.kd_brg) like upper('%$lccr%') 
		or upper(a.keterangan) like upper('%$lccr%'))";
		}
		if($otori == '01'){
		$where	= "$key";
		} else {
		$where	= "and a.kd_skpd='$skpd' $key";
		}
		
		$sql = "SELECT a.kd_brg,b.uraian from transaksi.trkib_a a
		join mbarang b on a.kd_brg=b.kd_brg 
		where a.nilai is not null $where GROUP BY a.kd_brg,b.uraian,a.kd_skpd order by a.kd_skpd";
		
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_brg' => $key['kd_brg'],  
				'uraian' => $key['uraian']
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
					WHERE length(kd_brg)='8'and akun='$akun' and kelompok='$kel' and jenis='$jenis' $key order by kd_brg ASC";
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
					WHERE length(kd_brg)='12'and akun='$akun' and kelompok='$kel' and jenis='$jenis' and LEFT(kd_brg,9)='$subrinci'
					AND (upper(kd_brg) like upper('%$lccr%') or upper(uraian) like upper('%$lccr%'))";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getMilik($lccq){
		$sql	= "SELECT kd_milik, nm_milik FROM mmilik";
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
				'kd_wilayah' => $key['kd_wilayah'],  
                'nm_wilayah' => $key['nm_wilayah'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getUnit($lccq,$skpd){
		$sql	= "SELECT kd_unit,nm_unit FROM public.munit WHERE kd_skpd='$skpd' group by kd_unit,nm_unit order by kd_unit";
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

		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(status) like upper('%$lccr%')"; 
        
        }

		$sql	= "SELECT kode,status FROM public.st_tanah $key group by kode,status order by kode ";
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
		// print_r($sql);	
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
		FROM transaksi.trkib_d WHERE kd_skpd='$skpd' AND tahun='$tahun' and kd_brg='$kd_brg'");  
        $nomor  = $query1->row('nomor');
		$result	= sprintf("%05d",intval($nomor)+1);
        return $result;
        $query1->free_result();
	}
	
	public function getMetode($lccq){
		$sql	= "SELECT kode, metode FROM mmetode";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kode' => $key['kode'],  
                'metode' => $key['metode'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */