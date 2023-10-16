<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Resource Category</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>resource_category">Resource Category</a></li>
        <li class="active"><strong>Edit Resource Category</strong></li>
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
                    <h3 class="panel-title">Edit Resource Category</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo base_url();?>resource_category/edit/<?php echo $category->wcrcid ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category_name">Category Name (English)</label>
                                <input type="text" class="form-control" name="category_name" value="<?php echo set_value('category_name') == false ? $category->category_name : set_value('category_name') ?>">
                                <span style="color: red"><?php echo form_error('category_name'); ?></span>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_name_ar">Category Name (Arabic)</label>
                                <input type="text" class="form-control" name="category_name_ar" value="<?php echo set_value('category_name_ar') == false ? $category->category_name_ar : set_value('category_name_ar') ?>">
                                <span style="color: red"><?php echo form_error('category_name_ar'); ?></span>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_icon">Category Icon</label>
                                <input type="file" class="form-control" name="category_icon">
                                <input type="hidden" name="pre_category_icon" value="<?= explode(":::",$category->category_icon)[0] ?>">
                                <span style="color: red"><?php
                                    if ( $this->session->flashdata( 'category_icon_error' ) ) {
                                        echo $this->session->flashdata('category_icon_error');
                                    }
                                    ?></span>
                                <img src="<?= base_url().'uploads/resource_category_img/'.explode(":::",$category->category_icon)[0] ?>" class="fileImg" style="height: 80px; margin-top: 10px; background: lightgrey; border: 1px solid lightgrey;"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_icon_select">Category Icon Select</label>
                                <input type="file" class="form-control" name="category_icon_select">
                                <input type="hidden" name="pre_category_icon_select" value="<?= explode(":::",$category->category_icon)[1] ?>">
                                <span style="color: red"><?php
                                    if ( $this->session->flashdata( 'category_icon_select_error' ) ) {
                                        echo $this->session->flashdata('category_icon_select_error');
                                    }
                                    ?></span>
                                <img src="<?= base_url().'uploads/resource_category_img/'.explode(":::",$category->category_icon)[1] ?>" class="fileImg" style="height: 80px; margin-top: 10px; background: lightgrey; border: 1px solid lightgrey;"/>
                            </div>
                            <div class="form-group col-md-6">
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