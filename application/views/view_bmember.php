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
    <h1 class="page-title">Board Member</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url('boardmember/list'); ?>">Board Members</a></li>
        <li class="active">Board Member</li>
    </ol>

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Board Member Details</h3>
                </div>

                <div class="panel-body personal-info text-center">
                    <div class="row">
                        <div class="col-md-4" style="margin-top:20px;">
                            <div class="outLine">
                                <a href="<?= base_url().'uploads/about/'.$bmember->image ?>" target="_blank">
                                    <img src="<?= base_url().'uploads/about/'.$bmember->image ?>" alt="Image" width=200 height=200>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-6" style="margin-top:20px;">
                                <div class="outLine">
                                    <h4><b> Name ( English ) : </b></h4>
                                    <p style="color: #5e5783;"><b><?= $bmember->bname ?></b></p>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:20px;">
                                <div class="outLine">
                                    <h4><b> Name ( Arabic ) : </b></h4>
                                    <p style="color: #5e5783;"><b><?= $bmember->bname_ar ?></b></p>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:20px;">
                                <div class="outLine">
                                    <h4><b> Designation ( English ) :</b></h4>
                                    <p style="color: #5e5783;"><b><?= $bmember->designation ?></b></p>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:20px;">
                                <div class="outLine">
                                    <h4><b> Designation ( Arabic ):</b></h4>
                                    <p style="color: #5e5783;"><b><?= $bmember->designation_ar ?></b></p>
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