<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workwithus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('workwithus_model');
        $this->load->library('auth');

    }

    public function index()
    {
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['mpage_title'] = 'Settings'; //Title
        $data['page_title'] = 'Work with Us'; //Title
        $this->load->view('header', $data);
        $this->load->view('workwithus');
        $this->load->view('dashboard_footer');
    }

    public function update($id)
    {
        if (can('view-cms')) {
            if ($this->input->post('submit')) {
                $title_en = $this->input->post('title_en');
                $title_ar = $this->input->post('title_ar');
                $con_en = $this->input->post('content_en');
                $con_ar = $this->input->post('content_ar');
                $user = array('title_en' => $title_en, 'title_ar' => $title_ar, 'content_en' => $con_en, 'content_ar' => $con_ar);
                //print_r($user);
                //die();
                $this->workwithus_model->add($user);
                $this->session->set_flashdata('msg', "Work With Us has been updated successfully");
                $base_url = base_url();
                redirect("$base_url" . "workwithus/update/9");
            }
            $data['about'] = $this->workwithus_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'Work with Us'; //Title
            $this->load->view('header', $data);
            $this->load->view('workwithus');
            $this->load->view('user_footer');
        } else {
            echo "Permission denied";
        }


    }

}
