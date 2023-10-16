<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Forgetpass_volenteer extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('apis/Forgetpass_voulnteer_model');
        $this->load->helper('email');
    }

    public function index_post() {
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
            if($language=='en'){ $msg4 = "Please Enter Email !!"; $msg5 = "Please check your email. I have send your Password on your mail !!"; $msg6 = "Invalid Email";}
            if($language=='ar'){ $msg4 = "الرجاء إدخال البريد الإلكتروني !!"; $msg5 = "تفقد بريدك الالكتروني من فضلك. لقد قمت بإرسال كلمة المرور الخاصة بك على بريدك !!"; $msg6 = "بريد إلكتروني خاطئ";}
        
           
           $email=$this->input->post('email');
            if($email=='')
           {
            $data = array(
                'success' => "false",
                "message" => $msg4,
            );
           }
           else{
            
            $email = $this->Forgetpass_voulnteer_model->get_voulnteer_email();
            // echo "<pre>";print_r($email->vpassword);die;
            if(!empty($email)){
            //     $to = $this->input->post('email');
            //     $subject = 'Forgot Password';
            //     $message = "<html><body><h2>Forgot Password</h2>
            //                   <p>Email: $to</p>
            //                   <p>Password: $email->vpassword</p>
            //               </body></html>";

            //     $sendemail = ci_send_email("info@shamsaha.org",$to,$subject,$message);
            //     if ($sendemail == "success") 
            //     {
                    $data = array(
                        'success' => "true",
                        "message" => $msg5,
                    );
                    
            //     }
            //     else
            //     {   //echo 'Email has been sent successfully';
            //         $this->email->print_debugger();
            //         $data = array(
            //             'status' => "invalid",
            //             "message" => "Mail not send",
            //         );
            //     }
            }
            else{
                // $data = array(
                //     'status' => "invalid",
                //     "message" => "Mail not send",
                // );
                $data = array(
                    'success' => "false",
                    "message" => $msg6,
                );
            }
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
}
