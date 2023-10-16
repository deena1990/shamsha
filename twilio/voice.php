<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$twilio = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

$call = $twilio->calls
               ->create("+97317651421", // to
                        "+97333378686", // from
                        ["url" => "http://demo.twilio.com/docs/voice.xml"]
               );

print($call->sid);