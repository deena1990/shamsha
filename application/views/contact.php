	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Contact Us</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Contact Us</strong></li> 
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
						<h3 class="panel-title">Contact Us</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>contact/update/4" enctype="multipart/form-data">
						 	<div class="row">
								<div class="form-group col-xs-6">
									<label for="title_en">Title ( English )</label>
									<input type="text" name="title_en" class="form-control" id="title_en" value="<?php echo $contact[0]->title_en;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="title_ar">Title ( Arabic )</label>
									<input type="text" name="title_ar" class="form-control" id="title_ar" value="<?php echo $contact[0]->title_ar;?>">
								</div>
							</div>
							
							<div class="row">
								<div class="form-group text-center col-xs-12">
									<label>Image</label><br>
									<input type="file" class="form-control" name="image" id="image" style="display: none">
									<i class="fa fa-camera" id="upload_image_icon"></i>
									<input type="hidden" name="previous_image" value="<?php echo $contact[0]->service_en;?>">
									<span class="text-danger">
										<?php if ($this->session->flashdata('contact_image_error')) { echo $this->session->flashdata('contact_image_error');  } ?>
									</span>
									<img src="<?php echo base_url().'uploads/'.$contact[0]->service_en;?>" style="width:180px;">
								</div>
							</div>
							<script>
								$('#upload_image_icon').click(function(){
									$('#image').trigger('click');
								});
							</script>

							<div class="row">
								<div class="form-group col-xs-6">
									<label for="heading_en">Heading ( English )</label>
									<input type="text" name="heading_en" class="form-control" id="heading_en" value="<?php echo $contact[0]->team1;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="heading_ar">Heading ( Arabic )</label>
									<input type="text" name="heading_ar" class="form-control" id="heading_ar" value="<?php echo $contact[0]->service_ar;?>">
								</div>
							</div>
						 
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content_en">Content ( English )</label>
									<textarea class="form-control" name="content_en" id="editor1" style="display: block; visibility: visible;"><?php echo $contact[0]->content_en;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="content_ar">Content ( Arabic )</label>
									<textarea class="form-control" name="content_ar" id="editor2" style="display: block; visibility: visible;"><?php echo $contact[0]->content_ar;?></textarea>
								</div>
							</div>

							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="address_en">Address ( English )</label>
									<textarea class="form-control" name="address_en" id="address_en" rows=5><?php echo $contact[0]->address;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="address_ar">Address ( Arabic )</label>
									<textarea class="form-control" name="address_ar" id="address_ar" rows=5><?php echo $contact[0]->team2;?></textarea>
								</div>
							</div>

							<div class="row">
								<div class="form-group col-xs-12">
									<label for="google_map">Google Map</label>
									<input type="text" name="google_map" class="form-control" id="google_map" value="<?php echo $contact[0]->google_map;?>">
								</div>
							</div>

							<div class="row">
								<div class="form-group col-xs-6">
									<label for="latitude">Latitude</label>
									<input type="text" name="latitude" class="form-control" id="latitude" value="<?php echo $contact[0]->latitude;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="longitude">Longitude</label>
									<input type="text" name="longitude" class="form-control" id="longitude" value="<?php echo $contact[0]->longitude;?>">
								</div>
							</div>
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>