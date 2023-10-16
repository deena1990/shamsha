<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Register_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->model('apis/register_victim_model');
    }

    public function index_post() {
        
        //$this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required|is_unique[wc_victim.device_id]');
		$this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required');//|is_unique[wc_victim.device_id]
        $this->form_validation->set_rules('pin', 'Password', 'trim|required|max_length[4]');
        $this->form_validation->set_rules('conf_pin', 'Password Confirmation', 'trim|required|matches[pin]');
        //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[wc_victim.email]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');//|is_unique[wc_victim.email]
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim');

        if ($this->form_validation->run() == FALSE)
        {
           
           $data = array(
                    'status' => "invalid1",
                    "message" => array_values($this->form_validation->error_array())[0],
                    //"data" => $register_user,
                );
           return  $this->response($data, REST_Controller::HTTP_OK);
                // $this->output->_display();
                // exit;
        }
        else
        {
			$userExists = $this->register_victim_model->check_victim_exists();
			if($userExists>0){
				$update_user = $this->register_victim_model->update_victim_user();
				
				$data = array(
					'status' => "valid",
					"message" => "User Exists Upadated",
					//"data" => $register_user,
				);
				return $this->response($data, REST_Controller::HTTP_OK);
			}else{
				$register_user = $this->register_victim_model->register_user();
				$insert_id = $this->db->insert_id();

				$aa = $this->register_victim_model->update_victimid_entry($insert_id);
				if($register_user){
					$data = array(
						'status' => "valid",
						"message" => "User Registered",
						//"data" => $register_user,
					);
					return $this->response($data, REST_Controller::HTTP_OK);
					// $this->output->_display();
					// exit;
				}
			}
        }

        
        //print_r($check_device);
       /* if ($register_user == 0) {
            $data = array(
                'status' => "invalid",
                "message" => "device not found",
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
                    'status' => "invalid",
                    "message" => "User not found with this device ID",
                    //"data" => array(),
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }else{
                $data = array(
                    'status' => "valid",
                    "message" => "User found with this device ID",
                    //"data" => array(),
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
        }*/
    
        
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
        
         //$this->response($data, REST_Controller::HTTP_OK);
    }

}
