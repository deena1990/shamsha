<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Update Volunteer</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>volunteer/alluser">Volunteers</a></li>
        <li class="active"><strong>Update Volunteer</strong></li>
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
                    <h3 class="panel-title">Update Details</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <?php //echo form_open('User/add'); ?>
                    <form name="add"   method="POST" action="<?php echo  base_url();?>volunteer/edit/<?php echo $user->wc_vid;?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress"> Name <span style="color:red">*</span></label>
                                <input type="text" value="<?php echo set_value('vname') == false ? $user->vname : set_value('name') ?>" class="form-control" name="name" placeholder="Name">
                                <span style="color: red"><?php echo form_error('vname');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Email ID <span style="color:red">*</span></label>
                                <input type="email" value="<?php echo set_value('email') == false ? $user->vemail : set_value('email') ?>" class="form-control" name="email" id="emailaddress" placeholder="Email">
                                <span style="color: red"><?php echo form_error('vemail');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Mobile No. <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="mobile" value="<?php echo set_value('mobile') == false ? $user->vmobile : set_value('mobile') ?>" id="emailaddress" placeholder="mobile">
                                <!--<input type="text" data-mask="(+999) 9999-9999" name="mobile" class="form-control">-->
                                <span style="color: red"><?php echo form_error('vmobile');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Whatsapp<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="whatsapp" value="<?php echo set_value('whatsapp') == false ? $user->whatsapp : set_value('whatsapp') ?>" id="emailaddress" placeholder="Whatsapp">
                                <!--<input type="text" data-mask="(+999) 9999-9999" name="mobile" class="form-control">-->
                                <span style="color: red"><?php echo form_error('whatsapp');  ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emailaddress"> Passport/CPR No.<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="passport_r_cpr" value="<?php echo set_value('passport_r_cpr') == false ? $user->passport_r_cpr : set_value('passport_r_cpr') ?>" placeholder="passport or cpr">
                                <span style="color: red"><?php echo form_error('passport_r_cpr');  ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emailaddress">Address <span style="color:red">*</span></label>
                                <textarea class="form-control" name="address" rows="4"><?php echo set_value('address') == false ? $user->address : set_value('address') ?></textarea>
                                <span style="color: red"><?php echo form_error('address');  ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Residence<span style="color:red">*</span></label>
                                <input type="text" name="residence" value="<?php echo set_value('residence') == false ? $user->residence : set_value('residence') ?>" class="form-control" placeholder="Residence"> 
                                <span style="color: red"><?php echo form_error('residence');  ?></span> 
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Nationality<span style="color:red">*</span></label>
                                <input type="text" name="nationality" value="<?php echo set_value('nationality') == false ? $user->nationality : set_value('nationality') ?>" class="form-control" placeholder="Nationality"> 
                                <span style="color: red"><?php echo form_error('nationality');  ?></span> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Date of Birth <span style="color:red">*</span></label>
                                <div id="date-popup" class="input-group date">
                                    <input type="text" data-format="D, dd MM yyyy" name="dob" value="<?php echo set_value('dob') == false ? date('m/d/Y', strtotime($user->date_of_birth)) : set_value('dob') ?>" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <span style="color: red"><?php echo form_error('date_of_birth');  ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emailaddress">Date of Joining <span style="color:red">*</span></label>
                                <div id="date-popup2" class="input-group date">
                                    <input type="text" data-format="D, dd MM yyyy" name="doj" value="<?php echo set_value('doj') == false ? date('m/d/Y', strtotime($user->date_of_joining)) : set_value('doj') ?>" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <span style="color: red"><?php echo form_error('date_of_joining');  ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress"> Profile Picture  <span style="color:red">*</span></label>
                                <input type="file" class="form-control" name="profile_pic">
                                <span style="color:red; display: block;">Max size 2MB, Max Dimension 1500X1500</span>
                                <img src="<?= base_url().'uploads/'.$user->profile_pic ?>" class="fileImg"/>
                                <span style="color: red"><?php
                                    if ( $this->session->flashdata( 'profile_pic_error' ) ) {
                                        echo $this->session->flashdata('profile_pic_error');
                                    }
                                    ?></span>
                                <span style="color: red"><?php echo form_error('profile_pic');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress"> Passport <span style="color:red"></span></label>
                                <input type="file" class="form-control" name="passport_pic">
                                <img src="<?= base_url().'uploads/'.$user->passport_pic ?>" class="fileImg"/>
                                <span style="color: red"><?php
                                    if ( $this->session->flashdata( 'passport_pic_error' ) ) {
                                        echo $this->session->flashdata('passport_pic_error');
                                    }
                                    ?></span>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="emailaddress">CPR(Front) <span style="color:red"></span></label>
                                <input type="file" class="form-control" name="cpr_pic">
                                <img src="<?= base_url().'uploads/'.$user->cpr_pic ?>" class="fileImg"/>
                                <span style="color: red"><?php
                                    if ( $this->session->flashdata( 'cpr_pic_error' ) ) {
                                        echo $this->session->flashdata('cpr_pic_error');
                                    }
                                    ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">CPR(Back) <span style="color:red"></span></label>
                                <input type="file" class="form-control" name="cpr_back_pic">
                                <img src="<?= base_url().'uploads/'.$user->cpr_back_pic ?>" class="fileImg"/>
                                <span style="color: red"><?php
                                    if ( $this->session->flashdata( 'cpr_back_pic_error' ) ) {
                                        echo $this->session->flashdata('cpr_back_pic_error');
                                    }
                                    ?></span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Shift Language <span style="color:red">*</span></label>
                                <select class="form-control" name="slanguage">
                                    <option value="English">English</option>
                                    <option value="Arabic">Arabic</option>
                                </select>
                                <span style="color: red"><?php echo form_error('shift_language');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailaddress">Languages Known <span style="color:red">*</span></label>
                                <input type="text" name="language" value="<?php echo set_value('language') == false ? $user->language_known : set_value('language') ?>" class="form-control languageList"></input>
                                <span style="color: red"><?php echo form_error('language_known');  ?></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="emergency_contact">Emergency contact No.</label>
                                <input type="text" class="form-control" name="emergency_contact" value="<?php echo set_value('emergency_contact') == false ? $user->emergency_contact : set_value('emergency_contact') ?>" id="emergency_contact" placeholder="Emergency contact No">
                                <span style="color: red"><?php echo form_error('vmobile');  ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="total_rewards">Total Rewards</label>
                                    <input type="text" class="form-control" name="total_rewards" value="<?php echo set_value('total_rewards') == false ? $user->total_rewards : set_value('total_rewards') ?>" id="emergency_contact" placeholder="Total Rewards">
                                    <span style="color: red"><?php echo form_error('total_rewards');  ?></span>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                    <label for="onDuty_status">On Duty Status</label>
                                    <select class="form-control" name="onduty_status">
                                        <option value="0" <?php echo set_select('onduty_status', "0", ("0" ==  set_value('onduty_status', $user->onduty_status))); ?>>Inactive</option>
                                        <option value="1" <?php echo set_select('onduty_status', "1", ("1" ==  set_value('onduty_status', $user->onduty_status))); ?>>Active</option>
                                    </select>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="sel1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="Active" <?php echo set_select('status', "Active", ("Active" ==  set_value('status', $user->status))); ?>>Active</option>
                                    <option value="On Break" <?php echo set_select('status', "On Break", ("On Break" ==  set_value('status', $user->status))); ?>>On Break</option>
                                    <option value="Inactive" <?php echo set_select('status', "Inactive", ("Inactive" ==  set_value('status', $user->status))); ?>>Inactive</option>
                                    <option value="Left" <?php echo set_select('status', "Left", ("Left" ==  set_value('status', $user->status))); ?>>Left</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="update" value="Submit" class="btn btn-primary">

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