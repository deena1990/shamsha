

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Role Information</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i>Home</a></li>
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
                    <h3 class="panel-title">All Roles</h3>
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
                                <th width="5%">Sl No</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Manage</th>
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
            var dataTables =  $('#sponserDatatable').DataTable({
                // Processing indicator
                "processing": true,
                "pageLength": 10,
                // DataTables server-side processing mode
                "serverSide": true,
                // Initial no order.
                "order": [],
                // Load data from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url('roles/getroles/'); ?>",
                    "type": "POST"
                },
                //Set column definition initialisation properties
                "columnDefs":[{"targets":6, "data":"id", "render": function(data,type,full,meta)
                    { return ' <?php if (can('edit-role') && !can('assign-permission')) { ?> <a href="<?php echo base_url(); ?>roles/edit/'+full[6]+'"><i class="fa fa-pencil" style="color:green;"></i></a> <?php } if (!can('edit-role') && can('assign-permission')) { ?> <a href="<?php echo base_url(); ?>roles/assign/'+full[6]+'"><i class="fa fa-users"></i></a><?php } if (can('edit-role') && can('assign-permission')) { ?> <a href="<?php echo base_url(); ?>roles/edit/'+full[6]+'"><i class="fa fa-pencil" style="color:green;"></i></a> | <a href="<?php echo base_url(); ?>roles/assign/'+full[6]+'"><i class="fa fa-users"></i></a> <?php } ?>'
                    }}]

            });
        });
    </script>
