<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_pin extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('apis/volunteer_login_model');
        //$this->load->model('apis/schedule_model');
    }

    public function index_post() {
        
        $this->form_validation->set_rules('pin', 'Password', 'trim|required|max_length[4]');
        $this->form_validation->set_rules('conf_pin', 'Password Confirmation', 'trim|required|matches[pin]');

        if ($this->form_validation->run() == FALSE)
        {
            //print_r($this->form_validation->error_array());
    //echo "ERRR!";
    $data = $this->form_validation->error_array();
        }
        else
        {
            $result = $this->volunteer_login_model->volunteer_pin();
            $data = array(
                'status' => "valid",
                "message" => "Pin Created Successfully",
                //"data" => array(),
                //"data" => $result
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
