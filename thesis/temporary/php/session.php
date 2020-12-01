<?php

//Include our login information
include_once('db_connect.php');
if(null ==session_id())
session_start();
// Connect
// $mysqli= new mysqli($db_host, $db_username, $db_password, $db_database);
$db=mysqli_connect($db_host, $db_username, $db_password, $db_database);
if(mysqli_connect_errno($db))
{ echo "failed";
exit();}
 
// $user_check=$_SESSION['phone'];

    if(!isset($_SESSION['username'])||!isset($_SESSION['phone'])||!isset($_SESSION['email'])){
        $isLogged=false;
    }
    else{
        $isLogged=true;
        $username=$_SESSION['username'];
        $phone=$_SESSION['phone'];
        $email=$_SESSION['email'];
        $sql="SELECT role FROM `user` WHERE `username`=$username OR 'phone'=$phone OR 'email'=$email";
        $result=$db->query($sql);
        $result_row = mysqli_fetch_array($result,MYSQLI_ASSOC); ;
        $role=$result_row['role'] ;
        
        }
mysqli_close($db);
mysqli_close($mysqli);
?> 