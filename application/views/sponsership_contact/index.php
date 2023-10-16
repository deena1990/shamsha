

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Sponserships Contact</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li>Sponserships Contact</li>
    </ol>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading clearfix">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="panel-title">Sponsership Contact List</h3>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <ul class="panel-tool-options" style="display:none;">
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
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Message</th>
                                <th>Date</th>
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
                    "url": "<?php echo base_url('sponsership_contact/getLists/'); ?>",
                    "type": "POST"
                },
                "rowCallback": function (nRow, aData, iDisplayIndex) {
                    var oSettings = this.fnSettings ();
                    $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                    return nRow;
                },


            });
        });
    </script>
