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
    <?php if($intake_form_details){ ?> 
    <div class="container text-center">
        <h3> <strong>Intake Form Details</strong> </h3>
        <div class="form-group">
            <label class="questionLabel">What is your name ? </label>
            <p class="answerQuest"><?= ucfirst($intake_form_details['screen_name']) ?></p>
        </div>
        <div class="form-group">
            <label class="questionLabel">How old are you ?  </label>
            <p class="answerQuest"><?= $intake_form_details['age']." Years" ?></p>
        </div>
        <div class="form-group">
            <label class="questionLabel">What is your gender ? </label>
            <p class="answerQuest"><?= ucfirst($intake_form_details['gender']) ?></p>
        </div>
        <div class="form-group">
            <label class="questionLabel">Is it safe to call you back if the line gets disconnected ? </label>
            <p class="answerQuest"><?= ucfirst($intake_form_details['safe_to_call']) ?></p>
        </div>
        <?php if(strtolower($intake_form_details['safe_to_call']) == "yes"){ ?>
        <div class="form-group">
            <label class="questionLabel">What is phone munber ? </label>
            <p class="answerQuest"><?= $intake_form_details['mobile'] ?></p>
        </div>
        <?php } ?> 
        <div class="form-group">
            <label class="questionLabel">Where are you contacting us from ? </label>
            <p class="answerQuest"><?= $intake_form_details['race_or_ethnicity'] ?></p>
        </div>
    </div>
    <?php } else { ?> 
    <div class="container text-center">
        <h3> <strong>Intake Form Details</strong> </h3>
        <p> No Record Found </p>
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
