<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        $this->load->library('FCM');

        // Load database
        $this->load->model('event_model');
        $this->load->library('auth');
    }

    public function add()
    {
        $error = false;
        if( can('add-event') ) {
            if ($this->input->post('submit')) {
                $data['title_en'] = $this->input->post('title_en');
                $data['price'] = $this->input->post('price');
                $data['req_registration'] = $this->input->post('entry');
                $data['event_type'] = $this->input->post('etype');
                $data['content_en'] = $this->input->post('content_en');
                $data['title_ar'] = $this->input->post('title_ar');
                $data['content_ar'] = $this->input->post('content_ar');
                $data['date'] = (!$this->input->post('date')) ? '' : date("Y-m-d", strtotime($this->input->post('date')));
                $data['status'] = 'Active';
                $data['event_for'] = $this->input->post('event_for');

                // $data['venu'] = $this->input->post('venu');
                // $data['venu_time'] = $this->input->post('venu_time');
                
                  $data['venu'] = "B";
                $data['venu_time'] = "5";

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title_en', 'Title English', 'trim|required');
                //$this->form_validation->set_rules('price', 'Price', 'trim|required');
                $this->form_validation->set_rules('req_registration', 'Total Entries', 'trim|required');
                $this->form_validation->set_rules('event_type', 'Event Type', 'trim|required');
                $this->form_validation->set_rules('content_en', 'Content English', 'trim|required');
                $this->form_validation->set_rules('title_ar', 'Title Arabic', 'trim|required');
                $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('content_ar', 'Content Arabic', 'trim|required');
                $this->form_validation->set_rules('event_for', 'Event for', 'trim|required');

                $this->form_validation->set_rules('venu', 'Event Venue', 'trim|required');
                $this->form_validation->set_rules('venu_time', 'Event Time', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    $even = $this->input->post('event_for');
                    if (!empty($_FILES['event_pic']['name'])) {
                        $config['upload_path'] = 'uploads/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['event_pic']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('event_pic')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                            $url = base_url();
                            $data['event_pic'] = $url . 'uploads/' . $picture;
                        } else {
                            $error = true;
                            $this->session->set_flashdata('error_pic', $this->upload->display_errors());

                        }
                    } else {
                        $error = true;
                        $this->session->set_flashdata('error_pic', "This field is required");
                    }
                    if(!$error){
                        $this->event_model->add_event($data);
                        $title = "A new event has been added at Shamsaha.";
                        $body = $data['title_en'];
                        if ($even == 'Volunteer') {
                            $volunteers = $this->event_model->get_volunteers();
                            $arrNotification = array();
                            $arrNotification["body"] = $body;
                            $arrNotification["title"] = $title;
                            $arrNotification["sound"] = "default";
                            $arrNotification["type"] = 1;
                            $this->fcm->send_notification($volunteers['android'], $arrNotification,'Android',true);
                            $this->fcm->send_notification($volunteers['ios'], $arrNotification,'iOS',true);
                        } else {
                            $this->fcm->sendBulkNotification($title, $body, [], 'all');
                        }
                        $this->session->set_flashdata('msg', "Event has been added successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "event/allevent");
                    }

                } else {

                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('event');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    function allevent()
    {
        if( can('view-event') ) {
            $data['eventlist'] = $this->event_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('eventlist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function edit($id)
    {
        $error = false;
        if( can('edit-event') ) {
            if ($this->input->post('submit')) {
                $data['title_en'] = $this->input->post('title_en');
                $data['price'] = $this->input->post('price');
                $data['req_registration'] = $this->input->post('entry');
                $data['event_type'] = $this->input->post('etype');
                $data['content_en'] = $this->input->post('content_en');
                $data['title_ar'] = $this->input->post('title_ar');
                $data['content_ar'] = $this->input->post('content_ar');
                $data['date'] = (!$this->input->post('date')) ? '' : date("Y-m-d", strtotime($this->input->post('date')));
                $data['status'] = 'Active';
                $data['event_for'] = $this->input->post('event_for');

                $data['venu'] = $this->input->post('venu');
                $data['venu_time'] = $this->input->post('venu_time');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title_en', 'Title English', 'trim|required');
                //$this->form_validation->set_rules('price', 'Price', 'trim|required');
                $this->form_validation->set_rules('req_registration', 'Total Entries', 'trim|required');
                $this->form_validation->set_rules('event_type', 'Event Type', 'trim|required');
                $this->form_validation->set_rules('content_en', 'Content English', 'trim|required');
                $this->form_validation->set_rules('title_ar', 'Title Arabic', 'trim|required');
                $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('content_ar', 'Content Arabic', 'trim|required');
                $this->form_validation->set_rules('event_for', 'Event for', 'trim|required');

                $this->form_validation->set_rules('venu', 'Event Venue', 'trim|required');
                $this->form_validation->set_rules('venu_time', 'Event Time', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    if (!empty($_FILES['event_pic']['name'])) {
                        $config['upload_path'] = 'uploads/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['event_pic']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('event_pic')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                            $url = base_url();
                            $data['event_pic'] = $url . 'uploads/' . $picture;
                        } else {
                            $error = true;
                            $this->session->set_flashdata('error_pic', $this->upload->display_errors());
                            //$picture = '';
                            //print_r($error); exit;
                        }
                    } else {
                        $error = true;
                        $this->session->set_flashdata('error_pic', "This field is required");
                    }
                    if(!$error){
                        $this->event_model->update_entry($data, $id);
                        $this->session->set_flashdata('msg', "Event has been updated successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "event/allevent");
                    }

                }
                else{

                }

            }
            $data['event'] = $this->event_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('editevent', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function delete($id)
    {
        if( can('delete-event') ) {
            $this->event_model->delete_entry($id);
            $this->session->set_flashdata('msg', "Event has been deleted successfully");
            $data['eventlist'] = $this->event_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('eventlist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }


    }

    public function viewregistration($id){
        if( can('view-event') ) {
            $data['reglist'] = $this->event_model->get_registration($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('reglist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

}
