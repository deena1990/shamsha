<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shamsaha's Client Feedback Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <style>
        /* .rating {
            float: left;
        } */

        /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
          follow these rules. Every browser that supports :checked also supports :not(), so
          it doesn’t make the test unnecessarily selective */
        /* .rating:not(:checked) > input {
            position:absolute;
            clip:rect(0,0,0,0);
        } */

        .rating:not(:checked) > label {
            float:right;
            width:50px;
            /* padding:0 .1em; */
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:15px;
            /* line-height:1.2; */
            color:#ddd;
            text-align: center;
        }

         /* .rating:not(:checked) > label:before {
            content: '★ ';
            font-size: 30px;
            display: block;
            margin-bottom: 0px;
        } */

        .rating > input:checked ~ label {
            color: #e34587;

        }

        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: #e34587;

        }

        .rating > input:checked + label:hover,
        .rating > input:checked + label:hover ~ label,
        .rating > input:checked ~ label:hover,
        .rating > input:checked ~ label:hover ~ label,
        .rating > label:hover ~ input:checked ~ label {
            color: #e34587;

        }

        .rating > label:active {
            position:relative;
            top:2px;
            left:2px;
        }
        .row{
            padding-left: 20px;
            padding-right: 20px;
        }
        .feedback p{
            margin-bottom: 0;
            margin-top: 25px;
        }
        .form-control,.form-control:focus{
            border: none;
            box-shadow: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
        }
        .btn{
            background-color:#e34587;
            border-color: #e34587;
        }
        .btn-info:hover {
        color: #fff;
        background-color: #e34587!important;
        border-color: #e34587!important;
    }
    .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
    outline: thin dotted;
    outline: none;
    outline-offset: -2px;
}
    </style>
</head>
<body>
<br>

<div class="container feedback">
<?php if($this->session->flashdata('msg')) { ?>

    <div class="alert alert-success text-center" id="mydivs"  role="alert">

        <?php echo $this->session->flashdata('msg'); ?>

    </div>

<?php } ?>

<?php if($this->session->flashdata('error')) { ?>

    <div class="alert alert-danger" id="mydivs"  role="alert">

        <?php echo $this->session->flashdata('error'); ?>

    </div>

<?php } ?>

<style>
    .dateForm {
    width: 210px;
}
.dateForm .form-group span {
    display: inline-block;
    width: 64px;
    line-height: 35px;
    font-weight: 700;
    text-align: center;
    font-size: 18px;
}
    .dateForm .form-group {
      display: flex;
    }
    .dateLabel{
        display: flex;
        justify-content: space-between;
        width: 186px;
        margin: 0 auto;
        color: #aaa;
    }
    .rating {
        margin-top: 34px;
    }
    .rating span {
        width: 26px;
        display: inline-block;
        text-align: center;
    }
    .rating span label {
        display: block;
        text-align: center;
        width: 100%;
        font-weight: 500;
    }
  .rating input[type=radio] {
     line-height: bold;
    accent-color: #e34587;
    margin:1em 0em;
    -webkit-transform:scale(1.5, 1.5);
     -moz-transform:scale(1.5, 1.5);
      -ms-transform:scale(1.5, 1.5);
       -o-transform:scale(1.5, 1.5);
          transform:scale(1.5, 1.5) !important;
}
.itenCenter{
    display: flex;
    justify-content:center;
}

