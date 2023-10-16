<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Forgetpin_victim extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('apis/forgetpin_victim_model');
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
            if($language=='en'){ $msg3 = "Please Enter Device Id !!"; $msg4 = "Please Enter Email !!"; $msg5 = "Please check your email. I have send your pin on your mail !!"; $msg6 = "Device ID does not exist";}
            if($language=='ar'){ $msg3 = "الرجاء إدخال معرف الجهاز !!"; $msg4 = "الرجاء إدخال البريد الإلكتروني !!"; $msg5 = "تفقد بريدك الالكتروني من فضلك. لقد أرسلت رقم التعريف الشخصي الخاص بك على بريدك !!"; $msg6 = "معرف الجهاز غير موجود";}
        
           $device_id=$this->input->post('deviceid');
           $email=$this->input->post('email');
           if($device_id==''){
            $data = array(
                'success' => "false",
                "message" => $msg3,
            );
           }
           else if($email=='')
           {
            $data = array(
                'success' => "false",
                "message" => $msg4,
            );
           }
           else{
            
            $pin = $this->forgetpin_victim_model->get_victim_email();
            // echo "<pre>";print_r($pin);die;
            if(!empty($pin)){
            //     $to = $this->input->post('email');
            //     $subject = 'Forgot Password';
            //     $message = "<html><body><h2>Forgot Password</h2>
            //                   <p>Email: $to</p>
            //                   <p>Password: $pin</p>
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
