<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Pin_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('apis/pin_victim_model');
    }

    public function create_post() {
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
        
            $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('pin', 'Pin', 'trim|required|max_length[4]');

            if ($this->form_validation->run() == FALSE)
            {
            $data = array(
                        "success" => "false",
                        "message" => array_values($this->form_validation->error_array())[0],
                    );
            }
            else
            {   
                if ($language == "en"){ $msg1 = "Pin created successfully !!"; $msg2 = "Pin already created !!"; $msg3 = "Device not found in our record !!"; }
                if ($language == "ar"){ $msg1 = "تم إنشاء الدبوس بنجاح !!"; $msg2 = "تم إنشاء دبوس بالفعل !!"; $msg3 = "الجهاز غير موجود في سجلنا !!"; }
                $userExists = $this->pin_victim_model->check_victim_exist();
                if($userExists>0){
                    $pin_user = $this->pin_victim_model->check_pin_victim_exist();
                    if($pin_user>0){
                        $update_user = $this->pin_victim_model->create_pin_victim();
                        $data = array(
                            "success" => "true",
                            "message" => $msg1,
                        );
                    }else{
                        $data = array(
                            "success" => "false",
                            "message" => $msg2,
                        );
                    }
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3,
                    );
                }
                
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }

    public function update_post() {
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
        
            $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
            $this->form_validation->set_rules('pin', 'Pin', 'trim|required|max_length[4]');
            $this->form_validation->set_rules('new_pin', 'New Pin', 'trim|required|max_length[4]');

            if ($this->form_validation->run() == FALSE)
            {
            $data = array(
                        "success" => "false",
                        "message" => array_values($this->form_validation->error_array())[0],
                    );
            }
            else
            {   
                if ($language == "en"){ $msg1 = "Pin updated successfully !!"; $msg2 = "Old pin is not valid !!"; }
                if ($language == "ar"){ $msg1 = "تم تحديث الدبوس بنجاح !!"; $msg2 = "رقم التعريف الشخصي القديم غير صالح !!"; }
                $correct_pin_victim = $this->pin_victim_model->check_correct_pin_victim_exist();
                if($correct_pin_victim>0){
                    $this->pin_victim_model->update_pin_victim();
                    $data = array(
                        "success" => "true",
                        "message" => $msg1,
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg2,
                    );
                }
                
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }

    public function disable_post() {
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
        
            $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
            // $this->form_validation->set_rules('pin', 'Pin', 'trim|required|max_length[4]');

            if ($this->form_validation->run() == FALSE)
            {
            $data = array(
                        "success" => "false",
                        "message" => array_values($this->form_validation->error_array())[0],
                    );
            }
            else
            {   
                if ($language == "en"){ $msg1 = "Pin disabled successfully !!"; }
                if ($language == "ar"){ $msg1 = "تم تعطيل الدبوس بنجاح !!"; }
                // $correct_pin_victim = $this->pin_victim_model->check_correct_pin_victim_exist();
                // if($correct_pin_victim>0){
                    $this->pin_victim_model->disable_pin_victim();
                    $data = array(
                        "success" => "true",
                        "message" => $msg1,
                    );
                // }else{
                //     $data = array(
                //         "success" => "false",
                //         "message" => $msg2,
                //     );
                // }
                
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }

    public function validate_post() {
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
        
            $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
            $this->form_validation->set_rules('pin', 'Pin', 'trim|required|max_length[4]');

            if ($this->form_validation->run() == FALSE)
            {
            $data = array(
                        "success" => "false",
                        "message" => array_values($this->form_validation->error_array())[0],
                    );
            }
            else
            {   
                if ($language == "en"){ $msg1 = "Login successfully !!"; $msg2 = "Pin is not valid !!"; }
                if ($language == "ar"){ $msg1 = "تسجيل الدخول بنجاح !!"; $msg2 = "رقم التعريف الشخصي غير صالح !!"; }
                $validate_pin_victim = $this->pin_victim_model->check_correct_pin_victim_exist();
                if($validate_pin_victim>0){
                    $data = array(
                        "success" => "true",
                        "message" => $msg1,
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg2,
                    );
                }
                
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }
    
    public function status_post() {
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
        
            $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
            
            if ($this->form_validation->run() == FALSE)
            {
            $data = array(
                        "success" => "false",
                        "message" => array_values($this->form_validation->error_array())[0],
                    );
            }
            else
            {   
                if ($language == "en"){ $msg1 = "Pin is not created yet !!"; $msg2 = "Pin already created !!"; $msg3 = "Device Id is not in our record !!"; }
                if ($language == "ar"){ $msg1 = "لم يتم إنشاء دبوس بعد !!"; $msg2 = "تم إنشاء دبوس بالفعل !!"; $msg3 = "معرف الجهاز غير موجود في سجلنا !!"; }
                
                $checkDevice = $this->pin_victim_model->checkDevice();
                if ($checkDevice > 0){
                    $pin_user = $this->pin_victim_model->check_pin_victim_exist();
                    if($pin_user>0){
                        $data = array(
                            "success" => "false",
                            "message" => $msg1,
                        );
                    }else{
                        $data = array(
                            "success" => "true",
                            "message" => $msg2,
                        );
                    }
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3,
                    );
                }
                
                
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }

}
