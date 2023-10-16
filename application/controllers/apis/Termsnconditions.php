<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Termsnconditions extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/Termsnconditions_model');
    }

    public function index_post() {
        
        $result = $this->Termsnconditions_model->get_data();
        if ($result) {
            $data = $result;
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
