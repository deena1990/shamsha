<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #ffffff;
        overflow-x: hidden;
    }

    h1 {
        text-align: center;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
        padding: 20px;
    }

    button {
        background-color: #fa518d;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #fa518d;
    }
    .hide {
        display: none;
    }p.answerQuest {
        border: 1px solid #000;
        padding: 10px 20px;
        border-radius: 20px;
        margin: 10px 0px;
    }
</style>
<body>
<div class="container text-center">
    <h3> <strong>Case Report Details</strong> </h3>
    <div class="form-group">
        <label class="questionLabel">What is your name ? </label>
        <p class="answerQuest"><?= $case_details->fullname ?></p>
    </div>
    <div class="form-group">
        <label class="questionLabel">What is your phone number ? </label>
        <div class="row">
            <div class="col-md-3">
                <label for="date">Country Code</label>
                <p class="answerQuest"><?= explode(':::',$case_details->mobile)[0] ?></p>
            </div>
            <div class="col-md-9">
                <label for="date">Phone Number</label>
                <p class="answerQuest"><?= explode(':::',$case_details->mobile)[1] ?></p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="questionLabel">What is your country of location ? </label>
        <p class="answerQuest"><?= $case_details->recomment_care ?></p>
    </div>
    <div class="form-group">
        <label class="questionLabel">At what date and time did you receive the interaction? </label>
        <div class="row">
            <div class="col-md-6">
                <label for="date">Date</label>
                <p class="answerQuest"><?= date('d-m-Y',strtotime($case_details->date)) ?></p>
            </div>
            <div class="col-md-6">
                <label for="time">Time</label>
                <p class="answerQuest"><?= $case_details->time ?></p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="questionLabel">Which country was the client contacting us from ? </label>
        <p class="answerQuest"><?= $case_details->client_country ?></p>
    </div>
    <?php if($case_details->client_country == "Bahrain"){ ?>
    <div class="form-group">
        <label class="questionLabel"> Did the caller request immediate in-person support from the Shamsaha casework team? </label>
        <p class="answerQuest"><?= $case_details->new_caller_r_client ?></p>
    </div>
    <?php if($case_details->new_caller_r_client == "Yes"){ ?>
    <div class="form-group">
        <label class="questionLabel"> Did you communicate this immediately to the case work team in Bahrain? </label>
        <p class="answerQuest"><?= $case_details->why_she_call ?></p>
    </div>
    <div class="form-group">
        <label class="questionLabel"> Did you explain the process (including working hours) to the caller - indicating that the casework team would call her back within 30-60 minutes? </label>
        <p class="answerQuest"><?= $case_details->name_of_caller ?></p>
    </div>
    <div class="form-group">
        <label class="questionLabel"> What specifically is the caller requesting? </label>
        <p class="answerQuest"><?= $case_details->desc_interaction ?></p>
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> Did the caller request ongoing case work support ? </label>
        <p class="answerQuest"><?= $case_details->how_call_follow_up ?></p>
    </div>
    <?php if($case_details->how_call_follow_up == "Yes"){ ?>
    <div class="form-group">
        <label class="questionLabel"> Did you explain the process (including working hour) to the caller - indicating that the casework team would call her back within 3 days ? </label>
        <p class="answerQuest"><?= $case_details->shift_u_on ?></p>
    </div>
    <div class="form-group">
        <label class="questionLabel"> With what issues is she requesting support ? </label>
        <p class="answerQuest"><?= $case_details->client_last_name ?></p>
    </div>
    <?php } ?>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel">What was the client’s name ? </label>
        <p class="answerQuest"><?= $case_details->client_first_name ?></p>
    </div>
    <div class="form-group">
        <label class="questionLabel"> What was the client’s phone number ? </label>
        <div class="row">
            <div class="col-md-3">
                <label for="date">Country Code</label>
                <p class="answerQuest"><?= explode(':::',$case_details->client_phone_num)[0] ?></p>
            </div>
            <div class="col-md-9">
                <label for="date">Phone Number</label>
                <p class="answerQuest"><?= explode(':::',$case_details->client_phone_num)[1] ?></p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="questionLabel"> What type of interaction was this ? </label>
        <p class="answerQuest"><?= $case_details->type_of_call ?></p>
        <?php if(in_array("Other", explode(':::',$case_details->type_of_call))){ ?> 
        <p class="answerQuest"><?= $case_details->type_of_call_other ?></p>          
        <?php } ?>
    </div>
    <div class="form-group">
        <label class="questionLabel"> How long was the interaction ? </label>
        <p class="answerQuest"><?= $case_details->how_long_interaction ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> About what issue was the client contacting Shamsaha ? </label>
        <p class="answerQuest"><?= $case_details->repeat_client_r_admin_inquiry ?></p>          
    </div>
    <?php if ($case_details->repeat_client_r_admin_inquiry == "The client was a victim of any form of gender-based abuse or violence (Such as domestic violence, sexual violence, or intimate partner violence)"){ ?>
    <div class="form-group">
        <label class="questionLabel"> What type of abuse is she facing ? </label>
        <p class="answerQuest"><?= $case_details->abuse_she_face ?></p>          
    </div>
    <?php if($case_details->abuse_she_face != "" && ( $case_details->abuse_she_face == "Sexual violence from family" || $case_details->abuse_she_face == "Sexual violence from intimate partner" || $case_details->abuse_she_face == "Sexual violence acquaintance (not intimate partner)" || $case_details->abuse_she_face == "Sexual violence from employer" || $case_details->abuse_she_face == "Sexual violence stranger")){ ?> 
    <div class="form-group">
    <label class="questionLabel"> Was any form of penetration made ? </label>
        <p class="answerQuest"><?= $case_details->penetration_made ?></p>          
        <?php if(in_array("Other", explode(':::',$case_details->penetration_made))){ ?> 
        <p class="answerQuest"><?= $case_details->penetration_made_other ?></p>          
        <?php } ?> 
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel">What was the relationship of the perpetrator to the victim ? </label><br>
        <p class="answerQuest"><?= $case_details->relationship_of_perpet_to_victim ?></p>          
        <?php if($case_details->relationship_of_perpet_to_victim == "Other"){ ?>
        <p class="answerQuest"><?= $case_details->relationship_of_perpet_to_victim_other ?></p>          
        <?php } ?> 
    </div>
    <div class="form-group">
        <label class="questionLabel"> Was this interaction for the caller or somebody else ? </label>
        <p class="answerQuest"><?= $case_details->interaction_for ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> Did the client answer indicate yes to any of the Urgency Assessment Questions during the client interaction ? </label>
        <p class="answerQuest"><?= $case_details->client_country_other ?></p>          
    </div>
    <?php if($case_details->client_country_other == "Yes"){ ?>
    <div class="form-group">
        <label class="questionLabel"> Which question did the client respond yes to during the Urgency Assessment ? </label>
        <p class="answerQuest">
            <?php 
                $data = explode(' ::: ',$case_details->how_long_interaction_others); 
                foreach ($data as $key => $value) {
                    echo "- ".$value."<br>";
                } 
            ?>
        </p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> What steps were taken in response to the Urgency Assessment? </label>
        <p class="answerQuest"><?= $case_details->did_case_req_payment ?></p>          
    </div>
    <?php } ?>
    <?php if($case_details->service_r_item_paid_for){ ?>
    <div class="form-group">
        <label class="questionLabel"> What was discovered during the risk analysis? </label>
        <p class="answerQuest"><?= $case_details->service_r_item_paid_for ?></p>          
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> Was a safety plan completed for any reason? </label>
        <p class="answerQuest"><?= $case_details->service_r_item_paid_for_others ?></p>          
    </div>
    <?php if($case_details->service_r_item_paid_for_others == "Yes"){ ?>
    <div class="form-group">
        <label class="questionLabel"> What were the details and/or outcomes of the safety planning? </label>
        <p class="answerQuest"><?= $case_details->reimbursed ?></p>          
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> Is this the first time, or repeat violence or abuse?  </label>
        <p class="answerQuest"><?= $case_details->first_time_r_repeat_violence ?></p>          
    </div>
    <?php if($case_details->first_time_r_repeat_violence == "Repeat violence"){ ?>
        <div class="form-group">
            <label class="questionLabel"> When was the last incident of abuse? </label>
            <p class="answerQuest"><?= $case_details->your_role_in_shamsaha ?></p>          
        </div>
        <div class="form-group">
            <label class="questionLabel"> What were the circumstances? </label>
            <p class="answerQuest"><?= $case_details->expense_n_purpose ?></p>          
        </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> Overall, describe the interaction you had with the client. Please elaborate as much as possible here. </label>
        <p class="answerQuest"><?= $case_details->summary_of_case_n_reason ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> Does this client want to be put on the service list? </label>
        <p class="answerQuest"><?= $case_details->amount_of_expense ?></p>          
    </div>
    <?php if($case_details->amount_of_expense == "Yes"){ ?>
    <div class="form-group">
        <label class="questionLabel"> What type of service are they interested in? </label>
        <p class="answerQuest"><?= $case_details->do_u_have_receipt ?></p>          
    </div>
    <?php if($case_details->benifit_r_by_cash){ ?>
    <div class="form-group">
        <label class="questionLabel"> What were the circumstances of their request? </label>
        <p class="answerQuest"><?= $case_details->benifit_r_by_cash ?></p>          
    </div>
    <?php } ?>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> Is it safe for Shamsaha to call or contact her back? </label>
        <p class="answerQuest"><?= $case_details->is_it_safe_to_cal_back ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> How did you get the client’s phone number? </label>
        <p class="answerQuest"><?= $case_details->client_info_abt_ofc_hrs ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> Did the client display any signs of being suicidal or at risk of harming themselves or others? </label>
        <p class="answerQuest"><?= $case_details->any_sign_of_suicide_r_harm ?></p>          
        <?php if($case_details->any_sign_of_suicide_r_harm == "Provide further details if relevant"){ ?>
        <p class="answerQuest"><?= $case_details->further_details ?></p>          
        <?php } ?>
    </div>
    <div class="form-group">
        <label class="questionLabel"> Did you provide any publicly available resources to the client or details about Shamsaha’s operational partners in the relevant country? </label>
        <p class="answerQuest">
            <?php 
                $data = explode(' ::: ',$case_details->abuse_she_face_other); 
                foreach ($data as $key => $value) {
                    echo $value."<br>";
                } 
            ?>
        </p>         
    </div>
    <div class="form-group">
        <label class="questionLabel"> What is the ethnicity of the client? </label>
        <p class="answerQuest"><?= explode(" => ",$case_details->client_ethnicity)[0] ?></p>          
        <?php if(explode(" => ",$case_details->client_ethnicity)[0] == "Other"){ ?>
        <p class="answerQuest"><?= explode(" => ",$case_details->client_ethnicity)[1] ?></p>          
        <?php } ?>
    </div>
    <?php if($case_details->complete_address){ ?>
    <div class="form-group">
        <label class="questionLabel"> Which city/ area is the client contacting you from? </label>
        <p class="answerQuest"><?= $case_details->complete_address ?></p>          
    </div>
    <?php } if($case_details->client_age){ ?>
    <div class="form-group">
        <label class="questionLabel"> What is the client’s age? </label>
        <p class="answerQuest"><?= $case_details->client_age ?></p>          
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> What is the client’s marital status? </label>
        <p class="answerQuest"><?= $case_details->marital_status ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> Does the client have children? </label>
        <p class="answerQuest"><?= $case_details->client_have_children ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> Is the client employed? </label>
        <p class="answerQuest"><?= $case_details->client_employed ?></p>          
    </div>
    <div class="form-group">
        <label class="questionLabel"> In what language would the client prefer to communicate? </label>
        <p class="answerQuest"><?= $case_details->interaction_for_other ?></p>          
    </div>
    <?php if($case_details->hear_about_shamsaha){ ?>
    <div class="form-group">
        <label class="questionLabel"> How did she hear about Shamsaha? </label>
        <p class="answerQuest"><?= $case_details->hear_about_shamsaha ?></p>
    </div>
    <?php } if($case_details->final_notes_n_thought_abt_client){ ?>
    <div class="form-group">
        <label class="questionLabel"> Do you have any final notes regarding this client and/or the interaction? </label>
        <p class="answerQuest"><?= $case_details->final_notes_n_thought_abt_client ?></p>
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="questionLabel"> How were you feeling during and after the interaction? </label>
        <p class="answerQuest"><?= $case_details->feeling_interaction_with_client ?></p>
    </div>
    <?php if($case_details->good_r_bad_abt_shift){ ?>
    <div class="form-group">
        <label class="questionLabel"> Did you face any issues with the App? </label>
        <p class="answerQuest"><?= $case_details->good_r_bad_abt_shift ?></p>
    </div>
    <?php } if($case_details->like_to_do_next){ ?>
    <div class="form-group">
        <label class="questionLabel"> يمكنك إضافة أي ملاحظات أخرى باللغة العربية إذا كانت هناك المزيد معلومات تريدين توضيحها أكثر  </label>
        <p class="answerQuest"><?= $case_details->like_to_do_next ?></p>
    </div>
    <?php }}else{ ?>
    <?php if($case_details->perpetrator_access_to_gun){ ?>
    <div class="form-group">
        <label class="questionLabel"> What type of interaction was this? </label>
        <p class="answerQuest"><?= $case_details->perpetrator_access_to_gun ?></p>
        <?php if($case_details->perpetrator_access_to_gun == "Other"){ ?> 
        <label class="container2">Other
            <input type="checkbox" name="what_type_of_interaction_was_this[]" id="what_type_of_interaction_was_this_other" class="section3" value="Other"><span class="checkmark2"></span>
        </label>
        <!-- <input type="text" class="form-control hide" name="what_type_of_interaction_was_this_other_text" placeholder="type short answer here"> -->
        <p class="answerQuest"><?= $case_details->perpetrator_access_to_gun ?></p>
        <?php } ?>
    </div>
    <?php } if($case_details->recomment_care_other){ ?>
    <div class="form-group">
        <label class="questionLabel">Please detail the interaction? </label>
        <p class="answerQuest"><?= $case_details->recomment_care_other ?></p>
    </div>
    <?php } if($case_details->violence_towards_victim){ ?>
    <div class="form-group">
        <label class="questionLabel">Did you provide any additional information or details during this interaction? </label>                    
        <p class="answerQuest"><?= $case_details->violence_towards_victim ?></p>
    </div>
    <?php } if($case_details->perpetrator_mem_of_police){ ?>
    <div class="form-group">
        <label class="questionLabel">يمكنك إضافة أي ملاحظات أخرى باللغة العربية إذا كانت هناك المزيد معلومات تريدين توضيحها أكثر </label>
        <p class="answerQuest"><?= $case_details->perpetrator_mem_of_police ?></p>
    </div>
    <?php }} ?>
</div>

<?php
// $full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$full_url1 = base_url().'case_report/save_case_report_form';
?>

<script>
    function what_ethnicity_of_client_function(){
        var value = $("select[name='what_ethnicity_of_client']").val();
        if (value == 'Other') {
            $("input[name='what_ethnicity_of_client_other_text']").addClass('required');
            $("input[name='what_ethnicity_of_client_other_text']").css('display','block');  
        }else{
            $("input[name='what_ethnicity_of_client_other_text']").removeClass('required');
            $("input[name='what_ethnicity_of_client_other_text']").css('display','none');
            $("input[name='what_ethnicity_of_client_other_text']").val('');
        }
    }
    function countryClientFunction(){
        var countryClient = $('#countryClient').val();
        if (countryClient == "Bahrain"){
            $('.countryBahrain').css('display','block');
            $('.add_Class').addClass('required');
        }else{
            $('.countryBahrain').css('display','none');
            $('.add_Class').removeClass('required');
        }
    }
    function what_client_issue(){
        var about_what_issue_was_client = $('#about_what_issue_was_client').val();
        if (about_what_issue_was_client == "The interaction was an administrative inquiry, spam, other, or failed interaction"){
            $('.sec3').removeClass('hide');
            $('.sect3').removeClass('hide');
            $('.sec3').addClass('tab');
            $('.sect3').addClass('step');
            $('.section3').addClass('required');
            $('.administrative').removeClass('tab');
            $('.administration').removeClass('step');
            $('.administrative').css('display','none');
            $('.administration').css('display','none');
            $('.administrate').removeClass('required');
        }else{
            $('.sec3').addClass('hide');
            $('.sect3').addClass('hide');
            $('.sec3').removeClass('tab');
            $('.sect3').removeClass('step');
            $('.section3').removeClass('required');
            $('.administrative').addClass('tab');
            $('.administration').addClass('step');
            $('.administration').css('display','inline-block');
            $('.administrate').addClass('required');
        }
    }
    function urgency_quest_yes(){
        var yes_to_any_urgency_quest = $('#yes_to_any_urgency_quest').val();
        if (yes_to_any_urgency_quest == "No"){
            $('.urgency_quest_yes').addClass('hide');
            $('.urgency_quest').removeClass('required');
        }else{
            $('.urgency_quest_yes').removeClass('hide');
            $('.urgency_quest').addClass('required');
        }
    }
    function safety_plan_completed(){
        var was_a_safety_plan_completed_for_any_reason = $('#was_a_safety_plan_completed_for_any_reason').val();
        if (was_a_safety_plan_completed_for_any_reason == "No"){
            $('.safety_plan_completed').addClass('hide');
            $('.safety_plan').removeClass('required');
        }else{
            $('.safety_plan_completed').removeClass('hide');
            $('.safety_plan').addClass('required');
        }
    }
    function first_time_r_repeat(){
        var is_this_first_time_r_repeat_violence = $('#is_this_first_time_r_repeat_violence').val();
        if (is_this_first_time_r_repeat_violence != "Repeat violence"){
            $('.first_time_r_repeat').addClass('hide');
            $('.first_r_repeat').removeClass('required');
        }else{
            $('.first_time_r_repeat').removeClass('hide');
            $('.first_r_repeat').addClass('required');
        }
    }
    function client_want_put_on_service_list(){
        var does_client_want_put_on_service_list = $('#does_client_want_put_on_service_list').val();
        if (does_client_want_put_on_service_list == "No"){
            $('.client_want_put_on_service_list').addClass('hide');
            $('.client_on_service_list').removeClass('required');
        }else{
            $('.client_want_put_on_service_list').removeClass('hide');
            $('.client_on_service_list').addClass('required');
        }
    }
    function client_display_any_signs(){
        var did_client_display_any_signs = $('#did_client_display_any_signs').val();
        if (did_client_display_any_signs != "Provide further details if relevant"){
            $('.client_display_any_signs').addClass('hide');
            $('.client_display_any_signs').removeClass('required');
        }else{
            $('.client_display_any_signs').removeClass('hide');
            $('.client_display_any_signs').addClass('required');
        }
    }
    function inpersonSupport_condition(){
        var inpersonSupport = $('#inpersonSupport').val();
        if (inpersonSupport == "No"){
            $('.inpersonSupport_condition').addClass('hide');
            $('.support_condition').removeClass('required');
        }else{
            $('.inpersonSupport_condition').removeClass('hide');
            $('.support_condition').addClass('required');
        }
    }
    function OngoingCaseWorkSupport_condition(){
        var callerRequestOngoingCaseWorkSupport = $('#callerRequestOngoingCaseWorkSupport').val();
        if (callerRequestOngoingCaseWorkSupport == "No"){
            $('.OngoingCaseWorkSupport_condition').addClass('hide');
            $('.OngoingCaseWorkSupport').removeClass('required');
        }else{
            $('.OngoingCaseWorkSupport_condition').removeClass('hide');
            $('.OngoingCaseWorkSupport').addClass('required');
        }
    }
    function showInputBox(){
        if($("#type_of_interaction_was_other").is(":checked")){
            $("input[name='type_of_interaction_was_other_text']").addClass('required');
            $("input[name='type_of_interaction_was_other_text']").css('display','block');  
        }else{
            $("input[name='type_of_interaction_was_other_text']").removeClass('required');
            $("input[name='type_of_interaction_was_other_text']").css('display','none');
            $("input[name='type_of_interaction_was_other_text']").val('');
        }
    }
    function showInputBox1(){
        if($("#was_any_penetration_made_other").is(":checked")){
            $("input[name='was_any_penetration_made_other_text']").addClass('required');
            $("input[name='was_any_penetration_made_other_text']").css('display','block');  
        }else{
            $("input[name='was_any_penetration_made_other_text']").removeClass('required');
            $("input[name='was_any_penetration_made_other_text']").css('display','none');
            $("input[name='was_any_penetration_made_other_text']").val('');
        }
    }
    function showInputBox2(){
        if($("#how_did_she_hear_about_Shamsaha_other").is(":checked")){
            $("input[name='how_did_she_hear_about_Shamsaha_other_text']").removeClass('hide');
            $("input[name='how_did_she_hear_about_Shamsaha_other_text']").addClass('required');  
        }else{
            $("input[name='how_did_she_hear_about_Shamsaha_other_text']").addClass('hide');  
            $("input[name='how_did_she_hear_about_Shamsaha_other_text']").removeClass('required');
            $("input[name='how_did_she_hear_about_Shamsaha_other_text']").val('');
        }
    }
    function showInputBox3(){
        if($("#what_type_of_interaction_was_this_other").is(":checked")){
            $("input[name='what_type_of_interaction_was_this_other_text']").removeClass('hide');
            $("input[name='what_type_of_interaction_was_this_other_text']").addClass('required');  
        }else{
            $("input[name='what_type_of_interaction_was_this_other_text']").addClass('hide');  
            $("input[name='what_type_of_interaction_was_this_other_text']").removeClass('required');
            $("input[name='what_type_of_interaction_was_this_other_text']").val('');
        }
    }
    $("input[name='what_relation_of_perpetrator_to_victim']").change(function () {
        if ($("input[name='what_relation_of_perpetrator_to_victim']:checked")) {
            var value = $("input[name='what_relation_of_perpetrator_to_victim']:checked").val();
            if (value == 'Other') {
                $("input[name='what_relation_of_perpetrator_to_victim_other_text']").addClass('required');
                $("input[name='what_relation_of_perpetrator_to_victim_other_text']").css('display','block');  
            }else{
                $("input[name='what_relation_of_perpetrator_to_victim_other_text']").removeClass('required');
                $("input[name='what_relation_of_perpetrator_to_victim_other_text']").css('display','none');
                $("input[name='what_relation_of_perpetrator_to_victim_other_text']").val('');
            }
        }
    });
    $("input[name='what_type_of_abuse_she_facing[]']").change(function () {
        if($("input[name='what_type_of_abuse_she_facing[]']:checked").length == 0){
            $('.form_of_penetration').addClass('hide'); 
            $('.condition').removeClass('required');
        }else{
            if ($("input[name='what_type_of_abuse_she_facing[]']:checked")){
                $("input[name='what_type_of_abuse_she_facing[]']:checked").each(function () {
                    if($(this).val() == "Sexual violence from family" || $(this).val() == "Sexual violence from intimate partner" || $(this).val() == "Sexual violence acquaintance (not intimate partner)" || $(this).val() == "Sexual violence from employer" || $(this).val() == "Sexual violence stranger"){
                        // alert($(this).val());
                        $('.form_of_penetration').removeClass('hide');
                        $('.condition').addClass('required');
                    }else{
                        $('.form_of_penetration').addClass('hide'); 
                        $('.condition').removeClass('required');
                    }
                });
            }
        }
    });
</script>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        x[n].scrollIntoView();
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            $("#submitBtn").prop('disabled', false);
            $('#submitBtn').show();
            $('#nextBtn').hide();
        } else {
            $('#submitBtn').hide();
            $('#nextBtn').show();

        }
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {
            return false;
        }
        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].querySelectorAll("div.validationReq .required");

        for (i = 0; i < y.length; i++) {
            var value = y[i].value;
            if (y[i].type == "radio") {
                var value = $('input[name=' + y[i].name + ']:checked').val();
            }
            if (y[i].type == "checkbox") {
                var value = $('input[name="' + y[i].name + '"]:checked').map(function () {
                    return this.value;
                }).get().join(",");
            }
            // If a field is empty...
            if (value == "" || value === undefined) {
                y[i].className += " invalid";
                $('input[name="' + y[i].name + '"]').closest('.form-group').addClass('errorContainer')
                var er = document.querySelector('.errorContainer .questionLabel');
                er.scrollIntoView();
                valid = false;
            } else {
                y[i].classList.remove('invalid');
                $('input[name="' + y[i].name + '"]').closest('.form-group').removeClass('errorContainer')
            }

        }
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        document.getElementsByClassName("step")[currentTab].className += " finish";
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
    }

    $(function () {
        $(document).on('click','#submitBtn', function (e) {
            e.preventDefault();
             if (!validateForm()) return false;
            $("#submitBtn").prop('disabled', true);
            $.ajax({
                type: 'post',
                url: '<?= $full_url1 ?>',
                dataType: 'json',
                data: $('form').serialize(),
                success: function (data) {
                    console.log(data);
                    $("#submitBtn").prop('disabled', false);
                    if(data.status == "success"){
                        window.location.href = '<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>'+'&success=true';
                        
						try {
							window.webkit.messageHandlers.successfulReport.postMessage(true);
						} catch(err) {
							console.log('error');
							console.log(err);
						} 
						try {
							Android.successfulReport(true);
						} catch(err) {
							console.log('error');
							console.log(err);
						} 
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });

        });

    });
</script>

<style>


    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */

    .container2:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */

    .container2 input:checked ~ .checkmark {
        background-color: #fa518d;
    }

    /* Create the checkmark/indicator (hidden when not checked) */

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */

    .container2 input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */

    .container2 .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .container2 {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */

    .container2 input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */

    .checkmark2 {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */

    .container2:hover input ~ .checkmark2 {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */

    .container2 input:checked ~ .checkmark2 {
        background-color: #fa518d;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */

    .checkmark2:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */

    .container2 input:checked ~ .checkmark2:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */

    .container2 .checkmark2:after {
        top: 6px;
        left: 6.5px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
        text-align: center;
        margin: 0 auto;
    }

    .error {
        color: red;
    }

    .errorContainer .questionLabel {
        color: red;
    }
</style>

</body>
</html>
