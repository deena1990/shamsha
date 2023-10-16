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

$identity = isset($_GET["identity"]) ? $_GET["identity"] : NULL;
if (!isset($identity) || empty($identity)) {
  $identity = isset($_POST["identity"]) ? $_POST["identity"] : $requestData["identity"];
}

$bindingType = isset($_POST["bindingType"]) ? $_POST["bindingType"] : $requestData["bindingType"];
if (!isset($bindingType) || empty($bindingType)) {
  $bindingType = isset($_GET["bindingType"]) ? $_GET["bindingType"] : $requestData["bindingType"];
}

$address = isset($_POST["address"]) ? $_POST["address"] : $requestData["address"];
if (!isset($address) || empty($address)) {
  $address = isset($_GET["address"]) ? $_GET["address"] : $requestData["address"];
}

/*print("address : ");
echo  $address;print("\n");
print("identity : ");
echo $identity;print("\n");
print("bindingType : ");
echo $bindingType;print("\n");*/
/*$endpoint = isset($_POST["endpoint"]) ? $_POST["endpoint"] : NULL;
if (!isset($endpoint) || empty($endpoint)) {
  $endpoint = isset($_GET["endpoint"]) ? $_GET["endpoint"] : "XXXXXXXXXXXXXXX";
}*/

// Create a binding
try {
    $binding = $client->notify->v1->services($TWILIO_NOTIFICATION_SERVICE_SID)->bindings->create(
        $identity,
        $bindingType,
        $address,
    );
    
    $response = array(
        'message' => 'binding created',
		'sid' => $binding->sid
		
    );
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($response);
} catch (Exception $e) {
    $response = array(
        'message' => 'Error creating binding: ' . $e->getMessage(),
        'error' => $e->getMessage()
    );
    header('Content-type:application/json;charset=utf-8');
    http_response_code(500);
    echo json_encode($response);
}