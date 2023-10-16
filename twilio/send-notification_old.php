<?php

include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

// Authenticate with Twilio
$client = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

function getPost()
{
    // when using application/json as the HTTP Content-Type in the request 
    $post = json_decode(file_get_contents('php://input'), true);
    if(json_last_error() == JSON_ERROR_NONE){
        return $post;
    }
    return [];
}
$requestData = getPost();

/*$identity = isset($_GET["identity"]) ? $_GET["identity"] : $requestData["identity"];
if (!isset($identity) || empty($identity)) {
  $identity = isset($_POST["identity"]) ? $_POST["identity"] : $requestData["identity"];
}

$message = isset($_POST["message"]) ? $_POST["message"] : $requestData["message"];
if (!isset($message) || empty($message)) {
  $message = isset($_GET["message"]) ? $_GET["message"] : $requestData["message"];
}*/


try {
	$identity = isset($_GET["identity"]) ? $_GET["identity"] : (isset($_POST["identity"])? $_POST["identity"]:NULL);
	if (!isset($identity) || empty($identity)) {
		$response = array(
			"status" => "invalid",
			"message" => "identity not send"
		);
		header('Content-type:application/json;charset=utf-8');
		echo json_encode($response);
		return;
	}

	$message = isset($_POST["message"]) ? $_POST["message"] : (isset($_POST["message"])? $_POST["message"]:NULL) ;
	if (!isset($message) || empty($message)) {
		$response = array(
			"status" => "invalid",
			"message" => "identity not send"
		);
		header('Content-type:application/json;charset=utf-8');
		echo json_encode($response);
		return;
	}

	
    $notification = $client->notify->v1->services($TWILIO_NOTIFICATION_SERVICE_SID)->notifications->create(
       [
		   "apn" => [
			   "aps" => [
				   "alert" => [
					   "title" => "Shamsaha Alert",
					   "body" => $message,
				   ],
				   "badge" => 1
			   ]
		   ],
		   "body" => $message,
		   "fcm" => [
			   "notification" => [
				   "title" => "Shamsaha Alert",
				   "body" => $message,
			   ]
		   ],
		   "identity" => [$identity],
		   "title" => "Shamsaha Alert"
	   ]
    );

    $response = array(
		"status" => "valid",
        "notificationSid" => $notification->sid,
		"message" => $message
    );
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($response);
} catch (Exception $e) {
    $response = array(
		"status" => "invalid",
        "message" => "Error creating notification: " . $e->getMessage(),
        "error" => $e->getMessage()
    );
    header('Content-type:application/json;charset=utf-8');
    http_response_code(500);
    echo json_encode($response);
}