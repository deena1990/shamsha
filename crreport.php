<?php
$con = mysqli_connect("localhost","sayg_wcci_usr","[J?ST]vr=.]6","sayg_wcci");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  $sql = mysqli_query($con, "select * from wc_pages where wcp_id =8");
  $counter =0 ;
 $row = mysqli_fetch_array($sql); ?>
  
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        .row {
            margin-left: 20px;
            margin-right: 20px;
        }
        /* The container */
        
        .container {
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
        /* Hide the browser's default checkbox */
        
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        /* Create a custom checkbox */
        
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
        }
        /* On mouse-over, add a grey background color */
        
        .container:hover input~.checkmark {
            background-color: #ccc;
        }
        /* When the checkbox is checked, add a blue background */
        
        .container input:checked~.checkmark {
            background-color: #fa518d;
        }
        /* Create the checkmark/indicator (hidden when not checked) */
        
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
        /* Show the checkmark when checked */
        
        .container input:checked~.checkmark:after {
            display: block;
        }
        /* Style the checkmark/indicator */
        
        .container .checkmark:after {
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
        
        .container2:hover input~.checkmark2 {
            background-color: #ccc;
        }
        /* When the radio button is checked, add a blue background */
        
        .container2 input:checked~.checkmark2 {
            background-color: #fa518d;
        }
        /* Create the indicator (the dot/circle - hidden when not checked) */
        
        .checkmark2:after {
            content: "";
            position: absolute;
            display: none;
        }
        /* Show the indicator (dot/circle) when checked */
        
        .container2 input:checked~.checkmark2:after {
            display: block;
        }
        /* Style the indicator (dot/circle) */
        
        .container2 .checkmark2:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }
    </style>

</head>

<body>
    
    <?php 
    
    if(isset($_POST['insert'])){
    $volunteer = $_GET['volunteer'];
    $case_id = $_GET['case_id'];
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
    $like_to_do_next = $_POST['like_to_do_next'];
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
 `victim_in_danger`, `any_advance_r_serious_injury`, `final_notes_n_thought_abt_client`, `feeling_interaction_with_client`, `good_r_bad_abt_shift`,like_to_do_next,case_id) 
 VALUES ('$volunteer','$fullname','$mobile','$new_caller_r_client','$repeat_client_r_admin_inquiry','$caller_name','$caller_phone_num',
 '$why_she_call','$further_details','$name_of_caller','$desc_interaction','$how_call_follow_up','$shift_u_on','$date',
 '$time','$client_first_name','$client_last_name','$client_phone_num','$client_country','$client_country_other','$type_of_call',
 '$type_of_call_other','$how_long_interaction1','$how_long_interaction_others','$did_case_req_payment','$service_r_item_paid_for1',
 '$service_r_item_paid_for_others','$reimbursed','$your_role_in_shamsaha1','$expense_n_purpose','$amount_of_expense','$do_u_have_receipt',
 '$benifit_r_by_cash','$complete_address','$abuse_she_face','$abuse_she_face_other','$interaction_for','$interaction_for_other',
 '$relationship_of_perpet_to_victim','$relationship_of_perpet_to_victim_other','$first_time_r_repeat_violence','$summary_of_case_n_reason',
 '$client_follow_up','$is_it_safe_to_cal_back','$client_info_abt_ofc_hrs','$any_sign_of_suicide_r_harm','$discuss_r_safe_plan','$any_referrals',
 '$client_ethnicity','$client_ethnicity_other','$client_age','$marital_status','$marital_status_other','$client_have_children','$client_employed',
 '$what_she_do','$recomment_care','$recomment_care_other','$perpetrator_access_to_gun','$violence_towards_victim','$perpetrator_mem_of_police',
 '$victim_in_danger','$any_advance_r_serious_injury','$final_notes_n_thought_abt_client','$feeling_interaction_with_client','$good_r_bad_abt_shift', '$like_to_do_next', '$case_id')");
    
     if($sql){
     echo "<script>alert('Success')</script>";
 }else{
     echo "<script>alert('fail')</script>";
 }
    
    
    } ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"> 
        
         <!--<form method="post" action="insert.php">-->

