<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
/*require_once ('./Twilio/autoload.php');*/
include('./Twilio/autoload.php');

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$twilio = new Client($ACCOUNT_SID, 'b6c55da917e0c43b5b513ecce468c38a');

$message = $twilio->chat->v2->services("IS11f09501c6d34171a9cb7fbb36823a3d")
                            ->channels("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                            ->messages
                            ->create();

print($message->sid);