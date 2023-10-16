
	
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Survivor support tools </h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li> 
			<li><a href="<?php echo base_url(); ?>survivor_tools/">Survivor support tools </a></li>

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
						<h3 class="panel-title">Survivor support tools </h3>
						<ul class="panel-tool-options" style="display:none;"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>

					<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="sponserDatatable">
									<thead>
										<tr>
											<th>Id</th>
											<th>Name</th>
                                            <th class="text-center">Action</th>

										</tr>
									</thead>
									<tbody> 

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
 background-color: #FF0000;
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
   alert('Select atleast one records');
  }
 });

});
</script>

        <script>
            $(document).ready(function(){
               var dataTables =  $('#sponserDatatable').DataTable({
                    // Processing indicator
                    "processing": true,
                    "pageLength": 25,
                    // DataTables server-side processing mode
                    "serverSide": true,
                    // Initial no order.
                    "order": [],
                    // Load data from an Ajax source
                    "ajax": {
                        "url": "<?php echo base_url('survivor_tools/getLists/'); ?>",
                        "type": "POST"
                    },
                   "columnDefs":[{"targets":2, "data":"path", "render": function(data,type,full,meta)
                       { return '<a target="_blank" href="'+full[2]+'"><i class="fa fa-download" style="color:darkgoldenrod;"></i></a> <?php if (can('edit-survivor_tool')) { ?> | <a href="<?php echo base_url(); ?>survivor_tools/edit/'+full[0]+'"><i class="fa fa-pencil" style="color:green;"></i></a> <?php } if (can('delete-survivor_tool')) { ?> | <a href="<?php echo base_url(); ?>survivor_tools/delete/'+full[0]+'"><i class="fa fa-trash" style="color:red;"></i></a><?php } ?>'
                       }}]

                });
            });
        </script>
