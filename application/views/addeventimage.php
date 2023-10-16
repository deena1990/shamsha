<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Add Event Image</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>event/alleventimages">Event Images</a></li>
        <li class="active"><strong>Add Event Image</strong></li>
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
                    <h3 class="panel-title">Add Event Image</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>


                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add" method="POST" action="<?php echo base_url(); ?>event/add_event_image"
                          enctype="multipart/form-data">
                          <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Event For</label>
                                <select class="form-control" name="event_for">
                                    <option value="">Select Event</option>
                                    <?php foreach ($eventlist as $key => $value) { ?>
                                        <option value="<?= $value->wceid ?>"><?= $value->title_en ?></option>
                                    <?php } ?>
                                </select>
                                <span style="color: red"><?php echo form_error('event_for'); ?></span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Upload Images</label>
                                <input type="file" class="form-control" name="event_pic[]" multiple>
                                <span style="color: red"><?php echo form_error('event_pic'); ?></span>
                                <span style="color: red"><?php echo $this->session->flashdata('error_pic'); ?></span>
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