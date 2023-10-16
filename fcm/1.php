<?php
$dv_id [] = array(
                'dv_id' => $re['dv_id'],
            );
//Loop through your id's array

for ($i = 1; $i < count($dv_id); $i++) {

//Call your send notification function link this
    send_notification($dv_id[$i]['dv_id'],$title,$msg);
}

function send_notification($device_id,$title,$message){

// API access key from Google API's Console
// prep the bundle
    $msg = array
    (
        'to'=>$device_id,
        'notification' => array('body'=>$message,'title'=>$title,
            'click_action'=>'MY_ACTIVITY_1','sound'=>'tone'),
        'data' => array('message'=>$message,'title'=>$title)

    );
    $headers = array
    (
        'Authorization: key=AAAAgUKdWY0:APA91bE43TS4KluqXwMqtnDZnC4DrTDhYdO667d0xIBRrSEDqG2KmZ45DY2XtX99avhhtJiYvp5l0kVX7u6nuwHYlp7rP5TCAEQjXWGSwz_9YqLfD5WsvSJ22X4QbsNoRYzRavdS3qS6',
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $msg ) );
    $result = curl_exec($ch );
    curl_close( $ch );

}?>