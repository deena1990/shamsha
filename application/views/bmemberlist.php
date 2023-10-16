
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Board Members</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Board Members</strong></li>  
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
						<h3 class="panel-title">Board Members List</h3>
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
											<th>S no</th>
											<th>Name ( English )</th>
											<th>Designation ( English )</th>
											<th>Manage</th> 
										</tr>
									</thead>
									<tbody> 
										<?php $j=0; for($i=0; $i<count($bmemberlist);$i++) { ?>
										<tr class="gradeX">
											<td><?php echo ++$j;?></td>
											<td><?php echo $bmemberlist[$i]->bname;?></td>
											<td><?php echo $bmemberlist[$i]->designation;?></td>
											<td>
												<a href="<?php echo base_url(); ?>boardmember/view/<?php echo $bmemberlist[$i]->id;?>"><i class="fa fa-eye"></i></a> 
												<?php if (can('edit-board_member')) { ?> 
												| <a href="<?php echo base_url(); ?>boardmember/edit/<?php echo $bmemberlist[$i]->id;?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
												<?php } if (can('delete-board_member')) { ?> 
												| <a href="<?php echo base_url(); ?>boardmember/delete/<?php echo $bmemberlist[$i]->id;?>" onclick="return confirm('Are you sure you want to delete Board Member ?')"><i class="fa fa-trash" style="color:red;"></i></a>
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
		
