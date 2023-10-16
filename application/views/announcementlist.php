

	

	<!-- Main content -->

	<div class="main-content">

		<h1 class="page-title">Announcement Information</h1>

		<!-- Breadcrumb -->

		<ol class="breadcrumb breadcrumb-2"> 

			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 

			<li class="active"><a href="#">Announcement</a></li> 

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

						<h3 class="panel-title">Announcement List</h3>

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

											<th>Subject (English)</th>

											<th>Status</th>

                                            <th>Manage</th>

										</tr>

									</thead>

									<tbody> 

										<?php $j=0; for($i=0; $i<count($announcementlist);$i++) { ?>

										<tr class="gradeX">

											<td><?php echo ++$j;?></td>

											<td><?php echo date('d-m-Y', strtotime( $announcementlist[$i]->date));?></td>

											<td><?php echo $announcementlist[$i]->subject_en;?></td>

											<td><?php echo $announcementlist[$i]->status; ?></td>

                                            <td>
                                                <a href="<?php echo base_url(); ?>announcement/view_announcement/<?php echo $announcementlist[$i]->wcnid; ?>"><i class="fa fa-eye"></i></a> 
												<?php if (can('edit-announcement')) { ?>
												| <a href="<?php echo base_url(); ?>announcement/edit/<?php echo $announcementlist[$i]->wcnid; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
												<?php } if (can('delete-announcement')) { ?>
												| <a href="<?php echo base_url(); ?>announcement/delete/<?php echo $announcementlist[$i]->wcnid; ?>" onclick="return confirm('are you sure to delete Announcement ')"><i class="fa fa-trash" style="color:red;"></i></a>
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



