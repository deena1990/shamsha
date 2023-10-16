

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Feedback Details</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('feedback'); ?>">Feedback</a></li>
        <li>Feedback Details</li>
    </ol>


    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Feedback Details</h3>
                </div>

                <div class="panel-body personal-info">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Case Id:</b></h4>
                            <p><?= $feedback->case_id ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Volunteer ID:</b></h4>
                            <p><?= $feedback->volunteer_id ?></p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Date:</b></h4>
                            <p><?= $feedback->created_at ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Overall how satisfied were you with your experience using the crisis telephone helplines and/or face to face meetings with crisis volunteers?</b></h4>
                            <p><?= $controller->starRating($feedback->how_satisfied); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Did you feel your crisis volunteer was knowledgeable?</b></h4>
                            <p><?= $controller->starRating($feedback->knowledgeable) ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Did you feel your crisis volunteer was kind?</b></h4>
                            <p><?= $controller->starRating($feedback->kind) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Would you recommend Shamsaha's services to others?</b></h4>
                            <p><?= $controller->starRating($feedback->recommend) ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Please leave us a testimonial about any positive experiences you had with Shamsaha.</b></h4>
                            <p><?= $feedback->positive_experiences ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Please give us more details if you had any negative experiences with Shamsaha.</b></h4>
                            <p><?= $feedback->negative_experiences ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4><b>Please tell us if there was anything you would have like to have had or experienced, but did not. Or any additional thoughts/comments.</b></h4>
                            <p><?= $feedback->additional_thoughts ?></p>
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
        .personal-info .row{
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 15px;
        }
    </style>