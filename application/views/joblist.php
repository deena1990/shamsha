
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Job Information</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><a href="#">Job</a></li> 
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
						<h3 class="panel-title">Job List</h3>
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
											<th>Date</th>
											<th>Title</th>
											<th>Total Applicants</th>
											<th>Status</th>
											<th>Manage</th>
										</tr>
									</thead>
									<tbody> 
									<?php $j=0; for($i=0; $i<count($joblist);$i++) { ?>
										<tr class="gradeX">
											<td><?php echo ++$j;?></td>
											<td><?php echo date('d-m-Y',strtotime($joblist[$i]->jdate)); ?></td>
											<td><?php echo $joblist[$i]->title;?></td>
											<td><a href="<?php echo base_url(); ?>job/viewapplicant/<?php echo $joblist[$i]->job_id;?>">View applicants</a></td>
											<td><?php echo $joblist[$i]->status;?></td>
											<td>
                                                <a href="<?php echo base_url(); ?>job/view/<?php echo $joblist[$i]->wcjid;?>"><i class="fa fa-eye"></i></a> 
												<?php if (can('edit-job')) { ?>
												| <a href="<?php echo base_url(); ?>job/edit/<?php echo $joblist[$i]->wcjid;?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
												<?php } if (can('delete-job')) { ?>
												| <a href="<?php echo base_url(); ?>job/delete/<?php echo $joblist[$i]->wcjid;?>" onclick="return confirm('are you sure to delete Job')"><i class="fa fa-trash" style="color:red;"></i></a>
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
		
