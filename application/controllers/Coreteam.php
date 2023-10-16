<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coreteam extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('CTM_model');
		
}
	
			 public function add()
		    {
		    
		if($this->input->post('submit'))
		      {
		         
		              if(!empty($_FILES['image']['name'])){
					$config['upload_path'] = 'uploads/about/';
					$config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
					$config['max_size'] = 50000;
					$config['max_width'] = 3500;
					$config['max_height'] = 3500;
					$config['file_name'] = $_FILES['image']['name'];
					$config['file_ext'] = $_FILES['image']['name'];
			
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
			
					if($this->upload->do_upload('image'))
					{
					    //print_r('hi');
						$uploadData = $this->upload->data();
						$picture = $uploadData['file_name'];
						$ff = $uploadData['file_ext'];
						
					}else{
					   // print_r('hello');
						$picture = '';
					}
				}else{
				     //print_r('text');
					$picture = '';
				}
	
				$url = base_url();		      				
				$picture2 = $url.'uploads/about/'.$picture;
				$file_type = $ff;
			
		      	
					$user=array( 'image' => $picture2, 'name' =>$this->input->post('name'), 'designation' =>$this->input->post('designation'));
				
		       
         
	//print_r($user);
	//	die();
		$this->CTM_model->add($user);
		
		$this->session->set_flashdata('msg',"Team Members has been added successfully");
		$base_url=base_url();
		redirect("$base_url"."coreteam/list");
		       }
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Core Team Members';
       $this->load->view('header',$data);
		$this->load->view('ctmember');
        $this->load->view('user_footer');
		  }

	function list()
	{
			$data['ctmemberlist']=$this->CTM_model->get_entries();
			$data['site_title'] = 'Admin Dashboard'; //Title
			$data['page_title'] = 'Core Team Members';
        	$this->load->view('header',$data);
			$this->load->view('ctmemberlist',$data);
			$this->load->view('user_footer');
	}

	public function edit($id)
  	{
    			if($this->input->post('submit'))
				{
					if(!empty($_FILES['image']['name'])){
					$config['upload_path'] = 'uploads/about/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = 50000;
					$config['max_width'] = 3500;
					$config['max_height'] = 3500;
					$config['file_name'] = $_FILES['image']['name'];
			
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
			
					if($this->upload->do_upload('image'))
					{
					    //print_r('hi');
						$uploadData = $this->upload->data();
						$picture = $uploadData['file_name'];
						$ff = $uploadData['file_ext'];
							$url = base_url();		      				
				$picture2 = $url.'uploads/about/'.$picture;
					}else{
					   // print_r('hello');
						$url = base_url();		      				
				$picture2 = $url.'uploads/about/'.$picture;
					}
				}else{
				     //print_r('text');
					$url = base_url();		      				
				$picture2 = $this->input->post('image1');
				}
	
				

			$user=array( 'image' => $picture2, 'name' =>$this->input->post('name'), 'designation' =>$this->input->post('designation'));

					$this->CTM_model->update_entry($user,$id);
					$this->session->set_flashdata('msg',"Core Team Member has been updated successfully");
					$base_url=base_url();
					redirect("$base_url"."coreteam/list");
   				}
				$data['ctmember']=$this->CTM_model->get($id);
  				$data['site_title'] = 'Admin Dashboard'; //Title
  				$data['page_title'] = 'Core Team Members';
  				$this->load->view('header',$data);
				$this->load->view('editctmember',$data);
				$this->load->view('user_footer');
    }
public function delete($id)
    {
 
       $this->CTM_model->delete_entry($id);
     $this->session->set_flashdata('msg',"Core Team Member has been deleted successfully");   
  $data['ctlist']=$this->CTM_model->get_entries();
   $data['site_title'] = 'Admin Dashboard'; //Title
   $data['page_title'] = 'Core Team Member';
        	$this->load->view('header',$data);
			$this->load->view('ctmemberlist',$data);
			$this->load->view('user_footer');
                      
}
	 
}
