<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//create json array
$response = array();
 

if (isset($_GET['id']) && (isset($_GET['light'])||isset($_GET['fan'])||isset($_GET['heater'])||isset($_GET['pump']))) {
 
    $id = $_GET['id'];
    $fan= $_GET['fan'];
    $heater= $_GET['heater'];
    $pump= $_GET['pump'];
    $light= $_GET['light'];

	require_once("server.php");
$result = mysqli_query($db, "UPDATE controller SET fan= '$fan', heater='$heater', light='$light', pump='$pump' WHERE id = '$id'");
 
    if ($result) {
         $response["success"] = 1;
        $response["message"] = "controller Data successfully updated.";
  
        echo json_encode($response);
    } else {
 
    }
} 
else if (isset($_GET['id']) && isset($_GET['port'])) {
 
    $id = $_GET['id'];
    $port= $_GET['port'];

	require_once("server.php");

$result = mysqli_query($db, "UPDATE controlpanel SET port= '$port' WHERE id = '$id'");
	

    if ($result) {
        
        $response["success"] = 1;
        $response["message"] = "controller Data successfully updated.";
 
        echo json_encode($response);
    } else {
 
    }}
else {
 
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    echo json_encode($response);
}
?>