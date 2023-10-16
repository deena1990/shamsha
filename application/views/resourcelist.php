<!-- Main content -->
<style>
    div#importFrm {
        margin: 20px 20px 20px 15px;
        padding: 0px 0px 0px 150px;
        top: -30px;
    }
    div.excelSheet {
        margin: 10px;
    }
    div.formSection {
        margin: 35px 0px 0px 35px;
    }
    input#submitBtn {
        margin: 15px 0px 0px 45px;
    }
    .mainDiv {
        border: 2px solid lightgrey;
        border-radius: 5px;
        padding: 10px 0px 5px 22px;
    }.col-md-12.head {
        margin: 0px 0px 15px 0px;
    }
</style>
<div class="main-content">
    <h1 class="page-title">Resource Information</h1>
    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-md-3">
            <ol class="breadcrumb breadcrumb-2">
                <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
                <li class="active">Resources</li>
            </ol>
        </div>
        <div class="col-md-6 text-center" id="importMsg">
            <?php if($this->session->userdata('success_msg')) { ?>
            <span class="alert alert-success"><?php echo $this->session->userdata('success_msg'); ?></span> 
            <?php } $this->session->unset_userdata('success_msg'); 
            if($this->session->userdata('error_msg')) { ?>
            <span class="alert alert-danger"><?php echo $this->session->userdata('error_msg'); ?></span> 
            <?php } $this->session->unset_userdata('error_msg'); ?>
        </div>
        <div class="col-md-3 text-right">
            <div class="head" id="importBtn">
                <a href="javascript:void(0);" class="btn btn-success" id="importButton" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
                <a href="javascript:void(0);" class="btn btn-danger" id="backButton" style="display: none;" onclick="formToggle('importFrm');"><i class="plus"></i> Hide Import</a>
            </div>  
        </div>
    </div>
    
    <div class="row">
    <!-- File upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <div class="mainDiv">
                <div class="excelSheet">
                    <a href="<?php echo base_url(); ?>assets/SampleExcel/SampleExcelResourceData.csv" class="btn btn-primary">Download Sample Excelsheet</a>
                </div>
                <div class="formSection">
                    <form action="<?php echo base_url('members/import'); ?>" method="post" onsubmit="return removeImpMsg();" enctype="multipart/form-data">
                        <input type="file" name="file" class="form-control" style="margin-left: -27px;" required>
                        <input type="submit" class="btn btn-primary" id="submitBtn" name="importSubmit" value="Import">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    function formToggle(ID){
        var element = document.getElementById(ID);
        if(element.style.display === "none"){
            element.style.display = "block";
            document.getElementById('importButton').style.display = "none";
            document.getElementById('backButton').style.display = "inline-block";
        }else{
            element.style.display = "none";
            document.getElementById('importButton').style.display = "inline-block";
            document.getElementById('backButton').style.display = "none";
        }
    }
    setTimeout(() => {
        document.getElementById('importMsg').innerHTML = "";
    }, 8000);
    </script>
    </div>

    <?php if ($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Resource List</h3>
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
                                <th>Location</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0;
                            for ($i = 0; $i < count($resourcelist); $i++) {

                                ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$j; ?></td>
                                    <td><?php echo $resourcelist[$i]->name; ?></td>
                                    <td><?php echo $resourcelist[$i]->location_name; ?></td>
                                    <td><?php echo $resourcelist[$i]->category_name; ?></td>
                                    <td><?php echo $resourcelist[$i]->contact_info1; ?></td>
                                    <td><?php echo $resourcelist[$i]->address_info; ?></td>
                                    <td><?php echo ($resourcelist[$i]->status == "Active") ? "<span class='label label-success'>".$resourcelist[$i]->status."</span>" : "<span class='label label-danger'>".$resourcelist[$i]->status."</span>"; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>resource/view/<?php echo $resourcelist[$i]->wcresid; ?>"><i class="fa fa-eye"></i></a> 
                                        <?php if (can('edit-resource')) { ?>
                                        | <a href="<?php echo base_url(); ?>resource/edit/<?php echo $resourcelist[$i]->wcresid; ?>"><i class="fa fa-pencil" style="color:green;"></i></a> 
                                        <?php } if (can('delete-resource')) { ?>
                                        | <a href="<?php echo base_url(); ?>resource/delete/<?php echo $resourcelist[$i]->wcresid; ?>" onclick="return confirm('are you sure to delete Resource')"><i class="fa fa-trash" style="color:red;"></i></a>
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
		
