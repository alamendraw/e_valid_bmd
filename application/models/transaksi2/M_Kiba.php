<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kiba extends CI_Model {

	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	function saveData($post){
			// $no_regis		= htmlspecialchars($post['no_regis'], ENT_QUOTES);
			$no_dokumen        = htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
			$kd_barang         = htmlspecialchars($post['kd_barang'], ENT_QUOTES);
			$milik             = htmlspecialchars($post['milik'], ENT_QUOTES);
			$wil               = htmlspecialchars($post['wil'], ENT_QUOTES);
			$kd_skpd           = htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
			$kd_unit           = htmlspecialchars($post['kd_unit'], ENT_QUOTES);
			$perolehan         = htmlspecialchars($post['perolehan'], ENT_QUOTES);
			$dasar             = htmlspecialchars($post['dasar'], ENT_QUOTES);
			$no_oleh           = htmlspecialchars($post['no_oleh'], ENT_QUOTES);
			$tgl_oleh          = htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
			$thn_oleh          = htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
			$hrg_oleh          = htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
			$tgl_regis         = htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
			$sts_tanah         = htmlspecialchars($post['sts_tanah'], ENT_QUOTES);
			$kondisi           = htmlspecialchars($post['kondisi'], ENT_QUOTES);
			$no_sert           = htmlspecialchars($post['no_sert'], ENT_QUOTES);
			$tgl_sert          = htmlspecialchars($post['tgl_sert'], ENT_QUOTES);
			$luas              = htmlspecialchars($post['luas'], ENT_QUOTES);
			$alamat1           = htmlspecialchars($post['alamat1'], ENT_QUOTES);
			$alamat2           = htmlspecialchars($post['alamat2'], ENT_QUOTES);
			$alamat3           = htmlspecialchars($post['alamat3'], ENT_QUOTES);
			$latitude          = htmlspecialchars($post['latitude'], ENT_QUOTES);
			$longtitude        = htmlspecialchars($post['longtitude'], ENT_QUOTES);
			$keterangan        = htmlspecialchars($post['keterangan'], ENT_QUOTES);
			$penggunaan        = htmlspecialchars($post['penggunaan'], ENT_QUOTES);
			$upload            = htmlspecialchars($post['upload_sert'], ENT_QUOTES);
			$gambar1           = htmlspecialchars($post['gambar1'], ENT_QUOTES);
			$gambar2           = htmlspecialchars($post['gambar2'], ENT_QUOTES);
			$gambar3           = htmlspecialchars($post['gambar3'], ENT_QUOTES);
			$gambar4           = htmlspecialchars($post['gambar4'], ENT_QUOTES);
			$detail            = htmlspecialchars($post['detail'], ENT_QUOTES);
			$nm_brg            = $this->getNmBrg($kd_barang);
			$camat             = htmlspecialchars($post['camat'], ENT_QUOTES);
			$lurah             = htmlspecialchars($post['lurah'], ENT_QUOTES);
			$pemegang_hak      = htmlspecialchars($post['pemegang_hak'], ENT_QUOTES);
			$b_barat           = htmlspecialchars($post['b_barat'], ENT_QUOTES);
			$b_timur           = htmlspecialchars($post['b_timur'], ENT_QUOTES);
			$b_selatan         = htmlspecialchars($post['b_selatan'], ENT_QUOTES);
			$b_utara           = htmlspecialchars($post['b_utara'], ENT_QUOTES);
			$no_surat_ukur     = htmlspecialchars($post['no_surat_ukur'], ENT_QUOTES);
			$tgl_surat_ukur    = htmlspecialchars($post['tgl_surat_ukur'], ENT_QUOTES);
			$status_sertifikat = htmlspecialchars($post['status_sertifikat'], ENT_QUOTES);
			$fasilitas         = htmlspecialchars($post['fasilitas'], ENT_QUOTES);
			$ket_matriks       = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
			$kronologis        = htmlspecialchars($post['kronologis'], ENT_QUOTES);
			$user              = $this->session->userdata('nm_user');
			$no_regis          = $this->max_number($kd_unit,$kd_barang);
			$id_brg            = $kd_barang.'.'.$kd_unit.'.'.$thn_oleh.'.'.$no_regis;
 
			if($tgl_surat_ukur=='--'){
				$tgl_surat_ukur = '1009-01-01';
			}
			if ($tgl_sert=='--') {
				$tgl_sert = '1009-01-01';
			}
			 
  			$auto 			= $this->getAuto();
 
			$query = "INSERT INTO transaksi.trkib_a(no_reg,tgl_reg,id_barang,no_dokumen,kd_brg,no_oleh,tgl_oleh,status_tanah,kondisi,asal,dsr_peroleh,no_sertifikat,tgl_sertifikat,luas,nilai,alamat1,alamat2,alamat3,keterangan,milik,wilayah,kd_skpd,kd_unit,tahun,upload_sert,foto1,foto2,foto3,foto4,lat,lon,penggunaan,id_lokasi,nm_brg,kd_camat,kd_lurah,pemegang_hak,b_barat,b_timur,b_selatan,b_utara,surat_ukur,tgl_surat_ukur,status_sertifikat,status_fasilitas,auto,username,tgl_update,total,jumlah,sts,detail_brg,ket_matriks,kronologis)
					VALUES('$no_regis','$tgl_regis','$id_brg','$no_dokumen','$kd_barang','$no_oleh','$tgl_oleh','$sts_tanah','$kondisi','$perolehan','$dasar','$no_sert','$tgl_sert','$luas','$hrg_oleh','$alamat1','$alamat2','$alamat3','$keterangan','$milik','$wil','$kd_skpd','$kd_unit','$thn_oleh','$upload','$gambar1','$gambar2','$gambar3','$gambar4',cast(NULLIF('$latitude','') as double precision),cast(NULLIF('$longtitude','') as double precision),'$penggunaan','$id_brg','$nm_brg','$camat','$lurah','$pemegang_hak','$b_barat','$b_timur','$b_selatan','$b_utara','$no_surat_ukur','$tgl_surat_ukur','$status_sertifikat','$fasilitas','$auto','$user',CURRENT_TIMESTAMP,'$hrg_oleh','1','0','$detail','$ket_matriks','$kronologis')";
			 // print_r($query); 
			 // exit();
			 $sql = $this->db->query($query); 
			 $auto++; 
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
		$proses = $this->db->query("select uraian from mbarang where kd_brg='$kode'")->row('uraian');
		return $proses;
	}
	function getAuto(){
		$proses = $this->db->query("SELECT max(auto) as auto from transaksi.trkib_a")->row('auto');
		if($proses=='' || $proses=='(Null)'){
			$hasil =1;
		}else{
			$hasil = $proses +1;
		}
		return $hasil;
	}
	function editData($post){

			$id_barang         = htmlspecialchars($post['id_barang'], ENT_QUOTES);
			$no_regis          = htmlspecialchars($post['no_regis'], ENT_QUOTES);
			$no_dokumen        = htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
			$rincian           = htmlspecialchars($post['rincian'], ENT_QUOTES);
			$sub_rincian       = htmlspecialchars($post['sub_rincian'], ENT_QUOTES);
			$kd_barang         = htmlspecialchars($post['kd_barang'], ENT_QUOTES);
			$milik             = htmlspecialchars($post['milik'], ENT_QUOTES);
			$wil               = htmlspecialchars($post['wil'], ENT_QUOTES);
			$kd_skpd           = htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
			$kd_unit           = htmlspecialchars($post['kd_unit'], ENT_QUOTES);
			$perolehan         = htmlspecialchars($post['perolehan'], ENT_QUOTES);
			$dasar             = htmlspecialchars($post['dasar'], ENT_QUOTES);
			$no_oleh           = htmlspecialchars($post['no_oleh'], ENT_QUOTES);
			$tgl_oleh          = htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
			$thn_oleh          = htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
			$hrg_oleh          = htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
			$tgl_regis         = htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
			$sts_tanah         = htmlspecialchars($post['sts_tanah'], ENT_QUOTES);
			$kondisi           = htmlspecialchars($post['kondisi'], ENT_QUOTES);
			$no_sert           = htmlspecialchars($post['no_sert'], ENT_QUOTES);
			$tgl_sert          = htmlspecialchars($post['tgl_sert'], ENT_QUOTES);
			$luas              = htmlspecialchars($post['luas'], ENT_QUOTES);
			$alamat1           = htmlspecialchars($post['alamat1'], ENT_QUOTES);
			$alamat2           = htmlspecialchars($post['alamat2'], ENT_QUOTES);
			$alamat3           = htmlspecialchars($post['alamat3'], ENT_QUOTES);
			$latitude          = htmlspecialchars($post['latitude'], ENT_QUOTES);
			$longtitude        = htmlspecialchars($post['longtitude'], ENT_QUOTES);
			$keterangan        = htmlspecialchars($post['keterangan'], ENT_QUOTES);
			$penggunaan        = htmlspecialchars($post['penggunaan'], ENT_QUOTES);
			$detail            = htmlspecialchars($post['detail'], ENT_QUOTES);
			$sts               = htmlspecialchars($post['sts'], ENT_QUOTES);
			$upload            = htmlspecialchars($post['upload_sert'], ENT_QUOTES);
			$gambar1           = htmlspecialchars($post['gambar1'], ENT_QUOTES);
			$gambar2           = htmlspecialchars($post['gambar2'], ENT_QUOTES);
			$gambar3           = htmlspecialchars($post['gambar3'], ENT_QUOTES);
			$gambar4           = htmlspecialchars($post['gambar4'], ENT_QUOTES);
			$b_barat           = htmlspecialchars($post['b_barat'], ENT_QUOTES);
			$b_timur           = htmlspecialchars($post['b_timur'], ENT_QUOTES);
			$b_selatan         = htmlspecialchars($post['b_selatan'], ENT_QUOTES);
			$b_utara           = htmlspecialchars($post['b_utara'], ENT_QUOTES);
			$camat             = htmlspecialchars($post['camat'], ENT_QUOTES);
			$lurah             = htmlspecialchars($post['lurah'], ENT_QUOTES);
			$pemegang_hak      = htmlspecialchars($post['pemegang_hak'], ENT_QUOTES);
			$no_surat_ukur     = htmlspecialchars($post['no_surat_ukur'], ENT_QUOTES);
			$tgl_surat_ukur    = htmlspecialchars($post['tgl_surat_ukur'], ENT_QUOTES);
			$status_sertifikat = htmlspecialchars($post['status_sertifikat'], ENT_QUOTES);
			$fasilitas         = htmlspecialchars($post['fasilitas'], ENT_QUOTES);
			$ket_matriks       = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
			$kronologis        = htmlspecialchars($post['kronologis'], ENT_QUOTES);
			if($tgl_surat_ukur=='--'){
				$tgl_surat_ukur = '1009-01-01';
			}
			if ($tgl_sert=='--') {
				$tgl_sert = '1009-01-01';
			}
			 
		switch ($sts) {
			case 1:
				$query = "UPDATE transaksi.trkib_a SET  
						no_dokumen        = '$no_dokumen',
						kd_brg            = '$kd_barang',
						no_oleh           = '$no_oleh',
						tgl_oleh          = '$tgl_oleh',
						status_tanah      = '$sts_tanah',
						asal              = '$perolehan',
						dsr_peroleh       = '$dasar',
						no_sertifikat     = '$no_sert',
						tgl_sertifikat    = '$tgl_sert',
						luas              = '$luas',
						alamat1           = '$alamat1',
						alamat2           = '$alamat2',
						alamat3           = '$alamat3',
						keterangan        = '$keterangan',
						milik             = '$milik',
						wilayah           = '$wil',
						tahun             = '$thn_oleh',
						upload_sert       = '$upload',
						foto1             = '$gambar1',
						foto2             = '$gambar2',
						foto3             = '$gambar3',
						foto4             = '$gambar4',
						b_barat           = '$b_barat',
						b_timur           = '$b_timur',
						b_selatan         = '$b_selatan',
						b_utara           = '$b_utara',
						lat               = '$latitude',
						lon               = '$longtitude',
						penggunaan        = '$penggunaan',
						detail_brg        = '$detail',
						kd_skpd           = '$kd_skpd',
						kd_unit           = '$kd_unit',
						ket_matriks       = '$ket_matriks',
						kronologis        = '$kronologis',
						kd_camat          = '$camat',
						kd_lurah          = '$lurah',
						pemegang_hak      = '$pemegang_hak',
						surat_ukur        = '$no_surat_ukur',
						tgl_surat_ukur    = '$tgl_surat_ukur',
						status_fasilitas  = '$no_surat_ukur',
						status_sertifikat = '$status_sertifikat'
						WHERE id_lokasi   = '$id_barang'";
						// print_r($query); 
			 		// 	exit();
				break;
			
			default:
				$query = "UPDATE transaksi.trkib_a SET 
						tgl_reg           = '$tgl_regis',/*block*/
						no_dokumen        = '$no_dokumen',
						kd_brg            = '$kd_barang',
						no_oleh           = '$no_oleh',
						tgl_oleh          = '$tgl_oleh',
						status_tanah      = '$sts_tanah',
						kondisi           = '$kondisi',/*block*/
						asal              = '$perolehan',
						dsr_peroleh       = '$dasar',
						no_sertifikat     = '$no_sert',
						tgl_sertifikat    = '$tgl_sert',
						luas              = '$luas',
						nilai             = '$hrg_oleh',/*block*/
						alamat1           = '$alamat1',
						alamat2           = '$alamat2',
						alamat3           = '$alamat3',
						keterangan        = '$keterangan',
						milik             = '$milik',
						wilayah           = '$wil',
						tahun             = '$thn_oleh',
						upload_sert       = '$upload',
						foto1             = '$gambar1',
						foto2             = '$gambar2',
						foto3             = '$gambar3',
						foto4             = '$gambar4',
						b_barat           = '$b_barat',
						b_timur           = '$b_timur',
						b_selatan         = '$b_selatan',
						b_utara           = '$b_utara',
						lat               = '$latitude',
						lon               = '$longtitude',
						penggunaan        = '$penggunaan',
						detail_brg        = '$detail',
						kd_skpd           = '$kd_skpd',
						kd_unit           = '$kd_unit',
						ket_matriks       = '$ket_matriks',
						kronologis        = '$kronologis',
						kd_camat          = '$camat',
						kd_lurah          = '$lurah',
						pemegang_hak      = '$pemegang_hak',
						surat_ukur        = '$no_surat_ukur',
						tgl_surat_ukur    = '$tgl_surat_ukur',
						status_fasilitas  = '$no_surat_ukur',
						status_sertifikat = '$status_sertifikat'
						WHERE id_lokasi   = '$id_barang'";
				break;
		}
		
			
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

		$query = $this->db->where('kd_comp', $object['kd_comp'])
						->update('mcompany', $object);
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
					$query = "SELECT foto1,foto2,foto3,foto4,upload_sert as foto5 from transaksi.trkib_a where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query)->row_array();
					for ($i=1; $i <= 5; $i++) {
						if ($sql['foto'.$i]!='' || $sql['foto'.$i]!=null) {
							if (file_exists('./uploads/kibA/'.$sql['foto'.$i])) {
								$path1 ='./uploads/kibA/'.$sql['foto'.$i];
								unlink($path1);
							}
						}
					}
					$query = "DELETE from transaksi.trkib_a where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query);
				}
				 
				return 1; 
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}

	
	
	public function loadHeader($key1,$key2,$key3,$otori,$skpd) {
		$unit = $this->session->userdata['kd_unit'];
		$xkey1 ='';
		$xkey2 ='';
		$xkey3 ='';
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
		
		if($key1!=''){
			$xkey1 = "and (upper(b.uraian) like upper('%$key1%') or upper(a.detail_brg) like upper('%$key1%'))"; 
		}
		
		if($key2!=''){
			$xkey2 = "and (upper(a.tahun) like upper('%$key2%'))";	 
		}
		
		if($key3!=''){ //Sumber Dana / No Sertifikat / Luas / Penggunaan / Alamat / Tahun / Keterangan
			$xkey3 = "and (upper(g.cara_peroleh) like upper('%$key3%') or upper(a.no_sertifikat) like upper('%$key3%') or upper(a.luas) like upper('%$key3%') or upper(a.penggunaan) like upper('%$key3%') or upper(a.alamat1) like upper('%$key3%') or upper(a.keterangan) like upper('%$key3%') or a.nilai::text like '%$key3%')";	 
		}
		if($key1!='' || $key2!='' || $key3!=''){
			$where = "where a.no_reg!='' $kondisi $xkey1 $xkey2 $xkey3";	
		}
		
	// no_reg,nm_barang,merek,tahun,harga,keterangn	
		$sql = "SELECT count(*) as tot FROM transaksi.trkib_a a LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				LEFT JOIN public.mskpd c ON a.kd_skpd=c.kd_skpd 
				LEFT JOIN public.munit f ON a.kd_unit = f.kd_unit and a.kd_skpd=f.kd_skpd
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh $where" ;
				 // print_r($sql);exit();
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT a.*,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek, b.uraian as nm_rincian, b.uraian as nm_subrinci, c.nm_skpd,b.uraian nm_brg,f.nm_unit, g.cara_peroleh,a.detail_brg
				FROM transaksi.trkib_a a LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				LEFT JOIN public.mskpd c ON a.kd_skpd=c.kd_skpd 
				LEFT JOIN public.munit f ON a.kd_unit = f.kd_unit and a.kd_skpd=f.kd_skpd
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh $where 
				GROUP BY no_reg,id_barang,id_lokasi,tgl_reg,no_oleh,tgl_oleh,no_dokumen,status_tanah,kondisi,asal,dsr_peroleh,no_sertifikat,tgl_sertifikat,luas,nilai,alamat1,alamat2,alamat3,keterangan,milik,wilayah,a.kd_skpd,a.kd_unit,tahun,b.kd_brg,lat,lon,rincian_objek,sub_rincian_objek,nm_skpd,upload_sert,foto1,foto2,nm_rincian,nm_subrinci,nm_brg,nm_unit,penggunaan,detail_brg,sts,g.cara_peroleh
				$limit";
		//print_r($sql);
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
        	if($resulte['sts']=='1'){
        		$icon = "<div style='width: 0; height: 0; border-top: 13px solid #800000; border-right: 13px solid transparent;'></div>"; 
        	}else{
        		$icon = "<div style='width: 0; height: 0; border-top: 13px solid #90EE90; border-right: 13px solid transparent;'></div>"; 
        	} 

            $row[] = array(
				'id'                => $ii,        
				'no_reg'            => $resulte['no_reg'],
				'id_barang'         => $resulte['id_barang'],
				'id_lokasi'         => $resulte['id_lokasi'],
				'tgl_reg'           => $this->tanggal_ind($resulte['tgl_reg']),
				'no_oleh'           => $resulte['no_oleh'],
				'tgl_oleh'          => $this->tanggal_ind($resulte['tgl_oleh']),
				'no_dokumen'        => $resulte['no_dokumen'],
				'status_tanah'      => $resulte['status_tanah'],
				'kondisi'           => $resulte['kondisi'],
				'asal'              => $resulte['asal'],
				'dsr_peroleh'       => $resulte['dsr_peroleh'],
				'no_sertifikat'     => $resulte['no_sertifikat'],
				'tgl_sertifikat'    => $this->tanggal_ind($resulte['tgl_sertifikat']),
				'luas'              => $resulte['luas'],
				'nilai'             => number_format($resulte['nilai'],2),
				'alamat1'           => $resulte['alamat1'],
				'alamat2'           => $resulte['alamat2'],
				'alamat3'           => $resulte['alamat3'],
				'keterangan'        => $resulte['keterangan'],
				'milik'             => $resulte['milik'],
				'wilayah'           => $resulte['wilayah'],
				'kd_skpd'           => $resulte['kd_skpd'],
				'kd_unit'           => $resulte['kd_unit'],
				'tahun'             => $resulte['tahun'],
				'kd_brg'            => $resulte['kd_brg'],
				'lat'               => $resulte['lat'],
				'lon'               => $resulte['lon'],
				'rincian_objek'     => $resulte['rincian_objek'],
				'sub_rincian_objek' => $resulte['sub_rincian_objek'],
				'nm_skpd'           => $resulte['nm_skpd'],
				'upload_sert'       => $resulte['upload_sert'],
				'foto1'             => $resulte['foto1'],
				'foto2'             => $resulte['foto2'],
				'foto3'             => $resulte['foto3'],
				'foto4'             => $resulte['foto4'],
				'nm_rincian'        => $resulte['nm_rincian'],
				'nm_subrinci'       => $resulte['nm_subrinci'],
				'nm_brg'            => $resulte['nm_brg'],
				'nm_unit'           => $resulte['nm_unit'],
				'penggunaan'        => $resulte['penggunaan'],
				'detail_brg'        => $resulte['detail_brg'],
				'ket_matriks'       => $resulte['ket_matriks'],
				'b_barat'           => $resulte['b_barat'],
				'b_timur'           => $resulte['b_timur'],
				'b_selatan'         => $resulte['b_selatan'],
				'b_utara'           => $resulte['b_utara'],
				'kd_camat'          => $resulte['kd_camat'],
				'kd_lurah'          => $resulte['kd_lurah'],
				'pemegang_hak'      => $resulte['pemegang_hak'],
				'no_surat_ukur'     => $resulte['surat_ukur'],
				'tgl_surat_ukur'    => $this->tanggal_ind($resulte['tgl_surat_ukur']),
				'status_sertifikat' => $resulte['status_sertifikat'],
				'status_fasilitas'  => $resulte['status_fasilitas'],
				'kronologis'  		=> $resulte['kronologis'],
				'sts'               => $resulte['sts'],
				'icon'              => $icon,
				'sert'              => "<a><i class='fa fa-file-pdf-o' style='font-size:23px; color:red;' title='Sertifikat'></i><a/>",
				'img'               => "<i class='fa fa-file-image-o' onClick='getGambar()' style='font-size:23px; color:green;' title='Foto'></i>",
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
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg,c.kd_wilayah FROM transaksi.trd_isianbrg a join public.mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock 
		where left(a.kd_brg,5)='$kib' order by a.kd_skpd";
		} else {
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg,c.kd_wilayah FROM transaksi.trd_isianbrg a join public.mbarang b 
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
		return $query->result_array(); 
	}
	
	public function getCamat(){ 
		$query  = $this->db->query("SELECT kd_lokasi,nm_lokasi from mlokasi where upper(nm_lokasi) like '%KECAMATAN%'"); 
		return $query->result_array(); 
	}
	
	public function getLurah(){ 
		$camat = $this->input->post('qode');
		$query  = $this->db->query("SELECT kd_lokasi,nm_lokasi from mlokasi where left(kd_uker,2)='$camat' and upper(nm_lokasi) like '%KELURAHAN%'"); 
		return $query->result_array(); 
	}
	
	public function getFasilitas(){ 
		$query  = $this->db->query("SELECT id,fasilitas from status_fasilitas"); 
		return $query->result_array(); 
	}
	
	public function getSertifikat(){ 
		$query  = $this->db->query("SELECT id,status from status_sertifikat"); 
		return $query->result_array(); 
	}
	
	
	

	public function getRincian($lccq,$akun,$kel,$jenis){
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(uraian) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kd_brg,rincian_objek,uraian FROM public.mbarang 
					WHERE length(kd_brg)='11'and akun='$akun' 
					and kelompok='$kel' and jenis='$jenis' $key order by kd_brg ASC";
		$query  = $this->db->query($sql);
/* 		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_brg' => $key['kd_brg'],  
				'rincian' => $key['rincian_objek'],  
                'nm_bidang' => $key['uraian'],
			);
			$li++;
		} */
		return $query->result_array();
		//return $res;
		//$query->free_result();
	}
	
	public function getSubRincian($lccq,$akun,$kel,$jenis,$rincian){

		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(uraian) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kd_brg,sub_rincian_objek,uraian FROM public.mbarang 
					WHERE length(kd_brg)='14'and akun='$akun' and kelompok='$kel' and jenis='$jenis' and rincian_objek='$rincian' $key";
		$query  = $this->db->query($sql);
/* 		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'sub_rincian' => $key['kd_brg'],  
                'uraian' => $key['uraian'],
			);
			$li++;
		} */
		return $query->result_array() ;
		//return $res;
		//$query->free_result();
	}
	
	public function getKdbarang($lccr,$akun,$kel,$jenis,$subrinci){
		$sql	= "SELECT kd_brg,uraian FROM public.mbarang 
					WHERE length(kd_brg)='18'and akun='$akun' and kelompok='$kel' and jenis='$jenis' and LEFT(kd_brg,14)='$subrinci'
					AND (upper(kd_brg) like upper('%$lccr%') or upper(uraian) like upper('%$lccr%'))";
		$query  = $this->db->query($sql);
/* 		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_brg' => $key['kd_brg'],  
                'uraian' => $key['uraian'],
			);
			$li++;
		} */
		return $query->result_array();
		//return $res;
		//$query->free_result();
	}
	
	public function getMilik($lccq){
		$sql	= "SELECT kd_milik, nm_milik FROM mmilik order by kd_milik";
		$query  = $this->db->query($sql);
 
		return $query->result_array(); 
	}
	
	public function getWilayah($lccq){
		$sql	= "SELECT kd_wilayah, nm_wilayah FROM mwilayah";
		$query  = $this->db->query($sql);
/* 		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_wilayah' => $key['kd_wilayah'],  
                'nm_wilayah' => $key['nm_wilayah'],
			);
			$li++;
		} */
		return $query->result_array();
		//return $res;
		//$query->free_result();
	}
	
	public function getUnit(){
		$skpd = $this->input->post('kd_skpd');
		$sql	= "SELECT kd_lokasi as kd_unit,nm_lokasi as nm_unit FROM public.mlokasi WHERE left(kd_skpd,10)='$skpd' group by  kd_lokasi,nm_lokasi order by kd_lokasi";
		// print_r($sql); exit();
		$query  = $this->db->query($sql);
/* 		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_unit' => $key['kd_unit'],  
                'nm_unit' => $key['nm_unit'],
			);
			$li++;
		} */
		// return $sql;
		return $query->result_array();
		//return $res;
		//$query->free_result();
	}
	
	public function getOleh($lccq){
		$sql	= "SELECT kd_cr_oleh,trim(cara_peroleh)cara_peroleh FROM public.cara_peroleh ";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function getmatriks($lccq){
		$sql	= "SELECT id,ket_matriks FROM public.matriks ";
		$query  = $this->db->query($sql);
 
		return $query->result_array();
		 
	}
	
	public function getDasar($lccq){
		$sql	= "SELECT kode,trim(dasar_peroleh)dasar_peroleh FROM public.mdasar ";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getStatustanah($lccq){
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(status) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kode,status 
					FROM public.st_tanah $key group by kode,status
					order by kode ";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getKondisi($lccq){
		$sql	= "SELECT kode,kondisi FROM public.mkondisi order by kode ";
		$query  = $this->db->query($sql);
		/* $res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'			=> $li,
				'kode' 			=> $key['kode'],  
                'kondisi'		=> $key['kondisi'],
			);
			$li++;
		} */
		return $query->result_array();
		//return $res;
		//$query->free_result();
	}
	
	public function getKelompok()
	{
		$data = array();
		$sql = $this->db->select('kd_brg, uraian')
						->from('mbarang')
						->where('LENGTH(kd_brg)=','3')
						->get();			
		foreach ($sql->result_array() as $key) {
			$data[] = array(
				'kelompok'		=> $key['kd_brg'],
				'nm_kelompok'	=> $key['uraian']
			);
		}
		return $sql->result_array();
		//return $data;
		//$sql->free_result();
	}
	
	public function getJenis($param)
	{
		$kel  	= $param['kd'];
		$lccq 	= $param['lccq'];
		
		if ($kel != '') {
			$whr = "LEFT(kd_brg, 2) = '$kel' AND LENGTH(kd_brg)='5' AND ";
		} else {
			$whr = '';
		}				
		
		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE $whr (upper(kd_brg) like upper('%$lccq%') 
		or upper(uraian) like upper('%$lccq%')) order by kd_brg";
		$query = $this->db->query($sql);
/* 		$data = array();
		$li = 0;		
		foreach ($query->result_array() as $key) {
			$data[] = array(
				'id'		=> $li,
				'jenis'		=> $key['kd_brg'],
				'nm_jenis'	=> $key['uraian']
			);
			$li++;
		} */
		return $query->result_array();
		//return $data;
		//$sql->free_result();
	}

	public function getBarang($param)
	{
		$jen  	= $param['kd'];
		$lccq 	= $param['lccq'];

		if ($jen != '') {
			$whr = "LEFT(kd_brg, 3) = '$jen' AND LENGTH(kd_brg)='18' AND ";
		} else {
			$whr = '';
		}

		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE $whr (upper(kd_brg) like upper('%$lccq%') 
		or upper(uraian) like upper('%$lccq%')) ORDER BY kd_brg LIMIT 100 OFFSET 1";		
		$query = $this->db->query($sql);
	/* 	$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_brg' 	=> $key['kd_brg'],  
                'nm_brg' 	=> $key['uraian'] 
			);
			$li++;
		} */

		return $query->result_array();
		//return $res;
		//$query->free_result();
	}
	
	function max_number($kd_unit,$kd_barang){
		$proses = $this->db->query("SELECT MAX(left(no_reg,6)) AS nomor FROM transaksi.trkib_a where kd_unit='$kd_unit' and kd_brg='$kd_barang'")->row('nomor'); 
		if($proses=='null'){
			$hasil	= '0000001';
		}else{
			$hasil	= sprintf("%06d",intval($proses)+1);
		}
		
        return $hasil;
        $query1->free_result();
	}

	public function loadBarang($akun,$kel,$jenis,$key) {  
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
				and kelompok='$kel' and jenis='$jenis' and uraian <> 'Dst….'
				$where";
		// print_r($sql);
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM public.mbarang 
				WHERE length(kd_brg)='18'and akun='$akun' 
				and kelompok='$kel' and jenis='$jenis' and uraian <> 'Dst….'
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

}

/* End of file M_Pengadaan.php */
/* Location: ./application/models/perencanaan/M_Pengadaan.php */