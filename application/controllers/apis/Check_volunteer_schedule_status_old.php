<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Check_volunteer_schedule_status extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/check_volunter_schedule_model');
    }

    public function index_post() {
        
        if (empty($this->post('volunteer_id'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Volunteer Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        //$date = Date('Y-m-d');
        $result = $this->check_volunter_schedule_model->get_data();
        if ($result) {
            $data = array(
                'status' => "valid",
                "message" => "1",
                //"data" => array(),
               // "data" => $result
            );
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "0",
                //"data" => array(),
                
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
