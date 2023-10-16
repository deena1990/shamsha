<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_to extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load database
		$this->load->model('contact_model');
		
}

	public function index() 
	{
        $id = $this->input->post('id');
       	$user=$this->contact_model->userDetail($id);

       echo"<pre>"; print_r($user);

    }
    
	 
}
