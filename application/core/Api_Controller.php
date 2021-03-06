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
			$title = $this->input->post('unittitle');
			$description = $this->input->post('unitdescription');
			$blokid = $this->input->post('blokid');
			$edit = $this->input->post('edit');
			$id = $this->input->post('unitid');
			if(!empty($title)){
				$data = array(
					'unittitle' => $title,
					'blokid' => $blokid,
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
		public function saveblok(){
			$blokname = $this->input->post('blokname');
			$coords = $this->input->post('coords');
			$dormitoryclass = $this->input->post('dormitoryclass');
			$parentblokid = $this->input->post('parentblokid');
			$edit = $this->input->post('edit');
			$id = $this->input->post('blokid');
			$dormitory = $this->input->post('dormitory');
			if(!empty($blokname)){
				$data = array(
					'blokname' => $blokname,
					'parentblokid' => $parentblokid,
					'blokcoords' => $coords,
					'dormitoryclass' => $dormitoryclass,
					'dormitory' => $dormitory
				);

				if(!$edit){
					$save = $this->muser->saveblok($data);
				}else{
					$save = $this->muser->updateblok($data,$id);
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

		public function deleteblok(){
			$id = $this->input->post('id');
			if(empty($id)){
				$resp['success'] = false;
				$resp['message'] = 'Unit belum dipilih';
				echo json_encode($resp);
				return;
			}
	
			$result = $this->muser->deleteblok($id);
			if($result){
				$resp['success'] = true;
				$resp['message'] = 'Data berhasil Dihapus';
			}else{
				$resp['success'] = false;
				$resp['message'] = 'Data gagal dihapus';
			}
			echo json_encode($resp);
		}

		public function getunit(){
			$id = $this->input->post('blokid');

			if(!empty($id)){
				$result = $this->muser->getunits($id);
				if($result){
					$resp['success'] = true;
					$resp['data'] = $result;
				}else{
					$resp['success'] = false;
				}
			}

			echo json_encode($resp);

		}

		function uploadimage(){
			$filename = $this->input->post('base64');
			if(!empty($filename)){
				$image_parts = explode(";base64,", $filename);
				$image_type_aux = explode("image/", $image_parts[0]); 
				$image_type = $image_type_aux[1];  
				$image_base64 = base64_decode($image_parts[1]);
				$name = uniqid() . '.'.$image_type;
				$file = realpath('assets/request').'/'.$name ;
				file_put_contents($file, $image_base64);
				$data = array(
					'filename' => $name,
					'realpath' => $file,
					'success' => true
				);
				
			}else{
				$data = array('success' => false);
			}
			echo json_encode($data);
		}
		
		function saverequestdetail(){
			$requesttypeid = $this->input->post('requesttypeid');
			$unittypeid = $this->input->post('unittypeid');
			$blokid = $this->input->post('blokid');
			$unitid = $this->input->post('unitid');
			$telepon = $this->input->post('telepon');
			$username = $this->input->post('username');
			$checkindate = $this->input->post('checkindate');
			$checkoutdate = $this->input->post('checkoutdate');
			$images = $this->input->post('images');
			$edit = $this->input->post('edit');
			$id = $this->input->post('id');

			if(!empty($requesttypeid) && !empty($unittypeid) && !empty($blokid) && !empty($unitid)){
				$data = array(
					'requesttypeid' => $requesttypeid,
					'username' => !empty($username)?$username: getuserlogin('username'),
					'unittypeid' => $unittypeid,
					'blokid' => $blokid,
					'checkindate' => $checkindate,
					'checkoutdate' => $checkoutdate,
					'unitid' => $unitid,
					'createdby' => getuserlogin('username'),
				);

				if($requesttypeid == REQUESTTYPE_NEW){
						$data['marriagecertificate'] = $images;
				}else{
					$data['image_maintenance'] = $images;
				}

				if(!$edit){
					$save = $this->muser->saverequestdetail($data);
				}else{
					$data['updatedby'] = getuserlogin('username');
					$save = $this->muser->updaterequestdetail($data,$id);
				}

				if($save){
					$resp['success'] = true;
				}else{
					$resp['success'] = false;
					$resp['message'] = "Data Gagal Disimpan";
				}

			}else{
				$resp['success'] = false;
				$resp['message'] = "Silahkan Masukkan data yang dibutuhkan";
			}
			echo json_encode($resp);

		}

		public function deleterequestdetail(){
			$id = $this->input->post('id');
			if(empty($id)){
				$resp['success'] = false;
				$resp['message'] = 'Request belum dipilih';
				echo json_encode($resp);
				return;
			}
	
			$result = $this->muser->deleterequest($id);
			if($result){
				$resp['success'] = true;
				$resp['message'] = 'Data berhasil Dihapus';
			}else{
				$resp['success'] = false;
				$resp['message'] = 'Data gagal dihapus';
			}
			echo json_encode($resp);
		}

		public function approverequest(){
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			if(empty($id)){
				$resp['success'] = false;
				$resp['message'] = 'Request belum dipilih';
				echo json_encode($resp);
				return;
			}

			$selectedrequest = $this->muser->getwhererequest($id, true)[0];
			$currentuser = $this->muser->getuser(getuserlogin('username'));
			$selectedrequest['approvedstatusid'] = $status;
			$selectedrequest['approvedby'] = getuserlogin('username');
			$selectedrequest['approveddate'] = date('Y-m-d H:i:s');

			$unit = $this->muser->getunits($id);
			if(!empty($unit)){
				if($unit->statusid != 1){
					$resp['success'] = false;
					$resp['message'] = 'Tidak dapat Order Unit ini karena status '. $unit->statusname;
					echo json_encode($resp);
					return;
				}
			}

			$bookuser = $this->muser->getuser($selectedrequest['username']);
			// var_dump($bookuser);
			$data = array(
				'unitid' => $selectedrequest['unitid'],
				'fullname' => $bookuser->fullname,
				'email' => $bookuser->email,
				'phone' => $bookuser->telepon,
				'remarks' => 'Has Approved Request'
			);

			$result = $this->muser->savebook($data);
			if($currentuser->allowapproverequest == 1){
				$result = $this->muser->updaterequestdetail($selectedrequest,$id);
				if($result){
					$resp['success'] = true;
					$resp['message'] = 'Data berhasil Disimpan';
				}else{
					$resp['success'] = false;
					$resp['message'] = 'Data gagal disimpan';
				}
			}else{
				$resp['success'] = false;
				$resp['message'] = 'Anda tidak diizinkan approve request.';
			}
			
			echo json_encode($resp);
		}

		function savemaintenance(){
			$requesttypeid = $this->input->post('requesttypeid');
			$unitid = $this->input->post('unitid');
			$username = $this->input->post('username');
			$description = $this->input->post('description');
			$images = $this->input->post('images');
			$edit = $this->input->post('edit');
			$id = $this->input->post('id');

			if(!empty($requesttypeid) && !empty($unitid) ){
				$username = $username?$username:getuserlogin('username');
				$unit = $this->muser->getuserunit($username, $unitid)[0];
				if($unit > 0 || $unit != null){
					$data = array(
						'requesttypeid' => $requesttypeid,
						'username' => $username ,
						'unittypeid' => $unit['unittypeid'],
						'blokid' => $unit['blokid'],
						'unitid' => $unitid,
						'description' => $description,
						'image_maintenance' => $images,
						'createdby' => getuserlogin('username'),
					);

					if(!$edit){
						$save = $this->muser->saverequestdetail($data);
					}else{
						$data['updatedby'] = getuserlogin('username');
						$save = $this->muser->updaterequestdetail($data,$id);
					}

					if($save){
						$resp['success'] = true;
					}else{
						$resp['success'] = false;
						$resp['message'] = "Data Gagal Disimpan";
					}
				}else{
					$resp['success'] = false;
					$resp['message'] = 'User tidak memiliki Unit dan Sudah di Approve';
				}
				
			}
			
			echo json_encode($resp);
		}

		function getuserunit(){
			$username = $this->input->post('username');
			if(!empty($username)){
				$resp['data'] = $this->muser->getwhererequests(true, $username);
			}else{
				$resp['data'] = $this->muser->getwhererequests(true, getuserlogin('username'));
			}

			$resp['success'] = true;
			echo json_encode($resp);
			
		}

		function getunitperblok()
		{
			$blokid = $this->input->post('blokid');
			if(!empty($blokid)){
				$resp['data'] = $this->muser->getunitwhereblok($blokid);
				$resp['count'] = count($resp['data']);
				$resp['success'] = true;
			}else{
				$resp['success'] = false;
			}
			echo json_encode($resp);

		}
		

}