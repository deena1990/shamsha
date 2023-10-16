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
    <h1 class="page-title">Media Article</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url('event/allmediaarticle'); ?>">Media Articles</a></li>
        <li class="active">Media Article</li>
    </ol>

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Media Article Details</h3>
                </div>

                <div class="panel-body personal-info text-center">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="outLine" style="margin-top:20px;">
                                <a href="<?= base_url().'uploads/Events/mediaPhotos/'.$media_article->image ?>" target="_blank">
                                    <img src="<?= base_url().'uploads/Events/mediaPhotos/'.$media_article->image ?>" alt="Image" width=300>
                                </a>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Title ( English ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $media_article->title_en ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Title ( Arabic ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $media_article->title_ar ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Content ( English ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $media_article->content_en ?></b></p>
                            </div>
                            <div class="outLine" style="margin-top:20px;">
                                <h4><b> Content ( Arabic ) : </b></h4>
                                <p style="color: #5e5783;"><b><?= $media_article->content_ar ?></b></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b> Date : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $media_article->date ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b> Time : </b></h4>
                                        <p style="color: #5e5783;"><b><?= $media_article->time ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b>Created Date & Time :</b></h4>
                                        <p style="color: #5e5783;"><b><?= date('d-m-Y H:i:s',strtotime($media_article->created_at)) ?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="outLine" style="margin-top:20px;">
                                        <h4><b>Status:</b></h4>
                                        <p style="color: #5e5783;"><b><?= $media_article->status ?></b></p>
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