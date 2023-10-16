<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_cpassword extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/volunteer_login_model');
    }

    public function index_post() {
        
     
            $result = $this->volunteer_login_model->cpassword();
            if ($result=='true') {
                $data = array(
                    'status' => "valid",
                    "message" => "Password Changed Successfully",
                );
            } else {
                $data = array(
                    'status' => "invalid",
                    "message" => "Not Changed, Please try again",
                    //"data" => array(),
                );
            }
        
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
