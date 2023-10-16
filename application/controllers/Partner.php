<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Partner_model');
		
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
			
		      	
					$user=array( 'image' => $picture2, 'pname' =>$this->input->post('name'), 'website' =>$this->input->post('designation'));
				
		       
         
	//print_r($user);
	//	die();
		$this->Partner_model->add($user);
		
		$this->session->set_flashdata('msg',"Partners has been added successfully");
		$base_url=base_url();
		redirect("$base_url"."partner/list");
		       }
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Partners';
       $this->load->view('header',$data);
		$this->load->view('partner');
        $this->load->view('user_footer');
		  }

	function list()
	{
			$data['partnerlist']=$this->Partner_model->get_entries();
			$data['site_title'] = 'Admin Dashboard'; //Title
			$data['page_title'] = 'Core Team Members';
        	$this->load->view('header',$data);
			$this->load->view('partnerlist',$data);
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
	
				

			$user=array( 'image' => $picture2, 'pname' =>$this->input->post('name'), 'website' =>$this->input->post('designation'));

					$this->Partner_model->update_entry($user,$id);
					$this->session->set_flashdata('msg',"Partner has been updated successfully");
					$base_url=base_url();
					redirect("$base_url"."partner/list");
   				}
				$data['partner']=$this->Partner_model->get($id);
  				$data['site_title'] = 'Admin Dashboard'; //Title
  				$data['page_title'] = 'Partner';
  				$this->load->view('header',$data);
				$this->load->view('editpartner',$data);
				$this->load->view('user_footer');
    }
public function delete($id)
    {
 
       $this->Partner_model->delete_entry($id);
     $this->session->set_flashdata('msg',"partner has been deleted successfully");   
  $data['partner']=$this->Partner_model->get_entries();
   $data['site_title'] = 'Admin Dashboard'; //Title
   $data['page_title'] = 'partner';
        	$this->load->view('header',$data);
			$this->load->view('partnerlist',$data);
			$this->load->view('user_footer');
                      
}
	 
}
