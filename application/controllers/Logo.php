<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logo extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load database
		$this->load->model('logo_model');
        $this->load->library('auth');
}
	public function index()
	{
        if( can('view-setting') ) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'Logo'; //Title
            $this->load->view('header',$data);
            $this->load->view('logo');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
	}
	public function upload($id) 
	{
        if( can('view-setting') ) {
            if($this->input->post('submit'))
            {
                $logo2 = $this->input->post('logo2');
                if(!empty($_FILES['logo']['name'])){
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2000;
                    $config['max_width'] = 1500;
                    $config['max_height'] = 1500;
                    $config['file_name'] = $_FILES['logo']['name'];

                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('logo')){
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    }else{
                        $picture = '';
                    }
                    $picture2 = $picture;
                }else{
                    $picture2 = $logo2;
                }


                $user=array('site_logo' =>$picture2);
                //print_r($user);
                //die();
                $this->logo_model->add_logo($user);
                $this->session->set_flashdata('msg',"Logo has been updated successfully");
                $base_url=base_url();
                redirect("$base_url"."logo/upload/1");
            }
            $data['logo']=$this->logo_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'Logo'; //Title
            $this->load->view('header',$data);
            $this->load->view('logo');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }


    }
	 
}
