<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();
 
require_once("server.php");

$sql = "SELECT * FROM controlpanel";
$result = mysqli_query($db, $sql);
 
if (mysqli_num_rows($result) > 0) {
    
	 
    $response["controlpanel"] = array();
 
 
    while ($row = mysqli_fetch_array($result)) {
        // temperoary user array
        $controlpanel = array();
        $controlpanel["id"] = $row["id"];
        $controlpanel["port"] = $row["port"];
     
		// push sensor 
        array_push($response["controlpanel"], $controlpanel);
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