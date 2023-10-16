<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Bahrain Taxi</title>
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
          .taxi-logo{
              width: 150px;
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
             <?php if($this->session->flashdata("messageBool")) { ?>
             <script>
                 M.toast({html: "<?php echo $this->session->flashdata("message"); ?>", classes: 'rounded'});
             </script>
             <?php } ?>
             <img src="https://onde-images.s3.amazonaws.com/company/2021-05-05/f24d0b41-f3ff-454b-910b-8f8501472385-760ec4b8-ebf0-4b1b-bd84-ab8eb568f209.png" class="taxi-logo" /> 
            <form class="col s12" method="post">
				<h5 style="margin-bottom:20px;">Information</h5>
				<div class="row">
                  <div class="input-field col s12">
                     <input name="phone" id="phone" value="<?php echo set_value('phone'); ?>" type="text" class="validate">
                     <label for="phone">Phone Number</label>
                  </div>
                  <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
				</div>
				<div class="row">
                  <div class="input-field col s12">
                     <input name="country" id="country" value="<?php echo set_value('country'); ?>" type="text" class="validate">
                     <label for="country">Country</label>
                  </div>
                  <?php echo form_error('country', '<div class="error">', '</div>'); ?>
               </div>
				<h5 style="margin-bottom:20px;">Start Address</h5>
				<div class="row">
					<div class="input-field col s12">
						<input name="bstart" id="bstart" value="<?php echo set_value('bstart'); ?>" type="text" class="validate">
						<label for="bstart">Building No</label>
					</div>
					<?php echo form_error('bstart', '<div class="error">', '</div>'); ?>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="rstart" id="rstart" value="<?php echo set_value('rstart'); ?>" type="text" class="validate">
						<label for="rstart">Road No</label>
					</div>
					<?php echo form_error('rstart', '<div class="error">', '</div>'); ?>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="astart" id="astart" value="<?php echo set_value('astart'); ?>" type="text" class="validate">
						<label for="astart">Area/block No</label>
					</div>
					<?php echo form_error('astart', '<div class="error">', '</div>'); ?>
				</div>
				<h5 style="margin-bottom:20px;">End Address</h5>
				<div class="row">
					<div class="input-field col s12">
						<input name="bend" id="bend" value="<?php echo set_value('bend'); ?>" type="text" class="validate">
						<label for="bend">Building No</label>
					</div>
					<?php echo form_error('bend', '<div class="error">', '</div>'); ?>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="rend" id="rend" value="<?php echo set_value('rend'); ?>" type="text" class="validate">
						<label for="rend">Road No</label>
					</div>
					<?php echo form_error('rend', '<div class="error">', '</div>'); ?>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="aend" id="aend" value="<?php echo set_value('aend'); ?>" type="text" class="validate">
						<label for="aend">Area/block No</label>
					</div>
					<?php echo form_error('aend', '<div class="error">', '</div>'); ?>
				</div>
				<p class="center-align">
				<button class="btn waves-effect red" id="submit" type="submit" name="submit">Request Taxi</button>
				</p>
            </form>
			
         </div>
      </div>
      <br>
   </body>
</html>