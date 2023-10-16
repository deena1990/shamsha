<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Event Registration</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url().'event/allevent/'; ?>">Registration List</a></li>
    </ol>

    <?php if ($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Event List</h3>
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
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Registered On</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0;
                            for ($i = 0; $i < count($reglist); $i++) {
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$j; ?></td>
                                    <td><?php echo $reglist[$i]->name; ?></td>
                                    <td><?php echo $reglist[$i]->email; ?></td>
                                    <td><?php echo $reglist[$i]->phone; ?></td>
                                    <td><?php echo $reglist[$i]->address; ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($reglist[$i]->created_at)); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

