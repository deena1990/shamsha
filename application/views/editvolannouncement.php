	<!-- Main content -->
	<div class="main-content">
	    <h1 class="page-title">Announcement</h1>
	    <!-- Breadcrumb -->
	    <ol class="breadcrumb breadcrumb-2">
	        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
	        <li class="active"><strong>Announcement</strong></li>
	    </ol>



	    <?php if($this->session->flashdata('msg')) { ?>

	    <div class="alert alert-success" id="mydivs" role="alert">

	        <?php echo $this->session->flashdata('msg'); ?>

	    </div>

	    <?php } ?>

	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading clearfix">
	                    <h3 class="panel-title"> Update Details</h3>
	                    <ul class="panel-tool-options" style="display: none;">
	                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
	                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
	                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
	                    </ul>
	                </div>




	                <div class="panel-body">
	                    <form name="add" method="POST"
	                        action="<?php echo base_url(); ?>Announcement/edit_vol_announce/<?php echo $announcement[0]->wcnvid;?>"
	                        enctype="multipart/form-data">

	                        <label>Send Type</label>
	                        <div class="form-group">
	                            <label class="radio-inline"> <input type="radio" class="announcement_type"
	                                    name="announcement_type" value="all"
	                                    <?php echo  $announcement[0]->send_to == "all" ? "checked" : ""; ?>>All
	                                Volunteer</label>
	                            <label class="radio-inline"><input type="radio" class="announcement_type"
	                                    name="announcement_type" value="active"
	                                    <?php echo  $announcement[0]->send_to == "active" ? "checked" : ""; ?>>Active
	                                Volunteer</label>
	                            <label class="radio-inline"><input type="radio" class="announcement_type"
	                                    name="announcement_type" value="arabic"
	                                    <?php echo  $announcement[0]->send_to == "arabic" ? "checked" : ""; ?>>Arabic
	                                Volunteer</label>
	                            <label class="radio-inline"><input type="radio" class="announcement_type"
	                                    name="announcement_type" value="english"
	                                    <?php echo  $announcement[0]->send_to == "english" ? "checked" : ""; ?>>English
	                                Volunteer</label>
	                            <label class="radio-inline"><input type="radio" class="announcement_type"
	                                    name="announcement_type" value="selected"
	                                    <?php echo  $announcement[0]->send_to == "selected" ? "checked" : ""; ?>>Selected
	                                Volunteer</label>
	                        </div>
	                        <?php echo form_error('announcement_type', '<div class="text-danger">', '</div>'); ?>
	                        <div id="selectedEmail"
	                            style="display: <?php echo ($announcement[0]->send_to) == "selected" ? "block" : "none" ?>">
	                            <div class="form-group">
	                                <label for="emailaddress">To</label>
	                                <input type="text" name="emailaddress" class="form-control emailList"
	                                    value="<?php echo ($announcement[0]->send_to) == "selected" ? $emails[0]->emailaddress : "" ?>"></input>
	                                <?php echo form_error('emailaddress', '<div class="text-danger">', '</div>'); ?>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group col-md-6">
	                                <label for="emailaddress">Date</label>
	                                <div id="date-popup" class="input-group date">
	                                    <input type="text" data-format="D, dd MM yyyy" name="date" class="form-control"
	                                        value="<?php echo date('d-m-Y',strtotime($announcement[0]->date));?>">
	                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                </div>
	                                <?php echo form_error('date', '<div class="text-danger">', '</div>'); ?>
	                            </div>
	                            <div class="col-md-6">
	                                <div class="form-group">
	                                    <label for="emailaddress">Select Attachment Type</label>
	                                    <select class="form-control" name="anounce_type" id='purpose'>
	                                        <option value="">Select Attachment Type</option>
	                                        <option value="image"
	                                            <?php echo set_select('type', "image", ("image" ==  set_value('type', $announcement[0]->type))); ?>>
	                                            Image</option>
	                                        <option value="doc"
	                                            <?php echo set_select('type', "doc", ("doc" ==  set_value('type', $announcement[0]->type))); ?>>
	                                            Document</option>
	                                        <option value="pdf"
	                                            <?php echo set_select('type', "pdf", ("pdf" ==  set_value('type', $announcement[0]->type))); ?>>
	                                            PDF</option>
	                                        <option value="content"
	                                            <?php echo set_select('type', "content", ("content" ==  set_value('type', $announcement[0]->type))); ?>>
	                                            Content</option>
	                                    </select>
	                                </div>
	                                <?php echo form_error('anounce_type', '<div class="text-danger">', '</div>'); ?>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="form-group col-xs-12">
	                                <label for="subject_en">Subject</label>
	                                <input type="text" class="form-control" name="subject_en" id="emailaddress"
	                                    placeholder="Subject" value="<?php echo $announcement[0]->subject_en;?>">
	                                <?php echo form_error('subject_en', '<div class="text-danger">', '</div>'); ?>
	                            </div>
	                        </div>
	                        <div style='display:none;' id='business'>
	                            <div class="row">
	                                <div class="form-group col-xs-12">
	                                    <label for="emailaddress">Content</label>
	                                    <textarea class="form-control" name="content_en"
	                                        style="display: block;visibility: visible;"><?php echo $announcement[0]->content_en; ?></textarea>
	                                </div>
	                                <?php echo form_error('content_en', '<div class="text-danger">', '</div>'); ?>
	                            </div>
	                        </div>
	                        <div style='display:none;' id='pbusiness'>
	                            <div class="row">
	                                <div class="form-group col-xs-12">
	                                    <label for="emailaddress">Upload Document</label>
	                                    <input type="file" class="form-control" name="event_pic" id="emailaddress">
	                                    <?php echo form_error('event_pic', '<div class="text-danger">', '</div>'); ?>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- <div class="row">
	                            <div class="form-group col-xs-12">
	                                <label for="emailaddress">Status</label> -->
                                    <input type="hidden" name="status" value="<?php echo $announcement[0]->status; ?>">
	                            <!-- </div>
	                        </div> -->
	                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- /main content -->

	    <script type='text/javascript'>
	    $(window).load(function() {
	        var val = $('#purpose').val();
	        if (val == 'image' || val == 'doc' || val == 'pdf') {
	            $("#pbusiness").show();
	            $("#business").hide();
	        } else if (val == 'content') {
	            $("#pbusiness").hide();
	            $("#business").show();
	        } else {
	            $("#pbusiness").hide();
	            $("#business").hide();
	        }

	    });
	    $(document).ready(function() {
	        $('#purpose').on('change', function() {
	            if (this.value == 'image' || this.value == 'doc' || this.value == 'pdf') {
	                $("#pbusiness").show();
	                $("#business").hide();
	            } else if (this.value == 'content') {
	                $("#pbusiness").hide();
	                $("#business").show();
	            } else {
	                $("#pbusiness").hide();
	                $("#business").hide();
	            }
	        });

	        $('.announcement_type').on('change', function() {
	            if (this.value == 'selected') {
	                $("#selectedEmail").show();
	            } else {
	                $("#selectedEmail").hide();
	            }
	        });






	    });
	    </script>
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-tagsinput/examples/assets/app.css">
	    <script src="<?php echo base_url(); ?>assets/bootstrap-tagsinput/examples/assets/typeahead.bundle.min.js"></script>

	    <script src="<?php echo base_url(); ?>assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
	    <script>
	    var states = <?php  echo json_encode($volunteer_list) ?>;
	    var states = new Bloodhound({
	        datumTokenizer: Bloodhound.tokenizers.whitespace,
	        queryTokenizer: Bloodhound.tokenizers.whitespace,
	        // `states` is an array of state names defined in "The Basics"
	        local: states
	    });
	    states.initialize();

	    $('.emailList').tagsinput({
	        confirmKeys: [13, 188],
	        typeaheadjs: {
	            name: 'states',
	            source: states
	        }
	    });
	    $('.bootstrap-tagsinput input').keydown(function(event) {
	        if (event.which == 13) {
	            $(this).blur();
	            $(this).focus();
	            return false;
	        }
	    })
	    </script>