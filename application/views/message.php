	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Message</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="<?php echo base_url(); ?>message/list">Messages</a></li>  
			<li class="active"><strong>Add Message</strong></li> 
		</ol>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title">Message</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">
						 <form name="add"   method="POST" action="<?php echo base_url();?>message/add" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="emailaddress">Message (English)</label>
									<textarea class="form-control" name="message_en" id="editor1" style="display: block;visibility: visible;"></textarea>
								</div>
								<div class="form-group col-xs-6">
									<label for="emailaddress">Message (Arabic)</label>
									<textarea class="form-control" name="message_ar" id="editor2" style="display: block;visibility: visible;"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="title">Title</label>
									<select class="form-control" name="title" id="title">
										<?php for($i=0;$i<count($messagetitle);$i++){ ?>
										<option value="<?php echo $messagetitle[$i]->title; ?>"><?php echo $messagetitle[$i]->title; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-xs-6">
									<label for="sel1">Status</label>
									<select class="form-control" name="status">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							</div>
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>
	