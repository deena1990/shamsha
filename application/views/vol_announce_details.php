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
    <h1 class="page-title">Volunteer Announcement</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url('announcement/volannouncement'); ?>">Volunteers Announcement</a></li>
        <li class="active">Volunteer Announcement</li>
    </ol>

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Volunteer Announcement Details</h3>
                </div>

                <div class="panel-body personal-info">
                    <br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Volunteer Name : </b></h4>
                                <p style="color: #5e5783;"><b><?= $vol_name ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Send To : </b></h4>
                                <p style="color: #5e5783;"><b><?= ucfirst($vol_announce_details->send_to).' Volunteer [ '.count(explode(',',$vol_announce_details->emailaddress)).' ]' ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Date : </b></h4>
                                <p style="color: #5e5783;"><b><?= date('d-m-Y',strtotime($vol_announce_details->date)) ?></b></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Attachment Type : </b></h4>
                                <p style="color: #5e5783;"><b><?= ucfirst($vol_announce_details->type) ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Subject : </b></h4>
                                <p style="color: #5e5783;"><b><?= $vol_announce_details->subject_en ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Content : </b></h4>
                                <p style="color: #5e5783;"><b><?= $vol_announce_details->content_en ?></b></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Created Date & Time :</b></h4>
                                <p style="color: #5e5783;"><b><?= date('d-m-Y H:i:s',strtotime($vol_announce_details->created_at)) ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b>Status:</b></h4>
                                <p style="color: #5e5783;"><b><?php echo $vol_announce_details->status == "Inactive" ? "Pending" : "Active"?></b></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
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