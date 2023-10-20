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
	// function send_notification($registatoin_ids, $notification,$device_type) {
	// 	$url = 'https://fcm.googleapis.com/fcm/send';
	// 	//echo $registatoin_ids[0];
	// 	if($device_type == "Android"){
	// 		$fields = array(
	// 			'to' => $registatoin_ids[0],
	// 			'data' => $notification
	// 		);
	// 	} else {
	// 		$fields = array(
	// 			'to' => $registatoin_ids[0],
	// 			'notification' => $notification
	// 		);
	// 	}
	// 	// Firebase API Key
	// 	$headers = array('Authorization:key=AAAApdHl590:APA91bFVCJKCAAKUko7ZFn3jeUTisGxu7UNDeVD3EiZ5KWq7gvaBVUzp_0PAx-mQid4FHQMVXRhSnU8rYfHBWsJJmuytTFYEr3S3-Yt2nUPigOGv7jhS0iE6ZkFfU_o_4j4IyTkwNIx3','Content-Type:application/json');
	// 	//echo print_r($fields);
	// 	//echo print_r($headers);
	// 	// Open connection
	// 	$ch = curl_init();
	// 	// Set the url, number of POST vars, POST data
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	curl_setopt($ch, CURLOPT_POST, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	// Disabling SSL Certificate support temporarly
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	// 	$result = curl_exec($ch);
	// 	//echo "result \n";
	// 	//echo $result;
	// 	if ($result === FALSE) {
	// 		die('Curl failed: ' . curl_error($ch));
	// 	}
	// 	curl_close($ch);
	// }

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
		
	public function helplineTwilioAR_get(){
		$victim['connection_type'] = "cellularCall";
        $victim['language'] = "Arabic";
        /*$victim['device_id'] = "";
        $victim['device_type'] = "";
        $victim['mobile'] = "";
        $victim['safe_to_call'] = "";
        $victim['fcm_token'] = "";
        $victim['case_id'] = "";
        $victim['age'] = "";
        $victim['crisis'] = "";*/
		$victim['chat_opened'] = 0;
		$victim['opened_date'] = date("Y-m-d H:i:s");
		$victim['status'] = 1;
		$result = $this->victim_model->create_victim($victim);
		$volunteer = $this->victim_model->getVolunteer("Arabic");
		$caller = "NULL";
		//print_r(  $volunteer );
		if( count($volunteer)>0){
			$caller=$volunteer[0]->vounter_id;
		}
		//echo $result;
		$res = array(
			"caseId"=>$result,
			"caller"=>$caller
		);
		$this->response($res, REST_Controller::HTTP_OK);
	}
	
	public function helplineTwilio_get(){
		$victim['connection_type'] = "cellularCall";
        $victim['language'] = "English";
        /*$victim['device_id'] = "";
        $victim['device_type'] = "";
        $victim['mobile'] = "";
        $victim['safe_to_call'] = "";
        $victim['fcm_token'] = "";
        $victim['case_id'] = "";
        $victim['age'] = "";
        $victim['crisis'] = "";*/
// 		$victim['chat_opened'] = 0;
// 		$victim['opened_date'] = date("Y-m-d H:i:s");
// 		$victim['status'] = 1;
// 		$result = $this->victim_model->create_victim($victim);
// 		$volunteer = $this->victim_model->getVolunteer("English");
// 		$caller = "NULL";
// 		//print_r(  $volunteer );
// 		if( count($volunteer)>0){
// 			$caller=$volunteer[0]->vounter_id;
// 		}
		//echo $result;
		$this->db->order_by('updated_at', 'desc');
		$this->db->limit(1,0);
		$sql = $this->db->get_where('wc_conversation_details',['voiceCall_status'=>1]);
		if($sql->num_rows()!=0){
		    $row = $sql->row();
		     $voiceCall_from = $row->voiceCall_from;
		    if($voiceCall_from==1){
		        $result = $row->case_id;
		        if($row->reassign_volunteer_id==""){
		            $caller = $row->volunteer_id;
		        }else{
		            $caller = $row->reassign_volunteer_id;
		        }
		        
		    }else{
		        if($row->reassign_volunteer_id==""){
		            $result = $row->volunteer_id;
		        }else{
		            $result = $row->reassign_volunteer_id;
		        }
		        
		        $caller = $row->case_id;
		    }
		    
		}else{
		    $result = "NULL";
		    $caller = "NULL";
		}
// 		echo "<pre>";
// 		print_r($sql->result());
// 		die;
// 			$sql = $this->db
//                 ->select('*')
//                 ->from('wc_conversation_details')
//                 ->where('voiceCall_status', 1)
//                 ->order_by('updated_at', 'desc')
//                 ->limit(0,1)
//                 ->get();
		$res = array(
			"caseId"=>$result,
			"caller"=>$caller
		);
		$this->response($res, REST_Controller::HTTP_OK);
	}

    public function save_intake_form_post(){
        date_default_timezone_set('Asia/Kuwait');
        // date_default_timezone_set('Asia/Kolkata');
        $language = $this->input->post('language');
        $conn_language = $this->input->post('conn_language');
        $device_id = $this->input->post('device_id');
        $device_type = $this->input->post('device_type');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $fcm_token = $this->input->post('fcm_token');
        $connection_type = $this->input->post('connection_type');
        // $crisis = $this->input->post('crisis');
        $age = $this->input->post('age');
        $gender = $this->input->post('gender');
        $safe_to_call = $this->input->post('safe_to_call');
        $mobile = $this->input->post('mobile');
        $race = $this->input->post('race');
        // $about = $this->input->post('about');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else if (empty($conn_language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter connection language",
            );
        }else if (empty($device_id)){
            $data = array(
                "success" => "false",
                "message" => "Please enter device id",
            );
        }else if (empty($device_type)){
            $data = array(
                "success" => "false",
                "message" => "Please enter device type",
            );
        }else if (empty($latitude)){
            $data = array(
                "success" => "false",
                "message" => "Please enter latitude",
            );
        }else if (empty($longitude)){
            $data = array(
                "success" => "false",
                "message" => "Please enter longitude",
            );
        }else if (empty($fcm_token)){
            $data = array(
                "success" => "false",
                "message" => "Please enter fcm token",
            );
        }else if (empty($connection_type)){
            $data = array(
                "success" => "false",
                "message" => "Please enter connection type",
            );
        // }else if (empty($crisis)){
        //     $data = array(
        //         "success" => "false",
        //         "message" => "Please enter crisis",
        //     );
        }else if (empty($age)){
            $data = array(
                "success" => "false",
                "message" => "Please enter age",
            );
        // }else if (empty($gender)){
        //     $data = array(
        //         "success" => "false",
        //         "message" => "Please enter gender",
        //     );
        }else if (empty($safe_to_call)){
            $data = array(
                "success" => "false",
                "message" => "Please enter safe to call",
            );
        // }else if (empty($mobile)){
        //     $data = array(
        //         "success" => "false",
        //         "message" => "Please enter mobile",
        //     );
        // }else if (empty($race)){
        //     $data = array(
        //         "success" => "false",
        //         "message" => "Please enter race or ethnicity",
        //     );
        // }else if (empty($about)){
        //     $data = array(
        //         "success" => "false",
        //         "message" => "Please enter hear about us",
        //     );
        }else{
            if ($language == "en"){ $msg1 = "Form submitted succesfully !!"; }
            if ($language == "ar"){ $msg1 = "في محطة للحافلات !!"; }
            
            $victim['language'] = $conn_language;
            $victim['device_id'] = $device_id;
            $victim['device_type'] = $device_type;
            $victim['latitude'] = $latitude;
            $victim['longitude'] = $longitude;
            $victim['fcm_token'] = $fcm_token;
            $victim['opened_date'] = date('Y-m-d H:i:s');
            $victim['connection_type'] = $connection_type;
            $result = $this->victim_model->create_victim($victim);

            $chatForm['screen_name'] = $this->input->post('name');
            if ($chatForm['screen_name'] == "") {
                $chatForm['screen_name'] = "Unknown";
            }
            $chatForm['mobile'] = $this->input->post('mobile');
            if ($chatForm['mobile'] == "") {
                $chatForm['mobile'] = "";
            }
            // $chatForm['are_you_in_crisis'] = $crisis;
            $chatForm['age'] = $age;
            $chatForm['gender'] = $gender;
            // $chatForm['mobile'] = $mobile;
            $chatForm['safe_to_call'] = $safe_to_call;
            $chatForm['race_or_ethnicity'] = $race;
            // $chatForm['hear_about_us'] = $about;
            $chatForm['case_id'] = $result;
            $this->victim_model->create_chat_form($chatForm);
            $data = array(
                "success" => "true",
                "message" => $msg1,
                "case_id" => $result,
                "userIdentity" => $this->victim_model->get_victim_id()
            );

            // notification code start from here

            $volunteers = $this->victim_model->get_volunteer($victim['language']);
            // print_r($volunteers);die;
            $title = "Victim found";
            $msg = "You have a new client";
            $arrNotification = array();
            $arrNotification["body"] = $msg;
            $arrNotification["title"] = $title;
            $arrNotification["sound"] = "default";
            $arrNotification["type"] = 1;
            $arrNotification["tag"] = 1;
            
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
                    $this->victim_model->insertNotification($android_notification_Data);
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
                    $this->victim_model->insertNotification($ios_notification_Data);
                }
                $this->fcm->send_notification($volunteers['ios'], $arrNotification, 'iOS', true, 1);
            }

            // notification code end here
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
        $victim['connection_type'] = $data['connection_type'];
        if (($this->form_validation->run() == true)) {
            $volunteer = $this->victim_model->getVolunteer($victim['language']);
            print_r($volunteer);die;
            /*if (empty($volunteer) && $data['language'] == "English") {
                $volunteer = $this->victim_model->getVolunteer("Arabic");
            }*/
			//print_r($volunteer); exit;
            if (!empty($volunteer)) {
                if ($volunteer[0]->available_status == "Available") {
                    if ($data['user_type'] == "new") {
						$victim['chat_opened'] = 0;
						$victim['opened_date'] = date('Y-m-d H:i:s');
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

                            if (empty($volunteer)) {
                                /*$volunteerList = [];
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
                                    //$this->fcm->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
									$this->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
                                    //echo '<pre>'; print_r($arrNotification); exit();
                                }

                                if (count($volunteerList['ios']) > 0) {
                                    //$this->fcm->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
									$this->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
                                    //echo '<pre>'; print_r($arrNotification); exit();
                                }*/
                                $res = array(
                                    'status' => "valid",
                                    "message" => "Volunteer found",
									"date" =>  $victim['opened_date'],
                                    'case_id' => $result,
									'volunteer' => $volunteer[0],
                                );
                            } else {
                                $res = array(
                                    'status' => "invalid",
									"date" =>  $victim['opened_date'],
                                    "message" => "Volunteer not found1",
                                );
                            }
                        }
                    } else {
                        $victim['case_id'] = $data['case_id'];
                        $check_case_id = $this->victim_model->check_victim($victim['case_id']);
						$victim['opened_date'] = date("Y-m-d H:i:s");
						
                        if ($check_case_id > 0) {
							$case_status = $this->victim_model->get_victim_status($victim['case_id']);
							//echo $case_status;
							if($case_status==2){
								$victim['status'] = 3;
							}
                            $result = $this->victim_model->update_victim($victim);
							//echo $result;
                            if (!empty($result)) {
                                $volunteer = $this->victim_model->getVolunteer($victim['language']);
                                if (!empty($volunteer)) {
                                    /*$volunteerList = [];
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
                                        //$this->fcm->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
										$this->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
                                        //echo '<pre>'; print_r($arrNotification); exit();
                                    }

                                    if (count($volunteerList['ios']) > 0) {
                                        //$this->fcm->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
										$this->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
                                        //echo '<pre>'; print_r($arrNotification); exit();
                                    }*/
                                    $res = array(
                                        'status' => "valid",
                                        "message" => "Volunteer found",
										"date" =>  $victim['opened_date'],
                                        'case_id' => $result,
                                        'volunteer' => $volunteer[0],
                                    );
                                } else {
                                    $res = array(
                                        'status' => "invalid",
										"date" =>  date('Y-m-d H:i:s'),
                                        "message" => "Volunteer not found2",
                                    );
                                }
                            }

                        } else {
                            $res = array(
                                'status' => "invalid",
								"date" =>  date('Y-m-d H:i:s'),
                                "message" => "Case Id Not found!",
                            );
                        }

                    }
                } else {
					$victim['case_id'] = $data['case_id'];
					$check_case_id = $this->victim_model->check_victim($victim['case_id']);
					$victim['opened_date'] = date("Y-m-d H:i:s");

					if ($check_case_id > 0) {
						$case_status = $this->victim_model->get_victim_status($victim['case_id']);
						//echo $case_status;
						if($case_status==2){
							$victim['status'] = 3;
						}
						$result = $this->victim_model->update_victim($victim);
					}
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
					
					
					/*if(count($volunteerList['android']) > 0){
						// echo $this->fcm->send_notification(array($volunteer->vol_token_id), $arrNotification,'Android',true);
						
						foreach ($volunteerList['android'] as $vol){
							//curl close
							$ch = curl_init();
							// Set the url, number of POST vars, POST data
							curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
							curl_setopt($ch, CURLOPT_POST, true);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							// Disabling SSL Certificate support temporarly
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt(
								$ch, 
								CURLOPT_POSTFIELDS, 
								json_encode(
									array(
										'to' => $vol->vol_token_id,
										'notification' => $arrNotification
									)
								)
							);
							$result = curl_exec($ch);
						}
					}
					if(count($volunteerList['ios']) > 0){
						//echo $this->fcm->send_notification(array($volunteer->vol_token_id), $arrNotification,'iOS',true);
						foreach ($volunteerList['ios'] as $vol){
							curl_setopt(
								$ch, 
								CURLOPT_POSTFIELDS, 
								json_encode(
									array(
										'to' => $vol->vol_token_id,
										'notification' => $arrNotification
									)
								)
							);
							$result = curl_exec($ch);
						}
					}
					//curl close
					if ($result === FALSE) {
						die('Curl failed: ' . curl_error($ch));
					}
					curl_close($ch);
					*/
					//if (count($volunteerList['android']) > 0) {
						//$this->fcm->send_notification($volunteerList['android'], $arrNotification, 'Android', true);
						//echo '<pre>'; print_r($arrNotification); exit();
					//}

					//if (count($volunteerList['ios']) > 0) {
						//$this->fcm->send_notification($volunteerList['ios'], $arrNotification, 'iOS', true);
						//echo '<pre>'; print_r($arrNotification); exit();
					//}
					
                    $res = array(
                        'status' => "invalid",
						"date" =>  $victim['opened_date'],
                        "message" => "All our volunteers are busy at the moment, please contact us in a few minutes.",
                    );
                }

            } else {
                $res = array(
                    'status' => "invalid",
					"date" =>  date('Y-m-d H:i:s'),
                    "message" => "Volunteer not found3",
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

    public function existingCases_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Device Id Required !!"; }
            if ($language == "ar"){ $msg1 = "معرف الجهاز مطلوب !!"; }
            if (empty($this->post('device_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $result = $this->victim_model->get_volExistingCases($this->post('device_id'));
                $data = array(
                    "success" => "true",
                    "message" => "",
                    "Data" => $result,
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function volConnetInConversationStatus_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Volunteer responded in this conversation !!"; $msg3 = "Case Id is not in our record !!"; $msg4 = "Volunteer not responded in this conversation !!"; }
            if ($language == "ar"){ $msg1 = "معرف الجهاز مطلوب !!"; $msg2 = "أجاب المتطوع في هذا الحديث !!"; $msg3 = "رقم الحالة غير موجود في سجلنا!!"; $msg4 = "لم يرد المتطوع في هذه المحادثة !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkCaseId = $this->victim_model->checkCaseId(); 
                if ($checkCaseId>0){
                    $checkVolunteerResponded = $this->victim_model->checkVolunteerResponded();
                    if($checkVolunteerResponded>0){
                        $data = array(
                            "success" => "true",
                            "message" => $msg2,
                            "volunteerConfirmation" => "1",
                            "volunteerIdentity" => $this->victim_model->getVolIdentity(),
                        );
                    }else{
                        $data = array(
                            "success" => "true",
                            "message" => $msg4,
                            "volunteerConfirmation" => "0",
                            "volunteerIdentity" => "",
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
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function reassignVolConnetInConversationStatus_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Volunteer responded in this conversation !!"; $msg3 = "Case Id is not in our record !!"; $msg4 = "Volunteer not responded in this conversation !!"; }
            if ($language == "ar"){ $msg1 = "معرف الجهاز مطلوب !!"; $msg2 = "أجاب المتطوع في هذا الحديث !!"; $msg3 = "رقم الحالة غير موجود في سجلنا!!"; $msg4 = "لم يرد المتطوع في هذه المحادثة !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkCaseId = $this->victim_model->checkCaseId(); 
                if ($checkCaseId>0){
                    $get_data = $this->db->get_where('wc_conversation_details',['case_id'=>$this->input->post('case_id')])->row();
                    if($get_data->reassign_number==null){
                        $status = "0";
                        $volunteerIdentity='';
                        $msg = $msg4;
                    }else if($get_data->reassign_number==1 && $get_data->reassign_volunteer_id == null){
                        $status = "0";
                        $volunteerIdentity='';
                        $msg = $msg4;
                    }else if($get_data->reassign_number==2 && $get_data->reassign_volunteer_id == null){
                        $status = "1";
                        $volunteerIdentity=$this->victim_model->getVolIdentity();;
                        $msg = $msg2;
                    }else if($get_data->reassign_volunteer_id != null){
                        $status = "1";
                        $volunteerIdentity=$this->victim_model->getVolIdentity();
                        $msg = $msg2;
                    }
                    $data = array(
                                "success" => "true",
                                "message" => $msg,
                                "volunteerConfirmation" =>$status,
                                "volunteerIdentity" => $volunteerIdentity,
                            );

                    // $checkAssignVolunteerResponded = $this->victim_model->checkAssignVolunteerResponded();
                    // if($checkAssignVolunteerResponded==0){
                    //     $data = array(
                    //         "success" => "true",
                    //         "message" => $msg4,
                    //         "volunteerConfirmation" => "0",
                    //         "volunteerIdentity" => "",
                    //     );
                    // }else{
                    //     $data = array(
                    //         "success" => "true",
                    //         "message" => $msg2,
                    //         "volunteerConfirmation" => "1",
                    //         "volunteerIdentity" => $this->victim_model->getVolIdentity(),
                    //     );
                    // }   
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3,
                    );
                }
                
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function getVictimIdentity_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Device Id Required !!"; $msg2 = "User exist with this device Id !!"; $msg3 = "User does not exist with this device Id !!"; }
            if ($language == "ar"){ $msg1 = "معرف الجهاز مطلوب !!"; $msg2 = "المستخدم موجود بمعرف الجهاز هذا !!"; $msg3 = "المستخدم غير موجود بمعرف هذا الجهاز !!"; }
            if (empty($this->post('device_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkVictimExist = $this->victim_model->checkVictimExist();
                if($checkVictimExist>0){
                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                        "userIdentity" => $this->victim_model->get_victim_id()
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3
                    );
                } 
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function videoCallStatus_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Video call requested with this case Id !!"; $msg3 = "Conversation does not exist with this case Id !!"; $msg4 = "Call From Required !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "تم طلب مكالمة فيديو باستخدام معرف الحالة هذا !!"; $msg3 = "المحادثة غير موجودة مع معرف هذه الحالة !!"; $msg4 = "الاتصال من المطلوب!!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkConversationCaseId = $this->victim_model->checkConversationCaseId();
                if($checkConversationCaseId>0){
                    $this->victim_model->updateVideoCallStatus(1);

                    // notification code start from here

                    // print_r($volunteers);die;
                    if ($this->input->post('callFrom') == 2){ 
                        $volunteers = $this->victim_model->get_case_victim();
                        $msg = "Volunteer is calling to you.";
                    }else{
                        $volunteers = $this->victim_model->get_case_volunteer();
                        $msg = "Client is calling to you.";
                    }
                    $title = "Incoming Video Call..."; 
                    $arrNotification = array();
                    $arrNotification["body"] = $msg;
                    $arrNotification["title"] = $title;
                    $arrNotification["sound"] = "default";
                    $arrNotification["type"] = 3;
                    $arrNotification["tag"] = 3;
                    $arrNotification["color"] = $this->post('case_id');
                    
                    if (count($volunteers['android']) > 0) {
                        // print_r($volunteers['android_user_id']);die;
                        foreach ($volunteers['android_user_id'] as $key => $value) {
                            // echo"<pre>";print_r($value);die;
                            $android_notification_Data = array(
                                                'user_id' => $value,
                                                'title' => $title,
                                                'message' => $msg,
                                                'type' => 3,
                                                'dateTime' => date('Y-m-d H:i:s')
                                                );
                            $this->victim_model->insertNotification($android_notification_Data);
                        }
                        $this->fcm->send_notification($volunteers['android'], $arrNotification, 'Android', true, 3);
                    }

                    if (count($volunteers['ios']) > 0) {
                        // print_r($volunteers['ios_user_id']);die;
                        foreach ($volunteers['ios_user_id'] as $key => $value) {
                            // echo"<pre>";print_r($value);die;
                            $ios_notification_Data = array(
                                                'user_id' => $value,
                                                'title' => $title,
                                                'message' => $msg,
                                                'type' => 3,
                                                'dateTime' => date('Y-m-d H:i:s')
                                                );
                            $this->victim_model->insertNotification($ios_notification_Data);
                        }
                        $this->fcm->send_notification($volunteers['ios'], $arrNotification, 'iOS', true, 3);
                    }

                    // notification code end here

                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3
                    );
                } 
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function endVideoCallStatus_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Video call ended with this case Id !!"; $msg3 = "Conversation does not exist with this case Id !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "انتهت مكالمة الفيديو بمعرف الحالة هذا !!"; $msg3 = "المحادثة غير موجودة مع معرف هذه الحالة !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkConversationCaseId = $this->victim_model->checkConversationCaseId();
                if($checkConversationCaseId>0){
                    $this->victim_model->updateVideoCallStatus(0);
                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3
                    );
                } 
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function voiceCallStatus_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Voice call requested with this case Id !!"; $msg3 = "Conversation does not exist with this case Id !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "مكالمة صوتية مطلوبة مع معرف هذه الحالة !!"; $msg3 = "المحادثة غير موجودة مع معرف هذه الحالة !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkConversationCaseId = $this->victim_model->checkConversationCaseId();
                if($checkConversationCaseId>0){
                    $this->victim_model->updateVoiceCallStatus(1);

                    // notification code start from here

                    if ($this->input->post('callFrom') == 2){ 
                        $volunteers = $this->victim_model->get_case_victim();
                        $msg = "Volunteer is calling to you.";
                    }else{
                        $volunteers = $this->victim_model->get_case_volunteer();
                        $msg = "Client is calling to you.";
                    }
                    $title = "Incoming Voice Call..."; 
                    $arrNotification = array();
                    $arrNotification["body"] = $msg;
                    $arrNotification["title"] = $title;
                    $arrNotification["sound"] = "default";
                    $arrNotification["type"] = 2;
                    $arrNotification["tag"] = 2;
                    
                    if (count($volunteers['android']) > 0) {
                        // print_r($volunteers['android_user_id']);die;
                        foreach ($volunteers['android_user_id'] as $key => $value) {
                            // echo"<pre>";print_r($value);die;
                            $android_notification_Data = array(
                                                'user_id' => $value,
                                                'title' => $title,
                                                'message' => $msg,
                                                'type' => 2,
                                                'dateTime' => date('Y-m-d H:i:s')
                                                );
                            $this->victim_model->insertNotification($android_notification_Data);
                        }
                        $this->fcm->send_notification($volunteers['android'], $arrNotification, 'Android', true, 2);
                    }

                    if (count($volunteers['ios']) > 0) {
                        // print_r($volunteers['ios_user_id']);die;
                        foreach ($volunteers['ios_user_id'] as $key => $value) {
                            // echo"<pre>";print_r($value);die;
                            $ios_notification_Data = array(
                                                'user_id' => $value,
                                                'title' => $title,
                                                'message' => $msg,
                                                'type' => 2,
                                                'dateTime' => date('Y-m-d H:i:s')
                                                );
                            $this->victim_model->insertNotification($ios_notification_Data);
                        }
                        $this->fcm->send_notification($volunteers['ios'], $arrNotification, 'iOS', true, 2);
                    }

                    // notification code end here

                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3
                    );
                } 
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function endVoiceCallStatus_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "Case Id Required !!"; $msg2 = "Voice call ended with this case Id !!"; $msg3 = "Conversation does not exist with this case Id !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "انتهت المكالمة الصوتية بمعرف هذه الحالة !!"; $msg3 = "المحادثة غير موجودة مع معرف هذه الحالة !!"; }
            if (empty($this->post('case_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $checkConversationCaseId = $this->victim_model->checkConversationCaseId();
                if($checkConversationCaseId>0){
                    $this->victim_model->updateVoiceCallStatus(0);
                    $data = array(
                        "success" => "true",
                        "message" => $msg2,
                    );
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => $msg3
                    );
                } 
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function getUserNotifications_post(){
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                "success" => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                "success" => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            if ($language == "en"){ $msg1 = "User Id Required !!"; $msg2 = "Voice call ended with this case Id !!"; $msg3 = "Conversation does not exist with this case Id !!"; }
            if ($language == "ar"){ $msg1 = "معرف الحالة مطلوب !!"; $msg2 = "انتهت المكالمة الصوتية بمعرف هذه الحالة !!"; $msg3 = "المحادثة غير موجودة مع معرف هذه الحالة !!"; }
            if (empty($this->post('user_id'))) {
                $data = array(
                    "success" => "false",
                    "message" => $msg1,
                );
            }else{
                $getUserNotifications = $this->victim_model->getUserNotifications();
                $data = array(
                    "success" => "true",
                    "message" => "",
                    "Data" => $getUserNotifications
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
