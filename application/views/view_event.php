<style>
    .outLine{
        border: 2px solid #e24484;
        background: #f5f3ff;
        border-radius: 30px;
        padding: 20px;
    }
</style>

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Event</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url('event/allevent'); ?>">Events</a></li>
        <li class="active">Event</li>
    </ol>

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Event Details</h3>
                </div>

                <div class="panel-body personal-info text-center">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="outLine" style="margin-top:20px;">
                                <a href="<?= base_url().'uploads/'.$event->event_pic ?>" target="_blank">
                                    <img src="<?= base_url().'uploads/'.$event->event_pic ?>" alt="Image" width=500>
                                </a>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Title ( English ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $event->title_en ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Title ( Arabic ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $event->title_ar ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Content ( English ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $event->content_en ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Content ( Arabic ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $event->content_ar ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Venue ( English ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $event->venu ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Venue ( Arabic ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $event->venu_ar ?></b></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b> Event Type : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->event_type ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b> Event For : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->event_for ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                    <div class="outLine">
                                        <h4><b> Maximum Entries : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->req_registration ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                    <div class="outLine">
                                        <h4><b> Price : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->price != "" ? $event->price : "No Price"?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                    <div class="outLine">
                                        <h4><b> Event Date : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->date ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                    <div class="outLine">
                                        <h4><b> Event Time : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->venu_time ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                    <div class="outLine">
                                        <h4><b>Created Date & Time :</b></h4>
                                        <p style="color: #5e5783;"><b><?= date('d-m-Y H:i:s',strtotime($event->created_at)) ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                    <div class="outLine">
                                        <h4><b>Status:</b></h4>
                                        <p style="color: #5e5783;"><b><?= $event->status ?></b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<style>
    .profile-img{
        margin: 10px auto;
    }
    .profile-img img{
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 10px auto;
        display: block;
        border: 4px solid #fa518d;
    }
    h4.name-info{
        text-align: center;
        font-weight: 500;
    }
    .personal-info h4{
        font-weight: 500;

    }
</style>