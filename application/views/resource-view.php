

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Resources</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('resource/allresource'); ?>">Resources</a></li>
    </ol>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title"> View Details</h3>
                </div>

                <div class="panel-body personal-info">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Name:</b></h4>
                            <p><?= $resourcelist->name ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Location:</b></h4>
                            <p><?= $resourcelist->location_name ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Category:</b></h4>
                            <p><?= $resourcelist->category_name ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Address:</b></h4>
                            <p><?= $resourcelist->address_info ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Phone Number 1:</b></h4>
                            <p><?= $resourcelist->contact_info1 ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Phone Number 2:</b></h4>
                            <p><?= $resourcelist->contact_info2 ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Phone Number 3:</b></h4>
                            <p><?= $resourcelist->contact_info3 ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Phone Number 4:</b></h4>
                            <p><?= $resourcelist->contact_info4 ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Email 1</b></h4>
                            <p><?= $resourcelist->email_info1 ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Email 2:</b></h4>
                            <p><?= $resourcelist->email_info2 ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Email 3:</b></h4>
                            <p><?= $resourcelist->email_info3 ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Address</b></h4>
                            <p><?= $resourcelist->address_info ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Timings:</b></h4>
                            <p><?= $resourcelist->timings ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Website 1:</b></h4>
                            <p><?= $resourcelist->web_info1 ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Website 2</b></h4>
                            <p><?= $resourcelist->web_info2 ?></p>
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

    </div>

