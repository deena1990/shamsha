<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Job_detail extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/job_model');
    }

    public function index_post() {
        
        $result = $this->job_model->get_detail_info();
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
