<?php
header('Content-Type: application/json');
if(isset($_POST)){
    $name = $_POST['name'];
    $email = $_POST['email'];
 $array = array("name" => $name,"email" => $email);
echo json_encode($array);   
}

?>