<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abvolunteer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('about_model');
        $this->load->library('auth');
    }

    public function index()
    {
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['mpage_title'] = 'Settings'; //Title
        $data['page_title'] = 'AVolunteer'; //Title
        $this->load->view('header', $data);
        $this->load->view('abvolunteer');
        $this->load->view('dashboard_footer');
        $this->load->library('auth');
    }

    public function update($id)
    {
        if (can('view-cms')) {
            if ($this->input->post('submit')) {
                $con_en = $this->input->post('content_en');
                $con_ar = $this->input->post('content_ar');
                $contact_en = $this->input->post('contact_en');
                $contact_ar = $this->input->post('contact_ar');
                $goo_en = $this->input->post('goo_en');
                $goo_ar = $this->input->post('goo_ar');

                $user = array('content_en' => $con_en, 'content_ar' => $con_ar, 'vol_form_con_en' => $contact_en, 'vol_form_con_ar' => $contact_ar,
                    'vol_goo_con_en' => $goo_en, 'vol_goo_con_ar' => $goo_ar);
                //print_r($user);
                //die();
                $this->about_model->add_vol_con($user);
                $this->session->set_flashdata('msg', "Volunteer Content has been updated successfully");
                $base_url = base_url();
                redirect("$base_url" . "abvolunteer/update/5");
            }
            $data['about'] = $this->about_model->get_vol_con($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'AVolunteer'; //Title
            $this->load->view('header', $data);
            $this->load->view('abvolunteer');
            $this->load->view('user_footer');
        }
        else {
            echo "Permission denied";
        }
    }

}