@media screen and (max-width:480px) {
    .rating span {
    width: 25px;
    }
    .container.feedback .row {
        padding: 0 4px;
    }
    
}
</style>
        <h2 class="text-center"><b>Shamsaha's Client Feedback Form</b></h2>
        <h2 class="text-center"><b>ا تاظحلام ءلامع اه</b></h2>
        <p>Please note that this form will not affect your access to any Shamsaha services in the future. All answers are strictly confidential and optional.</p>
        <p style='margin-bottom:10px'>نل رثؤت ىلعتاباجلإا ةيناكمإ كلوصح تامدخل " اهشمش " يف لبقتسملا . عيمج ةبوجلأا ةيرايتخا ة</p>
        <p style='margin-bottom:10px;color:red;'>* Indicates required question</p>
        <form class="" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <label>Today's date</label><span style="color:red;"> * </span><br>
                    <label style='margin-bottom:10px'>مويلا خيرات </label>
                    <!-- <input type="text" class="form-control" name="todayDate" placeholder="Example: January 7, 2019" Required> -->
                    <div class="dateForm">
                        <div class="dateLabel">
                            <span>MM</span>
                            <span>DD</span>
                            <span>YYYY</span>
                        </div>
                        <div class="form-group">
                            <input type="number" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="2" name="todayMonth" id="todayMonth" oninput="dateValidation();">
                            <span>/</span>
                            <input type="number" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="2" name="todayDate" id="todayDate" oninput="dateValidation();">
                            <span>/</span>
                            <input type="number" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" minlength="4" maxlength="4" name="todayYear" id="todayYear" oninput="dateValidation();">
                        </div>
                    </div>
                    <span style="color:red;" class="dateError"></span>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <label>Would you like to leave feedback about the mobile application? ( Mark only one oval. )</label><br>
                    <p style='margin-top:0px'><input type="radio" onchange="return leaveFeedbackFunc('Yes');" name="leaveFeedback" value="Yes"> Yes</p>
                    <p style='margin-top:0px'><input type="radio" onchange="return leaveFeedbackFunc('No');" name="leaveFeedback" value="No"> No</p>
                    <span style="color:red;" class="leaveFeedbackError"></span>
                </div>
            </div><br>
            <div id="sws" style="display:none;">
                <label>Satisfaction with services</label><br><br>
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Overall how satisfied were you with your experience using the Shamsaha app with crisis volunteers?</label><br>
                        <label style='margin-bottom:10px'> بشكل عام، ما مدى رضاك ​​عن تجربتك مع خطوط المساعدة و / أو اللقاءات وجهًا لوجه مع متطوعي "شمسها"؟</label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>Not satisfied<br>غير راضي</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="how_satisfied1" title="1">1</label>
                                    <input type="radio" id="how_satisfied1" name="how_satisfied" value="1" />
                                </span>
                                <span>
                                    <label for="how_satisfied2" title="2">2</label>
                                    <input type="radio" id="how_satisfied2" name="how_satisfied" value="2" />
                                </span>
                                <span>
                                    <label for="how_satisfied3" title="3">3</label>
                                    <input type="radio" id="how_satisfied3" name="how_satisfied" value="3" />
                                </span>
                                <span>
                                    <label for="how_satisfied4" title="4">4</label>
                                    <input type="radio" id="how_satisfied4" name="how_satisfied" value="4" />
                                </span>
                                <span>
                                    <label for="how_satisfied5" title="5">5</label>
                                    <input type="radio" id="how_satisfied5" name="how_satisfied" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Very satisfied<br>راض جدا</p>
                        </div>
                    </div>
                <!-- </div> -->
                <br>
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Did you feel your crisis volunteer was knowledgeable?</label><br>
                        <label style='margin-bottom:10px'>هل شعرت أن المتطوعة لديها معلومات كافية؟</label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>No, not at all<br>لا، على الإطلاق</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="knowledgeable1" title="1">1</label>
                                    <input type="radio" id="knowledgeable1" name="knowledgeable" value="1" />
                                </span>
                                <span>
                                    <label for="knowledgeable2" title="2">2</label>
                                    <input type="radio" id="knowledgeable2" name="knowledgeable" value="2" />
                                </span>
                                <span>
                                    <label for="knowledgeable3" title="3">3</label>
                                    <input type="radio" id="knowledgeable3" name="knowledgeable" value="3" />
                                </span>
                                <span>
                                    <label for="knowledgeable4" title="4">4</label>
                                    <input type="radio" id="knowledgeable4" name="knowledgeable" value="4" />
                                </span>
                                <span>
                                    <label for="knowledgeable5" title="5">5</label>
                                    <input type="radio" id="knowledgeable5" name="knowledgeable" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Yes, very<br>نعم بالتأكيد</p>
                        </div>
                    </div>
                <!-- </div> -->
                <br>
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Did you feel your crisis volunteer was kind? </label><br>
                        <label style='margin-bottom:10px'> هل شعرت أن المتطوعة كانت لطيفة معك؟ </label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>No, not at all<br>لا، على الإطلاق</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="kind1" title="1">1</label>
                                    <input type="radio" id="kind1" name="kind" value="1" />
                                </span>
                                <span>
                                    <label for="kind2" title="2">2</label>
                                    <input type="radio" id="kind2" name="kind" value="2" />
                                </span>
                                <span>
                                    <label for="kind3" title="3">3</label>
                                    <input type="radio" id="kind3" name="kind" value="3" />
                                </span>
                                <span>
                                    <label for="kind4" title="4">4</label>
                                    <input type="radio" id="kind4" name="kind" value="4" />
                                </span>
                                <span>
                                    <label for="kind5" title="5">5</label>
                                    <input type="radio" id="kind5" name="kind" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Yes, very<br>نعم بالتأكيد</p>
                        </div>
                    </div>
                <!-- </div> -->
                <br>
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Overall how satisfied were you with your experience with your ongoing casework support (Which would have started several days after your first call to us)?</label><br>
                        <label style='margin-bottom:10px'> لكشب ،ماع ام ىدم كاضر نع كتبرجت عم معد لمعلا رمتسملا ( يذلا أدبي دعب ةدع مايأ نم كتملاكم ىلولأا انل )؟</label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>Not satisfied<br>غير راضي</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="how_satisfied_with_casework1" title="1">1</label>
                                    <input type="radio" id="how_satisfied_with_casework1" name="how_satisfied_with_casework" value="1" />
                                </span>
                                <span>
                                    <label for="how_satisfied_with_casework2" title="2">2</label>
                                    <input type="radio" id="how_satisfied_with_casework2" name="how_satisfied_with_casework" value="2" />
                                </span>
                                <span>
                                    <label for="how_satisfied_with_casework3" title="3">3</label>
                                    <input type="radio" id="how_satisfied_with_casework3" name="how_satisfied_with_casework" value="3" />
                                </span>
                                <span>
                                    <label for="how_satisfied_with_casework4" title="4">4</label>
                                    <input type="radio" id="how_satisfied_with_casework4" name="how_satisfied_with_casework" value="4" />
                                </span>
                                <span>
                                    <label for="how_satisfied_with_casework5" title="5">5</label>
                                    <input type="radio" id="how_satisfied_with_casework5" name="how_satisfied_with_casework" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Very satisfied<br>راض جدا</p>
                        </div>
                    </div>
                <!-- </div> -->
                <br>
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Did you feel your caseworker (Who would have called you several days after your first call to us) was knowledgeable? </label><br>
                        <label style='margin-bottom:10px'>هل شعرت أن مسؤول الحالة الخاص بك (الذي كان سيتصل بك بعد عدة أيام من مكالمتك الأولى لنا) كان على دراية؟</label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>No, not at all<br>لا، على الإطلاق</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="caseworker_knowledgeable1" title="1">1</label>
                                    <input type="radio" id="caseworker_knowledgeable1" name="caseworker_knowledgeable" value="1" />
                                </span>
                                <span>
                                    <label for="caseworker_knowledgeable2" title="2">2</label>
                                    <input type="radio" id="caseworker_knowledgeable2" name="caseworker_knowledgeable" value="2" />
                                </span>
                                <span>
                                    <label for="caseworker_knowledgeable3" title="3">3</label>
                                    <input type="radio" id="caseworker_knowledgeable3" name="caseworker_knowledgeable" value="3" />
                                </span>
                                <span>
                                    <label for="caseworker_knowledgeable4" title="4">4</label>
                                    <input type="radio" id="caseworker_knowledgeable4" name="caseworker_knowledgeable" value="4" />
                                </span>
                                <span>
                                    <label for="caseworker_knowledgeable5" title="5">5</label>
                                    <input type="radio" id="caseworker_knowledgeable5" name="caseworker_knowledgeable" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Yes, very<br>نعم بالتأكيد</p>
                        </div>
                    </div>
                <!-- </div> -->
                <br>
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Did you feel your caseworker (Who would have called you several days after your first call to us) was kind? </label><br>
                        <label style='margin-bottom:10px'>هل شعرت أن مسؤول الحالة الخاص بك (الذي كان سيتصل بك بعد عدة أيام من مكالمتك الأولى لنا) كان لطيفًا؟</label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>No, not at all<br>لا، على الإطلاق</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="caseworker_kind1" title="1">1</label>
                                    <input type="radio" id="caseworker_kind1" name="caseworker_kind" value="1" />
                                </span>
                                <span>
                                    <label for="caseworker_kind2" title="2">2</label>
                                    <input type="radio" id="caseworker_kind2" name="caseworker_kind" value="2" />
                                </span>
                                <span>
                                    <label for="caseworker_kind3" title="3">3</label>
                                    <input type="radio" id="caseworker_kind3" name="caseworker_kind" value="3" />
                                </span>
                                <span>
                                    <label for="caseworker_kind4" title="4">4</label>
                                    <input type="radio" id="caseworker_kind4" name="caseworker_kind" value="4" />
                                </span>
                                <span>
                                    <label for="caseworker_kind5" title="5">5</label>
                                    <input type="radio" id="caseworker_kind5" name="caseworker_kind" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Yes, very<br>نعم بالتأكيد</p>
                        </div>
                    </div>
                <!-- </div> -->
                <br>

                <!-- <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <label>Would you recommend Shamsaha's services to others?</label><br>
                        <label style='margin-bottom:10px'>هل ستنصح الآخرين بخدمات "شمسها"؟</label>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-2 col-xs-3">
                            <p>No, never<br>لا أبدا</p>
                        </div>
                        <div class="col-md-3 col-xs-6 itenCenter">
                            <div class="rating">
                                <span>
                                    <label for="recommend1" title="1">1</label>
                                    <input type="radio" id="recommend1" name="recommend" value="1" />
                                </span>
                                <span>
                                    <label for="recommend2" title="2">2</label>
                                    <input type="radio" id="recommend2" name="recommend" value="2" />
                                </span>
                                <span>
                                    <label for="recommend3" title="3">3</label>
                                    <input type="radio" id="recommend3" name="recommend" value="3" />
                                </span>
                                <span>
                                    <label for="recommend4" title="4">4</label>
                                    <input type="radio" id="recommend4" name="recommend" value="4" />
                                </span>
                                <span>
                                    <label for="recommend5" title="5">5</label>
                                    <input type="radio" id="recommend5" name="recommend" value="5" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <p>Yes, definitely<br>نعم بالتأكيد</p>
                        </div>
                    </div>
                <!-- </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <label>Please leave us a testimonial about any positive experiences you had with Shamsaha.</label><br>
                        <label style='margin-bottom:10px'>."من فضلك اترك لنا تعليقًا حول انطباعك الإيجابي عن تجربتك مع "شمسها</label>
                        <input name="positive_experiences" class="form-control inputForm" />
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-12">
                        <label>Please give us more details if you had any negative experiences with Shamsaha.</label><br>
                        <label style='margin-bottom:10px'>."من فضلك اترك لنا تعليقًا حول انطباعك السلبي عن تجربتك مع "شمسها</label>
                        <input name="negative_experiences" class="form-control inputForm" />
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-12">
                        <label>Please tell us if there was anything you would have like to have had or experienced, but did not. Or any additional thoughts/comments. </label><br>
                        <label style='margin-bottom:10px'>هل تود أن تخبرنا بشيء كنت تود حصولها خلال تجربتك مع "شمسها"؟ أو هل لديك أية ملاحظات أخرى؟ </label>
                        <input name="additional_thoughts" class="form-control inputForm" />
                    </div>
                </div><br>
            </div>
            <div id="swsmpa" style="display:none;">
                <label>Satisfaction with the Shamsaha mobile phone application.</label>
                <p>Please tell us about your experience with the new Shamsaha mobile phone application.</p><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Have you downloaded the Shamsaha mobile phone application? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="downloaded_app" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="downloaded_app" value="No"> No</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>From which store did you download it? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="which_store" value="Apple Store"> Apple Store</p>
                        <p style='margin-top:0px'><input type="radio" name="which_store" value="Google Play Store"> Google Play Store</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Did you use any of the talk to us features, such as app to app chat, app to app calling, or app to app video? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="use_any_talk_features" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="use_any_talk_features" value="No"> No</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Did you experience any technical issues? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="technical_issue" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="technical_issue" value="No"> No</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Please describe what you experienced if you had any technical issues.</label><br>
                        <input name="describe_experience_technical_issue" class="form-control inputForm" />
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Did you enjoy using the app? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="enjoy_app" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="enjoy_app" value="No"> No</p>
                        <p style='margin-top:0px'><input type="radio" name="enjoy_app" value="Somewhat"> Somewhat</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Did you find it easy to use? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="find_easy_to_use" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="find_easy_to_use" value="No"> No</p>
                        <p style='margin-top:0px'><input type="radio" name="find_easy_to_use" value="Somewhat"> Somewhat</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Did you feel it was welcoming and friendly? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="feel_welcoming_friendly" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="feel_welcoming_friendly" value="No"> No</p>
                        <p style='margin-top:0px'><input type="radio" name="feel_welcoming_friendly" value="Somewhat"> Somewhat</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Did you feel safe and secure while using it? ( Mark only one oval. )</label><br>
                        <p style='margin-top:0px'><input type="radio" name="feel_safe_while_use" value="Yes"> Yes</p>
                        <p style='margin-top:0px'><input type="radio" name="feel_safe_while_use" value="No"> No</p>
                        <p style='margin-top:0px'><input type="radio" name="feel_safe_while_use" value="Somewhat"> Somewhat</p>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>Is there anything else you would like to tell us? </label><br>
                        <input name="anything_else_tell_us" class="form-control inputForm" />
                    </div>
                </div><br>
            </div>
            <div class="row" style="margin-top: 20px">
               <div class="col-md-12">
                   <input type="submit" id='submitBtn' class="btn btn-info" value="Next" />
               </div>
           </div>
        </form>
