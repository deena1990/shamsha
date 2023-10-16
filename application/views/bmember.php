	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Board Member</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="<?php echo base_url(); ?>boardmember/list">Board Members</a></li>  
			<li class="active"><strong>Add Board Member</strong></li> 
		</ol>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title">Board Member</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>boardmember/add" enctype="multipart/form-data">
						
							
						 	<div class="row">
								<div class="form-group col-xs-6">
									<label for="name">Name ( English )</label>
									<input type="text" class="form-control" name="name" id="name" required>
								</div>
								<div class="form-group col-xs-6">
									<label for="name_ar">Name ( Arabic )</label>
									<input type="text" class="form-control" name="name_ar" id="name_ar" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="designation">Designation ( English )</label>
									<input type="text" class="form-control" name="designation" id="designation" required>
								</div>
								<div class="form-group col-xs-6">
									<label for="designation_ar">Designation ( Arabic )</label>
									<input type="text" class="form-control" name="designation_ar" id="designation_ar" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="image">Picture Upload</label>
									<input type="file" class="form-control" name="image" id="image" required>
								</div>
							</div>

							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>
	