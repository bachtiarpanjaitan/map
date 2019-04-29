<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Controller extends CI_Controller {

	public function __construct() {
       parent::__construct();
			$this->load->helper('custom_helper');
			$this->load->helper('url');
			$this->load->model('muser');
			$this->load->model('munit');
			$this->load->library('session');
			$this->load->library('form_validation');
			$resp = "";
	}

	public function viewlogin()
	{
		$data['error'] = "";
		$this->load->view('login', $data);
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data['error'] = "";

		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if(empty($username)){
			$data['error'] =  "Username Cannot Be Null, Please fill username.";
		}

		if(empty($password)){
			$data['error'] = "Password Can not Be Null, Please fill password.";
		}

		if ($this->form_validation->run() == true){
			$user = $this->muser->getsingleuserdata(trim($username));
			if($user){
				$issuspend = $user->issuspend;
				if($issuspend){
					$data['error'] = "The User Not Active";
				}

				$cpass = $user->password;
				$md5pass = md5($password);
				if($md5pass == $cpass){
					// $session = array(
					// 	COL_USERNAME =>$user->username,
					// 	COL_EMAIL => $user->email,
					// 	COL_ROLEID => $user->roleid,
					// 	COL_FULLNAME => $user->fullname,
					// 	COL_ISSUSPEND => $user->issuspend,
					// 	ISLOGIN => true
					// );
					$this->session->set_userdata(COL_USERNAME, $user->username);
					$this->session->set_userdata(COL_EMAIL, $user->email);
					$this->session->set_userdata(COL_ROLEID, $user->roleid);
					$this->session->set_userdata(COL_LEVELID, $user->levelid);
					$this->session->set_userdata(COL_FULLNAME, $user->fullname);
					$this->session->set_userdata(COL_ISSUSPEND, $user->issuspend);
					$this->session->set_userdata('blokid', $user->blokid);
					$this->session->set_userdata('allowapproverequest', $user->allowapproverequest);
					$this->session->set_userdata('telepon', $user->telepon);
					$this->session->set_userdata(COL_ISLOGIN, TRUE);
					redirect('', 'refresh');
				}else{
					$data['error'] = "Your Password do not match.";
					$this->load->view('login', $data);
				}
			}else{
				$data['error'] = "Cannot Identifing this user.";
				$this->load->view('login', $data);
			}
		}else{
			$this->load->view('login', $data);
		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('user/viewlogin');
	}

	public function register(){
		$this->load->view('register');
	}

	public function adduser(){
		$data['roles'] = $this->muser->getroles();
		$data['level'] = $this->muser->getlevels();
		$data['bloks'] = $this->muser->getbloks();
		$data['edit'] = false;
		$this->load->view('user/adduser',$data);
	}

	public function saveuser(){
		$username = $this->input->post('username');
		$fullaname = $this->input->post('fullname');
		$email = $this->input->post('email');
		$level = $this->input->post('level');
		$role = $this->input->post('role');
		$telepon = $this->input->post('telepon');
		$issuspend = $this->input->post('issuspend');
		$blok = $this->input->post('blok');
		$edit = $this->input->post('edit');

		if(!empty($fullaname) && !empty($email) && !empty($level) && !empty($role) && !empty($telepon)){
			$checkusername = $this->muser->checkuserexist($username);
			if($checkusername && !$edit){
				$resp['success'] = false;
				$resp['message'] = "Username sudah pernah digunakan";
				echo json_encode($resp);
				return false;
			}

			if($edit){
				$data = array(
					'fullname' => $fullaname,
					'email' => $email,
					'levelid' => $level,
					'roleid' => $role,
					'telepon' => $telepon,
					'password' => md5($username),
					'issuspend' => $issuspend,
					'blokid' => $blok
				);
			}else{
				$data = array(
					'username' => $username,
					'fullname' => $fullaname,
					'email' => $email,
					'levelid' => $level,
					'roleid' => $role,
					'telepon' => $telepon,
					'password' => md5($username),
					'issuspend' => $issuspend,
					'blokid' => $blok
				);
			}
			if($edit){
				$result = $this->muser->updateuser($data,$username);
			}else{
				$result = $this->muser->saveuser($data);
			}
			if($result){
				$resp['success'] = true;
				$resp['message'] = "Data Berhasil Disimpan";
			}else{
				$resp['success'] = false;
				$resp['message'] = "Data Gagal Disimpan";
			}
		}

		echo json_encode($resp);
	}

	function userlist(){
		$data['users'] = $this->muser->getuserinherit();
		$this->load->view('user/userlist',$data);
	}

	function useredit($username){
		if(!empty($username)){
			$data['edit'] = true;
			$data['user'] = $this->muser->getuser($username);
			$data['roles'] = $this->muser->getroles();
			$data['level'] = $this->muser->getlevels();
			$data['bloks'] = $this->muser->getbloks();
			$this->load->view('user/adduser', $data);
		}
	}

	function addunit(){
		$data['edit'] = false;
		$data['bloks'] = $this->muser->getbloks();
		$this->load->view('user/addunit',$data);
	}

	function editunit($id){
		if(!empty($id)){
			$data['edit'] = true;
			$data['unit'] = $this->muser->getwhereunit($id);
			$data['bloks'] = $this->muser->getbloks();
			$this->load->view('user/addunit',$data);
		}
	}

	function unitlist(){
		$data['units'] = $this->munit->getdataunits();
		$this->load->view('user/unitlist',$data);
	}

	function bloklist(){
		$data['bloks'] = $this->munit->getdatabloks();
		$this->load->view('user/bloklist',$data);
	}

	function changepassword(){
		$this->load->view('user/changepassword');
	}
	function addblok(){
		$data['edit'] = false;
		$this->load->view('user/addblok', $data);
	}
	function blokedit($id){
		if(!empty($id)){
			$data['edit'] = true;
			$data['blok'] = $this->muser->getwhereblok($id);
			$this->load->view('user/addblok',$data);
		}
	}

	function addrequest(){
		$data['edit'] = false;
		$data['bloks'] = $this->muser->getbloks();
		$data['users'] = $this->muser->getuser();
		$data['requesttypes'] = $this->muser->getrequesttype();
		$data['unittypes'] = $this->muser->getunittype();
		$this->load->view('user/newrequest',$data);
	}

	function addrequestunit(){
		$data['edit'] = false;
		$this->load->view('user/requestunit', $data);
	}

	function listrequestdetail(){
		$data['requests'] = $this->muser->getrequest();
		$this->load->view('user/requestdetaillist',$data);
	}

	function editrequestdetail($id){
		if(!empty($id)){
			$data['edit'] = true;
			$data['bloks'] = $this->muser->getbloks();
			$data['users'] = $this->muser->getuser();
			$data['requesttypes'] = $this->muser->getrequesttype();
			$data['unittypes'] = $this->muser->getunittype();
			$data['request'] = $this->muser->getwhererequest($id)[0];
			// var_dump($data);
			$this->load->view('user/newrequest',$data);
		}
	}

	function approvallist(){
		$data['status'] = $this->muser->getapprovalstatus();
		$data['requests'] = $this->muser->getrequest();
		$this->load->view('user/requestapprovallist',$data);
	}
}
