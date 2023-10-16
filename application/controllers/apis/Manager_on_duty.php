<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Manager_on_duty extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('manager_on_duty_model');
    }

    public function index_post() {

        $result = $this->manager_on_duty_model->get_row_api();
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
