<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('user_model');
		
}
	
			 public function add()
		    {
		    
		if($this->input->post('insert'))
		      {
		      	$dt = $this->input->post('dob');
		      	$dt1 = date("Y-m-d", strtotime($dt));
		$user=array('name' =>$this->input->post('name'),'email' =>$this->input->post('email'),'mobile' =>$this->input->post('mobile'),'dob' =>$dt1,'gender' =>$this->input->post('gender'), 'status' =>$this->input->post('status'));
		//print_r($user);
		//die();
		$this->user_model->add_user($user);
		$insert_id = $this->db->insert_id();
		
		$aa = $this->user_model->update_userid_entry($insert_id);
		//print_r($aa);
		//die();
		$this->session->set_flashdata('msg',"Employee has been added successfully");
		$base_url=base_url();
		redirect("$base_url"."User/add/");
		       }
		$data['site_title'] = 'Admin Dashboard'; //Title
        $this->load->view('header',$data);
		$this->load->view('user');
        $this->load->view('user_footer');
		  }

	function alluser()
	{
			$data['userlist']=$this->user_model->get_entries();
			$data['site_title'] = 'Admin Dashboard'; //Title
        	$this->load->view('header',$data);
			$this->load->view('userlist',$data);
			$this->load->view('user_footer');
	}

	public function edit($id)
  	{
    			if($this->input->post('submit'))
				{
					$dt = $this->input->post('dob');
		      	$dt1 = date("Y-m-d", strtotime($dt));
					$user=array('name' =>$this->input->post('name'),'email' =>$this->input->post('email'),'mobile' =>$this->input->post('mobile'),'dob' =>$dt1,'gender' =>$this->input->post('gender'), 'status' =>$this->input->post('status'));
					$this->user_model->update_entry($user,$id);
					$this->session->set_flashdata('msg',"Employee has been updated successfully");
					$base_url=base_url();
					redirect("$base_url"."user/alluser");
   				}
				$data['user']=$this->user_model->get($id);
  				$data['site_title'] = 'Admin Dashboard'; //Title
  				$this->load->view('header',$data);
				$this->load->view('edituser',$data);
				$this->load->view('user_footer');
    }
public function delete($id)
    {
 
       $this->user_model->delete_entry($id);
     $this->session->set_flashdata('msg',"Employee has been deleted successfully");   
  $data['userlist']=$this->user_model->get_entries();
   $data['site_title'] = 'Admin Dashboard'; //Title
        	$this->load->view('header',$data);
			$this->load->view('userlist',$data);
			$this->load->view('user_footer');
                      
}
	 
}
