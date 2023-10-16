<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Aboutwebview extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/about_model');
    }

    public function index_post() {
        
        $result = $this->about_model->get_data();
        if ($result) {
            $data = $result;
            $data2 = array(
                'Url' => 'http://shamsaha.sayg.co/aboutwebview.php'
                );
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data2, REST_Controller::HTTP_OK);
    }

}
