<div class="">

    <form method="post" id="assignForm" action="<?php echo current_url(). '?' .$_SERVER['QUERY_STRING'];  ?>">
        <div class="form-group">
            <label for="sel1">Select Volunteer:</label>
            <select class="form-control select-class" id="asigVolunteer">
                <option value="">Assign Volunteer</option>
                <?php
                $v_id = $schedule->volunteer_assign;
                foreach ($volunteer as $v){
                    $volunteer_id = $v->vounter_id;
                    $vname = $v->vname;
                    $selected = ($v_id == $volunteer_id) ? "selected" : "";
                    echo "<option value='$volunteer_id'  $selected>$vname</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<style>
    .select-class{
        width: 100%!important;
    }
    table#shiftSchedule {
        border-collapse: collapse;
        width: 100%;
    }

    table#shiftSchedule td, table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table#shiftSchedule tr:nth-child(even){background-color: #f2f2f2;}

    table#shiftSchedule tr:hover {background-color: #ddd;}

    table#shiftSchedule th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #fa518d;
        color: white;
    }
    .select2-container{
        width: 100%!important;
    }
</style>
