<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Testfile extends REST_Controller {

    function __construct() {
        parent::__construct();
       // $this->load->model('apis/resource_model');
    }

    public function index_post() {
        
       
       $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        

        if ($this->form_validation->run() == FALSE)
        {
            //print_r($this->form_validation->error_array());
            //echo "ERRR!!";
            $data = $this->form_validation->error_array();
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        else
        {
            $user=array('name' => $this->input->get_post('name'),'email' => $this->input->get_post('email')
				 );
           
            if($user){
                $data = array(
                    'status' => "valid",
                    "message" => "Sponser Registered",
                    //"data" => $register_user,
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
        }
       
       
    }

}
