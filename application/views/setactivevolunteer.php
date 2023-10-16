<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Minimum Active Volunteers Count</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Set Active Volunteers</strong></li>
    </ol>

    <?php if($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading clearfix">
                    <h3 class="panel-title">Set Active Volunteers</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div> -->
                <div class="panel-body">
                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo base_url();?>volunteer/setActiveVols" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress"> Minimum Active Volunteers <span style="color:red">*</span></label>
                                <input type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?= $activeVolsCount ?>" class="form-control" name="activeVolsCount" placeholder="Set Minimum Active Volunteers Count" required>
                                <span style="color: red"><?php echo form_error('activeVolsCount');  ?></span>
                            </div>
                        </div>
                        <?php if (can('edit-set_active_volunteer')) { ?> 
                        <input type="submit" name="update" value="Update" class="btn btn-primary">
                        <?php } ?>
                    </form>
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
        $('.bootstrap-tagsinput input').keydown(function( event ) {
            if ( event.which == 13 ) {
                $(this).blur();
                $(this).focus();
                return false;
            }
        })
    </script>
    <style>
        .fileImg{
            height: 80px;
            width: auto;
            margin-top: 20px;
        }
    </style>
