<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Helpvictim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/victim_model');
        $this->load->model('event_model');
        $this->load->library('FCM');

        $this->load->library('form_validation');
    }

    public function index_post() {
        $data['case_id'] = $this->input->post('case_id');
        $data['message'] = $this->input->post('message');
        $data['support_type'] = $this->input->post('support_type');
        $data['language'] = $this->input->post('language');
        $this->form_validation->set_rules('support_type', 'Support Type', 'trim|required');
        $this->form_validation->set_rules('case_id', 'Case', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $language = "";
        if($data['support_type'] == "Language"){
            $data['language'] = $this->input->post('language');
            $language = $data['language'];
            $this->form_validation->set_rules('language', 'Language', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE)
        {
            $errors = $this->form_validation->error_array();
            // There could be many but grab only the first
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];
            $res = array(
                'status' => "invalid",
                "message" => $err_msg,
            );
        }
        else
        {
            $register_user = $this->victim_model->helpStatusentry($data);
            if($register_user){
                $volunteer = $this->victim_model->getHelpvolunteer($language);
                   //print_r(count($volunteer)); exit;
                if(!empty($volunteer)){
                    $volunteerList = [];
                    $volunteerList['android']=[];
                    $volunteerList['ios']=[];
                    foreach ($volunteer as $v){
                        if(!empty($v->vol_token_id)){
                            if(strtolower($v->device) == 'android'){
                                $volunteerList['android'][] = $v->vol_token_id;
                            }

                            if(strtolower($v->device) == 'ios'){
                                $volunteerList['ios'][] = $v->vol_token_id;
                            }
                        }
                    }

                    $arrNotification= array();
                    $arrNotification["body"] = $data['message']; //"Language Support Needed for ".$data['case_id']."(".$data['language'].")";
                    $arrNotification["title"] = "🔴 ".$data['support_type']." Support for ".$data['case_id'];
                    $arrNotification["sound"] = "default";
                    $arrNotification["type"] = 1;



                    if(count($volunteerList['android'])>0){
                        $this->fcm->send_notification($volunteerList['android'], $arrNotification,'Android',true);
                        //echo '<pre>'; print_r($arrNotification); exit();
                    }

                    if(count($volunteerList['ios'])>0){
                        $this->fcm->send_notification($volunteerList['ios'], $arrNotification,'iOS',true);
                        //echo '<pre>'; print_r($arrNotification); exit();
                    }

                    $res = array(
                        'status' => "valid",
                        "message" => "Send Successfully!",
                        'victim' => $data
                    );
                }
                else{
                    $res = array(
                        'status' => "invalid",
                        "message" => "Send Successfully!",
                    );
                }
            }
            else{
                $res = array(
                    'status' => "invalid",
                    "message" => "Something went wrong please try later",
                );
            }

        }
        $this->response($res, REST_Controller::HTTP_OK);
    }

    public function accept_post() {

        $data['help_id'] = $this->input->post('id');
        $help_id=$data['help_id'];

            $volunteer = $this->victim_model->helpStatusupdate($help_id);

            $res = array(
                'status' => "valid",
                "message" => "Volunteer found!",
                'victim' => $data
            );
            $this->response($res, REST_Controller::HTTP_OK);
    }

    public function helpvictimlist_post() {

        $list = $this->victim_model->helpvictimlist();
        if ($list) {
            $data = array( 
				'status' => "valid",
				"data"=>$list 
			);
        }
        else {
            $data = array(
                'status' => "invalid",
                "message" => "Not found",
				"data" => []
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
	
	public function deletehelpvictim_post() {
		 $bool = $this->victim_model->helpStatusdelete($this->input->post('case_id'));
		 $data = array(
                'status' => "valid",
                "message" => $bool,
		 );
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function languagelist_post() {

        $list = $this->victim_model->language_list1();
        if ($list) {
            $data = $list;
        }
        else {
            $data = array(
                'status' => "invalid",
                "message" => "Not found",
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
