<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Case Report Form</title>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel='shortcut icon' type='<?php echo base_url(); ?>public/image/x-icon' href='images/favicon.ico' />
<link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet">
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
    }.card {
        padding: 20px;
        margin: 10px 0 20px 0;
        background-color: rgba(255, 255, 255, 1);
        border-top-width: 0;
        border-bottom-width: 2px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 12px;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(97,97,97,0.75);
        -moz-box-shadow: 0px 0px 5px 0px rgba(97,97,97,0.75);
        box-shadow: 0px 0px 5px 0px rgba(97,97,97,0.75);
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        margin: 100px 20px;
        /* width:100%; */
    }
    .success-fa{
        text-align: center;
        display: block;
        font-size: 70px;
        color: #e34587;
    }
    .card h4{
        text-align: center;
        margin-top : 0;
        font-size: 24px;
        font-weight: 600;
    }

</style>
<body>
<?php if($_GET['success'] == "true"){  ?>
<div class="card">
    <h3 class="text-center"> <strong>Case Report Form</strong> </h3>
    <span class="success-fa"><i class="fa fa-check-circle"></i></span>
    <h4>Form Submitted Successfully !!</h4>
</div>
<?php }else{  ?>
    <div class="container">
            <form id="regForm" method="post">
                <h3 class="text-center"> <strong>Case Report Form</strong> </h3>
                <input type="hidden" name="case_id" value="<?= $case_id ?>">
                <input type="hidden" name="volunteer" value="<?= $volunteer_id ?>">
                <div class="tab">
                    <div class="row validationReq" id="sec1">
                        <div class="form-group">
                            <label class="questionLabel">What is your name ? <span class="error">*</span> </label>
                            <input type="text" class="form-control required" name="name">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">What is your phone number ? <span
                                        class="error">*</span></label>
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
                                    <label for="date">Country Code  <span
                                        class="error">*</span></label>
                                    <select name="countryCode" class="form-control required">
                                        <?php foreach($phone_codes as $phone_code){ ?>
                                        <option value="<?= $phone_code->phonecode ?>"><?= $phone_code->phonecode ?> ( <?= $phone_code->nicename ?> ) </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-9 col-xs-6">
                                    <label for="date">Phone Number  <span
                                        class="error">*</span></label>
                                    <input type="number" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="12" class="form-control required" name="phoneNumber">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">What is your country of location ? <span
                                        class="error">*</span></label>
                            <select name="countryOfLocation" class="form-control required">
                                <?php foreach($phone_codes as $phone_code){ ?>
                                <option value="<?= $phone_code->nicename ?>"><?= $phone_code->nicename ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">At what date and time did you receive the interaction? <span
                                        class="error">*</span></label>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <label for="date">Date <span
                                        class="error">*</span></label>
                                    <input type="date" class="form-control required" name="date" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <label for="time">Time <span
                                        class="error">*</span></label>
                                    <input type="time" class="form-control required" name="time" value="<?php echo date('h:i'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">Which country was the client contacting us from ? <span
                                        class="error">*</span></label>
                            <select name="countryClient" id="countryClient" onchange="countryClientFunction();" class="form-control required">
                                <?php foreach($phone_codes as $phone_code){ ?>
                                <option value="<?= $phone_code->nicename ?>"><?= $phone_code->nicename ?></option>
                                <?php } ?>
                            </select> 
                        </div>
                        <div class="countryBahrain" style="display: none;">
                            <div class="form-group">
                                <label class="questionLabel"> Did the caller request immediate in-person support from the Shamsaha casework team? <span
                                            class="error">*</span></label>
                                <select name="inpersonSupport" onchange="inpersonSupport_condition();" id="inpersonSupport" class="form-control add_Class">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="inpersonSupport_condition">
                                <div class="form-group">
                                    <label class="questionLabel"> Did you communicate this immediately to the case work team in Bahrain? <span
                                                class="error">*</span></label>
                                    <select name="caseWorkTeam" class="form-control add_Class support_condition">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="questionLabel"> Did you explain the process (including working hours) to the caller - indicating that the casework team would call her back within 30-60 minutes? <span
                                                class="error">*</span></label>
                                    <select name="callback3060min" class="form-control add_Class support_condition">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="questionLabel"> What specifically is the caller requesting? <span class="error">*</span> </label>
                                    <input type="text" class="form-control add_Class support_condition" name="callerRequest">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="questionLabel"> Did the caller request ongoing case work support ? <span
                                            class="error">*</span></label>
                                <select name="callerRequestOngoingCaseWorkSupport" onchange="OngoingCaseWorkSupport_condition();" id="callerRequestOngoingCaseWorkSupport" class="form-control add_Class">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="OngoingCaseWorkSupport_condition">
                                <div class="form-group">
                                    <label class="questionLabel"> Did you explain the process (including working hour) to the caller - indicating that the casework team would call her back within 3 days ? <span
                                                class="error">*</span></label>
                                    <select name="callback3days" class="form-control add_Class OngoingCaseWorkSupport">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="questionLabel"> With what issues is she requesting support ? <span class="error">*</span> </label>
                                    <input type="text" class="form-control add_Class OngoingCaseWorkSupport" name="whatIssueReqSupprot">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">What was the client’s name ? <span class="error">*</span> </label>
                            <input type="text" class="form-control required" name="clientName">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What was the client’s phone number ? <span
                                        class="error">*</span></label>
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
                                    <label for="date">Country Code <span
                                        class="error">*</span></label>
                                    <select name="clientCountryCode" class="form-control required">
                                        <?php foreach($phone_codes as $phone_code){ ?>
                                        <option value="<?= $phone_code->phonecode ?>"><?= $phone_code->phonecode ?> ( <?= $phone_code->nicename ?> ) </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-9 col-xs-6">
                                    <label for="date">Phone Number <span
                                        class="error">*</span></label>
                                    <input type="number" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="12" class="form-control required" name="clientPhone">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What type of interaction was this ? <span class="error">*</span> </label>
                            <label class="container2">Audio call
                                <input type="checkbox" name="type_of_interaction_was[]" class="required" value="Audio call"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Video call
                                <input type="checkbox" name="type_of_interaction_was[]" class="required" value="Video call"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Text chat
                                <input type="checkbox" name="type_of_interaction_was[]" class="required" value="Text chat"><span class="checkmark2"></span>
                            </label>
                            <label class="container2" onclick="showInputBox();" >Other
                                <input type="checkbox" name="type_of_interaction_was[]" id="type_of_interaction_was_other" class="required" value="Other"><span class="checkmark2"></span>
                            </label>
                            <input type="text" class="form-control" name="type_of_interaction_was_other_text" placeholder="type short answer here" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> How long was the interaction ? <span
                                        class="error">*</span></label>
                            <select name="how_long_was_interaction" class="form-control required">
                                <option value="0 to 5 minutes">0 to 5 minutes</option>
                                <option value="6 to 30 minutes">6 to 30 minutes</option>
                                <option value="31 to 60 minutes">31 to 60 minutes</option>
                                <option value="More than 1 hour">More than 1 hour</option>
                                <option value="More than 2 hour">More than 2 hour</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> About what issue was the client contacting Shamsaha ? <span
                                        class="error">*</span></label>
                            <select name="about_what_issue_was_client" onchange="what_client_issue();" id="about_what_issue_was_client" class="form-control required">
                                <option value="The client was a victim of any form of gender-based abuse or violence (Such as domestic violence, sexual violence, or intimate partner violence)">The client was a victim of any form of gender-based abuse or violence (Such as domestic violence, sexual violence, or intimate partner violence)</option>
                                <option value="The interaction was an administrative inquiry, spam, other, or failed interaction">The interaction was an administrative inquiry, spam, other, or failed interaction</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <div class="administrative"> -->
                <div class="tab administrative">
                    <div id="normalSection">
                        <div class="row validationReq" id="normalSection1">
                            <div class="form-group">
                                <label class="questionLabel"> What type of abuse is she facing ? <span class="error">*</span> </label>
                                <label class="container2">Verbal violence from intimate partner
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Verbal violence from intimate partner"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Psychological/emotional abuse from intimate partner
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Psychological/emotional abuse from intimate partner"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Financial abuse from intimate partner
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Financial abuse from intimate partner"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Physical violence from intimate partner
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Physical violence from intimate partner"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Psychological/verbal/financial abuse from family 
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Psychological/verbal/financial abuse from family"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Sexual violence from family  
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Sexual violence from family"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Sexual violence from intimate partner 
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Sexual violence from intimate partner"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Sexual violence acquaintance (not intimate partner) 
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Sexual violence acquaintance (not intimate partner)"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Sexual violence from employer 
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Sexual violence from employer"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Sexual violence stranger 
                                    <input type="checkbox" name="what_type_of_abuse_she_facing[]" class="required administrate" value="Sexual violence stranger"><span class="checkmark2"></span>
                                </label>
                            </div>
                            <div class="form-group form_of_penetration hide">
                                <label class="questionLabel"> Was any form of penetration made ? <span class="error">*</span> </label>
                                <label class="container2">Vaginal
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Vaginal"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Anal
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Anal"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Penetration with penis 
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Penetration with penis"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Penetration with object
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Penetration with object"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Condom was used  
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Condom was used"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Condom was not used   
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Condom was not used "><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Don’t know if condom was used  
                                    <input type="checkbox" name="was_any_penetration_made[]" class=" condition" value="Don’t know if condom was used"><span class="checkmark2"></span>
                                </label>
                                <label class="container2" onclick="showInputBox1();">Other
                                    <input type="checkbox" name="was_any_penetration_made[]" id="was_any_penetration_made_other" class=" condition" value="Other"><span class="checkmark2"></span>
                                </label>
                                <input type="text" class="form-control" name="was_any_penetration_made_other_text" placeholder="type short answer here" style="display:none;">
                            </div>
                            <div class="form-group">
                                <label class="questionLabel">What was the relationship of the perpetrator to the victim ? <span class="error">*</span></label><br>
                                <label class="container2">Husband 
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Husband"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Boyfriend
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Boyfriend"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Ex-husband 
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Ex-husband"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Ex-boyfriend
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Ex-boyfriend"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Fiance
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Fiance"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Acquaintance (date) 
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Acquaintance (date)"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Family member 
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Family member"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Sponsor/ employer 
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Sponsor/ employer"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Stranger
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Stranger"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Unknown (You should not choose this option often)
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Unknown"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Not relevant 
                                    <input type="radio" class="required administrate" name="what_relation_of_perpetrator_to_victim" value="Not relevant"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Other
                                    <input type="radio" name="what_relation_of_perpetrator_to_victim" class="required administrate" value="Other"><span class="checkmark2"></span>
                                </label>
                                <input type="text" class="form-control" name="what_relation_of_perpetrator_to_victim_other_text" placeholder="type short answer here" style="display:none;">
                            
                            </div>
                            <div class="form-group">
                                <label class="questionLabel"> Was this interaction for the caller or somebody else ? <span
                                            class="error">*</span></label>
                                <select name="was_interaction_for_caller_r_somebody_else" class="form-control required administrate">
                                    <option value="The client herself">The client herself</option>
                                    <option value="Somebody else about whom the client is asking">Somebody else about whom the client is asking</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab administrative">
                    <div class="row validationReq">
                        <div class="form-group">
                            <label class="questionLabel"> Did the client answer indicate yes to any of the Urgency Assessment Questions during the client interaction ? <span
                                        class="error">*</span></label>
                            <select name="did_client_answer_yes_to_any_urgency_quest_during_client_interaction" onchange="urgency_quest_yes();" id="yes_to_any_urgency_quest" class="form-control required administrate">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="urgency_quest_yes">
                            <div class="form-group">
                                <label class="questionLabel"> Which question did the client respond yes to during the Urgency Assessment ? <span class="error">*</span>  (Select all that apply) </label>
                                <label class="container2">Is she still in the presence of a violent abuser?
                                    <input type="checkbox" name="which_quests_client_respond_yes_during_urgency_assessment[]" class="required urgency_quest administrate" value="Is she still in the presence of a violent abuser?"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Is the client physically or medically injured?
                                    <input type="checkbox" name="which_quests_client_respond_yes_during_urgency_assessment[]" class="required urgency_quest administrate" value="Is the client physically or medically injured?"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Has the physical or sexual abuse been escalating? 
                                    <input type="checkbox" name="which_quests_client_respond_yes_during_urgency_assessment[]" class="required urgency_quest administrate" value="Has the physical or sexual abuse been escalating?"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Does the abuser have access to a weapon? 
                                    <input type="checkbox" name="which_quests_client_respond_yes_during_urgency_assessment[]" class="required urgency_quest administrate" value="Does the abuser have access to a weapon?"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Does the client have safe shelter for tonight? 
                                    <input type="checkbox" name="which_quests_client_respond_yes_during_urgency_assessment[]" class="required urgency_quest administrate" value="Does the client have safe shelter for tonight?"><span class="checkmark2"></span>
                                </label>
                                <label class="container2">Is the client able to leave the situation/house?    
                                    <input type="checkbox" name="which_quests_client_respond_yes_during_urgency_assessment[]" class="required urgency_quest administrate" value="Is the client able to leave the situation/house?"><span class="checkmark2"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="questionLabel"> What steps were taken in response to the Urgency Assessment? <span class="error">*</span> </label>
                                <textarea name="what_steps_were_taken_in_response_to_urgency_ssessment" class="form-control urgency_quest required administrate" cols="5" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What was discovered during the risk analysis? 
                                <!-- <span class="error">*</span>  -->
                            </label>
                            <textarea name="what_was_discovered_during_risk_analysis" class="form-control administrate" cols="5" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Was a safety plan completed for any reason? <span
                                        class="error">*</span></label>
                            <select name="was_a_safety_plan_completed_for_any_reason" onchange="safety_plan_completed();" id="was_a_safety_plan_completed_for_any_reason" class="form-control required administrate">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="safety_plan_completed">
                            <div class="form-group">
                                <label class="questionLabel"> What were the details and/or outcomes of the safety planning? <span class="error">*</span> </label>
                                <input type="text" name="what_were_details_outcomes_of_safety_planning" class="form-control safety_plan required administrate" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Is this the first time, or repeat violence or abuse?  <span
                                        class="error">*</span></label>
                            <select name="is_this_first_time_r_repeat_violence" onchange="first_time_r_repeat();" id="is_this_first_time_r_repeat_violence" class="form-control required administrate">
                                <option value="First time ever">First time ever</option>
                                <option value="Repeat violence">Repeat violence</option>
                                <option value="I don’t know ">I don’t know </option>
                            </select>
                        </div>
                        <div class="first_time_r_repeat hide">
                            <div class="form-group">
                                <label class="questionLabel"> When was the last incident of abuse? <span class="error">*</span> </label>
                                <input type="text" name="when_was_last_incident_of_abuse" class="form-control first_r_repeat administrate">
                            </div>
                            <div class="form-group">
                                <label class="questionLabel"> What were the circumstances? <span class="error">*</span> </label>
                                <input type="text" name="what_were_the_circumstances" class="form-control first_r_repeat administrate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Overall, describe the interaction you had with the client. Please elaborate as much as possible here. <span class="error">*</span> </label>
                            <textarea name="overall_describe_interaction" class="form-control required administrate" cols="5" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="tab administrative">
                    <div class="row validationReq">
                        <div class="form-group">
                            <label class="questionLabel"> Does this client want to be put on the service list? <span
                                        class="error">*</span></label>
                            <select name="does_client_want_put_on_service_list" onchange="client_want_put_on_service_list();" id="does_client_want_put_on_service_list" class="form-control required administrate">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="client_want_put_on_service_list">
                            <div class="form-group">
                                <label class="questionLabel"> What type of service are they interested in? <span class="error">*</span> </label>
                                <input type="text" name="what_service_they_interested" class="form-control client_on_service_list required administrate">
                            </div>
                            <div class="form-group">
                                <label class="questionLabel"> What were the circumstances of their request? 
                                    <!-- <span class="error">*</span>  -->
                                </label>
                                <input type="text" name="what_were_circumstances_of_their_request" class="form-control client_on_service_list administrate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Is it safe for Shamsaha to call or contact her back? <span
                                        class="error">*</span></label>
                            <select name="is_it_safe_for_Shamsaha_to_call_r_contact_her_back" class="form-control required administrate">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> How did you get the client’s phone number? 
                                <!-- <span class="error">*</span> -->
                            </label>
                            <select name="how_did_you_get_client_phone_number" class="form-control administrate">
                                <option value="The client told me specifically.">The client told me specifically.</option>
                                <option value="I utilized the number she provided on the intake form. ">I utilized the number she provided on the intake form. </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Did the client display any signs of being suicidal or at risk of harming themselves or others? <span
                                        class="error">*</span></label>
                            <select name="did_client_display_any_signs_of_being_suicidal_r_at_risk_of_harming_themselves_or_others" onchange="client_display_any_signs();" id="did_client_display_any_signs" class="form-control required administrate">
                                <option value="No">No</option>
                                <option value="Yes, and I immediately recommended that they visit any hospital/ police authorities, and informed her of Shamsaha suicide/homicide policy">Yes, and I immediately recommended that they visit any hospital/ police authorities, and informed her of Shamsaha suicide/homicide policy.</option>
                                <option value="Not relevant (Ex: it was an administrative call or inquiry)">Not relevant (Ex: it was an administrative call or inquiry)</option>
                                <option value="Provide further details if relevant">Provide further details if relevant</option>
                            </select>
                            <input type="text" class="form-control client_display_any_signs hide" name="client_display_any_signs_further_details_text" placeholder="type short answer here">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Did you provide any publicly available resources to the client or details about Shamsaha’s operational partners in the relevant country? <span class="error">*</span> </label>
                            <label class="container2">Yes - Publicly available resources (from the Shamsaha mobile app, or other online research)
                                <input type="checkbox" name="did_you_provide_any_publicly_available_resources_to_client_r_details_about_Shamsaha’s_operational_partners_in_relevant_country[]" class="required administrate" value="Yes - Publicly available resources (from the Shamsaha mobile app, or other online research)"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Yes - Shamsaha’s partners
                                <input type="checkbox" name="did_you_provide_any_publicly_available_resources_to_client_r_details_about_Shamsaha’s_operational_partners_in_relevant_country[]" class="required administrate" value="Yes - Shamsaha’s partners"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">No
                                <input type="checkbox" name="did_you_provide_any_publicly_available_resources_to_client_r_details_about_Shamsaha’s_operational_partners_in_relevant_country[]" class="required administrate" value="No"><span class="checkmark2"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What is the ethnicity of the client? 
                                <!-- <span class="error">*</span> -->
                            </label>
                            <select name="what_ethnicity_of_client" onchange="return what_ethnicity_of_client_function();" class="form-control administrate">
                                <option value="Arab (Bahrain)">Arab (Bahrain)</option>
                                <option value="Arab (GCC)">Arab (GCC)</option>
                                <option value="Arab (Other Middle East)">Arab (Other Middle East)</option>
                                <option value="Central Asia (Pakistan, Afghanistan, Bangladesh,...)">Central Asia (Pakistan, Afghanistan, Bangladesh,...)</option>
                                <option value="Indian">Indian</option>
                                <option value="Sri Lankan">Sri Lankan</option>
                                <option value="North East Asian (China, Japan, ...)">North East Asian (China, Japan, ...)</option>
                                <option value="South East Asia (Thailand, Philippines, Indonesian, ...)">South East Asia (Thailand, Philippines, Indonesian, ...)</option>
                                <option value="Sub Saharan African (Kenya, Ghana, South African, ...)">Sub Saharan African (Kenya, Ghana, South African, ...)</option>
                                <option value="North American (USA, Canada, ...)">North American (USA, Canada, ...)</option>
                                <option value="South American/ Central American (Mexico, Brazil,...)">South American/ Central American (Mexico, Brazil,...)</option>
                                <option value="Western Europe (UK, France,...)">Western Europe (UK, France,...)</option>
                                <option value="Eastern Europe (Russia, Ukraine, Slovakia,...)">Eastern Europe (Russia, Ukraine, Slovakia,...)</option>
                                <option value="Pacific Islander (New Zealand, Australia, Islander)">Pacific Islander (New Zealand, Australia, Islander)</option>
                                <option value="Unknown">Unknown</option>
                                <option value="Not relevant">Not relevant</option>
                                <option value="Other">Other</option>
                            </select><br>
                            <input type="text" class="form-control" name="what_ethnicity_of_client_other_text" placeholder="type short answer here" style="display:none;">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Which city/ area is the client contacting you from? 
                                <!-- <span class="error">*</span> -->
                            </label>
                            <input type="text" name="which_city_area_is_client_contacting_you_from" class="form-control administrate">
                        </div>
                    </div>
                </div>

                <div class="tab administrative">
                    <div class="row validationReq">
                        <!-- <h4>Closing and final notes</h4> -->
                        <!-- <p>Please use this section to tell us about your thoughts and feelings, as well as any challenges you -->
                            <!-- had with the case, or any part of the interaction.</p> -->
                        <div class="form-group">
                            <label class="questionLabel"> What is the client’s age? 
                                <!-- <span class="error">*</span> -->
                            </label>
                            <input type="number" name="what_client_age" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="3" class="form-control administrate">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What is the client’s marital status? <span
                                        class="error">*</span></label>
                            <select name="what_client_marital_status" class="form-control required administrate">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorce">Divorce</option>
                                <option value="Separated">Separated</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Engaged">Engaged</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Does the client have children? <span
                                        class="error">*</span></label>
                            <select name="does_client_have_children" class="form-control required administrate">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Is the client employed? <span
                                        class="error">*</span></label>
                            <select name="is_client_employed" class="form-control required administrate">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> In what language would the client prefer to communicate? <span
                                        class="error">*</span></label>
                            <input type="text" name="language_client_prefer_to_communicate" class="form-control required administrate">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> How did she hear about Shamsaha? 
                                <!-- <span class="error">*</span>  -->
                            </label>
                            <label class="container2">Instagram
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" class="administrate" value="Instagram"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Facebook
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" class="administrate" value="Facebook"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Twitter
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" class="administrate" value="Twitter"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Google search
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" class="administrate" value="Google search"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Friend
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" class="administrate" value="Friend"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Unknown
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" class="administrate" value="Unknown"><span class="checkmark2"></span>
                            </label>
                            <label class="container2" onclick="showInputBox2();">Other
                                <input type="checkbox" name="how_did_she_hear_about_Shamsaha[]" id="how_did_she_hear_about_Shamsaha_other" class="administrate" value="Other"><span class="checkmark2"></span>
                            </label>
                            <input type="text" class="form-control hide" name="how_did_she_hear_about_Shamsaha_other_text" placeholder="type short answer here">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Do you have any final notes regarding this client and/or the interaction? 
                                <!-- <span class="error">*</span>  -->
                            </label>
                            <input type="text" name="final_notes" class="form-control administrate">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> How were you feeling during and after the interaction? <span class="error">*</span> </label>
                            <input type="text" name="how_were_you_feeling" class="form-control required administrate">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Did you face any issues with the App? 
                                <!-- <span class="error">*</span>  -->
                            </label>
                            <input type="text" name="any_issues_with_App" class="form-control administrate">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> يمكنك إضافة أي ملاحظات أخرى باللغة العربية إذا كانت هناك المزيد معلومات تريدين توضيحها أكثر  
                                <!-- <span class="error">*</span>  -->
                            </label>
                            <textarea name="other_notes_in_arabic" class="form-control administrate" cols="5" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="hide sec3">
                    <div class="row validationReq">
                        <div class="form-group">
                            <label class="questionLabel"> What type of interaction was this? <span class="error">*</span> </label>
                            <label class="container2">Administrative inquiry
                                <input type="checkbox" name="what_type_of_interaction_was_this[]" class="section3" value="Administrative inquiry"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Volunteer inquiry 
                                <input type="checkbox" name="what_type_of_interaction_was_this[]" class="section3" value="Volunteer inquiry"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Other support request that does not fit the Shamsaha mandate (such as request for employment)
                                <input type="checkbox" name="what_type_of_interaction_was_this[]" class="section3" value="Other support request that does not fit the Shamsaha mandate (such as request for employment)"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Spam
                                <input type="checkbox" name="what_type_of_interaction_was_this[]" class="section3" value="Spam"><span class="checkmark2"></span>
                            </label>
                            <label class="container2">Interaction failed/hung up
                                <input type="checkbox" name="what_type_of_interaction_was_this[]" class="section3" value="Interaction failed/hung up"><span class="checkmark2"></span>
                            </label>
                            <label class="container2" onclick="showInputBox3();">Other
                                <input type="checkbox" name="what_type_of_interaction_was_this[]" id="what_type_of_interaction_was_this_other" class="section3" value="Other"><span class="checkmark2"></span>
                            </label>
                            <input type="text" class="form-control hide" name="what_type_of_interaction_was_this_other_text" placeholder="type short answer here">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">Please detail the interaction? <span class="error">*</span> </label>
                            <textarea name="detail_the_interaction" class="form-control section3" cols="5" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">Did you provide any additional information or details during this interaction? <span class="error">*</span> </label>                    
                            <input type="text" name="additional_information" class="form-control section3" id="">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel">يمكنك إضافة أي ملاحظات أخرى باللغة العربية إذا كانت هناك المزيد معلومات تريدين توضيحها أكثر 
                                <!-- <span class="error">*</span>  -->
                            </label>
                            <textarea name="additional_information_in_arabic" class="form-control" cols="5" rows="5"></textarea>
                        </div>
                    </div>

                </div>

                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        <button type="submit" id="submitBtn" style="display: none;">Submit</button>
                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step administration"></span>
                    <span class="step administration"></span>
                    <span class="step administration"></span>
                    <span class="step administration"></span>
                    <span class="hide sect3"></span>
                </div>
            </form>
    </div>
<?php } ?>

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
                        window.location.href = '<?php echo str_replace("&success=false","","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>'+'&success=true';
                        
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
        left: 0;
        right: 0;
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
