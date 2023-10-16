<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Vol_status_update extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_status_update_model');
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Volunteer Id is not correct !!"; $msg3 = "Status Required !!"; $msg4 = "Volunteer status changed successfully !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "هوية المتطوع غير صحيحة !!"; $msg3 = "مطلوب الحالة !!"; $msg4 = "تم تغيير وضع التطوع بنجاح !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }else{
                $result = $this->vol_status_update_model->get_user_info();
                if($result){
                    if ($this->post('status') == "") {
                        $data = array(
                            'success' => "false",
                            "message" => $msg3,
                        );
                    }else{
                        $this->vol_status_update_model->save_vol_status();
                        $data = array(
                            'success' => "true",
                            "message" => $msg4,
                        );
                    }
                }else{
                    $data = array(
                        'success' => "false",
                        "message" => $msg2,
                    ); 
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
