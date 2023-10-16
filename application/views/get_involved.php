	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Get Involved</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Get Involved</strong></li> 
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
						<h3 class="panel-title">Get Involved</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		

					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>get_involved/update/3" enctype="multipart/form-data">
						     
						 	<div class="row">
								<div class="form-group col-xs-6">
									<label for="title_en">Title ( English )</label>
									<input type="text" name="title_en" class="form-control" id="title_en" value="<?php echo $about[0]->title_en;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="title_ar">Title ( Arabic )</label>
									<input type="text" name="title_ar" class="form-control" id="title_ar" value="<?php echo $about[0]->title_ar;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="heading_en">Heading ( English )</label>
									<input type="text" name="heading_en" class="form-control" id="heading_en" value="<?php echo $about[0]->content_en;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="heading_ar">Heading ( Arabic )</label>
									<input type="text" name="heading_ar" class="form-control" id="heading_ar" value="<?php echo $about[0]->content_ar;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content1_en">Content1 (English)</label>
									<textarea class="form-control" name="content1_en" id="editor1"><?php echo $about[0]->contact;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="content1_ar">Content1 (Arabic)</label>
									<textarea class="form-control" name="content1_ar" id="editor2"><?php echo $about[0]->linkden;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group text-center col-xs-12">
									<label>Image</label><br>
									<input type="file" class="form-control" name="image" id="image" style="display: none">
									<i class="fa fa-camera" id="upload_image_icon"></i>
									<input type="hidden" name="previous_image" value="<?php echo $about[0]->en_helpline;?>">
									<a href="<?php echo base_url().'uploads/'.$about[0]->en_helpline;?>" target="_blank"><img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src="<?php echo base_url().'uploads/'.$about[0]->en_helpline;?>" style="width:180px;"></a>
								</div>
							</div>
							<script>
								$('#upload_image_icon').click(function(){
									$('#image').trigger('click');
								});
							</script>
							<script>
								function bigImg(x) {
								x.style.width = "800px";
								}

								function normalImg(x) {
								x.style.width = "180px";
								}
							</script>
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content2_en">Content2 ( English )</label>
									<textarea class="form-control" name="content2_en" id="editor3"><?php echo $about[0]->google_map;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="content2_ar">Content2 ( Arabic )</label>
									<textarea class="form-control" name="content2_ar" id="editor4"><?php echo $about[0]->website;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content3_en">Content3 ( English )</label>
									<textarea class="form-control" name="content3_en"><?php echo $about[0]->address;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="content3_ar">Content3 ( Arabic )</label>
									<textarea class="form-control" name="content3_ar"><?php echo $about[0]->instagram;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="act_title_en">Action Title ( English )</label>
									<input type="text" name="act_title_en" class="form-control" id="act_title_en" value="<?php echo $about[0]->ar_helpline;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="act_title_ar">Action Title ( Arabic )</label>
									<input type="text" name="act_title_ar" class="form-control" id="act_title_ar" value="<?php echo $about[0]->vision_en;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="act_content_en">Action Content (English)</label>
									<textarea class="form-control" name="act_content_en"><?php echo $about[0]->latitude;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="act_content_ar">Action Content (Arabic)</label>
									<textarea class="form-control" name="act_content_ar"><?php echo $about[0]->vision_ar;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="vol_title_en">Volunteer Title ( English )</label>
									<input type="text" name="vol_title_en" class="form-control" id="vol_title_en" value="<?php echo $about[0]->email;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="vol_title_ar">Volunteer Title ( Arabic )</label>
									<input type="text" name="vol_title_ar" class="form-control" id="vol_title_ar" value="<?php echo $about[0]->ab_values_en;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="vol_content_en">Volunteer Content (English)</label>
									<textarea class="form-control" name="vol_content_en"><?php echo $about[0]->longitude;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="vol_content_ar">Volunteer Content (Arabic)</label>
									<textarea class="form-control" name="vol_content_ar"><?php echo $about[0]->ab_values_ar;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="gift_title_en">Gift Title ( English )</label>
									<input type="text" name="gift_title_en" id="gift_title_en" class="form-control" value="<?php echo $about[0]->facebook;?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="gift_title_ar">Gift Title ( Arabic )</label>
									<input type="text" name="gift_title_ar" id="gift_title_ar" class="form-control" value="<?php echo $about[0]->service_en;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="gift_content_en">Gift Content (English)</label>
									<textarea class="form-control" name="gift_content_en"><?php echo $about[0]->twitter;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="gift_content_ar">Gift Content (Arabic)</label>
									<textarea class="form-control" name="gift_content_ar"><?php echo $about[0]->service_ar;?></textarea>
								</div>
							</div>
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>