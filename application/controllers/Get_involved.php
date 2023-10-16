<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_involved extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load database
		$this->load->model('get_involved_model');
        $this->load->library('auth');
		
    }
    
	public function index()
	{
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['mpage_title'] = 'Settings'; //Title
		$data['page_title'] = 'Getinvolved'; //Title
        $this->load->view('header',$data);
		$this->load->view('get_involved');
        $this->load->view('dashboard_footer');
	}
	public function update($id) 
	{
        if (can('view-cms')) {
            if($this->input->post('submit'))
            {
                $title_en = $this->input->post('title_en');
                $title_ar = $this->input->post('title_ar');
                $heading_en = $this->input->post('heading_en');
                $heading_ar = $this->input->post('heading_ar');
                $content1_en = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('content1_en')));
                $content1_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('content1_ar')));
                $content2_en = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('content2_en')));
                $content2_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('content2_ar')));
                $previous_image = $this->input->post('previous_image');
                if (!empty($_FILES['image']['name'])) {
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    // $config['max_size'] = 2000;
                    // $config['max_width'] = 1500;
                    // $config['max_height'] = 1500;
                    $config['file_name'] = $_FILES['image']['name'];

                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('image')) {
                        $uploadData = $this->upload->data();
                        $image = $uploadData['file_name'];
                    } else {
                        $image = '';
                    }
                } else {
                    $image = $previous_image;
                }
                $content3_en = $this->input->post('content3_en');
                $content3_ar = $this->input->post('content3_ar');
                $act_title_en = $this->input->post('act_title_en');
                $act_title_ar = $this->input->post('act_title_ar');
                $act_content_en = $this->input->post('act_content_en');
                $act_content_ar = $this->input->post('act_content_ar');
                $vol_title_en = $this->input->post('vol_title_en');
                $vol_title_ar = $this->input->post('vol_title_ar');
                $vol_content_en = $this->input->post('vol_content_en');
                $vol_content_ar = $this->input->post('vol_content_ar');
                $gift_title_en = $this->input->post('gift_title_en');
                $gift_title_ar = $this->input->post('gift_title_ar');
                $gift_content_en = $this->input->post('gift_content_en');
                $gift_content_ar = $this->input->post('gift_content_ar');
                $user=array('title_en' =>$title_en, 'title_ar' =>$title_ar, 'content_en' =>$heading_en, 'content_ar' =>$heading_ar, 'contact' =>$content1_en, 'linkden' =>$content1_ar, 'en_helpline' =>$image, 'google_map' =>$content2_en, 'website' =>$content2_ar, 'address' =>$content3_en, 'instagram' =>$content3_ar, 'ar_helpline' =>$act_title_en, 'vision_en' =>$act_title_ar, 'latitude' =>$act_content_en, 'vision_ar' =>$act_content_ar, 'email' =>$vol_title_en, 'ab_values_en' =>$vol_title_ar, 'longitude' =>$vol_content_en, 'ab_values_ar' =>$vol_content_ar, 'facebook' =>$gift_title_en, 'service_en' =>$gift_title_ar, 'twitter' =>$gift_content_en, 'service_ar' =>$gift_content_ar);
                $this->get_involved_model->add($user);
                $this->session->set_flashdata('msg',"Get Involved Page has been updated successfully !!");
                $base_url=base_url();
                redirect("$base_url"."get_involved/update/3");
            }
            $data['about']=$this->get_involved_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'Get Involved'; //Title
            $this->load->view('header',$data);
            $this->load->view('get_involved');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }


    }
	
}
