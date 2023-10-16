<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Add Event</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>event/allevent">Events</a></li>
        <li class="active"><strong>Add Event</strong></li>
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
                    <h3 class="panel-title">Add Event</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>


                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add" method="POST" action="<?php echo base_url(); ?>event/add"
                          enctype="multipart/form-data">
                          <div class="row">
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Event For</label>
                                <select class="form-control" name="event_for">
                                    <option value="">Select</option>
                                    <option value="Victim" <?php echo set_select('event_for', 'Victim'); ?>>Public
                                    </option>
                                    <option value="Volunteer" <?php echo set_select('event_for', 'Volunteer'); ?>>
                                        Volunteer
                                    </option>
                                </select>
                                <span style="color: red"><?php echo form_error('event_for'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Event Type</label>
                                <select class="form-control" name="etype">
                                    <option value="">Select</option>
                                    <option value="No registration" <?php echo set_select('event_type', "No registration" ); ?>>
                                        Free, no registration required
                                    </option>
                                    <option value="Free" <?php echo set_select('event_type', "Free" ); ?>>Free, registration
                                        required
                                    </option>
                                    <option value="Paid" <?php echo set_select('event_type', "Paid" ); ?>>Paid, registration
                                        required
                                    </option>
                                </select>
                                <span style="color: red"><?php echo form_error('event_type'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Price</label>
                                <input type="number" name="price" value="<?php echo set_value('price'); ?>"
                                       class="form-control">
                                <span style="color: red"><?php echo form_error('price'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Maximum entries</label>
                                <input type="text" value="<?php echo set_value('req_registration'); ?>" name="entry"
                                       class="form-control">
                                <span style="color: red"><?php echo form_error('req_registration'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Venue ( English )</label>
                                <input type="text" value="<?php echo set_value('venu'); ?>" name="venu"
                                       class="form-control">
                                <span style="color: red"><?php echo form_error('venu'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Venue ( Arabic )</label>
                                <input type="text" value="<?php echo set_value('venu_ar');?>" name="venu_ar"
                                       class="form-control">
                                <span style="color: red"><?php echo form_error('venu_ar'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Date</label>
                                <div id="date-popup" class="input-group date">
                                <input type="text" data-format="D, dd MM yyyy" name="date"
                                           value="<?php echo set_value('date'); ?>" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <span style="color: red"><?php echo form_error('date'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Start Time</label>
                                <input type="time" value="<?php echo set_value('start_time'); ?>" name="start_time"
                                       class="form-control">
                                <span style="color: red"><?php echo form_error('start_time'); ?></span>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">End Time</label>
                                <input type="time" value="<?php echo set_value('end_time'); ?>" name="end_time"
                                       class="form-control">
                                <span style="color: red"><?php echo form_error('end_time'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Title (English)</label>
                                <input type="text" value="<?php echo set_value('title_en'); ?>" class="form-control"
                                       name="title_en" id="emailaddress" placeholder="Subject">
                                <span style="color: red"><?php echo form_error('title_en'); ?></span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Title (Arabic)</label>
                                <input type="text" class="form-control" value="<?php echo set_value('title_ar'); ?>"
                                       name="title_ar" id="emailaddress" placeholder="Subject">
                                <span style="color: red"><?php echo form_error('title_ar'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Content (English)</label>
                                <textarea class="form-control" name="content_en" id="editor1" style="display: block;visibility: visible;"><?php echo set_value('content_en'); ?></textarea>
                                <span style="color: red"><?php echo form_error('content_en'); ?></span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Content (Arabic)</label>
                                <textarea class="form-control" name="content_ar" id="editor2" style="display: block;visibility: visible;"><?php echo set_value('content_ar'); ?></textarea>
                                <span style="color: red"><?php echo form_error('content_ar'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="emailaddress">Image</label>
                                <input type="file" class="form-control" name="event_pic">
                                <span style="color: red"><?php echo form_error('event_pic'); ?></span>
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