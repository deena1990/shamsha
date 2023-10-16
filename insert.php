<?php 
$con = mysqli_connect("localhost","saygaug_wcciapp","*OvYMBcWrW1u","saygaug_wcci_application");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

    $volunteer = $_POST['volunteer'];
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $new_caller_r_client = $_POST['new_caller_r_client'];
    $repeat_client_r_admin_inquiry = $_POST['repeat_client_r_admin_inquiry'];
    $caller_name = $_POST['caller_name'];
    $caller_phone_num = $_POST['caller_phone_num'];
    $why_she_call = $_POST['why_she_call'];
    $further_details = $_POST['further_details'];
    $name_of_caller = $_POST['name_of_caller'];
    $desc_interaction = $_POST['desc_interaction'];
    $how_call_follow_up = $_POST['how_call_follow_up'];
    $shift_u_on = $_POST['shift_u_on'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $client_first_name = $_POST['client_first_name'];
    $client_last_name = $_POST['client_last_name'];
    $client_phone_num = $_POST['client_phone_num'];
    $client_country = $_POST['client_country'];
    $client_country_other = $_POST['client_country_other'];
    $type_of_call = $_POST['type_of_call'];
    $type_of_call_other = $_POST['type_of_call_other'];
    $how_long_interaction = $_POST['how_long_interaction'];
    $how_long_interaction1 = implode(',',$how_long_interaction);
    $how_long_interaction_others = $_POST['how_long_interaction_others'];
    $did_case_req_payment = $_POST['did_case_req_payment'];
    $service_r_item_paid_for = $_POST['service_r_item_paid_for'];
    $service_r_item_paid_for1 = implode(',',$service_r_item_paid_for);
    $service_r_item_paid_for_others = $_POST['service_r_item_paid_for_others'];
    $reimbursed = $_POST['reimbursed'];
    $your_role_in_shamsaha = $_POST['your_role_in_shamsaha'];
    $your_role_in_shamsaha1 = implode(',',$your_role_in_shamsaha);
    $expense_n_purpose = $_POST['expense_n_purpose'];
    $amount_of_expense = $_POST['amount_of_expense'];
    $do_u_have_receipt = $_POST['do_u_have_receipt'];
    $benifit_r_by_cash = $_POST['benifit_r_by_cash'];
    $complete_address = $_POST['complete_address'];
    $abuse_she_face = $_POST['abuse_she_face'];
    $abuse_she_face_other = $_POST['abuse_she_face_other'];
    $interaction_for = $_POST['interaction_for'];
    $interaction_for_other = $_POST['interaction_for_other'];
    $relationship_of_perpet_to_victim = $_POST['relationship_of_perpet_to_victim'];
    $relationship_of_perpet_to_victim_other = $_POST['relationship_of_perpet_to_victim_other'];
    $first_time_r_repeat_violence = $_POST['first_time_r_repeat_violence'];
    $summary_of_case_n_reason = $_POST['summary_of_case_n_reason'];
    $client_follow_up = $_POST['client_follow_up'];
    $is_it_safe_to_cal_back = $_POST['is_it_safe_to_cal_back'];
    $client_info_abt_ofc_hrs = $_POST['client_info_abt_ofc_hrs'];
    $any_sign_of_suicide_r_harm = $_POST['any_sign_of_suicide_r_harm'];
    $discuss_r_safe_plan = $_POST['discuss_r_safe_plan'];
    $any_referrals = $_POST['any_referrals'];
    $client_ethnicity = $_POST['client_ethnicity'];
    $client_ethnicity_other = $_POST['client_ethnicity_other'];
    $client_age = $_POST['client_age'];
    $marital_status = $_POST['marital_status'];
    $marital_status_other = $_POST['marital_status_other'];
    $client_have_children = $_POST['client_have_children'];
    $client_employed = $_POST['client_employed'];
    $what_she_do = $_POST['what_she_do'];
    $recomment_care = $_POST['recomment_care'];
    $recomment_care1 = implode(',',$recomment_care);
    $recomment_care_other = $_POST['recomment_care_other'];
    $perpetrator_access_to_gun = $_POST['perpetrator_access_to_gun'];
    $violence_towards_victim = $_POST['violence_towards_victim'];
    $perpetrator_mem_of_police = $_POST['perpetrator_mem_of_police'];
    $victim_in_danger = $_POST['victim_in_danger'];
    $any_advance_r_serious_injury = $_POST['any_advance_r_serious_injury'];
    $final_notes_n_thought_abt_client = $_POST['final_notes_n_thought_abt_client'];
    $feeling_interaction_with_client = $_POST['feeling_interaction_with_client'];
    $good_r_bad_abt_shift = $_POST['good_r_bad_abt_shift'];
    
  $sql =  mysqli_query($con,"INSERT INTO `wc_cr_report`(`volunteer`, `fullname`, `mobile`, `new_caller_r_client`, `repeat_client_r_admin_inquiry`, `caller_name`,
 `caller_phone_num`, `why_she_call`, `further_details`, `name_of_caller`, `desc_interaction`, `how_call_follow_up`, `shift_u_on`, `date`, 
 `time`, `client_first_name`, `client_last_name`, `client_phone_num`, `client_country`, `client_country_other`, `type_of_call`, 
 `type_of_call_other`, `how_long_interaction`, `how_long_interaction_others`, `did_case_req_payment`, `service_r_item_paid_for`, 
 `service_r_item_paid_for_others`, `reimbursed`, `your_role_in_shamsaha`, `expense_n_purpose`, `amount_of_expense`, `do_u_have_receipt`, 
 `benifit_r_by_cash`, `complete_address`, `abuse_she_face`, `abuse_she_face_other`, `interaction_for`, `interaction_for_other`, 
 `relationship_of_perpet_to_victim`, `relationship_of_perpet_to_victim_other`, `first_time_r_repeat_violence`, `summary_of_case_n_reason`, 
 `client_follow_up`, `is_it_safe_to_cal_back`, `client_info_abt_ofc_hrs`, `any_sign_of_suicide_r_harm`, `discuss_r_safe_plan`, `any_referrals`, 
 `client_ethnicity`, `client_ethnicity_other`, `client_age`, `marital_status`, `marital_status_other`, `client_have_children`, `client_employed`, 
 `what_she_do`, `recomment_care`, `recomment_care_other`, `perpetrator_access_to_gun`, `violence_towards_victim`, `perpetrator_mem_of_police`, 
 `victim_in_danger`, `any_advance_r_serious_injury`, `final_notes_n_thought_abt_client`, `feeling_interaction_with_client`, `good_r_bad_abt_shift`) 
 VALUES ('volunteer','fullname','mobile','new_caller_r_client','repeat_client_r_admin_inquiry','caller_name','caller_phone_num',
 'why_she_call','further_details','name_of_caller','desc_interaction','how_call_follow_up','shift_u_on','date',
 'time','client_first_name','client_last_name','client_phone_num','client_country','client_country_other','type_of_call',
 'type_of_call_other','how_long_interaction','how_long_interaction_others','did_case_req_payment','service_r_item_paid_for',
 'service_r_item_paid_for_others','reimbursed','your_role_in_shamsaha','expense_n_purpose','amount_of_expense','do_u_have_receipt',
 'benifit_r_by_cash','complete_address','abuse_she_face','abuse_she_face_other','interaction_for','interaction_for_other',
 'relationship_of_perpet_to_victim','relationship_of_perpet_to_victim_other','first_time_r_repeat_violence','summary_of_case_n_reason',
 'client_follow_up','is_it_safe_to_cal_back','client_info_abt_ofc_hrs','any_sign_of_suicide_r_harm','discuss_r_safe_plan','any_referrals',
 'client_ethnicity','client_ethnicity_other','client_age','marital_status','marital_status_other','client_have_children','client_employed',
 'what_she_do','recomment_care','recomment_care_other','perpetrator_access_to_gun','violence_towards_victim','perpetrator_mem_of_police',
 'victim_in_danger','any_advance_r_serious_injury','final_notes_n_thought_abt_client','feeling_interaction_with_client','good_r_bad_abt_shift')");
 
 if($sql){
     echo "<script>alert('Success')</script>";
 }else{
     echo "<script>alert('fail')</script>";
 }
    
     ?>