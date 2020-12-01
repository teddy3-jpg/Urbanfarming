<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
$response = array();
 
 
if (isset($_GET['temp'])&& isset($_GET['hum'])&&isset($_GET['moisture'])&& isset($_GET['water'])&& isset($_GET['light'])&& isset($_GET['alarm'])) {
 
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];
    $moisture = $_GET['moisture'];
    $water = $_GET['water'];
    $light = $_GET['light'];
    $alarm = $_GET['alarm'];
 
   
	require_once("server.php");
 
 
 
    //  insert data in sensor table
    $query = "INSERT INTO sensor (temp,hum,moisture,water,light,alarm) VALUES('$temp','$hum','$moisture','$water','$light','$alarm')";

    $result = mysqli_query($db, $query);
  
    if ($result) {
        // if successfully inserted 
        $response["success"] = 1;
        $response["message"] = "sensor successfully created.";
  
        echo json_encode($response);
    } else {
        // if failed to insert data
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
  
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
  
    echo json_encode($response);
}
?>