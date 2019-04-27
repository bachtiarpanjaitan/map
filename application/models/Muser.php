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
			$data = $this->db->get(TBL_USERS)->row();
			if($data){
				return $data;
			}
			
		}
	}

	public function checkuserexist($id){
		if(!empty($id)){
			$this->db->where(TBL_USERS.'.'.COL_USERNAME, $id);
			$data = $this->db->get(TBL_USERS)->result_array();
			if(count($data) > 0){
				return true;
			}else{
				return false;
			}
			
		}
	}

	public function getroles(){
		return $this->db->get('roles')->result_array();
	}
	public function getlevels(){
		return $this->db->get('levels')->result_array();
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

	public function getuserinherit(){
		$this->db->join('roles', 'roles.roleid = u.roleid', 'left');
		$this->db->join('levels', 'levels.levelid = u.levelid','left');
		$data = $this->db->get('users u')->result_array();
		return $data;
	}

	public function getuser($username = ""){
		if(!empty($username)){
			$this->db->where('username', $username);
			$data = $this->db->get('users')->row();
			return $data;
		}else{
			return $this->db->get('users')->result_array();
		}
	}

	public function unithasbooking($unitid){
		if(!empty($unitid)){
			$this->db->where('unitid', $unitid);
			return $this->db->get('books')->result_array();
		}
	}

	public function savebook($data){
		if(!empty($data)){
			$this->db->insert('books', $data);
			return true;
		}else{
			return false;
		}
	}

	public function updatebook($data,$id){
		if(!empty($data) && !empty($id)){
			$this->db->where('bookid', $id);
			$this->db->update('books', $data);
			return true;
		}else{
			return false;
		}
	}

	public function getunit($id){
		if(!empty($id)){
			$this->db->where('unitid', $id);
			$data =  $this->db->get('books')->row();
			return $data;
		}
	}

	public function getunits($id){
		if(!empty($id)){
			$this->db->where('unitid', $id);
			$data =  $this->db->get('units')->result_array();
			return $data;
		}
	}

	public function updateunit($data, $id){
		if(!empty($data) && !empty($id)){
			$this->db->where('unitid', $id);
			$this->db->update('units', $data);
			return true;
		}else{
			return false;
		}
	}

	public function updateunitstatus($data, $id){
		if(!empty($data) && !empty($id)){
			$this->db->where('unitid', $id);
			$this->db->update('units', $data);
			return true;
		}else{
			return false;
		}
	}

	public function saveunit($data){
		if(!empty($data)){
			$this->db->insert('units', $data);
			return true;
		}else{
			return false;
		}
	}

	public function getwhereunit($id){
		if(!empty($id)){
			$this->db->where('unitid', $id);
			$data =  $this->db->get('units')->row();
			return $data;
		}
	}

	public function getbloks($id = ""){
		if(!empty($id)){
			$this->db->get('blokid',$id);
		}

		return $this->db->get('bloks')->result_array();

	}
	public function updateblok($data, $id){
		if(!empty($data) && !empty($id)){
			$this->db->where('blokid', $id);
			$this->db->update('bloks', $data);
			return true;
		}else{
			return false;
		}
	}

	public function saveblok($data){
		if(!empty($data)){
			$this->db->insert('bloks', $data);
			return true;
		}else{
			return false;
		}
	}
	public function getwhereblok($id){
		if(!empty($id)){
			$this->db->where('blokid', $id);
			$data =  $this->db->get('bloks')->row();
			return $data;
		}
	}
	public function deleteblok($id){
		if($id){
			$this->db->where('blokid', $id);
			if($this->db->delete('bloks')){
				return true;
			}else{
				return false;
			}
		}
	}

	public function getrequesttype(){
		return $this->db->get('requesttypes')->result_array();
	}

	public function getunittype(){
		return $this->db->get('unittypes')->result_array();
	}

}