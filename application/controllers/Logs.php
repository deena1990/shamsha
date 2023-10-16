<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pending_model');
        $this->load->library('auth');
    }

    function send() {
        $this->load->config('email');
		$this->load->library('email');
		$this->email->from("cyz@gmail.com", "Shamsaha");
		$this->email->to("mobappssolutions154@gmail.com");
		$this->email->subject("Write subject here");
		$this->email->message("Write mail body message here");
		$this->email->set_newline("\r\n");

		if ($this->email->send()) {
			echo 'Email has been sent successfully !!';
            // save 1 in database table
		} else {
			show_error($this->email->print_debugger());
        }
    }

	public function chats()
	{
        $data['chats']=$this->pending_model->get_chats();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Chats'; //Title
        $this->load->view('header',$data);
        $this->load->view('chats',$data);
        $this->load->view('user_footer',$data);
	}

    public function view_chat($id){
        $data['chat']=$this->pending_model->get_chat($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Chats'; //Title
        $this->load->view('header',$data);
        $this->load->view('view_chat',$data);
        $this->load->view('user_footer',$data);
    }

    public function calls()
	{
        $data['calls']=$this->pending_model->get_calls();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Calls'; //Title
        $this->load->view('header',$data);
        $this->load->view('calls',$data);
        $this->load->view('user_footer',$data);
	}

    public function view_call($id)
    {
        $data['call']=$this->pending_model->get_call($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Calls'; //Title
        $this->load->view('header',$data);
        $this->load->view('view_call',$data);
        $this->load->view('user_footer',$data);
    }

    public function video_calls()
	{
        $data['video_calls']=$this->pending_model->get_video_calls();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Video Calls'; //Title
        $this->load->view('header',$data);
        $this->load->view('video_calls',$data);
        $this->load->view('user_footer',$data);
	}

    public function view_video_call($id)
    {
        $data['video_call']=$this->pending_model->get_video_call($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Video Calls'; //Title
        $this->load->view('header',$data);
        $this->load->view('view_video_call',$data);
        $this->load->view('user_footer',$data);
    }

    public function volunteer_logs(){
        $data['volunteer_logs']=$this->pending_model->get_volunteer_logs();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Volunteer Logs'; //Title
        $this->load->view('header',$data);
        $this->load->view('volunteer_logs',$data);
        $this->load->view('user_footer',$data);
    }
	 
}
