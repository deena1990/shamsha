<?php
header("Content-Type: application/json; charset=utf-8");

//Response for JSON file
//$response = array();
//$response["status"] = false;
//$response["message"] = "";
 

/*
 * All database connection variables
*/

define('DB_USER', "sayg_wcci_usr"); // db user
define('DB_PASSWORD', "[J?ST]vr=.]6"); // db password (mention your db password here)
define('DB_DATABASE', "sayg_wcci"); // database name
define('DB_SERVER', "localhost"); // db server

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());


 
mysqli_set_charset($con,"utf8");

//Receive the search key word & validation
    if(!empty($_POST["volunteer_id"])){
	
    $volunteer_id=$_POST["volunteer_id"];
	}
	else{
	$response["message"] = "volunteer_id parameter required";
	echo json_encode($response);
	die;
	}



// get all details
$result = mysqli_query($con,"SELECT * FROM sayg_wcci.wc_voulnteer WHERE vounter_id= '$volunteer_id'");
//echo "SELECT * FROM sayg_wcci.wc_volunteer WHERE vounter_id= '$volunteer_id'";

// check for empty result
if (mysqli_num_rows($result) > 0) {
	
	// success
    //$response["status"] = true;

    $response = array();
	
	
 
    while ($row = mysqli_fetch_array($result)) {

        //$data = array();
        $object = new stdClass();
        $object->name = $row["vname"];
        $object->email = $row["vemail"];
        $object->mobile = $row["vmobile"];
        $object->language = $row["language_known"];
        //$myArray[] = $object;
        //$data["name"] = $row["vname"];
        //$data["email"] = $row["vemail"];
        //$data["mobile"] = $row["vmobile"];
        //$data["language"] = $row["language_known"];
    
        // push single data into final response array
        array_push($response, $object);
    }
    // echoing JSON response
    echo json_encode($response);
} else {
    // no videos found
    $response["status"] = false;
    $response["message"] = "No details found";
 
    echo json_encode($response);
}
?>