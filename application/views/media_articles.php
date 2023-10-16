<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Media Articles</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Media Articles</li>
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
                    <h3 class="panel-title">Media Articles</h3>
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0;
                            for ($i = 0; $i < count($media_articles); $i++) { 
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$j; ?></td>
                                    <td><img src="<?php echo base_url().'uploads/Events/mediaPhotos/'.$media_articles[$i]->image; ?>" height="0" width="100" alt="eventImage"></td>                                    
                                    <td><?php echo $media_articles[$i]->title_en; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>event/view_media_articles/<?php echo $media_articles[$i]->wcmaid; ?>"><i class="fa fa-eye"></i></a> 
                                        <?php if (can('edit-media_article')) { ?>
                                        | <a href="<?php echo base_url(); ?>event/edit_media_articles/<?php echo $media_articles[$i]->wcmaid; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        <?php } if (can('delete-media_article')) { ?>
                                        | <a href="<?php echo base_url(); ?>event/delete_media_articles/<?php echo $media_articles[$i]->wcmaid; ?>" onclick="return confirm('Are you sure you want to delete Media Article ?')"><i class="fa fa-trash" style="color:red;"></i></a> 
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
		
