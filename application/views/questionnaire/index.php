



<!-- Main content -->

<div class="main-content">

    <h1 class="page-title">Intake Form Responses</h1>

    <!-- Breadcrumb -->

    <ol class="breadcrumb breadcrumb-2">

        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>

        <li>Intake Form Responses</li>

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

                    <h3 class="panel-title">Intake Form Responses List</h3>

                    <ul class="panel-tool-options" style="display:none;">

                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>

                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>

                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>

                    </ul>

                </div>



                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>

                                <th>S.No.</th>

                                <th>Case ID</th>

                                <!-- <th>What is your name ?</th> -->
                                <th>Name</th>

                                <!-- <th>Are you in crisis?</th> -->

                                <!-- <th>How old are you?</th> -->
                                <th>Age</th>

                                <!-- <th>What is your gender?</th> -->
                                <th>Gender</th>

                                <!-- <th>Is it safe to call you back if the line gets disconnected?</th> -->
                                <th>Call you Back?</th>

                                <th>Phone Number</th>

                                <!-- <th>Where are you contacting us from ?</th> -->
                                <th>Address</th>

                                <!-- <th>How did you hear about us?</th> -->
                                <!-- <th>Action</th> -->

                            </tr>

                            </thead>

                            <tbody>

                                

                                <?php $i=1; foreach($questionnaire as $val){ ?>

                                <tr>

                                    <td><?=$i?></td>

                                    <td><?=$val->case_id?></td>

                                    <td><?=$val->screen_name?></td>

                                    <!-- <td><?=$val->are_you_in_crisis?></td> -->

                                    <td><?=$val->age?></td>

                                    <td><?=$val->gender?></td>

                                    <td><?=$val->safe_to_call?></td>

                                    <td><?=$val->mobile?></td>

                                    <td><?=$val->race_or_ethnicity?></td>

                                    <!-- <td><?=$val->hear_about_us?></td> -->
                                    <!-- <td><a href="<?=base_url('questionnaire/case_feedback?case_id='.$val->case_id)?>" class="btn btn-primary">Feedback</a></td> -->

                                </tr>

                                <?php $i++; } ?>



                            </tbody>



                        </table>

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





    

