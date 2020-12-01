<?php

 
require_once("server.php");
  
$temp='';
$hum='';
$moisture='';
$water='';
$light='';
$timestamp='';
$alarm='';
$sql = "SELECT temp,hum,moisture,water,light,alarm,TIME(timestamp) as time FROM sensor";
$result = mysqli_query($db, $sql);
 
if (mysqli_num_rows($result) > 0) {
    
	
while ($row = mysqli_fetch_array($result)) {

    $temp = $temp . '"'. $row['temp'].'",';
    $hum = $hum . '"'. $row['hum'] .'",';
    $moisture = $moisture . '"'. $row['moisture'].'",';
    $water = $water . '"'. $row['water'] .'",';
    $light = $light . '"'. $row['light'].'",';
    $timestamp = $timestamp . '"'. $row['time'].'",';
    $alarm = $alarm . '"'. $row['alarm'].'",';
}



$temp = trim($temp,",");
$hum = trim($hum,",");
$moisture = trim($moisture,",");
$water = trim($water,",");
$light = trim($light,",");
$timestamp = trim($timestamp,",");
$alarm = trim($alarm,",");

}
?>