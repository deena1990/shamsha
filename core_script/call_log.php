<?php
header("Content-Type: application/json; charset=utf-8");

//Response for JSON file
$response = array();
$response["status"] = false;
$response["message"] = "";
 

/*
 * All database connection variables
*/

define('DB_USER', "sayg_wcci_usr"); // db user
define('DB_PASSWORD', "[J?ST]vr=.]6"); // db password (mention your db password here)
define('DB_DATABASE', "sayg_wcci"); // database name
define('DB_SERVER', "localhost"); // db server

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());


 
mysqli_set_charset($con,"utf8");


// get all details
$result = mysqli_query($con,"SELECT * FROM sayg_wcci.victim WHERE connection_type='CALL' AND status =1 AND updated_at >= now() - INTERVAL 1 DAY ORDER BY id DESC");

//echo "SELECT * FROM sayg_wcci.victim WHERE connection_type='CALL' AND status =1 AND updated_at >= now() - INTERVAL 1 DAYORDER BY id DESC";


// check for empty result
if (mysqli_num_rows($result) > 0) {
	
	// success
    $response["status"] = true;

    $response["data"] = array();
	
	
 
    while ($row = mysqli_fetch_array($result)) {

        $data = array();
        $data["case_id"] = $row["case_id"];
        $data["updated_at"] = $row["updated_at"];
    
        // push single data into final response array
        array_push($response["data"], $data);
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