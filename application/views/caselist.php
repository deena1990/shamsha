
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Cases</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li>Cases</li> 
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
					<div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title">Cases List</h3>
                            </div>
                            <div class="col-md-6">
                                <!-- <a href="<?php echo base_url()?>volunteer/downloadVolunteer" class="btn btn-sm btn-info pull-right">Export in Excel</a> -->
                            </div>
                        </div>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

					<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" id="sponserDatatable">
									<thead class="text-center">
										<tr>
											<!-- <th width="5%"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Delete</button></th> -->
											<th class="text-center">S. No.</th>
											<th class="text-center">Case ID</th>
											<th class="text-center">Status</th>
											<th class="text-center">Details</th>
										</tr>
									</thead>
									<tbody class="text-center"> 
									    <?php $j=0; for($i=0; $i<count($caselist);$i++) { ?>
										<tr class="gradeX">
											<!-- <td><p class="text-center"><input type="checkbox" class="delete_checkbox" value="<?php echo $caselist[$i]['id'];?>"/></p></td> -->
											<td><?php echo ++$j;?></td>
											<td><?php echo $caselist[$i]['case_id'];?></td>
											<td><?php $status = $caselist[$i]['chat_opened']; if($status == 0){ echo "Pending";}else if($status == 1){ echo "Received";}else if($status == 2){ echo "Completed";}else if($status == 3){ echo "Missed";} ?></td>
											<td><a href="<?php echo base_url(); ?>cases/view/<?php echo $caselist[$i]['id'];?>"><i class="fa fa-eye"></i></a> 
										</tr>
										<?php } ?>
									</tbody>
									
								</table>
							</div>
						</div>
					
				</div>
			</div>
		
		</div>
		
		<style>
.removeRow
{
 background-color: #FF0000 !important;
    color:#FFFFFF;
}
</style>
<script>
$(document).ready(function(){
 
 $('.delete_checkbox').click(function(){
  if($(this).is(':checked'))
  {
   $(this).closest('tr').addClass('removeRow');
  }
  else
  {
   $(this).closest('tr').removeClass('removeRow');
  }
 });

 $('#delete_all').click(function(){
  var checkbox = $('.delete_checkbox:checked');
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({
    url:"<?php echo base_url(); ?>multiple_delete/delete_all",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
        dataTables.ajax.reload();
    }
   })
  }
  else
  {
   alert('Select atleast one volunteer');
  }
 });

});
</script>

<script>
    $(document).ready(function(){
        var dataTables =  $('#sponserDatatablesdaasdsad').DataTable({
            // Processing indicator
            "processing": true,
            // "pageLength": 5000000000,
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'All rows' ]
            ],
            buttons: [
                'pageLength',
                // 'copyHtml5',
                'excelHtml5',
                // 'csvHtml5',
                // 'pdfHtml5',
                // 'colvis'
            ],
            // DataTables server-side processing mode
            "serverSide": true,
            // Initial no order.
            "order": [],
            // Load data from an Ajax source
            "ajax": {
                "url": "<?php echo base_url('volunteer/getLists/'); ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties
            "columnDefs":[{"targets":9, "data":"wcsbid", "render": function(data,type,full,meta)
                { return '<p class="text-center"><?php if(can('view-volunteer')){ ?><a href="<?php echo base_url(); ?>volunteer/view/'+full[9]+'"><i class="fa fa-eye"></i></a> | <?php }  if(can('change-password-volunteer')){ ?><a href="<?php echo base_url(); ?>volunteer/cpassword/'+full[9]+'"><i class="fa fa-cog" style="color:orange;"></i></a> | <?php } if(can('edit-volunteer')){ ?><a href="<?php echo base_url(); ?>volunteer/edit/'+full[9]+'"><i class="fa fa-pencil" style="color:green;"></i></a> | <?php } if(can('delete-volunteer')){ ?><a href="<?php echo base_url(); ?>volunteer/delete/'+full[9]+'" onclick="return confirm('+"'are you sure to delete volunteer'"+')"><i class="fa fa-trash" style="color:red;"></i></a><?php } ?></p>'
                }},{"targets":0, "data":"wcsbid", "render": function(data,type,full,meta)
                { return '<p class="text-center"><input type="checkbox" class="delete_checkbox" value="'+full[9]+'" /></p>'
                }}]

        });
    });
</script>
