<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Emailer (Same as VSP)</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Emailer (Same as VSP)</strong></li>
    </ol>


    <?php if ($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>
    

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading clearfix">
                    <h3 class="panel-title">Announcement</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div> -->


                <div class="panel-body">
                    <div class="col-md-12">
                        <form name="mailerVSP" method="POST" action="<?php echo base_url(); ?>Announcement/mailerVSP"
                              enctype="multipart/form-data">

                            <!-- <input type="hidden" name="who_are_you" value="<?php echo $role_name; ?>"> -->
                            <label>Send To</label>
                            <div class="form-group">
                                <label class="radio-inline"> <input type="radio" class="announcement_type" name="announcement_type" value="all">All
                                    Volunteer</label>
                                <label class="radio-inline"><input type="radio" class="announcement_type" name="announcement_type" value="active">Active
                                    Volunteer</label>
                                <label class="radio-inline"><input type="radio" class="announcement_type" name="announcement_type" value="arabic">Arabic
                                    Volunteer</label>
                                <label class="radio-inline"><input type="radio" class="announcement_type" name="announcement_type" value="english">English
                                    Volunteer</label>
                                <label class="radio-inline"><input type="radio" class="announcement_type" name="announcement_type" value="selected">Selected
                                    Volunteer</label>
                            </div>
                            <?php echo form_error('announcement_type', '<div class="text-danger">', '</div>'); ?>

                            <div id="selectedEmail" style="display: none">
                                <div class="form-group">
                                    <label for="emailaddress">To</label>
                                    <input type="text" name="emailaddress" class="form-control emailList"></input>
                                    <?php echo form_error('emailaddress', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="subject_en">Subject</label>
                                        <input type="text" class="form-control" name="subject_en" id="subject_en"
                                                placeholder="Subject">
                                        <?php echo form_error('subject_en', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-6">
                                    <label for="emailaddress">Date</label>
                                    <div id="date-popup" class="input-group date">
                                        <input type="text" data-format="D, dd MM yyyy" name="date" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_error('date', '<div class="text-danger">', '</div>'); ?>
                                </div> -->
                            </div>


                            <!-- <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="subject_en">Subject</label>
                                    <input type="text" class="form-control" name="subject_en" id="subject_en"
                                           placeholder="Subject">
                                    <?php echo form_error('subject_en', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div> -->

                            <!-- <div style='display:none;' id='business'> -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="emailaddress">Message</label>
                                            <textarea class="form-control" id="editor1" name="content_en" style="display: block;visibility: visible;"></textarea>
                                        <?php echo form_error('content_en', '<div class="text-danger">', '</div>'); ?>
                                        </div>
                                        <input type="checkbox" id="attachCheck">&emsp;<label>Check, If you want to attach document with the email Otherwise ignore it</label>
                                    </div>
                                </div>
                            <!-- </div> -->

                            <div style='display:none;margin-top:15px;' id='pbusiness'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Select Attachment Type</label>
                                            <select class="form-control" name="anounce_type">
                                                <option value="">Select Attachment Type</option>
                                                <option value="image">Image</option>
                                                <option value="doc">Document</option>
                                                <option value="pdf">PDF</option>
                                                <!-- <option value="content">Content</option> -->
                                            </select>
                                        </div>
                                        <?php echo form_error('anounce_type', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="attachment">Upload Attachment</label>
                                            <input type="file" class="form-control" name="event_pic" id="attachment">
                                            <?php echo form_error('event_pic', '<div class="text-danger">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="submit" value="Send" class="btn btn-primary" style="margin-top: 20px;">
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
<!-- /main content -->

<script type='text/javascript'>
    $(document).ready(function () {
        $('#purpose').on('change', function () {
            if (this.value == 'image' || this.value == 'doc' || this.value == 'pdf') {
                $("#pbusiness").show();
                $("#business").hide();
            // } else if (this.value == 'content') {
            //     $("#pbusiness").hide();
            //     $("#business").show();
            } else {
                $("#pbusiness").hide();
                $("#business").hide();
            }
        });

        $('.announcement_type').on('change', function () {
            if (this.value == 'selected') {
                $("#selectedEmail").show();
            } else {
                $("#selectedEmail").hide();
            }
        });

        $('#attachCheck').click(function() {
            if(this.checked == true){
                $("#pbusiness").show();
                $("#attachment").attr('Required','Required');
            }else{
                $("#pbusiness").hide();
                $("#attachment").removeAttr('Required');
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
    $('.bootstrap-tagsinput input').keydown(function( event ) {
        if ( event.which == 13 ) {
            $(this).blur();
            $(this).focus();
            return false;
        }
    })
</script>

