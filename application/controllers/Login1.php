<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_model');
}
	public function index()
	{
		$data['site_title'] = 'Admin Dashboard'; //Title
		$this->load->view('login',$data);
	}
	public function login_validation()  
      {  
           
                $username = $this->input->post('username');  
                $password = $this->input->post('password');  
                //model function  
                if($this->login_model->can_login($username, $password))  
                {  
                     $session_data = array(  
                          'username'     =>     $username  
                     );  
                     $this->session->set_userdata($session_data); 
                     //$this->session->set_userdata('username', $username); 
                     redirect(base_url() . 'Dashboard');  
        			$data['site_title'] = 'Admin Dashboard'; //Title
        			$data['page_title'] = 'Dashboard'; //Title
                    $this->load->view('header',$data);
		            $this->load->view('dashboard');
                    $this->load->view('dashboard_footer');
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(base_url());  
                }  
           
      }

    public function logout() {
        // Removing session data
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $data['site_title'] = 'Admin Dashboard'; //Title
        $this->load->view('login', $data);
    }  
}
