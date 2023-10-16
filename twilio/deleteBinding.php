<?php

include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

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

$sid = isset($_GET["sid"]) ? $_GET["sid"] : NULL;
if (!isset($sid) || empty($sid)) {
  $sid = isset($_POST["sid"]) ? $_POST["sid"] : $requestData["sid"];
}


/*print("address : ");
echo  $address;print("\n");
print("identity : ");
echo $identity;print("\n");
print("bindingType : ");
echo $bindingType;print("\n");*/

// delete a binding
try {
	$globalSid = 0;
	$bindings = $client->notify->v1->services($TWILIO_NOTIFICATION_SERVICE_SID) ->bindings ->read([]);
	foreach ($bindings as $record) {
		//echo $record->identity;
		//echo "\n";
		if( $record->identity == $sid){
			echo $record->identity;
			echo "\n";
			echo $record->sid;
			echo "\n";
			$globalSid=$record->sid;
			break;
		}
    
	}
    $binding = $client->notify->v1->services($TWILIO_NOTIFICATION_SERVICE_SID)
                   ->bindings($globalSid)
                   ->delete();
	
	/*$client->chat->v2->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                             ->users("USXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                 ->userBindings("BSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                 ->fetch();
    */
    $response = array(
        'message' => 'binding terminated',
		'result'=> $binding
    );
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($response);
} catch (Exception $e) {
    $response = array(
        'message' => 'Unable to delete record'
		//'Error creating binding: ' . $e->getMessage(),
        //'error' => $e->getMessage()
    );
    header('Content-type:application/json;charset=utf-8');
    http_response_code(500);
    echo json_encode($response);
}