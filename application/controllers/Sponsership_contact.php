<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsership_contact extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('sponsership_contact_model');
        $this->load->library('auth');
    }

    public function index(){
        if( can('view-volunteer') ) {
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Sponsership Contact'; //Page Title
            $this->load->view('header', $data);
            $this->load->view('sponsership_contact/index', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function getLists()
    {
        if( can('view-volunteer') ) {
            $data = $row = array();

            // Fetch member's records
            $contactData = $this->sponsership_contact_model->getRows($_POST);

            $i = $_POST['start'];
            foreach ($contactData as $contact) {
                $i++;
                $data[] = array("", $contact->name, $contact->email, $contact->phone, $contact->company, $contact->message, date('d M Y H:i:s', strtotime($contact->created_date)),$contact->id);
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->sponsership_contact_model->countAll(),
                "recordsFiltered" => $this->sponsership_contact_model->countFiltered($_POST),
                "data" => $data,
            );

            // Output to JSON format
            echo json_encode($output);
        }
        else{
            echo "Permission denied";
        }

    }


}