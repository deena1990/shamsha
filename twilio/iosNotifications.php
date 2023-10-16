<?php

include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

$client = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

$id = isset($_GET["id"]) ? $_GET["id"] : NULL;
if (!isset($id) || empty($id)) {
  $id = isset($_POST["id"]) ? $_POST["id"] : "0";
}

$type = isset($_GET["type"]) ? $_GET["type"] : NULL;
if (!isset($type) || empty($type)) {
  $type = isset($_POST["type"]) ? $_POST["type"] : "dn sou lew";
}

$identity = isset($_GET["identity"]) ? $_GET["identity"] : NULL;
if (!isset($identity) || empty($identity)) {
  $identity = isset($_POST["identity"]) ? $_POST["identity"] : "shamsaha_victim";
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
														"id" => $id,
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
		"id" => $id,
		"type" => $type
	);
	header('Content-type:application/json;charset=utf-8');
	http_response_code(200);
	echo json_encode($response);
}else{
	$response = array(
		"status" => "invalid",
		"message" => $message,
		"id" => $id,
		"type" => $type
	);
	header('Content-type:application/json;charset=utf-8');
    http_response_code(500);
    echo json_encode($response);
}
//print($notification);

