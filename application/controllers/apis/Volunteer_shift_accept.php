<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_shift_accept extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_shift_accpt_model');
         $this->load->model('event_model');
         $this->load->library('FCM');
    }



    public function index_post() {
        $check = $this->vol_shift_accpt_model->accept_shift();
        //echo '<pre>'; print_r($check); exit;
       if ($check) {

           $volunteer_id = trim($this->input->post('volunteer_id'));
           $schedule_id = trim($this->input->post('schedule_id'));
           $sql = "SELECT * FROM `wc_voulnteer` WHERE vounter_id='$volunteer_id'";
           $vol = $this->db->query($sql)->row_array();

           $sqll = "SELECT * FROM wc_schedule WHERE w_sch_id='$schedule_id'";
           $sch = $this->db->query($sqll)->row_array();

           $sql2 = "SELECT * FROM wc_shifts WHERE wcsid='".$sch['shift_id']."'";
           $shf = $this->db->query($sql2)->row_array();

           //$regId ="cKbVkPz3QlWOHs2lpMGUCK:APA91bHSULWFCoYhRalAPgO918sJA4fHgCSCi_HZSSNVn_I_iEy1uxz8mssVFiN-7n1LAzY0SWuJRxqCM8FrFT00K6KWpZWqzTOpOfgH0iF7635Q_Q06SOvAYZrhQWlJcTo3CR5RSO5I";

            $notification = array();
            $arrNotification= array();
            $arrData = array();
           $msg = $shf['shift_language'] . " " . $shf['shift_name'] . " on " . $sch['date'] . ", " . $shf['start_time'] . " accepted by " . $vol['vname'];
            

           $regId=$vol['vol_token_id'];
           //print_r($regId);
            $volunteers = $this->event_model->get_volunteers_language($shf['shift_language']);
                          
           if(!empty($volunteers)) {

                //  $arrNotification = array();
                //             $arrNotification["body"] = $msg;
                //             $arrNotification["title"] = "Shift Accept Alert";
                //             $arrNotification["sound"] = "default";
                //             $arrNotification["type"] = 1;
                //           if(count($volunteers['android'])>0){
                //             $this->fcm->send_notification($volunteers['android'], $arrNotification,'Android',true);
                //             }
                            
                //             if(count($volunteers['ios'])>0){
                //             $this->fcm->send_notification($volunteers['ios'], $arrNotification,'iOS',true);
                //             }
               
                $data = array(
                    'status' => "valid",
                    "message" => $shf['shift_language'] . " " . $shf['shift_name'] . " on " . $sch['date'] . ", " . $shf['start_time'] . " accepted by " . $vol['vname'],
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
                "message" => "Cannot Accept",
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
}