<input type="hidden" name="volunteer" value="<?php echo $_GET['volunteer_id']; ?>">
<!--<input type="hidden" name="volunteer" value="1">-->

        <div class="row" id="sec1">
            <div class="form-group">
                <label for="exampleInputEmail1">What is your full name? </label>
                <input type="text" class="form-control" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">What is your most up to date mobile number?</label>
                <input type="text" class="form-control" name="mobile" required>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec2();" id="b1"> Next</button>
            </div>
        </div>

        <div class="row" id="sec2">
            <div class="form-group">
                <label for="exampleInputPassword1">Was this a new caller or client requesting advocacy support from Shamsaha 
                        because of some form of abuse?</label>
                <label class="container2">Yes
                            <input type="radio" id="new_caller_r_client" name="new_caller_r_client" value="Yes" onclick="sec3();"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" id="new_caller_r_client2" name="new_caller_r_client" value="No" onclick="sec3();"><span class="checkmark2"></span>
                        </label>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec3();" id="b2">Next</button>
            </div>
        </div>

        <div class="row" id="sec3">
            <div class="form-group">
                <label for="exampleInputPassword1">Was this client a repeat client or an administrative inquiry?</label>
                <label class="container2">Repeat client or caller
                            <input type="radio" name="repeat_client_r_admin_inquiry" value="Repeat client or caller"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Administrative inquiry
                            <input type="radio" name="repeat_client_r_admin_inquiry" value="Administrative inquiry"><span class="checkmark2"></span>
                        </label>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">What was the name of the caller? </label>
                <input type="text" class="form-control" name="caller_name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">What was the caller's phone number? </label>
                <input type="text" class="form-control" name="caller_phone_num" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Why was she calling?</label>
                <input type="text" class="form-control" name="why_she_call" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Any notes or further details you think we should know?</label>
                <input type="text" class="form-control" name="further_details" required>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec4();" id="b3">Next</button>
            </div>
        </div>

        <div class="row" id="sec4">
            <div class="form-group">
                <label for="exampleInputEmail1">Please tell us the name of the caller.</label>
                <input type="text" class="form-control" name="name_of_caller" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Please describe the interaction.</label>
                <input type="text" class="form-control" name="desc_interaction" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Please describe how this call needs to be followed up on. (Did you promise them a call back? Etc) </label>
                <input type="text" class="form-control" name="how_call_follow_up" required>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec5();" id="b4">Next</button>
            </div>
        </div>

        <div class="row" id="sec5">
            <div class="form-group">
                <label for="exampleInputPassword1">Which type of language specific shift were you on?</label><br>
                <label class="container2">English Advocacy
                            <input type="radio" name="shift_u_on" value="English Advocacy"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Arabic Advocacy
                            <input type="radio" name="shift_u_on" value="Arabic Advocacy"><span class="checkmark2"></span>
                        </label>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">When did you receive this advocacy client?</label><br>

                <div class="row">
                    <div class="col-xs-6">
                        <label for="exampleInputPassword1">Date</label>
                        <input type="date" class="form-control" name="date" id="password">
                    </div>
                    <div class="col-xs-6">
                        <label for="exampleInputPassword1">Time</label>
                        <input type="time" class="form-control" name="time" id="password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Client's first name? (If you do not know, type "unknown".)</label>
                <input type="text" class="form-control" name="client_first_name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Client's last name? (If you do not know, type "unknown".)</label>
                <input type="text" class="form-control" name="client_last_name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Client's phone number (look in the call log on the phone)? </label>
                <input type="text" class="form-control" name="client_phone_num">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">From which country was the client contacting us?</label>
                <label class="container2">Bahrain
                            <input type="radio" name="client_country" value="Bahrain"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Saudi Arabia
                            <input type="radio" name="client_country" value="Saudi Arabia"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Kuwait
                            <input type="radio" name="client_country" value="Kuwait"><span class="checkmark2"></span>
                        </label>
                <label class="container2">United Arab Emirates
                            <input type="radio" name="client_country" value="United Arab Emirates"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Oman
                            <input type="radio" name="client_country" value="Oman"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Qatar
                            <input type="radio" name="client_country" value="Qatar"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other
                            <input type="radio" name="client_country" value="Other"><span class="checkmark2"></span>
                        </label>
                <input type="text" class="form-control" name="client_country_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Which type of call was this?</label>
                <label class="container2">Hospital AMH Manama - Bahrain
                            <input type="radio" name="type_of_call" value="Hospital AMH Manama - Bahrain"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Hospital AMH Amwaj - Bahrain
                            <input type="radio" name="type_of_call" value="Hospital AMH Amwaj - Bahrain"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Hospital AMH Saar - Bahrain
                            <input type="radio" name="type_of_call" value="Hospital AMH Saar - Bahrain"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Hospital AMH Riffa - Bahrain
                            <input type="radio" name="type_of_call" value="Hospital AMH Riffa - Bahrain"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other hospital
                            <input type="radio" name="type_of_call" value="Other hospital"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Telephone talking
                            <input type="radio" name="type_of_call" value="Telephone talking"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Telephone text
                            <input type="radio" name="type_of_call" value="Telephone text"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Office advocacy
                            <input type="radio" name="type_of_call" value="Office advocacy"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Police station
                            <input type="radio" name="type_of_call" value="Police station"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Court house
                            <input type="radio" name="type_of_call" value="Court house"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Government shelter
                            <input type="radio" name="type_of_call" value="Government shelter"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Friend/Outside advocacy
                            <input type="radio" name="type_of_call" value="Friend/Outside advocacy"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other
                            <input type="radio" name="type_of_call" value="Other"><span class="checkmark2"></span>
                        </label>
                <input type="text" class="form-control" name="type_of_call_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Approximately how long was your interaction?</label><br>
                <label class="container">0 to 30 minutes
                            <input type="checkbox" name="how_long_interaction[]" value="0 to 30 minutes"><span class="checkmark"></span>
                        </label>
                <label class="container">30 to 60 minutes
                            <input type="checkbox" name="how_long_interaction[]" value="30 to 60 minutes"><span class="checkmark"></span>
                        </label>
                <label class="container">60 to 120 minutes
                            <input type="checkbox" name="how_long_interaction[]" value="60 to 120 minutes"><span class="checkmark"></span>
                        </label>
                <label class="container">Others
                            <input type="checkbox" name="how_long_interaction[]" value="Others"><span class="checkmark"></span>
                        </label>
                <input type="text" class="form-control" name="how_long_interaction_others" id="password">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did this case require payment for anything (taxi, hotel, food, etc)?</label>
                <label class="container2">Yes
                            <input type="radio" name="did_case_req_payment" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="did_case_req_payment" value="No"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec6();" id="b5">Next</button>
            </div>
        </div>

        <div class="row" id="sec6">
            <div class="form-group">
                <label for="exampleInputPassword1">What services/items were paid for?</label>
                <label class="container">Food
                            <input type="checkbox" name="service_r_item_paid_for[]" value="Food"><span class="checkmark"></span>
                        </label>
                <label class="container">Taxi
                            <input type="checkbox" name="service_r_item_paid_for[]" value="Taxi"><span class="checkmark"></span>
                        </label>
                <label class="container">Hotel
                            <input type="checkbox" name="service_r_item_paid_for[]" value="Hotel"><span class="checkmark"></span>
                        </label>
                <label class="container">Medical
                            <input type="checkbox" name="service_r_item_paid_for[]" value="Medical"><span class="checkmark"></span>
                        </label>
                <label class="container">Others
                            <input type="checkbox" name="service_r_item_paid_for[]" value="Others"><span class="checkmark"></span>
                        </label>
                <input type="text" class="form-control" name="service_r_item_paid_for_others">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did you pay for anything personally, for which you need to be reimbursed? If yes - please click here to complete the reimbursement form. https://forms.gle/oDq9RZAeVJv7BXtAA (also at top of this form) </label>
                <label class="container2">Yes
                            <input type="radio" name="reimbursed" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="reimbursed" value="No"><span class="checkmark2"></span>
                        </label>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec7();" id="b6">Next</button>
            </div>
        </div>


        <div class="row" id="sec7">
            <div class="form-group">
                <label for="exampleInputPassword1">What is your role in Shamsaha ? </label>
                <label class="container">Advocate
                            <input type="checkbox" name="your_role_in_shamsaha[]" value="Advocate"><span class="checkmark"></span>
                        </label>
                <label class="container">Intern
                            <input type="checkbox" name="your_role_in_shamsaha[]" value="Intern"><span class="checkmark"></span>
                        </label>
                <label class="container">Staff
                            <input type="checkbox" name="your_role_in_shamsaha[]" value="Staff"><span class="checkmark"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">What was the expense and the purpose?</label>
                <input type="text" class="form-control" name="expense_n_purpose">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">What was the exact amount of the expense?</label>
                <input type="text" class="form-control" name="amount_of_expense">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Do you have the receipt? (This is required for reimbursement. Please save it and give to us when you get your refund and/or take a photo and email it to nrahman@shamsaha.org.)</label>
                <label class="container2">Yes
                            <input type="radio" name="do_u_have_receipt" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="do_u_have_receipt" value="No"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Would you like to be reimbursed by benefit pay or by cash home delivery? </label>
                <label class="container2">Benefit Pay
                            <input type="radio" name="benifit_r_by_cash" value="Benefit Pay"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Home delivery
                            <input type="radio" name="benifit_r_by_cash" value="Home delivery"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">What is your completed home address? </label>
                <input type="text" class="form-control" name="complete_address">
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec8();" id="b7">Next</button>
            </div>
        </div>


        <div class="row" id="sec8">
            <div class="form-group">
                <label for="exampleInputPassword1">What type of abuse is she facing? </label>
                <label class="container">Physical violence, from intimate partner
                            <input type="radio" name="abuse_she_face" value="Physical violence, from intimate partner"><span class="checkmark"></span>
                        </label>
                <label class="container">Physical violence, from employer
                            <input type="radio" name="abuse_she_face" value="Physical violence, from employer"><span class="checkmark"></span>
                        </label>
                <label class="container">Emotional/psychological/financial violence, from intimate partner
                            <input type="radio" name="abuse_she_face" value="Emotional/psychological/financial violence, from intimate partner"><span class="checkmark"></span>
                        </label>
                <label class="container">Sexual violence, from intimate partner
                            <input type="radio" name="abuse_she_face" value="Sexual violence, from intimate partner"><span class="checkmark"></span>
                        </label>
                <label class="container">Sexual violence from acquaintance (not intimate partner)
                            <input type="radio" name="abuse_she_face" value="Sexual violence from acquaintance (not intimate partner)"><span class="checkmark"></span>
                        </label>
                <label class="container">Sexual violence from employer
                            <input type="radio" name="abuse_she_face" value="Sexual violence from employer"><span class="checkmark"></span>
                        </label>
                <label class="container">Sexual violence from stranger
                            <input type="radio" name="abuse_she_face" value="Sexual violence from stranger"><span class="checkmark"></span>
                        </label>
                <label class="container">Other type of family or general violence
                            <input type="radio" name="abuse_she_face" value="Other type of family or general violence"><span class="checkmark"></span>
                        </label>
                <label class="container">Other type of harassment or discrimination
                            <input type="radio" name="abuse_she_face" value="Other type of harassment or discrimination"><span class="checkmark"></span>
                        </label>
                <label class="container">Other type of "non abuse" or "non discrimination" but upset about relationship issues
                            <input type="radio" name="abuse_she_face" value="Other type of non abuse or non discrimination but upset about relationship issues"><span class="checkmark"></span>
                        </label>
                <label class="container">Other
                            <input type="radio" name="abuse_she_face" value="Other"><span class="checkmark"></span>
                        </label>
                <input type="text" class="form-control" name="abuse_she_face_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Was this interaction for </label>
                <label class="container2">The caller herself
                            <input type="radio" name="interaction_for" value="The caller herself"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Somebody else about whom the caller is asking
                            <input type="radio" name="interaction_for" value="Somebody else about whom the caller is asking"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other
                            <input type="radio" name="interaction_for" value="Other"><span class="checkmark2"></span>
                        </label>
                <input type="text" class="form-control" name="interaction_for_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">What is the relationship of the perpetrator to the victim?</label>
                <label class="container2">Husband
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Husband"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Boyfriend
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Boyfriend"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Ex-husband
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Ex-husband"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Ex-boyfriend
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Ex-boyfriend"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Fiance
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Fiance"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Acquaintance (or date)
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Acquaintance (or date)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Family member
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Family member"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Sponsor/Employer
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Sponsor/Employer"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Stranger
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Stranger"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Unknown (You should not choose this option often)
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Unknown (You should not choose this option often)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Not relevant"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other
                            <input type="radio" name="relationship_of_perpet_to_victim" value="Other"><span class="checkmark2"></span>
                        </label>
                <input type="text" class="form-control" name="relationship_of_perpet_to_victim_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Was this the first time, or repeat violence?</label>
                <label class="container2">First time ever
                            <input type="radio" name="first_time_r_repeat_violence" value="First time ever"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Repeated violence
                            <input type="radio" name="first_time_r_repeat_violence" value="Repeated violence"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="first_time_r_repeat_violence" value="I dont know"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="first_time_r_repeat_violence" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Give summary of case and reason for call</label>
                <input type="text" class="form-control" name="summary_of_case_n_reason">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did the client state what she would like to do next? If yes, explain. </label>
                <input type="text" class="form-control" name="like_to_do_next">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Does the client want follow up from Shamsaha? </label>
                <label class="container2">Yes
                            <input type="radio" name="client_follow_up" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="client_follow_up" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not sure (you should not choose this option often)
                            <input type="radio" name="client_follow_up" value="Not sure (you should not choose this option often)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="client_follow_up" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Is it safe for Shamsaha? to call her back? </label>
                <label class="container2">Yes
                            <input type="radio" name="is_it_safe_to_cal_back" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="is_it_safe_to_cal_back" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know (you should not choose this option often)
                            <input type="radio" name="is_it_safe_to_cal_back" value="I dont know (you should not choose this option often)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="is_it_safe_to_cal_back" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did you give the client information about Shamsaha office hours/location for case work support? </label>
                <label class="container2">Yes
                            <input type="radio" name="client_info_abt_ofc_hrs" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No (If not, explain why in the notes at the end.)
                            <input type="radio" name="client_info_abt_ofc_hrs" value="No (If not, explain why in the notes at the end.)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="client_info_abt_ofc_hrs" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did the client display any sign of being suicidal or at risk of harming themselves or others? </label>
                <label class="container2">No
                            <input type="radio" name="any_sign_of_suicide_r_harm" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Yes, and I immediately recommended that they visit any hospital, and informed her of Shamsaha suicide/homicide policy.
                            <input type="radio" name="any_sign_of_suicide_r_harm" value="Yes, and I immediately recommended that they visit any hospital, and informed her of Shamsaha suicide/homicide policy."><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did you discuss or complete a safety plan? </label>
                <label class="container">Yes
                            <input type="checkbox" name="discuss_r_safe_plan" value="Yes"><span class="checkmark"></span>
                        </label>
                <label class="container">No (If not, explain why in the notes)
                            <input type="checkbox" name="discuss_r_safe_plan" value="No (If not, explain why in the notes)"><span class="checkmark"></span>
                        </label>
                <label class="container">Not relevant: Not in further danger or administrative type of call
                            <input type="checkbox" name="discuss_r_safe_plan" value="Not relevant: Not in further danger or administrative type of call"><span class="checkmark"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Did you make any referrals? If so, list which referrals you made. </label>
                <input type="text" class="form-control" name="any_referrals">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">To the best of your knowledge, what was the client's ethnicity?  </label>
                <label class="container2">Arab (Bahrain)
                            <input type="radio" name="client_ethnicity" value="Arab (Bahrain)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Arab (GCC)
                            <input type="radio" name="client_ethnicity" value="Arab (GCC)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Central Asian (Pakistan, Afghanistan, Bangladesh)
                            <input type="radio" name="client_ethnicity" value="Central Asian (Pakistan, Afghanistan, Bangladesh)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Indian
                            <input type="radio" name="client_ethnicity" value="Indian"><span class="checkmark2"></span>
                        </label>
                <label class="container2">SriLankan
                            <input type="radio" name="client_ethnicity" value="SriLankan"><span class="checkmark2"></span>
                        </label>
                <label class="container2">North East Asian (China, Japan, Etc)
                            <input type="radio" name="client_ethnicity" value="North East Asian (China, Japan, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">South East Asian (Thailand, Philippines, Indonesian, Etc)
                            <input type="radio" name="client_ethnicity" value="South East Asian (Thailand, Philippines, Indonesian, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">North African (Egypt, Sudan, Morocco, Tunisia, Etc)
                            <input type="radio" name="client_ethnicity" value="North African (Egypt, Sudan, Morocco, Tunisia, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Sub-Saharan African (Kenya, Ghana, South Africa, Etc)
                            <input type="radio" name="client_ethnicity" value="Sub-Saharan African (Kenya, Ghana, South Africa, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">North American (USA, Canada)
                            <input type="radio" name="client_ethnicity" value="North American (USA, Canada)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">South American/Central American (Mexico, Brazil, Etc)
                            <input type="radio" name="client_ethnicity" value="South American/Central American (Mexico, Brazil, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Western Europe (UK, France, Etc)
                            <input type="radio" name="client_ethnicity" value="Western Europe (UK, France, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Eastern Europe (Russia, Ukraine, Slovakia, Etc)
                            <input type="radio" name="client_ethnicity" value="Eastern Europe (Russia, Ukraine, Slovakia, Etc)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Pacific Islander (New Zealand, Australia, Islander)
                            <input type="radio" name="client_ethnicity" value="Pacific Islander (New Zealand, Australia, Islander)"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Unknown
                            <input type="radio" name="client_ethnicity" value="Unknown"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="client_ethnicity" value="Not relevant"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other
                            <input type="radio" name="client_ethnicity" value="Other"><span class="checkmark2"></span>
                        </label>
                <input type="text" class="form-control" name="client_ethnicity_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Client age? </label>
                <label class="container2">13 to 17
                            <input type="radio" name="client_age" value="13 to 17"><span class="checkmark2"></span>
                        </label>
                <label class="container2">18 to 25
                            <input type="radio" name="client_age" value="18 to 25"><span class="checkmark2"></span>
                        </label>
                <label class="container2">26 to 45
                            <input type="radio" name="client_age" value="26 to 45"><span class="checkmark2"></span>
                        </label>
                <label class="container2">45 +
                            <input type="radio" name="client_age" value="45 +"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="client_age" value="I dont know"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Client marital status?</label>
                <label class="container2">Single
                            <input type="radio" name="marital_status" value="Single"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Married
                            <input type="radio" name="marital_status" value="Married"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Divorced
                            <input type="radio" name="marital_status" value="Divorced"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Separated
                            <input type="radio" name="marital_status" value="Separated"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Widowed
                            <input type="radio" name="marital_status" value="Widowed"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Engaged
                            <input type="radio" name="marital_status" value="Engaged"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Unknown
                            <input type="radio" name="marital_status" value="Unknown"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Other
                            <input type="radio" name="marital_status" value="Other"><span class="checkmark2"></span>
                        </label>
                <input type="text" class="form-control" name="marital_status_other">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Does the client have children?</label>
                <label class="container2">Yes
                            <input type="radio" name="client_have_children" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="client_have_children" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Unknown
                            <input type="radio" name="client_have_children" value="Unknown"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Is the client employed?</label>
                <label class="container2">Yes
                            <input type="radio" name="client_employed" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="client_employed" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="client_employed" value="I dont know"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">If the answer to the employment question above is "yes", explain what she does and for whom? </label>
                <input type="text" class="form-control" name="what_she_do">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">If you could recommend care for this client in any language, which would it be?  </label>
                <label class="container">English
                            <input type="checkbox" name="recomment_care[]" value="English"><span class="checkmark"></span>
                        </label>
                <label class="container">Arabic
                            <input type="checkbox" name="recomment_care[]" value="Arabic"><span class="checkmark"></span>
                        </label>
                <label class="container">Other
                            <input type="checkbox" name="recomment_care[]" value="Other"><span class="checkmark"></span>
                        </label>
                <input type="text" class="form-control" name="recomment_care_other">
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec9();" id="b8">Next</button>
            </div>
        </div>


        <div class="row" id="sec9">

            <div class="form-group">
                <label for="exampleInputPassword1">Does the perpetrator have access to a gun?  </label>
                <label class="container2">Yes
                            <input type="radio" name="perpetrator_access_to_gun" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="perpetrator_access_to_gun" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="perpetrator_access_to_gun" value="I dont know"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="perpetrator_access_to_gun" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Has the violence towards the victim been escalating recently? </label>
                <label class="container2">Yes
                            <input type="radio" name="violence_towards_victim" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="violence_towards_victim" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="violence_towards_victim" value="I dont know"><span class="checkmark2"></span>
                        </label>
                <label class="container2">First time: Not relevant
                            <input type="radio" name="violence_towards_victim" value="First time: Not relevant"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="violence_towards_victim" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Is the perpetrator a member of the police or military?  </label>
                <label class="container2">Yes
                            <input type="radio" name="perpetrator_mem_of_police" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="perpetrator_mem_of_police" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="perpetrator_mem_of_police" value="I dont know"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="perpetrator_mem_of_police" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Is the victim in danger tonight? </label>
                <label class="container2">Yes, she is in danger and has nowhere safe to sleep tonight.
                            <input type="radio" name="victim_in_danger" value="Yes, she is in danger and has nowhere safe to sleep tonight."><span class="checkmark2"></span>
                        </label>
                <label class="container2">No, she has a safe place to sleep.
                            <input type="radio" name="victim_in_danger" value="No, she has a safe place to sleep."><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="victim_in_danger" value="I dont know"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="victim_in_danger" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Were there any advanced or serious injuries as a result of this incident? </label>
                <label class="container2">Yes
                            <input type="radio" name="any_advance_r_serious_injury" value="Yes"><span class="checkmark2"></span>
                        </label>
                <label class="container2">No
                            <input type="radio" name="any_advance_r_serious_injury" value="No"><span class="checkmark2"></span>
                        </label>
                <label class="container2">I dont know
                            <input type="radio" name="any_advance_r_serious_injury" value="I dont know"><span class="checkmark2"></span>
                        </label>
                <label class="container2">Not relevant
                            <input type="radio" name="any_advance_r_serious_injury" value="Not relevant"><span class="checkmark2"></span>
                        </label>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d" onclick="sec0();" id="b9">Next</button>
            </div>
        </div>


        <div class="row" id="sec0">

            <div class="form-group">
                <label for="exampleInputEmail1">Your final notes and thoughts about case/client. </label>
                <input type="text" class="form-control" name="final_notes_n_thought_abt_client" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">How were you feeling during your interactions with the client? </label>
                <input type="text" class="form-control" name="feeling_interaction_with_client" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Please choose any one thing good or bad that you would like us to know about your shift. </label>
                <input type="text" class="form-control" name="good_r_bad_abt_shift" required>
            </div>

            <div class="form-group">
                <!--<button type="submit" name="submit" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d">Submit</button>-->
                <input type="submit" name="insert" class="btn btn-primary" style="color:#fff; background-color:#fa518d; border-color:#fa518d">
            </div>

        </div>



    </form>

    <script>
        document.getElementById("sec2").style.display = "none";
        document.getElementById("sec3").style.display = "none";
        document.getElementById("sec4").style.display = "none";
        document.getElementById("sec5").style.display = "none";
        document.getElementById("sec6").style.display = "none";
        document.getElementById("sec7").style.display = "none";
        document.getElementById("sec8").style.display = "none";
        document.getElementById("sec9").style.display = "none";
        document.getElementById("sec0").style.display = "none";

        function sec2() {

            document.getElementById("sec2").style.display = "block";
            document.getElementById("b1").style.display = "none";
        }

        function sec3() {
            if (document.getElementById('new_caller_r_client').checked) {
                var rate_value = document.getElementById('new_caller_r_client').value;

                if (rate_value == "Yes") {
                    document.getElementById("sec5").style.display = "block";
                    document.getElementById("sec3").style.display = "none";

                    document.getElementById("b2").style.display = "none";


                }

            }

            if (document.getElementById('new_caller_r_client2').checked) {
                var rate_value2 = document.getElementById('new_caller_r_client2').value;

                if (rate_value2 == "No") {
                    document.getElementById("sec3").style.display = "block";
                    document.getElementById("sec5").style.display = "none";

                    document.getElementById("b2").style.display = "none";


                }

            }

        }

        function sec4() {

            document.getElementById("sec4").style.display = "block";
            document.getElementById("b3").style.display = "none";
        }

        function sec5() {

            document.getElementById("sec5").style.display = "block";
            document.getElementById("b4").style.display = "none";
        }

        function sec6() {

            document.getElementById("sec6").style.display = "block";
            document.getElementById("b5").style.display = "none";
        }

        function sec7() {

            document.getElementById("sec7").style.display = "block";
            document.getElementById("b6").style.display = "none";
        }

        function sec8() {

            document.getElementById("sec8").style.display = "block";
            document.getElementById("b7").style.display = "none";
        }

        function sec9() {

            document.getElementById("sec9").style.display = "block";
            document.getElementById("b8").style.display = "none";
        }
        
        function sec0() {

            document.getElementById("sec0").style.display = "block";
            document.getElementById("b9").style.display = "none";
        }
    </script>


</body>

</html>