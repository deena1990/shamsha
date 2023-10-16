

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Volunteer Information</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('job/viewapplicant/'.$applicant->job_id); ?>">Applicant List</a></li>
    </ol>


    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Applicant Details</h3>
                </div>

                <div class="panel-body personal-info">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Name:</b></h4>
                            <p><?= $applicant->name ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Email:</b></h4>
                            <p><?= $applicant->email ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Phone:</b></h4>
                            <p><?= $applicant->phone ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Address:</b></h4>
                            <p><?= $applicant->address ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Extra Info:</b></h4>
                            <p><?= $applicant->extra_info ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Applied Date:</b></h4>
                            <p><?= date('d M Y', strtotime($applicant->applied_date)) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Status:</b></h4>
                            <p><?= $applicant->status ?></p>
                        </div>

                        <div class="col-md-4">
                            <h4><b>Download CV:</b></h4>
                            <p><a target="_blank" class="btn btn-success" href="<?= $applicant->user_cv ?>">Click here to download</a> </p>
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