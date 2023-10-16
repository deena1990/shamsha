<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
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

	public function index()
	{
        if($this->auth->loginStatus()){
            $data['victim']=$this->dashboard_model->get_victim();
            $data['victim_growth']=$this->dashboard_model->get_victim_growth();

            $data['volunteers']=$this->dashboard_model->get_volunteer();
            $data['volunteer_growth']=$this->dashboard_model->get_volunteer_growth();

            $data['active_volunteers']=$this->dashboard_model->get_active_volunteer();
            $data['min_active_volunteer']=$this->dashboard_model->get_min_active_volunteer();
            $data['jobs']=$this->dashboard_model->get_job();
            //Deena

            $data['cases']=$this->dashboard_model->get_case();
            $data['case_growth']=$this->dashboard_model->get_case_growth();

            $data['case_reports']=$this->dashboard_model->get_case_report();
            $data['case_report_growth']=$this->dashboard_model->get_case_report_growth();

            $data['calls']=$this->dashboard_model->get_call();
            $data['call_growth']=$this->dashboard_model->get_call_growth();

            $data['video_calls']=$this->dashboard_model->get_video_call();
            $data['video_call_growth']=$this->dashboard_model->get_video_call_growth();

            $data['chats']=$this->dashboard_model->get_chat();
            $data['chat_growth']=$this->dashboard_model->get_chat_growth();

            $data['job_growth']=$this->dashboard_model->get_job_growth();
            $data['event_growth']=$this->dashboard_model->get_event_growth();
            $data['graph_start_month']=$this->dashboard_model->get_graph_start_month();
            $data['victim_graphValues']=$this->dashboard_model->get_victim_graphValues();
            $data['case_graphValues']=$this->dashboard_model->get_case_graphValues();
            $data['call_missed_graphValues']=$this->dashboard_model->get_call_missed_graphValues();
            $data['chat_missed_graphValues']=$this->dashboard_model->get_chat_missed_graphValues();
            //Deena
            $data['events']=$this->dashboard_model->get_event();
            $data['today']=$this->dashboard_model->get_today_shift();
            $data['upcoming']=$this->dashboard_model->get_upcoming_shift();
            // echo "<pre>";print_r($data['upcoming']);die;
            // $data['announcement']=$this->dashboard_model->get_($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Dashboard'; //Title
            $this->load->view('header',$data);
            $this->load->view('dashboard',$data);
            $this->load->view('dashboard_footer',$data);
        }
        else { 
            return redirect('login');
        }
	    //print_r($_SESSION); exit;

	}
	 
}
