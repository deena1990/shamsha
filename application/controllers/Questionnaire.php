<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Questionnaire extends CI_Controller

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

        $this->load->model('case_report_model');

        $this->load->library('auth');

    }







    function index()

    {

       /* if( can('view-case-report') ) {*/

            $data=array();

            $data['site_title'] = 'Admin Dashboard'; //Title

            $data['page_title'] = 'Questionnaire';

            $this->db->order_by("id", "DESC");

            $data['questionnaire'] = $this->db->get('chat_form')->result();

            $this->load->view('header', $data);

            $this->load->view('questionnaire/index', $data);

            $this->load->view('user_footer');

        /*}

        else{

            echo "Permission denied";

        }*/

    }

    function case_feedback(){
        $data=array();

        $data['site_title'] = 'Admin Dashboard'; //Title

        $data['page_title'] = 'Questionnaire';

        
        $case_id = $_GET['case_id'];
        //$case_id ="CI000905";
       
        $this->db->order_by("id", "DESC");
        $data['questionnaire'] = $this->db->get('chat_form')->result();

        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        $data['feedback'] = $this->db->get_where('feedback_form',['case_id'=>$case_id])->result();
        $this->load->view('header', $data);

        $this->load->view('questionnaire/feedback', $data);

        $this->load->view('user_footer');
    }



    







}

