<?php
$con = mysqli_connect("localhost","saygaug_wcciapp","*OvYMBcWrW1u","saygaug_wcci_application");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  $sql = mysqli_query($con, "select * from wc_pages where wcp_id =8");
  $counter =0 ;
 $row = mysqli_fetch_array($sql); ?>
  
<html>
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body style=" color:#fff; background-color:#F05A94;" align="justify">
        
        <div class="row">
            <h4 align="center">WHO WE ARE</h4>
        
            <div class="col-md-6" style=" font-size:14px; width:90%">
                 <?php 
           $con_en = $row['content_en'];
            $content_en = str_replace(array("<pre>"), " ", $con_en);
           echo $content_en; ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3" style="float:left">
                <img src="<?php echo $row['team1']; ?>">
            </div>
            <div class="col-md-3">
                <img src="<?php echo $row['team2']; ?>">
            </div>
        </div>
        
        
      
    </body>
</html>