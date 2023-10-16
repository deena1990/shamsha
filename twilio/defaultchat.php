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

$CHANNEL = isset($_GET["CHANNEL"]) ? $_GET["CHANNEL"] : $requestData["CHANNEL"];
if (!isset($CHANNEL) || empty($CHANNEL)) {
  $CHANNEL = isset($_POST["CHANNEL"]) ? $_POST["CHANNEL"] : $requestData["CHANNEL"];
}

$USER = isset($_POST["USER"]) ? $_POST["USER"] : $requestData["USER"];
if (!isset($USER) || empty($USER)) {
  $USER = isset($_GET["USER"]) ? $_GET["USER"] : $requestData["USER"];
}

$MESSAGE = isset($_POST["MESSAGE"]) ? $_POST["MESSAGE"] : $requestData["MESSAGE"];
if (!isset($MESSAGE) || empty($MESSAGE)) {
  $MESSAGE = isset($_GET["MESSAGE"]) ? $_GET["MESSAGE"] : $requestData["MESSAGE"];
}

$service = $client->chat->v2->services($TWILIO_CHAT_SERVICE_SID)
                            ->update(array(
                                         "notificationsAddedToChannelEnabled" => True,
                                         "notificationsAddedToChannelSound" => "default",
                                         "notificationsAddedToChannelTemplate" => "A New message in ${CHANNEL} from ${USER}: ${MESSAGE}"
                                     )
                            );
echo "A New message in ${CHANNEL} from ${USER}: ${MESSAGE}\n";
print($service->friendlyName);
//echo "\n";
//print_r($service->links);
//echo "\n";
//print_r($service);
