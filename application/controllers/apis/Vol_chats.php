<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Vol_chats extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_chats_model');
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
                if($this->vol_chats_model->checkVolExist($this->post('volunteer_id')) == 1){
                    $data = array(
                        "success" => "true",
                        "message" => "",
                        "Data" => [
                            'incoming_chats' => $this->vol_chats_model->get_vol_incoming_chats($this->post('volunteer_id')),
                            'past_chats' => $this->vol_chats_model->get_vol_past_chats($this->post('volunteer_id')),
                        ]
                    );
                }else{
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
