<?php
/*twilio-php\
 * Creates an access token with VoiceGrant using your Twilio credentials.
 */
/*require_once ('./Twilio/autoload.php');*/
include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\ChatGrant;

// Use identity and room from query string if provided
$identity = isset($_GET["identity"]) ? $_GET["identity"] : 'alice';
if (!isset($identity) || empty($identity)) {
  $identity = isset($_POST["identity"]) ? $_POST["identity"] : "alice";
}

// Create access token, which we will serialize and send to the client
$voiceToken = new AccessToken($ACCOUNT_SID, 
                         $API_KEY, 
                         $API_KEY_SECRET, 
                         3600, 
                         $identity
);

$videoToken = new AccessToken($ACCOUNT_SID, 
                         $API_KEY, 
                         $API_KEY_SECRET, 
                         3600, 
                         $identity
);

$chatToken = new AccessToken($ACCOUNT_SID, 
                         $API_KEY, 
                         $API_KEY_SECRET, 
                         3600, 
                         $identity
);

// Grant access to Voice
$voiceGrant = new VoiceGrant();
$voiceGrant->setOutgoingApplicationSid($APP_SID);
$voiceGrant->setPushCredentialSid($PUSH_CREDENTIAL_SID);
$voiceToken->addGrant($voiceGrant);

// Grant access to Video
$videoGrant = new VideoGrant();

$videoToken->addGrant($videoGrant);

// Grant access to Chat
$chatGrant = new ChatGrant();
$chatGrant->setServiceSid($TWILIO_CHAT_SERVICE_SID);
$chatToken->addGrant($chatGrant);

//echo $token->toJWT();
//echo $token;
$myObj = new stdClass();
$myObj->token = $voiceToken->toJWT();
$myJSON = json_encode($myObj);
echo $myJSON;