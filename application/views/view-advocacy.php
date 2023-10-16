<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">View Advocacy</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>View Advocacy</strong></li>
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
                    <h3 class="panel-title">View Advocacy</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>




                <div class="panel-body personal-info">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Full Name</b></h4>
                            <p><?php echo $advocacy->fullname ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Email Address</b></h4>
                            <p><?php echo $advocacy->email_id ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Mobile Number</b></h4>
                            <p><?php echo $advocacy->mobile ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Are you 21 years or older?</b></h4>
                            <p><?php echo $advocacy->age_above_r_nt ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>What languages do you speak?</b></h4>
                            <p><?php echo $advocacy->language_u_speak ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Do you have access to reliable transportation?</b></h4>
                            <p><?php echo $advocacy->transportation ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Will you be in the country where you are applying to take the training for atleast 6 months following the training</b></h4>
                            <p><?php echo $advocacy->stay_in ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Are you able to attend the entire training duration of the training</b></h4>
                            <p><?php echo $advocacy->attend_training ?></p>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Are you able to volunteer and dedicate a minimum total of 24 hours (two 12 hour shifts) for a period of 6 months from the completion of your training?</b></h4>
                            <p><?php echo $advocacy->r_u_volunteer ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Do you understand that though this is an unpaid volunteer position, it requires a serious and reliable commitment?</b></h4>
                            <p><?php echo $advocacy->unpain_volunteer ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Training Fees</b></h4>
                            <p><?php echo $advocacy->traning_fee ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>In case you are not selected to become an advocate and you would like to be involved, please tell us her if you have any additional skills or time that you would like to share. We will contact you regarding this if and when the appropriate need arises.</b></h4>
                            <p><?php echo $advocacy->any_additional_skill ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Payment status</b></h4>
                            <p><?php echo $advocacy->payment_status ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Created at</b></h4>
                            <p><?php echo date('d-m-Y h:i:s A', strtotime($advocacy->created_at)) ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <style>
        .personal-info h4{
            font-weight: 500;

        }
        .personal-info .row{
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 15px;
        }
    </style>