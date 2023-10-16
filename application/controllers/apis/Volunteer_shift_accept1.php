<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_shift_accept1 extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/vol_shift_accpt_model1');
    }

    public function index_post() {
        
        $check = $this->vol_shift_accpt_model1->check_shift();
       if($check == 0){
           $data = array(
                'status' => "invalid",
                "message" => "You cannot Accept for past days",
                //"data" => array(),
            );
       }else{
           $check = $this->vol_shift_accpt_model1->check_vol_shift();
           //print_r($check);
           if($check == 0){
               $result = $this->vol_shift_accpt_model1->update_vol_shift();
              // print_r($result);
               $data = array(
                'status' => "valid",
                "message" => "Shift Accepted as all are empty",
                //"data" => array(),
            );
           }else if($check == 4){
               $data = array(
                'status' => "invalid",
                "message" => "All shifts are occupied",
                //"data" => array(),
            );
           }else{
               $result = $this->vol_shift_accpt_model1->update_vol_shift_on_empty();
                //print_r($result);
                if($result == 0){
                    $data = array(
                        'status' => "invalid",
                        "message" => "shift not occupied",
                        //"data" => array(),
                    );
                }else{
                       $data = array(
                        'status' => "valid",
                        "message" => "shift occupied",
                        //"data" => array(),
                    );
                }
           }
       }
        
         $this->response($data, REST_Controller::HTTP_OK);
    }

}
