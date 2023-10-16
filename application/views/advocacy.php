	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Advocacy</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Advocacy</strong></li> 
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
						<h3 class="panel-title">Advocacy</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 

                        <form class="col s12" method="post" action="<?php echo base_url();?>advocacy/edit/<?php echo $advocacy->id;?>">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name">Full Name *</label>
                                    <input name="fullname" id="name" value="<?php echo set_value('fullname') == false ? $advocacy->fullname : set_value('fullname') ?>" type="text" class="form-control">
                                    <?php echo form_error('fullname', '<div class="error">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="email">Email Address</label>
                                    <input name="email_id" id="email" value="<?php echo set_value('email_id') == false ? $advocacy->email_id : set_value('email_id') ?>" type="email" class="form-control">
                                    <?php echo form_error('email_id', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mobile">Mobile Number (Include Whatsapp Number)</label>
                                    <input name="mobile" id="mobile" value="<?php echo set_value('mobile') == false ? $advocacy->mobile : set_value('mobile') ?>" type="text" class="form-control">
                                    <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-4">
                                    <p><label>Are you 21 years or older?</label></p>
                                        <label>
                                            <input name="age_above_r_nt" value="Yes" <?php echo set_radio('age_above_r_nt', "Yes", ("Yes" ==  set_value('age_above_r_nt', $advocacy->age_above_r_nt))); ?> class="radio-inline" type="radio" />
                                            <span>Yes</span>
                                        </label>
                                        <label>
                                            <input class="radio-inline" value="No" <?php echo set_radio('age_above_r_nt', "No", ("No" ==  set_value('age_above_r_nt', $advocacy->age_above_r_nt))); ?> name="age_above_r_nt" type="radio"  />
                                            <span>No</span>
                                        </label>
                                    <?php echo form_error('age_above_r_nt', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <p><label>What languages do you speak? *</label></p>

                                        <label>
                                            <input type="checkbox" name="language_u_speak[]" <?php echo set_checkbox('language_u_speak[]', "English", ("English" == set_value('language_u_speak[]', in_array('English', explode(',',$advocacy->language_u_speak)) ? "English" : ""))) ?> value="English" class="checkbox-inline"  />
                                            <span>English</span>
                                        </label>

                                        <label>
                                            <input type="checkbox" name="language_u_speak[]" <?php echo set_checkbox('language_u_speak[]', "Arabic", ("Arabic" == set_value('language_u_speak[]', in_array('Arabic', explode(',',$advocacy->language_u_speak)) ? "Arabic" : ""))) ?> value="Arabic" class="checkbox-inline" />
                                            <span>Arabic</span>
                                        </label>

                                        <label>
                                            <?php
                                              $otherLang = array_diff(explode(',',$advocacy->language_u_speak), array('English','Arabic'));
                                              //print_r($otherLang);
                                            ?>
                                            <input type="checkbox" value="Other" <?php echo set_checkbox('language_u_speak[]', "Other", ("Other" == set_value('language_u_speak[]', count($otherLang) > 0 ? "Other" : ""))) ?> name="language_u_speak[]" class="checkbox-inline" />
                                            <span>Other</span>
                                        </label>

                                    <input name="language_u_speak_other" value="<?php echo set_value('language_u_speak_other') == false ? implode(',',$otherLang) : set_value('language_u_speak_other') ?>"  id="other" type="text" class="form-control">
                                    <?php echo form_error('language_u_speak[]', '<div class="error">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <p><label>Do you have access to reliable transportation? *</label></p>

                                        <label>
                                            <input name="transportation" <?php echo set_radio('transportation', "Yes, I have a car.", ("Yes, I have a car." ==  set_value('transportation', $advocacy->transportation))); ?> value="Yes, I have a car." class="radio-inline" type="radio" />
                                            <span>Yes, I have a car.</span>
                                        </label>

                                        <label>
                                            <input class="radio-inline" value="Yes, I have a driver." name="transportation" <?php echo set_radio('transportation', "Yes, I have a driver.", ("Yes, I have a driver." ==  set_value('transportation', $advocacy->transportation))); ?> type="radio"  />
                                            <span>Yes, I have a driver.</span>
                                        </label>

                                        <label>
                                            <input class="radio-inline" value="No" name="transportation" <?php echo set_radio('transportation', "No", ("No" ==  set_value('transportation', $advocacy->transportation))); ?> type="radio"  />
                                            <span>No</span>
                                        </label>


                                    <?php echo form_error('transportation', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <p><label>Will you be in the country where you are applying to take the training for atleast 6 months following the training*</label></p>

                                        <label>
                                            <input name="stay_in" value="Yes" class="radio-inline" <?php echo set_radio('stay_in', "Yes", ("Yes" ==  set_value('stay_in', $advocacy->stay_in))); ?> type="radio" />
                                            <span>Yes</span>
                                        </label>

                                        <label>
                                            <input class="radio-inline" value="No" name="stay_in" <?php echo set_radio('stay_in', "No", ("Yes" ==  set_value('stay_in', $advocacy->stay_in))); ?> type="radio"  />
                                            <span>No</span>
                                        </label>
                                    <?php echo form_error('stay_in', '<div class="error">', '</div>'); ?>
                                </div>


                                <div class="form-group col-md-6">
                                    <p><label>Are you able to attend the entire training duration of the training *</label></p>
                                        <label>
                                            <input name="attend_training" value="Yes" <?php echo set_radio('attend_training', "Yes", ("Yes" ==  set_value('attend_training', $advocacy->attend_training))); ?> class="radio-inline" type="radio" />
                                            <span>Yes</span>
                                        </label>

                                        <label>
                                            <input class="radio-inline" value="No" name="attend_training" <?php echo set_radio('attend_training', "No", ("No" ==  set_value('attend_training', $advocacy->attend_training))); ?> type="radio"  />
                                            <span>No</span>
                                        </label>
                                    <?php echo form_error('attend_training', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <p><label>Are you able to volunteer and dedicate a minimum total of 24 hours (two 12 hour shifts) for a period of 6 months from the completion of your training? *</label></p>
                                     <label>
                                            <input name="r_u_volunteer" value="Yes" class="radio-inline" <?php echo set_radio('r_u_volunteer', "Yes", ("Yes" ==  set_value('r_u_volunteer', $advocacy->r_u_volunteer))); ?> type="radio" />
                                            <span>Yes</span>
                                        </label>

                                        <label>
                                            <input class="radio-inline" value="No" name="r_u_volunteer" <?php echo set_radio('r_u_volunteer', "No", ("No" ==  set_value('r_u_volunteer', $advocacy->r_u_volunteer))); ?> type="radio"  />
                                            <span>No</span>
                                        </label>
                                    <label>
                                        <?php
                                        $r_u_volunteer  = array_diff(explode(',',$advocacy->r_u_volunteer), array('Yes','No'));
                                        ?>
                                            <input class="radio-inline" value="Other" name="r_u_volunteer" <?php echo set_radio('r_u_volunteer', "Other", ("Other" ==  set_value('r_u_volunteer', count($r_u_volunteer) > 0 ? "Other" : ""))); ?> type="radio"  />
                                            <span>Other</span>
                                        </label>
                                    <input name="r_u_volunteer_other" value="<?php echo set_value('r_u_volunteer_other') == false ? $advocacy->r_u_volunteer : set_value('language_u_speak_other') ?>" id="other" type="text" class="form-control">
                                    <?php echo form_error('r_u_volunteer', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <p><label>Do you understand that though this is an unpaid volunteer position, it requires a serious and reliable commitment? *</label></p>
                                    <label>
                                            <input name="unpain_volunteer" value="Yes" <?php echo set_radio('unpain_volunteer', "Yes", ("Yes" ==  set_value('unpain_volunteer', $advocacy->unpain_volunteer))); ?> class="radio-inline" type="radio" />
                                            <span>Yes</span>
                                        </label>

                                        <label>
                                            <input class="radio-inline" value="No" name="unpain_volunteer" <?php echo set_radio('unpain_volunteer', "No", ("No" ==  set_value('unpain_volunteer', $advocacy->unpain_volunteer))); ?> type="radio"  />
                                            <span>No</span>
                                        </label>
                                    <?php echo form_error('unpain_volunteer', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <p><label>Training Fees *</label></p>
                                    <p>
                                        <label>
                                            <input name="traning_fee" value="I will pay the entire fee to cover the cost of my training spot." <?php echo set_radio('traning_fee', "I will pay the entire fee to cover the cost of my training spot.", ("I will pay the entire fee to cover the cost of my training spot." ==  set_value('traning_fee', $advocacy->traning_fee))); ?> class="with-gap" type="radio" />
                                            <span>I will pay the entire fee to cover the cost of my training spot.</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input class="with-gap" <?php echo set_radio('traning_fee', "I am unable to pay the fee.", ("I am unable to pay the fee." ==  set_value('traning_fee', $advocacy->traning_fee))); ?> value="I am unable to pay the fee." name="traning_fee" type="radio"  />
                                            <span>I am unable to pay the fee.</span>
                                        </label>
                                    </p>
                                    <?php echo form_error('traning_fee', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <p><label>In case you are not selected to become an advocate and you would like to be involved, please tell us her if you have any additional skills or time that you would like to share. We will contact you regarding this if and when the appropriate need arises.</label></p>
                                    <input name="any_additional_skill" value="<?php echo set_value('any_additional_skill') == false ? $advocacy->any_additional_skill : set_value('any_additional_skill') ?>" id="other" type="text" class="form-control">
                                    <?php echo form_error('any_additional_skill', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <p><label>*Kindly note only successful applicants will be contacted for a followup interview. Due to limited staffing at Shamsaha, and a high volume of applicants, we are unable to contact and respond to anyone who has not been selected for an interview. Further, please note that the completion of this form does not guarantee you a spot in the upcoming training. Thank you most sincerely for your interest! *</label></p>
                                    <p>
                                        <label>
                                            <input type="checkbox" name="understand_r_not" <?php echo set_checkbox('understand_r_not', "I understand.", ("I understand." == set_value('understand_r_not', $advocacy->understand_r_not))) ?> value="I understand." class="filled-in" />
                                            <span>I understand.</span>
                                        </label>
                                    </p>
                                </div>
                                <?php echo form_error('understand_r_not', '<div class="error">', '</div>'); ?>
                            </div>
                            <br>
                            <p class="center-align"><button class="btn btn-info" type="submit" name="action">Submit</button></p>
                        </form>

                    </div>

				</div>
			</div>
		
		</div>
		
		<style>
            .error{
                color: red!important;
            }
            input[type=checkbox], input[type=radio] {
   
    margin-left: 10px;
}
        </style>