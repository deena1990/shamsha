<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Contactus extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/contact_model');
    }

    public function index_post() {
        
        $result = $this->contact_model->get_data();
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
            if ($language == "en"){ $msg = "Data not found"; $title = $result->title_en; $heading = $result->team1; $content = strip_tags($result->content_en); $address = $result->address; }
            if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; $title = $result->title_ar; $heading = $result->service_ar; $content = strip_tags($result->content_ar); $address = $result->team2; }
            if ($result) {
                $data = array(
                    'success' => 'true',
                    'message' => '',
                );
                $data['Data'] = array(
                    'image' => base_url().'uploads/'.$result->service_en,
                    'title' => $title,
                    'heading' => $heading,
                    'content' => $content,
                    'address' => $address,
                    'google_map' => $result->google_map,
                    'latitude' => $result->latitude,
                    'longitude' => $result->longitude,
                );
            } else {
                $data = array(
                    'success' => "false",
                    "message" => $msg,
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
