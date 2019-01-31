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

	

}