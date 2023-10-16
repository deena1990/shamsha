<?php
/*
 * Creates an endpoint that plays back a greeting.
 */
include('./Twilio/autoload.php');
include('./config.php');

$ch = curl_init("https://shamsaha.com/app/apis/Victim/helplineTwilioAR"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = json_decode(curl_exec($ch));
curl_close($ch);

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();

$response->say('Welcome to Shamsa ha, please wait.');

if($data->caller=="NULL"){
	$response->say('No available volunteer');
}else{
	$response->say('Connecting');
	$dial = $response->dial('', ['callerId' => 'client:VOIP_'.$data->caseId]);
	$client = $dial->client($data->caller);
	$client->parameter(['name' => 'from', 'value' => $data->caseId]);
	$client->parameter(['name' => 'to', 'value' => $data->caller]);
}
$response->say('Goodbye');

print $response;