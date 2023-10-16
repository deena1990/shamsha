<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Changepin_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->model('apis/changepin_victim_model');
    }

    public function index_post() {
        $this->form_validation->set_rules('deviceid', 'Device Id', 'trim|required[wc_victim.device_id]');
        $this->form_validation->set_rules('pin', 'Password', 'trim|required|max_length[4]');

        /*if ($this->form_validation->run() == FALSE)
        {
            print_r($this->form_validation->error_array());
        }
        else
        {*/
            $change_pin = $this->changepin_victim_model->change_victim_pin();
            //echo '<pre>'; print_r($change_pin); exit;
            if($change_pin){
                $data = array(
                    'status' => "valid",
                    "message" => "PIN Changed",
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
        //}
    }
}
