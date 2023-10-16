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
    }

    public function add()
    {
        if( can('add-announcement') ) {
            if ($this->input->post('submit')) {

                $announcement_type = $this->input->post('announcement_type');
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
                                $this->validation->set_message('event_pic', $this->upload->display_errors());
                                return false;
                                $picture = '';

                            }
                        } else {
                            //print_r('text');
                            $picture = '';
                        }
                        $url = base_url();
                        $picture2 = $url . 'uploads/announcement/' . $picture;
                        $file_type = $ff;

                        $date = $this->input->post('date');
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array(
                            'date' => $dt, 'status' => 'Active', 'image' => $picture2, 'image_type' => $file_type, 'type' => $ann,
                            'subject_en' => $subject_en, 'send_to' => $announcement_type);

                    } else {
                        $dt = date("Y-m-d", strtotime($date));

                        $user = array('subject_en' => $subject_en, 'content_en' => $content_en,
                            'date' => $dt, 'type' => $ann, 'status' => 'Active', 'send_to' => $announcement_type);
                    }
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
                        }
                    }

                    $this->session->set_flashdata('msg', "Announcement has been added successfully");
                    $base_url = base_url();
                    redirect("$base_url" . "announcement/allannouncement");
                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Announcement';
            $data['volunteer_list'] = $this->announcement_model->get_volunteers();
            $this->load->view('header',$data);
            $this->load->view('announcement', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    function allannouncement()
    {
        if( can('view-announcement') ) {
            $data['announcementlist'] = $this->announcement_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Announcement';
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
                $date = $this->input->post('date');
                $dt = date("Y-m-d", strtotime($date));

                $user = array('subject_en' => $this->input->post('subject_en'), 'content_en' => $this->input->post('content_en'), 'subject_ar' => $this->input->post('subject_ar'), 'content_ar' => $this->input->post('content_ar'), 'date' => $dt, 'status' => $this->input->post('status'));

                $this->announcement_model->update_entry($user, $id);
                $this->session->set_flashdata('msg', "Announcement has been updated successfully");
                $base_url = base_url();
                redirect("$base_url" . "announcement/allannouncement");
            }
            $data['announcement'] = $this->announcement_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Announcement';
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
        $data['page_title'] = 'Announcement';
        $this->load->view('header', $data);
        $this->load->view('announcementlist', $data);
        $this->load->view('user_footer');

    }

    public function volunteerlist(){
        return json_encode($this->announcement_model->get_volunteers());
    }


}
