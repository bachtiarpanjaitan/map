<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 	public function __construct() {
       parent::__construct();
       $this->load->model('muser');
    }

  public function index(){
    $data['title'] = 'Add Request Unit';
		$data['edit'] = false;
		$data['bloks'] = $this->muser->getbloks();
		$data['users'] = $this->muser->getuser();
		$data['requesttypes'] = $this->muser->getrequesttype();
    $data['unittypes'] = $this->muser->getunittype();
    $data['user'] = $this->muser->getuserdata();
    $this->load->view('dashboard',$data);

    // if(isCustomer()){
    //   $data['user'] = $this->muser->getuserdata();
    //   $this->load->view('customerdashboard',$data);
    // }else{
    //   $data['user'] = $this->muser->getuserdata();
    //   $this->load->view('dashboard',$data);
    // }
  	
	}


}