<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Checkdevice extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/checkdevice_model');
    }

    public function index_post() {
        if (empty($this->post('deviceid'))) {
            $data = array(
                'status' => "false",
                "message" => "Please enter device id",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        $check_device = $this->checkdevice_model->check_device();
       // print_r($check_device);
        if ($check_device == 0) {
            $data = array(
                'success' => "false",
                "message" => "This device id is not found in our record",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }else{
            $result = $this->checkdevice_model->check_victim();
            //print_r($result);
            if($result == 0){
                $data = array(
                    'success' => "false",
                    "message" => "User not found with this device ID",
                    //"data" => array(),
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }else{
                $data = array(
                    'success' => "true",
                    "message" => "User found with this device ID",
                    //"data" => array(),
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
        }
    
        
       /* $result = $this->volunteer_login_model->check_login_data();
        if ($result) {
            $data = array(
                'status' => "valid",
                "message" => "Logged in Successfully",
                //"data" => array(),
                "data" => $result
            );
           
            $this->volunteer_login_model->save_log_data();
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Invalid credentails, Please try again",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);*/
    }

}
