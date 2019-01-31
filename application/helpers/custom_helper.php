<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('errorjson')){
	function errorjson($message, $success = FALSE){
		$ci =& get_instance();
		$data;
		if(!empty($message)){
			$data =  $ci->output
						->set_content_type('application/json')
						->set_status_header(200)
						->set_header('Content-Type: application/json')
						->set_output(json_encode(array(
							'text' => $message,
							'type' => 'error',
							'success' => $success
						)));
		}
	}
}	

if ( ! function_exists('successjson')){
	function successjson($message, $success = FALSE){
		$ci =& get_instance();
		$data;
		if(!empty($message)){
			$data =  $ci->output
						->set_content_type('application/json')
						->set_header('Content-Type: application/json')
						->set_status_header(200)
						->set_output(json_encode(array(
							'text' => $message,
							'type' => 'success',
							'success' => $success
						)));
		}
	}
}

function getuserlogin($param){
	$ci =& get_instance();
	$ci->load->library('session');
	$data = $ci->session->userdata($param);
	if($param){
		return $data;
	}else{
		return $data;
	}
}

function islogin(){
	$ci =& get_instance();
	$ci->load->library('session');
	if($ci->session->userdata(COL_ISLOGIN) == true){
		return true;
	}else{
		return false;
	}
}