<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'mobile_detect.php';

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_model');
		$this->load->library('upload');
		$this->load->library('email');
	}

	public function index(){
		$session = isset($_SESSION['isLogin']);
		if($session == FALSE)
		{
			$this->load->view('welcome_message');
		}else{
			if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
				$status = 'Super Admin';
			}elseif ($_SESSION['otori']==2) {
				$status = 'Admin';
			}else{
				$status = 'User';
			}
			$count = $this->db->query("SELECT count(id) as count from m_user WHERE status=1")->row_array();
			$a['count']	= $count['count'];
			$a['page']  = 'dashboard';
			$a['title'] = $_SESSION['nama_simbakda'];
			$a['icon']  = '';
			$a['level'] = $status;
			$this->load->view('main',$a);
		}
	}
	public function cek_stat(){
		$res = $this->db->where(array('id'=>$_SESSION['iduser'],'destroy'=>1))->get('m_user');
		if ($res->num_rows()>0) {
			$this->db->where(array('id'=>$_SESSION['iduser'],'destroy'=>1))->update('m_user',array('destroy'=>0));
			$this->logout();
			echo(1);
		}else{
			echo(0);
		}
	}
	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => md5($username),
			'password' => md5($password)
		);
		$cek = $this->M_model->cek_data("m_user",$where);
		if(count($cek) == 1 AND $username!=''){
			foreach ($cek as $cek) {
				$iduser        = $cek['id'];
				$nm_user       = $cek['nm_user'];
				$nama_simbakda = $cek['ket'];
				$otori         = $cek['oto'];
				$skpd          = $cek['skpd'];
				$unit_skpd     = $cek['unit_skpd'];
				$nama_admin    = $cek['nm_admin'];
				$ket    	   = $cek['ket'];
				$activity      = $cek['activity'];
			}
			$cek_skpd =$this->db->query("SELECT nm_skpd FROM ms_skpd WHERE kd_skpd = '$skpd'")->row();
			$cek_unit =$this->db->query("SELECT nm_lokasi FROM mlokasi WHERE kd_lokasi = '$unit_skpd'")->row();
			$data_session = array(
				'iduser'        => $iduser,
				'username'      => $username,
				'nm_user'       => $nm_user,
				'iduser'        => $iduser,
				'nama_simbakda' => $nama_simbakda,
				'otori'         => $otori,
				'skpd'          => $skpd,
				'nm_skpd'       => $cek_skpd->nm_skpd,
				'unit_skpd'     => $unit_skpd,
				'nm_unit'       => $cek_unit->nm_lokasi,
				'nama_admin'    => $nama_admin,
				'ket'    		=> $ket,
				'activity'    	=> $activity
			);
			$this->session->set_userdata($data_session);
			$this->db->query("UPDATE m_user set status='1' WHERE username=md5('$_SESSION[username]')");
			$where = array(
				'username' => $username,
				'password' => $password
			);
			$cek = $this->M_model->cek_data("user_temp",$where);
			$date =date('Y-m-d H:i:s');
			$data_insert = array(
				'username'   => $username,
				'password'   => $password,
				'nm_user'    => $nm_user,
				'oto'        => $otori,
				'ket'        => $ket,
				'kd_skpd'    => $skpd,
				'unit_skpd'  => $unit_skpd,
				'nm_admin'   => $nama_admin,
				'last_login' => $date
			);
			$data_update = array(
				'password'   =>$password,
				'last_login' =>$date
			);
			if(count($cek) == 1 AND $username!=''){
				$this->db->where('username',$_SESSION['username'])->update('user_temp',$data_update);
			}else{
				$this->db->insert('user_temp',$data_insert);
			}
			$_SESSION['isLogin']   = TRUE;
			if (date('H:i')>='01:00' && date('H:i')<='10:00') {
				$msg = 'Selamat Pagi';
			}elseif (date('H:i')>='10:01' && date('H:i')<='13:59') {
				$msg = 'Selamat Siang';
			}elseif (date('H:i')>='14:00' && date('H:i')<='18:00') {
				$msg = 'Selamat Sore';
			}else{
				$msg = 'Selamat Malam';
			}
			$data['msg'] = $msg;
			$data['ket'] = $_SESSION['ket'];
			$data['status'] = true;
		}else{
			$data['msg'] = "*User atau Password salah!";
			$data['ket'] = $_SESSION['ket'];
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	function logout(){
		$date =date('Y-m-d H:i:s');
		$this->db->query("UPDATE m_user set status='0' WHERE username=md5('$_SESSION[username]')");
		$this->db->query("UPDATE user_temp set last_logout='$date' WHERE username='$_SESSION[username]'");
		$this->session->sess_destroy();
		$detect = new Mobile_Detect();

		if ($detect->isMobile()) {
			redirect(base_url());
		}else{
			// redirect('http://103.134.73.15:8080/simbakda');
			redirect();
		}
	}
	function cek_password(){
		$password = $this->input->post('passlama');
		$where = array(
			'password' => md5($password),
			'username' => md5($_SESSION['username'])
		);
		$cek = $this->M_model->cek_data("m_user",$where);
		if(count($cek) == 1){
			echo "true";
		}
		else {
			echo "false";
		}
	}
	function simpan_password(){
		$passbaru    = $this->input->post('passbaru');
		$this->db->query("UPDATE user_temp set password='$passbaru' WHERE username='$_SESSION[username]'");
		$sql = $this->db->query("UPDATE m_user set password=md5('$passbaru') where username =md5('$_SESSION[username]')");
		$e = $this->db->error();
		if ($sql) {
			$data = array(
				'data_msg' => "Update Berhasil",
				'swal'	   => "success"
			);
		}else {

			$data = array(
				'data_msg' => "Gagal! (".$msg['code'].") ". $msg['message'],
				'swal'	   => "error"
			);
		}
		echo json_encode($data);
	}
	function get_skpd(){
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4) {
			$where="";
		}else{
			$where="WHERE kd_skpd='$_SESSION[skpd]'";
		}
		$data = $this->db->query("SELECT kd_skpd,nm_skpd FROM ms_skpd $where")->result();
		echo json_encode($data);
	}
	function get_unit(){
		$p = $this->input->post('kd_skpd');
		if ($_SESSION['otori']==1 OR $_SESSION['otori']==4 OR $_SESSION['otori']==2) {
			$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_skpd ='$p' order by kd_lokasi ASC")->result();
		}else if($p=='1.02.01.00'){
			$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE LEFT(kd_lokasi,11) ='$_SESSION[unit_skpd]' order by kd_lokasi ASC")->result();
		}else{
			$data = $this->db->query("SELECT kd_lokasi,nm_lokasi FROM mlokasi WHERE kd_lokasi ='$_SESSION[unit_skpd]' order by kd_lokasi ASC")->result();
		}
		echo json_encode($data);
	}

}
?>
