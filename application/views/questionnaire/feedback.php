


<style>
        .rating {
            float: left;
        }

        /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
          follow these rules. Every browser that supports :checked also supports :not(), so
          it doesn’t make the test unnecessarily selective */
        .rating:not(:checked) > input {
            position:absolute;
            clip:rect(0,0,0,0);
        }

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

         .rating:not(:checked) > label:before {
            content: '★ ';
            font-size: 30px;
            display: block;
            margin-bottom: 0px;
        }

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
            margin-top: 15px;
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
<!-- Main content -->

<div class="main-content">

    <h1 class="page-title">Feedback</h1>

    <!-- Breadcrumb -->

    <ol class="breadcrumb breadcrumb-2">

        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>questionnaire">Intake Form Responses</a></li>

        <li>Feedback</li>

    </ol>



    <?php if($this->session->flashdata('msg')) { ?>



        <div class="alert alert-success" id="mydivs"  role="alert">



            <?php echo $this->session->flashdata('msg'); ?>



        </div>



    <?php } ?>

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-heading clearfix">

                    <h3 class="panel-title">Shamsaha's Client Feedback Form</h3>

                    <ul class="panel-tool-options" style="display:none;">

                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>

                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>

                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>

                    </ul>

                </div>



                <div class="panel-body">

                    <div class="table-responsive">

                       <!--  // -->
                       <?php
                       //echo "<pre>";
                       //print_r($feedback);
                       if(count($feedback)!=0){
                       ?>
                       <form class="" method="post">
            <div class="row">
                <div class="col-md-12">
                    <p>Overall how satisfied were you with your experience using the crisis telephone helplines and/or face to face meetings with crisis volunteers?</p>
                    <p  style='margin-bottom:10px'> بشكل عام، ما مدى رضاك ​​عن تجربتك مع خطوط المساعدة و / أو اللقاءات وجهًا لوجه مع متطوعي "شمسها"؟</p>
                </div>
                    <div class="rating">
                        <input type="radio" id="how_satisfied5" name="how_satisfied" value="5" <?php if($feedback[0]->how_satisfied==5){ echo"Checked"; } ?> /><label for="how_satisfied5" title="5">5</label>
                        <input type="radio" id="how_satisfied4" name="how_satisfied" value="4" <?php if($feedback[0]->how_satisfied==4){ echo"Checked" ;} ?> /><label for="how_satisfied4" title="4">4</label>
                        <input type="radio" id="how_satisfied3" name="how_satisfied" value="3" <?php if($feedback[0]->how_satisfied==3){ echo"Checked"; } ?> /><label for="how_satisfied3" title="3">3</label>
                        <input type="radio" id="how_satisfied2" name="how_satisfied" value="2" <?php if($feedback[0]->how_satisfied==2){ echo"Checked"; } ?> /><label for="how_satisfied2" title="2">2</label>
                        <input type="radio" id="how_satisfied1" name="how_satisfied" value="1" <?php if($feedback[0]->how_satisfied==1){ echo"Checked"; } ?> /><label for="how_satisfied1" title="1">1</label>
                    </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>Did you feel your crisis volunteer was knowledgeable?</p>
                    <p style='margin-bottom:10px'>هل شعرت أن المتطوعة لديها معلومات كافية؟</p>
                </div>
                    <div class="rating">
                        <input type="radio" id="knowledgeable5" name="knowledgeable" value="5" <?php if($feedback[0]->knowledgeable==5){ echo"Checked"; } ?>/><label for="knowledgeable5" title="5">5</label>
                        <input type="radio" id="knowledgeable4" name="knowledgeable" value="4" <?php if($feedback[0]->knowledgeable==4){ echo"Checked"; } ?> /><label for="knowledgeable4" title="4">4</label>
                        <input type="radio" id="knowledgeable3" name="knowledgeable" value="3" <?php if($feedback[0]->knowledgeable==3){ echo"Checked"; } ?> /><label for="knowledgeable3" title="3">3</label>
                        <input type="radio" id="knowledgeable2" name="knowledgeable" value="2" <?php if($feedback[0]->knowledgeable==2){ echo"Checked"; } ?> /><label for="knowledgeable2" title="2">2</label>
                        <input type="radio" id="knowledgeable1" name="knowledgeable" value="1" <?php if($feedback[0]->knowledgeable==1){ echo"Checked"; } ?>  /><label for="knowledgeable1" title="1">1</label>
                    </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>Did you feel your crisis volunteer was kind? </p>
                    <p style='margin-bottom:10px'> هل شعرت أن المتطوعة كانت لطيفة معك؟ </p>
                </div>
                    <div class="rating">
                        <input type="radio" id="kind5" name="kind" value="5" <?php if($feedback[0]->kind==5){ echo"Checked"; } ?> /><label for="kind5" title="5">5</label>
                        <input type="radio" id="kind4" name="kind" value="4" <?php if($feedback[0]->kind==4){ echo"Checked"; } ?> /><label for="kind4" title="4">4</label>
                        <input type="radio" id="kind3" name="kind" value="3" <?php if($feedback[0]->kind==3){ echo"Checked"; } ?> /><label for="kind3" title="3">3</label>
                        <input type="radio" id="kind2" name="kind" value="2" <?php if($feedback[0]->kind==2){ echo"Checked"; } ?> /><label for="kind2" title="2">2</label>
                        <input type="radio" id="kind1" name="kind" value="1" <?php if($feedback[0]->kind==1){ echo"Checked"; } ?>  /><label for="kind1" title="1">1</label>
                    </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>Would you recommend Shamsaha's services to others?</p>
                    <p style='margin-bottom:10px'>هل ستنصح الآخرين بخدمات "شمسها"؟</p>
                </div>
                    <div class="rating">
                        <input type="radio" id="recommend5" name="recommend" value="5" <?php if($feedback[0]->recommend==5){ echo"Checked"; } ?> /><label for="recommend5" title="5">5</label>
                        <input type="radio" id="recommend4" name="recommend" value="4" <?php if($feedback[0]->recommend==4){ echo"Checked"; } ?> /><label for="recommend4" title="4">4</label>
                        <input type="radio" id="recommend3" name="recommend" value="3" <?php if($feedback[0]->recommend==3){ echo"Checked"; } ?> /><label for="recommend3" title="3">3</label>
                        <input type="radio" id="recommend2" name="recommend" value="2" <?php if($feedback[0]->recommend==2){ echo"Checked"; } ?> /><label for="recommend2" title="2">2</label>
                        <input type="radio" id="recommend1" name="recommend" value="1" <?php if($feedback[0]->recommend==1){ echo"Checked"; } ?>  /><label for="recommend1" title="1">1</label>
                    </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Please leave us a testimonial about any positive experiences you had with Shamsaha.</p>
                    <p style='margin-bottom:10px'>."من فضلك اترك لنا تعليقًا حول انطباعك الإيجابي عن تجربتك مع "شمسها</p>
                    <input name="positive_experiences" class="form-control inputForm" value="<?=$feedback[0]->positive_experiences?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>Please give us more details if you had any negative experiences with Shamsaha.</p>
                    <p style='margin-bottom:10px'>."من فضلك اترك لنا تعليقًا حول انطباعك السلبي عن تجربتك مع "شمسها</p>
                    <input name="negative_experiences" class="form-control inputForm" value="<?=$feedback[0]->negative_experiences?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>Please tell us if there was anything you would have like to have had or experienced, but did not. Or any additional thoughts/comments. </p>
                    <p style='margin-bottom:10px'>هل تود أن تخبرنا بشيء كنت تود حصولها خلال تجربتك مع "شمسها"؟ أو هل لديك أية ملاحظات أخرى؟ </p>
                    <input name="additional_thoughts" class="form-control inputForm" value="<?=$feedback[0]->additional_thoughts?>" />
                </div>
            </div>
           <div class="row" style="margin-top: 20px">
               
           </div>
        </form>
    <?php }else{ ?>
        <h4>No Feedback Found</h4>
    <?php } ?>
                       <!--  // -->

                    </div>

                </div>



            </div>

        </div>



    </div>



    <style>

        .removeRow

        {

            background-color: #FF0000;

            color:#FFFFFF;

        }

    </style>





    

