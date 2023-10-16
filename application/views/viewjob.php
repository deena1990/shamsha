

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Volunteer Information</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('job/alljob'); ?>">Job List</a></li>
    </ol>


    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Job Details</h3>
                </div>
                <div class="panel-body personal-info">
                    <div class="row">
                        <div class="col-md-3">
                            <h4><b>Start Date:</b></h4>
                            <p><?= $job->jdate ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4><b>End Date:</b></h4>
                            <p><?= $job->edate ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4><b>Job Type:</b></h4>
                            <p><?= $job->job_type ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4><b>Status:</b></h4>
                            <p><?= $job->status ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><b>Job Title:</b></h4>
                            <p><?= $job->title ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><b>Brief Description:</b></h4>
                            <p><?= $job->brief ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4> <b>Detail Description:</b> </h4>
                            <p><?= $job->detail ?></p>
                        </div>
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