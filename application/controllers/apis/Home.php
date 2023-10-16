<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Home extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/about_model');
    }

    public function index_post() {
        
        $result = $this->about_model->get_hdata();
        $language = $this->input->post('language');
        if (empty($language)){
            $data = array(
                'success' => "false",
                "message" => "Please enter language",
                'lan'=>$language
            );
        }else if ($language != "en" && $language != "ar"){
            $data = array(
                'success' => "false",
                "message" => "Please enter available language ( en, ar )",
                'lan'=>$language
            );
        }else{
            if ($language == "en"){ $msg = "Data not found"; $heading1 = strip_tags($result->title_en); $content1 = strip_tags($result->content_en); $heading2 = strip_tags($result->vision_en); $content2 = strip_tags($result->service_en); }
            if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; $heading1 = strip_tags($result->title_ar); $content1 = strip_tags($result->content_ar); $heading2 = strip_tags($result->vision_ar); $content2 = strip_tags($result->service_ar); }
            if ($result) {
                $data = array(
                    'success' => 'true',
                    'message' => '',
                    'lan'=>$language
                );
                $data['Data']  = array(
                    'image' => base_url().'assets/images/'.$result->email,
                    'heading1' => $heading1,
                    'content1' => $content1,
                    'heading2' => $heading2,
                    'content2' => $content2,
                );
            } else {
                $data = array(
                    'success' => 'false',
                    'message' => $msg,
                    'lan'=>$language
                    //"data" => array(),
                );
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
