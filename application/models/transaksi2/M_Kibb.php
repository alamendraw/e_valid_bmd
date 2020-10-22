<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_kibb extends CI_Model {
	
	
	public function max_number($kode,$kd_unit){
		$skpd = $_SESSION['skpd'];
		// $kd_unit = $this->session->userdata['kd_unit'];
		$proses = $this->db->query("SELECT MAX(left(no_reg,6)) AS nomor FROM trkib_b_input where kd_unit='$kd_unit' and kd_brg='$kode'")->row('nomor');
		 
		if($proses=='null'){
			$hasil = '0000001';
		}else{
			$hasil	= sprintf("%06d",intval($proses)+1);
		}
        return $hasil;
        $proses->free_result();
	}
	
	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	
	public function loadHeader($key1,$key2,$key3,$otori,$skpd) { 
		$jns = $this->input->post('jns');
		if($jns=='aset'){
			$kond = 'a.nilai >= 300000';
		}else{ //eca
			$kond = 'a.nilai < 300000';
		}
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
		$where = 'where '.$kond.$kondisi;
		$limit = "ORDER BY a.tahun DESC,a.kd_brg,a.no_reg,b.uraian,a.tgl_reg ASC LIMIT $rows OFFSET $offset";

		if($key1!=''){
			$xkey1 = "and (upper(b.uraian) like upper('%$key1%') or upper(a.detail_brg) like upper('%$key1%'))"; 
		}
		
		if($key2!=''){
			$xkey2 = "and (upper(a.tahun) like upper('%$key2%'))";	 
		}
		
		if($key3!=''){ //Sumber dana / merek / no polisi / kondisi / keterangan / nilai
			$xkey3 = "and (upper(g.cara_peroleh) like upper('%$key3%') or upper(a.merek) like upper('%$key3%') or upper(a.no_polisi) like upper('%$key3%') or upper(a.kondisi) like upper('%$key3%') or upper(a.keterangan) like upper('%$key3%') or a.nilai::text like '%$key3%')";	 
		}
		if($key1!='' || $key2!='' || $key3!=''){
			$where = "where $kond $kondisi $xkey1 $xkey2 $xkey3";	
		}
		
		
		$sql = "SELECT count(*) as tot from trkib_b_input a
				LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg
				left join cara_peroleh g on a.asal=g.kd_cr_oleh $where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT a.*,left(b.kd_brg,8) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,
				b.uraian as nm_rincian, b.uraian as nm_subrinci,
				c.nm_skpd,b.uraian nm_brg,f.nm_unit, g.cara_peroleh
				FROM trkib_b_input a 
				LEFT JOIN mbarang b ON a.kd_brg=b.kd_brg
				LEFT JOIN mskpd c ON a.kd_skpd=c.kd_skpd 
				LEFT JOIN munit f ON a.kd_unit = f.kd_unit and a.kd_skpd=f.kd_skpd
				left join cara_peroleh g on a.asal=g.kd_cr_oleh
				$where 
				group by no_reg,id_lokasi,id_barang,tgl_reg,no_oleh,tgl_oleh,no_dokumen,kondisi,asal,dsr_peroleh,nilai,keterangan,milik,wilayah,a.kd_skpd,a.kd_unit,tahun,b.kd_brg,rincian_objek,sub_rincian_objek,nm_skpd,foto1,foto2,nm_rincian,nm_subrinci,nm_brg,nm_unit,merek,tipe,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,kd_ruang,tgl_stnk,no_bpkb,jumlah,tgl_bpkb,sts,g.cara_peroleh
				$limit";
		// print_r($sql); exit();	 
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
                'id_lokasi' 		=> $resulte['id_lokasi'],
                'id_barang' 		=> $resulte['id_barang'],
                'tgl_reg' 			=> $this->tanggal_ind($resulte['tgl_reg']),
                'no_oleh' 			=> $resulte['no_oleh'],
                'tgl_oleh' 			=> $this->tanggal_ind($resulte['tgl_oleh']),
                'no_dokumen'		=> $resulte['no_dokumen'],
                'kondisi' 			=> $resulte['kondisi'],
                'asal' 				=> $resulte['asal'],
                'dsr_peroleh' 		=> $resulte['dsr_peroleh'],
                'nilai' 			=> number_format($resulte['nilai'],2),
                'keterangan' 		=> $resulte['keterangan'],
                'milik' 			=> $resulte['milik'],
                'wilayah' 			=> $resulte['wilayah'],
                'kd_skpd' 			=> $resulte['kd_skpd'],
                'kd_unit' 			=> $resulte['kd_unit'],
                'tahun' 			=> $resulte['tahun'],
                'kd_brg'  			=> $resulte['kd_brg'],
                'rincian_objek' 	=> $resulte['rincian_objek'],
                'sub_rincian_objek'	=> $resulte['sub_rincian_objek'],
                'nm_skpd'			=> $resulte['nm_skpd'],
                'foto1'				=> $resulte['foto1'],
                'foto2'				=> $resulte['foto2'],
                'foto3'				=> $resulte['foto3'],
                'foto4'				=> $resulte['foto4'],
				'nm_rincian'		=> $resulte['nm_rincian'],
                'nm_subrinci'		=> $resulte['nm_subrinci'],
                'nm_brg'			=> $resulte['nm_brg'],
                'detail_brg'		=> $resulte['detail_brg'],
                'nm_unit'			=> $resulte['nm_unit'],
                'merek'				=> $resulte['merek'],
                'tipe'				=> $resulte['tipe'],
                'kd_warna'			=> $resulte['kd_warna'],
                'kd_bahan'			=> $resulte['kd_bahan'],
                'kd_satuan'			=> $resulte['kd_satuan'],
                'no_rangka'			=> $resulte['no_rangka'],
                'no_mesin'			=> $resulte['no_mesin'],
                'no_polisi'			=> $resulte['no_polisi'],
                'silinder'			=> $resulte['silinder'],
                'no_stnk'			=> $resulte['no_stnk'],
                'kd_ruang'			=> $resulte['kd_ruang'],
                'ket_matriks'		=> $resulte['ket_matriks'],
                'kronologis'		=> $resulte['kronologis'],
                'tgl_stnk'			=> $this->tanggal_ind($resulte['tgl_stnk']),
                'no_bpkb'			=> $resulte['no_bpkb'],
                'jumlah'			=> $resulte['jumlah'],
                'tgl_bpkb'			=> $this->tanggal_ind($resulte['tgl_bpkb']),
                'sts' 				=> $resulte['sts'],
                'icon' 				=> $icon,
            );
            $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result;
	  
	}
	
	
	public function loadBarang($akun,$kel,$jenis,$key,$rinci) {  
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
		
		$sql = "SELECT count(*) as tot FROM mbarang 
				WHERE length(kd_brg)='18' and left(kd_brg,8)='$rinci' and uraian <> 'Dst….'
				$where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kd_brg,uraian FROM mbarang 
				WHERE length(kd_brg)='18' and left(kd_brg,8)='$rinci' and uraian <> 'Dst….'
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

	function load_ruang($otori,$skpd) { 
		 
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = " ";
		$limit = "ORDER BY id_lokasi LIMIT $rows OFFSET $offset";
 
		
		$sql = "SELECT count(*) as tot FROM trkib_b_input a
				left join mruang b on a.kd_ruang=b.kd_ruang
				left join cara_peroleh c on a.asal=c.kd_cr_oleh $where" ;
			 
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT id_lokasi,no_reg,nm_brg,tahun,nilai,a.keterangan,a.kd_skpd,a.kd_unit,b.nm_ruang,
				merek,no_polisi,kondisi,detail_brg,cara_peroleh
				FROM trkib_b_input a
				left join mruang b on a.kd_ruang=b.kd_ruang
				left join cara_peroleh c on a.asal=c.kd_cr_oleh
				$where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte){ 
        	 
            $row[] = array(
                'id' 				=> $ii,        
                'id_lokasi' 			=> $resulte['id_lokasi'], 
                'no_reg' 			=> $resulte['no_reg'], 
                'nm_brg' 			=> $resulte['nm_brg'], 
                'tahun' 			=> $resulte['tahun'], 
                'nilai' 			=> number_format($resulte['nilai'],2), 
                'keterangan' 		=> $resulte['keterangan'], 
                'kd_skpd' 			=> $resulte['kd_skpd'], 
                'kd_unit' 			=> $resulte['kd_unit'], 
                'nm_ruang' 			=> $resulte['nm_ruang'], 
                'merek' 			=> $resulte['merek'], 
                'no_polisi' 		=> $resulte['no_polisi'], 
                'kondisi' 			=> $resulte['kondisi'], 
                'detail_brg' 		=> $resulte['detail_brg'], 
                'cara_peroleh' 		=> $resulte['cara_peroleh'], 
            );
            $ii++;
        }
	  	$result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result; 
	}
	
	
	function saveData($post){
		$sql='';
		$jns			= htmlspecialchars($post['jns'], ENT_QUOTES);
		// $no_reg			= htmlspecialchars($post['no_reg'], ENT_QUOTES);
		$no_dokumen 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
		$kd_brg		    = htmlspecialchars($post['kd_brg'], ENT_QUOTES);
		$milik 		    = htmlspecialchars($post['milik'], ENT_QUOTES);
		$wilayah 		= htmlspecialchars($post['wilayah'], ENT_QUOTES);
		$tahun		    = htmlspecialchars($post['tahun'], ENT_QUOTES);
		$kd_skpd 		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
		$kd_unit 		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
		$asal 			= htmlspecialchars($post['asal'], ENT_QUOTES);
		$dsr_peroleh	= htmlspecialchars($post['dsr_peroleh'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
		$nilai 		    = htmlspecialchars($post['nilai'], ENT_QUOTES);
		$merek 		    = htmlspecialchars($post['merek'], ENT_QUOTES);
		$tipe 			= htmlspecialchars($post['tipe'], ENT_QUOTES);
		$kd_warna 		= htmlspecialchars($post['kd_warna'], ENT_QUOTES);
		$kd_bahan 		= htmlspecialchars($post['kd_bahan'], ENT_QUOTES);
		$no_rangka 	    = htmlspecialchars($post['no_rangka'], ENT_QUOTES);
		$no_mesin 		= htmlspecialchars($post['no_mesin'], ENT_QUOTES);
		$no_polisi 	    = htmlspecialchars($post['no_polisi'], ENT_QUOTES);
		$no_stnk 		= htmlspecialchars($post['no_stnk'], ENT_QUOTES);
		$no_bpkb 		= htmlspecialchars($post['no_bpkb'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
		$keterangan 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
		$kd_ruang 		= htmlspecialchars($post['kd_ruang'], ENT_QUOTES);
		$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$satuan 		= htmlspecialchars($post['satuan'], ENT_QUOTES);
		$tgl_regis 	    = htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
		$tgl_bpkb 		= htmlspecialchars($post['tgl_bpkb'], ENT_QUOTES);
		$tgl_stnk 		= htmlspecialchars($post['tgl_stnk'], ENT_QUOTES);
		$gambar1		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
		$gambar2		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
		$gambar3		= htmlspecialchars($post['gambar3'], ENT_QUOTES);
		$gambar4		= htmlspecialchars($post['gambar4'], ENT_QUOTES);
		$ukuran			= htmlspecialchars($post['ukuran'], ENT_QUOTES);
		$detail			= htmlspecialchars($post['detail'], ENT_QUOTES);
		$nm_brg 		= $this->getNmBrg($kd_brg);
		$ket_matriks    = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
		$kronologis     = htmlspecialchars($post['kronologis'], ENT_QUOTES);

		$nm_user		= $this->session->userdata('nm_user');
		$update 		= date('Y-m-d h:m:s');
		// $total 			= $nilai * $jumlah; 
  		 
		if($tgl_bpkb=='--' || $tgl_bpkb==''){
			$tgl_bpkb='0001-01-01';
		}
		if($tgl_stnk=='--' || $tgl_stnk==''){
			$tgl_stnk='0001-01-01';
		}

		$auto= $this->getAuto();

		for ($x = 1; $x <= $jumlah; $x++) { 
			$no_reg 		= $this->max_number($kd_brg,$kd_unit);
			$id_bar 		= $kd_brg.'.'.$kd_unit.'.'.$tahun.'.'.$no_reg;
			$query = "INSERT INTO trkib_b_input(no_reg,id_lokasi,id_barang,no_oleh,tgl_reg,tgl_oleh,no_dokumen,kd_brg,nm_brg,nilai,asal,dsr_peroleh, merek, tipe, kd_warna, kd_bahan, kd_satuan,silinder,no_rangka, no_mesin,no_polisi, no_stnk,tgl_stnk, no_bpkb, tgl_bpkb, kondisi, keterangan,kd_ruang, kd_skpd, kd_unit, milik, wilayah, tahun,jumlah,foto1,foto2,foto3,foto4,jenis,username,tgl_update,total,auto,sts,detail_brg,ket_matriks,kronologis) 
			VALUES ('$no_reg','$id_bar','$id_bar', '$no_oleh', '$tgl_regis', '$tgl_oleh', '$no_dokumen', '$kd_brg','$nm_brg', '$nilai', '$asal', '$dsr_peroleh', '$merek', '$tipe', '$kd_warna','$kd_bahan', '$satuan','$ukuran','$no_rangka', '$no_mesin', '$no_polisi', '$no_stnk', '$tgl_stnk', '$no_bpkb', '$tgl_bpkb', '$kondisi', '$keterangan', '$kd_ruang', '$kd_skpd','$kd_unit', '$milik','$wilayah','$tahun','1','$gambar1','$gambar2','$gambar3','$gambar4','$jns','$nm_user','$update','$nilai','$auto','0','$detail','$ket_matriks','$kronologis')";
			 
			 $auto++ ;
			 // print_r($query); exit();
			$sql = $this->db->query($query); 
			$no_reg=sprintf("%06d",intval($no_reg)+1);
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
		$proses = $this->db->query("SELECT uraian from mbarang_new_modif where kd_brg='$kode'")->row('uraian');
		return $proses;
	}

	function getAuto(){
		$proses = $this->db->query("SELECT max(auto) as auto from trkib_b_input")->row('auto');
		if($proses=='' || $proses=='(Null)'){
			$hasil =1;
		}else{
			$hasil = $proses +1;
		}
		return $hasil;
	}
	
	function editData($post){
		$id_barang		= htmlspecialchars($post['id_barang'], ENT_QUOTES);
		$no_reg			= htmlspecialchars($post['no_reg'], ENT_QUOTES);
		$no_dokumen 	= htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
		$kd_brg		    = htmlspecialchars($post['kd_brg'], ENT_QUOTES);
		$milik 		    = htmlspecialchars($post['milik'], ENT_QUOTES);
		$wilayah 		= htmlspecialchars($post['wilayah'], ENT_QUOTES);
		$tahun		    = htmlspecialchars($post['tahun'], ENT_QUOTES);
		$kd_skpd 		= htmlspecialchars($post['kd_skpd'], ENT_QUOTES);
		$kd_unit 		= htmlspecialchars($post['kd_unit'], ENT_QUOTES);
		$asal 			= htmlspecialchars($post['asal'], ENT_QUOTES);
		$dsr_peroleh	= htmlspecialchars($post['dsr_peroleh'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh'], ENT_QUOTES);
		$nilai 		    = htmlspecialchars($post['nilai'], ENT_QUOTES);
		$merek 		    = htmlspecialchars($post['merek'], ENT_QUOTES);
		$tipe 			= htmlspecialchars($post['tipe'], ENT_QUOTES);
		$kd_warna 		= htmlspecialchars($post['kd_warna'], ENT_QUOTES);
		$kd_bahan 		= htmlspecialchars($post['kd_bahan'], ENT_QUOTES);
		$no_rangka 	    = htmlspecialchars($post['no_rangka'], ENT_QUOTES);
		$no_mesin 		= htmlspecialchars($post['no_mesin'], ENT_QUOTES);
		$no_polisi 	    = htmlspecialchars($post['no_polisi'], ENT_QUOTES);
		$no_stnk 		= htmlspecialchars($post['no_stnk'], ENT_QUOTES);
		$no_bpkb 		= htmlspecialchars($post['no_bpkb'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi'], ENT_QUOTES);
		$keterangan 	= htmlspecialchars($post['keterangan'], ENT_QUOTES);
		$kd_ruang 		= htmlspecialchars($post['kd_ruang'], ENT_QUOTES);
		$jumlah 		= htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$satuan 		= htmlspecialchars($post['satuan'], ENT_QUOTES);
		$tgl_regis 	    = htmlspecialchars($post['tgl_regis'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh'], ENT_QUOTES);
		$tgl_bpkb 		= htmlspecialchars($post['tgl_bpkb'], ENT_QUOTES);
		$tgl_stnk 		= htmlspecialchars($post['tgl_stnk'], ENT_QUOTES);
		$gambar1		= htmlspecialchars($post['gambar1'], ENT_QUOTES);
		$gambar2		= htmlspecialchars($post['gambar2'], ENT_QUOTES);
		$gambar3		= htmlspecialchars($post['gambar3'], ENT_QUOTES);
		$gambar4		= htmlspecialchars($post['gambar4'], ENT_QUOTES);
		$ukuran			= htmlspecialchars($post['ukuran'], ENT_QUOTES);
		$sts			= htmlspecialchars($post['sts'], ENT_QUOTES);
		$detail			= htmlspecialchars($post['detail'], ENT_QUOTES);
		$ket_matriks    = htmlspecialchars($post['ket_matriks'], ENT_QUOTES);
		$kronologis     = htmlspecialchars($post['kronologis'], ENT_QUOTES);
		
		// print_r($sts);exit();
		switch ($sts) {
			case 1:
				$query = "UPDATE trkib_b_input SET 
					no_oleh        = '$no_oleh',  
					tgl_oleh       = '$tgl_oleh',   
					asal           = '$asal', 
					dsr_peroleh    = '$dsr_peroleh', 
					merek          = '$merek', 
					tipe           = '$tipe', 
					kd_warna       = '$kd_warna',
					kd_bahan       = '$kd_bahan', 
					kd_satuan      = '$satuan',
					silinder       = '$ukuran',
					no_rangka      = '$no_rangka', 
		            no_mesin       = '$no_mesin', 
					no_polisi      = '$no_polisi', 
					no_stnk        = '$no_stnk', 
					tgl_stnk       = '$tgl_stnk', 
					no_bpkb        = '$no_bpkb', 
					tgl_bpkb       = '$tgl_bpkb', 
		            kondisi        = '$kondisi', 
					keterangan     = '$keterangan', 
					kd_ruang       = '$kd_ruang',
					jumlah         = '$jumlah', 
					milik          = '$milik',
					wilayah        = '$wilayah', 
					detail_brg     = '$detail', 
					foto1          = '$gambar1',
					foto2          = '$gambar2',
					foto3          = '$gambar3',
					foto4          = '$gambar4',
					kronologis     = '$kronologis',
					ket_matriks    = '$ket_matriks'
					WHERE id_lokasi='$id_barang'";
				break;
			
			default:
				$query = "UPDATE trkib_b_input SET 
					no_oleh        = '$no_oleh', 
					tgl_reg        = '$tgl_regis', 
					tgl_oleh       = '$tgl_oleh', 
					no_dokumen     = '$no_dokumen', 
		            kd_brg         = '$kd_brg', 
					nilai          = '$nilai', 
					asal           = '$asal', 
					dsr_peroleh    = '$dsr_peroleh', 
					merek          = '$merek', 
					tipe           = '$tipe', 
					kd_warna       = '$kd_warna',
					detail_brg     = '$detail', 
					kd_bahan       = '$kd_bahan', 
					kd_satuan      = '$satuan',
					silinder       = '$ukuran',
					no_rangka      = '$no_rangka', 
		            no_mesin       = '$no_mesin', 
					no_polisi      = '$no_polisi', 
					no_stnk        = '$no_stnk', 
					tgl_stnk       = '$tgl_stnk', 
					no_bpkb        = '$no_bpkb', 
					tgl_bpkb       = '$tgl_bpkb', 
		            kondisi        = '$kondisi', 
					keterangan     = '$keterangan', 
					kd_ruang       = '$kd_ruang',
					jumlah         = '$jumlah', 
					milik          = '$milik',
					wilayah        = '$wilayah',
		            tahun          = '$tahun',
					foto1          = '$gambar1',
					foto2          = '$gambar2',
					foto3          = '$gambar3',
					foto4          = '$gambar4',
					no_reg 			= '$no_reg',
					kd_skpd 		= '$kd_skpd',
					kd_unit 		= '$kd_unit',
					kronologis     = '$kronologis',
					ket_matriks    = '$ket_matriks'
					WHERE id_lokasi='$id_barang'";
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
	
	
	
	
	function simpan($post){
		$kode 			= htmlspecialchars($post['no_reg		'], ENT_QUOTES);
		$nama 			= htmlspecialchars($post['no_dokumen	'], ENT_QUOTES);
		$kdbrg 			= htmlspecialchars($post['kd_brg		'], ENT_QUOTES);
		$tgl_regis 		= htmlspecialchars($post['tgl_regis		'], ENT_QUOTES);
		$tgl_oleh 		= htmlspecialchars($post['tgl_oleh		'], ENT_QUOTES);
		$milik 			= htmlspecialchars($post['milik			'], ENT_QUOTES);
		$wilayah 		= htmlspecialchars($post['wilayah		'], ENT_QUOTES);
		$tahun 			= htmlspecialchars($post['tahun			'], ENT_QUOTES);
		$skpd 			= htmlspecialchars($post['kd_skpd		'], ENT_QUOTES);
		$unit 			= htmlspecialchars($post['kd_unit		'], ENT_QUOTES);
		$asal 			= htmlspecialchars($post['asal			'], ENT_QUOTES);
		$dsr_peroleh 	= htmlspecialchars($post['dsr_peroleh	'], ENT_QUOTES);
		$no_oleh 		= htmlspecialchars($post['no_oleh		'], ENT_QUOTES);
		$nilai_oleh 	= htmlspecialchars($post['nilai			'], ENT_QUOTES);
		$merek 			= htmlspecialchars($post['merek			'], ENT_QUOTES);
		$tipe 			= htmlspecialchars($post['tipe			'], ENT_QUOTES);
		$kd_warna 		= htmlspecialchars($post['kd_warna		'], ENT_QUOTES);
		$kd_bahan 		= htmlspecialchars($post['kd_bahan		'], ENT_QUOTES);
		$no_rangka 		= htmlspecialchars($post['no_rangka		'], ENT_QUOTES);
		$no_mesin 		= htmlspecialchars($post['no_mesin		'], ENT_QUOTES);
		$no_polisi 		= htmlspecialchars($post['no_polisi		'], ENT_QUOTES);
		$no_stnk 		= htmlspecialchars($post['no_stnk		'], ENT_QUOTES);
		$tgl_stnk 		= htmlspecialchars($post['tgl_stnk		'], ENT_QUOTES);
		$no_bpkb 		= htmlspecialchars($post['no_bpkb		'], ENT_QUOTES);
		$tgl_bpkb 		= htmlspecialchars($post['tgl_bpkb		'], ENT_QUOTES);
		$kondisi 		= htmlspecialchars($post['kondisi		'], ENT_QUOTES);
		$keterangan		= htmlspecialchars($post['keterangan	'], ENT_QUOTES);
		$kd_ruang 		= htmlspecialchars($post['kd_ruang		'], ENT_QUOTES);
		
		try {
			$sql=$this->db->query("INSERT INTO trkib_b_input(
            no_reg, id_barang, no, no_oleh, tgl_reg, tgl_oleh, no_dokumen, 
            kd_brg, nm_brg, detail_brg, nilai, asal, dsr_peroleh, jumlah, 
            total, merek, tipe, pabrik, kd_warna, kd_bahan, kd_satuan, no_rangka, 
            no_mesin, no_polisi, silinder, no_stnk, tgl_stnk, no_bpkb, tgl_bpkb, 
            kondisi, tahun_produksi, dasar, no_sk, tgl_sk, keterangan, no_mutasi, 
            tgl_mutasi, no_pindah, tgl_pindah, no_hapus, tgl_hapus, 
            kd_lokasi2, kd_skpd, kd_unit, milik, wilayah, username, tgl_update, 
            tahun, foto1, foto2, foto3, foto4, foto5, no_urut, metode, masa_manfaat, 
            nilai_sisa, kd_riwayat, tgl_riwayat, detail_riwayat, kd_pemilik) VALUES ('$kode','', '', '$no_oleh', '$tgl_regis', '$tgl_oleh', '$nama', 
            '$kdbrg', '', '', $nilai_oleh, '$asal', '$dsr_peroleh', 1, 
            $nilai_oleh, '$merek', '$tipe', '', '$kd_warna', '$kd_bahan', '', '$no_rangka', 
            '$no_mesin', '$no_polisi', '', '$no_stnk', '$tgl_stnk', '$no_bpkb', '$tgl_bpkb', 
            '$kondisi', '', '', '', '0000-00-00', '$keterangan', '', 
            '0000-00-00', '', '0000-00-00', '', '0000-00-00',  
            '', '$skpd', '$unit', '$milik', '$wilayah', '', '0000-00-00', 
            '$tahun', '', '', '', '', '', '', '', '', 
            '', '', '0000-00-00', '', '')");
			if($sql){
				return 1;
			}else{
				return 0;
			}
		}catch (Exception $e) {
			return 0;
		}
		
	}
	
	function ubah($post){
		$kode = htmlspecialchars($post['no_reg'], ENT_QUOTES);
		$nama = htmlspecialchars($post['no_dokumen'], ENT_QUOTES);
		try{
			$sql = $this->db->query("update trkib_b_input set no_reg='$kode' where no_dokumen='$nama'");
			return 1;
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
					$query = "SELECT foto1,foto2,foto3,foto4 from trkib_b_input where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query)->row_array();
					for ($i=1; $i <= 4; $i++) {
						if ($sql['foto'.$i]!='' || $sql['foto'.$i]!=null) {
							if (file_exists('./uploads/kibB/'.$sql['foto'.$i])) {
								$path1 ='./uploads/kibB/'.$sql['foto'.$i];
								unlink($path1);
							}
						}
					}
					$query = "DELETE from trkib_b_input where id_lokasi='$val' and sts!='1'";
					$sql = $this->db->query($query);
				}
				 
				return 1; 
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function prosesPindah($post){
		$kode = htmlspecialchars($post['kode'], ENT_QUOTES);
		$ruang = htmlspecialchars($post['ruang'], ENT_QUOTES);
		$ex	  = explode("#", $kode);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){ 
					$query = "update trkib_b_input set kd_ruang='$ruang' where id_lokasi='$val'";
					$sql = $this->db->query($query); 
				}
			
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
	public function getDokumen($kib){
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		if($otori == '01'){
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg, kd_wilayah FROM transaksi.trd_isianbrg a join mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock 
		where left(a.kd_brg,5)='$kib' order by a.kd_skpd";
		} else {
		$sql	= "SELECT a.*,c.tahun,left(b.kd_brg,11) rincian_objek,left(b.kd_brg,14) sub_rincian_objek,b.uraian nm_brg, kd_wilayah FROM transaksi.trd_isianbrg a join mbarang b 
		on a.kd_brg=b.kd_brg 
		join transaksi.trh_isianbrg c on a.kd_skpd=c.kd_skpd and a.no_dokumen=c.no_dokumen and a.id_lock=c.id_lock
		WHERE  left(a.kd_brg,5)='$kib' and c.kd_skpd = '$skpd' order by a.kd_skpd";
		}
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getSkpd($lccq){
		$otori = $this->session->userdata['oto'];
		$skpd = $this->session->userdata['kd_skpd'];
		$key='';
		if($lccq!=''){
        	$key ="where upper(kd_skpd) like upper('%$lccq%') or upper(nm_skpd) like upper('%$lccq%')";
        }
		if($otori == '01'){
		$sql	= "SELECT kd_skpd,nm_skpd FROM mskpd $key order by kd_skpd";
		} else {
		$sql	= "SELECT kd_skpd,nm_skpd FROM mskpd WHERE kd_skpd = '$skpd' order by kd_skpd";
		}
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_skpd' => trim($key['kd_skpd']),  
				'nm_skpd' => $key['nm_skpd'],  
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
				FROM msatuan $key ORDER BY kd_satuan";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_satuan' => trim($key['kd_satuan']),  
                'nm_satuan' => $key['nm_satuan'],
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

		$sql	= "SELECT kd_brg,rincian_objek,objek,uraian FROM mbarang 
					WHERE length(kd_brg)='8' and akun='$akun' 
					and kelompok='$kel' and jenis='$jenis' and objek<>'' $key order by kd_brg ASC";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getSubRincian($lccq,$akun,$kel,$jenis,$rincian){
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(uraian) like upper('%$lccr%')"; 
        }

		$sql	= "SELECT kd_brg,sub_rincian_objek,uraian FROM mbarang 
					WHERE length(kd_brg)='14'and akun='$akun' 
					and kelompok='$kel' and jenis='$jenis' and rincian_objek='$rincian' $key and objek<>'' and rincian_objek=''";
		$query  = $this->db->query($sql);
		return $query->result_array() ;
	}
	
	public function getKdbarang($lccr,$akun,$kel,$jenis,$subrinci){
		$sql	= "SELECT kd_brg,uraian FROM mbarang 
					WHERE length(kd_brg)='18'and akun='$akun' 
					and kelompok='$kel' and jenis='$jenis' and rincian_objek='$subrinci'
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
		$key='';
		if($lccq!=''){
        	$key ="and upper(nm_lokasi) like upper('%$lccq%') or upper(kd_lokasi) like upper('%$lccq%')"; 
        }
		$sql	= "SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_skpd='$skpd' $key order by kd_lokasi";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_unit' => trim($key['kd_lokasi']),  
                'nm_unit' => trim($key['nm_lokasi']),
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getRuang($lccq,$skpd){

		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="and upper(kd_ruang) 
				like upper('%$lccq%') or upper(nm_ruang) like upper('%$lccq%')"; 
        }
 
		$sql	= "SELECT kd_ruang,nm_ruang FROM mruang WHERE kd_skpd='$skpd' $key order by kd_ruang"; 
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
		$sql	= "SELECT kd_cr_oleh,trim(cara_peroleh)cara_peroleh FROM cara_peroleh ";
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
		$sql	= "SELECT id,ket_matriks FROM matriks ";
		$query  = $this->db->query($sql);
 
		return $query->result_array();
		 
	}
	public function getDasar($lccq){
		$sql	= "SELECT kode,trim(dasar_peroleh)dasar_peroleh FROM mdasar ";
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
	
	public function getWarna($lccq){
        $lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_warna) like '%$lccr%'"; 
        }

		$sql	= "SELECT kd_warna, nm_warna 
					FROM mwarna $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_warna' => $key['kd_warna'],  
                'nm_warna' => $key['nm_warna'],
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
		$sql	= "SELECT kode, kondisi FROM mkondisi";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kode' => $key['kode'],  
                'kondisi' => $key['kondisi'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
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

?>