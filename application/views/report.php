

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Schedule Report</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Schedule Report</strong></li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Schedule Report</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="row filterCont">
                        <div class="col-md-12">
                            <form method="post" class="form-inline text-center">
                                <div class="form-group mb-2">
                                    <label for="dateRange">Select Date: </label>
                                    <input class="form-control" name="dateRange" type="text" id="dataRangePicker">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                            </form>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sponserDatatable">
                            <thead>
                            <tr>
                                <th>Volunteer ID</th>
                                <th>Name</th>
                                <th>Total Arabic shift</th>
                                <th>Total English Shift</th>
                                <th>Total Shift</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($report as $data) { ?>
                                    <tr>
                                        <td><?= $data->vounter_id ?></td>
                                        <td><?= $data->vname ?></td>
                                        <td><?= $data->arabic ?></td>
                                        <td><?= $data->english ?></td>
                                        <td><?= $data->arabic +  $data->english ?></td>
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
    .filterCont{
        padding: 20px;
    }
</style>

    <script>
        $(document).ready(function(){
            $('#sponserDatatable').DataTable({
                "order": [[ 1, "asc" ]],
                "pageLength": 50,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo site_url() ?>assets/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url() ?>assets/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>assets/daterangepicker/daterangepicker.css" />
    <script>
        $(function() {
            $('#dataRangePicker').daterangepicker({
                "opens": "center",
                locale: {
                    cancelLabel: 'Clear',
                },
                "alwaysShowCalendars": true,
                "startDate": "<?= $startDate ?>",
                "endDate": "<?= $endDate ?>",
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
        });
    </script>