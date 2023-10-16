<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('shift_model');
        $this->load->library('auth');
    }


    public function add()
    {

        if ($this->input->post('submit')) {

            $user = array('shift_name' => $this->input->post('shift_a_name'), 'shift_time' => $this->input->post('shift_a_time'));
//print_r($user);
//die();
            $this->shift_model->add_shift($user);

            $this->session->set_flashdata('msg', "Shift has been added successfully");
            $base_url = base_url();
            redirect("$base_url" . "shift/allshift");
        }
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Shifts'; //Title
        $this->load->view('header', $data);
        $this->load->view('shift');
        $this->load->view('user_footer');
    }

    function allshift()
    {
        if (can('view-shift')) {
            $data['shiftlist'] = $this->shift_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Shifts'; //Title
            $this->load->view('header', $data);
            $this->load->view('shiftlist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function shift_cancel_reason()
    {
        $sql="SELECT wc_voulnteer.vname, wc_shifts.shift_language,wc_shifts.shift_name,wc_shifts.shift_time,wc_schedule.date,wc_schedule_reasons_for_request.reason FROM wc_schedule_reasons_for_request INNER JOIN wc_schedule ON wc_schedule_reasons_for_request.schedule_id = wc_schedule.w_sch_id INNER JOIN wc_voulnteer ON wc_schedule_reasons_for_request.volunteer = wc_voulnteer.vounter_id INNER JOIN wc_shifts ON wc_schedule.shift_id = wc_shifts.wcsid ORDER BY `wc_schedule`.`date` DESC";
        $data['shiftlist'] = $this->db->query($sql)->result();
        $data['site_title'] = 'Admin Dashboard'; //Title
        $data['page_title'] = 'Shifts Cancel'; //Title
        $this->load->view('header', $data);
        $this->load->view('shiftcancellist', $data);
        $this->load->view('user_footer');
    }

    public function edit($id)
    {
        if (can('edit-shift')) {
            if ($this->input->post('submit')) {
                if (!empty($_FILES['simage']['name'])) {
                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2000;
                    $config['max_width'] = 1500;
                    $config['max_height'] = 1500;
                    $config['file_name'] = $_FILES['simage']['name'];

                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('simage')) {
                        $uploadData = $this->upload->data();
                        $picture = $uploadData['file_name'];
                    } else {
                        $picture = '';
                    }
                    $url = base_url();
                    $picture2 = $url . 'uploads/' . $picture;
                } else {
                    $picture2 = $this->input->post('simage1');
                }

                $user = array('shift_name' => $this->input->post('shift_a_name'), 'shift_time' => $this->input->post('shift_a_time'), 'image' => $picture2, 'color' => $this->input->post('color'));

                $this->shift_model->update_entry($user, $id);
                $this->session->set_flashdata('msg', "shift has been updated successfully");
                $base_url = base_url();
                redirect("$base_url" . "shift/allshift");
            }
            $data['shift'] = $this->shift_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Shifts'; //Title
            $this->load->view('header', $data);
            $this->load->view('editshift', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function delete($id)
    {
        if (can('delete-shift')) {
            $this->shift_model->delete_entry($id);
            $this->session->set_flashdata('msg', "Shift has been deleted successfully");
            $data['shiftlist'] = $this->shift_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Shifts'; //Title
            $this->load->view('header', $data);
            $this->load->view('shiftlist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

}
