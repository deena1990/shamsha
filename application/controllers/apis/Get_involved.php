<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Get_involved extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/getinvolved_model');
    }

    public function index_post() {
        
        $result = $this->getinvolved_model->get_data();
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
                if ($language == "en"){ $title = $result->title_en; $heading = $result->content_en; $content1 = str_replace("amp;","",$result->contact); $content2 = $result->google_map; $content3 = $result->address; $act_title = $result->ar_helpline; $act_content = $result->latitude; $vol_title = $result->email; $vol_content = $result->longitude; $gift_title = $result->facebook; $gift_content = $result->twitter; }
                if ($language == "ar"){ $title = $result->title_ar; $heading = $result->content_ar; $content1 = $result->linkden; $content2 = $result->website; $content3 = $result->instagram; $act_title = $result->vision_en; $act_content = $result->vision_ar; $vol_title = $result->ab_values_en; $vol_content = $result->ab_values_ar; $gift_title = $result->service_en; $gift_content = $result->service_ar; }
                $data['Data'] = array(
                    'title' => $title,
                    'heading' => $heading,
                    'content1' => $content1,
                    "image" => base_url().'uploads/'.$result->en_helpline,
                    'content2' => $content2,
                    'content3' => $content3,
                    'act_title' => $act_title,
                    'act_content' => $act_content,
                    'vol_title' => $vol_title,
                    'vol_content' => $vol_content,
                    'gift_title' => $gift_title,
                    'gift_content' => $gift_content,
                );
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
