<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Controller extends CI_Controller {

	public function __construct() {
       parent::__construct();
			$this->load->helper('custom_helper');
			$this->load->helper('url');
			$this->load->model('muser');
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->helper(array('form', 'url'));
		$resp = "";
		}
		
		public function deleteuser(){
			$id = $this->input->post('username');
			if(empty($id)){
				$resp['success'] = false;
				$resp['message'] = 'User belum dipilih';
				echo json_encode($resp);
				return;
			}
	
			$result = $this->muser->deleteuser($id);
			if($result){
				$resp['success'] = true;
				$resp['message'] = 'Data berhasil Dihapus';
			}else{
				$resp['success'] = false;
				$resp['message'] = 'Data gagal dihapus';
			}
			echo json_encode($resp);
		}

		public function saveorder(){
			$fullname = $this->input->post('fullname');
			$email = $this->input->post('email');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$remarks = $this->input->post('remarks');
			$unitid = $this->input->post('unitid');
			$edit = false;
			if(!empty($fullname) && !empty($phone) && !empty($email)){
				$exist = $this->muser->unithasbooking($unitid);
				if(count($exist) > 0){
					$edit = true;
				}

				$data = array(
					'fullname' => $fullname,
					'email' => $email,
					'address' => $address,
					'phone' => $phone,
					'remarks' => $remarks,
					'unitid' => $unitid
				);

				if(!$edit){
					$save = $this->muser->savebook($data);
					$dataunit = array(
						'statusid' => STATUS_ONBOOKING
					);

					$this->muser->updateunitstatus($dataunit, $unitid);

				}else{
					$save = $this->muser->updatebook($data, $exist[0]['bookid']);
				}

				if($save){
					$resp['success'] = true;
				}else{
					$resp['success'] = false;
					$resp['message'] = "Data Gagal Disimpan";
				}
			}else{
				$resp['success'] = false;
				$resp['message'] = "Lengkapi data yang diperlukan";
			}
			echo json_encode($resp);
		}

		public function getorder(){
			$id = $this->input->post('id');
			if(!empty($id)){
				$resp['book'] = $this->muser->getunit($id);
			}

			echo json_encode($resp);
		}

		public function editunit(){
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$description = $this->input->post('description');

			$data = array(
				'unittitle' => $title,
				'unitdescription' => $description
			);
			$save = $this->muser->updateunit($data, $id);
			
			if($save){
				$resp['success'] = true;
			}else{
				$resp['success'] = false;
				$resp['message'] = "Data Gagal Disimpan";
			}

			echo json_encode($resp);
		}

		public function saveunit(){
			$coords = $this->input->post('unitcoords');
			$title = $this->input->post('unittitle');
			$description = $this->input->post('unitdescription');
			$edit = $this->input->post('edit');
			$id = $this->input->post('unitid');
			if(!empty($coords) && !empty($title)){
				$data = array(
					'unitcoords' => $coords,
					'unittitle' => $title,
					'unitdescription' => $description,
				);

				if(!$edit){
					$data['statusid'] = STATUS_ALLOWORDER;
					$save = $this->muser->saveunit($data);
				}else{
					$save = $this->muser->updateunit($data,$id);
				}

				if($save){
					$resp['success'] = true;
				}else{
					$resp['success'] = false;
					$resp['message'] = "Data Gagal Disimpan";
				}
			}else{
				$resp['success'] = false;
				$resp['message'] = "Lengkapi data yang diperlukan";
			}
			echo json_encode($resp);
		}

		public function deleteunit(){
			$id = $this->input->post('unitid');
			if(empty($id)){
				$resp['success'] = false;
				$resp['message'] = 'Unit belum dipilih';
				echo json_encode($resp);
				return;
			}
	
			$result = $this->munit->deleteunit($id);
			if($result){
				$resp['success'] = true;
				$resp['message'] = 'Data berhasil Dihapus';
			}else{
				$resp['success'] = false;
				$resp['message'] = 'Data gagal dihapus';
			}
			echo json_encode($resp);
		}

		public function changepassword(){
			$cpassword = $this->input->post('cpassword');
			$password = $this->input->post('password');
			$user = $this->muser->getsingleuserdata(getuserlogin('username'));
			if(md5($cpassword) != $user->password){
				$resp['message'] = "Password aktif yang anda masukkan tidak dikenali, masukkan password sekarang.";
				$resp['success'] = false;
				echo json_encode($resp);
				return;
			}
			if(!empty($password)){
				$data = array(
					'password' => md5($password)
				);
				$res = $this->muser->updateuser($data, getuserlogin('username'));
				if($res){
					$resp['success'] = true;
				}else{
					$resp['success'] = false;
					$resp['message'] = "Password Gagal Disimpan";
				}
			}
			echo json_encode($resp);
		}

}