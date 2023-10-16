

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Resource Country</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Resource Country</strong></li>
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
                    <h3 class="panel-title">Resource Country</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Name (English)</th>
                                <th>Name (Arabic)</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; foreach ($category_list as $catlist) { ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$i;?></td>
                                    <td><?php echo $catlist->location_name;?></td>
                                    <td><?php echo $catlist->location_name_ar;?></td>
                                    <td><?php echo $catlist->status;?></td>
                                    <td>
                                        <?php if (can('edit-resource_country') && !can('delete-resource_country')) { ?>
                                        <a href="<?php echo base_url(); ?>resource_location/edit/<?php echo $catlist->wcrid;?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        <?php } if (!can('edit-resource_country') && can('delete-resource_country')) { ?>
                                        <a href="<?php echo base_url(); ?>resource_location/delete/<?php echo $catlist->wcrid;?>" onclick="return confirm('are you sure to delete Resource')"><i class="fa fa-trash" style="color:red;"></i></a>
                                        <?php } if (can('edit-resource_country') && can('delete-resource_country')) { ?>
                                        <a href="<?php echo base_url(); ?>resource_location/edit/<?php echo $catlist->wcrid;?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        | <a href="<?php echo base_url(); ?>resource_location/delete/<?php echo $catlist->wcrid;?>" onclick="return confirm('are you sure to delete Resource')"><i class="fa fa-trash" style="color:red;"></i></a>
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

