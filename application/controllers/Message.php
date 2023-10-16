<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Message_model');
		
	}
	
	public function add()
	{	    
		if($this->input->post('submit'))
		{
			$message=array( 'title' =>$this->input->post('title'), 'message_en' =>$this->input->post('message_en'), 'message_ar' =>$this->input->post('message_ar'), 'status' =>$this->input->post('status' ) );
			// print_r($message);die;
			$this->Message_model->add($message);
			
			$this->session->set_flashdata('msg',"Message has been added successfully !!");
			$base_url=base_url();
			redirect("$base_url"."message/list");
		}
		$data['messagetitle']=$this->Message_model->get_title_list();
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Add Message';
		$this->load->view('header',$data);
		$this->load->view('message');
		$this->load->view('user_footer');
		
	}

	function list()
	{
		$data['messagelist']=$this->Message_model->get_entries();
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Messages';
		$this->load->view('header',$data);
		$this->load->view('messagelist',$data);
		$this->load->view('user_footer');
	}

	function view($id)
	{
		$data['message']=$this->Message_model->get_message($id);
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Messages';
		$this->load->view('header',$data);
		$this->load->view('view_message',$data);
		$this->load->view('user_footer');
	}

	public function edit($id)
	{
		if($this->input->post('submit'))
		{
			$message=array( 'title' =>$this->input->post('title'), 'message_en' =>$this->input->post('message_en'), 'message_ar' =>$this->input->post('message_ar'), 'status' =>$this->input->post('status' ) );
			// print_r($message);die;

			$this->Message_model->update_entry($message,$id);
			$this->session->set_flashdata('msg',"Message has been updated successfully !!");
			$base_url=base_url();
			redirect("$base_url"."message/list");
		}
		$data['message']=$this->Message_model->get($id);
		$data['messagetitle']=$this->Message_model->get_title_list();
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Messages';
		$this->load->view('header',$data);
		$this->load->view('editmessage',$data);
		$this->load->view('user_footer');
	}

	public function delete($id)
	{
		$this->Message_model->delete_entry($id);
		$this->session->set_flashdata('msg',"Message has been deleted successfully !!");
		$base_url=base_url();
		redirect("$base_url"."message/list");               
	}

	public function add_title()
	{	    
		if($this->input->post('submit'))
		{
			$messagetitle=array( 'title' =>$this->input->post('title'), 'status' =>$this->input->post('status' ) );
			// print_r($messagetitle);die;
			$this->Message_model->add_title($messagetitle);
			
			$this->session->set_flashdata('msg',"Message Title has been added successfully !!");
			$base_url=base_url();
			redirect("$base_url"."message/title_list");
		}
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Add Message Title';
		$this->load->view('header',$data);
		$this->load->view('messagetitle');
		$this->load->view('user_footer');
		
	}

	function title_list()
	{
		$data['title_list']=$this->Message_model->get_title_list();
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Message Titles';
		$this->load->view('header',$data);
		$this->load->view('messagetitlelist',$data);
		$this->load->view('user_footer');
	}

	public function edit_message_title($id)
	{
		if($this->input->post('submit'))
		{
			$messagetitle=array( 'title' =>$this->input->post('title'), 'status' =>$this->input->post('status' ) );
			// print_r($messagetitle);die;
			$this->Message_model->update_title($messagetitle, $id);

			$this->session->set_flashdata('msg',"Message Title has been updated successfully !!");
			$base_url=base_url();
			redirect("$base_url"."message/title_list");
		}
		$data['title']=$this->Message_model->get_title($id);
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['page_title'] = 'Message Titles';
		$this->load->view('header',$data);
		$this->load->view('editmessagetitle',$data);
		$this->load->view('user_footer');
	}

	public function delete_message_title($id)
	{
		$this->Message_model->delete_title($id);
		$this->session->set_flashdata('msg',"Message Title has been deleted successfully !!");
		$base_url=base_url();
		redirect("$base_url"."message/title_list");               
	}
	 
}