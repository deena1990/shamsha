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
            <div class="row validationReq" id="sec3">
                <h2 class="text-center">SHORT FORM</h2>
                <p>The short form is to be completed for the following reasons:</p>
                <ul>
                    <li>You had a repeat client that is already in touch with the case worker.</li>
                    <li>You had some sort of interaction on the helpline, but it did not warrant a full report, such as
                        a volunteer inquiry.
                    </li>
                    <li> For ALL "hang up" or "spam" calls, and/or calls that do not fit Shamsaha's mandate, and thus
                        none of the questions were relevant, such as someone wanting a new job or visa.
                    </li>
                    <li>If you had problems with any part of your shift, or if you need to inform us of anything
                        additional information.
                    </li>
                </ul>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="questionLabel">Was this client a repeat client or an
                        administrative inquiry? <span class="error">*</span></label>
                    <label class="container2">Repeat client or caller
                        <input type="radio" name="repeat_client_r_admin_inquiry" class="required"
                               value="Repeat client or caller"><span class="checkmark2"></span>
                    </label>
                    <label class="container2">Administrative inquiry or other
                        <input type="radio" name="repeat_client_r_admin_inquiry" class="required"
                               value="Administrative inquiry or other"><span class="checkmark2"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="tab">

            <div id="normalSection">
                <div class="row validationReq" id="normalSection1">
                    <div class="form-group">
                        <label class="questionLabel">What was the name of the caller? <span
                                    class="error">*</span></label>
                        <input type="text" class="form-control required" name="caller_name">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">What was the caller's phone number? <span
                                    class="error">*</span></label>
                        <input type="text" class="form-control required" name="caller_phone_num">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Why was she calling? <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="why_she_call">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Any notes or further details you think we should know? <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="further_details">
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

            <div id="administrativeSection">
                <div class="row">
                    <h4>Administrative/Other Inquiries</h4>
                    <p>This section is for calls such as volunteer inquiries, questions, or sponsorships.</p>
                    <div class="form-group">
                        <label class="questionLabel">Was this a spam call/chat? <span class="error">*</span></label>
                        <label class="container2">Yes
                            <input type="radio" class="required" name="spam_call_chat" value="Yes"><span
                                    class="checkmark2"></span>
                        </label>
                        <label class="container2">No
                            <input type="radio" class="required" name="spam_call_chat" value="No"><span
                                    class="checkmark2"></span>
                        </label>
                        <label class="container2">Maybe
                            <input type="radio" class="required" name="spam_call_chat" value="Maybe"><span
                                    class="checkmark2"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Please tell us the name of the caller. <span class="error">*</span></label>
                        <input type="text" class="form-control" name="name_of_caller">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Please describe the interaction. <span
                                    class="error">*</span></label>
                        <input type="text" class="form-control required" name="desc_interaction">
                    </div>
                    <div class="form-group">
                        <label class="questionLabel">Please describe how this call needs to be followed up on. (Did you
                            promise them a call back? Etc) <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="how_call_follow_up">
                    </div>
                </div>
            </div>

        </div>

        <div class="tab">
            <div class="row validationReq">
                <h4>Closing and final notes</h4>
                <p>Please use this section to tell us about your thoughts and feelings, as well as any challenges you
                    had with the case, or any part of the interaction.</p>
                <div class="form-group">
                    <label class="questionLabel">Your final notes and thoughts about case/client.<span class="error">*</span> </label>
                    <input type="text" class="form-control required" name="final_notes_n_thought_abt_client">
                </div>

                <div class="form-group">
                    <label class="questionLabel">How were you feeling during your interactions with the client?<span class="error">*</span> </label>
                    <input type="text" class="form-control required" name="feeling_interaction_with_client">
                </div>

                <div class="form-group">
                    <label class="questionLabel">Please choose any one thing good or bad that you would like us to know
                        about your shift.<span class="error">*</span> </label>
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
        $("input[name='repeat_client_r_admin_inquiry']").change(function () {
            if ($("input[name='repeat_client_r_admin_inquiry']:checked")) {
                var value = $("input[name='repeat_client_r_admin_inquiry']:checked").val();
                if (value == 'Repeat client or caller') {
                    $("#administrativeSection").hide();
                    $("#normalSection").show();
                    $("#normalSection1").addClass('validationReq');
                    $("#administrativeSection").removeClass('validationReq');
                }
                if (value == 'Administrative inquiry or other') {
                    $("#normalSection").hide();
                    $("#administrativeSection").show();
                    $("#administrativeSection").addClass('validationReq');
                    $("#normalSection1").removeClass('validationReq');
                    $("#reimbursementSection").removeClass('validationReq');
                }
            }
        });


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

    });

    $(function () {
        $(document).on('click','#submitBtn', function (e) {
            if (!validateForm()) return false;
            e.preventDefault();
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
