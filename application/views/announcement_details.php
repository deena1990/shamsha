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
    <h1 class="page-title">Announcement</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url('announcement/allannouncement'); ?>">Announcements</a></li>
        <li class="active">Announcement</li>
    </ol>

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Announcement Details</h3>
                </div>

                <div class="panel-body personal-info text-center">
                    <div class="row">
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b> Send To : </b></h4>
                            <p style="color: #5e5783;"><b><?= ucfirst($announcement_details->send_to).' Volunteer ' ?></b></p>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Date : </b></h4>
                            <p style="color: #5e5783;"><b><?= date('d-m-Y',strtotime($announcement_details->date)) ?></b></p>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Attachment Type : </b></h4>
                            <p style="color: #5e5783;"><b><?= ucfirst($announcement_details->type) ?></b></p>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Subject : </b></h4>
                            <p style="color: #5e5783;"><b><?= $announcement_details->subject_en ?></b></p>
                        </div>
                    </div>
                    <?php if($announcement_details->type == "content"){ ?>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Content : </b></h4>
                            <p style="color: #5e5783;"><b><?= $announcement_details->content_en ?></b></p>
                        </div>
                    </div>
                    <?php }else if($announcement_details->type == "image") { ?>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Image : </b></h4>
                            <a href="<?= base_url() . 'uploads/announcement/' . $announcement_details->image ?>" target="_blank">
                                <img src="<?= base_url() . 'uploads/announcement/' . $announcement_details->image ?>" alt="Doc" width=40 height=40>
                            </a></div>
                    </div>
                    <?php }else if($announcement_details->type == "doc") { ?>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Document : </b></h4>
                            <a href="<?= base_url() . 'uploads/announcement/' . $announcement_details->image ?>" target="_blank">
                                <img src="<?= base_url() . 'uploads/announcement/doc-icon.png' ?>" alt="Doc" width=40 height=40>
                            </a>
                        </div>
                    </div>
                    <?php }else if($announcement_details->type == "pdf") { ?>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>PDF : </b></h4>
                            <a href="<?= base_url() . 'uploads/announcement/' . $announcement_details->image ?>" target="_blank">
                                <img src="<?= base_url() . 'uploads/announcement/pdf-icon.png' ?>" alt="Doc" width=40 height=40>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Created Date & Time :</b></h4>
                            <p style="color: #5e5783;"><b><?= date('d-m-Y H:i:s',strtotime($announcement_details->created_at)) ?></b></p>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4" style="margin-top:20px;">
                        <div class="outLine">
                            <h4><b>Status:</b></h4>
                            <p style="color: #5e5783;"><b><?php echo $announcement_details->status == "Inactive" ? "Pending" : "Active"?></b></p>
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