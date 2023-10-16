<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource_category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('resource_category_model');
        $this->load->library('auth');
    }
    public function index(){
        if( can('view-resource_category') ) {
            $data['category_list']=$this->resource_category_model->all();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Category'; //Title
            $this->load->view('header',$data);
            $this->load->view('resource_category/index',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function add()
    {
        if( can('add-resource_category') ) {
            if($this->input->post('submit'))
            {
                $data['category_name'] = $this->input->post('category_name');
                $data['category_name_ar'] = $this->input->post('category_name_ar');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
                $this->form_validation->set_rules('category_name_ar', 'Category Name', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                $imgVal = true;

                if (($this->form_validation->run() == true)) {
                    if (!empty($_FILES['category_icon']['name'])) {
                        $config['upload_path'] = 'uploads/resource_category_img/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['category_icon']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('category_icon')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                        } else {
                            $this->session->set_flashdata( 'category_icon_error', $this->upload->display_errors() );
                            $imgVal = false;
                        }
                        $category_icon = $picture;
                    } else {
                        $this->session->set_flashdata( 'category_icon_error', "This Field is required!!");
                        $imgVal = false;
                    }
                    if (!empty($_FILES['category_icon_select']['name'])) {
                        $config['upload_path'] = 'uploads/resource_category_img/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['category_icon_select']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('category_icon_select')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                        } else {
                            $this->session->set_flashdata( 'category_icon_select_error', $this->upload->display_errors() );
                            $imgVal = false;
                        }
                        $category_icon_select = $picture;
                    } else {
                        $this->session->set_flashdata( 'category_icon_select_error', "This Field is required!!");
                        $imgVal = false;
                    }
                    
                    if($imgVal){
                        $data['category_icon'] = $category_icon.':::'.$category_icon_select;
                        // print_r($data);die;
                        $insert = $this->resource_category_model->add($data);
                        if($insert){
                            $this->session->set_flashdata('msg',"Category has been added successfully");
                            $base_url=base_url();
                            redirect("$base_url"."resource_category");
                        }
                    }

                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Category'; //Title
            $this->load->view('header',$data);
            $this->load->view('resource_category/add');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }


    public function edit($id)
    {
        if( can('edit-resource_category') ) {
            $category = $this->resource_category_model->get_row($id);
            //print_r($category); exit;
            if($this->input->post('submit'))
            {
                $data['category_name'] = $this->input->post('category_name');
                $data['category_name_ar'] = $this->input->post('category_name_ar');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
                $this->form_validation->set_rules('category_name_ar', 'Category Name', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                $imgVal = true;

                if (($this->form_validation->run() == true)) {
                    if (!empty($_FILES['category_icon']['name'])) {
                        $config['upload_path'] = 'uploads/resource_category_img/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['category_icon']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('category_icon')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                        } else {
                            $this->session->set_flashdata( 'category_icon_error', $this->upload->display_errors() );
                            $imgVal = false;
                        }
                        $category_icon = $picture;
                    }else{
                        $category_icon = $this->input->post('pre_category_icon');
                    }
                    if (!empty($_FILES['category_icon_select']['name'])) {
                        $config['upload_path'] = 'uploads/resource_category_img/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['category_icon_select']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('category_icon_select')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                        } else {
                            $this->session->set_flashdata( 'category_icon_select_error', $this->upload->display_errors() );
                            $imgVal = false;
                        }
                        $category_icon_select = $picture;
                    }else{
                        $category_icon_select = $this->input->post('pre_category_icon_select');
                    }
                    if($imgVal){
                        $data['category_icon'] = $category_icon.':::'.$category_icon_select;
                        $data['wcrcid'] = $id;
                        // print_r($data);die;
                        $insert = $this->resource_category_model->update($data);
                        if($insert){
                            $this->session->set_flashdata('msg',"Category Update successfully");
                            $base_url=base_url();
                            redirect("$base_url"."resource_category");
                        }
                    }

                }
            }
            $data['category'] = $category;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Category'; //Title
            $this->load->view('header',$data);
            $this->load->view('resource_category/edit');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function delete($id)
    {
        if( can('delete-resource_category') ) {
            if($this->resource_category_model->delete($id)){
                $this->session->set_flashdata('msg',"Deleted successfully");
            }
            redirect(base_url()."resource_category");
        }
        else{
            echo "Permission denied";
        }


    }



}
