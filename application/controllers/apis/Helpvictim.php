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
	
	function send_notification($registatoin_ids, $notification,$device_type) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		//echo $registatoin_ids[0];
		if($device_type == "Android"){
			$fields = array(
				'to' => $registatoin_ids[0],
				'data' => $notification
			);
		} else {
			$fields = array(
				'to' => $registatoin_ids[0],
				'notification' => $notification
			);
		}
		// Firebase API Key
		$headers = array('Authorization:key=AAAApdHl590:APA91bFVCJKCAAKUko7ZFn3jeUTisGxu7UNDeVD3EiZ5KWq7gvaBVUzp_0PAx-mQid4FHQMVXRhSnU8rYfHBWsJJmuytTFYEr3S3-Yt2nUPigOGv7jhS0iE6ZkFfU_o_4j4IyTkwNIx3','Content-Type:application/json');
		//echo print_r($fields);
		//echo print_r($headers);
		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		//echo "result \n";
		//echo $result;
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
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
                        //$this->fcm->send_notification($volunteerList['android'], $arrNotification,'Android',true);
						$this->send_notification($volunteerList['android'], $arrNotification,'Android',true);
                        //echo '<pre>'; print_r($arrNotification); exit();
                    }

                    if(count($volunteerList['ios'])>0){
                        //$this->fcm->send_notification($volunteerList['ios'], $arrNotification,'iOS',true);
						$this->send_notification($volunteerList['android'], $arrNotification,'Android',true);
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
            if ($language == "en"){ $msg1 = "Id Required !!"; }
            if ($language == "ar"){ $msg1 = "المعرف مطلوب !!"; }
            $help_id = $this->input->post('id');
            if (empty($help_id)){
                $data = array(
                    'success' => 'false',
                    'message' => $msg1,
                );
            }else{
                $volunteer = $this->victim_model->helpStatusupdate($help_id);
                $data = array(
                    'success' => "true",
                    // "message" => "Volunteer found!",
                    // 'victim' => $volunteer
                );
            }
        }
		$this->response($data, REST_Controller::HTTP_OK);
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
            if ($language == "en"){ $msg1 = "Data not found !!"; }
            if ($language == "ar"){ $msg1 = "لم يتم العثور على بيانات !!"; }
            $list = $this->victim_model->language_list1();
            if ($list) {
                $data = array(
                    'success' => "true",
                    "message" => "",
                    'data' => $list,
                );
            }
            else {
                $data = array(
                    'success' => "false",
                    "message" => $msg1,
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
