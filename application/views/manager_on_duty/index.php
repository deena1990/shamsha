

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Manager on Duty Information</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="#">Manager on Duty</a></li>
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
                    <h3 class="panel-title">Manager on Duty List</h3>
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
                                <th>Sno</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0;
                            for ($i = 0; $i < count($manager_list); $i++) { 
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$j; ?></td>
                                    <td><?php echo $manager_list[$i]->name; ?></td>
                                    <td><?php echo $manager_list[$i]->email; ?></td>
                                    <td><?php echo $manager_list[$i]->contact_no; ?></td>
                                    <td><?php echo date('d M Y', strtotime($manager_list[$i]->start_date)) ?></td>
                                    <td><?php echo date('d M Y', strtotime($manager_list[$i]->end_date)) ?></td>
                                    <td><?php echo $manager_list[$i]->status; ?></td>
                                    <td>
                                        <?php if (can('edit-manager_on_duty') && !can('delete-manager_on_duty')) { ?>
                                        <a href="<?php echo base_url(); ?>manager_on_duty/edit/<?php echo $manager_list[$i]->id; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        <?php } if (!can('edit-manager_on_duty') && can('delete-manager_on_duty')) { ?>
                                        <a href="<?php echo base_url(); ?>manager_on_duty/delete/<?php echo $manager_list[$i]->id; ?>" onclick="return confirm('Are you sure you want to delete Manager on Duty?')"><i class="fa fa-trash" style="color:red;"></i></a> 
                                        <?php } if (can('edit-manager_on_duty') && can('delete-manager_on_duty')) { ?>
                                        <a href="<?php echo base_url(); ?>manager_on_duty/edit/<?php echo $manager_list[$i]->id; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        | <a href="<?php echo base_url(); ?>manager_on_duty/delete/<?php echo $manager_list[$i]->id; ?>" onclick="return confirm('Are you sure you want to delete Manager on Duty?')"><i class="fa fa-trash" style="color:red;"></i></a> 
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

    <script>
        $(document).ready(function(){
                var managersDatatables =  $('#managersDatatables').DataTable({
                    // Processing indicator
                    "processing": true,
                    "pageLength": 10,
                    // DataTables server-side processing mode
                    "serverSide": true,
                    // Initial no order.
                    "order": [],
                    // Load data from an Ajax source
                    "ajax": {
                        "url": "<?php echo base_url('manager_on_duty/getLists/'); ?>",
                        "type": "POST"
                    },
                    //Set column definition initialisation properties
                    "columnDefs":[{"targets":7, "data":"id", "render": function(data,type,full,meta)
                        { return '<p class="text-center"><i class="fa fa-eye"></i><?php if(can('edit-manager_on_duty')){ ?> | <a href="<?php echo base_url(); ?>manager_on_duty/edit/'+full[7]+'"><i class="fa fa-pencil" style="color:green;"></i></a><?php } if(can('delete-manager_on_duty')){ ?> | <a href="<?php echo base_url(); ?>manager_on_duty/delete/'+full[7]+'" onclick="return confirm('+"'are you sure to delete volunteer'"+')"><i class="fa fa-trash" style="color:red;"></i></a><?php } ?></p>'
                        }}]

                });

        });
    </script>