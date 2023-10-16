<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Advocacy extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/advocacy_model');
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
            if ($language == "en"){ $msg1 = "Form submitted successfully !!"; $msg2 = "Something went wrong, please try again !!"; }
            if ($language == "ar"){ $msg1 = "في محطة للحافلات !!"; $msg2 = "حدث خطأ ما. أعد المحاولة من فضلك !!"; }
            
            $this->form_validation->set_rules('email_id', 'Email ID', 'trim|valid_email|required');
            $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
            $this->form_validation->set_rules('age_above_r_nt', 'Crisis Advocate', 'trim|required');
            $this->form_validation->set_rules('language_u_speak[]', 'Language', 'required');
            $this->form_validation->set_rules('transportation', 'Transportation', 'trim|required');
            $this->form_validation->set_rules('stay_in', 'Stay', 'trim|required');
            //$this->form_validation->set_rules('plan_to_stay', 'Plan', 'trim|required');
            $this->form_validation->set_rules('attend_training', 'Attend Training', 'trim|required');
            $this->form_validation->set_rules('r_u_volunteer', 'Voluteer', 'trim|required');
            $this->form_validation->set_rules('unpain_volunteer', 'Unpaid Volunteer', 'trim|required');
            $this->form_validation->set_rules('traning_fee', 'Training Fee', 'trim|required');
            $this->form_validation->set_rules('any_additional_skill', 'Any Additional Skills', 'trim|required');
            $this->form_validation->set_rules('understand_r_not', 'I understand', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                // print_r($this->form_validation->error_array());
                $errors = $this->form_validation->error_array();
                $fields = array_keys($errors);
                $err_msg = $errors[$fields[0]];
                $data = array(
                    'success' => 'false',
                    'message' => $err_msg
                );
            }
            else
            {
                $user=array(
                    'email_id' => $this->input->get_post('email_id'),
                    'fullname' => $this->input->get_post('fullname'), 
                    'mobile' => $this->input->get_post('mobile'), 
                    'age_above_r_nt' => $this->input->get_post('age_above_r_nt'), 
                    'language_u_speak' => $this->input->get_post('language_u_speak'), 
                    'transportation' => $this->input->get_post('transportation'),
                    'stay_in' => $this->input->get_post('stay_in'),
                    'attend_training' => $this->input->get_post('attend_training'),
                    'r_u_volunteer' => $this->input->get_post('r_u_volunteer'),
                    'unpain_volunteer' => $this->input->get_post('unpain_volunteer'),
                    'traning_fee' => $this->input->get_post('traning_fee'), 
                    'any_additional_skill' => $this->input->get_post('any_additional_skill'),
                    'understand_r_not' => $this->input->get_post('understand_r_not'),
                    'status' => 'Active'
                );
                $result = $this->advocacy_model->upload($user);
                if($result){
                    $data = array(
                        'success' => 'true',
                        'message' => $msg1,
                    );
                }else {
                    $data = array(
                        'success' => 'false',
                        'message' => $msg2,
                    );
                }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
