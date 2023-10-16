<table>


<?php
$con = mysqli_connect("localhost","saygaug_wcciapp","*OvYMBcWrW1u","saygaug_wcci_application");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  $sql = mysqli_query($con, "select * from wc_resources where res_loc_id =2");
  $counter =0 ;
  while($row = mysqli_fetch_array($sql)){ ?>
  
  <?php $lc = $row['res_loc_id'];
  $cc = $row['res_res_cat_id'];
$sql1 = mysqli_query($con, "SELECT * FROM `wc_resource_locations` where wcrid ='$lc'");
  $row1 = mysqli_fetch_array($sql1);
  $sql2 = mysqli_query($con, "SELECT * FROM `wc_resource_category` where wcrcid ='$cc'");
  $row2 = mysqli_fetch_array($sql2);
?>
 
 
<?php
               // foreach ($row as $row2){
$desc=$row['content'];
$word="Timing";
if(strpos($desc, $word) !== false){
    $temparray=explode("\n",$desc);
$temparray[0];
$temparray[1];
$temparray[2];
if (array_key_exists(3,$temparray))
    { $contact = $temparray[3];
}else {
    $contact ="";
}


if (array_key_exists(4,$temparray))
    {
    $web = $temparray[4];
}else {
    $web ="";
}  ?>



<tr>
      <td><?php //echo ++$counter; ?></td>
      <td> <?php echo $row['res_loc_id']; ?></td>
      <td><?php echo $row1['location_name']; ?></td>
      <td> <?php echo $row['res_res_cat_id']; ?></td>
      <td> <?php echo $row2['category_name']; ?></td>
      <td><?php echo $temparray[0]; ?></td>
      <td><?php echo $temparray[1]; ?></td>
      <td><?php echo str_replace("Tel:","",$temparray[2]); ?></td>
      <td><?php echo str_replace("Tel:","",$temparray[3]); ?></td>
      <td><?php echo str_replace("Contact:","",$temparray[4]); ?></td>
      <td><?php echo str_replace("Website:","",$temparray[5]); ?></td>
      
     </tr> 
     
      
  <?php
    
} else{
   
$temparray=explode("\n",$desc);
$temparray[0];
$temparray[1];
$temparray[2];
if (array_key_exists(3,$temparray))
    { $contact = $temparray[3];
}else {
    $contact ="";
}


if (array_key_exists(4,$temparray))
    {
    $web = $temparray[4];
}else {
    $web ="";
}  ?>

<tr>
      <td><?php //echo ++$counter; ?></td>
      <td> <?php echo $row['res_loc_id']; ?></td>
      <td> <?php echo $row1['location_name']; ?></td>
      <td> <?php echo $row['res_res_cat_id']; ?></td>
      <td> <?php echo $row2['category_name']; ?></td>
      <td><?php echo $temparray[0]; ?></td>
      <td><?php echo $temparray[1]; ?></td>
      <td> </td>
      <td><?php echo str_replace("Tel:","",$temparray[2]); ?></td>
      <td><?php echo str_replace("Contact:","",$temparray[3]); ?></td>
      <td><?php echo str_replace("Website:","",$temparray[4]); ?></td>
      </tr>
  <?php }
                }
 // }
?>
</table>