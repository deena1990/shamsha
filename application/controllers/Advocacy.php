<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advocacy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('advocacy_model');
		$this->load->model('apis/payment_model');
		
}
	function alladvocacy()
	{
			$data['advocacylist']=$this->advocacy_model->get_entries();
			$data['site_title'] = 'Admin Dashboard'; //Title
			$data['page_title'] = 'Advocacy';
        	$this->load->view('header',$data);
			$this->load->view('advocacylist',$data);
			$this->load->view('user_footer');
	}

       public function view($id)
  	{
    		
				$data['advocacy']=$this->advocacy_model->get_row($id);
				if(!empty($data['advocacy'])){
                    $data['site_title'] = 'Admin Dashboard'; //Title
                    $data['page_title'] = 'Advocacy';
                    $this->load->view('header',$data);
                    $this->load->view('view-advocacy',$data);
                    $this->load->view('user_footer');
                }
				else{
				    return show_404();
                }

    }
    
    public function edit($id)
    {

        $data['advocacy']=$this->advocacy_model->get_row($id);
       // print_r($data); exit;
        if(!empty($data['advocacy'])){
            if ($this->input->server('REQUEST_METHOD') == 'POST'){
                $this->form_validation->set_rules('email_id', 'Email ID', 'trim|valid_email|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('age_above_r_nt', 'Age', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('language_u_speak[]', 'Languages', "trim|required",array('required' => 'The field is required'));
                $this->form_validation->set_rules('transportation', 'Transportation', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('stay_in', 'Stay', 'trim|required',array('required' => 'The field is required'));
                //$this->form_validation->set_rules('plan_to_stay', 'Plan', 'trim|required');
                $this->form_validation->set_rules('attend_training', 'Attend Traning', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('r_u_volunteer', 'Voluteer', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('traning_fee', 'Traning Fee', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('unpain_volunteer', 'Un paid Volunteer', 'trim|required',array('required' => 'The field is required'));
                $this->form_validation->set_rules('understand_r_not', '', 'trim|required',array('required' => 'The field is required'));

                if ($this->form_validation->run() == FALSE)
                {
                    //print_r($this->form_validation->error_array());
                    $data['error'] = validation_errors();
                }
                else{
                    $r_u_volunteer = $this->input->get_post('r_u_volunteer');
                    if($r_u_volunteer == "Other"){
                        $r_u_volunteer =  $this->input->get_post('r_u_volunteer_other');
                    }
                    $langArray = $this->input->get_post('language_u_speak');
                    if (in_array("Other", $langArray)){
                        $langArray[] = $this->input->get_post('language_u_speak_other');
                    }
                    $language_u_speak = implode(',', array_diff($langArray, array('Other')));



                    $user=array('email_id' => $this->input->get_post('email_id'),'fullname' => $this->input->get_post('fullname'),
                        'mobile' => $this->input->get_post('mobile'), 'age_above_r_nt' => $this->input->get_post('age_above_r_nt'),
                        'language_u_speak' => $language_u_speak, 'transportation' => $this->input->get_post('transportation'),
                        'stay_in' => $this->input->get_post('stay_in'),
                        'attend_training' => $this->input->get_post('attend_training'),'r_u_volunteer' => $r_u_volunteer,
                        'unpain_volunteer' => $this->input->get_post('unpain_volunteer'),
                        'traning_fee' => $this->input->get_post('traning_fee'), 'any_additional_skill' => $this->input->get_post('any_additional_skill'),
                        'understand_r_not' => $this->input->get_post('understand_r_not'),
                        'status' => 'Active'
                    );
                   // print_r($user); exit;
                    $result = $this->advocacy_model->update_entry($user,$id);
                    if($result){
                        $this->session->set_flashdata('msg', "Updated successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "advocacy/edit/".$id);

                    }
                    else{
                        print_r($this->db->error()); exit;
                    }
                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Advocacy';
            $this->load->view('header',$data);
            $this->load->view('advocacy',$data);
            $this->load->view('user_footer');
        }
        else{
            return show_404();
        }

    }
    
    
    
    public function delete($id)
    {
 
       $this->advocacy_model->delete_entry($id);
     $this->session->set_flashdata('msg',"Advocacy record has been deleted successfully");   
  $data['advocacylist']=$this->advocacy_model->get_entries();
   $data['site_title'] = 'Admin Dashboard'; //Title
   $data['page_title'] = 'Advocacy';
        	$this->load->view('header',$data);
			$this->load->view('advocacylist',$data);
			$this->load->view('user_footer');
                      
}

	function add()
	{
	    if ($this->input->server('REQUEST_METHOD') == 'POST'){
	        $this->form_validation->set_rules('email_id', 'Email ID', 'trim|valid_email|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('age_above_r_nt', 'Age', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('language_u_speak[]', 'Languages', "trim|required",array('required' => 'The field is required'));
            $this->form_validation->set_rules('transportation', 'Transportation', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('stay_in', 'Stay', 'trim|required',array('required' => 'The field is required'));
            //$this->form_validation->set_rules('plan_to_stay', 'Plan', 'trim|required');
            $this->form_validation->set_rules('attend_training', 'Attend Traning', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('r_u_volunteer', 'Voluteer', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('traning_fee', 'Traning Fee', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('unpain_volunteer', 'Un paid Volunteer', 'trim|required',array('required' => 'The field is required'));
            $this->form_validation->set_rules('understand_r_not', '', 'trim|required',array('required' => 'The field is required'));
    
            if ($this->form_validation->run() == FALSE)
            {
                //print_r($this->form_validation->error_array());
            }
            else{
                
                $r_u_volunteer = $this->input->get_post('r_u_volunteer');
                if($r_u_volunteer == "Other"){
                   $r_u_volunteer =  $this->input->get_post('r_u_volunteer_other');
                }
                $langArray = $this->input->get_post('language_u_speak');
                if (in_array("Other", $langArray)){
                    $langArray[] = $this->input->get_post('language_u_speak_other');
                }
                $language_u_speak = implode(',', array_diff($langArray, array('Other')));
                
                
                
                $user=array('email_id' => $this->input->get_post('email_id'),'fullname' => $this->input->get_post('fullname'), 
				 'mobile' => $this->input->get_post('mobile'), 'age_above_r_nt' => $this->input->get_post('age_above_r_nt'), 
				 'language_u_speak' => $language_u_speak, 'transportation' => $this->input->get_post('transportation'),
				 'stay_in' => $this->input->get_post('stay_in'),
				 'attend_training' => $this->input->get_post('attend_training'),'r_u_volunteer' => $r_u_volunteer,
				 'unpain_volunteer' => $this->input->get_post('unpain_volunteer'),
				 'traning_fee' => $this->input->get_post('traning_fee'), 'any_additional_skill' => $this->input->get_post('any_additional_skill'),
				 'understand_r_not' => $this->input->get_post('understand_r_not'),
				 'status' => 'Active'
				 );
				 	$result = $this->advocacy_model->add($user);
				 	if($result != "failed"){
				 	    if($this->input->get_post('traning_fee') == "I am unable to pay the fee."){
				 	        redirect('/advocacy/unpaidvolunteer', 'refresh');
				 	    }
				 	    else{
				 	        redirect('/advocacy/paidvolunteer/'.$result, 'refresh');
				 	    }
				 	    
				 	}
            }
	    }
	    
		$data['advocacylist']=$this->advocacy_model->get_entries();
		$this->load->view('webviews/add-advocacy',$data);
	}
	
	function unpaidvolunteer(){
	   $this->load->view('webviews/google-form-success');
	}
	
// 	function paidvolunteer($id){
// 	    $this->advocacy_model->get_entries();
// 	    $this->load->view('webviews/google-form-success');
// 	}
	
	function return($id){
	    if ($this->input->server('REQUEST_METHOD') == 'GET'){
            $data = [];
            if(!empty($_GET)){
                $data = $this->input->get();
                $result = $this->advocacy_model->update_payment($data,$id);
                
                if($result == "success"){
                    $this->load->view('webviews/return-google-form', $data);
                }
                else{
                   echo "Something went wrong, Please try after sometimes!!";
                }
                
            }
           
         }
	}
	
	function paidvolunteer($id){
	    if ($this->input->server('REQUEST_METHOD') == 'POST'){
	        $data = $this->advocacy_model->getdetails($id);
	        $type = "Volunteer Register";
            $name = $data->fullname;
            $email = $data->email_id;
            $phone = $data->mobile;
            $address = "Google form";
            $amount = 0.010;
            $payType = $this->input->post('payType', true);
            $cattype = "";
            $company ="";
            $memo = "";

            $data = array(
                'type' => $type,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'amount' => $amount,
                'payType' => $payType,
                'cattype' => $cattype,
                'company' => $company,
                'memo' => $memo,
            );
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            $this->form_validation->set_rules('payType', 'Payment Type', 'required');
            if ($cattype == "corp")
            {
                $this->form_validation->set_rules('company', 'Company', 'required');
            }
            if ($cattype == "ind_gen ")
            {
                $this->form_validation->set_rules('memo', 'Memo', 'required');
            }

            if ($this->form_validation->run() == false)
            {
                $data['error'] = validation_errors();
            }
            else
            {
                if ($payType == "credit")
                {
                    $paymentchannel = "BHOGAUBCC"; /* kwknetonedc for knet */
                }
                if ($payType == "debit")
                {
                    $paymentchannel = "BHBENEFITDC"; /* kwknetonedc for knet */
                }

                $isysid = rand(1, 9).time() . rand(10, 99); /* Must be a unique number (atleast 12) for each request*/
                //$amount = "0.010";
                $description = 'Test';
                $description2 = "more details you need to include";
                $tunnel = "isys";
                $currency = "BHD";
                $language = "EN";
                $country = "BH";
                $merchant_name = "Shamsaha";
                $akey = "dizhQwEBgVhzcDg6";
                $timestamp = time();
                $rnd = "";
                $original = "vT9UGwC08nBaSoEjmEGpBmiQx3M84MLW7hPr3K5iiPA=";
                $msisdn = str_replace("+","00","$phone");

                $dataToComputeHash = $paymentchannel . "paymentchannel" . $isysid . "isysid" . $amount . "amount" . $timestamp . "timestamp" . $description . "description" . $rnd . "rnd" . $original . "original" . $msisdn . "msisdn" . $currency . "currency" . $tunnel . "tunnel";

                $decryptedOriginal = "XuCESt3ThDt6JQiG";

                $hash = strtoupper(hash_hmac("sha256", $dataToComputeHash, $decryptedOriginal));
                //print($hash."\n");
                /* the redirect url to receive payment notification */
                $merchantResponseUrl = "http://shamsaha.sayg.co/advocacy/return/".$id;

                /* payit checkout payment host */
                $host = "https://pay-it.mobi/globalpayit/pciglobal/WebForms/payitcheckoutservice2.aspx";

                /* Construct the url with parameters */
                $data['url'] = $host . "?country=" . $country . "&paymentchannel=" . $paymentchannel . "&isysid=" . $isysid . "&amount=" . $amount . "&tunnel=" . $tunnel . "&description=" . urlencode($description) . "&description2=" . urlencode($description2) . "&currency=" . $currency . "&Responseurl=" . $merchantResponseUrl . "&merchant_name=" . $merchant_name . "&akey=" . $akey . "&hash=" . $hash . "&original=" . $original . "&timestamp=" . $timestamp . "&msisdn=" . $msisdn . "&rnd=" . $rnd;

            
                    $data['payType'] = $payType;
                    $data['paymentchannel'] = $paymentchannel;
                    $data['isysid'] = $isysid;
                    $data['description'] = $description;
                    $data['description2'] = $description2;
                    $data['tunnel'] = $tunnel;
                    $data['currency'] = $currency;
                    $data['language'] = $language;
                    $data['country'] = $country;
                    $data['merchant_name'] = $merchant_name;
                    $data['akey'] = $akey;
                    $data['timestamp'] = $timestamp;
                    $data['rnd'] = $rnd;
                    $data['original'] = $original;
                    $data['msisdn'] = $msisdn;
                    $data['dataToComputeHash'] = $dataToComputeHash;
                    $data['decryptedOriginal'] = $decryptedOriginal;
                    $data['hash'] = $hash;
                    
                    $result = $this->payment_model->add_payment($data);
                    if($result == "success"){
                        $this->load->view('webviews/payment', $data);
                    }
                    else{
                        echo "Something went wrong, Please try after sometimes!!";
                    }
            }
	    }
	    else{
	        $this->load->view('webviews/paidvolunteer');
	    }
	}
    
	 
}
