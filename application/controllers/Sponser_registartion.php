<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponser_registartion extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('sponser_model');

}



	function allregistrations()
	{
			$data['registartionlist']=$this->sponser_model->get_entries();
			$data['site_title'] = 'Admin Dashboard'; //Title
			$data['page_title'] = 'Sponser Registration';
        	$this->load->view('header',$data);
			$this->load->view('sponseregisrationlist',$data);
			$this->load->view('user_footer');
	}

    function getLists(){
        $data = $row = array();

        // Fetch member's records
        $sponsorData = $this->sponser_model->getRows($_POST);

        $i = $_POST['start'];
        foreach($sponsorData as $sponser){
            $i++;
            $created = date( 'jS M Y', strtotime($sponser->created_at));
            $data[] = array($i, $sponser->name, $sponser->email, $sponser->mobile, $sponser->address, $sponser->price, $created, $sponser->pay_result, $sponser->wcsbid);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sponser_model->countAll(),
            "recordsFiltered" => $this->sponser_model->countFiltered($_POST),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    function view($id)
    {
        $data['registartionlist']=$this->sponser_model->get_row($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Sponser Registration';
        $this->load->view('header',$data);
        $this->load->view('sponseregisrationview',$data);
        $this->load->view('user_footer');
    }


}
