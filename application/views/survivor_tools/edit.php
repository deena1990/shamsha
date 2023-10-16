<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Edit Survivor support tool</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>survivor_tools/">Survivor support tools</a></li>
        <li class="active"><strong>Edit Survivor support tool</strong></li>
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
                    <h3 class="panel-title">Edit Survivor support tool</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <?php //echo form_open('User/add'); ?>
                    <form name="edit" method="POST" action="<?php echo  base_url();?>survivor_tools/edit/<?php echo $s_tool->s_id;?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"> Name <span style="color:red">*</span></label>
                                <input type="text" value="<?php echo set_value('name') == false ? $s_tool->name : set_value('name') ?>" class="form-control" name="name" placeholder="Name"> <span style="color: red"><?php echo form_error('name');  ?></span> </div>
                            <div class="form-group col-md-6">
                                <label for="document"> Document <span style="color:red">*</span></label>
                                <input type="file" class="form-control" name="document">
                                <span class="text-danger"><b>Note : </b>Max size 100 MB and PDF only.</span>
                                <span style="color: red"><?php

                                    if ( $this->session->flashdata( 'document_error' ) ) {

                                        echo $this->session->flashdata('document_error');

                                    }

                                    ?></span> <span style="color: red"><?php echo form_error('document');  ?></span> </div>
                        </div>


                        <input type="submit" name="update" value="Submit" class="btn btn-primary"> </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-tagsinput/examples/assets/app.css">
    <script src="<?php echo base_url(); ?>assets/bootstrap-tagsinput/examples/assets/typeahead.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script>
        var language = <?php  echo json_encode($language) ?>;
        console.log(language);
        var language = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // `states` is an array of state names defined in "The Basics"
            local: language
        });
        language.initialize();
        $('.languageList').tagsinput({
            confirmKeys: [13, 188],
            typeaheadjs: {
                name: 'language',
                source: language
            }
        });
        $('.bootstrap-tagsinput input').keydown(function(event) {
            if(event.which == 13) {
                $(this).blur();
                $(this).focus();
                return false;
            }
        })
    </script>