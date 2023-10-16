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

    public function helpline_post() {

        $data['connection_type'] = $this->input->post('connection_type');
        $data['user_type'] = $this->input->post('user_type');
        $data['language'] = $this->input->post('language');
        $data['device_id'] = $this->input->post('device_id');
        $data['device_type'] = $this->input->post('device_type');
        $data['latitude'] = $this->input->post('latitude');
        $data['longitude'] = $this->input->post('longitude');
        $data['fcm_token'] = $this->input->post('fcm_token');
        $data['case_id'] = $this->input->post('case_id');

        //echo '<pre>'; print_r($data); exit;
        
        $this->form_validation->set_rules('language', 'Language', 'trim|required');
        $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
        if($data['user_type'] == "existing"){
            $this->form_validation->set_rules('case_id', 'Case', 'trim|required');
        }
        $this->form_validation->set_data($data);

        $victim = [];
        $victim['language'] = $data['language'];
        $victim['device_id'] = $data['device_id'];
        $victim['device_type'] = $data['device_type'];
        $victim['latitude'] = $data['latitude'];
        $victim['longitude'] = $data['longitude'];
        $victim['fcm_token'] = $data['fcm_token'];
        $victim['chat_opened'] = 1;
        $victim['opened_date'] = date('Y-m-d H:i:s');
        if (($this->form_validation->run() == true)) {

            if($data['user_type'] == "new"){
                $result = $this->victim_model->create_victim($victim);
                if(!empty($result)){
                    if($data['connection_type'] == "chat"){
                        $chatForm['screen_name'] = $this->input->post('name');
                        if($chatForm['screen_name']=="")
                        {
                            $chatForm['screen_name']="Unknown";
                        }
                        $chatForm['are_you_in_crisis'] = $this->input->post('crisis');
                        $chatForm['age'] = $this->input->post('age');
                        $chatForm['gender'] = $this->input->post('gender');
                        $chatForm['race_or_ethnicity'] = $this->input->post('race');
                        $chatForm['hear_about_us'] = $this->input->post('about');
                        $chatForm['case_id'] = $result;
                        $this->victim_model->create_chat_form($chatForm);
                        //print_r($this->db->last_query());
                    }
                    $volunteer = $this->victim_model->getVolunteer($victim['language']);
                    if(!empty($volunteer)){
                        $res = array(
                            'status' => "valid",
                            "message" => "Volunteer found!!",
                            'case_id' => $result,
                            'volunteer' => $volunteer
                        );
                    }
                    else{
                        $res = array(
                            'status' => "invalid",
                            "message" => "Volunteer not found!!",
                        );
                    }
                }
            } else {
                $victim['case_id'] = $data['case_id'];
                $check_case_id = $this->victim_model->check_victim($victim['case_id']);
                if($check_case_id > 0){
                    $result = $this->victim_model->update_victim($victim);
                    if(!empty($result)) {
                        $volunteer = $this->victim_model->getVolunteer($victim['language']);
                        if(!empty($volunteer)){
                            $res = array(
                                'status' => "valid",
                                "message" => "Volunteer found!!",
                                'case_id' => $result,
                                'volunteer' => $volunteer
                            );
                        }
                        else{
                            $res = array(
                                'status' => "invalid",
                                "message" => "Volunteer not found!!",
                            );
                        }
                    }

                }
                else{
                    $res = array(
                        'status' => "invalid",
                        "message" => "Case Id Not found!!",
                    );
                }

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
