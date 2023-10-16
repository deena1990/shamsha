<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Victim_event_image extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/Victim_event_model');
    }

    public function index_post() {
        
        $result = $this->Victim_event_model->get_imagedata();
        if ($result) {
            // $data = array(
            //   // 'status' => "valid",
            //   // "message" => "Logged in Successfully",
            //     //"data" => array(),
                
            //      $result
            // );
            
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
