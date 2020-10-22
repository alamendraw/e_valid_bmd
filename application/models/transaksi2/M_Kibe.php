<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kibe extends CI_Model {

	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	function saveData($post){
			$no_regis		= htmlspecialchars($post['no_regis'], ENT_QUOTES);
			$no_dokumen 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
			$pilih 			= htmlspecialchars($post['pilih'], ENT_QUOTES);
			$rincian 		= htmlspecialchars($post['rincian'], ENT_QUOTES);
			$sub_rincian 	= htmlspecialchars($post['sub_rincian'], ENT_QUOTES);
			$kd_barang 		= htmlspecialchars($post['kd_barang'], ENT_QUOTES);
			$milik 			= htmlspecialchars($post['milik'], ENT_QUOTES);
			$wil 			= htmlspecialchars($post['wil'], ENT_QUOTES);
			$kd_skpd 		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
			$kd_unit 		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
			$perolehan 		= htmlspecialchars($post['perolehan'], ENT_QUOTES);
			$dasar 			= htmlspecialchars($post['dasar'], ENT_QUOTES);
			$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
			$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
			$thn_oleh 		= htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
			$hrg_oleh 		= htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
			$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
			$tgl_regis 		= htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
			$judul 			= htmlspecialchars($post['judul'], ENT_QUOTES);
			$penerbit 		= htmlspecialchars($post['penerbit'], ENT_QUOTES);
			$spesifikasi	= htmlspecialchars($post['spesifikasi'], ENT_QUOTES);
			$asal 			= htmlspecialchars($post['asal'], ENT_QUOTES);
			$pencipta 	    = htmlspecialchars($post['pencipta'], ENT_QUOTES);
			$jenis	 	    = htmlspecialchars($post['jenis'], ENT_QUOTES);
			$ukuran 		= htmlspecialchars($post['ukuran'], ENT_QUOTES);
			$tahun_terbit 	= htmlspecialchars($post['tahun_terbit'], ENT_QUOTES);
			$satuan 		= htmlspecialchars($post['satuan'], ENT_QUOTES);
			$bahan 			= htmlspecialchars($post['bahan'], ENT_QUOTES);
			$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
			$latitude 		= htmlspecialchars($post['latitude'], ENT_QUOTES);
			$longtitude 	= htmlspecialchars($post['longtitude'], ENT_QUOTES);
			$keterangan 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
			$ruangan 		= htmlspecialchars($post['ruangan'], ENT_QUOTES);
			$gambar1		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
			$gambar2		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
			$gambar3		= htmlspecialchars($post['gambar3'], ENT_QUOTES);
			$gambar4		= htmlspecialchars($post['gambar4'], ENT_QUOTES);
			$user 			= $this->session->userdata('nm_user');
			$detail			= htmlspecialchars($post['detail'], ENT_QUOTES);
			$auto 			= $this->getAuto();
			$nm_brg 		= $this->getNmBrg($kd_barang);
			$ket_matriks    = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);

			if($pilih=='aset'){
				$jnsEca = '1';
			}else{
				$jnsEca = '2';
			}
			for ($x = 1; $x <= $jumlah; $x++) {
			$id_barang 		= $kd_barang.'.'.$kd_unit.'.'.$thn_oleh.'.'.$no_regis;
			$query = "INSERT INTO transaksi.trkib_e(
					no_reg,tgl_reg,id_barang,id_lokasi,no_dokumen,kd_brg,no_oleh,tgl_oleh,kondisi,asal,peroleh,dsr_peroleh,
					judul, penerbit,spesifikasi,cipta,kategori,tahun_terbit,kd_satuan,kd_bahan,tipe,
					nilai,jumlah,keterangan,milik,wilayah,kd_skpd,kd_unit,tahun,foto1,foto2,foto3,foto4,lat,lon,kd_ruang,total,username,tgl_update,auto,jenis,sts,nm_brg,detail_brg,ket_matriks)
					VALUES('$no_regis','$tgl_regis','$id_barang','$id_barang','$no_dokumen',
					'$kd_barang','$no_oleh','$tgl_oleh','$kondisi','$asal','$perolehan','$dasar','$judul','$penerbit',
					'$spesifikasi','$pencipta','$jenis','$tahun_terbit','$satuan','$bahan','$ukuran',
					'$hrg_oleh','1','$keterangan','$milik','$wil','$kd_skpd','$kd_unit','$thn_oleh','$gambar1',
					'$gambar2','$gambar3','$gambar4','$latitude','$longtitude','$ruangan','$hrg_oleh','$user',CURRENT_TIMESTAMP,'$auto','$jnsEca','0','$nm_brg','$detail','$ket_matriks')";
// print_r($query); 
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
		$proses = $this->db->query("SELECT max(auto) as auto from transaksi.trkib_e")->row('auto');
		if($proses=='' || $proses==NULL){
			return '1';
		}else{
			return $proses +1;
		}
	}
	
	function editData($post){ 
		$id_lokasi			= htmlspecialchars($post['id_lokasi'], ENT_QUOTES);
		$no_regis		= htmlspecialchars($post['no_regis'], ENT_QUOTES);
		$no_dokumen 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
		$rincian 		= htmlspecialchars($post['rincian'], ENT_QUOTES);
		$sub_rincian 	= htmlspecialchars($post['sub_rincian'], ENT_QUOTES);
		$kd_barang 		= htmlspecialchars($post['kd_barang'], ENT_QUOTES);
		$milik 			= htmlspecialchars($post['milik'], ENT_QUOTES);
		$wil 			= htmlspecialchars($post['wil'], ENT_QUOTES);
		$kd_skpd 		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
		$kd_unit 		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
		$perolehan 		= htmlspecialchars($post['perolehan'], ENT_QUOTES);
		$dasar 			= htmlspecialchars($post['dasar'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
		$thn_oleh 		= htmlspecialchars($post['thn_oleh'], ENT_QUOTES);
		$hrg_oleh 		= htmlspecialchars($post['hrg_oleh'], ENT_QUOTES);
		$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$tgl_regis 		= htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
		$judul 			= htmlspecialchars($post['judul'], ENT_QUOTES);
		$penerbit 		= htmlspecialchars($post['penerbit'], ENT_QUOTES);
		$spesifikasi	= htmlspecialchars($post['spesifikasi'], ENT_QUOTES);
		$asal 			= htmlspecialchars($post['asal'], ENT_QUOTES);
		$pencipta 	    = htmlspecialchars($post['pencipta'], ENT_QUOTES);
		$jenis	 	    = htmlspecialchars($post['jenis'], ENT_QUOTES);
		$ukuran 		= htmlspecialchars($post['ukuran'], ENT_QUOTES);
		$tahun_terbit 	= htmlspecialchars($post['tahun_terbit'], ENT_QUOTES);
		$satuan 		= htmlspecialchars($post['satuan'], ENT_QUOTES);
		$bahan 			= htmlspecialchars($post['bahan'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
		$latitude 		= htmlspecialchars($post['latitude'], ENT_QUOTES);
		$longtitude 	= htmlspecialchars($post['longtitude'], ENT_QUOTES);
		$keterangan 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
		$detail 		= htmlspecialchars($post['detail'], ENT_QUOTES);
		$sts 			= htmlspecialchars($post['sts'], ENT_QUOTES);
		$ruangan 		= htmlspecialchars($post['ruangan'], ENT_QUOTES);
		$gambar1		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
		$gambar2		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
		$gambar3		= htmlspecialchars($post['gambar3'], ENT_QUOTES);
		$gambar4		= htmlspecialchars($post['gambar4'], ENT_QUOTES);
		$ket_matriks    = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
		
		switch ($sts) {
			case 1:
				$query = "UPDATE transaksi.trkib_e SET  
					no_oleh         =  '$no_oleh',
					detail_brg      =  '$detail',
					tgl_oleh     	=  '$tgl_oleh',
					kondisi         =  '$kondisi',
					peroleh  		=  '$perolehan',
					asal	        =  '$asal',
					dsr_peroleh     =  '$dasar',
					judul           =  '$judul',
					penerbit        =  '$penerbit',
					spesifikasi     =  '$spesifikasi',
					cipta           =  '$pencipta',
					kategori        =  '$jenis',
					tahun_terbit    =  '$tahun_terbit',
					kd_satuan       =  '$satuan',
					kd_bahan        =  '$bahan',
					tipe            =  '$ukuran', 
					keterangan      =  '$keterangan',
					milik           =  '$milik',
					wilayah         =  '$wil', 
					foto1           =  '$gambar1',
					foto2           =  '$gambar2',
					foto3           =  '$gambar3',
					foto4           =  '$gambar4',
					lat             =  '$latitude',
					lon             =  '$longtitude',
					ket_matriks     =  '$ket_matriks',
					kd_ruang        =  '$ruangan'
					WHERE id_lokasi='$id_lokasi'";
			break;
			
			default:
				$query = "UPDATE transaksi.trkib_e SET 
					tgl_reg			=  '$tgl_regis', 
					no_oleh         =  '$no_oleh',
					detail_brg      =  '$detail',
					tgl_oleh     	=  '$tgl_oleh',
					kondisi         =  '$kondisi',
					peroleh 		=  '$perolehan',
					asal	        =  '$asal',
					dsr_peroleh     =  '$dasar',
					judul           =  '$judul',
					penerbit        =  '$penerbit',
					spesifikasi     =  '$spesifikasi',
					cipta           =  '$pencipta',
					kategori        =  '$jenis',
					tahun_terbit    =  '$tahun_terbit',
					kd_satuan       =  '$satuan',
					kd_bahan        =  '$bahan',
					tipe            =  '$ukuran',
					nilai           =  '$hrg_oleh',
					jumlah          =  '$jumlah',
					keterangan      =  '$keterangan',
					milik           =  '$milik',
					wilayah         =  '$wil',
					tahun           =  '$thn_oleh',
					foto1           =  '$gambar1',
					foto2           =  '$gambar2',
					foto3           =  '$gambar3',
					foto4           =  '$gambar4',
					lat             =  '$latitude',
					lon             =  '$longtitude',
					ket_matriks     =  '$ket_matriks',
					kd_ruang        =  '$ruangan'
					WHERE id_lokasi='$id_lokasi'";
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
	
	
	function load_ruang($otori,$skpd) { 
		 
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = " ";
		$limit = "ORDER BY id_lokasi LIMIT $rows OFFSET $offset";
 
		
		$sql = "SELECT count(*) as tot FROM transaksi.trkib_e a
				left join public.mruang b on a.kd_ruang=b.kd_ruang
				left join public.cara_peroleh c on a.asal=c.kd_cr_oleh $where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT id_lokasi,no_reg,nm_brg,tahun,nilai,a.keterangan,a.kd_skpd,a.kd_unit,b.nm_ruang,
				c.cara_peroleh,a.cipta,a.penerbit,kondisi,judul
				FROM transaksi.trkib_e a
				left join public.mruang b on a.kd_ruang=b.kd_ruang
				left join public.cara_peroleh c on a.asal=c.kd_cr_oleh
				$where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte){ 
        	 
            $row[] = array(
                'id' 				=> $ii,        
                'id_lokasi' 		=> $resulte['id_lokasi'], 
                'no_reg' 			=> $resulte['no_reg'], 
                'nm_brg' 			=> $resulte['nm_brg'], 
                'tahun' 			=> $resulte['tahun'], 
                'nilai' 			=> number_format($resulte['nilai'],2), 
                'keterangan' 		=> $resulte['keterangan'], 
                'kd_skpd' 			=> $resulte['kd_skpd'], 
                'kd_unit' 			=> $resulte['kd_unit'], 
                'nm_ruang' 			=> $resulte['nm_ruang'],  
                'cara_peroleh' 		=> $resulte['cara_peroleh'], 
                'cipta' 			=> $resulte['cipta'], 
                'penerbit' 			=> $resulte['penerbit'], 
                'kondisi' 			=> $resulte['kondisi'], 
                'judul' 			=> $resulte['judul'], 
            );
            $ii++;
        }
	  	$result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result; 
	}
	
	
	function hapus($post){
		$kode = htmlspecialchars($post['id_lokasi'], ENT_QUOTES);
		$ex	  = explode("#", $kode);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$query = "SELECT foto1,foto2,foto3,foto4 from transaksi.trkib_e where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query)->row_array();
					for ($i=1; $i <= 4; $i++) {
						if ($sql['foto'.$i]!='' || $sql['foto'.$i]!=null) {
							if (file_exists('./uploads/kibE/'.$sql['foto'.$i])) {
								$path1 ='./uploads/kibE/'.$sql['foto'.$i];
								unlink($path1);
							}
						}
					}
					$query = "DELETE from transaksi.trkib_e where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query);
				}
			
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}

	public function loadHeader($key1,$key2,$key3){
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		$jenis = $this->input->post('jenis');
		if($jenis=='aset'){
			$jenisEca = "a.jenis='1'";
		}else{
			$jenisEca = "a.jenis='2'";
		}
		$unit = $this->session->userdata['kd_unit'];
		if($otori=='01'){
			$kondisi = "";
		}else{
			$kondisi = "and a.kd_skpd='$skpd' and a.kd_unit='$unit'";
		}
		$xkey1 ='';
		$xkey2 ='';
		$xkey3 ='';
		 
			$result = array();
			$row = array();
			$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
			$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
			$offset = ($page-1)*$rows;
			$where = "where ".$jenisEca.$kondisi;
			$limit = "ORDER BY a.tahun DESC,a.kd_brg,a.no_reg,b.uraian,a.tgl_reg ASC LIMIT $rows OFFSET $offset";
			if($key1!=''){
				$xkey1 = "and (upper(b.uraian) like upper('%$key1%') or upper(a.detail_brg) like upper('%$key1%'))"; 
			}
			
			if($key2!=''){
				$xkey2 = "and (upper(a.tahun) like upper('%$key2%'))";	 
			}
			
			if($key3!=''){ //perolehan / sumber dana / ciptaan / penerbit / bahan / kondisi / keterangan / nilai / judul
				$xkey3 = "and (upper(g.cara_peroleh) like upper('%$key3%') or upper(a.peroleh) like upper('%$key3%') or upper(a.cipta) like upper('%$key3%') or upper(a.penerbit) like upper('%$key3%') or upper(a.kondisi) like upper('%$key3%') or upper(a.keterangan) like upper('%$key3%') or upper(a.judul) like upper('%$key3%') or a.nilai::text like '%$key3%')";	 
			}
			if($key1!='' || $key2!='' || $key3!=''){
				$where = "where $jenisEca $kondisi $xkey1 $xkey2 $xkey3";	
			}
			
			$sql = "SELECT count(*) as tot from transaksi.trkib_e a 
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh  $where" ;
 // print_r($sql); exit();
			$query1 = $this->db->query($sql);
			$total = $query1->row();
			
			$sql = "SELECT a.id_barang,a.id_lokasi,a.detail_brg,a.no_reg,a.tgl_reg,a.no_oleh,a.tgl_oleh,a.no_dokumen,a.kondisi,a.dsr_peroleh,a.peroleh,a.judul,a.penerbit,a.spesifikasi,a.asal,a.cipta,a.jenis,a.tahun_terbit,a.kd_satuan,a.kd_bahan,a.tipe,a.nilai,a.jumlah,a.keterangan,a.milik,a.wilayah,a.kd_skpd,a.kd_unit,a.tahun,a.kd_brg,a.lat,a.lon,a.kd_ruang,a.foto1,a.foto2,a.foto3,a.foto4,a.sts,a.kategori,left(b.kd_brg,8) rincian_objek,left(b.kd_brg,14) sub_rincian_objek, b.uraian as nm_rincian, c.nm_skpd,b.uraian nm_brg,f.nm_unit,a.ket_matriks
				FROM transaksi.trkib_e a 
				LEFT JOIN public.mbarang b ON a.kd_brg=b.kd_brg
				LEFT JOIN public.mskpd c ON a.kd_skpd=c.kd_skpd 
				LEFT JOIN public.munit f ON a.kd_unit = f.kd_unit and a.kd_skpd=f.kd_skpd
				left join public.cara_peroleh g on a.asal=g.kd_cr_oleh $where 
				GROUP BY no_reg,id_barang,id_lokasi,a.kd_brg,a.ket_matriks,tgl_reg,no_oleh,tgl_oleh,no_dokumen,kondisi,dsr_peroleh,peroleh,judul,penerbit,spesifikasi,asal,cipta,a.jenis,kategori,tahun_terbit,kd_satuan,kd_bahan,tipe,nilai,jumlah,keterangan,milik,wilayah,a.kd_skpd,a.kd_unit,tahun,b.kd_brg,lat,lon,rincian_objek,sub_rincian_objek,nm_skpd,kd_ruang,foto1,foto2,foto3,foto4,nm_rincian,nm_brg,nm_unit,sts,detail_brg
				$limit";
// print_r($sql);
			$query1 = $this->db->query($sql);  
			$result = array();
			$ii = 0;
			foreach($query1->result_array() as $resulte){
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
					'kondisi' 			=> $resulte['kondisi'],
					'dsr_peroleh' 		=> $resulte['dsr_peroleh'],
					'peroleh' 			=> $resulte['peroleh'],
					'judul'				=> $resulte['judul'],
					'penerbit'			=> $resulte['penerbit'],
					'spesifikasi'		=> $resulte['spesifikasi'],
					'asal'				=> $resulte['asal'],
					'cipta'				=> $resulte['cipta'],
					'jenis'				=> $resulte['jenis'],
					'kategori'			=> $resulte['kategori'],
					'tahun_terbit'		=> $resulte['tahun_terbit'],
					'kd_satuan'			=> $resulte['kd_satuan'],
					'kd_bahan'			=> $resulte['kd_bahan'],
					'tipe'				=> $resulte['tipe'],
					'nilai' 			=> number_format($resulte['nilai'],2),
					'jumlah' 			=> $resulte['jumlah'],
					'keterangan' 		=> $resulte['keterangan'],
					'milik' 			=> $resulte['milik'],
					'wilayah' 			=> $resulte['wilayah'],
					'kd_skpd' 			=> $resulte['kd_skpd'],
					'kd_unit' 			=> $resulte['kd_unit'],
					'tahun' 			=> $resulte['tahun'],
					'kd_brg'  			=> $resulte['kd_brg'],
					'lat'  				=> $resulte['lat'],
					'lon'  				=> $resulte['lon'],
					'rincian_objek' 	=> $resulte['rincian_objek'],
					'nm_skpd'			=> $resulte['nm_skpd'],
					'kd_ruang'			=> $resulte['kd_ruang'],
					'foto1'				=> $resulte['foto1'],
					'foto2'				=> $resulte['foto2'],
					'foto3'				=> $resulte['foto3'],
					'foto4'				=> $resulte['foto4'],
					'nm_rincian'		=> $resulte['nm_rincian'],
					'nm_brg'			=> $resulte['nm_brg'],
					'nm_unit'			=> $resulte['nm_unit'],
	                'sts' 				=> $resulte['sts'],
	                'detail_brg'		=> $resulte['detail_brg'],
	                'ket_matriks'		=> $resulte['ket_matriks'],
	                'icon' 				=> $icon,
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
				'kd_skpd' => $key['kd_skpd'],  
				'nm_skpd' => $key['nm_skpd'],  
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function loadBarang($akun,$kel,$jenis,$rinci,$key) {  
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
				WHERE length(kd_brg)='18' and akun='$akun' 
				and kelompok='$kel' and jenis='$jenis' and left(kd_brg,8)='$rinci' and uraian not like '%Dst….%'
				$where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM public.mbarang 
				WHERE length(kd_brg)='18'and akun='$akun' 
				and kelompok='$kel' and jenis='$jenis' and left(kd_brg,8)='$rinci' and uraian not like '%Dst….%'
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
	
	public function getRincian($lccq,$akun,$kel,$jenis){

		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(uraian) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kd_brg,left(kd_brg,8) rincian_objek,uraian FROM public.mbarang 
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
				'kd_wilayah' => $key['kd_wilayah'],  
                'nm_wilayah' => $key['nm_wilayah'],
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
				'kd_unit' => $key['kd_unit'],  
                'nm_unit' => $key['nm_unit'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	function prosesPindah($post){
		$kode = htmlspecialchars($post['kode'], ENT_QUOTES);
		$ruang = htmlspecialchars($post['ruang'], ENT_QUOTES);
		$ex	  = explode("#", $kode);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){ 
					$query = "update transaksi.trkib_e set kd_ruang='$ruang' where id_lokasi='$val'";
					$sql = $this->db->query($query); 
				}
			
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}

	public function getRuang($lccq,$skpd,$unit){
		$skpd = $this->session->userdata('kd_skpd');
		$sql	= "SELECT kd_ruang,nm_ruang 
        FROM public.mruang 
        WHERE kd_skpd='$skpd' 
        order by kd_ruang";
        
        //and kd_unit='$unit' 
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_ruang' => $key['kd_ruang'],  
                'nm_ruang' => $key['nm_ruang'],
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
	
	public function getBahan($lccq){
        $lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_bahan) like '%$lccr%'"; 
        }

		$sql	= "SELECT kd_bahan, nm_bahan 
		FROM mbahan $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_bahan' => $key['kd_bahan'],  
                'nm_bahan' => $key['nm_bahan'],
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
	
	public function max_number($tahun,$unit,$kd_brg){
		$query1 = $this->db->query("SELECT COALESCE(MAX(CAST(no_reg as int)),0) as nomor 
		FROM transaksi.trkib_e WHERE kd_unit='$unit' and kd_brg='$kd_brg'");  
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