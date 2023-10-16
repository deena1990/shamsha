
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Schedule Information On <?php $d = $schedulelist[0]->date;
											echo date("d-M-Y", strtotime($d) );?></h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><a href="#">Shift</a></li> 
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
						<h3 class="panel-title">Schedule Information On <?php echo $schedulelist[0]->date;?></h3>
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
											<th>Shift Type- Time</th>
											<th>Language</th>
											<th>Volunteer Assigned</th>
											<th>Shift Status</th>
										</tr>
									</thead>
									<tbody> 
									<?php $j=0;
     for($i=0; $i<count($schedulelist);$i++) {
?>
										<tr class="gradeX">
											<td><?php echo ++$j;?></td>
											<td><?php  $d = $schedulelist[$i]->date;
											echo date("d-M-Y", strtotime($d) );?></td>
											<td><?php echo $schedulelist[$i]->shift_name;?> - <?php echo $schedulelist[$i]->shift_time;?></td>
											<td><?php echo $schedulelist[$i]->shift_language;?></td>
											<td><?php echo $schedulelist[$i]->vname;?></td>
											<td><?php echo $schedulelist[$i]->schedule_status;?></td>
											<td style="display: none;">
												<a href="<?php echo base_url(); ?>shift/view/<?php echo $schedulelist[$i]->date;?>"><i class="fa fa-eye" style="color:green;"></i></a> 
												<!--<a href="<?php echo base_url(); ?>shift/delete/<?php echo $schedulelist[$i]->w_sch_id;?>" onclick="return confirm('are you sure to delete Schedule')"><i class="fa fa-trash" style="color:red;"></i></a>-->
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
		
