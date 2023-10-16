<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Jobapply extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/jobapply_model');
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
        if (empty($this->post('address'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Address is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
        
        if(!empty($_FILES['ufile']['name'])){
					$config['upload_path'] = 'uploads/';
					$config['allowed_types'] = 'doc|pdf|docx';
					$config['max_size'] = 5000;
					$config['max_width'] = 1500;
					$config['max_height'] = 1500;
					$config['file_name'] = $_FILES['ufile']['name'];
			
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
			
					if($this->upload->do_upload('ufile'))
					{
						$uploadData = $this->upload->data();
						$picture = $uploadData['file_name'];
					}else{
						$picture = '';
					}
						$url = base_url();		      				
			$picture2 = $url.'uploads/'.$picture;
				}else{
					 $data = array(
                'status' => "invalid",
                "message" => "File is Required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
				}
				
				 $user=array('user_cv' =>$picture2, 'name' => $this->input->get_post('name'),'email' => $this->input->get_post('email'), 
				 'phone' => $this->input->get_post('phone'), 'address' => $this->input->get_post('address'), 
				 'extra_info' => $this->input->get_post('statement'), 'job_id' => $this->input->get_post('jobid'),
				 'status' => 'Active'
				 );
            	$result = $this->jobapply_model->upload($user);
    
        if ($result) {
            $data = array(
                'status' => "valid",
                "message" => "Applied Successfully",
                //"data" => array(),
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
