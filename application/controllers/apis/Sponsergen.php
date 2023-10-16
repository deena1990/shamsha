<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Sponsergen extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->model('apis/sponser_model');
    }

    public function index_post() {
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
        

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
            $user=array('name' => $this->input->get_post('name'),'email' => $this->input->get_post('email'), 
				 'mobile' => $this->input->get_post('mobile'), 'address' => $this->input->get_post('address'), 
				 'memo' => $this->input->get_post('memo'), 'stype' => 'General', 'price'  => $this->input->get_post('price'), 
				 'payment_type' => $this->input->get_post('payment_type'), 'status' => 'Active'
				 );
            $register_user = $this->sponser_model->general_sponser($user);
            $insert_id = $this->db->insert_id();
		    $aa = $this->sponser_model->update_sponserid_entry($insert_id);
            if($register_user){
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
