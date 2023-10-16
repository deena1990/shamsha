<?php
/*twilio-php\
 * Creates an access token with VoiceGrant using your Twilio credentials.
 */
/*require_once ('./Twilio/autoload.php');*/
include('./Twilio/autoload.php');
include('./config.php');
include('./randos.php');

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\ChatGrant;

// Use identity and room from query string if provided
$identity = '';

if (isset($_GET['identity'])) {
    $identity = $_GET['identity'];
}

if (empty($identity)) {
    // choose a random username for the connecting user (if one is not supplied)
    $identity = randomUsername();
}

//$identity = isset($_GET["identity"]) ? $_GET["identity"] : "identity";
$room = isset($_GET["room"]) ? $_GET["room"] :  "";

// Create access token, which we will serialize and send to the client
$token = new AccessToken($TWILIO_ACCOUNT_SID, 
                         $TWILIO_API_KEY, 
                         $TWILIO_API_SECRET, 
                         3600, 
                         $identity
);

// Grant access to Voice
$voiceGrant = new VoiceGrant();
$voiceGrant->setOutgoingApplicationSid($TWILIO_APP_SID);
$voiceGrant->setPushCredentialSid($TWILIO_PUSH_CREDENTIAL_SID);
$token->addGrant($voiceGrant);

// Grant access to Video
$videoGrant = new VideoGrant();
$videoGrant->setRoom($room);
$token->addGrant($videoGrant);

// Grant access to Chat
$chatGrant = new ChatGrant();
$chatGrant->setServiceSid($TWILIO_CHAT_SERVICE_SID);
$chatGrant->setPushCredentialSid($TWILIO_PUSH_CREDENTIAL_SID);
$token->addGrant($chatGrant);

//echo $token->toJWT();
//echo $token;
//$myObj = new stdClass();
//$myObj->token = $token->toJWT();
//$myJSON = json_encode($myObj);
//echo $myJSON;

// return serialized token and the user's randomly generated ID
header('Content-type:application/json;charset=utf-8');
echo json_encode(array(
    'identity' => $identity,
    'token' => $token->toJWT(),
));