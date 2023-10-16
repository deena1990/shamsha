<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
//require APPPATH . 'fcm/FCM.php';

class Volunteer_shift_request extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_shift_request_model');
        $this->load->model('event_model');
        $this->load->library('FCM');
    }



    public function index_post() {
        
 $volunteer_id = trim($this->input->post('volunteer_id'));
        $schedule_id = trim($this->input->post('schedule_id'));

        if(!empty($volunteer_id) AND !empty($schedule_id)){
        $check = $this->vol_shift_request_model->shift_request();
        if ($check) {

                $sql = "SELECT * FROM `wc_voulnteer` WHERE vounter_id='$volunteer_id'";
                $vol = $this->db->query($sql)->row_array();
                //print_r($sql); exit;

                $sqll = "SELECT * FROM wc_schedule WHERE w_sch_id='$schedule_id'";
                $sch = $this->db->query($sqll)->row_array();

                $sql2 = "SELECT * FROM wc_shifts WHERE wcsid='".$sch['shift_id']."'";
                $shf = $this->db->query($sql2)->row_array();

                //$regId ="cKbVkPz3QlWOHs2lpMGUCK:APA91bHSULWFCoYhRalAPgO918sJA4fHgCSCi_HZSSNVn_I_iEy1uxz8mssVFiN-7n1LAzY0SWuJRxqCM8FrFT00K6KWpZWqzTOpOfgH0iF7635Q_Q06SOvAYZrhQWlJcTo3CR5RSO5I";

                $notification = array();
                $arrNotification= array();
                $arrData = array();
                $msg = $shf['shift_language']." ".$shf['shift_name']." on ".$sch['date'].", ".$shf['start_time']." requested by ".$vol['vname'];


                $regId=$vol['vol_token_id'];
                
                $volunteers = $this->event_model->get_volunteers_language($shf['shift_language']);
               // print_r($volunteers); exit;

                if(!empty($volunteers)) {

                    $arrNotification = array();
                    $arrNotification["body"] = $msg;
                    $arrNotification["title"] = $shf['shift_language']." Swap Request";
                    $arrNotification["sound"] = "default";
                    $arrNotification["type"] = 1;
                    if(count($volunteers['android'])>0){
                        $this->fcm->send_notification($volunteers['android'], $arrNotification,'Android',true);
                    }

                    if(count($volunteers['ios'])>0){
                        $this->fcm->send_notification($volunteers['ios'], $arrNotification,'iOS',true);
                    }

                    $data = array(
                        'status' => "valid",
                        "message" => $shf['shift_language']." ".$shf['shift_name']." on ".$sch['date'].", ".$shf['start_time']." requested by ".$vol['vname'],
                        //"data" => array(),
                    );
                }
                else{
                    $data = array(
                        'status' => "invalid",
                        "message" => "No Token",
                        //"data" => array(),
                    );
                }
            } else {
                $data = array(
                    'status' => "invalid",
                    "message" => "Cannot Requested",
                );
            }

                
        $this->response($data, REST_Controller::HTTP_OK);
        }
        
    }
    
   public function list_post() {
        $list = $this->vol_shift_request_model->shift_request_list();
       //print_r($list);
       if ($list) {
 /*          $regId ="cKbVkPz3QlWOHs2lpMGUCK:APA91bHSULWFCoYhRalAPgO918sJA4fHgCSCi_HZSSNVn_I_iEy1uxz8mssVFiN-7n1LAzY0SWuJRxqCM8FrFT00K6KWpZWqzTOpOfgH0iF7635Q_Q06SOvAYZrhQWlJcTo3CR5RSO5I";
$notification = array();
$arrNotification= array();			
$arrData = array();											
$arrNotification["body"] ="Test by Shamsaha.";
$arrNotification["title"] = "My Shift Cancel Notification";
$arrNotification["sound"] = "default";
$arrNotification["type"] = 1;
 
$fcm = new FCM();
$result = $fcm->send_notification($regId, $arrNotification,"Android");*/

             $data = $list;
        } else {
            $data = array(array(
                'status' => "invalid",
                "message" => "Not found",
            ));
        }
        $this->response($data, REST_Controller::HTTP_OK);
         
        
    }

    public function accept_post() {
        $schedule_id = trim($this->input->post('schedule_id'));
         $sqll = "SELECT wc_voulnteer.vol_token_id, wc_voulnteer.device FROM wc_schedule inner join wc_voulnteer on wc_voulnteer.vounter_id = wc_schedule.volunteer_assign WHERE wc_schedule.w_sch_id='$schedule_id'";
          $sch = $this->db->query($sqll)->row_array();
        $accept = $this->vol_shift_request_model->shift_accept();
        if ($accept) {
             $sql2 = "SELECT wc_voulnteer.vname,wc_voulnteer.vol_token_id, wc_voulnteer.device,wc_schedule.date FROM wc_schedule inner join wc_voulnteer on wc_voulnteer.vounter_id = wc_schedule.volunteer_assign WHERE wc_schedule.w_sch_id='$schedule_id'";
             $sch2 = $this->db->query($sql2)->row_array();
            $notification = array();
            $arrNotification= array();
            $arrData = array();
            $msg = "Shift cancellation request for ".date('d-m-Y', strtotime($sch2['date']))." accepted by ".$sch2['vname'];
             $arrNotification = array();
            $arrNotification["body"] = $msg;
            $arrNotification["title"] = "Shift Accept Alert";
            $arrNotification["sound"] = "default";
            $arrNotification["type"] = 1;
            if($sch['device'] == 'Android'){
               $this->fcm->send_notification(array($sch['vol_token_id']), $arrNotification,'Android',true);
            }
                            
           if($sch['device'] == 'iOS'){
                $this->fcm->send_notification(array($sch['vol_token_id']), $arrNotification,'iOS',true);
           }
            
            $data = array(
                'status' => "success",
                "message" => "Shift Accepted",
            );
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not found",
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);


    }

}
