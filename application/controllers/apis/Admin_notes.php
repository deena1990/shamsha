<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Admin_notes extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/admin_notes_model');
    }

    public function index_post() {

        $result = $this->admin_notes_model->get_data();
        if ($result) {
           /* $data = array(
                'status' => "valid",
                "message" => "Logged in Successfully",
                "data" => array(),
                "data" => $result
            );*/
            $data = $result;
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found"
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }


    public function list_post() {

        $result = $this->admin_notes_model->get_data_by_volunteer($this->post('volunteer_id'));
        if ($result) {
            $data = $result;
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
}
