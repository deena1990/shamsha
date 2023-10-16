<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Edit Resource Country</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>resource_location"></i>Resource Country</a></li>
        <li class="active"><strong>Edit Resource Country</strong></li>
    </ol>



    <?php if($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs"  role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Edit Resource Country</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>




                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo base_url();?>resource_location/edit/<?php echo $category->wcrid ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="location_name">Country Name (English)</label>
                                <input type="text" class="form-control" name="location_name" value="<?php echo set_value('location_name') == false ? $category->location_name : set_value('location_name') ?>">
                                <span style="color: red"><?php echo form_error('location_name'); ?></span>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="location_name_ar">Country Name (Arabic)</label>
                                <input type="text" class="form-control" name="location_name_ar" value="<?php echo set_value('location_name_ar') == false ? $category->location_name_ar : set_value('location_name_ar') ?>">
                                <span style="color: red"><?php echo form_error('location_name_ar'); ?></span>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="sel1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Active" <?php echo set_select('status', "Active", ("Active" ==  set_value('status', $category->status))); ?>>Active</option>
                                    <option value="Inactive" <?php echo set_select('status', "Inactive", ("Inactive" ==  set_value('status', $category->status))); ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>

    </div>