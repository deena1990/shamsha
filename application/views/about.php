	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">About Us</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>About Us</strong></li> 
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
						<h3 class="panel-title">About Us</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		

					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>about/aupdate/8" enctype="multipart/form-data">
						     

							
						 	<div class="row">
								<div class="form-group col-xs-6">
									<label for="title_en">Title ( English )</label>
									<input type="text" class="form-control" name="title_en" value="<?php echo $about[0]->title_en;?>" id="title_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="title_ar">Title ( Arabic )</label>
									<input type="text" class="form-control" name="title_ar" value="<?php echo $about[0]->title_ar;?>" id="title_ar">
								</div>
							</div>


							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content1_en">Content1 ( English )</label>
									<input type="text" class="form-control" name="content1_en" value="<?php echo $about[0]->content_en;?>" id="content1_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="content1_ar">Content1 ( Arabic )</label>
									<input type="text" class="form-control" name="content1_ar" value="<?php echo $about[0]->content_ar;?>" id="content1_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content2_en">Content2 ( English )</label>
									<input type="text" class="form-control" name="content2_en" value="<?php echo $about[0]->email;?>" id="content2_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="content2_ar">Content2 ( Arabic )</label>
									<input type="text" class="form-control" name="content2_ar" value="<?php echo $about[0]->ar_helpline;?>"id="content2_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content3_en">Content3 ( English )</label>
									<input type="text" class="form-control" name="content3_en" value="<?php echo $about[0]->contact;?>" id="content3_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="content3_ar">Content3 ( Arabic )</label>
									<input type="text" class="form-control" name="content3_ar" value="<?php echo $about[0]->address;?>" id="content3_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="content4_en">Content4 ( English )</label>
									<input type="text" class="form-control" name="content4_en" value="<?php echo $about[0]->en_helpline;?>" id="content4_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="content4_ar">Content4 ( Arabic )</label>
									<input type="text" class="form-control" name="content4_ar" value="<?php echo $about[0]->ab_values_ar;?>" id="content4_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group text-center col-xs-12">
									<label for="image1">Image 1</label><br>
									<input type="file" class="form-control" name="image1" id="image1" style="display: none">
									<input type="hidden" name="previous_image1" value="<?php echo $about[0]->team1;?>">
									<i class="fa fa-camera" id="upload_image1_icon"></i>
									<img src="<?php echo base_url().'uploads/'.$about[0]->team1;?>" width=150 alt="Image">
								</div>
							</div>
							<script>
								$('#upload_image1_icon').click(function(){
									$('#image1').trigger('click');
								});
							</script>

							<div class="row">
								<div class="form-group col-xs-6">
									<label for="name1_en">Name 1 ( English )</label>
									<input type="text" class="form-control" name="name1_en" value="<?php echo $about[0]->team_a_name;?>" id="name1_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="name1_ar">Name 1 ( Arabic )</label>
									<input type="text" class="form-control" name="name1_ar" value="<?php echo $about[0]->longitude;?>" id="name1_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="tag1_en">Tag 1 ( English )</label>
									<input type="text" class="form-control" name="tag1_en" value="<?php echo $about[0]->vol_form_con_en;?>" id="tag1_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="tag1_ar">Tag 1 ( Arabic )</label>
									<input type="text" class="form-control" name="tag1_ar" value="<?php echo $about[0]->twitter;?>" id="tag1_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="post1_en">Post 1 ( English )</label>
									<input type="text" class="form-control" name="post1_en" value="<?php echo $about[0]->team_a_info;?>" id="post1_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="post1_ar">Post 1 ( Arabic )</label>
									<input type="text" class="form-control" name="post1_ar" value="<?php echo $about[0]->google_map;?>" id="post1_ar">
								</div>
							</div>
							
							
							<div class="row" >
								<div class="form-group col-xs-6">
									<label for="about1_en">About 1 (English)</label>
									<textarea class="form-control" name="about1_en" id="editor1" style="display: block; visibility: visible;"><?php echo $about[0]->vol_goo_con_en;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="about1_ar">About 1 (Arabic)</label>
									<textarea class="form-control" name="about1_ar" id="editor2" style="display: block; visibility: visible;"><?php echo $about[0]->website;?></textarea>
								</div>
							</div>
						
							
							<div class="row">
								<div class="form-group text-center col-xs-12">
									<label for="image2">Image 2</label><br>
									<input type="file" class="form-control" name="image2" id="image2" style="display: none">
									<i class="fa fa-camera" id="upload_image2_icon"></i>
									<input type="hidden" name="previous_image2" value="<?php echo $about[0]->team2;?>">
									<img src="<?php echo base_url().'uploads/'.$about[0]->team2;?>" width=100 alt="Image">
								</div>
							</div>
							<script>
								$('#upload_image2_icon').click(function(){
									$('#image2').trigger('click');
								});
							</script>

							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="name2_en">Name 2 ( English )</label>
									<input type="text" class="form-control" name="name2_en" value="<?php echo $about[0]->team_b_name;?>" id="name2_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="name2_ar">Name 2 ( Arabic )</label>
									<input type="text" class="form-control" name="name2_ar" value="<?php echo $about[0]->facebook;?>" id="name2_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="tag2_en">Tag 2 ( English )</label>
									<input type="text" class="form-control" name="tag2_en" value="<?php echo $about[0]->vol_form_con_ar;?>" id="tag2_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="tag2_ar">Tag 2 ( Arabic )</label>
									<input type="text" class="form-control" name="tag2_ar" value="<?php echo $about[0]->linkden;?>" id="tag2_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="post2_en">Post 2 ( English )</label>
									<input type="text" class="form-control" name="post2_en" value="<?php echo $about[0]->team_b_info;?>" id="post2_en">
								</div>
								<div class="form-group col-xs-6">
									<label for="post2_ar">Post 2 ( Arabic )</label>
									<input type="text" class="form-control" name="post2_ar" value="<?php echo $about[0]->latitude;?>" id="post2_ar">
								</div>
							</div>
							
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="about2_en">About 2 (English)</label>
									<textarea class="form-control" name="about2_en" id="editor3" style="display: block; visibility: visible;"><?php echo $about[0]->vol_goo_con_ar;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="about2_ar">About 2 (Arabic)</label>
									<textarea class="form-control" name="about2_ar" id="editor4" style="display: block; visibility: visible;"><?php echo $about[0]->instagram;?></textarea>
								</div>
							</div>
							
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>