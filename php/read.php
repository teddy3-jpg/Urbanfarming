<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();
 
require_once("server.php");
  
$sql = "SELECT * FROM sensor";
$result = mysqli_query($db, $sql);
 
if (mysqli_num_rows($result) > 0) {
    
	 
    $response["sensor"] = array();
 
 
    while ($row = mysqli_fetch_array($result)) {
        // temperoary user array
        $sensor = array();
        $sensor["id"] = $row["id"];
        $sensor["temp"] = $row["temp"];
        $sensor["hum"] = $row["hum"];
        $sensor["moisture"] = $row["moisture"];
        $sensor["water"] = $row["water"];
        $sensor["light"] = $row["light"];
        $sensor["alarm"] = $row["alarm"];
		// push sensor 
        array_push($response["sensor"], $sensor);
    }
    // On success
    $response["success"] = 1;
 
    echo json_encode($response);
}	
else 
{
    // if no data is found
	$response["success"] = 0;
    $response["message"] = "No data on sensor found";
  
    echo json_encode($response);
}


?>