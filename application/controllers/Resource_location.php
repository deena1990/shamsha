<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource_location extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('resource_location_model');
        $this->load->library('auth');
    }
    public function index(){
        if( can('view-resource_country') ) {
            $data['category_list']=$this->resource_location_model->all();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Location'; //Title
            $this->load->view('header',$data);
            $this->load->view('resource_location/index',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function add()
    {
        if( can('add-resource_country') ) {
            if($this->input->post('submit'))
            {
                $data['location_name'] = $this->input->post('location_name');
                $data['location_name_ar'] = $this->input->post('location_name_ar');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('location_name', 'Country Name (English)', 'trim|required');
                $this->form_validation->set_rules('location_name_ar', 'Country Name (Arabic)', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                $imgVal = true;

                if (($this->form_validation->run() == true)) {
                    $insert = $this->resource_location_model->add($data);
                    if($insert){
                        $this->session->set_flashdata('msg',"Country has been added successfully");
                        $base_url=base_url();
                        redirect("$base_url"."resource_location");
                    }

                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Location'; //Title
            $this->load->view('header',$data);
            $this->load->view('resource_location/add');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }


    public function edit($id)
    {
        if( can('edit-resource_country') ) {
            $category = $this->resource_location_model->get_row($id);
            //print_r($category); exit;
            if($this->input->post('submit'))
            {
                $data['location_name'] = $this->input->post('location_name');
                $data['location_name_ar'] = $this->input->post('location_name_ar');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('location_name', 'Country Name (English)', 'trim|required');
                $this->form_validation->set_rules('location_name_ar', 'Country Name (Arabic)', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
                $imgVal = true;

                if (($this->form_validation->run() == true)) {

                    $data['wcrid'] = $id;
                    $insert = $this->resource_location_model->update($data);
                    if($insert){
                        $this->session->set_flashdata('msg',"Country Updated successfully");
                        $base_url=base_url();
                        redirect("$base_url"."resource_location");
                    }
                }
            }
            $data['category'] = $category;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Location'; //Title
            $this->load->view('header',$data);
            $this->load->view('resource_location/edit');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function delete($id)
    {
        if( can('delete-resource_country') ) {
            if($this->resource_location_model->delete($id)){
                $this->session->set_flashdata('msg',"Deleted successfully");
            }
            redirect(base_url()."resource_location");
        }
        else{
            echo "Permission denied";
        }


    }



}
