<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Volunteer_forgot_password extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('apis/volunteer_login_model');
        $this->load->helper('email');
    }

    public function index_post() {
        
        if (empty($this->post('email'))) {
            $data = array(
                'status' => "invalid",
                "message" => "email required",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }
       
        $check_user = $this->volunteer_login_model->check_user();
        if ($check_user == 0) {
            $data = array(
                'status' => "invalid",
                "message" => "User not found",
                //"data" => array(),
            );
            $this->response($data, REST_Controller::HTTP_OK);
            $this->output->_display();
            exit;
        }else{
			//savas return it back if needed
            $password = rand(10,99999999);
            $result = 1//$this->volunteer_login_model->send_new_data($password);
           // print($result);
            if($result==1){
        		$to = $this->input->post('email');
                $subject = 'Your password has been resetted';
       			$message = "<html><body><h2>User Login Credentails</h2>
                          <p>Email: $to</p>
                          <p>Password: $password</p>
                      </body></html>";
                
	       			//$send = $this->email->send();
	       			
                $sendemail = ci_send_email("info@shamsaha.org",$to,$subject,$message);

		        if ($sendemail == "success") 
				{
					$result = $this->volunteer_login_model->send_new_data($password);
				    $data = array(
                        'status' => "valid",
                        "message" => "Mailed Successfully",
                    );
		            
		           
		        } 
				else 
				{   
    		       $data = array(
                    'status' => "invalid",
                    "message" => "Mail not send",
                );
		           // show_error($this->email->print_debugger());
		        }
            }else{
                $data = array(
                'status' => "invalid",
                "message" => "Mail not send",
                //"data" => array(),
                //"data" => $result
                );
            }
            
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
