<?php
/*
 * Makes a call to the specified client using the Twilio REST API.
 */
include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

$identity = 'SV000069';
$callerNumber = '+97333378686';
$callerId = 'client:shamsaha_server';
//$callerId = 'client:apanta_re_malaka';
$to = isset($_GET["to"]) ? $_GET["to"] : $identity;
if (!isset($to) || empty($to)) {
  $to = isset($POST["to"]) ? $_POST["to"] : "";
}

$client = new Client($TWILIO_ACCOUNT_SID, 'b6c55da917e0c43b5b513ecce468c38a');

$call = NULL;
if (!isset($to) || empty($to)) {
  $call = $client->calls->create(
    'client:alice', // Call this number
    $callerId,      // From a valid Twilio number
    array(
      'url' => 'https://shamsaha.org/app/twilio/incoming.php'
    )
  );
} else if (is_numeric($to)) {
  $call = $client->calls->create(
    $to,           // Call this number
    $callerNumber, // From a valid Twilio number
    array(
      'url' => 'https://shamsaha.org/app/twilio/incoming.php'
    )
  );
} else {
  $call = $client->calls->create(
    'client:'.$to, // Call this number
    $callerId,     // From a valid Twilio number
    array(
      'url' => 'https://shamsaha.org/app/twilio/incoming.php'
    )
  );
}

print $call;
