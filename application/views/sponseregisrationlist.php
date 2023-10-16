

        <!-- Main content -->
        <div class="main-content">
            <h1 class="page-title">Sponsor Registrations</h1>
            <!-- Breadcrumb -->
            <ol class="breadcrumb breadcrumb-2">
                <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
                <li>Sponsor Registrations</li>
            </ol>

            <?php if($this->session->flashdata('msg')) { ?>

                <div class="alert alert-success" id="mydivs"  role="alert">

                    <?php echo $this->session->flashdata('msg'); ?>

                </div>

            <?php } ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading clearfix">
                            <h3 class="panel-title">Sponsor Registration List</h3>
                            <ul class="panel-tool-options" style="display: none;">
                                <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                                <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                                <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                            </ul>
                        </div> -->

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="sponserDatatable">
                                    <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                        <!--	<th>Manage</th>-->
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

            <script>
                $(document).ready(function(){
                    $('#sponserDatatable').DataTable({
                        // Processing indicator
                        "processing": true,
                        "pageLength": 25,
                        // DataTables server-side processing mode
                        "serverSide": true,
                        // Initial no order.
                        "order": [],
                        // Load data from an Ajax source
                        "ajax": {
                            "url": "<?php echo base_url('sponser_registartion/getLists/'); ?>",
                            "type": "POST"
                        },
                        //Set column definition initialisation properties
                        "columnDefs":[{"targets":8, "data":"wcsbid", "render": function(data,type,full,meta)
                            { console.log(full); return '<p class="text-center"><a href=<?php echo base_url("sponser_registartion/view/"); ?>'+full[8]+'><i class="fa fa-eye"></i></a></p>'
                            }}]

                    });
                });
            </script>