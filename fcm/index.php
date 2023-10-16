<?php
$regId = array();
$regId = array("cKbVkPz3QlWOHs2lpMGUCK:APA91bHSULWFCoYhRalAPgO918sJA4fHgCSCi_HZSSNVn_I_iEy1uxz8mssVFiN-7n1LAzY0SWuJRxqCM8FrFT00K6KWpZWqzTOpOfgH0iF7635Q_Q06SOvAYZrhQWlJcTo3CR5RSO5I","d_M_FJbLS--uBstsb4gv0X:APA91bFhV5RI7YiZVbMWcI8LUITe6_yVx-hgpcXGVAk98r1jJFtbwhwSG-EK2Oq8n4J5aMbDLH7UnZvEF0FX0wzXNPTR785ALirYMd628fp_xkkAMYI3XuI_dmHYUl60Ll6j0nzxj4z_","fTKcHe6PRfyos2LdsmYTGv:APA91bHsq4qX8EejMDtBIU5b5xs1KSfIakn71Wh52IurbWw89Elp83VuoKdvitTlgqGsYDhAUHSQrZAkChtjKybqjNvV-h2JgvyPs5iLpqzMV6-y4_188UP9nTNZDfEHHLqxowebPxIO");
 
//print_r($regId); 
$c = COUNT($regId);
echo $c;
// INCLUDE YOUR FCM FILE
include_once 'fcm.php';    
 
$notification = array();
$arrNotification= array();			
$arrData = array();		

$arrNotification["body"] ="New event got released";
$arrNotification["title"] = "Events are out";
$arrNotification["sound"] = "default";
$arrNotification["type"] = 1;
 
$fcm = new FCM();

for($i=0;$i<=$c;$i++){

$result = $fcm->send_notification($regId[$i], $arrNotification,"Android");
print_r($result);
}
//$result=$fcm->send_notification($regId, $arrNotification,"IOS");


?>