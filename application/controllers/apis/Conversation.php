<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Conversation extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('apis/Conversation_model');
        $this->load->library('FCM');
    }

    public function save_conversation_detail_post() {
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
            if ($language == "en"){ $msg1 = "Case Id required !!"; $msg2 = "Case Id is not correct !!"; $msg3 = "Device Id required !!"; $msg4 = "Conversation sid required !!"; $msg5 = "User Identity required !!"; $msg6 = "Volunteer Identity required !!"; $msg7 = "Conservation Details saved successfully !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "معرف الحالة غير صحيح !!"; $msg3 = "معرف الجهاز مطلوب !!"; $msg4 = "مطلوب محادثة سيد !!"; $msg5 = "هوية المستخدم مطلوبة !!"; $msg6 = "مطلوب هوية متطوع !!"; $msg7 = "تم حفظ تفاصيل الحفظ بنجاح !!"; }
            if (empty($this->input->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkCaseExist = $this->Conversation_model->checkCaseExist();
                if($checkCaseExist == 1){

                    if (empty($this->input->post('device_id'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg3,
                        );
                    }else if (empty($this->input->post('conversation_sid'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg4,
                        );
                    }else if (empty($this->input->post('userIdentity'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg5,
                        );
                    }else if (empty($this->input->post('volunteerIdentity'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg6,
                        );
                    }else{
                        $this->Conversation_model->saveConversationDetails();
                        

                        // notification code start from here

                        $volunteers = $this->Conversation_model->get_case_victim();
                        // print_r($volunteers);die;
                        $msg = "You are entered in Chat Room successfully.";
                        $arrNotification = array();
                        $arrNotification["body"] = $msg;
                        $arrNotification["title"] = "Chat Connected !!";
                        $arrNotification["sound"] = "default";
                        $arrNotification["type"] = 1;
                        
                        if (count($volunteers['android']) > 0) {
                            $this->fcm->send_notification($volunteers['android'], $arrNotification, 'Android', true);
                        }

                        if (count($volunteers['ios']) > 0) {
                            $this->fcm->send_notification($volunteers['ios'], $arrNotification, 'iOS', true);
                        }

                        // notification code end here

                        $data = array(
                            "success" => "true",
                            "message" => $msg7,
                        );
                    }
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

    public function add_volunteer_in_conversations_post(){
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
            if ($language == "en"){ $msg1 = "Case Id required !!"; $msg2 = "Case Id is not correct !!"; $msg3 = "Volunteer Id required !!"; $msg4 = "Volunteer added successfully in conversation !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "معرف الحالة غير صحيح !!"; $msg3 = "مطلوب معرف المتطوع !!"; $msg4 = "تمت إضافة المتطوع بنجاح في المحادثة !!"; }
            if (empty($this->input->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkCaseExist = $this->Conversation_model->checkCaseExist();
                if($checkCaseExist == 1){

                    if (empty($this->input->post('volunteer_id'))) {
                        $data = array(
                            "success" => "false",
                            "message" => $msg3,
                        );
                    }else{
                        $this->Conversation_model->addVolunteer();
                        $data = array(
                            "success" => "true",
                            "message" => $msg4,
                        );
                    }
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

    public function checkConversationCreated_post(){
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
            if ($language == "en"){ $msg1 = "Case Id required !!"; $msg2 = "Case Id is not correct !!"; $msg3 = "Conversation created successfully !!"; $msg4 = "Conversation still not created !!"; $msg5 = "Conversation updated successfully !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "معرف الحالة غير صحيح !!"; $msg3 = "تم إنشاء المحادثة بنجاح !!"; $msg4 = "المحادثة لم تنشأ بعد !!"; $msg5 = "";}
            if (empty($this->input->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkCaseExist = $this->Conversation_model->checkCaseExist();
                if($checkCaseExist>0){
                    $checkConversationCreated = $this->Conversation_model->checkConversationCreated();
                    if ($checkConversationCreated>0) {
                        
                        $get_data = $this->db->get_where('wc_conversation_details',['case_id'=>$this->input->post('case_id')])->row();
                        if($get_data->reassign_number==null){
                            $status = "1";
                        }else if($get_data->reassign_number==1){
                            $status = "0";
                        }else if($get_data->reassign_number==2 && $get_data->reassign_volunteer_id == null){
                            $status = "0";
                        }else if($get_data->reassign_volunteer_id != null){
                            $status = "1";
                        }
                        $data = array(
                                    "success" => "true",
                                    "message" => $msg3,
                                    "status" => $status,
                                    "conversation_sid" => $this->Conversation_model->getConversationSid(),
                                );
                     
                    }else{
                        $data = array(
                            "success" => "true",
                            "message" => $msg4,
                            "status" => "0",
                            "conversation_sid" => "",
                        );
                    }
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

    public function exit_post(){
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
            if ($language == "en"){ $msg1 = "Case Id required !!"; $msg2 = "Conversation not created with this Case Id !!"; $msg3 = "Conversation ended successfully !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "لم يتم إنشاء المحادثة باستخدام معرف الحالة هذا !!"; $msg3 = "انتهت المحادثة بنجاح !!"; }
            if (empty($this->input->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkConversationCreated = $this->Conversation_model->checkConversationCreated();
                if ($checkConversationCreated>0) {
                    $this->Conversation_model->victimUpdate();
                    $data = array(
                        "success" => "true",
                        "message" => $msg3,
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