</div>
<br>

<script>
    function leaveFeedbackFunc(val){
        $('.leaveFeedbackError').text('');
        $('#submitBtn').val('Submit');
        if (val == "Yes"){
            $('#swsmpa').css('display','block');
            $('#sws').css('display','none');
        }else if (val == "No"){
            $('#swsmpa').css('display','none');
            $('#sws').css('display','block');
        }
    }
    function dateValidation(){
        $('.dateError').text('');
        var todayMonth = $('#todayMonth').val();
        var todayDate = $('#todayDate').val();
        var todayYear = $('#todayYear').val();
        if (todayMonth.length > 0){
            if (todayMonth < 1 || todayMonth > 12){
                $('.dateError').text('Invalid month');
                return false;
            }else{
                $('.dateError').text('');
            }
        }
        if (todayDate.length > 0){
            if (todayDate < 1 || todayDate > 31){
                $('.dateError').text('Invalid date');
                return false;
            }else{
                $('.dateError').text('');
            }
        }
        if (todayYear.length > 0){
            if (todayYear != <?php echo date('Y'); ?>){
                $('.dateError').text('Invalid year');
                return false;
            }else{
                $('.dateError').text('');
            }
        }

    }
    $('#submitBtn').click(function(){
        var todayMonth = $('#todayMonth').val();
        var todayDate = $('#todayDate').val();
        var todayYear = $('#todayYear').val();
        if (todayMonth == "" || todayDate == "" || todayYear == ""){
            $('.dateError').text('Please enter today date in correct format (MM/DD/YYYY)');
            return false;
        }
        if ($("input[name='leaveFeedback']").is(":checked") == false){
            $('.leaveFeedbackError').text('Please mark atleast one oval');
            return false;
        }
    });
</script>

</body>
</html>