<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class About extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/about_model');
    }

    public function index_post() {
        
        $result = $this->about_model->get_data();
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
            if ($language == "en"){ $msg = "Data not found"; $title = $result->title_en; $content1 = strip_tags($result->content_en); $content2 = strip_tags($result->email); $content3 = strip_tags($result->contact); $content4 = strip_tags($result->en_helpline); $name1 = $result->team_a_name; $tag1 = $result->vol_form_con_en; $post1 = $result->team_a_info; $about1 = $result->vol_goo_con_en; $name2 = $result->team_b_name; $tag2 = $result->vol_form_con_ar; $post2 = $result->team_b_info; $about2 = $result->vol_goo_con_ar; }
            if ($language == "ar"){ $msg = "لم يتم العثور على بيانات"; $title = $result->title_ar; $content1 = strip_tags($result->content_ar); $content2 = strip_tags($result->ar_helpline); $content3 = strip_tags($result->address); $content4 = strip_tags($result->ab_values_ar); $name1 = $result->longitude; $tag1 = $result->twitter; $post1 = $result->google_map; $about1 = $result->website; $name2 = $result->facebook; $tag2 = $result->linkden; $post2 = $result->latitude; $about2 = $result->instagram;}
            if ($result) {
                $data = array(
                    'success' => "true",
                    "message" => "",
                );
                $data['Data'] = array(
                    'title' => $title,
                    'content1' => $content1,
                    'content2' => $content2,
                    'content3' => $content3,
                    'content4' => $content4,
                    'image1' => base_url().'uploads/'.$result->team1,
                    'name1' => $name1,
                    'tag1' => $tag1,
                    'post1' => $post1,
                    'about1' => $about1,
                    'image2' => base_url().'uploads/'.$result->team2,
                    'name2' => $name2,
                    'tag2' => $tag2,
                    'post2' => $post2,
                    'about2' => $about2,
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
