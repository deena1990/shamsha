<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Schedule extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/schedule_model');
    }

    public function index_post() {
        
        $result = $this->schedule_model->get_data();
        if ($result) {
            $data = array(
               // 'status' => "valid",
               // "message" => "Logged in Successfully",
                //"data" => array(),
                $result
            );
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    public function timer_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                'success' => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                'success' => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Data not found !!"; }
            if ($language == "ar"){ $msg1 = "لم يتم العثور على بيانات !!"; }
            $volunteer_id = $this->input->post('volunteer_id');
            if (!empty($volunteer_id)) {
                $result = $this->schedule_model->get_timer($volunteer_id);
                if (!empty($result)) {
                    $timeLeft = strtotime($result->start_time) - strtotime(date('Y-m-d H:i:s'));
                    $data = array(
                        'success' => "true",
                        "message" => $timeLeft,
                    );
                } else {
                    $data = array(
                        'success' => "false",
                        "message" => "Data not found",
                    );
                }
            }
            else{
                $data = array(
                    'success' => "false",
                    "message" => "Volunteer id required",
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
