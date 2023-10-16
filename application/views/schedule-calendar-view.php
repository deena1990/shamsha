
<div class="">
    <h2>Date: <?php echo date("d-m-Y", strtotime($date))?></h2>
</div>
<table id="shiftSchedule">
  <tr>
    <th>Shift Time</th>
    <th>Language</th>
    <th>Volunteer</th>
      <?php if( can('assign-schedule') ) { ?>
    <th>Action</th>
      <?php } ?>
  </tr>
  <?php
    foreach($schedulelist as $list){
  ?>
  <tr>
    <td><?php echo $list->shift_time ?></td>
    <td><?php echo $list->shift_language ?></td>
    <td><?php echo ($list->vname == "") ? "Open Shift" : $list->vname ?></td>
      <?php if( can('assign-schedule') ) { ?>
    <td align="center"><a href="javascript:void(0)" data-id="<?= $list->w_sch_id ?>" class="assignStaff"><?php echo ($list->vname == "") ? "<i class='fa fa-plus'></i>" : "<i class='fa fa-edit'></i>" ?></a> </td>
      <?php } ?>
  </tr>
  <?php
    }
  ?>

</table>

<style>
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
</style>