<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('app_model');
        $this->load->library('auth');

    }

    public function eventDetails()
    {
        $event_id = $_GET['event_id'];
        $language = $_GET['language'];
        $eventDetails = $this->app_model->get_event($event_id);
        if ($language == "en"){
            $data['event'] = [
                'event_pic' => $eventDetails->event_pic,
                'title' => $eventDetails->title_en,
                'date' => date('d-M-Y',strtotime($eventDetails->date)),
                'time' => $eventDetails->venu_time,
                'venu' => $eventDetails->venu,
                'content' => $eventDetails->content_en,
            ];
        }else{
            $data['event'] = [
                'event_pic' => $eventDetails->event_pic,
                'title' => $eventDetails->title_ar,
                'date' => date('d-M-Y',strtotime($eventDetails->date)),
                'time' => $eventDetails->venu_time,
                'venu' => $eventDetails->venu_ar,
                'content' => $eventDetails->content_ar,
            ];
        }
        // print_r($data);die;
        $this->load->view('pages/eventDetails', $data);
    }

    public function articleDetails()
    {
        $article_id = $_GET['article_id'];
        $language = $_GET['language'];
        $articleDetails = $this->app_model->get_media_article($article_id);
        if ($language == "en"){
            $data['article'] = [
                'image' => $articleDetails->image,
                'title' => $articleDetails->title_en,
                'content' => $articleDetails->content_en,
            ];
        }else{
            $data['article'] = [
                'image' => $articleDetails->image,
                'title' => $articleDetails->title_ar,
                'content' => $articleDetails->content_ar,
            ];
        }
        // print_r($data);die;
        $this->load->view('pages/articleDetails', $data);
    }

    public function terms_conditions()
    {
        $language = $_GET['language'];
        $terms_conditions = $this->app_model->get_terms_conditions();
        if ($language == "en"){
            $data['terms'] = [
                'title' => $terms_conditions->title_en,
                'content' => $terms_conditions->content_en,
            ];
        }else{
            $data['terms'] = [
                'title' => $terms_conditions->title_ar,
                'content' => $terms_conditions->content_ar,
            ];
        }
        $this->load->view('pages/terms&conditions', $data);
    }

    public function resources()
    {
        $resource_loc_id = $_GET['resource_loc_id'];
        $resource_type_id = $_GET['resource_type_id'];
        $data['resource_type'] = $this->app_model->get_resource_type($resource_type_id);
        $data['hospital_details'] = $this->app_model->get_hospital_details($resource_loc_id,$resource_type_id);
        $this->load->view('pages/resources',$data);
    }

    public function hupdate($id)
    {
        if (can('view-setting')) {
            if ($this->input->post('submit')) {
                $home_image = $this->input->post('home_image');
                $heading1_en = $this->input->post('heading1_en');
                $heading1_ar = $this->input->post('heading1_ar');
                $content1_en = $this->input->post('content1_en');
                $content1_ar = $this->input->post('content1_ar');
                $heading2_en = $this->input->post('heading2_en');
                $heading2_ar = $this->input->post('heading2_ar');
                $content2_en = $this->input->post('content2_en');
                $content2_ar = $this->input->post('content2_ar');
                $imgVal = true;
                $config['upload_path'] = 'assets/images';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['home_image']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!empty($_FILES['home_image']['name'])) {

                    if ($this->upload->do_upload('home_image')) {
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata( 'home_image_error', $this->upload->display_errors() );
                        $imgVal = false;
                        // return false;
                        redirect("$base_url" . "about/hupdate/1");
                    }
                } else {
                    $picture = 'img1.png';
                }
                $user = array(
                    'email' => $picture, 
                    'title_en' => $heading1_en, 
                    'title_ar' => $heading1_ar, 
                    'content_en' => $content1_en, 
                    'content_ar' => $content1_ar, 
                    'vision_en' => $heading2_en, 
                    'vision_ar' => $heading2_ar, 
                    'service_en' => $content2_en, 
                    'service_ar' => $content2_ar,
                );
                //print_r($user);
                //die();
                $this->about_model->add_home($user);
                $this->session->set_flashdata('msg', "Home has been updated successfully");
                $base_url = base_url();
                redirect("$base_url" . "about/hupdate/1");
            }
            $data['about'] = $this->about_model->hget($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['mpage_title'] = 'Settings'; //Title
            $data['page_title'] = 'Home'; //Title
            $this->load->view('header', $data);
            $this->load->view('home');
            $this->load->view('user_footer');
        }
        else {
            echo "Permission denied";
        }
    }

    public function aupdate($id)
    {
        if ($this->input->post('submit')) {
            $title_en = $this->input->post('title_en');
            $title_ar = $this->input->post('title_ar');
            $content1_en = $this->input->post('content1_en');
            $content1_ar = $this->input->post('content1_ar');
            $content2_en = $this->input->post('content2_en');
            $content2_ar = $this->input->post('content2_ar');
            $content3_en = $this->input->post('content3_en');
            $content3_ar = $this->input->post('content3_ar');
            $content4_en = $this->input->post('content4_en');
            $content4_ar = $this->input->post('content4_ar');
            $previous_image1 = $this->input->post('previous_image1');
            if (!empty($_FILES['image1']['name'])) {
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['image1']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image1')) {
                    $uploadData = $this->upload->data();
                    $image1 = $uploadData['file_name'];
                } else {
                    $image1 = '';
                }
            } else {
                $image1 = $previous_image1;
            }
            $name1_en = $this->input->post('name1_en');
            $name1_ar = $this->input->post('name1_ar');
            $tag1_en = $this->input->post('tag1_en');
            $tag1_ar = $this->input->post('tag1_ar');
            $post1_en = $this->input->post('post1_en');
            $post1_ar = $this->input->post('post1_ar');
            $about1_en = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('about1_en')));
            $about1_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('about1_ar')));
            $previous_image2 = $this->input->post('previous_image2');
            if (!empty($_FILES['image2']['name'])) {
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['image2']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('image2')) {
                    $uploadData = $this->upload->data();
                    $image2 = $uploadData['file_name'];
                } else {
                    $image2 = '';
                }
            } else {
                $image2 = $previous_image2;
            }
            $name2_en = $this->input->post('name2_en');
            $name2_ar = $this->input->post('name2_ar');
            $tag2_en = $this->input->post('tag2_en');
            $tag2_ar = $this->input->post('tag2_ar');
            $post2_en = $this->input->post('post2_en');
            $post2_ar = $this->input->post('post2_ar');
            $about2_en = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('about2_en')));
            $about2_ar = str_replace(array("&nbsp;", "\n", "\t", "\r"), " ", strip_tags($this->input->post('about2_ar')));
            
            $user=array('title_en' =>$title_en, 'title_ar' =>$title_ar, 'content_en' => $content1_en, 'content_ar' => $content1_ar,'email' => $content2_en, 'ar_helpline'=> $content2_ar, 'contact' => $content3_en, 'address' => $content3_ar, 'en_helpline' => $content4_en, 'ab_values_ar' =>$content4_ar, 'team1' =>$image1, 'team_a_name' =>$name1_en, 'longitude' =>$name1_ar, 'vol_form_con_en' =>$tag1_en, 'twitter' =>$tag1_ar, 'team_a_info' =>$post1_en, 'google_map' =>$post1_ar, 'vol_goo_con_en' =>$about1_en, 'website' =>$about1_ar, 'team2' =>$image2, 'team_b_name' =>$name2_en, 'facebook' =>$name2_ar, 'vol_form_con_ar' =>$tag2_en, 'linkden' =>$tag2_ar, 'team_b_info' =>$post2_en, 'latitude' =>$post2_ar, 'vol_goo_con_ar' =>$about2_en, 'instagram' =>$about2_ar);
            // $user = array('content_en' => $con_en, 'content_ar' => $con_ar,
            //     'team1' => $apicture2, 'team2' => $bpicture2);
            //	print_r($user);
            //die();
            $this->about_model->add_about($user);
            $this->session->set_flashdata('msg', "About Us Page has been updated successfully !!");
            $base_url = base_url();
            redirect("$base_url" . "about/aupdate/8");
        }
        $data['about'] = $this->about_model->aget($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['mpage_title'] = 'Settings'; //Title
        $data['page_title'] = 'About Us'; //Title
        // echo"<pre>";print_r($data);die;
        $this->load->view('header', $data);
        $this->load->view('about');
        $this->load->view('user_footer');

    }
}
