<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsership extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load database
		$this->load->model('sponsership_model');
        $this->load->library('auth');
}

	public function isponser($id) 
	{
        if (can('view-setting')) {
            if($this->input->post('submit'))
            {
                $con_en = strip_tags($this->input->post('content_en'));
                $content_en = str_replace(array("'","&nbsp;", "\n", "\t", "\r"), " ", $con_en);
                $con_ar = strip_tags($this->input->post('content_ar'));
                $content_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", $con_ar);
                $user=array('content_en' =>$content_en, 'content_ar' =>$content_ar);
                //print_r($user);
                //die();
                $this->sponsership_model->add_isponser($user);
                $this->session->set_flashdata('msg',"Sponsership has been updated successfully");
                $base_url=base_url();
                redirect("$base_url"."sponsership/update/6");
            }
            $data['sponser']=$this->sponsership_model->iget($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'ISponser'; //Title
            $this->load->view('header',$data);
            $this->load->view('isponsership');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }
    
    public function csponser($id) 
	{
        if (can('view-setting')) {
            if($this->input->post('submit'))
            {
                $con_en = strip_tags($this->input->post('content_en'));
                $content_en = str_replace(array("'","&nbsp;", "\n", "\t", "\r"), " ", $con_en);
                $con_ar = strip_tags($this->input->post('content_ar'));
                $content_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", $con_ar);
                $user=array('content_en' =>$content_en, 'content_ar' =>$content_ar);
                //print_r($user);
                //die();
                $this->sponsership_model->add_csponser($user);
                $this->session->set_flashdata('msg',"Sponsership has been updated successfully");
                $base_url=base_url();
                redirect("$base_url"."sponsership/update/7");
            }
            $data['sponser']=$this->sponsership_model->cget($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'CSponser'; //Title
            $this->load->view('header',$data);
            $this->load->view('csponsership');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }
	 
}
