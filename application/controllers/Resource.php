<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource extends CI_Controller
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
        $this->load->model('resource_model');
        $this->load->library('auth');

    }

    public function add()
    {
        if( can('add-resource') ) {
            if ($this->input->post('submit')) {
                $data['res_loc_id'] = $this->input->post('res_loc_id');
                $data['res_res_cat_id'] = $this->input->post('res_res_cat_id');
                $data['name'] = $this->input->post('name');
                $data['address_info'] = $this->input->post('address_info');
                $data['contact_info1'] = $this->input->post('contact_info1');
                $data['contact_info2'] = $this->input->post('contact_info2');
                $data['contact_info3'] = $this->input->post('contact_info3');
                $data['contact_info4'] = $this->input->post('contact_info4');
                $data['email_info1'] = $this->input->post('email_info1');
                $data['email_info2'] = $this->input->post('email_info2');
                $data['email_info3'] = $this->input->post('email_info3');
                $data['web_info1'] = $this->input->post('web_info1');
                $data['web_info2'] = $this->input->post('web_info2');
                $data['timings'] = $this->input->post('timings');
                $data['status'] = $this->input->post('status');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('res_loc_id', 'Location', 'trim|required');
                $this->form_validation->set_rules('res_res_cat_id', 'Category', 'trim|required');
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                if(!empty($data['email_info1'])){
                    $this->form_validation->set_rules('email_info1', 'Email 1', 'trim|valid_email');
                }
                if(!empty($data['email_info2'])){
                    $this->form_validation->set_rules('email_info2', 'Email 2', 'trim|valid_email');
                }
                if(!empty($data['email_info3'])){
                    $this->form_validation->set_rules('email_info3', 'Email 3', 'trim|valid_email');
                }
                if (($this->form_validation->run() == true)) {
                    $this->resource_model->add($data);
                    $this->session->set_flashdata('msg', "Resource has been added successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "resource/allresource");
                }
            }
            $data['location'] = $this->resource_model->get_loc();
            $data['category'] = $this->resource_model->get_category();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Resource';
            $this->load->view('header', $data);
            $this->load->view('resource');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    function allresource()
    {
        if( can('view-resource') ) {
            $data['resourcelist'] = $this->resource_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Resources';
            $this->load->view('header', $data);
            $this->load->view('resourcelist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function edit($id)
    {
        if( can('edit-resource') ) {
            if ($this->input->post('submit')) {
                $data['res_loc_id'] = $this->input->post('res_loc_id');
                $data['res_res_cat_id'] = $this->input->post('res_res_cat_id');
                $data['name'] = $this->input->post('name');
                $data['address_info'] = $this->input->post('address_info');
                $data['contact_info1'] = $this->input->post('contact_info1');
                $data['contact_info2'] = $this->input->post('contact_info2');
                $data['contact_info3'] = $this->input->post('contact_info3');
                $data['contact_info4'] = $this->input->post('contact_info4');
                $data['email_info1'] = $this->input->post('email_info1');
                $data['email_info2'] = $this->input->post('email_info2');
                $data['email_info3'] = $this->input->post('email_info3');
                $data['web_info1'] = $this->input->post('web_info1');
                $data['web_info2'] = $this->input->post('web_info2');
                $data['timings'] = $this->input->post('timings');
                $data['status'] = $this->input->post('status');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('res_loc_id', 'Location', 'trim|required');
                $this->form_validation->set_rules('res_res_cat_id', 'Category', 'trim|required');
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                if(!empty($data['email_info1'])){
                    $this->form_validation->set_rules('email_info1', 'Email 1', 'trim|valid_email');
                }
                if(!empty($data['email_info2'])){
                    $this->form_validation->set_rules('email_info2', 'Email 2', 'trim|valid_email');
                }
                if(!empty($data['email_info3'])){
                    $this->form_validation->set_rules('email_info3', 'Email 3', 'trim|valid_email');
                }
                if (($this->form_validation->run() == true)) {
                    $this->resource_model->update_entry($data, $id);
                    $this->session->set_flashdata('msg', "Resource has been updated successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "resource/allresource");
                }
            }
            $data['resource'] = $this->resource_model->get_row($id);
            if(!empty( $data['resource'])){
                $data['location'] = $this->resource_model->get_loc();
                $data['category'] = $this->resource_model->get_category();
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'Resources';
                $this->load->view('header', $data);
                $this->load->view('editresource', $data);
                $this->load->view('user_footer');
            }
        }
        else{
            echo "Permission denied";
        }


    }

    public function delete($id)
    {
        if( can('delete-resource') ) {
            $this->resource_model->delete_entry($id);
            $this->session->set_flashdata('msg', "Resource has been deleted successfully");
            $data['resourcelist'] = $this->resource_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Resources';
            $this->load->view('header', $data);
            $this->load->view('resourcelist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function allresourcecategory()
    {
        if( can('resource-category-view') ) {
            $data['catlist'] = $this->resource_model->get_cat_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Resource';
            $this->load->view('header', $data);
            $this->load->view('resourcecategorylist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function view($id)
    {
        if( can('view-resource') ) {
            $data['resourcelist'] =  $this->resource_model->get_row($id);
            if(!empty($data['resourcelist'])){
                $data['site_title'] = 'Admin Dashboard'; //Title
                $data['page_title'] = 'Resources';
                $this->load->view('header', $data);
                $this->load->view('resource-view', $data);
                $this->load->view('user_footer');
            }
        }
        else{
            echo "Permission denied";
        }

    }

    public function catdelete($id)
    {
        if( can('resource-category-delete') ) {
            $this->resource_model->delete_cat_entry($id);
            $this->session->set_flashdata('msg', "Resource Category has been deleted successfully");
            $base_url = base_url();
            redirect("$base_url" . "resource/allresourcecategory");
            $data['catlist'] = $this->resource_model->get_cat_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Resource';
            $this->load->view('header', $data);
            $this->load->view('resourcecategorylist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function catedit($id)
    {
        if( can('resource-category-edit') ) {
            if ($this->input->post('submit')) {

                $icon2 = $this->input->post('icon2');
                if (!empty($_FILES['icon']['name'])) {
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2000;
                    $config['max_width'] = 1500;
                    $config['max_height'] = 1500;
                    $config['file_name'] = $_FILES['icon']['name'];

                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('icon')) {
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = '';
                    }
                    $url = base_url();
                    $picture2 = $url . 'uploads/' . $picture;
                } else {
                    $picture2 = $icon2;
                }

                $user = array('category_name' => $this->input->post('name'), 'category_icon' => $picture2);

                $this->resource_model->update_category_entry($user, $id);
                $this->session->set_flashdata('msg', "Resource Category has been updated successfully");
                $base_url = base_url();
                redirect("$base_url" . "resource/allresourcecategory");
            }
            $data['category'] = $this->resource_model->get_cat_info($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Resource';
            $this->load->view('header', $data);
            $this->load->view('editresourcecategory', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }


}
