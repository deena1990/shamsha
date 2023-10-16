<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Con_message extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/conmesg_model');
    }

    public function index_post() {
        
        /*if (empty($this->post('name'))) {
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
        
        if (empty($this->post('message'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Message is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }*/
       
       	
        $user=array('name' => $this->input->get_post('name'), 'email' => $this->input->get_post('email'), 
        'message' => $this->input->get_post('message'), 'phone' => $this->input->get_post('phone'));
        $result = $this->conmesg_model->upload($user);
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
            if ($language == "en"){ $s_msg = "Message sent successfully !!"; $f_msg = "Message not sent"; }
            if ($language == "ar"){ $s_msg = "تم ارسال الرسالة بنجاح !!"; $f_msg = "لم يتم إرسال الرسالة"; }
            if ($result) {
                $data = array(
                    'success' => "true",
                    "message" => $s_msg,
                    //"data" => array(),
                );
            } else {
                $data = array(
                    'success' => "false",
                    "message" => $f_msg,
                    //"data" => array(),
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
