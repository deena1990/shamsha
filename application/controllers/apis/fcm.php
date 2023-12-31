<?php
class FCM {
	function __construct() {
	}
	/**
	  * Sending Push Notification
	  */
	public function send_notification($registatoin_ids, $notification,$device_type) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		if($device_type == "Android"){
			$fields = array(
				'to' => $registatoin_ids,
				'data' => $notification
			);
		} else {
			$fields = array(
				'to' => $registatoin_ids,
				'notification' => $notification
			);
		}
		// Firebase API Key
		$headers = array
		(
		  'Authorization: key=AAAApdHl590:APA91bFVCJKCAAKUko7ZFn3jeUTisGxu7UNDeVD3EiZ5KWq7gvaBVUzp_0PAx-mQid4FHQMVXRhSnU8rYfHBWsJJmuytTFYEr3S3-Yt2nUPigOGv7jhS0iE6ZkFfU_o_4j4IyTkwNIx3',
		  'Content-Type: application/json'
		);
		echo print_r($fields);
		echo print_r($headers);
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
		echo "result \n\n";
		echo $result;
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
	}
}   
?>