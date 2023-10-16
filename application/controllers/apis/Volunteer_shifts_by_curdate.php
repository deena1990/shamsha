<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_shifts_by_curdate extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/schedule_model');
    }

    public function index_post() {
        
        $check_data = $this->schedule_model->check_schedule_data_oncurdate();

        if ($check_data == 0) {
            $data = array(
                'status' => "invalid",
                "message" => "Shifts not Present",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }else{
            $result = $this->schedule_model->get_schedule_data_oncurdate();
            $data = array(
                //"data" => array(),
                "data" => $result
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
        //$this->response($data2, REST_Controller::HTTP_OK);
    }

}
