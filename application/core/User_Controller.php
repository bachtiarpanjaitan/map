<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Controller extends CI_Controller {

	public function __construct() {
       parent::__construct();
			$this->load->helper('custom_helper');
			$this->load->helper('url');
			$this->load->model('muser');
			$this->load->library('session');
			$this->load->library('form_validation');
	    }

	public function viewlogin()
	{
		$data['error'] = "";
		$this->load->view('login', $data);
	}

	public function login(){
		$username = $this->input->post('Username');
		$password = $this->input->post('Password');
		$ajax = $this->input->post('ajax');
		$data['error'] = "";

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if(empty($username)){
			$data['error'] =  "Username Cannot Be Null, Please fill username.";
		}

		if(empty($password)){
			$data['error'] = "Can not Be Null, Please fill password.";
		}

		if ($this->form_validation->run() == FALSE){

			$user = $this->muser->getsingleuserdata(trim($username));
			// var_dump($user);
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
					$this->session->set_userdata(COL_FULLNAME, $user->fullname);
					$this->session->set_userdata(COL_ISSUSPEND, $user->issuspend);
					$this->session->set_userdata(COL_ISLOGIN, TRUE);
					if(!$ajax){
						redirect('', 'refresh');
					}else{
						successjson("OK",TRUE);
					}
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
}