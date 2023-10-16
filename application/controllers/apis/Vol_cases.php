<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Vol_cases extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_cases_model');
    }

    public function index_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Volunteer Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "هوية المتطوع غير صحيحة !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }

            else {
                $checkVolExist = $this->vol_cases_model->checkVolExist($this->post('volunteer_id'));

                if($checkVolExist == 1){
                    
                    $result = $this->vol_cases_model->get_vol_cases($this->post('volunteer_id'));
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
