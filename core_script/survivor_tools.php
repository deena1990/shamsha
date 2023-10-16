<?php
header("Content-Type: application/json; charset=utf-8");

//Response for JSON file
$response = array();
$response["status"] = false;
$response["message"] = "";
 

/*
 * All database connection variables
*/

// define('DB_USER', "i136288mjt_shamsaha_app"); // db user
// define('DB_PASSWORD', "9%Lqpj35"); // db password (mention your db password here)
// define('DB_DATABASE', "shamsaha_app"); // database name
define('DB_USER', "root"); // db user
define('DB_PASSWORD', ""); // db password (mention your db password here)
define('DB_DATABASE', "shamsaha_shamshaApp"); // database name
define('DB_SERVER', "localhost"); // db server

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());


 
mysqli_set_charset($con,"utf8");


// get all details
$result = mysqli_query($con,"SELECT * FROM wc_survivor_tools ORDER BY s_id");

// check for empty result
if (mysqli_num_rows($result) > 0) {
	
	// success
    $response["status"] = true;

    $response["data_en"] = array();
    $response["data_ar"] = array();
	
	
 
    while ($row = mysqli_fetch_array($result)) {

        $data = array();
        $data["name"] = $row["name"];
        $data["path"] = $row["path"];
    
        $reg = '/[A-Za-z]/';
        if(preg_match($reg, $data["name"])){
            array_push($response["data_en"], $data);
        }else{
            array_push($response["data_ar"], $data);
        }
        // push single data into final response array
        // array_push($response["data"], $data);
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