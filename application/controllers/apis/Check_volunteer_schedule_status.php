<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Check_volunteer_schedule_status extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/check_volunter_schedule_model');
    }

    public function index_post() {
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }else{
                $result = $this->check_volunter_schedule_model->get_data();
                // print_r($result);die;
                if ($result) {
                    $data = array(
                        'success' => "true",
                        "message" => "1",
                        "data" => $result
                    );
                } else {
                    $data = array(
                        'success' => "false",
                        "message" => "0",
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
