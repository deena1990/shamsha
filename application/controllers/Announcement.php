<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('announcement_model');
        $this->load->model('volunteer_model');
        $this->load->library('auth');
        $this->load->library('FCM');
    }

    public function add()
    {
        if( can('add-announcement') ) {
            if ($this->input->post('submit')) {

                $user_id = array('volunteer_id'=>$this->session->userdata('userID'));
                $who_are_you = $this->input->post('who_are_you');
                $announcement_type = $this->input->post('announcement_type');
                // $viaEmail = $this->input->post('viaEmail');
                $emailaddress = array('emailaddress'=>$this->input->post('emailaddress'));
                $email = $this->input->post('emailaddress');
                $date = $this->input->post('date');
                $ann = $this->input->post('anounce_type');
                $subject_en = $this->input->post('subject_en');
                $content_en = $this->input->post('content_en');
                $picture = "";
                $ff = "";
                $data = [];
                $data['announcement_type'] = $announcement_type;
                $data['emailaddress'] = $email;
                $data['date'] = $date;
                $data['anounce_type'] = $ann;
                $data['subject_en'] = $subject_en;
                $data['content_en'] = $content_en;

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('announcement_type', 'Send To', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('subject_en', 'Subject', 'required');
                $this->form_validation->set_rules('anounce_type', 'Attachment Type', 'required');
                if ($announcement_type == "selected") {
                    $this->form_validation->set_rules('emailaddress', 'Email', 'required');
                }
                if ($ann == "content") {
                    $this->form_validation->set_rules('content_en', 'Content', 'required');
                }
                if ($who_are_you == "super-admin" || $who_are_you == "admin"){
                    $announcement_status = "Active";
                    // print_r($announcement_status);die;
                }else if ($who_are_you == "volunteer"){
                    $announcement_status = "Pending";
                    // print_r($announcement_status);die;
                }

                if ($this->form_validation->run() == false) {
                    $data['error'] = validation_errors();
                } else {

                    if ($ann == 'image' || $ann == 'doc' || $ann == 'pdf') {
                        if (!empty($_FILES['event_pic']['name'])) {
                            $config['upload_path'] = 'uploads/announcement/';
                            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
                            $config['max_size'] = 50000;
                            $config['max_width'] = 3500;
                            $config['max_height'] = 3500;
                            $config['file_name'] = $_FILES['event_pic']['name'];
                            $config['file_ext'] = $_FILES['event_pic']['name'];

                            //Load upload library and initialize configuration
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('event_pic')) {
                                //print_r('hi');
                                $uploadData = $this->upload->data();
                                $picture = $uploadData['file_name'];
                                $ff = $uploadData['file_ext'];

                            } else {
                                /*$this->validation->set_message('event_pic', $this->upload->display_errors());*/
                                $this->form_validation->set_message('event_pic', $this->upload->display_errors());
                                return false;
                                $picture = '';

                            }
                        } else {
                            //print_r('text');
                            $picture = '';
                        }
                        // $url = base_url();
                        // $picture2 = $url . 'uploads/announcement/' . $picture;
                        $file_type = $ff;

                        $date = $this->input->post('date');
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array(
                            'date' => $dt, 'status' => $announcement_status, 'image' => $picture, 'image_type' => $file_type, 'type' => $ann,
                            'subject_en' => $subject_en, 'send_to' => $announcement_type);
                    }
                    else {
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array('subject_en' => $subject_en, 'content_en' => $content_en,
                            'date' => $dt, 'type' => $ann, 'status' => $announcement_status, 'send_to' => $announcement_type);
                    }
                    if ($announcement_status == "Active"){

                        $this->announcement_model->add_announcement($user);

                        

                        $insert_id = $this->db->insert_id();
                        $selected_email = [];
                        if ($announcement_type == "selected" && !empty($email)) {
                            $email_list = "'" . str_replace(",", "','", $email) . "'";
                            $selected_email = $this->announcement_model->get_volunteers_by_type($announcement_type, $email_list);
                        } elseif (!empty($announcement_type)) {
                            $selected_email = $this->announcement_model->get_volunteers_by_type($announcement_type, []);
                        }

                        if (!empty($selected_email)) {
                            foreach ($selected_email as $volunteer) {
                                $listData = [];
                                $listData['volunteer_id'] = $volunteer->vounter_id;
                                $listData['firebase_token'] = $volunteer->vol_token_id;
                                $listData['notes_id'] = $insert_id;
                                $listData['email'] = $volunteer->vemail;
                                $this->announcement_model->add_notes_admin_send_list($listData);

                                //Deena
                                
                                // if ($viaEmail == "viaEmail"){
                                //     $this->load->config('email');
                                //     $this->load->library('email');
                                //     $this->email->from("cyz@gmail.com", "Shamsaha");
                                //     $this->email->to($listData['email']);
                                //     $this->email->subject($subject_en);
                                //     if ($ann == 'image' || $ann == 'doc' || $ann == 'pdf'){
                                //         $this->email->message("Hello,\n\nThis is an announcement from Shamsaha Admin to you.\n\nPlease find attached in this email carefully.");
                                //         $this->email->attach(base_url() . 'uploads/announcement/' . $_FILES['event_pic']['name']);
                                //     }else{
                                //         $this->email->message($content_en);
                                //     }
                                //     $this->email->set_newline("\r\n");
                                //     $this->email->send();
                                // }
                                
                                //Deena

                            }
                        }


                        // $title = "New announcement added!!";
                        $title = $data['subject_en'];
                        $body = $data['content_en'];
                        //$body = "New announcement";
                           if($announcement_type=="all"){
                            $volunteers = $this->announcement_model->get_volunteers_all();
                           }
                           if($announcement_type=="active"){
                            $volunteers = $this->announcement_model->get_volunteers_active();
                           }
                           if($announcement_type=="arabic"){
                            $volunteers = $this->announcement_model->get_volunteers_arabic();
                           }
                           if($announcement_type=="english"){
                            $volunteers = $this->announcement_model->get_volunteers_english();
                           }
                           if($announcement_type=="selected"){
                            $volunteers = $this->announcement_model->get_volunteers_selected($email);
                           }
                            $arrNotification = array();
                            $arrNotification["body"] = $body;
                            $arrNotification["title"] = $title;
                            $arrNotification["sound"] = "default";
                            $arrNotification["type"] = 4;
                            $arrNotification["tag"] = 4;

                            // echo"<pre>";print_r($volunteers);die;


                            if(count($volunteers['android'])>0){
                                // print_r($volunteers['android_user_id']);die;
                                foreach ($volunteers['android_user_id'] as $key => $value) {
                                    // echo"<pre>";print_r($value);die;
                                    $android_notification_Data = array(
                                                        'user_id' => $value,
                                                        'title' => $title,
                                                        'message' => $body,
                                                        'type' => 4,
                                                        'dateTime' => date('Y-m-d H:i:s')
                                                        );
                                    $this->announcement_model->insertNotification($android_notification_Data);
                                }
                                $this->fcm->send_notification($volunteers['android'], $arrNotification,'Android',true,4);
                            }
                            
                            if(count($volunteers['ios'])>0){
                                // print_r($volunteers['ios_user_id']);die;
                                foreach ($volunteers['ios_user_id'] as $key => $value) {
                                    // echo"<pre>";print_r($value);die;
                                    $ios_notification_Data = array(
                                                        'user_id' => $value,
                                                        'title' => $title,
                                                        'message' => $body,
                                                        'type' => 4,
                                                        'dateTime' => date('Y-m-d H:i:s')
                                                        );
                                    $this->announcement_model->insertNotification($ios_notification_Data);
                                }
                                $this->fcm->send_notification($volunteers['ios'], $arrNotification,'iOS',true,4);
                            }
                            $this->session->set_flashdata('msg', "Announcement has been added successfully");
                            $base_url = base_url();
                            redirect("$base_url" . "announcement/allannouncement");

                    }else{
                        // echo "<pre>";print_r($user);die;

                        $users = array_merge($user,$user_id,$emailaddress);
                        // echo "<pre>";print_r($users);die;
                        $this->announcement_model->add_vol_announcement($users);

                        $this->session->set_flashdata('msg', "Announcement has been added for Approval successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "announcement/volannouncement");

                    }
                }
            }
            $session_id = $this->session->userdata('userID');
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Announcement';
            $data['volunteer_list'] = $this->announcement_model->get_volunteers();
            $data['role_name'] = $this->announcement_model->get_role_name($session_id);
            $this->load->view('header',$data);
            $this->load->view('announcement', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function mailerVSP()
    {
        // if( can('add-announcement') ) {
            if ($this->input->post('submit')) {

                $announcement_type = $this->input->post('announcement_type');
                $emailaddress = array('emailaddress'=>$this->input->post('emailaddress'));
                $email = $this->input->post('emailaddress');
                // $date = $this->input->post('date');
                $ann = $this->input->post('anounce_type');
                $subject_en = $this->input->post('subject_en');
                $content_en = $this->input->post('content_en');
                // $picture = "";
                // $ff = "";
                $data = [];
                $data['announcement_type'] = $announcement_type;
                $data['emailaddress'] = $email;
                // $data['date'] = $date;
                $data['anounce_type'] = $ann;
                $data['subject_en'] = $subject_en;
                $data['content_en'] = $content_en;

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('announcement_type', 'Send To', 'required');
                // $this->form_validation->set_rules('date', 'Date', 'required');
                    $this->form_validation->set_rules('content_en', 'Content', 'required');
                    $this->form_validation->set_rules('subject_en', 'Subject', 'required');
                if ($announcement_type == "selected") {
                    $this->form_validation->set_rules('emailaddress', 'Email', 'required');
                }

                if ($this->form_validation->run() == false) {
                    $data['error'] = validation_errors();
                } else {

                    if ($ann == 'image' || $ann == 'doc' || $ann == 'pdf') {
                        if (!empty($_FILES['event_pic']['name'])) {
                            $config['upload_path'] = 'uploads/announcement/';
                            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
                            // $config['max_size'] = 50000;
                            // $config['max_width'] = 3500;
                            // $config['max_height'] = 3500;
                            $config['file_name'] = $_FILES['event_pic']['name'];
                            $config['file_ext'] = $_FILES['event_pic']['name'];

                            //Load upload library and initialize configuration
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('event_pic')) {
                                // print_r('hi');die;
                                $uploadData = $this->upload->data();
                                $picture = $uploadData['file_name'];
                                $ff = $uploadData['file_ext'];

                            } else {
                                // print_r('bye');die;
                                /*$this->validation->set_message('event_pic', $this->upload->display_errors());*/
                                $this->form_validation->set_message('event_pic', $this->upload->display_errors());
                                return false;

                            }
                        } 
                        // else {
                            // $this->session->set_flashdata('msg', "Attachment is missing !!");
                            // return false;
                            // $base_url = base_url();
                            // redirect("$base_url" . "announcement/mailerVSP");
                        // }
                    }
                        
                    $selected_email = [];
                    if ($announcement_type == "selected" && !empty($email)) {
                        $email_list = "'" . str_replace(",", "','", $email) . "'";
                        $selected_email = $this->announcement_model->get_volunteers_by_type($announcement_type, $email_list);
                    } elseif (!empty($announcement_type)) {
                        $selected_email = $this->announcement_model->get_volunteers_by_type($announcement_type, []);
                    }

                    if (!empty($selected_email)) {
                        foreach ($selected_email as $volunteer) {
                            $listData = [];
                            $listData['email'] = $volunteer->vemail;
                            // print_r($picture);die;
                            //Deena
                            
                            $this->load->config('email');
                            $this->load->library('email');
                            $this->email->from("cyz@gmail.com", "Shamsaha");
                            $this->email->to($listData['email']);
                            $this->email->subject($subject_en);
                            if ($ann == 'image' || $ann == 'doc' || $ann == 'pdf'){
                                $this->email->message($content_en);
                                $this->email->attach(base_url().'uploads/announcement/'.$picture);
                            }else{
                                $this->email->message($content_en);
                            }
                            $this->email->set_newline("\r\n");
                            $this->email->send();
                            
                            //Deena

                        }
                    }

                    $this->session->set_flashdata('msg', "Email has been sent successfully !!");
                    $base_url = base_url();
                    redirect("$base_url" . "announcement/mailerVSP");
                }
            }
            $session_id = $this->session->userdata('userID');
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'VSP Emailer';
            $data['volunteer_list'] = $this->announcement_model->get_volunteers();
            $data['role_name'] = $this->announcement_model->get_role_name($session_id);
            $this->load->view('header',$data);
            $this->load->view('mailerVSP', $data);
            $this->load->view('user_footer');
        // }
        // else{
        //     echo "Permission denied";
        // }

    }

    function allannouncement()
    {
        if( can('view-announcement') ) {
            $session_id = $this->session->userdata('userID');
            $data['announcementlist'] = $this->announcement_model->get_entries();
            $data['role_name'] = $this->announcement_model->get_role_name($session_id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Announcements';
            $this->load->view('header', $data);
            $this->load->view('announcementlist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function edit($id)
    {
        if( can('view-announcement') ) {
            if ($this->input->post('submit')) {
                $announcement_type = $this->input->post('announcement_type');
                $email = $this->input->post('emailaddress');
                $date = $this->input->post('date');
                $ann = $this->input->post('anounce_type');
                $status = $this->input->post('status');
                $subject_en = $this->input->post('subject_en');
                $content_en = $this->input->post('content_en');
                $picture = "";
                $ff = "";
                $data = [];
                $data['announcement_type'] = $announcement_type;
                $data['emailaddress'] = $email;
                $data['date'] = $date;
                $data['anounce_type'] = $ann;
                $data['subject_en'] = $subject_en;
                $data['content_en'] = $content_en;

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('announcement_type', 'Announcement Type', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('subject_en', 'Subject', 'required');
                $this->form_validation->set_rules('anounce_type', 'Attachment Type', 'required');
                if ($announcement_type == "selected") {
                    $this->form_validation->set_rules('emailaddress', 'Email', 'required');
                }
                if ($ann == "content") {
                    $this->form_validation->set_rules('content_en', 'Content', 'required');
                }


                if ($this->form_validation->run() == false) {
                    $data['error'] = validation_errors();
                } else {
                    if ($ann == 'image' || $ann == 'doc' || $ann == 'pdf') {
                        if (!empty($_FILES['event_pic']['name'])) {
                            $config['upload_path'] = 'uploads/announcement/';
                            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
                            $config['max_size'] = 50000;
                            $config['max_width'] = 3500;
                            $config['max_height'] = 3500;
                            $config['file_name'] = $_FILES['event_pic']['name'];
                            $config['file_ext'] = $_FILES['event_pic']['name'];

                            //Load upload library and initialize configuration
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('event_pic')) {
                                //print_r('hi');
                                $uploadData = $this->upload->data();
                                $picture = $uploadData['file_name'];
                                $ff = $uploadData['file_ext'];

                            } else {
                                /*$this->validation->set_message('event_pic', $this->upload->display_errors());*/
                                $this->form_validation->set_message('event_pic', $this->upload->display_errors());
                                return false;
                                $picture = '';

                            }
                        } else {
                            //print_r('text');
                            $picture = '';
                        }
                        // $url = base_url();
                        // $picture2 = $url . 'uploads/announcement/' . $picture;
                        $file_type = $ff;

                        $date = $this->input->post('date');
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array(
                            'date' => $dt, 'status' => 'Active', 'image' => $picture, 'image_type' => $file_type, 'type' => $ann,
                            'subject_en' => $subject_en, 'send_to' => $announcement_type);

                    } else {
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array('subject_en' => $subject_en, 'content_en' => $content_en,
                            'date' => $dt, 'type' => $ann, 'status' => $status, 'send_to' => $announcement_type);
                    }

                    $this->announcement_model->update_entry($user, $id);
                    $insert_id = $this->db->insert_id();
                    $selected_email = [];
                    if ($announcement_type == "selected" && !empty($email)) {
                        $email_list = "'" . str_replace(",", "','", $email) . "'";
                        $selected_email = $this->announcement_model->get_volunteers_by_type($announcement_type, $email_list);
                    } elseif (!empty($announcement_type)) {
                        $selected_email = $this->announcement_model->get_volunteers_by_type($announcement_type, []);
                    }

                    if (!empty($selected_email)) {
                        foreach ($selected_email as $volunteer) {
                            $listData = [];
                            $listData['volunteer_id'] = $volunteer->vounter_id;
                            $listData['firebase_token'] = $volunteer->vol_token_id;
                            $listData['notes_id'] = $insert_id;
                            $listData['email'] = $volunteer->vemail;
                            $this->announcement_model->add_notes_admin_send_list($listData);
                        }
                    }
                    $this->session->set_flashdata('msg', "Announcement has been updated successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "announcement/allannouncement");
                }
            }
            $data['announcement'] = $this->announcement_model->get($id);
            $data['emails']=$this->announcement_model->get_emails($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Announcements';
            $data['volunteer_list'] = $this->announcement_model->get_volunteers();
            $this->load->view('header', $data);
            $this->load->view('editannouncement', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function delete($id)
    {

        $this->announcement_model->delete_entry($id);
        $this->session->set_flashdata('msg', "Announcement has been deleted successfully");
        $data['announcementlist'] = $this->announcement_model->get_entries();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Announcements';
        $this->load->view('header', $data);
        $this->load->view('announcementlist', $data);
        $this->load->view('user_footer');

    }

    public function volunteerlist(){
        return json_encode($this->announcement_model->get_volunteers());
    }

    public function view_vol_announce($id){
        $data['vol_announce_details'] = $this->announcement_model->get_vol_announce_details($id);
        $data['vol_name'] = $this->announcement_model->get_vol_names($data['vol_announce_details']->volunteer_id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Volunteers Announcement';
        $this->load->view('header', $data);
        $this->load->view('vol_announce_details', $data);
        $this->load->view('user_footer');
    }

    public function view_announcement($id){
        $data['announcement_details'] = $this->announcement_model->get_announcement_details($id);
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Announcements';
        $this->load->view('header', $data);
        $this->load->view('announcement_details', $data);
        $this->load->view('user_footer');
    }

    public function edit_vol_announce($id)
    {
        // if( can('view-announcement') ) {
            if ($this->input->post('submit')) {
                $announcement_type = $this->input->post('announcement_type');
                $email = $this->input->post('emailaddress');
                $date = $this->input->post('date');
                $ann = $this->input->post('anounce_type');
                $status = $this->input->post('status');
                $subject_en = $this->input->post('subject_en');
                $content_en = $this->input->post('content_en');
                $picture = "";
                $ff = "";
                $data = [];
                $data['announcement_type'] = $announcement_type;
                $data['emailaddress'] = $email;
                $data['date'] = $date;
                $data['anounce_type'] = $ann;
                $data['subject_en'] = $subject_en;
                $data['content_en'] = $content_en;

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('announcement_type', 'Announcement Type', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('subject_en', 'Subject', 'required');
                $this->form_validation->set_rules('anounce_type', 'Attachment Type', 'required');
                if ($announcement_type == "selected") {
                    $this->form_validation->set_rules('emailaddress', 'Email', 'required');
                }
                if ($ann == "content") {
                    $this->form_validation->set_rules('content_en', 'Content', 'required');
                }


                if ($this->form_validation->run() == false) {
                    $data['error'] = validation_errors();
                } else {
                    if ($ann == 'image' || $ann == 'doc' || $ann == 'pdf') {
                        if (!empty($_FILES['event_pic']['name'])) {
                            $config['upload_path'] = 'uploads/announcement/';
                            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
                            $config['max_size'] = 50000;
                            $config['max_width'] = 3500;
                            $config['max_height'] = 3500;
                            $config['file_name'] = $_FILES['event_pic']['name'];
                            $config['file_ext'] = $_FILES['event_pic']['name'];

                            //Load upload library and initialize configuration
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('event_pic')) {
                                //print_r('hi');
                                $uploadData = $this->upload->data();
                                $picture = $uploadData['file_name'];
                                $ff = $uploadData['file_ext'];

                            } else {
                                /*$this->validation->set_message('event_pic', $this->upload->display_errors());*/
                                $this->form_validation->set_message('event_pic', $this->upload->display_errors());
                                return false;
                                $picture = '';

                            }
                        } else {
                            //print_r('text');
                            $picture = '';
                        }
                        // $url = base_url();
                        // $picture2 = $url . 'uploads/announcement/' . $picture;
                        $file_type = $ff;

                        $date = $this->input->post('date');
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array(
                            'date' => $dt, 'status' => 'Active', 'image' => $picture, 'image_type' => $file_type, 'type' => $ann,
                            'subject_en' => $subject_en, 'send_to' => $announcement_type);

                    } else {
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array('subject_en' => $subject_en, 'content_en' => $content_en,
                            'date' => $dt, 'type' => $ann, 'status' => $status, 'send_to' => $announcement_type);
                    }

                    $this->announcement_model->update_volannu_entry($user, $id);
                    $this->session->set_flashdata('msg', "Vol announcement has been updated successfully !!");
                    $base_url = base_url();
                    redirect("$base_url" . "announcement/volannouncement");
                }
            }
            $data['announcement'] = $this->announcement_model->get_vol_announce($id);
            $data['emails']=$this->announcement_model->get_vol_emails($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Volunteers Announcement';
            // $data['volunteer_list'] = $this->announcement_model->get_volunteers();
            $this->load->view('header', $data);
            $this->load->view('editvolannouncement');
            $this->load->view('user_footer');
        // }
        // else{
        //     echo "Permission denied";
        // }

    }

    function volannouncement()
    {
        // if( can('view-announcement') ) {
            $session_id = $this->session->userdata('userID');
            $data['vol_names_entries'] = $this->announcement_model->get_vol_names_entries();
            $data['announcementlist'] = $this->announcement_model->get_vol_entries();
            $data['role_name'] = $this->announcement_model->get_role_name($session_id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Volunteers Announcement';
            $this->load->view('header', $data);
            $this->load->view('volannouncementlist', $data);
            $this->load->view('user_footer');
        // }
        // else{
        //     echo "Permission denied";
        // }
    }

    public function approve_vol_announce($id){
        $this->announcement_model->change_vol_announce_status($id);
        $vol_announce_details = $this->announcement_model->get_vol_announce_details($id);
        // $vol_announce_add_to_admin = array(
        //     'type' => $vol_announce_details->type,
        //     'send_to' => $vol_announce_details->send_to,
        //     'subject_en' => $vol_announce_details->subject_en,
        //     'content_en' => $vol_announce_details->content_en,
        //     'image' => $vol_announce_details->image,
        //     'image_type' => $vol_announce_details->image_type,
        //     'date' => $vol_announce_details->date,
        //     'status' => $vol_announce_details->status,
        // );
        // echo"<pre>";print_r($vol_announce_details);echo"<br>";echo"<br>";echo"<pre>";print_r($vol_announce_add_to_admin);die;
        // $this->announcement_model->add_announcement($vol_announce_details);
        // $insert_id = '00'.$this->db->insert_id();
        $insert_id = 'VOL00'.$vol_announce_details->wcnvid;

        $selected_email = [];
        if ($vol_announce_details->send_to == "selected" && !empty($vol_announce_details->emailaddress)) {
            $email_list = "'" . str_replace(",", "','", $vol_announce_details->emailaddress) . "'";
            $selected_email = $this->announcement_model->get_volunteers_by_type($vol_announce_details->send_to, $email_list);
        } elseif (!empty($vol_announce_details->send_to)) {
            $selected_email = $this->announcement_model->get_volunteers_by_type($vol_announce_details->send_to, []);
        }

        if (!empty($selected_email)) {
            foreach ($selected_email as $volunteer) {
                $listData = [];
                $listData['volunteer_id'] = $volunteer->vounter_id;
                $listData['firebase_token'] = $volunteer->vol_token_id;
                $listData['notes_id'] = $insert_id;
                $listData['email'] = $volunteer->vemail;
                $this->announcement_model->add_notes_admin_send_list($listData);
            }
        }


        $title = "New announcement added!!";
        $body = $vol_announce_details->subject_en;
        //$body = "New announcement";
        if($vol_announce_details->send_to=="all"){
        $volunteers = $this->announcement_model->get_volunteers_all();
        }
        if($vol_announce_details->send_to=="active"){
        $volunteers = $this->announcement_model->get_volunteers_active();
        }
        if($vol_announce_details->send_to=="arabic"){
        $volunteers = $this->announcement_model->get_volunteers_arabic();
        }
        if($vol_announce_details->send_to=="english"){
        $volunteers = $this->announcement_model->get_volunteers_english();
        }
        if($vol_announce_details->send_to=="selected"){
        $volunteers = $this->announcement_model->get_volunteers_selected($vol_announce_details->emailaddress);
        }
        $arrNotification = array();
        $arrNotification["body"] = $body;
        $arrNotification["title"] = $title;
        $arrNotification["sound"] = "default";
        $arrNotification["type"] = 1;
        if(count($volunteers['android'])>0){
        $this->fcm->send_notification($volunteers['android'], $arrNotification,'Android',true);
        }
        
        if(count($volunteers['ios'])>0){
        $this->fcm->send_notification($volunteers['ios'], $arrNotification,'iOS',true);
        }
        $this->session->set_flashdata('msg', "Announcement has been approved and added successfully");
        $base_url = base_url();
        redirect("$base_url" . "announcement/volannouncement");
    }


}
