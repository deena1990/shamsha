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
</style>
<body>
<div class="container">
    <form id="regForm" action="" method="post">

        <div class="tab">
            <div class="row validationReq" id="sec1">
                <h4>Which Form Should You Complete?</h4>
                <p>Please answer the following question to determine which form you should complete: The "short" form or the
                    "long" form. *
                </p>
                <div class="form-group">
                    <label class="questionLabel">What is your full name? <span class="error">*</span> </label>
                    <input type="text" class="form-control required" name="fullname" required>
                </div>
                <div class="form-group">
                    <label class="questionLabel">What is your most up to date mobile number? <span
                                class="error">*</span></label>
                    <input type="text" class="form-control required" name="mobile" required>
                </div>
            </div>
        </div>

        <div class="tab">

            <div id="normalSection">
                <div class="row validationReq" id="normalSection1">
                    <h2 class="text-center">LONG FORM</h2>
                    <p>Please tell us about the interaction with your client using as much detail as possible.</p>

                    <div class="form-group">
                        <label class="questionLabel">Which type of language specific shift were you on? <span class="error">*</span></label><br>
                        <label class="container2">English Advocacy
                            <input type="radio" class="required" name="shift_u_on" value="English Advocacy"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Arabic Advocacy
                            <input type="radio" class="required" name="shift_u_on" value="Arabic Advocacy"><span class="checkmark2"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">When did you receive this advocacy client? <span class="error">*</span></label><br>

                        <div class="row">
                            <div class="col-xs-6">
                                <label class="questionLabel">Date</label>
                                <input type="date" class="form-control required" name="date">
                            </div>
                            <div class="col-xs-6">
                                <label class="class="questionLabel"">Time</label>
                                <input type="time" class="form-control required" name="time">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="questionLabel">Client's first name? (If you do not know, type "unknown".) <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="client_first_name">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Client's last name? (If you do not know, type "unknown".) <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="client_last_name">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Client's phone number (look in the call log on the phone)? <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="client_phone_num">
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">From which country was the client contacting us? <span class="error">*</span></label>
                        <label class="container2">Bahrain
                            <input type="radio" class="required" name="client_country" value="Bahrain"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Saudi Arabia
                            <input type="radio" class="required" name="client_country" value="Saudi Arabia"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Kuwait
                            <input type="radio" class="required" name="client_country" value="Kuwait"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">United Arab Emirates
                            <input type="radio" class="required" name="client_country" value="United Arab Emirates"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Oman
                            <input type="radio" class="required" name="client_country" value="Oman"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Qatar
                            <input type="radio" class="required" name="client_country" value="Qatar"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Other
                            <input type="radio" class="required" name="client_country" value="Other"><span class="checkmark2"></span>
                        </label>
                        <input type="text" class="form-control" name="client_country_other">
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">Which type of call was this? <span class="error">*</span></label>
                        <label class="container2">Hospital AMH Manama - Bahrain
                            <input type="radio" class="required" name="type_of_call" value="Hospital AMH Manama - Bahrain"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Hospital AMH Amwaj - Bahrain
                            <input type="radio" class="required" name="type_of_call" value="Hospital AMH Amwaj - Bahrain"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Hospital AMH Saar - Bahrain
                            <input type="radio" class="required" name="type_of_call" value="Hospital AMH Saar - Bahrain"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Hospital AMH Riffa - Bahrain
                            <input type="radio" class="required" name="type_of_call" value="Hospital AMH Riffa - Bahrain"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Other hospital
                            <input type="radio" class="required" name="type_of_call" value="Other hospital"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Telephone talking
                            <input type="radio" class="required" name="type_of_call" value="Telephone talking"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Telephone text
                            <input type="radio" class="required" name="type_of_call" value="Telephone text"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Office advocacy
                            <input type="radio" class="required" name="type_of_call" value="Office advocacy"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Police station
                            <input type="radio" class="required" name="type_of_call" value="Police station"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Court house
                            <input type="radio" class="required" name="type_of_call" value="Court house"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Government shelter
                            <input type="radio" class="required" name="type_of_call" value="Government shelter"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Friend/Outside advocacy
                            <input type="radio" class="required" name="type_of_call" value="Friend/Outside advocacy"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Other
                            <input type="radio" class="required" name="type_of_call" value="Other"><span class="checkmark2"></span>
                        </label>
                        <input type="text" class="form-control" name="type_of_call_other">
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">Approximately how long was your interaction? <span class="error">*</span></label><br>
                        <label class="container2">0 to 30 minutes
                            <input type="radio" class="required" name="how_long_interaction" value="0 to 30 minutes"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">30 to 60 minutes
                            <input type="radio" class="required" name="how_long_interaction" value="30 to 60 minutes"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">60 to 120 minutes
                            <input type="radio" class="required" name="how_long_interaction" value="60 to 120 minutes"><span class="checkmark2"></span>
                        </label>
                        <label class="container2">Others
                            <input type="radio" class="required" name="how_long_interaction" value="Others"><span class="checkmark2"></span>
                        </label>
                        <input type="text" class="form-control" name="how_long_interaction_others" >
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">Did this case require payment for anything (taxi, hotel, food,
                            etc)? <span class="error">*</span></label>
                        <label class="container2">Yes
                            <input type="radio" class='required' name="did_case_req_payment" value="Yes"><span
                                    class="checkmark2"></span>
                        </label>
                        <label class="container2">No
                            <input type="radio" class='required' name="did_case_req_payment" value="No"><span
                                    class="checkmark2"></span>
                        </label>
                    </div>
                </div>
                <div class="row" id="paymentSection" style="display: none;">
                    <h4>Payment details</h4>
                    <p>Please complete this section if this case required payments of any type.</p>
                    <div class="form-group">
                        <label class="questionLabel">What services/items were paid for? <span
                                    class="error">*</span></label>
                        <label class="container2">Food
                            <input type="checkbox" name="service_r_item_paid_for[]" class="required" value="Food"><span
                                    class="checkmark"></span>
                        </label>
                        <label class="container2">Taxi
                            <input type="checkbox" name="service_r_item_paid_for[]" class="required" value="Taxi"><span
                                    class="checkmark"></span>
                        </label>
                        <label class="container2">Hotel
                            <input type="checkbox" name="service_r_item_paid_for[]" class="required" value="Hotel"><span
                                    class="checkmark"></span>
                        </label>
                        <label class="container2">Medical
                            <input type="checkbox" name="service_r_item_paid_for[]" class="required"
                                   value="Medical"><span class="checkmark"></span>
                        </label>
                        <label class="container2">Others
                            <input type="checkbox" name="service_r_item_paid_for[]" class="required"
                                   value="Others"><span class="checkmark"></span>
                        </label>
                        <input type="text" class="form-control" name="service_r_item_paid_for_others">
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">Did you pay for anything personally, for which you need to be
                            reimbursed?<span class="error">*</span></label>
                        <label class="container2">Yes
                            <input type="radio" name="reimbursed" value="Yes" class="required"><span
                                    class="checkmark2"></span>
                        </label>
                        <label class="container2">No
                            <input type="radio" name="reimbursed" value="No" class="required"><span
                                    class="checkmark2"></span>
                        </label>
                    </div>
                </div>

                <div class="row" id="reimbursementSection" style="display: none;">
                    <h4>Reimbursements</h4>
                    <p>Tell us about the payment so we can reimburse you. Please allow 2 weeks for completion of your
                        reimbursement payment. Be sure to save ALL receipts.</p>

                    <div class="form-group">
                        <label class="questionLabel">What was the expense and the purpose? <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="expense_n_purpose">
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">What was the exact amount of the expense? <span
                                    class="error">*</span></label>
                        <input type="text" class="form-control required" name="amount_of_expense">
                    </div>

                    <div class="form-group">
                        <label class="questionLabel">Do you have the receipt? (This is required for reimbursement.
                            Please save it and give to us when you get your refund and/or take a photo and email it to
                            info@shamsaha.org.) <span class="error">*</span></label>
                        <label class="container2">Yes
                            <input type="radio" class="required" name="do_u_have_receipt" value="Yes"><span
                                    class="checkmark2"></span>
                        </label>
                        <label class="container2">No
                            <input type="radio" class="required" name="do_u_have_receipt" value="No"><span
                                    class="checkmark2"></span>
                        </label>
                    </div>
                </div>
            </div>



        </div>
        <div class="tab">
            <div class="row validationReq">
                <h4>Case Details</h4>
                <p>Please provide as much information as possible. And remember to please be available for a call with
                    the case worker in the coming days in order to debrief about the case.</p>

                <div class="form-group">
                    <label class="questionLabel">What type of abuse is she facing? <span class="error">*</span></label>
                    <label class="container2">Physical violence, from intimate partner
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Physical violence, from intimate partner"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Physical violence, from employer
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Physical violence, from employer"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Emotional/psychological/financial violence, from intimate partner
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Emotional/psychological/financial violence, from intimate partner"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Sexual violence, from intimate partner
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Sexual violence, from intimate partner"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Sexual violence from acquaintance (not intimate partner)
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Sexual violence from acquaintance (not intimate partner)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Sexual violence from employer
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Sexual violence from employer"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Sexual violence from stranger
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Sexual violence from stranger"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Other type of family or general violence
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Other type of family or general violence"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Other type of harassment or discrimination
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Other type of harassment or discrimination"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Other type of "non abuse" or "non discrimination" but upset about
                        relationship issues
                        <input type="radio" class="required" name="abuse_she_face"
                               value="Other type of non abuse or non discrimination but upset about relationship issues"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="abuse_she_face" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="abuse_she_face_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Was this interaction for <span class="error">*</span></label>
                    <label class="container2">The caller herself
                        <input type="radio" class="required" name="interaction_for" value="The caller herself"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Somebody else about whom the caller is asking
                        <input type="radio" class="required" name="interaction_for"
                               value="Somebody else about whom the caller is asking"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="interaction_for" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="interaction_for_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">What is the relationship of the perpetrator to the victim? <span
                                class="error">*</span></label>
                    <label class="container2">Husband
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Husband"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Boyfriend
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Boyfriend"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Ex-husband
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim" value="Ex-husband"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Ex-boyfriend
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Ex-boyfriend"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Fiance
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Fiance"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Acquaintance (or date)
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Acquaintance (or date)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Family member
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Family member"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Sponsor/Employer
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Sponsor/Employer"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Stranger
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Stranger"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Unknown (You should not choose this option often)
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Unknown (You should not choose this option often)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim"
                               value="Not relevant"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="relationship_of_perpet_to_victim" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="relationship_of_perpet_to_victim_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Was this the first time, or repeat violence? <span
                                class="error">*</span></label>
                    <label class="container2">First time ever
                        <input type="radio" class="required" name="first_time_r_repeat_violence"
                               value="First time ever"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Repeated violence
                        <input type="radio" class="required" name="first_time_r_repeat_violence"
                               value="Repeated violence"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="first_time_r_repeat_violence"
                               value="I dont know"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="first_time_r_repeat_violence"
                               value="Not relevant"><span class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Give summary of case and reason for call <span
                                class="error">*</span></label>
                    <input type="text" class="form-control required" name="summary_of_case_n_reason">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Did the client state what she would like to do next? If yes, explain.
                        <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="like_to_do_next">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Does the client want follow up from Shamsaha? <span
                                class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="client_follow_up" value="Yes"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="client_follow_up" value="No"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Not sure (you should not choose this option often)
                        <input type="radio" class="required" name="client_follow_up"
                               value="Not sure (you should not choose this option often)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="client_follow_up" value="Not relevant"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Is it safe for Shamsaha? to call her back? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="is_it_safe_to_cal_back" value="Yes"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="is_it_safe_to_cal_back" value="No"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know (you should not choose this option often)
                        <input type="radio" class="required" name="is_it_safe_to_cal_back"
                               value="I dont know (you should not choose this option often)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="is_it_safe_to_cal_back" value="Not relevant"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Did you give the client information about Shamsaha office
                        hours/location for case work support? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="client_info_abt_ofc_hrs" value="Yes"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No (If not, explain why in the notes at the end.)
                        <input type="radio" class="required" name="client_info_abt_ofc_hrs"
                               value="No (If not, explain why in the notes at the end.)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="client_info_abt_ofc_hrs" value="Not relevant"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Did the client display any sign of being suicidal or at risk of harming
                        themselves or others? <span class="error">*</span></label>
                    <label class="container2">No
                        <input type="radio" class="required" name="any_sign_of_suicide_r_harm" value="No"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Yes, and I immediately recommended that they visit any hospital, and
                        informed her of Shamsaha suicide/homicide policy.
                        <input type="radio" class="required" name="any_sign_of_suicide_r_harm"
                               value="Yes, and I immediately recommended that they visit any hospital, and informed her of Shamsaha suicide/homicide policy."><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Did you discuss or complete a safety plan? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="discuss_r_safe_plan" value="Yes"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No (If not, explain why in the notes)
                        <input type="radio" class="required" name="discuss_r_safe_plan"
                               value="No (If not, explain why in the notes)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant: Not in further danger or administrative type of call
                        <input type="radio" class="required" name="discuss_r_safe_plan"
                               value="Not relevant: Not in further danger or administrative type of call"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Did you make any referrals? If so, list which referrals you made. <span
                                class="error">*</span></label>
                    <input type="text" class="form-control required" name="any_referrals">
                </div>
                <div class="form-group">
                    <label class="questionLabel">To the best of your knowledge, what was the client's ethnicity? <span
                                class="error">*</span></label>
                    <label class="container2">Arab (Bahrain)
                        <input type="radio" class="required" name="client_ethnicity" value="Arab (Bahrain)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Arab (GCC)
                        <input type="radio" class="required" name="client_ethnicity" value="Arab (GCC)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Central Asian (Pakistan, Afghanistan, Bangladesh)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="Central Asian (Pakistan, Afghanistan, Bangladesh)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Indian
                        <input type="radio" class="required" name="client_ethnicity" value="Indian"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">SriLankan
                        <input type="radio" class="required" name="client_ethnicity" value="SriLankan"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">North East Asian (China, Japan, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="North East Asian (China, Japan, Etc)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">South East Asian (Thailand, Philippines, Indonesian, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="South East Asian (Thailand, Philippines, Indonesian, Etc)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">North African (Egypt, Sudan, Morocco, Tunisia, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="North African (Egypt, Sudan, Morocco, Tunisia, Etc)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Sub-Saharan African (Kenya, Ghana, South Africa, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="Sub-Saharan African (Kenya, Ghana, South Africa, Etc)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">North American (USA, Canada)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="North American (USA, Canada)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">South American/Central American (Mexico, Brazil, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="South American/Central American (Mexico, Brazil, Etc)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Western Europe (UK, France, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="Western Europe (UK, France, Etc)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Eastern Europe (Russia, Ukraine, Slovakia, Etc)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="Eastern Europe (Russia, Ukraine, Slovakia, Etc)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Pacific Islander (New Zealand, Australia, Islander)
                        <input type="radio" class="required" name="client_ethnicity"
                               value="Pacific Islander (New Zealand, Australia, Islander)"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Unknown
                        <input type="radio" class="required" name="client_ethnicity" value="Unknown"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="client_ethnicity" value="Not relevant"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="client_ethnicity" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="client_ethnicity_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Client age? <span class="error">*</span></label>
                    <label class="container2">13 to 17
                        <input type="radio" class="required" name="client_age" value="13 to 17"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">18 to 25
                        <input type="radio" class="required" name="client_age" value="18 to 25"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">26 to 45
                        <input type="radio" class="required" name="client_age" value="26 to 45"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">45 +
                        <input type="radio" class="required" name="client_age" value="45 +"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="client_age" value="I dont know"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Client marital status? <span class="error">*</span></label>
                    <label class="container2">Single
                        <input type="radio" class="required" name="marital_status" value="Single"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Married
                        <input type="radio" class="required" name="marital_status" value="Married"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Divorced
                        <input type="radio" class="required" name="marital_status" value="Divorced"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Separated
                        <input type="radio" class="required" name="marital_status" value="Separated"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Widowed
                        <input type="radio" class="required" name="marital_status" value="Widowed"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Engaged
                        <input type="radio" class="required" name="marital_status" value="Engaged"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Unknown
                        <input type="radio" class="required" name="marital_status" value="Unknown"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="marital_status" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="marital_status_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Does the client have children? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="client_have_children" value="Yes"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="client_have_children" value="No"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Unknown
                        <input type="radio" class="required" name="client_have_children" value="Unknown"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">Is the client employed? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="client_employed" value="Yes"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="client_employed" value="No"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="client_employed" value="I dont know"><span
                                class="checkmark2"></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="questionLabel">If the answer to the employment question above is "yes", explain what
                        she does and for whom? </label>
                    <input type="text" class="form-control" name="what_she_do">
                </div>
                <div class="form-group">
                    <label class="questionLabel">If you could recommend care for this client in any language, which
                        would it be? <span class="error">*</span> </label>
                    <label class="container2">English
                        <input type="checkbox" class="required" name="recomment_care[]" value="English"><span
                                class="checkmark"></span>
                    </label>
                    <label class="container2">Arabic
                        <input type="checkbox" class="required" name="recomment_care[]" value="Arabic"><span
                                class="checkmark"></span>
                    </label>
                    <label class="container2">Other
                        <input type="checkbox" class="required" name="recomment_care[]" value="Other"><span
                                class="checkmark"></span>
                    </label>
                    <input type="text" class="form-control" name="recomment_care_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">If this was sexual violence, was any form of penetration made?</label>
                    <label class="container2">Vaginal
                        <input type="radio"  name="penetration_made" value="Vaginal"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Anal
                        <input type="radio"  name="penetration_made" value="Anal"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Penetration was penis
                        <input type="radio"  name="penetration_made" value="Penetration was penis"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Penetration was object
                        <input type="radio"  name="penetration_made"
                               value="Penetration was object"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Don't know
                        <input type="radio"  name="penetration_made" value="Don't know"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Condom was used
                        <input type="radio"  name="penetration_made" value="Condom was used"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Condom was not used
                        <input type="radio"  name="penetration_made" value="Condom was not used"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Don’t know if condom was used
                        <input type="radio"  name="penetration_made"
                               value="Don’t know if condom was used"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio"  name="penetration_made" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="penetration_made_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">Has the client involved the police? If yes, describe the situation in
                        the final note section at the end.<span class="error">*</span></label>
                    <label class="container2">Yes, and she has a good experience with the police
                        <input type="radio" class="required" name="client_involved_the_police"
                               value="Yes, and she has a good experience with the police"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Yes, and she had a bad experience with the police
                        <input type="radio" class="required" name="client_involved_the_police"
                               value="Yes, and she had a bad experience with the police"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Yes, her experience with the police was neutral or she didn't describe it
                        <input type="radio" class="required" name="client_involved_the_police"
                               value="Yes, her experience with the police was neutral or she didn't describe it"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">No, she does not want to involve the police
                        <input type="radio" class="required" name="client_involved_the_police"
                               value="No, she does not want to involve the police"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No, she is scared to involve the police
                        <input type="radio" class="required" name="client_involved_the_police"
                               value="No, she is scared to involve the police"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No, but she didn't specify why
                        <input type="radio" class="required" name="client_involved_the_police"
                               value="No, but she didn't specify why"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Don't know
                        <input type="radio" class="required" name="client_involved_the_police" value="Don't know"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="client_involved_the_police" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <input type="text" class="form-control" name="client_involved_the_police_other">
                </div>
                <div class="form-group">
                    <label class="questionLabel">How did the caller hear about Shamsaha? <span class="error">*</span></label>
                    <label class="container2">Social media (facebook, Instagram)
                        <input type="radio" class="required" name="hear_about_shamsaha"
                               value="Social media (facebook, Instagram)"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Brochure or printed material
                        <input type="radio" class="required" name="hear_about_shamsaha"
                               value="Brochure or printed material"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Hospital
                        <input type="radio" class="required" name="hear_about_shamsaha" value="Hospital"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Friend
                        <input type="radio" class="required" name="hear_about_shamsaha" value="Friend"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Shamsaha advocate
                        <input type="radio" class="required" name="hear_about_shamsaha" value="Shamsaha advocate"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">Other
                        <input type="radio" class="required" name="hear_about_shamsaha" value="Other"><span
                                class="checkmark2"></span>
                    </label>
                    <label class="container2">I don’t know
                        <input type="radio" name="hear_about_shamsaha" value="I don’t know"><span
                                class="checkmark2"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="tab">
            <div class="row validationReq">
                <h4>Urgency Assessment</h4>
                <p>Remember you should have completed a safety plan with any client who answered "yes" to two or more of the following 5 questions. </p>
                <div class="form-group">
                    <label class="questionLabel">Does the perpetrator have access to a gun?  <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="perpetrator_access_to_gun" value="Yes"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="perpetrator_access_to_gun" value="No"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="perpetrator_access_to_gun" value="I dont know"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="perpetrator_access_to_gun" value="Not relevant"><span class="checkmark2"></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="questionLabel">Has the violence towards the victim been escalating recently? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="violence_towards_victim" value="Yes"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="violence_towards_victim" value="No"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="violence_towards_victim" value="I dont know"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">First time: Not relevant
                        <input type="radio" class="required" name="violence_towards_victim" value="First time: Not relevant"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="violence_towards_victim" value="Not relevant"><span class="checkmark2"></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="questionLabel">Is the perpetrator a member of the police or military?  <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="perpetrator_mem_of_police" value="Yes"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="perpetrator_mem_of_police" value="No"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="perpetrator_mem_of_police" value="I dont know"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="perpetrator_mem_of_police" value="Not relevant"><span class="checkmark2"></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="questionLabel">Is the victim in danger tonight? <span class="error">*</span></label>
                    <label class="container2">Yes, she is in danger and has nowhere safe to sleep tonight.
                        <input type="radio" class="required" name="victim_in_danger" value="Yes, she is in danger and has nowhere safe to sleep tonight."><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No, she has a safe place to sleep.
                        <input type="radio" class="required" name="victim_in_danger" value="No, she has a safe place to sleep."><span class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="victim_in_danger" value="I dont know"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="victim_in_danger" value="Not relevant"><span class="checkmark2"></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="questionLabel">Were there any advanced or serious injuries as a result of this incident? <span class="error">*</span></label>
                    <label class="container2">Yes
                        <input type="radio" class="required" name="any_advance_r_serious_injury" value="Yes"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">No
                        <input type="radio" class="required" name="any_advance_r_serious_injury" value="No"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">I dont know
                        <input type="radio" class="required" name="any_advance_r_serious_injury" value="I dont know"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Not relevant
                        <input type="radio" class="required" name="any_advance_r_serious_injury" value="Not relevant"><span class="checkmark2"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="tab">
            <div class="row validationReq">
                <h4>Closing and final notes</h4>
                <p>Please use this section to tell us about your thoughts and feelings, as well as any challenges you
                    had with the case, or any part of the interaction.</p>
                <div class="form-group">
                    <label class="questionLabel">Your final notes and thoughts about case/client. <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="final_notes_n_thought_abt_client">
                </div>

                <div class="form-group">
                    <label class="questionLabel">How were you feeling during your interactions with the client? <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="feeling_interaction_with_client">
                </div>

                <div class="form-group">
                    <label class="questionLabel">Please choose any one thing good or bad that you would like us to know
                        about your shift. <span class="error">*</span></label>
                    <input type="text" class="form-control required" name="good_r_bad_abt_shift">
                </div>
            </div>

        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                <button type="submit" id="submitBtn"  style="display: none;">Submit</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
</div>
<?php
$full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
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

    $(document).ready(function () {

        $("input[name='did_case_req_payment']").change(function () {
            if ($("input[name='did_case_req_payment']:checked")) {
                var value = $("input[name='did_case_req_payment']:checked").val();
                if (value == 'Yes') {
                    $("#paymentSection").show();
                    $("#paymentSection").addClass('validationReq');
                    var reimbursed = $("input[name='reimbursed']:checked").val();
                    if (reimbursed == 'Yes') {
                        $("#reimbursementSection").show();

                    } else {
                        $("#reimbursementSection").hide();
                    }
                }
                if (value == 'No') {
                    $("#paymentSection").removeClass('validationReq');
                    $("#paymentSection").hide();
                    $("#reimbursementSection").hide();
                }
            }
        });

        $("input[name='reimbursed']").change(function () {
            if ($("input[name='reimbursed']:checked")) {
                var value = $("input[name='reimbursed']:checked").val();
                if (value == 'Yes') {
                    $("#reimbursementSection").show();
                    $("#reimbursementSection").addClass('validationReq');
                }
                if (value == 'No') {
                    $("#reimbursementSection").hide();
                    $("#reimbursementSection").removeClass('validationReq');
                }
            }
        });

        $("input[name='abuse_she_face']").change(function () {
            if ($("input[name='abuse_she_face']:checked")) {
                var value = $("input[name='abuse_she_face']:checked").val();
                if (value == 'Other') {
                    $("input[name='abuse_she_face_other']").addClass('required');
                }
              else {
                    $("input[name='abuse_she_face_other']").removeClass('required');
                }
            }
        });

        $("input[name='interaction_for']").change(function () {
            if ($("input[name='interaction_for']:checked")) {
                var value = $("input[name='interaction_for']:checked").val();
                if (value == 'Other') {
                    $("input[name='interaction_for_other']").addClass('required');
                }
                else {
                    $("input[name='interaction_for_other']").removeClass('required');
                }
            }
        });

        $("input[name='relationship_of_perpet_to_victim']").change(function () {
            if ($("input[name='relationship_of_perpet_to_victim']:checked")) {
                var value = $("input[name='relationship_of_perpet_to_victim']:checked").val();
                if (value == 'Other') {
                    $("input[name='relationship_of_perpet_to_victim_other']").addClass('required');
                }
                else {
                    $("input[name='relationship_of_perpet_to_victim_other']").removeClass('required');
                }
            }
        });

        $("input[name='client_ethnicity']").change(function () {
            if ($("input[name='client_ethnicity']:checked")) {
                var value = $("input[name='client_ethnicity']:checked").val();
                if (value == 'Other') {
                    $("input[name='client_ethnicity_other']").addClass('required');
                }
                else {
                    $("input[name='client_ethnicity_other']").removeClass('required');
                }
            }
        });

        $("input[name='marital_status']").change(function () {
            if ($("input[name='marital_status']:checked")) {
                var value = $("input[name='marital_status']:checked").val();
                if (value == 'Other') {
                    $("input[name='marital_status_other']").addClass('required');
                }
                else {
                    $("input[name='marital_status_other']").removeClass('required');
                }
            }
        });

        $("input[name='recomment_care[]']").change(function () {
            if ($("input[name='recomment_care[]']:checked")) {
                $("input[name='recomment_care_other']").removeClass('required');
                $("input[name='recomment_care[]']:checked").each(function () {
                    if ($(this).val() == 'Other') {
                        $("input[name='recomment_care_other']").addClass('required');
                    }
                })
            }
        });

        $("input[name='penetration_made']").change(function () {
            if ($("input[name='penetration_made']:checked")) {
                var value = $("input[name='penetration_made']:checked").val();
                if (value == 'Other') {
                    $("input[name='penetration_made_other']").addClass('required');
                }
                else {
                    $("input[name='penetration_made_other']").removeClass('required');
                }
            }
        });

        $("input[name='client_involved_the_police']").change(function () {
            if ($("input[name='client_involved_the_police']:checked")) {
                var value = $("input[name='client_involved_the_police']:checked").val();
                if (value == 'Other') {
                    $("input[name='client_involved_the_police_other']").addClass('required');
                }
                else {
                    $("input[name='client_involved_the_police_other']").removeClass('required');
                }
            }
        });

        $("input[name='service_r_item_paid_for[]']").change(function () {
            if ($("input[name='service_r_item_paid_for[]']:checked")) {
                $("input[name='service_r_item_paid_for_others']").removeClass('required');
                $("input[name='service_r_item_paid_for[]']:checked").each(function () {
                    if ($(this).val() == 'Others') {
                        $("input[name='service_r_item_paid_for_others']").addClass('required');
                    }
                })
            }
        });

        $("input[name='client_country']").change(function () {
            if ($("input[name='client_country']:checked")) {
                var value = $("input[name='client_country']:checked").val();
                if (value == 'Other') {
                    $("input[name='client_country_other']").addClass('required');
                }
                else {
                    $("input[name='client_country_other']").removeClass('required');
                }
            }
        });

        $("input[name='client_employed']").change(function () {
            if ($("input[name='client_employed']:checked")) {
                var value = $("input[name='client_employed']:checked").val();
                if (value == 'Yes') {
                    $("input[name='what_she_do']").addClass('required');
                }
                else {
                    $("input[name='what_she_do']").removeClass('required');
                }
            }
        });
        
         $("input[name='type_of_call']").change(function () {
            if ($("input[name='type_of_call']:checked")) {
                var value = $("input[name='type_of_call']:checked").val();
                if (value == 'Other') {
                    $("input[name='type_of_call_other']").addClass('required');
                }
                else {
                    $("input[name='type_of_call_other']").removeClass('required');
                }
            }
        });
        

        $("input[name='how_long_interaction']").change(function () {
            if ($("input[name='how_long_interaction']:checked")) {
                var value = $("input[name='how_long_interaction']:checked").val();
                if (value == 'Others') {
                    $("input[name='how_long_interaction_others']").addClass('required');
                }
                else {
                    $("input[name='how_long_interaction_others']").removeClass('required');
                }
            }
        });


    });

    $(function () {
        $(document).on('click','#submitBtn', function (e) {
            e.preventDefault();
             if (!validateForm()) return false;
            $("#submitBtn").prop('disabled', true);
            $.ajax({
                type: 'post',
                url: '<?= $full_url ?>',
                dataType: 'json',
                data: $('form').serialize(),
                success: function (data) {
                    $("#submitBtn").prop('disabled', false);
                    if(data.status == "success"){
                        $("body").html('<div class="container" style="margin-top: 50px"><div class="alert alert-success alert-dismissible">\n' +
                            '    <strong>Success!</strong> Added successfully!!\n' +
                            '  </div></div>')
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
