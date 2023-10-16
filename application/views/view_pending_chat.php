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
    <h1 class="page-title">Pending Chat</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('pending/chats'); ?>">Pending Chats</a></li>
        <li>Pending Chat Details</li>
    </ol>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Pending Chat Details</h3>
                </div>
                <div class="panel-body personal-info">
                    <br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Case ID : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->case_id ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Language : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->language ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Device ID : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->device_id ?></b></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Device Type : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->device_type ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Chat Status : </b></h4>
                                <p style="color: #5e5783;"><b><?php $chat_opened = $pending_chat->chat_opened; if($chat_opened == 0){ echo "Wait to Connect..."; }elseif($chat_opened == 1){ echo "Ongoing..."; }else{ echo "End"; } ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Open Date : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->opened_date ?></b></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-center">
                        <?php if($pending_chat->reported_date != ""){ ?>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Reported Date : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->reported_date ?></b></p>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Connection Type : </b></h4>
                                <p style="color: #5e5783;"><b><?= ucfirst($pending_chat->connection_type) ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Connection Status : </b></h4>
                                <p style="color: #5e5783;"><b><?php $status = $pending_chat->status; if ($status == 1){ echo "Follow up"; }else if($status == 2){ echo "Closed"; }else if($status == 3){ echo "Reopen"; } ?></b></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Name : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->screen_name ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Age : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->age." Years" ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Gender : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->gender ?></b></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Safe to Callback : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->safe_to_call ?></b></p>
                            </div>
                        </div>
                        <?php if(strtolower($pending_chat->safe_to_call) == "yes"){ ?>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Mobile Number : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->mobile ?></b></p>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="outLine">
                                <h4><b> Country : </b></h4>
                                <p style="color: #5e5783;"><b><?= $pending_chat->race_or_ethnicity ?></b></p>
                            </div>
                        </div>
                    </div>
                    <br>
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