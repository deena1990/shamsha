<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_login extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/volunteer_login_model');
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
            if ($language == "en"){ $msg1 = "Email required !!"; $msg2 = "Password required !!"; $msg3 = "User not found !!"; $msg4 = "Logged in Successfully !!"; $msg5 = "Invalid credentails, Please try again !!"; }
            if ($language == "ar"){ $msg1 = "البريد الإلكتروني (مطلوب !!"; $msg2 = "كلمة المرور مطلوبة !!"; $msg3 = "لم يتم العثور على المستخدم !!"; $msg4 = "تم تسجيل الدخول بنجاح !!"; $msg5 = "بيانات الاعتماد غير صالحة ، يرجى المحاولة مرة أخرى !!"; }
            if (empty($this->post('email'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }
            else if (empty($this->post('password'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg2,
                );
            }
            else{
                $check_user = $this->volunteer_login_model->check_user();

                if ($check_user == 0) {
                    $data = array(
                        'success' => "false",
                        "message" => $msg3,
                    );
                }else{
                    $result = $this->volunteer_login_model->check_login_data();
                    if ($result!='') {
                        $data = array(
                            'success' => "true",
                            "message" => $msg4,
                            "data" => $result
                        );
                        $this->volunteer_login_model->save_vol_device_info();
                        $this->volunteer_login_model->save_log_data();
                    } else {
                        $data = array(
                            'success' => "false",
                            "message" => $msg5,
                        );
                    }
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }


    public function first_login_post() {
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Volunteer not found !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "المتطوع غير موجود !!"; }
            $volunteer_id = $this->post('volunteer_id');
            if (empty($volunteer_id)) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }
            else{
                $check_user = $this->volunteer_login_model->user_single_detail($volunteer_id);
                if(!empty($check_user)){
                    $data = array(
                        'success' => "true",
                        "message" => $check_user->password_login_first,
                    );
                }
                else{
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
