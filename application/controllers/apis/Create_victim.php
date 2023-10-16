<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Create_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/create_victim_model');
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
            if ($language == "en"){ $msg = "The Device Id field is required."; $msg1 = "User already Exists !!"; $msg2 = "User updated successfully !!"; $msg3 = "User created successfully !!"; }
            if ($language == "ar"){ $msg = "حقل معرف الجهاز مطلوب."; $msg1 = "المستخدم موجود اصلا !!"; $msg2 = "تم تحديث المستخدم بنجاح !!"; $msg3 = "تم إنشاء المستخدم بنجاح !!"; }
            if (empty($this->input->post('deviceid')))
            {
                $data = array(
                        'success' => "false",
                        "message" => $msg,
                    );
            }
            else
            {   
                // if($this->input->post('mobile') != ""){
                //     $userExists = $this->create_victim_model->check_victim_exists();
                //     if($userExists>0){
                //         $this->create_victim_model->update_existing_victim_deviceid();
                //         $this->create_victim_model->delete_existing_deviceid_noMobile();
                //         $victim_details = $this->create_victim_model->get_victim_details();
                //         $data = array(
                //             'success' => "true",
                //             "message" => $msg1,
                //             "Data" => $victim_details,
                //         );
                //     }else{
                //         $deviceExists = $this->create_victim_model->check_existing_device_noMobile();
                //         if($deviceExists > 0){
                //             $device_status_inactive = $this->create_victim_model->device_status_inactive();
                //             $this->create_victim_model->update_existing_device_noMobile();
                //             $data = array(
                //                 'success' => "true",
                //                 "message" => $msg2,
                //             );
                //         }else{
                //             $device_status_inactive = $this->create_victim_model->device_status_inactive();
                //             $register_user = $this->create_victim_model->register_user();
                //             $insert_id = $this->db->insert_id();
                //             $this->create_victim_model->update_victimid_entry($insert_id);
                            
                //             if($register_user){
                //                 $data = array(
                //                     'success' => "true",
                //                     "message" => $msg3,
                //                     "Data" => $this->create_victim_model->getVictimDetails($insert_id)
                //                 );
                //             }
                //         }
                //     }
                // }else{
                    $userExists = $this->create_victim_model->check_victim_exist();
                    if ($userExists>0){
                        $data = array(
                            'success' => "true",
                            "message" => $msg3,
                            "userIdentity" => $this->create_victim_model->getExistingVictimDetails()
                        );
                    }else{
                        $register_user = $this->create_victim_model->register_user();
                        $insert_id = $this->db->insert_id();
                        $this->create_victim_model->update_victimid_entry($insert_id);
                        if($register_user){
                            $data = array(
                                'success' => "true",
                                "message" => $msg3,
                                "userIdentity" => $this->create_victim_model->getExistingVictimDetails()
                            );
                        }
                    }
                // }
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }
    
    public function check_device_noMobile_post(){
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
            if ($language == "en"){ $msg = "The Device Id field is required."; $msg1 = "Mobile number exist !!"; $msg2 = "Mobile number does not exist !!"; }
            if ($language == "ar"){ $msg = "حقل معرف الجهاز مطلوب."; $msg1 = "الجهاز موجود بدون موبايل !!"; $msg2 = "الجهاز لايوجد بدون موبايل !!"; }
            if (empty($this->input->post('deviceid')))
            {
                $data = array(
                        'success' => "false",
                        "message" => $msg,
                    );
            }
            else
            {
                $deviceExists = $this->create_victim_model->check_existing_device_noMobile();
                if($deviceExists > 0){
                    $data = array(
                        'success' => "false",
                        "message" => $msg2,
                    );
                }else{
                    $data = array(
                        'success' => "true",
                        "message" => $msg1,
                    );
                }
            }
        }
        return $this->response($data, REST_Controller::HTTP_OK);
    }

}
