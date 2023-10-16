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
    <h1 class="page-title">Message</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url('message/list'); ?>">Messages</a></li>
        <li class="active">Message</li>
    </ol>

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Message Details</h3>
                </div>

                <div class="panel-body personal-info text-center">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="outLine" style="margin-top:20px;word-wrap: break-word;">
                                <h4><b> Title : </b></h4>
                                <p style="color: #5e5783;"><b><?= $message->title ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;word-wrap: break-word;">
                                <h4><b> Message ( English ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $message->message_en ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;word-wrap: break-word;">
                                <h4><b>Message ( Arabic ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $message->message_ar ?></b></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b>Created Date & Time :</b></h4>
                                        <p style="color: #5e5783;"><b><?= date('d-m-Y H:i:s',strtotime($message->created_at)) ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b>Status:</b></h4>
                                        <p style="color: #5e5783;"><b><?php echo $message->status == 0 ? "Inactive" : "Active"?></b></p>
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