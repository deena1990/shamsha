<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Change_pin_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('apis/create_pin_victim_model');
    }

    public function index_post() {
        
        $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('pin', 'Pin', 'trim|required|max_length[4]');
        $this->form_validation->set_rules('new_pin', 'New Pin', 'trim|required|max_length[4]');

        if ($this->form_validation->run() == FALSE)
        {
           $data = array(
                    "success" => "false",
                    "message" => array_values($this->form_validation->error_array())[0],
                );
           return  $this->response($data, REST_Controller::HTTP_OK);
        }
        else
        {
			$userExists = $this->create_pin_victim_model->check_victim_exist();
			if($userExists>0){
				$pin_user = $this->create_pin_victim_model->check_pin_victim_exist();
                if($pin_user>0){
                    $update_user = $this->create_pin_victim_model->create_pin_victim();
                    $data = array(
                        "success" => "true",
                        "message" => "Pin created successfully !!",
                    );
                    return $this->response($data, REST_Controller::HTTP_OK);
                }else{
                    $data = array(
                        "success" => "false",
                        "message" => "Pin already created !!",
                    );
                    return $this->response($data, REST_Controller::HTTP_OK);
                }
			}else{
				$data = array(
					"success" => "false",
					"message" => "Mobile number is not in our record !!",
				);
				return $this->response($data, REST_Controller::HTTP_OK);
			}
        }
    }

}
