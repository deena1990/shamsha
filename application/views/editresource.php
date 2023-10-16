<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Resources</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Resources</strong></li>
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
                    <h3 class="panel-title"> Update Details</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>


                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add" method="POST"
                          action="<?php echo base_url(); ?>resource/edit/<?php echo $resource->wcresid; ?>"
                          enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Select Location</label>
                                <select class="form-control" name="res_loc_id">
                                    <option value="">Select</option>
                                    <?php $j = 0;
                                    for ($i = 0; $i < count($location); $i++) {
                                        ?>
                                        <option value="<?php echo $location[$i]->wcrid; ?>" <?php echo set_select('res_loc_id', $location[$i]->wcrid, ($location[$i]->wcrid ==  set_value('res_loc_id', $resource->res_loc_id))); ?>><?php echo $location[$i]->location_name; ?></option>
                                    <?php } ?>
                                </select>
                                <span style="color: red"><?php echo form_error('res_loc_id'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Select Category</label>
                                <select class="form-control" name="res_res_cat_id">
                                    <option value="">Select</option>
                                    <?php $j = 0;
                                    for ($i = 0; $i < count($category); $i++) {
                                        ?>
                                        <option value="<?php echo $category[$i]->wcrcid; ?>" <?php echo set_select('res_res_cat_id', $category[$i]->wcrcid, ($category[$i]->wcrcid ==  set_value('res_res_cat_id', $resource->res_res_cat_id))); ?>><?php echo $category[$i]->category_name; ?></option>
                                    <?php } ?>
                                </select>
                                <span style="color: red"><?php echo form_error('res_res_cat_id'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="<?php echo set_value('name') == false ? $resource->name : set_value('name') ?>">
                                <span style="color: red"><?php echo form_error('name'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Address</label>
                                <textarea type="text" name="address_info"
                                          class="form-control"><?php echo set_value('address_info') == false ? $resource->address_info : set_value('address_info') ?></textarea>
                                <span style="color: red"><?php echo form_error('address_info'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Phone Number 1</label>
                                <input type="text" name="contact_info1" class="form-control"
                                       value="<?php echo set_value('contact_info1') == false ? $resource->contact_info1 : set_value('contact_info1') ?>">
                                <span style="color: red"><?php echo form_error('contact_info1'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Phone Number 2</label>
                                <input type="text" name="contact_info2" class="form-control"
                                       value="<?php echo set_value('contact_info2') == false ? $resource->contact_info2 : set_value('contact_info2') ?>">
                                <span style="color: red"><?php echo form_error('contact_info2'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Phone Number 3</label>
                                <input type="text" name="contact_info3" class="form-control"
                                       value="<?php echo set_value('contact_info3') == false ? $resource->contact_info3 : set_value('contact_info3') ?>">
                                <span style="color: red"><?php echo form_error('contact_info3'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Phone Number 4</label>
                                <input type="text" name="contact_info4" class="form-control"
                                       value="<?php echo set_value('contact_info4') == false ? $resource->contact_info4 : set_value('contact_info4') ?>">
                                <span style="color: red"><?php echo form_error('contact_info4'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Email 1</label>
                                <input type="text" name="email_info1" class="form-control"
                                       value="<?php echo set_value('email_info1') == false ? $resource->email_info1 : set_value('email_info1') ?>">
                                <span style="color: red"><?php echo form_error('email_info1'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Email 2</label>
                                <input type="text" name="email_info2" class="form-control"
                                       value="<?php echo set_value('email_info2') == false ? $resource->email_info2 : set_value('email_info2') ?>">
                                <span style="color: red"><?php echo form_error('email_info2'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Email 3</label>
                                <input type="text" name="email_info3" class="form-control"
                                       value="<?php echo set_value('email_info3') == false ? $resource->email_info3 : set_value('email_info3') ?>">
                                <span style="color: red"><?php echo form_error('email_info3'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Website 1</label>
                                <input type="text" name="web_info1" class="form-control"
                                       value="<?php echo set_value('web_info1') == false ? $resource->web_info1 : set_value('web_info1') ?>">
                                <span style="color: red"><?php echo form_error('web_info1'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Website 2</label>
                                <input type="text" name="web_info2" class="form-control"
                                       value="<?php echo set_value('web_info2') == false ? $resource->web_info2 : set_value('web_info2') ?>">
                                <span style="color: red"><?php echo form_error('web_info2'); ?></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emailaddress">Timing</label>
                                <input type="text" name="timings" class="form-control"
                                       value="<?php echo set_value('timings') == false ? $resource->timings : set_value('timings') ?>">
                                <span style="color: red"><?php echo form_error('timings'); ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sel1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Active" <?php echo set_select('res_loc_id', 'Inactive', ('Active' ==  set_value('status', $resource->status))); ?>>Active</option>
                                    <option value="Inactive" <?php echo set_select('res_loc_id', 'Inactive', ('Inactive'==  set_value('status', $resource->status))); ?>>Inactive</option>
                                </select>
                            </div>

                        </div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>

    </div>