<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load database
		$this->load->model('contact_model');
		
}

	public function update($id) 
	{
       	if($this->input->post('submit'))
		{
            $title_en = $this->input->post('title_en');
            $title_ar = $this->input->post('title_ar');
            $previous_image = $this->input->post('previous_image');
            $imgVal = true;
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['image']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                } else {
                    $this->session->set_flashdata( 'contact_image_error', $this->upload->display_errors() );
                    $imgVal = false;
                    // return false;
                    $base_url = base_url();
                    redirect("$base_url" . "contact/update/4");
                }
            } else {
                $image = $previous_image;
            }
            $heading_en = $this->input->post('heading_en');
            $heading_ar = $this->input->post('heading_ar');
            $content_en = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('content_en')));
            $content_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('content_ar')));
            $address_en = $this->input->post('address_en');
            $address_ar = $this->input->post('address_ar');
            $google_map = $this->input->post('google_map');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $user=array('title_en' =>$title_en, 'title_ar' =>$title_ar, 'service_en' => $image, 'team1' => $heading_en, 'service_ar' => $heading_ar, 
            'content_en' => $content_en, 'content_ar' => $content_ar, 'address' => $address_en, 'team2' => $address_ar, 'google_map' => $google_map, 
            'latitude' => $latitude, 'longitude' => $longitude);
		
			$this->contact_model->add($user);
			$this->session->set_flashdata('msg',"Contact Us Page has been updated successfully !!");
			$base_url=base_url();
			redirect("$base_url"."contact/update/4");
		}
		$data['contact']=$this->contact_model->get($id);
		$data['site_title'] = 'Admin Dashboard'; //Title
		$data['mpage_title'] = 'Settings'; //Title
		$data['page_title'] = 'Contact Us'; //Title
        $this->load->view('header',$data);
		$this->load->view('contact');
        $this->load->view('user_footer');

    }
    
	 
}
