<?php

class Muser extends CI_Model{
	

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getuserdata($id = '',$array = false, $role = ""){
		if(!empty($id)){
			$this->db->where(COL_USERNAME, $id);
		}
		if(!empty($role)){
			$this->db->where(COL_ROLEID, ROLE_USER);
		}
		if($array){
			$data = $this->db->get(TBL_USERS)->result_array();
		}else{
			$data = $this->db->get(TBL_USERS)->result();
		}
		return $data;
	}

	public function getsingleuserdata($id){
		if(!empty($id)){
			$this->db->where(TBL_USERS.'.'.COL_USERNAME, $id);
			$this->db->join('userinformations ui','ui.'. COL_USERNAME.' = '. TBL_USERS.'.'.COL_USERNAME, 'inner');
			$data = $this->db->get(TBL_USERS)->row();
			if($data){
				return $data;
			}
			
		}
	}

	public function getroles(){
		return $this->db->get(TBL_ROLES)->result_array();
	}

	public function saveuser($data){
		if(!empty($data)){
			$this->db->insert(TBL_USERS, $data);
			return true;
		}else{
			return false;
		}
	}

	public function saveuserinformation($data){
		if(!empty($data)){
			$this->db->insert('userinformations', $data);
			return true;
		}else{
			return false;
		}
	}

	public function updateuser($data,$id){
		if(!empty($data) && !empty($id)){
			$this->db->where(COL_USERNAME, $id);
			$this->db->update(TBL_USERS, $data);
			return true;
		}else{
			return false;
		}
	}
	public function updateuserinformation($data,$id){
		if(!empty($data) && !empty($id)){
			$this->db->where(COL_USERNAME, $id);
			$this->db->update('userinformations', $data);
			return true;
		}else{
			return false;
		}
	}

	public function getalluser(){
		$this->db->join('userinformations ui','ui.'. COL_USERNAME.' = '. TBL_USERS.'.'.COL_USERNAME, 'inner');
		$this->db->join(TBL_BRANCHES, TBL_BRANCHES.'.'.COL_BRANCHID.' = '.'ui.'.COL_BRANCHID, 'left' );
		return $this->db->get(TBL_USERS)->result_array();
	}

	public function saveemployee($data){
		if(!empty($data)){
			$this->db->insert(TBL_EMPLOYEETRAININGS, $data);
			return true;
		}else{
			return false;
		}
	}
	public function updateemployee($data,$id){
		if(!empty($data) && !empty($id)){
			$this->db->where(COL_EMPLOYEETRAININGID, $id);
			$this->db->update(TBL_EMPLOYEETRAININGS, $data);
			return true;
		}else{
			return false;
		}
	}

	public function getemployee($id){
		if(!empty($id)){
			$this->db->where(COL_EMPLOYEETRAININGID, $id);
			$data = $this->db->get(TBL_EMPLOYEETRAININGS)->result_array();
			return $data;
		}
	}
	public function getemployeebyname($name){
		if(!empty($name)){
			$this->db->where(COL_NAME, $name);
			$data = $this->db->get(TBL_EMPLOYEETRAININGS)->result_array();
			return $data;
		}
	}
	public function getallemployee(){
		return $this->db->get(TBL_EMPLOYEETRAININGS)->result_array();
	}

	public function getsingleemployeedata($id){
		if(!empty($id)){
			$this->db->where(COL_EMPLOYEETRAININGID, $id);
			$data = $this->db->get(TBL_EMPLOYEETRAININGS)->row();
			if($data){
				return $data;
			}
			
		}
	}

	public function deleteuser($username){
		if($username){
			$this->db->where(COL_USERNAME, $username);
			if($this->db->delete(TBL_USERS)){
				return true;
			}else{
				return false;
			}
		}
	}

	public function deleteemployee($id){
		if($id){
			$this->db->where(COL_EMPLOYEETRAININGID, $id);
			if($this->db->delete(TBL_EMPLOYEETRAININGS)){
				return true;
			}else{
				return false;
			}
		}
	}

}