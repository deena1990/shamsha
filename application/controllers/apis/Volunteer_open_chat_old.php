<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_open_chat extends REST_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index_post() {
        
        $data = $this->input->post();
        $data['attened_date'] = date('Y-m-d H:i:s');
        $this->db->trans_begin();
        $this->db->set($data);
        $this->db->insert('volunteer_cases');
        $attendedId = $this->db->insert_id();
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
                "message" => "Cases Attended",
                "attended_id" => $attendedId,
            );
        }        
        $this->response($data, REST_Controller::HTTP_OK);
    }   
}
