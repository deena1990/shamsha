<?php
    $url = "https://fcm.googleapis.com/fcm/send";
    $token = "frq4no1iT_qTtGl4Z2Xd0t:APA91bFluXpm9DM0BLD8ly-WbMikkd3s-2-narnzvgM_5KNWp26CTiz-NWGbPtoCUMmAV7PQhSVb98EfdCLO-Ow361hS0BTS7i6BSIWRgXt3pAlzZjt_WPGtJC4x8G6cEJlR17tGoRZ1";
    $serverKey = 'AAAAgUKdWY0:APA91bE6O2ho0VKN5mYR4GSRUMZzcwhVNpGwdLl_8ILUuVki1XNUdlh6XdEJhJReYH5WZZdbcid_QLIujYEFkSZtqBtbfn_tduyglwVVPJq3Si5pN_r2pv-OrAtc40INmjNaB73SYzBp';
    $title = "Notification title";
    $body = "Hello I am from Your php server";
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
?>