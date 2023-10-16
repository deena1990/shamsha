<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        $this->load->library('FCM');

        // Load database
        $this->load->model('notification_model');
        $this->load->library('auth');
    }

    function index()
    {
        // if( can('view-notifications') ) {
            $data=array();
            $data['notifications'] = $this->notification_model->getNotifications();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Notifications';
            $this->load->view('header', $data);
            $this->load->view('notification', $data);
            $this->load->view('user_footer');
        // }
        // else{
        //     echo "Permission denied";
        // }
    }
}