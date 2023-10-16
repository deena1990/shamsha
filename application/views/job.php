	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Job</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Job</strong></li> 
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
						<h3 class="panel-title">Job</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>Job/add" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group col-xs-4">
									<label for="emailaddress">Start Date</label>
									<div id="date-popup" class="input-group date"> 
											<input type="text" data-format="D, dd MM yyyy" value="<?php echo set_value('jdate') ?>" name="date" class="form-control">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
										</div>
                                    <span style="color: red"><?php echo form_error('jdate');  ?></span>
								</div>
                                <div class="form-group col-xs-4">
                                    <label for="emailaddress">End Date</label>
                                    <div id="date-popup2" class="input-group date">
                                        <input type="text" data-format="D, dd MM yyyy" value="<?php echo set_value('edate') ?>" name="edate" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <span style="color: red"><?php echo form_error('edate');  ?></span>
                                </div>
								<div class="form-group col-xs-4">
									<label for="emailaddress">Job Type</label>
									<select class="form-control" name="type">
										<option value="">Select</option>
										<option value="Internship" <?php echo  set_select('job_type', 'Internship'); ?>>Internship</option>
										<option value="Job" <?php echo  set_select('job_type', 'Job'); ?>>Job</option>
									</select>
                                    <span style="color: red"><?php echo form_error('job_type');  ?></span>
								</div>
							</div>
						
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Title</label>
									<input type="text" class="form-control" value="<?php echo set_value('title') ?>" name="title"  style="     display: block;
    visibility: visible;" />
                                    <span style="color: red"><?php echo form_error('title');  ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Brief Description</label>
									<textarea class="form-control" name="short_desc" id="editor1" style="     display: block;
    visibility: visible;"><?php echo set_value('brief') ?></textarea>
                                    <span style="color: red"><?php echo form_error('brief');  ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-12">
									<label for="emailaddress">Detail Description</label>
									<textarea class="form-control" id="editor2" name="breif_desc"  style="     display: block;
    visibility: visible;"><?php echo set_value('detail') ?></textarea>
                                    <span style="color: red"><?php echo form_error('detail');  ?></span>
								</div>
							</div>
                             <div class="row">
                                 <div class="form-group col-xs-6">
                                     <label for="emailaddress">Status</label>
                                     <select class="form-control" name="status">
                                         <option value="">Select</option>
                                         <option value="Open" <?php echo set_select('status', "Open"); ?>>Open</option>
                                         <option value="Close" <?php echo set_select('status', "Close"); ?>>Close</option>
                                     </select>
                                     <span style="color: red"><?php echo form_error('status');  ?></span>
                                 </div>
                             </div>
						
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>