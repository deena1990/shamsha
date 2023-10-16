<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">User Information</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>volunteer/alluser">Volunteers </a></li>
        <li class="active"><strong>Change Password</strong></li>
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
                    <h3 class="panel-title">Change Password</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div>




                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo  base_url();?>volunteer/cpassword/<?php echo $user[0]->wc_vid;?>" enctype="multipart/form-data">


                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">New Password</label>
                                <input type="password" class="form-control" name="new_pass" id="password" placeholder="New Password">

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="emailaddress">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_pass" id="password" placeholder="Confirm Password">
                                <?php echo form_error('passconf', '<div class="error">', '</div>')?>
                            </div>
                        </div>


                        <input type="submit" name="update" value="Submit" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>

    </div>