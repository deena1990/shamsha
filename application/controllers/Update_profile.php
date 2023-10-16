<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class update_profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Profile_model');
        $this->load->library('auth');
    }

    public function index()
    {
        $session_id = $this->session->userdata('userID');
        $data['site_title'] = ' Admin Dashboard'; //Title
        $data['page_title'] = 'Profile '; //Title
        $data['userdetail'] = $this->Profile_model->get_profile_detail($session_id); 
        $data['roles'] = $this->Profile_model->get_roles(); 
        $data['user_role'] = $this->Profile_model->get_user_role($session_id); 
        $this->load->view('header', $data);
        $this->load->view('update_profile',$data);
        $this->load->view('user_footer');
    }

    public function edit($id)
    {
        // if (can('edit-user')) {
            $userdetail = $this->Profile_model->find($id);
            if ($this->input->post('insert')) {
                $data['name'] = $this->input->post('name');
                $data['username'] = $this->input->post('username');
                $data['password'] = $this->input->post('password');
                $data['email'] = $this->input->post('email');
                $data['role'] = $this->input->post('role');
                $data['status'] = $this->input->post('status');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|edit_unique[users.username.id.'.$id.']', array('edit_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('email', 'Email', 'trim|required|edit_unique[users.email.id.'.$id.']', array('edit_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('role', 'Role', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                if (($this->form_validation->run() == true)) {
                    if(empty($data['password'])){
                        unset($data['password']);
                    }
                    else{
                        $data['password'] = password_hash($data["password"], PASSWORD_BCRYPT);
                    }
                    $role = $data['role'];
                    unset($data['role']);
                    $data['id'] = $id;
                    $this->Profile_model->edit($data);
                    $this->Profile_model->editRoles($id, $role);
                    $this->session->set_flashdata('msg', "User has been updated successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "update_profile");
                } else {
                    $data['error'] = validation_errors();
                }

            }
            if(!empty($userdetail)){
                $userRole = $this->User->userWiseRoles($id);
                $data['roles'] = $this->user_model->get_all_roles();
                $data['userdetail'] = $userdetail;
                $data['user_role'] = isset($userRole[0]) ? $userRole[0] : '';
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'User Management'; //Page Title
                $this->load->view('header', $data);
                $this->load->view('user-management/edit');
                $this->load->view('user_footer');
            }
        // }
        // else{
        //     echo "Permission denied";
        // }
    }
}
