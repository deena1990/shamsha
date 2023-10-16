<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Partner extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/about_model');
    }

    public function index_post() {
        
        $result = $this->about_model->get_pmember_data();
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
