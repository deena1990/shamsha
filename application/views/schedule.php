<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Schedule</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Schedule</strong></li>
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
                    <h3 class="panel-title">Schedule</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>


                <div class="panel-body">

                    <?php //echo form_open('User/add'); ?>
                    <form name="add" method="POST" action="<?php echo base_url(); ?>schedule/add"
                          enctype="multipart/form-data">
                        <!--<div class="row">
								<div class="form-group col-xs-4">
									<label for="emailaddress">Date</label>
									<div id="date-popup" class="input-group date"> 
											<input type="text" data-format="D, dd MM yyyy" name="date" class="form-control"> 
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
										</div>
								</div>

								<div class="form-group col-xs-4">
									<label for="emailaddress">Shift Type <span style="color:red">*</span></label>
									<select class="form-control" name="shift_type">
									<?php for ($i = 0; $i < count($shift); $i++) { ?>
										<option value="<?php echo $shift[$i]->wcsid; ?>"><?php echo $shift[$i]->shift_name; ?></option>
									<?php } ?>
									</select>
								</div>

								<div class="form-group col-xs-4">
									<label for="emailaddress">Shift Language <span style="color:red">*</span></label>
									<select class="form-control" name="shift_lang">
									
										<option value="English">English</option>
										<option value="Arabic">Arabic</option>
									</select>
								</div>
							</div>
							
							-->

                        <div class="row">
                            <div class="form-group col-xs-4">
                                <label for="emailaddress">Select Year</label>
                                <select class="form-control" name="year">
                                    <option value="">--Select--</option>
                                    <?php
                                    $year = date('Y');
                                    for ($i = $year; $i <= $year + 10; $i++) {
                                        ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="row"><?php for ($i = 0; $i < count($shift); $i++) { ?>
                                <div class="form-group col-xs-4">
                                <!--<label for="emailaddress">Shift Type <span style="color:red">*</span></label>-->
                                <input type="hidden" class="form=control" readonly
                                       value="<?php echo $shift[$i]->shift_name; ?> - <?php echo $shift[$i]->shift_language; ?>">
                                <input type="hidden" name="shift[]" value="<?php echo $shift[$i]->wcsid; ?>">
                                </div><?php } ?>
                        </div>


                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>

    </div>
    <!-- Footer -->
