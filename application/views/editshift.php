	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Shift</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Shift</strong></li> 
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
						<h3 class="panel-title"> Update Details</h3>
						<ul class="panel-tool-options" style="display: none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>shift/edit/<?php echo $shift[0]->wcsid;?>" enctype="multipart/form-data">
                         <div class="row">
								<div class="form-group col-xs-6">
                                    <label for="emailaddress">Shift Name</label>
                                    <input type="text" class="form-control" name="shift_a_name" value="<?php echo $shift[0]->shift_name;?>">
								</div>
								 <div class="form-group col-xs-6">
                                    <label for="emailaddress">Shift Timing</label>
                                    <input type="text" class="form-control" name="shift_a_time" value="<?php echo $shift[0]->shift_time;?>">
								</div>
							</div>
							<div class="row">
                                    <div class="form-group col-xs-6">
                                    <label for="emailaddress">Shift Image</label>
                                    <input type="file" class="form-control" name="simage">
                                    <input type="hidden" class="form-control" name="simage1" value="<?php echo $shift[0]->image;?>">
                                    <img src="<?php echo $shift[0]->image;?>" style="width:180px; margin-top: 10px">
								</div>
                                <div class="form-group col-xs-6">
                                    <label>Text Color</label><br>
                                    <label class="radio-inline"><input type="radio" name="color" value="dark" <?php echo  $shift[0]->color == "dark" ? "checked" : ""; ?> /> Dark</label>
                                    <label class="radio-inline"><input type="radio" name="color" value="light" <?php echo  $shift[0]->color == "light" ? "checked" : ""; ?> /> Light</label>

                                </div>
                            </div>
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>