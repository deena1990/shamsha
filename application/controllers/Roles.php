<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller
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
        $this->load->model('role_model');
        $this->load->model('User');
        $this->load->model('Role');
        $this->load->model('Permission');
        $this->load->library('auth');

    }

    public function index()
    {
        if (can('view-role')) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Manage Roles'; //Title
            $this->load->view('header', $data);
            $this->load->view('roles/index');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    function getroles()
    {
        $data = $row = array();

        // Fetch member's records
        $roleData = $this->role_model->getRows($_POST);
//print_r($roleData); exit;
        $i = $_POST['start'];
        foreach ($roleData as $role) {
            $i++;
            //print_r($role->name); exit;
            if ($role->status == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }
            if(!empty($role->created_at)){
                $created_date = date('d M Y H:i:s', strtotime($role->created_at));
            }
            else{
                $created_date = "";
            }
            $data[] = array($i, $role->name, $role->display_name, $role->description, $created_date, $status, $role->id);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->role_model->countAll(),
            "recordsFiltered" => $this->role_model->countFiltered($_POST),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    public function add()
    {
        if (can('add-role')) {
            if ($this->input->post('insert')) {
                $data['name'] = $this->input->post('name');
                $data['display_name'] = $this->input->post('display_name');
                $data['description'] = $this->input->post('description');
                $data['status'] = $this->input->post('status');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[roles.name]', array('is_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|is_unique[roles.display_name]', array('is_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('status', 'Status', 'trim|required');


                if (($this->form_validation->run() == true)) {

                    if($this->Role->add($data)){
                        $this->session->set_flashdata('msg', "Role added successfully");
                    }
                    $base_url = base_url();
                    redirect("$base_url" . "roles/add/");
                } else {
//                print_r(validation_errors());
                    $data['error'] = validation_errors();
                }

            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Role'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('roles/add');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function edit($id)
    {
        if (can('edit-role')) {
            $roledetail = $this->Role->find($id);
            if ($this->input->post('insert')) {
                $data['name'] = $this->input->post('name');
                $data['display_name'] = $this->input->post('display_name');
                $data['description'] = $this->input->post('description');
                $data['status'] = $this->input->post('status');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required|edit_unique[roles.name.id.'.$id.']', array('edit_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|edit_unique[roles.display_name.id.'.$id.']', array('edit_unique' => 'The %s is already taken'));
                $this->form_validation->set_rules('status', 'Status', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    $data['id'] = $id;
                    if($this->Role->edit($data)){
                        $this->session->set_flashdata('msg', "Role update successfully");
                    }
                    $base_url = base_url();
                    redirect("$base_url" . "roles/");
                } else {
                    $data['error'] = validation_errors();
                }

            }
            if(!empty($roledetail)){
                $data['roledetail'] = $roledetail;
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'Manage Roles'; //Page Title
                $this->load->view('header', $data);
                $this->load->view('roles/edit');
                $this->load->view('user_footer');
            }
        }
        else{
            echo "Permission denied";
        }
    }

    public function assign($id){
        // if (can('assign-permission')) {
            if(!empty($id)){
                $data['role_id'] = $id;
                $data['modules'] = $this->role_model->get_all_modules();
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'Manage Roles'; //Title
                $this->load->view('header', $data);
                $this->load->view('roles/assign');
                $this->load->view('user_footer');
            }
        // }
        // else{
            // echo "Permission denied";
        // }
    }

    public function assignpermission(){
            $data['role_id'] = $this->input->post('role_id');
            $data['permission_id'] = $this->input->post('permission_id');
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('role_id', 'Role Id', 'trim|required');
            $this->form_validation->set_rules('permission_id', 'Permission Id', 'trim|required');
            if (($this->form_validation->run() == true)) {
                $count = $this->role_model->count_permission($data['role_id'],$data['permission_id']);
                if($count == 0){
                    if($this->role_model->add_permission($data)){
                        echo "success";
                    }
                    else{
                        echo "error";
                    }
                }
                else{
                    if ($this->role_model->delete_permission($data)){
                        echo "success";
                    }
                    else{
                        echo "error";
                    }
                }
            }
            else{
               //print_r(validation_errors());
            }
    }


}
