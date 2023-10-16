
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Advocacy Information</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><a href="#">Advocacy</a></li> 
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
						<h3 class="panel-title">Advocacy List</h3>
						<ul class="panel-tool-options" style="display: none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

					<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th>Sno</th>
											<th>Email</th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Manage</th> 
										</tr>
									</thead>
									<tbody> 
										<?php $j=0; for($i=0; $i<count($advocacylist);$i++) { ?>
										<tr class="gradeX">
											<td><?php echo ++$j;?></td>
											<td><?php echo $advocacylist[$i]->email_id;?></td>
											<td><?php echo $advocacylist[$i]->fullname;?></td>
											<td><?php echo $advocacylist[$i]->mobile;?></td>
											<td>
												<a href="<?php echo base_url(); ?>advocacy/view/<?php echo $advocacylist[$i]->id;?>"><i class="fa fa-eye" ></i></a> 
												<?php if (can('edit-advocacy_applicant')) { ?>
												| <a href="<?php echo base_url(); ?>advocacy/edit/<?php echo $advocacylist[$i]->id;?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
												<?php } if (can('delete-advocacy_applicant')) { ?>
												| <a href="<?php echo base_url(); ?>advocacy/delete/<?php echo $advocacylist[$i]->id;?>" onclick="return confirm('are you sure to delete Record')"><i class="fa fa-trash" style="color:red;"></i></a>
										  		<?php } ?>
											</td> 
										</tr>
										<?php } ?>
									</tbody>
									
								</table>
							</div>
						</div>
					
				</div>
			</div>
		
		</div>
		
