<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_alerts extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/volunteer_alerts_model');
        $this->load->library('FCM');
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
                $checkVolunteer = $this->volunteer_alerts_model->checkVolunteer();
                if ($checkVolunteer){
                    $loginStatus = $this->volunteer_alerts_model->checkVolunteerLoginStatus();
                    if($loginStatus){
                        $volLang = $this->volunteer_alerts_model->getVolunteerLang();
                        if ($volLang == "English"){
                            $data = array(
                                'success' => "true",
                                "message" => "",
                                "Data" => $this->volunteer_alerts_model->get_en_case_alerts()
                            );
                        }else if($volLang == "Arabic"){
                            $data = array(
                                'success' => "true",
                                "message" => "",
                                "Data" => $this->volunteer_alerts_model->get_ar_case_alerts()
                            );
                        }
                    }else{
                        $data = array(
                            'success' => "false",
                            "message" => "You are not logged In, please login first...",
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

    public function respond_post() {
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
            if ($language == "en"){ $msg1 = "Volunteer Id Required !!"; $msg2 = "Case Id Required !!"; $msg3 = "Volunteer responded successfully !!"; $msg4 = "Volunteer not responded on this case Id !!";}
            if ($language == "ar"){ $msg1 = "معرف المتطوع مطلوب !!"; $msg2 = "معرف الحالة مطلوب !!"; $msg3 = 'استجاب المتطوع بنجاح !!'; $msg4 = "لم يستجب المتطوع في هذه الحالة معرف"; }
            if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1
                );
            }else if (empty($this->post('case_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg2
                );
            }else{
                $checkRespond = $this->volunteer_alerts_model->checkRespond();
                if ($checkRespond == 0){
                    $insert = [
                        'case_id' => $this->post('case_id'),
                        'volunteer_id' => $this->post('volunteer_id'),
                        'attened_date' => date('Y-m-d H:i:s'),
                        'given_report' => 1,
                    ];
                    $this->volunteer_alerts_model->volResponded($insert);
                    $this->volunteer_alerts_model->victimUpdate();
                    $data = array(
                        'success' => "true",
                        "message" => $msg3
                    );
                }else{
                    $details = array(
                        'reassign_number' => 2
                    );
                    $this->db->where('case_id',$this->input->post('case_id'));
                    $this->db->update('wc_conversation_details',$details);

                    $this->volunteer_alerts_model->victimUpdate();
                    
                    $this->volunteer_alerts_model->updateVolunteerCases();

                    $data = array(
                        'success' => "true",
                        "message" => $msg3
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function notifyVolForVideoCall_post() {
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
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Victim still not requested for video call !!"; $msg3 = "Victim requested for video call !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "الضحية لم يطلب بعد مكالمة فيديو !!"; $msg3 = "الضحية طلبت مكالمة فيديو !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1
                );
            }else{
                $checkVictimReqForVideoCall = $this->volunteer_alerts_model->checkVictimReqForVideoCall();
                if ($checkVictimReqForVideoCall>0){
                    $data = array(
                        "success" => "true",
                        "message" => $msg3,
                        "status" => "1",
                    );
                }else{
                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                        "status" => "0",
                    ); 
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function notifyVolForVoiceCall_post() {
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
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Victim still not requested for voice call !!"; $msg3 = "Victim requested for voice call !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "الضحية لم يطلب الاتصال الصوتي بعد !!"; $msg3 = "الضحية طلبت مكالمة صوتية !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1
                );
            }else{
                $checkVictimReqForVoiceCall = $this->volunteer_alerts_model->checkVictimReqForVoiceCall();
                if ($checkVictimReqForVoiceCall>0){
                    $data = array(
                        "success" => "true",
                        "message" => $msg3,
                        "status" => "1",
                    );
                }else{
                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                        "status" => "0",
                    ); 
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function volAcceptOrNotVideoCall_post() {
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
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Action Required !!"; $msg3 = "Video call accepted successfully !!"; $msg4 = "Video call not accepted !!"; $msg5 = "Video call rejected successfully !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "الإجراء مطلوب !!"; $msg3 = "تم قبول مكالمة الفيديو بنجاح !!"; $msg4 = "مكالمة الفيديو غير مقبولة!!"; $msg5 = "تم رفض مكالمة الفيديو بنجاح!!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1
                );
            }else if (empty($this->post('action'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg2
                );
            }else{
                if ($this->post('action') == "2"){
                    $data = array(
                        "success" => "true",
                        "message" => $msg3
                    );
                }else if ($this->post('action') == "3"){
                    $data = array(
                        "success" => "true",
                        "message" => $msg4
                    );
                }else if ($this->post('action') == "4"){
                    $data = array(
                        "success" => "true",
                        "message" => $msg5
                    ); 
                }
                $this->volunteer_alerts_model->updateVideoCallStatus($this->post('action'));
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function volAcceptOrNotVoiceCall_post() {
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
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Action Required !!"; $msg3 = "Voice call accepted successfully !!"; $msg4 = "Voice call not accepted !!"; $msg5 = "Voice call rejected successfully !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "الإجراء مطلوب !!"; $msg3 = "تم قبول المكالمة الصوتية بنجاح !!"; $msg4 = "المكالمة الصوتية غير مقبولة !!"; $msg5 = "تم رفض المكالمة الصوتية بنجاح!!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1
                );
            }else if (empty($this->post('action'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg2
                );
            }else{
                if ($this->post('action') == "2"){
                    $data = array(
                        "success" => "true",
                        "message" => $msg3
                    );
                }else if ($this->post('action') == "3"){
                    $data = array(
                        "success" => "true",
                        "message" => $msg4
                    );
                }else if ($this->post('action') == "4"){
                    $data = array(
                        "success" => "true",
                        "message" => $msg5
                    ); 
                }
                $this->volunteer_alerts_model->updateVoiceCallStatus($this->post('action'));
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function getVictimCallConnectingMessages_post() {
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
            $data = array(
                "success" => "true",
                "message" => "",
                "Data" => $this->volunteer_alerts_model->getVictimCallConnectingMessages()
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function volChatWindowAutoResponseMessages_post() {
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
            $data = array(
                "success" => "true",
                "message" => "",
                "Data" => $this->volunteer_alerts_model->getChatWindowAutoResponseMessages()
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function getTokenFromIdentity_post() {
        if (empty($this->input->post('identity'))){
            $data = array(
                'success' => "false",
                "message" => "Please enter identity",
            );
        }else{
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://itdevelopmentservices.com/twilio/voicetokenandroid.php?identity='.$this->input->post("identity"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
            $data = array(
                "success" => "true",
                "message" => "",
                "Token" => $response
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    public function volAssignCaseToOther_post() {
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
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "New Language Required !!"; $msg3 = "Case Id is not correct !!"; $msg4 = "Volunteer is not present with requested Language !!"; $msg5 = "Request sent successfully to all available volunteer !!"; $msg6 = "Volunteer Id Required !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "لغة جديدة مطلوبة !!"; $msg3 = "معرف الحالة غير صحيح !!"; $msg4 = "المتطوع غير موجود باللغة المطلوبة !!"; $msg5 = "تم إرسال الطلب بنجاح إلى جميع المتطوعين المتاحين !!"; $msg6 ="مطلوب معرف المتطوع"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg1
                );
            }else if (empty($this->post('new_language'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg2
                );
            }else if (empty($this->post('volunteer_id'))) {
                $data = array(
                    'success' => "false",
                    "message" => $msg6
                );
            }else{

                $check_caseId = $this->volunteer_alerts_model->check_caseId();

                if($check_caseId>0){
                    //update
                    $update = array(
                        'reassign_number'=>1
                    );
                    $this->db->where('case_id',$this->post('case_id'));
                    $this->db->update('wc_conversation_details',$update);

                    $volunteer_count = $this->volunteer_alerts_model->get_new_language_volunteer_count($this->post('new_language'));

                    if ($volunteer_count>0){

                        $this->volunteer_alerts_model->updateVictimCaseLangNStatus();

                        // notification code start from here

                        $volunteers = $this->volunteer_alerts_model->get_new_language_volunteer($this->post('new_language'),$this->post('volunteer_id'));
                        // print_r($volunteers);die;
                        $msg = "You have a new client";
                        $title = $this->input->post('subject') == "" ? "Victim found" : $this->input->post('subject');
                        $arrNotification = array();
                        $arrNotification["body"] = $msg;
                        $arrNotification["title"] = $title;
                        $arrNotification["sound"] = "default";
                        $arrNotification["type"] = 1;
                        
                        if (count($volunteers['android']) > 0) {
                            // print_r($volunteers['android_user_id']);die;
                            foreach ($volunteers['android_user_id'] as $key => $value) {
                                // echo"<pre>";print_r($value);die;
                                $android_notification_Data = array(
                                                    'user_id' => $value,
                                                    'title' => $title,
                                                    'message' => $msg,
                                                    'type' => 1,
                                                    'dateTime' => date('Y-m-d H:i:s')
                                                    );
                                $this->volunteer_alerts_model->insertNotification($android_notification_Data);
                            }
                            $this->fcm->send_notification($volunteers['android'], $arrNotification, 'Android', true, 1);
                        }

                        if (count($volunteers['ios']) > 0) {
                            // print_r($volunteers['ios_user_id']);die;
                            foreach ($volunteers['ios_user_id'] as $key => $value) {
                                // echo"<pre>";print_r($value);die;
                                $ios_notification_Data = array(
                                                    'user_id' => $value,
                                                    'title' => $title,
                                                    'message' => $msg,
                                                    'type' => 1,
                                                    'dateTime' => date('Y-m-d H:i:s')
                                                    );
                                $this->volunteer_alerts_model->insertNotification($ios_notification_Data);
                            }
                            $this->fcm->send_notification($volunteers['ios'], $arrNotification, 'iOS', true, 1);
                        }

                        // notification code end here

                        $data = array(
                            'success' => "true",
                            "message" => $msg5
                        ); 

                    }else{
                        $data = array(
                            'success' => "false",
                            "message" => $msg4
                        ); 
                    }

                }else{
                    $data = array(
                        'success' => "false",
                        "message" => $msg3
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
