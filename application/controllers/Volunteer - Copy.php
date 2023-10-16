<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('volunteer_model');
	}
	
	public function add()
	{
		    //$this->load->config('email');

			
			if($this->input->post('insert'))
		    {
				if(!empty($_FILES['profile_pic']['name'])){
	                $config['upload_path'] = 'uploads/';
	                $config['allowed_types'] = 'jpg|jpeg|png|gif';
	                $config['max_size'] = 2000;
	        		$config['max_width'] = 1500;
	        		$config['max_height'] = 1500;
	                $config['file_name'] = $_FILES['profile_pic']['name'];
	                
	                //Load upload library and initialize configuration
	                $this->load->library('upload',$config);
	                $this->upload->initialize($config);
	                
	                if($this->upload->do_upload('profile_pic'))
	                {
	                    $uploadData = $this->upload->data();
	                    $picture = $uploadData['file_name'];
	                }else{
	                    $picture = '';
	                }
            	}else{
                $picture = '';
            	}
		      	$dob = $this->input->post('dob');
		      	$dob1 = date("Y-m-d", strtotime($dob));

		      	$doj = $this->input->post('doj');
		      	$doj1 = date("Y-m-d", strtotime($doj));

		      	$lang = $this->input->post('language');
		      	$lang2 = implode(',',$lang);
		      	$length=8;
		      	$password = substr(str_shuffle("1234567890QWERTYUIOP$@#!=_)(*123456789012345602345ABCDEFGHIJK$@#!=_)(*LM0987654321NOPQRSTUVWXYZ"), 0, $length);
		      	$email = $this->input->post('email');

				$user=array('vname' =>$this->input->post('name'),'vemail' =>$this->input->post('email'), 'vpassword' => $password, 'vmobile' =>$this->input->post('mobile'),'gender' =>$this->input->post('gender'), 'language_known' =>$lang2, 'profile_pic' =>$picture, 'shift_language' =>$this->input->post('slanguage'), 'date_of_birth' =>$dob1, 'date_of_joining' =>$doj1, 'address' => $this->input->post('address'), 'status' =>$this->input->post('status'));
				//print_r($user);
				//die();
				$this->volunteer_model->add_user($user);
				$insert_id = $this->db->insert_id();
		
				$aa = $this->volunteer_model->update_userid_entry($insert_id);
				//print_r($aa);
				//die();

				 		$this->load->library('email');
				        $config = array();
			       		$config['useragent'] = "CodeIgniter";
			       		$config['protocol'] = "smtp";
			       		$config['smtp_host'] = "ssl://smtp.gmail.com";
			       		$config['smtp_user'] = "info@akshriinformatics.com";
			       		$config['smtp_pass'] = "Akil@priya143";
			       		$config['smtp_port'] = "465";
			       		$config['mailtype'] = 'html';
			       		$config['charset'] = 'utf-8';
			       		$config['newline'] = "\r\n";
			       		$config['wordwrap'] = true;
		       			$this->email->initialize($config);
						//$from = $this->config->item('smtp_user');
        				$to = $this->input->post('email');
        				$subject = 'Welcome to WCCI Application';
       					$message = "<html><body><h2>User Login Credentails</h2>
      <p><a href='#'>Email: $email</a></p>
      <p><a href='#'>Password: $password</a></p>
  </body></html>";

       					$system_name = "WCCI";
       					$from = "priyankaprismsoft@gmail.com";
       					$this->email->from($from, $system_name);

	       				$this->email->to($to);
	       				$this->email->subject($subject);
	       				$this->email->message($message);
	       				$send = $this->email->send();

		        if ($this->email->send()) 
				{
		            echo 'Email has been sent successfully';
		        } 
				else 
				{
		            show_error($this->email->print_debugger());
		        }

				$this->session->set_flashdata('msg',"Volunteer has been added successfully");
				$base_url=base_url();
				redirect("$base_url"."volunteer/add/");
				       }
				$data['site_title'] = 'Admin Dashboard'; //Title
		        $this->load->view('header',$data);
				$this->load->view('volunteer');
		        $this->load->view('user_footer');
	}

	function alluser()
	{
			$data['volunteerlist']=$this->volunteer_model->get_entries();
			$data['site_title'] = 'Admin Dashboard'; //Title
        	$this->load->view('header',$data);
			$this->load->view('volunteerlist',$data);
			$this->load->view('user_footer');
	}

	public function edit($id)
  	{
    			if($this->input->post('update'))
				{

					if(!empty($_FILES['profile_pic']['name'])){
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;
                $config['file_name'] = $_FILES['profile_pic']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('profile_pic')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = $this->input->post('profile_pic2');
            }

					$dob = $this->input->post('dob');
		      		$dob1 = date("Y-m-d", strtotime($dob));

		      		$doj = $this->input->post('doj');
		      		$doj1 = date("Y-m-d", strtotime($doj));

		      		$lang = $this->input->post('language');
		      		$lang2 = implode(',',$lang);
					$user=array('vname' =>$this->input->post('name'),'vemail' =>$this->input->post('email'),'vmobile' =>$this->input->post('mobile'),'gender' =>$this->input->post('gender'), 'language_known' =>$lang2, 'profile_pic' =>$picture, 'shift_language' =>$this->input->post('slanguage'), 'date_of_birth' =>$dob1, 'date_of_joining' =>$doj1, 'address' => $this->input->post('address'), 'status' =>$this->input->post('status'));
					$this->volunteer_model->update_entry($user,$id);
					$this->session->set_flashdata('msg',"volunteer has been updated successfully");
					$base_url=base_url();
					redirect("$base_url"."volunteer/alluser");
   				}
				$data['user']=$this->volunteer_model->get($id);
  				$data['site_title'] = 'Admin Dashboard'; //Title
  				$this->load->view('header',$data);
				$this->load->view('editvolunteer',$data);
				$this->load->view('user_footer');
    }
public function delete($id)
    {
 
       $this->volunteer_model->delete_entry($id);
     $this->session->set_flashdata('msg',"volunteer has been deleted successfully");   
  $data['volunteerlist']=$this->volunteer_model->get_entries();
   $data['site_title'] = 'Admin Dashboard'; //Title
        	$this->load->view('header',$data);
			$this->load->view('volunteerlist',$data);
			$this->load->view('user_footer');
                      
}
	 
}
