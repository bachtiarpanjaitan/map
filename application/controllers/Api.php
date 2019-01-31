<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/core/Api_Controller.php';

class Api extends Api_Controller {

 	public function __construct() {
       parent::__construct();
       $this->load->model('munit');
       $resp = "";
    }

    public function getunits(){
        $result = $data['units'] = $this->munit->getdataunits();
        if(!$result){
            $resp['success'] = false;
            echo json_encode($resp);
            return;
        }
        $resp['success'] = true;
        $resp['units'] = $data['units'];
        echo json_encode($resp);
    }

}