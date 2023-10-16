<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Manager on Duty</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>manager_on_duty"><i class="fa fa-home"></i>Manager on Duty</a></li>
        <li class="active"><strong>Edit Manager on Duty</strong></li>
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
                    <h3 class="panel-title">Edit Manager on Duty</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>




                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo base_url();?>manager_on_duty/edit/<?= $manager->id ?>">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo set_value('name') == false ? $manager->name : set_value('name') ?>">
                                <span style="color: red"><?php echo form_error('name'); ?></span>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo set_value('email') == false ? $manager->email : set_value('email') ?>">
                                <span style="color: red"><?php echo form_error('email'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="contact_no">Contact No</label>
                                <input type="text" class="form-control" name="contact_no" value="<?php echo set_value('contact_no') == false ? $manager->contact_no : set_value('contact_no') ?>">
                                <span style="color: red"><?php echo form_error('contact_no'); ?></span>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="start_date">Start Date</label>
                                <input type="text" id="startDate" class="form-control" name="start_date" value="<?php echo set_value('start_date') == false ? date('m/d/Y', strtotime($manager->start_date)) : date('m/d/Y', strtotime(set_value('start_date'))) ?>">
                                <span style="color: red"><?php echo form_error('start_date'); ?></span>
                                <?php if($this->session->flashdata('error_date')) { ?>
                                    <span style="color: red"><?php echo $this->session->flashdata('error_date'); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="end_date">End Date</label>
                                <input type="text" id="endDate" class="form-control" name="end_date" value="<?php echo set_value('end_date') == false ? date('m/d/Y', strtotime($manager->end_date)) : date('m/d/Y', strtotime(set_value('end_date'))) ?>">
                                <span style="color: red"><?php echo form_error('end_date'); ?></span>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="sel1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Active" <?php echo set_select('status', "Active", ("Active" ==  set_value('status', $manager->status))); ?>>Active</option>
                                    <option value="Inactive" <?php echo set_select('status', "Inactive", ("Inactive" ==  set_value('status', $manager->status))); ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>

    </div>

