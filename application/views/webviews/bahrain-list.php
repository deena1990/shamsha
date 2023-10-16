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
		  .input-field label {
			 color:#F44336;
		   }
		  .collection .collection-item.active {
			  background-color: #F44336;
			  color:#eafaf9;
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
            <div class="col s12">
				<h5 style="margin-bottom:20px;">Start Address</h5>
				<div class="row">
					<div class="input-field col s12">
						<div class="collection" id="start">
							<?php 
								$object=json_decode($startAddresses,true);
								foreach($object["items"] as $ad){
									echo "<a href=\"#!=\" class=\"collection-item\" position=".json_encode($ad["position"]).">".$ad["title"]."</a>";
									//print_r($ad["position"]);
									//print_r($ad);
								}
							?>
						</div>
					</div>
					<?php echo form_error('bend', '<div class="error">', '</div>'); ?>
				</div>
				<h5 style="margin-bottom:20px;">End Address</h5>
				<div class="row">
					<div class="input-field col s12">
						<div class="collection" id="end">
							<?php 
								$object=json_decode($endAddresses,true);
								foreach($object["items"] as $ad){
									echo "<a href=\"#!=\" class=\"collection-item\" position=". json_encode($ad["position"]).">".$ad["title"]."</a>";
									
									//print_r( $ad["position"]);
									//print_r($ad);
								}
							?>
						</div>
					</div>
					<?php echo form_error('bend', '<div class="error">', '</div>'); ?>
				</div>
				<p class="center-align">
				<button class="btn waves-effect red" id="submit" type="submit" name="submit">Request Taxi</button>
				</p>
            </div>
			
         </div>
      </div>
      <br>
   </body>
	<script>
		let address = {
			"start":false,
			"end":false,
			"mobile":<?php echo $mobile;?>,
		};
		$(document).ready(function() {
			console.log("boom");
            $('.collection').on('click', 'a',function() {
				
				$(this).parent().find( ".active" ).removeClass("active");
                //$('.collection.collection-item.active').removeClass("active");
                $(this).addClass("active");
				
				address[$(this).parent()[0].id] = $(this).attr( "position" );
            });
			$('#submit').click(function() {
				//console.log(address["start"])
				//console.log(address["end"])
				if( address["start"] == false ){
					alert("Choose start adress");
					return;
				}
				if( address["end"] == false ){
					alert("Choose end adress");
					return;
				}
				
				$.ajax({
					type: "POST",
					url: "https://shamsaha.com/app/apis/services/bahrainList",
					beforeSend: function(request) {
						request.setRequestHeader("Authorization", "423d7814-6778-4fa0-b8fd-d4a213abf41d");
					},
					data: address,
					success: function(e){
						console.log(e)
						if(e["status"]){
							alert(e["message"]);
						}else{
							alert(e["message"]);
						}

					},
				});
            });
        });
	</script>
</html>