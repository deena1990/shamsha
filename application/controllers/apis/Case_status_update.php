<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Case_status_update extends REST_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index_post() {
		 date_default_timezone_set('Asia/Kuwait');
       // $this->db->trans_begin();

        //echo $this->input->post('status');
		//-> where('id', $this->input->post('victim_id'))
        $this->db->where('case_id', $this->input->post('case_id') )
            ->set('status', $this->input->post('status') )
			 ->set('reported_date', date('Y-m-d H:i:s') )
            ->update('victim');
		//->where('id', $this->input->post('attended_id'))
        $this->db->where('case_id', $this->input->post('case_id') )
            ->where('volunteer_id', $this->input->post('volunteer_id') )
            ->set('given_report', $this->input->post('status') )
            ->update('volunteer_cases');

        if( $this->db->trans_status() === FALSE ) {
            $this->db->trans_rollback();
            $data = array(
                'status' => REST_Controller::HTTP_EXPECTATION_FAILED,
                "message" => "Something went wrong"
            );
        } else {
            $this->db->trans_commit();
            $data = array(
                'status' => REST_Controller::HTTP_OK,
                "message" => "Chat status has been updated",
            );
        }        
        $this->response($data, REST_Controller::HTTP_OK);
    }   
}
