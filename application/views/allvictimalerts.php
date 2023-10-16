

	

	<!-- Main content -->

	<div class="main-content">

		<h1 class="page-title">Victim Alerts</h1>

		<!-- Breadcrumb -->

		<ol class="breadcrumb breadcrumb-2"> 

			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 

			<li class="active">Victim Alerts</li> 

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

						<h3 class="panel-title">Victim Alert List</h3>

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

											<th class="text-center">S.No.</th>

											<th class="text-center">Sent By</th>

											<th class="text-center">Sent To</th>

											<th class="text-center">Subject</th>

											<th class="text-center">Message</th>

										</tr>

									</thead>

									<tbody class="text-center"> 

									<?php $j=0;for($i=0;$i<count($allvictimalerts);$i++) { ?>
									<?php for($i=0;$i<count($sent_by_name);$i++) { ?>

										<tr class="gradeX">

											<td><?php echo ++$j; ?></td>

											<td><?php echo $sent_by_name[$i]; ?></td>

											<td><?php echo $allvictimalerts[$i]->victim_id; ?></td>

											<td><?php echo $allvictimalerts[$i]->subject; ?></td>

											<td><?php echo $allvictimalerts[$i]->message; ?></td>

										</tr>

										  <?php }} ?>

									</tbody>

									

								</table>

							</div>

						</div>

					

				</div>

			</div>

		

		</div>



