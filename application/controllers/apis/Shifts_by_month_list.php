<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Shifts_by_month_list extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/schedule_model');
    }

    public function index_post() {
        
       
        $result = $this->schedule_model->get_schedule_data_onmonth();
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
        //$this->response($data2, REST_Controller::HTTP_OK);
    }

}
