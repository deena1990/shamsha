<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
include('./Twilio/autoload.php');
include('./config.php');

use Twilio\Rest\Client;

$client = new Client($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

$rooms = $client->video->v1->rooms
							//->create(["uniqueName" => "DailyStandup"]);
                           ->read(["uniqueName" => "tesRdev"], 20);

foreach ($rooms as $record) {
    print($record->sid);
}

exit;

//if(isset($_GET['room'])){
// $room = $client->video->v1->rooms
//                          ->create(["uniqueName" => $_GET['room']]);
//print($room->sid);   
//}


//$room = $client->video->v1->rooms("DailyStandup")
//                          ->fetch();
//
print($room->uniqueName);