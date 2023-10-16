<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/victim_model');
        $this->load->model('event_model');
        $this->load->library('FCM');

        $this->load->library('form_validation');
    }

    public function index_post() {


        $result = $this->victim_model->upcoming_openschedule_list();
        if ($result) {
            $data = $result;

        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function helpline_post()
    {

        $data['connection_type'] = $this->input->post('connection_type');
        $data['user_type'] = $this->input->post('user_type');
        $data['language'] = $this->input->post('language');
        $data['device_id'] = $this->input->post('device_id');
        $data['device_type'] = $this->input->post('device_type');
        $data['mobile'] = $this->input->post('mobile');
        $data['safe_to_call'] = $this->input->post('safe_to_call');
        //$data['latitude'] = $this->input->post('latitude');
        //$data['longitude'] = $this->input->post('longitude');
        $data['fcm_token'] = $this->input->post('fcm_token');
        $data['case_id'] = $this->input->post('case_id');
        $data['age'] = $this->input->post('age');
        $data['crisis'] = $this->input->post('crisis');

        //echo '<pre>'; print_r($data); exit;

        $this->form_validation->set_rules('language', 'Language', 'trim|required');
        $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
        /*if ($data['safe_to_call'] == "Yes" && $data['connection_type'] == "chat") {
            //$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        }
        if ($data['connection_type'] == "chat") {
            $this->form_validation->set_rules('age', 'Age', 'trim|required');
            //$this->form_validation->set_rules('crisis', 'Are you in Crisis', 'trim|required');
        }*/
        if ($data['user_type'] == "existing") {
            $this->form_validation->set_rules('case_id', 'Case', 'trim|required');
        }
		if ($data['user_type'] == "new") {
            $this->form_validation->set_rules('age', 'Age', 'trim|required');
			$this->form_validation->set_rules('safe_to_call', 'Are you safe to call', 'trim|required');
        }
        $this->form_validation->set_data($data);

        $victim = [];
        $volunteerList = [];
        $volunteerList['android'] = [];
        $volunteerList['ios'] = [];
        $victim['language'] = $data['language'];
        $victim['device_id'] = $data['device_id'];
        $victim['device_type'] = $data['device_type'];
        //$victim['latitude'] = $data['latitude'];
        //$victim['longitude'] = $data['longitude'];
        $victim['fcm_token'] = $data['fcm_token'];
        $victim['chat_opened'] = 1;
        $victim['opened_date'] = date('Y-m-d H:i:s');
        $victim['connection_type'] = $data['connection_type'];
        if (($this->form_validation->run() == true)) {
            $volunteer = $this->victim_model->getVolunteer($victim['language']);
           
            if (empty($volunteer) && $data['language'] == "English") {
                $volunteer = $this->victim_model->getVolunteer("Arabic");
            }
			//print_r($volunteer); exit;
            if (!empty($volunteer)) {
                if ($volunteer[0]->available_status == "Available") {
                    if ($data['user_type'] == "new") {
                        $result = $this->victim_model->create_victim($victim);
                        if (!empty($result)) {
                            //if ($data['connection_type'] == "chat") {
                                $chatForm['screen_name'] = $this->input->post('name');
                                if ($chatForm['screen_name'] == "") {
                                    $chatForm['screen_name'] = "Unknown";
                                }
                                $chatForm['are_you_in_crisis'] = $this->input->post('crisis');
                                $chatForm['age'] = $this->input->post('age');
                                $chatForm['gender'] = $this->input->post('gender');
                                $chatForm['race_or_ethnicity'] = $this->input->post('race');
                                $chatForm['hear_about_us'] = $this->input->post('about');
                                $chatForm['case_id'] = $result;
                                $chatForm['mobile'] = $this->input->post('mobile');
                                $chatForm['safe_to_call'] = $this->input->post('safe_to_call');
                                $this->victim_model->create_chat_form($chatForm);
                                //print_r($this->db->last_query());
                            //}

                            if (!empty($volunteer)) {
                                $volunteerList = [];
                                $volunteerList['android'] = [];
                                $volunteerList['ios'] = [];
                                foreach ($volunteer as $v) {
                                    if (!empty($v->vol_token_id)) {
                                        if (strtolower($v->device) == 'android') {
                                            $volunteerList['android'][] = $v->vol_token_id;
                                        }

                                        if (strtolower($v->device) == 'ios') {
                                            $volunteerList['ios'][] = $v->vol_token_id;
                                        }
                                    }
                                }

                                $msg = "You have a new client";
                                $arrNotification = array();
                                $arrNotification["body"] = $msg;
                                $arrNotification["title"] = "Victim found";
                                $arrNotification["sound"] = "default";
                                $arrNotification["type"] = 1;

                                if (count($volunteerList['android']) > 0) {
                                    $this->fcm->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
                                    //echo '<pre>'; print_r($arrNotification); exit();
                                }

                                if (count($volunteerList['ios']) > 0) {
                                    $this->fcm->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
                                    //echo '<pre>'; print_r($arrNotification); exit();
                                }

								
                                $res = array(
                                    'status' => "valid",
                                    "message" => "Volunteer found",
                                    'case_id' => $result,
									'volunteer' => $volunteer[0],
                                );
                            } else {
                                $res = array(
                                    'status' => "invalid",
                                    "message" => "Volunteer not found",
                                );
                            }
                        }
                    } else {
                        $victim['case_id'] = $data['case_id'];
                        $check_case_id = $this->victim_model->check_victim($victim['case_id']);
                        if ($check_case_id > 0) {
                            $result = $this->victim_model->update_victim($victim);
                            if (!empty($result)) {
                                //$volunteer = $this->victim_model->getVolunteer($victim['language']);
                                if (!empty($volunteer)) {
                                    $volunteerList = [];
                                    $volunteerList['android'] = [];
                                    $volunteerList['ios'] = [];
                                    foreach ($volunteer as $v) {
                                        if (!empty($v->vol_token_id)) {
                                            if (strtolower($v->device) == 'android') {
                                                $volunteerList['android'][] = $v->vol_token_id;
                                            }

                                            if (strtolower($v->device) == 'ios') {
                                                $volunteerList['ios'][] = $v->vol_token_id;
                                            }
                                        }
                                    }
                                    $msg = "You have a new client";
                                    $arrNotification = array();
                                    $arrNotification["body"] = $msg;
                                    $arrNotification["title"] = "Victim found";
                                    $arrNotification["sound"] = "default";
                                    $arrNotification["type"] = 1;

                                    if (count($volunteerList['android']) > 0) {
                                        $this->fcm->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
                                        //echo '<pre>'; print_r($arrNotification); exit();
                                    }

                                    if (count($volunteerList['ios']) > 0) {
                                        $this->fcm->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
                                        //echo '<pre>'; print_r($arrNotification); exit();
                                    }
                                    $res = array(
                                        'status' => "valid",
                                        "message" => "Volunteer found",
                                        'case_id' => $result,
                                        'volunteer' => $volunteer[0],
                                    );
                                } else {
                                    $res = array(
                                        'status' => "invalid",
                                        "message" => "Volunteer not found",
                                    );
                                }
                            }

                        } else {
                            $res = array(
                                'status' => "invalid",
                                "message" => "Case Id Not found!",
                            );
                        }

                    }
                } else {
                    $volunteer = $this->victim_model->getVolunteer($victim['language']);
                    foreach ($volunteer as $v) {
                    	if (!empty($v->vol_token_id)) {
							if (strtolower($v->device) == 'android') {
                            	$volunteerList['android'][] = $v->vol_token_id;
                             }

                             if (strtolower($v->device) == 'ios') {
                                 $volunteerList['ios'][] = $v->vol_token_id;
                             }
                         }
                     }
					
					$msg = "You have a client waiting in queue";
					$arrNotification = array();
					$arrNotification["body"] = $msg;
					$arrNotification["title"] = "Victim found";
					$arrNotification["sound"] = "default";
					$arrNotification["type"] = 1;
					
					//Savas add help victim when there are not volunteers available
					//if ($data['user_type'] == "new") {
					//	$helpvictim['case_id'] = $this->victim_model->create_victim($victim);
					//	$helpvictim['message'] = $msg;
					//	$helpvictim['support_type'] ="language";
					//	$helpvictim['language'] = $data['language'];
					//	$this->victim_model->helpStatusentry($helpvictim);
					//}else{
					//	$helpvictim['case_id'] = $data['case_id'];
					//	$helpvictim['message'] = $msg;
					//	$helpvictim['support_type'] ="language";
					//	$helpvictim['language'] = $data['language'];
					//	$this->victim_model->helpStatusentry($helpvictim);
					//}

					if (count($volunteerList['android']) > 0) {
						$this->fcm->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
						//echo '<pre>'; print_r($arrNotification); exit();
					}

					if (count($volunteerList['ios']) > 0) {
						$this->fcm->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
						//echo '<pre>'; print_r($arrNotification); exit();
					}
					
                    $res = array(
                        'status' => "invalid",
                        "message" => "All our volunteers are busy at the moment, please contact us in a few minutes.",
                    );
                }

            } else {
                $res = array(
                    'status' => "invalid",
                    "message" => "Volunteer not found",
                );
            }


        } else {
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];
            $res = array(
                'status' => "invalid",
                "message" => $err_msg,
            );
        }
        $this->response($res, REST_Controller::HTTP_OK);
    }

    public function check_volunteer_status_post(){
        $language = $this->input->post('language');
        if(!empty($language)){
            $check = $this->victim_model->checkAvailableStatus($language);
            //print_r($check); exit;
            if(!empty($check)){
                if($check->available_status == 'Available'){
                    $res = array(
                        'status' => "valid",
                        "message" => "Available",
                    );
                }
                else{
                    $res = array(
                        'status' => "invalid",
                        "message" => 'Busy',
                    );
                }
            }
            else{
                $res = array(
                    'status' => "invalid",
                    "message" => "Volunteer not available",
                );
            }
        }
        else{
            $res = array(
                'status' => "invalid",
                "message" => 'Please Enter language',
            );
        }
        $this->response($res, REST_Controller::HTTP_OK);
    }

}
