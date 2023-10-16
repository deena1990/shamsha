<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Sponsership_contact extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('apis/sponsership_contact_model');
        $this->load->library('form_validation');
    }

    public function add_post(){
        $res = [];
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['company'] = $this->input->post('company');
        $data['message'] = $this->input->post('message');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('company', 'Company', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if (($this->form_validation->run() == true)) {
            $result = $this->sponsership_contact_model->insert($data);
            if($result){
                $res = array(
                    'status' => "valid",
                    "message" => "Added Successfully",
                );
            }
            else{
                $res = array(
                    'status' => "invalid",
                    "message" => "Something went wrong",
                );
            }
        }
        else{
            $errors = $this->form_validation->error_array();
            $fields = array_keys($errors);
            $err_msg = $errors[$fields[0]];
            $res= array(
                'status' => "invalid",
                "message" => $err_msg,
            );
        }

        $this->response($res, REST_Controller::HTTP_OK);
    }
}