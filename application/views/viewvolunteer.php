

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Volunteer</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('volunteer/alluser'); ?>">Volunteers</a></li>
        <li>Volunteer Details</li>
    </ol>


    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="profile-img">
                        <img src="<?= base_url().'uploads/'.$volunteerdetail->profile_pic ?>" class="img-circle"/>
                    </div>
                    <h4 class="name-info"><?= $volunteerdetail->vname ?></h4>
                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Personal Details</h3>
                </div>

                <div class="panel-body personal-info">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Email:</b></h4>
                            <p><?= $volunteerdetail->vemail ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Phone:</b></h4>
                            <p><?= $volunteerdetail->vmobile ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Whatsapp:</b></h4>
                            <p><?= $volunteerdetail->whatsapp ?></p>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Address:</b></h4>
                            <p><?= $volunteerdetail->address ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Residence:</b></h4>
                            <p><?= $volunteerdetail->residence ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Nationality:</b></h4>
                            <p><?= $volunteerdetail->nationality ?></p>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Date of Birth:</b></h4>
                            <p><?= date("d-m-Y", strtotime($volunteerdetail->date_of_birth)) ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Date of Joining:</b></h4>
                            <p><?= date("d-m-Y", strtotime($volunteerdetail->date_of_joining)) ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Shift Language:</b></h4>
                            <p><?= $volunteerdetail->shift_language ?></p>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Languages Known:</b></h4>
                            <p><?= $volunteerdetail->language_known ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Rewards:</b></h4>
                            <p><?= $volunteerdetail->total_rewards ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Emergency Contact No:</b></h4>
                            <p><?= $volunteerdetail->emergency_contact ?></p>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Passport Image:</b></h4>
                            <img src="<?= base_url().'uploads/'.$volunteerdetail->passport_pic ?>" class="img-responsive" style="max-width: 60%;"/>
                        </div>
                        <div class="col-md-4">
                            <h4><b>CPR Front Image:</b></h4>
                            <img src="<?= base_url().'uploads/'.$volunteerdetail->cpr_pic ?>" class="img-responsive" style="max-width: 60%;"/>
                        </div>
                        <div class="col-md-4">
                            <h4><b>CPR Back Image:</b></h4>
                            <img src="<?= base_url().'uploads/'.$volunteerdetail->cpr_back_pic ?>" class="img-responsive" style="max-width: 60%;"/>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>On Duty Status:</b></h4>
                            <p><?php if($volunteerdetail->onduty_status == 1){ echo "Active"; }else{ echo "Inactive"; } ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Status:</b></h4>
                            <p><?= $volunteerdetail->status ?></p>
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