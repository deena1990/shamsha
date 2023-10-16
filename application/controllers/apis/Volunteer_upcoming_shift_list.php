<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_upcoming_shift_list extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/schedule_model');
    }

    public function index_post() {
        
       
        $result = $this->schedule_model->get_volun_upcoming_schedule_list_data();
        if ($result) {
           $data = $result;
        } else {
            $data = array(
				array(
                	'status' => "invalid",
                	"message" => "Not Found",
                	//"data" => array(),
            	)
			);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}