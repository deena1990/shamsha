<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_info extends REST_Controller {

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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Volunteer Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "هوية المتطوع غير صحيحة !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }else{
                $result = $this->volunteer_login_model->get_user_info();
                if ($result) {
                    $data = array(
                        'success' => "true",
                        "message" => "",
                        'Data' => $result,
                    );
                } else {
                    $data = array(
                        'success' => "false",
                        "message" => $msg2,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function dashboard_post() {
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Volunteer Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "هوية المتطوع غير صحيحة !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }else{
                $result = $this->volunteer_login_model->get_vol_dashboard_info();
                if ($result) {
                    $data = array(
                        'success' => "true",
                        "message" => "",
                        'Data' => $result,
                    );
                } else {
                    $data = array(
                        'success' => "false",
                        "message" => $msg2,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function logout_post() {
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Logged out successfully !!"; $msg3 = "Volunteer Id is not correct !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "تم تسجيل الخروج بنجاح !!"; $msg3 = "هوية المتطوع غير صحيحة !!"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }else{
                $result = $this->volunteer_login_model->check_volunteer();
                if ($result) {
                    $this->volunteer_login_model->update_user_info(array( 'onduty_status' => 0, 'vol_token_id'=> '', 'device' => '' ));

                    //


                    if(date("Y-m-d") > $this->volunteer_login_model->getMailDate()){
                        $this->volunteer_login_model->updateMailedStatus();
                    }

                    if($this->volunteer_login_model->getMailedStatus() == 0){
                    
                        if($this->volunteer_login_model->get_active_volunteer() < $this->volunteer_login_model->get_min_active_volunteer()){
                            $this->load->config('email');
                            $this->load->library('email');
                            $this->email->from("cyz@gmail.com", "Shamsaha");
                            $this->email->to("mobappssolutions154@gmail.com");
                            $this->email->subject("Available Volunteers Alert !!");
                            $this->email->message("<p>Hello,</p><br><br><p>This is an alert that available volunteers are less than minimum required available volunteers.</p><br><br><p>Please manage this from your end.</p>");
                            $this->email->set_newline("\r\n");
                    
                            if ($this->email->send()) {
                                $this->volunteer_login_model->saveEmailStatus();
                            } else {
                                // show_error($this->email->print_debugger());
                            }
                            
                        }
                    }


                    //
                    //

                    $data = array(
                        'success' => "true",
                        "message" => $msg2,
                    );
                } else {
                    $data = array(
                        'success' => "false",
                        "message" => $msg3,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function updateToken_post(){
        $this->volunteer_login_model->update_token();
        $data = array(
            'success' => "true",
            "message" => "Token updated successfully !!",
        );
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function check_in_post(){
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Status Required !!"; $msg3 = "Updated successfully !!"; $msg4 = "Something went wrong !!"; }
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "الحالة مطلوبة !!"; $msg3 = "تم التحديث بنجاح !!"; $msg4 = "هناك خطأ ما !!"; }
            $volunteer_assign = $this->input->post('volunteer_id');
            $status = $this->input->post('status');
            $check = array(
                'volunteer_assign' => $volunteer_assign,
                'status' => $status,
            );
            if (empty($volunteer_assign)){
                $data = array(
                    'success' => "false",
                    'message' => $msg1,
                );
            }else if (empty($status)){
                $data = array(
                    'success' => "false",
                    'message' => $msg2,
                );
            }else{
                $result = $this->volunteer_login_model->updateShiftStatus($check);
                // print_r($result);die;
                if($result){
                    if($status == "CheckOut"){
                        $this->volunteer_login_model->updateRewards($volunteer_assign);
                    }
                    $data = array(
                        'success' => "true",
                        "message" => $msg3,
                    );
                }
                else{
                    $data = array(
                        'success' => "false",
                        "message" => $msg4,
                    );
                }
            } 
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function accept_checkin_post(){
        $check['volunteer_id'] = $this->input->post('volunteer_id');
        $this->form_validation->set_rules('volunteer_id', 'Volunteer Id', 'trim|required');
        $this->form_validation->set_data($check);
        if (($this->form_validation->run() == true)) {
            $result = $this->volunteer_login_model->shiftAcceptRequest($check['volunteer_id']);
            if(!empty($result)){
                $res = array(
                    'status' => "valid",
                    "message" => 'Shift Available',
                );
            }
            else{
                $res = array(
                    'status' => "invalid",
                    "message" => 'No shift found',
                );
            }
        }
        else{
            $res = array(
                'status' => "invalid",
                "message" => validation_errors(),
            );
        }
        $this->response($res, REST_Controller::HTTP_OK);

    }
    
    public function availability_post(){
        $check['volunteer_id'] = $this->input->post('volunteer_id');
        $check['status'] = $this->input->post('status');
        $this->form_validation->set_rules('volunteer_id', 'Volunteer Id1', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_data($check);
        if (($this->form_validation->run() == true)) {
            $result = $this->volunteer_login_model->availabilityUpdate($check);
            if($result){
                $res = array(
                    'status' => "valid",
                    "message" => 'Updated Successfully',
                );
            }
            else{
                $res = array(
                    'status' => "invalid",
                    "message" => 'Something went wrong',
                );
            }
        }
        else{
            $error = $this->form_validation->error_array();
            $res = array(
                'status' => "invalid",
                "message" => array_values($error)[0],
            );
        }
        $this->response($res, REST_Controller::HTTP_OK);

    }

}
