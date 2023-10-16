<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Google Form</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="<?php echo site_url() ?>assets/js/jquery.min.js"></script>
      <link rel="stylesheet" href="<?php echo site_url() ?>assets/css/materialize.min.css">
      <link rel="stylesheet" href="<?php echo site_url() ?>assets/css/google-form.css">
      <!-- Compiled and minified JavaScript -->
      <script src="<?php echo site_url() ?>assets/js/materialize.min.js"></script>
      <style>
          .error{
              color: red;
          }
          p{
              font-size: 13px;
          }
      </style>
   </head>
   <body>
       <br>
      <div class="container">
         <div class="row">

             <div class="col">
                 <h4 style="font-size: 16px;font-weight: 600;">***KINDLY READ***</h4>

                 <p>All training days are mandatory:</p>

                 <p>First of all, thank you most sincerely for taking the time to complete this form and for expressing interest in becoming a Shamsaha advocate! This alone shows that you are a person who wants to make the world a better place and empower women.</p>

                 <p>If you are selected to attend this training, you will learn first hand how to provide emotional & logistical support to women suffering from abuse in Bahrain through our helplines. Training topics & activities will include but are not limited to: domestic & sexual violence in-depth, sub-conscious bias, understanding trauma, Bahraini laws & legislation, women in the media, & understanding crisis advocacy and its protocols.</p>

                 <p>To understand the responsibilities of an advocate, please read the details below very carefully. Finally, thank you kindly for understanding that due to the high volume of applicants and limited staffing at Shamsaha, if you do not meet the stated requirements in the form to complete the training and become an advocate, you will not be contacted further.</p>

                 <p>To become an advocate, you must be:</p>

                     <p>- A woman<br>
                     - Over 21 years old<br>
                     - Speak English and/or Arabic<br>
                         - Have a car/driver<br>
                         - Live in Bahrain</p>

                 <h5 style="font-size: 15px;font-weight: 600;">DETAILS OF ADVOCATE RESPONSIBILITIES:</h5>
                    <p> - Commit to a minimum total of 24 volunteer hours per month. (Volunteer "on-duty" shifts are in 12-hour increments: Day shift is from 6 AM to 6 PM, Nightshift is from 6 PM to 6 AM the next morning. You are free to choose your shifts. This allows people who work during the day to take night time shifts.)<br>
                     - Be ready to be on call on the mobile helpline during your shift & provide telephone as well as in-person support to any client at any of the approved locations.<br>
                     - Have reliable transportation and be willing to drive for at least 30 minutes during every shift.<br>
                     - Attend a minimum of 3 out of 4 continuing education advocate meetings held during the year, on Saturday afternoons each quarter.<br>
                     - Be available by telephone for a short debrief call with Shamsaha's staff, each day after completing your shift.<br>
                        - Be willing to complete all confidential paperwork or online forms.</p>

                 <p>****The training cost is BD35 per person.</p>
                 <p>Understand this is a serious commitment and make sure to review the responsibilities above. We run a 24/7 helpline to support vulnerable women any hour of the day and require our advocates to take their monthly shifts seriously in order to provide this support.**</p>

                    <p> We have over 100 women volunteers. Join this network of socially conscious & compassionate group of women!</p>
             </div>
            <form class="col s12" method="post">
               <div class="row">
                  <div class="input-field col s12">
                     <input name="fullname" id="name" value="<?php echo set_value('fullname'); ?>" type="text" class="validate">
                     <label for="name">Full Name *</label>
                  </div>
                  <?php echo form_error('fullname', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <input name="email_id" id="email" value="<?php echo set_value('email_id'); ?>" type="email" class="validate">
                     <label for="email">Email Address</label>
                  </div>
                  <?php echo form_error('email_id', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <input name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>" type="text" class="validate">
                     <label for="mobile">Mobile Number (Include Whatsapp Number)</label>
                  </div>
                  <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Are you 21 years or older?</label></p>
                     <p>
                        <label>
                        <input name="age_above_r_nt" value="Yes" <?php echo  set_radio('age_above_r_nt', 'Yes'); ?> class="with-gap" type="radio" />
                        <span>Yes</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="No" <?php echo  set_radio('age_above_r_nt', 'No'); ?> name="age_above_r_nt" type="radio"  />
                        <span>No</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('age_above_r_nt', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>What languages do you speak? *</label></p>
                     <p>
                        <label>
                        <input type="checkbox" name="language_u_speak[]" <?php echo  set_checkbox('language_u_speak[]', 'English'); ?> value="English" class="filled-in"  />
                        <span>English</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input type="checkbox" name="language_u_speak[]" <?php echo  set_checkbox('language_u_speak[]', 'Arabic'); ?> value="Arabic" class="filled-in" />
                        <span>Arabic</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input type="checkbox" value="Other" <?php echo  set_checkbox('language_u_speak[]', 'Other'); ?> name="language_u_speak[]" class="filled-in" />
                        <span>Other</span>
                        </label>
                     </p>
                     <input name="language_u_speak_other" value="<?php echo set_value('language_u_speak_other'); ?>"  id="other" type="text" class="validate">
                  </div>
                  <?php echo form_error('language_u_speak[]', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Do you have access to reliable transportation? *</label></p>
                     <p>
                        <label>
                        <input name="transportation" <?php echo  set_radio('transportation', 'Yes, I have a car.'); ?> value="Yes, I have a car." class="with-gap" type="radio" />
                        <span>Yes, I have a car.</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="Yes, I have a driver." name="transportation" <?php echo  set_radio('transportation', 'Yes, I have a driver.'); ?> type="radio"  />
                        <span>Yes, I have a driver.</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="No" name="transportation" <?php echo  set_radio('transportation', 'No'); ?> type="radio"  />
                        <span>No</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('transportation', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Will you be in the country where you are applying to take the training for atleast 6 months following the training*</label></p>
                     <p>
                        <label>
                        <input name="stay_in" value="Yes" class="with-gap" <?php echo  set_radio('stay_in', 'Yes'); ?> type="radio" />
                        <span>Yes</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="No" name="stay_in" <?php echo  set_radio('stay_in', 'No'); ?> type="radio"  />
                        <span>No</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('stay_in', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Are you able to attend the entire training duration of the training *</label></p>
                     <p>
                        <label>
                        <input name="attend_training" value="Yes" <?php echo  set_radio('attend_training', 'Yes'); ?> class="with-gap" type="radio" />
                        <span>Yes</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="No" name="attend_training" <?php echo  set_radio('attend_training', 'No'); ?> type="radio"  />
                        <span>No</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('attend_training', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Are you able to volunteer and dedicate a minimum total of 24 hours (two 12 hour shifts) for a period of 6 months from the completion of your training? *</label></p>
                     <p>
                        <label>
                        <input name="r_u_volunteer" value="Yes" class="with-gap" <?php echo  set_radio('r_u_volunteer', 'Yes'); ?> type="radio" />
                        <span>Yes</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="No" name="r_u_volunteer" <?php echo  set_radio('r_u_volunteer', 'No'); ?> type="radio"  />
                        <span>No</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" value="Other" name="r_u_volunteer" <?php echo  set_radio('r_u_volunteer', 'Other'); ?> type="radio"  />
                        <span>Other</span>
                        </label>
                     </p>
                     <input name="r_u_volunteer_other" value="<?php echo set_value('r_u_volunteer_other'); ?>" id="other" type="text" class="validate">
                  </div>
                  <?php echo form_error('r_u_volunteer', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Do you understand that though this is an unpaid volunteer position, it requires a serious and reliable commitment? *</label></p>
                     <p>
                        <label>
                        <input name="unpain_volunteer" value="Yes" <?php echo  set_radio('unpain_volunteer', 'Yes'); ?> class="with-gap" type="radio" />
                        <span>Yes</span>
                        </label>
                     </p>
                     <p>
                        <label> 
                        <input class="with-gap" value="No" name="unpain_volunteer" <?php echo  set_radio('unpain_volunteer', 'No'); ?> type="radio"  />
                        <span>No</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('unpain_volunteer', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>Training Fees *</label></p>
                     <p>
                        <label>
                        <input name="traning_fee" value="I will pay the entire fee to cover the cost of my training spot." <?php echo  set_radio('traning_fee', 'I will pay the entire fee to cover the cost of my training spot.'); ?> class="with-gap" type="radio" />
                        <span>I will pay the entire fee to cover the cost of my training spot.</span>
                        </label>
                     </p>
                     <p>
                        <label>
                        <input class="with-gap" <?php echo  set_radio('traning_fee', 'I am unable to pay the fee.'); ?> value="I am unable to pay the fee." name="traning_fee" type="radio"  />
                        <span>I am unable to pay the fee.</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('traning_fee', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>In case you are not selected to become an advocate and you would like to be involved, please tell us her if you have any additional skills or time that you would like to share. We will contact you regarding this if and when the appropriate need arises.</label></p>
                     <input name="any_additional_skill" value="<?php echo set_value('any_additional_skill'); ?>" id="other" type="text" class="validate">
                  </div>
                  <?php echo form_error('any_additional_skill', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <p><label>*Kindly note only successful applicants will be contacted for a followup interview. Due to limited staffing at Shamsaha, and a high volume of applicants, we are unable to contact and respond to anyone who has not been selected for an interview. Further, please note that the completion of this form does not guarantee you a spot in the upcoming training. Thank you most sincerely for your interest! *</label></p>
                     <p>
                        <label>
                        <input type="checkbox" name="understand_r_not" <?php echo  set_checkbox('understand_r_not', 'I understand.'); ?> value="I understand." class="filled-in" />
                        <span>I understand.</span>
                        </label>
                     </p>
                  </div>
                  <?php echo form_error('understand_r_not', '<div class="error">', '</div>'); ?>
               </div>
               <br>
               <p class="center-align"><button class="btn waves-effect waves-light" type="submit" name="action">Submit</button></p>
            </form>
         </div>
      </div>
      <br>
      
      <script>
          function myFunction() {
            var checkBox = document.getElementById("myCheck");
  // Get the output text
            var text = document.getElementById("text");

          // If the checkbox is checked, display the output text
          if (checkBox.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
        }
      </script>
   </body>
</html>