<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Resource_category extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/resource_model');
    }

    public function index_post() {
        header('Access-Control-Allow-Origin: *'); 
        $result = $this->resource_model->get_cat_data();
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
            if ($result) {
                $data = array(
                    'success' => 'true',
                    'message' => '',
                );
                foreach ($result as $key => $value) {
                    if ($language == "en"){ $category_name = $value->category_name; $location_name = $value->location_name; }
                    if ($language == "ar"){ $category_name = $value->category_name_ar; $location_name = $value->location_name_ar; }
                    $cat_img = explode(':::',$value->category_icon);
                    $data['Data'][]  = array(
                        'wcrcid' => $value->wcrcid,
                        'category_name' => $category_name,
                        'category_icon' => base_url().'uploads/resource_category_img/'.$cat_img[0],
                        'category_icon_select' => base_url().'uploads/resource_category_img/'.$cat_img[1],
                        'location_name' => $location_name,
                        'wcrid' => $value->wcrid,
                    );
                }
            } else {
                if ($language == "en"){ $msg = "Data not found"; }
                if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; }
                $data = array(
                    'status' => 'false',
                    'message' => $msg,
                    //"data" => array(),
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
