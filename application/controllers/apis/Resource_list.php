<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Resource_list extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/resource_model');
    }

    public function index_post() {
        
        $presult = $this->resource_model->get_data();
        if ($presult) {
            $data = array(
                'success' => "true",
                "message" => "",
            );
            $data['Data'] = $presult;
        } else {
            $data = array(
                'success' => "false",
                "message" => "Not Found",
               // "data" => $result,
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
