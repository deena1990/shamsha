<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Checkdevice_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->model('apis/checkdevice_victim_model');
    }

    /*public function index_post() {*/
    public function index_post() {

        //echo '<pre>'; print_r($this->post('deviceid')); exit;
        if (empty($this->post('deviceid'))) {
            $data = array(
                'status' => "invalid",
                "message" => "Device Not Valid",
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }

        $status = $this->checkdevice_victim_model->checkdevice_delete();
        //echo '<pre>'; print_r($status); exit;

        //$change_stat = $this->checkdevice_victim_model->checkdevice_update($status);
            if($status){
                // if($status=='Active'){
                //     $data = array(
                //         'status' => "Active",
                //     );
                // }
                // else{
                //     $data = array(
                //         'status' => "Inactive",
                //     );
                // }
                
                $data = array(
                        'status' => "Inactive",
                    );

                $this->response($data, REST_Controller::HTTP_OK);
                $this->output->_display();
                exit;
            }
    }
}
