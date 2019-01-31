<?php
class Munit extends CI_Model{
	

	public function __construct() {
		parent::__construct();
		$this->load->database();
    }
    
    public function getdataunits($id= ""){
        if(!empty($id)){
            $this->db->where('unitid',$id);
        }
        $this->db->join('status','status.statusid = '.'units.statusid','left');
        return $this->db->get('units')->result_array();
    }
}