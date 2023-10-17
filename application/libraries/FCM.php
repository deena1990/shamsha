<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FCM {
    public $serverKey;
    function __construct() {
        // $this->serverKey = "AAAAgUKdWY0:APA91bE43TS4KluqXwMqtnDZnC4DrTDhYdO667d0xIBRrSEDqG2KmZ45DY2XtX99avhhtJiYvp5l0kVX7u6nuwHYlp7rP5TCAEQjXWGSwz_9YqLfD5WsvSJ22X4QbsNoRYzRavdS3qS6";
        $this->serverKey = "AAAAmoPSp1Y:APA91bHc2UAsDm1uVNbCPEjhCGcIGpvtSRGNNAUcibRaVrEwElSf1kwnNxSSd9vDI6ntHLJdBJTlneKNkQQOo63_tWjSZlT7-ajNl2nOs2GLvhE7Z8Rv_t1eOhA6NwJHoqQK2SZFLZRi";
  
    }
    /**
     * Sending Push Notification
     */

    public function send_notification($registatoin_ids, $notification,$device_type,$multiple,$type=null) {
        $json = '{"type":'.$type.'}';
        $fields = [];
        //echo $multiple;

        if($multiple){
            foreach($registatoin_ids as $token){
                $fields['to'] = $token;
                $fields['notification'] = $notification;
                $fields['tag'] = array('android'=>$json);
                return $this->fcmCurl($fields);
            }
            
            
        }
        else{
            $fields['to'] = $registatoin_ids;
            $fields['notification'] = $notification;
            return $this->fcmCurl($fields);
        }
        // if($device_type == "Android"){
        //     $fields['notification'] = $notification;
        // } else {
        //     $fields['notification'] = $notification;

        // }
        // echo "<pre>";print_r($fields['registration_ids']);die;
     //return $fields; 
        //return $this->fcmCurl($fields);

    }

    public function sendBulkNotification($title = "", $body = "", $customData = [], $topic = ""){
        $data = array(
            "priority" => "high",
            "to" => '/topics/'.$topic,
            'notification' => array(
                "body" => $body,
                "title" => $title
            ),
            // "data" => $customData
        );
        if(!empty($customData)){
            $data['data'] = $customData;
        }

//        print_r($data);
        return $this->fcmCurl($data);
    }

    public function fcmCurl($fields){
        // echo"<pre>";print_r(json_encode($fields));
       
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array('Authorization:key='.$this->serverKey,'Content-Type:application/json');
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        // echo "<pre>";
        // print_r($result); die;
        return $result;
    }
}
?>