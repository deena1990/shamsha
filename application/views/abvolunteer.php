	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Volunteer CMS</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Volunteer CMS</strong></li> 
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
						<h3 class="panel-title">Volunteer CMS</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		

					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>abvolunteer/update/5" enctype="multipart/form-data">
						    
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Content (English)</label>
									<textarea class="form-control" name="content_en" id="editor1" style="     display: block;
    visibility: visible;"><?php echo $about[0]->content_en;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Content (Arabic)</label>
									<textarea class="form-control" name="content_ar" id="editor2" style="     display: block;
    visibility: visible;"><?php echo $about[0]->content_ar;?></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Form Content (English)</label>
									<textarea class="form-control" name="goo_en" id="editor3" style="     display: block;
    visibility: visible;"><?php echo $about[0]->vol_goo_con_en;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Form Content (Arabic)</label>
									<textarea class="form-control" name="goo_ar" id="editor4" style="     display: block;
    visibility: visible;"><?php echo $about[0]->vol_goo_con_ar;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Contact (English)</label>
									<textarea class="form-control" name="contact_en" id="editor5" style="     display: block;
    visibility: visible;"><?php echo $about[0]->vol_form_con_en;?></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Contact (Arabic)</label>
									<textarea class="form-control" name="contact_ar" id="editor6" style="     display: block;
    visibility: visible;"><?php echo $about[0]->vol_form_con_ar;?></textarea>
								</div>
							</div>
							
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>