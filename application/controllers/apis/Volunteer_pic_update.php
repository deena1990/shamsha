<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_pic_update extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/volunteer_login_model');
    }

    public function index_post() {
        if (empty($this->post('volunteer_id'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Volunteer required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }

        

        
        $result = $this->volunteer_login_model->update_user_picinfo();
        //print_r($result);
        //die;
        if ($result) {
            $data = array(
                'status' => "valid",
                "message" => "Updated Successfully",
                //"data" => array(),
               // "data" => $result
            );
            $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Upload failed",
                //"data" => array(),
               // "data" => $result
            );
            $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
        }
       
    }

}
