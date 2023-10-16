<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Events</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Events</li>
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
                                <th>Date</th>
                                <th>Title</th>
                                <th>Total Registration</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0; for ($i = 0; $i < count($eventlist); $i++) { ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$j; ?></td>
		                            <td><?php echo date('d-m-Y',strtotime($eventlist[$i]->date)); ?></td>                                    
                                    <td><?php echo $eventlist[$i]->title_en; ?></td>
                                    <td><a href="<?php echo base_url(); ?>event/viewregistration/<?php echo $eventlist[$i]->wceid;?>" title="View Registration">View Registration</a></td>
                                    <td><?php echo $eventlist[$i]->status; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>event/view/<?php echo $eventlist[$i]->wceid; ?>"><i class="fa fa-eye"></i></a> 
                                        <?php if (can('edit-event')) { ?>
                                        | <a href="<?php echo base_url(); ?>event/edit/<?php echo $eventlist[$i]->wceid; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        <?php } if (can('delete-event')) { ?>
                                        | <a href="<?php echo base_url(); ?>event/delete/<?php echo $eventlist[$i]->wceid; ?>" onclick="return confirm('Are you sure you want to delete Event ?')"><i class="fa fa-trash" style="color:red;"></i></a>
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
		
