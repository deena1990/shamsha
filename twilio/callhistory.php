<?php
/*twilio-php\
 * Creates an access token with VoiceGrant using your Twilio credentials.
 */
/*require_once ('./Twilio/autoload.php');*/
include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$twilio = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

$calls = $twilio->calls
                ->read([/*"startTime" => new \DateTime('2021-11-19T00:00:00Z')*/], 20);

foreach ($calls as $record) {
    print($record);
	 print("=====");
}
