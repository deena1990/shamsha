<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('job_model');
        $this->load->library('auth');
	}
	
	public function add()
    {
        if( can('add-job') ) {
            if($this->input->post('submit'))
            {
                $data['title'] = $this->input->post('title');
                $data['job_type'] = $this->input->post('type');
                $data['jdate'] = ($this->input->post('date')) ? date("Y-m-d", strtotime($this->input->post('date'))) : "";
                $data['edate'] = ($this->input->post('edate')) ? date("Y-m-d", strtotime($this->input->post('edate'))) : "";
                $data['brief'] = $this->input->post('short_desc');
                $data['detail'] = $this->input->post('breif_desc');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title', 'Title', 'trim|required');
                $this->form_validation->set_rules('job_type', 'Job Type', 'trim|required');
                $this->form_validation->set_rules('jdate', 'Date', 'trim|required');
                $this->form_validation->set_rules('brief', 'Breif Description', 'trim|required');
                $this->form_validation->set_rules('detail', 'Detail Description', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    $this->job_model->add($data);
                    $insert_id = $this->db->insert_id();
                    $aa = $this->job_model->update_jobid_entry($insert_id);
                    $this->session->set_flashdata('msg',"Job has been added successfully");
                    $base_url=base_url();
                    redirect("$base_url"."job/alljob");
                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('job');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

	function alljob(){
        if( can('view-job') ) {
            $data['joblist']=$this->job_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('joblist',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
	}
	
	function viewapplicant($id)
	{
        if( can('view-job') ) {
            $data['jobapplilist']=$this->job_model->get_applicant_entries($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('jobapplicantlist',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
	}

	public function edit($id)
  	{
        if( can('edit-job') ) {
            if($this->input->post('submit'))
            {
                $data['title'] = $this->input->post('title');
                $data['job_type'] = $this->input->post('type');
                $data['jdate'] = ($this->input->post('date')) ? date("Y-m-d", strtotime($this->input->post('date'))) : "";
                $data['edate'] = ($this->input->post('edate')) ? date("Y-m-d", strtotime($this->input->post('edate'))) : "";
                $data['brief'] = $this->input->post('short_desc');
                $data['detail'] = $this->input->post('breif_desc');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $status = 'Active';
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title', 'Title', 'trim|required');
                $this->form_validation->set_rules('job_type', 'Job Type', 'trim|required');
                $this->form_validation->set_rules('jdate', 'Date', 'trim|required');
                $this->form_validation->set_rules('brief', 'Breif Description', 'trim|required');
                $this->form_validation->set_rules('detail', 'Detail Description', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    $this->job_model->update_entry($data,$id);
                    $this->session->set_flashdata('msg',"Job has been updated successfully");
                    $base_url=base_url();
                    redirect("$base_url"."job/alljob");
                }
            }
            $data['job']=$this->job_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('editjob',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }
    
    public function delete($id)
    {
        if( can('delete-job') ) {
            $this->job_model->delete_entry($id);
            $this->session->set_flashdata('msg',"Job has been deleted successfully");
            $data['joblist']=$this->job_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('joblist',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

                      
    }
    
    public function jadelete($id,$id2)
    {
        if( can('delete-job') ) {
            $this->job_model->delete_jobapplicant_entry($id);
            $this->session->set_flashdata('msg',"Applicant entry has been deleted successfully");
            $data['jobapplilist']=$this->job_model->get_applicant_entries($id2);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('jobapplicantlist',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
                      
    }

    public function view($id)
    {
        if( can('view-job') ) {
            $data['job'] = $this->job_model->get_row($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('viewjob',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }


    }
    public function viewinfo($id)
    {
        if( can('view-job') ) {
            $data['applicant'] = $this->job_model->get_applicant_row($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'All Job'; //Title
            $this->load->view('header',$data);
            $this->load->view('view-applicant-detail',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

	 
}
