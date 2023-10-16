<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Checkvictim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/checkvictim_model');
    }

    public function index_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                'success' => "false",
                "message" => "Please enter language",
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                'success' => "false",
                "message" => "Please enter available language ( en, ar )",
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }else{
            if ($language == "en"){ $msg1 = "Device ID is required"; $msg2 = "Pin is required"; $msg3 = "victim not found"; $msg4 = "User found with this device ID"; }
            if ($language == "ar"){ $msg1 = "معرف الجهاز مطلوب"; $msg2 = "رقم التعريف الشخصي مطلوب"; $msg3 = "الضحية غير موجودة"; $msg4 = "وجد المستخدم مع معرف الجهاز هذا"; }
            
            if (empty($this->post('deviceid'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
            if (empty($this->post('pin'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg2,
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
        
            $check_user = $this->checkvictim_model->check_user();
            //print_r($check_device);
            if ($check_user == 0) {
                $data = array(
                    'success' => "false",
                    "message" => $msg3,
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }else{
                $result = $this->checkvictim_model->get_victim();
                    $data = array(
                        'success' => "true",
                        "message" => $msg4,
                        "Data" => $result,
                    );
                    $this->response($data, REST_Controller::HTTP_OK);
                    $this->output->_display();
                    exit;
            
            }
        }
    
        
       /* $result = $this->volunteer_login_model->check_login_data();
        if ($result) {
            $data = array(
                'status' => "valid",
                "message" => "Logged in Successfully",
                //"data" => array(),
                "data" => $result
            );
           
            $this->volunteer_login_model->save_log_data();
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Invalid credentails, Please try again",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);*/
    }

}
