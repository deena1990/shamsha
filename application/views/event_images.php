<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Event Images</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Event Images</li>
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
                    <h3 class="panel-title">Event Images</h3>
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
                                <th>Event Name</th>
                                <th>Image</th>
                                <?php if (can('delete-event_image')) { ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0;
                            for ($i = 0; $i < count($event_images); $i++) { 
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$j; ?></td>                                    
                                    <td><?php echo $event_images[$i]['eventName']; ?></td>
                                    <td><img src="<?php echo base_url().'uploads/Events/mediaPhotos/'.$event_images[$i]['image']; ?>" height="0" width="100" alt="eventImage"></td>
                                    <?php if (can('delete-event_image')) { ?>
                                    <td>
                                        <a href="<?php echo base_url(); ?>event/delete_event_image/<?php echo $event_images[$i]['id']; ?>"
                                           onclick="return confirm('Are you sure you want to delete Event Image ?')"><i
                                                    class="fa fa-trash" style="color:red;"></i></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
		
