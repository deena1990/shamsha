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
            $data=array();
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
                $data['venu_ar'] = $this->input->post('venu_ar');
                $data['start_time'] = $this->input->post('start_time');
                $data['end_time'] = $this->input->post('end_time');
                $data['event_pic'] = $_FILES['event_pic']['name'];

                //echo '<pre>'; print_r(json_encode($this->form_validation->set_data($data))); exit;

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

                $this->form_validation->set_rules('venu', 'Venue English', 'trim|required');
                $this->form_validation->set_rules('venu_ar', 'Venue Arabic', 'trim|required');
                $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
                $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
                $this->form_validation->set_rules('event_pic', 'Event Image', 'trim|required');

                //echo '<pre>'; print_r(json_encode($this->form_validation->run())); exit;

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
                            $data['event_pic'] = $picture;
                        }
                        else {
                            $error = true;
                            $this->session->set_flashdata('error_pic', $this->upload->display_errors());
                        }
                    }
                    else {
                        $error = true;
                        $this->session->set_flashdata('error_pic', "This field is required");
                    }
                    $update = [
                        'event_for' => $data['event_for'],
                        'title_en' => $data['title_en'],
                        'title_ar' => $data['title_ar'],
                        'event_type' => $data['event_type'],
                        'req_registration' => $data['req_registration'],
                        'content_en' => $data['content_en'],
                        'content_ar' => $data['content_ar'],
                        'event_pic' => $data['event_pic'],
                        'price' => $data['price'],
                        'venu' => $data['venu'],
                        'venu_ar' => $data['venu_ar'],
                        'date' => $data['date'],
                        'venu_time' => date('h:i A', strtotime($data['start_time'])).' - '.date('h:i A', strtotime($data['end_time'])),
                        'status' => 'Active',
                    ];
                    if(!$error){
                        $this->event_model->add_event($update);
                        $title = "Shamsaha has a new event!";
                        $body = $data['title_en']." on ".date('d M Y \a\t l', strtotime($data['date'])).", ".date('h:i A', strtotime($data['start_time'])). " AST";
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

                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Event';
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
            $data=array();
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

    function view($id)
    {
        if( can('view-event') ) {
            $data=array();
            $data['event'] = $this->event_model->get_event($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('view_event', $data);
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
            $data=array();
            if ($this->input->post('submit')) {
                $data['event_for'] = $this->input->post('event_for');
                $data['date'] = (!$this->input->post('date')) ? '' : date("Y-m-d", strtotime($this->input->post('date')));
                $data['venu'] = $this->input->post('venu');
                $data['venu_ar'] = $this->input->post('venu_ar');
                $data['start_time'] = $this->input->post('start_time');
                $data['end_time'] = $this->input->post('end_time');
                $data['price'] = $this->input->post('price');
                $data['event_type'] = $this->input->post('etype');
                $data['req_registration'] = $this->input->post('entry');
                $data['title_en'] = $this->input->post('title_en');
                $data['content_en'] = $this->input->post('content_en');
                $data['title_ar'] = $this->input->post('title_ar');
                $data['content_ar'] = $this->input->post('content_ar');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('event_for', 'Event for', 'trim|required');
                $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('venu', 'Venue English', 'trim|required');
                $this->form_validation->set_rules('venu_ar', 'Venue Arabic', 'trim|required');
                $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
                $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
                //$this->form_validation->set_rules('price', 'Price', 'trim|required');
                $this->form_validation->set_rules('event_type', 'Event Type', 'trim|required');
                $this->form_validation->set_rules('req_registration', 'Total Entries', 'trim|required');
                $this->form_validation->set_rules('title_en', 'Title English', 'trim|required');
                $this->form_validation->set_rules('content_en', 'Content English', 'trim|required');
                $this->form_validation->set_rules('title_ar', 'Title Arabic', 'trim|required');
                $this->form_validation->set_rules('content_ar', 'Content Arabic', 'trim|required');

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
                            $data['event_pic'] = $picture;
                        } else {
                            $data['event_pic'] = $this->input->post('pre_event_pic');
                        }
                    } else {
                        $data['event_pic'] = $this->input->post('pre_event_pic');
                    }
                    $update = [
                        'event_for' => $data['event_for'],
                        'title_en' => $data['title_en'],
                        'title_ar' => $data['title_ar'],
                        'event_type' => $data['event_type'],
                        'req_registration' => $data['req_registration'],
                        'content_en' => $data['content_en'],
                        'content_ar' => $data['content_ar'],
                        'event_pic' => $data['event_pic'],
                        'price' => $data['price'],
                        'venu' => $data['venu'],
                        'venu_ar' => $data['venu_ar'],
                        'date' => $data['date'],
                        'venu_time' => date('h:i A', strtotime($data['start_time'])).' - '.date('h:i A', strtotime($data['end_time'])),
                        'status' => 'Active',
                    
                    ];
                    if(!$error){
                        $this->event_model->update_entry($update, $id);
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
            //echo '<pre>'; print_r($data); exit;
        }
        else{
            echo "Permission denied";
        }
    }

    public function delete($id)
    {
        if( can('delete-event') ) {
            $data=array();
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
            $data=array();
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

    public function add_event_image()
    {
        $error = false;
        if( can('add-event') ) {
            $data=array();
            if ($this->input->post('submit')) {
                $data['event_for'] = $this->input->post('event_for');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('event_for', 'Event For', 'trim|required');

                if (($this->form_validation->run() == true)) { 
                    if (!empty($_FILES['event_pic']['name'])) { 
                        $this->load->library('upload');
                        $image = array();
                        $ImageCount = count($_FILES['event_pic']['name']);
                        for($i = 0; $i < $ImageCount; $i++){
                            $_FILES['file']['name']       = $_FILES['event_pic']['name'][$i];
                            $_FILES['file']['type']       = $_FILES['event_pic']['type'][$i];
                            $_FILES['file']['tmp_name']   = $_FILES['event_pic']['tmp_name'][$i];
                            $_FILES['file']['error']      = $_FILES['event_pic']['error'][$i];
                            $_FILES['file']['size']       = $_FILES['event_pic']['size'][$i];

                            // File upload configuration
                            $uploadPath = 'uploads/Events/mediaPhotos/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                            $config['max_size'] = 2000;
                            $config['max_width'] = 1500;
                            $config['max_height'] = 1500;

                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $imageData = $this->upload->data();
                                $uploadImgData[$i]['image'] = $imageData['file_name'];
                                $uploadImgData[$i]['event_id'] = $data['event_for'];

                            }
                            else {
                                $error = true;
                                $this->session->set_flashdata('error_pic', $this->upload->display_errors());
                            }
                        }
                        if(!empty($uploadImgData)){
                            // Insert files data into the database
                            $this->event_model->multiple_images($uploadImgData);
                            $this->session->set_flashdata('msg', "Event Image has been added successfully !!");
                            $base_url = base_url();
                            redirect("$base_url" . "event/alleventimages");             
                        }
                    }
                    else {
                        $error = true;
                        $this->session->set_flashdata('error_pic', "This field is required");
                    }
                }
            }
            $data['eventlist'] = $this->event_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Event Images';
            $this->load->view('header', $data);
            $this->load->view('addeventimage');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    function alleventimages()
    {
        if( can('view-event') ) {
            $data=array();
            $data['event_images'] = $this->event_model->get_event_images();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Event Images';
            $this->load->view('header', $data);
            $this->load->view('event_images', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function delete_event_image($id)
    {
        if( can('delete-event') ) {
            $data=array();
            $this->event_model->delete_eventImage($id);
            $this->session->set_flashdata('msg', "Event Image has been deleted successfully !!");
            $data['event_images'] = $this->event_model->get_event_images();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Event Images';
            $this->load->view('header', $data);
            $this->load->view('event_images', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function allmediaarticle()
    {
        if( can('view-media_article') ) {
            $data=array();
            $data['media_articles'] = $this->event_model->get_media_articles();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Media Articles';
            $this->load->view('header', $data);
            $this->load->view('media_articles', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function view_media_articles($id)
    {
        if( can('view-media_article') ) {
            $data=array();
            $data['media_article'] = $this->event_model->get_media_article($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Media Articles';
            $this->load->view('header', $data);
            $this->load->view('view_media_article', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function add_media_article()
    {
        $error = false;
        if( can('add-media_article') ) {
            $data=array();
            if ($this->input->post('submit')) {
                $data['title_en'] = $this->input->post('title_en');
                $data['title_ar'] = $this->input->post('title_ar');
                $data['content_en'] = strip_tags($this->input->post('content_en'));
                $data['content_ar'] = strip_tags($this->input->post('content_ar'));
                $data['date'] = (!$this->input->post('date')) ? '' : date("Y-m-d", strtotime($this->input->post('date')));
                $data['time'] = (!$this->input->post('time')) ? '' : date("H:i:s", strtotime($this->input->post('time')));

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title_en', 'Title English', 'trim|required');
                $this->form_validation->set_rules('title_ar', 'Title Arabic', 'trim|required');
                $this->form_validation->set_rules('content_en', 'Content English', 'trim|required');
                $this->form_validation->set_rules('content_ar', 'Content Arabic', 'trim|required');
                $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('time', 'Time', 'trim|required');
                if (empty($_FILES['image']['name'])){
                    $this->form_validation->set_rules('image', 'Upload Image', 'trim|required');
                }
                // print_r($data);die;
                if (($this->form_validation->run() == true)) {
                    if (!empty($_FILES['image']['name'])) {
                        $config['upload_path'] = 'uploads/Events/mediaPhotos/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['image']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('image')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                            $data['image'] = $picture;
                        }
                        else {
                            $error = true;
                            $this->session->set_flashdata('error_pic', $this->upload->display_errors());
                            die;
                        }
                    } 
                    $update = [
                        'title_en' => $data['title_en'],
                        'title_ar' => $data['title_ar'],
                        'content_en' => $data['content_en'],
                        'content_ar' => $data['content_ar'],
                        'image' => $data['image'],
                        'date' => $data['date'],
                        'time' => $data['time'],
                    
                    ];
                    if(!$error){
                        $this->event_model->add_mediaArticle($update);
                        $this->session->set_flashdata('msg', "Media Article has been added successfully !!");
                        $base_url = base_url();
                        redirect("$base_url" . "event/allmediaarticle");
                    }

                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Media Article';
            $this->load->view('header', $data);
            $this->load->view('addmediaarticle', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function edit_media_articles($id)
    {
        $error = false;
        if( can('edit-media_article') ) {
            $data=array();
            if ($this->input->post('submit')) {
                $data['title_en'] = $this->input->post('title_en');
                $data['title_ar'] = $this->input->post('title_ar');
                $data['content_en'] = strip_tags($this->input->post('content_en'));
                $data['content_ar'] = strip_tags($this->input->post('content_ar'));
                $data['date'] = date('Y-m-d',strtotime($this->input->post('date')));
                $data['time'] = date('H:i:s',strtotime($this->input->post('time')));
                // print_r($data);die;

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title_en', 'Title English', 'trim|required');
                $this->form_validation->set_rules('title_ar', 'Title Arabic', 'trim|required');
                $this->form_validation->set_rules('content_en', 'Content English', 'trim|required');
                $this->form_validation->set_rules('content_ar', 'Content Arabic', 'trim|required');
                $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('time', 'Time', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    if (!empty($_FILES['image']['name'])) {
                        $config['upload_path'] = 'uploads/Events/mediaPhotos/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['image']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('image')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                            $data['image'] = $picture;
                        } else {
                            $data['image'] = $this->input->post('pre_image');
                        }
                    } else {
                        $data['image'] = $this->input->post('pre_image');
                    }
                    $update = [
                        'title_en' => $data['title_en'],
                        'title_ar' => $data['title_ar'],
                        'content_en' => $data['content_en'],
                        'content_ar' => $data['content_ar'],
                        'image' => $data['image'],
                        'date' => $data['date'],
                        'time' => $data['time'],
                    
                    ];
                    if(!$error){
                        $this->event_model->update_mediaArticle($update, $id);
                        $this->session->set_flashdata('msg', "Media Article has been updated successfully !!");
                        $base_url = base_url();
                        redirect("$base_url" . "event/allmediaarticle");
                    }

                }
                else{

                }

            }
            $data['mediaarticle'] = $this->event_model->get_mediaArticle($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Media Articles';
            $this->load->view('header', $data);
            $this->load->view('editmediaarticle', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    public function delete_media_articles($id)
    {
        if( can('delete-media_article') ) {
            $data=array();
            $this->event_model->delete_mediaArticles($id);
            $this->session->set_flashdata('msg', "Media Article has been deleted successfully !!");
            $data['media_articles'] = $this->event_model->get_media_articles();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Media Articles';
            $this->load->view('header', $data);
            $this->load->view('media_articles', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

}
