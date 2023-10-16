<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Add Media Article</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>event/allmediaarticle">Media Articles</a></li>
        <li class="active"><strong>Add Media Article</strong></li>
    </ol>


    <?php if ($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Add Media Article</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <?php //echo form_open('User/add'); ?>
                    <form name="add" method="POST" action="<?php echo base_url(); ?>event/add_media_article"
                          enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="emailaddress">Upload Image</label>
                                <input type="file" class="form-control" name="image">
                                <?php if ($this->session->flashdata('error_pic')) { ?>
                                    <span style="color: red"><?php echo $this->session->flashdata('error_pic'); ?></span>
                                <?php } ?>
                                <span style="color: red"><?php echo form_error('image'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Title (English)</label>
                                <input class="form-control" name="title_en">
                                <span style="color: red"><?php echo form_error('title_en'); ?></span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Title (Arabic)</label>
                                <input class="form-control" name="title_ar">
                                <span style="color: red"><?php echo form_error('title_ar'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Content (English)</label>
                                <textarea class="form-control" name="content_en" id="editor1" style="display: block;visibility: visible;"></textarea>
                                <span style="color: red"><?php echo form_error('content_en'); ?></span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Content (Arabic)</label>
                                <textarea class="form-control" name="content_ar" id="editor2" style="display: block;visibility: visible;"></textarea>
                                <span style="color: red"><?php echo form_error('content_ar'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Date</label>
                                <div id="date-popup" class="input-group date">
                                    <input type="text" data-format="D, dd MM yyyy" name="date" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <span style="color: red"><?php echo form_error('date'); ?></span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Time</label>
                                <input type="time" name="time" class="form-control">
                                <span style="color: red"><?php echo form_error('time'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>