<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller
{
	private $headers;// Firebase API Key
	private $url;
    public function __construct()
    {
        parent::__construct();
        //$this->load->library('FCM');
        $this->load->helper('form');
        $this->load->model('cron_model');
		$this->headers = array(
			'Authorization:key=AAAApdHl590:APA91bFVCJKCAAKUko7ZFn3jeUTisGxu7UNDeVD3EiZ5KWq7gvaBVUzp_0PAx-mQid4FHQMVXRhSnU8rYfHBWsJJmuytTFYEr3S3-Yt2nUPigOGv7jhS0iE6ZkFfU_o_4j4IyTkwNIx3',
			'Content-Type:application/json');
		$this->url = 'https://fcm.googleapis.com/fcm/send';
    }


    public function dailyNotificationBeforeOneHour(){
        if($this->input->is_cli_request())
        {
			echo "dailyNotificationBeforeOneHour\n";
            $model = $this->cron_model->getTodayShiftVolunteer();
			//print_r($model);
            foreach ($model as $volunteer){
               	if($volunteer->timeLeft <= 60 && $volunteer->timeLeft > 30){
                    $timeLeft = 60;
                    $msg = "Don’t forget your ". $volunteer->shift_language." ". $volunteer->shift_name." starts in ".$timeLeft." minutes on ".date('l, d M Y', strtotime($volunteer->date)). ", ". $volunteer->shift_time;
                }
                 if($volunteer->timeLeft <= 30 && $volunteer->timeLeft > 10){
                    $timeLeft = 30;
                    $msg = "Get ready! Your  ". $volunteer->shift_language." ". $volunteer->shift_name." starts in ".$timeLeft." minutes on ".date('l, d M Y', strtotime($volunteer->date)). ", ". $volunteer->shift_time;
                }
                if($volunteer->timeLeft <= 10 && $volunteer->timeLeft > 0){
                   $timeLeft = 10; 
                   $msg = "Get ready! Your ". $volunteer->shift_language." ". $volunteer->shift_name." starts in ".$timeLeft." minutes on ".date('l, d M Y', strtotime($volunteer->date)). ", ". $volunteer->shift_time;
                }
                $arrNotification = array();
                $arrNotification["body"] = $msg;
                $arrNotification["title"] = "🔴 Shift Reminder!";
                $arrNotification["sound"] = "default";
                $arrNotification["type"] = 1;
                if($volunteer->device == "Android"){
                    //echo $this->fcm->send_notification(array($volunteer->vol_token_id), $arrNotification,'Android',true);
					$ch = curl_init();
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $this->url);
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
									'to' => $volunteer->vol_token_id,
									'notification' => $arrNotification
								)
							)
						);
						$result = curl_exec($ch);
						if ($result === FALSE) {
							die('Curl failed: ' . curl_error($ch));
						}
						curl_close($ch);
                }
                if($volunteer->device == "iOS"){
                    //echo $this->fcm->send_notification(array($volunteer->vol_token_id), $arrNotification,'iOS',true);
					$ch = curl_init();
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $this->url);
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
									'to' => $volunteer->vol_token_id,
									'notification' => $arrNotification
								)
							)
						);
						$result = curl_exec($ch);
						if ($result === FALSE) {
							die('Curl failed: ' . curl_error($ch));
						}
						curl_close($ch);
                }
				echo $volunteer->vol_token_id;
            }
            echo "success";
        }
        else
        {
            echo "You dont have access";
        }
    }

    public function dailyShiftAlertNotification(){
//        date_default_timezone_set('Asia/Kuwait');
//        $date = date('Y-m-d', strtotime(' +1 day'));
//        echo $date; exit;
		//echo "dailyShiftAlertNotification\n";
        if($this->input->is_cli_request())
        {
            $model = $this->cron_model->getTomorrowShiftVolunteer();
            //print_r($model); 
            if(!empty($model)){
                foreach ($model as $volunteer){
                    $arrNotification = array();
                   $arrNotification["body"] = " Don’t forget you have an  ". $volunteer->shift_language." ". $volunteer->shift_name." tomorrow
on ".date('l, d M Y', strtotime($volunteer->date)). ", ". $volunteer->shift_time;
                    $arrNotification["title"] = "🔴 Shift Reminder!";
                    $arrNotification["sound"] = "default";
                    $arrNotification["type"] = 1;
                    if($volunteer->device == "Android"){
                        $ch = curl_init();
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $this->url);
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
									'to' => $volunteer->vol_token_id,
									'notification' => $arrNotification
								)
							)
						);
						$result = curl_exec($ch);
						if ($result === FALSE) {
							die('Curl failed: ' . curl_error($ch));
						}
						curl_close($ch);
                    }
                    if($volunteer->device == "iOS"){
						$ch = curl_init();
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $this->url);
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
									'to' => $volunteer->vol_token_id,
									'notification' => $arrNotification
								)
							)
						);
						$result = curl_exec($ch);
						if ($result === FALSE) {
							die('Curl failed: ' . curl_error($ch));
						}
						curl_close($ch);
                    }
                }
				
                echo "success";
            }
            else{
                echo "failed";
            }

        }
        else
        {
            echo "You dont have access";
        }
    }
}
