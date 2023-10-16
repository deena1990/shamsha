<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Add Victim Alert</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><strong>Add Victim Alert</strong></li>
    </ol>


    <?php if ($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form name="add" method="POST" action="<?php echo base_url(); ?>victim_alert/add"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="send_to_victim">Send To</label>
                                        <select class="form-control" name="send_to_victim[]" id='send_to_victim' multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="<?= count($victims) ?>">
                                            <?php foreach ($victims as $key => $value) { ?> 
                                                <option value=<?= $value->victim_id ?>><?= $value->victim_id ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('send_to_victim', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="alert_subject">Subject</label>
                                    <input type="text" class="form-control" name="alert_subject" id="alert_subject"
                                           placeholder="Subject">
                                    <?php echo form_error('alert_subject', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="alert_message">Alert Message</label>
                                    <textarea class="form-control" name="alert_message" placeholder="Type a message here..." id="alert_message"></textarea>
                                    <?php echo form_error('alert_message', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
<!-- /main content -->


