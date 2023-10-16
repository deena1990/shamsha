<!DOCTYPE html>
<html>
<head>
  <title>Shamsaha Booking </title>
</head>
<body>
<div class="">
	<p style="margin:0;">You have received a new booking request from Shamsaha. Please find the booking details below.</p><br>
	<p style="margin:0;">Cpr/id: <?php echo $cpr_id ?></p>
	<p style="margin:0;">Name <?php echo $victim_name ?></p>
	<p style="margin:0;">Email <?php echo $victim_email ?></p>
	<p style="margin:0;">Phone number: <?php echo $victim_mobile ?></p>
	<p style="margin:0;">Date: <?php echo date("d M Y", strtotime($booking_date)) ?></p>
	<p style="margin:0;">Number of Rooms: <?php echo $no_of_rooms ?></p>
	<p style="margin:0;">Smoking: <?php echo $smoking?"Yes":"No" ?></p>
	<p style="margin:0;">Breakfast: <?php echo $breakfast?"Yes":"No" ?></p>
<br>
<p style="margin:0;"><a style="text-decoration:none" href="<?php echo $url ?>">Please click here to confirm the booking.</a></p>
<br>


<p style="margin:0;">Regards,</p>
<p style="margin:0;">Shamsaha</p>
</div>
</body>
</html>