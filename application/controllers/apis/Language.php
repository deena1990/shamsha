<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Language extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/language_model');
    }

    public function index_post() {
        
        $result = $this->language_model->get_data();
        if ($result) {
            $data = array(
               // 'status' => "valid",
               // "message" => "Logged in Successfully",
                //"data" => array(),
                "data" => $result
            );
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
