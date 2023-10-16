<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller
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
        $this->load->model('permission_model');
        $this->load->model('User');
        $this->load->model('Permission');

    }

    public function index()
    {
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'User Management'; //Title
        $this->load->view('header', $data);
        $this->load->view('permission/index');
        $this->load->view('user_footer');
    }

    function getpermissions()
    {
        $data = $row = array();

        // Fetch member's records
        $roleData = $this->permission_model->getRows($_POST);
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
            if (!empty($role->created_at)) {
                $created_date = date('d M Y H:i:s', strtotime($role->created_at));
            } else {
                $created_date = "";
            }
            $data[] = array($i, $role->name, $role->display_name, $role->description, $created_date, $status, $role->id);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->permission_model->countAll(),
            "recordsFiltered" => $this->permission_model->countFiltered($_POST),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    public function add()
    {
        if ($this->input->post('insert')) {
            $data['name'] = $this->input->post('name');
            $data['display_name'] = $this->input->post('display_name');
            $data['description'] = $this->input->post('description');
            $data['module_id'] = $this->input->post('module_id');
            $data['status'] = $this->input->post('status');

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[permissions.name]', array('is_unique' => 'The %s is already taken'));
            $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|is_unique[permissions.display_name]', array('is_unique' => 'The %s is already taken'));
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('module_id', 'Module', 'trim|required');


            if (($this->form_validation->run() == true)) {

                if ($this->Permission->add($data)) {
                    $this->session->set_flashdata('msg', "Module added successfully");
                }
                $base_url = base_url();
                redirect("$base_url" . "permissions/add/");
            } else {
//                print_r(validation_errors());
                $data['error'] = validation_errors();
            }

        }
        $data['modules'] = $this->permission_model->get_all_modules();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'User Management'; //Page Title
        $this->load->view('header', $data);
        $this->load->view('permission/add');
        $this->load->view('user_footer');
    }

    public function edit($id)
    {
        $roledetail = $this->Permission->find($id);
        if ($this->input->post('insert')) {
            $data['name'] = $this->input->post('name');
            $data['display_name'] = $this->input->post('display_name');
            $data['description'] = $this->input->post('description');
            $data['module_id'] = $this->input->post('module_id');
            $data['status'] = $this->input->post('status');

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Name', 'trim|required|edit_unique[permissions.name.id.' . $id . ']', array('edit_unique' => 'The %s is already taken'));
            $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|edit_unique[permissions.display_name.id.' . $id . ']', array('edit_unique' => 'The %s is already taken'));
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('module_id', 'Module', 'trim|required');

            if (($this->form_validation->run() == true)) {
                $data['id'] = $id;
                //echo $this->db->last_query(); exit;
                if ($this->Permission->edit($data)) {
                    $this->session->set_flashdata('msg', "Role update successfully");
                }
                else{
                    //echo $this->db->last_query(); exit;
                }
                $base_url = base_url();
                redirect("$base_url" . "permissions/");
            } else {
                print_r(validation_errors());
                $data['error'] = validation_errors();
            }

        }
        if (!empty($roledetail)) {
            $data['modules'] = $this->permission_model->get_all_modules();
            $data['roledetail'] = $roledetail;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'User Management'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('permission/edit');
            $this->load->view('user_footer');
        }

    }

    public function delete($id)
    {
        if ($this->User->delete($id)) {
            $this->session->set_flashdata('msg', "Deleted successfully");
        }
        $base_url = base_url();
        redirect("$base_url" . "usermanagement");
    }

    public function modulesadd()
    {
        if ($this->input->post('insert')) {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['status'] = $this->input->post('status');

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[modules.name]', array('is_unique' => 'The %s is already taken'));
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if (($this->form_validation->run() == true)) {
                if ($this->permission_model->add_module($data)) {
                    $this->session->set_flashdata('msg', "Modules added successfully");
                }
                $base_url = base_url();
                redirect("$base_url" . "permissions/modulesadd");
            } else {
                $data['error'] = validation_errors();
            }

        }

        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'User Management'; //Page Title
        $this->load->view('header', $data);
        $this->load->view('permission/module-add');
        $this->load->view('user_footer');

    }

}
