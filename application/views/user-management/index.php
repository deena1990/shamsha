

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">User Information</h1>
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
                    <h3 class="panel-title">User List</h3>
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
                                <th width="5%">S. No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
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
                    "url": "<?php echo base_url('usermanagement/getusers/'); ?>",
                    "type": "POST"
                },
                //Set column definition initialisation properties
                "columnDefs":[{"targets":7, "data":"id", "render": function(data,type,full,meta)
                    { return '<?php if (can('edit-user') && !can('delete-user')) { ?> <a href="<?php echo base_url(); ?>usermanagement/edit/'+full[7]+'"><i class="fa fa-pencil" style="color:green;"></i></a> <?php } if (!can('edit-user') && can('delete-user')) { ?> <a href="<?php echo base_url(); ?>usermanagement/delete/'+full[7]+'" onclick="return confirm('+"'are you sure to delete user'"+')"><i class="fa fa-trash" style="color:red;"></i></a><?php } if (can('edit-user') && can('delete-user')) { ?> <a href="<?php echo base_url(); ?>usermanagement/edit/'+full[7]+'"><i class="fa fa-pencil" style="color:green;"></i></a> | <a href="<?php echo base_url(); ?>usermanagement/delete/'+full[7]+'" onclick="return confirm('+"'are you sure to delete user'"+')"><i class="fa fa-trash" style="color:red;"></i></a>  <?php } ?>'
                    }}]

            });
        });
    </script>
