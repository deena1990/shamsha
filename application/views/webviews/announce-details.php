<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #ffffff;
        overflow-x: hidden;
    }

    h1 {
        text-align: center;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
        padding: 20px;
    }

    button {
        background-color: #fa518d;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #fa518d;
    }
    .hide {
        display: none;
    }p.answerQuest {
        border: 1px solid #000;
        padding: 10px 20px;
        border-radius: 20px;
        margin: 10px 0px;
    }
</style>
<body>
    <?php if($announce_details){ ?> 
    <div class="container text-center">
        <h3> <strong>Annoucement Details</strong> </h3>
        <?php if($announce_details->subject_en){ ?>
        <div class="form-group">
            <label class="questionLabel">Subject</label>
            <p class="answerQuest"><?= $announce_details->subject_en ?></p>
        </div>
        <?php } if($announce_details->subject_ar){ ?>
        <div class="form-group">
            <label class="questionLabel">Subject</label>
            <p class="answerQuest"><?= $announce_details->subject_ar ?></p>
        </div>
        <?php } ?>
        <?php if($announce_details->type == "content"){ ?>
        <?php if($announce_details->content_en){ ?>
        <div class="form-group">
            <label class="questionLabel">Content</label>
            <p class="answerQuest"><?= $announce_details->content_en ?></p>
        </div>
        <?php } if($announce_details->content_ar){ ?>
        <div class="form-group">
            <label class="questionLabel">Content</label>
            <p class="answerQuest"><?= $announce_details->content_ar ?></p>
        </div>
        <?php } ?>
        <?php } else { ?>
        <?php if($announce_details->image){ ?>
        <div class="form-group">
            <label class="questionLabel">Document</label>
            <?php if($announce_details->type == "image"){ ?>
            <p class="answerQuest">
                <a href="<?= base_url() . 'uploads/announcement/' . $announce_details->image ?>" target="_blank">
                    <img src="<?= base_url() . 'uploads/announcement/' . $announce_details->image ?>" alt="Doc" width=40 height=40>
                </a>
            </p>
            <?php } if($announce_details->type == "doc"){ ?>
            <p class="answerQuest">
                <a href="<?= base_url() . 'uploads/announcement/' . $announcement_details->image ?>" target="_blank">
                    <img src="<?= base_url() . 'uploads/announcement/doc-icon.png' ?>" alt="Doc" width=40 height=40>
                </a>
            </p>
            <?php } if($announce_details->type == "pdf"){ ?>
            <p class="answerQuest">
                <a href="<?= base_url() . 'uploads/announcement/' . $announcement_details->image ?>" target="_blank">
                    <img src="<?= base_url() . 'uploads/announcement/pdf-icon.png' ?>" alt="Doc" width=40 height=40>
                </a>
            </p>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if($announce_details->date){ ?>
        <div class="form-group">
            <label class="questionLabel">Date</label>
            <p class="answerQuest"><?= $announce_details->date ?></p>
        </div>
        <?php } ?>
    </div>
    <?php } else { ?> 
    <div class="container text-center">
        <h3> <strong>Annoucement Details</strong> </h3>
        <p> No Record Found </p>
    </div>
    <?php } ?>

</body>
</html>
