<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Vol_contact extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->model('apis/vol_contact_model');
    }

    public function index_post() {
       // print('hi');
       
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        $this->form_validation->set_rules('intrest', 'Intrest', 'trim|required');

        if(!empty($_FILES['ufile']['name'])){
					$config['upload_path'] = 'uploads/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = 2000;
					$config['max_width'] = 1500;
					$config['max_height'] = 1500;
					$config['file_name'] = $_FILES['ufile']['name'];
			
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
			
					if($this->upload->do_upload('ufile'))
					{
						$uploadData = $this->upload->data();
						
						$url = base_url();		      				
            			$picture = $url.'uploads/'.$uploadData['file_name'];

						
						//$picture = $uploadData['file_name'];
					}else{
						$picture = '';
					}
				}else{
					$picture = '';
				}

        if ($this->form_validation->run() == FALSE)
        {
            print_r($this->form_validation->error_array());
    //echo "ERRR!!";
        }
        else
        {
            //print('hi');
             $user=array('ufile' =>$picture, 'name' => $this->input->get_post('name'),'mobile' => $this->input->get_post('mobile'), 
             'address' => $this->input->get_post('address'), 'email' => $this->input->get_post('email'), 
             'intrest' => $this->input->get_post('intrest'));
            	//$this->upload_model->upload($user);
            $register_user = $this->vol_contact_model->insert_con($user);
           // $insert_id = $this->db->insert_id();
		
			//	$aa = $this->register_victim_model->update_victimid_entry($insert_id);
            if($register_user){
                $data = array(
                    'status' => "valid",
                    "message" => "Submitted Successfully",
                    //"data" => $register_user,
                );
                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
        }

        
        
    
        
     
    }

}
