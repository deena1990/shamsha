<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Module Information</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>permissions">Module</a></li>
        <li class="active"><strong>Add Module</strong></li>
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
                    <h3 class="panel-title">Add Module</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo  base_url();?>permissions/modulesadd" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"> Name <span style="color:red">*</span></label>
                                <input type="text" value="<?php echo set_value('name') ?>" class="form-control" name="name" placeholder="Name">
                                <span style="color: red"><?php echo form_error('name');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username">Description <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="description" value="<?php echo set_value('description') ?>" id="description" placeholder="Description">
                                <span style="color: red"><?php echo form_error('description');  ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="sel1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?php echo set_select('status', "1") ?>>Active</option>
                                    <option value="0" <?php echo set_select('status', "0") ?>>Inactive</option>
                                </select>
                                <span style="color: red"><?php echo form_error('status');  ?></span>
                            </div>
                        </div>


                        <input type="submit" name="insert" value="Submit" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>

    </div>
<?php
