<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Victim_event_detail extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/Victim_event_model');
    }

    public function index_post() {
        
        $result = $this->Victim_event_model->get_info_detail();
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
