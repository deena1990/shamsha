<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Contact extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/contact_model');
    }

    public function index_get() {
        
        $result = $this->contact_model->get_data();
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
