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
        $this->db->join('bloks','bloks.blokid = '.'units.blokid','left');
        return $this->db->get('units')->result_array();
		}
		public function getdatabloks($id= ""){
			if(!empty($id)){
					$this->db->where('blokid',$id);
			}
			return $this->db->get('bloks')->result_array();
		}

    public function deleteunit($id){
		if($id){
			$this->db->where('unitid', $id);
			if($this->db->delete('units')){
				return true;
			}else{
				return false;
			}
		}
	}
}