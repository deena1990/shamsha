<?php
/*
 * Creates an access token with VoiceGrant using your Twilio credentials.
 */
include('./Twilio/autoload.php');
include('./config.php');
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;

// Use identity and room from query string if provided
$identity = isset($_GET["identity"]) ? $_GET["identity"] : NULL;
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

$chatToken = new AccessToken($ACCOUNT_SID, 
                         $API_KEY, 
                         $API_KEY_SECRET, 
                         3600, 
                         $identity
);

// Grant access to Voice
$voiceGrant = new VoiceGrant();
$voiceGrant->setOutgoingApplicationSid($APP_SID);
$voiceGrant->setPushCredentialSid($APN_CREDENTIAL_SID);
$voiceToken->addGrant($voiceGrant);

// Grant access to Chat
$chatGrant = new ChatGrant();
$chatGrant->setServiceSid($APNCredentialSid);
$chatToken->addGrant($chatGrant);

//echo $token->toJWT();
$myObj = new stdClass();
$myObj->token = $voiceToken->toJWT();
$myJSON = json_encode($myObj);
echo $myJSON;
