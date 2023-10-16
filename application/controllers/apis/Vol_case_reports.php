<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Vol_case_reports extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_case_reports_model');
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Phone number required !!"; $msg3 = "Whatsapp number required !!"; $msg4 = "Email Id required !!"; $msg5 = "Address required !!"; $msg6 = "Passport number required !!"; $msg7 = "Profile updated successfully !!"; $msg8 = "Volunteer Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "رقم الهاتف مطلوب !!"; $msg3 = "رقم الواتس اب مطلوب !!"; $msg4 = "معرف البريد الإلكتروني مطلوب !!"; $msg5 = "العنوان مطلوب !!"; $msg6 = "رقم جواز السفر مطلوب !!"; $msg7 = "تم تحديث الملف الشخصي بنجاح !!"; $msg8 = "هوية المتطوع غير صحيحة !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }

            else {
                $checkVolExist = $this->vol_case_reports_model->checkVolExist($this->post('volunteer_id'));

                if($checkVolExist == 1){
                    
                    $result = $this->vol_case_reports_model->get_vol_case_reports($this->post('volunteer_id'));
                    $data = array(
                        "success" => "true",
                        "message" => "",
                        "Data" => $result,
                    );
                    
                }
                else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg8,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
