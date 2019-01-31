<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/core/User_Controller.php';

class User extends User_Controller {

 	public function __construct() {
       parent::__construct();
       $this->load->model('mbranch');
       $this->load->model('muser');

    }

    function adduser(){
        $data['branch'] = $this->mbranch->getallbranch();
        $data['roles'] = $this->muser->getroles();
        $data['edit'] = false;
        return $this->load->view('user/adduser',$data);
    }

    function userlist(){
        $data['users'] = $this->muser->getalluser();
        return $this->load->view('user/userlist',$data);
    }

    function useredit($username){
        if(!empty($username)){
            $data['edit'] = true;
            $data['user'] = $this->muser->getsingleuserdata($username);
            $data['branch'] = $this->mbranch->getallbranch();
            $data['roles'] = $this->muser->getroles();
            return $this->load->view('user/adduser', $data);
        }
    }

    function addemployee(){
        $data['edit'] = false;
        return $this->load->view('user/addemployee', $data);
    }

    function employeelist(){
        $data['employee'] = $this->muser->getallemployee();
        return $this->load->view('user/employeelist',$data);
    }

    function employeeedit($employeetrainingid){
        if(!empty($employeetrainingid)){
            $data['edit'] = true;
            $data['user'] = $this->muser->getsingleemployeedata($employeetrainingid);
            return $this->load->view('user/addemployee', $data);
        }
    }
}