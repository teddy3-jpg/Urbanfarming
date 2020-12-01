<?php
$db_host="localhost";
$db_database="iot";
$db_username="root";
$db_password="";
$mysqli= new mysqli($db_host, $db_username, $db_password, $db_database);
if($mysqli->connect_errno)
die ("failed");
?>