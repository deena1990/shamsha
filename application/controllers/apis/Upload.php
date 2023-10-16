<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Upload extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/upload_model');
    }
    
   public function index_post() {
       
       
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
						$picture = $uploadData['file_name'];
					}else{
						$picture = '';
					}
				}else{
					$picture = '';
				}
				
				 $user=array('ufile' =>$picture, 'name' => $this->input->get_post('name'),'rcode' => $this->input->get_post('rcode'));
            	$this->upload_model->upload($user);
                        
                $returndata = array('status'=>0,'data'=>'user details','message'=>'image uploaded successfully');
                $this->set_response($returndata, 200); 
       
              
               /* $this->load->library('upload',$config);
                 
                if($this->upload->do_upload('file_name')) 
                {
                     print_r('hi');
                $data = array('upload_data' => $this->upload->data());
                $path = $config['upload_path'].'/'.$data['upload_data']['orig_name'];
                print_r($path);
                        // Write query to store image details of login user { }
                          $user=array('ufile' =>$path, 'name' => $this->input->get_post('name'),'rcode' => $this->input->get_post('rcode'));
                		//print_r($user);
                		//die();
                			$this->upload_model->upload($user);
                        
                $returndata = array('status'=>0,'data'=>'user details','message'=>'image uploaded successfully');
                $this->set_response($returndata, 200); 
                }
                else
                {
                $error = array('error' => $this->upload->display_errors());
                $returndata = array('status'=>0,'data'=>$error,'message'=>'image upload failed');
                $this->set_response($returndata, 200); 
                }
                }*/

   }

}
