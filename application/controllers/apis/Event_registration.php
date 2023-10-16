<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Event_registration extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/event_registration_model');
    }

    public function index_post() {
        
        if (empty($this->post('name'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Name is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        if (empty($this->post('email'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Email is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        if (empty($this->post('phone'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Phone is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        //  if (empty($this->post('amount'))) {
        //     $data = array(
        //         'status' => "invalid",
        //         "message" => "Amount is Required",
        //         //"data" => array(),
        //     );
        //     $this->response($data, REST_Controller::HTTP_OK);
        //     $this->output->_display();
        //     exit;
        // }
        /*if (empty($this->post('address'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Address is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }*/



				 $user=array('event_id' => $this->input->get_post('event_id'),'name' => $this->input->get_post('name'),'email' => $this->input->get_post('email'), 
				 'phone' => $this->input->get_post('phone'), 'address' => $this->input->get_post('address'), 
				 
				 'status' => 'Active',
				 'amount' => $this->input->get_post('amount')
				 );
            	$result = $this->event_registration_model->upload($user);
    
        if ($result) {
            $data = array(
                'status' => "valid",
                "message" => "Registered Successfully",
                //"data" => array(),
                'reg_id' =>  $this->db->insert_id()
            );
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
