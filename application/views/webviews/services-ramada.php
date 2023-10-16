<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Ramada Booking</title>
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
              padding-left: 10px;
          }
          .ramada-logo{
              width: 200px;
                height: auto;
                margin: auto;
                display: block;
                margin-bottom: 30px;
          }
      </style>
   </head>
   <body>
       <br>
      <div class="container">
         <div class="row">
             <?php
             if($this->session->flashdata("message")) {
                
             ?>
             <script>
                 M.toast({html: 'Submited Successfully', classes: 'rounded'});
             </script>
             <?php
             }
             ?>
             <img src="<?php echo site_url() ?>assets/images/ramada-Logo.png" class="ramada-logo" /> 
            <form class="col s12" method="post">
               <div class="row">
                  <div class="input-field col s12">
                     <input name="victim_name" id="victim_name" value="<?php echo set_value('victim_name'); ?>" type="text" class="validate">
                     <label for="victim_name">Name of client</label>
                  </div>
                  <?php echo form_error('victim_name', '<div class="error">', '</div>'); ?>
               </div>
			   <div class="row">
                  <div class="input-field col s12">
                     <input name="CPR/ID" id="CPR/ID" value="<?php echo set_value('CPR/ID'); ?>" type="text" class="validate">
                     <label for="CPR/ID">CPR/ID</label>
                  </div>
                  <?php echo form_error('CPR/ID', '<div class="error">', '</div>'); ?>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <input name="victim_mobile" id="victim_mobile" value="<?php echo set_value('victim_mobile'); ?>" type="text" class="validate">
                     <label for="victim_mobile">Mobile phone</label>
                  </div>
                  <?php echo form_error('victim_mobile', '<div class="error">', '</div>'); ?>
               </div>
				<div class="row">
                  <div class="input-field col s12">
                     <input name="victim_email" id="victim_email" value="<?php echo set_value('victim_email'); ?>" type="text" class="validate">
                     <label for="victim_email">Email address</label>
                  </div>
                  <?php echo form_error('victim_email', '<div class="error">', '</div>'); ?>
               </div>
				<div class="row">
					
                  <div class="input-field col s12">
					  <select name="smoking" class="form-control" >
						  <option value="1" <?php echo  set_select('smoking', '1'); ?>>Yes</option>
						  <option value="0" <?php echo  set_select('smoking', '0'); ?> selected>No</option>
					  </select>
                     <!--<input name="smoking" id="smoking" value="<?php echo set_value('smoking'); ?>" type="text" class="validate">-->
                     <label for="smoking">Smoking</label>
                  </div>
                  <?php echo form_error('smoking', '<div class="error">', '</div>'); ?>
               </div>
                <div class="row">
                  <div class="input-field col s12">
                      <select name="breakfast" class="form-control" >
						  <option value="1" <?php echo  set_select('breakfast', '1'); ?>>Yes</option>
						  <option value="0" <?php echo  set_select('breakfast', '0'); ?> selected>No</option>
					  </select>
                     <label for="breakfast">Breakfast request</label>
                  </div>
                  <?php echo form_error('breakfast', '<div class="error">', '</div>'); ?>
               </div>
				<div class="row">
                  <div class="input-field col s12">
                     <input name="booking_date" id="booking_date" value="<?php echo set_value('booking_date'); ?>" type="text" class="validate datepicker">
                     <label for="booking_date">Date *</label>
                  </div>
                  <?php echo form_error('booking_date', '<div class="error">', '</div>'); ?>
               </div>
                <div class="row">
                    
                    <div class="input-field col s12">
                        <select name="no_of_rooms" id="no_of_rooms">
                          <option value="" disabled selected>Select No of Rooms</option>
                          <option value="1" <?php echo  set_select('number_of_rooms', '1'); ?> selected>1</option>
                          <option value="2" <?php echo  set_select('number_of_rooms', '2'); ?> >2</option>
                          <option value="3" <?php echo  set_select('number_of_rooms', '3'); ?> >3</option>
                        </select>
                        <label>No of Rooms *</label>
                      </div>
                  <?php echo form_error('no_of_rooms', '<div class="error">', '</div>'); ?>
               </div>
               
               <p class="center-align"><button class="btn waves-effect waves-light" type="submit" name="action">Submit</button></p>
            </form>
         </div>
      </div>
      <br>
      
      <script>
         $(document).ready(function(){
    $('.datepicker').datepicker({
        'format' : "yyyy-mm-dd"
    });
     $('select').formSelect();
  });
      </script>
   </body>
</html>