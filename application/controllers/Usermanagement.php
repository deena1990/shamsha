<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('user_model');
        $this->load->model('User');
        $this->load->library('auth');

    }

    public function index()
    {
        if (can('view-user')) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Manage Users'; //Title
            $this->load->view('header', $data);
            $this->load->view('user-management/index');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    function getUsers()
    {
        $data = $row = array();

        // Fetch member's records
        $userData = $this->user_model->getRows($_POST);

        $i = $_POST['start'];
        foreach ($userData as $user) {
            $i++;
            if ($user->status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }
            $data[] = array($i, $user->name, $user->email, $user->username,$user->display_name, date('d M Y H:i:s', strtotime($user->created_at)), $status, $user->uid);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_model->countAll(),
            "recordsFiltered" => $this->user_model->countFiltered($_POST),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    public function add()
    {
        if (can('add-user')) {
            if ($this->input->post('insert')) {
                $data['name'] = $this->input->post('name');
                $data['username'] = $this->input->post('username');
                $data['password'] = $this->input->post('password');
                $data['email'] = $this->input->post('email');
                $data['role'] = $this->input->post('role');
                $data['status'] = $this->input->post('status');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]', array('is_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]', array('is_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('role', 'Role', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');


                if (($this->form_validation->run() == true)) {

                    $add = $this->User->add(array(
                        'name' => $data['name'],
                        'username' => $data['username'],
                        'password' => password_hash($data['password'],   PASSWORD_BCRYPT),
                        'status' => $data['status'],
                        'email' => $data['email'],
                    ));
                    $insert_id = $this->db->insert_id();
                    $this->User->addRoles($insert_id, $data['role']);
                    $this->session->set_flashdata('msg', "User has been added successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "usermanagement/add/");
                } else {
//                print_r(validation_errors());
                    $data['error'] = validation_errors();
                }

            }
            $data['roles'] = $this->user_model->get_all_roles();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'User Management'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('user-management/add');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function edit($id)
    {
        if (can('edit-user')) {
            $userdetail = $this->User->find($id);
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
                    $this->User->edit($data);
                    $this->User->editRoles($id, $role);
                    $this->session->set_flashdata('msg', "User has been updated successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "usermanagement");
                } else {
//                print_r(validation_errors());
                    $data['error'] = validation_errors();
                }

            }
            if(!empty($userdetail)){
                $userRole = $this->User->userWiseRoles($id);
                $data['roles'] = $this->user_model->get_all_roles();
                $data['userdetail'] = $userdetail;
                $data['user_role'] = isset($userRole[0]) ? $userRole[0] : '';
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'Manage Users'; //Page Title
                $this->load->view('header', $data);
                $this->load->view('user-management/edit');
                $this->load->view('user_footer');
            }
        }
        else{
            echo "Permission denied";
        }
    }

    public function delete($id){
        if (can('delete-user')) {
            if($this->User->delete($id)){
                $this->session->set_flashdata('msg', "Deleted successfully");
            }

            $base_url = base_url();
            redirect("$base_url" . "usermanagement");
        }
        else{
            echo "Permission denied";
        }
    }


}
