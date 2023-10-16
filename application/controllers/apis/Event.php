<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Event extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/event_model');
    }

    public function index_post() {
        
        $result = $this->event_model->get_data();
        if ($result) {
            $data =  $result;
        } else {
            $data = array(
                'status' => "invalid",
                "message" => "Not Found",
                //"data" => array(),
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function event_vol_post() {
        
        $result = $this->event_model->get_data_vol();
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
                    if ($language == "en"){ $title = $value->title_en; $content = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($value->content_en)); $address = $value->venu; }
                    if ($language == "ar"){ $title = $value->title_ar; $content = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($value->content_ar)); $address = $value->venu_ar; }
                    $data['Data'][] =  array(
                        'event_id' => $value->wceid,
                        'event_name' => $title,
                        'event_type' => $value->event_type,
                        'event_req_registration' => $value->req_registration,
                        'event_content' => $content,
                        'event_image' => base_url().'uploads/'.$value->event_pic,
                        'event_price' => $value->price,
                        'event_address' => $address,
                        'event_time' => $value->venu_time,
                        'event_date' => date('F d',strtotime($value->date)),
                        'event_status' => $value->status,
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

    public function media_photo_post() {
        
        $result = $this->event_model->get_media_photo();
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
                    $data['Data'][] =  array(
                        'media_id' => $value->wceiid,
                        'event_id' => $value->event_id,
                        'media_image' => base_url().'uploads/Events/mediaPhotos/'.$value->image,
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

    public function media_article_post() {
        
        $result = $this->event_model->get_media_article();
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
                    if ($language == "en"){ $title = $value->title_en; $content = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($value->content_en)); }
                    if ($language == "ar"){ $title = $value->title_ar; $content = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($value->content_ar)); }
                    $data['Data'][] =  array(
                        'id' => $value->wcmaid,
                        'title' => $title,
                        'content' => $content,
                        'image' => base_url().'uploads/Events/mediaPhotos/'.$value->image,
                        'date' => date('m-d-Y',strtotime($value->date)),
                        'time' => $value->time,
                        'status' => $value->status,
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