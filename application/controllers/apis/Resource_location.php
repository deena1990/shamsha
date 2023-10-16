<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Resource_location extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/resource_model');
    }

    public function index_post() {
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                'success' => "false",
                "message" => "Please enter language",
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                'success' => "false",
                "message" => "Please enter available language ( en, ar )",
            );
        }else{
            $result = $this->resource_model->get_loc_data();
            if ($result) {
                $data = array(
                    'success' => 'true',
                    'message' => '',
                );
                foreach ($result as $key => $value) { 
                    if ($language == "en"){ $location_name = $value->location_name; }
                    if ($language == "ar"){ $location_name = $value->location_name_ar; }
                    $data['Data'][]  = array(
                        'wcrid' => $value->wcrid,
                        'country_code' => $value->country_code,
                        'location_name' => $location_name,
                    );
                } 
            } else {
                if ($language == "en"){ $msg = "Data not found"; }
                if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; }
                $data = array(
                    'status' => 'false',
                    'message' => $msg,
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
