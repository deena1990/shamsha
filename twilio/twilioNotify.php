<?php

include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

$client = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

$id = isset($_GET["room_id"]) ? $_GET["room_id"] : NULL;
if (!isset($id) || empty($id)) {
  $id = isset($_POST["room_id"]) ? $_POST["room_id"] : "0";
}

$type = isset($_GET["type"]) ? $_GET["type"] : NULL;
if (!isset($type) || empty($type)) {
  $type = isset($_POST["type"]) ? $_POST["type"] : "dn sou lew";
}

$identity = isset($_GET["invite_id"]) ? $_GET["invite_id"] : NULL;
if (!isset($identity) || empty($identity)) {
  $identity = isset($_POST["invite_id"]) ? $_POST["invite_id"] : "shamsaha_victim";
}

$message = isset($_POST["message"]) ? $_POST["message"] : NULL;
if (!isset($message) || empty($message)) {
  $message = isset($_GET["message"]) ? $_GET["message"] : "Empty";
}

$notification = $client->notify->v1->services($TWILIO_NOTIFICATION_SERVICE_SID)
                                   ->notifications
                                   ->create([
									  		 	
                                               "apn" => [
                                                    "aps" => [
														"content-available"=>1,
														"mutable-content"=>1,
                                                        "alert" => [
                                                            "title" => "Shamsaha",
                                                            "body" => $message
                                                        ],
                                                        "badge" => 1,
														"sound" => "default"
                                                    ],
													"response"=>[
														"room_id" => $id,
														"type" => $type
													],
                                                ],
											   "fcm" => [
			  										"notification" => [
				  										 "title" => "Shamsaha",
				 										  "body" => $message
			 										 ],
													 "data" => [
													     "room_id" => $id,
													  	  "type" => $type
													  ]
												],
                                                "identity" => [$identity]
                                           ]
                                   );
if($notification->sid){
	$response = array(
		"status" => "valid",
		"message" => $message,
		"room_id" => $id,
		"type" => $type
	);
	header('Content-type:application/json;charset=utf-8');
	http_response_code(200);
	echo json_encode($response);
}else{
	$response = array(
		"status" => "invalid",
		"message" => $message,
		"room_id" => $id,
		"type" => $type
	);
	header('Content-type:application/json;charset=utf-8');
    http_response_code(500);
    echo json_encode($response);
}
//print($notification);

