<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Rescat extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/resource_model');
    }

    public function index_post() {
        
        $result = $this->resource_model->get_ccat_data();
        if ($result) {
            $data = $result;
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
               // "data" => $result,
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
