<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class change_password extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('cp_model');
        $this->load->library('auth');
    }

    public function index()
    {
        // if (can('change-password')) {
            if ($this->input->post('change_pass')) {
                $data['old_pass'] = $this->input->post('old_pass');
                $data['new_pass'] = $this->input->post('new_pass');
                $data['confirm_pass'] = $this->input->post('confirm_pass');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required');
                $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required');
                $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[new_pass]');
                if (($this->form_validation->run() == true)) {

                    $id = $this->session->userdata('userID');
                    $que = $this->db->query("select * from users where id='$id'");
                    $row = $que->row();

                    if (password_verify($data['old_pass'], $row->password)) {
                        if ($this->cp_model->change_pass_admin($id, password_hash($data['new_pass'], PASSWORD_BCRYPT))) {
                            $this->session->set_flashdata('msg', "Password changed successfully");
                        } else {
                            $this->session->set_flashdata('error', "Something went wrong");
                        }
                        //echo "Password changed successfully !";

                    } else {
                        $this->session->set_flashdata('error', "Incorrect Old Password!!");
                    }
                }

            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Cpassword'; //Title
            $this->load->view('header', $data);
            $this->load->view('change_password');
            $this->load->view('user_footer');
        // }
        // else {
        //     echo "Permission denied";
        // }
    }
}
