<?php
include('./Twilio/autoload.php');
include('./config.php');

use Twilio\TwiML\VoiceResponse;

$callerId = isset($_GET["callerId"]) ? $_GET["callerId"] : "";
if (!isset($callerId) || empty($callerId)) {
  $callerId = isset($_POST["callerId"]) ? $_POST["callerId"] : "Shamsaha";
}
$from="";
if(strpos($callerId, "Shamsaha") !== false){
    $pieces = explode(":", $callerId);
	$callerId = $pieces[0];
	$from = $pieces[1];
}else{
	$from=$callerId;
} 
/*
$from = isset($_POST["from"]) ? $_POST["from"] : "";
if (!isset($from) || empty($from)) {
  $from = isset($_GET["from"]) ? $_GET["from"] : "";
}*/

$to = isset($_POST["to"]) ? $_POST["to"] : "";
if (!isset($to) || empty($to)) {
  $to = isset($_GET["to"]) ? $_GET["to"] : "";
}

$response = new VoiceResponse();

$response->say('Welcome to shamsaha  .  ');
if (!isset($to) || empty($to)) {
  $response->say('Not valid number send');
} else if (is_numeric($to)) {
	$response->say('Connecting to phone Number');
	$dial = $response->dial('', ['callerId' => '+97333378686']);
	$dial->number($to);
} else {
	$response->say('Connecting');
	$dial = $response->dial('', ['callerId' => 'client:'.$callerId]);
	$client = $dial->client($to);
	$client->parameter(['name' => 'from', 'value' => $from]);
	$client->parameter(['name' => 'to', 'value' => $to]);
}
$response->say('Goodbye');
print $response;