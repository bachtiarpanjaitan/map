<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 	public function __construct() {
       parent::__construct();
       $this->load->model('muser');
    }

  public function index(){
    if(isCustomer()){
      $data['user'] = $this->muser->getuserdata();
      $this->load->view('customerdashboard',$data);
    }else{
      $data['user'] = $this->muser->getuserdata();
      $this->load->view('dashboard',$data);
    }
  	
	}


}