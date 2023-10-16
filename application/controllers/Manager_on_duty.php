<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_on_duty extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('manager_on_duty_model');
        $this->load->library('auth');
    }
    public function index(){
        if( can('view-manager_on_duty') ) {
            $data['manager_list']=$this->manager_on_duty_model->all();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Manager on Duty'; //Title
            $this->load->view('header',$data);
            $this->load->view('manager_on_duty/index',$data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function getLists()
    {
        if( can('view-manager_on_duty') ) {
            $data = $row = array();

            // Fetch member's records
            $managerData = $this->manager_on_duty_model->getRows($_POST);

            $i = $_POST['start'];
            foreach ($managerData as $manager) {
                $i++;
                $data[] = array($i, $manager->name, $manager->email, $manager->contact_no, date('d M Y', strtotime($manager->start_date)), date('d M Y',strtotime($manager->end_date)), $manager->status, $manager->id);
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->manager_on_duty_model->countAll(),
                "recordsFiltered" => $this->manager_on_duty_model->countFiltered($_POST),
                "data" => $data,
            );

            // Output to JSON format
            echo json_encode($output);
        }
        else{
            echo "Permission denied";
        }

    }

    public function add()
    {
        if( can('view-manager_on_duty') ) {
            if($this->input->post('submit'))
            {
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['contact_no'] = $this->input->post('contact_no');
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
                $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
                $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');


                if (($this->form_validation->run() == true)) {
                    $dateCheck = true;
                    $exDate = '';
                    $dates =  $this->date_range($data['start_date'], $data['end_date'], $step = '+1 day', $output_format = 'Y-m-d' );
                    foreach ($dates as $date){
                        $count = $this->manager_on_duty_model->checkAvailability($date);
                        if($count > 0){
                            $dateCheck = false;
                            $exDate = date('d-m-Y', strtotime($date));
                        }
                    }
                    if($dateCheck){
                        $data['start_date'] = (!empty($data['start_date'])) ? date('Y-m-d', strtotime($this->input->post('start_date'))) : '';
                        $data['end_date'] = (!empty($data['end_date'])) ? date('Y-m-d', strtotime($this->input->post('end_date'))) : '';

                        $insert = $this->manager_on_duty_model->add($data);
                        if($insert){
                            $this->session->set_flashdata('msg',"Added successfully");
                            $base_url=base_url();
                            redirect("$base_url"."manager_on_duty");
                        }
                    }
                    else{
                        $this->session->set_flashdata('error_date', "Another Manager assigned on $exDate");
                    }

                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Add Manager on Duty'; //Title
            $this->load->view('header',$data);
            $this->load->view('manager_on_duty/add');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }


    public function edit($id)
    {
        if( can('view-manager_on_duty') ) {
            $manager = $this->manager_on_duty_model->get_row($id);
            if($this->input->post('submit'))
            {
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['contact_no'] = $this->input->post('contact_no');
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
                $data['status'] = $this->input->post('status');
                //$job_code = $this->input->post('job_code');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
                $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
                $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');


                if (($this->form_validation->run() == true)) {
                    $dateCheck = true;
                    $exDate = '';
                    $dates =  $this->date_range($data['start_date'], $data['end_date'], $step = '+1 day', $output_format = 'Y-m-d' );
                    foreach ($dates as $date){
                        $count = $this->manager_on_duty_model->checkAvailability($date, $manager->id);
                       // print_r($this->db->last_query()); exit;
                        if($count > 0){
                            $dateCheck = false;
                            $exDate = date('d-m-Y', strtotime($date));
                        }
                    }
                    if($dateCheck){
                        $data['start_date'] = (!empty($data['start_date'])) ? date('Y-m-d', strtotime($this->input->post('start_date'))) : '';
                        $data['end_date'] = (!empty($data['end_date'])) ? date('Y-m-d', strtotime($this->input->post('end_date'))) : '';
                        $data['id'] = $manager->id;
                        $insert = $this->manager_on_duty_model->update($data);

                        if($insert){
                            $this->session->set_flashdata('msg',"Edit successfully");
                            $base_url=base_url();
                            redirect("$base_url"."manager_on_duty");
                        }
                    }
                    else{
                        $this->session->set_flashdata('error_date', "Another Manager assigned on $exDate");
                    }

                }
            }
            $data['manager'] = $manager;
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Manager on Duty'; //Title
            $this->load->view('header',$data);
            $this->load->view('manager_on_duty/edit');
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }

    }

    public function delete($id)
    {
        if( can('delete-manager_on_duty') ) {
            if($this->manager_on_duty_model->delete($id)){
                $this->session->set_flashdata('msg',"Deleted successfully");
            }
            redirect(base_url()."manager_on_duty");
        }
        else{
            echo "Permission denied";
        }
    }

//    function tes(){
//        $dates =  $this->date_range('2020-09-14', '2020-09-19', $step = '+1 day', $output_format = 'Y-m-d' );
//        foreach ($dates as $date){
//            $count = $this->manager_on_duty_model->checkAvailability($date);
//           // print_r($this->db->last_query());
//            if($count > 0){
//                echo "count";
//            }
//        }
//    }


    function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        while( $current <= $last ) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
        return $dates;
    }



}
