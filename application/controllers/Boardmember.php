<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boardmember extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('BM_model');
		
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
				}
			}else{
					//print_r('text');
				$picture = '';
			}
			$user=array( 'image' => $picture, 'bname' =>$this->input->post('name'), 'bname_ar' =>$this->input->post('name_ar'), 'designation' =>$this->input->post('designation'), 'designation_ar' =>$this->input->post('designation_ar'));
			
			$this->BM_model->add($user);
			
			$this->session->set_flashdata('msg',"Board Member has been added successfully !!");
			$base_url=base_url();
			redirect("$base_url"."boardmember/list");
		}
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Add Board Member';
		$this->load->view('header',$data);
		$this->load->view('bmember');
		$this->load->view('user_footer');
		
	}

	function list()
	{
		$data['bmemberlist']=$this->BM_model->get_entries();
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Board Members';
		$this->load->view('header',$data);
		$this->load->view('bmemberlist',$data);
		$this->load->view('user_footer');
	}

	function view($id)
	{
		$data['bmember']=$this->BM_model->get_bmember($id);
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Board Members';
		$this->load->view('header',$data);
		$this->load->view('view_bmember',$data);
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
				}
			}else{		      				
				$picture = $this->input->post('image1');
			}
			$user=array( 'image' => $picture, 'bname' =>$this->input->post('name'), 'bname_ar' =>$this->input->post('name_ar'), 'designation' =>$this->input->post('designation'), 'designation_ar' =>$this->input->post('designation_ar'));

			$this->BM_model->update_entry($user,$id);
			$this->session->set_flashdata('msg',"Board Member has been updated successfully !!");
			$base_url=base_url();
			redirect("$base_url"."boardmember/list");
		}
		$data['bmember']=$this->BM_model->get($id);
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Board Members';
		$this->load->view('header',$data);
		$this->load->view('editbmember',$data);
		$this->load->view('user_footer');
	}

	public function delete($id)
	{
		$this->BM_model->delete_entry($id);
		$this->session->set_flashdata('msg',"Board Member has been deleted successfully !!");   
		$data['bmemberlist']=$this->BM_model->get_entries();
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Board Members';
		$this->load->view('header',$data);
		$this->load->view('bmemberlist',$data);
		$this->load->view('user_footer');                 
	}
	 
}