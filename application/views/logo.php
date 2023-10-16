	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Logo</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Logo</strong></li> 
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
						<h3 class="panel-title">Logo</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>logo/upload/<?php echo $logo[0]->wc_id;?>" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="emailaddress">Image</label>
									<input type="file" class="form-control" name="logo">
									<input type="hidden" name="logo2" value="<?php echo $logo[0]->site_logo;?>">
								</div>
								<div class="form-group col-xs-6">
									<img src="<?php echo base_url().'uploads/'.$logo[0]->site_logo;?>" style="margin: 10px;background:lightgrey;">
								</div>
							</div>
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>