<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Bmember extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/about_model');
    }

    public function index_post() {
        
        $result = $this->about_model->get_bmember_data();
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
                    'success' => "true",
                    "message" => "",
                );
                foreach ($result as $key => $value) {
                    if ($language == "en"){ $name = $value->bname; $designation = $value->designation; }
                    if ($language == "ar"){ $name = $value->bname_ar; $designation = $value->designation_ar; }
                    $data['Data'][] = array(
                        "name" => $name,
                        "image" => base_url().'uploads/about/'.$value->image,
                        "designation" => $designation,
                    ); 
                }
                
            } else {
                if ($language == "en"){ $msg = "Data not found"; }
                if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; }
                $data = array(
                    'success' => "false",
                    "message" => $msg,
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
