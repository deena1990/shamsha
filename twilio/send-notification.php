<?php

include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

// Authenticate with Twilio
//$client = new Client($TWILIO_ACCOUNT_SID, $TWILIO_API_KEY, $TWILIO_API_SECRET);

$client = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

// Send a notification
$service = $client->notify->v1->services($TWILIO_NOTIFICATION_SERVICE_SID);

$json = json_decode(file_get_contents('php://input'), true);

try {
	if(isset($json['identity'])){
		$notification = $service->notifications->create(
			[
				'identity' => isset($json['identity'])?$json['identity']:"0",
				'body' => 'Hello world!'
			]
		);

		$response = array(
			'message' => 'Notification Sent!'
		);
		header('Content-type:application/json;charset=utf-8');
		echo json_encode($response);
	}else{
		$response = array(
			'message' => 'Identity not send!'
		);
		header('Content-type:application/json;charset=utf-8');
		echo json_encode($response);
	}
   
} catch (Exception $e) {
    $response = array(
        'message' => 'Error creating notification: ' . $e->getMessage(),
        'error' => $e->getMessage()
    );
    header('Content-type:application/json;charset=utf-8');
    http_response_code(500);
    echo json_encode($response);
}