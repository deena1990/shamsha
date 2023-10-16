<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Case_report extends CI_Controller
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

    public function case_report_form()
    {   
        $data['phone_codes'] = $this->case_report_model->get_country_code();
        $data['case_id'] = $_GET['case_id'];
        $data['volunteer_id'] = $_GET['volunteer'];
        $this->load->view('webviews/case-report-form', $data);
    }

    public function case_report_detail_view()
    {   
        $data['phone_codes'] = $this->case_report_model->get_country_code();
        $data['case_id'] = $_GET['case_id'];
        $data['volunteer_id'] = $_GET['volunteer'];
        $data['case_details'] = $this->case_report_model->get_case_details($data['case_id'],$data['volunteer_id']);
        $this->load->view('webviews/case-report-form-details', $data);
    }

    public function intake_form_detail_view()
    {   
        $data['case_id'] = $_GET['case_id'];
        $data['intake_form_details'] = $this->case_report_model->get_intake_form_details($data['case_id']);
        $this->load->view('webviews/intake-form-details', $data);
    }

    public function save_case_report_form()
    {   
        $what_ethnicity_of_client = $this->input->post('what_ethnicity_of_client');
        if ($what_ethnicity_of_client == "Other"){
            $ethnicity_of_client = $what_ethnicity_of_client.' => '.$this->input->post('what_ethnicity_of_client_other_text');
        }else{
            $ethnicity_of_client = $what_ethnicity_of_client;
        }
        if ($this->input->post('how_did_she_hear_about_Shamsaha') == ""){
            $hear_about_shamasaha_all = $this->input->post('how_did_she_hear_about_Shamsaha');
        }else{
            $hear_about_shamasaha_all = implode(' ::: ',$this->input->post('how_did_she_hear_about_Shamsaha'));
        }
        if (is_int(strpos($hear_about_shamasaha_all, "Other"))){
            $hear_about_shamasaha = $hear_about_shamasaha_all.' => '.$this->input->post('how_did_she_hear_about_Shamsaha_other_text');
        }else{
            $hear_about_shamasaha = $hear_about_shamasaha_all;
        }
        if ($this->input->post('was_any_penetration_made') == ""){
            $was_any_penetration_made = $this->input->post('was_any_penetration_made');
        }else{
            $was_any_penetration_made = implode(' ::: ',$this->input->post('was_any_penetration_made'));
        }
        $data = [
            'case_id'=> $this->input->post('case_id'),
            'volunteer'=> $this->input->post('volunteer'),
            'form_name'=> "Case Report",
            'fullname'=> $this->input->post('name'),
            'caller_name'=> $this->input->post('clientName'),
            'caller_phone_num'=> $this->input->post('clientCountryCode').':::'.$this->input->post('clientPhone'),
            'client_first_name'=> $this->input->post('clientName'),
            'client_phone_num'=> $this->input->post('clientCountryCode').':::'.$this->input->post('clientPhone'),
            'mobile'=> $this->input->post('countryCode').':::'.$this->input->post('phoneNumber'),
            'recomment_care'=> $this->input->post('countryOfLocation'),
            'date'=> $this->input->post('date'),
            'time'=> $this->input->post('time'),
            'hear_about_shamsaha'=> $hear_about_shamasaha,
            'penetration_made'=> $was_any_penetration_made,
            'penetration_made_other'=> $this->input->post('was_any_penetration_made_other_text'),
            'feeling_interaction_with_client'=> $this->input->post('how_were_you_feeling'),
            'final_notes_n_thought_abt_client'=> $this->input->post('final_notes'),
            'good_r_bad_abt_shift'=> $this->input->post('any_issues_with_App'),
            'client_employed'=> $this->input->post('is_client_employed'),
            'marital_status'=> $this->input->post('what_client_marital_status'),
            'client_have_children'=> $this->input->post('does_client_have_children'),
            'client_age'=> $this->input->post('what_client_age'),
            'client_ethnicity'=> $ethnicity_of_client,
            'any_sign_of_suicide_r_harm'=> $this->input->post('did_client_display_any_signs_of_being_suicidal_r_at_risk_of_harming_themselves_or_others'),
            'is_it_safe_to_cal_back'=> $this->input->post('is_it_safe_for_Shamsaha_to_call_r_contact_her_back'),
            'first_time_r_repeat_violence'=> $this->input->post('is_this_first_time_r_repeat_violence'),
            'relationship_of_perpet_to_victim'=> $this->input->post('what_relation_of_perpetrator_to_victim'),
            'relationship_of_perpet_to_victim_other'=> $this->input->post('what_relation_of_perpetrator_to_victim_other_text'),
            'interaction_for'=> $this->input->post('was_interaction_for_caller_r_somebody_else'),
            'abuse_she_face'=> implode(' ::: ',$this->input->post('what_type_of_abuse_she_facing')),
            'how_long_interaction'=> $this->input->post('how_long_was_interaction'),
            'type_of_call'=> implode(' ::: ',$this->input->post('type_of_interaction_was')),
            'type_of_call_other'=> $this->input->post('type_of_interaction_was_other_text'),
            'client_country'=> $this->input->post('countryClient'),
            'client_phone_num'=> $this->input->post('clientCountryCode').':::'.$this->input->post('clientPhone'),
            'client_first_name'=> $this->input->post('clientName'),
            'complete_address'=> $this->input->post('which_city_area_is_client_contacting_you_from'),
            'repeat_client_r_admin_inquiry'=> $this->input->post('about_what_issue_was_client'),
            'summary_of_case_n_reason'=> $this->input->post('overall_describe_interaction'),
            'new_caller_r_client'=> $this->input->post('inpersonSupport'),
            'why_she_call'=> $this->input->post('caseWorkTeam'),
            'name_of_caller'=> $this->input->post('callback3060min'),
            'desc_interaction'=> $this->input->post('callerRequest'),
            'how_call_follow_up'=> $this->input->post('callerRequestOngoingCaseWorkSupport'),
            'shift_u_on'=> $this->input->post('callback3days'),
            'client_last_name'=> $this->input->post('whatIssueReqSupprot'),
            'client_country_other'=> $this->input->post('did_client_answer_yes_to_any_urgency_quest_during_client_interaction'),
            'how_long_interaction_others'=> implode(' ::: ',$this->input->post('which_quests_client_respond_yes_during_urgency_assessment')),
            'did_case_req_payment'=> $this->input->post('what_steps_were_taken_in_response_to_urgency_ssessment'),
            'service_r_item_paid_for'=> $this->input->post('what_was_discovered_during_risk_analysis'),
            'service_r_item_paid_for_others'=> $this->input->post('was_a_safety_plan_completed_for_any_reason'),
            'reimbursed'=> $this->input->post('what_were_details_outcomes_of_safety_planning'),
            'your_role_in_shamsaha'=> $this->input->post('when_was_last_incident_of_abuse'),
            'expense_n_purpose'=> $this->input->post('what_were_the_circumstances'),
            'amount_of_expense'=> $this->input->post('does_client_want_put_on_service_list'),
            'do_u_have_receipt'=> $this->input->post('what_service_they_interested'),
            'benifit_r_by_cash'=> $this->input->post('what_were_circumstances_of_their_request'),
            'client_info_abt_ofc_hrs'=> $this->input->post('how_did_you_get_client_phone_number'),
            'further_details'=> $this->input->post('client_display_any_signs_further_details_text'),
            'abuse_she_face_other'=> implode(' ::: ',$this->input->post('did_you_provide_any_publicly_available_resources_to_client_r_details_about_Shamsaha’s_operational_partners_in_relevant_country')),
            'interaction_for_other'=> $this->input->post('language_client_prefer_to_communicate'),
            'like_to_do_next'=> $this->input->post('other_notes_in_arabic'),
            'perpetrator_access_to_gun'=> $this->input->post('what_type_of_interaction_was_this'),
            'recomment_care_other'=> $this->input->post('detail_the_interaction'),
            'violence_towards_victim'=> $this->input->post('additional_information'),
            'perpetrator_mem_of_police'=> $this->input->post('additional_information_in_arabic'),
        ];
        $status['status'] = 'success';
        $status['msg'] = 'Something went wrong !!';
        $victim = [
            'case_id'=> $this->input->post('case_id'),
        ];
        $this->case_report_model->add_caserform($data, $victim);
        echo json_encode($status);
    }

    function update_case_work_at_sight_post(){
        $this->case_report_model->update_casework_AtSight($this->input->post('caseworkAtSight'),$this->input->post('id'));
        echo "done";
    }

    function update_service_list_post(){
        $id = $this->input->post('id');
        $what_service_they_interested = $this->input->post('what_service_they_interested');
        $what_were_circumstances_of_their_request = $this->input->post('what_were_circumstances_of_their_request');
        $get_case_report_row_service_list = $this->case_report_model->get_row($id)->amount_of_expense;
       if($get_case_report_row_service_list == "Yes"){
        $data = [ 
            'amount_of_expense' => "No",
            'do_u_have_receipt' => null,
            'benifit_r_by_cash' => null,
        ];
       }else{
        $data = [ 
            'amount_of_expense' => "Yes", 
            'do_u_have_receipt' => $what_service_they_interested, 
            'benifit_r_by_cash' => $what_were_circumstances_of_their_request, 
        ];
       }
       $this->case_report_model->update_case_report_row($id,$data);
       $status['status'] = 'success';
       $status['msg'] = 'Something went wrong !!';
        echo json_encode($status);

    }

    function update_inPerson_support_post(){
        $id = $this->input->post('id');
        $caseWorkTeam = $this->input->post('caseWorkTeam');
        $callback3060min = $this->input->post('callback3060min');
        $callerRequest = $this->input->post('callerRequest');
        $get_case_report_row_inPerson_support = $this->case_report_model->get_row($id)->new_caller_r_client;
        if($get_case_report_row_inPerson_support == "Yes"){
            $data = [ 
                'new_caller_r_client' => "No",
                'why_she_call' => null,
                'name_of_caller' => null,
                'desc_interaction' => null,
            ];
        }else{
            $data = [ 
                'new_caller_r_client' => "Yes", 
                'why_she_call' => $caseWorkTeam,
                'name_of_caller' => $callback3060min,
                'desc_interaction' => $callerRequest, 
            ];
        }
        $this->case_report_model->update_case_report_row($id,$data);
        $status['status'] = 'success';
        $status['msg'] = 'Something went wrong !!';
        echo json_encode($status);

    }

    function update_onGoing_caseworkSupport_post(){
        $id = $this->input->post('id');
        $callback3days = $this->input->post('callback3days');
        $whatIssueReqSupprot = $this->input->post('whatIssueReqSupprot');
        $get_case_report_row_onGoing_caseworkSupport = $this->case_report_model->get_row($id)->how_call_follow_up;
        if($get_case_report_row_onGoing_caseworkSupport == "Yes"){
        $data = [ 
            'how_call_follow_up' => "No",
            'shift_u_on' => null,
            'client_last_name' => null,
        ];
       }else{
        $data = [ 
            'how_call_follow_up' => "Yes", 
            'shift_u_on' => $callback3days,
            'client_last_name' => $whatIssueReqSupprot, 
        ];
       }
       $this->case_report_model->update_case_report_row($id,$data);
       $status['status'] = 'success';
       $status['msg'] = 'Something went wrong !!';
        echo json_encode($status);

    }

    function update_case_status_post(){
        $id = $this->input->post('id');
        $opval = $this->input->post('opval');
        $data['case_id'] = $this->case_report_model->get_row($id)->case_id;
        $data['status'] = $opval;
        $update = [ 
            'client_follow_up' => $opval,
        ];
       $this->case_report_model->update_case_report_row($id,$update);
       $this->case_report_model->update($data);
       $status['status'] = 'success';
       $status['msg'] = 'Something went wrong !!';
        echo json_encode($status);

    }

    function index()
    {
        if( can('view-case_report') ) {
            $data=array();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Case Report';
            $this->load->view('header', $data);
            $this->load->view('case_report/index', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }
    }

    function getLists()
    {
        if( can('view-volunteer') ) {
            $data = $row = array();

            // Fetch member's records
            $caseData = $this->case_report_model->getRows($_POST);
            
            $i = $_POST['start'];
            foreach ($caseData as $case) {
                $i++;
                $data[] = array( date('d-m-Y', strtotime($case->created_at)), $case->fullname, $case->caller_name, str_replace(':::','-',$case->caller_phone_num), $case->client_country, $case->case_id, $case->amount_of_expense, $case->new_caller_r_client, $case->how_call_follow_up, $case->client_follow_up, $case->form_name, $case->id);
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->case_report_model->countAll(),
                "recordsFiltered" => $this->case_report_model->countFiltered($_POST),
                "data" => $data,
            );

            // Output to JSON format
            echo json_encode($output);
        }
        else{
            echo "Permission denied";
        }

    }

    public function view($id){
        $data['cr_report'] = $this->case_report_model->get_case_row($id);
        //echo $this->db->last_query();
        // print_r($data['cr_report']); exit;
        if(!empty($data['cr_report'])){
            // print_r($this->input->server('REQUEST_METHOD')); exit;
            if ($this->input->server('REQUEST_METHOD') == 'POST'){
                if ($this->input->post('post_type') == "cs"){
                    $status['status'] = $this->input->post('status',true);
                    $status['case_id'] = $data['cr_report']->case_id;
                    $update = $this->case_report_model->update($status);
                    if($update){
                        $data['cr_report']->status = $this->input->post('status',true);
                        $this->session->set_flashdata('msg', "Case Status updated successfully !!");
                    }
                    else{
                        $this->session->set_flashdata('error', "Something went wrong please try later !!");
                    }
                }else if ($this->input->post('post_type') == "cwas"){
                    $form_name['form_name'] = $this->input->post('caseworkAtSight');
                    $id = $this->input->post('id');
                    $updated = $this->case_report_model->update_caseworkAtSight($form_name,$id);
                    if($updated){
                        $this->session->set_flashdata('msg', "Casework At Sight updated successfully !!");
                    }
                    else{
                        $this->session->set_flashdata('error', "Something went wrong please try later !!");
                    }
                }
            }
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Case Report';
            $this->load->view('header', $data);
            // if($data['cr_report']->form_name == "short"){
                // $this->load->view('case_report/short-form', $data);
            // }
            // if($data['cr_report']->form_name == "long"){
                $this->load->view('case_report/view', $data);
            // }
            $this->load->view('user_footer');
        }
        else{
            return show_404();
        }

    }

    public function edit($id)
    {
        $error = false;
        if( can('edit-case_report') ) {
            $data=array();
            if ($this->input->post('submit')) {
                $data['title_en'] = $this->input->post('title_en');
                $data['price'] = $this->input->post('price');
                $data['req_registration'] = $this->input->post('entry');
                $data['event_type'] = $this->input->post('etype');
                $data['content_en'] = $this->input->post('content_en');
                $data['title_ar'] = $this->input->post('title_ar');
                $data['content_ar'] = $this->input->post('content_ar');
                $data['date'] = (!$this->input->post('date')) ? '' : date("Y-m-d", strtotime($this->input->post('date')));
                $data['status'] = 'Active';
                $data['event_for'] = $this->input->post('event_for');

                $data['venu'] = $this->input->post('venu');
                $data['venu_time'] = $this->input->post('venu_time');

                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('title_en', 'Title English', 'trim|required');
                //$this->form_validation->set_rules('price', 'Price', 'trim|required');
                $this->form_validation->set_rules('req_registration', 'Total Entries', 'trim|required');
                $this->form_validation->set_rules('event_type', 'Event Type', 'trim|required');
                $this->form_validation->set_rules('content_en', 'Content English', 'trim|required');
                $this->form_validation->set_rules('title_ar', 'Title Arabic', 'trim|required');
                $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('content_ar', 'Content Arabic', 'trim|required');
                $this->form_validation->set_rules('event_for', 'Event for', 'trim|required');

                $this->form_validation->set_rules('venu', 'Event Venue', 'trim|required');
                $this->form_validation->set_rules('venu_time', 'Event Time', 'trim|required');

                if (($this->form_validation->run() == true)) {
                    if (!empty($_FILES['event_pic']['name'])) {
                        $config['upload_path'] = 'uploads/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2000;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;
                        $config['file_name'] = $_FILES['event_pic']['name'];

                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('event_pic')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                            $url = base_url();
                            $data['event_pic'] = $url . 'uploads/' . $picture;
                        } else {
                            $error = true;
                            $this->session->set_flashdata('error_pic', $this->upload->display_errors());
                            //$picture = '';
                            //print_r($error); exit;
                        }
                    } else {
                        $error = true;
                        $this->session->set_flashdata('error_pic', "This field is required");
                    }
                    if(!$error){
                        $this->event_model->update_entry($data, $id);
                        $this->session->set_flashdata('msg', "Event has been updated successfully");
                        $base_url = base_url();
                        redirect("$base_url" . "event/allevent");
                    }

                }
                else{

                }

            }
            $data['event'] = $this->event_model->get($id);
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('editevent', $data);
            $this->load->view('user_footer');
            //echo '<pre>'; print_r($data); exit;
        }
        else{
            echo "Permission denied";
        }
    }

    public function delete($id)
    {
        if( can('delete-event') ) {
            $data=array();
            $this->event_model->delete_entry($id);
            $this->session->set_flashdata('msg', "Event has been deleted successfully");
            $data['eventlist'] = $this->event_model->get_entries();
            $data['site_title'] = 'Admin Dashboard'; //Title
            $data['page_title'] = 'Events';
            $this->load->view('header', $data);
            $this->load->view('eventlist', $data);
            $this->load->view('user_footer');
        }
        else{
            echo "Permission denied";
        }


    }



}