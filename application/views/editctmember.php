	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Core Team Member</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Core Team Member</strong></li> 
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
						<h3 class="panel-title">Core Team Member</h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

		


					<div class="panel-body">

						 <?php //echo form_open('User/add'); ?> 
						 <form name="add"   method="POST" action="<?php echo base_url();?>coreteam/edit/<?php echo $ctmember[0]->id;?>" enctype="multipart/form-data">
						
							
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="emailaddress">Name</label>
									<input type="text" class="form-control" name="name" id="emailaddress"  value="<?php echo $ctmember[0]->name;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="emailaddress">Designation</label>
									<input type="text" class="form-control" name="designation" id="emailaddress" value="<?php echo $ctmember[0]->designation;?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-xs-6">
									<label for="emailaddress">Picture Upload</label>
									<input type="file" class="form-control" name="image" id="emailaddress">
									<input type="hidden" class="form-control" name="image1" value="<?php echo $ctmember[0]->image;?>">
									<img src="<?php echo $ctmember[0]->image;?>" style="width:120px;">
								</div>
							</div>
							
					
							
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</form>
					</div>

				</div>
			</div>
		
		</div>
		<!-- Footer -->
		<footer class="footer-main"> 
			&copy; 2020 <strong>Shamsaha</strong> Designed & Developed by <a target="_blank" href="#/">Say G</a> 
		</footer>	
		<!-- /footer -->
		
	  </div>
	  <!-- /main content -->
	  
  </div>
  <!-- /main container -->
  
</div>
<!-- /page container -->

<!--<script src="<?php echo base_url(); ?>public/js/plugins/metismenu/jquery.metisMenu.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--nouiSlider-->
<script src="<?php echo base_url(); ?>public/js/plugins/nouislider/nouislider.min.js"></script>

<!-- Input Mask-->
<script src="<?php echo base_url(); ?>public/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<!-- Select2-->
<script src="<?php echo base_url(); ?>public/js/plugins/select2/select2.full.min.js"></script>
<!--Bootstrap ColorPicker-->
<script src="<?php echo base_url(); ?>public/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!--Bootstrap DatePicker-->
<script src="<?php echo base_url(); ?>public/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function () {
		

		$('#date-popup').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true
		});

		$('#date-popup2').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true
		});

	
		
	});
</script>
<script src="<?php echo base_url(); ?>public/js/functions.js"></script>

<script type="text/javascript">
	 setTimeout(function() {
            $('#mydivs').hide('fast');
        }, 2000); // in miliseconds (2*1000)
</script>

</body>

</html>
