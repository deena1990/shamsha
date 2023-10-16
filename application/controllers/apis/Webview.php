<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webview extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('apis/event_registration_model');
        $this->load->model('apis/payment_model');
        $this->load->model('apis/feedback_model');
        $this->load->model('apis/case_report_model');
    }
    public function index(){
        echo "Invalid";
    }
    
    public function about(){
        $this->load->view('webviews/about');
    }
    
    public function about_ar(){
        $this->load->view('webviews/about_ar');
    }

    public function event_pay(){
        if ($this->input->server('REQUEST_METHOD') == 'GET'){
            $id = $this->input->get('reg_id', true);
            $data = $this->event_registration_model->getData($id);
            $type = "Event Register";
            $name = $data->name;
            $email = $data->email;
            $phone = $data->phone;
            $address = $data->phone;
            $amount = $data->amount;
            $payType = $this->input->get('payType', true);
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
                $msisdn = str_replace('+','00',$phone);

                $dataToComputeHash = $paymentchannel . "paymentchannel" . $isysid . "isysid" . $amount . "amount" . $timestamp . "timestamp" . $description . "description" . $rnd . "rnd" . $original . "original" . $msisdn . "msisdn" . $currency . "currency" . $tunnel . "tunnel";

                $decryptedOriginal = "XuCESt3ThDt6JQiG";

                $hash = strtoupper(hash_hmac("sha256", $dataToComputeHash, $decryptedOriginal));
                //print($hash."\n");
                /* the redirect url to receive payment notification */
                $merchantResponseUrl = site_url()."webview/event_pay_return/".$id;

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
//print_r($data); exit;
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
    function event_pay_return($id){
        if ($this->input->server('REQUEST_METHOD') == 'GET'){
            $data = [];
            if(!empty($_GET)){
                $data = $this->input->get();
                $result = $this->event_registration_model->update_payment($data,$id);

                if($result == "success"){
                    $this->load->view('webviews/event-pay-return', $data);
                }
                else{
                    echo "Something went wrong, Please try after sometimes!!";
                }

            }

        }
    }
    
   public function feedback(){
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $data['case_id'] = $this->input->get('case_id', true);
            $data['volunteer_id'] = $this->input->get('volunteer_id', true);
            $data['todayDate'] = $this->input->post('todayMonth', true).'/'.$this->input->post('todayDate', true).'/'.$this->input->post('todayYear', true);
            $data['leaveFeedback'] = $this->input->post('leaveFeedback', true);
            $data['how_satisfied'] = $this->input->post('how_satisfied', true);
            $data['knowledgeable'] = $this->input->post('knowledgeable', true);
            $data['kind'] = $this->input->post('kind', true);
            $data['how_satisfied_with_casework'] = $this->input->post('how_satisfied_with_casework', true);
            $data['caseworker_knowledgeable'] = $this->input->post('caseworker_knowledgeable', true);
            $data['caseworker_kind'] = $this->input->post('caseworker_kind', true);
            $data['recommend'] = $this->input->post('recommend', true);
            $data['positive_experiences'] = $this->input->post('positive_experiences', true);
            $data['negative_experiences'] = $this->input->post('negative_experiences', true);
            $data['additional_thoughts'] = $this->input->post('additional_thoughts', true);
            $data['downloaded_app'] = $this->input->post('downloaded_app', true);
            $data['which_store'] = $this->input->post('which_store', true);
            $data['use_any_talk_features'] = $this->input->post('use_any_talk_features', true);
            $data['technical_issue'] = $this->input->post('technical_issue', true);
            $data['describe_experience_technical_issue'] = $this->input->post('describe_experience_technical_issue', true);
            $data['enjoy_app'] = $this->input->post('enjoy_app', true);
            $data['find_easy_to_use'] = $this->input->post('find_easy_to_use', true);
            $data['feel_welcoming_friendly'] = $this->input->post('feel_welcoming_friendly', true);
            $data['feel_safe_while_use'] = $this->input->post('feel_safe_while_use', true);
            $data['anything_else_tell_us'] = $this->input->post('anything_else_tell_us', true);
            // echo"<pre>";print_r($data);die;
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('case_id', 'Case Id', 'required');
            $this->form_validation->set_rules('volunteer_id', 'Volunteer Id', 'required');
            if ($this->form_validation->run() == false)
            {
                $errors = $this->form_validation->error_array();
                $fields = array_keys($errors);
                $err_msg = $errors[$fields[0]];
                $this->session->set_flashdata('error', $err_msg);
            }
            else
            {
                $result = $this->feedback_model->insert($data);
                // if ($result){
                //     $this->session->set_flashdata('msg', "Sent successfully");
                // }
                // else{
                //     $this->session->set_flashdata('error', "Something went wrong");
                // }
                return redirect('apis/webview/feedback_form_success');
                
            }
            // $full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            // redirect($full_url);
            

        }
        $this->load->view('webviews/feedback');
    }

    public function feedback_form_success(){
        return $this->load->view('webviews/feedback-form-success');
    }

    
    public function shortcasereport(){
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
//            echo "<pre>";
//            print_r($_POST); exit;
            $data['volunteer'] = $this->input->get('volunteer',true);
            $data['form_name'] = "short";
            $data['case_id'] = $this->input->get('case_id',true);
            $data['fullname'] = $this->input->post('fullname',true);
            $data['mobile'] = $this->input->post('mobile',true);
            $data['repeat_client_r_admin_inquiry'] = $this->input->post('repeat_client_r_admin_inquiry',true);
            if($data['repeat_client_r_admin_inquiry'] == "Repeat client or caller"){
                $data['caller_name'] = $this->input->post('caller_name',true);
                $data['caller_phone_num'] = $this->input->post('caller_phone_num',true);
                $data['why_she_call'] = $this->input->post('why_she_call',true);
                $data['further_details'] = $this->input->post('further_details',true);
                $data['did_case_req_payment'] = $this->input->post('did_case_req_payment',true);
                if($data['did_case_req_payment'] == "Yes"){
                    $data['service_r_item_paid_for'] = implode (", ", $this->input->post('service_r_item_paid_for',true));
                    $data['service_r_item_paid_for_others'] = $this->input->post('service_r_item_paid_for_others',true);
                    $data['reimbursed'] = $this->input->post('reimbursed',true);
                     if($data['reimbursed'] == "Yes"){
                          $data['expense_n_purpose'] = $this->input->post('expense_n_purpose',true);
                          $data['amount_of_expense'] = $this->input->post('amount_of_expense',true);
                          $data['do_u_have_receipt'] = $this->input->post('do_u_have_receipt',true);
                     }
                }
               
            }
            if($data['repeat_client_r_admin_inquiry'] == "Administrative inquiry or other"){
                $data['spam_call_chat'] = $this->input->post('spam_call_chat',true);
                $data['name_of_caller'] = $this->input->post('name_of_caller',true);
                $data['desc_interaction'] = $this->input->post('desc_interaction',true);
                $data['how_call_follow_up'] = $this->input->post('how_call_follow_up',true);
            }
            $data['final_notes_n_thought_abt_client'] = $this->input->post('final_notes_n_thought_abt_client',true);
            $data['feeling_interaction_with_client'] = $this->input->post('feeling_interaction_with_client',true);
            $data['good_r_bad_abt_shift'] = $this->input->post('good_r_bad_abt_shift',true);

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('volunteer', '', 'required');
            $this->form_validation->set_rules('case_id', '', 'required');
            $this->form_validation->set_rules('fullname', '', 'required');
            $this->form_validation->set_rules('mobile', '', 'required');
            $this->form_validation->set_rules('repeat_client_r_admin_inquiry', '', 'required');
            if($data['repeat_client_r_admin_inquiry'] == "Repeat client or caller"){
                $this->form_validation->set_rules('caller_name', '', 'required');
                $this->form_validation->set_rules('caller_phone_num', '', 'required');
                $this->form_validation->set_rules('why_she_call', '', 'required');
                $this->form_validation->set_rules('further_details', '', 'required');
                $this->form_validation->set_rules('did_case_req_payment', '', 'required');

                if($data['did_case_req_payment'] == "Yes"){
                    $this->form_validation->set_rules('service_r_item_paid_for', '', 'required');
                    //print_r($data['service_r_item_paid_for']); exit();
                    if (in_array("Others", $this->input->post('service_r_item_paid_for',true))){
                        $this->form_validation->set_rules('service_r_item_paid_for_others', '', 'required');
                    }
                    $this->form_validation->set_rules('reimbursed', '', 'required');

                    if($data['reimbursed'] == "Yes"){
                        $this->form_validation->set_rules('expense_n_purpose', '', 'required');
                        $this->form_validation->set_rules('amount_of_expense', '', 'required');
                        $this->form_validation->set_rules('do_u_have_receipt', '', 'required');
                    }
                }
            }
            if($data['repeat_client_r_admin_inquiry'] == "Administrative inquiry or other"){
                $this->form_validation->set_rules('spam_call_chat', '', 'required');
                $this->form_validation->set_rules('name_of_caller', '', 'required');
                $this->form_validation->set_rules('desc_interaction', '', 'required');
                $this->form_validation->set_rules('how_call_follow_up', '', 'required');
            }
            $this->form_validation->set_rules('final_notes_n_thought_abt_client', '', 'required');
            $this->form_validation->set_rules('feeling_interaction_with_client', '', 'required');
            $this->form_validation->set_rules('good_r_bad_abt_shift', '', 'required');
            if ($this->form_validation->run() == false)
            {
                header('Content-Type: application/json');
                echo json_encode(array('status' => "error", 'msg' => validation_errors()));
                exit;
            }
            else
            {
                $result = $this->case_report_model->insert($data);
                if ($result){
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => "success",'msg' => 'Added Successfully'));
                    exit;
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => "failed",'msg' => 'Something went wrong please try later!!'));
                    exit;
                }
            }

        }

        $this->load->view('webviews/short-case-report');
    }
    
    
    public function longcasereport(){
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
//            echo "<pre>";
//            print_r($_POST); exit;
            $data['volunteer'] = $this->input->get('volunteer',true);
            $data['case_id'] = $this->input->get('case_id',true);
            $data['form_name'] = "long";
            $data['fullname'] = $this->input->post('fullname',true);
            $data['mobile'] = $this->input->post('mobile',true);

            $data['shift_u_on'] = $this->input->post('shift_u_on',true);
            $data['date'] = $this->input->post('date',true);
            $data['time'] = $this->input->post('time',true);
            $data['client_first_name'] = $this->input->post('client_first_name',true);
            $data['client_last_name'] = $this->input->post('client_last_name',true);
            $data['client_phone_num'] = $this->input->post('client_phone_num',true);
            $data['client_country'] = $this->input->post('client_country',true);
            $data['client_country_other'] = $this->input->post('client_country_other',true);
            $data['type_of_call'] = $this->input->post('type_of_call',true);
            $data['type_of_call_other'] = $this->input->post('type_of_call_other',true);
            $data['how_long_interaction'] = $this->input->post('how_long_interaction',true);
            $data['how_long_interaction_others'] = $this->input->post('how_long_interaction_others',true);


            $data['did_case_req_payment'] = $this->input->post('did_case_req_payment',true);

            if($data['did_case_req_payment'] == "Yes"){
                $data['service_r_item_paid_for'] = implode (", ", $this->input->post('service_r_item_paid_for',true));
                $data['service_r_item_paid_for_others'] = $this->input->post('service_r_item_paid_for_others',true);
                $data['reimbursed'] = $this->input->post('reimbursed',true);
                if($data['reimbursed'] == "Yes"){
                    $data['expense_n_purpose'] = $this->input->post('expense_n_purpose',true);
                    $data['amount_of_expense'] = $this->input->post('amount_of_expense',true);
                    $data['do_u_have_receipt'] = $this->input->post('do_u_have_receipt',true);
                }
            }

            $data['abuse_she_face'] = $this->input->post('abuse_she_face',true);
            $data['abuse_she_face_other'] = $this->input->post('abuse_she_face_other',true);
            $data['interaction_for'] = $this->input->post('interaction_for',true);
            $data['interaction_for_other'] = $this->input->post('interaction_for_other',true);
            $data['relationship_of_perpet_to_victim'] = $this->input->post('relationship_of_perpet_to_victim',true);
            $data['relationship_of_perpet_to_victim_other'] = $this->input->post('relationship_of_perpet_to_victim_other',true);
            $data['first_time_r_repeat_violence'] = $this->input->post('first_time_r_repeat_violence',true);
            $data['summary_of_case_n_reason'] = $this->input->post('summary_of_case_n_reason',true);
            $data['like_to_do_next'] = $this->input->post('like_to_do_next',true);
            $data['client_follow_up'] = $this->input->post('client_follow_up',true);
            $data['is_it_safe_to_cal_back'] = $this->input->post('is_it_safe_to_cal_back',true);
            $data['client_info_abt_ofc_hrs'] = $this->input->post('client_info_abt_ofc_hrs',true);
            $data['any_sign_of_suicide_r_harm'] = $this->input->post('any_sign_of_suicide_r_harm',true);
            $data['discuss_r_safe_plan'] = $this->input->post('discuss_r_safe_plan',true);
            $data['any_referrals'] = $this->input->post('any_referrals',true);
            $data['client_ethnicity'] = $this->input->post('client_ethnicity',true);
            $data['client_ethnicity_other'] = $this->input->post('client_ethnicity_other',true);
            $data['client_age'] = $this->input->post('client_age',true);
            $data['marital_status'] = $this->input->post('marital_status',true);
            $data['marital_status_other'] = $this->input->post('marital_status_other',true);
            $data['client_have_children'] = $this->input->post('client_have_children',true);
            $data['client_employed'] = $this->input->post('client_employed',true);
            $data['what_she_do'] = $this->input->post('what_she_do',true);
            $data['recomment_care'] = implode (", ", $this->input->post('recomment_care',true));
            $data['recomment_care_other'] = $this->input->post('recomment_care_other',true);
            $data['penetration_made'] = $this->input->post('penetration_made',true);
            $data['penetration_made_other'] = $this->input->post('penetration_made_other',true);
            $data['client_involved_the_police'] = $this->input->post('client_involved_the_police',true);
            $data['client_involved_the_police_other'] = $this->input->post('client_involved_the_police_other',true);
            $data['hear_about_shamsaha'] = $this->input->post('hear_about_shamsaha',true);

            $data['perpetrator_access_to_gun'] = $this->input->post('perpetrator_access_to_gun',true);
            $data['violence_towards_victim'] = $this->input->post('violence_towards_victim',true);
            $data['perpetrator_mem_of_police'] = $this->input->post('perpetrator_mem_of_police',true);
            $data['victim_in_danger'] = $this->input->post('victim_in_danger',true);
            $data['any_advance_r_serious_injury'] = $this->input->post('any_advance_r_serious_injury',true);


            $data['final_notes_n_thought_abt_client'] = $this->input->post('final_notes_n_thought_abt_client',true);
            $data['feeling_interaction_with_client'] = $this->input->post('feeling_interaction_with_client',true);
            $data['good_r_bad_abt_shift'] = $this->input->post('good_r_bad_abt_shift',true);

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('volunteer', '', 'required');
            $this->form_validation->set_rules('case_id', '', 'required');
            $this->form_validation->set_rules('fullname', '', 'required');
            $this->form_validation->set_rules('mobile', '', 'required');


            $this->form_validation->set_rules('shift_u_on', '', 'required');
            $this->form_validation->set_rules('date', '', 'required');
            $this->form_validation->set_rules('time', '', 'required');
            $this->form_validation->set_rules('client_first_name', '', 'required');
            $this->form_validation->set_rules('client_last_name', '', 'required');
            $this->form_validation->set_rules('client_phone_num', '', 'required');
            $this->form_validation->set_rules('client_country', '', 'required');
            if($data['client_country'] == "Other"){
                $this->form_validation->set_rules('client_country_other', '', 'required');
            }
            $this->form_validation->set_rules('type_of_call', '', 'required');
            if($data['type_of_call'] == "Other"){
                $this->form_validation->set_rules('type_of_call_other', '', 'required');
            }
            $this->form_validation->set_rules('how_long_interaction', '', 'required');
            if($data['how_long_interaction'] == "Others"){
                $this->form_validation->set_rules('how_long_interaction_others', '', 'required');
            }

            $this->form_validation->set_rules('did_case_req_payment', '', 'required');

            if($data['did_case_req_payment'] == "Yes"){
                $this->form_validation->set_rules('service_r_item_paid_for', '', 'required');
                if (in_array("Others", $this->input->post('service_r_item_paid_for',true))){
                    $this->form_validation->set_rules('service_r_item_paid_for_others', '', 'required');
                }
                $this->form_validation->set_rules('reimbursed', '', 'required');

                if($data['reimbursed'] == "Yes"){
                    $this->form_validation->set_rules('expense_n_purpose', '', 'required');
                    $this->form_validation->set_rules('amount_of_expense', '', 'required');
                    $this->form_validation->set_rules('do_u_have_receipt', '', 'required');
                }
            }




            $this->form_validation->set_rules('abuse_she_face', '', 'required');
            if($data['abuse_she_face'] == "Other"){
                $this->form_validation->set_rules('abuse_she_face_other', '', 'required');
            }
            $this->form_validation->set_rules('interaction_for', '', 'required');
            if($data['interaction_for'] == "Other"){
                $this->form_validation->set_rules('interaction_for_other', '', 'required');
            }
            $this->form_validation->set_rules('relationship_of_perpet_to_victim', '', 'required');
            if($data['relationship_of_perpet_to_victim'] == "Other"){
                $this->form_validation->set_rules('relationship_of_perpet_to_victim_other', '', 'required');
            }
            $this->form_validation->set_rules('first_time_r_repeat_violence', '', 'required');
            $this->form_validation->set_rules('summary_of_case_n_reason', '', 'required');
            $this->form_validation->set_rules('like_to_do_next', '', 'required');
            $this->form_validation->set_rules('client_follow_up', '', 'required');
            $this->form_validation->set_rules('is_it_safe_to_cal_back', '', 'required');
            $this->form_validation->set_rules('client_info_abt_ofc_hrs', '', 'required');
            $this->form_validation->set_rules('any_sign_of_suicide_r_harm', '', 'required');
            $this->form_validation->set_rules('discuss_r_safe_plan', '', 'required');
            $this->form_validation->set_rules('any_referrals', '', 'required');
            $this->form_validation->set_rules('client_ethnicity', '', 'required');
            if($data['client_ethnicity'] == "Other"){
                $this->form_validation->set_rules('client_ethnicity_other', '', 'required');
            }
            $this->form_validation->set_rules('client_age', '', 'required');
            $this->form_validation->set_rules('marital_status', '', 'required');
            if($data['marital_status'] == "Other"){
                $this->form_validation->set_rules('marital_status_other', '', 'required');
            }
            $this->form_validation->set_rules('client_have_children', '', 'required');
            $this->form_validation->set_rules('client_employed', '', 'required');
            //$this->form_validation->set_rules('what_she_do', '', 'required');
            $this->form_validation->set_rules('recomment_care[]', '', 'required');
            if (in_array("Other", $this->input->post('recomment_care',true))){
                $this->form_validation->set_rules('recomment_care_other', '', 'required');
            }

            //$this->form_validation->set_rules('penetration_made', '', 'required');
            if($data['penetration_made'] == "Other"){
                $this->form_validation->set_rules('penetration_made_other', '', 'required');
            }
            $this->form_validation->set_rules('client_involved_the_police', '', 'required');
            if($data['client_involved_the_police'] == "Other"){
                $this->form_validation->set_rules('client_involved_the_police_other', '', 'required');
            }
            $this->form_validation->set_rules('perpetrator_access_to_gun', '', 'required');
            $this->form_validation->set_rules('violence_towards_victim', '', 'required');
            $this->form_validation->set_rules('perpetrator_mem_of_police', '', 'required');
            $this->form_validation->set_rules('victim_in_danger', '', 'required');
            $this->form_validation->set_rules('any_advance_r_serious_injury', '', 'required');


            $this->form_validation->set_rules('hear_about_shamsaha', '', 'required');
            $this->form_validation->set_rules('final_notes_n_thought_abt_client', '', 'required');
            $this->form_validation->set_rules('feeling_interaction_with_client', '', 'required');
            $this->form_validation->set_rules('good_r_bad_abt_shift', '', 'required');
            if ($this->form_validation->run() == false)
            {
                header('Content-Type: application/json');
                echo json_encode(array('status' => "error", 'msg' => "Please fill all required fields"));
                exit;
            }
            else
            {
                $result = $this->case_report_model->insert($data);
                if ($result){
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => "success",'msg' => 'Added Successfully'));
                    exit;
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => "failed",'msg' => 'Something went wrong please try later!!'));
                    exit;
                }
            }

        }

        $this->load->view('webviews/long-case-report');
    }



    public function casereport(){
        $data['volunteer'] = $this->input->get('volunteer',true);
        $data['case_id'] = $this->input->get('case_id',true);
        $this->load->view('webviews/case-report',$data);
    }




}

