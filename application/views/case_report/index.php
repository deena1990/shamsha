
<style>
    .placehoderColor::placeholder{
        color:red;
    }
</style>
<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Case Reports</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><strong>Case Reports</strong></li>
    </ol>

    <?php if($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success" id="mydivs"  role="alert">
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger" id="mydivs"  role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <div class="alert alert-success" id="status_msg" style="display: none;" role="alert"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Case Reports</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sponserDatatable">
                            <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Advocate Name</th>
                                <th class="text-center">Client Name</th>
                                <th class="text-center">Client Number</th>
                                <th class="text-center">Client Country</th>
                                <th class="text-center">Case ID</th>
                                <th class="text-center">Service List</th>
                                <th class="text-center">In Person Support</th>
                                <th class="text-center">On going casework support</th>
                                <th class="text-center">Case Status</th>
                                <th class="text-center">Casework at sight</th>
                                <th class="text-center">Case Details</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Service List Additional Questions</h4>
                </div>
                <input type="hidden" id="idformodel1">
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="questionLabel"> What type of service are they interested in? <span class="text-danger">*</span> </label>
                            <input type="text" name="what_service_they_interested" id="what_service_they_interested" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What were the circumstances of their request? <span class="text-danger">*</span> </label>
                            <input type="text" name="what_were_circumstances_of_their_request" id="what_were_circumstances_of_their_request" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="get_data_model_service_list();">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">In Person Support Additional Questions</h4>
                </div>
                <input type="hidden" id="idformodel2">
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="questionLabel"> Did you communicate this immediately to the case work team in Bahrain? <span
                                        class="text-danger">*</span></label>
                            <select name="caseWorkTeam" class="form-control" id="caseWorkTeam">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> Did you explain the process (including working hours) to the caller - indicating that the casework team would call her back within 30-60 minutes? <span
                                        class="text-danger">*</span></label>
                            <select name="callback3060min" class="form-control" id="callback3060min">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> What specifically is the caller requesting? <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="callerRequest" id="callerRequest">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="get_data_model_inPerson_support();">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">On Going Casework Support Additional Questions</h4>
                </div>
                <input type="hidden" id="idformodel3">
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="questionLabel"> Did you explain the process (including working hour) to the caller - indicating that the casework team would call her back within 3 days ? <span
                                        class="text-danger">*</span></label>
                            <select name="callback3days" class="form-control" id="callback3days">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="questionLabel"> With what issues is she requesting support ? <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="whatIssueReqSupprot" id="whatIssueReqSupprot">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="get_data_model_onGoing_caseworkSupport();">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var dataTables =  $('#sponserDatatable').DataTable({
                
                // Processing indicator
                "processing": true,
                "bSort": false,    // Deena
                "pageLength": 25,
                dom: 'Bfrtip',
                buttons: [
                    // 'copyHtml5',
                    'excelHtml5',
                    // 'csvHtml5',
                    // 'pdfHtml5'
                ],
                // DataTables server-side processing mode
                "serverSide": true,
                // Initial no order.
                "order": [],
                // Load data from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url('case_report/getLists/'); ?>",
                    "type": "POST"
                },
                //Set column definition initialisation properties
                "columnDefs":[{"targets":11, "data":"id", "render": function(data,type,full,meta)
                    { return '<p class="text-center"><?php if(can('view-case_report')){ ?><a href="<?php echo base_url(); ?>case_report/view/'+full[11]+'"><i class="fa fa-eye"></i></a><?php } ?></p>'
                    }},
                
                    {"targets":6, "data":"form_name", "render": function(data,type,full,meta)
                    {   var optVal = full[6]; 
                        if(optVal == "Yes"){ 
                            return '<select class="text-center form-control optionValue_service_list" title="Yes" onchange="return get_data_service_list('+full[11]+');"><option selected value="Yes">Y</option><option value="No">N</option></select>'
                        }else{
                            return '<select class="text-center form-control optionValue_service_list" title="No" onchange="return get_data_service_list('+full[11]+');"><option value="Yes">Y</option><option selected value="No">N</option></select>'
                        }
                    }},
                
                    {"targets":7, "data":"form_name", "render": function(data,type,full,meta)
                    {   var optVal = full[7]; 
                        if(optVal == "Yes"){ 
                            return '<select class="text-center form-control optionValue_inPerson_support" title="Yes" onchange="return get_data_inPerson_support('+full[11]+');"><option selected value="Yes">Y</option><option value="No">N</option></select>'
                        }else{
                            return '<select class="text-center form-control optionValue_inPerson_support" title="No" onchange="return get_data_inPerson_support('+full[11]+');"><option value="Yes">Y</option><option selected value="No">N</option></select>'
                        }
                    }},
                
                    {"targets":8, "data":"form_name", "render": function(data,type,full,meta)
                    {   var optVal = full[8]; 
                        if(optVal == "Yes"){ 
                            return '<select class="text-center form-control optionValue_onGoing_caseworkSupport" title="Yes" onchange="return get_data_onGoing_caseworkSupport('+full[11]+');"><option selected value="Yes">Y</option><option value="No">N</option></select>'
                        }else{
                            return '<select class="text-center form-control optionValue_onGoing_caseworkSupport" title="No" onchange="return get_data_onGoing_caseworkSupport('+full[11]+');"><option value="Yes">Y</option><option selected value="No">N</option></select>'
                        }
                    }},
                
                    {"targets":9, "data":"form_name", "render": function(data,type,full,meta)
                    {   var optVal = full[9]; 
                        if(optVal == "1"){ 
                            return '<select class="text-center form-control optionValue_case_status" title="Transferred" onchange="return get_data_case_status('+full[11]+');"><option selected value="1">Transferred</option><option value="2">Closed</option></select>'
                        }else{
                            return '<select class="text-center form-control optionValue_case_status" title="Closed" onchange="return get_data_case_status('+full[11]+');"><option value="1">Transferred</option><option selected value="2">Closed</option></select>'
                        }
                    }},
                
                    {"targets":10, "data":"form_name", "render": function(data,type,full,meta)
                    { return '<input type="text" name="caseworkAtSight" class="text-center form-control caseworkAtSight'+full[11]+'" value="'+full[10]+'" style="width: 100px"><input type="hidden" name="id" value="'+full[11]+'"><input type="hidden" name="post_type" value="cwas"><button class="btn btn-primary" onclick="validation('+full[11]+');">Update</button>'
                    }},
                ]

            });
        });

