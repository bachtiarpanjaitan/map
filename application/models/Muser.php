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

	public function getunits($id = null){
		if(!empty($id)){
			$this->db->select('units.*');
			$this->db->select('status.statusname');
			$this->db->select('bloks.blokname');
			$this->db->select('bloks.dormitory');
			$this->db->join('bloks','units.blokid = bloks.blokid', 'left');
			$this->db->join('status','status.statusid = units.statusid', 'left');
			$this->db->where('unitid', $id);
			$data =  $this->db->get('units')->result_array();
			return $data;
		}else{
			$this->db->select('units.*');
			$this->db->select('bloks.blokname');
			$this->db->select('bloks.dormitory');
			$this->db->join('bloks','units.blokid = bloks.blokid', 'left');
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

	public function saverequestdetail($data){
		if(!empty($data)){
			$this->db->insert('requestdetails', $data);
			return true;
		}else{
			return false;
		}
	}

	public function updaterequestdetail($data, $id){
		if(!empty($data) && !empty($id)){
			$this->db->where('requestdetailid', $id);
			$this->db->update('requestdetails', $data);
			return true;
		}else{
			return false;
		}
	}

	public function getwhererequest($id, $approve = false, $username = null){
		if(!empty($id)){	
			if($approve){
				$this->db->where('requestdetailid', $id);
			}else{
				$this->db->select('requestdetails.*');
				$this->db->select('users.telepon');
				$this->db->select('units.unittitle');
				$this->db->join('users','users.'. COL_USERNAME.' = '. 'requestdetails.username', 'left');
				$this->db->join('units','units.unitid = '. 'requestdetails.unitid', 'left');
				$this->db->where('requestdetailid', $id);
			}
			if(!empty($username)){
				$this->db->where('username', $username);
			}
			$result = $this->db->get('requestdetails')->result_array();
			return $result;
		}else{
			return false;
		}
	}

	public function getrequest($username = null){
		$this->db->select('requestdetails.*');
		$this->db->select('requesttypes.requesttypename');
		$this->db->select('unittypes.unittypename');
		$this->db->select('bloks.blokname');
		$this->db->select('units.unittitle');
		$this->db->select('approvalstatus.approvalstatusname');
		$this->db->join('requesttypes','requesttypes.requesttypeid = requestdetails.requesttypeid', 'left');
		$this->db->join('unittypes','unittypes.unittypeid = requestdetails.unittypeid', 'left');
		$this->db->join('bloks','bloks.blokid = requestdetails.blokid', 'left');
		$this->db->join('units','units.unitid = requestdetails.unitid', 'left');
		$this->db->join('approvalstatus','approvalstatus.approvalstatusid = requestdetails.approvedstatusid', 'left');
		if(!empty($username)){
			$this->db->where('requestdetails.username', $username);
			$this->db->where('requestdetails.approvedstatusid', REQUESTSTATUS_PENDING);
		}
		return $this->db->get('requestdetails')->result_array();
	}

	public function deleterequest($id){
		if($id){
			$this->db->where('requestdetailid', $id);
			var_dump($id);
			if($this->db->delete('requestdetails')){
				return true;
			}else{
				return false;
			}
		}
	}

	public function getapprovalstatus(){
		return $this->db->get('approvalstatus')->result_array();
	}

	public function getuserunit($username, $unitid = null){
		if(!empty($username) && !empty($unitid)){
			$this->db->where('username', $username);
			$this->db->where('unitid', $unitid);
			$this->db->where('approvedstatusid',REQUESTSTATUS_APPROVED);
			$data = $this->db->get('requestdetails')->result_array();

			return $data;
		}else{
			$this->db->where('username', $username);
			$this->db->where('approvedstatusid',REQUESTSTATUS_APPROVED);
			$data = $this->db->get('requestdetails')->result_array();

			return $data;
		}
	}

	public function getwhererequests($approve = false, $username = null){
		$this->db->select('requestdetails.*');
		$this->db->select('users.telepon');
		$this->db->select('units.unittitle');
		$this->db->join('users','users.'. COL_USERNAME.' = '. 'requestdetails.username', 'left');
		$this->db->join('units','units.unitid = '. 'requestdetails.unitid', 'left');
		$this->db->where('approvedstatusid', REQUESTSTATUS_APPROVED);

		if(!empty($username)){
			$this->db->where('requestdetails.username', $username);
		}

		$result = $this->db->get('requestdetails')->result_array();
		return $result;
	}

	public function getunitwhereblok($blokid)
	{
		$this->db->select('units.*');
		// $this->db->select('units.statusid');
		// $this->db->select('books.fullname');
		// $this->db->select('books.phone');
		$this->db->select('status.statusname');
		$this->db->join('status','units.statusid = status.statusid', 'left');
        // $this->db->join('books','books.unitid = units.unitid','left');
		$this->db->where('blokid',$blokid);
		// var_dump($this->db->last_query());
		return $this->db->get('units')->result_array();
	}

	

}