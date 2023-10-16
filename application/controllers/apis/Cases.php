<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Cases extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/Victim_model');
    }

    public function index_get() {
        $language = $this->input->get('language');
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
            if ($language == "en"){ $msg1 = "Cases fetched !!"; }
            if ($language == "ar"){ $msg1 = "حالات الجلب !!"; }
            $result = $this->Victim_model->get_data();
            $data = array(
                'success' => "true",
                "message" => $msg1,
                "data" => $result,
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    public function case_details_post() {
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
            if ($language == "en"){ $msg1 = "Case Id required !!"; $msg2 = "Case Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "معرف الحالة غير صحيح !!"; }
            if (empty($this->input->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }

            else {
                $checkCaseExist = $this->Victim_model->checkCaseExist();
                if($checkCaseExist == 1){
                    $result = $this->Victim_model->getCaseDetails();
                    $data = array(
                        "success" => "true",
                        "message" => "",
                        "Data" => $result,
                    );
                }
                else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg2,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }   
}
