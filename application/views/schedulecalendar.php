
<link href='<?php echo site_url() ?>assets/fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='<?php echo site_url() ?>assets/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
<script src='<?php echo site_url() ?>assets/fullcalendar/packages/core/main.js'></script>
<script src='<?php echo site_url() ?>assets/fullcalendar/packages/interaction/main.js'></script>
<script src='<?php echo site_url() ?>assets/fullcalendar/packages/daygrid/main.js'></script>
<script>
    var getCurDate;
     function calenderView(volunteer = '') {
        var calendarEl = document.getElementById('calendar');
        $('#calendar').html('');
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid' ],
            editable: true,
            selectable: true,
            views: {
                week: {
                    duration: { months : 2 }
                }
            },
            eventLimit: true, // allow "more" link when too many events
            eventRender: function(info, element, monthView) {

            },

            events: {
                url: '<?php echo site_url() ?>schedule/allschedule2',
                extraParams: function() { // a function that returns an object
                    return {
                        dynamic_value: Math.random(),
                        volunteer_id : volunteer
                    };
                }
            },
            dateClick: function(info) {
                getCurDate = info.dateStr;
                loadShift(info.dateStr);
            },
        });

        currDate = calendar.getDate();
        getCurDate = currDate.toISOString();
        console.log(getCurDate);
        loadShift(getCurDate);
        calendar.render();

    };
    $(document).ready(function () {
        calenderView();
    });


</script>
<style>
    .fc-day-grid-container.fc-scroller {
        height: auto!important;
        overflow-y: auto;
    }
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    .redCell{
        background:red!important;
    }
    .greenCell{
        background:white!important;
    }
    .fc-event{
        cursor: pointer;
    }
    .yellowCell{
        background: yellow;
    }
    /*.fc-event-container {display: none;}*/
</style>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign Shift</h4>
            </div>
            <div class="modal-body">
                <div id="modelContent"></div>
            </div>
        </div>

    </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Volunteer</h4>
            </div>
            <div class="modal-body">
                <div id="modelContent2"></div>
            </div>
        </div>

    </div>
</div>
<div class="" style="padding-left:40px; padding-right: 40px">

    <div class="row">
        <div class="col-md-4"  style="padding-top:40px;">
            <div id='calendar'></div>
        </div>
        <div class="col-md-5 shiftList" style="padding-top:40px;">
            <div id="ShiftList"></div>
        </div>
        <div class="col-md-3 voluteerMain">
            <h4>Volunteer List</h4>
            <div class="filterCont">
                <h5><b>Filter :</b></h5>
                <label class="radio-inline">
                    <input type="radio" value="all" class="filterData" name="filteropt" checked>All
                </label>
                <label class="radio-inline">
                    <input type="radio" value="Arabic" class="filterData" name="filteropt">Arabic
                </label>
                <label class="radio-inline">
                    <input type="radio" value="English" class="filterData" name="filteropt">English
                </label>
                <label class="radio-inline">
                    <input type="radio" value="Active" class="filterData" name="filteropt">Active
                </label>
                <label class="radio-inline">
                    <input type="radio" value="Inactive" class="filterData" name="filteropt">Inactive
                </label>
                <label class="radio-inline">
                    <input type="radio" value="On Break" class="filterData" name="filteropt">On Break
                </label>
                <label class="radio-inline">
                    <input type="radio" value="Left" class="filterData" name="filteropt">Left
                </label>
            </div>
            <ul id="volunteerListSchedule" class="volunteerList">


            </ul>
        </div>
    </div>
</div>
<link href="<?php echo site_url(); ?>js/select2/select2.min.css" rel="stylesheet" />
<script src="<?php echo site_url(); ?>js/select2/select2.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        $('.filterData').on('change', function () {
            loadVolunteer();
        })
        $('body').on('click','.volSel', function(){
            calenderView($(this).attr('data-id'))
        });
        $('body').on('click','.profile-view', function(){
            jQuery("#modelContent2").append('<div class="loader"></div>');
            var id = $(this).attr('data-id');
            var url = '<?php echo site_url(); ?>schedule/volunteerdetail?id='+id;
            $('#myModal1').modal('show').find('#modelContent2').load(url,function () {
                jQuery(".loader").remove();
            });
        });
        loadVolunteer();
        $('body').on('click', '.assignStaff', function () {
            var id = $(this).attr('data-id');
            var url = '<?php echo site_url(); ?>schedule/assignvolunteer?id='+id;
            $('#myModal').modal('show').find('#modelContent').load(url,function () {
                $('.select-class').select2();
                $("#assignForm").submit(function (e) {
                    e.preventDefault();
                    var vid = $("#asigVolunteer").val();
                    var url = $(this).attr('action');
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType : "html",
                        data: { 'data' : vid},
                        success: function (res ) {
                            $('#myModal').modal('hide');
                        }
                    });
                })
            });
        })
        $("#myModal").on("hidden.bs.modal", function(){
            $(this).removeData('bs.modal');
            loadShift(getCurDate);
        });
        $("#myModal1").on("hidden.bs.modal", function(){
            $(this).removeData('bs.modal');
        });
    });
    function loadShift(date) {
        jQuery("#ShiftList").append('<div class="loader"></div>');
        var url = '<?php echo site_url(); ?>schedule/calendardetailview?date='+date;
        $.ajax({
            url: url,
            type: "GET",
            success: function ( responseText ) {
                jQuery(".loader").remove();
                $("#ShiftList").html( responseText );
            }
        });
    }
    function loadVolunteer() {
        calenderView();
        var filterData = $("input[class='filterData']:checked").val();
        jQuery("#volunteerListSchedule").append('<div class="loader"></div>');
        console.log(filterData)
        var url = '<?php echo site_url(); ?>schedule/volunteerlist';
        $.ajax({
            url: url,
            type: "GET",
            data : {'filter' : filterData},
            success: function ( responseText ) {
                jQuery(".loader").remove();
                $("#volunteerListSchedule").html( responseText );
            }
        });
    }
    jQuery.event.add(window, "load", resize);
    jQuery.event.add(window, "resize", resize);

    function resize()
    {
        var h = jQuery(window).height();
        jQuery(".voluteerMain").css({"height": h - 60});
    }
</script>

<style>
    .volunteerList{
        padding-left: 0px;
    }
    .volunteerList li:first-child{
        border-top: 1px solid #f3ecec;
    }
    .volunteerList li:last-child{
        border-bottom: none;
    }
    .volunteerList li{
        list-style: none;
        border-bottom: 1px solid #f3ecec;
        padding: 10px;
        cursor: pointer;
    }
    .volunteerList li:hover{
        background: #F5F5F5;
    }
    .voluteerMain {
        position: relative;
        background: #fdfdfd;
        overflow-y: auto;
        padding: 0;
        border-left: 1px solid #dadada;
        border-right: 1px solid #dadada;
    }
    .voluteerMain::-webkit-scrollbar {
        width: 5px;
    }

    .voluteerMain::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .voluteerMain::-webkit-scrollbar-thumb {
        background-color: darkgrey;
        outline: 1px solid slategrey;
    }
    .voluteerMain h4{
        font-size: 20px;
        font-weight: 600;
        margin-left: 10px;
        margin-top: 15px;
    }
    .filterCont{
        padding: 10px;
    }
    .fc td {
        cursor: pointer;
    }
    .loader{
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?php echo site_url(); ?>assets/images/loader.gif')
        50% 50% no-repeat;
    }
    .shiftList{
        position: relative;
    }
</style>