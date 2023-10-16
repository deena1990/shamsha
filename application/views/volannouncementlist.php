<!-- Main content -->

<div class="main-content">

    <h1 class="page-title">Volunteers Announcement</h1>

    <!-- Breadcrumb -->

    <ol class="breadcrumb breadcrumb-2">

        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>

        <li>Volunteers Announcement</li>

    </ol>



    <?php if($this->session->flashdata('msg')) { ?>



    <div class="alert alert-success" id="mydivs" role="alert">



        <?php echo $this->session->flashdata('msg'); ?>



    </div>



    <?php } ?>

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">

                <!-- <div class="panel-heading clearfix">

						<h3 class="panel-title">Volunteers Announcement</h3>

						<ul class="panel-tool-options" style="display: none;"> 

							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>

							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>

							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>

						</ul>

					</div> -->



                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                                <tr>

                                    <th>Sno</th>

                                    <th>Volunteer Name</th>

                                    <th>Date</th>

                                    <th>Subject (English)</th>

                                    <th>Status</th>

                                    <th>Manage</th>

                                    <?php if($role_name == "admin" || $role_name == "super-admin") { ?>

                                    <th>Action</th>

                                    <?php } ?>

                                </tr>

                            </thead>
                            <tbody>

                                <?php $j=0;

                                    for($i=0; $i<count($announcementlist);$i++) {
                                    for($i=0; $i<count($vol_names_entries);$i++) {

                                ?>

                                <tr class="gradeX">

                                    <td><?php echo ++$j;?></td>

                                    <td><?php echo $vol_names_entries[$i];?></td>

                                    <td><?php echo date('d-m-Y', strtotime( $announcementlist[$i]->date));?></td>

                                    <td><?php echo $announcementlist[$i]->subject_en;?></td>

                                    <td>
                                        <?php if ($announcementlist[$i]->status == "Inactive"){ echo "Pending"; }else { echo $announcementlist[$i]->status; }?>
                                    </td>

                                    <?php if ($announcementlist[$i]->status == "Inactive"){ ?>

                                    <td>
                                        <a href="<?php echo base_url(); ?>announcement/view_vol_announce/<?php echo $announcementlist[$i]->wcnvid; ?>"><i class="fa fa-eye" style="color:#434343;"></i></a> 
                                        <?php if (can('edit-volunteer_announcement')) { ?>
                                        | <a href="<?php echo base_url(); ?>announcement/edit_vol_announce/<?php echo $announcementlist[$i]->wcnvid; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        <?php } if (can('delete-volunteer_announcement')) { ?>
                                        | <a href="<?php echo base_url(); ?>announcement/delete/<?php echo $announcementlist[$i]->wcnvid; ?>" onclick="return confirm('are you sure to delete Announcement ')"><i class="fa fa-trash" style="color:red;"></i></a>
                                        <?php } ?>
                                    </td>

                                    <?php }else{?>

                                    <td>
                                        <a
                                            href="<?php echo base_url(); ?>announcement/view_vol_announce/<?php echo $announcementlist[$i]->wcnvid; ?>"><i
                                                class="fa fa-eye" style="color:#434343;"></i></a>
                                    </td>
                                    <?php }?>

                                    <?php if($role_name == "admin" || $role_name == "super-admin") { ?>

                                    <td>
                                        <?php if ($announcementlist[$i]->status == "Active"){ echo "Approved"; }else{ ?>
                                        <a class="btn btn-primary"
                                            href="<?php echo base_url(); ?>announcement/approve_vol_announce/<?php echo $announcementlist[$i]->wcnvid; ?>"
                                            onclick="return confirm('are you sure to approve this Announcement ?')">Approve</a>
                                        <?php }?>

                                    </td>

                                    <?php } ?>

                                </tr>

                                <?php } }?>

                            </tbody>



                        </table>

                    </div>

                </div>



            </div>

        </div>



    </div>