function validation(id){
    var caseworkAtSight = $(".caseworkAtSight"+id).val();
    if(caseworkAtSight == ""){
        $(".caseworkAtSight"+id).css('border','2px solid red');
        return false;
    }else{
        $(".caseworkAtSight"+id).css('border','');
        $.ajax({
            type : 'post',
            url : '<?php echo base_url('case_report/update_case_work_at_sight_post/'); ?>',
            data : {id:id,caseworkAtSight:caseworkAtSight},
            // dataType: 'json',
            success:function(data){
                if(data == "done"){
                    document.getElementById('status_msg').style.display = "block";
                    document.getElementById('status_msg').innerHTML = "Casework At Sight updated successfully !!";
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
                // console.log(data)
            }
        });
    }
}

function get_data_service_list(id){
    // alert(id);
    if(confirm("Are you sure you want to update service list option ?")){
        var opval = $('.optionValue_service_list').val();
        // alert(opval);
        if(opval=="Yes"){
            $('#idformodel1').val(id);
            $('#myModal1').modal("show");
        }else{
            $.ajax({
                type : 'post',
                url : '<?php echo base_url('case_report/update_service_list_post/'); ?>',
                data : {id:id},
                dataType: 'json',
                success:function(data){
                    // alert(data.status);
                    if(data.status == "success"){
                        // alert("Service List option updated successfully !!");
                        document.getElementById('status_msg').style.display = "block";
                        document.getElementById('status_msg').innerHTML = "Service List option updated successfully !!";
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
    }else{
        location.reload();
        return false;
    }
}

function get_data_model_service_list(){
    var id = $('#idformodel1').val();
    var what_service_they_interested = $('#what_service_they_interested').val();
    var what_were_circumstances_of_their_request = $('#what_were_circumstances_of_their_request').val();
    if (what_service_they_interested == ""){
        $('#what_service_they_interested').attr('placeholder','Please enter your answer here...');
        $('#what_service_they_interested').addClass('placehoderColor');
        return false;
    }else if (what_were_circumstances_of_their_request == ""){
        $('#what_were_circumstances_of_their_request').attr('placeholder','Please enter your answer here...');
        $('#what_were_circumstances_of_their_request').addClass('placehoderColor');
        return false;
    }else{
        $('#what_service_they_interested').attr('placeholder','');
        $('#what_service_they_interested').removeClass('placehoderColor');
        $('#what_were_circumstances_of_their_request').attr('placeholder','');
        $('#what_were_circumstances_of_their_request').removeClass('placehoderColor');
        $.ajax({
            type : 'post',
            url : '<?php echo base_url('case_report/update_service_list_post/'); ?>',
            data : {id:id,what_service_they_interested:what_service_they_interested,what_were_circumstances_of_their_request:what_were_circumstances_of_their_request},
            dataType: 'json',
            success:function(data){
                // alert(data.status);
                if(data.status == "success"){
                    // alert("Service List option updated successfully !!");
                    $('#myModal1').modal('hide');
                    document.getElementById('status_msg').style.display = "block";
                    document.getElementById('status_msg').innerHTML = "Service List option updated successfully !!";
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                }else{
                    alert(data.msg);
                }
            }
        });
    }
}

function get_data_inPerson_support(id){
    // alert(id);
    if(confirm("Are you sure you want to update In Person support option ?")){
        var opval = $('.optionValue_inPerson_support').val();
        // alert(opval);
        if(opval=="Yes"){
            $('#idformodel2').val(id);
            $('#myModal2').modal("show");
        }else{
            $.ajax({
                type : 'post',
                url : '<?php echo base_url('case_report/update_inPerson_support_post/'); ?>',
                data : {id:id},
                dataType: 'json',
                success:function(data){
                    // alert(data.status);
                    if(data.status == "success"){
                        // alert("Service List option updated successfully !!");
                        document.getElementById('status_msg').style.display = "block";
                        document.getElementById('status_msg').innerHTML = "In Person Support option updated successfully !!";
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
    }else{
        location.reload();
        return false;
    }
}

function get_data_onGoing_caseworkSupport(id){
    // alert(id);
    if(confirm("Are you sure you want to update On Going Casework Support option ?")){
        var opval = $('.optionValue_onGoing_caseworkSupport').val();
        // alert(opval);
        if(opval=="Yes"){
            $('#idformodel3').val(id);
            $('#myModal3').modal("show");
        }else{
            $.ajax({
                type : 'post',
                url : '<?php echo base_url('case_report/update_onGoing_caseworkSupport_post/'); ?>',
                data : {id:id},
                dataType: 'json',
                success:function(data){
                    // alert(data.status);
                    if(data.status == "success"){
                        // alert("On Going Casework Support option updated successfully !!");
                        document.getElementById('status_msg').style.display = "block";
                        document.getElementById('status_msg').innerHTML = "On Going Casework Support option updated successfully !!";
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
    }else{
        location.reload();
        return false;
    }
}

function get_data_case_status(id){
    // alert(id);
    if(confirm("Are you sure you want to update case status ?")){
        var opval = $('.optionValue_case_status').val();
        // alert(opval);
        $.ajax({
            type : 'post',
            url : '<?php echo base_url('case_report/update_case_status_post/'); ?>',
            data : {id:id, opval:opval},
            dataType: 'json',
            success:function(data){
                // alert(data.status);
                // console.log(data);
                if(data.status == "success"){
                    // alert("Case status updated successfully !!");
                    document.getElementById('status_msg').style.display = "block";
                    document.getElementById('status_msg').innerHTML = "Case status updated successfully !!";
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }else{
                    alert(data.msg);
                }
            }
        });
    }else{
        location.reload();
        return false;
    }
}

function get_data_model_inPerson_support(){
    var id = $('#idformodel2').val();
    var caseWorkTeam = $('#caseWorkTeam').val();
    var callback3060min = $('#callback3060min').val();
    var callerRequest = $('#callerRequest').val();
    if (callerRequest == ""){
        $('#callerRequest').attr('placeholder','Please enter your answer here...');
        $('#callerRequest').addClass('placehoderColor');
        return false;
    }else{
        $('#callerRequest').attr('placeholder','');
        $('#callerRequest').removeClass('placehoderColor');
        // alert(id);
        // alert(caseWorkTeam);
        // alert(callback3060min);
        // alert(callerRequest); return false;

        $.ajax({
            type : 'post',
            url : '<?php echo base_url('case_report/update_inPerson_support_post/'); ?>',
            data : {id:id,caseWorkTeam:caseWorkTeam,callback3060min:callback3060min,callerRequest:callerRequest},
            dataType: 'json',
            success:function(data){
                // alert(data.status);
                if(data.status == "success"){
                    // alert("Service List option updated successfully !!");
                    $('#myModal2').modal('hide');
                    document.getElementById('status_msg').style.display = "block";
                    document.getElementById('status_msg').innerHTML = "In Person Support option updated successfully !!";
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                }else{
                    alert(data.msg);
                }
            }
        });
    }
}

function get_data_model_onGoing_caseworkSupport(){
    var id = $('#idformodel3').val();
    var callback3days = $('#callback3days').val();
    var whatIssueReqSupprot = $('#whatIssueReqSupprot').val();
    if (whatIssueReqSupprot == ""){
        $('#whatIssueReqSupprot').attr('placeholder','Please enter your answer here...');
        $('#whatIssueReqSupprot').addClass('placehoderColor');
        return false;
    }else{
        $('#whatIssueReqSupprot').attr('placeholder','');
        $('#whatIssueReqSupprot').removeClass('placehoderColor');
        // alert(id);
        // alert(callback3days);
        // alert(whatIssueReqSupprot); return false;

        $.ajax({
            type : 'post',
            url : '<?php echo base_url('case_report/update_onGoing_caseworkSupport_post/'); ?>',
            data : {id:id,callback3days:callback3days,whatIssueReqSupprot:whatIssueReqSupprot},
            dataType: 'json',
            success:function(data){
                // alert(data.status);
                if(data.status == "success"){
                    // alert("On Going Casework Support option updated successfully !!");
                    $('#myModal3').modal('hide');
                    document.getElementById('status_msg').style.display = "block";
                    document.getElementById('status_msg').innerHTML = "On Going Casework Support option updated successfully !!";
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                }else{
                    alert(data.msg);
                }
            }
        });
    }
}
</script>