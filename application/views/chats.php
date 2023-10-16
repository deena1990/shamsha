
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Chats</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li class="active"><strong>Chats</strong></li>  
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
						<h3 class="panel-title">Chat List</h3>
						<ul class="panel-tool-options" style="display: none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
									<tr>
										<th class="text-center">S. No.</th>
										<th class="text-center">Case Id</th>
										<!-- <th>Status</th> -->
										<th class="text-center">Language</th>
										<th class="text-center">Details</th> 
									</tr>
								</thead>
								<tbody class="text-center"> 
									<?php $j=0; for($i=0; $i<count($chats);$i++) { ?>
									<tr>
										<td><?php echo ++$j;?></td>
										<td><?php echo $chats[$i]->case_id ?></td>
										<!-- <td><?php if($chats[$i]->chat_opened == 0){ echo "Pending";}else if($chats[$i]->chat_opened == 1){ echo "Received";}else if($chats[$i]->chat_opened == 2){ echo "Completed";}else if($chats[$i]->chat_opened == 3){ echo "Missed";} ?></td> -->
										<td><?php echo $chats[$i]->language ?></td>
										<td>
											<a href="<?php echo base_url(); ?>logs/view_chat/<?php echo $chats[$i]->case_id;?>"><i class="fa fa-eye"></i></a> 
											<!-- <?php if (can('edit-message')) { ?>
											| <a href="<?php echo base_url(); ?>logs/edit_pending_chat/<?php echo $chats[$i]->case_id;?>"><i class="fa fa-pencil" style="color:green;"></i></a>  -->
											<!-- <?php } if (can('delete-message')) { ?>
											| <a href="<?php echo base_url(); ?>logs/delete_pending_chat/<?php echo $chats[$i]->case_id;?>" onclick="return confirm('Are you sure you want to delete Message ?')"><i class="fa fa-trash" style="color:red;"></i></a>
											<?php } ?> -->
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
		
