<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">My Profile</h1>
    <!-- Breadcrumb -->
    <!-- <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Profile</strong></li>
    </ol> -->

    <?php if($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading clearfix">
                    <h3 class="panel-title">Edit Details</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div> -->
                <div class="panel-body">
                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo  base_url();?>update_profile/edit/<?php echo $userdetail->id ?>" enctype="multipart/form-data">
                        <div class="row">
                            <!-- <div class="form-group col-md-4">
                                <img src="<?php echo  base_url();?>public/images/download.png" height=200 width=200 alt="Image" style="border-radius: 100px; margin: 10px 0px 0px 75px;">
                            </div> -->
                            <div class="form-group col-md-12">

                                <div class="form-group col-md-6">
                                    <label for="name"> Name <span style="color:red">*</span></label>
                                    <input type="text" value="<?php echo set_value('name') == false ? $userdetail->name : set_value('name') ?>" class="form-control" name="name" placeholder="Name">
                                    <span style="color: red"><?php echo form_error('name');  ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email ID <span style="color:red">*</span></label>
                                    <input type="email" value="<?php echo set_value('email') == false ? $userdetail->email : set_value('email') ?>" class="form-control" name="email" id="email" placeholder="Email">
                                    <span style="color: red"><?php echo form_error('email');  ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Username <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="username" value="<?php echo set_value('username') == false ? $userdetail->username : set_value('username') ?>" id="username" placeholder="Username">
                                    <span style="color: red"><?php echo form_error('username');  ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emailaddress">Password <span style="color:red">*</span></label>
                                    <input type="password" class="form-control" name="password" value="" id="password" placeholder="Password">
                                    <span style="color: red"><?php echo form_error('password');  ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sel1">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="">Select</option>
                                        <?php 
                                        foreach ($roles as $role){
                                            echo "<option value='".$role->id."' ".set_select('role', $role->id, ($role->id ==  set_value('role', $user_role))).">".$role->display_name."</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style="color: red"><?php echo form_error('role');  ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sel1">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1" <?php echo set_select('status', "Active", ("Active" ==  set_value('status', $userdetail->status))); ?>>Active</option>
                                        <option value="0" <?php echo set_select('status', "Inactive", ("Inactive" ==  set_value('status', $userdetail->status))); ?>>Inactive</option>
                                    </select>
                                    <span style="color: red"><?php echo form_error('status');  ?></span>
                                </div>
                                <div class="row text-center">
                                    <input type="submit" name="insert" value="Update" class="btn btn-primary" style="margin-top: 10px;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
