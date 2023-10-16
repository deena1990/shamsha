	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Home Screen</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Home Screen</strong></li> 
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
						<h3 class="panel-title">Home Screen</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		

					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add" method="POST" action="<?php echo base_url();?>about/hupdate/1" enctype="multipart/form-data">
						     
						    
							<div class="row">
								<div class="form-group text-center col-xs-12">
									<label for="home_image">Upload Image</label><br>
									<input type="file" class="form-control" name="home_image" id="home_image" style="display: none">
									<i class="fa fa-camera" id="upload_image_icon"></i>
									<span class="text-danger">
										<?php if ($this->session->flashdata('home_image_error')) { echo $this->session->flashdata('home_image_error');  } ?>
									</span>
									<img src="<?php echo base_url();?>assets/images/<?= $about[0]->email ?>" height=200 width=200 alt="Image">
								</div>
							</div>
							<script>
								$('#upload_image_icon').click(function(){
									$('#home_image').trigger('click');
								});
							</script>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="heading1_en">Heading1 ( English )</label>
									<input type="text" class="form-control" name="heading1_en" id="heading1_en" value="<?= $about[0]->title_en ?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="heading1_ar">Heading1 ( Arabic )</label>
									<input type="text" class="form-control" name="heading1_ar" id="heading1_ar" value="<?= $about[0]->title_ar ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="editor1">Content1 ( English )</label>
									<textarea class="form-control" name="content1_en" id="editor1" style="display: block;visibility: visible;"><?php echo $about[0]->content_en;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="editor2">Content1 ( Arabic )</label>
									<textarea class="form-control" name="content1_ar" id="editor2" style="display: block;visibility: visible;"><?php echo $about[0]->content_ar;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="heading2_en">Heading2 (English)</label>
									<input type="text" class="form-control" name="heading2_en" id="heading2_en" value="<?= $about[0]->vision_en ?>">
								</div>
								<div class="form-group col-xs-6">
									<label for="heading2_ar">Heading2 (Arabic)</label>
									<input type="text" class="form-control" name="heading2_ar" id="heading2_ar" value="<?= $about[0]->vision_ar ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="editor3">Content2 (English)</label>
									<textarea class="form-control" name="content2_en" id="editor3" style="display: block;visibility: visible;"><?php echo $about[0]->service_en;?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="editor4">Content2 (Arabic)</label>
									<textarea class="form-control" name="content2_ar" id="editor4" style="display: block;visibility: visible;"><?php echo $about[0]->service_ar;?></textarea>
								</div>
							</div>
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>